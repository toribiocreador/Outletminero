<?php
echo (preg_match('/pruebaRandom.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class pruebaRandom extends _GLOBAL_{

public function main(){
	session_start();
	return '<form id="frmCaptcha" name="frmCaptcha">
		<table> 
			<tr>
				<td align="left">
					<label for="captcha"> </label>
				</td>
				<td><input type="hidden" name="prueba" value="hola" />
					<input id="txtCaptcha" type="text" name="txtCaptcha" value="" maxlength="10" size="32" />
				</td>
				<td> 
					<img id="imgCaptcha" src="class/create_image.php" />
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input id="btnCaptcha" type="button" value="Captcha Test" name="btnCaptcha" 
						onclick="getParam(document.frmCaptcha)" />
				</td>
			</tr>
		</table> 

		<div id="result">&nbsp;</div>
	</form>'.$_SESSION["security_code"];
	
	}//regEmpresa

}//class
?>