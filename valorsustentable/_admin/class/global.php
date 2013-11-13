<?php
echo (preg_match('/global.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';

class _GLOBAL_{

public function _db(){
		include("../db_conn.php");
		$con = mysql_connect($localhost,$user,$pswd) or die('Could not connect: ' . mysql_error());
		$db = mysql_select_db($bd, $con);
		return $db;
}// function _db

// Publicar con texto los niveles de usuario......
public function nivelUsuario($nivel){
	switch($nivel){
		case '0': return 'NO ASIGNADO'; break;
		case '1': return 'Administrador'; break;
		case '2': return 'Editor General'; break;
		case '3': return 'Editorial'; break;
		case '6': return 'First Majestic'; break;
		case '9': return 'Proveedores'; break;
		case '10': return 'Directorio de Proveedores'; break;
	}//switch
	
}//nivelUsuario

// Publicar con texto los niveles de usuario......
public function seccionNoticia($seccion){
	switch($seccion){
		case '0': return 'Sin secci&oacute;n'; break;
		case '4': return 'Financieras'; break;
		case '1': return 'Sociales'; break;
		case '2': return 'Sustentable'; break;
		case '5': return 'Nuevos Proyectos'; break;
		case '6': return 'Metales al d&iacute;a'; break;
		case '7': return 'Eventos'; break;
		case '3': return 'Informativo'; break;
	}//switch
	
}//nivelUsuario

public function seeDelete(){
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM noticias ORDER BY id DESC");
	$echo = '';
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$fechapub = $this->txtFechaPub($row["fechapub"]);
			$contenido = substr($row["contenido"], 0, 330);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=noticias&amp;_f=addMod&amp;id='. $row["id"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7" class="linkCont"><a href="?F=noticias&amp;_f=addMod&amp;id='. $row["id"] .'">'. $row["titulo"] .' </a></td>
						<td style="background:#F7F7F7"><span class="txtMiniBck">'. strip_tags($contenido) .'...</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $fechapub .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["autor"] .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="javascript:void(ConfirmDelete(\'?F=noticias&amp;_f=delNoticia&amp;id='. $row["id"] .'\'))"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<p class="txtTitles">Listado de Noticias</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="2">
				  <tr class="txtCont2Bold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">T&iacute;tulo</td>
					<td style="background:#E3EEF0" align="center">Contenido</td>
					<td style="background:#E3EEF0" align="center" width="170">Publicaci&oacute;n</td>
					<td style="background:#E3EEF0" align="center">Autor</td>
					<td style="background:#E3EEF0" width="30" align="center">Borrar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//

public function listNiveles($nivel){
	$niveles = array(1 => 'Administrador',
					 2 => 'Editor General',
					 3 => 'Editorial',
					 4 => 'Noticias',
					 5 => 'Art&iacute;culos y entrevistas',
					 6 => 'First Majestic',
					 7 => 'Videos',
					 8 => 'Anuncios Clasificados',
					 9 => 'Directorio de Mineria',
					 10 => 'Directorio de Proveedores');
	$total = count($niveles);
	$sel = '';
	$echo = '<select name="nivel" id="nivel"><option value="0">== Seleccione el nivel de acceso ==</option>';
	for ($i=1; $i<=$total; $i++){
		if ($i == $nivel){ $sel = 'selected="selected" '; }
		$echo .= '<option value="'. $i .'" '. $sel .'>'. $niveles[$i] .'</option>';
		$sel = '';
	}//for
	$echo .= '</select>';
	return $echo;
}//niveles

public $seccion = array(1 => 'editoriales',
						2 => 'noticias',
						3 => 'entrevistas',
						4 => 'foro');
public $seccionN = array('editoriales'=>1,
						'noticias'=>2,
						'entrevistas'=>3,
						'foro'=>4);
public $categorias = array(1 => 'Editorial',
						   2 => 'Noticias',
						   3 => 'Art&iacute;culos y entrevistas');

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
				$filename = "../". $ruta . $nameFile . $ext;
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

// SUBIR SOLAMENTE UNA IMAGEN ..... $i = field; $ruta = carpeta donde se guarda; ----------
public function validar_1_imagen_marcaAgua($i, $ruta, $WIDTH, $HEIGHT){
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
				
				//Marca de agua
				// obtener datos de la fotografia
				$anchura_original = $newwidth;
				$altura_original = $newheight;
				
				// obtener datos de la "marca de agua"
				$info_marcadeagua = getimagesize('../imgs/logo_marcaAgua.png');
				$anchura_marcadeagua = $info_marcadeagua[0];
				$altura_marcadeagua = $info_marcadeagua[1];
				
				// calcular la posici?n donde debe copiarse la "marca de agua" en la fotografia
				$horizextra = $anchura_original - $anchura_marcadeagua;
				$vertextra = $altura_original - $altura_marcadeagua;
				$horizmargen = round($horizextra-5);
				$vertmargen = round($vertextra-5);
				
				// crear imagen desde el original
				ImageAlphaBlending($tmp, true);
				
				// crear nueva imagen desde la marca de agua
				$marcadeagua = imagecreatefrompng('../imgs/logo_marcaAgua.png');
				
				// copiar la "marca de agua" en la fotografia
				ImageCopy($tmp, $marcadeagua, $horizmargen, $vertmargen, 0, 0, $anchura_marcadeagua,
				$altura_marcadeagua);
				
				$filename = "../". $ruta . $nameFile . $ext;
				imagejpeg($tmp,$filename,80);
				imagedestroy($src);
				imagedestroy($tmp);
				// cerrar las im?genes
				//imagedestroy($original);
				imagedestroy($marcadeagua);
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

# SLIDESHOWS DEL SITIO WEB ********************************************************************************************
# **********************************************************************************************************************
public function slideGaleria(){
	$content='<!-- SLIDE -->
			<script src="../js/jquery-1.6.1.min.js" type="text/javascript"></script>
			<link rel="stylesheet" href="../css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
			<script src="../js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
			<ul class="gallery clearfix">';
	for($x=1;$x<=9;$x++){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM galeriaFotografica WHERE clasificacion='{$x}'");
		switch($x){
			case 1:	$content .= '<p class="txtCont2">Desarrollo Comunitario</p>'; break;
			case 2:	$content .= '<p class="txtCont2">Empresas</p>'; break;
			case 3:	$content .= '<p class="txtCont2">Inversiones</p>'; break;
			case 4:	$content .= '<p class="txtCont2">Mineras</p>'; break;
			case 5:	$content .= '<p class="txtCont2">Otros</p>'; break;
			case 6:	$content .= '<p class="txtCont2">Personas</p>'; break;
			case 7:	$content .= '<p class="txtCont2">Protestas</p>'; break;
			case 8:	$content .= '<p class="txtCont2">Seguridad</p>'; break;
			case 9:	$content .= '<p class="txtCont2">Sustentables</p>'; break;
		}
		$content.='<table cellspacing="0" cellpadding="0">';
		$count = 1;
		$actual = 1;
		$imagen = 1;
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			if($actual!=$row["clasificacion"]){
				$actual = $row["clasificacion"];
				$count = 1;
				$content .= '</tr>';
			}
			if($count==11||$count==1)
				$content .= '<tr>';
			$content .= '
				<td>
					<table>
						 <tr><td><a href="../'. $row["imagen"] .'" rel="prettyPhoto[gallery'.$row["clasificacion"].']"><img src="../Scripts/timthumb.php?src=../'. $row["imagen"] .'&a=c&w=60&h=60" width="60" height="60" alt="'. $row["titulo"] .'" /></a></td></tr>
						 <tr><td><input type="radio" name="galerias" value="'. $row["imagen"] .'">'.$imagen.'</td>
						 </tr>
					 </table>
				</td>
				';
			$count++;
			if($count==11){
				$content .= '</tr>';
				$count = 1;
			}
			$imagen ++;
		}
		if($count!=11)
				$content .= '</tr>';
		$content .= '</table>';
	}
	$content.='</ul>	
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$("area[rel^=\'prettyPhoto\']").prettyPhoto();
				
				$(".gallery:first a[rel^=\'prettyPhoto\']").prettyPhoto({animation_speed:\'normal\',theme:\'light_square\',slideshow:10000, autoplay_slideshow: false});
				$(".gallery:gt(0) a[rel^=\'prettyPhoto\']").prettyPhoto({animation_speed:\'fast\',slideshow:10000, hideflash: true});
		
				$("#custom_content a[rel^=\'prettyPhoto\']:first").prettyPhoto({
					custom_markup: \'<div id="map_canvas" style="width:260px; height:265px"></div>\',
					changepicturecallback: function(){ initialize(); }
				});
	
				$("#custom_content a[rel^=\'prettyPhoto\']:last").prettyPhoto({
					custom_markup: \'<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>\',
					changepicturecallback: function(){ _bsap.exec(); }
				});
			});
			</script>';
	return $content;
}//codeJSSlideshow

public function listGiros($id){
	$echo = '<select name="giro" id="giro"><option value="0">== Seleccione un Giro ==</option>';
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM giros ORDER BY nombre");
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$selected = ($row["id"] == $id) ? 'selected="selected" ' : '';
		$echo .= '<option '. $selected .'value="'. $row["id"] .'">'. $row["nombre"] .'</option>';
	}//while
	return $echo .'</select>';
}//listGiros

public function selectPaises(){
	return '<select name="pais">
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

/*-------------------BIBLIOTECA-----------------------------------*/
public function listCat($id){
	$echo = '<select name="cat" id="cat"><option value="0">== Seleccione una Categoria ==</option>';
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM categorias ORDER BY nombre");
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$selected = ($row["id"] == $id) ? 'selected="selected" ' : '';
		$echo .= '<option '. $selected .'value="'. $row["id"] .'">'. $row["nombre"] .'</option>';
	}//while
	return $echo .'</select>';
}//listCat

public function listSC($id){
	$echo = '<select name="sc" id="sc"><option value="0">== Seleccione una Subcategoria ==</option>';
	$db = $this->_db();
	$result1 = mysql_query("SELECT * FROM categorias ORDER BY nombre");
	while ($row1 = mysql_fetch_array($result1, MYSQL_ASSOC)){
		$echo .='<optgroup label="'.$row1["nombre"].'">';	
		$result = mysql_query("SELECT * FROM subcategorias WHERE idcategoriaFK=".$row1["id"]." ORDER BY nombre");
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$selected = ($row["id"] == $id) ? 'selected="selected" ' : '';
			$echo .= '<option '. $selected .'value="'. $row["id"] .'">'. $row["nombre"] .'</option>';
		}//while
		$echo .'</optgroup>';
	}//while
	return $echo .'</select>';
}//listSC

public function listBen($id){
	$echo = '<select name="ben" id="ben"><option value="0">== Seleccione un Benefactor ==</option>';
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM benefactores ORDER BY nombre");
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$selected = ($row["id"] == $id) ? 'selected="selected" ' : '';
		$echo .= '<option '. $selected .'value="'. $row["id"] .'">'. $row["nombre"] .'</option>';
	}//while
	return $echo .'</select>';
}//listCat

public function listPC($id){	
	$db = $this->_db();
	$echo='';
	$result = mysql_query("SELECT * FROM palabrasclave WHERE iddocFK=".$id." ORDER BY nombre");
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){		
		$echo .=  $row["nombre"].',';
	}//while
	$echo = substr($echo,0,-1);
	return $echo;
}//listPC

// SUBIR SOLAMENTE UN ARCHIVO ..... $i = field; $ruta = carpeta donde se guarda; ----------
public function validar_archivo($ruta){		    	
	$MAX_FILE_SIZE =  "8000000";	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$nameFile = date('Ymd-His') . md5($_FILES["archivo"]["name"]);
		$archivo = $_FILES["archivo"]["name"];
		$uploadedfile = $_FILES['archivo']['tmp_name'];
		
		if ($archivo) {
			$filename = stripslashes($_FILES['archivo']['name']);
			$archivo = explode('.', $filename);
			$extension = $archivo[1];
			$extension = strtolower($extension);
			if ($extension != "pdf") {
				echo ' <h2>Extension de archivo no permitida.</h2> ';
				exit();
  			} else {
   				$size = $_FILES['archivo']['size'];					// tamano del archivo
				if ($size > $MAX_FILE_SIZE || $size == 0) {			// size daría 0 si sobrepasa lo máximo permitido en el form HTML
					echo "You have exceeded the size limit";
					exit();
				}
				// obtenemos los datos del archivo
				/*
				$tamano = $_FILES["archivo"]['size'];
				$tipo = $_FILES["archivo"]['type'];
				$archivo = $_FILES["archivo"]['name'];
				$prefijo = substr(md5(uniqid(rand())),0,6);
			   */
				if (is_uploaded_file($_FILES['archivo']['tmp_name'])) {															
				    $destino='../'.$ruta.$nameFile.'.'.$extension;
					copy($_FILES['archivo']['tmp_name'], $destino);
				    $subio = true;
			    }
				//imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
//				$filename = "../". $ruta . $nameFile . $ext;
				//imagejpeg($tmp,$filename,80);
				//imagedestroy($src);
				//imagedestroy($tmp);
			}//if
		}//if
		return $nameFile.'.'.$extension;
	} else {
		return '';
	}//if
}//validar_archivo
/*------------------------------------------------------------------*/


}//_GLOBAL_
?>