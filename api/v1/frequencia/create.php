<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Access-Control-Allow-Origin: *'); 
include_once "../autoload.php";
include_once "../Helpers/utilFunctions.php";

date_default_timezone_set('America/Fortaleza');

$frequencia = new FrequenciasController();
$data = json_decode(file_get_contents("php://input"));
//$funcionario_id,$hora_entrada,$hora_saida,$created_at
if(notEmpty($data->funcionario_id) and notEmpty($data->hora_entrada) ){
	$create = $frequencia->create($data->funcionario_id,$data->hora_entrada,date('0000-00-00'),date('Y-m-d H:i:s'));
	if($create){
		http_response_code(403);
		echo json_encode( array('message' =>'Entrada registrada!') );
	}
}else{
	http_response_code(403);
	echo json_encode(array('message' =>  'Erro ao registrar entrada!'));
}
?>