<?php
echo (preg_match('/biblioteca.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class biblioteca extends _GLOBAL_{

// MENÚ DE ACCESO RÁPIDO A ESTA SECCION *********************************************************************************
private function quickAccess(){
	$echo = '<table cellspacing="0" cellpadding="4"><tr>
				<td class="linkCont"><a href="?F=biblioteca&amp;_f=addModCat">Ingresar nueva Categoria</a></td>
				<td class="txtTitEncab"> | </td>
				<td class="linkCont"><a href="?F=biblioteca&amp;_f=addModSC">Agregar Subcategoria</a></td>
				<td class="txtTitEncab"> | </td>
				<td class="linkCont"><a href="?F=biblioteca&amp;_f=addModBen">Agregar Benefactor</a></td>
				<td class="txtTitEncab"> | </td>
				<td class="linkCont"><a href="?F=biblioteca&amp;_f=addMod">Agregar Documentos</a></td>
				<td class="txtTitEncab"> | </td>
				<td class="linkCont"><a href="?F=biblioteca&amp;_f=seeDelete">Listado de Documentos</a></td>
				</tr></table>';
	return $echo;
}//quickAccess




# ******************************************************** AGREGAR CATEGORIAS ************************************************************************
# ***********************************************************************************************************************************************
public function addModCat(){
	if (isset($_GET["id"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM categorias WHERE id='{$_GET['id']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		// Registros .......
		$nombre = $row["nombre"];
		$imagen = ($row["imagen"] != '') ? '<br /><img src="../'. $row["imagen"] .'" border="0" /><input type="hidden" name="img" value="'. $row["imagen"] .'" />' : '';		
	} else {
		$_GET["id"] = '0';
		$nombre = '';
		$imagen = '';
	}//if
	
	$echo = $this->quickAccess() .'<p class="txtTitles">Agregar Categoria</p>
			<p class="txtCont1">Ingrese los datos que se solicitan a continuaci&oacute;n para agregar una nueva categoria.</p>
			<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=biblioteca&amp;_f=addCat">
			  <input type="hidden" name="id" value="'. $_GET["id"] .'" />
				  <table width="100%" border="0" cellspacing="0" cellpadding="5">
					<tr>
					  <td valign="top" class="txtCont2" width="150">Categoria:</td>
					  <td valign="top"><input name="nombre" type="text" id="nombre" size="60" maxlength="255" value="'. $nombre .'" /></td>
					</tr>
					<tr>
      					<td valign="top" class="txtCont2">Imagen:</td>
					    <td valign="top">
							<input type="hidden" name="MAX_FILE_SIZE1" value="3000000" /><input name="imagen1" type="file" />'. $imagen .'&nbsp;<br />
	  					</td>
    				</tr>
					<tr>
					  <td valign="top" class="txtCont2">&nbsp;</td>
					  <td valign="top"><input name="enviar" type="submit" class="frmBtnIngresar" id="enviar" value="Agregar-Modificar" /></td>
					</tr>
				  </table>
			</form>
				<script language="JavaScript" type="text/javascript">
				 var frmvalidator = new Validator("form");
				 frmvalidator.addValidation("nombre","req","Ingrese el nombre de la categoria.");
				 //frmvalidator.addValidation("imagen1","req","Seleccione una imagen para la categoria.");
				</script>' . $this->seeDeleteCat();
	return $echo;
}//addModCat

# ******************************************************** AGREGAR SUBCATEGORIAS ************************************************************************
# ***********************************************************************************************************************************************
public function addModSC(){
	if (isset($_GET["id"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM subcategorias WHERE id='{$_GET['id']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		// Registros .......
		$nombre = $row["nombre"];
		$cat=$row["idcategoriaFK"];
	} else {
		$_GET["id"] = '0';
		$nombre = '';
	}//if
	
	$echo = $this->quickAccess() .'<p class="txtTitles">Agregar Subcategorias</p>
			<p class="txtCont1">Ingrese los datos que se solicitan a continuaci&oacute;n para agregar una nueva subcategoria.</p>
			<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=biblioteca&amp;_f=addSC">
			  <input type="hidden" name="id" value="'. $_GET["id"] .'" />
				  <table width="100%" border="0" cellspacing="0" cellpadding="5">
					<tr>
					  <td valign="top" class="txtCont2" width="150">Subcategoria:</td>
					  <td valign="top"><input name="nombre" type="text" id="nombre" size="60" maxlength="255" value="'. $nombre .'" /></td>
					</tr>
					<tr>
		  				<td valign="top" class="txtCont2" width="150">Categoria:</td>
					  <td valign="top">'. $this->listCat($cat) .'</td>
					</tr>
					<tr>
					  <td valign="top" class="txtCont2">&nbsp;</td>
					  <td valign="top"><input name="enviar" type="submit" class="frmBtnIngresar" id="enviar" value="Agregar-Modificar" /></td>
					</tr>
				  </table>
			</form>
				<script language="JavaScript" type="text/javascript">		
					var frmvalidator = new Validator("form");
					frmvalidator.addValidation("nombre","req","Ingrese el nombre de la Subcategoria");
					frmvalidator.addValidation("cat","dontselect=0","Seleccione una Categoria");						 				 			 				</script>' . $this->seeDeleteSC();
	return $echo;
}//addModSC


# ******************************************************** AGREGAR BENEFACTOR ************************************************************************
# ***********************************************************************************************************************************************
public function addModBen(){
	if (isset($_GET["id"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM benefactores WHERE id='{$_GET['id']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		// Registros .......
		$nombre = $row["nombre"];
		$introduccion = $row["introduccion"];
		$sitioweb = $row["sitioweb"];
//		$cat=$row["idcategoriaFK"];
	} else {
		$_GET["id"] = '0';
		$nombre = '';
	}//if
	
	$echo = $this->quickAccess() .'<p class="txtTitles">Agregar Benefactor</p>
			<p class="txtCont1">Los benefactores son las personas u organizaciones que aportan los documentos para la biblioteca virtual, para dar de alta alguno selecciona lo siguiente.</p>
			<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=biblioteca&amp;_f=addBen">
			  <input type="hidden" name="id" value="'. $_GET["id"] .'" />
				  <table width="100%" border="0" cellspacing="0" cellpadding="5">
					<tr>
					  <td valign="top" class="txtCont2" width="150">Nombre:</td>
					  <td valign="top"><input name="nombre" type="text" id="nombre" size="60" maxlength="255" value="'. $nombre .'" /></td>
					</tr>
					<tr>
				    	<td valign="top" class="txtCont2">Descripci&oacute;n:</td>
      					<td valign="top"><textarea name="introduccion" id="introduccion" cols="40" rows="3">'. $introduccion .'</textarea></td>
    				</tr>
					<tr>
				    	<td valign="top" class="txtCont2">Sitio web:</td>
					  	<td valign="top"><input name="sitioweb" type="text" id="sitioweb" size="60" maxlength="255" value="'. $sitioweb .'" /><br /><span class="txtCont1">Ingrese la direccion completa desde http://</span></td>
					</tr>					
					<tr>
					  <td valign="top" class="txtCont2">&nbsp;</td>
					  <td valign="top"><input name="enviar" type="submit" class="frmBtnIngresar" id="enviar" value="Agregar-Modificar" /></td>
					</tr>
				  </table>
			</form>
				<script language="JavaScript" type="text/javascript">		
					var frmvalidator = new Validator("form");
					frmvalidator.addValidation("nombre","req","Ingrese el nombre del Benefactor");
//					frmvalidator.addValidation("introduccion","req","Ingrese una descripcion");
					frmvalidator.addValidation("sitioweb","req","Ingrese el sitio web del Benefactor");
											 				 			 				</script>' . $this->seeDeleteBen();
	return $echo;
}//addModSC

public function addCat(){
	if(!isset($_POST["nombre"])){ echo '<h2>No se puede agregar su publicaci&oacute;n.</h2>'; exit(); }//if
	// Inserción de datos .............................	
	$nombre = strip_tags($_POST["nombre"]);
	$ruta = 'gallery/biblioteca/categorias/';
	
	
	// Validación de imágenes ...............................
	$WIDTH = 300; $HEIGHT = 230;
	
	if (isset($_FILES["imagen1"]["name"]) && $_FILES["imagen1"]["name"] != ''){
		$imagen = $this->validar_1_imagen('1', $ruta, $WIDTH, $HEIGHT);
		$imagen = $ruta . $imagen;
		@unlink('../'. $_POST["img"]);
	} else {
		$imagen = (isset($_POST["img"])) ? $_POST["img"] : '';
	}//if		
	
	// Bases de datos........................................
	$db = $this->_db();
	if ($_POST["id"] == 0){
		mysql_query("INSERT INTO categorias (nombre, imagen) VALUES ('". $nombre ."','".$imagen."')") or die(mysql_error());
		$id=mysql_insert_id();
		$echo ='<script type="text/javascript">
						setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
						setTimeout("top.location.href = \'?F=biblioteca&_f=addModCat\'",1000);
						</script>';
	} else {
		$sql = "UPDATE categorias SET nombre='$nombre', imagen='$imagen' WHERE id='{$_POST['id']}'";
		$result = mysql_query($sql);
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=biblioteca&_f=addModCat\'",1000);
					</script>';
	}//if
	return $echo;
}//addCat


public function addSC(){
	if(!isset($_POST["nombre"])){ echo '<h2>No se puede agregar su publicaci&oacute;n.</h2>'; exit(); }//if
	// Inserción de datos .............................	
	$nombre = strip_tags($_POST["nombre"]);
	$cat = $_POST["cat"];
	// Bases de datos........................................
	$db = $this->_db();
	if ($_POST["id"] == 0){
		mysql_query("INSERT INTO subcategorias (nombre, idcategoriaFK) VALUES ('". $nombre ."','".$cat."')") or die(mysql_error());
		$id=mysql_insert_id();
		$echo ='<script type="text/javascript">
						setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
						setTimeout("top.location.href = \'?F=biblioteca&_f=addModSC\'",1000);
						</script>';
	} else {
		$sql = "UPDATE subcategorias SET nombre='$nombre', idcategoriaFK=$cat WHERE id='{$_POST['id']}'";
		$result = mysql_query($sql);
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=biblioteca&_f=addModSC\'",1000);
					</script>';
	}//if
	return $echo;
}//addSC

public function addBen(){
	if(!isset($_POST["nombre"])){ echo '<h2>No se puede agregar su publicaci&oacute;n.</h2>'; exit(); }//if
	// Inserción de datos .............................	
	$nombre = strip_tags($_POST["nombre"]);
    $introduccion = strip_tags($_POST["introduccion"]);
	$sitioweb = $_POST["sitioweb"];

	// Bases de datos........................................
	$db = $this->_db();
	if ($_POST["id"] == 0){
		mysql_query("INSERT INTO benefactores (nombre, introduccion, sitioweb, activo) VALUES ('". $nombre ."','".$introduccion."','".$sitioweb."',1)") or die(mysql_error());
		$id=mysql_insert_id();
		$echo ='<script type="text/javascript">
						setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
						setTimeout("top.location.href = \'?F=biblioteca&_f=addModBen\'",1000);
						</script>';
	} else {
		$sql = "UPDATE benefactores SET nombre='$nombre', introduccion='$introduccion', sitioweb='$sitioweb' WHERE id='{$_POST['id']}'";
		$result = mysql_query($sql);
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=biblioteca&_f=addModBen\'",1000);
					</script>';
	}//if
	return $echo;
}//addBen

private function seeDeleteCat(){
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM categorias WHERE id!=10 ORDER BY nombre");
	$echo = '';
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			//$contenido = substr($row["contenido"], 0, 330);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=biblioteca&amp;_f=addModCat&amp;id='. $row["id"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7"><span class="linkCont"><a href="?F=biblioteca&amp;_f=addModCat&amp;id='. $row["id"] .'">'. $row["nombre"] .'</a></span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="javascript:void(ConfirmDelete(\'?F=biblioteca&amp;_f=deleteCat&amp;id='. $row["id"] .'\'))"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<p class="txtTitles">Listado de Categorias</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="3">
				  <tr class="txtBold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">Categoria:</td>
					<td style="background:#E3EEF0" width="30" align="center">Borrar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//seeDeleteCat

private function seeDeleteSC(){
	$db = $this->_db();
	$result = mysql_query("SELECT sc.id,sc.nombre,sc.idcategoriaFK,c.nombre as nombre2 FROM subcategorias sc, categorias c where sc.idcategoriaFk=c.id and sc.id!=41 ORDER BY sc.nombre");
	$echo = '';
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			//$contenido = substr($row["contenido"], 0, 330);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=biblioteca&amp;_f=addModSC&amp;id='. $row["id"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7"><span class="linkCont"><a href="?F=biblioteca&amp;_f=addModSC&amp;id='. $row["id"] .'">'. $row["nombre"] .'</a></span></td>
						<td style="background:#F7F7F7"><span class="txtCont1">'. $row["nombre2"] .'</a></span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="javascript:void(ConfirmDelete(\'?F=biblioteca&amp;_f=deleteSC&amp;id='. $row["id"] .'\'))"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<p class="txtTitles">Listado de Subcategorias</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="3">
				  <tr class="txtBold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">Subcategoria:</td>
					<td style="background:#E3EEF0" align="center">Categoria:</td>
					<td style="background:#E3EEF0" width="30" align="center">Borrar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//seeDeleteSC

private function seeDeleteBen(){
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM benefactores WHERE id!=3 ORDER BY nombre");
	$echo = '';
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			//$contenido = substr($row["contenido"], 0, 330);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=biblioteca&amp;_f=addModBen&amp;id='. $row["id"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7"><span class="linkCont"><a href="?F=biblioteca&amp;_f=addModBen&amp;id='. $row["id"] .'">'. $row["nombre"] .'</a></span></td>
						<td style="background:#F7F7F7"><span class="txtCont1">'. $row["introduccion"] .'</a></span></td>
						
						<td style="background:#F7F7F7"><span class="txtCont1">'. $row["sitioweb"] .'</a></span></td>
						
						<td style="background:#F7F7F7" width="30" align="center"><a href="javascript:void(ConfirmDelete(\'?F=biblioteca&amp;_f=deleteBen&amp;id='. $row["id"] .'\'))"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = '<p class="txtTitles">Listado de Benefactores</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="3">
				  <tr class="txtBold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">Benefactor:</td>
					<td style="background:#E3EEF0" align="center">Descripcion:</td>
					<td style="background:#E3EEF0" align="center">Sitio web:</td>
					<td style="background:#E3EEF0" width="30" align="center">Borrar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//seeDeleteBen

public function deleteCat(){
	if (!isset($_GET["id"])){ echo '<h2>No existe identificador de imagen</h2>'; exit(); }//if
	$db=$this->_db();
	mysql_query("UPDATE subcategorias set idcategoriaFK=10 WHERE idcategoriaFK='{$_GET['id']}'");
	$result=mysql_query("SELECT imagen FROM categorias WHERE id='{$_GET['id']}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
		
	if ($row["imagen"] != '' && $row["imagen"] != ' '){		
		@unlink('../'. $row["imagen"]);
	}
	
	mysql_query("DELETE FROM categorias WHERE id='{$_GET['id']}'");
		
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=biblioteca&_f=addModCat\'",1000);
				</script>';
	return $echo;
}//deleteCat

public function deleteSC(){
	if (!isset($_GET["id"])){ echo '<h2>No existe identificador de imagen</h2>'; exit(); }//if
	$db=$this->_db();
	mysql_query("UPDATE documentos set idsubcategoriaFK=41 WHERE idsubcategoriaFK='{$_GET['id']}'");
	mysql_query("DELETE FROM subcategorias WHERE id='{$_GET['id']}'");
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=biblioteca&_f=addModSC\'",1000);
				</script>';
	return $echo;
}//deleteSC

public function deleteBen(){
	if (!isset($_GET["id"])){ echo '<h2>No existe identificador de imagen</h2>'; exit(); }//if
	$db=$this->_db();
	mysql_query("UPDATE documentos set idbenefactorFK=3 WHERE idbenefactorFK='{$_GET['id']}'");
	mysql_query("DELETE FROM benefactores WHERE id='{$_GET['id']}'");
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=biblioteca&_f=addModBen\'",1000);
				</script>';
	return $echo;
}//deleteSC



# ********************************************************** DIRECTORIO DE PROVEEDORES *******************************************************************************
# **************************************************************************************************************************************************************

public function addMod(){	// Formulario para agregar empresa y usuario
	if (isset($_GET["id"])){
		$db = $this->_db();
		$result = mysql_query("SELECT * FROM documentos WHERE id='{$_GET['id']}'");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		// Registros .......
		$id = $row["id"];
		$titulo = $row["titulo"];
		$introduccion = $row["introduccion"];		
		$imagen = ($row["imagen"] != '') ? '<br /><img width="200" height="300" src="../'. $row["imagen"] .'" border="0" /><input type="hidden" name="img1" value="'. $row["imagen"] .'" />' : '';		
		$archivo= ($row["archivo"] != '') ? '<br /><embed src="../'.$row["archivo"].'" width="800" height="500" align="middle"></embed><input type="hidden" name="arch1" value="'. $row["archivo"] .'" />' : '';
	    $fechapub = $row["fechapub"];
		$sc = $row["idsubcategoriaFK"];
		$ben = $row["idbenefactorFK"];
	    $pc = $this->listPC($id);								
		
		mysql_free_result($result);
		mysql_close();
	} else {
		$_GET["id"] = '0';
		$titulo = '';
		$introduccion = '';
		$imagen = '';		
		$archivo = ''; 
		$fp = '';
		$sc = '';
		$ben = '';		
		$pc = '';		
	}//if
	
	return $this->quickAccess() .'<p class="txtTitles">Agregar / Modificar Documentos</p>
			<p class="txtCont1">Ingrese los datos que se solicitan a continuaci&oacute;n para agregar una un nuevo documentos, los cuales autom&aacute;ticamente se publicar&aacute;n en el sitio web.</p>
<form id="form" name="form" enctype="multipart/form-data" method="post" action="?F=biblioteca&amp;_f=addDocumentos">
	<input type="hidden" id="DPC_FIRST_WEEK_DAY" value="2" />
	<input type="hidden" id="DPC_WEEKEND_DAYS" value="[0,5,6]" />
	<input type="hidden" id="DPC_CALENDAR_OFFSET_X" value="20" />
	<input type="hidden" id="DPC_BUTTON_OFFSET_X" value="10" />
  	<input type="hidden" name="id" value="'. $_GET["id"] .'" />
	  <table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
		  <td valign="top" class="txtCont2" width="150">Titulo:</td>
		  <td valign="top"><input name="titulo" type="text" id="titulo" size="60" maxlength="255" value="'. $titulo .'" /></td>
		</tr>		
		<tr>
		  <td valign="top" class="txtCont2">Introducci&oacute;n del Documento:</td>
		  <td valign="top"><textarea name="introduccion" id="introduccion" cols="60" rows="3">'. $introduccion .'</textarea></td>
	    </tr>
		<tr>
			<td valign="top" class="txtCont2">Imagen:</td>
			<td valign="top">
				<input type="hidden" name="MAX_FILE_SIZE1" value="3000000" /><input name="imagen1" type="file" />'. $imagen .'&nbsp;<br />
			</td>
		</tr>
		<tr>
			<td valign="top" class="txtCont2">Archivo:</td>
			<td valign="top">
				<input type="hidden" name="MAX_FILE_SIZE1" value="3000000" /><input name="archivo" type="file" />'. $archivo .'&nbsp;<br /><span class="txtPieNotaGris">Solo se permiten subir archivo con extension .pdf</span>				
			</td>
		</tr>				
		<tr>
		  <td valign="top" class="txtCont2" width="150">Fecha de publicacion del archivo:</td>
		  <td valign="top"><input name="fechapub" type="text" id="DPC_calendar1b_YYYY-MM-DD" size="10" maxlength="10" value="'. $fechapub .'" /></td>
		</tr>
		<tr>
		  	<td valign="top" class="txtCont2" width="150">Subcategoria:</td>
			<td valign="top">'. $this->listSC($sc) .'</td>
		</tr>
		<tr>
		  	<td valign="top" class="txtCont2" width="150">Benefactor:</td>
			<td valign="top">'. $this->listBen($ben) .'</td>
		</tr>				
		<tr>
		  <td valign="top" class="txtCont2">Palabras clave:</td>
		  <td valign="top"><input name="pc" type="text" id="pc" value="'. $pc .'" size="60" maxlength="255" /><br /><span class="txtPieNotaGris">Escribe las palabras clave referentes al documento, separadas por comas(,).</span></td>
		</tr>
		<tr>
		  <td valign="top" class="txtCont2">&nbsp;</td>
		  <td valign="top"><input name="enviar" type="submit" class="frmBtnIngresar" id="enviar" value="Agregar-Modificar" /></td>
		</tr>
	  </table>
</form>
	<script language="JavaScript" type="text/javascript">
		 var frmvalidator = new Validator("form");
		 frmvalidator.addValidation("titulo","req","Ingrese el Titulo del documento");
		 //frmvalidator.addValidation("introduccion","req","Ingrese una introduccion");
		 //frmvalidator.addValidation("imagen1","req","Seleccione una imagen");
		 //frmvalidator.addValidation("archivo","req","Seleccione un archivo");
		 frmvalidator.addValidation("fechapub","req","Seleccione la fecha de publicacion");
		 frmvalidator.addValidation("sc","dontselect=0","Seleccione una Subcategoria");		
		 frmvalidator.addValidation("ben","dontselect=0","Seleccione un Benefactor");		
		 frmvalidator.addValidation("pc","req","Ingrese al menos una palabra clave");		
	</script>
';
}//addMod


public function addDocumentos(){
	if(!isset($_POST["titulo"])){ echo '<h2>No se puede agregar su publicaci&oacute;n.</h2>'; exit(); }//if
	// Inserción de datos .............................		
	extract($_POST);
	$titulo = strip_tags($_POST["titulo"]);
	$pc=$_POST["pc"];
	
	$ruta = 'gallery/biblioteca/imagenes/';
	$ruta2 = 'gallery/biblioteca/documentos/';		
			
	$fechasub = date("Y-m-d");
	$activo = '1';
	
	// Validación de imágenes ...............................
	$WIDTH = 300; $HEIGHT = 230;
	
	if (isset($_FILES["imagen1"]["name"]) && $_FILES["imagen1"]["name"] != ''){
		$imagen = $this->validar_1_imagen('1', $ruta, $WIDTH, $HEIGHT);
		$imagen = $ruta . $imagen;
		@unlink('../'. $_POST["img1"]);
	} else {
		$imagen = (isset($_POST["img1"])) ? $_POST["img1"] : '';
	}//if
	
		// Validación de archivos ...............................		
	
	if (isset($_FILES["archivo"]["name"]) && $_FILES["archivo"]["name"] != ''){
		$archivo = $this->validar_archivo($ruta2);
		$archivo = $ruta2 . $archivo;
		@unlink('../'. $_POST["arch1"]);
	} else {
		$archivo = (isset($_POST["arch1"])) ? $_POST["arch1"] : '';
	}
	$echo.= '<p>titulo='.$titulo.'<br />introduccion='.$introduccion.'<br />imagen='.$imagen.'<br />fechapu='.$fechapub.'<br />fechasub='.$fechasub.'<br />archivo='.$archivo.'<br />activo='.$activo.'<br />sc='.$sc.'<br />ben='.$ben.'</p>';
	//if
		
	// Bases de datos........................................
	$db = $this->_db();		
	if ($_POST["id"] == 0){
		// Registrar documento
		mysql_query("INSERT INTO documentos (titulo, introduccion, imagen, fechapub, fechasub, archivo, activo, idsubcategoriaFK, idbenefactorFK)
					VALUES ('". $titulo ."', '". $introduccion."', '". $imagen."', '". $fechapub."', '". $fechasub."', '". $archivo."', ".$activo.", ". $sc .", ". $ben .")") or die(mysql_error());
		
		//mysql_free_result($result);
		
		//Consultar id del ultimo registro
		$result = mysql_query("SELECT id FROM documentos ORDER BY id DESC");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		
		//Separar las palabras clave de la caja de texto
		$separar = explode(',',$pc);
		//echo($separar);
		$nopalabras=count($separar);
				
		$i=0;
		//insertar las palabras clave en la base de datos
		while($i<$nopalabras){
			mysql_query("INSERT INTO palabrasclave (nombre, iddocFK)
					VALUES ('". $separar[$i] ."',".$row["id"].")") or die(mysql_error());			
			$i=$i+1;			
		}		        					
					
		$id=mysql_insert_id();		
		//Mensaje de registro agregado 
		$echo ='<script type="text/javascript">
						setTimeout("alert(\'SU REGISTRO HA SIDO AGREGADO\');",100); 
						setTimeout("top.location.href = \'?F=biblioteca&_f=seeDelete\'",1000);
						</script>';
	} else {
		$sql = "UPDATE documentos SET titulo='$titulo', introduccion='$introduccion', imagen='$imagen', fechapub='$fechapub', fechasub='$fechasub', archivo='$archivo', idsubcategoriaFK=$sc, idbenefactorFK=$ben WHERE id='{$_POST['id']}'";
		$result = mysql_query($sql);
		$result = mysql_query("DELETE FROM palabrasclave WHERE iddocFK='{$_POST['id']}'");
		
		//Separar las palabras clave de la caja de texto
		$separar = explode(',',$pc);
		$nopalabras=count($separar);
		$i=0;
		//insertar las palabras clave en la base de datos
		while($i<$nopalabras){
			mysql_query("INSERT INTO palabrasclave (nombre, iddocFK)
					VALUES ('". $separar[$i] ."','{$_POST['id']}')") or die(mysql_error());			
			$i=$i+1;			
		}
		
		$echo ='<script type="text/javascript">
					setTimeout("alert(\'SU REGISTRO HA SIDO ACTUALIZADO\');",100); 
					setTimeout("top.location.href = \'?F=biblioteca&_f=seeDelete\'",1000);
					</script>';
	}//if
	return $echo;
}//addDocumentos

# ************************************************************* ENVÍO DE CORREOS PARA ACTIVACIÓN ******************************************************************
# *****************************************************************************************************************************************************************
public function enviar($id, $empresa, $giro, $descripcion, $calle, $numext, $numint, $colonia, $cp, $ciudad, $estado, $pais, $calle1, $calle2, $diasatencion, $horarios, $telefonos, $correo, $sitioweb, $us_nombre, $us_apellidos, $us_correo, $us_puesto, $us_telefono, $fechapub, $vigencia, $codigo){
	$destinatario = $correo;
	// Consultar el giro
	$result = mysql_query("SELECT * FROM giros WHERE id='{$giro}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	$giroProv = $row["nombre"];
	mysql_free_result($result);
	mysql_close();
	
	# FORMATO DE CORREO ELECTRONICO DEL PANEL DE ADMINISTRACIÓN AL REGISTRAR UN PROVEEDOR ++++++++++++++++++++++++++++++++++++++++++++++++
	$datos = '<p><img src="http://www.outletminero.com/imgs/logo_mini.png" border="0" /></p>
			 	<p>Ven y conoce OutletMinero.com, sitio de informaci&oacute;n de la industria minera en Latinoam&eacute;rica, donde podr&aacute;s encontrar Noticias, Entrevistas, Directorio de Proveedores, Bolsa de Trabajo y m&aacute;s.</p>
				<p>Este correo electr&oacute;nico es una notificaci&oacute;n de que has sido agregado en nuestro Directorio de Proveedores, y estar&aacute;s visible para nuestros visitantes.</p>
				<p>La informaci&oacute;n agregada de tu empresa ha sido la siguiente:</p>
				<p>
					<b>Nombre de la empresa: </b>'. utf8_decode($empresa) .'<br />
					<b>Giro: </b>'. utf8_decode($giroProv) .'<br />
					<b>Calle: </b>'. utf8_decode($calle) .'<br />
					<b>N&uacute;mero exterior: </b>'. utf8_decode($numext) .'<br />
					<b>N&uacute;mero interior: </b>'. utf8_decode($numint) .'<br />
					<b>Colonia: </b>'. utf8_decode($colonia) .'<br />
					<b>C&oacute;digo Postal: </b>'. utf8_decode($cp) .'<br />
					<b>Ciudad: </b>'. utf8_decode($ciudad) .'<br />
					<b>Estado: </b>'. utf8_decode($estado) .'<br />
					<b>Pa&iacute;s </b>'. utf8_decode($pais) .'<br />
					<b>Telefonos: </b>'. utf8_decode($telefonos) .'<br />
					<b>Correo: </b>'. $correo .'<br />
					<b>Sitio web: </b>'. $sitioweb .'
				</p>
				<p>Tu publicaci&oacute;n estar&aacute; vigente hasta el d&iacute;a 31 de Junio de 2011, y un ejecutivo se comunicar&aacute; contigo para dar seguimiento a tu registro.<p>
				<p>Para poder actualizar tu informaci&oacute;n podr&aacute;s ingresar con el siguiente enlace, y es necesario que ingreses tu contrase&ntilde;a para la seguridad de tu informaci&oacute;n</p>
				<p><a href="http://www.outletminero.com/?F=proveedores_activ&amp;_f=activarCuenta&amp;codigo='. $codigo .'&amp;id='. $id .'">http://www.outletminero.com/?F=proveedores_activ&amp;_f=activarCuenta&amp;correo='. $correo .'&amp;codigo='. $codigo .'&amp;id='. $id .'</a></p>
				';
	$datos .= 'Este correo es enviado desde formulario de registro del sitio Web: <b><a href="http://www.outletminero.com">www.outletminero.com</a></b>
				<a href="http://www.outletminero.com/" title="OutletMinero.com"><img src="http://www.outletminero.com/imgs/logo_outletminero.jpg" border="0" /></a>';

	require_once('../Rmail/Rmail.php');
	$mail = new Rmail();
		$mail->setFrom('Registro Proveedores <info@outletminero.com>');
		$mail->setSubject('Te damos la bienvenida a Outlet Minero');
		$mail->setPriority('high');
		$mail->setHTML($datos);
		$result  = $mail->send(array($destinatario));
		//$result  = $mail->send(array($destinatario));
}//function enviar


public function seeDelete(){
	$db = $this->_db();
	$result = mysql_query("select d.id as ide,d.titulo,d.introduccion,d.fechapub,d.fechasub,sc.nombre nombresc,c.nombre as nombrecat,b.nombre as nombreben from
documentos d, subcategorias sc, categorias c, benefactores b
where d.idsubcategoriaFK=sc.id and
d.idbenefactorFK=b.id and
sc.idcategoriaFK=c.id");
	$echo = '';
	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$fechapub = $this->txtFechaPub($row["fechapub"]);
			//$contenido = substr($row["contenido"], 0, 330);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=biblioteca&amp;_f=addMod&amp;id='. $row["ide"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7"><span class="linkCont"><a href="?F=biblioteca&amp;_f=addMod&amp;id='. $row["ide"] .'">'. $row["titulo"] .'</a></td>						
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["introduccion"] .'</span></td>						
						<td style="background:#F7F7F7"><span class="txtCont2">'. $this->txtFechaPub($row["fechapub"]) .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $this->txtFechaPub($row["fechasub"]) .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["nombresc"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["nombrecat"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["nombreben"] .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="javascript:void(ConfirmDelete(\'?F=biblioteca&amp;_f=deleteDocumentos&amp;id='. $row["ide"] .'\'))"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content = $this->quickAccess() . $this->buscarDocumentos() .'<p class="txtTitles">Listado de Documentos</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="3">
				  <tr class="txtBold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">Titulo</td>
					<td style="background:#E3EEF0" align="center">Introduccion:</td>
					<td style="background:#E3EEF0" align="center">Publicado el:</td>
					<td style="background:#E3EEF0" align="center">Subido el:</td>
					<td style="background:#E3EEF0" align="center">Subcategoria:</td>
					<td style="background:#E3EEF0" align="center">Categoria:</td>
					<td style="background:#E3EEF0" align="center">Benefactor:</td>
					<td style="background:#E3EEF0" width="30" align="center">Borrar</td>
				  </tr>
				  '. $echo .'
				</table>';
	return $content;
}//


private function buscarDocumentos(){
	return '<p class="txtTitles">B&uacute;squeda de Documentos</p>
			
			<table width="100%" border="0" cellpadding="0" cellspacing="10" class="tbBack1">
				  <tr class="clsBusqueda1">
				    <td>
					  <form id="form4" name="form4" method="post" action="?F=biblioteca&amp;_f=main">					  						  
					      <SELECT NAME="cmbPor" id="cmbPor" size="1">
						   
						  	<OPTION VALUE="titulo">Titulo</OPTION>
							<OPTION VALUE="nombre">Palabra clave</OPTION> 
						  </SELECT>
						  <input name="like" type="text" id="like" size="65%" maxlength="255" />						
						  <input name="submit" type="submit" class="frmButtonM" id="submit" value="Buscar" />
						
					  </form>					  
					</td>
				  </tr>
				  <tr>
				  	<td>
				  		<input name="btnBA" type="button" class="frmButtonM" id="btnBA" value="B&uacute;squeda avanzada" onclick="funBA();" />
					</td>
				  </tr>
				  <tr>
				  	<td>
						<table width="100%" border="0" cellpadding="0" cellspacing="10" class="clsBusqueda2">
				  <tr>
				  <td>
				  <form id="form4" name="form4" method="post" action="?F=biblioteca&amp;_f=main">					    				  
					  <table>
					  	<tr>
							<td>
								<label class="txtBold">Titulo:</label>
							</td>
							<td>
								<input name="like" type="text" id="like" size="65%" maxlength="255" />
							</td>
						</tr>
						<tr>						
							<td>
								<label class="txtBold">Aportado por:</label>
							</td>
							<td>
								<SELECT NAME="cmbAportado" id="cmbAportado" size="1">
									<option value="0">Seleccionar</option>
								'
								.$this->benefactores().' 								  	
							  	</SELECT>								
								
						  	</td>																					
						</tr>
						<tr>
							<td>
							</td>
							<td>
								<input name="submit" type="submit" class="frmButtonM" id="submit" value="Buscar" />
							</td>
							
						</tr>
					</table>
				</form>
				</td>
				</tr>
			</table>
					</td>
				  </tr>
			</table>
			
			<script src="../js/jquery-1.6.1.min.js" type="text/javascript"></script> 
					 <script type="text/javascript"> 
						$(document).ready(function(){    				   	    
						$(".txtTitCat2").hide();
						$(".txtTitSC2").hide();
						$(".oculta").hide("slow");
						$(".clsBusqueda2").hide("slow");
						
																		
					});		

					function ocultar(ban,oculta, muestra, clase){
						//alert (ban+oculta+muestra+clase);
				 	    $(oculta).hide();
      					$(muestra).show();
						if(ban == \'1\'){	  
    	  					$(clase).show("slow");
						}else{	  
    		  				$(clase).hide("slow");			  			
						}
					}
					function funBA(){												
						$(".clsBusqueda2").show("slow");
						$("#btnBA").hide("slow");
						$(".clsBusqueda1").hide("slow");
					}
					</script>  -
			';
}//buscarProveedor

public function benefactores(){
		$result = mysql_query("SELECT * FROM benefactores ORDER BY nombre");
		$content='';
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$content.='<OPTION VALUE="'.$row["id"].'">'.$row["nombre"].'</OPTION>';
		}
		return $content;
}

public function deleteDocumentos(){
	if (!isset($_GET["id"])){ echo '<h2>No existe identificador de imagen</h2>'; exit(); }//if
	$db=$this->_db();
	$result=mysql_query("SELECT archivo,imagen FROM documentos WHERE id='{$_GET['id']}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	if ($row["archivo"] != '' && $row["archivo"] != ' '){		
		@unlink('../'. $row["archivo"]);
	}
	if ($row["imagen"] != '' && $row["imagen"] != ' '){		
		@unlink('../'. $row["imagen"]);
	}
	
	mysql_query("DELETE FROM palabrasclave WHERE iddocFK='{$_GET['id']}'");
	mysql_query("DELETE FROM documentos WHERE id='{$_GET['id']}'");
	$echo ='<script type="text/javascript">
				setTimeout("alert(\'EL REGISTRO HA SIDO ELIMINADO\');",100); 
				setTimeout("top.location.href = \'?F=biblioteca&_f=seeDelete\'",1000);
				</script>';
	return $echo;
}//delete

public function main(){
	$db = $this->_db();
	
	$like = (!isset($_POST["like"]))? '': strip_tags($_POST["like"]);
	$campo = (!isset($_POST["cmbPor"]))? 'titulo': strip_tags($_POST["cmbPor"]);	
	$aportado = (!isset($_POST["cmbAportado"]))? '0':strip_tags($_POST["cmbAportado"]);	
	//echo 'like='.$like.' campo='.$campo.' aportado='.$aportado;		
	
	if($campo=='nombre'){
		//$result = mysql_query("SELECT id FROM `documentos` WHERE id in (SELECT iddocFK FROM palabrasclave WHERE nombre LIKE '%{$like}%')");
		$consulta = "SELECT id FROM `documentos` WHERE id in (SELECT iddocFK FROM palabrasclave WHERE nombre LIKE '%".$like."%')";		
	}
	else{
		if($aportado=='0'){
			//$result = mysql_query("SELECT id FROM documentos WHERE {$campo} LIKE '%{$like}%'");
			$consulta = "SELECT id FROM documentos WHERE ".$campo." LIKE '%".$like."%'";
		}else{
			//$result = mysql_query("SELECT id FROM documentos WHERE titulo LIKE '%{$like}%' AND idbenefactorFK={$aportado};");
			$consulta = "SELECT id FROM documentos WHERE titulo LIKE '%".$like."%' AND idbenefactorFK=".$aportado;			
		}		
	}	
    //$countresult=mysql_num_rows($result);
	//$content = '<p class="txtTitles">B&uacute;squeda de Documentos</p><p class="txtCont2">Resultados de la b&uacute;squeda</p>';
	//if($countresult>0){	
	return $content . $this->showDocumentos($consulta);
	//}else
	//{
		//return $content.='<p class="txtCont1">No hay resultados que cumplan los criterios de búsqueda.</p>';
	//}
	
}//main

public function showDocumentos($result2){
	$db = $this->_db();	
	$result = mysql_query("select d.id as ide,d.titulo,d.introduccion,d.fechapub,d.fechasub,sc.nombre nombresc,c.nombre as nombrecat,b.nombre as nombreben from
documentos d, subcategorias sc, categorias c, benefactores b
where d.idsubcategoriaFK=sc.id and
d.idbenefactorFK=b.id and
sc.idcategoriaFK=c.id and d.id in (".$result2.")");
	$countresult=mysql_num_rows($result);
	$content.= $this->quickAccess() .'<p class="txtTitles">B&uacute;squeda de Documentos</p><p class="txtCont2">Resultados de la b&uacute;squeda</p>';
	if($countresult>0){	
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$fechapub = $this->txtFechaPub($row["fechapub"]);
			//$contenido = substr($row["contenido"], 0, 330);
			$echo .= '<tr>
						<td style="background:#F7F7F7" width="30" align="center"><a href="?F=biblioteca&amp;_f=addMod&amp;id='. $row["ide"] .'"><img src="imgs/img_edit.png" border="0" /></a></td>
						<td style="background:#F7F7F7"><span class="linkCont"><a href="?F=biblioteca&amp;_f=addMod&amp;id='. $row["ide"] .'">'. $row["titulo"] .'</a></td>						
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["introduccion"] .'</span></td>						
						<td style="background:#F7F7F7"><span class="txtCont2">'. $this->txtFechaPub($row["fechapub"]) .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $this->txtFechaPub($row["fechasub"]) .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["nombresc"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["nombrecat"] .'</span></td>
						<td style="background:#F7F7F7"><span class="txtCont2">'. $row["nombreben"] .'</span></td>
						<td style="background:#F7F7F7" width="30" align="center"><a href="javascript:void(ConfirmDelete(\'?F=biblioteca&amp;_f=deleteDocumentos&amp;id='. $row["ide"] .'\'))"><img src="imgs/img_delete.png" border="0" /></a></td>
					  </tr>';
	}//while
	$content.= '<p class="txtTitles">Listado de Documentos</p>
				<table width="100%" border="0" cellspacing="2" cellpadding="3">
				  <tr class="txtBold">
					<td style="background:#E3EEF0" width="30" align="center">Ver</td>
					<td style="background:#E3EEF0" align="center">Titulo</td>
					<td style="background:#E3EEF0" align="center">Introduccion:</td>
					<td style="background:#E3EEF0" align="center">Publicado el:</td>
					<td style="background:#E3EEF0" align="center">Subido el:</td>
					<td style="background:#E3EEF0" align="center">Subcategoria:</td>
					<td style="background:#E3EEF0" align="center">Categoria:</td>
					<td style="background:#E3EEF0" align="center">Benefactor:</td>
					<td style="background:#E3EEF0" width="30" align="center">Borrar</td>
				  </tr>
				  '. $echo .'
				</table>';
	}else
	{
		return $content.='<p class="txtCont1">No hay resultados que cumplan los criterios de busqueda.</p>';
	}
	return $content;
}//


}//class
?>