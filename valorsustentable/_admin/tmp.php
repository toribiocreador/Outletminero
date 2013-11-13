<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2" />
<title>Untitled Document</title>
<link href="styles/textos.css" rel="stylesheet" type="text/css" />
<link href="styles/forms.css" rel="stylesheet" type="text/css" />
<link href="styles/links.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<script language="javascript" type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
      tinyMCE.init({
          mode : "textareas"
      });
</script>


<!-- DATEPICKERCONTROL -->
<script type="text/javascript" src="datepickercontrol/datepickercontrol.js"></script>
  <script language="JavaScript">
     if (navigator.platform.toString().toLowerCase().indexOf("linux") != -1){
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol/datepickercontrol_lnx.css">');
	 }
	 else{
	 	document.write('<link type="text/css" rel="stylesheet" href="datepickercontrol/datepickercontrol.css">');
	 }
  </script>
  <link type="text/css" rel="stylesheet" href="datepickercontrol/content.css">
<!-- DATEPICKERCONTROL -->


<link href="styles/tables.css" rel="stylesheet" type="text/css" />
</head>

<body>







<div style="display: none;" class="demo-description">
<p>The datepicker is tied to a standard form input field.  Focus on the input (click, or use the tab key) to open an interactive calendar in a small overlay.  Choose a date, click elsewhere on the page (blur the input), or hit the Esc key to close. If a date is chosen, feedback is shown as the input's value.</p>
</div><!-- End demo-description -->


<p class="txtTitles"><span class="txtCont1">
<?php 
$today = getdate();
echo $today["mday"];
echo $today["mon"];
echo $today["year"];


$archivo = 'jpeg';
echo strstr('jpeg', $archivo);
//echo strstr('jpeg', $archivo);
//echo strcmp('jpeg', $archivo);

$palabra = '<object width="480" height="385"><param name="movie" value="http://www.youtube.com/v/O2kzIYUQA-0&hl=es_ES&fs=1&"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/O2kzIYUQA-0&hl=es_ES&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="480" height="385"></embed></object>';
$inicio = substr($palabra, 0, 8);

//@unlink("../imgs/gallery/3.jpg");
echo '<br /><br />';
echo date('Ymd-His');
//mkdir('12345678', 0777);
?>
</span></p>

<?php 
if (isset($_POST["observaciones"])){ echo '<p>'. $_POST["observaciones"] .'</p>'; }//if
?>

<p class="txtTitles">Agregar Proveedor</p>
<p class="txtCont1">Ingrese los datos que se solicitan a continuaci&oacute;n para agregar una un nuevo proveedor, los cuales autom&aacute;ticamente se publicar&aacute;n en el sitio web.</p>
<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=clasificados&amp;_f=addClasificado">
  <input type="hidden" name="id" value="'. $_GET["id"] .'" />
</form>




<script type="text/javascript" language="javascript">
	CKEDITOR.replace( 'contenido', { skin : 'office2003' });
</script>



<p class="txtTitles">B&uacute;squeda de Proveedores</p>
<p class="txtCont1">Filtra resultados para realizar tu b&uacute;squeda</p>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbBack1">
  <tr>
    <td>
    <form id="form3" name="form3" method="post" action="">
      <table width="800" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td width="100" class="txtCont2">Usuario:</td>
          <td><input type="text" name="user" id="user" /></td>
        </tr>
        <tr>
          <td class="txtCont2">Contrase&ntilde;a:</td>
          <td><input type="text" name="pwd2" id="pwd2" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="submit2" type="submit" class="frmBtnIngresar" id="submit2" value="Ingresar" /></td>
        </tr>
      </table>
    </form>
    </td>
  </tr>
</table>
<p class="txtCont1">&nbsp;</p>
<p class="txtTitles">B&uacute;squeda de proveedores</p>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbBack1">
  <tr>
    <td><form id="form4" name="form4" method="post" action="">
      <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr>
          <td width="150" class="txtBold">Empresa:</td>
          <td><input name="empresa" type="text" id="empresa" size="60" maxlength="255" /></td>
        </tr>
        <tr>
          <td class="txtBold">Giro:</td>
          <td>LISTGIROS</td>
        </tr>
        <tr>
          <td class="txtBold">Ciudad:</td>
          <td><input name="ciudad" type="text" id="ciudad" size="60" maxlength="255" /></td>
        </tr>
        <tr>
          <td class="txtBold">Pa&iacute;s:</td>
          <td>SELECTPAISES</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input name="submit" type="submit" class="frmBtnIngresar" id="submit" value="Buscar Proveedor" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p class="txtTitles">Agregar Noticia</p>
<p class="txtCont1">Para dar de alta tu publicaci&oacute;n selecciona lo siguiente:</p>
<p class="txtCont1">&nbsp;</p>
<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=noticias&amp;_f=guardar&amp;val='. $val .'">
  <input type="hidden" name="id3" value="'. $id .'" />
  <table width="600" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="150" valign="top" class="txtCont2">Categor&iacute;a:</td>
      <td valign="top"><select name="categoria" id="categoria">
        <option value="0">== Selecciona la categor&iacute;a ==</option>
        <option value="1">Noticias</option>
        <option value="2">Editorial</option>
      </select></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">T&iacute;tulo:</td>
      <td valign="top"><input name="titulo" type="text" id="titulo" size="60" maxlength="256" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Introducci&oacute;n:</td>
      <td valign="top"><textarea name="introduccion" id="introduccion" cols="60" rows="5"></textarea></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Contenido:</td>
      <td valign="top"><textarea name="contenido" id="contenido" cols="60" rows="8"></textarea></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Insertar video de <img src="imgs/youtube-icon.gif" width="25" height="25" alt="" /></td>
      <td valign="top"><textarea name="embed" id="embed" cols="60" rows="5"></textarea></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Imagen 1:</td>
      <td valign="top"><input type="hidden" name="MAX_FILE_SIZE" value="100000"><input name="imagen1" type="file"></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Imagen 2:</td>
      <td valign="top"><input type="hidden" name="MAX_FILE_SIZE" value="100000"><input name="imagen2" type="file"></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Imagen 3:</td>
      <td valign="top"><input type="hidden" name="MAX_FILE_SIZE" value="100000"><input name="imagen3" type="file"></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Imagen 4:</td>
      <td valign="top"><input type="hidden" name="MAX_FILE_SIZE" value="100000"><input name="imagen4" type="file"></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Imagen 5:</td>
      <td valign="top"><input type="hidden" name="MAX_FILE_SIZE" value="100000"><input name="imagen5" type="file"></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">&nbsp;</td>
      <td valign="top"><input name="enviar3" type="submit" class="frmBtnIngresar" id="enviar3" value="Agregar-Modificar" /></td>
    </tr>
  </table>
  <script type="text/javascript">
	CKEDITOR.replace( "contenido" );
  </script>
</form>
<p class="txtCont1">&nbsp;</p>

<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="?F=noticias&_f=guardar&val='. $val .'">
	<input type="hidden" name="id" VALUE="'. $id .'">
  <table width="600" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="150" valign="top" class="txtCont2">T&iacute;tulo:</td>
      <td valign="top"><input name="titulo" type="text" id="titulo" size="60" maxlength="200" value="'. $titulo .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Imagen:</td>
      <td valign="top">
			<input type="hidden" name="MAX_FILE_SIZE" value="100000">
			<input name="imagen" type="file">
			<br /><span class="txtCont1">El archivo deber&aacute; ser menor a 100 KB de lo contrario no se subir&aacute; al servidor.</span>
			<br /><span class="txtCont1">Los archivos permitidos son JPG, GIF Y PNG</span>
	  </td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Contenido:</td>
      <td valign="top"><textarea name="contenido1" id="contenido1">'. $contenido .'</textarea></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Video de Youtube</td>
      <td valign="top"><textarea name="youtube" cols="60" rows="6" id="youtube">'. $youtube .'</textarea></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">Etiquetas:</td>
      <td valign="top"><input name="etiquetas" type="text" id="etiquetas" size="60" maxlength="200" value="'. $etiquetas .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">&nbsp;</td>
      <td valign="top"> <input name="limpiar" type="reset" class="frmBtnIngresar" id="limpiar" value="Limpiar campos" /> 
	  					<input name="enviar" type="submit" class="frmBtnIngresar" id="enviar" value="Agregar-Modificar" />
	  </td>
    </tr>
  </table>
  
  <script type="text/javascript">
	CKEDITOR.replace( "contenido" );
</script>
  
</form>

<p class="txtCont1">
<form action="subearchivo.php" method="post" enctype="multipart/form-data">
    <b>Campo de tipo texto:</b>
    <br>
    <input type="text" name="cadenatexto" size="20" maxlength="100">
    <input type="hidden" name="MAX_FILE_SIZE" value="100000">
    <input name="userfile" type="file">
    <br>
    <input type="submit" value="Enviar">
</form> 


<p class="txtTitles">&nbsp;</p>


</p>
<p class="txtTitles">Ver / Eliminar Usuarios</p>
<p class="txtCont1">Para poder ver alg&uacute;n registro de alg&uacute;n usuario de clic en el icono de <img src="imgs/img_edit.png" width="20" height="20" alt="" />, para eliminar el registro, de clic en <img src="imgs/img_delete.png" width="15" height="15" alt="" /></p>
<table width="100%" border="0" cellspacing="2" cellpadding="3">
  <tr class="txtCont2Bold">
    <td style="background:#E3EEF0">Ver</td>
    <td style="background:#E3EEF0">Nombre</td>
    <td style="background:#E3EEF0">Correo</td>
    <td style="background:#E3EEF0">Nivel de Usuario</td>
    <td style="background:#E3EEF0">Borrar</td>
  </tr>
  <tr>
    <td style="background:#F7F7F7">&nbsp;</td>
    <td style="background:#F7F7F7">&nbsp;</td>
    <td style="background:#F7F7F7">&nbsp;</td>
    <td style="background:#F7F7F7">&nbsp;</td>
    <td style="background:#F7F7F7">&nbsp;</td>
  </tr>
</table>
<p class="txtCont1">&nbsp;</p>
<form id="form2" name="form1" enctype="multipart/form-data" method="post" action="?F=noticias&amp;_f=guardar&amp;val='. $val .'">
  <input type="hidden" name="id2" value="'. $id .'" />
  <table width="600" border="0" cellspacing="0" cellpadding="5">
    <tr>
      <td width="150" valign="top" class="txtCont2Bold">*T&iacute;tulo:</td>
      <td valign="top"><input name="titulo2" type="text" id="titulo2" size="60" maxlength="200" value="'. $titulo .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2Bold">*Descripci&oacute;n:</td>
      <td valign="top"><textarea name="contenido2" id="contenido2">'. $contenido .'</textarea></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2Bold">*Video de Youtube</td>
      <td valign="top"><textarea name="youtube2" cols="60" rows="6" id="youtube2">'. $youtube .'</textarea></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2Bold">Etiquetas:</td>
      <td valign="top"><input name="etiquetas2" type="text" id="etiquetas2" size="60" maxlength="200" value="'. $etiquetas .'" /></td>
    </tr>
    <tr>
      <td valign="top" class="txtCont2">&nbsp;</td>
      <td valign="top"><input name="limpiar2" type="reset" class="frmBtnIngresar" id="limpiar2" value="Limpiar campos" />
        <input name="enviar2" type="submit" class="frmBtnIngresar" id="enviar2" value="Agregar-Modificar" /></td>
    </tr>
  </table>
</form>
<p class="txtCont1">&nbsp;</p>
<p>&nbsp;</p>
<span class="txtTitles">Eliminar Categor&iacute;a.<br />
</span><span class="txtCont1">Seleccione la categor&iacute;a que desea eliminar.</span>
			<br />
			<br />
			<form id="frmCategorias" name="frmCategorias" method="post" action="?F=portfolio&amp;_f=addCat">
			  <table width="600" border="0" cellspacing="0" cellpadding="5">
				<tr>
				  <td width="150" valign="top" class="txtCont2">Nombre de la categor&iacute;a:</td>
				  <td valign="top"><select name="listNombre" id="listNombre">
				    <option value="0">== Seleccione una categor&iacute;a ==</option>
				    <option value="1">OP1</option>
                  </select></td>
				</tr>
				<tr>
				  <td valign="top" class="txtCont2">&nbsp;</td>
				  <td valign="top"><input name="enviar4" type="submit" class="frmBtnIngresar" id="enviar4" value="Crear Categor&iacute;a" /></td>
				</tr>
			  </table>
			</form>
<p class="txtCont1">&nbsp;</p>
<p class="txtCont1">&nbsp;</p>
</body>
</html>