<?php
require_once "../model/frequenciaModel.php";
class CargosController{
	private $cargo;

	public function __construct(){
		$this->cargo = new FrequenciaModel();
	}

	public function getAll(){
		return $this->cargo->getAll();
	}
	public function show(){}
	public function create($funcionario_id,$hora_entrada,$hora_saida,$created_at){
		$dt = $this->cargo->insert($funcionario_id,$hora_entrada,$hora_saida,$created_at);
		return ($dt ? true : false);
	}
	public function update(){}
	public function destroy(){}
}

?>