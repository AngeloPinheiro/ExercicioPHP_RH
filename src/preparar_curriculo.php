<?php
   //Depende das funcoes
   require_once 'calcular_idade.php';
   require_once 'array_unshift_assoc.php';
   require_once 'corrigir_case.php';
   //require_once 'pegar_curriculo.php';
   
   /**
   *
   **/
   function preparar_curriculo(&$form){
		
		//Retira o nome do formulario
		unset($form["nome"]);

   		//Retira o campo endereco
   		unset($form["endereco"]);

   		//Pega a idade 
   		$idade = calcular_idade($form["data_nascimento"]);

   		//Retira "data_nascimento" do array
   		unset($form["data_nascimento"]);

   		//Adiciona a idade no lugar de data de nascimento
   		array_unshift_assoc($form, 'idade', $idade);

   		//Padroniza o case do form
   		corrigir_case($form);
   		
	}