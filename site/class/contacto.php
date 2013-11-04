<?php
echo (preg_match('/contacto.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
require_once("captcha-creator.php");

$captcha = new FGCaptchaCreator('scaptcha');



require_once('class/recaptchalib.php');

class contacto extends _GLOBAL_{

public function main(){
	$echo = '<script type="text/javascript" src="js/gen_validatorv31.js"></script>
      <script type="text/javascript" src="js/fg_captcha_validator.js"></script>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr><td>
	<p class="txtTit">Contacto</p>
        <blockquote>
          <p class="txtCont"><img src="imgs/logo_mini.png" width="153" height="40" alt="" /> </p>
          <p class="txtCont">De La Torre No. 101-A,<br />
            Fracc. La Herradura,<br />
            Zacatecas, Zac., M&eacute;xico.</p>
          <p class="txtCont">Tel. +52.492.922.2624 y 492.899.2577<br />
            <span class="linkCont"><a href="mailto:info@outletminero.org">info@outletminero.org</a></span></p>
          <p class="txtCont"><span class="txtBold">Ventas</span><br />
            <span class="linkCont"><a href="mailto:ventas@outletminero.org">ventas@outletminero.org</a></span></p>
          <p class="txtCont"><span class="txtBold">Redacci&oacute;n</span><br />
            <span class="linkCont"><a href="mailto:redaccion@outletminero.org">redaccion@outletminero.org</a></span></p>
          <p class="txtCont"><span class="txtBold">Marketing y Ventas</span><br />
            <span class="linkCont"><a href="mailto:marketing@outletminero.org">marketing@outletminero.org</a></span></p>
          <p class="txtCont"><span class="txtBold">Webmaster</span><br />
            <span class="linkCont"><a href="mailto:tecnologia@outletminero.org">tecnologia@outletminero.org</a></span></p>
          <p class="txtTit">Redes Sociales</p>
          <p class="txtCont"><span class="txtBold">Facebook</span><br />
            <span class="linkCont"><a href="http://www.facebook.com/pages/Outletminero/111838228897928" target="_blank">Outletminero</a></span></p>
          <p class="txtCont"><span class="txtBold">Twitter</span><br />
            <span class="linkCont"><a href="http://www.twitter.com/@outletminero" target="_blank">@Outletminero</a></span></p>
          <p>&nbsp; </p>
        </td>
		<td valign="center">
			<iframe width="562" height="314" frameborder="0" scrolling="yes" marginheight="0" marginwidth="0" src="http://maps.google.com.mx/maps?hl=es&amp;doflg=ptk&amp;ie=UTF8&amp;layer=c&amp;cbll=22.757547,-102.586708&amp;panoid=LrFbjVGXS5hKX8EDQKQy5w&amp;cbp=12,143.35,,0,-6.73&amp;source=embed&amp;ll=22.757328,-102.58671&amp;spn=0.000772,0.001505&amp;z=19&amp;output=svembed"></iframe><br/>
		</td></tr></table>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTC2">
            <tr>
              <td><p class="txtBold1">Escr&iacute;benos</p>
                
				<form id="frmContacto" name="frmContacto" method="post" action="class/verify.php">
                  <table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td width="150" valign="top" class="txtBold">Nombre:</td>
                      <td>
                        <input name="nombre" type="text" class="frmInputM" id="nombre" size="60" maxlength="100" /></td>
                    </tr>
                    <tr>
                      <td valign="top" class="txtBold">Correo:</td>
                      <td><input name="correo" type="text" class="frmInputM" id="correo" size="60" maxlength="255" /></td>
                    </tr>
                    <tr>
                      <td valign="top" class="txtBold">Empresa:</td>
                      <td><input name="empresa" type="text" class="frmInputM" id="empresa" size="60" maxlength="100" /></td>
                    </tr>
                    <tr>
                      <td valign="top" class="txtBold">Asunto:</td>
                      <td><input name="asunto" type="text" class="frmInputM" id="asunto" size="60" maxlength="200" /></td>
                    </tr>
                    <tr>
                      <td valign="top" class="txtBold">Comentarios:</td>
                      <td><textarea name="comentarios" cols="60" rows="8" class="frmInputM" id="comentarios"></textarea></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="submit5" type="submit" class="frmButtonM" id="submit5" value="Enviar Correo" /> <input name="reset" type="reset" class="frmButtonM" id="reset" value="Limpiar formulario" /></td>
                    </tr>
                  </table>'.
                  recaptcha_get_html($this->publickey).'
                </form></td>
            </tr>
          </table>
          <p class="txtCont">&nbsp;</p>
		  </blockquote>
		  <script language="JavaScript" type="text/javascript">
					 var frmvalidator = new Validator("frmContacto");
					 frmvalidator.addValidation("nombre","req","Ingrese su nombre");
					 frmvalidator.addValidation("correo","req","Ingrese su correo electronico");
					 frmvalidator.addValidation("correo","maxlen=100");
					 frmvalidator.addValidation("correo","email");
					 frmvalidator.addValidation("asunto","req","Ingrese el motivo de su correo");
					 frmvalidator.addValidation("comentarios","req","Ingrese sus comentarios");
				  </script>';
	return $echo;
}//main


# ************************************************************* ENVÍO DE CORREOS PARA SOLICITUD DE INFORMACIÓN ******************************************************************
# *****************************************************************************************************************************************************************
public function enviar(){
	if (!isset($_POST["nombre"]) || !isset($_POST["correo"]) || !isset($_POST["asunto"]) || !isset($_POST["comentarios"])) { echo '<h2>No se puede enviar su correo</h2>'; exit(); }//if
	
	$nombre = strip_tags($_POST["nombre"]);
	$correo = strip_tags($_POST["correo"]);
	$empresa = strip_tags($_POST["empresa"]);
	$asunto = strip_tags($_POST["asunto"]);
	$comentarios = strip_tags($_POST["comentarios"]);
	
  echo $_POST["response"].'<br />'.$_POST["challenge"].'<br />';

  /*
	$datos = '';
	$datos .= '<p>Un visitante en la secci&oacute;n de contacto ha enviado un correo electr&oacute;nico, a continuaci&oacute;n sus datos y mensaje:</p>';
	$datos .= '<b>Nombre:</b> '. utf8_decode($nombre) .'<br />
			   <b>Correo electr&oacute;nico: </b>'. utf8_decode($correo) .'<br />
			   <b>Empresa: </b>'. utf8_decode($empresa) .'<br />
			   <b>Comentarios: </b>'. utf8_decode($comentarios) .'<br />
				';
	$datos .= 'Este correo es enviado desde formulario de env&iacute;o de correo electr&oacute;nico v&iacute;a web de la secci&oacute;n de Contacto del sitio web: <b><a href="http://www.outletminero.com">www.outletminero.com</a></b>
				<a href="http://www.outletminero.com/" title="OutletMinero.com"><img src="http://www.outletminero.com/imgs/logo_mini.jpg" border="0" /></a>';

	require_once('Rmail/Rmail.php');
	$mail = new Rmail();
	$mail->setFrom('Contacto <info@outletminero.org>');
	$mail->setSubject($asunto);
	$mail->setPriority('high');
	$mail->setHTML($datos);
	$result = $mail->send(array($correo));
	$result = $mail->send(array('info@outletminero.org'));
	
	$echo = '<script type="text/javascript">
					setTimeout("alert(\'SU CORREO HA SIDO ENVIADO\');",100); 
					setTimeout("top.location.href = \'?F=contacto&_f=enviado\'",1000);
					</script>';
	return $echo;
  */
}//function enviar


public function enviado(){
	return '<p class="txtTit">Contacto</p>
           <blockquote>
             <p class="txtCont"><span class="txtBold">Tu correo ha enviado exitosamente</span>. En pocos minutos recibir&aacute;s un correo electr&oacute;nico como copia de tu env&iacute;o.</p>
             <p class="txtCont">Gracias por tu tiempo en escribirnos a Outlet Minero.</p>
			 <p class="txtCont">Para reportar alg&uacute;n error en el sitio web favor de reportarlo a <span class="linkCont"><a href="mailto:tecnologia@outletminero.com">tecnologia@outletminero.com</a></span>
             <p class="txtCont">Atentamente</p>
			 <p class="txtCont"><a href="http://www.outletminero.com/"><img src="http://www.outletminero.com/imgs/logo_mini.png" border="0" /></a></p>
           </blockquote>';
}//registrado

}//class
?>