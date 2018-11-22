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
	public function getAll($orderBy="frequencia.created_at",$order="desc", $condition = "today",$filtered = true){
		if($condition == "today"){
			$condition = "where frequencia.hora_entrada like '".date('Y-m-d')."%'";
		}else if($condition == "todas"){
			$condition = "";
		}

		if($filtered == true){
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
				    frequencia.created_at,
				    cargos.cargo
				from 
					frequencia
				inner join 
					funcionarios
				on 
					frequencia.funcionario_id = funcionarios.id
				inner join
					cargos
				on 
					funcionarios.cargo_id = cargos.id
				$condition

				group by 
					frequencia.funcionario_id
			 order by ".$orderBy." ".$order);
		}else{
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
				    frequencia.created_at,
				    cargos.cargo
				from
					frequencia
				inner join 
					funcionarios
				on 
					frequencia.funcionario_id = funcionarios.id
				inner join
					cargos
				on 
					funcionarios.cargo_id = cargos.id
				$condition

			 order by ".$orderBy." ".$order);
		}
		// die($this->sql);
		$query = $this->_db->prepare($this->sql);
		try{
			$query->execute();
			$frequencias['frequencias'] =  $query->fetchall(PDO::FETCH_OBJ);
			return $frequencias;
		}catch(PDOException $e){
			print($e->getMessage());
		}
	}
	public function insert($funcionario_id,$hora_entrada,$hora_saida='0000-00-00 00:00:00',$created_at){
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
	public function getReport($date1,$date2){
		// $this->setSql("
		// 		select
		// 			funcionarios.nome,
		// 			funcionarios.cpf,
		// 			funcionarios.rg,
		// 			funcionarios.dt_admissao,
		// 			funcionarios.dt_demissao,
		// 		    frequencia.funcionario_id, 
		// 		    frequencia.hora_entrada, 
		// 		    frequencia.hora_saida, 
		// 		    frequencia.created_at,
		// 		    cargos.cargo,
		// 		    COUNT(frequencia.id) as presencas
		// 		from 
		// 			frequencia
		// 		inner join 
		// 			funcionarios
		// 		on 
		// 			frequencia.funcionario_id = funcionarios.id
		// 		inner join
		// 			cargos
		// 		on 
		// 			funcionarios.cargo_id = cargos.id
				
		// 		where frequencia.created_at BETWEEN '$date1' AND '$date2'
		// 	 order by frequencia.created_at desc");
		// // die($this->sql);
		
		$relatorio = array();

		$this->setSql("select funcionarios.*,cargos.cargo from funcionarios inner join cargos on cargos.id = funcionarios.cargo_id order by funcionarios.nome asc");
		$query = $this->_db->prepare($this->sql);
		$funcionariosArray = array();
		try{
			$query->execute();
			
			while($funcionariosResult = $query->fetch(PDO::FETCH_OBJ)){
				$relatorio[] = $funcionariosResult;
				

				$this->setSql("select COUNT(*) as presenca from frequencia where funcionario_id={$funcionariosResult->id} and frequencia.created_at BETWEEN '$date1' AND '$date2'");
				$queryFrequencia = $this->_db->prepare($this->sql);
				$queryFrequencia->execute();
				// echo $this->sql;
				foreach($relatorio as $currentFuncionario){
					if( $funcionariosResult->id == $currentFuncionario->id ){
						$currentFuncionario->presencas =  $queryFrequencia->fetchall(PDO::FETCH_OBJ);
					}
					
				}
				
			}
			return $relatorio;
		}catch(PDOException $e){
			print($e->getMessage());
		}

		// $_index = 0;
		// while(count($funcionarios) < $_index){
		// 	$relatorio['relatorio'][] = $funcionarios[$_index];
		// 	// var_dump($funcionario[0]->id);
		// 	$this->setSql("
		// 		SELECT COUNT(*) as presencas FROM frequencia 
		// 		WHERE 
		// 			frequencia.funcionario_id={$funcionario[$_index]->id}
		// 		AND
		// 			frequencia.created_at BETWEEN '$date1' AND '$date2'
		// 	");
		// 	echo ">>>> {$funcionario[$_index]->id} <<<<";
		// 	$query = $this->_db->prepare($this->sql);
		// 	try{
		// 		$query->execute();
		// 		$currentRequest = $query->fetchall(PDO::FETCH_OBJ);
		// 		 foreach ($relatorio['relatorio'] as $current){
		// 		 	// var_dump($currentRequest[0]->presencas);
		// 		 	// var_dump($relatorio->)
		// 		 	if( $funcionario[$_index]->id == $current[$_index]->id ){
				 		
		// 		 		$current[$_index]->presencas = $currentRequest[$_index]->presencas;
		// 		 		// var_dump($current);
		// 		 	}
				 	
		// 		 }
		// 	}catch(PDOException $e){
		// 		print($e->getMessage());
		// 	}
		// 	echo "<b>$_index</b>";
		// 	$_index += 1;
			
		// }

		// return $relatorio;
		// $query = $this->_db->prepare($this->sql);
		// try{
		// 	$query->execute();
		// 	$funcionarios =  $query->fetchall(PDO::FETCH_OBJ);
		// 	return $frequencias;
		// }catch(PDOException $e){
		// 	print($e->getMessage());
		// }
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
			    cargos.cargo
			from 
				frequencia
			inner join 
				funcionarios
			on 
				frequencia.funcionario_id = funcionarios.id
			inner join 
				cargos
			on 
				funcionarios.cargo_id = cargos.id
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
	public function getFrequenciaByFuncID($funcionario_id,$orderBy="frequencias.created_at",$order="desc"){

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
			    frequencia.created_at,
			    cargos.cargo
			from 
				frequencia
			inner join 
				funcionarios
			on 
				frequencia.funcionario_id = funcionarios.id
			inner join
				cargos
			on 
				funcionarios.cargo_id = cargos.id

			where 
				funcionarios.id = $funcionario_id
		 order by ".$orderBy." ".$order);
		// die($this->sql);
		$query = $this->_db->prepare($this->sql);
		try{
			$query->execute();
			$frequencias['frequencias'] =  $query->fetchall(PDO::FETCH_OBJ);
			return $frequencias;
		}catch(PDOException $e){
			print($e->getMessage());
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