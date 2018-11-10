<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, OPTIONS");
 
include_once "../autoload.php";

$funcionario = new FuncionariosController();

$funcionarios = $funcionario->getAll();

http_response_code(200);
echo json_encode($funcionarios);
?>