<?php 
	@session_start();
    include 'modelo/consultaTablas.php';
    $soporte = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
	$fechaCreacion = date("Y-m-d");
	
	/* variable para la seccion de activos */
    $activos = $soporte->activos($id_usuario);

    //obtnemos los valores para las areas de trabajo
    $ares = $soporte->areaTrabaInfo($id_usuario);
    //generamos las variables
    $aresInfo = $ares->fetch_object();
    $vaeri = $aresInfo->idAreasTrabajo;
    $administracion = $aresInfo->administracion;
    $produccion = $aresInfo->produccion;
    $transporte = $aresInfo->transporte;
 ?>
 <script src="js/vista/activos.js"></script>
 
<!--seccion de contenido-->
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-warning text-center"><b>Es obligatorio</b> activar tus áreas de trabajo.<small> La activación de tus áreas de trabajo se requieren para la presentación de tus declaraciones.</small><br>
			<b>Es obligatorio</b> completar tus activos. Recuerda que su registro te ayudarán a deducir impuestos. Sino tienes activos no tendrás que completar esa sección.
			<br>
			<br>¿Sigues teniendo dudas? <a data-toggle="modal" data-target="#mennnas"style='color:  rgb(226, 0, 74)'> Clic aquí</a>
		</div>
	</div>

	<div class="row">
	    <div class="col-md-12" >
	        <?php if($tarsTRa == 1){?>
	            <div class="alert alert-warning text-center">Se actualizaron tus áreas de trabajo.</div>

	        <?php } if($tarsTRa == 2){?>
	            <div class="alert alert-danger text-center">Ocurrió un error al actualizar, inténtalo de nuevo.</div> 
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
	                <li class="active"><a data-toggle="tab" href="#tab-1"> Áreas de trabajo</a></li>
	                <li class=""><a data-toggle="tab" href="#tab-2">Activos</a></li>
	            </ul>
	            <div class="tab-content">
	                <!--seccion para areas de trabajo-->
	                <div id="tab-1" class="tab-pane active">
	                    <div class="panel-body">
	                        <div class="row">
								<div class="col-md-12">
									<div class="ibox float-e-margins">
										<div class="ibox-title">
											<h5>Áreas de trabajo</h5>
										</div>
										 <form action="controlador/areasTrabajoControlador.php" method="post" enctype="multipart/form-data">
										 	<input type="hidden" name="idAreasTrabajo" id="idAreasTrabajo" value="<?php echo $vaeri;?>">
											<div class="ibox-content text-center">
												<div class="row ">
													<div class="col-md-4 text-center">
														<input type="checkbox" id="administracion" value="1" name='administracion' <?php if($administracion == 1){ echo "checked";}?> > <b>Administración</b>
													</div>
													<div class="col-md-4 text-center">
														<input type="checkbox" id="produccion" value="1" name='produccion' <?php if($produccion == 1){ echo "checked";}?> > <b>Producción | Operación</b>
													</div>
													<div class="col-md-4 text-center">
														<input type="checkbox" id="transporte" value="1" name='transporte' <?php if($transporte == 1){ echo "checked";}?> > <b>Transporte | Reparto</b>
													</div>
												</div>
												<hr>
												<div class="row">
													<div class="col-md-12"> <button class="btn btn-primary" type="submit"></i> Guardar</button>	</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
	                    </div>
	                </div>

	                <div id="tab-2" class="tab-pane">
	                    <div class="panel-body">
							
							<div class="row wrapper">
								<div class="col-sm-12">
									<div class="title-action">
										<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoactivo"> Nuevo activo</a>
									</div>
								</div>
							</div>
							<hr>

	                        <div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
									<thead>
										<tr>
											<th>Fecha de compra</th>
											<th>Monto de compra sin impuestos</th>
											<th>Tipo de activo</th>
											<th>Depreciación acumulada <i class="fa fa-info-circle" title="Esta cantidad es la que ha perdido de valor hasta ahora."></i> </th>
											<th>Descripción</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php while($activosInfo = $activos->fetch_object()){?>
											<tr>
												<td><?php echo $activosInfo->fechaCompra;?></td>
												<td><?php echo $activosInfo->monto;?></td>
												<td><?php echo $activosInfo->tipo;?></td>
												<td><?php echo $activosInfo->depreciacion;?></td>
												<td><?php echo $activosInfo->descripcion;?></td>
												<td><a class="btn btn-danger" data-toggle="modal" data-target="#ModalEliminar" title="Eliminar" data-doos="<?php echo $activosInfo->idActivo; ?>">
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
								<option>Selecciona el tipo de activo</option>
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
							<input type="text" id="depreciacionInfo" name="depreciacionInfo" class="form-control" disabled>
							<input type="hidden" id="depreciacion" name="depreciacion"  class="form-control" >
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
				<h4 class="modal-title" id="titulo">¿QUÉ SON ACTIVOS Y ÁREAS DE TRABAJO?</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="alert alert-warning text-center"><p>Los activos son los recursos con los que cuentas para trabajar. <br>Ej: laptop, coches, motos, oficinas, escritorios, teléfonos, etc. Todo lo que esté orientado a realizar tu actividad de forma diaria.<br>Las áreas de trabajo son las áreas donde realizas tus actividades diarias.</p></div>
					
				</div>
			</div>	
			<div class="modal-footer">
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!--modal para eeliminar los activos --->
<div class="modal inmodal fade" id="ModalEliminar" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Eliminar activo</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="idActivioEli" id="idActivioEli">
    			<div class="alert alert-danger text-center">Recuerda que al eliminarlo no podrás recuperarlo.</div>
			</div>
			<div class="modal-footer">
				<button type="button" id='btnElimina' class="btn btn-w-m btn-danger"> Eliminar </button>
				<button type="button" class="btn btn-white" id="nbtelim" data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
	</div>
</div>
