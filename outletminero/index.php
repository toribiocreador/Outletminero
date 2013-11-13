<?php 
session_start();
$sessMenu = ''; // variable del menú de usuario
if (isset($_SESSION["nombre2"]) && isset($_SESSION["autorizado2"]) == "SI" && isset($_SESSION["id2"]) && $_SESSION["id2"] = session_id()){
  switch($_SESSION["tipo2"]){
    case '1':
      $sessMenu = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
              <tr>
              <td align="right" class="txtCont" valign="top" height="30">Bienvenido(a) '. $_SESSION["nombre2"].' | 
              <span class="txtBold">Modo: Aspirante</span> |
                  <span class="linkCont"><a href="?F=bolsatrabajo&amp;_f=misDatosEmp">Mi informaci&oacute;n</a></span> |
                <span class="linkCont"><a href="?F=bolsatrabajo&amp;_f=adminCurriculum">Mi Curriculum</a></span> |
                <span class="linkCont"><a href="?F=bolsatrabajo&amp;_f=adminBolsa">Bolsa de Trabajo</a></span> |
                <span class="linkCont"><a href="?F=usuarios&amp;_f=cerrarSesion">Cerrar Sesi&oacute;n</a></span>
              </td>
              </tr>
            </table>';
    break;
    case '2':
      $sessMenu = '<table width="100%" border="0" cellspacing="0" cellpadding="4">
              <tr>
              <td align="right" class="txtCont" valign="top" height="30">Bienvenido(a) '. $_SESSION["nombre2"].' | 
              <span class="txtBold">Modo: Administrador</span> |
                  <span class="linkCont"><a href="?F=bolsatrabajo&amp;_f=misDatosEmp">Mi informaci&oacute;n</a></span> |
                <span class="linkCont"><a href="?F=bolsatrabajo&amp;_f=adminCurriculum">Mi Curriculum</a></span> |
                <span class="linkCont"><a href="?F=bolsatrabajo&amp;_f=adminVacantes">Administrar Vacantes</a></span> |
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

$_G_ = new _GLOBAL_();
$calendar = $_G_->calendarEvents();
$multimedia = $_G_->getVideo();
$barraEventos = $_G_->barraEventos();

if(file_exists("class/{$_GET['F']}.php")){
  include("class/{$_GET['F']}.php");
  if (class_exists($_GET['F'])){
    $SEC = new $_GET['F']();
    $contenido = $SEC->$_GET['_f']();
  } 
}//file_exists
$_G_ = new _GLOBAL_();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="es_MX" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="es_MX" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="es_MX" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="es_MX" class="no-js"> <!--<![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="alternate" type="application/rss+xml" title="Mi feed RSS" href="http://outletminero.org/class/RSSFeed.php">  
<meta name="keywords" content="outlet minero, minería, noticias de minería, minas, bolsa de trabajo, proveedores de minería, entrevistas, latinoamérica, minería en latinoamérica, minería sustentable, bolsa de trabajo, sector minero, industria minera" />
<meta name="description" content="Portal de información de noticias, entrevistas, artículos, bolsa de trabajo, directorio de proveedores de la industria minera en Latinoamérica." />
<meta name="Language" content="Spanish" />
<meta name="Distribution" content="Global" />
<meta name="Robots" content="All" />
<meta name="Author" content="tecnologia@outletminero.com" />
<meta name="google-translate-customization" content="47cb8777b621b9b6-7d7a4e5e21323172-gaa8375c7350afa76-14"></meta>

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

<link href="css/links.css" rel="stylesheet" type="text/css" />
<link href="css/textos.css" rel="stylesheet" type="text/css" />
<link href="css/tables.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/estilos.css" media="all" />

<link rel="stylesheet" type="text/css" href="css/styleDropDownMenu.css" media="all" />
<link rel="shortcut icon" href="favicon.ico" />

<script language="javascript" type="text/javascript" src="js/ajax_captcha.js"></script>
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
function suscribete(){                        
  $("#abrirPop").click();
}
          
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
  
}); 
</script>  
<!-- jquery-1.6.1 -->



 <!-- get jQuery from the google apis -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>  

<!-- CSS STYLE -->
<link rel="stylesheet" type="text/css" href="css/kenburner.css" media="screen" />   

 <!-- jQuery Paradigm Slider  -->
<script type="text/javascript" src="js/kb-plugin/js/jquery.easing.1.3.js"></script> 
<script type="text/javascript" src="js/kb-plugin/js/jquery.cssAnimate.mini.js"></script>  
<script type="text/javascript" src="js/kb-plugin/js/jquery.waitforimages.js"></script>  
<script type="text/javascript" src="js/kb-plugin/js/jquery.touchwipe.min.js"></script>  
<script type="text/javascript" src="js/kb-plugin/js/jquery.themepunch.kenburn.min.js"></script> 

<link rel="stylesheet" type="text/css" href="js/kb-plugin/css/settings.css" media="screen" />

<!-- LOADING THE GOOGLE FONTS HERE, If no Google Fonts Needed, set families like: families:['']  !! -->
<script type="text/javascript">
  WebFontConfig = {
  google: { families: [ 'PT+Sans+Narrow:400,700' ] },
  active: function() { jQuery('body').data('googlefonts','loaded');},
  inactive: function() { jQuery('body').data('googlefonts','loaded');}
  };    
</script>
    
<script language="javascript" type="text/javascript" src="js/csspopup.js"></script>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'es', includedLanguages: 'es,en,fr', autoDisplay: false}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

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
<style type="text/css">
  .goog-te-banner-frame.skiptranslate { display: none !important;} 
  body {top: 0px !important; }
  .goog-logo-link{display:none !important}
  .goog-te-gadget {font-size: 0px;}
</style>     
<!-- <script type="text/javascript" src="js/jquery.snow.js"></script>
<script type="text/javascript">
$(document).ready( function(){

        $.fn.snow({ minSize: 5, maxSize: 50, newOn: 100, flakeColor: '#fff' });


});
</script>-->
</head>
<body>
 <div id="capaPopUp"></div>
    <div id="popUpDiv">
        <div id="capaContent">
          <a href="javascript:void(0);" title="Cerrar" id="cerrar">Cerrar</a>
            <div> 
                <form id="frmSuscribete" name="frmSuscribete" method="post" action="?F=suscribete&amp;_f=add">
                <table width="55%" border="0" align="center" cellpadding="0" cellspacing="0" class="tbInputQ">
                  <tr>
                    <td valign="middle"><input name="query" type="text" class="frmInputQ" id="query" size="35" value="Ingresa tu correo..." onblur="if(this.value == '') { this.value='Ingresa tu correo...'}" onfocus="if (this.value == 'Ingresa tu correo...') {this.value=''}" /></td>
                    <td width="30"><input name="button" type="submit" class="frmButtonS" id="button" value="Submit" /></td>
                  </tr>
                </table>
                </form>
                <script language="JavaScript" type="text/javascript">
           var frmvalidator = new Validator("frmSuscribete");
           frmvalidator.addValidation("query","req","Ingrese su correo electronico");
           frmvalidator.addValidation("query","maxlen=100");
           frmvalidator.addValidation("query","email");
          </script>
            </div>
        </div>
        <a href="javascript:void(0);" title="Abrir PopUp" id="abrirPop"></a>
    </div>
<table width="970" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    <table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr><td width="100%" align="right" >
            <div id="google_translate_element"></div>
          </td>
          </tr>
        </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="60%" height="80" valign="top"><a href="?"><img src="imgs/logo.png" alt="" width="305" height="80" border="0" /></a></td>
        <td width="40%" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
           <td height="36" valign="bottom">
           <form id="frmBuscador" name="frmBuscador" method="post" action="?F=buscar&amp;_f=main">
                <table width="55%" border="0" align="top" cellpadding="0" cellspacing="0">
                  <tr>
                    <td valign="center"><input name="query" type="text" class="frmInputQ" id="query" size="35" value="Buscar..." onblur="if(this.value == '') { this.value='Buscar...'}" onfocus="if (this.value == 'Buscar...') {this.value=''}" />
                    </td><td valign="middle">
                    <select name="seccion" class="frmInputM">
                      <option value="1">Editorial</option>
                      <option value="2">Noticias</option>
                      <option value="3">Entrevistas</option>
                     </select>
                    </td>
                    <td valign="center" width="30"><input name="button" type="submit" class="frmButtonQ" id="button" value="Submit" /></td>
                  </tr>
                </table>
                </form>
                </td>
                <!--
                            <td width="10%" align="right">
                              <div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=181783375212237&amp;xfbml=1"></script><fb:like href="http://www.outletminero.org/?F=noticias&amp;_f=ver&amp;id='. $row["id"] .'" send="false" layout="button_count" width="10" show_faces="false" font=""></fb:like>
                             </td>-->
                <td valign="bottom" width="32%" align="right"><a href="https://confirmsubscription.com/h/j/9BC772CDC3EA330B" onclick="suscribete();" target="_blank"><img src="images/suscribete.png" alt="" width="90" height="30" border="0" /></a></td>
                 <td valign="bottom"  width="32%" align="right"><a href="http://www.linkedin.com/company/outletminero" target="_blank"><img src="imgs/linkedin_32.png" alt="" width="32" height="32" border="0" /></a></td>
                 <td valign="bottom"  width="32%" align="right"><a href="http://www.facebook.com/profile.php?id=100002217442824" target="_blank"><img src="imgs/facebook_32.png" alt="" width="32" height="32" border="0" /></a></td>
                <td valign="bottom"  width="32%" align="right"><a href="http://www.twitter.com/@outletminero" target="_blank"><img src="imgs/twitter_32.png" alt="" width="32" height="32" border="0" /></a></td>
                <td valign="bottom"  width="32%" align="right"><a href="http://www.youtube.com/user/outletminero?feature=mhee" target="_blank"><img src="imgs/youtube_32.png" alt="" width="32" height="32" border="0" /></a></td>
               
          </tr>
        </table> <br /><br /></td> 
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
        <div class="shadow">
            <navD> 
                <ul>
                <li><a>QUI&Eacute;NES SOMOS</a>
                   <ul>
                        <li><a href="?F=quienessomos&amp;_f=nosotros">Nosotros</a></li>
                        <li><a href="?F=quienessomos&amp;_f=mision">Mision</a></li>
                        <li><a href="?F=quienessomos&amp;_f=vision">Visi&oacute;n</a></li>
                        <li><a href="?F=quienessomos&amp;_f=valores">Valores</a></li>
                        <li><a href="?F=quienessomos&amp;_f=relaciones">Relaciones</a></li>
                        <li><a href="?F=contacto&amp;_f=main">Contacto</a></li>
                        <li><a href="?F=privacidad&amp;_f=main">Aviso de Privacidad</a></li>
                    </ul> 
                </li>
                <li><a href="?F=editoriales&amp;_f=main">EDITORIAL</a></li>
                <li><a>NOTICIAS</a>
                   <ul>
                        <li><a href="?F=noticias&amp;_f=sociales">Sociales</a></li>
                        <li><a href="?F=noticias&amp;_f=sustentable">Sustentables</a></li>
                        <li><a href="?F=noticias&amp;_f=informativo">Informativas</a></li>
                        <li><a href="?F=noticias&amp;_f=financieras">Financieras</a></li>
                        <li><a href="?F=noticias&amp;_f=nProyectos">Nuevos Proyectos</a></li>
                        <li><a href="?F=noticias&amp;_f=metales">Metales al d&iacute;a</a></li>
                        <li><a href="?F=noticias&amp;_f=eventos">Eventos</a></li>
                    </ul> 
                </li>
                <li><a href="?F=entrevistas&amp;_f=main">ENTREVISTAS</a></li>
                <li><a>SABIAS QUE</a>
                   <ul>
                        <li style="float:right"><a href="?F=historias&amp;_f=main">Historias</a></li>
                        <li style="float:right"><a href="?F=mitos&amp;_f=main">Mitos y realidades</a></li>
                        <li style="float:right"><a href="?F=reportajes&amp;_f=main">Reportajes</a></li>
                    </ul> 
                </li>
                <li><a>MULTIMEDIA</a>
                   <ul>
                        <li style="float:right"><a href="?F=videos&_f=main">Videos</a></li>
                        <li style="float:right"><a href="?F=categorias&amp;_f=main">Biblioteca</a></li>
                    </ul> 
                </li>
                <li><a href="?F=bolsatrabajo&amp;_f=main">BOLSA DE TRABAJO</a></li>
                </ul>
            </nav>
            <div class="sh_bottom"></div> <!-- Used for the drop shadow -->
        </div>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><img src="imgs/shadow_menu.png" width="959" height="12" alt="" /></td>
  </tr>
  <tr>
    <td height="28"></td>
  </tr>
        <!-- BANNER DE INICIO -->
          
            
      <script type="text/javascript">
      $(document).ready(function(){
        //$("#abrirPop").click();
      });
      </script> 
      <!-- BANNER DE INICIO -->
  <tr>
    <td>
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <?php
                if ($_GET["F"] == 'inicio'){
                  echo '<td height="470" valign="top">
                          '.$barraEventos.' 
                        </td></tr>
                        <tr>';
                }
              ?>
              <td>
                <!-- CONTENIDOS -->
                <?php 
                  if (isset($sessMenu) && ($_GET["F"] == 'bolsatrabajo'))
                        echo $sessMenu;
                  if (isset($contenido)) { echo $contenido; } else { echo ''; } 
                ?> <!-- CONTENIDOS -->
              </td>
            </tr>
          </table>
        </td>
        <!-- CONTENIDOS -->
        <?php 
          if ($_GET["_f"] != 'verProductos')
                echo '<td width="33%" valign="top"><table width="50" border="0" align="right" cellpadding="5" cellspacing="0">
                 <tr>
                  <td align="left">
                      <table width="100" border="0" align="center" cellpadding="5" cellspacing="0">
                          <tr>
                            <td align="center"><a href="http://amolamineria.outletminero.org" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_amoMineria.jpg&a=c&w=260&h=300" alt="" border="0" /></a></td>
                          </tr>
                          <tr>
                            <td align="center"><a href="?F=bolsatrabajo&_f=seelista"><img src="Scripts/timthumb.php?src=gallery/banners/bann_reclutamiento.jpg&a=c&w=260&h=300" alt="" border="0" /></a></td>
                          </tr>
                          <tr>
                            <td align="center"><a href="http://www.pyroblast-c.com/" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_PYROBLAST-C.jpg&a=c&w=260&h=80" alt="" border="0" /></a></td>
                          </tr>
                          <tr>
                            <td align="center"><a href="http://www.srk.com/" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_SRK.png&a=c&w=260&h=80" alt="" width="260"  border="0" /></a></td>
                          </tr>
                          <tr>
                            <td align="center"><a href="http://www.ro-k.com.mx/" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_ro-k.jpg&a=c&w=260&h=80" alt="" width="260"  border="0" /></a></td>
                          </tr>
                          <tr>
                            <td align="center"><a href="?F=firstMajestic&amp;_f=main" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_FirstMajesticSilver.jpg&a=c&w=260&h=80" alt="" width="260"  border="0" /></a></td>
                          </tr>
                          <tr>
                            <td align="center"><a href="http://www.ingetrol.com/es/index.html" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_ingetrol.png&a=c&w=260&h=80" alt="" width="260"  border="0" /></a></td>
                          </tr>
                          <tr>
                            <td align="center"><a href="http://www.honeywellsafety.com/Americas/Home.aspx?LangType=21514" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_Honeywell.png&a=c&w=260&h=80" alt="" width="260"  border="0" /></a></td>
                          </tr>
                           <tr>
                            <td align="center"><a href="http://www.atlascopco.com.mx/mxes/" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_AtlasCopco.png&a=c&w=260&h=80" alt="" width="260"  border="0" /></a></td>
                          </tr>
                           <tr>
                            <td align="center"><a href="http://www.donaldsonlatam.com/" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_donalson.jpg&a=c&w=260&h=80" alt="" width="260"  border="0" /></a></td>
                          </tr>
                           <tr>
                            <td align="center"><a href="http://www.hosokawamex.com" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_Hosokawa.png&a=c&w=260&h=80" alt="" width="260"  border="0" /></a></td>
                          </tr>
                           <tr>
                            <td align="center"><a href="http://www.aranzazuholding.com" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_aranzazu.jpg&a=c&w=260&h=80" alt="" width="260"  border="0" /></a></td>
                          </tr>
                           <tr>
                            <td align="center"><a href="http://laprovincia.com.mx/tienda/" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_provincia.jpg&a=c&w=260&h=80" alt="" width="260"  border="0" /></a></td>
                          </tr>
                           <tr>
                           <td align="center"><a href="http://www.commosa.com.mx" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_commosa.jpg&a=c&w=260&h=80" alt="" width="260"  border="0" /></a></td>
                          </tr>
                           <tr>
                           <td align="center"><a href="http://www.almadenminerals.com/" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_almadenminerals.jpg&a=c&w=260&h=80" alt="" width="260"  border="0" /></a></td>
                          </tr>
                      </table>
                      <span class="txtEsp">&nbsp;<br /></span>
                      <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                        <tr>
                        <td align="center"><a href="http://capstonemining.com/s/About.asp" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_capstoneG.png&a=c&w=125&h=125" alt="" /></a></td>
                          <td align="center"><a href="http://www.geomin.com.mx/" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_AIMMGM.jpg&a=c&w=125&h=125" alt="" /></a></td>
                        </tr>
                      </table>
                       <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                        <tr>
                         <td align="center"><a href="http://www.zacatecas.gob.mx/" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_gobedo.jpg&a=c&w=125&h=125" alt="" /></a></td>
                         <td align="center"><a href="http://xanvil.org" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_xanvil.jpg&a=c&w=125&h=125" alt="" /></a></td>
                        </tr>
                      </table>
                      <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                        <tr>
                         <td align="center"><a href="http://www.servicio-automotriz-abdul.com" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_Abdul.png&a=c&w=125&h=125" alt="" /></a></td>
                         <td align="center"><a href="http://tecmin.com.mx" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_Tecmin.jpg&a=c&w=125&h=125" alt="" /></a></td>
                         </tr>
                      </table>
                      <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                        <tr>
                         <td align="center"><a href="http://www.puntoforza.com" target="_blank"><img src="Scripts/timthumb.php?src=gallery/banners/bann_125_puntoForza.jpg&a=c&w=125&h=125" alt="" /></a></td>
                         <td align="center"><a href="#"></a></td>
                         </tr>
                      </table>
                       <span class="txtEsp">&nbsp;<br /></span>
                      <table width="100" border="0" align="center" cellpadding="5" cellspacing="0">
                  <tr><td>
                                  </td></tr>
                      </table>
                      <span class="txtEsp">&nbsp;<br /></span>
                      <table width="262" align="center" class="tbTC2">
                        <tr>
                          <td class="linkPP" align="center"><a href="?F=contacto&amp;_f=main">M&aacute;s informaci&oacute;n para auspiciantes, clic aqu&iacute;</a></td>
                        </tr>
                      </table>
                      <span class="txtEsp">&nbsp;<br /></span><span class="txtEsp">&nbsp;<br /></span>
              <br />
                    <table align="center" cellpadding="5" cellspacing="0" width="100">
                    <tr>
                    <td width="100%" align="center">
                                      <iframe  width="20px"allowtransparency="true" frameborder="0" scrolling="no"
          src="http://platform.twitter.com/widgets/follow_button.html?screen_name=outletminero"
          style="width:140px; height:20px;"></iframe>
                                    </td>
                     </tr>
                    <tr><td>
                    <!-- TWITTER WIDGET CODE -->
                    <script type="text/javascript" language="javascript" src="http://widgets.twimg.com/j/2/widget.js"></script>
              <script type="text/javascript" language="javascript">
                    new TWTR.Widget({
                      version: 2,
                      type: \'profile\',
                      rpp: 50,
                      interval: 6000,
                      width: 280,
                      height: 300,
                      theme: {
                        shell: {
                          background: \'#e6e6e6\',
                          color: \'#152f7d\'
                        },
                        tweets: {
                          background: \'#ffffff\',
                          color: \'#707070\',
                          links: \'#09960e\'
                        }
                      },
                      features: {
                        scrollbar: true,
                        loop: false,
                        live: true,
                        hashtags: true,
                        timestamp: true,
                        avatars: true,
                        behavior: \'all\'
                      }
                    }).render().setUser(\'@Outletminero\').start();
                    </script>
                     <!-- TWITTER WIDGET CODE -->
                    
                    </td></tr></table>
                    <br /><center>
                    <table width="180px" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td style="border-top:1px solid #333333; border-left:1px solid #333333; border-right:1px solid #333333; background:#F9F9F9; padding:3px; font:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; font-size:12px">Los Metales</td>
                      </tr>
                      <tr>
                        <td style="border:1px solid #333333; padding:3px" align="center"><div style="background:url(http://quotes.ino.com/affiliates/metals2.gif) 0px -35px; width:175px; height:100px"></div></td>
                      </tr>
                    </table>
                    </center><br />
                      </td>
                  </tr>
                </table></td>';
        ?> <!-- CONTENIDOS -->
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