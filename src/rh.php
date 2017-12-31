<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Analise de Candidato</title>
</head>
<body>
	<pre>
<?php	
	require_once 'constantes_pts.php';
	require_once 'requisitos.php';
	require_once 'pegar_post.php';
	require_once 'decodificar.php';
	require_once 'pegar_curriculo.php';


	/**
	*	Recebe o nome da constante que contem um float
	*	correspondente ao valor(pontos) que a secao vale em caso de match, indiferenca ou "nao"(totalmente ao cotrario do requisito)
	*	Busca e retorna o valor em pontos referente a secao em caso de match ou indiferenca
	*	Retorna o valor da constante, em caso de falha retorna FALSE e exibe uma mensagem de erro
	**/
	function pega_const_pontos($nome){
		try{	
			switch ($nome) {
				case 'pessoais':
					return PONTOS_PESSOAL;
					break;
				case 'estado_civil':
					return PONTOS_ESTADO_CIVIL;
					break;
				case 'localizacao':
					return PONTOS_LOCALIZACAO;
					break;
				case 'salario_pretendido':
					return PONTOS_SAL_PRETEN;
					break;
				case 'formacao':
					return PONTOS_FORMACAO;
					break;
				case 'conhecimentos':
					return PONTOS_CONHECIMENTOS;
					break;
				case "indiferente":
					return PONTOS_INDIFERENTE;
					break;
				default:
					throw new Exception("nome da constante de pontos da avaliacao invalido");					
			}
		} catch (Exception $e) {
			echo "Erro: pega_const_pontos() : " . $e->getMessage();
			return false;
		}

	}

	/**
	*	Recebe o nome da secao e a consideracao('indiferente' ou 'nao') avaliativa em relacao a mesma.
	*	Valida a consideracao sobre a secao e retorna a pontuacao obtida
	*	Retorna a pontuacao obtida para a secao com tal consideracao, em caso de falha mostra um erro.
	**/
	function check_match($s, $c = NULL){
		//Se tem algo a considerar sobre a secao
		if(!is_null($c)){
			//Se consideraçao for indiferenca, se nao considera como negacao(nao)(valor em pts 0)
			$pts = ($c === "indiferente") ? pega_const_pontos($c) : 0.0;

		} else { //Deu match
			//Pega os pontos
			$pts = pega_const_pontos($s);

		}
		//Se nao houve erro(ou seja se tem $pts tem um float)
		if (is_real($pts)) {
			
			return $pts;

		} else { //Erro (pts == false ou int 0)
			echo "Erro: check_match(): nao conseguiu pegar os pontos";
		}					
	}

	/**
	* Recebe o nome da secao avalidada, OPCIONAL: caso seja totalmente proibida o requisito, a funcao recebe true 
	* caso seja indiferente, recebe "indiferente" no segundo parametro;
	* Seta o array pontos com a pontuacao do candidato em cada secao
	*/
	function setar_pontos($secao, $consideracao = NULL){

		global $pontos;
		//Valida o parametro
		if (isset($secao) && is_string($secao) ) {
			//add no final do array: "nome_da_secao" => pontuacao(float)
			$pontos[$secao] = check_match($secao, $consideracao);
		}		
	}

	function calcular_media() {

		global $pontos; 
		$s = 0.0;
		foreach($pontos as $secao => $pt){
			$s += $pt;
		}

		return $media = $s/count($pontos);
	}

	//MAIN

	$curriculo = pegar_curriculo();

	var_dump($curriculo);

	/*setar_pontos("pessoais");
	setar_pontos("conhecimentos");
	setar_pontos("salario_pretendido", "nao");*/

	//print_r($pontos);

	

?>	
</pre>
</body>
</html>


		