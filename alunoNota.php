<?php

	session_start();

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
			  
				<button type="button" class="btn btn-light order-md-last" id="userLogout">Sair</button>
			
				<!-- a barra em si -->
				<div class="collapse navbar-collapse justify-content-md-center" id="navegacao">
				  
					<ul class="navbar-nav navbar-nav-scroll col-md-10 justify-content-md-evenly" style="--bs-scroll-height: 100px;">
					
						<!-- itens -->
						<li class="nav-item">
							<a href="alunoMain.php" class="nav-link" aria-current="page">Painel</a>
						</li>
						
						<li class="nav-item">
							<a href="alunoNota.php" class="nav-link active" aria-current="page">Notas</a>
						</li>
						
						<li class="nav-item">
							<a href="alunoAltAluno.php" class="nav-link" aria-current="page">Mudar dados</a>
						</li>
					
					</ul>
				  
				</div>
			
			</div>
		</nav>
		
		<!-- info -->
		<div class="container d-block d-lg-flex justify-content-evenly mt-3 mb-3 form-control">
			<div class="col-12 col-lg-5 mb-3 mt-3">
			
				<select name="notaAlunoMateria" id="notaAlunoMateria" class="form-select mb-3">
					<?php
					
						require "php/conexao.php";
						$conn = conectar();
						$query = "SELECT * FROM materia";
						$result = $conn->query($query);
						
						echo "<option selected='selected' value=null disabled>Matéria</option>";
					
						while($row = $result->fetch_assoc()){
							echo "<option class='text-capitalize' value='".$row['nome']."'>".$row['nome']."</option>";
						}
					?>
				</select>
				
				<!-- botão -->
				<div class="row container-fluid d-flex justify-content-center mb-3">
					<button type="button" class="btn btn-primary col-10 col-lg-6" id="mostrarAlunoNota">Mostrar notas</button>
				</div>
				
				<!-- nota media -->
				<div class="col-12 form-control">
					<div class="text-start fs-4 font-monospace" id="notaTotal"></div>
				</div>
				
			</div>
			
			<!-- notas -->
			<div class="col-12 col-lg-5 mt-3">
				<div class="col-12 form-control mb-3">
					<div class="text-start fs-4 font-monospace" id="visualNota"></div>
				</div>
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