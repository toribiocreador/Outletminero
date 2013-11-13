<?php
echo (preg_match('/encuestas.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class encuestas extends _GLOBAL_{
	
	public $limitNot = 3;

public function main(){
	$db = $this->_db();
	return '<p class="txtTit">Encuestas</p>'.
		$this->postEncuestas();
}//main

private function postEncuestas(){
	$result = mysql_query("SELECT * FROM encuestas WHERE activo=1 ORDER BY id DESC LIMIT ".$this->limitNot);
 	$content='';
 	$nfilas =  2;
	$col = 2;
	$filas = ceil($nfilas/$col);
	$content.='<table width="100%" border="0" cellspacing="3" cellpadding="3">';
	for($c=0;$c<$filas;$c++){
		$content.='<tr>';
		for($s=0;$s<$col;$s++){
			if($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$content.='
				<td width="50%" align="center">
					<table width="320" height="242" valign="center" align="center" class="divContenedor3" border="0" cellspacing="3" cellpadding="3">
					  <tr>
						<td align="center">
							'.$row["contenido"].'
						</td>
					</tr>
					<tr>
						<td align="center">
							 <table width="53%" border="0" cellspacing="0" cellpadding="0">
								<tr>
								<td align="left">
									<p class="txtEsp">VOTAR</p>
								</td>
								</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>';
			}
		}
		$content.='</tr>';
	}
	$content.='</table>';
	return $content;
	
}//postEncuesta

}//class
?>