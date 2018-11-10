<?php 
header('Access-Control-Allow-Origin: *'); 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../autoload.php";

$cargo = new CargosController();
//json_decode(file_get_contents("php://input"));

function notEmpty($field){
	if(!empty(trim($field))){
		return true;
	}
	return false;
}

if( isset($_GET['cargo_id'])){
	if(is_numeric($_GET['cargo_id'])){
		$data = $_GET['cargo_id'];
		if(notEmpty($data)){
			
			$show = $cargo->show($data);
			if($show){
				http_response_code(200);
				echo json_encode($show[0]);
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