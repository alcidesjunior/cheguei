<?php 
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include_once "../../_config/_database.php";
include_once "../../model/cargoModel.php";
include_once "../../controller/cargosController.php";

final class CargosTest extends TestCase{

	protected $obj;
	protected function setup(){
		$this->obj = new CargosController;
	}
	public function testAddCargo(){
		
		$test = new CargosController();
		if($test->create("Lixeiro")){
			$var = true;
		}else{
			$var = false;
		}
		$this->assertTrue($var);
	}
	public function testUpdateCargo(){
		$test = new CargosController();
		if($test->update("Lixeiro Chefe",1)){
			$var = true;
		}else{
			$var = false;
		}
		$this->assertTrue($var);
	}
}
?>