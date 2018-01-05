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


	//==================================================================================================================
	

	
	


	

	
	//==================================================================================================================

	//MAIN


	$pessoais = [
			"idade"			=> [20, 30, 40],
			"nacionalidade" => "brasileiro",
			"sexo" 			=> "indiferente"
		];

	$curriculo = pegar_curriculo();
	preparar_curriculo($curriculo);
	
	/*function avaliar ($k, $v, $r) {
			
			if($r ){
				echo "<p>deu match! <br>  k $k  =  r $r !</p>";
				return true;
			}
		

		//var_dump($);
	}

	function secao($possib, $requisito){
		global $curriculo;

		if(is_array($possib)){			
		
			foreach ($curriculo as $req => $resposta) {
				if($req === $requisito){
					
					array_walk($possib, 'avaliar', $resposta);
				}
			}

		}
	}

	array_walk($requisitos, "secao");

	



	//var_dump($curriculo);

	/*setar_pontos("pessoais");
	setar_pontos("conhecimentos");
	setar_pontos("salario_pretendido", "nao");*/

	//print_r($sec);*/


/*foreach ($requisitos as $key) {
	$novo = array_filter($requisitos, function ($key, $value){
			if(is_array($key)){
				foreach($key as $requisito => $op){
					if($curriculo[$requisito]){
						if($curriculo[$requisito] == $op){
							echo "MATCH requisito '$curriculo[$requisito]' igual a resposta $op <br>";
							return true;
						}
					}
				}
			} else {
				//COMPARAR DIRETO
				var_dump($key);

			}
		}, ARRAY_FILTER_USE_BOTH);

}*/



foreach ($requisitos as $requisito => $possibilidades) { //percorre $requisitos
	
	//foreach($curriculo as $campo => $resposta){ //percorre $curriculo

		if(is_array($possibilidades)) { // se for "secao" => requisito1... => possibilidadeS

			foreach ($possibilidades as $possibilidade => $p) { //percorre $possibilidades

				if(is_array($p) && in_array($possibilidade, $curriculo)){ // se for "secao" => requisito1 => possibilidadeS => [possibilidade1, possibilidade2 ...] 
					
					foreach ($p as $k => $v) { //para cada possibilidade as indice($k) => valor($v)
						foreach($curriculo as $campo => $resposta){
							if($resposta == $v){
								echo "Resposta: $resposta igual possibilidade $v no requisito $campo $<br>"; 
							} /*else {
								echo "<strong><br>Resposta: $resposta eh totalmente inverso a $v no requisito $campo</strong><br>"; 
							}	*/
						}
					}

				} else { //se for secao => requisito => possibilidade

					
						foreach($curriculo as $campo => $resposta){
							if($resposta == $p){
								echo "Resposta: $resposta igual possibilidade $p no requisito $possibilidade $<br>"; 
							} /*else {
								echo "<strong><br>Resposta: $resposta eh totalmente inverso a $p no requisito $possibilidade</strong><br>"; 
							}	*/
						}
					
				} 
 				//unset($requisitos["$possibilidade"][$p]);
				//break;
			}

		} else { // se for "secao/requisito" => "possibilidade" (key => value)
			
						foreach($curriculo as $campo => $resposta){
							if($resposta == $possibilidades){
								echo "Resposta: $resposta igual possibilidade $possibilidades no requisito $requisito $<br>"; 
							} /*else {
								echo "<strong><br>Resposta: $resposta eh totalmente inverso a $possibilidades no requisito $requisito</strong><br>"; 
							}	*/
						}
				
		}
	//break;
	//}
	
}
	




	

?>	
</pre>
</body>
</html>


		