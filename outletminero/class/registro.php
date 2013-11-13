<?php
echo (preg_match('/registro.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class registro extends _GLOBAL_{

# Profesionista tipo = 1
# Empresa		tipo = 2

public function main(){
	return '<p class="txtTit">Registro de usuarios</p>
           <blockquote><p class="txtCont">Reg&iacute;strate en nuestra comunidad, comenta nuestras publicaciones, crea temas en los foros, en <span class="txtBold">OutletMinero.com</span> tendr&aacute;s la posibilidad de:</p></blockquote>
           <ul>
             <li class="txtCont"><span class="txtBold">Empresas</span>: Publicar ofertas laborales de cualquier nivel.</li>
             <li class="txtCont"><span class="txtBold">Profesionistas y usuarios en general:</span><span class="txtCont"> Publicar tu curriculum para consulta de las empresas registradas</span>.</li>
            </ul>
           <p class="linkTitNot"><a href="?F=bolsatrabajo&amp;_f=regProf">&iexcl;Bienvenida tu solicitud de empleo!</a></p>
           <blockquote><p class="txtCont">S&eacute; parte de nuestra comunidad y publica tu curriculum para que las empresas puedan consultarlo y ponerse en contacto contigo.<span class="linkCont"> <a href="?F=bolsatrabajo&amp;_f=regProf">Reg&iacute;strate ahora.</a></span></p></blockquote>
           <p class="linkTitNot"><a href="?F=bolsatrabajo&amp;_f=regEmp">&iexcl;Bienvenida empresa minera!</a></p>
           <blockquote><p class="txtCont">Publica tus ofertas laborates para que la comunidad se ponga en contacto contigo y se fomente el desarrollo profesional. <span class="linkCont"><a href="?F=bolsatrabajo&amp;_f=regEmp">Reg&iacute;strate ahora.</a></span><span class="linkCont"></span></p></blockquote>';
}//main

public function regEmpresa(){
	return '<table width="758" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
              <td width="460" valign="top"><p><img src="imgs/icon_om.png" width="68" height="23" alt="" />
			  		<span class="txtTitles">Registro de empresa</span></p>
                <blockquote>
                  <p class="txtSubTit">Bienvenid(a) Empresario(a)!</p>
                  <p class="txtCont">Bienvenido(a) a la bolsa de trabajo de OutletMinero.com, donde podr&aacute;s encontrar diferentes ofertas de trabajo desde empresas solicitando personal hasta profesionistas en busca de empleo.</p>
                  <p class="txtCont">Para poder registrarte, llena el siguiente formulario de suscripci&oacute;n:</p>
                  
				  <!-- FORMULARIO DE REGISTRO -->
				  <form id="formEmp" name="formEmp" method="post" action="?F=registro&amp;_f=registrar">
				  	<input name="tipo" type="hidden" id="tipo" value="2" /> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="10">
                      <tr>
                        <td width="140" valign="top" class="txtBold">*Nombre:</td>
                        <td valign="top"><input name="nombre" type="text" class="frmInput" id="nombre" size="50" maxlength="50" /></td>
                      </tr>
                      <tr>
                        <td valign="top" class="txtBold">*Apellido Paterno:</td>
                        <td valign="top"><input name="appaterno" type="text" class="frmInput" id="appaterno" size="50" maxlength="50" /></td>
                      </tr>
                      <tr>
                        <td valign="top" class="txtBold">*Apellido Materno:</td>
                        <td valign="top"><input name="apmaterno" type="text" class="frmInput" id="apmaterno" size="50" maxlength="50" /></td>
                      </tr>
                      <tr>
                        <td valign="top" class="txtBold">*Correo Electr&oacute;nico:</td>
                        <td valign="top"><input name="correo" type="text" class="frmInput" id="correo" size="50" maxlength="256" /><br />
						<span class="txtDet">Este ser&aacute; tu nombre de usuario al iniciar sesi&oacute;n.</span></td>
                      </tr>
					  <tr>
                        <td valign="top" class="txtBold">Sitio Web:</td>
                        <td valign="top"><span class="txtDet">http://</span><input name="sitioweb" type="text" class="frmInput" id="sitioweb" size="44" maxlength="256" /></td>
                      </tr>
					  <tr>
                        <td valign="top" class="txtBold">MSN Messenger:</td>
                        <td valign="top"><input name="messenger" type="text" class="frmInput" id="messeger" size="50" maxlength="256" /></td>
                      </tr>
					  <tr>
                        <td valign="top" class="txtBold">Skype:</td>
                        <td valign="top"><input name="skype" type="text" class="frmInput" id="skype" size="50" maxlength="256" /></td>
                      </tr>
                      <tr>
                        <td valign="top" class="txtBold">*Empresa:</td>
                        <td valign="top"><input name="empresa" type="text" class="frmInput" id="empresa" size="40" /></td>
                      </tr>
					  <tr>
                        <td valign="top" class="txtBold">*Descripci&oacute;n de su empresa:</td>
                        <td valign="top"><textarea name="comentarios" cols="50" rows="4" class="frmInput" id="comentarios"></textarea></td>
                      </tr>
					  <tr>
                        <td valign="top" class="txtBold">*Direcci&oacute;n:</td>
                        <td valign="top"><textarea name="direccion" cols="50" rows="4" class="frmInput" id="direccion"></textarea></td>
                      </tr>
					  <tr>
                        <td valign="top" class="txtBold">*Ciudad:</td>
                        <td valign="top"><input name="ciudad" type="text" class="frmInput" id="ciudad" size="40" /></td>
                      </tr>
                      <tr>
                        <td valign="top" class="txtBold">*Estado / Provincia:</td>
                        <td valign="top"><input name="estado" type="text" class="frmInput" id="estado" size="40" /></td>
                      </tr>
                      <tr>
                        <td valign="top" class="txtBold">*Pa&iacute;s:</td>
                        <td valign="top">'. $this->selectPaises() .'</td>
                      </tr>
					  <tr>
                        <td valign="top" class="txtBold">Telefono(s):</td>
                        <td valign="top"><input name="telefonos" type="text" class="frmInput" id="telefonos" size="50" maxlength="256" /></td>
                      </tr>
					  <tr>
                        <td valign="top" class="txtBold">Clave:</td>
                        <td valign="top"><input name="clave" type="password" class="frmInput" id="clave" size="20" maxlength="20" /><br />
						<span class="txtDet">Esta ser&aacute; tu contrase&ntilde;a para iniciar sesi&oacute;n.</span></td>
                      </tr>
                      <tr>
                        <td valign="top" class="txtBold">&nbsp;</td>
                        <td valign="top"><p class="txtBold">T&eacute;rminos y condiciones de uso.</p>
                          <p class="txtDet">Estoy de acuerdo que usar&eacute; este sistema de registro y publicaci&oacute;n de informaci&oacute;n para fines de promoci&oacute;n de oferta laboral e interacci&oacute;n como medio de contacto con empresas y profesionistas afines al giro de este sitio web. No publicar&eacute; informaci&oacute;n difamatoria, inexacta, abusiva, vulgar, ofensiva, sin fines de acoso, terminolog&iacute;a obsena, profanadora, con orientaciones sexuales, de amenaza, invasora a la privacidad de las personas, sin publicar material para adultos, sin violar la integridad moral e intelectual de todas las personas que utilicen este medio.</p>
                          <p class="txtDet">Adem&aacute;s no postear&eacute; ning&uacute;n contenido el cual tenga derechos de autor previamente establecidos a menos que tenga el consentimiento del autor. No publicar&eacute; spam, &quot;flooding&quot;, publicidad, esquemas piramidales, cadenas de caracteres indebidos y solicitudes que no se encuentren dentro de los fines de esta aplicaci&oacute;n.</p>
                          <p class="txtDet">Como observaci&oacute;n importante, los propietarios de esta aplicaci&oacute;n y de este sitio web no est&aacute;n indefinidamente monitoreando los mensajes publicados, es por ello que la informaci&oacute;n publicada no es responsabilidad de los mismos propietarios del sitio, m&aacute;s sin embargo tienen toda la autoridad de bloquear a cualquier usuario que se encuentre haciendo uso indebido del sitio web adem&aacute;s de tomar las acciones necesarias para responsabilizar cualquier publicaci&oacute;n. Es por ello que no se garantiza la exactitud, veracidad y credibilidad de la informaci&oacute;n publicada bajo la responsabilidad de los usuarios que utilicen el sitio web.</p>
                          <p class="txtDet">Los comentarios publicados expresan el punto de vista e informaci&oacute;n personal de cada usuario registrado.</p></td>
                      </tr>
                      <tr>
                        <td valign="top" class="txtBold">&nbsp;</td>
                        <td valign="top"><input name="button" type="submit" class="frmButton" id="button" value="Estoy de acuerdo, registrarme" /></td>
                      </tr>
                    </table>
                  </form>
				  
				  <script language="JavaScript" type="text/javascript">
					 var frmvalidator = new Validator("formEmp");
					 frmvalidator.addValidation("nombre","req","Ingrese su nombre");
					 frmvalidator.addValidation("appaterno","req","Ingrese el apellido paterno");
					 frmvalidator.addValidation("apmaterno","req","Ingrese el apellido materno");
					 frmvalidator.addValidation("correo","req","Ingrese su correo electronico");
					 frmvalidator.addValidation("correo","maxlen=100");
					 frmvalidator.addValidation("correo","email");
					 frmvalidator.addValidation("empresa","req","Ingrese el nombre oficial de su empresa");
					 frmvalidator.addValidation("ciudad","req","Ingrese su ciudad");
					 frmvalidator.addValidation("estado","req","Ingrese su estado");
					 frmvalidator.addValidation("pais","req","Ingrese su pais");
					 frmvalidator.addValidation("clave","req","Ingrese su clave");
					 frmvalidator.addValidation("comentarios","req","Ingrese una breve descripcion de su empresa");
				  </script>
				  
                </blockquote></td>
              </tr>
        </table>';
}//regEmpresa



// *************************************************** REGISTRAR EMPRESA Y PROFESIONISTAS **********************************************************
// ************************************************************************************************************************************************
public function registrar(){
	if(!isset($_POST["nombre".$_GET["id"]]) && !isset($_GET["id"])){	echo '<h2>No se puede agregar su registro en bolsa de trabajo.</h2>'; exit(); }//if
	
	$id = (isset($_GET["id"])) ? $_GET["id"] : '1';
	$nombre = strip_tags($_POST["nombre".$id]);
	$apellidos = strip_tags($_POST["apellidos".$id]);
	$correo = $_POST["correo".$id];
	$clavesimple = strip_tags($_POST["pwd".$id]);
	$pwd = md5(strip_tags($_POST["pwd".$id]));
	$codigo = md5($correo);	
	$tipo = $id;
	
	// Verifica si ya existe el registro ..................
	$db = $this->_db();
	$result = mysql_query("SELECT correo FROM aspirante WHERE correo='{$correo}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	if ($row["correo"] == $correo){
		echo '<script type="text/javascript">
					setTimeout("alert(\'El registro bajo este correo electr\u00F3nico YA EXISTE\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=main\'",1000);
					</script>';
		exit();
	}//if
	
	// Guardar nuevo registro
	mysql_query("INSERT INTO aspirante (tipo, nombre, apellidos, correo, pwd, codigo)
				 VALUES ('". $tipo ."', '". $nombre ."', '". $apellidos ."', '". $correo ."', '". $pwd ."', '". $codigo ."')") or die(mysql_error());
	$id=mysql_insert_id();
	mysql_query("INSERT INTO empleoDeseado (id_aspirante)
				 VALUES ('". $id ."')") or die(mysql_error());
	mysql_query("INSERT INTO areasExperiencia (id_aspirante)
				 VALUES ('". $id ."')") or die(mysql_error());
	mysql_query("INSERT INTO experienciaProfesional (id_aspirante)
				 VALUES ('". $id ."')") or die(mysql_error());
	mysql_query("INSERT INTO experienciaInternacional (id_aspirante)
				 VALUES ('". $id ."')") or die(mysql_error());
	mysql_query("INSERT INTO estudiosProfesionales (id_aspirante)
				 VALUES ('". $id ."')") or die(mysql_error());
	mysql_query("INSERT INTO idiomas (id_aspirante)
				 VALUES ('". $id ."')") or die(mysql_error());
	mysql_query("INSERT INTO informatica (id_aspirante)
				 VALUES ('". $id ."')") or die(mysql_error());
	
	//Enviar mail para que pueda confirmar el usuario registrado:
	$this->enviar($tipo, $nombre, $apellidos, $correo, $pwd, $codigo, $clavesimple);
	
	echo '<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
					setTimeout("top.location.href = \'?F=registro&_f=registrado\'",1000);
					</script>';
	return $echo;
}//registrarProf

# ************************************************************* ENVÍO DE CORREOS PARA ACTIVACIÓN ******************************************************************
# *****************************************************************************************************************************************************************
public function enviar($tipo, $nombre, $apellidos, $correo, $pwd, $codigo, $clavesimple){
	$destinatario = $correo;
	$datos = '';
	$datos .= '<p>Tu registro a OutletMinero.com se ha agregado exitosamente. Ahora tendr&aacute;s que activar tu registro dando clic en la siguiente liga:</p>';
	$datos .= '<p><a href="http://www.outletminero.org/autorizar.php?correo='. utf8_decode($correo) .'&key='. $codigo .'">http://www.outletminero.org/autorizar.php?correo='. $correo .'&key='. $codigo .'</a></p>';
	$datos .= '<p>A continuaci&oacute;n te listamos los datos que ingresaste al momento de tu registro:</p>';
	$datos .= '<b>Nombre:</b> '. utf8_decode($nombre) .' '. utf8_decode($apellidos) .'<br />
				<b>Correo electr&oacute;nico: </b>'. $correo .'<br />
				<b>Clave: </b>'. $clavesimple .'<br />
				<p>Es importante que recuerdes tu contrase&ntilde;a para poder tener acceso a modificar tu curriculum de publicaci&oacute;n en bolsa de trabajo.</p>
				';
	$datos .= 'Este correo es enviado desde formulario de registro del sitio Web: <b><a href="http://www.outletminero.com">www.outletminero.com</a></b>
				<a href="http://www.outletminero.com/" title="OutletMinero.com"><img src="http://www.outletminero.com/imgs/logo_outletminero.jpg" border="0" /></a>';

	require_once('Rmail/Rmail.php');
	$mail = new Rmail();
		$mail->setFrom('Registro <info@outletminero.com>');
		$mail->setSubject('OutletMinero - Registro');
		$mail->setPriority('high');
		$mail->setHTML($datos);
		$result  = $mail->send(array($correo));
}//function enviar


public function registrado(){
	return '<p class="txtTit">Registrado exitosamente</p>
           <blockquote>
             <p class="txtCont"><span class="txtBold">Tu correo ha sido a&ntilde;adido exitosamente</span>. En pocos minutos recibir&aacute;s un correo electr&oacute;nico donde podr&aacute;s activar tu cuenta en la comunidad. En caso de no visualizar el correo de registro en tu bandeja de entrada, verifica tu Bandeja de Correo No Deseado y m&aacute;rcalo como deseado o correo seguro.</p>
             <p class="txtCont">Sigue las instrucciones del correo para que puedas activar tu cuenta. Cualquier duda o inquietud que tengas en cuanto a la activaci&oacute;n de tu cuenta, por favor escribe a <span class="linkCont"><a href="mailto:tic@outletminero.com">tic@outletminero.com</a></span>.</p>
             <p class="txtCont">Al activar tu cuenta podr&aacute;s formar parte de esta comunidad de informaci&oacute;n.</p>
             <p class="txtCont">Agradecemos el tiempo que te has tomado en registrarte.</p>
           </blockquote>';
}//registrado



# ****************************************************** RECUPERAR CLAVES ********************************************************************************************
# *********************************************************************************************************************************************************************
public function recuperarClave(){
	return '<p class="txtTit">Recuperar mi clave de acceso</p>
           <blockquote>
             <p class="txtCont">Para poder restablecer tu clave ingresa tu correo electr&oacute;nico en el siguiente formulario, presiona el bot&oacute;n y se enviar&aacute; a tu correo electr&oacute;nico las instrucciones necesarias para restablecerla.</p>
             <form id="frmRecuperar" name="frmRecuperar" method="post" action="?F=registro&amp;_f=mailRecuperarClave">
                     <table width="100%" border="0" cellspacing="0" cellpadding="10">
                       <tr>
                         <td width="150" class="txtBold">Correo electr&oacute;nico:</td>
                         <td><input name="correo" type="text" class="frmInputM" id="correo" size="50" maxlength="256" /></td>
                       </tr>
                       <tr>
                         <td class="txtBold">&nbsp;</td>
                         <td><input name="button" type="submit" class="frmButtonM" id="button" value="Deseo restablecer mi contrase&ntilde;a" /></td>
                       </tr>
                </table>
              </form>
           </blockquote>
				  
		  <script language="JavaScript" type="text/javascript">
			 var frmvalidator = new Validator("frmRecuperar");
			 frmvalidator.addValidation("correo","req","Ingrese su correo electronico");
			 frmvalidator.addValidation("correo","maxlen=100");
			 frmvalidator.addValidation("correo","email");
		  </script>';
}//recuperarClave


public function mailRecuperarClave(){
	$db = $this->_db();
	$correo = $_POST["correo"];
	$result = mysql_query("SELECT correo, codigo, clave FROM usuariosweb WHERE correo='{$correo}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	if ($row["correo"] != $_POST["correo"]){
		echo '<h2>El correo que ingresaste no se encuentra en la base de datos.</h2>';
		exit();
	}//if

	$destinatario = $_POST["correo"];
	$datos = '';
	$datos .= '<p>Este correo ha sido enviado para que puedas restablecer tu clave de acceso a OutletMinero.com</p>';
	$datos .= '<p>Da clic en este enlace para ingresar al formulario donde podr&aacute;s restablecer tu clave:</p>
				<a href="http://www.outletminero.com/index1.php?F=registro&amp;_f=restablecerClave&amp;correo='. $destinatario .'&amp;codigo='. $row["codigo"] .'">http://www.outletminero.com/index1.php?F=registro&amp;_f=restablecerClave&amp;correo='. $destinatario .'&amp;codigo='. $row["codigo"] .'</a><br /><br />';
	$datos .= 'Este correo es enviado para restablecer clave de acceso del sitio Web: <b><a href="http://www.outletminero.com">www.outletminero.com</a></b>
				Si usted recibi&oacute; este correo por error, inf&oacute;rmenos a <a href="mailto:webmaster@outletminero.com">webmater@outletminero.com</a>';

	$this->setFrom("Outletminero.com - Restablecer clave de acceeso <{$destinatario}>");
	$this->setReturnPath($destinatario);
	$this->setSubject('Restablecer clave de acceso - outletminero.com');

	$this->setHTML($datos);
	$result2 = $this->send(array($destinatario));
	
	echo '<script type="text/javascript">
					setTimeout("alert(\'EL CORREO PARA RESTABLECER TU CLAVE DE ACCESO HA SIDO ENVIADO\');",100); 
					setTimeout("top.location.href = \'?F=registro&_f=mailEnviado\'",1000);
					</script>';
	
}//mailRecuperarClave

public function mailEnviado(){
	return '<p class="txtTit">Correo enviado para recuperar clave</p>
           <blockquote>
             <p class="txtCont">En pocos minutos recibir&aacute;s un correo electr&oacute;nico con las instrucciones para poder restablecer tu clave en la comunidad de OutletMinero. En caso de no visualizar el correo enviado, verifica tu Bandeja de Correo No Deseado y m&aacute;rcalo como correo deseado o correo seguro.</p>
             <p class="txtCont">Sigue las instrucciones del correo para que puedas restablecer tu clave en tu cuenta. Cualquier duda e inquietud que tengas relacionada con recuperar tu clave escr&iacute;benos a <span class="linkCont"><a href="mailto:tic@outletminero.com">tic@outletminero.com</a></span></p>
          </blockquote>';
}//mailEnviado

public function restablecerClave(){
	return '<p class="txtTit">Recuperar mi clave</p>
           <blockquote>
             <p class="txtCont">Ahora deber&aacute;s de confirmar tu contrase&ntilde;a en el siguiente formulario, en cuanto se valide podr&aacute;s hacer nuevamente uso de tu cuenta.</p>
             <form id="form1" name="form1" method="post" action="?F=registro&amp;_f=updateClave">
                     <input name="correo" type="hidden" id="correo" value="'. $_GET["correo"] .'" /> 
                     <input name="codigo" type="hidden" id="codigo" value="'. $_GET["codigo"] .'" /> 
                     <table width="100%" border="0" cellspacing="0" cellpadding="10">
                       <tr>
                         <td width="150" class="txtBold">Correo electr&oacute;nico:</td>
                         <td><span class="txtCont">'. $_GET["correo"] .'</span></td>
                        </tr>
                       <tr>
                         <td class="txtBold">&nbsp;</td>
                         <td class="txtDet">Escribe tu contrase&ntilde;a dos veces para asegurarte que es la contrase&ntilde;a que deseas.</td>
                        </tr>
                       <tr>
                         <td class="txtBold">Nueva contrase&ntilde;a:</td>
                         <td><input name="pwd1" type="password" class="frmInput" id="pwd1" size="50" maxlength="256" /></td>
                        </tr>
                       <tr>
                         <td class="txtBold">Nueva contrase&ntilde;a:</td>
                         <td><input name="pwd2" type="password" class="frmInput" id="pwd2" size="50" maxlength="256" /></td>
                        </tr>
                       <tr>
                         <td class="txtBold">&nbsp;</td>
                         <td><input name="button" type="submit" class="frmButton" id="button" value="Restablecer contrase&ntilde;a" /></td>
                        </tr>
                      </table>
                    </form>
           </blockquote>
           <script language="JavaScript" type="text/javascript">
					 var frmvalidator = new Validator("form1");
					 frmvalidator.addValidation("pwd1","req","Ingrese su clave");
					 frmvalidator.addValidation("pwd2","req","Ingrese su clave nuevamente");
				  </script>';
}//restablecerClave

public function updateClave(){
	if (!isset($_POST["pwd1"]) || !isset($_POST["pwd2"]) || $_POST["pwd1"] != $_POST["pwd2"]){
		echo '<h2>Las claves que ingresaste no coinciden, da clic aqu&iacute; para regresar:</h2>
				<input type=button value="Regresar" onClick="history.go(-1)">';
		exit();
	}//if

	$db = $this->_db();
	$correo = $_POST["correo"];
	$result = mysql_query("SELECT * FROM usuariosweb WHERE correo='{$correo}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	if ($_POST["codigo"] == $row["codigo"]){
		$clave = md5($_POST["pwd1"]);
		$sql = "UPDATE usuariosweb SET clave='$clave' WHERE correo='{$correo}'";
		$result = mysql_query($sql);
		echo '<script type="text/javascript">
					setTimeout("alert(\'TU CLAVE HA SIDO ACTUALIZADA\');",100); 
					setTimeout("top.location.href = \'?F=inicio&_f=main\'",1000);
					</script>';
	} else {
		echo '<h2>El c&oacute;digo de activaci&oacute;n no coincide, no se pudo actualizar la clave</h2><br /><input type=button value="Regresar" onClick="history.go(-1)">';
	}//if
}//updateClave

}//class
?>