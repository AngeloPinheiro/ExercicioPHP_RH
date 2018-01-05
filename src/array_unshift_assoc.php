<?php	
	/**
	*	Adiciona uma entrada associativa no inicio do array
	*	Faz por referencia ao array
	**/

	function array_unshift_assoc(&$array, $key, $value){
		$array = array_reverse($array);
   		$array[$key] = $value;
   		$array = array_reverse($array);
	}