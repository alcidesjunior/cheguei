<?php 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Access-Control-Allow-Origin: *'); 
include_once "../autoload.php";
include_once "../Helpers/utilFunctions.php";

date_default_timezone_set('America/Fortaleza');

$frequencia = new FrequenciasController();

$frequencias = $frequencia->getAll();
http_response_code(200);
echo json_encode($frequencias);
?>