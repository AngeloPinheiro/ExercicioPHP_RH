<?php
	
	/**
	*	Recebe uma REFERENCIA para um variavel com JSON de um POST
	*	Faz o parse do JSON pra array
	*	Retorna o array com os dados do form
	*/
	
	function decodificar(&$json){
		try {
			//Parse para array assoc. preservando acentuacao
			$json = json_decode("$json", true, JSON_UNESCAPED_UNICODE);
			//Trata os erros do parse
			if(json_last_error()){
				throw new Exception(json_last_error_msg());			  
			}
		} catch (Exception $e) {
			 echo "Erro: decodificar() em json_decode(): " . $e->getMessage();
		}

	}