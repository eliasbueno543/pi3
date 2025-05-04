<!doctype html>
<html land="pt-br">
	<head>
	
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>PORTAL - Colégio Galileu Caçapava</title>

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
						  <a href="professorMain.php" class="nav-link active" aria-current="page">Painel</a>
						</li>
            
						<li class="nav-item dropdown">
						  <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Cadastrar</a>
						  
						  <ul class="dropdown-menu">
							
							<li><a href="professorCadAluno.php" class="dropdown-item">Aluno</a></li>
							<li><a href="professorCadProf.php" class="dropdown-item">Professor</a></li>
							
						  </ul>
						</li>
            
					</ul>
          
				</div>
        
			</div>
		</nav>

		<!-- bootstrap js, colocado no fim do body pra acelerar o carregamento da página -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

	</body>
</html>