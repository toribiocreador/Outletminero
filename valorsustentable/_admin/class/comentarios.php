<?php
echo (preg_match('/comentarios.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class comentarios extends _GLOBAL_{

/* + id + titulo + introduccion + contenido + embed + imagen + pf + fechapub + autor */
public function addMod(){
	if (isset($_GET["id"])){
		if($_SESSION["nivel"]=='6')
			$socio = '1';
		else
			$socio = '0';
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM comentarios WHERE id='{$_GET['id']}' AND socio='{$socio}'");
		if(mysql_num_rows($result) == 0)
			return '<span class="txtCont2">No puedes navegar</span>';
		if($row["activo"]=='1')
				$activo='si';
			else
				$activo='no';
		
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$seccion = $this->seccion[$row["seccion"]];
		$comentario = $row["comentario"];
		$activo = '';
		if($row["activo"]=='1')
			$activo='<input type="checkbox" name="activo" value="si" checked>';
		else
			$activo='<input type="checkbox" name="activo" value="no">';
	} else {
		$_GET["id"] = '0';	
		$seccion = '';
		$comentario ='';
		$activo = '';
	}//if
	
	//<td valign="top"><input name="titulo" type="text" id="titulo" size="100" maxlength="255" value="'. $activo .'"/></td>
	
	return '<p class="txtTitles">Ver Comentario</p>
<p class="txtCont1">Para modificar el comentario o activarlo cambia el contenido de los campos siguientes:</p>
<p class="txtCont1">&nbsp;</p>

<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=comentarios&amp;_f=addNoticia">
  <input type="hidden" name="id" value="'. $_GET["id"] .'" />
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="150" valign="top" class="txtCont2" bgcolor="#E0F0F0">T&iacute;tulo:</td>
      <td valign="top" bgcolor="#E0F0F0"><input name="seccion" type="text" id="seccion" size="100" maxlength="255" value="'. $seccion.'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Contenido:</td>
      <td valign="top"><textarea name="comentario" id="comentario" cols="100" rows="20">'. $comentario .'</textarea></td>
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
		 frmvalidator.addValidation("titulo","req","Ingrese el titulo de la publicacion");
	  </script>';
}//addMod

public function addNoticia(){
	if(!isset($_POST["seccion"])){ echo '<h2>No se puede agregar su publicaci&oacute;n.</h2>'; exit(); }//if
	
	$seccion =  $this->seccionN[strip_tags($_POST["seccion"])];	
	$comentario = $_POST["comentario"];
	if(isset($_POST["activo"]))
		$activo = '1';
	else
		$activo = '0';
	
	$db = $this->_db();
	$sql = "UPDATE comentarios SET seccion='$seccion', comentario='$comentario', activo='$activo' WHERE id='{$_POST['id']}'";
	$result = mysql_query($sql);
	
	return $echo;
}//addNoticia

public function seeDelete(){
	if($_SESSION["nivel"]=='6'){
			$socio = '1';
			$apartado = 'Publicado en';
	}
		else{
			$socio = '0';
			$apartado = 'Secci&oacute;n';
	}
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM comentarios WHERE socio='$socio' ORDER BY id DESC");
	$echo = '';
	
	//<span class="txtCont2">'. $activo .'</span>
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$fechapub = $this->txtFechaPub($row["fechapub"]);
			$contenido = substr($row["comentario"], 0, 330);
			if($row["activo"]=='1')
				$activo='si';
			else
				$activo='no';
			if($row["tipo"]=='2')
				$tApartado='acerca de';
			else
				$tApartado='noticias';
			if($socio=='0')
				$tApartado=$this->seccion[$row["seccion"]];
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=comentarios&amp;_f=addMod&amp;id='. $row["id"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7" align="center" class="linkCont">'. $tApartado .'</td>
						<td style="background:#F7F7F7"><span class="txtMiniBck">'. strip_tags($contenido) .'...</span></td>
						<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $fechapub .'</span></td>
						<td style="background:#F7F7F7" align="center"><span class="txtCont2">'. $activo .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="javascript:void(ConfirmDelete(\'?F=comentarios&amp;_f=delNoticia&amp;id='. $row["id"] .'\'))"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<p class="txtTitles">Listado de Noticias</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">'.$apartado.'</td>
					<td style="background:#E3EEF0" align="center">Comentario</td>
					<td style="background:#E3EEF0" align="center" width="130">Publicaci&oacute;n</td>
					<td style="background:#E3EEF0" align="center">Activo</td>
					<td style="background:#E3EEF0" width="30" align="center">Eliminar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//

public function delNoticia(){
	if (!isset($_GET["id"])){ echo '<h2>No existe identificador de imagen</h2>'; exit(); }//if
	
	$db=$this->_db();
	$result = mysql_query("SELECT * FROM comentarios WHERE id='{$_GET['id']}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	mysql_free_result($result);
		
	mysql_query("DELETE FROM comentarios WHERE id='{$_GET['id']}'");
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=comentarios&_f=seeDelete\'",1000);
				</script>';
	return $echo;
}//delete

}//class
?>