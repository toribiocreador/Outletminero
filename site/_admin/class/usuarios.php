<?php
class usuarios extends _GLOBAL_{

public function addModUser(){
	$validarPwd = '';
	if($_SESSION["nivel"]==6&&$_GET['id']!=7)
		return;
	if (isset($_GET["id"])){
		$db = $this->_db();
		$id = $_SESSION["idusuario"];
		if($_SESSION["nivel"]!=6)
			$result = mysql_query("SELECT * FROM usuarios WHERE id='{$_GET['id']}'");
		else
			$result = mysql_query("SELECT * FROM usuarios WHERE id='{$id}'");
		echo $id;
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$nombre = $row["nombre"];
			$appaterno = $row["appaterno"];
			$apmaterno = $row["apmaterno"];
			$correo = $row["correo"];
			$messenger = $row["messenger"];
			$skype = $row["skype"];
			$movil = $row["movil"];
			$telefono = $row["telefono"];
			$direccion = $row["direccion"];
			$ciudad = $row["ciudad"];
			$estado = $row["estado"];
			$pais = $row["pais"];
			$cp = $row["cp"];
			$nivel = $row["nivel"];
			$observaciones = $row["observaciones"];
		$msgPwd = '<span class="txtCont2"> Deje este espacio en blanco si no desea modificarla.</span>';
	} else {
		$_GET["id"] = '0';
		$validarPwd = 'frmvalidator.addValidation("pwd","req","Ingrese su contrasena");';
		$msgPwd = '';
			$nombre = '';
			$appaterno = '';
			$apmaterno = '';
			$correo = '';
			$messenger = '';
			$skype = '';
			$movil = '';
			$telefono = '';
			$direccion = '';
			$ciudad = '';
			$estado = '';
			$pais = '';
			$cp = '';
			$nivel = '';
			$observaciones = '';
	}//if

	return '<p><span class="txtTitles">Alta de usuarios.</span></p>
<p><span class="txtCont1">Aqu&iacute; se dar&aacute;n de alta a los usuarios que podr&aacute;n insertar informaci&oacute;n para el sitio web outletminero.com</span></p>
<form id="form" name="form" method="post" action="?F=usuarios&amp;_f=addUser">
  <input type="hidden" name="id" value="'. $_GET["id"] .'">
  <table width="800" border="0" cellspacing="2" cellpadding="5">
    <tr>
      <td width="150" valign="top" class="txtCont2">*Nombre:</td>
      <td valign="top"><input name="nombre" type="text" id="nombre" size="50" maxlength="50" value="'. $nombre .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">*Apellido Paterno:</td>
      <td valign="top"><input name="appaterno" type="text" id="appaterno" size="50" maxlength="30" value="'. $appaterno .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">*Apellido Materno:</td>
      <td valign="top"><input name="apmaterno" type="text" id="apmaterno" size="50" maxlength="30" value="'. $apmaterno .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">*Correo electr&oacute;nico:</td>
      <td valign="top"><input name="correo" type="text" id="correo" size="50" maxlength="256" value="'. $correo .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">MSN Messenger:</td>
      <td valign="top"><input name="messenger" type="text" id="messenger" size="50" maxlength="256" value="'. $messenger .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Skype:</td>
      <td valign="top"><input name="skype" type="text" id="skype" size="50" maxlength="256" value="'. $skype .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Celular / M&oacute;vil:</td>
      <td valign="top"><input name="movil" type="text" id="movil" size="20" maxlength="100" value="'. $movil .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Tel&eacute;fono de contacto:</td>
      <td valign="top"><input name="telefono" type="text" id="telefono" size="20" maxlength="100" value="'. $telefono .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Direcci&oacute;n:</td>
      <td valign="top"><input name="direccion" type="text" id="direccion" size="50" maxlength="256" value="'. $direccion .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">*Ciudad:</td>
      <td valign="top"><input name="ciudad" type="text" id="ciudad" size="30" maxlength="100" value="'. $ciudad .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">*Estado:</td>
      <td valign="top"><input name="estado" type="text" id="estado" size="30" maxlength="100" value="'. $estado .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">*Pa&iacute;s:</td>
      <td valign="top"><input name="pais" type="text" id="pais" size="30" maxlength="50" value="'. $pais .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">C&oacute;digo Postal:</td>
      <td valign="top"><input name="cp" type="text" id="cp" size="10" maxlength="10" value="'. $cp .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Nivel de acceso:</td>
      <td valign="top">'. $this->listNiveles($nivel) .'</td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Observaciones:</td>
      <td valign="top"><textarea name="observaciones" id="observaciones" cols="50" rows="5">'. $observaciones .'</textarea></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2" style="background:#F1F8F8">Contrase&ntilde;a:</td>
      <td valign="top" style="background:#F1F8F8"><input name="pwd" type="password" id="pwd" size="20" />'. $msgPwd .'</td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">&nbsp;</td>
      <td valign="top"><input name="submit" type="submit" class="frmBtnIngresar" id="submit" value="Crear/Modificar" /></td>
    </tr>
  </table>
</form>

 	<script language="JavaScript" type="text/javascript">
		 var frmvalidator = new Validator("form");
		 frmvalidator.addValidation("nombre","req","Ingrese su nombre");
		 frmvalidator.addValidation("appaterno","req","Ingrese el apellido paterno");
		 frmvalidator.addValidation("apmaterno","req","Ingrese el apellido materno");
		 frmvalidator.addValidation("correo","req","Ingrese su correo electronico");
		 frmvalidator.addValidation("correo","maxlen=100");
		 frmvalidator.addValidation("correo","email");
		 frmvalidator.addValidation("ciudad","req","Ingrese su ciudad");
		 frmvalidator.addValidation("estado","req","Ingrese su estado");
		 frmvalidator.addValidation("pais","req","Ingrese su pais");
		 frmvalidator.addValidation("cp","req","Ingrese su codigo postal");
		 '. $validarPwd .'
	  </script>

';
}//main

public function addUser(){
	if(!isset($_POST["correo"])){
		echo '<h2>No se puede agregar al usuario</h2>';
		exit();
	}//if
	
	$nombre = strip_tags($_POST["nombre"]);
	$appaterno = strip_tags($_POST["appaterno"]);
	$apmaterno = strip_tags($_POST["apmaterno"]);
	$correo = strip_tags($_POST["correo"]);
	$messenger = strip_tags($_POST["messenger"]);
	$skype = strip_tags($_POST["skype"]);
	$movil = strip_tags($_POST["movil"]);
	$telefono = strip_tags($_POST["telefono"]);
	$direccion = strip_tags($_POST["direccion"]);
	$ciudad = strip_tags($_POST["ciudad"]);
	$estado = strip_tags($_POST["estado"]);
	$pais = strip_tags($_POST["pais"]);
	$cp = strip_tags($_POST["cp"]);
	$nivel = strip_tags($_POST["nivel"]);
	$observaciones = strip_tags($_POST["observaciones"]);
	$pwd = md5($_POST["pwd"]);
	$fechacreacion = date("Y-m-d");
	
	$db = $this->_db();
	
	if ($_POST["id"] == 0){
		mysql_query("INSERT INTO usuarios (nombre, appaterno, apmaterno, correo, messenger, skype, movil, telefono, direccion, ciudad, estado, pais, cp, fechacreacion, nivel, observaciones, pwd)
					VALUES ('". $nombre ."', '". $appaterno ."', '". $apmaterno ."', '". $correo ."', '". $messenger ."', '". $skype ."', '". $movil ."', '". $telefono ."', '". $direccion ."', '". $ciudad ."', '". $estado ."', '". $pais ."', '". $cp ."', '". $fechacreacion ."', '". $nivel ."', '". $observaciones ."', '". $pwd ."')") or die(mysql_error());
		$id=mysql_insert_id();
		$echo ='<script type="text/javascript">
						setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
						setTimeout("top.location.href = \'?F=usuarios&_f=addModUser\'",1000);
						</script>';
	} else {
		if ($_POST["pwd"] == ''){
			$sql ="UPDATE usuarios SET nombre='$nombre', appaterno='$appaterno', apmaterno='$apmaterno', correo='$correo', messenger='$messenger', skype='$skype', movil='$movil', telefono='$telefono', direccion='$direccion', ciudad='$ciudad', estado='$estado', pais='$pais', cp='$cp', fechacreacion='$fechacreacion', nivel='$nivel', observaciones='$observaciones' WHERE id='{$_POST['id']}'";
		} else {
			$pwd = md5($_POST["pwd"]);
			$sql = "UPDATE usuarios SET nombre='$nombre', appaterno='$appaterno', apmaterno='$apmaterno', correo='$correo', messenger='$messenger', skype='$skype', movil='$movil', telefono='$telefono', direccion='$direccion', ciudad='$ciudad', estado='$estado', pais='$pais', cp='$cp', fechacreacion='$fechacreacion', nivel='$nivel', observaciones='$observaciones', pwd='$pwd' WHERE id='{$_POST['id']}'";
		}//if
		$result = mysql_query($sql);
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?\'",1000);
					</script>';
	}//if
	return $echo;
}//addUser

public function seeDelete(){
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM usuarios ORDER BY appaterno");
	$echo = '';
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$nivel = $this->nivelUsuario($row["nivel"]);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=usuarios&amp;_f=addModUser&amp;id='. $row["id"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["appaterno"] .' '. $row["apmaterno"] .', '. $row["nombre"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["correo"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $nivel .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=usuarios&amp;_f=delUser&amp;id='. $row["id"] .'"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<table width="100%" border="0" cellspacing="2" cellpadding="3">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0">Nombre</td>
					<td style="background:#E3EEF0">Correo</td>
					<td style="background:#E3EEF0">Nivel de Usuario</td>
					<td style="background:#E3EEF0" width="30" align="center">Borrar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//seeDelete


public function main(){
	return '<p class="txtTitles">Bienvenido usuario</p>
			<p class="txtCont1">Para poder ingresar inserta los siguientes datos:</p>
			<form id="form" name="form" method="post" action="?F=usuarios&amp;_f=validar">
			  <table width="800" border="0" cellspacing="0" cellpadding="3">
				<tr>
				  <td width="100" class="txtCont2">Usuario:</td>
				  <td><input type="text" name="usuario" id="usuario" /></td>
				</tr>
				<tr>
				  <td class="txtCont2">Contrase&ntilde;a:</td>
				  <td><input type="password" name="pwd" id="pwd" /></td>
				</tr>
				<tr>
				  <td>&nbsp;</td>
				  <td><input name="submit" type="submit" class="frmBtnIngresar" id="submit" value="Ingresar" /></td>
				</tr>
			  </table>
			</form>

			<script language="JavaScript" type="text/javascript">
				 var frmvalidator = new Validator("form");
				 frmvalidator.addValidation("user","req","Ingrese el nombre de usuario");
				 frmvalidator.addValidation("pwd","req","Ingrese su contrasena");
			  </script>
';
}//main

public function validar(){
	if (!isset($_POST["usuario"]) && !isset($_POST["pwd"])){ echo '<h2>Acceso denegado</h2>'; exit(); }//if
	
	$db = $this->_db();
	$usuario = strip_tags($_POST["usuario"]); $pwd = md5($_POST["pwd"]);
	$result = mysql_query("SELECT * FROM usuarios WHERE correo='{$usuario}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	
	if ($usuario == $row["correo"] && $pwd == $row["pwd"]){
		$_SESSION["acceso"] = "SI";
		$_SESSION["nombre"] = $row["nombre"] .' '. $row["appaterno"];
		$_SESSION["idusuario"] = $row["id"];
		$_SESSION["nivel"] = $row["nivel"];
		$_SESSION["correo"] = $row["correo"];
		$_SESSION["id"] = session_id();
		header('Location: ?F=inicio&_f=welcome');
		exit();
	} else {
		echo '<h2>Usuario no autorizado</h2>'; exit();
	}//if
}//validar

public function cerrarSesion(){
	session_destroy();
	header('Location: ?');
	exit();
}//endSession

public function delUser(){
	if (!isset($_GET["id"])){ echo '<h2>Acceso denegado</h2>'; exit(); }//if
	$db = $this->_db();
	mysql_query("DELETE FROM usuarios WHERE id='{$_GET['id']}'");
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=usuarios&_f=seeDelete\'",1000);
				</script>';
	return $echo;
}//delUser


}//class
?>