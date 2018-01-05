<?php	
	/**
	*	Seta todos os dados para minusculo
	*	Para padronizar as strings que serao validadas
	**/
	function corrigir_case(&$form){
		foreach ($form as $k => $v) {
			if(is_string($v)){
				$form[$k] = strtolower($v);		
			}
		}
	}
