<?php

	require "php/funcoes.php";
	
	if(!isset($_POST['submit'])){
		
	}else{
		$resultado = cadAluno($_POST['cpf'], $_POST['nome'], $_POST['senha'], $_POST['confirmar'], $_POST['nascimento'], $_POST['genero'], $_POST['classe']);
	}

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
	  
		<!-- teste de dimensionamento
		<div class="row">
			<div class="col-7 ye"><h1>amarelo</h1></div>
			<div class="col-5 re"><h1>vermelho</h1></div>
		</div>
		-->
		
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
          
				<button type="button" class="btn btn-light order-md-last"><a href="index.php">Sair</a></button>
        
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
						  <a href="professorMain.php" class="nav-link" aria-current="page">Painel</a>
						</li>
            
						<li class="nav-item dropdown">
						  <a href="#" class="nav-link dropdown-toggle active" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastrar</a>
						  
						  <ul class="dropdown-menu">
							
							<li><a href="professorCadAluno.php" class="dropdown-item active">Aluno</a></li>
							<li><a href="professorCadProf.php" class="dropdown-item">Professor</a></li>
							
						  </ul>
						</li>
            
					</ul>
          
				</div>
        
			</div>
		</nav>
		
		<!-- formulario -->
		<div class="container-fluid d-flex justify-content-center">
			<form action="" method="post" class="col-10">
							
				<!-- campos a serem preenchidos -->
				<div class="row container-fluid d-flex justify-content-center">
					<div class="mb-3 col-md-5">
						<label for="cpf" class="form-label">CPF</label>
						<input name="cpf" type="number" class="form-control" id="cpf">
					</div>
					
					<div class="mb-3 col-md-5">
						<label for="nome" class="form-label">Nome</label>
						<input name="nome" type="text" class="form-control" id="nome">
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
							
								// colocar uma opção para cada classe registrada no database
								$conn = conectar();
								$query = "SELECT * FROM serie";
								$result = $conn->query($query);
								
								while($row = $result->fetch_assoc()){
									echo "<option value='".$row['classe']."'>".$row['classe']."</option>";
								}
							
							?>
						</select>
					</div>
				</div>
				
				<!-- botão pra cadastrar -->
				<div class="row container-fluid d-flex justify-content-center">
					<input type="submit" name="submit" class="btn btn-primary col-10 col-lg-6" value="Cadastrar">
				</div>
			</form>
		</div>
		
		<?php
		
			if ((@$result != NULL) && (isset($_POST['submit']))){
				echo "<p>".$resultado."</p>";
			}
		
		?>

		<!-- bootstrap js, colocado no fim do body pra acelerar o carregamento da página -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

	</body>
</html>