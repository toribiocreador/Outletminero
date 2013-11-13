<?php
echo (preg_match('/flash.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class flash extends _GLOBAL_{
	
	public $LIMIT = 7;
	public $PAGINAS = 10;

public function main(){
	echo '
		<script type="text/javascript" src="js/swfobject.js"></script>
		<script type="text/javascript">

		swfobject.embedSWF("anims/exploradores/mineria_principal.swf", "myContent", "300", "120", "9.0.0", "anims/expressInstall.swf");
		</script>
		
		<div id="myContent">
			<h1>Alternative content</h1>
			<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
		</div>
	';
		 
}//ver

}//class
?>