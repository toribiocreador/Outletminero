<?php
echo (preg_match('/articulos.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class articulos extends _GLOBAL_{

public function addMod(){
	if (isset($_GET["id"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM articulos WHERE id='{$_GET['id']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$titulo = $row["titulo"];
		$introduccion = $row["introduccion"];
		$contenido = $row["contenido"];
		$embed = $row["embed"];
		$imagen1 = ($row["imagen1"] != '') ? '<br /><img src="../'. $row["imagen1"] .'" width="80" height="60" border="0" /><input type="hidden" name="img1" value="'. $row["imagen1"] .'" />' : '';
		$imagen2 = ($row["imagen2"] != '') ? '<br /><img src="../'. $row["imagen2"] .'" width="80" height="60" border="0" /><input type="hidden" name="img2" value="'. $row["imagen2"] .'" />' : '';
		$imagen3 = ($row["imagen3"] != '') ? '<br /><img src="../'. $row["imagen3"] .'" width="80" height="60" border="0" /><input type="hidden" name="img3" value="'. $row["imagen3"] .'" />' : '';
		$imagen4 = ($row["imagen4"] != '') ? '<br /><img src="../'. $row["imagen4"] .'" width="80" height="60" border="0" /><input type="hidden" name="img4" value="'. $row["imagen4"] .'" />' : '';
		$imagen5 = ($row["imagen5"] != '') ? '<br /><img src="../'. $row["imagen5"] .'" width="80" height="60" border="0" /><input type="hidden" name="img5" value="'. $row["imagen5"] .'" />' : '';
		$pf1 = $row["pf1"]; $pf2 = $row["pf2"]; $pf3 = $row["pf3"];	$pf4 = $row["pf4"];	$pf5 = $row["pf5"];
	} else {
		$_GET["id"] = '0';
		$titulo = '';
		$introduccion = '';
		$contenido = '';
		$embed = '';
		$imagen1 = '';	$imagen2 = '';	$imagen3 = '';	$imagen4 = '';	$imagen5 ='';
		$pf1 = ''; $pf2 = ''; $pf3 = ''; $pf4 = '';	$pf5 = '';
	}//if
	
	return '<p class="txtTitles">Agregar Art&iacute;culo o Entrevista</p>
<p class="txtCont1">Para dar de alta tu publicaci&oacute;n selecciona lo siguiente:</p>
<p class="txtCont1">&nbsp;</p>

<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=articulos&amp;_f=addArticulo">
  <input type="hidden" name="id" value="'. $_GET["id"] .'" />
  <table width="600" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td valign="top" class="txtCont2">T&iacute;tulo:</td>
      <td valign="top"><input name="titulo" type="text" id="titulo" size="60" maxlength="255" value="'. $titulo .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Introducci&oacute;n:</td>
      <td valign="top"><textarea name="introduccion" id="introduccion" cols="60" rows="5">'. $introduccion .'</textarea></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Contenido:</td>
      <td valign="top"><textarea name="contenido" id="contenido" cols="100" rows="20">'. $contenido .'</textarea></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Insertar video de <img src="imgs/youtube-icon.gif" width="25" height="25" alt="" /></td>
      <td valign="top"><input name="embed" type="text" id="embed" size="60" maxlength="600" value="'. htmlspecialchars($embed, ENT_QUOTES) .'" />'. $embed .'</td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Imagen 1:</td>
      <td valign="top"><input type="hidden" name="MAX_FILE_SIZE1" value="3000000"><input name="imagen1" type="file"> <span class="txtPieNotaGris">Pie de foto:</span><input name="pf1" type="text" id="pf1" size="40" maxlength="255" value="'. $pf1 .'" />'. $imagen1 .'</td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Imagen 2:</td>
      <td valign="top"><input type="hidden" name="MAX_FILE_SIZE2" value="3000000"><input name="imagen2" type="file"> <span class="txtPieNotaGris">Pie de foto:</span><input name="pf2" type="text" id="pf2" size="40" maxlength="255" value="'. $pf2 .'" />'. $imagen2 .'</td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Imagen 3:</td>
      <td valign="top"><input type="hidden" name="MAX_FILE_SIZE3" value="3000000"><input name="imagen3" type="file"> <span class="txtPieNotaGris">Pie de foto:</span><input name="pf3" type="text" id="pf3" size="40" maxlength="255" value="'. $pf3 .'" />'. $imagen3 .'</td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Imagen 4:</td>
      <td valign="top"><input type="hidden" name="MAX_FILE_SIZE4" value="3000000"><input name="imagen4" type="file"> <span class="txtPieNotaGris">Pie de foto:</span><input name="pf4" type="text" id="pf4" size="40" maxlength="255" value="'. $pf4 .'" />'. $imagen4 .'</td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Imagen 5:</td>
      <td valign="top"><input type="hidden" name="MAX_FILE_SIZE5" value="3000000"><input name="imagen5" type="file"> <span class="txtPieNotaGris">Pie de foto:</span><input name="pf5" type="text" id="pf5" size="40" maxlength="255" value="'. $pf5 .'" />'. $imagen5 .'</td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">&nbsp;</td>
      <td valign="top"><input name="enviar3" type="submit" class="frmBtnIngresar" id="enviar3" value="Agregar-Modificar" /></td>
    </tr>
  </table>
  <script type="text/javascript">
	CKEDITOR.replace( "contenido" );
  </script>
</form>
		<script language="JavaScript" type="text/javascript">
		 var frmvalidator = new Validator("form");
		 frmvalidator.addValidation("titulo","req","Ingrese el titulo de la publicacion");
	  </script>
';
}//addMod


public function addArticulo(){
	if(!isset($_POST["titulo"])){
		echo '<h2>No se puede agregar su publicaci&oacute;n.</h2>';
		exit();
	}//if
	
	$titulo = strip_tags($_POST["titulo"]);
	$introduccion = strip_tags($_POST["introduccion"]);
	$contenido = $_POST["contenido"];
	$embed = $_POST["embed"];
	$fechapub = date("Y-m-d");
	$autor = $_SESSION["nombre"];
	$ruta = 'gallery/noticias/';
	
	// Validación de imágenes ...............................
	$WIDTH = 400; $HEIGHT = 300;
	if (isset($_FILES["imagen1"]["name"]) && $_FILES["imagen1"]["name"] != ''){
		$imagen = $this->validar_1_imagen('1', $ruta, $WIDTH, $HEIGHT);
		$imagen1 = $ruta . $imagen;
		@unlink('../'. $_POST["img1"]);
	} else {
		$imagen1 = (isset($_POST["img1"])) ? $_POST["img1"] : '';
	}//if
	if (isset($_FILES["imagen2"]["name"]) && $_FILES["imagen2"]["name"] != ''){
		$imagen = $this->validar_1_imagen('2', $ruta, $WIDTH, $HEIGHT);
		$imagen2 = $ruta . $imagen;
		@unlink('../'. $_POST["img2"]);
	} else {
		$imagen2 = (isset($_POST["img2"])) ? $_POST["img2"] : '';
	}//if
	if (isset($_FILES["imagen3"]["name"]) && $_FILES["imagen3"]["name"] != ''){
		$imagen = $this->validar_1_imagen('3', $ruta, $WIDTH, $HEIGHT);
		$imagen3 = $ruta . $imagen;
		@unlink('../'. $_POST["img3"]);
	} else {
		$imagen3 = (isset($_POST["img3"])) ? $_POST["img3"] : '';
	}//if
	if (isset($_FILES["imagen4"]["name"]) && $_FILES["imagen4"]["name"] != ''){
		$imagen = $this->validar_1_imagen('4', $ruta, $WIDTH, $HEIGHT);
		$imagen4 = $ruta . $imagen;
		@unlink('../'. $_POST["img4"]);
	} else {
		$imagen4 = (isset($_POST["img4"])) ? $_POST["img4"] : '';
	}//if
	if (isset($_FILES["imagen5"]["name"]) && $_FILES["imagen5"]["name"] != ''){
		$imagen = $this->validar_1_imagen('1', $ruta, $WIDTH, $HEIGHT);
		$imagen5 = $ruta . $imagen;
		@unlink('../'. $_POST["img5"]);
	} else {
		$imagen5 = (isset($_POST["img5"])) ? $_POST["img5"] : '';
	}//if
	$pf1 = strip_tags($_POST["pf1"]);
	$pf2 = strip_tags($_POST["pf2"]);
	$pf3 = strip_tags($_POST["pf3"]);
	$pf4 = strip_tags($_POST["pf4"]);
	$pf5 = strip_tags($_POST["pf5"]);

	$db = $this->_db();
	if ($_POST["id"] == 0){
		mysql_query("INSERT INTO articulos (titulo, introduccion, contenido, embed, imagen1, imagen2, imagen3, imagen4, imagen5, pf1, pf2, pf3, pf4, pf5, fechapub, autor)
					VALUES ('". $titulo ."', '". $introduccion ."', '". $contenido ."', '". $embed ."', '". $imagen1 ."', '". $imagen2 ."', '". $imagen3 ."', '". $imagen4 ."', '". $imagen5 ."', '". $pf1 ."', '". $pf2 ."', '". $pf3 ."', '". $pf4 ."', '". $pf5 ."', '". $fechapub ."', '". $autor ."')") or die(mysql_error());
		$id=mysql_insert_id();
		$echo ='<script type="text/javascript">
						setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
						setTimeout("top.location.href = \'?F=articulos&_f=addMod\'",1000);
						</script>';
	} else {
		
		$sql = "UPDATE articulos SET titulo='$titulo', introduccion='$introduccion', contenido='$contenido', embed='$embed', imagen1='$imagen1', imagen2='$imagen2', imagen3='$imagen3', imagen4='$imagen4', imagen5='$imagen5', pf1='$pf1', pf2='$pf2', pf3='$pf3', pf4='$pf4', pf5='$pf5', autor='$autor' WHERE id='{$_POST['id']}'";
		
		$result = mysql_query($sql);
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=articulos&_f=seeDelete\'",1000);
					</script>';
	}//if
	return $echo;
}//addNoticia


public function seeDelete(){
	$echo = '';
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM articulos ORDER BY fechapub DESC");
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$fechapub = $this->txtFechaPub($row["fechapub"]);
			$contenido = substr($row["contenido"], 0, 350);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=articulos&amp;_f=addMod&amp;id='. $row["id"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["titulo"] .' </span></td>
						<td style="background:#F7F7F7"><span class="txtMiniBck">'. $contenido .'...</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $fechapub .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["autor"] .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=articulos&amp;_f=delArticulo&amp;id='. $row["id"] .'"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<p class="txtTitles">Listado de Art&iacute;culos y Entrevistas</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="3">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">T&iacute;tulo</td>
					<td style="background:#E3EEF0" align="center">Contenido</td>
					<td style="background:#E3EEF0" align="center" width="170">Publicaci&oacute;n</td>
					<td style="background:#E3EEF0" align="center">Autor</td>
					<td style="background:#E3EEF0" width="30" align="center">Borrar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//seeDelete

public function delArticulo(){
	if (!isset($_GET["id"])){ echo '<h2>No existe identificador de imagen</h2>'; exit(); }//if

	$db=$this->_db();
	$result = mysql_query("SELECT * FROM articulos WHERE id='{$_GET['id']}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	for ($i=1; $i<=5; $i++){	// Borrar si existen imágenes......
		if ($row["imagen".$i] != ''){
			@unlink('../'. $row["imagen".$i]);
		}
	}//for
		
	mysql_query("DELETE FROM articulos WHERE id='{$_GET['id']}'");
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=articulos&_f=seeDelete\'",1000);
				</script>';
	return $echo;
}//delete

}//class
?>