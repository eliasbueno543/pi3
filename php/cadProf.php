<?php
	
	// cadastrar professor
	function cadProf($cpf, $nome, $senha, $confirmar, $nascimento, $genero){
		
		// conectar com o banco de dados
		$conn = conectar();
		
		// transformar os parametros da funcao em um array
		$args = func_get_args();
		
		// limpeza dos dados capturados
		// tirar espaços em branco do início/final de cada parametro
		
		$args = array_map(function($value){
			return trim($value);
		}, $args);
		
		// ver se algum valor está vazio
		foreach($args as $value){
			if(empty($value)){
				return "TODOS os campos devem ser preenchidos!";
			}
		}
		
		// ver se existe alguma possivel tag contendo codigo malicioso
		foreach($args as $value){
			if(preg_match("/([<|>])/", $value)){
				return "< e > NÃO SÃO permitidos!";
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
		if ($result1 || $result2){
			return "CPF já cadastrado na base de dados!";
		}
		
		// verificar tamanho de cada string
		if (strlen("".$cpf) > 11){
			return "CPF longo demais!";
		}
		
		if (strlen($senha) > 30){
			return "Senha longa demais!";
		} 
		
		if (strlen($nome) > 150){
			return "Nome longo demais!";
		}
		
		// verificar se as senhas estão iguais
		if ($senha != $confirmar){
			return "Senhas não condizem!";
		}
		
		// encriptar senha
		$senhaHash = password_hash($senha, PASSWORD_DEFAULT);
		
		// inserir dados na database
		$query = "INSERT INTO `professor`(`cpf`, `senha`, `nome`, `nascimento`, `genero`) VALUES (?,?,?,?,?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("issss", $cpf, $senhaHash, $nome, $nascimento, $genero);
		$stmt->execute();
		
		// ver se foi inserido com sucesso
		if ($stmt->affected_rows != 1){
			return "Um erro inesperado aconteceu. Por favor, tente novamente.";
		}else{
			return "Professor cadastrado com sucesso!";
		}
		
	}

?>