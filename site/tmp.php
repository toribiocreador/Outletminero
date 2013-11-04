<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
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

<script language="javascript">
<!-- Hide from non-JavaScript Browsers - CONFIRMACION AL DAR CLIC A ELIMINAR ALGUN ELEMENTO -
function ConfirmChoice(enlace){
		answer = confirm("Do you really want to go here?")
		if (answer !=0){
				location = enlace
		}
}
//Done Hiding-->
</script>

</head>

<body>
<table width="970" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="120"><table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr>
      <td align="right" class="txtBold">Bienvenido NOMBREUSUARIO | <span class="linkCont"><a href="#">Cerrar Sesi&oacute;n</a></span></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="485"><img src="imgs/logo.png" width="305" height="80" alt="" /></td>
        <td>&nbsp;</td>
      </tr>
  </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="110" valign="middle" class="linkMenu"><a href="#">QUI&Eacute;NES SOMOS</a></td>
        <td width="110" valign="middle" class="linkMenu"><a href="#">EDITORIAL</a></td>
        <td width="120" valign="middle" class="linkMenu"><a href="#">NOTICIAS Y <br />
          ART&Iacute;CULOS</a></td>
        <td width="130" valign="middle" class="linkMenu"><a href="#">ENTREVISTAS</a></td>
        <td width="150" valign="middle" class="linkMenu"><a href="#">DIRECTORIO DE <br />
          PROVEEDORES</a></td>
        <td width="110" valign="middle" class="linkMenu"><a href="#">BOLSA DE <br />
          TRABAJO</a></td>
        <td width="100" valign="middle" class="linkMenu"><a href="#">MAS</a></td>
        <td valign="middle" class="linkMenu" align="right">RSS</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><img src="imgs/shadow_menu.png" width="959" height="12" alt="" /></td>
  </tr>
  <tr>
    <td align="center"><img src="images/simple_img_1.jpg" width="960" height="350" alt="" /><br />      <img src="imgs/simple_img_bg.png" width="944" height="78" alt="" /></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top">
        
        <?php
		$arreglo = array(0 => 'cero',
						 1 => 'uno',
						 2 => 'dos');
		foreach($arreglo as $key => $value){
			echo $key .' - '. $value .'<br />';
		}//foreach
		
		
		?>
        
        
        
        
        
        
        
        
        <p class="txtCont">&nbsp;</p>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
          <tr>
            <td class="linkTitNot"><a href="?F=noticias&amp;_f=ver&amp;id='. $row["id"] .'">'. $row["titulo"] .'</a></td>
            </tr>
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont">Publicado el<span class="txtBold"> '. $this->txtFechaPub($row["fechapub"]) .'</span>, En <span class="linkCont"><a href="?F=noticias&amp;_f=main">Noticias y Art&iacute;culos</a></span> por '. $row["autor"] .'</td>
            </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="10">
            <tr>
              <td width="100" valign="top"><table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs">
                <tr>
                  <td><img src="gallery/noticias/20110405-11140006d3bc740e8ba0c8f64427649f537269.jpg" width="300" height="225" alt="" /><span class="txtPP">Foto: '. $row[&quot;pf&quot;] .'</span></td>
                </tr>
              </table></td>
              <td valign="top" class="txtCont"><p>Aqu&iacute; va el contenido de la introducci&oacute;n de la nota, de preferencia abarcar cierto espacio para poder bien distribuirlo, por lo tanto deber&aacute; ser un texto un poco m&aacute;s extenso para que pueda completar la informaci&oacute;n de una manera correcta y no se vea puesto al ah&iacute; se va.</p>
                <p><span class="linkCont"><a href="#">Ver publicaci&oacute;n completa</a></span> | <span class="linkCont"><a href="#">Deja tu comentario</a></span></p>
                <p>
                <!-- FACEBOOK -->
                <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.skuiken.com%2F&amp;layout=button_count&amp;show_faces=false&amp;width=150&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>
                &nbsp;
                <!-- TWITTER -->
                <a href="http://twitter.com/share" class="twitter-share-button" data-url="http://www.skuiken.com/" data-count="horizontal" data-lang="es">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                </p>
                <?php echo $_SERVER['SCRIPT_FILENAME'] ; ?>
                </td>
            </tr>
          </table>
          <br />
          <br />
        <table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td><table width="100" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                  <td><img src="imgs/qs_img1.png" width="300" height="212" alt="" /></td>
                </tr>
            </table></td>
            </tr>
        </table>
        <p class="txtTit">Registro de cuenta en Directorio de Proveedores</p>
        <blockquote>
          <p class="txtCont">Bienvenido proveedor, a continuaci&oacute;n te presentamos el formulario para que ingreses tus datos y puedas crear una cuenta de acceso para actualizar la informaci&oacute;n de tu empresa registrada cuando creas necesario.</p>
          <p class="txtCont">Dentro de tu cuenta podr&aacute;s agregar m&aacute;s empresas al directorio de proveedores. La empresa registrada anteriormente est&aacute; publicada pero no est&aacute; ligada a ning&uacute;n usuario, es por ello indispensable que puedas crear tu cuenta y asignar la empresa creada a tu cuenta.        </p>
          <form action="" method="post" enctype="multipart/form-data" name="frmProv" id="frmProv">
            <table width="100%" border="0" cellpadding="4" cellspacing="0" class="tbBackWhite">
              <tr>
                <td colspan="2" class="txtBold1">Informaci&oacute;n personal</td>
                </tr>
              <tr>
                <td width="150" class="txtBold">Nombre:</td>
                <td><input name="nombre" type="text" class="frmInputM" id="nombre" size="60" maxlength="50" /></td>
              </tr>
              <tr>
                <td class="txtBold">Apellidos:</td>
                <td><input name="apellidos2" type="text" class="frmInputM" id="apellidos2" size="60" maxlength="100" /></td>
              </tr>
              <tr>
                <td class="txtBold">Correo electr&oacute;nico:</td>
                <td><input name="correo" type="text" class="frmInputM" id="correo" size="60" maxlength="255" /></td>
              </tr>
              <tr>
                <td class="txtBold">Contrase&ntilde;a:</td>
                <td><input name="pwd1" type="password" class="frmInputM" id="pwd1" size="20" maxlength="20" /> 
                  <span class="txtPP">M&aacute;ximo 20 caracteres</span></td>
              </tr>
              <tr>
                <td class="txtBold">Verificar Contrase&ntilde;a:</td>
                <td><input name="pwd2" type="password" class="frmInputM" id="pwd2" size="20" maxlength="20" /> 
                  <span class="txtPP">M&aacute;ximo 20 caracteres</span></td>
              </tr>
            </table>
            <br />
            <table width="100%" border="0" cellpadding="4" cellspacing="0" class="tbBackWhite">
              <tr>
                <td colspan="2" class="txtBold1">Informaci&oacute;n Adicional</td>
                </tr>
              <tr>
                <td width="150" class="txtBold">Messenger:</td>
                <td><input name="messenger" type="text" class="frmInputM" id="messenger" size="60" maxlength="255" /></td>
              </tr>
              <tr>
                <td class="txtBold">Skype:</td>
                <td><input name="skype" type="text" class="frmInputM" id="skype" size="60" maxlength="255" /></td>
              </tr>
              <tr>
                <td class="txtBold">Sitio web:</td>
                <td><input name="sitioweb" type="text" class="frmInputM" id="sitioweb" size="60" maxlength="255" /></td>
              </tr>
              <tr>
                <td class="txtBold">Direcci&oacute;n:</td>
                <td><input name="direccion" type="text" class="frmInputM" id="direccion" size="60" maxlength="255" /></td>
              </tr>
              <tr>
                <td class="txtBold">Ciudad:</td>
                <td><input name="ciudad" type="text" class="frmInputM" id="ciudad" size="60" maxlength="100" /></td>
              </tr>
              <tr>
                <td class="txtBold">Estado:</td>
                <td><input name="estado" type="text" class="frmInputM" id="estado" size="60" maxlength="100" /></td>
              </tr>
              <tr>
                <td class="txtBold">Pa&iacute;s:</td>
                <td>LISTPAISES</td>
              </tr>
              <tr>
                <td class="txtBold">Tel&eacute;fono:</td>
                <td><input name="telefono" type="text" class="frmInputM" id="telefono" size="60" maxlength="100" /></td>
              </tr>
            </table>
            <br />
            <table width="100%" border="0" cellspacing="0" cellpadding="4">
              <tr>
                <td>&nbsp;</td>
                <td><p class="txtBold">T&eacute;rminos y condiciones de uso.</p>
                          <p class="txtPP">Estoy de acuerdo que usar&eacute; este sistema de registro y publicaci&oacute;n de informaci&oacute;n para fines de promoci&oacute;n de oferta laboral e interacci&oacute;n como medio de contacto con empresas y profesionistas afines al giro de este sitio web. No publicar&eacute; informaci&oacute;n difamatoria, inexacta, abusiva, vulgar, ofensiva, sin fines de acoso, terminolog&iacute;a obsena, profanadora, con orientaciones sexuales, de amenaza, invasora a la privacidad de las personas, sin publicar material para adultos, sin violar la integridad moral e intelectual de todas las personas que utilicen este medio.</p>
                          <p class="txtPP">Adem&aacute;s no postear&eacute; ning&uacute;n contenido el cual tenga derechos de autor previamente establecidos a menos que tenga el consentimiento del autor. No publicar&eacute; spam, &quot;flooding&quot;, publicidad, esquemas piramidales, cadenas de caracteres indebidos y solicitudes que no se encuentren dentro de los fines de esta aplicaci&oacute;n.</p>
                          <p class="txtPP">Como observaci&oacute;n importante, los propietarios de esta aplicaci&oacute;n y de este sitio web no est&aacute;n indefinidamente monitoreando los mensajes publicados, es por ello que la informaci&oacute;n publicada no es responsabilidad de los mismos propietarios del sitio, m&aacute;s sin embargo tienen toda la autoridad de bloquear a cualquier usuario que se encuentre haciendo uso indebido del sitio web adem&aacute;s de tomar las acciones necesarias para responsabilizar cualquier publicaci&oacute;n. Es por ello que no se garantiza la exactitud, veracidad y credibilidad de la informaci&oacute;n publicada bajo la responsabilidad de los usuarios que utilicen el sitio web.</p>
                          <p class="txtPP">Los comentarios publicados expresan el punto de vista e informaci&oacute;n personal de cada usuario registrado.</p>
                </td>
              </tr>
              <tr>
                <td width="150">&nbsp;</td>
                <td><input name="submit" type="submit" class="frmButtonM" id="submit" value="Registrarse" /></td>
              </tr>
            </table>
          </form>
          <p class="txtCont">&nbsp;</p>
        </blockquote>
        <p><span class="txtTit">Directorio de Proveedores</span></p>
        <blockquote>
          <p class="txtCont">La cuenta que deseas activar no existe, o bien los datos del enlace no coinciden para activar tu cuenta. Verifica tu enlace para poder activar tu cuenta, si el problema persiste por favor env&iacute;anos un correo electr&oacute;nico a info@outletminero.org para dar seguimineto.</p>
          <p><span class="txtCont">Muchas gracias.</span><br />
          </p>
        </blockquote>
</blockquote>
        <p class="txtTit">Directorio de Proveedores</p>
        <p class="txtCont">Estamos trabajando intensamente para la pr&oacute;xima apertura de esta secci&oacute;n, con la cual podr&aacute;s localizar a las empresas registradas de todo el medio minero.</p>
        <p class="txtBold1">Beneficios</p>
        <blockquote>
          <blockquote>
            <table width="100%" border="0" cellspacing="0" cellpadding="5">
              <tr>
                <td width="16" valign="top"><img src="imgs/dot.png" width="16" height="16" alt="" /></td>
                <td valign="top" class="txtBold">Publicar tu empresa en el directorio de proveedores.</td>
                </tr>
              <tr>
                <td valign="top"><img src="imgs/dot.png" width="16" height="16" alt="" /></td>
                <td valign="top" class="txtBold">Podr&aacute;s ser localizado por medio de tu regi&oacute;n geogr&aacute;fica, localidad y tipo de giro en el que se encuentra tu empresa.</td>
                </tr>
              </table>
          </blockquote>
        </blockquote>
        <p><span class="txtCont">Si est&aacute;s interesado en ser parte de nuestro directorio, cont&aacute;ctanos por medio del siguiente formulario de env&iacute;o de correo electr&oacute;nico v&iacute;a web, el cual ser&aacute; atendido por uno de nuestros ejecutivos a la brevedad posible.</span></p>
        <form id="frmContactoProv" name="frmContactoProv" method="post" action="?F=bolsatrabajo&amp;_f=actualizar">
          <br />
          <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" class="tbBackWhite">
            <tr>
              <td colspan="2" class="txtBold1">Contacto para Directorio de Proveedores de Outlet Minero</td>
              </tr>
            <tr>
              <td width="150" valign="top" class="txtBold">*Nombre de la empresa.</td>
              <td><input name="nombre" type="text" id="nombre" size="60" maxlength="255" class="frmInputM" /></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">*Giro de la empresa.</td>
              <td><input name="correo2" type="text" class="frmInputM" id="correo2" size="60" maxlength="255" /></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Descripci&oacute;n de la<br />
                empresa:</td>
              <td><input name="telefono" type="text" class="frmInputM" id="telefono" size="60" maxlength="60" /></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Calle:</td>
              <td><input name="direccion" type="text" class="frmInputM" id="direccion" size="60" maxlength="255" /></td>
              </tr>
            <tr>
              <td colspan="2" valign="top" class="txtBold"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="160">N&uacute;mero exterior:</td>
                  <td width="100"><label for="numext"></label>
                    <input name="numext" type="text" class="frmInputM" id="numext" size="10" maxlength="10" /></td>
                  <td width="150">N&uacute;mero interior:</td>
                  <td><label for="numint"></label>
                    <input name="numint" type="text" class="frmInputM" id="numint" size="10" maxlength="10" /></td>
                  </tr>
                </table></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Colonia:</td>
              <td><input name="estado" type="text" class="frmInputM" id="estado" size="60" maxlength="100" /></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Ciudad:</td>
              <td>SELECTPAISES</td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Estado:</td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Pa&iacute;s:</td>
              <td>&nbsp;</td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Entre las calles:</td>
              <td class="txtCont">
                <input name="calle1" type="text" class="frmInputM" id="calle1" size="30" /> 
                y 
                <input name="calle2" type="text" class="frmInputM" id="calle2" size="30" /></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">D&iacute;as de atenci&oacute;n:</td>
              <td class="txtPPBold" valign="top">
                <table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>L</td>
                    <td><input type="checkbox" name="lunes" id="lunes" /></td>
                    <td>M</td>
                    <td><input type="checkbox" name="martes" id="martes" /></td>
                    <td>M</td>
                    <td><input type="checkbox" name="miercoles" id="miercoles" /></td>
                    <td>J</td>
                    <td><input type="checkbox" name="jueves" id="jueves" /></td>
                    <td>V</td>
                    <td><input type="checkbox" name="viernes" id="viernes" /></td>
                    <td>S</td>
                    <td><input type="checkbox" name="sabado" id="sabado" /></td>
                    <td>D</td>
                    <td><input type="checkbox" name="domingo" id="domingo" /></td>
                    </tr>
                  </table></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Horarios:</td>
              <td><input name="horarios" type="text" class="frmInputM" id="horarios" size="60" maxlength="100" /></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Tel&eacute;fonos:</td>
              <td><input name="telefonos" type="text" class="frmInputM" id="telefonos" size="60" maxlength="100" /></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Correo:</td>
              <td><input name="correo3" type="text" class="frmInputM" id="correo3" size="60" maxlength="255" /></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Sitio web:</td>
              <td class="txtPP">http://
                <input name="sitioweb" type="text" class="frmInputM" id="sitioweb" size="54" /></td>
              </tr>
            </table>
          
          <br />
          
          <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" class="tbBackWhite">
            <tr>
              <td colspan="2" valign="top" class="txtBold1">Datos de contacto<br />
                <span class="txtPP">Esta &aacute;rea es para el contacto directo del proveedor que se encuentra ingresando.</span></td>
              </tr>
            <tr>
              <td width="150" valign="top" class="txtBold">Nombre:</td>
              <td><input name="us_nombre" type="text" class="frmInputM" id="us_nombre" size="60" maxlength="100" /></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Correo:</td>
              <td><input name="us_correo" type="text" class="frmInputM" id="us_correo" size="60" maxlength="100" /></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Puesto que ocupa en<br />
                la empresa:</td>
              <td><input name="us_puesto2" type="text" class="frmInputM" id="us_puesto2" size="60" maxlength="100" /></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Tel&eacute;fono:</td>
              <td><input type="text" name="us_telefono" id="us_telefono" /></td>
              </tr>
            <tr>
              <td class="txtBold">Comentarios adicionales:</td>
              <td><textarea name="comentarios2" cols="60" rows="5" class="frmInputM" id="comentarios2"></textarea></td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="submit2" type="submit" class="frmButtonM" id="submit2" value="Enviar informaci&oacute;n" />
                <input name="reset2" type="reset" class="frmButtonM" id="reset2" value="Limpiar formulario" /></td>
              </tr>
            </table>
          <br />
        </form>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p class="txtTit">&nbsp;</p>
        <p class="txtTit">&nbsp;</p>
        <p class="txtTit">Mi Curriculum</p>
        <p>Para publicar una oferta de trabajo llena los siguientes campos:</p>
        <form id="frmMisDatos" name="frmMisDatos" method="post" action="?F=bolsatrabajo&amp;_f=actualizar">
          <input name="idusuario" id="idusuario" type="hidden" value="'. $_SESSION["idusuario"] .'" />
          <input type="hidden" id="DPC_FIRST_WEEK_DAY" value="2" />
          <input type="hidden" id="DPC_WEEKEND_DAYS" value="[0,5,6]" />
          <input type="hidden" id="DPC_CALENDAR_OFFSET_X" value="20" />
          <input type="hidden" id="DPC_BUTTON_OFFSET_X" value="10" />
          <br />
          <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" class="tbBackWhite">
            <tr>
              <td colspan="2" class="txtBold1">Datos profesionales</td>
              </tr>
            <tr>
              <td width="150" valign="top" class="txtBold">T&iacute;tulo del anuncio:</td>
              <td><input name="titulo" type="text" id="titulo" size="60" maxlength="255" class="frmInputM" /></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Educaci&oacute;n:</td>
              <td><textarea name="descripcion2" cols="50" rows="5" class="frmInputM" id="descripcion2"></textarea></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Fecha de nacimiento:</td>
              <td><input name="DPC_calendar2b_YYYY-MM-DD" type="text" class="frmInputM" id="DPC_calendar2b_YYYY-MM-DD2" value="'. $vigencia .'" size="10" maxlength="10" /></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Licencia de conducir:</td>
              <td><select name="conducir" class="frmInputM" id="conducir">
                <option value="0">== Selecciona una opci&oacute;n ==</option>
                <option value="1">SI</option>
                <option value="2">NO</option>
                </select></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">&iquest;Cuentas con veh&iacute;culo<br />
                propio?</td>
              <td><select name="vehiculo" class="frmInputM" id="vehiculo">
                <option value="0">== Selecciona una opci&oacute;n ==</option>
                <option value="1">SI</option>
                <option value="2">NO</option>
                </select></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Estudios:</td>
              <td><select name="estudios" class="frmInputM" id="estudios">
                <option value="0">== Selecciona una opci&oacute;n ==</option>
                <option value="1">Educaci&oacute;n B&aacute;sica</option>
                <option value="2">Educaci&oacute;n Secundaria</option>
                <option value="3">Formaci&oacute;n Profesional</option>
                <option value="4">Diploma Universitario</option>
                <option value="5">Licenciatura Universitaria</option>
                <option value="6">Maestr&iacute;a &oacute; Posgrado</option>
                <option value="7">Doctorado</option>
                </select></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">&iquest;Qu&eacute; titulaci&oacute;n tienes?</td>
              <td><input name="titulacion" type="text" class="frmInputM" id="titulacion" size="60" maxlength="100" /></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Situaci&oacute;n laboral actual:</td>
              <td><select name="sitlaboral" class="frmInputM" id="sitlaboral">
                <option value="0">== Selecciona una opci&oacute;n ==</option>
                <option value="1">Sin trabajo</option>
                <option value="2">Buscando primer empleo</option>
                <option value="3">Con trabajo permanente</option>
                <option value="4">Con trabajo temporal</option>
                <option value="5">Estudiante</option>
                <option value="6">Haciendo pr&aacute;cticas</option>
                <option value="7">Autoempleado</option>
                </select></td>
              </tr>
            <tr>
              <td valign="top" class="txtBold">Disponibilidad:</td>
              <td><select name="disponibilidad" class="frmInputM" id="disponibilidad">
                <option value="0">== Selecciona una opci&oacute;n ==</option>
                <option value="1">Inmediata</option>
                <option value="2">En 1 semana</option>
                <option value="3">En 2 semanas</option>
                <option value="4">En 3 semanas</option>
                <option value="5">En 4 semanas</option>
                <option value="6">En 5 semanas</option>
                <option value="7">En 6 semanas</option>
                <option value="8">En 2 meses</option>
                <option value="9">En 3 meses</option>
                <option value="10">En 4 meses</option>
                <option value="11">En 5 meses</option>
                <option value="12">En 6 meses</option>
                </select></td>
              </tr>
            <tr>
              <td class="txtBold">Experiencia profesional:</td>
              <td><select name="experiencia" class="frmInputM" id="experiencia">
                <option value="0">== Selecciona una opci&oacute;n ==</option>
                <option value="1">Sin experiencia</option>
                <option value="2">Estudios reci&eacute;n terminados</option>
                <option value="3">Pr&aacute;cticas en empresa</option>
                <option value="4">1 a&ntilde;o</option>
                <option value="5">2 a&ntilde;os</option>
                <option value="6">3 a 4 a&ntilde;os</option>
                <option value="7">5 a 10 a&ntilde;os</option>
                <option value="8">M&aacute;s de 10 a&ntilde;os</option>
                </select></td>
              </tr>
            <tr>
              <td class="txtBold">Nivel de ingl&eacute;s:</td>
              <td><select name="ingles" class="frmInputM" id="ingles">
                <option value="0">== Selecciona una opci&oacute;n ==</option>
                <option value="1">Nada</option>
                <option value="2">B&aacute;sico</option>
                <option value="3">Intermedio</option>
                <option value="4">Alto</option>
                <option value="5">Muy Alto</option>
                </select></td>
              </tr>
            <tr>
              <td class="txtBold">Otros idiomas:</td>
              <td><input name="otrosidiomas" type="text" class="frmInputM" id="otrosidiomas" size="60" maxlength="100" /></td>
              </tr>
            <tr>
              <td class="txtBold">Estado civil:</td>
              <td><select name="edocivil" class="frmInputM" id="edocivil">
                <option value="0">== Selecciona una opci&oacute;n ==</option>
                <option value="1">Soltero(a)</option>
                <option value="2">Casado(a)</option>
                <option value="3">Separado(a)/Divorciado(a)</option>
                <option value="4">Viudo(a)</option>
                </select></td>
              </tr>
            <tr>
              <td class="txtBold">Sexo:</td>
              <td><select name="sexo" class="frmInputM" id="sexo">
                <option value="0">== Selecciona una opci&oacute;n ==</option>
                <option value="1">Hombre</option>
                <option value="2">Mujer</option>
                </select></td>
              </tr>
            <tr>
              <td class="txtBold">Nacionalidad:</td>
              <td><input name="nacionalidad" type="text" class="frmInputM" id="nacionalidad" size="40" maxlength="40" /></td>
              </tr>
            <tr>
              <td class="txtBold">Espectativas salariales:</td>
              <td><input name="espectativas" type="text" class="frmInputM" id="espectativas" size="20" maxlength="40" /></td>
              </tr>
            <tr>
              <td class="txtBold">Tipo de empleo:</td>
              <td><select name="tipoempleo" class="frmInputM" id="tipoempleo">
                <option value="0">== Selecciona una opci&oacute;n ==</option>
                <option value="1">Tiempo completo</option>
                <option value="2">Por horas</option>
                <option value="3">Beca / Pr&aacute;cticas profesionales</option>
                <option value="4">Medio tiempo</option>
                <option value="5">Temporal</option>
                <option value="6">Desde casa</option>
                </select></td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="submit4" type="submit" class="frmButtonM" id="submit4" value="Agregar Vacante" />
                <input name="reset" type="reset" class="frmButtonM" id="reset" value="Limpiar formulario" /></td>
              </tr>
            </table>
          <br />
        </form>
        <p>&nbsp;</p>
        
        <p><span class="txtTit">Mis empresas</span></p>
          <table width="97%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
              <td width="20" valign="top" class="txtCont" style="background-color:#FFF"><img src="imgs/img_edit.png" width="20" height="20" alt="" /></td>
              <td valign="top" class="linkCont" style="background-color:#FFF"><a href="#">NOMBRE EMPRESA</a></td>
              <td width="15" valign="top" class="txtCont" style="background-color:#FFF"><a href="javascript:void(ConfirmChoice('http://www.skuiken.com/'))"><img src="imgs/img_delete.png" alt="" width="15" height="15" border="0" /></a></td>
            </tr>
          </table>
          <span class="txtEsp">&nbsp;<br /></span>
          <table width="97%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
              <td width="20" valign="top" class="txtCont" style="background-color:#FFF"><img src="imgs/img_edit.png" width="20" height="20" alt="" /></td>
              <td valign="top" class="linkCont" style="background-color:#FFF"><a href="#">NOMBRE EMPRESA</a></td>
              <td width="15" valign="top" class="txtCont" style="background-color:#FFF"><a href="javascript:void(ConfirmChoice('http://www.skuiken.com/'))"><img src="imgs/img_delete.png" alt="" width="15" height="15" border="0" /></a></td>
            </tr>
          </table>
          
          <p class="txtTit">Agregar nueva empresa</p>
          <p>&nbsp;</p>
<p>&nbsp;</p>
          
          
          
          <p class="txtTit">Mi informaci&oacute;n</p>
          <p class="txtCont">A continuaci&oacute;n te mostramos tus datos los cuales podr&aacute;s modificar directamente si es necesario. Tu cuenta es &uacute;nica, por eso no podr&aacute;s modificar tu correo electr&oacute;nico.</p>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
  <tr>
    <td class="linkTitNot"><a href="#">T&iacute;tulo de mi primer noticia</a></td>
    </tr>
</table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont">Publicado el<span class="txtBold"> 20 de Septiembre de 2011</span>, En <span class="linkCont"><a href="#">Noticias y Art&iacute;culos</a></span> por Liza D&iacute;az</td>
            </tr>
          </table>
          <br />
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="150" border="0" cellpadding="0" cellspacing="0" class="linkComm">
                <tr>
                  <td align="center"><a href="#">5 comentarios</a></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs">
            <tr>
              <td><a href="#"><img src="imgs/temp_imgnot.jpg" alt="" width="619" height="169" border="0" /></a></td>
            </tr>
          </table>
          <br />
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="txtCont">CONTENIDO<br /></td>
            </tr>
          </table>
          <p><span class="txtBold">Video.</span><br />
          </p>
          <p class="linkCont"><a href="#">Deja tu comentario</a></p>
          <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
            <tr>
              <td class="linkTitNot"><a href="#">T&iacute;tulo de mi segunda noticia</a></td>
            </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont">Publicado el<span class="txtBold"> 20 de Septiembre de 2011</span>, En <span class="linkCont"><a href="#">Noticias y Art&iacute;culos</a></span> por Liza D&iacute;az</td>
            </tr>
          </table>
          <br />
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="150" border="0" cellpadding="0" cellspacing="0" class="linkComm">
                <tr>
                  <td align="center"><a href="#">5 comentarios</a></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs">
            <tr>
              <td><a href="#"><img src="imgs/temp_imgnot.jpg" alt="" width="619" height="169" border="0" /></a></td>
            </tr>
          </table>
          <p><span class="txtBold">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</span><br />
            <span class="txtCont">Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</span></p>
          <p class="linkCont"><a href="#">Deja tu comentario</a></p>
          <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
            <tr>
              <td class="linkTitNot"><a href="#">T&iacute;tulo de mi segunda noticia</a></td>
            </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont">Publicado el<span class="txtBold"> 20 de Septiembre de 2011</span>, En <span class="linkCont"><a href="#">Noticias y Art&iacute;culos</a></span> por Liza D&iacute;az</td>
            </tr>
          </table>
          <br />
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="150" border="0" cellpadding="0" cellspacing="0" class="linkComm">
                <tr>
                  <td align="center"><a href="#">5 comentarios</a></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <p><span class="txtBold">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</span><br />
            <span class="txtCont">Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</span></p>
          <p class="linkCont"><a href="#">Deja tu comentario</a></p>
          <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
            <tr>
              <td class="linkTitNot"><a href="#">T&iacute;tulo de mi segunda noticia</a></td>
            </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont">Publicado el<span class="txtBold"> 20 de Septiembre de 2011</span>, En <span class="linkCont"><a href="#">Noticias y Art&iacute;culos</a></span> por Liza D&iacute;az</td>
            </tr>
          </table>
          <br />
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><table width="150" border="0" cellpadding="0" cellspacing="0" class="linkComm">
                <tr>
                  <td align="center"><a href="#">5 comentarios</a></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="300" valign="top"><table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs">
                <tr>
                  <td><a href="#"><img src="imgs/temp_imgentrevistas.jpg" alt="" width="284" height="325" border="0" /></a></td>
                </tr>
              </table></td>
              <td valign="top"><p><span class="txtBold">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</span><br />
                <span class="txtCont">Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</span></p></td>
            </tr>
          </table>
           <p class="linkCont"><a href="#">Deja tu comentario</a></p>
           <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTC">
             <tr>
               <td>Mi Cuenta</td>
             </tr>
           </table>
           <span class="txtEsp">&nbsp;<br />
           <table width="90%" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
						    <td width="10" class="txtBold">+</td>
							<td class="linkCont"><a href="?F=usuarios&amp;_f=frmOfertas">Publicar oferta laboral</a></td>
			  </tr>
						  <tr>
						    <td class="txtBold">+</td>
							<td class="linkCont"><a href="?F=comentarios&amp;_f=ver">Ver mis comentarios</a></td>
						  </tr>
						  <tr>
						    <td class="txtBold">+</td>
						    <td class="linkCont"><a href="?F=usuarios&amp;_f=cerrarSesion">Cerrar Sesi&oacute;n</a></td>
</tr>
			</table>
          <p class="txtTit">D&eacute;janos tu comentario</p>
          <p class="txtCont">Necesitas registrarte para poder publicar comentarios,<span class="linkCont"> <a href="?F=bolsatrabajo&amp;_f=main">por favor da clic aqu&iacute; para registrarte</a></span>.</p>
          <p class="txtCont">Agradecemos tu comprensi&oacute;n.</p>
          <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
            <tr>
              <td class="linkTitNot"><a href="#">T&iacute;tulo de mi segunda noticia</a></td>
              </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont">Publicado el<span class="txtBold"> 20 de Septiembre de 2011</span>, En <span class="linkCont"><a href="#">Noticias y Art&iacute;culos</a></span> por Liza D&iacute;az</td>
            </tr>
          </table>
          <p class="txtCont">Breve contenido truncado</p>
          <form id="frmComentario" name="frmComentario" method="post" action="?F=comentarios&amp;_f=add">
            <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
              <tr>
                <td width="100" valign="top" class="txtBold">Usuario:</td>
                <td valign="top" class="txtCont">NOMBREUSUARIO</td>
                </tr>
              <tr>
                <td valign="top" class="txtBold">Comentarios:</td>
                <td valign="top"><label for="comentarios"></label>
                  <textarea name="comentarios" id="comentarios" cols="45" rows="5"></textarea></td>
                </tr>
              <tr>
                <td valign="top" class="txtBold">&nbsp;</td>
                <td valign="top"><input name="button2" type="submit" class="frmButtonM" id="button2" value="Publicar comentario" /></td>
                </tr>
              </table>
          </form>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p><span class="txtTit">Bolsa de Trabajo</span></p>
          
          <table width="100%" border="0" cellpadding="10" cellspacing="0" style="background-color:#FFF">
            <tr>
              <td width="320" valign="top" class="txtCont"><p class="txtBold1">Publica una vacante</p>
                <form id="form1" name="form1" method="post" action="">
                <table border="0" cellspacing="0" cellpadding="10">
                  <tr>
                    <td class="linkCont" style="background-color:#EEE"><a href="#">Reg&iacute;strate</a></td>
                    <td class="linkCont" style="background-color:#D9F0E2"><a href="#">Soy usuario registrado</a></td>
                  </tr>
                </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="10" style="background-color:#EEE">
                    <tr>
                      <td width="70">Nombre:</td>
                      <td><label for="nombre"></label>
                        <input name="nombre" type="text" class="frmInputM" id="nombre" size="40" maxlength="60" /></td>
                    </tr>
                    <tr>
                      <td>Apellidos:</td>
                      <td><input name="apellidos" type="text" class="frmInputM" id="apellidos" size="40" maxlength="255" /></td>
                    </tr>
                    <tr>
                      <td>Correo:</td>
                      <td><input name="correo" type="text" class="frmInputM" id="correo" size="40" maxlength="255" /></td>
                    </tr>
                    <tr>
                      <td>Contrase&ntilde;a:</td>
                      <td><input name="pwd" type="password" class="frmInputM" id="pwd" size="30" maxlength="60" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><input name="submit" type="submit" class="frmButtonM" id="submit" value="Registrarme" /></td>
                    </tr>
                  </table>
                </form>
                </td>
              <td valign="top"><p class="txtBold1">Busca una vacante</p>
                <form id="form2" name="form2" method="post" action="">
                  <table width="100%" border="0" cellspacing="0" cellpadding="5" style="background-color:#EEE">
                    <tr>
                      <td class="txtBold">Ingresa tu b&uacute;squeda:</td>
                    </tr>
                    <tr>
                      <td><input name="query2" type="text" class="frmInputM" id="query2" size="50" maxlength="100" /></td>
                    </tr>
                    <tr>
                      <td class="txtBold">&iquest;D&oacute;nde?</td>
                    </tr>
                    <tr>
                      <td>SELECTPAISES</td>
                    </tr>
                    <tr>
                      <td>Ciudad:</td>
                    </tr>
                    <tr>
                      <td><input name="ciudad" type="text" class="frmInputM" id="ciudad" size="50" maxlength="100" /></td>
                    </tr>
                    <tr>
                      <td><input name="submit3" type="submit" class="frmButtonM" id="submit3" value="buscar" /></td>
                    </tr>
                  </table>
                  <label for="query"></label>
                  <table width="100%" border="0" cellspacing="0" cellpadding="5" style="background-color:#EEE">
                    <tr> </tr>
                </table>
                </form>
                <p>&nbsp;</p></td>
            </tr>
          </table>
          
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p class="txtTit">Comentarios en esta publicaci&oacute;n</p>
          <table width="100%" border="0" cellspacing="0" cellpadding="6">
            <tr>
              <td class="txtCont" style="background-color:#FFF">Publicado el<span class="txtBold"> 20 de Septiembre de 2011</span>, por Liza D&iacute;az<br />
                CONTENIDO</td>
            </tr>
          </table>
          <p class="txtTit">Cont&aacute;ctanos</p>
          <p><img src="imgs/logo_mini.png" width="153" height="40" alt="" /></p>
          <p class="txtCont">C. De la Torre No. 101,<br />
              Fracc. La Herradura,<br />
              C.P. 98080,
              <br />
              Zacatecas, Zac.
            </p>
          <p class="txtCont">Tel. +52.492.922.2624<br />
              <span class="linkCont"><a href="mailto:info@outletminero.com">info@outletminero.com </a></span></p>
          <p class="txtCont">&nbsp;</p>
          <p>&nbsp;</p></td>
        <td width="320" valign="top"><table width="300" border="0" align="right" cellpadding="0" cellspacing="0">
          <tr>
            <td align="right"><a href="#"><img src="imgs/facebook_32.png" alt="" width="32" height="32" border="0" /></a> <a href="#"><img src="imgs/twitter_32.png" alt="" width="32" height="32" border="0" /></a> <a href="#"><img src="imgs/linkedin_32.png" alt="" width="32" height="32" border="0" /></a> <a href="#"><img src="imgs/youtube_32.png" alt="" width="32" height="32" border="0" /></a> <a href="#"><img src="imgs/tumblr_32.png" alt="" width="32" height="32" border="0" /></a></td>
          </tr>
          <tr>
            <td><br />
              <form id="frmBuscador" name="frmBuscador" method="post" action="">
                <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="tbInputQ">
                  <tr>
                    <td valign="middle"><input name="query" type="text" class="frmInputQ" id="query" size="35" value="Buscar..." onblur="if(this.value == '') { this.value='Buscar...'}" onfocus="if (this.value == 'Buscar...') {this.value=''}" /></td>
                    <td width="30"><input name="button" type="submit" class="frmButtonQ" id="button" value="Submit" /></td>
                  </tr>
                </table>
              </form>
             <br />
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTC">
                <tr>
                  <td>Enfoque de Mercado</td>
                </tr>
              </table>
              
              INGRESAR LOS VALORES

              
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTC">
                <tr>
                  <td>Publicidad</td>
                </tr>
              </table>
              <span class="txtEsp">&nbsp;<br /></span>
              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td><img src="imgs/banner_1.gif" width="125" height="125" alt="" /></td>
                  <td><img src="imgs/banner_2.gif" width="125" height="125" alt="" /></td>
                </tr>
                <tr>
                  <td><img src="imgs/banner_3.gif" width="125" height="125" alt="" /></td>
                  <td><img src="imgs/banner_4.gif" width="125" height="125" alt="" /></td>
                </tr>
              </table>
              <span class="txtEsp">&nbsp;<br /></span>
              <table width="90%" align="center" class="tbTC2">
                <tr>
                  <td class="linkPP" align="center"><a href="#">M&aacute;s informaci&oacute;n de publicidad, clic aqu&iacute;</a></td>
                </tr>
              </table><span class="txtEsp">&nbsp;<br /></span>
              <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
                <tr>
                  <td align="center"><img src="imgs/banner_img_1.gif" width="250" height="109" alt="" /></td>
                </tr>
                <tr>
                  <td align="center"><img src="imgs/banner_img_2.gif" width="250" height="115" alt="" /></td>
                </tr>
              </table>
              <br />
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTC">
                <tr>
                  <td>Calendario</td>
                </tr>
            </table>
              <p>&nbsp;</p></td>
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
            <td colspan="2" class="linkPP"><a href="#">&iquest;Qui&eacute;nes somos?</a></td>
            </tr>
          <tr>
            <td colspan="2" class="linkPP"><a href="#">Noticias y art&iacute;culos</a></td>
            </tr>
          <tr>
            <td width="16%"></td>
            <td width="84%" class="linkPP"><a href="#">Videos</a></td>
          </tr>
          <tr>
            <td></td>
            <td class="linkPP"><a href="#">Calendario</a></td>
          </tr>
          <tr>
            <td></td>
            <td class="linkPP"><a href="#">Archivo</a></td>
          </tr>
        </table>
          <br /></td>
        <td width="240" valign="top"><br />
          <table width="100%" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td class="linkPP"><a href="#">Bolsa de trabajo</a></td>
            </tr>
            <tr>
              <td class="linkPP"><a href="#">Directorio de proveedores</a></td>
            </tr>
          </table></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td width="100%"><span class="txtBold1">MANTENTE INFORMADO</span></td>
          </tr>
          <tr>
            <td class="linkPP"><a href="#">Contacto</a></td>
          </tr>
          <tr>
            <td class="linkPP"><a href="#">Facebook</a></td>
          </tr>
          <tr>
            <td class="linkPP"><a href="#">Twitter</a></td>
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
</body>
</html>