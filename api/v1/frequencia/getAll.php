<?php 
header('Access-Control-Allow-Origin: *'); 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once "../autoload.php";
include_once "../Helpers/utilFunctions.php";

date_default_timezone_set('America/Fortaleza');

$frequencia = new FrequenciasController();
// $data = json_decode(file_get_contents("php://input"));
if(isset($_GET['filtro']) && $_GET['filtro'] == "data"){
	if(!empty($_GET['search']) && $_GET['search'] !="todas"){
		$data = explode("/",$_GET['search']);
		$data = $data[2]."-".$data[1]."-".$data[0];
		$frequencias = $frequencia->getAll("frequencia.created_at","desc","where frequencia.hora_entrada like '$data%'");
	}else{
		$frequencias = $frequencia->getAll("frequencia.created_at","desc","todas");
	}
	// die($data);
	

}else{
	$frequencias = $frequencia->getAll("frequencia.created_at","desc","today");
}
http_response_code(200);
echo json_encode($frequencias);
?>