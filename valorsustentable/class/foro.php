<?php
echo (preg_match('/foro.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class foro extends _GLOBAL_{
	
	public $LIMIT = 7;
	public $PAGINAS = 10;

public function main(){
	$db = $this->_db();
	echo 'hola';
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM foro WHERE activo=1 ORDER BY id DESC ". $qLimit);
	$content = '<p class="txtTit">Foro</p>';
	return $content . $this->showForo($result, 'foro', '9') . $this->paginacion($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'foro', 'foro', 'main', 9);
}//main

public function ver(){
	if (!isset($_GET["id"]) || $_GET["id"] == ''){ echo '<h2>No se encuentra el identificadors</h2>'; exit(); }//if
	$this -> lectura("foro",$_GET["id"]);	
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM foro WHERE id='{$_GET['id']}' AND activo=1");
	$content = '';
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$pie = '';
	$contenido = (isset($row["contenido"]) && $row["contenido"] != '') ? '<br /><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">'.$row["contenido"] .'</td></tr></table>' : '';
	return '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
          <tr>
            <td class="txtTit">'. $row["titulo"] .'</td>
          </tr>
        </table>
         <p class="linkCont"><a href="?F=comentarios&amp;_f=main&amp;tipo=4&amp;id='. $row["id"] .'">Deja tu comentario</a> <span class="linkCont"><a href="?F=inicio&amp;_f=verNormas">Normas de uso</a></span></p>'. $this->showComments('4', $row["id"]);
		 
}//ver

}//class
?>