<?php
// require_once "../model/cargoModel.php";
declare(strict_types=1);
class CargosController{
	private $cargo;

	public function __construct(){
		$this->cargo = new CargoModel();
	}

	public function getAll(){
		return $this->cargo->getAll();
	}
	public function show($id){
		return $this->cargo->getById($id);
	}
	public function create($cargo){
		return $this->cargo->insert($cargo);
		//return ($dt ? true : false);
	}
	public function update($cargo, $id){
		return $this->cargo->update($cargo,$id);
	}
	public function find($term){
		return $this->cargo->find($term);
	}
	public function destroy($term){
		return $this->cargo->delete($term);
	}
}

?>