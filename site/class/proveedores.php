<?php
echo (preg_match('/proveedores.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class proveedores extends _GLOBAL_{

public $limitNot = 8;
public $LIMIT = 8;
public $PAGINAS = 10;


//<button id="btnFormP" class="frmButtonM">Ver Formulario</button>

public function main(){
	//@unlink('gallery/proveedores/20110705-203746752b090ddd02dffc9b8c1581475e873a.jpg');
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$imagen = '';
	$producto1 = '';
	return '<p class="txtTit">Directorio de Proveedores</p>
			<button id="btnBuscP" class="frmButtonM">Buscar Proveedor</button>
			
				<table id="tblBuscP" width="100%" border="0" cellpadding="0" cellspacing="0" class="tbFind">
					<tr>
					<td><p align="center" class="txtTitles">B&uacute;squeda de proveedores</p></td>
					</tr>
				  <tr>
					<td><form id="form4" name="form4" method="post" action="?F=proveedores&amp;_f=busqueda">
					  <table width="100%" border="0" cellspacing="0" cellpadding="4">
						<tr>
						  <td width="120" class="txtBold">Empresa:</td>
						  <td><input name="empresa" type="text" id="empresa" size="65" maxlength="255" /></td>
						</tr>
						<tr>
						  <td class="txtBold">Secci&oacute;n:</td>
						  <td>'. $this->listGirosB('0') .'</td>
						</tr>
						<tr>
						  <td width="120" class="txtBold">Ciudad:</td>
						  <td><input name="ciudad" type="text" id="ciudad" size="65" maxlength="255" /></td>
						</tr>
						<tr>
						  <td class="txtBold">Pa&iacute;s:</td>
						  <td>'. $this->selectPaises() .'</td>
						</tr>
						<tr>
						  <td>&nbsp;</td>
						  <td><input name="submit" type="submit" class="frmButtonM" id="submit" value="Buscar Proveedor" /></td>
						</tr>
					  </table>
					</form></td>
				  </tr>
				</table>
          </blockquote>
		  '.$this->postProveedor() . $this->paginacion($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'proveedores', 'proveedores', 'main', 1).'
          <p><span class="txtCont">Si est&aacute;s interesado en ser parte de nuestro directorio, cont&aacute;ctanos por medio del siguiente formulario de env&iacute;o de correo electr&oacute;nico v&iacute;a web, el cual ser&aacute; atendido por uno de nuestros ejecutivos a la brevedad posible.</span></p>
		
		
		
		
		
		</blockquote>
		<form id="formP" name="form" enctype="multipart/form-data" method="post" action="">
          <br />
          <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" class="tbBackWhite">
            <tr>
              <td colspan="2" class="txtBold1">Contacto para Directorio de Proveedores de Outlet Minero</td>
            </tr>
            <tr>
              <td width="150" valign="top" class="txtBold">*Nombre de la empresa.</td>
              <td><input name="empresa" type="text" id="empresa" size="60" maxlength="255" class="frmInputM" /></td>
            </tr>
			<tr>
			  <td valign="top" class="txtBold">Logo de la empresa</td>
			  <td valign="top"><input type="hidden" name="MAX_FILE_SIZE1" value="3000000" /><input name="imagen1" type="file" />'. $imagen .'&nbsp;<br /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtBold">Productos:</br>limitado a 5</td>
				 <td valign="top">
				 <input type="hidden" name="MAX_FILE_SIZE1" value="3000000" /><input name="imagen2" type="file" />'. $producto1 .'&nbsp;<br />
				 <input type="hidden" name="MAX_FILE_SIZE1" value="3000000" /><input name="imagen3" type="file" />'. $producto2 .'&nbsp;<br />
				 <input type="hidden" name="MAX_FILE_SIZE1" value="3000000" /><input name="imagen4" type="file" />'. $producto3 .'&nbsp;<br />
				 <input type="hidden" name="MAX_FILE_SIZE1" value="3000000" /><input name="imagen5" type="file" />'. $producto4 .'&nbsp;<br />
				 <input type="hidden" name="MAX_FILE_SIZE1" value="3000000" /><input name="imagen6" type="file" />'. $producto5 .'&nbsp;<br /></td>
			</tr>
			<tr>
              <td valign="top" class="txtBold">*Secci&oacute;n:</td>
              <td>'. $this->listGiros('0') .'</td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">*Giro de la empresa.</td>
              <td><input name="giros" type="text" class="frmInputM" id="giros" size="60" maxlength="255" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Descripci&oacute;n de la<br />empresa:</td>
              <td><textarea name="descripcion" cols="80" rows="20" class="frmInputM" id="descripcion"></textarea></td> 
            </tr>
            <tr>
              <td valign="top" class="txtBold">Calle:</td>
              <td><input name="calle" type="text" class="frmInputM" id="calle" size="60" maxlength="255" /></td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="txtBold"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="160">N&uacute;mero exterior:</td>
                  <td width="100"><input name="numext" type="text" class="frmInputM" id="numext" size="10" maxlength="10" /></td>
                  <td width="150">N&uacute;mero interior:</td>
                  <td><input name="numint" type="text" class="frmInputM" id="numint" size="10" maxlength="10" /></td>
                </tr>
              </table></td>
              </tr>
			<tr>
              <td valign="top" class="txtBold">C&oacute;digo Postal:</td>
              <td><input name="cp" type="text" class="frmInputM" id="cp" size="10" maxlength="10" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Colonia:</td>
              <td><input name="colonia" type="text" class="frmInputM" id="colonia" size="60" maxlength="100" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Ciudad:</td>
              <td><input name="ciudad" type="text" class="frmInputM" id="ciudads" size="60" maxlength="100" /</td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Estado:</td>
              <td><input name="estado" type="text" class="frmInputM" id="estado" size="60" maxlength="100" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Pa&iacute;s:</td>
              <td>'. $this->selectPaises() .'</td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Entre las calles:</td>
              <td class="txtCont"><input name="calle1" type="text" class="frmInputM" id="calle1" size="30" /> y <input name="calle2" type="text" class="frmInputM" id="calle2" size="30" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">D&iacute;as de atenci&oacute;n:</td>
              <td class="txtPPBold" valign="top">
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>L</td>
                  <td><input type="checkbox" name="lunes" id="lunes" value="1" /></td>
                  <td>M</td>
                  <td><input type="checkbox" name="martes" id="martes" value="2" /></td>
                  <td>M</td>
                  <td><input type="checkbox" name="miercoles" id="miercoles" value="3" /></td>
                  <td>J</td>
                  <td><input type="checkbox" name="jueves" id="jueves" value="4" /></td>
                  <td>V</td>
                  <td><input type="checkbox" name="viernes" id="viernes" value="5" /></td>
                  <td>S</td>
                  <td><input type="checkbox" name="sabado" id="sabado" value="6" /></td>
                  <td>D</td>
                  <td><input type="checkbox" name="domingo" id="domingo" value="7" /></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Horarios:</td>
              <td><input name="horarios" type="text" class="frmInputM" id="horarios" size="60" maxlength="100" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Tel&eacute;fonos:</td>
              <td><input name="telefonos" type="text" class="frmInputM" id="telefonos" size="60" maxlength="100" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Correo:</td>
              <td><input name="correo" type="text" class="frmInputM" id="correo" size="60" maxlength="255" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">*Sitio web:</td>
              <td class="txtPP">http://<input name="sitioweb" type="text" class="frmInputM" id="sitioweb" size="54" /></td>
            </tr>
          </table>
          <br />
            
         <table width="95%" border="0" align="center" cellpadding="5" cellspacing="0" class="tbBackWhite">
       	  <tr>
              <td colspan="2" valign="top" class="txtBold1">Datos de contacto<br />
                <span class="txtPP">Esta &aacute;rea es para el contacto directo del proveedor que se encuentra ingresando.</span></td>
              </tr>
            <tr>
              <td width="150" valign="top" class="txtBold">*Nombre:</td>
              <td><input name="us_nombre" type="text" class="frmInputM" id="us_nombre" size="60" maxlength="100" /></td>
            </tr>
			<tr>
              <td width="150" valign="top" class="txtBold">*Usuario:</td>
              <td><input name="us_user" type="password" class="frmInputM" id="us_user" size="60" maxlength="100" /></td>
            </tr>
			<tr>
              <td width="150" valign="top" class="txtBold">*Contrase&ntilde;a:</td>
              <td><input name="us_password" type="password" class="frmInputM" id="us_nombre" size="60" maxlength="100" /></td>
            </tr>
			<tr>
              <td width="150" valign="top" class="txtBold">Apellidos:</td>
              <td><input name="us_apellidos" type="text" class="frmInputM" id="us_apellidos" size="60" maxlength="100" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Correo:</td>
              <td><input name="us_correo" type="text" class="frmInputM" id="us_correo" size="60" maxlength="100" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Puesto que ocupa en<br />
                la empresa:</td>
              <td><input name="us_puesto" type="text" class="frmInputM" id="us_puesto" size="60" maxlength="100" /></td>
            </tr>
            <tr>
              <td valign="top" class="txtBold">Tel&eacute;fono:</td>
              <td><input type="text" name="us_telefono" id="us_telefono" class="frmInputM" /></td>
            </tr>
            <tr>
              <td class="txtBold">Comentarios adicionales:</td>
              <td><textarea name="comentarios" cols="60" rows="5" class="frmInputM" id="comentarios"></textarea></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><input name="submit2" type="submit" class="frmButtonM" id="submit2" value="Enviar informaci&oacute;n" />
                <input name="reset2" type="reset" class="frmButtonM" id="reset2" value="Limpiar formulario" /></td>
            </tr>
          </table>
          <br />
        </form>
        <p>&nbsp;</p>
				<script language="JavaScript" type="text/javascript">
					 var frmvalidator = new Validator("form");
					 frmvalidator.addValidation("empresa","req","Ingrese el nombre de la empresa");
					 frmvalidator.addValidation("giros","req","Ingrese el giro de la empresa");
					 frmvalidator.addValidation("sitioweb","req","Ingrese el sitio web");
					 frmvalidator.addValidation("us_nombre","req","Ingrese el nombre del contacto");
					 frmvalidator.addValidation("us_user","req","Ingrese el usuario del contacto");
					 frmvalidator.addValidation("us_password","req","Ingrese el password del contacto");
				  </script>';
}//main

public function agregarImagen(){
		return '<button id="btnAgrP" class="frmButtonM" onclick="this->">Agregar producto</button>';
	}

public function ver(){
	if (!isset($_GET["id"]) || $_GET["id"] == ''){ echo '<h2>No se encuentra el identificador</h2>'; exit(); }//if
		
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM proveedores WHERE id='{$_GET['id']}'");
	$content = '';
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$tok=explode(",",$row["imagen"]);
	$imagen = (isset($tok[0]) && $tok[0] != '') ? '<td width="100" valign="top"><table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs"><tr><td><img src="'. $tok[0] .'" alt="" border="0"  width="160" /></a></td></tr></table></td>' : '<br /><img src="../gallery/proveedor.jpg" border="0" /><input type="hidden" name="img" value="proveedor.jpg" />';
	
	
		$introduccion = (isset($row["descripcion"]) && $row["descripcion"] != '') ? '<br /><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">'. $row["descripcion"] .'</td></tr></table>' : '';
		$content .= '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
          <tr>
            <td class="txtTitPro">'. $row["empresa"] .'</a></td>
          </tr>
		  
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
		  <tr>
			<td>
		   <span class="linkTitNot2"><a href="http://'.$row["sitioweb"].'">'.$row["sitioweb"].'</a></span>
		   </td>
            </tr>
			<tr>
			<td><span class="txtBold">Secci&oacute;n: </span><span class="txtPP">' . $row["seccion"] .'</span></td>
            </tr>
			<tr>
			<td><span class="txtBold">Giro: </span><span class="txtPP"> '. $row["giro"] .'</span></td>
            </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="10">
            <tr>
              '. $imagen .'
              <td> <valign="top" class="txtCont">'.$row["descripcion"].'<br>
				  <span class="txtBold">Direcci&oacute;n: </span>' . $row["calle"] .' '.$row["numext"].' '.$row["colonia"].' '.$row["cp"].' '.$row["ciudad"].', '.$row["estado"].' '.$row["pais"].'<br>
				  <span class="txtBold">Contacto: </span>'.$row["us_nombre"].' '.$row["us_apellidos"].' '.$row["us_puesto"].' '.  $row["us_correo"].'<br>
				  <span class="txtBold">Tel&eacute;fono: </span>'.$row["telefonos"].'<br>			
				</td>
			</tr>
			</table>
			<form id="frmModProv" name="frmModProv" method="post" action="?F=proveedores&amp;_f=modPro&amp;id='.$row["id"].'">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" hspace="0" class="tbShow">
				<tr>
					<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0" hspace="150">
						<tr>
							<td></td>
							<td></td>
							<td><span class="txtBold1">Modificar Informaci&oacute;n: </span></td>
						</tr>
						<tr>
							<td></td>
							<td width="150" valign="top" class="txtBold">User:</td>
						  <td><input name="us_nombreM" type="text" class="frmInputM" id="us_nombreM" size="30" maxlength="100" /></td>
						</tr>
						<tr>
							<td></td>
						  <td width="150" valign="top" class="txtBold">Password:</td>
						  <td><input name="us_passwordM" type="password" class="frmInputM" id="us_passwordM" size="30" maxlength="100" /></td>
						 </tr>
						 <tr>
							<td></td>
							<td></td>
							<td>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" hspace="95">
									<tr>
										<td></td>
										<td><input name="Actualizar datos" type="submit" class="frmButtonM" id="Enviar" value="Actualizar datos" /></td>
									</tr>
								</table>
							<td>
						</tr>
					 </table>
					 </td>
					</tr>
				</table>
			</form>
          <br />';
		  return $content;
}//ver

public function verA($id){
	
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM proveedores WHERE id='{$id}'");
	$content = '';
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$tok=explode(",",$row["imagen"]);
	$imagen = (isset($tok[0]) && $tok[0] != '') ? '<td width="100" valign="top"><table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs"><tr><td><img src="http://www.outletminero.org/'. $tok[0] .'" alt="" border="0"  width="160" /></a></td></tr></table></td>' : '';
		$introduccion = (isset($row["descripcion"]) && $row["descripcion"] != '') ? '<br /><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">'. $row["descripcion"] .'</td></tr></table>' : '';
		$content .= '<p class="txtTit">Ya formas parte del directorio de proveedores para la Industria Minera m&aacute;s importante en Am&eacute;rica Latina</p>
		<p class="txtCont">El registro de tu empresa esta disponible&nbsp;en el medio&nbsp;de comunicaci&oacute;n&nbsp;integrado m&aacute;s importante en Am&eacute;rica Latina sobre&nbsp;la industria minera.</p>
		<p class="txtCont">Outletminero no solo ofrece noticias, art&iacute;culos y entrevistas sino tambi&eacute;n un Directorio de Proveedores que puede fortalecer su campa&ntilde;a de ventas o incluso ser el detonador para ella.</p>
		
		<p class="txtCont">Puedes modificar tu registro dando click <span class="linkTitNot2"><a href="http://www.outletminero.org/?F=proveedores&_f=ver&id='.$row["id"].'"> aqui</a></span></p>
		
		<p class="txtCont">Ingresa con los siguientes datos:</p>
		
		<span class="txtBold">User: </span><span class="txtCont">'.$row["us_user"].'</span></br>
		<span class="txtBold">Pass: </span><span class="txtCont">pass</span></br>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
          <tr>
            <td class="txtTitPro">'. $row["empresa"] .'</a></td>
          </tr>
		  
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
		  <tr>
			<td>
		   <span class="linkTitNot2"><a href="http://'.$row["sitioweb"].'">'.$row["sitioweb"].'</a></span>
		   </td>
            </tr>
			<tr>
			<td><span class="txtBold">Secci&oacute;n: </span><span class="txtPP">' . $row["seccion"] .'</span></td>
            </tr>
			<tr>
			<td><span class="txtBold">Giro: </span><span class="txtPP"> '. $row["giro"] .'</span></td>
            </tr>
          </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="10">
            <tr>
              '. $imagen .'
              <td> <valign="top" class="txtCont">'.$row["descripcion"].'<br>
				  <span class="txtBold">Direcci&oacute;n: </span>' . $row["calle"] .' '.$row["numext"].' '.$row["colonia"].' '.$row["cp"].' '.$row["ciudad"].', '.$row["estado"].' '.$row["pais"].'<br>
				  <span class="txtBold">Contacto: </span>'.$row["us_nombre"].' '.$row["us_apellidos"].' '.$row["us_puesto"].' '.  $row["us_correo"].'<br>
				  <span class="txtBold">Tel&eacute;fono: </span>'.$row["telefonos"].'<br>			
				</td>
			</tr>
			</table>
			<p class="txtCont">Tienes dudas?&nbsp;con gusto nuestro equipo puede&nbsp;resolverlas adem&aacute;s deayudarle,&nbsp;con ideas y consejos o incluso&nbsp;corrigiendo&nbsp;su informaci&oacute;n de tal manera que pueda ser lo m&aacute;s efectiva.</p>
				
				<p class="txtCont">Cont&aacute;ctenos al correo:&nbsp;ventas@outletminero.com&nbsp;ser&aacute; un gusto&nbsp;atenderle.</p>
				<p class="txtCont">Durante Junio, sin costo!</p>
          <br />';
		  return $content;
}//ver

private function postProveedor(){
	$db = $this->_db();
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM proveedores ORDER BY prioridad DESC ". $qLimit);
	$content = '';
	return $content . $this->showProveedor($result, 'noticias', '2');
}//postProveedor

public function busqueda(){
						
	$empresa = strip_tags($_POST["empresa"]);
	$temp = strip_tags($_POST["seccion"]);
	$seccion = ($temp=='Todas') ? '': $temp;
	$ciudad = strip_tags($_POST["ciudad"]);
	$pais= strip_tags($_POST["pais"]);
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	if($empresa == '' && $ciudad ==''){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM proveedores WHERE Seccion LIKE '%{$seccion}%' AND pais = '{$pais}' ORDER BY id ASC ". $qLimit);
		$db = $this->_db();
		$result2 = mysql_query("SELECT * FROM proveedores WHERE Seccion LIKE '%{$seccion}%' AND pais = '{$pais}' ORDER BY id ASC ");
	}else if($empresa != '' && $ciudad !=''){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM proveedores WHERE empresa LIKE '%{$empresa}%' AND Seccion LIKE '%{$seccion}%' AND ciudad LIKE '%{$ciudad}%' AND pais = '{$pais}' ORDER BY id ASC ". $qLimit);
		$db = $this->_db();
		$result2 = mysql_query("SELECT * FROM proveedores WHERE empresa LIKE '%{$empresa}%' AND Seccion LIKE '%{$seccion}%' AND ciudad LIKE '%{$ciudad}%' AND pais = '{$pais}' ORDER BY id ASC ");
	}else if($empresa == '' && $ciudad !=''){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM proveedores WHERE Seccion LIKE '%{$seccion}%' AND ciudad LIKE '%{$ciudad}%' AND pais = '{$pais}' ORDER BY id ASC ". $qLimit);
		$db = $this->_db();
		$result2 = mysql_query("SELECT * FROM proveedores WHERE Seccion LIKE '%{$seccion}%' AND ciudad LIKE '%{$ciudad}%' AND pais = '{$pais}' ORDER BY id ASC ");
	}else if($empresa != '' && $ciudad ==''){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM proveedores WHERE empresa LIKE '%{$empresa}%' AND Seccion LIKE '%{$seccion}%' AND pais = '{$pais}' ORDER BY id ASC ". $qLimit);
		$db = $this->_db();
		$result2 = mysql_query("SELECT * FROM proveedores WHERE empresa LIKE '%{$empresa}%' AND Seccion LIKE '%{$seccion}%' AND pais = '{$pais}' ORDER BY id ASC ");
	}
	
	if (mysql_num_rows($result) >= 1)
		return  $this->showProveedor($result, 'noticias', '2').$this->paginacionP($this->LIMIT, $result2, 'proveedores', 'busqueda2',$empresa,$seccion,$ciudad,$pais);
	else{
		$echo = '<script type="text/javascript">
					setTimeout("alert(\'NO SE ENCONTRO REGISTRO PARA LA BUSQUEDA INGRESADA\');",100); 
					setTimeout("top.location.href = \'?F=proveedores&_f=main\'",1000);
					</script>';
		return $echo;
	}
	
	//return $this->postProveedor() . $this->paginacionP($this->LIMIT, 'proveedores', 'proveedores', 'busqueda');
}

public function busqueda2(){
						
	$empresa = strip_tags($_GET["e"]);
	$temp = strip_tags($_GET["s"]);
	$seccion = ($temp=='Todas') ? '': $temp;
	$ciudad = strip_tags($_GET["c"]);
	$pais= strip_tags($_GET["p"]);
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	if($empresa == '' && $ciudad ==''){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM proveedores WHERE Seccion LIKE '%{$seccion}%' AND pais = '{$pais}' ORDER BY id ASC ". $qLimit);
		$db = $this->_db();
		$result2 = mysql_query("SELECT * FROM proveedores WHERE Seccion LIKE '%{$seccion}%' AND pais = '{$pais}' ORDER BY id ASC ");
	}else if($empresa != '' && $ciudad !=''){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM proveedores WHERE empresa LIKE '%{$empresa}%' AND Seccion LIKE '%{$seccion}%' AND ciudad LIKE '%{$ciudad}%' AND pais = '{$pais}' ORDER BY id ASC ". $qLimit);
		$db = $this->_db();
		$result2 = mysql_query("SELECT * FROM proveedores WHERE empresa LIKE '%{$empresa}%' AND Seccion LIKE '%{$seccion}%' AND ciudad LIKE '%{$ciudad}%' AND pais = '{$pais}' ORDER BY id ASC ");
	}else if($empresa == '' && $ciudad !=''){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM proveedores WHERE Seccion LIKE '%{$seccion}%' AND ciudad LIKE '%{$ciudad}%' AND pais = '{$pais}' ORDER BY id ASC ". $qLimit);
		$db = $this->_db();
		$result2 = mysql_query("SELECT * FROM proveedores WHERE Seccion LIKE '%{$seccion}%' AND ciudad LIKE '%{$ciudad}%' AND pais = '{$pais}' ORDER BY id ASC ");
	}else if($empresa != '' && $ciudad ==''){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM proveedores WHERE empresa LIKE '%{$empresa}%' AND Seccion LIKE '%{$seccion}%' AND pais = '{$pais}' ORDER BY id ASC ". $qLimit);
		$db = $this->_db();
		$result2 = mysql_query("SELECT * FROM proveedores WHERE empresa LIKE '%{$empresa}%' AND Seccion LIKE '%{$seccion}%' AND pais = '{$pais}' ORDER BY id ASC ");
	}
	
	if (mysql_num_rows($result) >= 1)
		return  $this->showProveedor($result, 'noticias', '2').$this->paginacionP($this->LIMIT, $result2, 'proveedores', 'busqueda2',$empresa,$seccion,$ciudad,$pais);
	else{
		$echo = '<script type="text/javascript">
					setTimeout("alert(\'NO SE ENCONTRO REGISTRO PARA LA BUSQUEDA INGRESADA '.$seccion.'  \');",100); 
					setTimeout("top.location.href = \'?F=proveedores&_f=main\'",1000);
					</script>';
		return $echo;
	}
	
	//return $this->postProveedor() . $this->paginacionP($this->LIMIT, 'proveedores', 'proveedores', 'busqueda');
}

/*
private function postProveedor(){
	$db = $this->_db();
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM proveedores ORDER BY id ASC ". $qLimit);
	$content = '';
	return $content . $this->showProveedor($result, 'noticias', '2');
}//postProveedor
*/

public function agregarP(){
	if (!isset($_POST["empresa"]) && !isset($_POST["us_nombre"]) && !isset($_POST["us_correo"])){ echo '<h2>No se puede enviar la solicitud</h2>'; exit(); }//if
	// Formato de informaci�n ..........................
	$empresa = strip_tags($_POST["empresa"]);
	$seccion = strip_tags($_POST["giro"]);
	$giro = strip_tags($_POST["giros"]);
	$descripcion = $_POST["descripcion"];
	$calle = strip_tags($_POST["calle"]);
	$cp = strip_tags($_POST["cp"]);
	$numext = strip_tags($_POST["numext"]);
	$numint = strip_tags($_POST["numint"]);
	$colonia = strip_tags($_POST["colonia"]);
	$cp = strip_tags($_POST["cp"]);
	$ciudad = strip_tags($_POST["ciudad"]);
	$estado = strip_tags($_POST["estado"]);
	$pais = strip_tags($_POST["pais"]);
	$calle1 = strip_tags($_POST["calle1"]);
	$calle2 = strip_tags($_POST["calle2"]);
	$horarios = strip_tags($_POST["horarios"]);
	$telefonos = strip_tags($_POST["telefonos"]);
	$correo = strip_tags($_POST["correo"]);
	$sitioweb = strip_tags($_POST["sitioweb"]);
	$comentarios = strip_tags($_POST["comentarios"]);
	$us_nombre = strip_tags($_POST["us_nombre"]);
	$us_user = strip_tags($_POST["us_user"]);
	$us_password = md5($_POST["us_password"]);
	$us_apellidos = strip_tags($_POST["us_apellidos"]);
	$us_correo = strip_tags($_POST["us_correo"]);
	$us_puesto = strip_tags($_POST["us_puesto"]);
	$us_telefono = strip_tags($_POST["us_telefono"]);
	$activo = '0';
	$imagen = '';
	$producto = '';
	$ruta = 'gallery/proveedores/';
	$ruta2 = 'gallery/productos/';
	
	// Validación de imágenes proveedores.....................
	$WIDTH = 300; $HEIGHT = 230;
	
	if (isset($_FILES["imagen1"]["name"]) && $_FILES["imagen1"]["name"] != ''){
		$imagen = $this->validar_1_imagen('1', $ruta, $WIDTH, $HEIGHT);
		$imagen = $ruta . $imagen;
		@unlink('../'. $_POST["imagen1"]);
	} else {
		$imagen = (isset($_POST["imagen1"])) ? $_POST["imagen1"] : '';
	}//if
	
	$imagenes = $imagen;
	
	// Validación de imágenes productos.......................
	$WIDTH = 680; $HEIGHT = 580;
	
	for($x=2;$x<7;$x++)
		if (isset($_FILES["imagen".$x]["name"]) && $_FILES["imagen".$x]["name"] != ''){
			$producto='';
			$producto = $this->validar_1_imagen($x, $ruta2, $WIDTH, $HEIGHT);
			$producto = $ruta2 . $producto;
			$imagenes .= ','.$producto;
			@unlink('../'. $_POST["imagen".$x]);
		} else {
			$producto = (isset($_POST["imagen".$x])) ? $_POST["imagen".$x] : '';
		}//if

	$dias = array(1 => 'lunes',
				  2 => 'martes',
				  3 => 'miercoles',
				  4 => 'jueves',
				  5 => 'viernes',
				  6 => 'sabado',
				  7 => 'domingo');
	$diasatencion = '';
	
	for ($i=1; $i<=7; $i++){
		if (isset($_POST[$dias[$i]])){
			$diasatencion .= $i .',';
		}//if
	}//for
	$diasatencion = (strlen($diasatencion) > 0) ? substr($diasatencion, 0, -1) : '';
	
	$db = $this->_db();
	mysql_query("INSERT INTO proveedores (empresa, seccion, giro, imagen, descripcion, calle, numext, numint, colonia, cp, ciudad, estado, pais, calle1, calle2, diasatencion, horarios, telefonos, correo, sitioweb, us_nombre, us_user, us_password, us_apellidos, us_correo, us_puesto, us_telefono, comentarios, activo)
				 VALUES ('". $empresa ."', '". $seccion ."', '". $giro ."', '". $imagenes ."', '". $descripcion ."', '". $calle ."', '". $numext ."', '". $numint ."', '". $colonia ."', '". $cp ."', '". $ciudad ."', '". $estado ."', '". $pais ."', '". $calle1 ."', '". $calle2 ."', '". $diasatencion ."', '". $horarios ."', '". $telefonos ."', '". $correo ."', '". $sitioweb ."', '". $us_nombre ."', '". $us_user ."', '". $us_password ."', '". $us_apellidos ."', '". $us_correo ."', '". $us_puesto ."', '". $us_telefono ."', '". $comentarios ."', '". $activo ."')") or die(mysql_error());
	$id=mysql_insert_id();
	
	//Enviar mail para que pueda confirmar el usuario registrado:
	$this->enviar($id,$us_correo);
	
	$echo = '<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
					setTimeout("top.location.href = \'?F=proveedores&_f=enviado\'",1000);
					</script>';
	return $echo;

}//add

public function addProveedor(){
	//echo '</br>else '.$_POST["imagen2"];
	//return $echo;
	if(!isset($_POST["empresa"])){ echo '<h2>No se puede agregar su publicaci&oacute;n.</h2>'; exit(); }//if
	// Inserci�n de datos .............................	
	extract($_POST);
	$id=$_GET["id"];
	$descripcion = strip_tags($_POST["diasatencion"]);
	$fechapub = date("Y-m-d");
	$empresa = strip_tags($_POST["empresa"]);
	$seccion = strip_tags($_POST["giro"]);
	$giro = strip_tags($_POST["giros"]);
	$descripcion = $_POST["descripcion"];
	$calle = strip_tags($_POST["calle"]);
	$cp = strip_tags($_POST["cp"]);
	$numext = strip_tags($_POST["numext"]);
	$numint = strip_tags($_POST["numint"]);
	$colonia = strip_tags($_POST["colonia"]);
	$cp = strip_tags($_POST["cp"]);
	$ciudad = strip_tags($_POST["ciudad"]);
	$estado = strip_tags($_POST["estado"]);
	$pais = strip_tags($_POST["pais"]);
	$calle1 = strip_tags($_POST["calle1"]);
	$calle2 = strip_tags($_POST["calle2"]);
	$horarios = strip_tags($_POST["horarios"]);
	$telefonos = strip_tags($_POST["telefonos"]);
	$correo = strip_tags($_POST["correo"]);
	$sitioweb = strip_tags($_POST["sitioweb"]);
	$comentarios = strip_tags($_POST["comentarios"]);
	$us_nombre = strip_tags($_POST["us_nombre"]);
	$us_user = strip_tags($_POST["us_user"]);
	$pas=md5($_POST["us_password"]);
	$us_apellidos = strip_tags($_POST["us_apellidos"]);
	$us_correo = strip_tags($_POST["us_correo"]);
	$us_puesto = strip_tags($_POST["us_puesto"]);
	$us_telefono = strip_tags($_POST["us_telefono"]);
	$imagenes = '';
	$producto='';
	$ruta = 'gallery/proveedores/';
	$ruta2 = 'gallery/productos/';
	
	// Validación de imágenes proveedores.....................
	$WIDTH = 300; $HEIGHT = 230;
	
	if (isset($_FILES["imagen1"]["name"]) && $_FILES["imagen1"]["name"] != ''){
		$imagen = $this->validar_1_imagen('1', $ruta, $WIDTH, $HEIGHT);
		$imagen = $ruta . $imagen;
		@unlink('../'. $_POST["imagen1"]);
	} else {
		$imagen = (isset($_POST["imagen1"])) ? $_POST["imagen1"] : '';
	}//if
	
	if($imagen=='')
		$imagenes = 'gallery/proveedor.jpg';
	else
		$imagenes = $imagen;
	
	// Validación de imágenes productos.......................
	$WIDTH = 680; $HEIGHT = 580;
	
	for($x=2;$x<7;$x++){
		$producto='';
		if (isset($_FILES["imagen".$x]["name"]) && $_FILES["imagen".$x]["name"] != ''){
			//k este seleccionado un archivo
			
			$producto = $this->validar_1_imagen($x, $ruta2, $WIDTH, $HEIGHT);
			$producto = $ruta2 . $producto;
			@unlink('../'. $_POST["imagen".$x]);
		} else {
			//$imagenes .= ($_POST["imagen".$x])!='' ? ','.$producto : '';
			$producto = (isset($_POST["imagen".$x])) ? $_POST["imagen".$x] : '';
		}//if
		if($producto!='')
			$imagenes .= ','.$producto;
	}
	for ($i=1; $i<=7; $i++){
		if (isset($_POST[$this->dias[$i]])){
			$dias .= $i .',';
		}//if
	}//for
	$diasatencion = (strlen($dias) > 0) ? substr($dias, 0, -1) : '';
	//, descripcion='$descripcion', calle='$calle', numext='$numext', numint='$numint', colonia='$colonia', cp='$cp', ciudad='$ciudad', estado='$estado', pais='$pais', calle1='$calle1', calle2='$calle2', diasatencion='$diasatencion', horarios='$horarios', telefonos='$telefonos', correo='$correo', sitioweb='$sitioweb', us_nombre='$us_nombre',us_password='$pas', us_apellidos='$us_apellidos', us_correo='$us_correo', us_puesto='$us_puesto',us_telefono='$us_telefono'
	// Bases de datos........................................
		$db = $this->_db();
		$result = mysql_query("UPDATE proveedores SET empresa='$empresa', seccion='$seccion', imagen='$imagenes', giro='$giro', descripcion='$descripcion', calle='$calle', numext='$numext', numint='$numint', colonia='$colonia', cp='$cp', ciudad='$ciudad', estado='$estado', pais='$pais', calle1='$calle1', calle2='$calle2', diasatencion='$diasatencion', horarios='$horarios', telefonos='$telefonos', correo='$correo', sitioweb='$sitioweb', us_nombre='$us_nombre',us_user='$us_user',us_password='$pas', us_apellidos='$us_apellidos', us_correo='$us_correo', us_puesto='$us_puesto',us_telefono='$us_telefono' WHERE id='$id'");
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=proveedores&_f=main\'",1000);
					</script>';
	return $echo;
}//addProveedor

public function modPro(){	// Formulario para agregar proveedor
	if (isset($_GET["id"])){
		$db = $this->_db();
		$idt = strip_tags($_GET["id"]);
		$result = mysql_query("SELECT * FROM proveedores WHERE id='{$idt}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$tok=explode(",",$row["imagen"]);
		$tok2=explode(",",$row["imagen"]);
		$pwd = md5($_POST["us_passwordM"]);
		if($row["us_user"]==$_POST['us_nombreM'] && $row["us_password"]== $pwd){
			// Registros .......
			$id = $row["id"];
			$empresa = $row["empresa"];
			$seccion  = $row["seccion"];
			$giro = $row["giro"];
			$descripcion = $row["descripcion"];
			$calle = $row["calle"]; $numext = $row["numext"]; $numint = $row["numint"];
			$colonia = $row["colonia"]; $cp = $row["cp"];
			$ciudad = $row["ciudad"];
			$estado = $row["estado"];
			$pais = '<span class="txtCont1">Pa&iacute;s Actual: <span class="txtBold">'. $row["pais"] .'</span> <span class="txtCont">Cambiar Pa&iacute;s</span>';
			$calle1 = $row["calle1"];	$calle2 = $row["calle2"];
			$diasatencion = $row["diasatencion"];
			$horarios = $row["horarios"];
			$telefonos = $row["telefonos"];
			$correo = $row["correo"];
			$sitioweb = $row["sitioweb"];
			$activo = $row["activo"];
			$fechapub = $row["fechapub"];
			$us_nombre =  $row["us_nombre"];
			$us_user =  $row["us_user"];
			$us_password = $_POST["us_passwordM"];
			$us_apellidos =  $row["us_apellidos"];
			$us_correo =  $row["us_correo"];
			$us_puesto =  $row["us_puesto"];
			$us_telefono = $row["us_telefono"];
			$imagen = ($tok[0] != '') ? '<br /><img src="../'. $tok[0] .'" border="0" /><input type="hidden" name="imagen1" value="'. $tok[0] .'" />' : '<br /><img src="gallery/proveedor.jpg" border="0" /><input type="hidden" name="img" value="proveedor.jpg" />';
			unset($tok[0]);
			$productos = '<tr>
					  <td valign="top" class="txtCont2">Productos:</td>
					  <td><table border="0" cellpadding="0" cellspacing="0">';
			$i=2;
			foreach($tok as $c){ 
				$productos .= '
					<tr>
					  <td valign="top"><input type="hidden" name="MAX_FILE_SIZE1" value="3000000" /><input name="imagen'.$i.'" type="file" /><br /><img src="'. $c .'" border="0" /><input type="hidden" name="imagen'.$i.'" value="'. $c .'" />&nbsp;<br /></td>
					</tr>'; 
				$i++;
			}
			for($x=(5-count($tok));$x>0;$x--){
				$productos .= '
					<tr>
					  <td valign="top"><input type="hidden" name="MAX_FILE_SIZE1" value="3000000" /><input name="imagen'.$i.'" type="file" /><br /></td>
					</tr>'; 
					$i++;
			}
			$productos .= '</table></td></tr>';
			mysql_free_result($result);
			mysql_close();
			return '<p class="txtTitles">Agregar / Modificar Proveedor</p>
				<p class="txtCont1">Ingrese los datos que se solicitan a continuaci&oacute;n para agregar una un nuevo proveedor, los cuales autom&aacute;ticamente se publicar&aacute;n en el sitio web.</p>
	<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=proveedores&amp;_f=addProveedor&amp;id='.$id.'">
		<input type="hidden" id="DPC_FIRST_WEEK_DAY" value="2" />
		<input type="hidden" id="DPC_WEEKEND_DAYS" value="[0,5,6]" />
		<input type="hidden" id="DPC_CALENDAR_OFFSET_X" value="20" />
		<input type="hidden" id="DPC_BUTTON_OFFSET_X" value="10" />
		<input type="hidden" name="id" value="'. $_GET["id"] .'" />
		<input type="hidden" name="productos" value="'. $tok2 .'" />
		  <table width="100%" border="0" cellspacing="0" cellpadding="5">
			<tr>
			  <td valign="top" class="txtCont2" width="150">Empresa:</td>
			  <td valign="top"><input name="empresa" type="text" id="empresa" size="60" maxlength="255" value="'. $empresa .'" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2" width="150">Secci&oacute;n:</td>
			  <td valign="top">'. $this->listGiros($giro) .'</td>
			</tr>
			<tr>
				  <td valign="top" class="txtCont2">Giro de la empresa.</td>
				  <td valign="top"><input name="giros" type="text" id="giros" size="60" maxlength="255" value="'. $giro .'"/></td>
				</tr>
			<tr>
			  <td valign="top" class="txtCont2">Imagen:</td>
			  <td valign="top"><input type="hidden" name="MAX_FILE_SIZE1" value="3000000" /><input name="imagen1" type="file" />'. $imagen .'&nbsp;<br /></td>
			</tr>
			'.$productos.'
			<tr>
			  <td valign="top" class="txtCont2">Descripci&oacute;n de la Empresa:</td>
			  <td valign="top"><textarea name="descripcion" id="descripcion" cols="70" rows="20">'. $descripcion .'</textarea></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2">Calle:</td>
			  <td valign="top"><input name="calle" type="text" id="calle" value="'. $calle .'" size="60" maxlength="255" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2">N&uacute;mero exterior:</td>
			  <td valign="top"><input name="numext" type="text" id="numext" value="'. $numext .'" size="60" maxlength="255" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2">N&uacute;mero interior:</td>
			  <td valign="top"><input name="numint" type="text" id="numint" value="'. $numint .'" size="60" maxlength="255" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2" width="150">Colonia:</td>
			  <td valign="top"><input name="colonia" type="text" id="colonia" size="60" maxlength="255" value="'. $colonia .'" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2" width="150">C&oacute;digo Postal:</td>
			  <td valign="top"><input name="cp" type="text" id="cp" size="60" maxlength="255" value="'. $cp .'" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2" width="150">Ciudad:</td>
			  <td valign="top"><input name="ciudad" type="text" id="ciudad" size="60" maxlength="255" value="'. $ciudad .'" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2" width="150">Estado:</td>
			  <td valign="top"><input name="estado" type="text" id="estado" size="60" maxlength="255" value="'. $estado .'" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2" width="150">Pa&iacute;s:</td>
			  <td valign="top">'. $pais . $this->selectPaises() .'</td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2" width="150">Entre las calles:</td>
			  <td valign="top" class="txtCont2">
					<table cellpadding="2" cellspacing="0"><tr>
						  <td valign="top"><input name="calle1" type="text" id="calle1" size="30" maxlength="255" value="'. $calle1 .'" /></td>
						  <td valign="top" class="txtCont2"> y </td>
						  <td valign="top"><input name="calle2" type="text" id="calle2" size="30" maxlength="255" value="'. $calle2 .'" /></td>
					</tr></table>
			  </td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2">D&iacute;as de atenci&oacute;n:</td>
			  <td valign="top" class="txtBold">
					'. $this->listDiasAtencion($diasatencion) .'
			  </td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2">Horarios:</td>
			  <td valign="top"><input name="horarios" type="text" id="horarios" size="60" maxlength="255" value="'. $horarios .'" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2">Tel&eacute;fonos:</td>
			  <td valign="top"><input name="telefonos" type="text" id="telefonos" size="60" maxlength="255" value="'. $telefonos .'" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2">Correo electr&oacute;nico:</td>
			  <td valign="top" class="txtPieNotaGris"><input name="correo" type="text" id="correo" size="60" maxlength="255" value="'. $correo .'" /> <br />A este correo se enviar&aacute; la notificaci&oacute;n.</td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2">Sitio web:</td>
			  <td valign="top"><input name="sitioweb" type="text" id="sitioweb" size="60" maxlength="255" value="'. $sitioweb .'" /></td>
			</tr>		
			<tr>
			  <td valign="top" class="txtCont2" width="150">Nombre:</td>
			  <td valign="top"><input name="us_nombre" type="text" id="us_nombre" size="10" maxlength="10" value="'. $us_nombre .'" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2" width="150">Usuario:</td>
			  <td valign="top"><input name="us_user" type="text" id="us_user" size="10" maxlength="10" value="'. $us_user .'" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2" width="150">Contrase&ntilde;a:</td>
			  <td valign="top"><input name="us_password" type="text" id="us_password" size="20" maxlength="20" value="'. $us_password .'" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2" width="150">Apellidos:</td>
			  <td valign="top"><input name="us_apellidos" type="text" id="us_apellidos" size="10" maxlength="10" value="'. $us_apellidos .'" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2" width="150">Correo:</td>
			  <td valign="top"><input name="us_correo" type="text" id="us_correo" size="10" maxlength="10" value="'. $us_correo .'" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2" width="150">Puesto:</td>
			  <td valign="top"><input name="us_puesto" type="text" id="us_puesto" size="10" maxlength="10" value="'. $us_puesto .'" /></td>
			</tr>
			<tr>
			  <td valign="top" class="txtCont2" width="150">Tel&eacute;fono:</td>
			  <td valign="top"><input name="us_telefono" type="text" id="us_telefono" size="10" maxlength="10" value="'. $us_telefono .'" /></td>
			</tr>		
			<tr>
			  <td valign="top" class="txtCont2">&nbsp;</td>
			  <td valign="top"><input name="enviar" type="submit" class="frmBtnIngresar" id="enviar" value="Actualizar" /></td>
			</tr>
		  </table>
	</form>
			<script language="JavaScript" type="text/javascript">
			 var frmvalidator = new Validator("form");
			 frmvalidator.addValidation("empresa","req","Ingrese el nombre de la empresa");
			 frmvalidator.addValidation("giros","req","Ingrese el giro de la empresa");
			 frmvalidator.addValidation("sitioweb","req","Ingrese el sitio web");
			 frmvalidator.addValidation("us_nombre","req","Ingrese el nombre del contacto");
			 frmvalidator.addValidation("us_user","req","Ingrese el usuario del contacto");
			 frmvalidator.addValidation("us_password","req","Ingrese el password del contacto");
		  </script>
	';
		} else {
			$echo = '<script type="text/javascript">
						setTimeout("alert(\'Usuario o password incorrectos\');",100); 
						setTimeout("top.location.href = \'?F=proveedores&_f=main\'",1000);
						</script>';
		return $echo;
		}
	}
}//addPro

private function txtDiasAtencion($d){
	$dias = explode(',', $d);
	$total = count($dias);
	for ($i= 0; $i<$total; $i++){
		switch($dias[$i]){
			case '1': $echo .= 'Lunes,'; break;
			case '2': $echo .= 'Martes,'; break;
			case '3': $echo .= 'Mi�rcoles,'; break;
			case '4': $echo .= 'Jueves,'; break;
			case '5': $echo .= 'Viernes,'; break;
			case '6': $echo .= 'S�bado,'; break;
			case '7': $echo .= 'Domingo,'; break;
		}//switch
	}//for
	$echo = substr($echo, 0, -1);
	return $echo;
}//txtDiasAtencion

# ************************************************************* ENV�O DE CORREOS PARA SOLICITUD DE INFORMACI�N ******************************************************************
# *****************************************************************************************************************************************************************
private function enviar($id,$us_correo){
	
	require_once('Rmail/Rmail.php');
	$mail = new Rmail();
	$mail->setFrom('OutletMinero <info@outletminero.com>');
	$mail->setSubject('Registro de Proveedor');
	$mail->setPriority('high');
	$mail->setHTML('
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="outlet minero, miner�a, noticias de miner�a, minas, bolsa de trabajo, proveedores de miner�a, entrevistas, latinoam�rica, miner�a en latinoam�rica, miner�a sustentable, bolsa de trabajo, sector minero, industria minera" />
<meta name="description" content="Portal de informaci�n de noticias, entrevistas, art�culos, bolsa de trabajo, directorio de proveedores de la industria minera en Latinoam�rica." />
<meta name="Language" content="Spanish" />
<meta name="Distribution" content="Global" />
<meta name="Robots" content="All" />
<meta name="Author" content="tecnologia@outletminero.com" />
<title>Outlet Minero</title>
<style type="text/css">
body {
	background-image: url(http://www.outletminero.org/imgs/main_bg.gif);
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
<link href="http://www.outletminero.org/css/links.css" rel="stylesheet" type="text/css" />
<link href="http://www.outletminero.org/css/textos.css" rel="stylesheet" type="text/css" />
<link href="http://www.outletminero.org/css/tables.css" rel="stylesheet" type="text/css" />
<link href="http://www.outletminero.org/css/forms.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" />

</head>

<body>
<table width="970" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    </br>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="530" height="90" valign="top"><a href="?"><img src="http://www.outletminero.org/imgs/logo.png" alt="" width="305" height="80" border="0" /></a></td>
        <tr style="border-bottom:1px solid #999999">
          <td width="422" valign="top">
          	<table width="100%" hspace="s0" border="0" cellspacing="0" cellpadding="0">
          		<tr style="border-bottom:1px solid #999999">
                    <td align="left"><a href="http://www.facebook.com/profile.php?id=100002217442824" target="_blank"><img src="http://www.outletminero.org/imgs/facebook_32.png" alt="" width="32" height="32" border="0" /></a> 
                    <a href="http://www.twitter.com/@outletminero" target="_blank"><img src="http://www.outletminero.org/imgs/twitter_32.png" alt="" width="32" height="32" border="0" /></a>
                 </tr>
            </table></td> 
          </tr>
    </table></td>
  </tr>
  
  <tr>
    <td align="center"><img src="http://www.outletminero.org/imgs/shadow_menu.png" width="959" height="12" alt="" /></td>
  </tr>
  <tr>
    <td>
	'.$this->verA($id).'
    </td>
    
  </tr>  
  
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
  <td>
<table align="center" width="970" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
    
    <td width="970" height="150"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="280" valign="top"><p><img src="http://www.outletminero.org/imgs/logo_mini.png" width="153" height="40" alt="" /></p>
          <p><span class="txtPP">&copy; 2011</span>
            <span class="txtPPBold">Outlet Minero S.A. de C.V.</span><br />
            <span class="txtPP">Todos los Derechos Reservados </span></p></td>
        <td width="200" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="2"><span class="txtBold1">MAPA DEL SITIO</span></td>
            </tr>
          <tr>
            <td colspan="2" class="linkPP"><a href="?F=quienessomos&amp;_f=main">&iquest;Qui&eacute;nes somos?</a></td>
            </tr>
          <tr>
            <td colspan="2" class="linkPP"><a href="?F=editoriales&_f=main">Editorial</a></td>
          </tr>
          <tr>
            <td colspan="2" class="linkPP"><a href="?F=noticias&amp;_f=main">Noticias y art&iacute;culos</a></td>
            </tr>
          <tr>
            <td colspan="2" class="linkPP"><a href="?F=entrevistas&amp;_f=main">Entrevistas</a></td>
            </tr>
        </table>
          <br /></td>
        <td width="240" valign="top"><br />
          <table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
              <td class="linkPP"><a href="?F=proveedores&amp;-f=main">Directorio de proveedores</a></td>
            </tr>
            <tr>
              <td class="linkPP"><a href="?F=bolsatrabajo&amp;_f=main">Bolsa de trabajo</a></td>
            </tr>
          </table></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td width="100%"><span class="txtBold1">MANTENTE INFORMADO</span></td>
          </tr>
          <tr>
            <td class="linkPP"><a href="?F=contacto&amp;_f=main">Contacto</a></td>
          </tr>
          <tr>
            <td class="linkPP"><a href="http://www.facebook.com/pages/Outletminero/111838228897928" target="_blank">Facebook</a></td>
          </tr>
          <tr>
            <td class="linkPP"><a href="http://twitter.com/@outletminero" target="_blank">Twitter</a></td>
          </tr>        
        </table></td>
      </tr>
    </table></td>
    
  </tr>
</table>
</td>
</tr>
</table>
<table width="970" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><img src="http://www.outletminero.org/imgs/shadow_menu.png" width="959" height="12" alt="" /></td>
  </tr>
</table>'
	);
	$result = $mail->send(array('tecnologia@outletminero.com',$us_correo));
}//function enviar


public function enviado(){
	return '<p class="txtTit">Directorio de Proveedores</p>
           <blockquote>
             <p class="txtCont"><span class="txtBold">Tu correo ha sido a&ntilde;adido exitosamente</span>. En pocos minutos recibir&aacute;s un correo electr&oacute;nico como copia de tu env&iacute;o.</p>
             <p class="txtCont">Gracias por tu tiempo en solicitar informaci&oacute;n a Outlet Minero.</p>
			 <p class="txtCont">Para reportar alg&uacute;n error en el sitio web favor de reportarlo a <span class="linkCont"><a href="mailto:tecnologia@outletminero.com">tecnologia@outletminero.com</a></span>
             <p class="txtCont">Atentamente</p>
			 <p class="txtCont"><a href="http://www.outletminero.com/"><img src="http://www.outletminero.com/imgs/logo_mini.png" border="0" /></a></p>
           </blockquote>';
}//registrado


}//class
?>