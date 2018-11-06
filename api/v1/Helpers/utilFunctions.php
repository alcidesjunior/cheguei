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
?>