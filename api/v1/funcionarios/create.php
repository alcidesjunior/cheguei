<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../autoload.php";

$funcionario = new FuncionariosController();
$data = json_decode(file_get_contents("php://input"));

function notEmpty($field){
	if(!empty(trim($field))){
		return true;
	}
	return false;
}

if( isset($data) ){
	if( notEmpty($data->nome) and notEmpty($data->cpf) and notEmpty($data->rg) and notEmpty($data->cargo_id)){
		$create = $funcionario->create($data->nome,$data->cpf,$data->rg,$data->dt_admissao,$data->dt_demissao,$data->cargo_id);
		if($create){
			http_response_code(201);
			echo json_encode(array("message"=>"Funcionário criado!"));
		}else{
			http_response_code(422);
			echo json_encode(array("message"=>"Erro ao criar funcionário!"));
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