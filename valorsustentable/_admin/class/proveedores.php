<?php
echo (preg_match('/proveedores.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class proveedores extends _GLOBAL_{

// MENÚ DE ACCESO RÁPIDO A ESTA SECCION *********************************************************************************
private function quickAccess(){
	$echo = '<table cellspacing="0" cellpadding="4"><tr>
				<td class="linkCont"><a href="?F=proveedores&amp;_f=addModGiro">Ingresar nuevo Giro</a></td>
				<td class="txtTitEncab"> | </td>
				<td class="linkCont"><a href="?F=proveedores&amp;_f=addMod">Agregar Proveedor</a></td>
				<td class="txtTitEncab"> | </td>
				<td class="linkCont"><a href="?F=proveedores&amp;_f=seeDelete">Listado de Proveedores</a></td>
				</tr></table>';
	return $echo;
}//quickAccess




# ******************************************************** AGREGAR GIROS ************************************************************************
# ***********************************************************************************************************************************************
public function addModGiro(){
	if (isset($_GET["id"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM giros WHERE id='{$_GET['id']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		// Registros .......
		$nombre = $row["nombre"];
	} else {
		$_GET["id"] = '0';
		$nombre = '';
	}//if
	
	$echo = $this->quickAccess() .'<p class="txtTitles">Agregar Giro</p>
			<p class="txtCont1">Ingrese el giro para el Directorio de Proveedores.</p>
			<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=proveedores&amp;_f=addGiro">
			  <input type="hidden" name="id" value="'. $_GET["id"] .'" />
				  <table width="100%" border="0" cellspacing="0" cellpadding="5">
					<tr>
					  <td valign="top" class="txtCont2" width="150">Giro:</td>
					  <td valign="top"><input name="nombre" type="text" id="nombre" size="60" maxlength="255" value="'. $nombre .'" /></td>
					</tr>
					<tr>
					  <td valign="top" class="txtCont2">&nbsp;</td>
					  <td valign="top"><input name="enviar" type="submit" class="frmBtnIngresar" id="enviar" value="Agregar-Modificar" /></td>
					</tr>
				  </table>
			</form>
				<script language="JavaScript" type="text/javascript">
				 var frmvalidator = new Validator("form");
				 frmvalidator.addValidation("nombre","req","Ingrese el t\u00CDtulo del giro.");
				</script>' . $this->seeDeleteGiro();
	return $echo;
}//addModGiro

public function addGiro(){
	if(!isset($_POST["nombre"])){ echo '<h2>No se puede agregar su publicaci&oacute;n.</h2>'; exit(); }//if
	// Inserción de datos .............................	
	$nombre = strip_tags($_POST["nombre"]);
	// Bases de datos........................................
	$db = $this->_db();
	if ($_POST["id"] == 0){
		mysql_query("INSERT INTO giros (nombre) VALUES ('". $nombre ."')") or die(mysql_error());
		$id=mysql_insert_id();
		$echo ='<script type="text/javascript">
						setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
						setTimeout("top.location.href = \'?F=proveedores&_f=addModGiro\'",1000);
						</script>';
	} else {
		$sql = "UPDATE giros SET nombre='$nombre' WHERE id='{$_POST['id']}'";
		$result = mysql_query($sql);
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=proveedores&_f=addModGiro\'",1000);
					</script>';
	}//if
	return $echo;
}//addGiro

private function seeDeleteGiro(){
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM giros ORDER BY nombre");
	$echo = '';
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			//$contenido = substr($row["contenido"], 0, 330);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=proveedores&amp;_f=addModGiro&amp;id='. $row["id"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7"><span class="linkCont"><a href="?F=proveedores&amp;_f=addModGiro&amp;id='. $row["id"] .'">'. $row["nombre"] .'</a></span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="javascript:void(ConfirmDelete(\'?F=proveedores&amp;_f=deleteGiro&amp;id='. $row["id"] .'\'))"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<p class="txtTitles">Listado de Giros</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="3">
				  <tr class="txtBold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">Giro:</td>
					<td style="background:#E3EEF0" width="30" align="center">Borrar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//seeDeleteGiro

public function deleteGiro(){
	if (!isset($_GET["id"])){ echo '<h2>No existe identificador de imagen</h2>'; exit(); }//if
	$db=$this->_db();
	mysql_query("DELETE FROM giros WHERE id='{$_GET['id']}'");
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=proveedores&_f=addModGiro\'",1000);
				</script>';
	return $echo;
}//deleteGiro




# ********************************************************** DIRECTORIO DE PROVEEDORES *******************************************************************************
# **************************************************************************************************************************************************************

public function addMod(){	// Formulario para agregar empresa y usuario
	if (isset($_GET["id"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM proveedores WHERE id='{$_GET['id']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		// Registros .......
		$id = $row["id"];
		$empresa = $row["empresa"];
		$giro = $row["giro"];
		$descripcion = $row["descripcion"];
		$calle = $row["calle"]; $numext = $row["numext"]; $numint = $row["numint"];
		$colonia = $row["colonia"]; $cp = $row["cp"];
		$ciudad = $row["ciudad"];
		$estado = $row["estado"];
		$pais = '<span class="txtCont1">Pa&iacute;s Actual: <span class="txtBold">'. $row["pais"] .'</span> <span class="txtCont">Cambiar Pa&iacute;s</span>';
		$calle1 = $row["calle1"];	$calle2 = $row["calle2"];
		$diasatencion = $row["diasatencion"];
		$horarios = $row["horarios"];
		$telefonos = $row["telefonos"];
		$correo = $row["correo"];
		$sitioweb = $row["sitioweb"];
		$activo = $row["activo"];
		$fechapub = $row["fechapub"];
		$vigencia = $row["vigencia"];
		mysql_free_result($result);
		mysql_close();
	} else {
		$_GET["id"] = '0';
		$empresa = '';
		$giro = '';
		$descripcion = '';
		$calle = '';; $numext = ''; $numint = '';
		$colonia = ''; $cp = '';
		$ciudad = '';
		$estado = '';
		$pais = '';
		$calle1 = '';	$calle2 = '';
		$diasatencion = '';
		$horarios = '';
		$telefonos = '';
		$correo = '';
		$sitioweb = '';
		$activo = '';
		$fechapub = '';
		$vigencia = '';
	}//if
	
	return $this->quickAccess() .'<p class="txtTitles">Agregar / Modificar Proveedor</p>
			<p class="txtCont1">Ingrese los datos que se solicitan a continuaci&oacute;n para agregar una un nuevo proveedor, los cuales autom&aacute;ticamente se publicar&aacute;n en el sitio web.</p>
<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=proveedores&amp;_f=addProveedor">
	<input type="hidden" id="DPC_FIRST_WEEK_DAY" value="2" />
	<input type="hidden" id="DPC_WEEKEND_DAYS" value="[0,5,6]" />
	<input type="hidden" id="DPC_CALENDAR_OFFSET_X" value="20" />
	<input type="hidden" id="DPC_BUTTON_OFFSET_X" value="10" />
  	<input type="hidden" name="id" value="'. $_GET["id"] .'" />
	  <table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
		  <td valign="top" class="txtCont2" width="150">Empresa:</td>
		  <td valign="top"><input name="empresa" type="text" id="empresa" size="60" maxlength="255" value="'. $empresa .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2" width="150">Giro:</td>
		  <td valign="top">'. $this->listGiros($giro) .'</td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2">Descripci&oacute;n de la Empresa:</td>
		  <td valign="top"><textarea name="descripcion" id="descripcion" cols="60" rows="3">'. $descripcion .'</textarea></td>
	    </tr>
		<tr>
		  <td valign="top" class="txtCont2">Calle:</td>
		  <td valign="top"><input name="calle" type="text" id="calle" value="'. $calle .'" size="60" maxlength="255" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2">N&uacute;mero exterior:</td>
		  <td valign="top"><input name="numext" type="text" id="numext" value="'. $numext .'" size="60" maxlength="255" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2">N&uacute;mero interior:</td>
		  <td valign="top"><input name="numint" type="text" id="numint" value="'. $numint .'" size="60" maxlength="255" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2" width="150">Colonia:</td>
		  <td valign="top"><input name="colonia" type="text" id="colonia" size="60" maxlength="255" value="'. $colonia .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2" width="150">C&oacute;digo Postal:</td>
		  <td valign="top"><input name="cp" type="text" id="cp" size="60" maxlength="255" value="'. $cp .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2" width="150">Ciudad:</td>
		  <td valign="top"><input name="ciudad" type="text" id="ciudad" size="60" maxlength="255" value="'. $ciudad .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2" width="150">Estado:</td>
		  <td valign="top"><input name="estado" type="text" id="estado" size="60" maxlength="255" value="'. $estado .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2" width="150">Pa&iacute;s:</td>
		  <td valign="top">'. $pais . $this->selectPaises() .'</td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2" width="150">Entre las calles:</td>
		  <td valign="top" class="txtCont2">
		  		<table cellpadding="2" cellspacing="0"><tr>
					  <td valign="top"><input name="calle1" type="text" id="calle1" size="30" maxlength="255" value="'. $calle1 .'" /></td>
					  <td valign="top" class="txtCont2"> y </td>
					  <td valign="top"><input name="calle2" type="text" id="calle2" size="30" maxlength="255" value="'. $calle2 .'" /></td>
				</tr></table>
		  </td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2">D&iacute;as de atenci&oacute;n:</td>
		  <td valign="top" class="txtBold">
		  		'. $this->listDiasAtencion($diasatencion) .'
		  </td>
	    </tr>
		<tr>
		  <td valign="top" class="txtCont2">Horarios:</td>
		  <td valign="top"><input name="horarios" type="text" id="horarios" size="60" maxlength="255" value="'. $horarios .'" /></td>
	    </tr>
		<tr>
		  <td valign="top" class="txtCont2">Tel&eacute;fonos:</td>
		  <td valign="top"><input name="telefonos" type="text" id="telefonos" size="60" maxlength="255" value="'. $telefonos .'" /></td>
	    </tr>
		<tr>
		  <td valign="top" class="txtCont2">Correo electr&oacute;nico:</td>
		  <td valign="top" class="txtPieNotaGris"><input name="correo" type="text" id="correo" size="60" maxlength="255" value="'. $correo .'" /> <br />A este correo se enviar&aacute; la notificaci&oacute;n.</td>
	    </tr>
		<tr>
		  <td valign="top" class="txtCont2">Sitio web:</td>
		  <td valign="top"><input name="sitioweb" type="text" id="sitioweb" size="60" maxlength="255" value="'. $sitioweb .'" /></td>
	    </tr>
		<tr>
		  <td valign="top" class="txtCont2" width="150">Vigencia:</td>
		  <td valign="top"><input name="vigencia" type="text" id="DPC_calendar1b_YYYY-MM-DD" size="10" maxlength="10" value="'. $vigencia .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2">&nbsp;</td>
		  <td valign="top"><input name="enviar" type="submit" class="frmBtnIngresar" id="enviar" value="Agregar-Modificar" /></td>
		</tr>
	  </table>
</form>
		<script language="JavaScript" type="text/javascript">
		 var frmvalidator = new Validator("form");
		 frmvalidator.addValidation("empresa","req","Ingrese el nombre de la empresa");
		 frmvalidator.addValidation("calle","req","Ingrese la calle");
		 frmvalidator.addValidation("numext","req","Ingrese el numero exterior");
		 frmvalidator.addValidation("ciudad","req","Ingrese la ciudad");
		 frmvalidator.addValidation("estado","req","Ingrese lel Estado");
		 frmvalidator.addValidation("correo","req","Ingrese su correo electronico");
		 frmvalidator.addValidation("correo","maxlen=100");
		 frmvalidator.addValidation("correo","email");
		 frmvalidator.addValidation("vigencia","req","Ingrese la vigencia del anuncio");
	  </script>
';
}//addMod


public function addProveedor(){
	if(!isset($_POST["empresa"])){ echo '<h2>No se puede agregar su publicaci&oacute;n.</h2>'; exit(); }//if
	// Inserción de datos .............................	
	extract($_POST);
	$descripcion = strip_tags($_POST["diasatencion"]);
	$fechapub = date("Y-m-d");
	$activo = '1';
	$giro = $_POST["giro"];
	$codigo = md5($us_correo);
	$dias = '';
	for ($i=1; $i<=7; $i++){
		if (isset($_POST[$this->dias[$i]])){
			$dias .= $i .',';
		}//if
	}//for
	$diasatencion = (strlen($dias) > 0) ? substr($dias, 0, -1) : '';
	
	// Bases de datos........................................
	$db = $this->_db();
	// Ver si ya existe:
	$result = mysql_query("SELECT * FROM proveedores WHERE correo='{$_POST['correo']}'");
	if (mysql_num_rows($result) > 1){
		echo '<script type="text/javascript">
					setTimeout("alert(\'EL REGISTRO CON EL CORREO ELECTRONICO YA EXISTE, POSIBLEMENTE YA ESTE REGISTRADA ESTA EMPRESA.\');",100); 
					setTimeout("top.location.href = \'javascript:history.go(-1)\'",1000);
					</script>';
		exit();
	}//if
	mysql_free_result($result);
	
	if ($_POST["id"] == 0){
		// Ingrear a la empresa
		mysql_query("INSERT INTO proveedores (empresa, giro, descripcion, calle, numext, numint, colonia, cp, ciudad, estado, pais, calle1, calle2, diasatencion, horarios, telefonos, correo, sitioweb, fechapub, vigencia, codigo, activo)
					VALUES ('". $empresa ."', '". $giro ."', '". $descripcion ."', '". $calle ."', '". $numext ."', '". $numint ."', '". $colonia ."', '". $cp ."', '". $ciudad ."', '". $estado ."', '". $pais ."', '". $calle1 ."', '". $calle2 ."', '". $diasatencion ."', '". $horarios ."', '". $telefonos ."', '". $correo ."', '". $sitioweb ."', '". $fechapub ."', '". $vigencia ."', '". $codigo ."', '". $activo ."')") or die(mysql_error());
		$id=mysql_insert_id();
		//Enviar mail para que pueda confirmar el usuario registrado:
		$this->enviar($id, $empresa, $giro, $descripcion, $calle, $numext, $numint, $colonia, $cp, $ciudad, $estado, $pais, $calle1, $calle2, $diasatencion, $horarios, $telefonos, $correo, $sitioweb, $us_nombre, $us_apellidos, $us_correo, $us_puesto, $us_telefono, $fechapub, $vigencia, $codigo);
		//Mensaje de registro agregado 
		$echo ='<script type="text/javascript">
						setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO Y EL CORREO HA SIDO ENVIADO A: '. $correo .'\');",100); 
						setTimeout("top.location.href = \'?F=proveedores&_f=addMod\'",1000);
						</script>';
	} else {
		$sql = "UPDATE proveedores SET empresa='$empresa', giro='$giro', descripcion='$descripcion', calle='$calle', numext='$numext', numint='$numint', colonia='$colonia', cp='$cp', ciudad='$ciudad', estado='$estado', pais='$pais', calle1='$calle1', calle2='$calle2', diasatencion='$diasatencion', horarios='$horarios', telefonos='$telefonos', correo='$correo', sitioweb='$sitioweb', vigencia='$vigencia' WHERE id='{$_POST['id']}'";
		$result = mysql_query($sql);
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=proveedores&_f=seeDelete\'",1000);
					</script>';
	}//if
	return $echo;
}//addProveedor

# ************************************************************* ENVÍO DE CORREOS PARA ACTIVACIÓN ******************************************************************
# *****************************************************************************************************************************************************************
public function enviar($id, $empresa, $giro, $descripcion, $calle, $numext, $numint, $colonia, $cp, $ciudad, $estado, $pais, $calle1, $calle2, $diasatencion, $horarios, $telefonos, $correo, $sitioweb, $us_nombre, $us_apellidos, $us_correo, $us_puesto, $us_telefono, $fechapub, $vigencia, $codigo){
	$destinatario = $correo;
	// Consultar el giro
	$result = mysql_query("SELECT * FROM giros WHERE id='{$giro}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$giroProv = $row["nombre"];
	mysql_free_result($result);
	mysql_close();
	
	# FORMATO DE CORREO ELECTRONICO DEL PANEL DE ADMINISTRACIÓN AL REGISTRAR UN PROVEEDOR ++++++++++++++++++++++++++++++++++++++++++++++++
	$datos = '<p><img src="http://www.outletminero.com/imgs/logo_mini.png" border="0" /></p>
			 	<p>Ven y conoce OutletMinero.com, sitio de informaci&oacute;n de la industria minera en Latinoam&eacute;rica, donde podr&aacute;s encontrar Noticias, Entrevistas, Directorio de Proveedores, Bolsa de Trabajo y m&aacute;s.</p>
				<p>Este correo electr&oacute;nico es una notificaci&oacute;n de que has sido agregado en nuestro Directorio de Proveedores, y estar&aacute;s visible para nuestros visitantes.</p>
				<p>La informaci&oacute;n agregada de tu empresa ha sido la siguiente:</p>
				<p>
					<b>Nombre de la empresa: </b>'. utf8_decode($empresa) .'<br />
					<b>Giro: </b>'. utf8_decode($giroProv) .'<br />
					<b>Calle: </b>'. utf8_decode($calle) .'<br />
					<b>N&uacute;mero exterior: </b>'. utf8_decode($numext) .'<br />
					<b>N&uacute;mero interior: </b>'. utf8_decode($numint) .'<br />
					<b>Colonia: </b>'. utf8_decode($colonia) .'<br />
					<b>C&oacute;digo Postal: </b>'. utf8_decode($cp) .'<br />
					<b>Ciudad: </b>'. utf8_decode($ciudad) .'<br />
					<b>Estado: </b>'. utf8_decode($estado) .'<br />
					<b>Pa&iacute;s </b>'. utf8_decode($pais) .'<br />
					<b>Telefonos: </b>'. utf8_decode($telefonos) .'<br />
					<b>Correo: </b>'. $correo .'<br />
					<b>Sitio web: </b>'. $sitioweb .'
				</p>
				<p>Tu publicaci&oacute;n estar&aacute; vigente hasta el d&iacute;a 31 de Junio de 2011, y un ejecutivo se comunicar&aacute; contigo para dar seguimiento a tu registro.<p>
				<p>Para poder actualizar tu informaci&oacute;n podr&aacute;s ingresar con el siguiente enlace, y es necesario que ingreses tu contrase&ntilde;a para la seguridad de tu informaci&oacute;n</p>
				<p><a href="http://www.outletminero.com/?F=proveedores_activ&amp;_f=activarCuenta&amp;codigo='. $codigo .'&amp;id='. $id .'">http://www.outletminero.com/?F=proveedores_activ&amp;_f=activarCuenta&amp;correo='. $correo .'&amp;codigo='. $codigo .'&amp;id='. $id .'</a></p>
				';
	$datos .= 'Este correo es enviado desde formulario de registro del sitio Web: <b><a href="http://www.outletminero.com">www.outletminero.com</a></b>
				<a href="http://www.outletminero.com/" title="OutletMinero.com"><img src="http://www.outletminero.com/imgs/logo_outletminero.jpg" border="0" /></a>';

	require_once('../Rmail/Rmail.php');
	$mail = new Rmail();
		$mail->setFrom('Registro Proveedores <info@outletminero.com>');
		$mail->setSubject('Te damos la bienvenida a Outlet Minero');
		$mail->setPriority('high');
		$mail->setHTML($datos);
		$result  = $mail->send(array($destinatario));
		//$result  = $mail->send(array($destinatario));
}//function enviar


public function seeDelete(){
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM proveedores ORDER BY empresa");
	$echo = '';
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$date =  new DateTime($row["fechapub"]);
			$fechapub = $this->txtFechaPub(date_format($date, 'Y-m-d'));
			//$contenido = substr($row["contenido"], 0, 330);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=proveedores&amp;_f=addMod&amp;id='. $row["id"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["empresa"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtMiniBck">'. $row["calle"] .', '. $row["numext"] .' '. $row["colonia"] .', '. $row["cp"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["estado"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["pais"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["correo"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $fechapub .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="javascript:void(ConfirmDelete(\'?F=proveedores&amp;_f=deleteProveedor&amp;id='. $row["id"] .'\'))"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = $this->quickAccess() . $this->buscarProveedor() .'<p class="txtTitles">Listado de Proveedores</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="3">
				  <tr class="txtBold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">Empresa</td>
					<td style="background:#E3EEF0" align="center">Direcci&oacute;n:</td>
					<td style="background:#E3EEF0" align="center">Estado</td>
					<td style="background:#E3EEF0" align="center">Pa&iacute;s</td>
					<td style="background:#E3EEF0" align="center">Correo electr&oacute;nico</td>
					<td style="background:#E3EEF0" align="center">Publicado el:</td>
					<td style="background:#E3EEF0" width="30" align="center">Borrar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//


private function buscarProveedor(){
	return '<p class="txtTitles">B&uacute;squeda de proveedores</p>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbBack1">
				  <tr>
					<td><form id="form4" name="form4" method="post" action="">
					  <table width="100%" border="0" cellspacing="0" cellpadding="4">
						<tr>
						  <td width="150" class="txtBold">Empresa:</td>
						  <td><input name="empresa" type="text" id="empresa" size="60" maxlength="255" /></td>
						</tr>
						<tr>
						  <td class="txtBold">Giro:</td>
						  <td>'. $this->listGiros('0') .'</td>
						</tr>
						<tr>
						  <td class="txtBold">Ciudad:</td>
						  <td><input name="ciudad" type="text" id="ciudad" size="60" maxlength="255" /></td>
						</tr>
						<tr>
						  <td class="txtBold">Pa&iacute;s:</td>
						  <td>'. $this->selectPaises() .'</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td><input name="submit" type="submit" class="frmBtnIngresar" id="submit" value="Buscar Proveedor" /></td>
						</tr>
					  </table>
					</form></td>
				  </tr>
				</table>';
}//buscarProveedor


public function deleteProveedor(){
	if (!isset($_GET["id"])){ echo '<h2>No existe identificador de imagen</h2>'; exit(); }//if
	$db=$this->_db();
	mysql_query("DELETE FROM proveedores WHERE id='{$_GET['id']}'");
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=proveedores&_f=seeDelete\'",1000);
				</script>';
	return $echo;
}//delete


}//class
?>