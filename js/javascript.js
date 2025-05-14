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
					$('#erroMensagem').html("CPF ou SENHA incorretos!");
				}else{
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

// cadastrar nota de aluno FORMULARIO DE SELECIONAR ALUNO ANTES DE ALTERAR OU CADASTRAR
$(document).ready(function(){
	// serie do aluno e selecionada
	var selOne = null;
	$('#notaClasse').change(function(){
		selOne = $('#notaClasse').find(":selected").val();
		$.ajax({
			type: 'post',
			url: 'php/altAlunoNotaSelect.php',
			data: {
				selOne: selOne
			},
			success: function(data, status){
				$('#notaAluno').html(data);
				// alert(data);
			},
			error: function(data, status){
				alert(data+status)
			}
		});
	});
	
	// nome do aluno e selecionado
	var selTwo = null;
	$('#notaAluno').change(function(){
		selTwo = $('#notaAluno').find(":selected").val();
		if (selTwo != null){
			$.ajax({
			type: 'post',
			url: 'php/altAlunoNotaSelect.php',
			data: {
				selTwo: selTwo
			},
			success: function(data, status){
				// retornado array com os dados do aluno
				var alunoArray = JSON.parse(data);
				
				$('#notaCpf').html(alunoArray['cpf']);
				$('#notaNome').html(alunoArray['nome']);
				$('#notaGenero').html(alunoArray['genero']);
				$('#notaNascimento').html(alunoArray['nascimento']);
				$('#nota2Classe').html(alunoArray['classe']);
				
				// define o valor de um campo do html para mostrar os dados do aluno
				document.getElementById('nota2Cpf').value = alunoArray['cpf'];
				
			},
			error: function(data, status){
				alert(data+status)
			}
		});
		}
	});
	
	// select 3, usado para visualizar notas sem altera-las
	$('#mostrarNota').click(function(){
		$.ajax({
			type: 'post',
			url: 'php/profMostrarNota.php',
			data: {
				cpf: document.getElementById('nota2Cpf').value,
				materia: document.getElementById('notaMateria').value
			},
			success: function(data,status){
				var notaArray = JSON.parse(data);
				$('#visualNota').html(notaArray[0]);
				$('#notaTotal').html(notaArray[1]);
			},
			error: function(data,status){
				alert('error: '+data);
			}
		});
	});
});

// aluno mostrar Nota
$(document).ready(function(){
	$('#mostrarAlunoNota').click(function(){
		$.ajax({
			type: 'post',
			url: 'php/alunoMostrarNota.php',
			data: {
				materia: document.getElementById('notaAlunoMateria').value
			},
			success: function(data,status){
				// array com os dados de nota do aluno
				var notaArray = JSON.parse(data);
				$('#visualNota').html(notaArray[0]);
				$('#notaTotal').html(notaArray[1]);
			},
			error: function(data,status){
				alert('error: '+data);
			}
		});
	});
});

// cadastrar nota de aluno
$(document).ready(function(){
	// apertar botao
	$('#notaCad').click(function(){
		$.ajax({
			type: 'post',
			url: 'php/cadNota.php',
			data: $('#formNota').serialize(),
			success: function(data,status){
				// cadastrou
				if (data == "Nota atribuída ao aluno!"){
					alert(data);
					// refresh na pagina
					location.replace('professorCadNota.php');
					
				// erro na request
				}else if(data == "Um erro inesperado aconteceu. Por favor, tente novamente."){
					alert(data);
					
				// formulario preenchido incorretamente, lista quais erros foram cometidos
				}else{
					$('#erroMensagem').html(data);
				}
			},
			error: function(data,status){
				alert('error: '+data);
			}
		})
	});
});

// alterar dados aluno FORMULARIO DE SELECIONAR ALUNO ANTES DE ALTERAR OU CADASTRAR
$(document).ready(function(){
	// serie do aluno e selecionada
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
			},
			error: function(data, status){
				alert(data+status)
			}
		});
	});
	
	// nome do aluno e selecionado
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
				// array com os dados do aluno
				var alunoArray = JSON.parse(data);
				
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

// aluno alterar dados aluno
$(document).ready(function(){
	$('#alunoAltAluno').click(function(){
		// enviar formulario sem dar refresh na pagina
		$.ajax({
			type: 'post',
			url: 'php/alunoAltAluno.php',
			data: $('#formAltAluno').serialize(),
			success: function(data, status){
				// cadastrou
				if (data == "Dados alterados com sucesso!"){
					alert(data);
					// refresh na pagina
					location.replace('alunoMain.php');
					
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