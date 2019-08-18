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
		<h1 class="text-center">Opa!!!</h1>
		<div class="col-md-12">
			<div class="row">
				<div class="alert alert-danger text-center">
					<?= $mensagem; ?>
				</div>
			</div>
			<div class="row text-center">
				<td><!--  -->
					<a href="javascript:history.go(-1)" /><< Voltar</a>
				</td>
				<!-- <td><?= anchor('', 'Página Inicial');  ?></td> -->				
				<!-- <p><a href="javascript:history.go(-1)" title="Return"><button type='button'>Voltar</button></a></p>	 -->
				<!-- <a href='javascript:void(0);' onclick=window.open();></a> -->
						
			</div>
		</div>	
	</div>
</body>
</html>