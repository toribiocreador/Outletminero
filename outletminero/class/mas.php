<?php
echo (preg_match('/mas.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class mas extends _GLOBAL_{
	
	public $limitNot = 7;

public function main(){
	$echo = '<p class="txtTit">M&aacute;s en Outlet Minero</p>
        <p class="txtTit">Calendario de eventos</p>
        <blockquote>
          <p class="txtCont">Te invitamos a que nos compartas informaci&oacute;n sobre tus eventos relacionados con la industria, envi&aacute;ndonos un correo a <span class="linkCont"><a href="mailto:contacto@outletminero.com">contacto@outletminero.com</a></span> y poder publicarlo en nuestro calendario de eventos.</p>
          </blockquote>';
		  	
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM calendario ORDER BY id DESC LIMIT ". $this->limitNot);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$imagen = '';
		if ($row["imagen"] != ''){
			$imagen = '<td width="100" valign="top"><table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs">
                <tr>
                  <td class="txtPP"><img src="'. $row["imagen"] .'" border="0" alt="" />Foto:</td>
                  </tr>
                </table></td>';
		}//if
		$echo .= '<table width="97%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
              '. $imagen .'
              <td valign="top" class="txtCont"><p><span class="txtBold1">'. $row["titulo"] .'</span><br />
                <br />
                <span class="txtBold">Fecha de inicio</span>: '. $this->txtFechaPub($row["fechainicio"]) .'<br />
                <span class="txtBold">Fecha de t&eacute;rmino:</span> '. $this->txtFechaPub($row["fechafin"]) .'<br />
                <span class="txtBold">Horario:</span> '. $row["horario"] .'<br />
                <span class="txtBold">Direcci&oacute;n:</span> '. strip_tags($row["direccion"]) .'<br />
                <span class="txtBold">Ciudad:</span> '. $row["ciudad"] .'<br />
                <span class="txtBold">Estado:</span> '. $row["estado"] .'<br />
                <span class="txtBold">Pa&iacute;s:</span> '. $row["pais"] .'<br />
                <span class="txtBold">Tel&eacute;fonos:</span> '. $row["telefonos"] .'<br />
                <span class="txtBold">Correo: </span><span class="linkCont"><a href="mailto:'. $row["correo"] .'">'. $row["correo"] .'</a></span><br />
                <span class="txtBold">Sitio web:</span> <span class="linkCont"><a href="http://'. $row["sitioweb"] .'">'. $row["sitioweb"] .'</a></span></span></p>
                <p>'. $row["contenido"] .'</p></td>
              </tr>
          </table><br />';
	}//while
	mysql_free_result($result);
	return $echo .'<p class="txtTit">Videos</p>
        <blockquote>
          <p class="txtCont">Comp&aacute;rtenos tus videos de YouTube para publicarlos en nuestro sitio. Env&iacute;anos un correo a <span class="linkCont"><a href="mailto:contacto@outletminero.com">contacto@outletminero.com</a></span>, con el enlace de tu video y as&iacute; lo anexaremos en nuestras publicaciones.</p>
          </blockquote>';
}//main


public function ver(){
	if (!isset($_GET["id"]) || $_GET["id"] == ''){ echo '<h2>No se encuentra el identificador</h2>'; exit(); }//if
	
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM mas WHERE id='{$_GET['id']}'");
	$content = '';
	$row = mysql_fetch_array($result, MYSQL_ASSOC);

	$imagen = (isset($row["imagen"]) && $row["imagen"] != '') ? '<table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs"><tr><td><img src="'. $row["imagen"] .'" alt="" border="0" /><span class="txtPP">Foto: '. $row["pf"] .'</span></td></tr></table>' : '';
	$video = (isset($row["video"]) && $row["video"] != '') ? $row["embed"] : '';
	$contenido = (isset($row["contenido"]) && $row["contenido"] != '') ? '<br /><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">'. $row["contenido"] .'</td></tr></table>' : '';
		
	return '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
          <tr>
            <td class="txtTit">'. $row["titulo"] .'</td>
          </tr>
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont">Publicado el<span class="txtBold"> '. $this->txtFechaPub($row["fechapub"]) .'</span>, En <span class="linkCont"><a href="?F=mas&amp;_f=main">mas y Art&iacute;culos</a></span> por '. $row["autor"] .'</td>
            </tr>
          </table>
          '. $imagen . $contenido . $video .'
         <p class="linkCont"><a href="?F=comentarios&amp;_f=main&amp;tipo=2&amp;id='. $row["id"] .'">Deja tu comentario</a></p>'. $this->showComments('2', $row["id"]);
}//ver

}//class
?>