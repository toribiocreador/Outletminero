<?php 
session_start();
$sessMenu = '';	// variable del menú de usuario
if (isset($_SESSION["nombre"]) && isset($_SESSION["autorizado"]) == "SI" && isset($_SESSION["id"]) && $_SESSION["id"] = session_id()){
	switch($_SESSION["tipo"]){
		case '1':
			$sessMenu = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
						  <tr>
						  <td align="right" class="txtCont" valign="top" height="30">Bienvenido(a) '. $_SESSION["nombre"].' | 
						  <span class="txtBold">Modo: Empresa</span> |
						  		<span class="linkCont"><a href="?F=bolsatrabajo&amp;_f=misDatosEmp">Mi informaci&oacute;n</a></span> |
								<span class="linkCont"><a href="?F=bolsatrabajo&amp;_f=adminEmpresas">Administrar Empresas</a></span> |
								<span class="linkCont"><a href="?F=bolsatrabajo&amp;_f=adminOfertas">Publicar Oferta Laboral</a></span> |
								<span class="linkCont"><a href="?F=usuarios&amp;_f=cerrarSesion">Cerrar Sesi&oacute;n</a></span>
						  </td>
						  </tr>
						</table>';
		break;
		case '2':
			$sessMenu = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
						  <tr>
						  <td align="right" class="txtCont" valign="top" height="30">Bienvenido(a) '. $_SESSION["nombre"].' | 
						  <span class="txtBold">Modo: Aspirante</span> |
						  		<span class="linkCont"><a href="?F=bolsatrabajo&amp;_f=misDatosEmp">Mi informaci&oacute;n</a></span> |
								<span class="linkCont"><a href="?F=bolsatrabajo&amp;_f=adminCurriculum">Mi Curriculum</a></span> |
								<span class="linkCont"><a href="?F=usuarios&amp;_f=cerrarSesion">Cerrar Sesi&oacute;n</a></span>
						  </td>
						  </tr>
						</table>';
		break;
		default: $sessMenu = ''; break;
	}//switch
}//if

include_once('class/global.php');
if (!isset($_GET['F']) || !isset($_GET['_f'])) {
	$_GET['F'] = 'inicio';
	$_GET['_f'] = 'main';
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
<meta name="keywords" content="outlet minero, minería, noticias de minería, minas, bolsa de trabajo, proveedores de minería, entrevistas, latinoamérica, minería en latinoamérica, minería sustentable, bolsa de trabajo, sector minero, industria minera" />
<meta name="description" content="Portal de información de noticias, entrevistas, artículos, bolsa de trabajo, directorio de proveedores de la industria minera en Latinoamérica." />
<meta name="Language" content="Spanish" />
<meta name="Distribution" content="Global" />
<meta name="Robots" content="All" />
<meta name="Author" content="tecnologia@outletminero.com" />
<title>Outlet Minero</title>
<style type="text/css">
body {
	background-image: url(imgs/main_bg.gif);
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>

<!-- calendar caleightysix -->
<link rel="stylesheet" type="text/css" href="css/calendar-eightysix-v1.1-default.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/calendar-eightysix-v1.1-vista.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/calendar-eightysix-v1.1-osx-dashboard.css" media="screen" />

<link href="css/links.css" rel="stylesheet" type="text/css" />
<link href="css/textos.css" rel="stylesheet" type="text/css" />
<link href="css/tables.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/jquery.hrzAccordion.defaults.css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.hrzAccordion.examples.css"/>
<link rel="stylesheet" type="text/css" href="css/estilos.css" media="all" />
<link rel="shortcut icon" href="favicon.ico" />

<script language="javascript" type="text/javascript" src="js/gen_validatorv31.js"></script>
<script language="javascript" type="text/javascript" src="js/fadeslideshow.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
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

<!-- DATEPICKERCONTROL -->
<script type="text/javascript" src="datepickercontrol/datepickercontrol.js"></script>
<script language="javascript" type="text/javascript">
 if (navigator.platform.toString().toLowerCase().indexOf("linux") != -1){
	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol/datepickercontrol_lnx.css" />');
 }
 else{
	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol/datepickercontrol.css" />');
 }
</script>
  <link type="text/css" rel="stylesheet" href="datepickercontrol/content.css" />
<!-- DATEPICKERCONTROL -->

<!-- jquery-1.6.1 -->
<script src="js/jquery-1.6.1.min.js" type="text/javascript"></script> 
<script language="javascript" type="text/javascript"> 
$(document).ready(function(){
    $("#formP").hide();
	$("#tblBuscP").hide();
      	
    $("#btnFormP").click(function () {
      $("#formP").show("slow");
	  $("#btnFormP").hide();
    }); 
	$("#btnBuscP").click(function () {
      $("#tblBuscP").show("slow");
	  $("#btnBuscP").hide();
    });
	
	//paradigma
	$("#mitoT").hide();
	$("#realidadT").hide();
	$("#imagenMito").click(function () {
      //$("#formP").show("slow");
	  $("#imagesParadigma").hide($("#mitoT").show("slow"),"normal");
	  //$("#mitoT").show("slow");
    });
	$("#imagenRealidad").click(function () {
      //$("#formP").show("slow");
	  $("#imagesParadigma").hide($("#realidadT").show("slow"),"normal");
	  //$("#imagesParadigma").show("fast");
    });
	$("#Paradigma").click(function () {
      //$("#formP").show("slow");
	  $("#imagesParadigma").slideDown("Slow");
	  $("#realidadT").slideUp("fast");
	  $("#mitoT").slideUp("fast");
    });
});	
</script>  
<!-- jquery-1.6.1 -->


<?php if ($_GET['F'] == 'inicio' && $_GET['_f'] == 'main'){ echo $_G_->JScodeSlideshow('2', '960', '350'); }//if ?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22672711-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<script type="text/javascript">
/* This script and many more are available free online at
The JavaScript Source :: http://javascript.internet.com
Created by: James Nisbet (morBandit) :: http://www.bandit.co.nz/ */

	window.onload = function() {
	  document.onselectstart = function() {return false;} // ie
	  document.onmousedown = function() {return false;} // mozilla
	}
	
	/* You can attach the events to any element. In the following example
	I'll disable selecting text in an element with the id 'content'. */
	
	window.onload = function() {
	  var element = document.getElementById('content');
	  element.onselectstart = function () { return false; } // ie
	  element.onmousedown = function () { return false; } // mozilla
	}
</script>

<script type="text/javascript" src="js/horizontalAccorfition/jquery-1.3.2.js"></script>
<script type="text/javascript" src="js/horizontalAccorfition/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/horizontalAccorfition/jquery.hrzAccordion.js"></script>
<script type="text/javascript" src="js/horizontalAccorfition/jquery.hrzAccordion.examples.js"></script>

<script language="javascript" type="text/javascript" src="js/csspopup.js"></script>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-3621330-3");
pageTracker._trackPageview();
} catch(err) {}</script>          

</head>

<body>
 <div id="capaPopUp"></div>
    <div id="popUpDiv">
        <div id="capaContent">
        	<a href="javascript:void(0);" title="Cerrar" id="cerrar">Cerrar</a>
            <div> 
                <a href="http://www.puntoestocastico.com/encuesta/fifomi/"><img src="gallery/popups/invitacion_FIFOMI.jpg" alt="" width="827" height="590" border="0" /></a>
            </div>
        </div>
        <a href="javascript:void(0);" title="Abrir PopUp" id="abrirPop"></a>
    </div>
<br />
<table width="970" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    <?php echo $sessMenu ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="60%" height="80" valign="top"><a href="?"><img src="imgs/logo.png" alt="" width="305" height="80" border="0" /></a></td>
        <td width="40%" valign="top"><table width="100%" border="0" cellspacing="10" cellpadding="0">
          <tr>
           <td>
           <form id="frmBuscador" name="frmBuscador" method="post" action="?_f=busqueda">
                <table width="55%" border="0" align="center" cellpadding="0" cellspacing="0" class="tbInputQ">
                  <tr>
                    <td valign="middle"><input name="query" type="text" class="frmInputQ" id="query" size="35" value="Buscar..." onblur="if(this.value == '') { this.value='Buscar...'}" onfocus="if (this.value == 'Buscar...') {this.value=''}" /></td>
                    <td width="30"><input name="button" type="submit" class="frmButtonQ" id="button" value="Submit" /></td>
                    
                  </tr>
                </table>
                </form></td>
                <td width="60%" valign="top">
                    <table align="center" width="10%" hspace="0" border="0" cellspacing="0" cellpadding="0">
                        <tr style="border-bottom:1px solid #999999"><!--
                            <td width="10%" align="right">
                            	<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=181783375212237&amp;xfbml=1"></script><fb:like href="http://www.outletminero.org/?F=noticias&amp;_f=ver&amp;id='. $row["id"] .'" send="false" layout="button_count" width="10" show_faces="false" font=""></fb:like>
                             </td>-->
                             <td width="10%" align="right"><a href="http://www.facebook.com/profile.php?id=100002217442824" target="_blank"><img src="imgs/facebook_32.png" alt="" width="32" height="32" border="0" /></a></td>
                            <td width="30%" align="right"><a href="http://www.twitter.com/@outletminero" target="_blank"><img src="imgs/twitter_32.png" alt="" width="32" height="32" border="0" /></a></td>
                            <td width="30%" align="right"><a href="http://www.youtube.com/user/outletminero?feature=mhee" target="_blank"><img src="imgs/youtube_32.png" alt="" width="32" height="32" border="0" /></a></td>
                         </tr>
                    </table></td>
          </tr>
        </table></td> 
        <!--
        <tr style="border-bottom:1px solid #999999">
          	<td width="60%" valign="top">
          	</td>       
            <td width="40%" align="right" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" hspace="0">
          		<tr style="border-bottom:1px solid #999999">
                	<td width="10%"></td>
            		<td width="20%" align="right"><a href="?F=proveedores&amp;_f=main"><img src="images/nuevo.png" alt="" width="65" height="27" border="0" /></a></td> 
                 </tr>
            </table></td> 
          </tr>
          -->
    </table></td>
    
  </tr>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td width="100" align="center" alt= "QUI&Eacute;NES SOMOS" class="linkMenu"><a href="?F=quienessomos&amp;_f=main">QUI&Eacute;NES<br /> SOMOS</a></td>
        <td width="100" align="center" alt= "EDITORIAL" class="linkMenu"><a href="?F=editoriales&amp;_f=main">EDITORIAL</a></td>
        <td width="100" align="center" alt= "NOTICIAS Y ART&Iacute;CULOS" class="linkMenu"><a href="?F=noticias&amp;_f=main">NOTICIAS Y <br /> ART&Iacute;CULOS</a></td>
        <td width="100" align="center" alt= "ENTREVISTASL" class="linkMenu"><a href="?F=entrevistas&amp;_f=main">ENTREVISTAS</a></td>
        <td width="100" align="center" alt= "DIRECTORIO DE PROVEEDORES" class="linkMenu"><a href="?F=proveedores&amp;_f=main">DIRECTORIO DE <br /> PROVEEDORES</a></td>
        <td width="100" align="center" alt= "BIBLIOTECA" class="linkMenu"><a href="?F=categorias&amp;_f=main">BIBLIOTECA<br /> VIRTUAL</a></td>
        <td width="100" align="center" alt= "BOLSA DE TRABAJO" class="linkMenu"><a href="?F=bolsatrabajo&amp;_f=main">BOLSA DE <br /> TRABAJO</a></td>
        <!--<a href="?F=proveedores&amp;_f=main" title="Directorio de proveedores">DIRECTORIO DE <br /> PROVEEDORES</a>
        <a hidden="yes" href="?F=bolsatrabajo&amp;_f=main" title="Bolsa de trabajo">BOLSA DE <br /> TRABAJO</a> -->
        <!-- <td width="70" class="linkMenu"><a href="?F=mas&amp;_f=main">MAS</a></td> -->
        <td width="100" align="center" class="linkMenu"><a href="?F=contacto&amp;_f=main">CONTACTO</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><img src="imgs/shadow_menu.png" width="959" height="12" alt="" /></td>
  </tr>
    		<!-- BANNER DE INICIO -->
           <?php 
			if ($_GET["F"] == 'inicio' && $_GET["_f"] == 'main') {
				echo '<tr><td align="center"><div id="fadeshow2"></div></td></tr><tr><td align="center"><img src="imgs/simple_img_bg.png" width="944" height="78" alt="" /></td></tr>';
			}//if
			?>
			<!-- BANNER DE INICIO -->
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top">
        <!-- CONTENIDOS -->
        <?php 
		// Banners ...........................................
		if (isset($_GET["F"])){
			$banner = '';
			switch($_GET["F"]){
				case 'bolsatrabajo': $banner .= '<table width="640" border="0" cellspacing="0" cellpadding="10"><tr><td height="80"><a href="http://www.fifomi.gob.mx/web/" target="_blank"><img src="gallery/banners/banner_fifomi.jpg" alt="" width="640"  border="0" /></a></td></tr></table>
			<table width="640" border="0" cellspacing="0" cellpadding="10"><tr><td height="80"><a href="?F=rh&amp;_f=main" target="_blank"><img src="gallery/banners/banner_rh.jpg" alt="" width="640"  border="0" /></a></td></tr></table>';
				break;
				case 'inicio': $banner .= '<table width="640" border="0" cellspacing="0" cellpadding="10"><tr><td height="80"><a href="http://www.fifomi.gob.mx/web/" target="_blank"><img src="gallery/banners/banner_fifomi.jpg" alt="" width="640"  border="0" /></a></td></tr></table>
			<table width="640" border="0" cellspacing="0" cellpadding="10"><tr><td height="80"><a href="?F=rh&amp;_f=main" target="_blank"><img src="gallery/banners/banner_rh.jpg" alt="" width="640"  border="0" /></a></td></tr></table>';
				break;
				case 'proveedores': $banner .= '<table width="640" border="0" cellspacing="0" cellpadding="10"><tr><td height="80"><a href="http://www.fifomi.gob.mx/web/" target="_blank"><img src="gallery/banners/banner_fifomi.jpg" alt="" width="640"  border="0" /></a></td></tr></table>
			<table width="640" border="0" cellspacing="0" cellpadding="10"><tr><td height="80"><a href="?F=rh&amp;_f=main" target="_blank"><img src="gallery/banners/banner_rh.jpg" alt="" width="640"  border="0" /></a></td></tr></table>';
				break;
			}//switch
			echo $banner;
		}//if..................................................
		
		if (isset($contenido)) { echo $contenido; } else { echo ''; } ?>
         <!-- CONTENIDOS -->
        
        </td>
         
        <td width="33%" valign="top"><table width="50" border="0" align="right" cellpadding="5" cellspacing="0">
         <tr>
          <td align="left">
          <!--
          <a href="http://www.facebook.com/profile.php?id=100002217442824" target="_blank"><img src="imgs/facebook_32.png" alt="" width="32" height="32" border="0" /></a> 
          <a href="http://www.twitter.com/@outletminero" target="_blank"><img src="imgs/twitter_32.png" alt="" width="32" height="32" border="0" /></a> -->
            <!-- <a href="#"><img src="imgs/linkedin_32.png" alt="" width="32" height="32" border="0" /></a>  <a href="#"><img src="imgs/youtube_32.png" alt="" width="32" height="32" border="0" /></a> --><!--</td>
          </tr>
          <tr>
            <td>
            <!-- <br />
              <form id="frmBuscador" name="frmBuscador" method="post" action="">
                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="tbInputQ">
                  <tr>
                    <td valign="middle"><input name="query" type="text" class="frmInputQ" id="query" size="35" value="Buscar..." onblur="if(this.value == '') { this.value='Buscar...'}" onfocus="if (this.value == 'Buscar...') {this.value=''}" /></td>
                    <td width="30"><input name="button" type="submit" class="frmButtonQ" id="button" value="Submit" /></td>
                  </tr>
                </table>
              </form> -->
              <?php echo ''/*$_G_->frmValidarUsuarioRight();*/ ?>
              <table width="100" border="0" align="center" cellpadding="5" cellspacing="0">
                  <tr><td align="center" width="100%" valign="top">
                  	<table border="0" cellspacing="10" cellpadding="0">
                      <tr>
                            <td align="right"><a href="?F=om_em&amp;_f=main"><img src="images/bt_emt.png" width="109"border="0" /></a></td>
                            <td align="right"><a href="?F=om_pyp&amp;_f=main"><img src="images/bt_pypt.png" width="109"  border="0" /></a></td>
                        </tr>
                        <tr>
                        	<td align="right"><a href="?F=om_gob&amp;_f=main"><img src="images/bt_gobt.png" width="109" border="0" /></a></td>
                            <td align="right"><a href="?F=om_edu&amp;_f=main"><img src="images/bt_edut.png" width="109" border="0" /></a></td>
                        </tr>
                       </table></td>
                  <tr>
                  	<td align="center"><a href="http://www.encinales.com.mx/" target="_blank"><img src="gallery/banners/bann_125_encinales.png" alt="" width="260"  border="0" /></a><a href="http://bandasinaloense.mx" target="_blank"></a></td>
                  </tr>
                  <tr>
                  	<td align="center"><a href="http://www.pyroblast-c.com/" target="_blank"><img src="gallery/banners/bann_PYROBLAST-C.jpg" alt="" width="260"  border="0" /></a></td>
                  </tr>
                  <tr>
                  	<td align="center"><a href="http://www.ro-k.com.mx/" target="_blank"><img src="gallery/banners/bann_ro-k.jpg" alt="" width="260"  border="0" /></a></td>
                  </tr>
                  <tr>
                  	<td align="center"><a href="http://www.camimex.org.mx/" target="_blank"><img src="gallery/banners/bann_125_camimex.jpg" alt="" width="260"  border="0" /></a></td>
                  </tr>
                  <tr>
                  	<td align="center"><a href="?F=firstMajestic&amp;_f=main" target="_blank"><img src="gallery/banners/bann_125_FirstMajesticSilver.jpg" alt="" width="260"  border="0" /></a></td>
                  </tr>
              </table>
              <span class="txtEsp">&nbsp;<br /></span>
              <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                <td align="center"><a href="http://capstonemining.com/s/About.asp" target="_blank"><img src="gallery/banners/bann_125_capstoneG.png" width="125" height="125" alt="" /></a></td>
                  <td align="center"><a href="http://www.geomin.com.mx/" target="_blank"><img src="gallery/banners/bann_125_AIMMGM.jpg" width="125" height="125" alt="" /></a></td>
                </tr>
              </table>
              <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                  <td align="center"><a href="?F=proveedores&amp;_f=ver&amp;id=51" target="_blank"><img src="gallery/banners/bann_125_BURAK.jpg" width="125" height="125" alt="" /></a></td>
                  <td align="center"><a href="?F=proveedores&amp;_f=ver&amp;id=48" target="_blank"><img src="gallery/banners/bann_125_pndm.jpg" width="125" height="125" alt="" /></a></td>
                </tr>
              </table>
              <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                <td align="center"><a href="http://www.liugongdelcentro.com.mx/" target="_blank"><img src="gallery/banners/bann_125_luigong.jpg" width="125" height="125" alt="" /></a></td>
                  <td align="center"><a href="http://www.grainger.com.mx/grainger" target="_blank"><img src="gallery/banners/bann_125_gringer.jpg" width="125" height="125" alt="" /></a></td>
                </tr>
              </table>
              <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                <td align="center"><a href="http://www.draeger.com/MX/es/" target="_blank"><img src="gallery/banners/bann_125_drager.jpg" width="125" height="125" alt="" /></a></td>
                  <td align="center"><a href="http://metso.com/" target="_blank"><img src="gallery/banners/bann_125_metso.jpg" width="125" height="125" alt="" /></a></td>
                </tr>
              </table>
               <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                  <td align="center"><a href="http://www.srk.com/" target="_blank"><img src="gallery/banners/bann_125_srk.jpg" width="125" height="125" alt="" /></a></td>
                  <td align="center"><a href="http://solutions.3m.com.mx/wps/portal/3M/es_MX/WW2/Country?WT.mc_id=www.3m.com/mx" target="_blank"><img src="gallery/banners/bann_125_3m.jpg" width="125" height="125" alt="" /></a></td>
                </tr>
              </table>
               <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr >
                  <td width="50%" align="left"><a href="http://www.srk.com/" target="_blank"><img src="gallery/banners/bann_125_gobedo.jpg" width="125" height="125" alt="" /></a></td>
                  <td width="50%" align="left"><a href="" target=""></a></td>
                </tr>
              </table>
               <span class="txtEsp">&nbsp;<br /></span>
              <table width="262" align="center" class="tbTC2">
                <tr>
                  <td class="linkPP" align="center"><a href="?F=contacto&amp;_f=main">M&aacute;s informaci&oacute;n para auspiciantes, clic aqu&iacute;</a></td>
                </tr>
              </table>
              <span class="txtEsp">&nbsp;<br /></span><span class="txtEsp">&nbsp;<br /></span>
              <table width="100" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                  <td><img src="gallery/banners/banner_col1.jpg" width="260" height="80" alt="" /></td>
                </tr>
                <tr>
                  <td align="center"><a href="http://www.chilemin.cl/" target="_blank"><img src="gallery/banners/bann_chilemin.jpg" alt="" width="260"  border="0" /></a></td>
                  </tr>
                <tr>
                  <td align="center"><a href="http://xanvil.org" target="_blank"><img src="gallery/banners/bann_XANVIL.gif" alt="" width="260"  border="0" /></a></td>
                  </tr>
              </table>
			<br />
            <table align="center" cellpadding="5" cellspacing="0" width="100">
            <tr>
            <td width="100%" align="center">
                              <iframe  width="20px"allowtransparency="true" frameborder="0" scrolling="no"
  src="http://platform.twitter.com/widgets/follow_button.html?screen_name=outletminero"
  style="width:150px; height:20px;"></iframe>
                            </td>
             </tr>
            <tr><td>
            <!-- TWITTER WIDGET CODE -->
            <script type="text/javascript" language="javascript" src="http://widgets.twimg.com/j/2/widget.js"></script>
			<script type="text/javascript" language="javascript">
            new TWTR.Widget({
              version: 2,
              type: 'profile',
              rpp: 50,
              interval: 6000,
              width: 280,
              height: 300,
              theme: {
                shell: {
                  background: '#e6e6e6',
                  color: '#152f7d'
                },
                tweets: {
                  background: '#ffffff',
                  color: '#707070',
                  links: '#09960e'
                }
              },
              features: {
                scrollbar: true,
                loop: false,
                live: true,
                hashtags: true,
                timestamp: true,
                avatars: true,
                behavior: 'all'
              }
            }).render().setUser('@Outletminero').start();
            </script>
             <!-- TWITTER WIDGET CODE -->
            
            </td></tr></table>
            <br /><center>
            <table width="170px" border="0" cellspacing="0" cellpadding="0">
              <tr>
              <td align="center">
              <br />
              <script type="text/javascript" src="http://oilprice.com/widgets/metals.js"></script><noscript>Please Enable Javascript for this <a href="http://oilprice.com">Oil Price</a> widget to work</noscript>     </td>
              </tr>    
            </table>
            </center><br />
              </td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
    <td>&nbsp;</td>
    <td width="970" height="150"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="280" valign="top"><p><img src="imgs/logo_mini.png" width="56" height="15" alt="" /></p>
          <p><span class="txtPP">&copy; 2011</span>
            <span class="txtPPBold">Outlet Minero S.A. de C.V.</span><br />
            <span class="txtPP">Todos los Derechos Reservados </span></p></td>
        <td width="200" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="2"><span class="txtBold1">MAPA DEL SITIO</span></td>
            </tr>
          <tr>
            <td colspan="2" class="linkPP"><a href="?F=quienessomos&amp;_f=main">&iquest;Qui&eacute;nes somos?</a></td>
            </tr>
          <tr>
            <td colspan="2" class="linkPP"><a href="?F=editoriales&_f=main">Editorial</a></td>
          </tr>
          <tr>
            <td colspan="2" class="linkPP"><a href="?F=noticias&amp;_f=main">Noticias y art&iacute;culos</a></td>
            </tr>
          <tr>
            <td colspan="2" class="linkPP"><a href="?F=entrevistas&amp;_f=main">Entrevistas</a></td>
            </tr>
        </table>
          <br /></td>
        <td width="240" valign="top"><br />
          <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
              <td class="linkPP"><a href="?F=proveedores&amp;-f=main">Directorio de proveedores</a></td>
            </tr>
            <tr>
              <td class="linkPP"><a href="?F=bolsatrabajo&amp;_f=main">Bolsa de trabajo</a></td>
            </tr>
          </table></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td width="100%"><span class="txtBold1">MANTENTE INFORMADO</span></td>
          </tr>
          <tr>
            <td class="linkPP"><a href="?F=contacto&amp;_f=main">Contacto</a></td>
          </tr>
          <tr>
            <td class="linkPP"><a href="http://www.facebook.com/pages/Outletminero/111838228897928" target="_blank">Facebook</a></td>
          </tr>
          <tr>
            <td class="linkPP"><a href="http://twitter.com/@outletminero" target="_blank">Twitter</a></td>
          </tr>        
        </table></td>
      </tr>
    </table></td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="970" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><img src="imgs/shadow_menu.png" width="959" height="12" alt="" /></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>