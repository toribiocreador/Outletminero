<?php
echo (preg_match('/insertarDB.php/',$_SERVER['SCRIPT_NAME'])) ? header('Location: ../') : '';
class insertarDB extends _GLOBAL_{

public function main(){
	
}//main

public function insertar1(){
	for($x=1;$x<=12;$x++){
		$db = $this->_db();
		echo "INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('desarrollo comunitario ".$x."',',gallery/estandarizadas/desarrolloComunitario/desarrollo_comunitario_".$x.".png','2')";
		mysql_query("INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('desarrollo comunitario ".$x."','gallery/estandarizadas/desarrolloComunitario/desarrollo_comunitario_".$x.".png','2')")or die(mysql_error());
	}
}

public function insertar2(){
	for($x=1;$x<=31;$x++){
		$db = $this->_db();
		echo "INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('empresa ".$x."',',gallery/estandarizadas/empresas/empresa_".$x.".png','2')";
		mysql_query("INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('empresa ".$x."','gallery/estandarizadas/empresas/empresa_".$x.".png','2')")or die(mysql_error());
	}
}

public function insertar3(){
	for($x=1;$x<=4;$x++){
		$db = $this->_db();
		echo "INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('inversion ".$x."','gallery/estandarizadas/inversiones/inversion_".$x.".png','3')";
		mysql_query("INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('inversion ".$x."','gallery/estandarizadas/inversiones/inversion_".$x.".png','3')")or die(mysql_error());
	}
}

public function insertar4(){
	for($x=1;$x<=165;$x++){
		$db = $this->_db();
		echo "INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('mineria ".$x."','gallery/estandarizadas/mineras/mineria_".$x.".png','4')";
		mysql_query("INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('mineria ".$x."','gallery/estandarizadas/mineras/mineria_".$x.".png','4')")or die(mysql_error());
	}
}

public function insertar5(){
	for($x=1;$x<=81;$x++){
		$db = $this->_db();
		echo "INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('otro ".$x."','gallery/estandarizadas/otros/otro_".$x.".png','5')";
		mysql_query("INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('otro ".$x."','gallery/estandarizadas/otros/otro_".$x.".png','5')")or die(mysql_error());
	}
}

public function insertar6(){
	for($x=1;$x<=15;$x++){
		$db = $this->_db();
		echo "INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('persona ".$x."','gallery/estandarizadas/personas/persona_".$x.".png','6')";
		mysql_query("INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('persona ".$x."','gallery/estandarizadas/personas/persona_".$x.".png','6')")or die(mysql_error());
	}
}

public function insertar7(){
	for($x=1;$x<=2;$x++){
		$db = $this->_db();
		echo "INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('protesta ".$x."','gallery/estandarizadas/protestas/protesta_".$x.".png','7')";
		mysql_query("INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('protesta ".$x."','gallery/estandarizadas/protestas/protesta_".$x.".png','7')")or die(mysql_error());
	}
}

public function insertar8(){
	for($x=1;$x<=3;$x++){
		$db = $this->_db();
		echo "INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('seguridad ".$x."','gallery/estandarizadas/seguridad/seguridad_".$x.".png','8')";
		mysql_query("INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('seguridad ".$x."','gallery/estandarizadas/seguridad/seguridad_".$x.".png','8')")or die(mysql_error());
	}
}

public function insertar9(){
	for($x=1;$x<=78;$x++){
		$db = $this->_db();
		echo "INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('sustentable ".$x."','gallery/estandarizadas/sustentables/sustentable_".$x.".png','9')";
		mysql_query("INSERT INTO galeriaFotografica (titulo, imagen, clasificacion) VALUES ('sustentable ".$x."','gallery/estandarizadas/sustentables/sustentable_".$x.".png','9')")or die(mysql_error());
	}
}

}//class
?>