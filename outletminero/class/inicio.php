<?php
echo (preg_match('/inicio.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class inicio extends _GLOBAL_{
				/* <p>
                <!-- FACEBOOK -->
                <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F'. $_SERVER['REQUEST_URI'] .'&amp;layout=button_count&amp;show_faces=false&amp;width=150&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>
                &nbsp;
                <!-- TWITTER -->
                <a href="http://twitter.com/share" class="twitter-share-button" data-url="http://www.skuiken.com/" data-count="horizontal" data-lang="es">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
                </p> */
	
	public $limitNot = 2;
	public $limitNot2 = 2;
	public $limitNot3 = 8;
	public $limitEdi = 1;
	public $limitEnt = 1;

public function main(){
	$db = $this->_db();
	return
		
		//$this->postTwitter() .
		$this->postNoticias() .
		   $this->postNoticias3() .
			$this->postEditorial() .
			$this->postEntrevistas();
}//main

public function postTwitter(){
	$echo = '
	<table width="90%" border="0" cellspacing="0" cellpadding="0">
      <tr><td>
	  		<script src="http://widgets.twimg.com/j/2/widget.js"></script>
                                    <script>
                                    new TWTR.Widget({
                                      version: 2,
                                      type: "search",
                                      search: "#outletminero OR #convencionminera OR #convencionintmineria",
                                      interval: 6000,
                                      title: "Outlet Minero",
                                      subject: "Convenci&oacute;n Internacional de Minera 2011",
                                      width: 660,
                                      height: 375,
                                      theme: {
                                        shell: {
                                          background: "#f1f1f1",
                                          color: "#667074"
                                        },
                                        tweets: {
                                          background: "#ffffff",
                                          color: "#444444",
                                          links: "#76a2b6"
                                        }
                                      },
                                      features: {
                                        scrollbar: false,
                                        loop: true,
                                        live: true,
                                        hashtags: true,
                                        timestamp: true,
                                        avatars: true,
                                        toptweets: true,
                                        behavior: "default"
                                      }
                                    }).render().start();
                                    </script>
	  </td></tr>
	</table>';
	return $echo;
}//twitter

private function postEntrevista(){
	$content.='
	<table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td align="center">
			<script type="text/javascript" charset="utf-8" src="http://static.polldaddy.com/p/5164321.js"></script>
<noscript>
	<a href="http://polldaddy.com/poll/5164321/">En tu opinión ¿Cuál debería de ser el principal compromiso de la minería?</a><span style="font-size:9px;"><a href="http://polldaddy.com/features-surveys/">survey software</a></span>
</noscript>
<script type="text/javascript" charset="utf-8" src="http://static.polldaddy.com/p/5231087.js"></script>
<noscript>
	<a href="http://polldaddy.com/poll/5231087/">¿Esta a favor de la inversión minera?</a>
</noscript>
		</td>
	  </tr>
	</table>';
	return $content;
}//postNoticias

private function postNoticias(){
	$result = mysql_query("SELECT * FROM noticias WHERE socio='0' AND embed NOT LIKE '%http://%' ORDER BY id DESC LIMIT 1,".$this->limitNot);
	$content = '<p class="txtTit">Noticias y Art&iacute;culos</p>';
	return $content . $this->showPublicacion($result, 'noticias', '2');
}//postNoticias

private function postNoticias2(){
	$result = mysql_query("SELECT * FROM noticias WHERE socio='0' ORDER BY id DESC LIMIT ".$this->limitNot.",". $this->limitNot2);
	$tipoComm=2;
 
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
						<td width="100" align="center" alt= "ENCUESTAS" class="linkMenu"><span class="linkCont"><a href="?F=encuestas&amp;_f=main">VER M&Aacute;S ENCUESTAS</a></span></td>
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
				$tok=explode(",",$row["imagen"]);
				$img = (isset($tok[0]) && $tok[0] != '') ? '<a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'"><img src="'. $tok[0] .'" border="0" width="110" height="105" /></a>':'<iframe width="110" height="105" src="'. $row["embed"] .'" frameborder="0" allowfullscreen></iframe>';
				$content.='<td width="50%"><div class="divContenedor2" onClick="window.location.href=\'?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'\'">
				<table width="100%" border="0" cellspacing="2" cellpadding="1">
				  <tr>
					<td width="11%" class="linkTitNot3"><div align="center">'.$img.'</div></td>
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
	$limit = $this->limitNot;
$result = mysql_query("SELECT * FROM noticias WHERE socio='0' AND embed NOT LIKE '%http://%' ORDER BY id DESC LIMIT 3,". $this->limitNot3);
//$sql="SELECT * FROM noticias ORDER BY id DESC LIMIT 1,". $this->limitNot; 
//$consulta = mysql_query($sql,MYSQL_ASSOC);
 $tipoComm=2;
 
$nfilas =  $this->limitNot3;
$col = 2;
$filas = ceil($nfilas/$col);
$content.='<table width="100%" border="0" cellspacing="3" cellpadding="3">';
for($c=0;$c<$filas;$c++){
	$content.='<tr>';
	for($s=0;$s<$col;$s++){
		//$resultado = mysql_fetch_array($consulta);
		
		if($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			$tok=explode(",",$row["imagen"]);
			$img = (isset($tok[0]) && $tok[0] != '') ? '<a href="?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'"><img src="../Scripts/timthumb.php?src='. $tok[0] .'&a=c&w=105&h=105" border="0" /></a>':'<iframe width="110" height="105" src="'. $row["embed"] .'" frameborder="0" allowfullscreen></iframe>';
			$content.='<td width="50%"><div class="divContenedor2" onClick="window.location.href=\'?F='. $this->seccion[$tipoComm] .'&amp;_f=ver&amp;id='. $row["id"] .'\'">
			<table width="100%" border="0" cellspacing="2" cellpadding="1">
			  <tr>
				<td width="11%" class="linkTitNot3"><div align="center">'.$img.'</div></td>
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

private function postEditorial(){
	$result = mysql_query("SELECT * FROM editoriales ORDER BY id DESC LIMIT 0,". $this->limitEdi);
	$content = '<p class="txtTit">Editorial</p>';
	return $content . $this->showPublicacion($result, 'editoriales', '1');
}//postNoticias

private function postEntrevistas(){
	$result = mysql_query("SELECT * FROM entrevistas ORDER BY id DESC LIMIT 0,". $this->limitEnt);
	$content = '<p class="txtTit">Entrevista</p>';
	return $content . $this->showPublicacion($result, 'noticias', '3');
}//postEntrevistas

}//class
?>