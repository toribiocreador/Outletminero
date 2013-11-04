<?php
echo (preg_match('/videos.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class videos extends _GLOBAL_{
	
	public $LIMIT = 7;
	public $PAGINAS = 10;

public function main(){
	$db = $this->_db();
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM noticias WHERE socio='0' AND activo=1 AND embed LIKE '%http://%' ORDER BY id DESC ". $qLimit);
	$content = '<p class="txtTit">Videos</p>';
	return $content . $this->showPublicacion($result, 'videos', '8') . $this->paginacionV($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'noticias', 'videos', 'main', 8);
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
	$img = (isset($tok[0]) && $tok[0] != '') ? '<div style="border:#000000 1px solid; background:#FFFFFF; float:left; font-size:10px; color:#333333; margin-right: 20px; width:auto;"><img src="'.$tok[0] .'" width=300" alt="" border="0" />'.$this->slideGalerias('videos',$row["id"]).'</div>':'';
	$video = (isset($row["embed"]) && $row["embed"] != '') ? '<br /><iframe width="640" height="390" src="'. $row["embed"] .'" frameborder="0" allowfullscreen></iframe>':'';
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
          '. $contenido . $video .'
		 <table width="95%" border="0" height="27" align="center" cellspacing="10" cellpadding="0" hspace="25">
            <tr>
				<td align="center" class="txtBold">Disfrutaste la publicaci&oacute;n Comp&aacute;rtela!</td>
				<td>
					<a href="http://twitter.com/share" class="twitter-share-button" data-via="outletminero" data-url="http://www.outletminero.org/?F=videos&amp;_f=ver&amp;id='. $row["id"] .'" data-text="'. $row["titulo"] .'" data-count="horizontal" data-lang="es">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>	
				</td>
				<td>
					<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=181783375212237&amp;xfbml=1"></script><fb:like href="http://www.outletminero.org/?F=videos&amp;_f=ver&amp;id='. $row["id"] .'" send="false" layout="button_count" width="10" show_faces="false" font=""></fb:like>
				</td>
		  		<td>
					<a name="fb_share" type="button_count" share_url="http://www.outletminero.org/?F=videos&amp;_f=ver&amp;id='. $row["id"] .'">Compartir</a> 
					<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
				</td>
			</tr>
          </table>
         <p class="linkCont"><a href="?F=comentarios&amp;_f=main&amp;tipo=2&amp;id='. $row["id"] .'">Deja tu comentario</a> <span class="linkCont"><a href="?F=inicio&amp;_f=verNormas">Normas de uso</a></span></p>'. $this->showComments('2', $row["id"]);
		 
}//ver

}//class
?>