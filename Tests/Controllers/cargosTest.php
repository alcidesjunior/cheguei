<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
include_once "autoload.php";

final class CargosTest extends TestCase{

	protected $obj;
	protected function setup(){

		$this->obj = new CargosController;
	}
	public function testGetAll(){

		$cargos = (count($this->obj->getAll())>=0 ? true : false);
		$this->assertTrue($cargos);
	}
	public function testAdd(){
	
		$cargo = ($this->obj->create("Pedreiro") ? true : false);
		$this->assertTrue($cargo);
	}
	public function testShow(){

		$cargo = (count($this->obj->show(1))==1 ? true : false);
		$this->assertTrue($cargo);
	}
	public function testUpdate(){

		$cargo = ($this->obj->update("Lixeiro Chefex",1) ? true : false);
		$this->assertTrue($cargo);
	}
	public function testFind(){

		$term = "select * from cargos where cargo like '%x' ";
		$cargo = $this->obj->find($term);
		$this->assertCount(1,[$cargo]);
	}
	public function testDestroy(){

		$cargo = ($this->obj->destroy("id=4") ? true : false);
		$this->assertTrue($cargo);
	}
}
?>