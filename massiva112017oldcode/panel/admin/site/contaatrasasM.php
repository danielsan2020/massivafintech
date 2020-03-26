<?php 
    include 'modelo/consultaTablas.php';
    $soporte = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
    $fechaCreacion = date("Y-m-d");

    //consultas de persona fisica
    $uno = $soporte->conatrapfUno();
    $dos = $soporte->conatrapfDos();
    $tres = $soporte->conatrapfTres();

 ?>
 <script src="js/vista/activos.js"></script>
 <div class="row white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action"><a href="index.php?secc=dascontaM" class="btn btn-primary" > Regresar</a></div>
	</div>
</div>
<!--seccion de contenido-->
<div class="wrapper wrapper-content">

	<div class="row">
	    <div class="col-md-12" >
	        <?php if($guaSim == 2){?>
	            <div class="alert alert-success text-center">Se reenvió la cotización</div>

	        <?php } if($guaSim == 3){?>
	            <div class="alert alert-danger text-center">Se eliminó la cotización</div> 
	        <?php }?>
	    </div>
	</div>

	<div class="row">
		<div class="col-md-12" id="alertAccion"></div>
	</div><br>

	<div class="row">
		<div class="col-lg-12">
	        <div class="tabs-container">
	            <ul class="nav nav-tabs">
	                <li class="active"><a data-toggle="tab" href="#tab-1"> Pendientes por registro </a></li>
	                <li class=""><a data-toggle="tab" href="#tab-2">Analizando </a></li>
	                <li class=""><a data-toggle="tab" href="#tab-3">Ejecutando </a></li>
	            </ul>
	            <div class="tab-content">
	                <!--seccion para areas de trabajo-->
	                <div id="tab-1" class="tab-pane active">
	                    <div class="panel-body">
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
												<td><?= $unoInfo->idContaAtrasada;?></td>
												<td><?= $unoInfo->rfc;?></td>
												<td><?= $unoInfo->fechaCreacion;?></td>
												<td><?= $unoInfo->correo;?></td>
												<td><?= $unoInfo->monto;?></td>
												<td class="text-center">
													<div class="col-md-6">
														<form action="controlador/simuladorControlador.php" method="POST">
															<input type="hidden" name="accion" id="accion" value="reenviar">
															<input type="hidden" name="montoEnvia" id="montoEnvia" value="<?= $unoInfo->monto;?>">
															<input type="hidden" name="correEnvia" id="correEnvia" value="<?= $unoInfo->correo;?>">
															<button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
																
														</form>
													</div>

													<div class="col-md-6">
														<form action="controlador/simuladorControlador.php" method="POST">
															<input type="hidden" name="accion" id="accion" value="eliminar">
															<input type="hidden" name="idContaAtrasada" id="idContaAtrasada" value="<?= $unoInfo->idContaAtrasada;?>">
															<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
														</form>
														
													</div>													
													
												</td>
											</tr>
										<?php }?>
									</tbody>
								</table>
							</div>
	                    </div>
	                </div>

	                <div id="tab-2" class="tab-pane">
	                    <div class="panel-body">
	                        <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
									<thead>
										<tr>
											<th>#</th>
											<th>Fecha de compra</th>
											<th>Monto de compra sin impuestos</th>
											<th>Tipo de activo</th>
											<th>Depreciación acumulada </th>
											<th>Descripción</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php while($activosInfo = $activos->fetch_object()){?>
											<tr>
												<td><?= $activosInfo->idActivo;?></td>
												<td><?= $activosInfo->fechaCompra;?></td>
												<td><?= $activosInfo->monto;?></td>
												<td><?= $activosInfo->tipo;?></td>
												<td><?= $activosInfo->depreciacion;?></td>
												<td><?= $activosInfo->descripcion;?></td>
												<td><a class="btn btn-danger" data-toggle="modal" data-target="#ModalEliminar" title="Eliminar" data-doos="<?= $activosInfo->idActivo; ?>">
													<i class="fa fa-trash"></i> 
												</a></td>
											</tr>
										<?php }?>
									</tbody>
								</table>
							</div>
	                    </div>
	                </div>

	                <div id="tab-3" class="tab-pane">
	                    <div class="panel-body">
	                        <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
									<thead>
										<tr>
											<th>#</th>
											<th>Fecha de compra</th>
											<th>Monto de compra sin impuestos</th>
											<th>Tipo de activo</th>
											<th>Depreciación acumulada </th>
											<th>Descripción</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php while($activosInfo = $activos->fetch_object()){?>
											<tr>
												<td><?= $activosInfo->idActivo;?></td>
												<td><?= $activosInfo->fechaCompra;?></td>
												<td><?= $activosInfo->monto;?></td>
												<td><?= $activosInfo->tipo;?></td>
												<td><?= $activosInfo->depreciacion;?></td>
												<td><?= $activosInfo->descripcion;?></td>
												<td><a class="btn btn-danger" data-toggle="modal" data-target="#ModalEliminar" title="Eliminar" data-doos="<?= $activosInfo->idActivo; ?>">
													<i class="fa fa-trash"></i> 
												</a></td>
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
	</div>
	
</div><br><hr>


<!--seccion para modals--->

<!---modal para nuevo activo-->
<div class="modal inmodal fade" id="nuevoactivo" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Agregar nuevo activo</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">Fecha de compra</span> 
							<input type="date" id="fechaCompra" name="fechaCompra" placeholder="Fecha de inicio de póliza" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="monto" name="monto" placeholder="Monto de compra sin iva" class="form-control" onkeypress="return NumCheck(event, this)">
						</div>
					</div>
				</div>
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select name="tipo" id="tipo" class="form-control">
								<option>Seleccione el tipo de activo</option>
								<option>Terreno</option>
								<option>Edificio</option>
								<option>Mobiliario</option>
								<option>Equipo de computo</option>
								<option>Equipo de producción</option>
								<option>Vehiculo</option>

							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">Depreciación acumulada</span> 
							<input type="text" id="depreciacion" name="depreciacion" class="form-control" disabled>
						</div>
					</div>
				</div>  

				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripción del activo"></textarea>

						</div>
					</div>
				</div>   
					
			</div>
			<div class="modal-footer">
				<button id='nuevoActivobtn' class="btn btn-primary"> Guardar</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!--modal para el mesnaje --->
<div class="modal inmodal fade" id="mennnas" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">¿QUE SON ACTIVOS Y ÁREAS DE TRABAJO?</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<p>Los activos son los recursos con los que cuentas para trabajar. Ej: laptop, coches, motos, oficinas, escritorios, teléfonos, etc. Todo lo que esté orientado a realizar tu actividad de forma diaria.<br>Las áreas de trabajo son las áreas donde realizas tus actividades diarias.</p>
				</div>
			</div>	
			<div class="modal-footer">
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
	</div>
</div>


     