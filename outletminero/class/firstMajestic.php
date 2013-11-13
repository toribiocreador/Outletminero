<?php
echo (preg_match('/firstMajestic.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class firstMajestic extends _GLOBAL_{

				/* <p>
                <!-- FACEBOOK -->
                <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F'. $_SERVER['REQUEST_URI'] .'&amp;layout=button_count&amp;show_faces=false&amp;width=150&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>
                &nbsp;
                <!-- TWITTER -->
                <a href="http://twitter.com/share" class="twitter-share-button" data-url="http://www.skuiken.com/" data-count="horizontal" data-lang="es">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                </p> */
	public $LIMIT2 = 5;		
	public $limitEnc = 2;
				
	public $LIMIT = 7;
	public $PAGINAS = 10;
	
	public $limitNot = 1;
	public $limitNot2 = 2;
	public $limitNot3 = 2;
	public $limitEdi = 1;
	public $limitEnt = 1;

public function main(){
	$db = $this->_db();
	
	return 
		$this->postNoticias() .
			//$this->postNoticias2().
		  // $this->postNoticias3().
		  $this->postEncuestas().
			$this->postNoticias4();
}//main

public function ver(){
	if (!isset($_GET["id"]) || $_GET["id"] == ''){ echo '<h2>No se encuentra el identificador</h2>'; exit(); }//if
		
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM noticias WHERE id='{$_GET['id']}'");
	$content = '';
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	if (isset($_SESSION["nombre"]) && isset($_SESSION["autorizado"])) {
		$nombre = '<input id="nombre" name="nombre" type="text" size="105" maxlength="200" readonly="true" class="frmInputM" value="'. $_SESSION["nombre"] .'"/>';
		$idusuario = $_SESSION["idusuario"];
	} else {
		$nombre ='<input id="nombre" name="nombre" type="text" size="105" maxlength="200" class="frmInputM" />';
		$idusuario = '0';
	}//if
	
	$imagen="";
	$img = (isset($row["imagen"]) && $row["imagen"] != '') ? '<div style="border:#000000 1px solid; background:#FFFFFF; float:left; font-size:10px; color:#333333; margin-right: 20px; width:auto;"><img src="'. $row["imagen"] .'" alt="" border="0" /><br><span class="txtPP" style="padding:5px;">Foto: '. $row["pf"] .'</span></div>':'<iframe width="640" height="390" src="'. $row["embed"] .'" frameborder="0" allowfullscreen></iframe>';
	//$imagen = (isset($row["imagen"]) && $row["imagen"] != '') ? '<table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs"><tr><td><img src="'. $row["imagen"] .'" alt="" border="0" style="float:left; margin-right: 10px;" /><span class="txtPP">Foto: '. $row["pf"] .'</span></td></tr></table>' : '';
	//$video = (isset($row["video"]) && $row["video"] != '') ? $row["embed"] : '';
	$contenido = (isset($row["contenido"]) && $row["contenido"] != '') ? '<br /><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">'.$img. $row["contenido"] .'</td></tr></table>' : '';
		
	return '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
          <tr>
            <td class="txtTit">'. $row["titulo"] .'</td>
          </tr>
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont"><span class="txtBold"> '. $this->txtFechaPub($row["fechapub"]) .'</span></td>
            </tr>
          </table>
          '. $imagen . $contenido . $video .'
		 <table width="95%" border="0" height="27" align="center" cellspacing="10" cellpadding="0" hspace="25">
            <tr>
				<td align="center" class="txtBold">Disfrutaste la publicaci&oacute;n Comp&aacute;rtela!</td>
				<td>
					<a href="http://twitter.com/share" class="twitter-share-button" data-via="outletminero" data-url="http://www.outletminero.org/?F=firstMajestic&amp;_f=ver&amp;id='. $row["id"] .'" data-text="'. $row["titulo"] .'" data-count="horizontal" data-lang="es">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>	
				</td>
				<td>
					<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=181783375212237&amp;xfbml=1"></script><fb:like href="http://www.outletminero.org/?F=firstMajestic&amp;_f=ver&amp;id='. $row["id"] .'" send="false" layout="button_count" width="10" show_faces="false" font=""></fb:like>
				</td>
		  		<td>
					<a name="fb_share" type="button_count" share_url="http://www.outletminero.org/?F=firstMajestic&amp;_f=ver&amp;id='. $row["id"] .'">Compartir</a> 
					<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
				</td>
			</tr>
          </table>
         <form id="frmComentario1" name="frmComentario" method="post" action="?F=comentarios&amp;_f=add">
		  	<input type="hidden" name="id_usuario" value="0" />
			<input type="hidden" name="seccion" value="2" />
			<input type="hidden" name="socio" value="1" />
			<input type="hidden" name="link" value="'. $_SERVER["REQUEST_URI"] .'" />
			<input type="hidden" name="id_publicacion" value="'. $row["id"] .'" />
            <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
              <tr>
                <td width="80%" valign="top" class="txtBold">Nombre: </td>
                <td valign="top" class="txtBold1">'.$nombre.'</td>
              </tr>
              <tr>
                <td valign="top" class="txtBold">Comentarios: </td>
                <td valign="top">
                  <textarea name="comentarios" id="comentarios" cols="110" rows="10" class="frmInputM"></textarea></td>
              </tr>
              <tr>
                <td valign="top" class="txtBold">&nbsp;</td>
                <td valign="top"><input name="button3" type="submit" class="frmButtonM" id="button3" value="Publicar comentario" /><span class="linkCont"> <a href="?F=inicio&amp;_f=verNormas">Normas de uso</a></span></td>
              </tr>
            </table>
          </form>
		  '. $this->showComments('2', $row["id"]);
		 
}//ver

public function verMas(){
	$db = $this->_db();
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT}" : "LIMIT {$this->LIMIT}";
	
	$result = mysql_query("SELECT * FROM noticias WHERE socio='1' ORDER BY id DESC ". $qLimit);
	$content = '<p class="txtTit">Noticias y Art&iacute;culos</p>';
	return $content . $this->showPublicacion($result, 'noticias', '5') . $this->paginacion($_GET["ver"], $this->PAGINAS, $this->LIMIT, 'noticias', 'noticias', 'main', 5);
}//main

private function postNoticias(){
	$result = mysql_query("SELECT * FROM noticias WHERE socio='1' ORDER BY id DESC LIMIT ". $this->limitNot);
	$contenido = '';
	$imagen="";
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	$_GET["ver"] = (!isset($_GET["ver"])) ? '0' : $_GET["ver"];
	$_GET["ver2"] = (!isset($_GET["ver2"])) ? '0' : $_GET["ver2"];
	$qLimit = (isset($_GET["ver"]) && isset($_GET["ver"])!='') ? "LIMIT {$_GET['ver']}, {$this->LIMIT2}" : "LIMIT {$this->LIMIT2}";
	
	$img = (isset($row["imagen"]) && $row["imagen"] != '') ? '<div style="border:#000000 1px solid; background:#FFFFFF; float:left; font-size:10px; color:#333333; margin-right: 20px; width:auto;"><img src="'. $row["imagen"] .'" alt="" border="0" /><br><span class="txtPP" style="padding:5px;">Foto: '. $row["pf"] .'</span></div>':'<iframe width="640" height="390" src="'. $row["embed"] .'" frameborder="0" allowfullscreen></iframe>';
	//$imagen = (isset($row["imagen"]) && $row["imagen"] != '') ? '<table width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs"><tr><td><img src="'. $row["imagen"] .'" alt="" border="0" style="float:left; margin-right: 10px;" /><span class="txtPP">Foto: '. $row["pf"] .'</span></td></tr></table>' : '';
	//$video = (isset($row["video"]) && $row["video"] != '') ? $row["embed"] : '';
	$contenido = (isset($row["contenido"]) && $row["contenido"] != '') ? '<br /><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">'.$img. $row["contenido"] .'</td></tr></table>' : '';
		
	if (isset($_SESSION["nombre"]) && isset($_SESSION["autorizado"])) {
		$nombre = '<input id="nombre" name="nombre" type="text" size="105" maxlength="200" readonly="true" class="frmInputM" value="'. $_SESSION["nombre"] .'"/>';
		$idusuario = $_SESSION["idusuario"];
	} else {
		$nombre ='<input id="nombre" name="nombre" type="text" size="105" maxlength="200" class="frmInputM" />';
		$idusuario = '0';
	}//if
	
	$table = mysql_query("SELECT * FROM comentarios WHERE seccion='2' AND id_publicacion=". $row["id"]." AND activo='1' AND tipo!='2' ORDER BY id DESC ". $qLimit);
	$table2 = mysql_query("SELECT * FROM comentarios WHERE seccion='2' AND id_publicacion=". $row["id"]." AND activo='1' AND tipo='2' ORDER BY id DESC ". $qLimit);
	
	$tableO = mysql_query("SELECT * FROM comentarios WHERE seccion='2' AND id_publicacion=". $row["id"]." AND activo='1' AND tipo!='2' ORDER BY id DESC");
	$tableO2 = mysql_query("SELECT * FROM comentarios WHERE seccion='2' AND id_publicacion=". $row["id"]." AND activo='1' AND tipo='2' ORDER BY id DESC");
	
	return '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
          <tr>
            <td class="txtTit">'. $row["titulo"] .'</td>
          </tr>
        </table>
          <table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="txtCont"><span class="txtBold"> '. $this->txtFechaPub($row["fechapub"]) .'</span></td>
            </tr>
          </table>
          '. $imagen . $contenido . $video .'
		 <table width="95%" border="0" height="27" align="center" cellspacing="10" cellpadding="0" hspace="25">
            <tr>
				<td align="center" class="txtBold">Disfrutaste la publicaci&oacute;n Comp&aacute;rtela!</td>
				<td>
					<a href="http://twitter.com/share" class="twitter-share-button" data-via="outletminero" data-url="http://www.outletminero.org/?F=firstMajestic&amp;_f=ver&amp;id='. $row["id"] .'" data-text="'. $row["titulo"] .'" data-count="horizontal" data-lang="es">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>	
				</td>
				<td>
					<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=181783375212237&amp;xfbml=1"></script><fb:like href="http://www.outletminero.org/?F=firstMajestic&amp;_f=ver&amp;id='. $row["id"] .'" send="false" layout="button_count" width="10" show_faces="false" font=""></fb:like>
				</td>
		  		<td>
					<a name="fb_share" type="button_count" share_url="http://www.outletminero.org/?F=firstMajestic&amp;_f=ver&amp;id='. $row["id"] .'">Compartir</a> 
					<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
				</td>
			</tr>
          </table>
		 <p class="txtTit">Te invitamos a dejar tu comentario de esta nota</p>
		 
		 <form id="frmComentario1" name="frmComentario" method="post" action="?F=comentarios&amp;_f=add">
		  	<input type="hidden" name="id_usuario" value="0" />
			<input type="hidden" name="seccion" value="2" />
			<input type="hidden" name="socio" value="1" />
			<input type="hidden" name="link" value="'. $_SERVER["REQUEST_URI"] .'" />
			<input type="hidden" name="id_publicacion" value="'. $row["id"] .'" />
            <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
              <tr>
                <td width="80%" valign="top" class="txtBold">Nombre: </td>
                <td valign="top" class="txtBold1">'.$nombre.'</td>
              </tr>
              <tr>
                <td valign="top" class="txtBold">Comentarios: </td>
                <td valign="top">
                  <textarea name="comentarios" id="comentarios" cols="110" rows="10" class="frmInputM"></textarea></td>
              </tr>
              <tr>
                <td valign="top" class="txtBold">&nbsp;</td>
                <td valign="top"><input name="button3" type="submit" class="frmButtonM" id="button3" value="Publicar comentario" /><span class="linkCont"> <a href="?F=inicio&amp;_f=verNormas">Normas de uso</a></span></td>
              </tr>
            </table>
          </form>
		 <p>&nbsp;</p>
		 '. $this->showCommentsC('2', $table, $row["id"]).$this->paginacionC($_GET["ver"], $this->PAGINAS, $this->LIMIT2, $tableO, $row["id"], 'firstMajestic', 'main','<span class="txtCont">M&aacute;s comentarios: </span>').'
		 
		
		  
		  <img src="gallery/banners/banner _first.jpg" alt="" width="660" border="0" /><p>&nbsp;</p>
		  Este espacio es para ti, servir&aacute; como un foro de comunicaci&oacute;n interna en donde puedes compartir tus comentarios, experiencia, consejos o bien las &aacute;reas donde podamos mejorar.
		 <p class="txtTit">Deja tu comentario</p>
		  <form id="frmComentario2" name="frmComentario" method="post" action="?F=comentarios&amp;_f=add">
		  	<input type="hidden" name="id_usuario" value="0" />
			<input type="hidden" name="seccion" value="2" />
			<input type="hidden" name="socio" value="2" />
			<input type="hidden" name="link" value="'. $_SERVER["REQUEST_URI"] .'" />
			<input type="hidden" name="id_publicacion" value="'. $row["id"] .'" />
            <table width="90%" border="0" align="center" cellpadding="5" cellspacing="0">
              <tr>
                <td valign="top" class="txtBold">Nombre:</td>
                <td valign="top" class="txtBold1">'.$nombre.'</td>
              </tr>
              <tr>
                <td valign="top" class="txtBold">Comentarios:</td>
                <td valign="top">
                  <textarea name="comentarios2" id="comentarios2" cols="110" rows="10" class="frmInputM"></textarea></td>
              </tr>
              <tr>
                <td valign="top" class="txtBold">&nbsp;</td>
                <td valign="top"><input name="button3" type="submit" class="frmButtonM" id="button3" value="Publicar comentario" /><span class="linkCont"> <a href="?F=inicio&amp;_f=verNormas">Normas de uso</a></span></td>
              </tr>
            </table>
          </form>
		  <p>&nbsp;</p>
		 '. $this->showComments2C('2', $table2, $row["id"]).$this->paginacionC($_GET["ver"], $this->PAGINAS, $this->LIMIT2, $tableO2, $row["id"], 'firstMajestic', 'main','<span class="txtCont">M&aacute;s comentarios: </span>').'
		 
		
		 
		 ';
}//postNoticias

private function postNoticias2(){
	$result = mysql_query("SELECT * FROM noticias WHERE socio='1' ORDER BY id DESC LIMIT ".$this->limitNot.",". $this->limitNot2);
	$tipoComm=5;
 
 	$nfilas =  2;
	$col = 1;
	$filas = ceil($nfilas/$col);
	
	$db = $this->_db();
	$result2 = mysql_query("SELECT * FROM encuestas ORDER BY id DESC");
	$row2 = mysql_fetch_array($result2, MYSQL_ASSOC);
	
	$content.='
	<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="50%" align="center">
			<table width="320" height="242" valign="center" align="center" class="divContenedor3" border="0" cellspacing="3" cellpadding="3">
			  <tr>
				<td align="center">
					'.$row2["contenido"].'
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
		</td>
		<td width="50%">';
	$content.='<table width="100%" border="0" cellspacing="3" cellpadding="3">';
	for($c=0;$c<$filas;$c++){
		$content.='<tr>';
			
			if($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$content.='<td width="50%"><div class="divContenedor2" onClick="window.location.href=\'?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'\'">
				<table width="100%" border="0" cellspacing="2" cellpadding="1">
				  <tr>
					<td width="11%" class="linkTitNot3"><div align="center"><a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'"><img src="'. $row["imagen"] .'" border="0" width="110" height="105" /></a></div></td>
					<td width="89%" valign="top" align="left" class="linkTitNot3"><a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'">'. $row["titulo"] .'</a><br><br><span class="linkCont2"><a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'">Ver publicaci&oacute;n completa</a></span></td>
				  </tr>
				</table>
				</div></td>';
		}
		$content.='</tr>';
	}
	$content.='</table></td></tr>
	</table>';
	return $content;
}//postNoticias

private function postNoticias3(){
	$limit = $this->limitNot+$this->limitNot2;
$result = mysql_query("SELECT * FROM noticias WHERE socio='1' ORDER BY id DESC LIMIT ".$limit .",". $this->limitNot3);
//$sql="SELECT * FROM noticias ORDER BY id DESC LIMIT 1,". $this->limitNot; 
//$consulta = mysql_query($sql,MYSQL_ASSOC);
 $tipoComm=5;
 
$nfilas =  $this->limitNot3;
$col = 2;
$filas = ceil($nfilas/$col);
$content.='<table width="100%" border="0" cellspacing="3" cellpadding="3">';
for($c=0;$c<$filas;$c++){
	$content.='<tr>';
	for($s=0;$s<$col;$s++){
		//$resultado = mysql_fetch_array($consulta);
		
		if($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$content.='<td width="50%"><div class="divContenedor2" onClick="window.location.href=\'?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'\'">
			<table width="100%" border="0" cellspacing="2" cellpadding="1">
			  <tr>
				<td width="11%" class="linkTitNot3"><div align="center"><a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'"><img src="'. $row["imagen"] .'" border="0" width="110" height="105" /></a></div></td>
				<td width="89%" valign="top" align="left" class="linkTitNot3"><a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'">'. $row["titulo"] .'</a><br><br><span class="linkCont2"><a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'">Ver publicaci&oacute;n completa</a></span></td>
			  </tr>
			</table>
			</div></td>';
		}
	}
	$content.='</tr>';
}
$content.='</table>';
return $content;
}//postNoticias

public function verNormas(){	
	$imagen = '<table align="left" width="100" border="0" cellpadding="0" cellspacing="0" class="tbImgs"><tr><td><img src="images/normas.jpg" alt="" border="0"  width="350" /></a></td></tr></table>';
		  
		  $contenido = '<br /><table align="center" width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td class="txtCont">
		  	<p class="estilo1">Te ofrecemos un canal de interacci&oacute;n que abre la posibilidad de que expreses tu punto de vista sobre la informaci&oacute;n que se publica diariamente, es importante que lo aproveches de manera responsable analizando, cuestionando y criticando de manera seria.</p>
<p class="estilo1">Para que estos espacios cumplan su objetivos democr&aacute;ticos es necesario que evites incluir contenido vulgar, difamatorio o que no tenga que ver con el tema en cuesti&oacute;n.</p>
<p class="estilo2"><strong>&iquest;C&oacute;mo puedes participar ?</strong></p>
<p class="estilo1">A fin de facilitar al m&aacute;ximo esta participaci&oacute;n se ruega que los textos sean lo m&aacute;s breves posible. Si bien no es necesario registrarse para opinar recomendamos no usar seud&oacute;nimos e identificarse al momento de hacer su comentario .</p>
<p class="estilo2"><strong>Pol&iacute;ticas de los espacios de opini&oacute;n</strong></p>
<p class="estilo1">Outletminero no se responsabiliza por los comentarios o cr&iacute;ticas que aparezcan en los espacios de opini&oacute;n y se reserva el derecho de eliminar cualquier contenido que atente contra la integridad de los dem&aacute;s. Si los textos no cumplen con este requisito, el Moderador proceder&aacute; a eliminarlos.<span style="white-space: pre;"> </span></p>
<p>&nbsp;</p>		  
		  </td></tr></table>';
		  
		  return '
		  <table width="90%" align="center" border="0" cellpadding="0" cellspacing="0">
		  	<tr><td>
			  <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbTitNot">
				  <tr>
					<td class="txtTit">Normas para los espacios de opini&oacute;n de Outletminero</td>
				  </tr>
				</table>
			</td></tr>
			<tr><td>
				'.$imagen.$contenido.'
			</td></tr>
			</table>
          ';
}//ver

private function postNoticias4(){
	$result2 = mysql_query("SELECT * FROM noticias WHERE socio='1' ORDER BY id DESC");
	$total = mysql_num_rows($result2);
	$db = $this->_db();
	$qLimit = "1, {$total}";
	
	$result = mysql_query("SELECT * FROM noticias WHERE socio='1' ORDER BY id DESC LIMIT ". $qLimit);
	$tipoComm=5;
 
	$content.='<p class="txtTit">Noticias anteriores</p><table width="100%" border="0" cellspacing="3" cellpadding="3">';
			while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
				$content.='<tr><td width="89%" valign="top" align="left" class="linkTitNot3"><a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'">'. $row["titulo"] .'</a><br></td>
				  </tr>';
			}
		$content.='</table><br><br>';
	return $content;
}//postNoticias

private function postEncuestas(){
	$result = mysql_query("SELECT * FROM encuestas WHERE activo=1 ORDER BY id DESC LIMIT ".$this->limitEnc);
 	$content='';
 	$nfilas =  2;
	$col = 2;
	$filas = ceil($nfilas/$col);
	$content.='<p class="txtTit">Encuestas</p><table width="100%" border="0" cellspacing="3" cellpadding="3">';
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