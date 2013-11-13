<?php
echo (preg_match('/inicio.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class inicio extends _GLOBAL_{

				/* <p>
                <!-- FACEBOOK -->
                <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F'. $_SERVER['REQUEST_URI'] .'&amp;layout=button_count&amp;show_faces=false&amp;width=150&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>
                &nbsp;
                <!-- TWITTER -->
                <a href="http://twitter.com/share" class="twitter-share-button" data-url="http://www.skuiken.com/" data-count="horizontal" data-lang="es">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                </p> */
	
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
	return $content . $this->showPublicacion($result, 'noticias', '2');
}//postNoticias

private function postEditorial(){
	$result = mysql_query("SELECT * FROM editoriales ORDER BY id DESC LIMIT ". $this->limitEdi);
	$content = '';
	return $content . $this->showPublicacion($result, 'editoriales', '1');
}//postNoticias

private function postEntrevistas(){
	$result = mysql_query("SELECT * FROM entrevistas ORDER BY id DESC LIMIT ". $this->limitEnt);
	$content = '';
	return $content . $this->showPublicacion($result, 'noticias', '3');
}//postEntrevistas

}//class
?>