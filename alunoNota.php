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
							<a href="alunoNota.php" class="nav-link active" aria-current="page">Notas</a>
						</li>
						
						<li class="nav-item">
							<a href="alunoAltAluno.php" class="nav-link" aria-current="page">Mudar dados</a>
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
		<div class="container d-block d-lg-flex justify-content-evenly">
			<div class="card col-12 col-lg-5">
				<!-- user info -->
				<div class="card-body fs-2 text-start">
					<span class='text-uppercase'>cpf: </span><span class='text-uppercase' name="notaCpf" id="notaCpf">?</span><br>
					<span class='text-uppercase'>nome: </span><span class='text-uppercase' name="notaNome" id="notaNome">?</span><br>
					<span class='text-uppercase'>nascimento: </span><span class='text-uppercase' name="notaNascimento" id="notaNascimento">?</span><br>
					<span class='text-uppercase'>gênero: </span><span class='text-uppercase' name="notaGenero" id="notaGenero">?</span><br>
					<span class='text-uppercase'>classe: </span><span class='text-uppercase' name="nota2Classe" id="nota2Classe">?</span><br>
				</div>
			</div>
			
			<span class="d-block d-lg-none"><br></span>
			
			<div class="col-12 col-lg-5">
				<select name="notaAlunoMateria" id="notaAlunoMateria" class="form-select mb-3">
					<?php
						$query = "SELECT * FROM materia";
						$result = $conn->query($query);
						
						echo "<option selected='selected' value=null disabled>Matéria</option>";
					
						while($row = $result->fetch_assoc()){
							echo "<option class='text-capitalize' value='".$row['nome']."'>".$row['nome']."</option>";
						}
					?>
				</select>
				
				<!-- botão -->
				<div class="row container-fluid d-flex justify-content-center">
					<button type="button" class="btn btn-primary col-10 col-lg-6" id="mostrarAlunoNota">Mostrar notas</button>
				</div>
				
				<!-- notas -->
				<div class="col-12 form-control">
					<div id="visualNota"></div>
				</div>
			</div>
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