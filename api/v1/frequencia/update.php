<?php 
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST,OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once "../autoload.php";
include_once "../Helpers/utilFunctions.php";

date_default_timezone_set('America/Fortaleza');

$frequencia = new FrequenciasController();
$data = json_decode(file_get_contents("php://input"));
//$funcionario_id,$hora_entrada,$hora_saida,$created_at
if(notEmpty($data->funcionario_id) and notEmpty($data->hora_saida) and notEmpty($data->frequencia_id) ){
	$create = $frequencia->update(array("hora_saida"=>$data->hora_saida),"funcionario_id={$data->funcionario_id} and id={$data->frequencia_id}");
	if($create){
		http_response_code(403);
		echo json_encode( array('message' =>'Saída registrada!') );
	}
}else{
	http_response_code(403);
	echo json_encode(array('message' =>  'Erro ao registrar saída!'));
}
?>