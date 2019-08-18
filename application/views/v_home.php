<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cadastro de Pessoas</title>
	<?= link_tag('assets/bootstrap/css/bootstrap.min.css') ?>
	<?= link_tag('assets/bootstrap/css/bootstrap-theme.min.css') ?>
</head>
<body>
	<div class="container">
		<h1 class="text-center">Cadastro de Pessoas</h1>
		<div class="col-md-12">
			<div class="row">
				<?= anchor('cadastro/create', 'Novo Cadastro', array('class' => 'btn btn-success')); ?>
			</div>
			<div class="row">
				<h3><?= $cadastros->num_rows(); ?> registros(s)</h3>
			</div>
			<div class="row">
			<? if ($cadastros->num_rows() > 0): ?>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Código</th>
							<th>Nome</th>
							<th>E-mail</th>
							<th>Celular</th>							
							<th>Cidade/UF</th>	
							<th>Data do Cadastro</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						<? foreach($cadastros -> result() as $cadastro): ?>
						<tr>
							<td>
								<span style="font-size:12px;" class="label label-default" data-toggle="" data-target=""><?= str_pad($cadastro->id, 6, 0, STR_PAD_LEFT) ?></span>       
							</td>
							<td><?= $cadastro->nome ?></td>
							<td><?= $cadastro->email ?></td>
							<td><?= $cadastro->celular ?></td>							
							<td><?= $cadastro->nom_cidade.'/'.$cadastro->sgl_estado ?></td>
							<td><?= date("d/m/Y H:m:s",strtotime( $cadastro->data_cadastro)) ?></td>
							<td><!--  -->
								<a href="#" class='confirma_exclusao' data-id="<?= $cadastro->id ?>" data-nome="<?= $cadastro->nome ?>" />Excluir</a>
							</td>
						</tr>
						<? endforeach; ?>
					</tbody>
				</table>
				<? else: ?>
					<h4>Nenhum registro cadastrado.</h4>
				<? endif; ?>
			</div>
		</div>	
	</div>
<div class="modal fade" id="modal_confirmation">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirmação de Exclusão do Resgitro</h4>
      </div>
      <div class="modal-body">
        <p>Deseja realmente excluir o registro <strong><span id="nome_exclusao"></span></strong>?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><< Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn_excluir">Ok</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?= base_url('assets/js/jquery.js') ?>"></script>	
<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>

	<script>
	
		var base_url = "<?= base_url(); ?>";
	
		$(function(){
			$('.confirma_exclusao').on('click', function(e) {
			    e.preventDefault();
			    
			    var nome = $(this).data('nome');
			    var id = $(this).data('id');
			    
			    $('#modal_confirmation').data('nome', nome);
			    $('#modal_confirmation').data('id', id);
			    $('#modal_confirmation').modal('show');
			});
			
			$('#modal_confirmation').on('show.bs.modal', function () {
			  var nome = $(this).data('nome');
			  $('#nome_exclusao').text(nome);
			});	
			
			$('#btn_excluir').click(function(){
				var id = $('#modal_confirmation').data('id');
				document.location.href = base_url + "index.php/cadastro/delete/"+id;
			});					
		});
	</script>
	
</body>
</html>