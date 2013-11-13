<?php
echo (preg_match('/biblioteca.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class categorias extends _GLOBAL_{
	
	public $LIMIT = 7;

public function main(){
	$db = $this->_db();	
	return '<p class="txtTit">Biblioteca Virtual </p>'.
	       $this->postBusqueda() .
	       $this->postCategorias() .		   
		   $this->postDocumentosCuadroBlanco();
//		   $this->postDocumentos() ;
}//main

public function postCategorias(){
    //$db = $this->_db();	
	//$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	//$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";	
	
	$content .= '<p class="txtTit">Categorias</p><table width="100%" border="0" cellpadding="0" cellspacing="10" class="tbBackWhite">
				  <tr>
				    <td class="divContenedor3">
						<table>';
						
	$result = mysql_query("SELECT * FROM categorias WHERE id!=10 ORDER BY nombre");
	$i=1;		
	//categorias
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$result2 = mysql_query("SELECT * FROM subcategorias WHERE idcategoriaFK=".$row["id"]." ORDER BY nombre");
		$countresult2=mysql_num_rows($result2);
		$content.= '<tr><td>&nbsp;&nbsp;<img width="50" height="50" src="'.$row["imagen"].'" /></td><td><p id="c'.$i.'m" class="txtTitCat" onclick="ocultar(\'1\' , \'#c'.$i.'m\' , \'#c'.$i.'o\' , \'#scs'.$i.'\');">'.$row["nombre"].' ('.$countresult2.')</p><p id="c'.$i.'o" class="txtTitCat2" onclick="ocultar(\'2\' , \'#c'.$i.'o\' , \'#c'.$i.'m\' , \'#scs'.$i.'\');">'.$row["nombre"].' ('.$countresult2.')</p></td></tr><tr><td></td><td>
		<ul class="oculta" id="scs'.$i.'">';
		//subcategorias
		while ($row2 = mysql_fetch_array($result2, MYSQL_ASSOC)){												
			$result3 = mysql_query("SELECT * FROM documentos WHERE idsubcategoriaFK=".$row2["id"]." ORDER BY titulo");
			$countresult3=mysql_num_rows($result3);			
			
			$content.='<li id="sc'.$i.'m" class="txtTitSC" onclick="ocultar(\'1\',\'#sc'.$i.'m\',\'#sc'.$i.'o\',\'#doc'.$i.'\');">'.$row2["nombre"].' ('.$countresult3.')</a></li>
        			   <li id="sc'.$i.'o" class="txtTitSC2" onclick="ocultar(\'2\',\'#sc'.$i.'o\',\'#sc'.$i.'m\',\'#doc'.$i.'\');">'.$row2["nombre"].' ('.$countresult3.')</a></li>';			
			
			if($countresult3>0){												
			$content.='<ul class="oculta" id="doc'.$i.'">';
			while ($row3 = mysql_fetch_array($result3, MYSQL_ASSOC)){
				$content.='<li class="linkCont"><a href="?F=biblioteca&amp;_f=ver&amp;id='.$row3["id"].'">'.$row3["titulo"].'</a></li>';			
			}
			$content.='</ul>';												
			}
			$i=$i+1;			
		}
		$content.='</ul></td></tr>';									
	}
	$content.='</table></td></tr></table>';						
	mysql_free_result($result);			
	return $content.'<script src="../js/jquery-1.6.1.min.js" type="text/javascript"></script> 
					 <script type="text/javascript"> 
						$(document).ready(function(){    				   	    
						$(".txtTitCat2").hide();
						$(".txtTitSC2").hide();
						$(".oculta").hide("slow");
						$(".clsBusqueda2").hide("slow");
						
																		
					});		

					function ocultar(ban,oculta, muestra, clase){
						//alert (ban+oculta+muestra+clase);
				 	    $(oculta).hide();
      					$(muestra).show();
						if(ban == \'1\'){	  
    	  					$(clase).show("slow");
						}else{	  
    		  				$(clase).hide("slow");			  			
						}
					}
					function funBA(){												
						$(".clsBusqueda2").show("slow");
						$("#btnBA").hide("slow");
						$(".clsBusqueda1").hide("slow");
					}
					</script>  
					';
#	return $content . $this->showCategorias($result, 'categorias');# . $this->paginacion($this->LIMIT, 'documentos', 'biblioteca', 'main');
}//postCategos

public function postBusqueda(){
	return '<p class="txtTit">B&uacute;squeda</p>
			
			<table width="100%" border="0" cellpadding="0" cellspacing="10" class="tbBackWhite">
				  <tr class="clsBusqueda1">
				    <td>
					  <form id="form4" name="form4" method="post" action="?F=biblioteca&amp;_f=main">					  						  
					      <SELECT NAME="cmbPor" id="cmbPor" size="1">
						   
						  	<OPTION VALUE="titulo">Titulo</OPTION>
							<OPTION VALUE="nombre">Palabra clave</OPTION> 
						  </SELECT>
						  <input name="like" type="text" id="like" size="65%" maxlength="255" />						
						  <input name="submit" type="submit" class="frmButtonM" id="submit" value="Buscar" />
						
					  </form>					  
					</td>
				  </tr>
				  <tr>
				  	<td>
				  		<input name="btnBA" type="button" class="frmButtonM" id="btnBA" value="B&uacute;squeda avanzada" onclick="funBA();" />
					</td>
				  </tr>
				  <tr>
				  	<td>
						<table width="100%" border="0" cellpadding="0" cellspacing="10" class="clsBusqueda2">
				  <tr>
				  <td>
				  <form id="form4" name="form4" method="post" action="?F=biblioteca&amp;_f=main">					    				  
					  <table>
					  	<tr>
							<td>
								<label class="txtBold">Titulo:</label>
							</td>
							<td>
								<input name="like" type="text" id="like" size="65%" maxlength="255" />
							</td>
						</tr>
						<tr>						
							<td>
								<label class="txtBold">Aportado por:</label>
							</td>
							<td>
								<SELECT NAME="cmbAportado" id="cmbAportado" size="1">
									<option value="0">Seleccionar</option>
								'
								.$this->benefactores().' 								  	
							  	</SELECT>								
								
						  	</td>																					
						</tr>
						<tr>
							<td>
							</td>
							<td>
								<input name="submit" type="submit" class="frmButtonM" id="submit" value="Buscar" />
							</td>
							
						</tr>
					</table>
				</form>
				</td>
				</tr>
			</table>
					</td>
				  </tr>
			</table>
			
			';
}
public function benefactores(){
		$result = mysql_query("SELECT * FROM benefactores WHERE id!=3 ORDER BY nombre");
		$content='';
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$content.='<OPTION VALUE="'.$row["id"].'">'.$row["nombre"].'</OPTION>';
		}
		return $content;
}
	

public function postDocumentos(){

	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM documentos ORDER BY fechasub");
	$content = '<p class="txtTit">Archivos recientes</p>';
	return $content . $this->showArchivos($result, 'biblioteca', '4') . $this->paginacion($this->LIMIT, 'documentos', 'biblioteca', 'main');
}

/*private function postDocumentosCuadroBlanco(){
	$result = mysql_query("SELECT * FROM documentos ORDER BY fechasub");
	$content = '<p class="txtTit">Archivos recientes</p>';
	$tipoComm=2;

 	$nfilas =  2;
	$col = 1;
	$filas = ceil($nfilas/$col);		
	  				
	$content.='<table width="100%" border="0" cellspacing="3" cellpadding="3">';
	for($c=0;$c<$filas;$c++){
		$content.='<tr>';
			
			if($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$content.='<td width="50%"><div class="divContenedor2" onClick="window.location.href=\'?F=biblioteca&amp;_f=ver&amp;id='. $row["id"] .'\'">
				<table width="100%" border="0" cellspacing="2" cellpadding="1">
				  <tr>
					<td width="11%" class="linkTitNot3"><div align="center"><a href="?F=biblioteca&amp;_f=ver&amp;id='. $row["id"] .'"><img src="'. $row["imagen"] .'" border="0" width="110" height="105" /></a></div></td>
					
					<td width="89%" valign="top" align="left" class="linkTitNot3"><a href="?F=biblioteca&amp;_f=ver&amp;id='. $row["id"] .'">'. $row["titulo"] .'</a><br><br><span class="linkCont2"><a href="?F=biblioteca&amp;_f=ver&amp;id='. $row["id"] .'">Ver publicaci&oacute;n completa</a></span></td>
				  </tr>
				</table>
				</div></td>';
		}
		$content.='</tr>';
	}
	$content.='</table>';
	return $content;
}//postDocumentos
*/
private function postDocumentosCuadroBlanco(){	
	$result = mysql_query("SELECT * FROM documentos WHERE idsubcategoriaFK!=41 ORDER BY fechasub ");
//$sql="SELECT * FROM noticias ORDER BY id DESC LIMIT 1,". $this->limitNot; 
//$consulta = mysql_query($sql,MYSQL_ASSOC);
 $tipoComm=2;
$nfilas = 20;
$col = 2;
$filas = ceil($nfilas/$col);
$content = '<p class="txtTit">Archivos recientes</p>';
$content.='<table width="100%" border="0" cellspacing="3" cellpadding="3">';
for($c=0;$c<$filas;$c++){
	$content.='<tr>';
	for($s=0;$s<$col;$s++){
		//$resultado = mysql_fetch_array($consulta);
		
		if($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$content.='<td width="50%"><div class="divContenedor2" onClick="window.location.href=\'?F=biblioteca&amp;_f=ver&amp;id='. $row["id"] .'\'">
			<table width="100%" border="0" cellspacing="2" cellpadding="1">
			  <tr>
				<td width="11%" class="linkTitNot3"><div align="center"><a href="?F=biblioteca&amp;_f=ver&amp;id='. $row["id"] .'"><img src="'. $row["imagen"] .'" border="0" width="110" height="105" /></a></div></td>
				<td width="89%" valign="top" align="left" class="linkTitNot3"><a href="?F=biblioteca&amp;_f=ver&amp;id='. $row["id"] .'">'. $row["titulo"] .'</a><br><br><span class="linkCont2"><a href="?F=biblioteca&amp;_f=ver&amp;id='. $row["id"] .'">Ver publicaci&oacute;n completa</a></span></td>
			  </tr>
			</table>
			</div></td>';
		}
	}
	$content.='</tr>';
}
$content.='</table>';
return $content;
}//postDocumentosCuadroBlanco

/*
public function ver(){
	if (!isset($_GET["id"]) || $_GET["id"] == ''){ echo '<h2>No se encuentra el identificador</h2>'; exit(); }//if
		
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM documentos WHERE id='{$_GET['id']}'");
	$result2 = mysql_query("SELECT nombre,sitioweb FROM benefactores WHERE id=".$result["idbenefactorFK"]);
	$content = '';
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
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
              <td class="txtCont"><span class="txtBold"> '. $this->txtFechaPub($row["fechapub"]) .'</span><span class="txtBold"> | Aportado por:</span><span class="txtBold"><a href="'.$row2["sitioweb"].'"> '. $row2["nombre"] .'</a></span></td>
            </tr>
          </table>
          '. $imagen . $contenido . $video .'
		 <table width="95%" border="0" height="27" align="center" cellspacing="10" cellpadding="0" hspace="25">
		 	<tr>
        		  <p>							
				  <embed src="'.$row["archivo"].'" width="100%" height="739"></embed>				
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
         <p class="linkCont"><a href="?F=comentarios&amp;_f=main&amp;tipo=2&amp;id='. $row["id"] .'">Deja tu comentario</a> <span class="linkCont"><a href="?F=inicio&amp;_f=verNormas">Normas de uso</a></span></p>'. $this->showComments('4', $row["id"]);
		 
}//ver*/
}//class
?>