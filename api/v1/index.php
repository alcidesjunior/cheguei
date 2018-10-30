<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once "autoload.php";

//endpoints
// $request = trim($_GET['request']);
// echo json_encode(array("nome"=>"Alcides Junior","idade"=>24));
if(isset($_GET){
	$request = trim($_GET['request']);
	if(!empty($request)){
		//FUNCIONARIOS
		///GETTING ALL FUNCIONARIOS
		//Resquest: all_funcionarios
		if($request=="all_funcionarios"){
			http_response_code(200);
			echo json_encode(array("nome"=>"Alcides Junior","idade"=>24));
		}
	}else{
		http_response_code(400);
		echo "bad request";
	}
}
?>