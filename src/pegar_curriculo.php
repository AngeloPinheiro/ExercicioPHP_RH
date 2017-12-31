<?php
	/**
	*	Pega e Prepara os dados do formulario
	*	retorna os dados em um array associativo
	*/
	
	require_once 'pegar_post.php';
	require_once 'decodificar.php';

	function pegar_curriculo(){
		$json = pegar_post();
		decodificar($json);
		return $json;
	}