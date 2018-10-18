<?php 
//autoload tests
	spl_autoload_register(function($classname){
		// $file = str_replace('\\', '/', $classname);
		$folders = array("Controller","Model","Config");
		foreach($folders as $word){
			if(strpos($classname,$word)){
				$folder = $word."/";
				$path = "../../";
				if(file_exists("$path"."$folder"."$classname.php")){
					include "$path"."$folder"."$classname.php";
				}else{
					print "$path"."$folder"."$classname.php";
					die("\nFile nem existe");
				}
			}
		}
		
	});

?>