 <?php
echo (preg_match('/global.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
include_once('Rmail/Rmail.php');

class _GLOBAL_{

public function _db(){
		include("db_conn.php");
		$con = mysql_connect($localhost,$user,$pswd) or die('Could not connect: ' . mysql_error());
		$db = mysql_select_db($bd, $con);
		return $db;
}// function _db

// Publicar la fecha en formato de texto con nombre de mes.
public function txtFechaPub($fecha){
	$miFecha = explode('-', $fecha);
	$year = $miFecha[0];	$month = $miFecha[1];	$day = $miFecha[2];
	switch($month){
		case '01': $month = 'Enero'; break;
		case '02': $month = 'Febrero'; break;
		case '03': $month = 'Marzo'; break;
		case '04': $month = 'Abril'; break;
		case '05': $month = 'Mayo'; break;
		case '06': $month = 'Junio'; break;
		case '07': $month = 'Julio'; break;
		case '08': $month = 'Agosto'; break;
		case '09': $month = 'Septiembre'; break;
		case '10': $month = 'Octubre'; break;
		case '11': $month = 'Noviembre'; break;
		case '12': $month = 'Diciembre'; break;
	}//switch month
	return $day .' de '. $month .' de '. $year;
}//txtFechaPub

// BANNERS ***************************************************************************************************
// ***********************************************************************************************************
public function bannersTopRight(){
	return '<table width="198" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="90" style="background:#CCCCCC">ESPACIO PUBLICITARIO</td>
          </tr>
        </table>
          <span class="txtEsp">&nbsp;<br /></span>
          <table width="198" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="90" style="background:#CCCCCC"><a href="http://twitter.com/@outletminero" target="_blank"><img src="imgs/bann_socialnetworks.jpg" border="0" /></a></td>
            </tr>
          </table>';
}//bannersTopRight

public function bannersMiddleRight(){
	return '<table width="198" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="90" style="background:#CCCCCC"><a href="?F=mailing&amp;_f=main"><img src="imgs/bann_mailinglist.jpg" border="0" alt=" Mailing List" /></a></td>
            </tr>
          </table>
        <span class="txtEsp">&nbsp;<br /></span>
          <table width="198" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td height="90" style="background:#CCCCCC">ESPACIO PUBLICITARIOs</td>
            </tr>
          </table>'. $this->eventsRight();
}//bannersMiddleRight

# ********************************************************* IMAGENES UPLOADING ********************************************************************
# *************************************************************************************************************************************************
		// $i = el número de la imagen que se está subiendo.
public function validar_imagen($i, $ruta, $m_ruta){
	$MAX_FILE_SIZE =  "8000000";
	$WIDTH1 = "400";
	$HEIGHT2 = "300";
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$nameFile = date('Ymd-His') . md5($_FILES["imagen".$i]["name"]);
		$image = $_FILES["imagen".$i]["name"];
		$uploadedfile = $_FILES['imagen'.$i]['tmp_name'];
		
		if ($image) {
			$filename = stripslashes($_FILES['imagen'.$i]['name']);
			$archivo = explode('.', $filename);
			$extension = $archivo[1];
			$extension = strtolower($extension);
			if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
				echo ' <h2>Extension de imagen desconocida.</h2> ';
				exit();
  			} else {
   				$size = $_FILES['imagen'.$i]['size'];					// tamano de la imagen
				if ($size > $MAX_FILE_SIZE || $size == 0) {			// size daría 0 si sobrepasa lo máximo permitido en el form HTML
					echo "You have exceeded the size limit";
					exit();
				}
				$uploadedfile = $_FILES['imagen'.$i]['tmp_name'];
				if($extension=="jpg" || $extension=="jpeg" ){
					$src = imagecreatefromjpeg($uploadedfile);
					$ext = ".jpg";
				} else if($extension=="png") {
					$src = imagecreatefrompng($uploadedfile);
					$ext = ".png";
				} else {
					$src = imagecreatefromgif($uploadedfile);
					$ext = ".gif";
				}//if extension
 
				list($width,$height)=getimagesize($uploadedfile);
				
				if ($width > $WIDTH1 || $height > $HEIGHT2){
					if($width > $height){
						$newwidth =  $WIDTH1;
						$newheight = ($height/$width)*$newwidth;
					} else {
						$newheight =  $HEIGHT2;
						$newwidth = ($width/$height)*$newheight;
					}
					if ($newwidth > $WIDTH1){
						$newwidth =  $WIDTH1;
						$newheight = ($height/$width)*$newwidth;
					}
					if ($newheight > $HEIGHT2){
						$newheight =  $HEIGHT2;
						$newwidth = ($width/$height)*$newheight;
					}
				} else {
					$newwidth = $width;
					$newheight = $height;
				}//IF
				$tmp=imagecreatetruecolor($newwidth,$newheight);
							
				// PARA CREAR EL THUMBNAIL
				$newwidth1=100;
				$newheight1=($height/$width)*$newwidth1;
				$tmp1=imagecreatetruecolor($newwidth1,$newheight1);
				
				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
				imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);

				//$filename = "../gallery/noticias/". $nameFile . $ext;
				//$filename1 = "../gallery/noticias/mini_". $nameFile . $ext;
				$filename = "../". $ruta . $nameFile . $ext;
				$filename1 = "../". $m_ruta . $nameFile . $ext;
				
				imagejpeg($tmp,$filename,80);
				imagejpeg($tmp1,$filename1,80);
				
				imagedestroy($src);
				imagedestroy($tmp);
				imagedestroy($tmp1);
			}//if
		}//if
		return $nameFile . $ext;
		
	} else {
		return '';
	}//if
}//validar_imagen


// SUBIR SOLAMENTE UNA IMAGEN ..... $i = field; $ruta = carpeta donde se guarda; ----------
public function validar_1_imagen($i, $ruta, $WIDTH, $HEIGHT){
	$MAX_FILE_SIZE =  "8000000";
	$WIDTH1 = $WIDTH;
	$HEIGHT2 = $HEIGHT;
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$nameFile = date('Ymd-His') . md5($_FILES["imagen".$i]["name"]);
		$image = $_FILES["imagen".$i]["name"];
		$uploadedfile = $_FILES['imagen'.$i]['tmp_name'];
		
		if ($image) {
			$filename = stripslashes($_FILES['imagen'.$i]['name']);
			$archivo = explode('.', $filename);
			$extension = $archivo[1];
			$extension = strtolower($extension);
			if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
				echo ' <h2>Extension de imagen desconocida.</h2> ';
				exit();
  			} else {
   				$size = $_FILES['imagen'.$i]['size'];					// tamano de la imagen
				if ($size > $MAX_FILE_SIZE || $size == 0) {			// size daría 0 si sobrepasa lo máximo permitido en el form HTML
					echo "You have exceeded the size limit";
					exit();
				}
				$uploadedfile = $_FILES['imagen'.$i]['tmp_name'];
				if($extension=="jpg" || $extension=="jpeg" ){
					$src = imagecreatefromjpeg($uploadedfile);
					$ext = ".jpg";
				} else if($extension=="png") {
					$src = imagecreatefrompng($uploadedfile);
					$ext = ".png";
				} else {
					$src = imagecreatefromgif($uploadedfile);
					$ext = ".gif";
				}//if extension
 
				list($width,$height)=getimagesize($uploadedfile);
				
				if ($width > $WIDTH1 || $height > $HEIGHT2){
					if($width > $height){
						$newwidth =  $WIDTH1;
						$newheight = ($height/$width)*$newwidth;
					} else {
						$newheight =  $HEIGHT2;
						$newwidth = ($width/$height)*$newheight;
					}
					if ($newwidth > $WIDTH1){
						$newwidth =  $WIDTH1;
						$newheight = ($height/$width)*$newwidth;
					}
					if ($newheight > $HEIGHT2){
						$newheight =  $HEIGHT2;
						$newwidth = ($width/$height)*$newheight;
					}
				} else {
					$newwidth = $width;
					$newheight = $height;
				}//IF
				$tmp=imagecreatetruecolor($newwidth,$newheight);				
				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
				$filename = "". $ruta . $nameFile . $ext;
				imagejpeg($tmp,$filename,80);
				imagedestroy($src);
				imagedestroy($tmp);
			}//if
		}//if
		return $nameFile . $ext;
	} else {
		return '';
	}//if
}//validar_1_imagen


public function validar_img_forzoso($i, $ruta, $WIDTH, $HEIGHT){
	$MAX_FILE_SIZE =  "8000000";
	$WIDTH1 = $WIDTH;
	$HEIGHT2 = $HEIGHT;
	$nameFile = date('Ymd-His');
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$image = $_FILES["imagen". $i]["name"];
		$uploadedfile = $_FILES['imagen'. $i]['tmp_name'];
		
		if ($image) {
			$filename = stripslashes($_FILES['imagen'. $i]['name']);
			$archivo = explode('.', $filename);
			$extension = $archivo[1];
			$extension = strtolower($extension);
			if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
				echo ' <h2>Extension de imagen desconocida.</h2> ';
				exit();
  			} else {
   				$size = $_FILES['imagen'. $i]['size'];					// tamano de la imagen
				if ($size > $MAX_FILE_SIZE || $size == 0) {			// size daría 0 si sobrepasa lo máximo permitido en el form HTML
					echo "You have exceeded the size limit";
					exit();
				}
				$uploadedfile = $_FILES['imagen'. $i]['tmp_name'];
				if($extension=="jpg" || $extension=="jpeg" ){
					$src = imagecreatefromjpeg($uploadedfile);
					$ext = ".jpg";
				} else if($extension=="png") {
					$src = imagecreatefrompng($uploadedfile);
					$ext = ".png";
				} else {
					$src = imagecreatefromgif($uploadedfile);
					$ext = ".gif";
				}//if extension
 
				list($width,$height)=getimagesize($uploadedfile);

				$newwidth = $WIDTH1; //NEW CODE - Para forzar el tamano
				$newheight = $HEIGHT2; //NEW CODE - Para forzar el tamano
				$tmp=imagecreatetruecolor($newwidth,$newheight);
				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
				$filename = "../gallery/bann_inicio/". $nameFile . $ext;
				imagejpeg($tmp,$filename,80);
				imagedestroy($src);
				imagedestroy($tmp);
			}//if
		}//if
		return $nameFile . $ext;
		
	} else {
		return '';
	}//if
}//validar_img_forzoso

// Publicación de eventos en la columna de la DERECHA............................
public function eventsRight(){
	$echo = '';
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM calendario ORDER BY id DESC LIMIT 3");
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$echo .= '<span class="linkCont"><a href="?F=calendario&amp;_f=mostrar&amp;id='. $row["id"] .'">'. $row["titulo"] .'</a></span><br />
                <span class="txtDet">de </span><span class="txtDetBlue">'. $row["fechainicio"] .'</span><span class="txtDet"> a </span><span class="txtDetBlue">'. $row["fechafin"] .'</span><span class="txtDet"><br />
                '. strip_tags($row["contenido"]) .'... </span><span class="linkCont"><a href="?F=calendario&amp;_f=mostrar&amp;id='. $row["id"] .'">[+]</a></span><span class="txtEsp">&nbsp;<br /><br /></span>';
	}//while
	return '<span class="txtEsp">&nbsp;<br /></span>
			<table width="198" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr><td>'. $echo .'</td></tr></table>';
}//eventsRight

# ********************************************** FORMATO DE PROOVEDORES ******************************************************
# ****************************************************************************************************************************
public function showProveedor($result, $table, $tipoComm){
	$content = '';
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){	
	
		$imagen = (isset($row["imagen"]) && $row["imagen"] != '') ? '<td width="100" valign="top"><table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs"><tr><td><img src="'. $row["imagen"] .'" alt="" border="0"  width="160" /></a></td></tr></table></td>' : '';
		$introduccion = (isset($row["descripcion"]) && $row["descripcion"] != '') ? '<br /><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">'. $row["descripcion"] .'</td></tr></table>' : '';
		$content .= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
          <tr>
            <td class="linkTitNot">'. $row["empresa"] .'</a></td>
          </tr>
		  <form id="frmModProv" name="frmModProv" method="post" action="?F=proveedores&amp;_f=modPro&amp;id='.$row["id"].'">
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
			<tr>
			<td><span class="txtBold">Secci&oacute;n: '. $row["seccion"] .' --> Giro: '. $row["giro"] .'</span></td>
            </tr>
			<tr>
			<td><input name="Actualizar datos" type="submit" class="frmButtonM" id="Actualizar datos" value="Actualizar datos" /></td>
			</tr>
          </table>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td width="150" valign="top" class="txtBold">Nombre:</td>
              <td><input name="us_nombreM" type="text" class="frmInputM" id="us_nombreM" size="30" maxlength="100" /></td>
			</tr>
			<tr>
              <td width="150" valign="top" class="txtBold">Password:</td>
              <td><input name="us_passwordM" type="password" class="frmInputM" id="us_passwordM" size="30" maxlength="100" /></td>
			 </tr>
			 </table>
			</form>
          <table width="100%" border="0" cellspacing="0" cellpadding="10">
            <tr>
              '. $imagen .'
              <td valign="top" class="txtCont">'.$row["descripcion"].'<br><br>Direcci&oacute;n:<br>'.$row["calle"].' '.$row["numext"].'<br> '.$row["colonia"].' '.$row["cp"].
			  '<br> '.$row["ciudad"].', '.$row["estado"].' '.$row["pais"].'<br><br>Contacto:<br>'.$row["us_nombre"].' '.$row["us_apellidos"].'<br>'.$row["us_puesto"].'<br>'.  
            	$row["us_correo"].'<br>
				<br>Tel&eacute;fono: '.$row["telefonos"].' |  
                <span class="linkPP"><a href="http://'.$row["sitioweb"].'">'.$row["sitioweb"].'</a></span>
			</tr>
          </table>
          <br />';
	}//while
	mysql_free_result($result);
	return $content;
}//showProveedores

# ********************************************** FORMATO DE PUBLICACIÓN ******************************************************
# ****************************************************************************************************************************
public function showPublicacion($result, $table, $tipoComm){
	$content = '';
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){		
		$imagen = (isset($row["imagen"]) && $row["imagen"] != '') ? '<td width="100" valign="top"><table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs"><tr><td><a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'"><img src="'. $row["imagen"] .'" alt="" border="0"  width="200" /></a><span class="txtPP">Foto: '. $row["pf"] .'</span></td></tr></table></td>' : '<td valign="top"><iframe width="215" height="152" src="'. $row["embed"] .'" frameborder="0" allowfullscreen></iframe></td>';
		$introduccion = (isset($row["introduccion"]) && $row["introduccion"] != '') ? '<br /><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">'. $row["introduccion"] .'</td></tr></table>' : '';
		$content .= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
          <tr>
            <td class="linkTitNot"><a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'">'. $row["titulo"] .'</a></td>
          </tr>
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont"><!-- Publicado el--><span class="txtBold"> '. $row["fechapub"] .'</span><!--, En <span class="linkCont"><a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=main">'. $this->nombreSeccion[$tipoComm] .'</a></span> por '. $row["autor"] .'--></td>
            </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="10">
            <tr>
              '. $imagen .'
              <td valign="top" class="txtCont">'.substr($row["introduccion"],0,500).'...
                <p><span class="linkCont"><a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'">Ver publicaci&oacute;n completa</a></span> | <span class="linkCont"><a href="?F=comentarios&amp;_f=main&amp;tipo='. $tipoComm .'&amp;id='. $row["id"] .'">Deja tu comentario</a></span></p>
                </td>
            </tr>
          </table>
          <br />';
	}//while
	mysql_free_result($result);
	return $content;
}//showPublicacion

public $seccion = array(1 => 'editoriales',
						2 => 'noticias',
						3 => 'entrevistas');
public $nombreSeccion = array(1 => 'Editoriales',
						2 => 'Noticias y Art&iacute;culos',
						3 => 'Entrevistas');

# SLIDESHOWS DEL SITIO WEB ********************************************************************************************
# **********************************************************************************************************************
public function JScodeSlideshow($fadeshow, $WIDTH, $HEIGHT){
	$echo = ''; $i = 0;
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM bann_inicio ORDER BY id DESC");
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$echo .= ($i == 0) ? '' : ',';
		$echo .= '["'. $row["imagen"] .'", "'. $row["enlace"] .'", "", "'. strip_tags($row["contenido"]) .'"]';
		$i++;
	}//while
	
	return '
<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/fadeslideshow.js"></script>
<script type="text/javascript">
	var mygallery2=new fadeSlideShow({
		wrapperid: "fadeshow'. $fadeshow .'", //ID of blank DIV on page to house Slideshow
		dimensions: ['. $WIDTH.', '. $HEIGHT .'], //width/height of gallery in pixels. Should reflect dimensions of largest image
		imagearray: [
			'. $echo .'
		],
		displaymode: {type:\'auto\', pause:5000, cycles:0, wraparound:false},
		persist: false, //remember last viewed slide and recall within same session?
		fadeduration: 1000, //transition duration (milliseconds)
		descreveal: "always",
		togglerid: "fadeshow2toggler"
	})
</script>';
}//codeJSSlideshow

# SELECCIÓN DE PAÍSES *************************************************************************************************************
# *********************************************************************************************************************************
public function selectPaises(){
	return '<select name="pais" class="frmInputM">
      <option value="Afganistan">Afganistán</option>
      <option value="Albania">Albania</option>
      <option value="Alemania">Alemania</option>
      <option value="Andorra">Andorra</option>
      <option value="Angola">Angola</option>
      <option value="Anguilla">Anguilla</option>
      <option value="Ant&aacute;rtida">Ant&aacute;rtida</option>
      <option value="Antigua y Barbuda">Antigua y Barbuda</option>
      <option value="Antillas Holandesas">Antillas Holandesas</option>
      <option value="Arabia Saud&iacute;">Arabia Saud&iacute;</option>
      <option value="Argelia">Argelia</option>
      <option value="Argentina">Argentina</option>
      <option value="Armenia">Armenia</option>
      <option value="Aruba">Aruba</option>
      <option value="Australia">Australia</option>
      <option value="Austria">Austria</option>
      <option value="Azerbaiy&aacute;n">Azerbaiy&aacute;n</option>
      <option value="Bahamas">Bahamas</option>
      <option value="Bahrein">Bahrein</option>
      <option value="Bangladesh">Bangladesh</option>
      <option value="Barbados">Barbados</option>
      <option value="B&eacute;lgica">B&eacute;lgica</option>
      <option value="Belice">Belice</option>
      <option value="Benin">Benin</option>
      <option value="Bermudas">Bermudas</option>
      <option value="Bielorrusia">Bielorrusia</option>
      <option value="Birmania">Birmania</option>
      <option value="Bolivia">Bolivia</option>
      <option value="Bosnia y Herzegovina">Bosnia y Herzegovina</option>
      <option value="Botswana">Botswana</option>
      <option value="Brasil">Brasil</option>
      <option value="Brunei">Brunei</option>
      <option value="Bulgaria">Bulgaria</option>
      <option value="Burkina Faso">Burkina Faso</option>
      <option value="Burundi">Burundi</option>
      <option value="But&aacute;n">But&aacute;n</option>
      <option value="Cabo Verde">Cabo Verde</option>
      <option value="Camboya">Camboya</option>
      <option value="Camer&uacute;n">Camer&uacute;n</option>
      <option value="Canad&aacute;">Canad&aacute;</option>
      <option value="Chad">Chad</option>
      <option value="Chile">Chile</option>
      <option value="China">China</option>
      <option value="Chipre">Chipre</option>
      <option value="Ciudad del Vaticano">Ciudad del Vaticano</option>
      <option value="Colombia">Colombia</option>
      <option value="Comores">Comores</option>
      <option value="Congo">Congo</option>
      <option value="Congo, Rep&uacute;blica Democr&aacute;tica del">Congo, Rep&uacute;blica Democr&aacute;tica del</option>
      <option value="Corea">Corea</option>
      <option value="Corea del Norte">Corea del Norte</option>
      <option value="Costa de Marfíl">Costa de Marfíl</option>
      <option value="Costa Rica">Costa Rica</option>
      <option value="Croacia">Croacia</option>
      <option value="Cuba">Cuba</option>
      <option value="Dinamarca">Dinamarca</option>
      <option value="Djibouti">Djibouti</option>
      <option value="Dominica">Dominica</option>
      <option value="Ecuador">Ecuador</option>
      <option value="Egipto">Egipto</option>
      <option value="El Salvador">El Salvador</option>
      <option value="Emiratos &Aacute;rabes Unidos">Emiratos &Aacute;rabes Unidos</option>
      <option value="Eritrea">Eritrea</option>
      <option value="Eslovenia">Eslovenia</option>
      <option value="Espana">Espana</option>
      <option value="Estados Unidos">Estados Unidos</option>
      <option value="Estonia">Estonia</option>
      <option value="Etiop&iacute;a">Etiop&iacute;a</option>
      <option value="Fiji">Fiji</option>
      <option value="Filipinas">Filipinas</option>
      <option value="Finlandia">Finlandia</option>
      <option value="Francia">Francia</option>
      <option value="Gab&oacute;n">Gab&oacute;n</option>
      <option value="Gambia">Gambia</option>
      <option value="Georgia">Georgia</option>
      <option value="Ghana">Ghana</option>
      <option value="Gibraltar">Gibraltar</option>
      <option value="Granada">Granada</option>
      <option value="Grecia">Grecia</option>
      <option value="Groelandia">Groenlandia</option>
      <option value="Guadalupe">Guadalupe</option>
      <option value="Guam">Guam</option>
      <option value="Guatemala">Guatemala</option>
      <option value="Guayana">Guayana</option>
      <option value="Guayana Francesa">Guayana Francesa</option>
      <option value="Guinea">Guinea</option>
      <option value="Guinea Ecuatorial">Guinea Ecuatorial</option>
      <option value="Guinea-Bissau">Guinea-Bissau</option>
      <option value="Haut&iacute;">Hait&iacute;</option>
      <option value="Honduras">Honduras</option>
      <option value="Hungr&iacute;a">Hungr&iacute;a</option>
      <option value="India">India</option>
      <option value="Indonesia">Indonesia</option>
      <option value="Irak">Irak</option>
      <option value="Ir&aacute;n">Ir&aacute;n</option>
      <option value="Irlanda">Irlanda</option>
      <option value="Isla Bouvet">Isla Bouvet</option>
      <option value="Isla de Christmas">Isla de Christmas</option>
      <option value="Islandia">Islandia</option>
      <option value="Islas Caim&aacute;n">Islas Caim&aacute;n</option>
      <option value="Islas Cook">Islas Cook</option>
      <option value="Islas de Cocos o Keeling">Islas de Cocos o Keeling</option>
      <option value="Islas Faroe">Islas Faroe</option>
      <option value="Islas Heard y McDonald">Islas Heard y McDonald</option>
      <option value="Islas Malvinas">Islas Malvinas</option>
      <option value="Islas Marianas del Norte">Islas Marianas del Norte</option>
      <option value="Islas Marshall">Islas Marshall</option>
      <option value="Islas menores de Estados Unidos">Islas menores de Estados Unidos</option>
      <option value="Islas Palau">Islas Palau</option>
      <option value="Islas Salom&oacute;n">Islas Salom&oacute;n</option>
      <option value="Islas Svalbard y Jan Mayen">Islas Svalbard y Jan Mayen</option>
      <option value="Islas Tokelau">Islas Tokelau</option>
      <option value="Islas Turks y Caicos">Islas Turks y Caicos</option>
      <option value="Islas V&iacute;rgenes">Islas V&iacute;rgenes (EE.UU.)</option>
      <option value="Islas V&iacute;rgenes (Reino Unido)">Islas V&iacute;rgenes (Reino Unido)</option>
      <option value="Islas Wallis y Futuna">Islas Wallis y Futuna</option>
      <option value="Israel">Israel</option>
      <option value="Italia">Italia</option>
      <option value="Jamacia">Jamaica</option>
      <option value="Jap&oacute;n">Jap&oacute;n</option>
      <option value="Jordania">Jordania</option>
      <option value="Kazajist&aacute;n">Kazajist&oacute;n</option>
      <option value="Kenia">Kenia</option>
      <option value="Kirguizist&aacute;">Kirguizist&aacute;n</option>
      <option value="Kiribati">Kiribati</option>
      <option value="Kuwait">Kuwait</option>
      <option value="Laos">Laos</option>
      <option value="Lesotho">Lesotho</option>
      <option value="Lethonia">Letonia</option>
      <option value="L&iacute;bano">L&iacute;bano</option>
      <option value="Liberia">Liberia</option>
      <option value="Libia">Libia</option>
      <option value="Liechtenstein">Liechtenstein</option>
      <option value="Lituania">Lituania</option>
      <option value="Luxemburgo">Luxemburgo</option>
      <option value="Macedonia, Ex-Rep&uacute;blica Yugoslava de">Macedonia, Ex-Rep&uacute;blica Yugoslava de</option>
      <option value="Madagascar">Madagascar</option>
      <option value="Malasia">Malasia</option>
      <option value="Malawi">Malawi</option>
      <option value="Maldivas">Maldivas</option>
      <option value="Mal&iacute;">Mal&iacute;</option>
      <option value="Malta">Malta</option>
      <option value="Marruecos">Marruecos</option>
      <option value="Martinica">Martinica</option>
      <option value="Mauricio">Mauricio</option>
      <option value="Mauritania">Mauritania</option>
      <option value="Mayotte">Mayotte</option>
      <option value="M&eacute;xico" selected="selected">M&eacute;xico</option>
      <option value="Micronesia">Micronesia</option>
      <option value="Moldavia">Moldavia</option>
      <option value="M&oacute;naco">M&oacute;naco</option>
      <option value="Mongolia">Mongolia</option>
      <option value="Montserrat">Montserrat</option>
      <option value="Mozambique">Mozambique</option>
      <option value="Namibia">Namibia</option>
      <option value="Nauru">Nauru</option>
      <option value="Nepal">Nepal</option>
      <option value="Nicaragua">Nicaragua</option>
      <option value="N&iacute;ger">Níger</option>
      <option value="Nigeria">Nigeria</option>
      <option value="Niue">Niue</option>
      <option value="Norfolk">Norfolk</option>
      <option value="Nruega">Noruega</option>
      <option value="Nueva Caledonia">Nueva Caledonia</option>
      <option value="Nueva Zelanda">Nueva Zelanda</option>
      <option value="Om&aacute;n">Om&aacute;n</option>
      <option value="Pa&iacute;ses Bajos">Pa&iacute;ses Bajos</option>
      <option value="Panam&aacute;">Panam&aacute;</option>
      <option value="Pap&uacute;a Nueva Guinea">Pap&uacute;a Nueva Guinea</option>
      <option value="Paquist&aacute;n">Paquist&aacute;n</option>
      <option value="Paraguay">Paraguay</option>
      <option value="Per&uacute;">Per&uacute;</option>
      <option value="Pitcairn">Pitcairn</option>
      <option value="Polinesia Francesa">Polinesia Francesa</option>
      <option value="Polonia">Polonia</option>
      <option value="Portugal">Portugal</option>
      <option value="Puerto Rico">Puerto Rico</option>
      <option value="Qatar">Qatar</option>
      <option value="Reino Unido">Reino Unido</option>
      <option value="Rep&uacute;blica Centroafricana">Rep&uacute;blica Centroafricana</option>
      <option value="Rep&uacute;blica Checa">Rep&uacute;blica Checa</option>
      <option value="Rep&uacute;blica de Sud&aacute;frica">Rep&uacute;blica de Sud&aacute;frica</option>
      <option value="Rep&uacute;blica Dominicana">Rep&uacute;blica Dominicana</option>
      <option value="Rep&uacute;blica Eslovaca">Rep&uacute;blica Eslovaca</option>
      <option value="Reuni&oacute;n">Reuni&oacute;n</option>
      <option value="Ruanda">Ruanda</option>
      <option value="Rumania">Rumania</option>
      <option value="Rusia">Rusia</option>
      <option value="Sahara Occidental">Sahara Occidental</option>
      <option value="Saint Kitts y Nevis">Saint Kitts y Nevis</option>
      <option value="Samoa">Samoa</option>
      <option value="Samoa Americana">Samoa Americana</option>
      <option value="San Marino">San Marino</option>
      <option value="San Vicente y Granadinas">San Vicente y Granadinas</option>
      <option value="Santa Helena">Santa Helena</option>
      <option value="Santa Luc&iacute;a">Santa Luc&iacute;a</option>
      <option value="Santo Tom&eacute; y Pr&iacute;ncipe">Santo Tom&eacute; y Pr&iacute;ncipe</option>
      <option value="Senegal">Senegal</option>
      <option value="Seychelles">Seychelles</option>
      <option value="Sierra Leona">Sierra Leona</option>
      <option value="Singapur">Singapur</option>
      <option value="Siria">Siria</option>
      <option value="Somalia">Somalia</option>
      <option value="Sri Lanka">Sri Lanka</option>
      <option value="St. Pierre y Miquelon">St. Pierre y Miquelon</option>
      <option value="Suazilandia">Suazilandia</option>
      <option value="Sud&aacute;n">Sud&aacute;n</option>
      <option value="Suecia">Suecia</option>
      <option value="Suiza">Suiza</option>
      <option value="Surinam">Surinam</option>
      <option value="Tailandia">Tailandia</option>
      <option value="Taiw&aacute;n">Taiw&aacute;n</option>
      <option value="Tanzania">Tanzania</option>
      <option value="Tayikist&aacute;n">Tayikist&aacute;n</option>
      <option value="Territorios franceses del Sur">Territorios franceses del Sur</option>
      <option value="Timor Oriental">Timor Oriental</option>
      <option value="Togo">Togo</option>
      <option value="Tonga">Tonga</option>
      <option value="Trinidad y Tobago">Trinidad y Tobago</option>
      <option value="T&uacute;nez">T&uacute;nez</option>
      <option value="Turkmenist&aacute;n">Turkmenist&aacute;n</option>
      <option value="Turqu&iacute;a">Turqu&iacute;a</option>
      <option value="Tuvalu">Tuvalu</option>
      <option value="Ucrania">Ucrania</option>
      <option value="Uganda">Uganda</option>
      <option value="Uruguay">Uruguay</option>
      <option value="Uzbekist&aacute;n">Uzbekist&aacute;n</option>
      <option value="Vanuatu">Vanuatu</option>
      <option value="Venezuela">Venezuela</option>
      <option value="Vietnam">Vietnam</option>
      <option value="Yemen">Yemen</option>
      <option value="Yugoslavia">Yugoslavia</option>
      <option value="Zambia">Zambia</option>
      <option value="Zimbabue">Zimbabue</option>
      </select>';
}//selectPaises



// ******************************************** BOLSA DE TRABAJO *********************************************************************
// ************************************************************ *********************************************************************

public function frmValidarUsuarioRight(){	// Para publicar en la columna de la derecha.............................................
	if (isset($_SESSION["autorizado"]) && $_SESSION["autorizado"] == 'SI'){
		switch ($_SESSION["tipo"]){
			case '1':
				$echo = '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTC">
						 <tr>
						   <td>Mi Cuenta</td>
						 </tr>
					   </table>
					   <span class="txtEsp">&nbsp;<br /></span>
						<table width="90%" border="0" align="center" cellpadding="2" cellspacing="0" bgcolor="#FFFFFF">
						  <tr>
						    <td width="10" class="txtBold">+</td>
							<td class="linkCont"><a href="?F=usuarios&amp;_f=frmSolicitud">Administrar curriculum</a></td>
						  </tr>
						  <tr>
						    <td class="txtBold">+</td>
							<td class="linkCont"><a href="?F=comentarios&amp;_f=ver">Ver mis comentarios</a></td>
						  </tr>
						  <tr>
						    <td class="txtBold">+</td>
						    <td class="linkCont"><a href="?F=usuarios&amp;_f=cerrarSesion">Cerrar Sesi&oacute;n</a></td>
					      </tr>
						</table>';
			break;
			case '2':
			$echo = '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTC">
					 <tr>
					   <td>Mi Cuenta</td>
					 </tr>
				   </table>
				   <span class="txtEsp">&nbsp;<br /></span>
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
						</table>';
			break;
		}//switch
		
	} else {
			$echo = '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTC">
						<tr>
						  <td>Iniciar sesi&oacute;n</td>
						</tr>
					  </table><span class="txtEsp">&nbsp;<br /></span>
					  <form id="frmUsuarios" name="frmUsuarios" method="post" action="?F=usuarios&amp;_f=validar">
						<table width="90%" border="0" align="center" cellpadding="4" cellspacing="0" bgcolor="#FFFFFF">
						  <tr>
							<td width="80" class="txtPPBold" align="right">Usuario:</td>
							<td><input name="usuario" type="text" class="frmInputM" id="usuario" /></td>
						  </tr>
						  <tr>
							<td class="txtPPBold" align="right">Contrasena:</td>
							<td><input name="pwd" type="password" class="frmInputM" id="pwd" /></td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td><input name="button2" type="submit" class="frmButtonM" id="button2" value="Ingresar" /><br />
							  <span class="linkCont"><a href="?F=registro&amp;_f=recuperarClave">Olvidaste tu clave? clic aqu&iacute;</a></span>
							  <span class="linkCont"><a href="?F=registro&amp;_f=main">Deseo registrarme, clic aqu&iacute;</a></span>
							  </td>
						  </tr>
						</table>
					  </form>
					  <span class="txtEsp">&nbsp;<br /></span>
							  
				  <script language="JavaScript" type="text/javascript">
					 var frmvalidator = new Validator("frmUsuarios");
					 frmvalidator.addValidation("usuario","req","Ingrese su correo electr\u00F3nico");
					 frmvalidator.addValidation("pwd","req","Ingrese su clave");
				  </script>
				  ';
	}//if
	return $echo .' <span class="txtEsp">&nbsp;<br /></span>';
}//validarUsuario


public function paginacion($LIMIT, $table, $seccion, $subseccion){
	$i = 0; $echo = '<span class="txtCont">P&aacute;ginas: </span>'; $pagina = 1;
	$result = mysql_query("SELECT * FROM {$table} ORDER BY id DESC");
	$totalPub = mysql_num_rows($result);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$resto = $i % $LIMIT;
		if ($resto == 0){
			$echo .= '<span class="linkCont"><a href="?F='. $seccion .'&amp;_f='. $subseccion .'&amp;ver='. $i .'">'. $pagina .'</a></span><span class="txtCont"> - </span>';
			$pagina++;
		}
		$i++;
	}
	return '<table width="100%" cellpadding="15" cellspacing="0" align="center"><tr><td>'. $echo .'</td></tr></table>';
}//paginacion

public function paginacionP($LIMIT, $result, $seccion, $subseccion){
	$i = 0; $echo = '<span class="txtCont">P&aacute;ginas: </span>'; $pagina = 1;
	//$result = mysql_query("SELECT * FROM {$table} ORDER BY id DESC");
	$totalPub = mysql_num_rows($result);
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$resto = $i % $LIMIT;
		if ($resto == 0){
			$echo .= '<span class="linkCont"><a href="?F='. $seccion .'&amp;_f='. $subseccion .'&amp;ver='. $i .'">'. $pagina .'</a></span><span class="txtCont"> - </span>';
			$pagina++;
		}
		$i++;
	}
	return '<table width="100%" cellpadding="15" cellspacing="0" align="center"><tr><td>'. $echo .'</td></tr></table>';
}//paginacion

private function noRegistros(){
	return '<blockquote><span class="txtTitNot">No existen registros</span></blockquote>';
}//noRegistros


# ********* COMENTARIOS *******************************************************************************************
# *****************************************************************************************************************
public function showComments($seccion, $id_publicacion){
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM comentarios WHERE seccion='{$seccion}' AND id_publicacion='{$id_publicacion}' AND activo='1' ORDER BY id DESC");
	$echo = '<p class="txtTit">Comentarios en esta publicaci&oacute;n</p>';
	if (mysql_num_rows($result) > 1) { $echo = '<p class="txtTit">Comentarios en esta publicaci&oacute;n</p>'; } else { $echo = ''; }//if
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$id_usuario = $row["id_usuario"];
		$result2 = mysql_query("SELECT * FROM usuariosweb WHERE id='{$id_usuario}'");
		$row2 = mysql_fetch_array($result2, MYSQL_ASSOC);
		$nombre = $row["usuario"];	
		mysql_free_result($result2);
		
		$echo .= '
          <table width="100%" border="0" cellspacing="0" cellpadding="2" class="tbComments">
            <tr>
              <td class="txtCont">Publicado el<span class="txtBold"> '. $this->txtFechaPub($row["fechapub"]) .'</span>, por '. $nombre .'</td>
			</tr>
			<tr>
              <td class="txtPP">'. $row["comentario"] .'</td>
            </tr>
          </table><br />';
	}//while
	return $echo;
}//showComments


# ********* PARA FORMULARIO DE PROVEEDORES ************************************************************************
# *****************************************************************************************************************
public function listGiros($id){
	$echo = '<select name="giro" id="giro" class="frmInputM">';//<option value="0">== Seleccione una Secci&oacute;n ==</option>';
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM giros ORDER BY nombre");
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$selected = ($row["id"] == $id) ? 'selected="selected" ' : '';
		$echo .= '<option '. $selected .'value="'. $row["id"] .'">'. $row["nombre"] .'</option>';
	}//while
	return $echo .'</select>';
}//listGiros

public $dias = array(1 => 'lunes', 2 => 'martes', 3 => 'miercoles', 4 => 'jueves', 5 => 'viernes', 6 => 'sabado', 7 => 'domingo');
public $diasL = array(1 => 'L', 2 => 'M', 3 => 'M', 4 => 'J', 5 => 'V', 6 => 'S', 7 => 'D');

public function listDiasAtencion($diasatencion){
	$days = explode(',', $diasatencion);	$j = 0;
	$echo = '<table cellpadding="0" cellspacing="0"><tr>';
	for ($i= 1; $i<=7; $i++){
		$checked = '';
		//echo $days[$j] .' = '. $i .'<br />';
		if (isset($days[$j]) && $days[$j] == $i){
			$checked = 'checked="yes" ';
			$j++;
		}//if
		$echo .= '<td>'. $this->diasL[$i] .'</td>
                  <td><input type="checkbox" name="'. $this->dias[$i] .'" value="'. $i .'" '. $checked .'/></td>';
	}//for
	return $echo .'</tr></table>';
}//diasatencion


}//class
?>