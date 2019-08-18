<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $titulo ?> - Cadastro de Pessoas</title>
	<?= link_tag('assets/bootstrap/css/bootstrap.min.css') ?>
	<?= link_tag('assets/bootstrap/css/bootstrap-theme.min.css') ?>
	<?= link_tag('plugins/select2-3.4.5/select2.css') ?>
	<?= link_tag('plugins/select2-3.4.5/select2-bootstrap.css') ?>
	<?= link_tag('plugins/select2-3.4.5/select2.min.js') ?>
	
	
	<style>
		.erro {
			color: #f00;
		}
	</style>

	<!-- -->
	 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	 <script>

	 	var base_url = '<?=base_url() ?>';



	 	function buscaCampos(id_estado){
	 		$.post(base_url+"index.php/cidade/buscaCidadeEstado", {
	 			id_estado : id_estado
	 		}, function(data){
	 		if(data!=null){
	 			
	 			$("#id_cidade").html(data);
	 		}
	 			//alert('-->'+data);
	 		});
	 	}

		$(function () {
			$('form').on('submit', function (e) {
				e.preventDefault();
				$.ajax({
					type: 'post',
					url: base_url+"index.php/cadastro/store",
					data: $('form').serialize(),
					success: function (data) {
						const { erro: {nome, email, celular, estado, cidade}, success, mensagem} = JSON.parse(data);
						if (!success && (mensagem === '' || mensagem === undefined || mensagem === null)) {
							$(".erroNome").text(nome === undefined || nome === null ? '' : nome);
							$(".erroEmail").text(email === undefined || email === null ? '' : email);
							$(".erroCelular").text(celular === undefined || celular === null ? '' : celular);
							$(".erroEstado").text(estado === undefined || estado === null ? '' : estado);
							$(".erroCidade").text(cidade === undefined || cidade === null ? '' : cidade);
						} else {
							let typeAlert = '';								
							$(".erroNome").text('');
							$(".erroEmail").text('');
							$(".erroCelular").text('');
							$(".erroEstado").text('');
							$(".erroCidade").text('');
							if (!success && (mensagem != undefined && mensagem != null)) {
								$("#gravado").addClass("alert alert-danger").text(mensagem);
								typeAlert = 'danger';
								$(".erroEmail").text('Por favor, insira um email diferente!');
								$(".erroCelular").text('Por favor, insira um número de celular diferente!');
							} else {
								$("#gravado").addClass("alert alert-success").text(mensagem);
								$("#nome").val('');
								$("#email").val('');
								$("#celular").val('');
								$('#id_estado  option[value=""]').prop("selected", true);
								$('#id_cidade  option[value=""]').prop("selected", true);
								typeAlert = 'success';
							}
							
							setTimeout(function(){
								$("#gravado").removeClass(`alert alert-${typeAlert}`).text('');
							}, 3000);
						}						
					}
				});
			});
		});		

	 </script>	
	 <!--  -->
</head>
<body>
	<div class="container">
		<h1 class="text-center"><?= $titulo ?></h1>
		<div class="col-md-6 col-md-offset-3">
			<div class="row">
				<div id="gravado"></div>

				<?= form_open('cadastro/store')  ?>
					<div class="form-group">
						<label for="nome">Nome</label>
						<br>
						<span class="erro erroNome"></span>
						<input type="text" name="nome" id="nome" class="form-control" value="" autofocus='true' />
					</div>

					<div class="form-group">
						<label for="email">E-mail</label>
						<br>
						<span class="erro erroEmail"></span>
						<input type="email" name="email" id="email" class="form-control" value="" />
					</div>
					
					<div class="form-group">
						<label for="celular">Celular</label>
						<br>
						<span class="erro erroCelular"></span>
						<input type="text" name="celular" id="celular" class="form-control" value="" />
					</div>					
					
					<div class="form-group">					
						<label for="estado">Escolha o Estado:</label>
						<br>
						<span class="erro erroEstado"></span>
						<select name="estado" id="id_estado" class="form-control" onchange="buscaCampos($(this).val())">
							<?=$selecionaEstado; ?>
						</select>
					
						<label>Escolha a Cidade:</label>
						<br>
						<span class="erro erroCidade"></span>					
						<select name="cidade" id="id_cidade" selected="selected" class="form-control"></select>											
					</div>					 
				
					<div class="form-group text-right">
						<input type="submit" value="Salvar" class="btn btn-success" />
					</div>
					<input type='hidden' name="id" value="">
				<?= form_close(); ?>
			</div>
			<div class="row"><hr></div>
			<div class="row">
				<?= anchor('', 'Página Inicial') ?>
			</div>
		</div>	
	</div>
</body>
</html>