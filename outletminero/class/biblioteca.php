<?php
echo (preg_match('/biblioteca.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class biblioteca extends _GLOBAL_{
	
	public $LIMIT = 7;
	public $PAGINAS = 10;

public function main(){
	$db = $this->_db();
	
	$like = (!isset($_POST["like"]))? '0': strip_tags($_POST["like"]);
	$campo = (!isset($_POST["cmbPor"]))? 'titulo': strip_tags($_POST["cmbPor"]);	
	$aportado = (!isset($_POST["cmbAportado"]))? '0':strip_tags($_POST["cmbAportado"]);	
	//echo 'like='.$like.' campo='.$campo.' aportado='.$aportado;
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	if($campo=='nombre'){
		$result = mysql_query("SELECT * FROM `documentos` WHERE id in (SELECT iddocFK FROM palabrasclave WHERE nombre LIKE '%{$like}%')");
	}
	else{
		if($aportado=='0'){
			$result = mysql_query("SELECT * FROM documentos WHERE {$campo} LIKE '%{$like}%'");
		}else{
			$result = mysql_query("SELECT * FROM documentos WHERE titulo LIKE '%{$like}%' AND idbenefactorFK={$aportado};");			
		}
		
	}	
    $countresult=mysql_num_rows($result);
	$content = '<p class="txtTit">Biblioteca Virtual </p><p class="txtTit">Resultados de la b&uacute;squeda</p>';
	if($countresult>0){	
	return $content . $this->showArchivos($result, 'biblioteca', '4') . $this->paginacion($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'documentos', 'biblioteca', 'main', 1);
	
	//$this->paginacion($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'proveedores', 'proveedores', 'main', 1).'
	
	}else
	{
		return $content.='<p class="txtCont">No hay resultados que cumplan los criterios de búsqueda.</p>';
	}
	
}//main

public function download(){
	$db = $this->_db();
	
	$f = $_GET["_a"];
	$result = mysql_query("SELECT * FROM `documentos` WHERE id = {$f}");
	
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$f=$row["archivo"];    
	
	//Incluimos la clase
	require('zipArchive.lib.php');
	//La instanciamos
	$zip = new zipArchive();
 
	//$path = 'ruta donde se encuentra el archivo a comprimir';
	$path=$f;
	//$name = 'nombre del archivo comprimido, podemos usar / para crear una estructura de directorios';
	$name= $row["titulo"];
 
	//Anadimos el archivo a comprimir
	$zip->addFile($path, $name);
 
	$pathSave = $row["titulo"].'.zip';
	//Guargamos el archivo
	$zip->saveZip($pathSave);
 
	//Si desaemos inmediatamente descargar el archivo compreso
	$zip->downloadZip($pathSave);
	
	/*
	if (!isset($_GET["id"]) || $_GET["id"] == ''){ echo '<h2>No se encuentra el identificador</h2>'; exit(); }//if
		
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM documentos WHERE id='{$_GET['id']}'");
	$content = '';
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$D = (isset($row["archivo"]) && $row["archivo"] != '') ? $row["archivo"] : '';
	*/
	//Download pdf
    //$extensiones = array("pdf");
//    $D = $_GET["D"];
//    if(strpos($D,"/")!==false){
//        die("No puedes navegar por otros directorios");
//    }
//    $ftmp = explode(".",$D);
//    $fExt = strtolower($ftmp[count($ftmp)-1]);
//
//    if(!in_array($fExt,$extensiones)){
//        die("<b>ERROR!</b> no es posible descargar archivos con la extensión $fExt");
//    }

//  header ("Content-Disposition: attachment; filename=".$id."\n\n"); 
//	header ("Content-Type: application/octet-stream");
//	header ("Content-Length: ".filesize($enlace));
//	readfile($enlace);
	//pdf
}

public function ver(){
	if (!isset($_GET["id"]) || $_GET["id"] == ''){ echo '<h2>No se encuentra el identificador</h2>'; exit(); }//if
		
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM documentos WHERE id='{$_GET['id']}'");	
	$content = '';
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$result2 = mysql_query("SELECT nombre,sitioweb FROM benefactores WHERE id=".$row["idbenefactorFK"]);
	$row2 = mysql_fetch_array($result2, MYSQL_ASSOC);
	
	//$imagen="";	
	//$img = (isset($row["imagen"]) && $row["imagen"] != '') ? '<div style="border:#000000 1px solid; background:#FFFFFF; float:left; font-size:10px; color:#333333; margin-right: 20px; width:auto;"><img src="'. $row["imagen"] .'" alt="" border="0" /><br><span class="txtPP" style="padding:5px;">Foto: '. $row["pf"] .'</span></div>':'<iframe width="640" height="390" src="'. $row["embed"] .'" frameborder="0" allowfullscreen></iframe>';
	
	//$imagen = (isset($row["imagen"]) && $row["imagen"] != '') ? '<table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs"><tr><td><img src="'. $row["imagen"] .'" alt="" border="0" style="float:left; margin-right: 10px;" /><span class="txtPP">Foto: '. $row["pf"] .'</span></td></tr></table>' : '';
	//$video = (isset($row["video"]) && $row["video"] != '') ? $row["embed"] : '';
	
	$contenido = (isset($row["introduccion"]) && $row["introduccion"] != '') ? '<br /><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">'.$img. $row["introduccion"] .'</td></tr></table>' : '';
		
	return '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
          <tr>
            <td class="txtTit">'. $row["titulo"] .'</td>
          </tr>
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont"><span class="txtBold"> '. $this->txtFechaPub($row["fechapub"]) .'</span><span class="txtBold"> | Aportado por: </span><span class="linkCont"><a href="'.$row2["sitioweb"].'">'.$row2["nombre"].'</a></span></td>
            </tr>
          </table>
          '. $imagen . $contenido . $video .'
		 <table width="95%" border="0" height="27" align="center" cellspacing="10" cellpadding="0" hspace="25">
		 	<tr>
        		  <p>							
				  <embed src="'.$row["archivo"].'" width="100%" height="895" align="middle"></embed>				
				  </p>
     		</tr>
            <tr>
				<td align="center" class="txtBold">Disfrutaste la publicaci&oacute;n Comp&aacute;rtela!</td>
				<td>
					<a href="http://twitter.com/share" class="twitter-share-button" data-via="outletminero" data-url="http://www.outletminero.org/?F=biblioteca&amp;_f=ver&amp;id='. $row["id"] .'" data-text="'. $row["titulo"] .'" data-count="horizontal" data-lang="es">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>	
				</td>
				<td>
					<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=181783375212237&amp;xfbml=1"></script><fb:like href="http://www.outletminero.org/?F=biblioteca&amp;_f=ver&amp;id='. $row["id"] .'" send="false" layout="button_count" width="10" show_faces="false" font=""></fb:like>
				</td>
		  		<td>
					<a name="fb_share" type="button_count" share_url="http://www.outletminero.org/?F=biblioteca&amp;_f=ver&amp;id='. $row["id"] .'">Compartir</a> 
					<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
				</td>
			</tr>
          </table>
         <p class="linkCont"><!-- <a href="?F=comentarios&amp;_f=main&amp;tipo=2&amp;id='. $row["id"] .'">Deja tu comentario</a> -->
		 <!-- <span class="linkCont"><a href="?F=biblioteca&amp;_f=download&amp;_a='.$row["id"].'">Descargar</a></span> -->
		 
		 <span class="linkCont"><a href="?F=inicio&amp;_f=verNormas">Normas de uso</a></span></p><script language="JavaScript">
function saveas(saveAs){
document.execCommand("SaveAs",false,saveAs);
}</script>'. $this->showComments('4', $row["id"]);
		 
}//ver

public function verProductos(){
	
	return '
		 <table width="100%" border="0" align="center" cellspacing="0" cellpadding="0" >
		 	<tr><td>
        		  <p>							
				  <embed src="gallery/productosCliente/CatalogoHMM-Mineria.pdf" width="100%" height="740" align="middle"></embed>				
				  </p>
				  </td>
     		</tr>
          </table>
         <script language="JavaScript">
			function saveas(saveAs){
				document.execCommand("SaveAs",false,saveAs);
			}
		</script>';
}//ver

public function verAmoMineria(){
	
	return '
		 <table width="100%" border="0" align="center" cellspacing="0" cellpadding="0" >
		 	<tr><td>
        		  <p>							
				  <embed src="gallery/documentos/Yo_amo_la_mineria.pdf" width="100%" height="740" align="middle"></embed>				
				  </p>
				  </td>
     		</tr>
          </table>
         <script language="JavaScript">
			function saveas(saveAs){
				document.execCommand("SaveAs",false,saveAs);
			}
		</script>';
}//ver


}//class
?>