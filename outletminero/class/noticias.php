<?php
echo (preg_match('/noticias.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class noticias extends _GLOBAL_{
	
	public $LIMIT = 7;
	public $PAGINAS = 10;

public function main(){
	$db = $this->_db();
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM noticias WHERE socio='0' AND activo=1 ORDER BY id DESC ". $qLimit);
	$content = '<p class="txtTit">Noticias y Art&iacute;culos</p>';
	return $content . $this->showPublicacion($result, 'noticias', '2') . $this->paginacion($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'noticias', 'noticias', 'main', 2);
}//main

public function main2(){
	$db = $this->_db();
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM noticias WHERE socio='0' AND activo=1 ORDER BY id DESC ". $qLimit);
	$content = '<p class="txtTit">Noticias y Art&iacute;culos</p>';
	return $content . $this->showPublicacion($result, 'noticias', '2') . $this->paginacion($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'noticias', 'noticias', 'main', 2);
}//main

public function financieras(){
	$db = $this->_db();
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM noticias WHERE socio='0' AND activo=1 AND id_seccion = 1 ORDER BY id DESC ". $qLimit);
	$content = '<p class="txtTit">Financieras</p>';
	return $content . $this->showPublicacion($result, 'noticias', '2') . $this->paginacion($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'noticias', 'noticias', 'main', 2);
}//main

public function sociales(){
	$db = $this->_db();
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM noticias WHERE socio='0' AND activo=1 AND id_seccion = 2 ORDER BY id DESC ". $qLimit);
	$content = '<p class="txtTit">Sociales</p>';
	return $content . $this->showPublicacion($result, 'noticias', '2') . $this->paginacion($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'noticias', 'noticias', 'main', 2);
}//main

public function sustentable(){
	$db = $this->_db();
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM noticias WHERE socio='0' AND activo=1 AND id_seccion = 3 ORDER BY id DESC ". $qLimit);
	$content = '<p class="txtTit">Sustentable</p>';
	return $content . $this->showPublicacion($result, 'noticias', '2') . $this->paginacion($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'noticias', 'noticias', 'main', 2);
}//main

public function nProyectos(){
	$db = $this->_db();
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM noticias WHERE socio='0' AND activo=1 AND id_seccion = 4 ORDER BY id DESC ". $qLimit);
	$content = '<p class="txtTit">Nuevos Proyectos</p>';
	return $content . $this->showPublicacion($result, 'noticias', '2') . $this->paginacion($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'noticias', 'noticias', 'main', 2);
}//main

public function metales(){
	$db = $this->_db();
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM noticias WHERE socio='0' AND activo=1 AND id_seccion = 5 ORDER BY id DESC ". $qLimit);
	$content = '<p class="txtTit">Metales al d&iacute;a</p>';
	return $content . $this->showPublicacion($result, 'noticias', '2') . $this->paginacion($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'noticias', 'noticias', 'main', 2);
}//main

public function eventos(){
	$db = $this->_db();
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM noticias WHERE socio='0' AND activo=1 AND id_seccion = 6 ORDER BY id DESC ". $qLimit);
	$content = '<p class="txtTit">Eventos</p>';
	return $content . $this->showPublicacion($result, 'noticias', '2') . $this->paginacion($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'noticias', 'noticias', 'main', 2);
}//main

public function informativo(){
	$db = $this->_db();
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM noticias WHERE socio='0' AND activo=1 AND id_seccion = 7 ORDER BY id DESC ". $qLimit);
	$content = '<p class="txtTit">Informativas</p>';
	return $content . $this->showPublicacion($result, 'noticias', '2') . $this->paginacion($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'noticias', 'noticias', 'main', 2);
}//main

public function ver(){
	if (!isset($_GET["id"]) || $_GET["id"] == ''){ echo '<h2>No se encuentra el identificador</h2>'; exit(); }//if
	$this -> lectura("noticias",$_GET["id"]);
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM noticias WHERE id='{$_GET['id']}' AND activo=1");
	$content = '';
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$tok=explode(",",$row["imagen"]);
	$imagen="";
	$pie = '';
	if($row["pf"]!='')
		$pie = '<span class="txtPP" style="padding:5px;>'. $row["pf"] .'</span>';
	$img = (isset($tok[0]) && $tok[0] != '') ? '<div style="border:#000000 1px solid; background:#FFFFFF; float:left; font-size:10px; color:#333333; margin-right: 20px; width:auto;"><img src="'. $tok[0] .'" width=300" alt="" border="0" /><br>'.$pie.'</span>'.$this->slideGalerias('noticias',$row["id"]).'</div>':'<iframe width="640" height="390" src="'. $row["embed"] .'" frameborder="0" allowfullscreen></iframe>';
	//$imagen = (isset($row["imagen"]) && $row["imagen"] != '') ? '<table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs"><tr><td><img src="'. $row["imagen"] .'" alt="" border="0" style="float:left; margin-right: 10px;" /><span class="txtPP">Foto: '. $row["pf"] .'</span></td></tr></table>' : '';
	//$video = (isset($row["video"]) && $row["video"] != '') ? $row["embed"] : '';
	$contenido = (isset($row["contenido"]) && $row["contenido"] != '') ? '<br /><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">'.$img. $row["contenido"] .'</td></tr></table>' : '';
	if(strlen ($row["titulo"])>101)
		$descripcion  = substr($row["titulo"], 0, 101).'...';
	else
		$descripcion  = $row["titulo"];
	
	$fechat = $row["fechapub"];
	$fechatt = new DateTime($fechat);
	$fecha = date_format($fechatt, 'Y-m-j');
	return '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
          <tr>
            <td class="txtTit">'. $row["titulo"] .'</td>
          </tr>
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont"><span class="txtBold"> '. $this->txtFechaPub($fecha) .'</span></td>
            </tr>
          </table>
          '. $imagen . $contenido . $video .'
		<table width="50%" align="right" border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td>
					<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: \'604ae005-d084-4823-8650-44bf570d6993\',
	tracking:\'google\', headerTitle:\'Outletminero\', popup: \'true\'}); </script>
					<span class="st_facebook_large" st_url="http://www.outletminero.org/?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'&amp;source=facebook" st_title="'.$descripcion.'" displayText="Facebook"></span>
					<span class="st_twitter_large" st_title="'.$descripcion.'" st_url="http://www.outletminero.org/?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'&amp;source=twitter" displayText="Tweet"></span>
					<span class="st_linkedin_large" st_title="'.$descripcion.'" st_url="http://www.outletminero.org/?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'" displayText="LinkedIn"></span>
					<span class="st_googleplus_large" st_title="'.$descripcion.'" st_url="http://www.outletminero.org/?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'" displayText="Google +"></span>
				</td>
			</tr>
		  </table>
         <p class="linkCont"><a href="?F=comentarios&amp;_f=main&amp;tipo=2&amp;id='. $row["id"] .'">Deja tu comentario</a> <span class="linkCont"><a href="?F=inicio&amp;_f=verNormas">Normas de uso</a></span></p>'. $this->showComments('2', $row["id"]);
		 
}//ver

}//class
?>