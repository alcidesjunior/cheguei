<?php
require_once "../model/dispositivoModel.php";
class CargosController{
	private $cargo;

	public function __construct(){
		$this->cargo = new CargoModel();
	}

	public function getAll(){
		return $this->cargo->getAll();
	}
	public function show(){}
	public function create($mac_address, $funcionario_id){
		$dt = $this->cargo->insert($mac_address, $funcionario_id);
		return ($dt ? true : false);
	}
	public function update(){}
	public function destroy(){}
}

?>