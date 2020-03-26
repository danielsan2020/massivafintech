<?php 
	@session_start();
    include 'modelo/consultaTablas.php';
    $soporte = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
    $fechaCreacion = date("Y-m-d");
    //consultas de persona fisica
	$uno = $soporte->contaatraSinregistroFinal();
	
 ?>
 
 <div class="row white-bg page-heading">
	<div class="col-md-12">
		<div class="title-action"><a href="index.php?secc=dascontaf" class="btn btn-primary" > Regresar</a></div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12" >
		<?php if($EnviCo == 1){?>
			<div class="alert alert-warning text-center">Se reenvió la cotización</div>

		<?php } if($EnviCo == 2){?>
			<div class="alert alert-danger text-center">Se eliminó la cotización</div> 
		<?php }?>
	</div>
</div>

<!--seccion de contenido-->
<hr>
<div class="row white-bg">
	<div class="col-md-12">
		<div class="ibox">
            <div class="ibox-title"><h5>Contabilidad atrasada sin registro</h5></div>
                <div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
								<tr>
									<th>Folio</th>
									<th>RFC</th>
									<th>Fecha registro</th>
									<th>Correo</th>
									<th>Monto</th>
									<th class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php while($unoInfo = $uno->fetch_object()){?>
									<tr>
										<td><?php echo $unoInfo->idContaAtrasada;?></td>
										<td><?php echo $unoInfo->rfc;?></td>
										<td><?php echo $unoInfo->fechaCreacion;?></td>
										<td><?php echo $unoInfo->correo;?></td>
										<td><?php echo $unoInfo->monto;?></td>
										<td class="text-center">
											<div class="col-md-6">
												<form action="controlador/simuladorControlador.php" method="POST">
													<input type="hidden" name="accion" id="accion" value="reenviar">
													<input type="hidden" name="montoEnvia" id="montoEnvia" value="<?php echo $unoInfo->monto;?>">
													<input type="hidden" name="correEnvia" id="correEnvia" value="<?php echo $unoInfo->correo;?>">
													<button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
												</form>
											</div>
											<div class="col-md-6">
												<button class="btn btn-danger" data-toggle="modal" title="Eliminar noticia" data-target="#eliminar" data-unoo="<?php echo $unoInfo->idContaAtrasada; ?>">
													<i class="fa fa-times" title="Eliminar"></i>
												</button>
											</div>
										</td>
									</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<br>
<hr>

<!--modal para eliminar-->
<div class="modal inmodal fade" id="eliminar" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Eliminar Cotización</h4>
			</div>
			<form action="controlador/simuladorControlador.php" method="POST">
			<div class="modal-body">
				<input type="hidden" name="accion" id="accion" value="eliminar">
				<input type="hidden" name="idContaAtrasada" id="idContaAtrasada" >
    			<div class="alert alert-danger text-center">Esta de acuerdo eliminar la cotización, recuerde que al eliminarlo no habra forma de recuperar la información.</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-w-m btn-danger"> Eliminar </button>
				<button type="button" class="btn btn-white" id="nbtelim" data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$('.dataTables-example').DataTable({
		pageLength: 25,
		responsive: true,
		dom: '<"html5buttons"B>lTfgitp',
		buttons: [
			{extend: 'pdf', title: 'ExampleFile'},

			{extend: 'print',
				customize: function (win){
					$(win.document.body).addClass('white-bg');
					$(win.document.body).css('font-size', '10px');

					$(win.document.body).find('table')
							.addClass('compact')
							.css('font-size', 'inherit');
			}
			}
		],
		language: {
			processing:     "Procesando...",
			search:         "Buscar:",
			lengthMenu:     "Mostrar: _MENU_ elementos",
			info:           "Mostrando _START_ a _END_ de _TOTAL_ resultados",
			infoEmpty:      "Elemento 0 de 0 elementos encontrados",
			infoFiltered:   "(elementos filtrado _MAX_ de elementos maximos )",
			infoPostFix:    "",
			loadingRecords: "Cambios en Curso...",
			zeroRecords:    "No se encuentran elementos.",
			emptyTable:     "Tabla no disponible",
			paginate: {
				first:      "Adelante",
				previous:   "Anterior",
				next:       "Siguiente",
				last:       "Atrás"
			}

		}
	});
	/* para el modla de eliminar */
	$('#eliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
		var uno = button.data('unoo');
        var modal = $(this);
        modal.find('.modal-body #idContaAtrasada').val(uno);
		
	});
});
</script>

