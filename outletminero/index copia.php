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
<link href="css/links.css" rel="stylesheet" type="text/css" />
<link href="css/textos.css" rel="stylesheet" type="text/css" />
<link href="css/tables.css" rel="stylesheet" type="text/css" />
<link href="css/forms.css" rel="stylesheet" type="text/css" />
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

</head>

<body>
<table width="970" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    <?php echo $sessMenu ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="430" height="90" valign="top"><a href="?"><img src="imgs/logo.png" alt="" width="305" height="80" border="0" /></a></td>
        <td width="540" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr style="border-bottom:1px solid #999999">
            <td align="right"><a href="?F=om_em&amp;_f=main"><img src="images/bt_em.png" width="132" height="41" border="0" /></a></td>
            <td align="right"><a href="?F=om_pyp&amp;_f=main"><img src="images/bt_pyp.png" width="132" height="41" border="0" /></a></td>
            <td align="right"><a href="?F=om_gob&amp;_f=main"><img src="images/bt_gob.png" width="132" height="41" border="0" /></a></td>
            <td align="right"><a href="?F=om_edu&amp;_f=main"><img src="images/bt_edu.png" width="132" height="41" border="0" /></a></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td width="100" class="linkMenu"><a href="?F=quienessomos&amp;_f=main">QUI&Eacute;NES SOMOS</a></td>
        <td width="110" class="linkMenu"><a href="?F=editoriales&amp;_f=main">EDITORIAL</a></td>
        <td width="120" class="linkMenu"><a href="?F=noticias&amp;_f=main">NOTICIAS Y <br /> ART&Iacute;CULOS</a></td>
        <td width="130" class="linkMenu"><a href="?F=entrevistas&amp;_f=main">ENTREVISTAS</a></td>
        <td width="150" class="linkMenu"><a href="?F=proveedores&amp;_f=main">DIRECTORIO DE <br /> PROVEEDORES</a></td>
        <td width="110" class="linkMenu"><a href="?F=bolsatrabajo&amp;_f=main">BOLSA DE <br /> TRABAJO</a></td>
        <!-- <td width="70" class="linkMenu"><a href="?F=mas&amp;_f=main">MAS</a></td> -->
        <td width="70" class="linkMenu"><a href="?F=contacto&amp;_f=main">CONTACTO</a></td>
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
				case 'bolsatrabajo': $banner .= '<table width="640" border="0" cellspacing="0" cellpadding="0"><tr><td height="80"><a href="http://www.itesm.mx/" target="_blank"><img src="gallery/banners/itesm.jpg" alt="" width="640" height="80" border="0" /></a></td></tr></table>';
				break;
				case 'inicio': $banner .= '<table width="640" border="0" cellspacing="0" cellpadding="0"><tr><td height="80"><a href="http://www.zacatecas.gob.mx/" target="_blank"><img src="gallery/banners/banner_gobedo.jpg" alt="" width="640" height="80" border="0" /></a></td></tr></table>';
				break;
				case 'proveedores': $banner .= '<table width="640" border="0" cellspacing="0" cellpadding="0"><tr><td height="80"><a href="http://mexico.cat.com/" target="_blank"><img src="gallery/banners/bann_caterpillar.jpg" alt="" width="640" height="80" border="0" /></a></td></tr></table>';
				break;
			}//switch
			echo $banner;
		}//if..................................................
		
		if (isset($contenido)) { echo $contenido; } else { echo ''; } ?>
         <!-- CONTENIDOS -->
        
        </td>
        <td width="320" valign="top"><table width="300" border="0" align="right" cellpadding="0" cellspacing="0">
         <!-- <tr>
            <td align="right"><a href="http://www.facebook.com/pages/Outletminero/111838228897928" target="_blank"><img src="imgs/facebook_32.png" alt="" width="32" height="32" border="0" /></a> <a href="http://www.twitter.com/@outletminero" target="_blank"><img src="imgs/twitter_32.png" alt="" width="32" height="32" border="0" /></a> --><!-- <a href="#"><img src="imgs/linkedin_32.png" alt="" width="32" height="32" border="0" /></a>  <a href="#"><img src="imgs/youtube_32.png" alt="" width="32" height="32" border="0" /></a> --><!--</td>
          </tr>  -->
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
              <table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="260" height="100">
                    <param name="movie" value="anims/banner_chilemin.swf" />
                    <param name="quality" value="high" />
                    <param name="swfversion" value="6.0.65.0" />
                    <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
                    <param name="expressinstall" value="Scripts/expressInstall.swf" />
                    <param name="menu" value="false" />
                    <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
                    <!--[if !IE]>-->
                    <object type="application/x-shockwave-flash" data="anims/banner_chilemin.swf" width="260" height="100">
                      <!--<![endif]-->
                      <param name="quality" value="high" />
                      <param name="swfversion" value="6.0.65.0" />
                      <param name="expressinstall" value="Scripts/expressInstall.swf" />
                      <param name="menu" value="false" />
                      <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
                      <div>
                        <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
                        <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="260" height="80" /></a></p>
                      </div>
                      <!--[if !IE]>-->
                    </object>
                    <!--<![endif]-->
                  </object></td>
                </tr>
              </table>
              <span class="txtEsp">&nbsp;<br /></span>
              <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                  <td align="center"><a href="http://www.itesm.mx/" target="_blank"><img src="gallery/banners/bann_125_itesm.jpg" alt="" width="125" height="125" border="0" /></a></td>
                  <td align="center"><a href="http://www.zacatecas.gob.mx/" target="_blank"><img src="gallery/banners/bann_125_gobedo.jpg" alt="" width="125" height="125" border="0" /></a></td>
                  </tr>
              </table>
              <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                  <td align="center"><img src="gallery/banners/bann_125_fifomi.jpg" width="125" height="125" alt="" /></td>
                  <td align="center"><img src="gallery/banners/bann_125_firstmajesticsilver.jpg" width="125" height="125" alt="" /></td>
                </tr>
              </table>
              <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                  <td align="center"><img src="gallery/banners/bann_125_goldcorp.jpg" width="125" height="125" alt="" /></td>
                  <td align="center"><img src="gallery/banners/bann_125_grupomexico.jpg" width="125" height="125" alt="" /></td>
                </tr>
              </table>
              <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                  <td align="center"><img src="gallery/banners/bann_125_austinpowder.jpg" width="125" height="125" alt="" /></td>
                  <td align="center"><img src="gallery/banners/bann_125X125-1.jpg" width="125" height="125" alt="" /></td>
                </tr>
              </table>
               <span class="txtEsp">&nbsp;<br /></span>
              <table width="262" align="center" class="tbTC2">
                <tr>
                  <td class="linkPP" align="center"><a href="?F=contacto&amp;_f=main">M&aacute;s informaci&oacute;n para auspiciantes, clic aqu&iacute;</a></td>
                </tr>
              </table>
              <span class="txtEsp">&nbsp;<br /></span><span class="txtEsp">&nbsp;<br /></span>
              <table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td><img src="gallery/banners/banner_col1.jpg" width="260" height="80" alt="" /></td>
                </tr>
              </table>
			<br />
            <table align="center" cellpadding="0" cellspacing="0" width="100"><tr><td>
            <!-- TWITTER WIDGET CODE -->
            <script type="text/javascript" language="javascript" src="http://widgets.twimg.com/j/2/widget.js"></script>
			<script type="text/javascript" language="javascript">
            new TWTR.Widget({
              version: 2,
              type: 'profile',
              rpp: 15,
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
                scrollbar: false,
                loop: false,
                live: true,
                hashtags: true,
                timestamp: true,
                avatars: false,
                behavior: 'default'
              }
            }).render().setUser('@outletminero').start();
            </script>
             <!-- TWITTER WIDGET CODE -->
            
            </td></tr></table>
            <br /><center>
            <table width="260px" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="border-top:1px solid #333333; border-left:1px solid #333333; border-right:1px solid #333333; background:#F9F9F9; padding:3px; font:Verdana, Arial, Helvetica, sans-serif; font-weight:bold; color:#000000; font-size:12px">Los Metales</td>
              </tr>
              <tr>
                <td style="border:1px solid #333333; padding:3px" align="center"><div style="background:url(http://quotes.ino.com/affiliates/metals2.gif) 0px -35px; width:175px; height:90px"></div></td>
              </tr>
            </table>
            </center><br />
             <table align="center" cellpadding="0" cellspacing="0"><tr>
               <td><object id="FlashID2" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="260" height="80">
                 <param name="movie" value="anims/bann_pyroblast_300x80.swf" />
                 <param name="quality" value="high" />
                 <param name="wmode" value="opaque" />
                 <param name="swfversion" value="6.0.65.0" />
                 <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
                 <param name="expressinstall" value="Scripts/expressInstall.swf" />
                 <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
                 <!--[if !IE]>-->
                 <object type="application/x-shockwave-flash" data="anims/bann_pyroblast_300x80.swf" width="260" height="80">
                   <!--<![endif]-->
                   <param name="quality" value="high" />
                   <param name="wmode" value="opaque" />
                   <param name="swfversion" value="6.0.65.0" />
                   <param name="expressinstall" value="Scripts/expressInstall.swf" />
                   <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
                   <div>
                     <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
                     <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
                   </div>
                   <!--[if !IE]>-->
                 </object>
                 <!--<![endif]-->
               </object></td></tr></table>
             <br />
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
        <td width="280" valign="top"><p><img src="imgs/logo_mini.png" width="153" height="40" alt="" /></p>
          <p><span class="txtPP">&copy; 2011</span><br />
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
            <td colspan="2" class="linkPP"><a href="?F=noticias&amp;_f=main">Noticias y art&iacute;culos</a></td>
            </tr>
          <tr>
            <td colspan="2" class="linkPP"><a href="?F=entrevistas&amp;_f=main">Entrevistas</a></td>
            </tr>
          <tr>
            <td width="16%"></td>
            <td width="84%" class="linkPP"><a href="?F=editoriales&amp;_f=archivo">Archivo Editorial</a></td>
          </tr>
        </table>
          <br /></td>
        <td width="240" valign="top"><br />
          <table width="100%" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td class="linkPP"><a href="?F=bolsatrabajo&amp;_f=main">Bolsa de trabajo</a></td>
            </tr>
            <tr>
              <td class="linkPP"><a href="?F=proveedores&amp;-f=main">Directorio de proveedores</a></td>
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
          <tr>
            <td class="linkPP"><a href="#">Youtube</a></td>
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
<script type="text/javascript">
swfobject.registerObject("FlashID");
swfobject.registerObject("FlashID2");
</script>
</body>
</html>