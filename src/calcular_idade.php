<?php
	/**
	* Calcula a idade da pessoa com base na data de nascimento
	* Fonte: http://www.phpit.com.br/artigos/descobrindo-a-idade-atraves-da-data-de-nascimento.phpit
	*	
	**/
	
	function calcular_idade($data_nascimento){

		// Declara a data! :P
		$data = $data_nascimento;
	
		// Separa em dia, mês e ano
    	list($dia, $mes, $ano) = explode('/', $data);
   
    	// Descobre que dia é hoje e retorna a unix timestamp
    	$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

    	// Descobre a unix timestamp da data de nascimento do fulano
    	$nascimento = mktime( 0, 0, 0, 1, 07, 2000);
 
	    // Depois apenas fazemos o cálculo já citado :)
   		$idade = (int) floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

   		return $idade;
	}