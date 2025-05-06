<?php

	require "conexao.php";
	$conn = conectar();
	
	// verificar primeiro select
	if(isset($_POST['selOne']) && !isset($_POST['selTwo'])){
		$selOne = $_POST['selOne'];
		$selOneReturn = "<option selected='selected' value=null disabled>Selecione uma classe</option>\n";
		
		$query = "SELECT cpf,nome FROM aluno WHERE classe=?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("s", $selOne);
		$stmt->execute();
		$result = $stmt->get_result();
		
		while($data = $result->fetch_assoc()){
			$selOneReturn = $selOneReturn."<option value='".$data['cpf']."'>".$data['cpf']." - ".$data['nome']."</option>\n";
		}
		
		echo $selOneReturn;
		
	// verificar segundo select
	}elseif(isset($_POST['selTwo'])){
		$selTwo = $_POST['selTwo'];
		
		$query = "SELECT * FROM `aluno` WHERE cpf=?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("i", $selTwo);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = $result->fetch_assoc();
		
		echo json_encode($data);
	}

?>