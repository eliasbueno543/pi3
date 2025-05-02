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

    <!-- corpo principal -->
  	<div class="container">
      
      <!-- colapsar o fomulario de login -->
      <div class="accordion" id="mostrarForm">
        
        <div class="accordion-item">
          
          <!--- cabeçalho: ponto de início do forumlário e posição dos botões -->
          <div class="accordion-header">
            
            <!-- deixar o formato e texto dos botões responsívos ao tamanho do display -->
            <!-- os botões fazem o formulario de login aparecer, apenas um a qualquer momento-->
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-evenly text-center">
        
              <button type="button" class="btn btn-dark col-10 mx-auto col-sm-5" data-bs-toggle="collapse" data-bs-target="#loginProf" aria-expanded="false" aria-controls="loginProf">
                <h1><i class="bi bi-book-half"></i>
                <br><span class="d-none d-lg-block align-items-center">ENTRAR COMO</span>PROFESSOR</h1>
              </button>
              
              <button type="button" class="btn btn-dark  col-10 mx-auto col-sm-5" data-bs-toggle="collapse" data-bs-target="#loginAluno" aria-expanded="false" aria-controls="loginAluno">
                <h1><i class="bi bi-backpack2-fill"></i>
                <br><span class="d-none d-lg-block align-items-center">ENTRAR COMO</span>ALUNO</h1>
              </button>
              
            </div>
            
          </div>
          
          <!-- formulario de login professor/adm -->
          <div id="loginProf" class="accordion-collapse collapse" data-bs-parent="#mostrarForm">
            
            <div class="accordion-body">
              
              <!-- testcase -->
              <form>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
              
            </div>
            
          </div>
          
          <!-- formulatio de login aluno -->
          <div id="loginAluno" class="accordion-collapse collapse" data-bs-parent="#mostrarForm">
            
            <div class="accordion-body">
              
              <!-- testcase -->
              <form>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">asdadsada</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  <div id="emailHelp" class="form-text">Waaaaaaaaa.</div>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Pasadadaddadadadadadadadadd</label>
                  <input type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <a href="alunoMain.php"><button type="button" class="btn btn-primary">Submit</button></a>
              </form>
              
            </div>
            
          </div>
          
        </div>
        
      </div>
  
  	</div>
  
    <!-- bootstrap js, colocado no fim do body pra acelerar o carregamento da página -->
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

	</body>
</html>