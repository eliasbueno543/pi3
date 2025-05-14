<?php
	// conexao
	require 'conexao.php';
	$conn = conectar();
	session_start();
	
	// capturar parametros e trasformar em um array
	$cpf = @$_POST['nota2Cpf'];
	$prof = @$_POST['notaProf'];
	$materia = @$_POST['notaMateria'];
	$bimestre = @$_POST['notaBim'];
	$valor = @$_POST['notaValor'];
	
	$args = array($cpf, $prof, $materia, $bimestre, $valor);
	
	// limpeza dos dados capturados
	// tirar espaços em branco do início/final de cada parametro
	
	$args = array_map(function($value){
		return trim($value);
	}, $args);
	
	// var de averiguacao de validez do cadastro
	$valido = true;
	
	// ver se algum valor está vazio
	foreach($args as $value){
		if(empty($value) && $value!=0){
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
	
	// verificar validez dos dados passados
	if ($valido == true){
		// inserir dados na database
		$query = "INSERT INTO `nota`(`aluno`, `materia`, `bimestre`, `valor`, `profResponsavel`) VALUES (?,?,?,?,?)";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("isiii", $cpf, $materia, $bimestre, $valor, $prof);
		$stmt->execute();
	}else{
		return;
	}
	
	// ver se foi inserido com sucesso
	if ($stmt->affected_rows != 1){
		echo "Um erro inesperado aconteceu. Por favor, tente novamente.";
	}else{
		echo "Nota atribuída ao aluno!";
	}

?>