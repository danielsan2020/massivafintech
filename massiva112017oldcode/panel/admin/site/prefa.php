<?php
	//instanciamos el metodo para mostrar la informacion
	include 'modelo/faqModelo.php';
    $faqPr = new faqPr();
    $rspTabla = $faqPr->informacionTabla();
?>
<!--seccion de contenido-->
<script src="js/vista/faq.js"></script>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action"><a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevo"> Nueva pregunta</a></div>
	</div>
</div>

<div class="row">
	<div class="col-md-12" id="alertAccion"></div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title"><h5>Preguntas frecuentes</h5></div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
								<tr>
									<th>#</th>
									<th>Pregunta</th>
									<th>Respuesta</th>
									<th>Área</th>
									<th>Status</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<?php while($rspTablaInfo = $rspTabla->fetch_object()){ ?>
								<tr class="gradeX">
									<td><?= $rspTablaInfo->idPregunta;?></td>
									<td><?= $rspTablaInfo->pregunta;?></td>
									<td><?= $rspTablaInfo->respuesta;?></td>
									<td><?= $rspTablaInfo->area;?></td>
									<td><?php
											if ($rspTablaInfo->estatus == 1){
												echo "Activa";
											}else{
												echo "Inactiva";
											}
									?></td>
									
									<td class="text-center">
										<button class="btn btn-primary" data-toggle="modal" title="Editar pregunta" data-target="#editar" data-unoo="<?= $rspTablaInfo->idPregunta; ?>">
											<i class="fa fa-edit" title="Editar"></i>
										</button>
										<button class="btn btn-danger" data-toggle="modal" title="Eliminar pregunta" data-target="#eliminar" data-unooo="<?= $rspTablaInfo->idPregunta; ?>">
											<i class="fa fa-times" title="Eliminar"></i>
										</button>
									</td>
								</tr>
								<?php }?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!--seccion de modals-->

<!---modal para agregar--->
<div class="modal inmodal fade" id="nuevo" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Agregar nueva pregunta</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="pregunta" name="pregunta" placeholder="Titulo de publicación" class="form-control">
						</div>
					</div>
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control" name="area" id="area">
								<option>Seleccionar una categoria</option>
								<option>PREGUNTAS GENERALES</option>
								<option>FACTURAS Y COTIZACIONES</option>
								<option>DECLARACIONES</option>
								<option>PAGOS, IMPUESTOS, COBROS Y CLIENTES</option>
								<option>PLATAFORMA</option>
								<option>RIF, SAS Y OTRAS PERSONAS MORALES</option>
								<option>OTRAS CONSULTAS O DUDAS</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control" name="estatus" id="estatus">
								<option>Seleccione un estatus</option>
								<option value="1">Activa</option>
								<option value="0">Inactiva</option>
								
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<textarea class="form-control" placeholder="Texto" name='respuesta' id='respuesta'></textarea> 
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" id='agregarPreg' class="btn btn-primary"> Agregar pregunta</button>
				<button type="button" class="btn btn-white" id='cerrarNueaNot' data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!---modal para editar--->
<div class="modal inmodal fade" id="editar" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Editar pregunta</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<input type="hidden" name="idPregunta1" id="idPregunta1">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="pregunta1" name="pregunta1" placeholder="Titulo de publicación" class="form-control">
						</div>
					</div>
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control" name="area1" id="area1">
								<option>Seleccionar una categoria</option>
								<option value="PREGUNTAS GENERALES">PREGUNTAS GENERALES</option>
								<option value='FACTURAS Y COTIZACIONES'>FACTURAS Y COTIZACIONES</option>
								<option value="DECLARACIONES">DECLARACIONES</option>
								<option value="PAGOS, IMPUESTOS, COBROS Y CLIENTES">PAGOS, IMPUESTOS, COBROS Y CLIENTES</option>
								<option value="PLATAFORMA">PLATAFORMA</option>
								<option value="RIF, SAS Y OTRAS PERSONAS MORALES">RIF, SAS Y OTRAS PERSONAS MORALES</option>
								<option value="OTRAS CONSULTAS O DUDAS">OTRAS CONSULTAS O DUDAS</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control" name="estatus1" id="estatus1">
								<option>Seleccione un estatus</option>
								<option value="1">Activa</option>
								<option value="0">Inactiva</option>
								
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<textarea class="form-control" placeholder="Texto" name='respuesta1' id='respuesta1'></textarea> 
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" id='ediatPree' class="btn btn-primary"> Editar pregunta</button>
				<button type="button" class="btn btn-white" id='cerarEditaPr' data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!---modal para eliminar--->
<div class="modal inmodal fade" id="eliminar" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Eliminar pregunta</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="idPregunta2" id="idPregunta2">
    			<div class="alert alert-danger text-center">Esta de acuerdo eliminar la pregunta, recuerde que al eliminarlo no habra forma de recuperar la información.</div>
			</div>
			<div class="modal-footer">
				<button type="button" id='btnElimina' class="btn btn-w-m btn-danger"> Eliminar </button>
				<button type="button" class="btn btn-white" id="nbtelim" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
			</div>
		</div>
	</div>
</div>

