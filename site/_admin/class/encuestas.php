<?php
echo (preg_match('/encuestas.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class encuestas extends _GLOBAL_{

public function addMod(){
	if (isset($_GET["id"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM encuestas WHERE id='{$_GET['id']}'");
		
		if($row["activo"]=='1')
				$activo='si';
			else
				$activo='no';
		
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$titulo = $row["titulo"];
		$contenido = $row["contenido"];
		$activo = '';
		if($row["activo"]=='1')
			$activo='<input type="checkbox" name="activo" value="si" checked>';
		else
			$activo='<input type="checkbox" name="activo" value="no">';
		$validador = '';
	} else {
		$_GET["id"] = '0';	
		$titulo = '';
		$contenido ='';
		$activo='<input type="checkbox" name="activo" value="si" checked>';
		$validador = 'frmvalidator.addValidation("contenido","req","Ingrese el contenido de la encuesta");';
	}//if
	
	//<td valign="top"><input name="titulo" type="text" id="titulo" size="100" maxlength="255" value="'. $activo .'"/></td>
	
	return '<p class="txtTitles">Agregar/Ver Encuesta</p>
<p class="txtCont1">Para modificar la encuesta o activarlo cambia el contenido de los campos siguientes:</p>
<p class="txtCont1">&nbsp;</p>

<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=encuestas&amp;_f=addEncuesta">
  <input type="hidden" name="id" value="'. $_GET["id"] .'" />
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="150" valign="top" class="txtCont2" bgcolor="#E0F0F0">T&iacute;tulo:</td>
      <td valign="top" bgcolor="#E0F0F0"><input name="titulo" type="text" id="titulo" size="100" maxlength="255" value="'. $titulo.'" /></td>
    </tr>
	<tr>
      <td valign="top" class="txtCont2">Agregar/Modificar:</td>
      <td valign="top"><input name="contenido" type="text" id="contenido" size="100" maxlength="255"/></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Vista Previa:</td>
      <td valign="top">'. $contenido .'</td>
    </tr>
	<tr>
      <td valign="top" class="txtCont2">Activo:</td>
	  <td valign="top">'.$activo.'</td>
	</tr>
    <tr>
      <td valign="top" class="txtCont2">&nbsp;</td>
      <td valign="top"><input name="enviar3" type="submit" class="frmBtnIngresar" id="enviar3" value="Agregar-Modificar" /></td>
    </tr>
  </table>
</form>
		<script language="JavaScript" type="text/javascript">
		 var frmvalidator = new Validator("form");
		 frmvalidator.addValidation("titulo","req","Ingrese el titulo de la encuesta");
		 '.$validador.'
	  </script>';
}//addMod

public function addEncuesta(){
	if(!isset($_POST["titulo"])){ echo '<h2>No se puede agregar su encuesta.</h2>'; exit(); }//if
	
	$titulo = strip_tags($_POST["titulo"]);
	$contenido = $_POST["contenido"];
	$activo='';
	if(isset($_POST["activo"]))
		$activo = '1';
	else
		$activo = '0';

	$db = $this->_db();
	if ($_POST["id"] == 0){
		mysql_query("INSERT INTO encuestas (titulo, contenido, activo)
					VALUES ('". $titulo ."', '". $contenido ."', '". $activo ."')") or die(mysql_error());
		$id=mysql_insert_id();
	} else {
		if($_GET["id"] != '')
			$sql = "UPDATE encuestas SET titulo='$titulo', contenido='$contenido', activo='$activo' WHERE id='{$_POST['id']}'";
		else
			$sql = "UPDATE encuestas SET titulo='$titulo', activo='$activo' WHERE id='{$_POST['id']}'";
		$result = mysql_query($sql);
	}//if
	return $echo;
}//addNoticia

public function seeDelete(){
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM encuestas ORDER BY id DESC");
	$echo = '';
	
	//<span class="txtCont2">'. $activo .'</span>
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$date =  new DateTime($row["fechapub"]);
			$fechapub = $this->txtFechaPub(date_format($date, 'Y-m-d'));
			$contenido = substr($row["contenido"], 0, 330);
			if($row["activo"]=='1')
				$activo='si';
			else
				$activo='no';
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=encuestas&amp;_f=addMod&amp;id='. $row["id"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7" align="center" class="linkCont">'. $row["titulo"] .'</td>
						<td style="background:#F7F7F7"><span class="txtMiniBck">'. strip_tags($contenido) .'...</span></td>
						<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $fechapub .'</span></td>
						<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $activo .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="javascript:void(ConfirmDelete(\'?F=encuestas&amp;_f=delEncuesta&amp;id='. $row["id"] .'\'))"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<p class="txtTitles">Listado de Noticias</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">T&iacute;tulo</td>
					<td style="background:#E3EEF0" align="center">Contenido</td>
					<td style="background:#E3EEF0" align="center" width="130">Publicaci&oacute;n</td>
					<td style="background:#E3EEF0" align="center">Activo</td>
					<td style="background:#E3EEF0" width="30" align="center">Eliminar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//

public function delEncuesta(){
	if (!isset($_GET["id"])){ echo '<h2>No existe identificador de encuesta</h2>'; exit(); }//if
	
	$db=$this->_db();
		
	mysql_query("DELETE FROM encuestas WHERE id='{$_GET['id']}'");
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=encuestas&_f=seeDelete\'",1000);
				</script>';
	return $echo;
}//delete

}//class
?>