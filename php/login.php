<?php
	
	// escolher entre login de aluno ou professor
	if ($_POST['action'] == "loginAluno"){
		$cpf = $_POST['alunoCpf'];
		$senha = $_POST['alunoSenha'];
		$target = "aluno";
	}elseif($_POST['action'] == "loginProfessor"){
		$cpf = $_POST['professorCpf'];
		$senha = $_POST['professorSenha'];
		$target = "professor";
	}else{
		return "Algo de errado aconteceu";
	}
	
	// estabelecer conexao
	require "conexao.php";
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
			// cria uma sessao para armazenamento de cookies
			session_start();
			$_SESSION['cpf'] = $cpf;
			// indica a pagina principal do aluno ou professor (definido por $target) para redirecionar apos sucesso de login
			echo $target."Main.php";
		}
	}else{
		// retornar false para a função jquery lança uma mensagem de erro
		echo false;
	}

?>