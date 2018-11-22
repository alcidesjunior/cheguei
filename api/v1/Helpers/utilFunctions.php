<?php
function notEmpty($field){
	if(!empty(trim($field))){
		return true;
	}
	return false;
}
function keyExist($field,$array){
	if(array_key_exists($field, $array)){
		return true;
	}
	return false;
}
function dateBrToEUA($date){
	if(notEmpty($date)){
		$local = explode('/', $date);
		$local = $local[2]."-".$local[1]."-".$local[0];

		return $local;
	}
	return;
}
?>