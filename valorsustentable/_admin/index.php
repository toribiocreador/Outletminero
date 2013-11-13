<?php
session_start();
include_once('class/global.php');
if (!isset($_GET['F']) || !isset($_GET['_f'])) {
	$_GET['F'] = 'inicio';
	$_GET['_f'] = 'welcome';
}//if
if (!isset($_SESSION["acceso"]) && !isset($_SESSION["nombre"])){
	$_GET["F"] = 'usuarios';
	$_GET["_f"] = ($_GET["_f"] == 'validar') ? 'validar' : 'main';
}//if

if(file_exists("class/{$_GET['F']}.php")){
	include("class/{$_GET['F']}.php");
	if (class_exists($_GET['F'])){
		$SEC = new $_GET['F']();
		$contenido = $SEC->$_GET['_f']();
	} 
}//file_exists
$_G_ = new _GLOBAL_();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS - Outlet Minero</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

-->
</style>
<link rel="stylesheet" type="text/css" href="JSCal2/css/jscal2.css" />
<link rel="stylesheet" type="text/css" href="JSCal2/css/win2k/win2k.css" />
<link href="styles/textos.css" rel="stylesheet" type="text/css" />
<link href="styles/tables.css" rel="stylesheet" type="text/css" />
<link href="styles/formas.css" rel="stylesheet" type="text/css" />
<link href="styles/links.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../favicon.ico" />

<script type="text/javascript" language="JavaScript">
/*function irA(donde){
    window.location = ""+donde+"";
}
// CHANGE ACTION OF FORM
function changeLink(f,a){
	document.getElementById(f).action=a;
	document.getElementById(f).submit();
}*/
function dispPopUp(ventana,w,h) {
		var open1 = window.open(ventana,'','scrollbars=yes,width='+w+',height='+h+',resizable=no,scrollbar=yes,toolbar=no');
}
</script>

<!-- SLIDE -->
<script type="text/javaScript" src="../js/slide.js"></script>
<script type="text/javascript">
<!--
	var viewer1 = new PhotoViewer();
		viewer1.add('../gallery/help/ayudaNoticia.png');
//--></script>
<!-- SLIDE -->

<script language="JavaScript" src="../js/gen_validatorv31.js" type="text/javascript"></script>
<script language="javascript" src="js/jquery-ui-1.8.6.custom.min" type="text/javascript"></script>

<!-- SCRIPT PARA TEXTAREAS -->
<script language="javascript" type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
      tinyMCE.init({
          mode : "textareas",
          theme : "simple",
          theme_advanced_buttons1 : "bold,italic,underline,paste,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink",
          theme_advanced_buttons2 : "",
          theme_advanced_buttons3 : "",
		  plugins : "paste",
			paste_insert_word_content_callback : "convertWord",
			paste_auto_cleanup_on_paste : true,
		  theme_advanced_toolbar_location : "top",
          theme_advanced_toolbar_align : "left",
          theme_advanced_path_location : "bottom",
          extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]"
      });
</script>
<!-- SCRIPT PARA TEXTAREAS -->

<link href="styles/textos.css" rel="stylesheet" type="text/css" />
<link href="styles/forms.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" language="javascript">
<!-- Hide from non-JavaScript Browsers - CONFIRMACION AL DAR CLIC A ELIMINAR ALGUN ELEMENTO -
function ConfirmDelete(enlace){
		answer = confirm("¿Realmente desea eliminar este registro?")
		if (answer !=0){
				location = enlace
		}
}
//Done Hiding-->
</script>

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td height="20" class="txtPiePagina" style="background:url(imgs/back_top.jpg)" align="right">
    	<span class="txtPieNotaGris">Contacto +52.492.9279542 -</span> <span class="linkSk"><a href="mailto:info@skuiken.com">info@skuiken.com</a></span> - <span class="linkSk"><a href="#">www.skuiken.com</a></span></td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td width="17%"><center>
      <a href="?"><img src="../imgs/logo_mini.png" alt="" width="153" height="40" border="0" /></a>
    </center></td>
    <td width="83%" align="right" class="txtTitlesRed">Panel de Administraci&oacute;n de Informaci&oacute;n </td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="tbBorderPrinc">
  <tr>
    <td><table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
      <tr>
        <td width="200" height="50" class="txtTitleWhite1" style="background:url(imgs/back_NavTitle.jpg)"><a href="?"><img src="imgs/ini.gif" alt="ini" width="13" height="13" border="0" /></a> &nbsp;&nbsp;<span class="linkMenu"><a href="?">Ir a inicio</a></span></td>
        <td class="txtTitleSeccion" style="background:url(imgs/back_SecTitle.jpg)">
        			
					<?php if (isset($_SESSION["nombre"])) { echo '<span class="txtBold">Bienvenido '. $_SESSION["nombre"] .'</span> | '; } //if ?>
                    <?php if (isset($_SESSION["nombre"]) && $_SESSION["acceso"] == 'SI') { echo '<span class="linkMenu"><a href="?F=usuarios&amp;_f=cerrarSesion">Cerrar Sesi&oacute;n</a></span>'; }//if ?>
                    </td>
      </tr>
      <tr>
        <td width="200" height="50" valign="top" style="background:#F4F4F4">
        <?php
		include('class/menus.php');
		$_M_ = new _MENU_();
		$MENUS = $_M_->main();
		echo $MENUS;
		?>
        
        
         
<br />
          <br /></td><td valign="top"><!-- BODY -->
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr><td width="2%">&nbsp;</td><td width="98%"><?php if (isset($contenido)) { echo $contenido; } else { echo 'No existen variables'; } ?></td></tr>
  </table>
  <!-- BODY --></td></tr>
  </table></td></tr>
</table>
<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td class="txtPiePagina" style="background:#E9ECEF"><span class="txtPieNotaGris">Control Management System personalizado por </span><span class="linkSk"><a href="http://www.skuiken.com/" target="_blank">Skuiken Dise&ntilde;o Web Interactivo</a></span></td>
  </tr>
</table>
</body>
</html>