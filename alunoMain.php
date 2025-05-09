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
							<a href="alunoMain.php" class="nav-link active" aria-current="page">Painel</a>
						</li>
						
						<li class="nav-item">
							<a href="alunoNota.php" class="nav-link" aria-current="page">Notas</a>
						</li>
						
						<li class="nav-item">
							<a href="alunoAltAluno.php" class="nav-link" aria-current="page">Mudar dados</a>
						</li>
					
					</ul>
				  
				</div>
			
			</div>
		</nav>
		
		<!-- bem vindo -->
		<div class="container d-flex justify-content-center mb-3 mt-3">
			<div class="card col-12">
				<div class="card-body fs-5 text-center">Bem-vindo(a),
				<span class="text-capitalize">
				<?php
					require 'php/conexao.php';
					$conn = conectar();
					
					$query = "SELECT * FROM aluno WHERE cpf=?";
					$stmt = $conn->prepare($query);
					$stmt->bind_param("i", $_SESSION['cpf']);
					$stmt->execute();
					$result = $stmt->get_result();
					$data = $result->fetch_assoc();
					
					echo $data['nome'];
				?>
				</span>
				</div>
			</div>
		</div>
		
		<!-- info -->
		<div class="container d-block d-lg-flex justify-content-evenly mb-3">
			<div class="card col-12 col-lg-5">
				<!-- user info -->
				<div class="card-body fs-2 text-start">
					<?php
						$query = "SELECT * FROM aluno WHERE cpf=?";
						$stmt = $conn->prepare($query);
						$stmt->bind_param("i", $_SESSION['cpf']);
						$stmt->execute();
						$result = $stmt->get_result();
						$data = $result->fetch_assoc();
						$colNames = array_keys($data);
						
						foreach($colNames as $key=>$value){
							if ($value != 'senha'){
								echo "<span class='text-uppercase'>".$value.":</span> <span class='text-capitalize'>".$data[$value]."</span><br>";
							}
						}
					?>
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