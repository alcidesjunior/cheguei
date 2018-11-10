<?php 
header('Access-Control-Allow-Origin: *'); 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST,OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../autoload.php";

$cargo = new CargosController();
$data = json_decode(file_get_contents("php://input"));

function notEmpty($field){
	if(!empty(trim($field))){
		return true;
	}
	return false;
}

if( isset($data) ){
	if( notEmpty($data->cargo) and notEmpty($data->id)){
		$update = $cargo->update($data->cargo,$data->id);
		if($update){
			http_response_code(201);
			echo json_encode(array("message"=>"Cargo atualizado!"));
		}else{
			http_response_code(422);
			echo json_encode(array("message"=>"Erro ao atualizar cargo!"));
		}
	}else{
		http_response_code(403);
		echo json_encode(array("message"=>"Preencha os campos obrigatórios!"));
	}
}else{
	http_response_code(403);
	echo json_encode(array("message"=>"Envie dados!"));
}

?>