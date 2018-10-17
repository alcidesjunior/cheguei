<?php
require_once "../model/funcionarioModel.php";
class FuncionariosController{
	private $funcionario;

	public function __construct(){
		$this->funcionario = new FuncionarioModel();
	}

	public function getAll(){
		return $this->funcionario->getAll();
	}
	public function show(){}
	public function create($nome,$cpf,$rg,$dt_admissao,$dt_demissao=NULL,$cargo_id){
		$dt = $this->funcionario->insert($$nome,$cpf,$rg,$dt_admissao,$dt_demissao,$cargo_id);
		return ($dt ? true : false);
	}
	public function update(){}
	public function destroy(){}
}

?>