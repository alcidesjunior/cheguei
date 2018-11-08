<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Access-Control-Allow-Origin: *'); 

include_once "../autoload.php";
include_once "../Helpers/utilFunctions.php";

date_default_timezone_set('America/Fortaleza');

$dispositivos = new DispositivosController();
$data = json_decode(file_get_contents("php://input"));
if(notEmpty($data->id)){
	$delete = $dispositivos->destroy("id = {$data->id}");
	if($delete){
		http_response_code(200);
		echo json_encode( array('message' =>'Dispositivo deletado!') );
	}
}else{
	http_response_code(403);
	echo json_encode(array('message' =>  'Erro ao deletar dispositivo!'));
}
?>