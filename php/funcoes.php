<?php

	// iniciar sessao para manter dados de login
	session_start();
	
	// acesso ao banco de dados
	function conectar(){
		
		$server = "localhost";	// nome do servidor hospedando a aplicacao
		$username = "root";	// nome para login no banco
		$password = "";			// senha para login no banco
		$db = "pi3";			// nome do banco de dados
		
		$conn = new mysqli($server, $username, $password, $db);
		
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}else{
			return $conn;
		}
		
	}
	
	
	
	// login
	function loginUser(){

		// escolher entre login de aluno ou professor
		if ($_POST['action'] == "loginAluno"){
			$cpf = $_POST['alunoCpf'];
			$senha = $_POST['alunoSenha'];
			$target = "aluno";
			// echo "yay";
		}elseif($_POST['action'] == "loginProfessor"){
			$cpf = $_POST['professorCpf'];
			$senha = $_POST['professorSenha'];
			$target = "professor";
		}
		
		// estabelecer conexao
		$conn = conectar();
		
		// checar dados
		// limpar os dados fornecidos para evitar injecao de codigo mal intencionado
		$cpf = filter_var($cpf, FILTER_SANITIZE_NUMBER_INT);
		$senha = htmlspecialchars($senha, ENT_SUBSTITUTE);
		
		// procurar pelos dados na database
		$query = "SELECT cpf,senha FROM ".$target." WHERE cpf=?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("i", $cpf);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		
		// verificar se o cpf existe
		if ($data != NULL){
			
			// verificar se a senha esta correta
			if(password_verify($senha, $data['senha']) == true){
				header("Location: ".$target."Main.php");
				exit;
			}
		}else{
			return "CPF ou SENHA incorretos!";
		}
		
	}
	
	
	
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
		
		
		
		
		return implode(", ", $args);
		
	}

?>