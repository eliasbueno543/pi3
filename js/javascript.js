// ajax login
$(document).ready(function(){
	
	// como professor
	$('#entrarProf').click(function(){
		// enviar formulario sem dar refresh na pagina
		$.ajax({
			type: 'post',
			url: 'php/login.php',
			data: $('#formLoginProf').serialize(),
			success: function(data, status){
				// detectar dados incorretos fornecidos
				if (data == false){
					$('#erroMensagem').html("CPF ou SENHA incorretos!")
				}else{
					// alert(data); // teste
					// enviar para página portal correta
					location.replace(data);
				}
			},
			error: function(data, status){
				alert('error');
			}
		});
	});
	
	// como aluno
	$('#entrarAluno').click(function(){
		// enviar formulario sem dar refresh na pagina
		$.ajax({
			type: 'post',
			url: 'php/login.php',
			data: $('#formLoginAluno').serialize(),
			success: function(data, status){
				// detectar dados incorretos fornecidos
				if (data == false){
					$('#erroMensagem').html("CPF ou SENHA incorretos!")
				}else{
					// alert(data); // teste
					// enviar para página portal correta
					location.replace(data);
				}
			},
			error: function(data, status){
				alert('error');
			}
		});
	});
});

// ajax logout (nao precisa de js no momento mas ja fazendo como js pra facilitar possiveis implementacoes futuras
$(document).ready(function(){
	$('#userLogout').click(function(){
		$.ajax({
			url: 'php/logout.php',
			success: function(data,status){
				// alert(data); // teste
				// enviar para pagina inicial
				location.replace(data);
			},
			error: function(data,status){
				alert('error');
			}
		});
	});
});

// cadastrar professor
$(document).ready(function(){
	$('#cadProf').click(function(){
		// enviar formulario sem dar refresh na pagina
		$.ajax({
			type: 'post',
			url: 'php/cadProf.php',
			data: $('#formCadProf').serialize(),
			success: function(data, status){
				// cadastrou
				if (data == "Professor cadastrado com sucesso!"){
					alert(data);
					// refresh na pagina
					location.replace('professorCadProf.php');
					
				// erro na request
				}else if(data == "Um erro inesperado aconteceu. Por favor, tente novamente."){
					alert(data);
					
				// formulario preenchido incorretamente, lista quais erros foram cometidos
				}else{
					$('#erroMensagem').html(data);
				}
			},
			error: function(data, status){
				alert('error');
			}
		});
	});
});

// alterar dados professor
$(document).ready(function(){
	$('#altProf').click(function(){
		// enviar formulario sem dar refresh na pagina
		$.ajax({
			type: 'post',
			url: 'php/altProf.php',
			data: $('#formAltProf').serialize(),
			success: function(data, status){
				// cadastrou
				if (data == "Dados alterados com sucesso!"){
					alert(data);
					// refresh na pagina
					location.replace('professorMain.php');
					
				// erro na request
				}else if(data == "Um erro inesperado aconteceu. Por favor, tente novamente."){
					alert(data);
					
				// formulario preenchido incorretamente, lista quais erros foram cometidos
				}else{
					$('#erroMensagem').html(data);
				}
			},
			error: function(data, status){
				alert('error');
			}
		});
	});
});

// cadastrar aluno
$(document).ready(function(){
	$('#cadAluno').click(function(){
		// enviar formulario sem dar refresh na pagina
		$.ajax({
			type: 'post',
			url: 'php/cadAluno.php',
			data: $('#formCadAluno').serialize(),
			success: function(data, status){
				// cadastrou
				if (data == "Aluno cadastrado com sucesso!"){
					alert(data);
					// refresh na pagina
					location.replace('professorCadAluno.php');
					
				// erro na request
				}else if(data == "Um erro inesperado aconteceu. Por favor, tente novamente."){
					alert(data);
					
				// formulario preenchido incorretamente, lista quais erros foram cometidos
				}else{
					$('#erroMensagem').html(data);
				}
			},
			error: function(data, status){
				alert('error');
			}
		});
	});
});

// alterar dados aluno selecionar aluno
$(document).ready(function(){
	// select num1 é ativado
	var selOne = null;
	$('#escolherClasse').change(function(){
		selOne = $('#escolherClasse').find(":selected").val();
		$.ajax({
			type: 'post',
			url: 'php/altAlunoSelect.php',
			data: {
				selOne: selOne
			},
			success: function(data, status){
				$('#escolherAluno').html(data);
				// alert(data);
			},
			error: function(data, status){
				alert(data+status)
			}
		});
	});
	
	// select num2 é ativado
	var selTwo = null;
	$('#escolherAluno').change(function(){
		selTwo = $('#escolherAluno').find(":selected").val();
		if (selTwo != null){
			// alert(selTwo);
			$.ajax({
			type: 'post',
			url: 'php/altAlunoSelect.php',
			data: {
				selTwo: selTwo
			},
			success: function(data, status){
				var alunoArray = JSON.parse(data);
				// alert(ar['nome']);
				
				document.getElementById('cpf').value = alunoArray['cpf'];
				document.getElementById('nome').placeholder = alunoArray['nome'];
				document.getElementById('genero').value = alunoArray['genero'];
				document.getElementById('classe').value = alunoArray['classe'];
				
			},
			error: function(data, status){
				alert(data+status)
			}
		});
		}
	});
});

// alterar dados aluno
$(document).ready(function(){
	$('#altAluno').click(function(){
		// enviar formulario sem dar refresh na pagina
		$.ajax({
			type: 'post',
			url: 'php/altAluno.php',
			data: $('#formAltAluno').serialize(),
			success: function(data, status){
				// cadastrou
				if (data == "Dados alterados com sucesso!"){
					alert(data);
					// refresh na pagina
					location.replace('professorMain.php');
					
				// erro na request
				}else if(data == "Um erro inesperado aconteceu. Por favor, tente novamente."){
					alert(data);
					
				// formulario preenchido incorretamente, lista quais erros foram cometidos
				}else{
					$('#erroMensagem').html(data);
				}
			},
			error: function(data, status){
				alert('error');
			}
		});
	});
});