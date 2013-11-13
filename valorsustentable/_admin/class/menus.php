<?php
echo (preg_match('/menus.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class _MENU_ extends _GLOBAL_{

public function main(){
	if (!isset($_SESSION["acceso"]) || $_SESSION["acceso"] == 'NO'){ return '';	exit();	}//if
	
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM usuarios WHERE correo='{$_SESSION['correo']}'");
	$row = mysql_fetch_array($result, MYSQL_ASSOC);

	switch($_SESSION["nivel"]){
		case '1': $echo = $this->menuBannersNoticias().
						  $this->menuBanners().
						  $this->menuNoticias().
						  $this->menuEditorial().
						  $this->menuEntrevistas().
						  $this->menuEncuestas().
						  $this->menuHistorias().
						  $this->menuReportajes().
						  $this->menuMitos().
						  $this->menuBiblioteca().
						  $this->menuVideos().
						  $this->menuGalerias().
						  $this->menuForo().
						  $this->menuComentarios().
						  $this->menuCalendario().
						  $this->menuProveedores().
						  $this->menuUsuarios().
						  $this->menuContactos().
						  $this->menuReportes();
		break;
		case '2': $echo = $this->menuBannersNoticias().
						  $this->menuNoticias().
						  $this->menuEditorial().
						  $this->menuEntrevistas().
						  $this->menuHistorias().
						  $this->menuReportajes().
						  $this->menuMitos().
						  $this->menuBiblioteca().
						  $this->menuVideos().
						  $this->menuGalerias().
						  $this->menuForo().
						  $this->menuComentarios().
						  $this->menuCalendario().
						  $this->menuReportes();
		break;
		case '3': $echo = '<span class="txtCont2">No puedes navegar</span>'; 
		break;
		case '10': $echo = $this->menuContactos();
		break;
		case '6': $echo = $this->menuNoticias().
						  $this->menuComentarios().
						  $this->menuUsuario();
		break;
	}//switch
	return $echo;
}//main

private function menuReportes(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Reportes</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=noticias&amp;_f=seeLecturas">Lectura de noticias</a></td>
            </tr>
			<tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=editorial&amp;_f=seeLecturas">Lectura de editoriales</a></td>
            </tr>
			<tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=entrevistas&amp;_f=seeLecturas">Lectura de entrevistas</a></td>
            </tr>
        </table>';
}//menuNoticias

private function menuUsuario(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
          <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Usuario</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=usuarios&amp;_f=addModUser&amp;id=7">Modificar Usuario</a></td>
            </tr>
        </table>';
}//menuUsuarios

private function menuUsuarios(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
          <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Usuarios</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=usuarios&amp;_f=addModUser">Alta de Usuario</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=usuarios&amp;_f=seeDelete">Ver/Eliminar Usuarios</a></td>
            </tr>
        </table>';
}//menuUsuarios

private function menuNoticias(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Noticias y Art&iacute;culos</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=noticias&amp;_f=addMod">Alta de Noticia</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=noticias&amp;_f=seeDelete">Ver/Eliminar Noticias</a></td>
            </tr>
        </table>';
}//menuNoticias

private function menuForo(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Foros</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=foro&amp;_f=addMod">Alta de Foro</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=foro&amp;_f=seeDelete">Ver/Eliminar Foros</a></td>
            </tr>
        </table>';
}//menuNoticias

private function menuMitos(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Mitos</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=mitos&amp;_f=addMod">Alta de Mito</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=mitos&amp;_f=seeDelete">Ver/Eliminar Mito</a></td>
            </tr>
        </table>';
}//menuNoticias

private function menuVideos(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Videos</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=videos&amp;_f=addMod">Alta de Video</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=videos&amp;_f=seeDelete">Ver/Eliminar Videos</a></td>
            </tr>
        </table>';
}//menuVideos

private function menuGalerias(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Galer&iacute;as</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=galerias&amp;_f=addMod">Alta de Galer&iacute;a</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=galerias&amp;_f=seeDelete">Ver/Eliminar Galer&iacute;a</a></td>
            </tr>
        </table>';
}//menuGalerias

private function menuHistorias(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Historias</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=historias&amp;_f=addMod">Alta de Historia</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=historias&amp;_f=seeDelete">Ver/Eliminar Historias</a></td>
            </tr>
        </table>';
}//menuNoticias

private function menuReportajes(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Reportajes</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=reportajes&amp;_f=addMod">Alta de Reportaje</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=reportajes&amp;_f=seeDelete">Ver/Eliminar Reportaje</a></td>
            </tr>
        </table>';
}//menuNoticias

private function menuEncuestas(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Encuestas</td>
            </tr>
			<tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=encuestas&amp;_f=addMod">Alta de Encuesta</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=encuestas&amp;_f=seeDelete">Ver/Eliminar Encuestas</a></td>
            </tr>
        </table>';
}//menuNoticias

private function menuComentarios(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Comentarios</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=comentarios&amp;_f=seeDelete">Ver/Eliminar Comentarios</a></td>
            </tr>
        </table>';
}//menuNoticias

private function menuEditorial(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Editorial</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=editorial&amp;_f=addMod">Alta de Editorial</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=editorial&amp;_f=seeDelete">Ver/Eliminar Editoriales</a></td>
            </tr>
        </table>';
}//menuEditorial

private function menuArticulos(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Art&iacute;culos y Entrevistas</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=articulos&amp;_f=addMod">Alta de Art&iacute;culo o Entrevista</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=articulos&amp;_f=seeDelete">Ver/Eliminar Art&iacute;culos y Entrevistas</a></td>
            </tr>
        </table>';
}//menuArticulos

private function menuEntrevistas(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Entrevistas</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=entrevistas&amp;_f=addMod">Agregar Entrevista</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=entrevistas&amp;_f=seeDelete">Ver/Eliminar Entrevistas</a></td>
            </tr>
        </table>';
}//menuEntrevistas

private function menuBannersNoticias(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Banners de Portada</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=bann_inicio&amp;_f=addMod">Alta de Banner</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=bann_inicio&amp;_f=seeDelete">Ver/Eliminar Banner</a></td>
            </tr>
        </table>';
}//menuBannersNoticias

private function menuBanners(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Banners Auspiciantes</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=banners&amp;_f=addMod">Alta de Banner</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=banners&amp;_f=seeDelete">Ver/Eliminar Banner</a></td>
            </tr>
        </table>';
}//menuBannersNoticias

private function menuCalendario(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Calendario</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=calendario&amp;_f=addMod">Alta de Evento</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=calendario&amp;_f=seeDelete">Ver/Eliminar Evento</a></td>
            </tr>
        </table>';
}//menuBannersNoticias

private function menuProveedores(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Directorio de Proveedores</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=proveedores&amp;_f=addModGiro">Alta/Mod de Giros</a></td>
            </tr>
			<tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=proveedores&amp;_f=addMod">Alta de Proveedor</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=proveedores&amp;_f=seeDelete">Ver/Eliminar Proveedores</a></td>
            </tr>
        </table>';
}//menuClasificados

private function menuContactos(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Directorio de Miner&iacute;a</td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=contactos&amp;_f=addModContacto">Alta/Mod de Contacto</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=contactos&amp;_f=seeDelete">Ver/Eliminar Contacto</a></td>
            </tr>
        </table>';
}//menuClasificados

/*------------------------AGREGADO PARA LA BIBLIOTECA--------------------------------------*/
private function menuBiblioteca(){
	return '<table width="100%" border="0" align="center" cellpadding="1" cellspacing="0" class="tbDivMenu">
            <tr>
              <td width="16"><img src="imgs/icon_arrow.png" width="10" height="10" alt="" /></td>
              <td class="txtTitEncab">Biblioteca Virtual</td>
            </tr>
			<tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=biblioteca&amp;_f=addModCat">Alta/Mod de Categorias</a></td>
            </tr>
			<tr>            			
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=biblioteca&amp;_f=addModSC">Alta/Mod de Subcategorias</a></td>
            </tr>
			<tr>            			
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=biblioteca&amp;_f=addModBen">Alta/Mod de Benefactores</a></td>
            </tr>
			<tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=biblioteca&amp;_f=addMod">Alta de Documentos</a></td>
            </tr>
            <tr>
              <td width="16" valign="top"><img src="imgs/arrow.jpg" width="10" height="10" alt="" /></td>
              <td valign="top" class="linkMenu"><a href="?F=biblioteca&amp;_f=seeDelete">Ver/Eliminar Documentos</a></td>
            </tr>
        </table>';
}//menuBiblioteca
/*------------------------------------------------------------------------------------------*/


}//_MENU_
?>