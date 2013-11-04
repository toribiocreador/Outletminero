<?php
echo (preg_match('/foro.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class foro extends _GLOBAL_{

/* + id + titulo + introduccion + contenido + embed + imagen + pf + fechapub + autor */
public function addMod(){
	$imagen = '';
	$producto1 = '';
	if (isset($_GET["id"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM foro WHERE id='{$_GET['id']}'");
		$db = $this->_db();
		if(mysql_num_rows($result) == 0)
			return '<span class="txtCont2">No puedes navegar</span>';
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$tok=explode(",",$row["imagen"]);
		$titulo = $row["titulo"];
	} else {
		$_GET["id"] = '0';	
		$titulo = '';
	}//if
	
	return '<p class="txtTitles">Agregar Foro</p>
<p class="txtCont1">Para dar de alta tu publicaci&oacute;n selecciona lo siguiente:</p>
<p class="txtCont1">&nbsp;</p>

<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=foro&amp;_f=addForo">
  <input type="hidden" name="id" value="'. $_GET["id"] .'" />
  <table width="100%" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="150" valign="top" class="txtCont2" bgcolor="#E0F0F0">Pregunta:</td>
      <td valign="top" bgcolor="#E0F0F0"><input name="titulo" type="text" id="titulo" size="100" maxlength="255" value="'. $titulo .'" /></td>
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

public function addForo(){
	if(!isset($_POST["titulo"])){ echo '<h2>No se puede agregar su publicaci&oacute;n.</h2>'; exit(); }//if
	
	$titulo = strip_tags($_POST["titulo"]);
	$fechapub = date("Y-m-d");
	$autor = $_SESSION["nombre"];
	$db = $this->_db();
	
	if ($_POST["id"] == 0){
		mysql_query("INSERT INTO foro (titulo, fechapub, autor)
					VALUES ('". $titulo ."', '". $fechapub ."', '". $autor ."')") or die(mysql_error());
		$id=mysql_insert_id();
	} else {
		$sql = "UPDATE foro SET titulo='$titulo' WHERE id='{$_POST['id']}'";
		$result = mysql_query($sql);
	}//if
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO MODIFICADO\');",100); 
				setTimeout("top.location.href = \'?F=foro&_f=seeDelete\'",1000);
				</script>';
	return $echo;
}//addNoticia

public function seeDelete(){
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM foro ORDER BY id DESC");
	$echo = '';
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$fechapub = $this->txtFechaPub($row["fechapub"]);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=foro&amp;_f=addMod&amp;id='. $row["id"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7" class="linkCont"><a href="?F=foro&amp;_f=addMod&amp;id='. $row["id"] .'">'. $row["titulo"] .' </a></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["autor"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $fechapub .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="javascript:void(ConfirmDelete(\'?F=foro&amp;_f=delForo&amp;id='. $row["id"] .'\'))"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<p class="txtTitles">Listado de Foros</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">T&iacute;tulo</td>
					<td style="background:#E3EEF0" align="center">Autor</td>
					<td style="background:#E3EEF0" align="center">Publicaci&oacute;n</td>
					<td style="background:#E3EEF0" width="30" align="center">Borrar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//

public function seeLecturas(){
	if($_SESSION["nivel"]=='6')
		$socio = '1';
	else
		$socio = '0';
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM noticias WHERE socio='$socio' ORDER BY (twitter+directo+facebook+boletin) DESC");
	$echo = '';
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$fechapub = $this->txtFechaPub($row["fechapub"]);
			$contenido = substr($row["contenido"], 0, 330);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="http://outletminero.org/?F=noticias&_f=ver&id='. $row["id"] .'" target="_blank"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7" class="linkCont"><a href="http://outletminero.org/?F=noticias&_f=ver&id='. $row["id"] .'" target="_blank">'. $row["titulo"] .' </a></td>
						<td style="background:#F7F7F7"><span class="txtMiniBck">'. strip_tags($contenido) .'...</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $fechapub .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["boletin"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["directo"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["twitter"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["facebook"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. ($row["facebook"]+$row["twitter"]+$row["directo"]+$row["boletin"]) .'</span></td>
					  </tr>';
	}//while
	$content = '<p class="txtTitles">Reporte de Lectura de Noticias</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">T&iacute;tulo</td>
					<td style="background:#E3EEF0" align="center">Contenido</td>
					<td style="background:#E3EEF0" align="center" width="150">Publicaci&oacute;n</td>
					<td style="background:#E3EEF0" align="center">Bolet&iacute;n</td>
					<td style="background:#E3EEF0" align="center">Directo</td>
					<td style="background:#E3EEF0" align="center">Twitter</td>
					<td style="background:#E3EEF0" align="center">Facebook</td>
					<td style="background:#E3EEF0" align="center">Total</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//

public function delForo(){
	if (!isset($_GET["id"])){ echo '<h2>No existe identificador de imagen</h2>'; exit(); }//if
	
	$db=$this->_db();
		
	mysql_query("DELETE FROM foro WHERE id='{$_GET['id']}'");
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=foro&_f=seeDelete\'",1000);
				</script>';
	return $echo;
}//delete

}//class
?>