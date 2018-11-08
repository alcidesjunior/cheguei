<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
include_once "autoload.php";

final class FuncionariosTest extends TestCase{

	protected $obj;
	protected function setup(){

		$this->obj = new FuncionariosController;
	}
	public function testGetAll(){

		$funcionario = (count($this->obj->getAll())>=0 ? true : false);
		$this->assertTrue($funcionario);
	}
	public function testAdd(){
	
		$funcionario = ($this->obj->create("Jose Alcides Junior","60351096329","20096587","2010-12-12","0000","1") ? true : false);
		$this->assertTrue($funcionario);
	}
	public function testShow(){

		$funcionario = (count($this->obj->show(3))==1 ? true : false);
		$this->assertTrue($funcionario);
	}
	public function testUpdate(){

		$cargo = ($this->obj->update(array("nome"=>"Alcides Junior"),"id=3") ? true : false);
		$this->assertTrue($cargo);
	}
	public function testFind(){

		$term = "select * from funcionarios where nome like '%a' ";
		$cargo = $this->obj->find($term);
		$this->assertCount(1,[$cargo]);
	}
	public function testDestroy(){

		$cargo = ($this->obj->destroy("id=3") ? true : false);
		$this->assertTrue($cargo);
	}
}
?>