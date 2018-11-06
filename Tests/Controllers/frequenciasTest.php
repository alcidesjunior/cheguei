<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
include_once "autoload.php";

final class FrequenciasTest extends TestCase{

	protected $obj;
	protected function setup(){

		$this->obj = new FrequenciasController;
	}
	public function testGetAll(){

		$frequencia = (count($this->obj->getAll())>=0 ? true : false);
		$this->assertTrue($frequencia);
	}
	public function testAdd(){
	
		$frequencia = ($this->obj->create(1,date('Y-m-d H:i:s'),null,date('Y-m-d H:i:s')) ? true : false);
		$this->assertTrue($frequencia);
	}
	public function testShow(){

		$frequencia = (count($this->obj->show(1))==1 ? true : false);
		$this->assertTrue($frequencia);
	}
	public function testUpdate(){

		$frequencia = ($this->obj->update(array("hora_saida"=>date('Y-m-d H:i:s')),"id=1") ? true : false);
		$this->assertTrue($frequencia);
	}
	public function testFind(){

		$term = "
			select 
				funcionarios.nome,funcionarios.cpf,funcionarios.rg,funcionarios.dt_admissao,funcionarios.dt_demissao,
			    frequencia.funcionario_id, frequencia.hora_entrada, frequencia.hora_saida, frequencia.created_at
			from 
				frequencia
			inner join 
				funcionarios
			on 
				frequencia.funcionario_id = funcionarios.id
		";
		$frequencia = $this->obj->find($term);
		$this->assertCount(1,[$frequencia]);
	}
	public function testDestroy(){

		$frequencia = ($this->obj->destroy("id=1") ? true : false);
		$this->assertTrue($frequencia);
	}
}
?>