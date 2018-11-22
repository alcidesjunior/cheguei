<?php
// require_once "../model/frequenciaModel.php";
class FrequenciasController{
	private $frequencia;

	public function __construct(){
		$this->frequencia = new FrequenciaModel();
	}

	public function getAll($order,$by,$condition,$filtered){
		return $this->frequencia->getAll($order,$by,$condition,$filtered);
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
	public function getReport($date1,$date2){
		return $this->frequencia->getReport($date1,$date2);
	}
	public function getFrequenciaByFuncID($funcionario_id,$param1,$param2){
		return $this->frequencia->etFrequenciaByFuncID($funcionario_id,$param1,$param2);
	}
	public function find($term){
		return $this->frequencia->find($term);
	}
	public function destroy($id){
		return $this->frequencia->delete($id);
	}
}

?>