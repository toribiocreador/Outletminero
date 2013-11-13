<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>Activaci&oacute;n de cuenta - Outlet Minero</title>
<link href="css/textos.css" rel="stylesheet" type="text/css" />
<link href="css/links.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico"  />

<style type="text/css">
<!--
body {
	margin-left: 20px;
	margin-top: 20px;
	margin-right: 20px;
	margin-bottom: 20px;
	background:url(imgs/main_bg.gif);
	background-repeat:repeat;
}
-->
</style></head>

<body>
  <?php
if (isset($_GET["key"]) && isset($_GET["correo"])){

	include("db_conn.php");
	$con = mysql_connect($localhost,$user,$pswd) or die('Could not connect: ' . mysql_error());
	$db = mysql_select_db($bd, $con);

	$result = mysql_query("SELECT correo, codigo FROM aspirante WHERE correo='{$_GET['correo']}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	if ($row["correo"] == $_GET["correo"] && $row["codigo"] == $_GET["key"]){
		$sql = "UPDATE aspirante SET activo=1 WHERE correo='{$_GET['correo']}'";
		$result = mysql_query($sql);
		echo '<p><a href="http://www.outletminero.org/"><img src="imgs/logo_mini.png" border="0" alt="" /></a></p>
			<p class="txtBold">El usuario <span class="txtTitNot">'. $_GET["correo"] .'</span> fue correctamente autorizado.</p>
			<p class="txtCont">Gracias por tu tiempo.</p>
			<p class="txtCont">Atentamente: Equipo de OutletMinero.com</p>
			<p class="linkTitNot"><a href="http://www.outletminero.org">Da clic aqu&iacute; para ir directamente al sitio.</a></p>';
	} else {
		echo '<h2>No puede autorizarse el correo debido a que el correo no existe o la clave no coincide.</h2>'; 
	}//if

} else {
	echo 'No puede accesar a esta p&aacute;gina.';
}//if

?>
</body>
</html>