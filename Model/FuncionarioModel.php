<?php

//require_once "../_config/_database.class.php";
class FuncionarioModel{
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
	public function getAll($orderBy="id",$order="asc"){
		$this->setSql("select funcionarios.*,cargos.cargo from funcionarios inner join cargos on cargos.id = funcionarios.cargo_id order by funcionarios.nome asc");
		$query = $this->_db->prepare($this->sql);
		try{
			$query->execute();
			
			while($funcionariosResult = $query->fetch(PDO::FETCH_OBJ)){
				$funcionariosArray['funcionarios'][] = $funcionariosResult;
				
				$this->setSql("select * from dispositivos where funcionario_id={$funcionariosResult->id}");
				$queryDispositivo = $this->_db->prepare($this->sql);
				$queryDispositivo->execute();

				$this->setSql("select * from frequencia where funcionario_id={$funcionariosResult->id}");
				$queryFrequencia = $this->_db->prepare($this->sql);
				$queryFrequencia->execute();

				foreach($funcionariosArray['funcionarios'] as $currentFuncionario){
					if( $funcionariosResult->id == $currentFuncionario->id ){
						$currentFuncionario->dispositivos = $queryDispositivo->fetchall(PDO::FETCH_OBJ);
						$currentFuncionario->frequencia = $queryFrequencia->fetchall(PDO::FETCH_OBJ);
					}
					
				}
				
			}
			return $funcionariosArray;
			
		}catch(PDOException $e){
			print($e->getMessage());
		}
	}
	public function insert($nome,$cpf,$rg,$dt_admissao,$dt_demissao=0000,$cargo_id){
		$this->setSql("insert into funcionarios(nome,cpf,rg,dt_admissao,dt_demissao,cargo_id) values (?,?,?,?,?,?)");
		$query  = $this->_db->prepare($this->sql);
		$query->bindValue(1,$nome);
		$query->bindValue(2,$cpf);
		$query->bindValue(3,$rg);
		$query->bindValue(4,date('Y-m-d',strtotime($dt_admissao)));
		$query->bindValue(5,date('Y-m-d',strtotime($dt_demissao)));
		$query->bindValue(6,$cargo_id);


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
            
            $this->setSql("UPDATE funcionarios SET $columns WHERE $condition");

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

	public function login($mac_address){
		$this->setSql("select funcionarios.*,cargos.cargo from funcionarios inner join cargos on cargos.id = funcionarios.cargo_id inner join dispositivos on dispositivos.funcionario_id = funcionarios.id where dispositivos.mac_address = '".addslashes($mac_address)."'");
		$query = $this->_db->prepare($this->sql);
		try{

			$query->execute();
			if($query->rowCount()>0){
				while($funcionariosResult = $query->fetch(PDO::FETCH_OBJ)){
					$funcionariosArray['funcionarios'][] = $funcionariosResult;
					
					$this->setSql("select * from dispositivos where funcionario_id={$funcionariosResult->id}");
					$queryDispositivo = $this->_db->prepare($this->sql);
					$queryDispositivo->execute();


					foreach($funcionariosArray['funcionarios'] as $currentFuncionario){
						if( $funcionariosResult->id == $currentFuncionario->id ){
							$currentFuncionario->dispositivos = $queryDispositivo->fetchall(PDO::FETCH_OBJ);
						}
						
					}
					
				}
				return $funcionariosArray;
			}else{
				return 0;
			}
			
		}catch(PDOException $e){
			print($e->getMessage());
		}
	}

	public function getById($id){
		$this->setSql("select funcionarios.*,cargos.cargo from funcionarios inner join cargos on cargos.id = funcionarios.cargo_id where funcionarios.id = ".addslashes($id));
		$query = $this->_db->prepare($this->sql);
		try{

			$query->execute();
			if($query->rowCount()>0){
				while($funcionariosResult = $query->fetch(PDO::FETCH_OBJ)){
					$funcionariosArray['funcionarios'][] = $funcionariosResult;
					
					$this->setSql("select * from dispositivos where funcionario_id={$funcionariosResult->id}");
					$queryDispositivo = $this->_db->prepare($this->sql);
					$queryDispositivo->execute();

					$this->setSql("select * from frequencia where funcionario_id={$funcionariosResult->id}");
					$queryFrequencia = $this->_db->prepare($this->sql);
					$queryFrequencia->execute();

					foreach($funcionariosArray['funcionarios'] as $currentFuncionario){
						if( $funcionariosResult->id == $currentFuncionario->id ){
							$currentFuncionario->dispositivos = $queryDispositivo->fetchall(PDO::FETCH_OBJ);
							$currentFuncionario->frequencia = $queryFrequencia->fetchall(PDO::FETCH_OBJ);
						}
						
					}
					
				}
				return $funcionariosArray;
			}else{
				return array("vazio");
			}
			
		}catch(PDOException $e){
			print($e->getMessage());
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
		$this->setSql("delete from funcionarios where $term");
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