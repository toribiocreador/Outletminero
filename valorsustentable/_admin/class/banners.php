<?php
echo (preg_match('/banners.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class banners extends _GLOBAL_{

public function addMod(){
	if (isset($_GET["id"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM banners WHERE id='{$_GET['id']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$id_sec = $row["id_sec"];
			$titulo = $row["titulo"];
			$imagen = '<br /><img src="../'. $row["imagen"] .'" border="0" /><input type="hidden" name="img1" value="'. $row["imagen"] .'" />';
			$enlace = $row["enlace"];
	} else {
		$_GET["id"] = '0';
		$id_sec = '';
		$titulo = '';
		$imagen = '';
		$enlace = '';
		
	}//if
	
	return '<p class="txtTitles">Agregar Banner de Auspiciantes</p>
			<p class="txtCont1">Aqu&iacute; podr&aacute;s agregar banners de Auspiciantes, tendr&aacute;s que seleccionar el tipo de banner a subir al sitio web, y autom&aacute;ticamente se publicar&aacute;. Debes de hacer tu banner al tama&ntilde;o de medida especificado.</p>
			<p class="txtCont1">&nbsp;</p>

	<form id="frmBanners" name="frmBanners" enctype="multipart/form-data" method="post" action="?F=banners&amp;_f=addBanner">
	  <input type="hidden" name="id" value="'. $_GET["id"] .'" />
	  <table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
		  <td valign="top" class="txtCont2" width="150">T&iacute;tulo:</td>
		  <td valign="top"><input name="titulo" type="text" id="titulo" size="60" maxlength="256" value="'. $titulo .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2">Contenido:</td>
		  <td valign="top"><textarea name="contenido" id="contenido" cols="80" rows="5">'. $contenido .'</textarea></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2">Banner 960 X 350 px:</td>
		  <td valign="top"><span class="txtPieNotaGris">Trate de que la imagen que vaya a subir sea de <span class="txtCont2Bold">960 X 350 px</span> para no deformar la imagen.</span><br />
		  			<input type="hidden" name="MAX_FILE_SIZE" value="3000000">
					<input name="imagen1" type="file">'. $imagen .'</td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2">Enlace:</td>
		  <td valign="top"><span class="txtPieNotaGris">Inserte la direcci&oacute;n completa <span class="txtCont2Bold">desde http://...</span> </span><br /><input name="enlace" type="text" id="enlace" size="60" maxlength="256" value="'. $enlace .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2">&nbsp;</td>
		  <td valign="top"><input name="enviar" type="submit" class="frmBtnIngresar" id="enviar" value="Agregar-Modificar" /></td>
		</tr>
	  </table>
	</form>
		<script language="JavaScript" type="text/javascript">
		 var frmvalidator = new Validator("form");
		 frmvalidator.addValidation("titulo","req","Ingrese el titulo de la publicacion");
	  </script>
';
}//addMod


public function addBanner(){
	if(!isset($_POST["titulo"])){ echo '<h2>No se puede agregar su publicaci&oacute;n.</h2>'; exit(); }//if
	
	$titulo = strip_tags($_POST["titulo"]);
	$contenido = $_POST["contenido"];
	$enlace = $_POST["enlace"];
	$fechapub = date("Y-m-d");
	$autor = $_SESSION["nombre"];
	$ruta = 'gallery/banners/';
	$m_ruta = 'gallery/banners/mini_';
	
	// Validación de imágenes ...............................
	$WIDTH = 960; $HEIGHT = 350;
	if (isset($_FILES["imagen1"]["name"]) && $_FILES["imagen1"]["name"] != ''){
		$imagen1 = $this->validar_1_imagen('1', $ruta, $WIDTH, $HEIGHT);
		$imagen = $ruta . $imagen1;
		$m_imagen = $m_ruta . $imagen1;
		if (isset($_POST["img1"]) && $_POST["img1"] != ''){
			@unlink('../'. $_POST["img1"]);
		}//if
	} else {
		$imagen = (isset($_POST["img1"])) ? $_POST["img1"] : '';
	}//if

	$db = $this->_db();
	if ($_POST["id"] == 0){
		mysql_query("INSERT INTO banners (titulo, contenido, enlace, imagen, fechapub, autor)
					VALUES ('". $titulo ."', '". $contenido ."', '". $enlace ."', '". $imagen ."', '". $fechapub ."', '". $autor ."')") or die(mysql_error());
		$id=mysql_insert_id();
		$echo ='<script type="text/javascript">
						setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
						setTimeout("top.location.href = \'?F=banners&_f=addMod\'",1000);
						</script>';
	} else {
		
		$sql = "UPDATE banners SET titulo='$titulo', contenido='$contenido', enlace='$enlace', imagen='$imagen', fechapub='$fechapub', autor='$autor' WHERE id='{$_POST['id']}'";
		
		$result = mysql_query($sql);
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=banners&_f=seeDelete\'",1000);
					</script>';
	}//if
	return $echo;
}//addNoticia


public function seeDelete(){
	$db = $this->_db();
	$categoria = '2'; // 2 = Noticias
	$result = mysql_query("SELECT * FROM banners ORDER BY id DESC");
	$echo = '';
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$fechapub = $this->txtFechaPub($row["fechapub"]);
			$contenido = substr($row["contenido"], 0, 330);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=banners&amp;_f=addMod&amp;id='. $row["id"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7" class="linkCont"><a href="?F=banners&amp;_f=addMod&amp;id='. $row["id"] .'">'. $row["titulo"] .'</a></td>
						<td style="background:#F7F7F7"><span class="txtMiniBck">'. strip_tags($contenido) .'...</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $fechapub .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["autor"] .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=banners&amp;_f=delBanner&amp;id='. $row["id"] .'"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<p class="txtTitles">Listado de Banners de Inicio</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="3">
				  <tr class="txtBold">
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
}//

public function delBanner(){
	if (!isset($_GET["id"])){ echo '<h2>No existe identificador de imagen</h2>'; exit(); }//if
	
	$db=$this->_db();
	$result = mysql_query("SELECT * FROM banners WHERE id='{$_GET['id']}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	@unlink('../'. $row["imagen"]);
		
	mysql_query("DELETE FROM banners WHERE id='{$_GET['id']}'");
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=banners&_f=seeDelete\'",1000);
				</script>';
	return $echo;
}//delete

}//class
?>