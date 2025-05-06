<?php

	// conectar com o banco de dados
	session_start();
	require "conexao.php";
	$conn = conectar();
	
	// capturar parametros e trasformar em um array
	$nome = $_POST['nome'];
	$senha = $_POST['senha'];
	$confirmar = $_POST['confirmar'];
	$nascimento = $_POST['nascimento'];
	$genero = $_POST['genero'];
	$classe = $_POST['classe'];
	$cpf = $_POST['cpf'];
	
	$args = array($nome, $senha, $confirmar, $nascimento, $genero, $classe, $cpf);
	
	// limpeza dos dados capturados
	// tirar espaços em branco do início/final de cada parametro
	$args = array_map(function($value){
		return trim($value);
	}, $args);
	
	// var de averiguacao de validez do cadastro
	$valido = true;
	
	// ver se algum valor está vazio
	foreach($args as $value){
		if(empty($value)){
			$valido = false;
			echo "TODOS os campos devem ser preenchidos!<br>";
			break;
		}
	}
	
	// ver se existe alguma possivel tag contendo codigo malicioso
	foreach($args as $value){
		if(preg_match("/([<|>])/", $value)){
			$valido = false;
			echo "< e > NÃO SÃO permitidos!<br>";
		}
	}
	
	// verificar tamanho de cada string
	// senha
	if (strlen($senha) > 30){
		$valido = false;
		echo "Senha longa demais!<br>";
	} 
	
	// nome
	if (strlen($nome) > 150){
		$valido = false;
		echo "Nome longo demais!<br>";
	}
	
	// verificar se as senhas estão iguais
	if ($senha != $confirmar){
		$valido = false;
		echo "Senhas não condizem!<br>";
	}
	
	// verificar validez dos dados passados
	if ($valido == true){
		// encriptar senha
		$senhaHash = password_hash($senha, PASSWORD_DEFAULT);
		
		// inserir dados na database
		$query = "UPDATE `aluno` SET `senha`=?,`nome`=?,`nascimento`=?,`genero`=?,`classe`=? WHERE `cpf`=?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("sssssi", $senhaHash, $nome, $nascimento, $genero, $classe, $cpf);
		$stmt->execute();
	}else{
		return;
	}
	
	// ver se foi inserido com sucesso
	if ($stmt->affected_rows != 1){
		echo "Um erro inesperado aconteceu. Por favor, tente novamente.";
	}else{
		echo "Dados alterados com sucesso!";
	}

?>