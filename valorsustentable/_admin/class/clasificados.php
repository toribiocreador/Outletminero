<?php
echo (preg_match('/clasificados.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class clasificados extends _GLOBAL_{

public function addMod(){
	if (isset($_GET["id"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM clasificados WHERE id='{$_GET['id']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$titulo = $row["titulo"];
			$contenido = $row["contenido"];
			$vigenciainicio = $row["vigenciainicio"];
			$vigenciafin = $row["vigenciafin"];
			$telefono = $row["telefono"];
			$correo = $row["correo"];
			$sitioweb = $row["sitioweb"];
			$imagen1 = '<br /><img src="../'. $row["m_imagen"] .'" border="0" /><input type="hidden" name="img1" value="'. $row["imagen"] .'" /><input type="hidden" name="m_img1" value="'. $row["m_imagen"] .'" />';
	} else {
		$_GET["id"] = '0';
			$titulo = '';
			$contenido = '';
			$vigenciainicio = '';
			$vigenciafin = '';
			$telefono = '';
			$correo = '';
			$sitioweb = '';
			$imagen1 = '';
	}//if
	
	return '<p class="txtTitles">Agregar Anuncio Clasificado</p>
<p class="txtCont1">Ingrese los datos que se solicitan a continuaci&oacute;n para agregar un anuncio clasificado, estos anuncios tendr&aacute;n la vigencia de Usted especifique, posteriormente se podr&aacute;n renovar cambiando la fecha o bien se tendr&aacute;n que eliminar manualmente.</p>
<p class="txtCont1">&nbsp;</p>

	<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=clasificados&amp;_f=addClasificado">
	<input type="hidden" id="DPC_FIRST_WEEK_DAY" value="2" />
	<input type="hidden" id="DPC_WEEKEND_DAYS" value="[0,5,6]" />
	<input type="hidden" id="DPC_CALENDAR_OFFSET_X" value="20" />
	<input type="hidden" id="DPC_BUTTON_OFFSET_X" value="10" />
	  <input type="hidden" name="id" value="'. $_GET["id"] .'" />
	  <table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
		  <td valign="top" class="txtCont2" width="150">T&iacute;tulo:</td>
		  <td valign="top"><input name="titulo" type="text" id="titulo" size="60" maxlength="256" value="'. $titulo .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2" width="150">Vigente desde:</td>
		  <td valign="top"><input name="vigenciainicio" type="text" id="DPC_calendar1b_YYYY-MM-DD" size="10" maxlength="10" value="'. $vigenciainicio .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2" width="150">Vigente hasta:</td>
		  <td valign="top"><input name="vigenciafin" type="text" id="DPC_calendar2b_YYYY-MM-DD" size="10" maxlength="10" value="'. $vigenciafin .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2">Contenido del anuncio clasificado:</td>
		  <td valign="top"><textarea name="contenido" id="contenido" cols="40" rows="4">'. $contenido .'</textarea></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2" width="150">Tel&eacute;fono de contacto:</td>
		  <td valign="top"><input name="telefono" type="text" id="telefono" size="60" maxlength="256" value="'. $telefono .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2" width="150">Correo electr&oacute;nico:</td>
		  <td valign="top"><input name="correo" type="text" id="correo" size="60" maxlength="256" value="'. $correo .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2">Sitio web:</td>
		  <td valign="top"><span class="txtPieNotaGris">Inserte la direcci&oacute;n completa <span class="txtCont2Bold">desde http://...</span> </span><br /><input name="sitioweb" type="text" id="sitioweb" size="60" maxlength="256" value="'. $sitioweb .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2">Subir imagen del anuncio clasificado:</td>
		  <td valign="top"><span class="txtPieNotaGris">Trate de que la imagen que vaya a subir sea de <span class="txtCont2Bold">460 X 210 px</span> para no deformar la imagen.</span><br />
		  			<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
					<input name="imagen1" type="file" />'. $imagen1 .'</td>
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
		 frmvalidator.addValidation("vigenciainicio","req","Ingrese la fecha de inicio de su evento");
		 frmvalidator.addValidation("vigenciafin","req","Ingrese la fecha de finalizacion de su evento");
	  </script>
';
}//addMod


public function addClasificado(){
	if(!isset($_POST["titulo"])){
		echo '<h2>No se puede agregar su publicaci&oacute;n.</h2>';
		exit();
	}//if
	
	$titulo = strip_tags($_POST["titulo"]);
	$contenido = $_POST["contenido"];
	$vigenciainicio = $_POST["vigenciainicio"];
	$vigenciafin = $_POST["vigenciafin"];
	$telefono = $_POST["telefono"];
	$correo = $_POST["correo"];
	$sitioweb = $_POST["sitioweb"];
	$fechapub = date("Y-m-d");
	$autor = $_SESSION["nombre"];
	$ruta = 'gallery/clasificados/';
	$m_ruta = 'gallery/clasificados/mini_';
	
	// Validación de imágenes ...............................
	if (isset($_FILES["imagen1"]["name"]) && $_FILES["imagen1"]["name"] != ''){
		$imagen1 = $this->validar_imagen('1', $ruta, $m_ruta);
		$imagen = $ruta . $imagen1;
		$m_imagen = $m_ruta . $imagen1;
		if (isset($_POST["img1"]) && $_POST["img1"] != ''){
			@unlink('../'. $_POST["img1"]);
			@unlink('../'. $_POST["m_img1"]);
		}//if
	} else {
		$imagen = (isset($_POST["img1"])) ? $_POST["img1"] : '';
		$m_imagen = (isset($_POST["m_img1"])) ? $_POST["m_img1"] : '';
	}//if
	

	$db = $this->_db();
	if ($_POST["id"] == 0){
		mysql_query("INSERT INTO clasificados (titulo, contenido, telefono, correo, sitioweb, vigenciainicio, vigenciafin, imagen, m_imagen, fechapub, autor)
					VALUES ('". $titulo ."', '". $contenido ."', '". $telefono ."', '". $correo ."', '". $sitioweb ."', '". $vigenciainicio ."', '". $vigenciafin ."', '". $imagen ."', '". $m_imagen ."', '". $fechapub ."', '". $autor ."')") or die(mysql_error());
		$id=mysql_insert_id();
		$echo ='<script type="text/javascript">
						setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
						setTimeout("top.location.href = \'?F=clasificados&_f=addMod\'",1000);
						</script>';
	} else {
		
		$sql = "UPDATE clasificados SET titulo='$titulo', contenido='$contenido', telefono='$telefono', correo='$correo', sitioweb'$sitioweb', vigenciainicio='$vigenciainicio', vigenciafin='$vigenciafin', imagen='$imagen', m_imagen='$m_imagen', fechapub='$fechapub', autor='$autor' WHERE id='{$_POST['id']}'";
		
		$result = mysql_query($sql);
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=clasificados&_f=seeDelete\'",1000);
					</script>';
	}//if
	return $echo;
}//addNoticia


public function seeDelete(){
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM clasificados ORDER BY id DESC");
	$echo = '';
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$vigenciainicio = $this->txtFechaPub($row["vigenciainicio"]);
			$vigenciafin = $this->txtFechaPub($row["vigenciafin"]);
			$fechapub = $this->txtFechaPub($row["fechapub"]);
			$contenido = substr($row["contenido"], 0, 330);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=clasificados&amp;_f=addMod&amp;id='. $row["id"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["titulo"] .' </span></td>
						<td style="background:#F7F7F7"><span class="txtMiniBck">'. strip_tags($contenido) .'...</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $vigenciainicio .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $vigenciafin .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $fechapub .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["autor"] .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=clasificados&amp;_f=delClasificado&amp;id='. $row["id"] .'"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<p class="txtTitles">Listado de Banners de Inicio</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="3">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">T&iacute;tulo</td>
					<td style="background:#E3EEF0" align="center">Contenido</td>
					<td style="background:#E3EEF0" align="center">Vigencia desde:</td>
					<td style="background:#E3EEF0" align="center">Vigencia hasta:</td>
					<td style="background:#E3EEF0" align="center">Publicado el:</td>
					<td style="background:#E3EEF0" align="center">Autor</td>
					<td style="background:#E3EEF0" width="30" align="center">Borrar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//

public function delClasificado(){
	$db=$this->_db();
	
	if (!isset($_GET["id"])){
		echo '<h2>No existe identificador de imagen</h2>';
		exit();
	}//if

	$result = mysql_query("SELECT * FROM clasificados WHERE id='{$_GET['id']}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	if (isset($row["imagen"]) && $row["imagen"] != ''){
		@unlink('../'. $row["imagen"]);
		@unlink('../'. $row["m_imagen"]);
	}//if
		
	mysql_query("DELETE FROM clasificados WHERE id='{$_GET['id']}'");

	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=clasificados&_f=seeDelete\'",1000);
				</script>';
	return $echo;
}//delete


}//class
?>