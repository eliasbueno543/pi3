// ajax login
$(document).ready(function(){
	$('#entrarProf').click(function(){
		// alert('yay');
		$.ajax({
			type: 'post',
			url: 'php/login.php',
			data: $('#formLoginProf').serialize(),
			success: function(data, status){
				if (data == false){
					$('#erroMensagem').html("CPF ou SENHA incorretos!")
				}else{
					// alert(data);
					location.replace(data);
				}
			},
			error: function(data, status){
				alert('error');
			}
		});
	});
});