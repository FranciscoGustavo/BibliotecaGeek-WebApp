<?php

class TemplateModel {

	/*=============================================
	 BUSCA LOS METADATOS
	=============================================*/
	static public function findOpenGraph($ruteOpen){
    $conection = Conection::starConection();
    $elements = $conection->prepare("
      SELECT * FROM opengraph WHERE rute = '$ruteOpen'
    ");

    $elements -> execute();
    return $elements->fetch();

    $elements-> close();

    $elements = null;
	}
}
