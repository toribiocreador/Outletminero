<?php
echo (preg_match('/comentarios.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class comentarios extends _GLOBAL_{
	
	public $tabla = array(1 => 'editoriales',
							2 => 'noticias',
							3 => 'entrevistas');
	public $seccion = array(1 => 'Editoriales',
							2 => 'Noticias y Art&iacute;culos',
							3 => 'Entrevistas');

public function main(){
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM ". $this->tabla[$_GET["tipo"]] ." WHERE id='{$_GET['id']}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	if (isset($_SESSION["nombre"]) && isset($_SESSION["autorizado"])) {
		$nombre = '<input name="nombre" type="text" size="60" maxlength="200" readonly="true" class="frmInputM" value="'. $_SESSION["nombre"] .'"/>';
		$idusuario = $_SESSION["idusuario"];
	} else {
		$nombre ='<input name="nombre" type="text" size="60" maxlength="200" class="frmInputM" />';
		$idusuario = '0';
	}//if
	$imagen = (isset($row["imagen"]) && $row["imagen"] != '') ? '<table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs"><tr><td><img src="'. $row["imagen"] .'" alt="" border="0" /><span class="txtPP">Foto: '. $row["pf"] .'</span></td></tr></table>' : '';


	return '<p class="txtTit">D&eacute;janos tu comentario</p>
          <p class="linkCont"></p>
          <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
            <tr>
              <td class="txtTit">'. $row["titulo"] .'</td>
            </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont">Publicado el<span class="txtBold"> '. $this->txtFechaPub($row["fechapub"]) .'</span>, En <span class="linkCont"><a href="?F='. $this->tabla[$_GET["tipo"]] .'&amp;_f=main">'. $this->seccion[$_GET["tipo"]].'</a></span> por '. $row["autor"] .'</td>
            </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
		  	<tr>
				<td class="txtCont">'. $imagen . $row["contenido"] .'</td>
			</tr>
		  </table>
          <br />
		  <form id="frmComentario" name="frmComentario" method="post" action="?F=comentarios&amp;_f=add">
		  	<input type="hidden" name="id_usuario" value="'. $idusuario .'" />
			<input type="hidden" name="seccion" value="'. $_GET["tipo"] .'" />
			<input type="hidden" name="id_publicacion" value="'. $row["id"] .'" />
            <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
              <tr>
                <td width="100" valign="top" class="txtBold">Usuario:</td>
                <td valign="top" class="txtBold1">'. $nombre .'</td>
              </tr>
              <tr>
                <td valign="top" class="txtBold">Comentarios:</td>
                <td valign="top">
                  <textarea name="comentarios" id="comentarios" cols="70" rows="10" class="frmInputM"></textarea></td>
              </tr>
              <tr>
                <td valign="top" class="txtBold">&nbsp;</td>
                <td valign="top"><input name="button3" type="submit" class="frmButtonM" id="button3" value="Publicar comentario" /></td>
              </tr>
            </table>
          </form>
		  <script language="JavaScript" type="text/javascript">
			 var frmvalidator = new Validator("frmComentario");
			 frmvalidator.addValidation("nombre","req","Ingrese su nombre");
			 frmvalidator.addValidation("comentarios","req","Ingrese su correo electronico");
		  </script>';
}//main

public function add(){
	if (!isset($_POST["comentarios"]) || $_POST["comentarios"] == ''){ echo '<h2>No se puede publicar su comentario.</h2>'; exit(); }//if
	
	$seccion = $_POST["seccion"];
	$id_publicacion = $_POST["id_publicacion"];
	$id_usuario = $_POST["id_usuario"];
	$usuario = $_POST["nombre"];
	$comentario = $_POST["comentarios"];
	$fechapub = date("Y-m-d");
	
	$db = $this->_db();
	mysql_query("INSERT INTO comentarios (seccion, id_publicacion, id_usuario, usuario, comentario, fechapub)
					VALUES ('". $seccion ."', '". $id_publicacion ."', '". $id_usuario ."', '". $usuario ."', '". $comentario ."', '". $fechapub ."')") or die(mysql_error());
	$id=mysql_insert_id();
	$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
					setTimeout("top.location.href = \'?F='. $this->tabla[$seccion].'&_f=ver&id='. $id_publicacion .'\'",1000);
					</script>';
	$this->enviar($seccion,$usuario,$comentario,$fechapu);
	return $echo;
	
}//ver

# ************************************************************* ENVÍO DE CORREOS PARA SOLICITUD DE INFORMACIÓN ******************************************************************
# *****************************************************************************************************************************************************************
private function enviar($seccion,$usuario,$comentario,$fechapu){

	//seccion 2 es noticias, seccion 3 es, 1 es editorial y 3 es entrevistas
	$apartado='';
	if($seccion=='1')
		$apartado='noticias';
	else if($seccion=='2')
		$apartado='editoria';
	else
		$apartado='entrevistas';

	$datos = '';
	$datos .= '<p>Te informamos que se a ingresado un comentado en el apartado de '.$apartado.' en la decha '.$fechapu.' por el usuario '.usuario.'.</p>';
	$datos .= '<p>Comentario:</p>';
	$datos .= '<b>'.utf8_decode($comentario).'</b>';
	$datos .= '<p></p>Este correo es enviado desde formulario de env&iacute;o de correo electr&oacute;nico v&iacute;a web de la secci&oacute;n de Proveedores del sitio web: <b><a href="http://www.outletminero.com">www.outletminero.com</a></b>
				<a href="http://www.outletminero.com/" title="OutletMinero.com"><img src="http://www.outletminero.com/imgs/logo_mini.jpg" border="0" /></a>';

	require_once('Rmail/Rmail.php');
	$mail = new Rmail();
	$mail->setFrom('OutletMinero <info@outletminero.com>');
	$mail->setSubject('OutletMinero - Nuevo comentario en el apartado '.$apartado);
	$mail->setPriority('high');
	$mail->setHTML($datos);
	$result = $mail->send(array($correo));
	$result = $mail->send(array('info@outletminero.org'));
}//function enviar

}//class
?>