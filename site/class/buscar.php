<?php
echo (preg_match('/buscar.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class buscar extends _GLOBAL_{
				/* <p>
                <!-- FACEBOOK -->
                <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F'. $_SERVER['REQUEST_URI'] .'&amp;layout=button_count&amp;show_faces=false&amp;width=150&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>
                &nbsp;
                <!-- TWITTER -->
                <a href="http://twitter.com/share" class="twitter-share-button" data-url="http://www.skuiken.com/" data-count="horizontal" data-lang="es">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                </p> */
	
	public $limitNot = 9;
	public $limitNot2 = 2;
	public $limitNot3 = 6;
	public $limitEdi = 1;
	public $limitEnt = 1;
	public $LIMIT = 7;
	public $PAGINAS = 10;

public function main(){
	$db = $this->_db();
	switch($_POST["seccion"]){
		case '1': return $this->postBuscarEditorial($_POST["query"]); break;
		case '2': return $this->postBuscarNoticias($_POST["query"]); break;
		case '3': return $this->postBuscarEntrevistas($_POST["query"]); break;
	}//switch month
	
	//$db = $this->_db();
	//return $content;
		
		//$this->postTwitter() .
		//$this->postNoticias() .
			//$this->postNoticias2() .
		   //$this->postNoticias3() .
			//$this->postEditorial() .
			//$this->postEntrevistas();
}//main


private function postBuscarNoticias($buscar){
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM noticias WHERE titulo LIKE '%{$buscar}%' OR contenido LIKE '%{$buscar}%' AND socio='0' AND activo=1 ORDER BY fechapub  DESC ". $qLimit);
	$content = '<p class="txtTit">Noticias y Art&iacute;culos</p>';
	return $content . $this->showPublicacion($result, 'noticias', '2') . $this->paginacionBuscar($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'noticias', 'buscar', 'postPagBuscarNoticias', $buscar, 2);
}//postNoticias

public function postPagBuscarNoticias(){
	$buscar = $_GET["buscar"];
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM noticias WHERE titulo LIKE '%{$buscar}%' OR contenido LIKE '%{$buscar}%' AND socio='0' AND activo=1 ORDER BY fechapub  DESC ". $qLimit);
	$content = '<p class="txtTit">Noticias y Art&iacute;culos</p>';
	$cBuscar = 'postPagBuscarNoticias&amp;buscar='.$buscar;
	return $content . $this->showPublicacion($result, 'noticias', '2') . $this->paginacionBuscar($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'noticias', 'buscar', $cBuscar, $buscar, 2);
}//postNoticias

private function postBuscarEditorial($buscar){
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM editoriales WHERE titulo LIKE '%{$buscar}%' OR contenido LIKE '%{$buscar}%' AND activo=1 ORDER BY fechapub  DESC ". $qLimit);
	$content = '<p class="txtTit">Editoriales</p>';
	return $content . $this->showPublicacion($result, 'editoriales', '1') . $this->paginacionBuscar($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'editoriales', 'buscar', 'postPagBuscarEditoriales', $buscar, 1);
}//postNoticias

public function postPagBuscarEditoriales(){
	$buscar = $_GET["buscar"];
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM editoriales WHERE titulo LIKE '%{$buscar}%' OR contenido LIKE '%{$buscar}%' AND activo=1 ORDER BY fechapub  DESC ". $qLimit);
	$content = '<p class="txtTit">Editoriales</p>';
	$cBuscar = 'postPagBuscarEditoriales&amp;buscar='.$buscar;
	return $content . $this->showPublicacion($result, 'editoriales', '1') . $this->paginacionBuscar($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'editoriales', 'buscar', 'postPagBuscarEditoriales', $buscar, 1);
}//postNoticias

private function postBuscarEntrevistas($buscar){
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM entrevistas WHERE titulo LIKE '%{$buscar}%' OR contenido LIKE '%{$buscar}%' AND activo=1 ORDER BY fechapub  DESC ". $qLimit);
	$content = '<p class="txtTit">Entrevistas</p>';
	return $content . $this->showPublicacion($result, 'entrevistas', '3') . $this->paginacionBuscar($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'entrevistas', 'buscar', 'postPagBuscarEntrevistas', $buscar, 1);
}//postEntrevistas

public function postPagBuscarEntrevistas(){
	$buscar = $_GET["buscar"];
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM entrevistas WHERE titulo LIKE '%{$buscar}%' OR contenido LIKE '%{$buscar}%' AND activo=1 ORDER BY fechapub  DESC ". $qLimit);
	$content = '<p class="txtTit">Entrevistas</p>';
	$cBuscar = 'postPagBuscarEntrevistas&amp;buscar='.$buscar;
	return $content . $this->showPublicacion($result, 'entrevistas', '3') . $this->paginacionBuscar($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'entrevistas', 'buscar', $cBuscar, $buscar, 1);
}//postEntrevistas

}//class
?>