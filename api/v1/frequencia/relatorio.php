<?php 
header('Access-Control-Allow-Origin: *'); 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../autoload.php";
include_once "../Helpers/utilFunctions.php";

date_default_timezone_set('America/Fortaleza');

$frequencia = new FrequenciasController();

if(isset($_GET['dataInicio']) && isset($_GET['dataFim'])){
	$dataInicio = dateBrToEUA($_GET['dataInicio']);
	$dataFim = dateBrToEUA($_GET['dataFim']);

	if(notEmpty($dataInicio) && notEmpty($dataFim)  ){
		$relatorio = $frequencia->getReport($dataInicio,$dataFim);
		http_response_code(200);
		// var_dump($relatorio);
		echo json_encode($relatorio);
	}else{
		http_response_code(400);
		echo json_encode(array("message"=>"As datas não podem ser vazias."));
	}
}else{
	http_response_code(200);
	echo json_encode(array("message"=>"Preencha as datas."));
}
?>