<?php
echo (preg_match('/videos.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class videos extends _GLOBAL_{

/* + id + titulo + introduccion + contenido + embed + imagen + pf + fechapub + autor */
public function addMod(){
	$imagen = '';
	$producto1 = '';
	if (isset($_GET["id"])){
		if($_SESSION["nivel"]=='6')
			$socio = '1';
		else
			$socio = '0';
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM noticias WHERE id='{$_GET['id']}' AND socio='{$socio}'");
		$db = $this->_db();
		if(mysql_num_rows($result) == 0)
			return '<span class="txtCont2">No puedes navegar</span>';
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$tok=explode(",",$row["imagen"]);
		$titulo = $row["titulo"];
		$introduccion = $row["introduccion"];
		$contenido = $row["contenido"];
		$embed = $row["embed"];
		$imagen = ($tok[0] != '') ? '<br /><img src="../'. $tok[0] .'" border="0" /><input type="hidden" name="imagen1" value="'. $tok[0] .'" />' : '';
		$pf = $row["pf"];
		$autor = $row["autor"];
		$idseccion = $row["id_seccion"];
		unset($tok[0]);
		$productos = '';
	} else {
		$_GET["id"] = '0';	
		$titulo = '';
		$introduccion = '';
		$contenido = '';
		$embed = '';
		$imagen = '';
		$pf = '';
		$autor = '';
		$idseccion = '';
		$productos = '';
	}//if
	$video='';
	if($embed=='')
	  		$video='</td>';
		else
	  		$video='<iframe width="315" height="266" src="'. $embed .'?rel=0&amp;wmode=transparent" frameborder="0" allowfullscreen></iframe></td>';
	
	return '<p class="txtTitles">Agregar Video</p>
<p class="txtCont1">Para dar de alta tu publicaci&oacute;n selecciona lo siguiente:</p>
<p class="txtCont1">&nbsp;</p>

<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=videos&amp;_f=addVideo">
  <input type="hidden" name="id" value="'. $_GET["id"] .'" />
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="150" valign="top" class="txtCont2" bgcolor="#E0F0F0">T&iacute;tulo:</td>
      <td valign="top" bgcolor="#E0F0F0"><input name="titulo" type="text" id="titulo" size="100" maxlength="255" value="'. $titulo .'" /></td>
    </tr>
	<tr>
      <td valign="top" class="txtCont2">Introducci&oacute;n:</td>
      <td valign="top"><textarea name="introduccion" id="introduccion" cols="40" rows="3">'. $introduccion .'</textarea></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Contenido:</td>
      <td valign="top"><textarea name="contenido" id="contenido" cols="100" rows="20">'. $contenido .'</textarea></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Insertar video de <img src="imgs/youtube-icon.gif" width="25" height="25" alt="" /></td>
      <td valign="top"><input name="embed" type="text" id="embed" size="73" maxlength="600" value="'. htmlspecialchars($embed, ENT_QUOTES) .'" /><br />
	  '.$video.'
    </tr>
	<tr>
      <td valign="top" class="txtCont2">Galer&iacute;a</td>
      <td>
			'.$this->slideGaleria().'
		</td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Imagen:</td>
      <td valign="top"><input type="hidden" name="MAX_FILE_SIZE1" value="3000000" /><input name="imagen1" type="file" />'. $imagen .'&nbsp;<br /><span class="txtCont2">Pie de foto:</span><input name="pf" type="text" id="pf" size="60" maxlength="255" value="'. $pf .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">&nbsp;</td>
      <td valign="top"><input name="enviar3" type="submit" class="frmBtnIngresar" id="enviar3" value="Agregar-Modificar" /></td>
    </tr>
  </table>
</form>
		<script language="JavaScript" type="text/javascript">
		 var frmvalidator = new Validator("form");
		 frmvalidator.addValidation("titulo","req","Ingrese el titulo de la publicacion");
		 frmvalidator.addValidation("embed","req","Ingrese el video de la publicacion");
	  </script>';
}//addMod

public function addVideo(){
	if(!isset($_POST["titulo"])){ echo '<h2>No se puede agregar su publicaci&oacute;n.</h2>'; exit(); }//if
	
	$titulo = strip_tags($_POST["titulo"]);
	$introduccion = strip_tags($_POST["introduccion"]);
	$contenido = $_POST["contenido"];
	$embed = $_POST["embed"];
	$fechapub = date("Y-m-d");
	$autor = $_SESSION["nombre"];
	$ruta = 'gallery/videos/';
	$imagen = '';
	$producto = '';
	$pf = strip_tags($_POST["pf"]);
	if($_SESSION["nivel"]=='6')
		$socio = '1';
	else
		$socio = '0';
	$idseccion = $_POST["seccion"];
	
	if(!isset($_POST["galerias"])){
		// Validación de imágenes ...............................
		$WIDTH = 600; $HEIGHT = 600;
		if (isset($_FILES["imagen1"]["name"]) && $_FILES["imagen1"]["name"] != ''){
			$imagen = $this->validar_1_imagen('1', $ruta, $WIDTH, $HEIGHT);
			$imagen = $ruta . $imagen;
			@unlink('../'. $_POST["img1"]);
		} else {
			$imagen = (isset($_POST["imagen1"])) ? $_POST["imagen1"] : '';
		}//if
		$imagenes = $imagen;
	}else
		$imagenes = $_POST["galerias"];
	
	$db = $this->_db();
	if ($_POST["id"] == 0){
		mysql_query("INSERT INTO noticias (titulo, introduccion, contenido, embed, imagen, pf, fechapub, autor, id_seccion, socio)
					VALUES ('". $titulo ."', '". $introduccion ."', '". $contenido ."', '". $embed ."', '". $imagenes ."', '". $pf ."', '". $fechapub ."', '". $autor ."', '". $idseccion ."', '". $socio ."')") or die(mysql_error());
		$id=mysql_insert_id();
	} else {
		$sql = "UPDATE noticias SET titulo='$titulo', introduccion='$introduccion', contenido='$contenido', embed='$embed', imagen='$imagenes', pf='$pf', id_seccion='$idseccion', socio='$socio' WHERE id='{$_POST['id']}'";
		$result = mysql_query($sql);
	}//if
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO MODIFICADO\');",100); 
				setTimeout("top.location.href = \'?F=videos&_f=seeDelete\'",1000);
				</script>';
	return $echo;
}//addNoticia

public function seeDelete(){
	if($_SESSION["nivel"]=='6')
		$socio = '1';
	else
		$socio = '0';
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM noticias WHERE socio='$socio' AND embed LIKE '%http://%' ORDER BY id DESC");
	$echo = '';
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$fechapub = $this->txtFechaPub($row["fechapub"]);
			$contenido = substr($row["contenido"], 0, 330);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=videos&amp;_f=addMod&amp;id='. $row["id"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7" class="linkCont"><a href="?F=videos&amp;_f=addMod&amp;id='. $row["id"] .'">'. $row["titulo"] .' </a></td>
						<td style="background:#F7F7F7"><span class="txtMiniBck">'. strip_tags($contenido) .'...</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["boletin"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["directo"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["twitter"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["facebook"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. ($row["facebook"]+$row["twitter"]+$row["directo"]+$row["boletin"]) .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["autor"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $fechapub .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="javascript:void(ConfirmDelete(\'?F=videos&amp;_f=delVideo&amp;id='. $row["id"] .'\'))"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<p class="txtTitles">Listado de Videos</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">T&iacute;tulo</td>
					<td style="background:#E3EEF0" align="center">Contenido</td>
					<td style="background:#E3EEF0" align="center">Bole</td>
					<td style="background:#E3EEF0" align="center">Dire</td>
					<td style="background:#E3EEF0" align="center">Twit</td>
					<td style="background:#E3EEF0" align="center">Face</td>
					<td style="background:#E3EEF0" align="center">Tota</td>
					<td style="background:#E3EEF0" align="center">Autor</td>
					<td style="background:#E3EEF0" align="center">Publicaci&oacute;n</td>
					<td style="background:#E3EEF0" width="30" align="center">Borrar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//

public function seeLecturas(){
	if($_SESSION["nivel"]=='6')
		$socio = '1';
	else
		$socio = '0';
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM noticias WHERE socio='$socio' ORDER BY (twitter+directo+facebook+boletin) DESC");
	$echo = '';
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$fechapub = $this->txtFechaPub($row["fechapub"]);
			$contenido = substr($row["contenido"], 0, 330);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="http://outletminero.org/?F=noticias&_f=ver&id='. $row["id"] .'" target="_blank"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7" class="linkCont"><a href="http://outletminero.org/?F=noticias&_f=ver&id='. $row["id"] .'" target="_blank">'. $row["titulo"] .' </a></td>
						<td style="background:#F7F7F7"><span class="txtMiniBck">'. strip_tags($contenido) .'...</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $fechapub .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["boletin"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["directo"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["twitter"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["facebook"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. ($row["facebook"]+$row["twitter"]+$row["directo"]+$row["boletin"]) .'</span></td>
					  </tr>';
	}//while
	$content = '<p class="txtTitles">Reporte de Lectura de Noticias</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">T&iacute;tulo</td>
					<td style="background:#E3EEF0" align="center">Contenido</td>
					<td style="background:#E3EEF0" align="center" width="150">Publicaci&oacute;n</td>
					<td style="background:#E3EEF0" align="center">Bolet&iacute;n</td>
					<td style="background:#E3EEF0" align="center">Directo</td>
					<td style="background:#E3EEF0" align="center">Twitter</td>
					<td style="background:#E3EEF0" align="center">Facebook</td>
					<td style="background:#E3EEF0" align="center">Total</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//

public function delVideo(){
	if (!isset($_GET["id"])){ echo '<h2>No existe identificador de imagen</h2>'; exit(); }//if
	
	$db=$this->_db();
	$result = mysql_query("SELECT * FROM noticias WHERE id='{$_GET['id']}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$tok=explode("/",$row["imagen"]);
	if($tok[1]=="videos")
	@unlink('../'. $row["imagen".$i]);
	mysql_free_result($result);
		
	mysql_query("DELETE FROM noticias WHERE id='{$_GET['id']}'");
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=videos&_f=seeDelete\'",1000);
				</script>';
	return $echo;
}//delete

}//class
?>