	<?php
echo (preg_match('/usuarios.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class usuarios extends _GLOBAL_{

public function iniciarSesion(){
	return '<table width="97%" border="0" align="center" cellpadding="5" cellspacing="0">
            <tr>
              <td width="460" valign="top"><p><span class="txtTit">Iniciar Sesi&oacute;n</span></p>
                <blockquote>
                  <p class="txtCont">Para poder ingresar a la secci&oacute;n que solicitaste, por favor inicia sesi&oacute;n.</p>
                  <form id="frmSesion" name="frmSesion" method="post" action="?F=usuarios&amp;_f=validar">
                    <table width="100%" border="0" cellspacing="0" cellpadding="10">
                      <tr>
                        <td width="150" class="txtBold">Usuario:</td>
                        <td><input name="usuario1" type="text" class="frmInputQ" id="usuario1" size="50" maxlength="256" />
                          <br />
                          <span class="txtPP">Ej. usuario@example.com</span></td>
                      </tr>
                      <tr>
                        <td class="txtBold">Contrase&ntilde;a:</td>
                        <td><input name="pwd1" type="password" class="frmInputQ" id="pwd1" size="50" maxlength="256" /></td>
                      </tr>
                      <tr>
                        <td class="txtBold">&nbsp;</td>
                        <td><input name="button3" type="submit" class="frmButtonM" id="button3" value="Iniciar sesi&oacute;n" /></td>
                      </tr>
                    </table>
                  </form>
                  <p class="txtCont">&nbsp;</p>
                </blockquote></td>
            </tr>
          </table>
		  
		  <script language="JavaScript" type="text/javascript">
					 var frmvalidator = new Validator("frmSesion");
					 frmvalidator.addValidation("usuario","req","Ingrese su correo electronico como nombre de usuario");
					 frmvalidator.addValidation("pwd","req","Ingrese su clave de acceso");
				  </script>';
}//iniciarSesion

# ************************************************* INICIO Y CIERRE DE SESIONES ************************************************************************
# ******************************************************************************************************************************************************
public function validar(){
	$id = (!isset($_POST["id"])) ? '1' : $_POST["id"];
	if (!isset($_POST["usuario".$id]) && !isset($_POST["pwd".$id])){ echo '<script type="text/javascript"> 
					setTimeout("top.location.href = \'?F=usuarios&_f=iniciarSesion\'",1000);
					</script>';exit(); }//if
	
	$db = $this->_db();
	$usuario = strip_tags($_POST["usuario".$id]); $pwd = md5($_POST["pwd".$id]);
	$result = mysql_query("SELECT * FROM aspirante WHERE correo='{$usuario}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	if ($usuario == $row["correo"] && $pwd == $row["pwd"]){
		$_SESSION["autorizado2"] = "SI";
		$_SESSION["nombre2"] = $row["nombre"] .' '. $row["apellidos"];
		$_SESSION["idusuario2"] = $row["id"];
		$_SESSION["tipo2"] = $row["tipo"];
		$_SESSION["correo2"] = $row["correo"];
		$_SESSION["id2"] = session_id();
		//$tipo = ($_SESSION["tipo"] == '1') ? 'Empresa' : 'Prof';
		//header('Location: ?F=inicio&_f=main');
		echo '<script type="text/javascript">
					setTimeout("alert(\'Usuario Autorizado\');",100); 
					setTimeout("top.location.href = \'?F=bolsatrabajo&_f=main\'",1000);
					</script>';
		exit();
	} else {
		echo '<script type="text/javascript">
					setTimeout("alert(\'Verifica tu Usuario o Contrase\u00f1a\');",100); 
					setTimeout("top.location.href = \'?F=usuarios&_f=iniciarSesion\'",1000);
					</script>';
		exit();
	}//if
}//validar

public function cerrarSesion(){
	session_destroy();
	echo '<script type="text/javascript">
					setTimeout("top.location.href = \'?\'",1000);
					</script>';
	exit();
}//endSession

# ------------------------------------------------------------------------------

public function frmSolicitud(){
	if (!isset($_SESSION["autorizado2"]) || $_SESSION["autorizado2"] != 'SI'){
		echo '<script type="text/javascript">
					setTimeout("alert(\'ACCESO DENEGADO\');",100); 
					setTimeout("top.location.href = \'?F=inicio&_f=main\'",1000);
					</script>';
		exit();
	}//if
	
	$titulo = '';
	$contenido = '';
	$db = $this->_db(); 
	$result = mysql_query("SELECT * FROM pubcurriculums WHERE idusuario='{$_SESSION['idusuario2']}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);

	if ($row["idusuario"] == $_SESSION["idusuario2"]){
		$titulo = $row["titulo"];
		$contenido = $row["contenido"];
	}//if
	
	return '<table width="758" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
              <td width="460" valign="top"><p><img src="imgs/icon_om.png" width="68" height="23" alt="" />
			  		<span class="txtTitles">Publicar mi solicitud de empleo</span></p>
                <blockquote>
                  <span class="txtCont">A continuaci&oacute;n podr&aacute;s publicar y modificar tu curriculum en la siguiente caja de texto. Podr&aacute;s publicar m&aacute;ximo 1000 caracteres como un resumen de las principales caracter&iacute;sticas de tu solicitud de empleo.</span><br />
                  <br />
				  <form id="form1" name="form1" method="post" action="?F=usuarios&amp;_f=pubSolicitud">
				  	<input name="tipo" id="tipo" type="hidden" value="'. $_SESSION["tipo2"] .'" />
					<span class="txtBold">Ingresa un breve t&iacute;tulo ofreciendo tus servicios.</span><br />
					<input name="titulo" id="titulo" type="text" size="80" class="frmInput" value="'. $titulo .'"/><br /><br />
					<span class="txtBold">Ingresa el resumen de tu curriculum o la oferta de los servicios que deseas realizar.</span><br />
                      <textarea name="contenido" cols="100" rows="12" class="frmInput" id="contenido" onKeyDown="textCounter(this.form.contenido,this.form.remLen,1000);" onKeyUp="textCounter(this.form.contenido,this.form.remLen,1000);">'. $contenido .'</textarea>
                      <br />
                      <input readonly type="text" name="remLen" size="6" maxlength="4" class="frmInput" value="1000" />
                      <span class="txtDet">Caracteres restantes</span><br /><br />
                      <input name="button" type="submit" class="frmButton" id="button" value="Publicar Curriculum" />
                  </form>
                  <p class="txtCont">&nbsp;</p>
                </blockquote></td>
              </tr>
        </table>';
}//frmSolicitud

public function pubSolicitud(){
	$titulo = strip_tags($_POST["titulo"]); 
	$contenido = strip_tags($_POST["contenido"]);
	$idusuario = $_SESSION["idusuario2"];
	$fechapub = date("Y-m-d");
	
	$db = $this->_db(); 
	$result = mysql_query("SELECT idusuario FROM pubcurriculums WHERE idusuario='{$_SESSION['idusuario2']}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
		
	if ($row["idusuario"] == $_SESSION["idusuario2"]){
		$sql = "UPDATE pubcurriculums SET titulo='$titulo', contenido='$contenido', fechapub='$fechapub' WHERE idusuario='{$idusuario}'";
		$result = mysql_query($sql);
	echo '<script type="text/javascript">
					setTimeout("alert(\'CURRICULUM ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=usuarios&_f=frmSolicitud\'",1000);
					</script>';
	exit();
	} else {
		mysql_query("INSERT INTO pubcurriculums (idusuario, titulo, contenido, fechapub)
					VALUES ('". $idusuario ."', '". $titulo ."', '". $contenido ."', '". $fechapub ."')") or die(mysql_error());
		$id=mysql_insert_id();
		echo '<script type="text/javascript">
					setTimeout("alert(\'CURRICULUM INGRESADO\');",100); 
					setTimeout("top.location.href = \'?F=usuarios&_f=frmSolicitud\'",1000);
					</script>';
		exit();
	}
}//pubSolicitud


// ******************************************************** EMPRESAS ********************************************************************
// **************************************************************************************************************************************

public function mainEmpresas(){
	$titulo = ''; $contenido = ''; $mod = ''; $id = '0';
	if (isset($_GET["id"])){
		$db = $this->_db(); 
		$result = mysql_query("SELECT * FROM pubempresas WHERE id='{$_GET['id']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$id = $row["id"]; $titulo = $row["titulo"]; $contenido = $row["contenido"];	$mod = '1';
	}//if
	
	return '<table width="980" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top"><table width="758" border="0" align="center" cellpadding="5" cellspacing="0">
          <tr>
              <td width="460" valign="top"><p><img src="imgs/icon_om.png" width="68" height="23" alt="" /><span class="txtTitles">Ofertas de trabajo</span></p>
                <blockquote>
                  <p class="txtCont">Publica tus ofertas de trabajo en la siguiente caja de. Podr&aacute;s publicar m&aacute;ximo 1000 caracteres como un resumen de las principales caracter&iacute;sticas de tu oferta de empleo.</p>
                  
				  <form id="form1" name="form1" method="post" action="?F=usuarios&amp;_f=pubOferta">
				  <input name="mod" id="mod" type="hidden" value="'. $mod .'" />
				  <input name="id" id="id" type="hidden" value="'. $id .'" />
                    <p>
                      <input name="titulo" type="text" class="frmInput" id="titulo" size="80" maxlength="256" value="'. $titulo .'" />
                      <br />
                      <br />
				<textarea name="contenido" cols="100" rows="5" class="frmInput" id="contenido" onKeyDown="textCounter(this.form.contenido,this.form.remLen,1000);" onKeyUp="textCounter(this.form.contenido,this.form.remLen,1000);">'. $contenido .'</textarea>
                      <br />
                      <input readonly type="text" name="remLen" size="6" maxlength="4" class="frmInput" value="1000" />
                      <span class="txtDet">Caracteres restantes</span>
                    </p>
                    <p>
                      <input name="button" type="submit" class="frmButton" id="button" value="Publicar Curriculum" />
                    </p>
                </form>
				
				
				'. $this->listOfertasEmpleo() .'
                </blockquote></td>
              </tr>
        </table>
          <p>&nbsp;</p></td>
        <td width="222" valign="top" style="background:#F7F7F7">
          <span class="txtEsp">&nbsp;<br /></span>
           <!-- INGRESAR FORM -->'. $this->frmValidarUsuarioRight() .'
          <!-- BANNERS -->'. $this->bannersMiddleRight() .'
            <span class="txtEsp">&nbsp;<br />
              </span><br />
          </td>
          </tr>
        </table>';
}//mainEmpresas

public function listOfertasEmpleo(){
	$echo = ''; $i = 0;
	$db = $this->_db(); 
	$result = mysql_query("SELECT * FROM pubempresas WHERE idusuario='{$_SESSION['idusuario2']}' ORDER BY id DESC");
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
		$i++;
		$echo .= '<tr class="txtDetBlue">
                          <td class="txtDet" valign="top"><a href="?F=usuarios&amp;_f=delOferta&amp;id='. $row["id"] .'"><img src="imgs/img_delete.png" title="Eliminar" border="0" /></a></td>
                          <td valign="top">'. $this->txtFechaPub($row["fechapub"]) .'</td>
                          <td class="linkDet" valign="top" width="180"><a href="?F=usuarios&amp;_f=mainEmpresas&amp;id='. $row["id"] .'" title="Clic para modificar o ver publicaci&oacute;n completa">'. $row["titulo"] .'</a></td>
                          <td class="txtDet" valign="top">'. substr($row["contenido"], 0, 100) .'...</td>
                        </tr>';
	}//while
	
	if ($i = 0) { return ''; exit(); }//if
	
	return '<span class="txtSubTit">Mis ofertas de trabajo</span>
			<table width="100%" border="0" cellpadding="2" cellspacing="0" class="tbBorder">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
                        <tr class="txtBold">
                          <td width="30">&nbsp;</td>
                          <td width="160">Publicado:</td>
                          <td>T&iacute;tulo</td>
                          <td>Contenido</td>
                        </tr>
                        '. $echo .'
                      </table></td>
                    </tr>
                  </table>';
}//listOfertasEmpleo

public function pubOferta(){
	$titulo = strip_tags($_POST["titulo"]); 
	$contenido = strip_tags($_POST["contenido"]);
	$idusuario = $_SESSION["idusuario2"];
	$fechapub = date("Y-m-d");
	
	$db = $this->_db(); 
	
	if (isset($_POST["mod"]) && $_POST["mod"] == '1'){
		$sql = "UPDATE pubempresas SET titulo='$titulo', contenido='$contenido' WHERE id='{$_POST['id']}'";
		$result = mysql_query($sql);
		echo '<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=usuarios&_f=mainEmpresas\'",1000);
					</script>';
		exit();
	} else {
		mysql_query("INSERT INTO pubempresas (idusuario, titulo, contenido, fechapub) 
				VALUES ('". $idusuario ."', '". $titulo ."', '". $contenido ."', '". $fechapub ."')") or die(mysql_error());
		$id=mysql_insert_id();
		echo '<script type="text/javascript">
					setTimeout("alert(\'OFERTA DE TRABAJO INGRESADA\');",100); 
					setTimeout("top.location.href = \'?F=usuarios&_f=mainEmpresas\'",1000);
					</script>';
		exit();
	}//if
	
}//pubOferta

public function delOferta(){
	if (!isset($_GET["id"])){
		echo '<script type="text/javascript">
				setTimeout("alert(\'REGISTRO INVALIDO PARA ELIMINAR\');",100); 
				setTimeout("top.location.href = \'?F=usuarios&_f=mainEmpresas\'",1000);
				</script>';
		exit();
	}//if
	
	$this->_db();
	mysql_query("DELETE FROM pubempresas WHERE id='{$_GET['id']}'");
	echo '<script type="text/javascript">
				setTimeout("alert(\'REGISTRO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=usuarios&_f=mainEmpresas\'",1000);
				</script>';
	exit();
}//delOferta

}//class
?>