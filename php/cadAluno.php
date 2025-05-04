<?php
	
	// conectar com o banco de dados
	
	require "conexao.php";
	$conn = conectar();
	
	// capturar parametros e trasformar em um array
	$cpf = $_POST['cpf'];
	$nome = $_POST['nome'];
	$senha = $_POST['senha'];
	$confirmar = $_POST['confirmar'];
	$nascimento = $_POST['nascimento'];
	$genero = $_POST['genero'];
	$classe = $_POST['classe'];
	
	$args = array($cpf, $nome, $senha, $confirmar, $nascimento, $genero, $classe);
	
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
	
	// verificar se o cpf ja foi cadastrado
	// como professor
	$query = "SELECT * FROM professor WHERE cpf=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $cpf);
	$stmt->execute();
	$result = $stmt->get_result();
	$data = $result->fetch_assoc();
	
	if ($data != NULL){
		$result1 = true;
	}else{
		$result1 = false;
	}
	
	// como aluno
	$query = "SELECT * FROM aluno WHERE cpf=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $cpf);
	$stmt->execute();
	$result = $stmt->get_result();
	$data = $result->fetch_assoc();
	
	if ($data != NULL){
		$result2 = true;
	}else{
		$result2 = false;
	}
	
	// averiguar
	// cpf existente
	if ($result1 || $result2){
		$valido = false;
		echo "CPF já cadastrado na base de dados!<br>";
	}
	
	// verificar tamanho de cada string
	// cpf
	if (strlen("".$cpf) > 11){
		$valido = false;
		echo "CPF longo demais!<br>";
	}
	
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
		$query = "INSERT INTO `aluno`(`cpf`, `senha`, `nome`, `nascimento`, `genero`, `classe`) VALUES (?,?,?,?,?,?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("isssss", $cpf, $senhaHash, $nome, $nascimento, $genero, $classe);
		$stmt->execute();
	}else{
		return;
	}
	
	// ver se foi inserido com sucesso
	if ($stmt->affected_rows != 1){
		echo "Um erro inesperado aconteceu. Por favor, tente novamente.";
	}else{
		echo "Aluno cadastrado com sucesso!";
	}

?>