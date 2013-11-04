<?php
echo (preg_match('/mitos.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class mitos extends _GLOBAL_{

public function main(){
	$db = $this->_db();
	$result = mysql_query("SELECT * FROM mitos WHERE activo=1 LIMIT 3");
	$content .=  '		
		<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="js/jquery-mousewheel/jquery.mousewheel.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="css/slidedeck.skin.css" media="screen,handheld" />
        <!-- Styles for the skin that only load for Internet Explorer -->
        <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="css/slidedeck.skin.ie.css" media="screen,handheld" />
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="css/slidedeck-home-page.css" media="screen,handheld" />
        <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="css/slidedeck-home-page.ie.css" media="screen,handheld" />
        <![endif]-->
		<!-- Styles custom to the SlideDeck.com home page content and additional navigation elements -->
        <link rel="stylesheet" type="text/css" href="css/slidedeck-home-page.css" media="screen,handheld" />
        <!--[if IE]>
        <link rel="stylesheet" type="text/css" href="css/slidedeck-home-page.ie.css" media="screen,handheld" />
        <![endif]-->

        <script type="text/javascript" src="js/slidedeck.jquery.js"></script>
		';
		
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$content .=  '<div id="slidedeck_frame" class="skin-slidedeck">
            <dl class="slidedeck">
                <dt>Mito sobre minería</dt>
                	<dd><div class="copy">
							<h4 class="title">Mito</h4>
							<span class="divider">&nbsp;</span>
							<p>'.$row["mito"].'</p>
                    	</div>
					</dd>
             	 <dt>Realidad sobre minería</dt>
               		 <dd><div class="copy">
							<h4 class="title">Realidad</h4>
							<span class="divider">&nbsp;</span>
							<p>'.$row["realidad"].'</p>
                    	</div>
					 </dd>
                
            </dl>
        	</div><br />';
		}
		
		$content .=  '<script type="text/javascript">
            
            /** Initiate the SlideDeck */
            $(\'.skin-slidedeck dl.slidedeck\').slidedeck({
                scroll: \'stop\'
            }).
            
            /**
             * Take advantage of the loaded() method of the SlideDeck library to move the vertical navigation
             * for from the slide area to the spine area of that slide
             */
            loaded(function(){
                $(\'.skin-slidedeck .slide .verticalSlideNav\').each(function(){
                    $(this).parents(\'dd.slide\').prevAll(\'dt.spine:first\').append(this);
                });
            }).
            
            /** Enable vertical slides */
            vertical({
                before: function(deck){
                    if(deck.current == 0){
                        $(deck.navChildren.context).find(\'a.vertical-prev-next.previous\').hide();
                    } else {
                        $(deck.navChildren.context).find(\'a.vertical-prev-next.previous\')[0].style.display = "";
                    }
                    if(deck.current == (deck.slides.length - 1)){
                        $(deck.navChildren.context).find(\'a.vertical-prev-next.next\').hide();
                    } else {
                        $(deck.navChildren.context).find(\'a.vertical-prev-next.next\')[0].style.display = "";
                    }
                },
                complete: function(deck){
                    if(deck.current == 0){
                        $(deck.navChildren.context).find(\'a.vertical-prev-next.previous\').hide();
                    } else {
                        $(deck.navChildren.context).find(\'a.vertical-prev-next.previous\')[0].style.display = "";
                    }
                    if(deck.current == (deck.slides.length - 1)){
                        $(deck.navChildren.context).find(\'a.vertical-prev-next.next\').hide();
                    } else {
                        $(deck.navChildren.context).find(\'a.vertical-prev-next.next\')[0].style.display = "";
                    }
                }
            });
            
            $(\'.skin-slidedeck a.vertical-prev-next\').bind(\'click\', function(event){
                event.preventDefault();
                switch(this.href.split(\'#\')[1]){
                    case "previous":
                        $(\'.skin-slidedeck .slidedeck\').slidedeck().vertical().prev();
                    break;
                    case "next":
                        $(\'.skin-slidedeck .slidedeck\').slidedeck().vertical().next();
                    break;
                }
            });
            
            /** Hide the previous vertical slide button */
            $(\'.skin-slidedeck dl.slidedeck a.vertical-prev-next.previous\').hide();
             
            $(document).ready(function(){
            
                /**
                 * Add goTo() click events to the image grid in slide 1 of the vertical slides on 
                 * slide 2 of the horizontal slides in the home page SlideDeck
                 */
                $(\'.skin-slidedeck .slidedeck dd.slide_2 .use-cases img\').each(function(index){
                    $(this).click(function(){
                        $(\'.skin-slidedeck .slidedeck\').slidedeck().vertical().goTo(index+2);
                    });
                });
            
            });
            
        </script>';
		return $content;
}//main

}//class
?>