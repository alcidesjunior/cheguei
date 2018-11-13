<?php

// require_once "../_config/_database.class.php";
class FrequenciaModel{
	private $_db; 
	private $sql;

	public function __construct(){
		$this->_db = ConnectionConfig::getInstance();
	}
	protected function setSql($sql_query){
		return isset($sql_query) ? $this->sql = $sql_query : false;
	}
	public function getLastID(){
		return $this->_db->lastInsertId();
	}
	public function getAll($orderBy="frequencia.created_at",$order="desc"){
		$this->setSql("
			select 
				funcionarios.nome,
				funcionarios.cpf,
				funcionarios.rg,
				funcionarios.dt_admissao,
				funcionarios.dt_demissao,
			    frequencia.funcionario_id, 
			    frequencia.hora_entrada, 
			    frequencia.hora_saida, 
			    frequencia.created_at
			from 
				frequencia
			inner join 
				funcionarios
			on 
				frequencia.funcionario_id = funcionarios.id
		 order by ".$orderBy." ".$order);
		$query = $this->_db->prepare($this->sql);
		try{
			$query->execute();
			$frequencias['frequencias'] =  $query->fetchall(PDO::FETCH_OBJ);
			return $frequencias;
		}catch(PDOException $e){
			print($e->getMessage());
		}
	}
	public function insert($funcionario_id,$hora_entrada,$hora_saida,$created_at){
		$this->setSql("insert into frequencia(funcionario_id,hora_entrada,hora_saida,created_at) values (?,?,?,?)");
		$query  = $this->_db->prepare($this->sql);
		$query->bindValue(1,$funcionario_id);
		$query->bindValue(2,$hora_entrada);
		$query->bindValue(3,$hora_saida);
		$query->bindValue(4,$created_at);
		

		try{
			if($query->execute()){
				return true;	
			}else{
				die(var_dump( $query->errorInfo() ));
			}
			
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	public function update($fieldValue = array(), $condition){
		if($fieldValue !=null){
            $columns = '';
            $x = 1;
            foreach($fieldValue as $key => $value){
                $columns .= "$key='$value'";
                if($x < count($fieldValue)){
                    $columns .= ",";
                }
                $x++;
            }
            
            $this->setSql("UPDATE frequencia SET $columns WHERE $condition");

            $query = $this->_db->prepare($this->sql);
            try{
            	if($query->execute()){
            		return true;
            	}else{
            		die($query->errorInfo());
            	}
            }catch(PDOException $e){
            	die($e->getMessage());
            }
        
        }
	}
	public function getById($id){
		$this->setSql("
			select 
				funcionarios.nome,
				funcionarios.cpf,
				funcionarios.rg,
				funcionarios.dt_admissao,
				funcionarios.dt_demissao,
			    frequencia.funcionario_id, 
			    frequencia.hora_entrada, 
			    frequencia.hora_saida, 
			    frequencia.created_at
			from 
				frequencia
			inner join 
				funcionarios
			on 
				frequencia.funcionario_id = funcionarios.id
			where 
				frequencia.id = ?
		");
		$query = $this->_db->prepare($this->sql);
		$query->bindValue(1,$id);

		try{
			$query->execute();
			return $query->fetchall(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	public function find($term){
		$query  = $this->_db->prepare($this->sql);
		$query->bindValue(1,$term);

		try{
			$query->execute();
			return $query->fetchall(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
	public function delete($term){
		$this->setSql("delete from frequencia where $term");
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
}

?>