<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once "../autoload.php";

$funcionario = new FuncionariosController();

function notEmpty($field){
	if(!empty(trim($field))){
		return true;
	}
	return false;
}

if( isset($_GET['funcionario_id'])){
	if(is_numeric($_GET['funcionario_id'])){
		$data = $_GET['funcionario_id'];
		if(notEmpty($data)){
			
			$show = $funcionario->show($data);
			if(array_key_exists("funcionarios",$show) ){
				http_response_code(200);
				echo json_encode($show['funcionarios'][0]);
			}else{
				http_response_code(200);
				echo json_encode(array("message"=>"Funcionário não encontrado!"));
			}
		}else{
			http_response_code(403);
			echo json_encode(array("message"=>"Preencha os campos obrigatórios!"));
		}
	}else{
		http_response_code(403);
		echo json_encode(array("message"=>"Parâmetro inválido, passe um inteiro."));
	}

}else{
	http_response_code(403);
	echo json_encode(array("message"=>"Envie dados!"));
}

?>