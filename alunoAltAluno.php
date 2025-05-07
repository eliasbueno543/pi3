<?php

	session_start();
	require "php/conexao.php";
	$conn = conectar();

?>

<!doctype html>
<html land="pt-br">
	<head>
	
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>PORTAL DO ALUNO - Colégio Galileu Caçapava</title>

  	<!-- bootstrap css e icons -->
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  
    <!-- css manual -->
  	<link href="css/cssMain.css" rel="stylesheet">
  
	</head>



	<body>
	  
		<!-- barra de navegacao -->
		<nav class="navbar navbar-expand-md sticky-top bg-dark" data-bs-theme="dark">
			<div class="container-fluid">
			
				<!-- botao de colapso em telas menores -->
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navegacao" aria-controls="navegacao" aria-expanded="false" aria-label="Toggle navigation">
				  <span class="navbar-toggler-icon"></span>
				</button>
			  
				<button type="button" class="btn btn-light order-md-last" id="userLogout">Sair</button>
			
				<!-- a barra em si -->
				<div class="collapse navbar-collapse justify-content-md-center" id="navegacao">
				  
					<ul class="navbar-nav navbar-nav-scroll col-md-10 justify-content-md-evenly" style="--bs-scroll-height: 100px;">
					
						<!-- itens -->
						
						<!-- exemplo de item puro
						<li class="nav-item">
							<a href="#" class="nav-link active" aria-current="page">Wow</a>
						</li>
						-->
						
						<li class="nav-item">
							<a href="alunoMain.php" class="nav-link" aria-current="page">Painel</a>
						</li>
						
						<li class="nav-item">
							<a href="alunoNota.php" class="nav-link" aria-current="page">Notas</a>
						</li>
						
						<li class="nav-item">
							<a href="alunoAltAluno.php" class="nav-link active" aria-current="page">Mudar dados</a>
						</li>
					
						<li class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Aluno</a>
						  
							<ul class="dropdown-menu">
							
								<li><a href="#" class="dropdown-item">Boletim</a></li>
								<li><a href="#" class="dropdown-item">Dados pessoais</a></li>
								<li><a href="#" class="dropdown-item">Professores</a></li>
							
							</ul>
						</li>
					
						<li class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Biblioteca</a>
						  
							<ul class="dropdown-menu">
							
								<li><a href="#" class="dropdown-item">Arquivos</a></li>
								<li><a href="#" class="dropdown-item">Material didático</a></li>
							
							</ul>
						</li>
					
						<li class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Notas</a>
						  
							<ul class="dropdown-menu">
							
								<li><a href="#" class="dropdown-item">Atividades e avaliações</a></li>
								<li><a href="#" class="dropdown-item">Cronograma</a></li>
								<li><a href="#" class="dropdown-item">Presença</a></li>
							
							</ul>
						</li>
					
					</ul>
				  
				</div>
			
			</div>
		</nav>
		
		<!-- info -->
		<!-- formulario -->
		<div class="container-fluid d-flex justify-content-center">
			<form class="col-10" id="formAltAluno">
				
				<!-- campos a serem preenchidos -->
				<div class="row container-fluid d-flex justify-content-center">
					<div class="mb-3 col-md-5">
						<label for="cpf" class="form-label">CPF</label>
						<input name="cpf" type="number" class="form-control" id="cpf" value="<?php echo $_SESSION['cpf']; ?>" readonly>
					</div>
					
					<div class="mb-3 col-md-5">
						<label for="nome" class="form-label">Nome</label>
						<input name="nome" type="text" class="form-control" id="nome" value="<?php
							
							$query = 'SELECT `nome` FROM `aluno` WHERE `cpf`=?';
							$stmt = $conn->prepare($query);
							$stmt->bind_param("i", $_SESSION['cpf']);
							$stmt->execute();
							$result = $stmt->get_result();
							$data = $result->fetch_assoc();
							echo $data['nome'];
							
						?>" readonly>
					</div>
				</div>
				
				<div class="row container-fluid d-flex justify-content-center">
					<div class="mb-3 col-md-5">
						<label for="senha" class="form-label">Senha</label>
						<input name="altAlunoSenha" type="password" class="form-control" id="altAlunoSenha">
					</div>
					
					<div class="mb-3 col-md-5">
						<label for="confirmar" class="form-label">Confirmar senha</label>
						<input name="altAlunoConfirmar" type="password" class="form-control" id="altAlunoConfirmar">
					</div>
				</div>
				
				<!-- botão pra alterar os dados -->
				<div class="row container-fluid d-flex justify-content-center">
					<button type="button" class="btn btn-primary col-10 col-lg-6" id="alunoAltAluno">Alterar dados</button>
				</div>
			</form>
		</div>
		
		<!-- erros de formulario -->
		<p class="" id="erroMensagem"></p>

		<!-- javascript, colocado no fim do body pra acelerar o carregamento da página -->
		
		<!-- bootstrap js -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
	
		<!-- jquery -->
		<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
		
		<!-- js manual -->
		<script src="js/javascript.js"></script>

	</body>
</html>