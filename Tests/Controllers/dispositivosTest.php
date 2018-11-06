<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;
include_once "autoload.php";

final class DispositivosTest extends TestCase{

	protected $obj;
	protected function setup(){

		$this->obj = new DispositivosController;
	}
	public function testGetAll(){

		$dispositivos = (count($this->obj->getAll())>=0 ? true : false);
		$this->assertTrue($dispositivos);
	}
	public function testAdd(){
	
		$funcionario = ($this->obj->create("0a:e3:25:ff:44",1) ? true : false);
		$this->assertTrue($funcionario);
	}
	public function testShow(){

		$funcionario = (count($this->obj->show(1))==1 ? true : false);
		$this->assertTrue($funcionario);
	}
	public function testUpdate(){

		$cargo = ($this->obj->update(array("mac_address"=>"ee:ff:e3:34"),"id=1") ? true : false);
		$this->assertTrue($cargo);
	}
	public function testFind(){

		$term = "select nome from funcionarios as f,dispositivos as d where f.id = d.funcionario_id";
		$cargo = $this->obj->find($term);
		$this->assertCount(1,[$cargo]);
	}
	public function testDestroy(){

		$cargo = ($this->obj->destroy("id=2") ? true : false);
		$this->assertTrue($cargo);
	}
}
?>