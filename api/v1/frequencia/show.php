<?php 
header('Access-Control-Allow-Origin: *'); 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../autoload.php";
include_once "../Helpers/utilFunctions.php";

$frequencia = new FrequenciasController();

if(isset($_GET['funcionario_id']) && notEmpty($_GET['funcionario_id']) && is_numeric($_GET['funcionario_id'])){
	$funcionario_id = $_GET['funcionario_id'];
	http_response_code(200);
	echo json_encode($frequencia->getFrequenciaByFuncID($funcionario_id));
}else{
	http_response_code(403);
	echo json_encode(array("message"=>"Houve um erro na validação do funcionario_id!"));
}
?>