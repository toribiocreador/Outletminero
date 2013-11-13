<?php
echo (preg_match('/bolsatrabajo.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class bolsatrabajo extends _GLOBAL_{

# Empresa = 1
# Profesionista = 2

public $giroEmp = array(0 => '== Seleccione un giro ==',
						1 => 'Ambientales',
						2 => 'Asociaciones y Entidades Oficiales',
						3 => 'Energ&iacute;a y Gas',
						4 => 'Maquinaria y Equipo',
						5 => 'Miner&iacute;a',
						6 => 'Pedr&oacute;leo e Hidrocarburos',
						7 => 'Servicios');

public $duracionVac = array(1 => '== Por tiempo indefinido ==',
						2 => 'de 1 a 3 meses',
						3 => 'de 3 a 6 meses',
						4 => 'de 6 a 12 meses',
						5 => 'de 1 a 2 a&ntilde;os',
						6 => 'por tiempo indefinido');

# ****************************************************** FORMULARIOS DE INICIO DE SECCION **************************************************************************
# ******************************************************************************************************************************************************************

public function main(){
	if (!isset($_SESSION["nombre2"]) || !isset($_SESSION["autorizado2"]) || $_SESSION["autorizado2"] != 'SI' || !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ 
		$form1 = (!isset($_GET["frm1"])) ? 'frmRegistro11' : 'frmRegistro1'. $_GET["frm1"];
		return '<p class="txtTit">Bolsa de Trabajo</p>
			<p class="txtCont">Reg&iacute;strate, es f&aacute;cil y r&aacute;pido, llena los siguientes campos y ya estar&aacute;s registrado.</p><br />
          <table width="97%" align="center" border="0" cellpadding="10" cellspacing="0" style="background-color:#FFF">
            <tr>
              <td width="320" valign="top" class="txtCont"><p class="txtBold1">Registrate</p>
				'. $this->$form1().'                
			  </td>
            </tr>
          </table>';
	
	 }//if
	 
}//main

private function frmRegistro11(){	//  Registro de empresas que van a publicar ofertas de trabajo  .......................
	return '<form id="frmRegistroNuevosAspirantes" name="frmRegistroNuevosAspirantes" method="post" action="?F=registro&amp;_f=registrar&amp;id=1">
                <table border="0" cellspacing="0" cellpadding="10">
                  <tr>
                    <td class="txtBold" style="background-color:#EEE">Reg&iacute;strate</td>
                    <td class="linkCont" style="background-color:#D9F0E2"><a href="?F=bolsatrabajo&amp;_f=main&amp;frm1=2">Soy usuario registrado</a></td>
                  </tr>
                </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="10" style="background-color:#EEE">
                    <tr>
                      <td width="70">Nombre:</td>
                      <td>
                        <input name="nombre1" type="text" class="frmInputM" id="nombre1" size="40" maxlength="60" /></td>
                    </tr>
                    <tr>
                      <td>Apellidos:</td>
                      <td><input name="apellidos1" type="text" class="frmInputM" id="apellidos1" size="40" maxlength="255" /></td>
                    </tr>
                    <tr>
                      <td>Correo:</td>
                      <td><input name="correo1" type="text" class="frmInputM" id="correo1" size="40" maxlength="255" /></td>
                    </tr>
                    <tr>
                      <td>Contrase&ntilde;a:</td>
                      <td><input name="pwd1" type="password" class="frmInputM" id="pwd1" size="40" maxlength="60" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="submit1" type="submit" class="frmButtonM" id="submit1" value="Registrarme" /></td>
                    </tr>
                  </table>
                </form>';
}//frmRegistro

private function frmRegistro12(){	// Aspirantes ya registrados .......................
	return '<form id="frmRegistroAspirantes" name="frmRegistroAspirantes" method="post" action="?F=usuarios&amp;_f=validar&amp;id=1">
                <table border="0" cellspacing="0" cellpadding="10">
                  <tr>
                    <td class="linkCont" style="background-color:#D9F0E2"><a href="?F=bolsatrabajo&amp;_f=main&amp;frm1=1">Reg&iacute;strate</a></td>
                    <td class="txtBold" style="background-color:#EEE">Soy usuario registrado</td>
                  </tr>
                </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="10" style="background-color:#EEE">
                    <tr>
                      <td width="70">Usuario:</td>
                      <td>
                        <input name="usuario1" type="text" class="frmInputM" id="usuario1" size="40" maxlength="60" /><br /><span class="txtPP">Ej.micorreo@dominio.com</span></td>
                    </tr>
                    <tr>
                      <td>Contrase&ntilde;a:</td>
                      <td><input name="pwd1" type="password" class="frmInputM" id="pwd1" size="40" maxlength="60" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="submit1" type="submit" class="frmButtonM" id="submit1" value="Iniciar Sesi&oacute;n" /></td>
                    </tr>
                  </table>
                </form>';
}//frmRegistro2

# ****************************************************** PUBLICACIONES DE BOLSA DE TRABAJO **************************************************************************
# ******************************************************************************************************************************************************************
public function adminVacantes(){
	if (!isset($_SESSION["nombre2"]) || !isset($_SESSION["autorizado2"]) || $_SESSION["autorizado2"] != 'SI' || !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	//$nombre = ''; $apellidos = ''; $messenger = ''; $skype = ''; $sitioweb = ''; $direccion = ''; $ciudad = ''; $estado = ''; $pais = ''; $embed = ''; $telefono = '';
	
	$echo = '
		<link rel="stylesheet" href="../css/jquery.ui.all.css">
		<script src="../js/jquery-1.6.2.js"></script>
		<script src="../js/jquery.ui.core.js"></script>
		<script src="../js/jquery.ui.widget.js"></script>
		<script src="../js/jquery.ui.accordion.js"></script>
		<script>
			$(function() {
				$( "#accordion" ).accordion({
					autoHeight: false,
					navigation: true
				});
			});
			</script>
		<p class="txtTit">Vacantes</p>
          <blockquote>
            <p class="txtCont">A continuaci&oacute;n te mostramos tus datos en los cuales podr&aacute;s agregar, ver o modificar directamente si es necesario las vacantes.</p>
          </blockquote>
          <div id="accordion">
				<h3><a href="#">Ver vacantes</a></h3>
				<div>
					 '.$this->seeDelete().'
				</div>
				<h3><a href="#">Agregar nueva vacante</a></h3>
				<div>
					 <form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=agregarVacante">
					  <input name="id" id="id" type="hidden" value="0" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td width="30%" class="txtBold">Titulo:</td>
							<td width="70%"><input name="titulo" type="text" id="titulo" size="49" maxlength="100" value="'. $row["titulo"] .'" class="frmInputQ" /></td>
							</tr>
						  <tr>
							<td class="txtBold">Ubicacion:</td>
							<td><input name="ubicacion" type="text" id="ubicacion" size="49" maxlength="100" value="'. $row["ubicacion"] .'" class="frmInputQ" /></td>
						  </tr>
						 <tr>
							<td class="txtBold">Empleador:</td>
							<td><input name="empleador" type="text" id="empleador" size="49" maxlength="100" value="'. $row["empleador"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Descripci&oacute;n:</td>
							<td><textarea name="descripcion" id="descripcion" cols="100" rows="10" class="frmInputQ" />'. $row["descripcion"] .'</textarea></td>
						  </tr>
						  <tr>
							<td class="txtBold">Funciones:</td>
							<td><textarea name="funciones" id="funciones" cols="100" rows="10" class="frmInputQ" />'. $row["funciones"] .'</textarea></td>
						  </tr>
						  <tr>
							<td class="txtBold">Requisitos:</td>
							<td><textarea name="requisitos" id="requisitos" cols="100" rows="10" class="frmInputQ" />'. $row["requisitos"] .'</textarea></td>
						  </tr>
						  <tr>
							<td class="txtBold">Beneficios:</td>
							<td><textarea name="beneficios" id="beneficios" cols="100" rows="10" class="frmInputQ" />'. $row["beneficios"] .'</textarea></td>
						  </tr>
						  <tr>
							<td class="txtBold">Notas:</td>
							<td><textarea name="notas" id="notas" cols="100" rows="10" class="frmInputQ" />'. $row["notas"] .'</textarea></td>
						  </tr>
						  <tr>
							<td class="txtBold">Contacto:</td>
							<td><input name="contacto" type="text" id="contacto" size="49" maxlength="200" value="'. $row["contacto"] .'" class="frmInputQ" /></td>
						  </tr>				  <tr>
							<td>&nbsp;</td>
							<td><input name="submit2" type="submit" class="frmButtonM" id="submit2" value="Guardar" /></td>
						  </tr>
						</table>
					  </form>
				</div>
			</div>';
	return $echo;
}//misDatosEmp

public function agregarVacante(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	
	$titulo = strip_tags($_POST["titulo"]);
	$ubicacion = strip_tags($_POST["ubicacion"]);
	$empleador = strip_tags($_POST["empleador"]);
	$descripcion = $_POST["descripcion"];
	$funciones = $_POST["funciones"];
	$requisitos = $_POST["requisitos"];
	$beneficios = $_POST["beneficios"];
	$notas = $_POST["notas"];
	$contacto = strip_tags($_POST["contacto"]);
	$activo='1';
	if(isset($_POST["activo"]))
		$activo = '1';
	else
		$activo = '0';
	$db = $this->_db();
	if($_POST["id"]==0){
		mysql_query("INSERT INTO vacante (titulo, ubicacion, empleador, descripcion, funciones, requisitos, beneficios, notas, contacto)
					 VALUES ('". $titulo ."', '". $ubicacion ."', '". $empleador ."', '". $descripcion ."', '". $funciones ."', '". $requisitos ."', '". $beneficios ."', '". $notas ."', '". $contacto ."')") or die(mysql_error());
		$id=mysql_insert_id();
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminVacantes\'",1000);
					</script>';
	}else{
		$sql = "UPDATE vacante SET titulo='$titulo', ubicacion='$ubicacion', empleador='$empleador', descripcion='$descripcion', funciones='$funciones', requisitos='$requisitos', beneficios='$beneficios', notas='$notas', contacto='$contacto', activo='$activo' WHERE id_vacante='{$_POST['id']}'";
		$result = mysql_query($sql);
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminVacantes\'",1000);
					</script>';
	}
	return $echo;
}//actualizarInfoGen

public function addMod(){
	if (!isset($_SESSION["nombre2"]) || !isset($_SESSION["autorizado2"]) || $_SESSION["autorizado2"] != 'SI' || !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	//$nombre = ''; $apellidos = ''; $messenger = ''; $skype = ''; $sitioweb = ''; $direccion = ''; $ciudad = ''; $estado = ''; $pais = ''; $embed = ''; $telefono = '';
	if (isset($_GET["id"]) && $_SESSION["tipo2"] == 2){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM vacante WHERE id_vacante='{$_GET['id']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		if($row["activo"]=='1')
			$activo='<input type="checkbox" name="activo" value="si" checked>';
		else
			$activo='<input type="checkbox" name="activo" value="no">';
	} else {
		return '<script type="text/javascript">
				setTimeout("alert(\'NO TIENES LOS PRIVILEGIOS NECESARIOS\');",100); 
				setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminBolsa\'",1000);
				</script>';
	}//if
	
	$echo = '
		<link rel="stylesheet" href="../css/jquery.ui.all.css">
		<script src="../js/jquery-1.6.2.js"></script>
		<script src="../js/jquery.ui.core.js"></script>
		<script src="../js/jquery.ui.widget.js"></script>
		<script src="../js/jquery.ui.accordion.js"></script>
		<script>
			$(function() {
				$( "#accordion" ).accordion({
					autoHeight: false,
					navigation: true
				});
			});
			</script>
		<p class="txtTit">Vacantes</p>
          <blockquote>
            <p class="txtCont">A continuaci&oacute;n te mostramos los datos los cuales podr&aacute;s modificar directamente si es necesario.</p>
          </blockquote>
          <div id="accordion">
				<h3><a href="#">Aspirantes a la vacante</a></h3>
				<div>'.$this->seeAspirantes($row['id_vacante']).'
				</div>
				<h3><a href="#">Modificar vacante</a></h3>
				<div>
					<form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=agregarVacante">
					   <input name="id" id="id" type="hidden" value="'. $_GET["id"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td width="30%" class="txtBold">Titulo:</td>
							<td width="70%"><input name="titulo" type="text" id="titulo" size="49" maxlength="100" value="'. $row["titulo"] .'" class="frmInputQ" /></td>
							</tr>
						  <tr>
							<td class="txtBold">Ubicacion:</td>
							<td><input name="ubicacion" type="text" id="ubicacion" size="49" maxlength="100" value="'. $row["ubicacion"] .'" class="frmInputQ" /></td>
						  </tr>
						 <tr>
							<td class="txtBold">Empleador:</td>
							<td><input name="empleador" type="text" id="empleador" size="49" maxlength="100" value="'. $row["empleador"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Descripci&oacute;n:</td>
							<td><textarea name="descripcion" id="descripcion" cols="50" rows="10" class="frmInputQ" />'. $row["descripcion"] .'</textarea></td>
						  </tr>
						  <tr>
							<td class="txtBold">Funciones:</td>
							<td><textarea name="funciones" id="funciones" cols="50" rows="10" class="frmInputQ" />'. $row["funciones"] .'</textarea></td>
						  </tr>
						  <tr>
							<td class="txtBold">Requisitos:</td>
							<td><textarea name="requisitos" id="requisitos" cols="50" rows="10" class="frmInputQ" />'. $row["requisitos"] .'</textarea></td>
						  </tr>
						  <tr>
							<td class="txtBold">Beneficios:</td>
							<td><textarea name="beneficios" id="beneficios" cols="50" rows="10" class="frmInputQ" />'. $row["beneficios"] .'</textarea></td>
						  </tr>
						  <tr>
							<td class="txtBold">Notas:</td>
							<td><textarea name="notas" id="notas" cols="50" rows="10" class="frmInputQ" />'. $row["notas"] .'</textarea></td>
						  </tr>
						  <tr>
							<td class="txtBold">Contacto:</td>
							<td><input name="contacto" type="text" id="contacto" size="49" maxlength="200" value="'. $row["contacto"] .'" class="frmInputQ" /></td>
						  </tr>	
						   <tr>
							<td class="txtBold">Activo:</td>
							<td>'.$activo.'</td>
						  </tr>	
						  <tr>
							<td>&nbsp;</td>
							<td><input name="submit2" type="submit" class="frmButtonM" id="submit2" value="Guardar" /></td>
						  </tr>
						</table>
					  </form>
				</div>
			</div>';
	return $echo;
}//addMod

public function ver(){
	if (isset($_GET["id"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM vacante WHERE id_vacante='{$_GET['id']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
	}
	
	$echo = '<table width="100%" border="0" align="center" cellpadding="0">
		  <tr><td><p class="txtTit" style="background:#56988a">'. $row["titulo"] .'</p></td></tr>';
		  if($row["ubicacion"]!='')$echo .= '<tr><td><blockquote><p class="txtBold1">Ubicacion: '. $row["ubicacion"] .'</p></blockquote></td></tr>';
		  if($row["empleador"]!='')$echo .= '<tr><td><blockquote><p class="txtBold1">Empleador: '. $row["empleador"] .'</p></blockquote></td></tr>';
		  if($row["descripcion"]!='')$echo .= '<tr><td style="background:#87c488"><p class="txtBold1">Descripci&oacute;n:</p></td></tr>
		  <tr><td><blockquote><p class="txtBold1">'. $row["descripcion"] .'</p></td></tr>';
		  if($row["funciones"]!='')$echo .= '<tr><td style="background:#87c488"><p class="txtBold1">Funciones:</p></td></tr>
		  <tr><td><blockquote><p class="txtBold1">'. $row["funciones"] .'</p></blockquote></td></tr>';
		  if($row["requisitos"]!='')$echo .= '<tr><td style="background:#87c488"><p class="txtBold1">Requisitos:</p></td></tr>
		  <tr><td><blockquote><p class="txtBold1">'. $row["requisitos"] .'</p></blockquote></td></tr>';
		  if($row["beneficios"]!='')$echo .= '<tr><td style="background:#87c488"><p class="txtBold1">Beneficios:</p></td></tr>
		  <tr><td><blockquote><p class="txtBold1">'. $row["beneficios"] .'</p></blockquote></td></tr>';
		  if($row["notas"]!='')$echo .= '<tr><td style="background:#87c488"><p class="txtBold1">Notas:</p></td></tr>
		  <tr><td><blockquote><p class="txtBold1">'. $row["notas"] .'</p></blockquote></td></tr>';
		  if($row["contacto"]!='')$echo .= '<tr><td style="background:#87c488"><p class="txtBold1">Contacto:</p></td></tr>
		  <tr><td><blockquote><p class="txtBold1">'. $row["contacto"] .'</p></blockquote></td></tr>';
	$echo .= '</table>';
	return $echo;
}//ver

public function seeLista(){
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM vacante WHERE activo=1 ORDER BY id_vacante DESC");
	$echo = '';
	
	//<span class="txtCont2">'. $activo .'</span>
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			if($_SESSION["tipo2"]=="1"){
				$aplicar = '<a href="?F=bolsatrabajo&_f=aspiranteVacante&id_vacante='. $row["id_vacante"] .'"><img src="imgs/img_dot.png" border="0" /></a>';
			}else
				$aplicar = '<a href="?F=bolsatrabajo&amp;_f=main"><img src="imgs/img_dot.png" border="0" /></a>';
			$date =  new DateTime($row["fechaPublicacion"]);
			$fechapub = $this->txtFechaPub(date_format($date, 'Y-m-d'));
			$contenido = substr($row["descripcion"], 0, 330);
			if($row["activo"]=='1')
				$activo='si';
			else
				$activo='no';
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=bolsatrabajo&amp;_f=ver&amp;id='. $row["id_vacante"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7" align="center" class="linkCont">'. $row["titulo"] .'</td>
						<td style="background:#F7F7F7"><span class="txtMiniBck">'. $row["empleador"] .'...</span></td>
						<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $row["ubicacion"] .'</span></td>
						<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $fechapub .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center">'.$aplicar.'</a></td>
					  </tr>';
	}//while
	$content = '<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">T&iacute;tulo</td>
					<td style="background:#E3EEF0" align="center">Empleador</td>
					<td style="background:#E3EEF0" align="center">Ubicaci&oacute;n</td>
					<td style="background:#E3EEF0" align="center" width="130">Publicaci&oacute;n</td>
					<td style="background:#E3EEF0" width="30" align="center">Aplicar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//


public function seeDelete(){
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM vacante ORDER BY id_vacante DESC");
	$echo = '';
	
	//<span class="txtCont2">'. $activo .'</span>
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$date =  new DateTime($row["fechaPublicacion"]);
			$fechapub = $this->txtFechaPub(date_format($date, 'Y-m-d'));
			$contenido = substr($row["descripcion"], 0, 330);
			if($row["activo"]=='1')
				$activo='si';
			else
				$activo='no';
			$db = $this->_db();
			$result2 = mysql_query("SELECT * FROM aspirante_vacante WHERE id_vacante='{$row['id_vacante']}' AND activo=1");
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=bolsatrabajo&amp;_f=addMod&amp;id='. $row["id_vacante"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7" align="center" class="linkCont">'. $row["titulo"] .'</td>
						<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $fechapub .'</span></td>
						<td style="background:#F7F7F7" align="center"><span class="txtMiniBck">'. mysql_num_rows($result2) .'</span></td>
						<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $activo .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="javascript:void(ConfirmDelete(\'?F=bolsatrabajo&amp;_f=delVecante&amp;id='. $row["id_vacante"] .'\'))"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">T&iacute;tulo</td>
					<td style="background:#E3EEF0" align="center" width="130">Publicaci&oacute;n</td>
					<td style="background:#E3EEF0" align="center">Aspirantes</td>
					<td style="background:#E3EEF0" align="center">Activo</td>
					<td style="background:#E3EEF0" width="30" align="center">Eliminar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//

public function seeAspirantes($idV){
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM aspirante_vacante WHERE id_vacante='{$idV}' AND activo=1");
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$idAs = $row["id_aspirante"];
		$db = $this->_db();
		$result2 = mysql_query("SELECT * FROM aspirante WHERE id='{$idAs}'");
		$row2 = mysql_fetch_array($result2, MYSQL_ASSOC);
		$echo .= '<tr>
					<td style="background:#F7F7F7" width="30" align="center"><a href="?F=bolsatrabajo&amp;_f=seeCurriculum&amp;id='. $row["id_vacante"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
					<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $row2["nombre"] .'</span></td>
					<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $row2["apellidos"] .'</span></td>
					<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $row2["estado"] .'</span></td>
					<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $row2["telefonoCel"] .'</span></td>
					<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $row2["correo"] .'</span></td>
				  </tr>';
	}//while
	$content = '<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">Nombre</td>
					<td style="background:#E3EEF0" align="center">Apellidos</td>
					<td style="background:#E3EEF0" align="center">Estado</td>
					<td style="background:#E3EEF0" align="center">Telefono</td>
					<td style="background:#E3EEF0" align="center">Correo</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//

public function delVecante(){
	if (!isset($_GET["id"])){ echo '<h2>No existe identificador de encuesta</h2>'; exit(); }//if
	
	$db=$this->_db();
		
	mysql_query("DELETE FROM vacante WHERE id_vacante='{$_GET['id']}'");
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminVacantes\'",1000);
				</script>';
	return $echo;
}//delete

# ****************************************************** PUBLICACIONES DE BOLSA DE TRABAJO **************************************************************************
# ******************************************************************************************************************************************************************
public function misDatosEmp(){
	if (!isset($_SESSION["nombre2"]) || !isset($_SESSION["autorizado2"]) || $_SESSION["autorizado2"] != 'SI' || !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	//$nombre = ''; $apellidos = ''; $messenger = ''; $skype = ''; $sitioweb = ''; $direccion = ''; $ciudad = ''; $estado = ''; $pais = ''; $embed = ''; $telefono = '';
	if (isset($_SESSION["idusuario2"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM aspirante WHERE id='{$_SESSION['idusuario2']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$fechat = $row["fechaNacimiento"];
		$fechatt = new DateTime($fechat);
		$fecha = date_format($fechatt, 'Y-m-j');
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM empleoDeseado WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row2 = mysql_fetch_array($result, MYSQL_ASSOC);
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM areasExperiencia WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row3 = mysql_fetch_array($result, MYSQL_ASSOC);
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM experienciaProfesional WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row4 = mysql_fetch_array($result, MYSQL_ASSOC);
		$result = mysql_query("SELECT * FROM experienciaInternacional WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row5 = mysql_fetch_array($result, MYSQL_ASSOC);
		$result = mysql_query("SELECT * FROM estudiosProfesionales WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row6 = mysql_fetch_array($result, MYSQL_ASSOC);
		$result = mysql_query("SELECT * FROM idiomas WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row7 = mysql_fetch_array($result, MYSQL_ASSOC);
		$result = mysql_query("SELECT * FROM informatica WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row8 = mysql_fetch_array($result, MYSQL_ASSOC);
		$fechat = $row4["fechaIngreso"];
		$fechatt = new DateTime($fechat);
		$fechaIngreso = date_format($fechatt, 'Y-m-j');
		$fechat = $row4["fechaSalida"];
		$fechatt = new DateTime($fechat);
		$fechaSalida = date_format($fechatt, 'Y-m-j');
	} else {
		echo '<h2>No se puede consultar tu informaci&oacute;n en bolsa de trabajo</h2>'; exit();
	}//if
	
	$echo = '
		<link rel="stylesheet" href="../css/jquery.ui.all.css">
		<script src="../js/jquery-1.6.2.js"></script>
		<script src="../js/jquery.ui.core.js"></script>
		<script src="../js/jquery.ui.widget.js"></script>
		<script src="../js/jquery.ui.accordion.js"></script>
		<script>
			$(function() {
				$( "#accordion" ).accordion({
					autoHeight: false,
					navigation: true
				});
			});
			</script>
		<p class="txtTit">Mi informaci&oacute;n de cuenta</p>
          <blockquote>
            <p class="txtCont">A continuaci&oacute;n te mostramos tus datos los cuales podr&aacute;s modificar directamente si es necesario. Tu cuenta es &uacute;nica, por eso no podr&aacute;s modificar tu correo electr&oacute;nico.</p>
          </blockquote>
          <div id="accordion">
				<h3><a href="#">Informaci&oacute;n General</a></h3>
				<div>
					 <form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizarInfoGen">
					  <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario2"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td width="30%" class="txtBold">Nombre:</td>
							<td width="70%"><input name="nombre" type="text" id="nombre" size="20" maxlength="100" value="'. $row["nombre"] .'" class="frmInputQ" /></td>
							</tr>
						  <tr>
							<td class="txtBold">Apellidos:</td>
							<td><input name="apellidos" type="text" id="nombre2" size="20" maxlength="100" value="'. $row["apellidos"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">G&eacute;nero:</td>
							<td class="txtBold">'. $this->selectGenero() .'</td>
						  </tr>
						  <tr>
							<td class="txtBold">Fecha:</td>
		 					 <td><input name="datepicker2" type="text" id="datepicker2" size="20" maxlength="255" value="'. $fecha .'" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Direcci&oacute;n:</td>
							<td><input name="direccion" type="text" id="nombre7" size="20" maxlength="255" value="'. $row["direccion"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Ciudad:</td>
							<td><input name="ciudad" type="text" id="nombre8" size="20" maxlength="150" value="'. $row["ciudad"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Estado:</td>
							<td><input name="estado" type="text" id="nombre9" size="20" maxlength="100" value="'. $row["estado"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Pa&iacute;s:</td>
							<td class="txtBold">'. $this->selectPaises() .'</td>
						  </tr>
						  <tr>
							<td class="txtBold">Tel&eacute;fono Celular:</td>
							<td><input name="telefonoCel" type="text" id="nombre10" size="20" maxlength="200" value="'. $row["telefonoCel"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Tel&eacute;fono de Casa:</td>
							<td><input name="telefonoCas" type="text" id="nombre10" size="20" maxlength="200" value="'. $row["telefonoCas"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Tel&eacute;fono Oficina:</td>
							<td><input name="telefonoOfi" type="text" id="nombre10" size="20" maxlength="200" value="'. $row["telefonoOfi"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Tel&eacute;fono Padres:</td>
							<td><input name="telefonoPad" type="text" id="nombre10" size="20" maxlength="200" value="'. $row["telefonoPad"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Correo:</td>
							<td class="txtBold">'. $row["correo"] .'</td>
						  </tr>						  <tr>
							<td>&nbsp;</td>
							<td><input name="submit2" type="submit" class="frmButtonM" id="submit2" value="Guardar" /></td>
						  </tr>
						</table>
					  </form>
				</div>
			</div>';
	return $echo;
}//misDatosEmp

public function actualizarInfoGen(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	
	$nombre = strip_tags($_POST["nombre"]);
	$apellidos = strip_tags($_POST["apellidos"]);
	$fechat = $_POST["datepicker2"];
	$fechatt = new DateTime($fechat);
	$fecha = date_format($fechatt, 'Y-m-j H:i:s');
	$genero = strip_tags($_POST["genero"]);
	$direccion = strip_tags($_POST["direccion"]);
	$ciudad = strip_tags($_POST["ciudad"]);
	$estado = strip_tags($_POST["estado"]);
	$pais = strip_tags($_POST["pais"]);
	$telefonoCel = strip_tags($_POST["telefonoCel"]);
	$telefonoCas = strip_tags($_POST["telefonoCas"]);
	$telefonoOfi = strip_tags($_POST["telefonoOfi"]);
	$telefonoPad = strip_tags($_POST["telefonoPad"]);
	
	$db = $this->_db();
	$sql = "UPDATE aspirante SET nombre='$nombre', apellidos='$apellidos', fechaNacimiento='$fecha', genero='$genero', direccion='$direccion', ciudad='$ciudad', estado='$estado', pais='$pais', telefonoCel='$telefonoCel', telefonoCas='$telefonoCas', telefonoOfi='$telefonoOfi', telefonoPad='$telefonoPad' WHERE id='{$_POST['idusuario']}'";
	$result = mysql_query($sql);
	$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=misDatosEmp\'",1000);
					</script>';
	return $echo;
}//actualizarInfoGen

public function actualizarEmpDes(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	
	$reubicarse = strip_tags($_POST["reubicarse"]);
	$sueldoActual = strip_tags($_POST["sueldoActual"]);
	$sueldoDeseado = strip_tags($_POST["sueldoDeseado"]);
	$aguinaldo = strip_tags($_POST["aguinaldo"]);
	$fondoAhorro = strip_tags($_POST["fondoAhorro"]);
	$valesDespensa = strip_tags($_POST["valesDespensa"]);
	$bonoProductividad = strip_tags($_POST["bonoProductividad"]);
	$otro = strip_tags($_POST["otro"]);
	
	$db = $this->_db();
	$sql = "UPDATE empleoDeseado SET reubicarse='$reubicarse', sueldoActual='$sueldoActual', sueldoDeseado='$sueldoDeseado', aguinaldo='$aguinaldo', fondoAhorro='$fondoAhorro', valesDespensa='$valesDespensa', bonoProductividad='$bonoProductividad', otro='$otro' WHERE id_aspirante='{$_POST['idusuario']}'";
	$result = mysql_query($sql);
	$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminCurriculum\'",1000);
					</script>';
	return $echo;
}//actualizarInfoGen

public function actualizarAreExp(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	
	$area = strip_tags($_POST["area"]);
	$puestoDeseado = strip_tags($_POST["puestoDeseado"]);
	$experiencia = strip_tags($_POST["experiencia"]);
	
	$db = $this->_db();
	$sql = "UPDATE areasExperiencia SET area='$area', puestoDeseado='$puestoDeseado', experiencia='$experiencia' WHERE id_aspirante='{$_POST['idusuario']}'";
	$result = mysql_query($sql);
	$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminCurriculum\'",1000);
					</script>';
	return $echo;
}//actualizarInfoGen

public function actualizarExpPro(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	
	$empresa = strip_tags($_POST["empresa"]);
	$giro = strip_tags($_POST["giro"]);
	$puestoDesempenado = strip_tags($_POST["puestoDesempenado"]);
	$fechat = $_POST["datepicker3"];
	$fechatt = new DateTime($fechat);
	$fechaIngreso = date_format($fechatt, 'Y-m-j H:i:s');
	
	$fechat = $_POST["datepicker4"];
	$fechatt = new DateTime($fechat);
	$fechaSalida = date_format($fechatt, 'Y-m-j H:i:s');
	
	$personasCargo = strip_tags($_POST["personasCargo"]);
	$puestoJefeInmediato = strip_tags($_POST["puestoJefeInmediato"]);
	$reportaJefeInmediato = strip_tags($_POST["reportaJefeInmediato"]);
	
	$db = $this->_db();
	$sql = "UPDATE experienciaProfesional SET empresa='$empresa', giro='$giro', fechaIngreso='$fechaIngreso', fechaSalida='$fechaSalida', personasCargo='$personasCargo', puestoJefeInmediato='$puestoJefeInmediato', reportaJefeInmediato='$reportaJefeInmediato' WHERE id_aspirante='{$_POST['idusuario']}'";
	$result = mysql_query($sql);
	$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminCurriculum\'",1000);
					</script>';
	return $echo;
}//actualizarInfoGen

public function actualizarExpInt(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	
	$estudiosExtranjero = strip_tags($_POST["boleana1"]);
	$estudiosExtranjeroEspecifique = strip_tags($_POST["estudiosExtranjeroEspecifique"]);
	$experienciaLaboralExtranjero = strip_tags($_POST["boleana2"]);
	$experienciaLaboralExtranjeroEspecifique = strip_tags($_POST["experienciaLaboralExtranjeroEspecifique"]);
	
	$db = $this->_db();
	$sql = "UPDATE experienciaInternacional SET estudiosExtranjero='$estudiosExtranjero', estudiosExtranjeroEspecifique='$estudiosExtranjeroEspecifique', experienciaLaboralExtranjero='$experienciaLaboralExtranjero', experienciaLaboralExtranjeroEspecifique='$experienciaLaboralExtranjeroEspecifique' WHERE id_aspirante='{$_POST['idusuario']}'";
	$result = mysql_query($sql);
	$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminCurriculum\'",1000);
					</script>';
	return $echo;
}//actualizarInfoGen

public function actualizarEstPro(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	
	$tituloUniversidad = strip_tags($_POST["sc"]);
	$plantelUniversidad = strip_tags($_POST["plantelUniversidad"]);
	$universidadInicio = strip_tags($_POST["universidadInicio"]);
	$universidadFin = strip_tags($_POST["universidadFin"]);
	$tituloPosgrado = strip_tags($_POST["tituloPosgrado"]);
	$plantelPosgrado = strip_tags($_POST["plantelPosgrado"]);
	$posgradoInicio = strip_tags($_POST["posgradoInicio"]);
	$posgradoFin = strip_tags($_POST["posgradoFin"]);
	$tituloMaestria = strip_tags($_POST["tituloMaestria"]);
	$plantelMaestria = strip_tags($_POST["plantelMaestria"]);
	$maestriaInicio = strip_tags($_POST["maestriaInicio"]);
	$maestriaFin = strip_tags($_POST["maestriaFin"]);
	$tituloDoctorado = strip_tags($_POST["tituloDoctorado"]);
	$plantelDoctorado = strip_tags($_POST["plantelDoctorado"]);
	$doctoradoInicio = strip_tags($_POST["doctoradoInicio"]);
	$doctoradoFin = strip_tags($_POST["doctoradoFin"]);
	
	$db = $this->_db();
	$sql = "UPDATE estudiosProfesionales SET tituloUniversidad='$tituloUniversidad', plantelUniversidad='$plantelUniversidad', universidadInicio='$universidadInicio', universidadFin='$universidadFin', tituloPosgrado='$tituloPosgrado', plantelPosgrado='$plantelPosgrado', posgradoInicio='$posgradoInicio', posgradoFin='$posgradoFin', tituloMaestria='$tituloMaestria', plantelMaestria='$plantelMaestria', maestriaInicio='$maestriaInicio', maestriaFin='$maestriaFin', tituloDoctorado='$tituloDoctorado', plantelDoctorado='$plantelDoctorado', doctoradoInicio='$doctoradoInicio', doctoradoFin='$doctoradoFin' WHERE id_aspirante='{$_POST['idusuario']}'";
	$result = mysql_query($sql);
	$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminCurriculum\'",1000);
					</script>';
	return $echo;
}//actualizarInfoGen

public function actualizarIdi(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	
	$espanol = strip_tags($_POST["espanol"]);
	$ingles = strip_tags($_POST["ingles"]);
	$frances = strip_tags($_POST["frances"]);
	$otroNombre = strip_tags($_POST["otroNombre"]);
	$otro = strip_tags($_POST["otro"]);
	
	$db = $this->_db();
	$sql = "UPDATE idiomas SET espanol='$espanol', ingles='$ingles', frances='$frances', otroNombre='$otroNombre', otro='$otro' WHERE id_aspirante='{$_POST['idusuario']}'";
	$result = mysql_query($sql);
	$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminCurriculum\'",1000);
					</script>';
	return $echo;
}//actualizarInfoGen

public function actualizarInfr(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	
	$sistema = strip_tags($_POST["sistema"]);
	$aplicacion = strip_tags($_POST["aplicacion"]);
	$areaAplicacion = strip_tags($_POST["areaAplicacion"]);
	
	$db = $this->_db();
	$sql = "UPDATE informatica SET sistema='$sistema', aplicacion='$aplicacion', areaAplicacion='$areaAplicacion' WHERE id_aspirante='{$_POST['idusuario']}'";
	$result = mysql_query($sql);
	$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminCurriculum\'",1000);
					</script>';
	return $echo;
}//actualizarInfoGen

# **************************************************** ADMINISTRAR EMPRESAS ******************************************************************************
# ********************************************************************************************************************************************************
public function adminEmpresas(){
	return $this->listadoEmpresas() .'<p class="linkCont"><a href="?F=bolsatrabajo&amp;_f=adminEmpresas#here">Agregar nueva empresa</a></p>'. $this->frmAddModEmpresa() .'<p>&nbsp;</p>';
}//adminEmpresas

private function listadoEmpresas(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	$echo = '<p><span class="txtTit">Mis empresas</span></p>';
	$db = $this->_db();	
	$result = mysql_query("SELECT * FROM us_empresas WHERE id_aspirante='{$_SESSION['idusuario2']}' ORDER BY empresa");
	if (mysql_num_rows($result) < 1){
		$echo .= '<blockquote><span class="txtBold">No tiene empresas dadas de alta</span></blockquote>';
	}//if
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$echo .= '<table width="97%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
              <td width="20" valign="top" class="txtCont" style="background-color:#FFF"><a href="?F=bolsatrabajo&amp;_f=adminEmpresas&amp;id='. $row["id"] .'#here"><img src="imgs/img_edit.png" border="0" alt="" /></a></td>
              <td valign="top" class="linkCont" style="background-color:#FFF"><a href="?F=bolsatrabajo&amp;_f=adminEmpresas&amp;id='. $row["id"] .'#here">'. $row["empresa"] .'</a></td>
              <td width="15" valign="top" class="txtCont" style="background-color:#FFF"><a href="javascript:void(ConfirmDelete(\'?F=bolsatrabajo&amp;_f=deleteEmp&amp;id='. $row["id"] .'\'))"><img src="imgs/img_delete.png" alt="" width="15" height="15" border="0" /></a></td>
            </tr>
          </table>
          <span class="txtEsp">&nbsp;<br /></span>';
	}//while
	return $echo;
	mysql_free_result($result);
}//listadoEmpresas

private function listGirosBT($giro){
	$total = count($this->giroEmp);	$echo = '';
	for ($i = 0; $i<$total; $i++){
		$selected = ($giro == $i) ? 'selected="selected" ' : '';
		$echo .= '<option value="'. $i .'" '. $selected .'>'. $this->giroEmp[$i] .'</option>';
	}//for
	return $echo;
}//listGirosBT

private function frmAddModEmpresa(){
	if (isset($_GET["id"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM us_empresas WHERE id='{$_GET['id']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$_GET["id"] = $row["id"];
		$empresa = $row["empresa"];
		$giro = $row["giro"];
		$puesto = $row["puesto"];
		$servprods = $row["servprods"];
		$calle = $row["calle"];
		$numext = $row["numext"];
		$numint = $row["numint"];
		$colonia = $row["colonia"];
		$ciudad = $row["ciudad"];
		$estado = $row["estado"];
		$pais = $row["pais"];
		$telefono = $row["telefono"];
		$correo = $row["correo"];
		$sitioweb = $row["sitioweb"];
		$descripcion = $row["descripcion"];
	} else {
		$_GET["id"] = '0'; $empresa = ''; $giro = '0'; $puesto = ''; $servprods = ''; $calle = ''; $numext = ''; $numint = ''; $colonia = ''; $ciudad = ''; $estado = ''; $pais = ''; $telefono = ''; $correo = ''; $sitioweb = ''; $descripcion = '';
	}//if
	$tit = ($_GET["id"] == '0') ? 'Agregar' : 'Modificar';
	
	$echo = '<a name="here"></a>
		<p class="txtTit">'. $tit .' empresa</p>
          <blockquote class="txtCont">Para agregar una nueva empresa, ingresa la siguiente informaci&oacute;n.</blockquote>
          <form id="frmEmpresa" name="frmEmpresa" method="post" action="?F=bolsatrabajo&amp;_f=addEmpresa">
            <input name="id" id="id" type="hidden" value="'. $_GET["id"] .'" />
            <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" class="tbBackWhite">
              <tr>
                <td colspan="2" valign="top" class="txtBold1">Informaci&oacute;n general de la empresa</td>
                </tr>
              <tr>
                <td width="140" valign="top" class="txtBold">*Nombre de la empresa:</td>
                <td valign="top"><input name="empresa" type="text" id="empresa" size="60" maxlength="255" value="'. $empresa .'" class="frmInputM" /></td>
              </tr>
              <tr>
                <td width="140" valign="top" class="txtBold">*Puesto:</td>
                <td valign="top"><input name="puesto" type="text" id="puesto" size="60" maxlength="100" value="'. $puesto .'" class="frmInputM" />
                  <br />
                  <span class="txtPP">Puesto que ocupa Usted dentro de la empresa.</span></td>
              </tr>
              <tr>
                <td valign="top" class="txtBold">*Giro de la empresa:</td>
                <td valign="top"><select name="giro" id="giro" class="frmInputM">
                  '. $this->listGirosBT($giro) .'
                </select></td>
              </tr>
              <tr>
                <td valign="top" class="txtBold">*Servicios y Productos:</td>
                <td valign="top"><input name="servprods" type="text" id="servprods" size="60" maxlength="100" value="'. $servprods .'" class="frmInputM" />
                  <br />
                  <span class="txtPP">Servicios y productos que oferta separados por comas, Ej. sistemas sustentables, an&aacute;lisis</span></td>
              </tr>
            </table>
            <br />
            <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" class="tbBackWhite">
              <tr>
                <td colspan="2" class="txtBold1">Informaci&oacute;n de contacto con la empresa</td>
                </tr>
              <tr>
                <td width="120" class="txtBold">*Calle:</td>
                <td><input name="calle" type="text" id="calle" size="60" maxlength="255" value="'. $calle . '" class="frmInputM" /></td>
              </tr>
              <tr>
                <td colspan="2" class="txtBold"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="130" class="txtBold">*N&uacute;mero exterior:</td>
                    <td width="100"><input name="numext" type="text" id="numext" size="10" maxlength="10" value="'. $numext .'" class="frmInputM" /></td>
                    <td width="105" class="txtBold">N&uacute;mero interior:</td>
                    <td><input name="numint" type="text" id="numint" size="10" maxlength="10" value="'. $numint .'" class="frmInputM" /></td>
                  </tr>
                </table></td>
                </tr>
              <tr>
                <td class="txtBold">*Colonia:</td>
                <td><input name="colonia" type="text" id="colonia" size="60" maxlength="100" value="'. $colonia .'" class="frmInputM" /></td>
              </tr>
              <tr>
                <td class="txtBold">*Ciudad:</td>
                <td><input name="ciudad" type="text" id="ciudad" size="60" maxlength="150" value="'. $ciudad .'" class="frmInputM" /></td>
              </tr>
              <tr>
                <td class="txtBold">*Estado:</td>
                <td><input name="estado" type="text" id="estado" size="60" maxlength="100" value="'. $estado .'" class="frmInputM" /></td>
              </tr>
              <tr>
                <td class="txtBold">*Pa&iacute;s:</td>
                <td>'. $this->selectPaises() .'</td>
              </tr>
              <tr>
                <td class="txtBold">*Tel&eacute;fono:</td>
                <td><input name="telefono" type="text" id="telefono" size="60" maxlength="200" value="'. $telefono .'" class="frmInputM" />
                  <br />
                  <span class="txtPP">Ej. (lada).(tel&eacute;fono)</span></td>
              </tr>
              <tr>
                <td class="txtBold">*Correo electr&oacute;nico:</td>
                <td><input name="correo" type="text" id="correo" size="60" maxlength="255" value="'. $correo .'" class="frmInputM" /></td>
              </tr>
              <tr>
                <td class="txtBold">Sitio web:</td>
                <td><input name="sitioweb" type="text" id="sitioweb" size="60" maxlength="255" value="'. $sitioweb .'" class="frmInputM" /></td>
              </tr>
			  <tr>
                <td class="txtBold">Descripci&oacute;n:</td>
                <td><textarea name="descripcion" cols="60" rows="5" class="frmInputM" id="descripcion">'. $descripcion .'</textarea></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input name="submit2" type="submit" class="frmButtonM" id="submit2" value="'. $tit .' empresa" />
                  <input name="reset2" type="reset" class="frmButtonM" id="reset2" value="Limpiar formulario" /></td>
              </tr>
            </table>
          </form>
		  
		  <script language="JavaScript" type="text/javascript">
				 var frmvalidator = new Validator("frmEmpresa");
				 frmvalidator.addValidation("empresa","req","Ingrese el nombre de su empresa");
				 frmvalidator.addValidation("puesto","req","Ingrese el puesto que ocupa dentro de la empresa");
				 frmvalidator.addValidation("servprods","req","Ingrese los productos y servicios que ofrece");
				 frmvalidator.addValidation("calle","req","Ingrese la calle de la empresa");
				 frmvalidator.addValidation("numext","req","Ingrese el n\u00FAmero exterior de la empresa");
				 frmvalidator.addValidation("colonia","req","Ingrese la colonia de la empresa");
				 frmvalidator.addValidation("ciudad","req","Ingrese la ciudad de la empresa");
				 frmvalidator.addValidation("estado","req","Ingrese el Estado de la empresa");
				 frmvalidator.addValidation("telefono","req","Ingrese el tel\u00E9fono de la empresa");
				 frmvalidator.addValidation("correo","req","Ingrese su correo electronico");
				 frmvalidator.addValidation("correo","maxlen=100");
				 frmvalidator.addValidation("correo","email");
		  </script>';
	return $echo;
}//frmAddModEmpresa


public function addEmpresa(){
	if(!isset($_POST["id"])){ echo '<h2>No se puede agregar su registro.</h2>'; exit(); }//if
	
	$id_aspirante = $_SESSION["idusuario2"];
	$puesto = strip_tags($_POST["puesto"]);
	$empresa = strip_tags($_POST["empresa"]);
	$giro = strip_tags($_POST["giro"]);
	$servprods = $_POST["servprods"];
	$calle = $_POST["calle"];
	$numext = $_POST["numext"];
	$numint = $_POST["numint"];
	$colonia = $_POST["colonia"];
	$ciudad = $_POST["ciudad"];
	$estado = $_POST["estado"];
	$pais = $_POST["pais"];
	$telefono = $_POST["telefono"];
	$correo = $_POST["correo"];
	$sitioweb = $_POST["sitioweb"];
	$descripcion = $_POST["descripcion"];
	$fechapub = date("Y-m-d");

	$db = $this->_db();
	if ($_POST["id"] == 0){
		mysql_query("INSERT INTO us_empresas (id_aspirante, puesto, empresa, giro, servprods, calle, numext, numint, colonia, ciudad, estado, pais, telefono, correo, sitioweb, descripcion, fechapub)
					VALUES ('". $id_aspirante ."', '". $puesto ."', '". $empresa ."', '". $giro ."', '". $servprods."', '". $calle ."', '". $numext ."', '". $numint ."', '". $colonia ."', '". $ciudad ."', '". $estado ."', '". $pais ."', '". $telefono ."', '". $correo ."', '". $sitioweb ."', '". $descripcion ."', '". $fechapub ."')") or die(mysql_error());
		$id=mysql_insert_id();
		$echo ='<script type="text/javascript">
						setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
						setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminEmpresas\'",1000);
						</script>';
	} else {
		$sql = "UPDATE us_empresas SET puesto='$puesto', empresa='$empresa', giro='$giro', servprods='$servprods', calle='$calle', numext='$numext', numint='$numint', colonia='$colonia', ciudad='$ciudad', estado='$estado', pais='$pais', telefono='$telefono', correo='$correo', sitioweb='$sitioweb', descripcion='$descripcion' WHERE id='{$_POST['id']}'";
		$result = mysql_query($sql);
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminEmpresas&id='. $_POST["id"] .'#here\'",1000);
					</script>';
	}//if
	return $echo;
}//addEmpresa

public function deleteEmp(){
	$db=$this->_db();
	mysql_query("DELETE FROM us_empresas WHERE id='{$_GET['id']}'");
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminEmpresas\'",1000);
				</script>';
	return $echo;
}//deleteEmp

# ******************************************************** ADMINISTRACIÓN DE OFERTAS DE TRABAJO **************************************************************
# ************************************************************************************************************************************************************

public function adminBolsa(){
$echo = '
		<link rel="stylesheet" href="../css/jquery.ui.all.css">
		<script src="../js/jquery-1.6.2.js"></script>
		<script src="../js/jquery.ui.core.js"></script>
		<script src="../js/jquery.ui.widget.js"></script>
		<script src="../js/jquery.ui.accordion.js"></script>
		<script>
			$(function() {
				$( "#accordion" ).accordion({
					autoHeight: false,
					navigation: true
				});
			});
			</script>
		<p class="txtTit">Vacantes</p>
          <blockquote>
            <p class="txtCont">A continuaci&oacute;n te mostramos tus datos en los cuales podr&aacute;s agregar, ver o modificar directamente si es necesario las vacantes.</p>
          </blockquote>
          <div id="accordion">
				<h3><a href="#">Vacantes Aplicadas</a></h3>
				<div>
					 '.$this->seeVacantesAplicadas().'
				</div>
				<h3><a href="#">Buscar Vacante</a></h3>
				<div>
					 '.$this->seeVacante().'
				</div>
			</div>';
	return $echo;
}

public function seeVacantesAplicadas(){
	
	$id_aspirante = strip_tags($_SESSION["idusuario2"]);	
	
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM aspirante_vacante WHERE id_aspirante='$id_aspirante' AND activo=1");
	$echo = '';
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$id_vacante = $row["id_vacante"];
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM vacante WHERE id_vacante='$id_vacante' ORDER BY id_vacante DESC");
		
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$date =  new DateTime($row["fechaPublicacion"]);
				$fechapub = $this->txtFechaPub(date_format($date, 'Y-m-d'));
				$contenido = substr($row["descripcion"], 0, 330);
				if($row["activo"]=='1')
					$activo='si';
				else
					$activo='no';
				$echo .= '<tr>
							<td style="background:#F7F7F7" width="30" align="center"><a href="?F=bolsatrabajo&amp;_f=ver&amp;id='. $row["id_vacante"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
							<td style="background:#F7F7F7" align="center" class="linkCont">'. $row["titulo"] .'</td>
							<td style="background:#F7F7F7"><span class="txtMiniBck">'. strip_tags($contenido) .'...</span></td>
							<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $fechapub .'</span></td>
							<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $activo .'</span></td>
							<td style="background:#F7F7F7" width="30" align="center"><a href="?F=bolsatrabajo&amp;_f=aspiranteVacanteD&amp;id_vacante='.$row["id_vacante"].'"><img src="imgs/img_delete.png" border="0" /></a></td>
						  </tr>';
		}//while
	}
	
	$content = '<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">T&iacute;tulo</td>
					<td style="background:#E3EEF0" align="center">Descripcion</td>
					<td style="background:#E3EEF0" align="center" width="130">Publicaci&oacute;n</td>
					<td style="background:#E3EEF0" align="center">Activo</td>
					<td style="background:#E3EEF0" width="30" align="center">Declinar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//

public function seeVacante(){
	//id_aspirante='$id_aspirante' AND activo=1"
	$id_aspirante = strip_tags($_SESSION["idusuario2"]);
	
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM vacante WHERE activo=1 ORDER BY id_vacante DESC");
	$echo = '';
	
	//<span class="txtCont2">'. $activo .'</span>
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$date =  new DateTime($row["fechaPublicacion"]);
			$fechapub = $this->txtFechaPub(date_format($date, 'Y-m-d'));
			$contenido = substr($row["descripcion"], 0, 330);
			if($row["activo"]=='1')
				$activo='si';
			else
				$activo='no';
			$db = $this->_db();
			$id_vacante = $row["id"];
			$result2 = mysql_query("SELECT * FROM aspirante_vacante WHERE id_aspirante='$id_aspirante' AND id_vacante='$id_vacante' AND activo=1");
			$row2 = mysql_fetch_array($result2, MYSQL_ASSOC);
			if(mysql_num_rows ( $result2 ) == 0)
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=bolsatrabajo&amp;_f=ver&amp;id='. $row["id_vacante"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7" align="center" class="linkCont">'. $row["titulo"] .'</td>
						<td style="background:#F7F7F7"><span class="txtMiniBck">'. strip_tags($contenido) .'...</span></td>
						<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $fechapub .'</span></td>
						<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $activo .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=bolsatrabajo&amp;_f=aspiranteVacante&amp;id_vacante='.$row["id_vacante"].'"><img src="imgs/img_dot.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">T&iacute;tulo</td>
					<td style="background:#E3EEF0" align="center">Descripcion</td>
					<td style="background:#E3EEF0" align="center" width="130">Publicaci&oacute;n</td>
					<td style="background:#E3EEF0" align="center">Activo</td>
					<td style="background:#E3EEF0" width="30" align="center">Aplicar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//

public function aspiranteVacante(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_GET["id_vacante"]) && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	
	$id_aspirante = strip_tags($_SESSION["idusuario2"]);
	$id_vacante = strip_tags($_GET["id_vacante"]);
	
	
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM aspirante_vacante WHERE id_aspirante='$id_aspirante' AND id_vacante='$id_vacante' AND activo=1");
	if( mysql_num_rows($result)!=0 ){
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'YA HAS APLICADO A ESTA VACANTE\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminBolsa\'",1000);
					</script>';
		return $echo;
	}
	
	$db = $this->_db();
	
	mysql_query("INSERT INTO aspirante_vacante (id_aspirante,id_vacante)
				 VALUES ('". $id_aspirante ."', '". $id_vacante ."')") or die(mysql_error());
	$id=mysql_insert_id();
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
				setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminBolsa\'",1000);
				</script>';

	return $echo;
	
}//actualizarInfoGen

public function aspiranteVacanteD(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_GET["id_vacante"]) && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	
	$id_aspirante = strip_tags($_SESSION["idusuario2"]);
	$id_vacante = strip_tags($_GET["id_vacante"]);
	
	$db = $this->_db();
	$sql = "UPDATE aspirante_vacante SET activo='0' WHERE id_vacante='$id_vacante' AND id_aspirante='$id_aspirante'";
	$result = mysql_query($sql);
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'HAS DECLINADO EN ESTA VACANTE\');",100); 
				setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminBolsa\'",1000);
				</script>';
	return $echo;
	
}//actualizarInfoGen

# ******************************************************** ADMINISTRACIÓN DE OFERTAS DE TRABAJO **************************************************************
# ************************************************************************************************************************************************************

public function adminOfertas(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	return $this->listadoOfertas() . $this->frmAddModVacante();
}//publicarOferta


private function listadoOfertas(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	$echo = '<p><span class="txtTit">Mis Ofertas de Trabajo</span></p><p class="linkCont"><a href="?F=bolsatrabajo&amp;_f=adminOfertas#here">Agregar nueva oferta de trabajo</a></p>';
	$db = $this->_db();	
	$result = mysql_query("SELECT * FROM vacante WHERE id_aspirante='{$_SESSION['idusuario2']}'");
	if (mysql_num_rows($result) < 1){
		$echo .= '<blockquote><span class="txtBold">No tiene empresas dadas de alta</span></blockquote>';
	}//if
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$echo .= '<table width="97%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
              <td width="20" valign="top" class="txtCont" style="background-color:#FFF"><a href="?F=bolsatrabajo&amp;_f=adminOfertas&amp;id='. $row["id_vacante"] .'&amp;idempresa='. $row["id_empresa"] .'#here"><img src="imgs/img_edit.png" border="0" alt="" /></a></td>
              <td valign="top" class="linkCont" style="background-color:#FFF"><a href="?F=bolsatrabajo&amp;_f=adminOfertas&amp;id='. $row["id_vacante"] .'&amp;idempresa='. $row["id_empresa"] .'#here">'. $row["titulo"] .'</a></td>
              <td width="15" valign="top" class="txtCont" style="background-color:#FFF"><a href="javascript:void(ConfirmDelete(\'?F=bolsatrabajo&amp;_f=deleteOferta&amp;id='. $row["id_vacante"] .'\'))"><img src="imgs/img_delete.png" alt="" width="15" height="15" border="0" /></a></td>
            </tr>
          </table>
          <span class="txtEsp">&nbsp;<br /></span>';
	}//while
	return $echo;
	mysql_free_result($result);
}//listadoOfertas


public function frmAddModVacante(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	
	$db = $this->_db();	
	$result = mysql_query("SELECT * FROM us_empresas WHERE id_aspirante='{$_SESSION['idusuario2']}' ORDER BY empresa");
	if (mysql_num_rows($result) < 1){	// Si no hay registros .... entonces ....
		$echo .= '<p class="txtBold">No tiene empresas dadas de alta</p><p class="txtCont">Vaya a la secci&oacute;n <span class="linkCont"><a href="?F=bolsatrabajo&amp;_f=adminEmpresas">Administrar Empresas</a></span> y agregue su primera empresa.</p>';
		return $echo;
		exit();
	}//if
	
	$_GET["idempresa"] = (isset($_GET["idempresa"])) ? $_GET["idempresa"]  : '0';
	// Empresas ...............................
	$select = '<select name="empresa" class="frmInputM">';
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$selected = ($row["id"] == $_GET["idempresa"]) ? 'selected="selected" ' : '';
		$select .= '<option '. $selected .'value="'. $row["id"] .'">'. $row["empresa"] .'</option>';
	}//while
	$select .= '</select>';
	// Duracion ...............................
	$selectDuracion = '<select name="duracion" class="frmInputM">';
	$total = count($this->duracionVac);
	for ($i=1; $i<=$total; $i++){
		$selected = ($row["duracion"] == $i) ? 'selected="selected" ' : '';
		$selectDuracion .= '<option '. $selected .'value="'. $i .'">'. $this->duracionVac[$i] .'</option>';
	}//for
	$selectDuracion .= '</select>';
	
	if (isset($_GET["id"])){
		$result = mysql_query("SELECT * FROM vacante WHERE id_vacante='{$_GET['id']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$tit = 'Modificar';
		$titulo = $row["titulo"];
		$descripcion = $row["descripcion"];
		$salario = $row["salario"];
		$vigencia = $row["vigencia"];
		$ciudad = $row["ciudad"];
		$estado = $row["estado"];
		$pais = $row["pais"];
		$telefono = $row["telefono"];
		$correo = $row["correo"];
		$sitioweb = $row["sitioweb"];		
		$contacto = $row["contacto"];
	} else {
		$_GET["id"] = '0';
		$tit = 'Agregar';
		$titulo = '';
		$descripcion = '';
		$salario = '';
		$vigencia = '';
		$ciudad = '';
		$estado = '';
		$pais = '';
		$telefono = '';
		$correo = '';
		$sitioweb = '';
		$contacto = '';
	}//if
	
	$echo = '<p><span class="txtTit">'. $tit .' Oferta de Trabajo</span></p>
		<a name="here">
		<blockquote class="txtCont">Para publicar una oferta de trabajo llena los siguientes campos:</blockquote>
        <form id="frmVacante" name="frmVacante" method="post" action="?F=bolsatrabajo&amp;_f=addVacante">
		  <input name="id" id="id" type="hidden" value="'. $_GET["id"] .'" />
		  <input name="idempresa" id="idempresa" type="hidden" value="'. $_GET["idempresa"] .'" />
            <input type="hidden" id="DPC_FIRST_WEEK_DAY" value="2" />
            <input type="hidden" id="DPC_WEEKEND_DAYS" value="[0,5,6]" />
            <input type="hidden" id="DPC_CALENDAR_OFFSET_X" value="20" />
            <input type="hidden" id="DPC_BUTTON_OFFSET_X" value="10" />
          <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" class="tbBackWhite">
            <tr>
              <td colspan="2" valign="top" class="txtBold1">Empresa que oferta la vacante</td>
            </tr>
            <tr>
              <td width="140" valign="top" class="txtBold">Empresa:</td>
              <td valign="top">'. $select.'</td>
            </tr>
          </table>
          <br />
          <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" class="tbBackWhite">
            <tr>
              <td colspan="2" class="txtBold1">Informaci&oacute;n de la vacante</td>
            </tr>
            <tr>
              <td width="150" valign="top" class="txtBold">T&iacute;tulo del anuncio:</td>
              <td><input name="titulo" type="text" id="titulo" size="60" maxlength="255" class="frmInputM" value="'. $titulo .'" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Descripci&oacute;n de la <br />vacante:</td>
              <td><textarea name="descripcion" cols="50" rows="5" class="frmInputM" id="descripcion">'. $descripcion .'</textarea></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Duraci&oacute;n:</td>
              <td valign="top">'. $selectDuracion .'</td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Salario:</td>
              <td><input type="text" name="salario" id="salario" class="frmInputM" value="'. $salario .'" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Vigencia de publicaci&oacute;n:</td>
              <td><input name="vigencia" type="text" class="frmInputM" id="DPC_calendar1b_YYYY-MM-DD" value="'. $vigencia .'" size="10" maxlength="10" /></td>
            </tr>
          </table>
          <br />
          <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" class="tbBackWhite">  
            <tr>
              <td colspan="2" valign="top" class="txtBold1">Ubicaci&oacute;n de la vacante</td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Ciudad:</td>
              <td><input name="ciudad" type="text" id="ciudad" size="60" maxlength="100" class="frmInputM" value="'. $ciudad .'" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Estado:</td>
              <td><input name="estado" type="text" class="frmInputM" id="estado" size="60" maxlength="100" value="'. $estado .'" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Pa&iacute;s:</td>
              <td>'. $this->selectPaises() .'</td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Tel&eacute;fono:</td>
              <td><input name="telefono" type="text" id="telefono" size="60" maxlength="200" class="frmInputM" value="'. $telefono .'" />
                <br />
                <span class="txtPP">Ej. Lada.Tel&eacute;fono</span></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Correo electr&oacute;nico:</td>
              <td><input name="correo" type="text" id="correo" size="60" maxlength="255" class="frmInputM" value="'. $correo .'" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Sitio web:</td>
              <td><input name="sitioweb" type="text" id="sitioweb" size="60" maxlength="255" class="frmInputM" value="'. $sitioweb .'" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Persona a contactar:</td>
              <td><input name="contacto" size="60" class="frmInputM" id="contacto" value="'. $contacto .'" /></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="submit2" type="submit" class="frmButtonM" id="submit2" value="'. $tit .' Vacante" />
                <input name="reset2" type="reset" class="frmButtonM" id="reset2" value="Limpiar formulario" /></td>
            </tr>
          </table>
        </form>
		<p>&nbsp;</p>
				<script language="JavaScript" type="text/javascript">
					 var frmvalidator = new Validator("frmVacante");
					 frmvalidator.addValidation("titulo","req","Ingrese el t\u00EDtulo");
					 frmvalidator.addValidation("descripcion","req","Ingrese la descripci\u00F3n");
					 frmvalidator.addValidation("salario","req","Ingrese el Salario");
					 frmvalidator.addValidation("vigencia","req","Ingrese la vigencia");
					 frmvalidator.addValidation("ciudad","req","Ingrese la ciudad");
					 frmvalidator.addValidation("estado","req","Ingrese el Estado");
					 frmvalidator.addValidation("telefono","req","Ingrese el telefono");
					 frmvalidator.addValidation("correo","req","Ingrese su correo electronico");
					 frmvalidator.addValidation("correo","maxlen=100");
					 frmvalidator.addValidation("correo","email");
					 frmvalidator.addValidation("contacto","req","Ingrese a la persona de contacto");
				  </script>
        ';
	return $echo;
}//addModVacante


public function addVacante(){
	if(!isset($_POST["id"])){ echo '<h2>No se puede agregar su registro.</h2>'; exit(); }//if
	
	$id_aspirante = $_SESSION["idusuario2"];
	$id_empresa = strip_tags($_POST["empresa"]);
	$empresa = strip_tags($_POST["empresa"]);
	$titulo = strip_tags($_POST["titulo"]);
	$descripcion = strip_tags($_POST["descripcion"]);
	$duracion = strip_tags($_POST["duracion"]);
	$salario = strip_tags($_POST["salario"]);
	$vigencia = strip_tags($_POST["vigencia"]);
	$ciudad = strip_tags($_POST["ciudad"]);
	$estado = strip_tags($_POST["estado"]);
	$pais = strip_tags($_POST["pais"]);
	$telefono = strip_tags($_POST["telefono"]);
	$correo = strip_tags($_POST["correo"]);
	$sitioweb = strip_tags($_POST["sitioweb"]);
	$contacto = strip_tags($_POST["contacto"]);

	$db = $this->_db();
	if ($_POST["id"] == 0){
		mysql_query("INSERT INTO vacante (id_aspirante, id_empresa, titulo, descripcion, duracion, salario, vigencia, ciudad, estado, pais, telefono, correo, sitioweb, contacto)
					VALUES ('". $id_aspirante ."', '". $id_empresa ."', '". $titulo ."', '". $descripcion ."', '". $duracion ."', '". $salario ."', '". $vigencia ."', '". $ciudad ."', '". $estado ."', '". $pais ."', '". $telefono ."', '". $correo ."', '". $sitioweb ."', '". $contacto ."')") or die(mysql_error());
		$id=mysql_insert_id();
		$echo ='<script type="text/javascript">
						setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
						setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminOfertas\'",1000);
						</script>';
	} else {
		$sql = "UPDATE vacante SET id_empresa='$id_empresa', titulo='$titulo', descripcion='$descripcion', duracion='$duracion', salario='$salario', vigencia='$vigencia', ciudad='$ciudad', estado='$estado', pais='$pais', telefono='$telefono', correo='$correo', sitioweb='$sitioweb', telefono='$telefono', correo='$correo', sitioweb='$sitioweb', contacto='$contacto' WHERE id_vacante='{$_POST['id']}'";
		$result = mysql_query($sql);
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminOfertas&id='. $_POST["id"] .'&idempresa='. $_POST["idempresa"] .'#here\'",1000);
					</script>';
	}//if
	return $echo;
}//addVacante


public function deleteOferta(){
	$db=$this->_db();
	mysql_query("DELETE FROM vacante WHERE id_vacante='{$_GET['id']}'");
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminOfertas\'",1000);
				</script>';
	return $echo;
}//deleteOferta

public function seeCurriculum(){			
	if (!isset($_SESSION["nombre2"]) || !isset($_SESSION["autorizado2"]) || $_SESSION["autorizado2"] != 'SI' || !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	//$nombre = ''; $apellidos = ''; $messenger = ''; $skype = ''; $sitioweb = ''; $direccion = ''; $ciudad = ''; $estado = ''; $pais = ''; $embed = ''; $telefono = '';
	if (isset($_GET["id"]) && $_SESSION["tipo2"] == 2){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM aspirante WHERE id='{$_SESSION['idusuario2']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$fechat = $row["fechaNacimiento"];
		$fechatt = new DateTime($fechat);
		$fecha = date_format($fechatt, 'Y-m-j');
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM empleoDeseado WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row2 = mysql_fetch_array($result, MYSQL_ASSOC);
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM areasExperiencia WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row3 = mysql_fetch_array($result, MYSQL_ASSOC);
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM experienciaProfesional WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row4 = mysql_fetch_array($result, MYSQL_ASSOC);
		$result = mysql_query("SELECT * FROM experienciaInternacional WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row5 = mysql_fetch_array($result, MYSQL_ASSOC);
		$result = mysql_query("SELECT * FROM estudiosProfesionales WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row6 = mysql_fetch_array($result, MYSQL_ASSOC);
		$result = mysql_query("SELECT * FROM idiomas WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row7 = mysql_fetch_array($result, MYSQL_ASSOC);
		$result = mysql_query("SELECT * FROM informatica WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row8 = mysql_fetch_array($result, MYSQL_ASSOC);
		$fechat = $row4["fechaIngreso"];
		$fechatt = new DateTime($fechat);
		$fechaIngreso = date_format($fechatt, 'Y-m-j');
		$fechat = $row4["fechaSalida"];
		$fechatt = new DateTime($fechat);
		$fechaSalida = date_format($fechatt, 'Y-m-j');
	} else {
		echo '<h2>No se puede consultar tu informaci&oacute;n en bolsa de trabajo</h2>'; exit();
	}//if
		
	$echo = '
		
		<link rel="stylesheet" href="../css/jquery.ui.all.css">
		<script src="../js/jquery-1.6.2.js"></script>
		<script src="../js/jquery.ui.core.js"></script>
		<script src="../js/jquery.ui.widget.js"></script>
		<script src="../js/jquery.ui.accordion.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.16.custom.min.js"></script>
		<script>
			$(function() {
				$( "#accordion" ).accordion({
					autoHeight: false,
					navigation: true
				});
				
				$.datepicker.regional[\'es\'] = {
					closeText: \'Cerrar\',
					prevText: \'&#x3c;Ant\',
					nextText: \'Sig&#x3e;\',
					currentText: \'Hoy\',
					monthNames: [\'Enero\',\'Febrero\',\'Marzo\',\'Abril\',\'Mayo\',\'Junio\',
					\'Julio\',\'Agosto\',\'Septiembre\',\'Octubre\',\'Noviembre\',\'Diciembre\'],
					monthNamesShort: [\'Ene\',\'Feb\',\'Mar\',\'Abr\',\'May\',\'Jun\',
					\'Jul\',\'Ago\',\'Sep\',\'Oct\',\'Nov\',\'Dic\'],
					dayNames: [\'Domingo\',\'Lunes\',\'Martes\',\'Mi&eacute;rcoles\',\'Jueves\',\'Viernes\',\'S&aacute;bado\'],
					dayNamesShort: [\'Dom\',\'Lun\',\'Mar\',\'Mi&eacute;\',\'Juv\',\'Vie\',\'S&aacute;b\'],
					dayNamesMin: [\'Do\',\'Lu\',\'Ma\',\'Mi\',\'Ju\',\'Vi\',\'S&aacute;\'],
					weekHeader: \'Sm\',
					firstDay: 1,
					isRTL: false,
					showMonthAfterYear: false,
					yearSuffix: \'\'};
					$.datepicker.setDefaults($.datepicker.regional[\'es\']);
					
				$( "#datepicker2" ).datepicker({  
					dayNamesMin: [\'Di\', \'Lu\', \'Ma\', \'Me\', \'Je\', \'Ve\', \'Sa\'],
					dateFormat: \'yy-mm-dd\',
				});
				
				$( "#datepicker3" ).datepicker({  
					dayNamesMin: [\'Di\', \'Lu\', \'Ma\', \'Me\', \'Je\', \'Ve\', \'Sa\'],
					dateFormat: \'yy-mm-dd\',
				});
				
				$( "#datepicker4" ).datepicker({  
					dayNamesMin: [\'Di\', \'Lu\', \'Ma\', \'Me\', \'Je\', \'Ve\', \'Sa\'],
					dateFormat: \'yy-mm-dd\',
				});
					
				$(document).ready(function() {
				   $("#datepicker").datepicker();
				   $("#datepicker2").datepicker();
				 });
			});
			</script>
		<p class="txtTit">Mi Curriculum</p>
          <blockquote>
            <p class="txtCont">A continuaci&oacute;n te mostramos tus datos los cuales podr&aacute;s modificar directamente tu curriculum si es necesario</p>
          </blockquote>
          <div id="accordion">
				<h3><a href="#">Empleo Deseado</a></h3>
				<div>
					 <form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizarEmpDes">
					  <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario2"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td width="30%" class="txtBold">Dispuesto a Reubicarse:</td>
							<td>
							  <input name="reubicarse" type="text" id="reubicarse" size="20" maxlength="100" value="'. $row2["reubicarse"] .'" class="frmInputQ" readonly/></td>
							</tr>
						  <tr>
							<td class="txtBold">Sueldo Actual:</td>
							<td><input name="sueldoActual" type="text" id="sueldoActual" size="20" maxlength="100" value="'. $row2["sueldoActual"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">Sueldo Deseado:</td>
							<td><input name="sueldoDeseado" type="text" id="sueldoDeseado" size="20" maxlength="255" value="'. $row2["sueldoDeseado"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">Aguinaldo:</td>
							<td><input name="aguinaldo" type="text" id="aguinaldo" size="20" maxlength="100" value="'. $row2["aguinaldo"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">Fondo de Ahorro:</td>
							<td><input name="fondoAhorro" type="text" id="fondoAhorro" size="20" maxlength="100" value="'. $row2["fondoAhorro"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">Vales de Despensa:</td>
							<td><input name="valesDespensa" type="text" id="valesDespensa" size="20" maxlength="150" value="'. $row2["valesDespensa"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">Bono de Productividad:</td>
							<td><input name="bonoProductividad" type="text" id="bonoProductividad" size="20" maxlength="100" value="'. $row2["bonoProductividad"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">Otro:</td>
							<td><input name="otro" type="text" id="otro" size="20" maxlength="200" value="'. $row2["otro"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						</table>
					  </form>
				</div>
				<h3><a href="#">Areas de Experiencia</a></h3>
				<div>
					<form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizarAreExp">
					  <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario2"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td width="30%" class="txtBold">Area:</td>
							<td>
							  <input name="area" type="text" id="reubicarse" size="20" maxlength="100" value="'. $row3["area"] .'" class="frmInputQ" readonly/></td>
							</tr>
						  <tr>
							<td class="txtBold">Puesto Deseado:</td>
							<td><input name="puestoDeseado" type="text" id="puestoDeseado" size="20" maxlength="100" value="'. $row3["puestoDeseado"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">A&ntilde;os de Experiencia:</td>
							<td><input name="experiencia" type="text" id="experiencia" size="20" maxlength="255" value="'. $row3["experiencia"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						</table>
					  </form>
				</div>
				<h3><a href="#">Experiencia Profesional</a></h3>
				<div>
					<form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizarExpPro">
					  <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario2"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td width="30%" class="txtBold">Empresa:</td>
							<td>
							  <input name="empresa" type="text" id="empresa" size="20" maxlength="100" value="'. $row4["empresa"] .'" class="frmInputQ" readonly/></td>
							</tr>
						  <tr>
							<td class="txtBold">Giro:</td>
							<td><input name="giro" type="text" id="giro" size="20" maxlength="100" value="'. $row4["giro"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">Puesto Desempenado:</td>
							<td><input name="puestoDesempenado" type="text" id="puestoDesempenado" size="20" maxlength="255" value="'. $row4["puestoDesempenado"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						   <tr>
							<td class="txtBold">Fecha de Ingreso:</td>
		 					 <td><input name="datepicker3" type="text" size="20" maxlength="255" value="'. $fechaIngreso .'" readonly/></td>
						  </tr>
						   <tr>
							<td class="txtBold">Fecha de Salida:</td>
		 					 <td><input name="datepicker4" type="text" size="20" maxlength="255" value="'. $fechaSalida .'" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">Numero de Personas a su Cargo:</td>
							<td><input name="personasCargo" type="text" id="personasCargo" size="20" maxlength="100" value="'. $row4["personasCargo"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">Puesto que desempe&ntilde;a su Jefe Inmediato:</td>
							<td><input name="puestoJefeInmediato" type="text" id="puestoJefeInmediato" size="20" maxlength="100" value="'. $row4["puestoJefeInmediato"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">A quien reporta su Jefe Inmediato:</td>
							<td><input name="reportaJefeInmediato" type="text" id="reportaJefeInmediato" size="20" maxlength="100" value="'. $row4["reportaJefeInmediato"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						</table>
					  </form>
				</div>
				<h3><a href="#">Experiencia Internacional</a></h3>
				<div>
					<form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizarExpInt">
					  <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario2"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td width="30%" class="txtBold">Cuenta con Estudios en el Extranjero:</td>
							<td>'. $this->selectBoleana($row5["estudiosExtranjero"],1) .'</td>
							</tr>
						  <tr>
							<td class="txtBold">Especifique a&ntilde;os de Experiencia:</td>
							<td><input name="estudiosExtranjeroEspecifique" type="text" id="estudiosExtranjeroEspecifique" size="20" maxlength="100" value="'. $row5["estudiosExtranjeroEspecifique"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">Cuenta con Experienci aLaboral en el Extranjero:</td>
							<td>'. $this->selectBoleana($row5["experienciaLaboralExtranjero"],2) .'</td>
						  </tr>
						  <tr>
							<td class="txtBold">Especifique a&ntilde;os de Experiencia:</td>
							<td><input name="experienciaLaboralExtranjeroEspecifique" type="text" id="experienciaLaboralExtranjeroEspecifique" size="20" maxlength="100" value="'. $row5["experienciaLaboralExtranjeroEspecifique"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						</table>
					  </form>
				</div>
				<h3><a href="#">Estudios Profesionales</a></h3>
				<div>
					<form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizarEstPro">
					  <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario2"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td width="30%" class="txtBold">Titulo Universitario:</td>
							<td>
							  '.$this->selectTitUni($row6["tituloUniversidad"]) .'</td>
							</tr>
							<tr>
							<td class="txtBold">Plantel:</td>
							<td>
							  <input name="plantelUniversidad" type="text" id="plantelUniversidad" size="20" maxlength="100" value="'. $row6["plantelUniversidad"] .'" class="frmInputQ" readonly/></td>
							</tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Inicio:</td>
							<td><input name="universidadInicio" type="text" id="universidadInicio" size="20" maxlength="100" value="'. $row6["universidadInicio"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Fin:</td>
							<td><input name="universidadFin" type="text" id="universidadFin" size="20" maxlength="255" value="'. $row6["universidadFin"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
						  	<td class="txtBold">Titulo de Posgrado:</td>
						   <td>
							  <input name="tituloPosgrado" type="text" id="tituloPosgrado" size="20" maxlength="100" value="'. $row6["tituloPosgrado"] .'" class="frmInputQ" readonly/></td>
							</tr>
							<tr>
							<td class="txtBold">Plantel:</td>
							<td>
							  <input name="plantelPosgrado" type="text" id="plantelPosgrado" size="20" maxlength="100" value="'. $row6["plantelPosgrado"] .'" class="frmInputQ" readonly/></td>
							</tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Inicio:</td>
							<td><input name="posgradoInicio" type="text" id="posgradoInicio" size="20" maxlength="100" value="'. $row6["posgradoInicio"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Fin:</td>
							<td><input name="posgradoFin" type="text" id="posgradoFin" size="20" maxlength="255" value="'. $row6["posgradoFin"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
						  <td width="30%" class="txtBold">Titulo de Maestria:</td>
						  <td>
							  <input name="tituloMaestria" type="text" id="tituloMaestria" size="20" maxlength="100" value="'. $row6["tituloMaestria"] .'" class="frmInputQ" readonly/></td>
							</tr>
							<tr>
							<td width="220" class="txtBold">Plantel:</td>
							<td>
							  <input name="plantelMaestria" type="text" id="plantelMaestria" size="20" maxlength="100" value="'. $row6["plantelMaestria"] .'" class="frmInputQ" readonly/></td>
							</tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Inicio:</td>
							<td><input name="maestriaInicio" type="text" id="maestriaInicio" size="20" maxlength="100" value="'. $row6["maestriaInicio"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Fin:</td>
							<td><input name="maestriaFin" type="text" id="maestriaFin" size="20" maxlength="255" value="'. $row6["maestriaFin"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
						  <td class="txtBold">Titulo de Doctorado:</td>
						  <td>
							  <input name="tituloDoctorado" type="text" id="tituloDoctorado" size="20" maxlength="100" value="'. $row6["tituloDoctorado"] .'" class="frmInputQ" readonly/></td>
							</tr>
							<tr>
							<td class="txtBold">Plantel:</td>
							<td>
							  <input name="plantelDoctorado" type="text" id="plantelDoctorado" size="20" maxlength="100" value="'. $row6["plantelDoctorado"] .'" class="frmInputQ" readonly/></td>
							</tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Inicio:</td>
							<td><input name="doctoradoInicio" type="text" id="doctoradoInicio" size="20" maxlength="100" value="'. $row6["doctoradoInicio"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Fin:</td>
							<td><input name="doctoradoFin" type="text" id="doctoradoFin" size="20" maxlength="255" value="'. $row6["doctoradoFin"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						</table>
					  </form>
				</div>
				<h3><a href="#">Idiomas</a></h3>
				<div>
					<form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizarIdi">
					  <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario2"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td width="220" class="txtBold">Espa&ntilde;ol:</td>
							<td>
							  <input name="espanol" type="text" id="espanol" size="20" maxlength="100" value="'. $row7["espanol"] .'" class="frmInputQ" readonly/></td>
							</tr>
							<tr>
							<td width="30%" class="txtBold">Ingles:</td>
							<td>
							  <input name="ingles" type="text" id="ingles" size="20" maxlength="100" value="'. $row7["ingles"] .'" class="frmInputQ" readonly/></td>
							</tr>
						  <tr>
							<td class="txtBold">Frances:</td>
							<td><input name="frances" type="text" id="frances" size="20" maxlength="100" value="'. $row7["frances"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td class="txtBold">Otro Idioma:</td>
							<td><input name="otroNombre" type="text" id="otroNombre" size="20" maxlength="255" value="'. $row7["otroNombre"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
						  	<td class="txtBold"></td>
						   <td>
							  <input name="otro" type="text" id="otro" size="20" maxlength="100" value="'. $row7["otro"] .'" class="frmInputQ" readonly/></td>
							</tr>
						</table>
					  </form>
				</div>
				<h3><a href="#">Inform&aacute;tica</a></h3>
				<div>
					<form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizarInfr">
					  <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario2"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td class="txtBold">Sistema:</td>
							<td><input name="sistema" type="text" id="sistema" size="20" maxlength="100" value="'. $row8["sistema"] .'" class="frmInputQ" readonly/></td>
						  </tr>
						  <tr>
							<td width="30%" class="txtBold">Aplicaci&oacute;n:</td>
							<td>
							  <input name="aplicacion" type="text" id="aplicacion" size="20" maxlength="100" value="'. $row8["aplicacion"] .'" class="frmInputQ" readonly/></td>
							</tr>
							<tr>
							<td class="txtBold">&Aacute;rea de Aplicaci&oacute;n:</td>
							<td>
							  <input name="areaAplicacion" type="text" id="areaAplicacion" size="20" maxlength="100" value="'. $row8["areaAplicacion"] .'" class="frmInputQ" readonly/></td>
							</tr>
						</table>
					  </form>
				</div>
			</div>';
	return $echo;
}//adminCurriculum
# ************************************************************* ADMINISTRACIÓN DE INFORMACIÓN DE ASPIRANTES ******************************************************************
# ****************************************************************************************************************************************************************************
public function adminCurriculum(){			
			if (!isset($_SESSION["nombre2"]) || !isset($_SESSION["autorizado2"]) || $_SESSION["autorizado2"] != 'SI' || !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	//$nombre = ''; $apellidos = ''; $messenger = ''; $skype = ''; $sitioweb = ''; $direccion = ''; $ciudad = ''; $estado = ''; $pais = ''; $embed = ''; $telefono = '';
	if (isset($_SESSION["idusuario2"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM aspirante WHERE id='{$_SESSION['idusuario2']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$fechat = $row["fechaNacimiento"];
		$fechatt = new DateTime($fechat);
		$fecha = date_format($fechatt, 'Y-m-j');
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM empleoDeseado WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row2 = mysql_fetch_array($result, MYSQL_ASSOC);
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM areasExperiencia WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row3 = mysql_fetch_array($result, MYSQL_ASSOC);
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM experienciaProfesional WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row4 = mysql_fetch_array($result, MYSQL_ASSOC);
		$result = mysql_query("SELECT * FROM experienciaInternacional WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row5 = mysql_fetch_array($result, MYSQL_ASSOC);
		$result = mysql_query("SELECT * FROM estudiosProfesionales WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row6 = mysql_fetch_array($result, MYSQL_ASSOC);
		$result = mysql_query("SELECT * FROM idiomas WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row7 = mysql_fetch_array($result, MYSQL_ASSOC);
		$result = mysql_query("SELECT * FROM informatica WHERE id_aspirante='{$_SESSION['idusuario2']}'");
		$row8 = mysql_fetch_array($result, MYSQL_ASSOC);
		$fechat = $row4["fechaIngreso"];
		$fechatt = new DateTime($fechat);
		$fechaIngreso = date_format($fechatt, 'Y-m-j');
		$fechat = $row4["fechaSalida"];
		$fechatt = new DateTime($fechat);
		$fechaSalida = date_format($fechatt, 'Y-m-j');
	} else {
		echo '<h2>No se puede consultar tu informaci&oacute;n en bolsa de trabajo</h2>'; exit();
	}//if
		
	$echo = '
		
		<link rel="stylesheet" href="../css/jquery.ui.all.css">
		<script src="../js/jquery-1.6.2.js"></script>
		<script src="../js/jquery.ui.core.js"></script>
		<script src="../js/jquery.ui.widget.js"></script>
		<script src="../js/jquery.ui.accordion.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.16.custom.min.js"></script>
		<script>
			$(function() {
				$( "#accordion" ).accordion({
					autoHeight: false,
					navigation: true
				});
				
				$.datepicker.regional[\'es\'] = {
					closeText: \'Cerrar\',
					prevText: \'&#x3c;Ant\',
					nextText: \'Sig&#x3e;\',
					currentText: \'Hoy\',
					monthNames: [\'Enero\',\'Febrero\',\'Marzo\',\'Abril\',\'Mayo\',\'Junio\',
					\'Julio\',\'Agosto\',\'Septiembre\',\'Octubre\',\'Noviembre\',\'Diciembre\'],
					monthNamesShort: [\'Ene\',\'Feb\',\'Mar\',\'Abr\',\'May\',\'Jun\',
					\'Jul\',\'Ago\',\'Sep\',\'Oct\',\'Nov\',\'Dic\'],
					dayNames: [\'Domingo\',\'Lunes\',\'Martes\',\'Mi&eacute;rcoles\',\'Jueves\',\'Viernes\',\'S&aacute;bado\'],
					dayNamesShort: [\'Dom\',\'Lun\',\'Mar\',\'Mi&eacute;\',\'Juv\',\'Vie\',\'S&aacute;b\'],
					dayNamesMin: [\'Do\',\'Lu\',\'Ma\',\'Mi\',\'Ju\',\'Vi\',\'S&aacute;\'],
					weekHeader: \'Sm\',
					firstDay: 1,
					isRTL: false,
					showMonthAfterYear: false,
					yearSuffix: \'\'};
					$.datepicker.setDefaults($.datepicker.regional[\'es\']);
					
				$( "#datepicker2" ).datepicker({  
					dayNamesMin: [\'Di\', \'Lu\', \'Ma\', \'Me\', \'Je\', \'Ve\', \'Sa\'],
					dateFormat: \'yy-mm-dd\',
				});
				
				$( "#datepicker3" ).datepicker({  
					dayNamesMin: [\'Di\', \'Lu\', \'Ma\', \'Me\', \'Je\', \'Ve\', \'Sa\'],
					dateFormat: \'yy-mm-dd\',
				});
				
				$( "#datepicker4" ).datepicker({  
					dayNamesMin: [\'Di\', \'Lu\', \'Ma\', \'Me\', \'Je\', \'Ve\', \'Sa\'],
					dateFormat: \'yy-mm-dd\',
				});
					
				$(document).ready(function() {
				   $("#datepicker").datepicker();
				   $("#datepicker2").datepicker();
				 });
			});
			</script>
		<p class="txtTit">Mi Curriculum</p>
          <blockquote>
            <p class="txtCont">A continuaci&oacute;n te mostramos tus datos los cuales podr&aacute;s modificar directamente tu curriculum si es necesario</p>
          </blockquote>
          <div id="accordion">
				<h3><a href="#">Empleo Deseado</a></h3>
				<div>
					 <form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizarEmpDes">
					  <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario2"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td width="30%" class="txtBold">Dispuesto a Reubicarse:</td>
							<td>
							  <input name="reubicarse" type="text" id="reubicarse" size="20" maxlength="100" value="'. $row2["reubicarse"] .'" class="frmInputQ" /></td>
							</tr>
						  <tr>
							<td class="txtBold">Sueldo Actual:</td>
							<td><input name="sueldoActual" type="text" id="sueldoActual" size="20" maxlength="100" value="'. $row2["sueldoActual"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Sueldo Deseado:</td>
							<td><input name="sueldoDeseado" type="text" id="sueldoDeseado" size="20" maxlength="255" value="'. $row2["sueldoDeseado"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Aguinaldo:</td>
							<td><input name="aguinaldo" type="text" id="aguinaldo" size="20" maxlength="100" value="'. $row2["aguinaldo"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Fondo de Ahorro:</td>
							<td><input name="fondoAhorro" type="text" id="fondoAhorro" size="20" maxlength="100" value="'. $row2["fondoAhorro"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Vales de Despensa:</td>
							<td><input name="valesDespensa" type="text" id="valesDespensa" size="20" maxlength="150" value="'. $row2["valesDespensa"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Bono de Productividad:</td>
							<td><input name="bonoProductividad" type="text" id="bonoProductividad" size="20" maxlength="100" value="'. $row2["bonoProductividad"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Otro:</td>
							<td><input name="otro" type="text" id="otro" size="20" maxlength="200" value="'. $row2["otro"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td><input name="submit2" type="submit" class="frmButtonM" id="submit2" value="Guardar" /></td>
						  </tr>
						</table>
					  </form>
				</div>
				<h3><a href="#">Areas de Experiencia</a></h3>
				<div>
					<form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizarAreExp">
					  <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario2"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td width="30%" class="txtBold">Area:</td>
							<td>
							  <input name="area" type="text" id="reubicarse" size="20" maxlength="100" value="'. $row3["area"] .'" class="frmInputQ" /></td>
							</tr>
						  <tr>
							<td class="txtBold">Puesto Deseado:</td>
							<td><input name="puestoDeseado" type="text" id="puestoDeseado" size="20" maxlength="100" value="'. $row3["puestoDeseado"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">A&ntilde;os de Experiencia:</td>
							<td><input name="experiencia" type="text" id="experiencia" size="20" maxlength="255" value="'. $row3["experiencia"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td><input name="submit2" type="submit" class="frmButtonM" id="submit2" value="Guardar" /></td>
						  </tr>
						</table>
					  </form>
				</div>
				<h3><a href="#">Experiencia Profesional</a></h3>
				<div>
					<form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizarExpPro">
					  <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario2"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td width="30%" class="txtBold">Empresa:</td>
							<td>
							  <input name="empresa" type="text" id="empresa" size="20" maxlength="100" value="'. $row4["empresa"] .'" class="frmInputQ" /></td>
							</tr>
						  <tr>
							<td class="txtBold">Giro:</td>
							<td><input name="giro" type="text" id="giro" size="20" maxlength="100" value="'. $row4["giro"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Puesto Desempenado:</td>
							<td><input name="puestoDesempenado" type="text" id="puestoDesempenado" size="20" maxlength="255" value="'. $row4["puestoDesempenado"] .'" class="frmInputQ" /></td>
						  </tr>
						   <tr>
							<td class="txtBold">Fecha de Ingreso:</td>
		 					 <td><input name="datepicker3" type="text" id="datepicker3" size="20" maxlength="255" value="'. $fechaIngreso .'" /></td>
						  </tr>
						   <tr>
							<td class="txtBold">Fecha de Salida:</td>
		 					 <td><input name="datepicker4" type="text" id="datepicker4" size="20" maxlength="255" value="'. $fechaSalida .'" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Numero de Personas a su Cargo:</td>
							<td><input name="personasCargo" type="text" id="personasCargo" size="20" maxlength="100" value="'. $row4["personasCargo"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Puesto que desempe&ntilde;a su Jefe Inmediato:</td>
							<td><input name="puestoJefeInmediato" type="text" id="puestoJefeInmediato" size="20" maxlength="100" value="'. $row4["puestoJefeInmediato"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">A quien reporta su Jefe Inmediato:</td>
							<td><input name="reportaJefeInmediato" type="text" id="reportaJefeInmediato" size="20" maxlength="100" value="'. $row4["reportaJefeInmediato"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td><input name="submit2" type="submit" class="frmButtonM" id="submit2" value="Guardar" /></td>
						  </tr>
						</table>
					  </form>
				</div>
				<h3><a href="#">Experiencia Internacional</a></h3>
				<div>
					<form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizarExpInt">
					  <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario2"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td width="30%" class="txtBold">Cuenta con Estudios en el Extranjero:</td>
							<td>'. $this->selectBoleana($row5["estudiosExtranjero"],1) .'</td>
							</tr>
						  <tr>
							<td class="txtBold">Especifique a&ntilde;os de Experiencia:</td>
							<td><input name="estudiosExtranjeroEspecifique" type="text" id="estudiosExtranjeroEspecifique" size="20" maxlength="100" value="'. $row5["estudiosExtranjeroEspecifique"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Cuenta con Experienci aLaboral en el Extranjero:</td>
							<td>'. $this->selectBoleana($row5["experienciaLaboralExtranjero"],2) .'</td>
						  </tr>
						  <tr>
							<td class="txtBold">Especifique a&ntilde;os de Experiencia:</td>
							<td><input name="experienciaLaboralExtranjeroEspecifique" type="text" id="experienciaLaboralExtranjeroEspecifique" size="20" maxlength="100" value="'. $row5["experienciaLaboralExtranjeroEspecifique"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td><input name="submit2" type="submit" class="frmButtonM" id="submit2" value="Guardar" /></td>
						  </tr>
						</table>
					  </form>
				</div>
				<h3><a href="#">Estudios Profesionales</a></h3>
				<div>
					<form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizarEstPro">
					  <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario2"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td width="30%" class="txtBold">Titulo Universitario:</td>
							<td>
							  '.$this->selectTitUni($row6["tituloUniversidad"]) .'</td>
							</tr>
							<tr>
							<td class="txtBold">Plantel:</td>
							<td>
							  <input name="plantelUniversidad" type="text" id="plantelUniversidad" size="20" maxlength="100" value="'. $row6["plantelUniversidad"] .'" class="frmInputQ" /></td>
							</tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Inicio:</td>
							<td><input name="universidadInicio" type="text" id="universidadInicio" size="20" maxlength="100" value="'. $row6["universidadInicio"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Fin:</td>
							<td><input name="universidadFin" type="text" id="universidadFin" size="20" maxlength="255" value="'. $row6["universidadFin"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
						  	<td class="txtBold">Titulo de Posgrado:</td>
						   <td>
							  <input name="tituloPosgrado" type="text" id="tituloPosgrado" size="20" maxlength="100" value="'. $row6["tituloPosgrado"] .'" class="frmInputQ" /></td>
							</tr>
							<tr>
							<td class="txtBold">Plantel:</td>
							<td>
							  <input name="plantelPosgrado" type="text" id="plantelPosgrado" size="20" maxlength="100" value="'. $row6["plantelPosgrado"] .'" class="frmInputQ" /></td>
							</tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Inicio:</td>
							<td><input name="posgradoInicio" type="text" id="posgradoInicio" size="20" maxlength="100" value="'. $row6["posgradoInicio"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Fin:</td>
							<td><input name="posgradoFin" type="text" id="posgradoFin" size="20" maxlength="255" value="'. $row6["posgradoFin"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
						  <td width="30%" class="txtBold">Titulo de Maestria:</td>
						  <td>
							  <input name="tituloMaestria" type="text" id="tituloMaestria" size="20" maxlength="100" value="'. $row6["tituloMaestria"] .'" class="frmInputQ" /></td>
							</tr>
							<tr>
							<td width="220" class="txtBold">Plantel:</td>
							<td>
							  <input name="plantelMaestria" type="text" id="plantelMaestria" size="20" maxlength="100" value="'. $row6["plantelMaestria"] .'" class="frmInputQ" /></td>
							</tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Inicio:</td>
							<td><input name="maestriaInicio" type="text" id="maestriaInicio" size="20" maxlength="100" value="'. $row6["maestriaInicio"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Fin:</td>
							<td><input name="maestriaFin" type="text" id="maestriaFin" size="20" maxlength="255" value="'. $row6["maestriaFin"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
						  <td class="txtBold">Titulo de Doctorado:</td>
						  <td>
							  <input name="tituloDoctorado" type="text" id="tituloDoctorado" size="20" maxlength="100" value="'. $row6["tituloDoctorado"] .'" class="frmInputQ" /></td>
							</tr>
							<tr>
							<td class="txtBold">Plantel:</td>
							<td>
							  <input name="plantelDoctorado" type="text" id="plantelDoctorado" size="20" maxlength="100" value="'. $row6["plantelDoctorado"] .'" class="frmInputQ" /></td>
							</tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Inicio:</td>
							<td><input name="doctoradoInicio" type="text" id="doctoradoInicio" size="20" maxlength="100" value="'. $row6["doctoradoInicio"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">A&ntilde;o de Fin:</td>
							<td><input name="doctoradoFin" type="text" id="doctoradoFin" size="20" maxlength="255" value="'. $row6["doctoradoFin"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td><input name="submit2" type="submit" class="frmButtonM" id="submit2" value="Guardar" /></td>
						  </tr>
						</table>
					  </form>
				</div>
				<h3><a href="#">Idiomas</a></h3>
				<div>
					<form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizarIdi">
					  <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario2"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td width="220" class="txtBold">Espa&ntilde;ol:</td>
							<td>
							  <input name="espanol" type="text" id="espanol" size="20" maxlength="100" value="'. $row7["espanol"] .'" class="frmInputQ" /></td>
							</tr>
							<tr>
							<td width="30%" class="txtBold">Ingles:</td>
							<td>
							  <input name="ingles" type="text" id="ingles" size="20" maxlength="100" value="'. $row7["ingles"] .'" class="frmInputQ" /></td>
							</tr>
						  <tr>
							<td class="txtBold">Frances:</td>
							<td><input name="frances" type="text" id="frances" size="20" maxlength="100" value="'. $row7["frances"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td class="txtBold">Otro Idioma:</td>
							<td><input name="otroNombre" type="text" id="otroNombre" size="20" maxlength="255" value="'. $row7["otroNombre"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
						  	<td class="txtBold"></td>
						   <td>
							  <input name="otro" type="text" id="otro" size="20" maxlength="100" value="'. $row7["otro"] .'" class="frmInputQ" /></td>
							</tr>
						  <tr>
							<td>&nbsp;</td>
							<td><input name="submit2" type="submit" class="frmButtonM" id="submit2" value="Guardar" /></td>
						  </tr>
						</table>
					  </form>
				</div>
				<h3><a href="#">Inform&aacute;tica</a></h3>
				<div>
					<form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizarInfr">
					  <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario2"] .'" />
						<table width="95%" border="0" align="center" cellpadding="5">
						  <tr>
							<td class="txtBold">Sistema:</td>
							<td><input name="sistema" type="text" id="sistema" size="20" maxlength="100" value="'. $row8["sistema"] .'" class="frmInputQ" /></td>
						  </tr>
						  <tr>
							<td width="30%" class="txtBold">Aplicaci&oacute;n:</td>
							<td>
							  <input name="aplicacion" type="text" id="aplicacion" size="20" maxlength="100" value="'. $row8["aplicacion"] .'" class="frmInputQ" /></td>
							</tr>
							<tr>
							<td class="txtBold">&Aacute;rea de Aplicaci&oacute;n:</td>
							<td>
							  <input name="areaAplicacion" type="text" id="areaAplicacion" size="20" maxlength="100" value="'. $row8["areaAplicacion"] .'" class="frmInputQ" /></td>
							</tr>
						  <tr>
							<td>&nbsp;</td>
							<td><input name="submit2" type="submit" class="frmButtonM" id="submit2" value="Guardar" /></td>
						  </tr>
						</table>
					  </form>
				</div>
			</div>';
	return $echo;
}//adminCurriculum

public function addCurriculum(){
	if (!isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) != "SI" && !isset($_SESSION["id2"]) && $_SESSION["id2"] != session_id()){ header('Location: ?'); exit(); }//if
	if(!isset($_POST["idusuario"])){ echo '<h2>No se puede agregar su registro.</h2>'; exit(); }//if
	
	$id_aspirante = $_SESSION["idusuario2"];
	$titulo = strip_tags($_POST["titulo"]);
	$educacion = strip_tags($_POST["educacion"]);
	$fechanac = strip_tags($_POST["fechanac"]);
	$conducir = strip_tags($_POST["conducir"]);
	$vehiculo = strip_tags($_POST["vehiculo"]);
	$estudios = strip_tags($_POST["estudios"]);
	$titulacion = strip_tags($_POST["titulacion"]);
	$sitlaboral = strip_tags($_POST["sitlaboral"]);
	$disponibilidad = strip_tags($_POST["disponibilidad"]);
	$experiencia = strip_tags($_POST["experiencia"]);
	$ingles = strip_tags($_POST["ingles"]);
	$otrosidiomas = strip_tags($_POST["otrosidiomas"]);
	$edocivil = strip_tags($_POST["edocivil"]);
	$sexo = strip_tags($_POST["sexo"]);
	$nacionalidad = strip_tags($_POST["nacionalidad"]);
	$espectativas = strip_tags($_POST["espectativas"]);
	$tipoempleo = strip_tags($_POST["tipoempleo"]);
	$fechapub = date("Y-m-d");

	$db = $this->_db();
	if ($_POST["idusuario"] == '0'){
		mysql_query("INSERT INTO us_aspirantes (id_aspirante, titulo, educacion, fechanac, conducir, vehiculo, estudios, titulacion, sitlaboral, disponibilidad, experiencia, ingles, otrosidiomas, edocivil, sexo, nacionalidad, espectativas, tipoempleo, fechapub)
					VALUES ('". $id_aspirante ."', '". $titulo ."', '". $educacion ."', '". $fechanac ."', '". $conducir ."', '". $vehiculo ."', '". $estudios ."', '". $titulacion ."', '". $sitlaboral ."', '". $disponibilidad ."', '". $experiencia ."', '". $ingles."', '". $otrosidiomas ."', '". $edocivil ."', '". $sexo ."', '". $nacionalidad ."', '". $espectativas ."', '". $tipoempleo ."', '". $fechapub ."')") or die(mysql_error());
		$id=mysql_insert_id();
		$echo ='<script type="text/javascript">
						setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
						setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminCurriculum\'",1000);
						</script>';
	} else {
		$sql = "UPDATE us_aspirantes SET titulo='$titulo', educacion='$educacion', fechanac='$fechanac', conducir='$conducir', vehiculo='$vehiculo', estudios='$estudios', titulacion='$titulacion', sitlaboral='$sitlaboral', disponibilidad='$disponibilidad', experiencia='$experiencia', ingles='$ingles', otrosidiomas='$otrosidiomas', edocivil='$edocivil', sexo='$sexo', nacionalidad='$nacionalidad', espectativas='$espectativas', tipoempleo='$tipoempleo', fechapub='$fechapub' WHERE id='{$_POST['idusuario']}'";
		$result = mysql_query($sql);
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=adminCurriculum&id='. $_POST["idusuario"] .'#here\'",1000);
					</script>';
	}//if
	return $echo;
	
}//addCurriculum


private function selectConducir($id){
	$items = array(0 => '== Selecciona una opci&oacute;n ==',
				   1 => 'SI',
				   2 => 'NO');
	$total = count ($items);
	$echo = '<select name="conducir" class="frmInputM" id="conducir">';
	for ($i=0; $i<$total; $i++){
		$selected = ($id == $i) ? 'selected="selected" ' : '';
		$echo .= '<option '. $selected .'value="'. $i .'">'. $items[$i] .'</option>';
	}//for
	$echo .= '</select>';
	return $echo;
}//selectConducir

private function selectVehiculo($id){
	$items = array(0 => '== Selecciona una opci&oacute;n ==',
				   1 => 'SI',
				   2 => 'NO');
	$total = count ($items);
	$echo = '<select name="vehiculo" class="frmInputM" id="vehiculo">';
	for ($i=0; $i<$total; $i++){
		$selected = ($id == $i) ? 'selected="selected" ' : '';
		$echo .= '<option '. $selected .'value="'. $i .'">'. $items[$i] .'</option>';
	}//for
	$echo .= '</select>';
	return $echo;
}//selectVehiculo

private function selectEstudios($id){
	$items = array(0 => '== Selecciona una opci&oacute;n ==',
				   1 => 'Educaci&oacute;n B&aacute;sica',
				   2 => 'Educaci&oacute;n Secundaria',
				   3 => 'Formaci&oacute;n Profesional',
				   4 => 'Diploma Universitario',
				   5 => 'Licenciatura Universitaria',
				   6 => 'Maestr&iacute;a &oacute; Posgrado',
				   7 => 'Doctorado');
	$total = count ($items);
	$echo = '<select name="estudios" class="frmInputM" id="estudios">';
	for ($i=0; $i<$total; $i++){
		$selected = ($id == $i) ? 'selected="selected" ' : '';
		$echo .= '<option '. $selected .'value="'. $i .'">'. $items[$i] .'</option>';
	}//for
	$echo .= '</select>';
	return $echo;
}//selectEstudios

private function selectSitLaboral($id){
	$items = array(0 => '== Selecciona una opci&oacute;n ==',
				   1 => 'Sin trabajo',
				   2 => 'Buscando primer empleo',
				   3 => 'Con trabajo permanente',
				   4 => 'Con trabajo temporal',
				   5 => 'Estudiante',
				   6 => 'Haciendo pr&aacute;cticas',
				   7 => 'Autoempleado');
	$total = count ($items);
	$echo = '<select name="sitlaboral" class="frmInputM" id="sitlaboral">';
	for ($i=0; $i<$total; $i++){
		$selected = ($id == $i) ? 'selected="selected" ' : '';
		$echo .= '<option '. $selected .'value="'. $i .'">'. $items[$i] .'</option>';
	}//for
	$echo .= '</select>';
	return $echo;
}//selectSitLaboral

private function selectTitUni($id){
	$areas = array(0 => 'Arte y Dise&ntilde;o',
				   1 => 'Ciencias Agropecuarias',
				   2 => 'Ciencias Contables, Administrativas y Econ&oacute;micas',
				   3 => 'Ciencias de la Educaci&oacute;n',
				   4 => 'Ciencias de la Salud',
				   5 => 'Ciencias Exactas, F&iacute;sicas y Naturales',
				   6 => 'Ciencias Jur&iacute;dicas',
				   7 => 'Ciencias Religiosas',
				   8 => 'Ciencias Sociales y Human&iacute;sticas',
				   9 => 'Ingenier&iacute;as');
	$carreras0 = array(0 => 'Arquitectura',
				   1 => 'Dise&ntilde;o de Interiores',
				   2 => 'Dise&ntilde;o de Modas',
				   3 => 'Dise&ntilde;o Gr&aacute;fico',
				   4 => 'Dise&ntilde;o Industrial',
				   5 => 'M&uacute;sica',
				   6 => 'Arte',
				   7 => 'Urbanismo');
	$carreras1 = array(0 => 'Agronom&iacute;a',
				   1 => 'Ciencias Ambientales',
				   2 => 'M&eacute;dico Veterinario',
				   3 => 'Zootecnista');
	$carreras2 = array(0 => 'Administraci&oacute;n de Empresas',
				   1 => 'Contadur&iacute;a P&uacute;blica y Auditor&iacute;a',
				   2 => 'Comercio Internacional',
				   3 => 'Econom&iacute;a',
				   4 => 'Estad&iacute;stica',
				   5 => 'Mercadotecnia',
				   6 => 'Turismo',
				   7 => 'Finanzas',
				   8 => 'Liderazgo Organizacional');
	$carreras3 = array(0 => 'Pedagog&iacute;a',
				   1 => 'Psicopedagog&iacute;a');
	$carreras4 = array(0 => 'Ciencia y Tecnolog&iacute;a de los Alimentos',
				   1 => 'Medicina',
				   2 => 'Nutrici&oacute;n y Diet&eacute;tica',
				   3 => 'Odontolog&iacute;a',
				   4 => 'Farmacia',
				   5 => 'Actividad f&iacute;sica y del Deporte',
				   6 => 'Enfermer&iacute;a');
	$carreras5 = array(0 => 'F&iacute;sica',
				   1 => 'Geolog&iacute;a',
				   2 => 'Matem&aacute;tica',
				   3 => 'Qu&iacute;mica',
				   4 => 'Astronom&iacute;a',
				   5 => 'Biolog&iacute;a',
				   6 => 'Bioqu&iacute;mico');
	$carreras6 = array(0 => 'Derecho');
	$carreras7 = array(0 => 'Teolog&iacute;a');
	$carreras8 = array(0 => 'Antropolog&iacute;a',
				   1 => 'Arqueolog&iacute;a',
				   2 => 'Bibliotecolog&iacute;a',
				   3 => 'Ciencia Pol&iacute;tica',
				   4 => 'Comunicaci&oacute;n Social',
				   5 => 'Filolog&iacute;a',
				   6 => 'Filosof&iacute;a',
				   7 => 'Geograf&iacute;a',
				   8 => 'Historia',
				   9 => 'Historia del Arte',
				   10 => 'Ling&uuml;&iacute;stica',
				   11 => 'Literatura',
				   12 => 'Periodismo',
				   13 => 'Psicolog&iacute;a',
				   14 => 'Publicidad y Relaciones P&uacute;blicas',
				   15 => 'Administraci&oacute;n de Recursos Humanos',
				   16 => 'Relaciones Internacionales',
				   17 => 'Sociolog&iacute;a',
				   18 => 'Trabajo Social',
				   19 => 'Traducci&oacute;n e Interpretaci&oacute;n');
	$carreras9 = array(0 => 'Ingenier&iacute;a en Petr&oacute;leos',
				   1 => 'Ingenier&iacute;a Civil',
				   2 => 'Ingenier&iacute;a El&eacute;ctrica',
				   3 => 'Ingenier&iacute;a Electr&oacute;nica',
				   4 => 'Ingenier&iacute;a en Agrimensura',
				   5 => 'Ingenier&iacute;a en Sistemas',
				   6 => 'Ingenier&iacute;a en Telecomunicaciones',
				   7 => 'Ingenier&iacute;a Industrial',
				   8 => 'Ingenier&iacute;a Mec&aacute;nica');
	$total = count ($areas);
	$echo = '<select name="sc" id="sc"><option value="0">= Seleccione una Carrera =</option>';
	$count = 1;
	for ($j=0; $j<$total; $j++){
		$echo .='<optgroup label="'.$areas[$j].'">';
		switch($j){
			case 0: $total2 = count ($carreras0); break;
			case 1: $total2 = count ($carreras1); break;
			case 2: $total2 = count ($carreras2); break;
			case 3: $total2 = count ($carreras3); break;
			case 4: $total2 = count ($carreras4); break;
			case 5: $total2 = count ($carreras5); break;
			case 6: $total2 = count ($carreras6); break;
			case 7: $total2 = count ($carreras7); break;
			case 8: $total2 = count ($carreras8); break;
			case 9: $total2 = count ($carreras9); break;
		}
		for ($i=0; $i<$total2; $i++){
			$selected = ($id == $count) ? 'selected="selected" ' : '';
			switch($j){
				case 0: $echo .= '<option '. $selected .'value="'. $count  .'">'. $carreras0[$i] .'</option>'; break;
				case 1: $echo .= '<option '. $selected .'value="'. $count  .'">'. $carreras1[$i] .'</option>'; break;
				case 2: $echo .= '<option '. $selected .'value="'. $count  .'">'. $carreras2[$i] .'</option>'; break;
				case 3: $echo .= '<option '. $selected .'value="'. $count  .'">'. $carreras3[$i] .'</option>'; break;
				case 4: $echo .= '<option '. $selected .'value="'. $count  .'">'. $carreras4[$i] .'</option>'; break;
				case 5: $echo .= '<option '. $selected .'value="'. $count  .'">'. $carreras5[$i] .'</option>'; break;
				case 6: $echo .= '<option '. $selected .'value="'. $count  .'">'. $carreras6[$i] .'</option>'; break;
				case 7: $echo .= '<option '. $selected .'value="'. $count  .'">'. $carreras7[$i] .'</option>'; break;
				case 8: $echo .= '<option '. $selected .'value="'. $count  .'">'. $carreras8[$i] .'</option>'; break;
				case 9: $echo .= '<option '. $selected .'value="'. $count  .'">'. $carreras9[$i] .'</option>'; break;
			}
			$count ++;
		}//for
		$echo .'</optgroup>';
	}//while
	return $echo .'</select>';
}//selectSitLaboral

private function selectDisponibilidad($id){
	$items = array(0 => '== Selecciona una opci&oacute;n ==',
				   1 => 'Inmediata',
				   2 => 'En 1 semana',
				   3 => 'En 2 semanas',
				   4 => 'En 3 semanas',
				   5 => 'En 4 semanas',
				   6 => 'En 5 semanas',
				   7 => 'En 6 semanas',
				   8 => 'En 2 meses',
				   9 => 'En 3 meses',
				   10 => 'En 4 meses',
				   11 => 'En 5 meses',
				   12 => 'Despu&eacute;s de 6 meses');
	$total = count ($items);
	$echo = '<select name="disponibilidad" class="frmInputM" id="disponibilidad">';
	for ($i=0; $i<$total; $i++){
		$selected = ($id == $i) ? 'selected="selected" ' : '';
		$echo .= '<option '. $selected .'value="'. $i .'">'. $items[$i] .'</option>';
	}//for
	$echo .= '</select>';
	return $echo;
}//selectDisponibilidad

private function selectExperiencia($id){
	$items = array(0 => '== Selecciona una opci&oacute;n ==',
				   1 => 'Sin experiencia',
				   2 => 'Estudios reci&eacute;n terminados',
				   3 => 'Pr&aacute;cticas en empresa',
				   4 => '1 a&ntilde;o',
				   5 => '2 a&ntilde;os',
				   6 => '3 a 4 a&ntilde;os',
				   7 => '5 a 10 a&ntilde;os',
				   8 => 'M&aacute;s de 10 a&ntilde;os');
	$total = count ($items);
	$echo = '<select name="experiencia" class="frmInputM" id="experiencia">';
	for ($i=0; $i<$total; $i++){
		$selected = ($id == $i) ? 'selected="selected" ' : '';
		$echo .= '<option '. $selected .'value="'. $i .'">'. $items[$i] .'</option>';
	}//for
	$echo .= '</select>';
	return $echo;
}//selectExperiencia

private function selectIngles($id){
	$items = array(0 => '== Selecciona una opci&oacute;n ==',
				   1 => 'Nada',
				   2 => 'B&aacute;sico',
				   3 => 'Intermedio',
				   4 => 'Alto',
				   5 => 'Muy Alto');
	$total = count ($items);
	$echo = '<select name="ingles" class="frmInputM" id="ingles">';
	for ($i=0; $i<$total; $i++){
		$selected = ($id == $i) ? 'selected="selected" ' : '';
		$echo .= '<option '. $selected .'value="'. $i .'">'. $items[$i] .'</option>';
	}//for
	$echo .= '</select>';
	return $echo;
}//selectIngles

private function selectEdoCivil($id){
	$items = array(0 => '== Selecciona una opci&oacute;n ==',
				   1 => 'Soltero(a)',
				   2 => 'Casado(a)',
				   3 => 'Separado(a)/Divorciado(a)',
				   4 => 'Viudo(a)');
	$total = count ($items);
	$echo = '<select name="edocivil" class="frmInputM" id="edocivil">';
	for ($i=0; $i<$total; $i++){
		$selected = ($id == $i) ? 'selected="selected" ' : '';
		$echo .= '<option '. $selected .'value="'. $i .'">'. $items[$i] .'</option>';
	}//for
	$echo .= '</select>';
	return $echo;
}//selectEdoCivil

private function selectSexo($id){
	$items = array(0 => '== Selecciona una opci&oacute;n ==',
				   1 => 'Hombre',
				   2 => 'Mujer');
	$total = count ($items);
	$echo = '<select name="sexo" class="frmInputM" id="sexo">';
	for ($i=0; $i<$total; $i++){
		$selected = ($id == $i) ? 'selected="selected" ' : '';
		$echo .= '<option '. $selected .'value="'. $i .'">'. $items[$i] .'</option>';
	}//for
	$echo .= '</select>';
	return $echo;
}//selectSexo

private function selectTipoEmpleo($id){
	$items = array(0 => '== Selecciona una opci&oacute;n ==',
				   1 => 'Tiempo completo',
				   2 => 'Por horas',
				   3 => 'Beca / Pr&aacute;cticas profesionales',
				   4 => 'Medio tiempo',
				   5 => 'Temporal',
				   6 => 'Desde casa');
	$total = count ($items);
	$echo = '<select name="tipoempleo" class="frmInputM" id="tipoempleo">';
	for ($i=0; $i<$total; $i++){
		$selected = ($id == $i) ? 'selected="selected" ' : '';
		$echo .= '<option '. $selected .'value="'. $i .'">'. $items[$i] .'</option>';
	}//for
	$echo .= '</select>';
	return $echo;
}//selectTimpoEmpleo


}//class