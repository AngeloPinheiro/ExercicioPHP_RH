<?php
	/**
	*	Pega e Prepara os dados do formulario
	*	retorna os dados em um array associativo
	*/
	
	function pegar_curriculo(){
		$json = pegar_post();
		decodificar($json);
		return $json;
	}