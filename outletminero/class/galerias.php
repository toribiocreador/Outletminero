<?php
echo (preg_match('/galerias.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class galerias extends _GLOBAL_{
	
	public $limitNot = 1;
	public $limitNot2 = 8;
	public $limitEdi = 1;
	public $limitEnt = 1;

public function main(){
	$db = $this->_db();
	$limit = $this->limitNot;
	$result = mysql_query("SELECT * FROM galerias");
		$tipoComm=10;
	 
		$nfilas =  $this->limitNot2;
		$col = 2;
		$filas = ceil($nfilas/$col);
		$content.='<table width="100%" border="0" cellspacing="2" cellpadding="10">';
		for($c=0;$c<$filas;$c++){
			$content.='<tr>';
			$count = 0;
			for($s=0;$s<$col;$s++){
				if($row = mysql_fetch_array($result, MYSQL_ASSOC)){
					$count++;
					$tok=explode(",",$row["imagen"]);
					$img = (isset($tok[0]) && $tok[0] != '') ? '<table class="tbImgs"><tr><td><a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'"><img src="../Scripts/timthumb.php?src='. $tok[0] .'&a=c&w=302&h=230"/></a></td></tr>'.$this->slideGale2($row["id"]).'</table>':'<iframe width="110" height="105" src="'. $row["embed"] .'" frameborder="0" allowfullscreen></iframe>';
					$content.='<td width="50%">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td align="left" class="linkTitNot3"><a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'">'. $row["titulo"] .'</a></td>
					  </tr><tr>
						<td class="linkTitNot3"><div align="center">'.$img.'</div></td>
					  </tr>
					</table>
					</td>';
				}
			}
			if($count == 1){
				$content.='<td width="50%">
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td></td>
					  </tr>
					</table>
					</td>';
			}
			$content.='</tr>';
		}
		$content.='</table>';
		return $content;	
}//main

public function ver(){
	if (!isset($_GET["id"]) || $_GET["id"] == ''){ echo '<h2>No se encuentra el identificador</h2>'; exit(); }//if
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM galerias WHERE id='{$_GET['id']}'");
	$content = '';
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$tok=explode(",",$row["imagen"]);
	$imagen="";
	$pie = '';
	$img = (isset($tok[0]) && $tok[0] != '') ? '<table class="tbImgs"><tr><td><a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'"><img src="../Scripts/timthumb.php?src='. $tok[0] .'&a=c&w=302&h=230"/></a></td></tr>'.$this->slideGale($row["id"]).'</table>':'<iframe width="110" height="105" src="'. $row["embed"] .'" frameborder="0" allowfullscreen></iframe>'.$this->slideGale($row["id"]).'';
	$contenido = (isset($row["contenido"]) && $row["contenido"] != '') ? '<br /><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">'.$img. $row["contenido"] .'</td></tr></table>' : '';
	if(strlen ($row["titulo"])>101)
		$descripcion  = substr($row["titulo"], 0, 101).'...';
	else
		$descripcion  = $row["titulo"];
		
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
          '. $contenido .'
		 <table width="95%" border="0" height="27" align="center" cellspacing="10" cellpadding="0" hspace="25">
            <tr>
				<td align="center" class="txtBold">Disfrutaste la publicaci&oacute;n Comp&aacute;rtela!</td>
				<td>
					<a href="http://twitter.com/share" class="twitter-share-button" data-via="pyroworldmx" data-url="http://www.pyroworld.mx/?F=ventas&amp;_f=ver&amp;id='. $row["id"] .'&amp;source=twitter" data-text="'. $descripcion .'" data-count="horizontal" data-lang="es">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>	
				</td>
				<td>
					<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=181783375212237&amp;xfbml=1"></script><fb:like href="http://www.pyroworld.mx/?F=ventas&amp;_f=ver&amp;id='. $row["id"] .'" send="false" layout="button_count" width="10" show_faces="false" font=""></fb:like>
				</td>
		  		<td>
					<a name="fb_share" type="button_count" share_url="http://www.pyroworld.mx/?F=ventas&amp;_f=ver&amp;id='. $row["id"] .'&amp;source=facebook">Compartir</a> 
					<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
				</td>
			</tr>
          </table>
         <p class="linkCont"><a href="?F=comentarios&amp;_f=main&amp;tipo=2&amp;id='. $row["id"] .'">Deja tu comentario</a> <span class="linkCont"><a href="?F=inicio&amp;_f=verNormas">Normas de uso</a></span></p>'. $this->showComments('2', $row["id"]);
		 
}//ver

}//class
?>