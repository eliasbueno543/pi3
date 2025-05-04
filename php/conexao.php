<?php

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

?>