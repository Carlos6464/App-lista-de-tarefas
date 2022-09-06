<?php
  $acao = 'recuperarTarefasPedentes';
  require 'tarefa_controller.php';
 
  
?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>
		<!--if para dar feedback de atualizado com sucesso-->
		<?php
		 if (isset($_GET['atual']) && $_GET['atual'] == 1) {
		?>
		<div class="alert alert-success" role="alert">
		  <strong>Atualizado com sucesso!</strong>
        </div>
        <?php }?>
		<?php
		 if (isset($_GET['removido']) && $_GET['removido'] == 1) {
		?>
		<div class="alert alert-danger" role="alert">
		  <strong>Excluido com sucesso!</strong>
        </div>
        <?php }?>
		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />
                            <?php
							    foreach ($tarefas as $tarefa) {
								
								
							?>
								<div class="row mb-3 d-flex align-items-center tarefa">
									<div class="col-sm-9"><?php echo $tarefa['tarefa'] ?></div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
									     <i class="fas fa-trash-alt fa-lg text-danger" data-toggle="modal" data-target="#modalExemplo" data-whatever="<?php echo $tarefa['id']?>" data-tarefa="<?php echo $tarefa['tarefa']?>"></i>
                                         <i class="fas fa-edit fa-lg text-info "  data-toggle="modal" data-target="#exampleModal"  data-whatever="<?php echo $tarefa['id']?>" data-tarefa="<?php echo $tarefa['tarefa']?>"></i>
										 <i class="fas fa-check-square fa-lg text-success" onclick="marcarTarefa(<?php echo $tarefa['id']?>)"></i>
				
									</div>
								</div>

							<?php  }?>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		 <!--Modal de atualização de tarefas-->
		 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Atualizar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="index.php?pag=index&acao=atualizar">
				<div class="form-group">
					<input type="hidden" name="id"  class="form-control" id="recipient-name">
				</div>
				<div class="form-group">
					<label for="tarefa-text" class="col-form-label">tarefa:</label>
					<textarea name="tarefa" class="form-control" id="tarefa-text"></textarea>
				</div>
				<div class="modal-footer">
				    <button type="button" class="btn btn-secondary" data-dismiss="modal">fechar</button>
				    <button type="submit" class="btn btn-success">atualizar</button>
			   </div>
				</form>
			</div>
			
			</div>
		</div>
		</div>

		<!-- modal de exclusão de tarefas -->
		<div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Deseja realmente excluir esasa tarefa</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="index.php?pag=index&acao=excluir">
					<div class="form-group">
						<input type="hidden" name="id"  class="form-control" id="recipient-name">
					</div>
					<div class="form-group">
						<label for="tarefa-text" class="col-form-label">tarefa:</label>
						<textarea name="tarefa" class="form-control" id="tarefa-text"></textarea>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">fechar</button>
						<button type="submit" class="btn btn-danger">excluir</button>
				</div>
				</form>
			</div>
			</div>
		</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script>
			$('#exampleModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) 
			var recipient = button.data('whatever') 
			var tarefa = button.data('tarefa')
			
			var modal = $(this)
			modal.find('.modal-body input').val(recipient)
			modal.find('.modal-body textarea').val(tarefa)
			
			})


			 $('#modalExemplo').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) 
			var recipient = button.data('whatever') 
			var tarefa = button.data('tarefa')

			var modal = $(this)
			modal.find('.modal-body input').val(recipient)
			modal.find('.modal-body textarea').val( tarefa )
			})

			function marcarTarefa(id){
				location.href = "index.php?pag=index&acao=marcar&id="+id;
			}
        </script>

	</body>
</html>