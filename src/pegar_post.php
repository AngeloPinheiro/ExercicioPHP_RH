<?php
	
	/**
	*	Pega o JSON no POST do form(curriculo)
	*	Retorna o conteudo do post
	*/
	
	function pegar_post(){
		try{
			//Pega o JSON no body da request post
			$content_post = file_get_contents("php://input");
			//Trata em caso de erro 
			if(empty($content_post)){
				throw new Exception("Erro ao processar a request POST");				
			} else {
				return $content_post;
			}
		} catch (Exception $e) {
				echo "Erro: get_curriculo(): " . $e->getMessage();
		}	
		
	}