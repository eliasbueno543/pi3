<?php
	// detectar a sessão
	session_start();
	
	// desalocar todas as variáveis da sessão atual
	session_unset();
	
	// destruir a sessão atual
	session_destroy();
	
	// voltar à página inicial
	echo "index.php";
	
?>