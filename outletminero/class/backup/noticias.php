<?php
echo (preg_match('/noticias.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class noticias extends _GLOBAL_{
	
	public $LIMIT = 7;

public function main(){
	$db = $this->_db();
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM noticias ORDER BY id DESC ". $qLimit);
	$content = '<p class="txtTit">Noticias y Art&iacute;culos</p>';
	return $content . $this->showPublicacion($result, 'noticias', '2') . $this->paginacion($this->LIMIT, 'noticias', 'noticias', 'main');
}//main


public function ver(){
	if (!isset($_GET["id"]) || $_GET["id"] == ''){ echo '<h2>No se encuentra el identificador</h2>'; exit(); }//if
		
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM noticias WHERE id='{$_GET['id']}'");
	$content = '';
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	$imagen="";
	$img = (isset($row["imagen"]) && $row["imagen"] != '') ? '<div style="border:#000000 1px solid; background:#FFFFFF; float:left; font-size:10px; color:#333333; margin-right: 20px; width:auto;"><img src="'. $row["imagen"] .'" alt="" border="0" /><br><span class="txtPP" style="padding:5px;">Foto: '. $row["pf"] .'</span></div>':'<iframe width="640" height="390" src="'. $row["embed"] .'" frameborder="0" allowfullscreen></iframe>';
	//$imagen = (isset($row["imagen"]) && $row["imagen"] != '') ? '<table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs"><tr><td><img src="'. $row["imagen"] .'" alt="" border="0" style="float:left; margin-right: 10px;" /><span class="txtPP">Foto: '. $row["pf"] .'</span></td></tr></table>' : '';
	//$video = (isset($row["video"]) && $row["video"] != '') ? $row["embed"] : '';
	$contenido = (isset($row["contenido"]) && $row["contenido"] != '') ? '<br /><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">'.$img. $row["contenido"] .'</td></tr></table>' : '';
		
	return '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
          <tr>
            <td class="txtTit">'. $row["titulo"] .'</td>
          </tr>
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont"><span class="txtBold"> '. $this->txtFechaPub($row["fechapub"]) .'</span></td>
            </tr>
          </table>
          '. $imagen . $contenido . $video .'
         <p class="linkCont"><a href="?F=comentarios&amp;_f=main&amp;tipo=2&amp;id='. $row["id"] .'">Deja tu comentario</a></p>'. $this->showComments('2', $row["id"]);
}//ver

}//class
?>