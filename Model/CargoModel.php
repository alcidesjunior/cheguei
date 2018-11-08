<?php

//require_once "../_config/_database.class.php";
class CargoModel{
	private $_db; 
	private $sql;

	public function __construct(){
		$this->_db = ConnectionConfig::getInstance();
	}
	protected function setSql($sql_query){
		return isset($sql_query) ? $this->sql = $sql_query : false;
	}
	public function getAll($orderBy="id",$order="asc"){
		$this->setSql("select * from cargos order by ".$orderBy." ".$order);
		$query = $this->_db->prepare($this->sql);
		try{
			$query->execute();

			return $query->fetchall(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			print($e->getMessage());
		}
	}
	public function insert($cargo){
		$this->setSql("insert into cargos(cargo) values (?)");
		$query  = $this->_db->prepare($this->sql);
		$query->bindValue(1,$cargo);


		try{
			$query->execute() or die(var_dump($query));
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
			return false;
		}
	}
	public function getById($id){
		$this->setSql("select * from cargos where id = ? ");
		$query = $this->_db->prepare($this->sql);
		$query->bindValue(1,$id);
	
		try{
			$query->execute();
			if($query->rowCount()>0){
				
				return $query->fetchall(PDO::FETCH_OBJ);
			}else{
				return 0;
			}
		}catch(PDOException $e){
				die($e->getMessage());
		}
	}
	public function delete($term){
		$this->setSql("delete from cargos where $term");
		$query  = $this->_db->prepare($this->sql);
		// $query->bindValue(1,$id);


		try{
			$query->execute() or die(var_dump($query));
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
			return false;
		}
	}
	public function find($term){
		$this->setSql($term);
		$query  = $this->_db->prepare($this->sql);

		try{
			$query->execute();
			return $query->fetch(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	public function update($cargo,$id){
		$this->setSql("update cargos set cargo= ? where id= ?");
		$query  = $this->_db->prepare($this->sql);
		$query->bindValue(1,$cargo);
		$query->bindValue(2,$id);


		try{
			$query->execute() or die(var_dump($query));
			return true;
		}catch(PDOException $e){
			die($e->getMessage());
			return false;
		}
	}
}

?>