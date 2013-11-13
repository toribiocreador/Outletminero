<?php
echo (preg_match('/inicio.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class inicio extends _GLOBAL_{
	
	public $limitNot = 4;
	public $limitEdi = 1;
	public $limitEnt = 1;

public function main(){
	$db = $this->_db();
	return $this->postNoticias() .
			$this->postEditorial() .
			$this->postEntrevistas();
}//main

private function postNoticias(){
	$result = mysql_query("SELECT * FROM noticias ORDER BY id DESC LIMIT ". $this->limitNot);
	$content = '';
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){		
		$imagen = (isset($row["imagen"]) && $row["imagen"] != '') ? '<table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs"><tr><td><a href="?F=noticias&amp;_f=ver&amp;id='. $row["id"] .'"><img src="'. $row["imagen"] .'" alt="" border="0" /></a><span class="txtPP">Foto: '. $row["pf"] .'</span></td></tr></table>' : '';
		$introduccion = (isset($row["introduccion"]) && $row["introduccion"] != '') ? '<br /><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">'. $row["introduccion"] .'</td></tr></table>' : '';
		$content .= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
          <tr>
            <td class="linkTitNot"><a href="?F=noticias&amp;_f=ver&amp;id='. $row["id"] .'">'. $row["titulo"] .'</a></td>
          </tr>
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont">Publicado el<span class="txtBold"> '. $this->txtFechaPub($row["fechapub"]) .'</span>, En <span class="linkCont"><a href="?F=noticias&amp;_f=main">Noticias y Art&iacute;culos</a></span> por '. $row["autor"] .'</td>
            </tr>
          </table>
          '. $imagen . $introduccion .'
          <p class="linkCont"><a href="?F=comentarios&amp;_f=main&amp;tipo=2&amp;id='. $row["id"] .'">Deja tu comentario</a></p>';
	}//while
	mysql_free_result($result);
	return $content;
}//postNoticias

private function postEditorial(){
	$result = mysql_query("SELECT * FROM editoriales ORDER BY id DESC LIMIT ". $this->limitEdi);
	$content = '';
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$imagen = (isset($row["imagen"]) && $row["imagen"] != '') ? '<table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs"><tr><td><a href="?F=editoriales&amp;_f=ver&amp;id='. $row["id"] .'"><img src="'. $row["imagen"] .'" alt="" border="0" /></a><span class="txtPP">Foto: '. $row["pf"] .'</span></td></tr></table>' : '';
		$introduccion = (isset($row["introduccion"]) && $row["introduccion"] != '') ? '<br /><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">'. $row["introduccion"] .'</td></tr></table>' : '';
		$content .= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
          <tr>
            <td class="linkTitNot"><a href="?F=editoriales&amp;_f=ver&amp;id='. $row["id"] .'">'. $row["titulo"] .'</a></td>
          </tr>
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont">Publicado el<span class="txtBold"> '. $this->txtFechaPub($row["fechapub"]) .'</span>, En <span class="linkCont"><a href="?F=editoriales&amp;_f=main">Editoriales</a></span> por '. $row["autor"] .'</td>
            </tr>
          </table>
          '. $imagen . $introduccion .'
          <p class="linkCont"><a href="?F=comentarios&amp;_f=main&amp;tipo=1&amp;id='. $row["id"] .'">Deja tu comentario</a></p>';
	}//while
	mysql_free_result($result);
	return $content;
}//postNoticias


private function postEntrevistas(){
	$result = mysql_query("SELECT * FROM entrevistas ORDER BY id DESC LIMIT ". $this->limitEnt);
	$content = '';
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$imagen = (isset($row["imagen"]) && $row["imagen"] != '') ? '<table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs"><tr><td><a href="?F=entrevistas&amp;_f=ver&amp;id='. $row["id"] .'"><img src="'. $row["imagen"] .'" alt="" border="0" /></a><span class="txtPP">Foto: '. $row["pf"] .'</span></td></tr></table>' : '';
		$introduccion = (isset($row["introduccion"]) && $row["introduccion"] != '') ? '<br /><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">'. $row["introduccion"] .'</td></tr></table>' : '';
		$content .= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
          <tr>
            <td class="linkTitNot"><a href="?F=entrevistas&amp;_f=ver&amp;id='. $row["id"] .'">'. $row["titulo"] .'</a></td>
          </tr>
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont">Publicado el<span class="txtBold"> '. $this->txtFechaPub($row["fechapub"]) .'</span>, En <span class="linkCont"><a href="?F=entrevistas&amp;_f=main">Editoriales</a></span> por '. $row["autor"] .'</td>
            </tr>
          </table>
          '. $imagen . $introduccion .'
          <p class="linkCont"><a href="?F=comentarios&amp;_f=main&amp;tipo=1&amp;id='. $row["id"] .'">Deja tu comentario</a></p>';
	}//while
	mysql_free_result($result);
	return $content;
}//postEntrevistas

}//class
?>