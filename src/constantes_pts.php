<?php	
	/**
	*	Aqui estao setadas todas constantes que representam 
	*	os valores em pontos para cada requisito ou secao.
	*
	*
	**/

	//Constante de pontuacao base (em caso de nao match com os requisitos)
	define("indiferente", 2.0);

	//Requisitos da secao "pessoal"
	define("pessoais", 4.0);
		define("idade", 5.0);
		define("nacionalidade", 4.5);
		define("sexo", 5.0);
	
	//Requisito "estado_civil"	
	define("estado_civil", 5.0);

	//Requisitos da secao "localizacao"	
	define("localizacao", 8.0);
		define("cidade", 9.0);
		define("estado", 4.5);

	//Requisitos salario pretendido
	define("salario_pretendido", 8.0);
	
	//Requisitos da secao formacao
	define("formacao", 9.0);
		define("instituicao", 8.5);
		define("titulo", 10);
		define("situacao", 10);
			