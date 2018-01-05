<?php
	/**
	*	Recebe os requisitos e o curriculo 
	*	Avalia o curriculo para ver se houve match entre os requisitos
	*	e os dados do curriculo
	*	Retorna o nome do requisito em caso de match (array)
	*/
	
	function check_match($requisitos, $curriculo){
		
		$matches; //contador de match

		foreach ($requisitos as $secao => $requisito) { //percorre os requisitos
		
			if (!is_array($requisitos[$secao]) ) { // SE $secao NAO FOR ARRAY (portanto, um requisito simples)

				if ($requisito === $curriculo[$secao]) {

					$matches[] = $secao;

				} elseif ($requisito === "indiferente") {

					echo "<br>$secao eh indiferente<br>";

				} elseif ($secao === "salario_pretendido") {

					if ($curriculo[$secao] <= $requisito){

						$matches[] = $secao;
						
					}
				}

			} else { // SE $secao FOR ARRAY (ou seja, uma secao que e um requisito composto por subrequisitos)

				foreach ($requisito as $r => $p) { //percorre os subrequisitos

					//$r eh o nome do requisito
					//$p eh a possibilidade definida para o requisito em questao

					if ($p === "indiferente") { // SE $p for indiferente

						echo "<br>$r eh indiferente<br>";

					} elseif ( $p === $curriculo[$r] ){ //SE der match
						
						$matches[] = $r;

					} elseif (is_array($p)){ //Se $p for um array de possibilidades
						
						foreach ($p as $k => $v) { //percorre $p sendo $v uma possibilidade
							
							if ($curriculo[$r] === $v){ //SE der match

								$matches[] = $r;

							}

						}

					}

				}

			}

		}

		return $matches;
	}