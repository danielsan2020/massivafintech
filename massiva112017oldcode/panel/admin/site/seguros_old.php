<?php
	//instanciamos el metodo para mostrar la informacion

    //consulta de catalogos
    include 'modelo/consultaTablas.php';
    $soporte = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
    $catTipoPago = $soporte->catTipoPago();
    $catTipoSeguradoras = $soporte->catTipoSeguradoras();

    $catTipoPago1 = $soporte->catTipoPago();
    $catTipoSeguradoras1 = $soporte->catTipoSeguradoras();

    //obtnemos la tabla de seguros
    $segurostabla = $soporte->segurostabla($id_usuario);
    
?>
<!--seccion de contenido-->
<script src="js/vista/inventarioSeguros.js"></script>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action">
			<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoSeguro"> Nuevo seguro</a>
			<!--a href="index.php?secc=inventarioGeneral" class="btn btn-primary"> Reporte general de seguros</a-->
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" id="alertAccion"></div>
</div><br>
<div class="row">
	<div class="col-md-12" id="">
		<div class="alert alert-warning text-center">Completa esta sección si tienes seguros, sino no es necesario.</div>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title"> <h5>Seguros</h5></div>
			<div class="ibox-content">
				<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover dataTables-example" >
					<thead>
						<tr>
							<th>RFC</th>
							<th>Tipo de seguro</th>
							<th>Prima</th>
							<th>Fecha Inicio</th>
							<th>Fecha de finalización</th>
							<th>Número de poliza</th>
							<th>Metodo de pago</th>
							<th>Aseguradora</th>
							<th>Descripción</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php while($rspTablaInfo = $segurostabla->fetch_object()){ ?>
								<tr class="gradeX">
									<td><?= $rspTablaInfo->rfc;?></td>
									<td><?= $rspTablaInfo->tipo;?></td>
									<td><?= $rspTablaInfo->prima;?></td>
									<td><?= $rspTablaInfo->fechaInicio;?></td>
									<td><?= $rspTablaInfo->fechaTermino;?></td>
									<td><?= $rspTablaInfo->numeroPoliza;?></td>
									<td><?= $rspTablaInfo->metodoPago;?></td>

									<td><?= $rspTablaInfo->aseguradora;?></td>
									<td><?= $rspTablaInfo->descripcion;?></td>
									<th class="text-center">
									
										<a href="" class="btn btn-primary" data-toggle="modal" data-target="#editaseguro" title="Ver detalles / editar" data-unoo="<?= $rspTablaInfo->idSeguro; ?>">
											<i class="fa fa-pencil"></i> 
										</a>
										
																			
										<a class="btn btn-danger" data-toggle="modal" data-target="#ModalEliminar" title="Eliminar" data-doos="<?= $rspTablaInfo->idSeguro; ?>">
											<i class="fa fa-trash"></i> 
										</a>
								</th>
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

<!---seccion para los modals-->
<div class="modal inmodal fade" id="nuevoSeguro" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Agregar nueva seguro</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="rfc" name="rfc" placeholder="*RFC" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="tipo" name="tipo"  placeholder="*Tipo de seguro" class="form-control">
						</div>
					</div>
				</div>
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="prima" name="prima" placeholder="Cantidad" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">Fecha de inicio</span> 
							<input type="date" id="fechaInicio" name="fechaInicio" placeholder="Fecha de inicio de póliza" class="form-control">
						</div>
					</div>
				</div>  
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">Fecha de término</span> 
							<input type="date" id="fechaTermino" name="fechaTermino" placeholder="Fecha de término de póliza" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="numeroPoliza" name="numeroPoliza"  placeholder="Número de seguro" class="form-control">
						</div>
					</div>
				</div>
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control" name="metodoPago" id="metodoPago">
								<option>Selecciona tu método de pago</option>
								<?php while ($catTipoPagoInfo = $catTipoPago->fetch_object()){?>
									<option><?= $catTipoPagoInfo->descripcion;?></option>
								<?php }?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control" name="aseguradora" id="aseguradora">
								<option>Selecciona tu aseguradora</option>
								<?php while ($catTipoSeguradorasInfo = $catTipoSeguradoras->fetch_object()){?>
									<option><?= $catTipoSeguradorasInfo->aseguradora;?></option>
								<?php }?>
							</select>
						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripción del seguro"></textarea>

						</div>
					</div>
				</div>   
					
			</div>
			<div class="modal-footer">
				<button id='GuardarSeguri' class="btn btn-primary"> Guardar</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!--modal para eliminar el seguro-->
<div class="modal inmodal fade" id="ModalEliminar" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Eliminar su seguro</h4>
			</div>
			<div class="modal-body">
				<input type="text" name="idSeguroEli" id="idSeguroEli">
    			<div class="alert alert-danger text-center">Estoy de acuerdo de eliminar el seguro, recuerde que al eliminarlo no habra forma de recuperar la información.</div>
			</div>
			<div class="modal-footer">
				<button type="button" id='btnElimin' class="btn btn-w-m btn-danger"> Eliminar </button>
				<button type="button" id='btnEliminaDir' class="btn btn-white" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!---Edicion de inventario-->
<div class="modal inmodal fade" id="editaseguro" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Editra seguro</h4>
			</div>
			<div class="modal-body">
				<input type="text" name="idSeguro1" id="idSeguro1">
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="rfc1" name="rfc1" placeholder="*RFC" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="tipo1" name="tipo1"  placeholder="*Tipo de seguro" class="form-control">
						</div>
					</div>
				</div>
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="prima1" name="prima1" placeholder="Cantidad" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">Fecha de inicio de póliza</span> 
							<input type="date" id="fechaInicio1" name="fechaInicio1" placeholder="Fecha de inicio de póliza" class="form-control">
						</div>
					</div>
				</div>  
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">Fecha de término de póliza</span> 
							<input type="date" id="fechaTermino1" name="fechaTermino1" placeholder="Fecha de término de póliza" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="numeroPoliza1" name="numeroPoliza1"  placeholder="Número de póliza" class="form-control">
						</div>
					</div>
				</div>
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control" name="metodoPago1" id="metodoPago1">
								<option>Selecciona tu metodo de pago</option>
								<?php while ($catTipoPagoInfo1 = $catTipoPago1->fetch_object()){?>
									<option><?= $catTipoPagoInfo1->descripcion;?></option>
								<?php }?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control" name="aseguradora1" id="aseguradora1">
								<option>Selecciona tu aseguradora</option>
								<?php while ($catTipoSeguradorasInfo1 = $catTipoSeguradoras1->fetch_object()){?>
									<option><?= $catTipoSeguradorasInfo1->aseguradora;?></option>
								<?php }?>
							</select>
						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<textarea name="descripcion1" id="descripcion1" class="form-control" placeholder="Descripción de la póliza"></textarea>

						</div>
					</div>
				</div>   
					
			</div>
			<div class="modal-footer">
				<button id='editarSeguro' class="btn btn-primary"> Editar</button>
				<button type="button" class="btn btn-white" id='btneditarSeguro' data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
	</div>
</div>

