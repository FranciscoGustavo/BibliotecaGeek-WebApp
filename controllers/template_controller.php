<?php

class TemplateController {

	/*=============================================
	LLAMAMOS LA PLANTILLA
	=============================================*/
	public function template(){

		include_once "views/template.php";

	}

	/*=============================================
		CONVIERTE LA FECHA
	=============================================*/
	static public function timesTampData($fecha){
		$timestamp = strtotime($fecha);
		$meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

		$dia = date('d', $timestamp);
		$mes = date('m', $timestamp) - 1;
		$year = date('Y', $timestamp);

		$fecha = "$dia/" . $meses[$mes] . "/$year";
		return $fecha;
	}

	/*=============================================
	 BUSCA LOS METADATOS
	=============================================*/
	static public function findOpenGraph($ruteOpen){
		$res =  TemplateModel::findOpenGraph($ruteOpen);
		return $res;
	}
}
