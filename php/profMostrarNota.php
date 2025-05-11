<?php

	session_start();
	require 'conexao.php';
	$conn = conectar();
	
	// capturar parametros e trasformar em um array
	$cpf = $_POST['cpf'];
	$materia = $_POST['materia'];
	
	// retorna as notas do aluno de uma materia especifica e ordena pelo bimestre cadastrado
	$query = "SELECT * FROM `nota` WHERE `aluno`=? AND `materia`=? ORDER BY `bimestre`";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("is", $cpf, $materia);
	$stmt->execute();
	$result = $stmt->get_result();
	
	// cria uma tabela com os valores recuperados
	$tabela = "
	<div class='row'>
		<div class='col-4' style='border-bottom:3px groove;border-right:3px groove;'>BIMESTRE</div>
		<div class='col-4' style='border-bottom:3px groove;border-right:3px groove;'>MATERIA</div>
		<div class='col-4' style='border-bottom:3px groove;border-right:3px groove;'>VALOR</div>
	</div>
	";
	while($row = $result->fetch_assoc()){
		$tabela = $tabela."
		<div class='row'>
			<div class='col-4' style='border-bottom:3px groove;border-right:3px groove;'>".$row['bimestre']."</div>
			<div class='col-4' style='border-bottom:3px groove;border-right:3px groove;'>".$row['materia']."</div>
			<div class='col-4' style='border-bottom:3px groove;border-right:3px groove;'>".$row['valor']."</div>
		</div>
		";
	}
	
	// retorna valor e bimestre pra calculo de media
	$query = "SELECT valor,bimestre FROM `nota` WHERE `aluno`=? AND `materia`=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("is", $cpf, $materia);
	$stmt->execute();
	$result = $stmt->get_result();
	
	// valores de media
	$soma = [
	1 => 0,
	2 => 0,
	3 => 0,
	4 => 0
	];
	
	// contagem de nota no bimestre
	$bim = [
	1 => 0,
	2 => 0,
	3 => 0,
	4 => 0
	];
	
	// soma todas as notas ORIENTADAS PELO BIMESTRE e contabiliza a quantidade de notas em cada bimestre
	while($row = $result->fetch_assoc()){
		$soma[$row['bimestre']] += $row['valor'];
		++$bim[$row['bimestre']];
	}
	
	$media = "";
	
	// calcula a media de cada bimestre para a materia selecionada e cria uma tabela com os dados
	foreach ($soma as $key => $value) {
		if($value!=0){
			$calc = $soma[$key]/$bim[$key];
			$media = $media."Média do ".$key."ºBIM: ".round($calc, 1)."<br>";
		}else{
			$media = $media."Média do ".$key."ºBIM: ".$value."<br>";
		}
	}
	
	// tabela de media e notas individuais para retornar ao html
	$data = [
		$tabela,
		$media
	];
	
	echo json_encode($data);

?>