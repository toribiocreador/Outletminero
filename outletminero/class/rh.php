<?php
echo (preg_match('/rh.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class rh extends _GLOBAL_{

public function main(){
	$echo = '
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr><td>
	  	<table width="640" border="0" cellspacing="0" cellpadding="10"><tr><td height="80"><img src="../gallery/hr/cursoContratistasB.jpg" alt="" width="640"  border="0" /></td></tr></table>
		</td></tr></table>';
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
	$mail->setFrom('Contacto <info@outletminero.com>');
	$mail->setSubject($asunto);
	$mail->setPriority('high');
	$mail->setHTML($datos);
	$result = $mail->send(array($correo));
	$result = $mail->send(array('info@outletminero.com'));
	
	$echo = '<script type="text/javascript">
					setTimeout("alert(\'SU CORREO HA SIDO ENVIADO\');",100); 
					setTimeout("top.location.href = \'?F=contacto&_f=enviado\'",1000);
					</script>';
	return $echo;
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