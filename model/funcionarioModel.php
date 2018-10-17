<?php

require_once "../_config/_database.class.php";
class FuncionarioModel{
	private $_db; 
	private $sql;

	public function __construct(){
		$this->_db = ConnectionDB::getInstance();
	}
	protected function setSql($sql_query){
		return isset($sql_query) ? $this->sql = $sql_query : false;
	}
	public function getAll($orderBy="id",$order="asc"){
		$this->setSql("select * from funcionarios order by ".$orderBy." ".$order);
		$query = $this->_db->prepare($this->sql);
		try{
			$query->execute();

			return $query->fetchall(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			print($e->getMessage());
		}
	}
	public function insert($nome,$cpf,$rg,$dt_admissao,$dt_demissao=NULL,$cargo_id){
		$this->setSql("insert into funcionarios(nome,cpf,rg,dt_admissao,dt_demissao,cargo_id) values (?,?,?,?,?,?)");
		$query  = $this->_db->prepare($this->sql);
		$query->bindValue(1,$nome);
		$query->bindValue(2,$cpf);
		$query->bindValue(3,$rg);
		$query->bindValue(4,date('Y-m-d',strtotime($dt_admissao)));
		$query->bindValue(5,date('Y-m-d',strtotime($dt_demissao)));
		$query->bindValue(6,$cargo_id);


		try{
			$query->execute() or die(var_dump($query));
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	public function getById($id){
		$query = $this->_db->prepare($this->sql);
		$query->bindValue(1,$id);

		try{
			$query->execute();
			return $query->fetch(PDO::FECTH_OBJ);
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	public function find($term){
		$query  = $this->_db->prepare($this->sql);
		$query->bindValue(1,$term);

		try{
			$query->execute();
			return $query->fetch(PDO::FECTH_OBJ);
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
}

?>