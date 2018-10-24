<?php
// require_once "../model/funcionarioModel.php";
class FuncionariosController{
	private $funcionario;

	public function __construct(){
		$this->funcionario = new FuncionarioModel();
	}

	public function getAll(){
		return $this->funcionario->getAll();
	}
	public function show($id){
		return $this->funcionario->getById($id);
	}
	public function create($nome,$cpf,$rg,$dt_admissao,$dt_demissao=0000,$cargo_id){
		$dt = $this->funcionario->insert($nome,$cpf,$rg,$dt_admissao,$dt_demissao,$cargo_id);
		return ($dt ? true : false);
	}
	public function update($fieldValue, $condition){
		/*
			$fieldValue = ["campo"=>"valor"]
		*/
		return $this->funcionario->update($fieldValue, $condition);
	}
	public function find($term){
		return $this->funcionario->find($term);
	}
	public function destroy($id){
		return $this->funcionario->delete($id);
	}
}

?>