<?php
// require_once "../model/frequenciaModel.php";
class FrequenciasController{
	private $frequencia;

	public function __construct(){
		$this->frequencia = new FrequenciaModel();
	}

	public function getAll(){
		return $this->frequencia->getAll();
	}
	public function show($id){
		return $this->frequencia->getById($id);
	}
	public function create($funcionario_id,$hora_entrada,$hora_saida,$created_at){
		$dt = $this->frequencia->insert($funcionario_id,$hora_entrada,$hora_saida,$created_at);
		return ($dt ? true : false);
	}
	public function getLastID(){
		return $this->frequencia->getLastID();
	}
	public function update($fieldValue, $condition){
		/*
			$fieldValue = ["campo"=>"valor"]
		*/
		return $this->frequencia->update($fieldValue, $condition);
	}
	public function find($term){
		return $this->frequencia->find($term);
	}
	public function destroy($id){
		return $this->frequencia->delete($id);
	}
}

?>