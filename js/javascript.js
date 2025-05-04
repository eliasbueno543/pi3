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