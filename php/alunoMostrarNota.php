<?php

	require 'conexao.php';
	$conn = conectar();
	session_start();
	
	// capturar parametros e trasformar em um array
	$cpf = $_SESSION['cpf'];
	$materia = $_POST['materia'];
	
	// aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
	$query = "SELECT * FROM `nota` WHERE `aluno`=? AND `materia`=?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("is", $cpf, $materia);
	$stmt->execute();
	$result = $stmt->get_result();
	
	$data = "bimestre - materia - valor<br>";
	while($row = $result->fetch_assoc()){
		$data = $data.$row['bimestre']." - ".$row['materia']." - ".$row['valor']."<br>";
	}
	
	
	echo $data;

?>