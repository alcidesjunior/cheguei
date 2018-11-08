<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Access-Control-Allow-Origin: *');
include_once "../autoload.php";
include_once "../Helpers/utilFunctions.php";

$funcionario = new FuncionariosController();
$dispositivo = new DispositivosController();
$data = json_decode(file_get_contents("php://input"));

if( isset($data) ){
	if( notEmpty($data->mac_address)){
		$doLogin = $funcionario->login($data->mac_address);
		if($doLogin){
			http_response_code(201);
			echo json_encode($doLogin);
		}else{
			http_response_code(422);
			echo json_encode(array("message"=>"Usuário inválido"));
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