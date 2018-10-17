<?php

require_once "../_config/_database.class.php";
class DispositivoModel{
	private $_db; 
	private $sql;

	public function __construct(){
		$this->_db = ConnectionDB::getInstance();
	}
	protected function setSql($sql_query){
		return isset($sql_query) ? $this->sql = $sql_query : false;
	}
	public function getAll($orderBy="id",$order="asc"){
		$this->setSql("select * from dispositivos order by ".$orderBy." ".$order);
		$query = $this->_db->prepare($this->sql);
		try{
			$query->execute();

			return $query->fetchall(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			print($e->getMessage());
		}
	}
	public function insert($mac_address,$funcionario_id){
		$this->setSql("insert into dispositivos(mac_address,funcionario_id) values (?,?)");
		$query  = $this->_db->prepare($this->sql);
		$query->bindValue(1,$mac_address);
		$query->bindValue(2,$funcionario_id);


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