<?php
// require_once "../model/dispositivoModel.php";
class DispositivosController{

	private $dispositivo;

	public function __construct(){
		$this->dispositivo = new DispositivoModel();
	}

	public function getAll(){
		return $this->dispositivo->getAll();
	}
	public function show($id){
		return $this->dispositivo->getById($id);
	}
	public function create($mac_address,$funcionario_id){
		$dt = $this->dispositivo->insert($mac_address,$funcionario_id);
		return ($dt ? true : false);
	}
	public function update($fieldValue, $condition){
		/*
			$fieldValue = ["campo"=>"valor"]
		*/
		return $this->dispositivo->update($fieldValue, $condition);
	}
	public function find($term){
		return $this->dispositivo->find($term);
	}
	public function destroy($id){
		return $this->dispositivo->delete($id);
	}
}

?>