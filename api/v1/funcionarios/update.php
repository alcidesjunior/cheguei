<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Access-Control-Allow-Origin: *'); 
include_once "../autoload.php";
include_once "../Helpers/utilFunctions.php";

$funcionario = new FuncionariosController();
$dispositivos = new DispositivosController();

$data = json_decode(file_get_contents("php://input"));
$dispositivosData = $data->dispositivos;

if(isset($data)){
	if(keyExist("id",$data) and notEmpty($data->id)){
		$update = $funcionario->update(
			array("nome"=>$data->nome,
				"cpf"=>$data->cpf,
				"rg"=>$data->rg,
				"dt_admissao"=>$data->dt_admissao,
				"dt_demissao"=>$data->dt_demissao,
				"cargo_id"=>$data->cargo_id),
			"id={$data->id}"
		);
		foreach($dispositivosData as $dispositivo){
			if($dispositivo->id != '-1'){
				$dispositivos->update(array("mac_address"=>$dispositivo->mac_address),"id={$dispositivo->id}");
			}else{
				$dispositivos->create($dispositivo->mac_address,$data->id);
			}
		}
		http_response_code(200);
		echo json_encode(array("message"=>"Funcionário atualizado!"));

	}else{
		http_response_code(403);
		echo json_encode(array("message"=>"Envie o ID do funcionário!"));
	}
}else{
	http_response_code(403);
	echo json_encode(array("message"=>"Envie parâmetros para atualizar!"));
}
?>