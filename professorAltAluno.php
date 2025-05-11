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
  	<title>Alterar dados de aluno - PORTAL DO PROFESSOR Colégio Galileu Caçapava</title>

  	<!-- bootstrap css e icons -->
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  
    <!-- css manual -->
  	<link href="css/cssMain.css" rel="stylesheet">
  
	</head>



	<body>
	  
		<!-- logo -->
		<div class="container d-flex justify-content-center">
			<img src="img/logo.png" class="col-1">
		</div>
    
		<!-- barra de navegacao -->
		<nav class="navbar navbar-expand-md sticky-top bg-dark" data-bs-theme="dark">
			
			<div class="container-fluid">
        
				<!-- botao de colapso em telas menores -->
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navegacao" aria-controls="navegacao" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
		  
				<!-- botão de lougout -->
				<button type="button" class="btn btn-light order-md-last" id="userLogout">Sair</button>
        
				<!-- a barra em si -->
				<div class="collapse navbar-collapse justify-content-md-center" id="navegacao">
				  
					<ul class="navbar-nav navbar-nav-scroll col-md-10 justify-content-md-evenly" style="--bs-scroll-height: 100px;">
            
						<li class="nav-item">
							<a href="professorMain.php" class="nav-link" aria-current="page">Painel</a>
						</li>
						
						<li class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle active" role="button" data-bs-toggle="dropdown" aria-expanded="false">Alterar dados</a>
						  
							<ul class="dropdown-menu">
							
								<li><a href="professorAltProf.php" class="dropdown-item">Seus dados</a></li>
								<li><a href="professorAltAluno.php" class="dropdown-item active">Dados de aluno</a></li>
								
							</ul>
						</li>
            
						<li class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastrar</a>
						  
							<ul class="dropdown-menu">
							
								<li><a href="professorCadAluno.php" class="dropdown-item">Aluno</a></li>
								<li><a href="professorCadProf.php" class="dropdown-item">Professor</a></li>
								
							</ul>
						</li>
						
						<li class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Notas</a>
						  
							<ul class="dropdown-menu">
							
								<li><a href="professorNota.php" class="dropdown-item">Visualizar</a></li>
								<li><a href="professorCadNota.php" class="dropdown-item">Registrar</a></li>
								
							</ul>
						</li>
            
					</ul>
          
				</div>
        
			</div>
		</nav>
		
		<!-- selecao de classe e aluno -->
		<div class="container-fluid d-flex justify-content-center col-11 col-lg-10">
			<div class="form-control mt-3">
				<div class="row container-fluid d-flex justify-content-center">
					<div class="col-5">
						<select name="escolherClasse" id="escolherClasse" class="form-select">
							<?php
							
								// procura por todas as series registradas
								$query = "SELECT * FROM serie";
								$result = $conn->query($query);
								
								echo "<option selected='selected' value=null disabled>Selecione uma classe</option>";
							
								while($row = $result->fetch_assoc()){
									echo "<option value='".$row['classe']."'>".$row['classe']."</option>";
								}
							?>
						</select>
					</div>
						
					<!-- tabela de alunos da serie relacionada -->
					<div class="col-5">
						<select name="escolherAluno" id="escolherAluno" class="form-select">
							
							
							
						</select>
					</div>
				</div>
			</div>
		</div>
		
		<!-- formulario -->
		<div class="container-fluid d-flex justify-content-center col-11 col-lg-10">
			<form class="form-control mb-3 mt-3" id="formAltAluno">
				
				<!-- campos a serem preenchidos -->
				<div class="row container-fluid d-flex justify-content-center">
					<div class="mb-3 col-md-5">
						<label for="cpf" class="form-label">CPF</label>
						<input name="cpf" type="number" class="form-control" id="cpf" value="" readonly>
					</div>
					
					<div class="mb-3 col-md-5">
						<label for="nome" class="form-label">Nome</label>
						<input name="nome" type="text" class="form-control" id="nome" placeholder="">
					</div>
				</div>
				
				<div class="row container-fluid d-flex justify-content-center">
					<div class="mb-3 col-md-5">
						<label for="senha" class="form-label">Senha</label>
						<input name="senha" type="password" class="form-control" id="senha">
					</div>
					
					<div class="mb-3 col-md-5">
						<label for="confirmar" class="form-label">Confirmar senha</label>
						<input name="confirmar" type="password" class="form-control" id="confirmar">
					</div>
				</div>
				
				<div class="row container-fluid d-flex justify-content-center">
					<div class="mb-3 col-md-4">
						<label for="nascimento" class="form-label">Nascimento</label>
						<input name="nascimento" type="date" class="form-control" id="nascimento">
					</div>
					
					<div class="mb-3 col-md-3">
						<label for="genero" class="form-label">Gênero</label>
						<select name="genero" id="genero" class="form-select">
							<option value="M">Masculino</option>
							<option value="F">Feminino</option>
							<option value="O">Outro</option>
						</select>
					</div>
					
					<div class="mb-3 col-md-3">
						<label for="classe" class="form-label">Série</label>
						<select name="classe" id="classe" class="form-select">
							<?php
							
								$query = "SELECT * FROM serie";
								$result = $conn->query($query);
								
								while($row = $result->fetch_assoc()){
									echo "<option value='".$row['classe']."'>".$row['classe']."</option>";
								}
							
							?>
						</select>
					</div>
				</div>
				
				<!-- botão pra alterar os dados -->
				<div class="row container-fluid d-flex justify-content-center mb-3 mt-2">
					<button type="button" class="btn btn-primary col-10 col-lg-6" id="altAluno">Alterar dados de aluno</button>
				</div>
			</form>
		</div>
		
		<!-- alert em caso de preenchimento incorreto -->
		<div class="container-fluid d-flex justify-content-center col-11 col-lg-10">
			<div class="form-control" id="erro">
				<p class="mt-3 text-center fs-4 fw-bolder" id="erroMensagem"></p>
			</div>
		</div>

		<!-- javascript, colocado no fim do body pra acelerar o carregamento da página -->
		<!-- bootstrap js -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
	
		<!-- jquery -->
		<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
		
		<!-- js manual -->
		<script src="js/javascript.js"></script>

	</body>
</html>