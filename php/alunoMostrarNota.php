<?php

	require 'conexao.php';
	$conn = conectar();
	session_start();
	
	// capturar parametros e trasformar em um array
	$cpf = $_SESSION['cpf'];
	$materia = $_POST['materia'];
	
	// aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
	$query = "SELECT * FROM `nota` WHERE `aluno`=? AND `materia`=? ORDER BY `bimestre`";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("is", $cpf, $materia);
	$stmt->execute();
	$result = $stmt->get_result();
	
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
	
	// aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
	$query = "SELECT valor,bimestre FROM `nota` WHERE `aluno`=? AND `materia`=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("is", $cpf, $materia);
	$stmt->execute();
	$result = $stmt->get_result();
	
	$soma = [
	1 => 0,
	2 => 0,
	3 => 0,
	4 => 0
	];
	
	$bim = [
	1 => 0,
	2 => 0,
	3 => 0,
	4 => 0
	];
	
	while($row = $result->fetch_assoc()){
		$soma[$row['bimestre']] += $row['valor'];
		++$bim[$row['bimestre']];
	}
	
	$media = "";
	
	foreach ($soma as $key => $value) {
		if($value!=0){
			$calc = $soma[$key]/$bim[$key];
			$media = $media."Média do ".$key."ºBIM: ".round($calc, 1)."<br>";
		}else{
			$media = $media."Média do ".$key."ºBIM: ".$value."<br>";
		}
	}
	
	$data = [
		$tabela,
		$media
	];
	
	echo json_encode($data);

?>