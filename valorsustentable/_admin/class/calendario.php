<?php
echo (preg_match('/calendario.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class calendario extends _GLOBAL_{

public function addMod(){
	if (isset($_GET["id"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM calendar_micro WHERE id='{$_GET['id']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$titulo = $row["titulo"];
		$fechat = $row["fecha"];
		$fechatt = new DateTime($fechat);
		$fecha = date_format($fechatt, 'Y-m-j');
		$hora = $row["hora"];
		$lugar = $row["lugar"];
	} else {
		$_GET["id"] = '0';
		$titulo = '';
		$fecha = '';
		$hora = '';
		$lugar = '';
	}//if
	
	return '
	<!-- DATAPICKER -->
		<link type="text/css" href="../css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="../js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript">
			$(function(){
				

				// Datepicker
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
					dateFormat: \'yy-mm-dd\',
					firstDay: 1,
					isRTL: false,
					showMonthAfterYear: false,
					yearSuffix: \'\'};
				$.datepicker.setDefaults($.datepicker.regional[\'es\']);
				
				$( "#datepicker" ).datepicker({ 
					minDate: -0, 
					//maxDate: "+1M", 
					dayNamesMin: [\'Di\', \'Lu\', \'Ma\', \'Me\', \'Je\', \'Ve\', \'Sa\']
				});
				
				$(document).ready(function() {
					$(\'#txtFechaLaborables\').datepicker({
						 minDate: -0,
						 beforeShowDay: function (day) { 
						   var day = day.getDay(); 
						   if (day == 0) { 
							 return [false, "somecssclass"] 
						   } else { 
							 return [true, "someothercssclass"] 
						   } 
						 }           
					});         
				  });
				
			});
		</script>
<!-- DATAPICKER -->
<p class="txtTitles">Agregar actividad o evento en Calendario</p>
<p class="txtCont1">Ingrese los datos que se solicitan a continuaci&oacute;n para agregar un evento o actividad, los cuales se mostrar&aacute;n los pr&oacute;ximos a seguir en el sitio web.</p>
<p class="txtCont1">&nbsp;</p>

	<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=calendario&amp;_f=addEvento">
	  <input type="hidden" name="id" value="'. $_GET["id"] .'" />
	  <table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
		  <td valign="top" class="txtCont2" width="150">T&iacute;tulo:</td>
		  <td valign="top"><input name="titulo" type="text" id="titulo" size="60" maxlength="256" value="'. $titulo .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2" width="150">Fecha:</td>
		  <td valign="top"><input name="datepicker" type="text" id="datepicker" size="60" maxlength="255" value="'. $fecha .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2" width="150">Hora:</td>
		  <td valign="top"><input name="hora" type="text" id="hora" size="60" maxlength="40" value="'. $hora .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2" width="150">Lugar:</td>
		  <td valign="top"><input name="lugar" type="text" id="lugar" size="60" maxlength="40" value="'. $lugar .'" /></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2">&nbsp;</td>
		  <td valign="top"><input name="enviar3" type="submit" class="frmBtnIngresar" id="enviar3" value="Agregar-Modificar" /></td>
		</tr>
	  </table>
	</form>
		<script language="JavaScript" type="text/javascript">
		 var frmvalidator = new Validator("form");
		 frmvalidator.addValidation("titulo","req","Ingrese el titulo de la publicacion");
		 frmvalidator.addValidation("lugar","req","Ingrese la fecha de inicio de su evento");
		 frmvalidator.addValidation("fecha","req","Ingrese la fecha de finalizacion de su evento");
	  </script>
';
}//addMod


public function addEvento(){
	if(!isset($_POST["titulo"])){ echo '<h2>No se puede agregar su publicaci&oacute;n.</h2>'; exit(); }//if
	$id=$_SESSION["idusuario"];
	$titulo = strip_tags($_POST["titulo"]);
	$fechat = $_POST["datepicker"];
	$hora = $_POST["hora"];
	$lugar = $_POST["lugar"];
	//$fecha = date_format(DateTime::createFromFormat('Y-m-j', '2011-11-17 10:00:00'), 'Y-m-j H:i:s');
	//$hora = DateTime::createFromFormat('Y-m-j H:i:s', $fechat.' 10:0:0');
	$fechatt = new DateTime($fechat);
	$fecha = date_format($fechatt, 'Y-m-j H:i:s');
	
	$db = $this->_db();
	if ($_POST["id"] == 0){
		mysql_query("INSERT INTO calendario (titulo, fecha, hora, lugar)
					VALUES ('". $titulo ."', '". $fecha ."', '". $hora ."', '". $lugar ."')") or die(mysql_error());
		$id=mysql_insert_id();
		$echo ='<script type="text/javascript">
						setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
						setTimeout("top.location.href = \'?F=calendario&_f=addMod\'",1000);
						</script>';
	} else {
		$sql = "UPDATE calendario SET titulo='$titulo', fecha='$fecha', hora='$hora', lugar='$lugar' WHERE id='{$_POST['id']}'";
		$result = mysql_query($sql);
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=calendario&_f=seeDelete\'",1000);
					</script>';
	}//if
	return $echo;
}//addNoticia


public function seeDelete(){
	$id=$_SESSION["idusuario"];
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM calendario ORDER BY id DESC");
	$echo = '';
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$fechat = $row["fecha"];
			$fechatt = new DateTime($fechat);
			$fecha = $this->txtFechaPub(date_format($fechatt, 'Y-m-j'));
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=calendario&amp;_f=addMod&amp;id='. $row["id"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["titulo"] .' </span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $fecha .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["hora"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["lugar"] .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=calendario&amp;_f=delEvento&amp;id='. $row["id"] .'"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<p class="txtTitles">Listado de Eventos Publicados</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="3">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">T&iacute;tulo</td>
					<td style="background:#E3EEF0" align="center">Fecha</td>
					<td style="background:#E3EEF0" align="center">Hora</td>
					<td style="background:#E3EEF0" align="center">Lugar</td>
					<td style="background:#E3EEF0" width="30" align="center">Borrar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//

public function delEvento(){
	$db=$this->_db();
	
	if (!isset($_GET["id"])){
		echo '<h2>No existe identificador de imagen</h2>';
		exit();
	}//if
		
	mysql_query("DELETE FROM calendario WHERE id='{$_GET['id']}'");

	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=calendario&_f=seeDelete\'",1000);
				</script>';
	return $echo;
}//delete

}//class
?>