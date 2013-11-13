<?php  
	function clrAll($str) {
		$str=str_replace("&","&amp;",$str);
		$str=str_replace("\"","&quot;",$str);
		$str=str_replace("'","&apos;",$str);
		$str=str_replace(">","&gt;",$str);
		$str=str_replace("<","&lt;",$str);
		return $str;
	}

	header("Content-type: text/xml");
 	echo "<?xml version=\"1.0\""." encoding=\"utf8\"?>";
	echo '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">';
	echo '<channel> ';
	echo '<atom:link href="http://outletminero.org/class/RSSFeed.php" rel="self" type="application/rss+xml" />';
    echo '<title>Noticias de Outletminero</title>';  
    echo '<link>http://www.outletminero.org</link> '; 
    echo '<description>Las mejores noticias de Internet</description>'; 
	echo "<language>es-es</language>";
	echo "<copyright>ileonel.com</copyright>\n"; 

   	$user = 'outminer_user';
	$pswd = 'EuQhSRw{zF@J';
	$localhost = 'localhost';
	$bd = 'outminer_db';
	$con = mysql_connect($localhost,$user,$pswd) or die('Could not connect: ' . mysql_error());
	$db = mysql_select_db($bd, $con);
  
   	$result = mysql_query("SELECT * FROM noticias WHERE socio='0' AND activo=1 ORDER BY id DESC LIMIT 20");
  
    
	$row = mysql_fetch_array($result, MYSQL_ASSOC)or die ('Error al ejecutar la consulta');  
  
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){	
		$fecha = DateTime::createFromFormat('Y-m-d H:i:s', $row["fechapub"]) ;
        echo '<item> 
                  <title><p>'.$row["titulo"].'</p></title> 
                  <link>http://outletminero.org?F=noticias&amp;_f=ver&amp;id='. $row["id"] .'</link> 
                  <description>'.$fecha .' '.$row["contenido"].'</description>
   				  
				  <guid isPermaLink="true">http://outletminero.org?F=noticias&amp;_f=ver&amp;id='. $row["id"] .'</guid>
             </item>';  
    }  
   
	echo '</channel>  ';
	echo '</rss>';
?> 
