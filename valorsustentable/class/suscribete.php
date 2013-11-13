<?php
echo (preg_match('/suscribete.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class suscribete extends _GLOBAL_{

public function add(){
	//if (!isset($_POST["comentarios"]) || $_POST["comentarios"] == ''){ echo '<h2>No se puede publicar su comentario.</h2>'; exit(); }//if
	
	$correo = $_POST["query"];
	
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM suscripcion WHERE correo='{$correo}'");
	if(mysql_num_rows($result)>0){
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'CORREO YA SUSCRÍTO\');",100); 
					setTimeout("top.location.href = \'?\'",1000);
					</script>';
		return $echo;	
	}
			
	$db = $this->_db();
	mysql_query("INSERT INTO suscripcion (correo,activo)
					VALUES ('". $correo."','1')") or die(mysql_error());
	$id=mysql_insert_id();
	$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
					setTimeout("top.location.href = \'?\'",1000);
					</script>';
	return $echo;
	
}//suscribete

}//class
?>