<?php 
    include 'modelo/consultaTablas.php';
    $soporte = new consultaTabla();
	$rspCate = $soporte->categoria();
	///aqui realizamos la consulta para saber si tenemos tickets abiertos
	$valoId = $_SESSION['nusuario'];
	//obtenemos los tickets terminados modal
	$vaTickTermin = $soporte->ticketAbiertosAdmin($valoId);

?>
<style>
	#form {
  width: 250px;
  margin: 0 auto;
  height: 50px;
}

#form p {
  text-align: center;
}

#form label {
  font-size: 80px;
}

input[type="radio"] {
  display: none;
  height:50px;
}

label {
  color: grey;
}

.clasificacion {
  direction: rtl;
  unicode-bidi: bidi-override;
  cursor: pointer;
}

label:hover,
label:hover ~ label {
  color: orange;
}

input[type="radio"]:checked ~ label {
  color: orange;
}

</style>
<script src="js/vista/soporteTecnico.js"></script>
<div class='row'><div class='col-md-12' id='alertAccion' name='alertAccion'></div></div>

<!--seccion de contenido-->
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title"><h5>Tickets pendientes</h5></div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
								<tr>
									<th>#</th>
									<th>Titulo</th>
									<th>Descripción</th>
									<th>Fecha creación</th>
									<th>Usuario escribe</th>
									<th>Categoria</th>
									<th>Estatus</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php while($vaTickTerminInfo = $vaTickTermin->fetch_object()){ ?>
								<tr class="gradeX">
									<td><?= $vaTickTerminInfo->id_soporte;?></td>
									<td><?= $vaTickTerminInfo->titulo;?></td>
									<td><?= $vaTickTerminInfo->descripcion;?></td>
									<td><?= $vaTickTerminInfo->fechaCreacion;?></td>
									<td><?= $vaTickTerminInfo->usuario;?></td>
									<td><?= $vaTickTerminInfo->nocat;?></td>
									<td>
										<?php
										 	if($vaTickTerminInfo->estatus == 1){ echo "Activo";}
										 	else{ echo "Inactivo";}
										 ?>
										
									</td>
									<?php if($vaTickTerminInfo->estatus == 1){?>
									<td class="text-center">
										

										<button class="btn btn-primary" data-toggle="modal" title="Agregar comentario" data-target="#nuevoComentario" data-unoo="<?= $vaTickTerminInfo->id_soporte; ?>">
											<i class="fa fa-edit"></i>
										</button>
										<button class="btn btn-primary" data-toggle="modal" title="Ver comentarios" data-target="#vercomentarios" data-unoo="<?= $vaTickTerminInfo->id_soporte; ?>">
											<i class="fa fa-search"></i>
										</button>
										<button class="btn btn-danger" data-toggle="modal" title="Terminar ticket" data-target="#terminaAdmin" data-unoo="<?= $vaTickTerminInfo->id_soporte; ?>">
											<i class="fa fa-times"></i>
										</button>
									</td>
									<?php }else{ ?>
										<td class="text-center">
										
											<button class="btn btn-primary" data-toggle="modal" title="Ver comentarios" data-target="#vercomentarios" data-unoo="<?= $vaTickTerminInfo->id_soporte; ?>">
												<i class="fa fa-search"></i>
											</button>
											
										</td>	
									<?php }?>
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

<!--seccion de modals-->
<div class="modal inmodal fade" id="nuevoComentario" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Respuesta a Ticket</h4>
			</div>
			<!--valores ocultos-->
			<div class="modal-body">
				<input type='hidden' name='idsoporteComen' id='idsoporteComen' value=''>
				<div class='row'>
					<div class='col-md-12'>
					<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<textarea class='form-control' id='comentarioAdmin' name='comentarioAdmin' placeholder='Comentario del soporte técnico'></textarea>
						</div>
					
					</div>
				</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id='nuevComnAd'> Responder</button>
				<button type="button" class="btn btn-white" data-dismiss="modal" id='btnnuevoComen'> Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!--mostrar comentarios-->
<div class="modal inmodal fade" id="vercomentarios" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Comentarios del ticket</h4>
			</div>
			<div class="modal-body">
				<div id="InvColor"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal" id='btnTern'> Cerrar</button>
			</div>
		</div>
	</div>
</div>
<!---modal para terminar el ticket-->
<div class="modal inmodal fade" id="terminaAdmin" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Terminar ticket</h4>
			</div>
			<div class="modal-body">
				<input type='text' name='idTermina' id='idTermina'>
				<div class='row'>
					<div class='col-md-12'>
						<div class="alert alert-danger text-center">¿Está de acuerdo en terminar el ticket?</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id='terminarTickeADmin'> Terminar Ticket</button>
				<button type="button" class="btn btn-white" data-dismiss="modal" id='btnTern'> Cerrar</button>
			</div>
		</div>
	</div>
</div>

     