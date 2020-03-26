<?php
	//instanciamos el metodo para mostrar la informacion
	/*include 'modelo/inventarioActivoModelo.php';
    $invactivo = new invactivo();
	$rspTabla = $invactivo->informacionTabla();*/
	
?>
<!--seccion de contenido-->
<script src="js/vista/misclientes.js"></script>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action">
			<!--a href="" class="btn btn-primary" data-toggle="modal" data-target="#reporte"> Carga masiva por proveedor</a-->
			<!--a href="" class="btn btn-primary" data-toggle="modal" data-target="#reporte"> Carga por xml</a-->
			<a href="index.php?secc=misclientes" class="btn btn-primary"> Regresar</a>
		</div>
	</div>
</div>
<hr>
<div class='row'>
	<div class='col-md-6'>
		<div class="ibox">
			<div class="ibox-title"><h5>Facturas generadas</h5></div>
			<div class="ibox-content text-center">
					<div class="ibox float-e-margins">
					<div>
						<canvas id="doughnutChart" height="50" ></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class='col-md-6'>
		<div class="ibox">
			<div class="ibox-title"><h5>Facturas canceladas</h5></div>
			<div class="ibox-content text-center">
					<div class="ibox float-e-margins">
					<div>
						<canvas id="doughnutChart" height="50"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title"> <h5>Facturas del Cliente</h5></div>
			<div class="ibox-content">
				<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover dataTables-example" >
					<thead>
						<tr>
							<th>Folio</th>
							<th>Fecha</th>
							
							<th>UIDE</th>
							<th>Método de pago</th>
							<th>Status SAT</th>
							<th>Status de cobranza</th>
							<th>Días de crédito</th>
							<th>Total</th>
							<th>Saldo pendiente</th>
							<th class="text-center">Acciones</th>
							<th class="text-center">Visor</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>

<!---detalle de factura-->
<div class="modal inmodal fade" id="verdetalle" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Detalle de factura</h4>
			</div>
			<div class="modal-body">
				
				<div class="row">
					<div class="alert alert-warning text-center">Aqui mostramos el pdf de la factura.</div>	
				</div>
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!---Descuentos--->
<div class="modal inmodal fade" id="descuento" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Descuento sobre factura</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="alert alert-warning text-center">Datos de la factura de origen
						Monto.
						Cliente RFC<br>
						CP cliente
						UIDE factura origen
						fecha y lugar de expedición del emisor
					</div>	
					<p>: <b>01-Nota de crédito de los documentos relacionados.</b></p>
					<p>Tipo de relación: <b>01-Nota de crédito de los documentos relacionados.</b></p>
					<p>Uso de CFDI<b> G02-Devoluciones, descuentos o bonificaciones.</b></p>
					<p>Tipo de comprobante: 02-Egreso</p>
					<p>Método de pago: <b>PPD-Pago en parcialidades o diferido.</b></p>
					<p>Forma de pago: <b>99-Por definir</b></p>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<input class="form-control" type="text" id="producto" name="prodcuto" placeholder="Servicios de facturación" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="*84111506" disabled>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<input class="form-control" type="text" id="cantidad" name="cantidad" placeholder="Cantidad 1" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="subtotal" name="subtotal"  placeholder="*subtotal a descontar" >
						</div>
					</div>
				</div>
				<div class="row">
					
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="subtotal" name="subtotal"  placeholder="IVA que viene de la factura original" disabled >
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="subtotal" name="subtotal"  placeholder="retenciones ISR que viene de la factura original" disabled >
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="subtotal" name="subtotal"  placeholder="retenciones de IVA que viene de la factura original" disabled >
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="subtotal" name="subtotal"  placeholder="retenciones que viene de la factura original" disabled >
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<input class="form-control" type="text" id="cantidad" name="cantidad" placeholder="Total" disabled>
						</div>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoprodu" title="Reenviar">Generar</a>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!---devoluciones--->
<div class="modal inmodal fade" id="devolucion" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Devoluciones</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="alert alert-warning text-center">Datos de la factura de origen
						Monto.
						Cliente RFC<br>
						CP cliente
						UIDE factura origen
						fecha y lugar de expedición del emisor
					</div>	
					<p>Tipo de relación: <b>03	Devolución de mercancía sobre facturas o traslados previos.</b></p>
					<p>Uso de CFDI<b> G02-Devoluciones, descuentos o bonificaciones.</b></p>
					<p>Tipo de comprobante: 02-Egreso</p>
					<p>Método de pago: <b>PPD-Pago en parcialidades o diferido.</b></p>
					<p>Forma de pago: <b>99-Por definir</b></p>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<input class="form-control" type="text" id="producto" name="prodcuto" placeholder="Servicios de facturación" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="*84111506" disabled>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<input class="form-control" type="text" id="cantidad" name="cantidad" placeholder="Cantidad 1" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="subtotal" name="subtotal"  placeholder="*subtotal a descontar" >
						</div>
					</div>
				</div>
				<div class="row">
					
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="subtotal" name="subtotal"  placeholder="IVA que viene de la factura original" disabled >
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<input class="form-control" type="text" id="cantidad" name="cantidad" placeholder="Total" disabled>
						</div>
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
				<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoprodu" title="Reenviar">Generar</a>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!---Cobto--->
<div class="modal inmodal fade" id="cobro" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Cobro</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="alert alert-warning text-center">Datos de la factura de origen
						Monto.
						Cliente RFC<br>
						CP cliente
						UIDE factura origen
						fecha y lugar de expedición del emisor
					</div>	
					<p>Tipo de relación: <b>08	Factura generada por pagos en parcialidades.</b></p>
					<p>Uso de CFDI<b> P01	Por definir.</b></p>
					<p>Tipo de comprobante: P-Pago</p>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<select class="form-control">
								<option>Aqui van los métodos de pago</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="Monto" >
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">Fecha de pago</span> 
							<input class="form-control" type="date" id="claveSat" name="claveSat"  placeholder="Fecha de pago" >
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoprodu" title="Reenviar">Generar</a>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!---Cobto--->
<div class="modal inmodal fade" id="reenviar" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Reenvio</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="alert alert-warning text-center">Correo ya registrado
					
					</div>	
					
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon">Otras cuentas de correo</span> 
							<input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="Agrega los correos adicionales separadas por coma" >
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoprodu" title="Reenviar">Enviar</a>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!---Vistor de descuentos--->
<div class="modal inmodal fade" id="vdes" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Visor de descuentos</h4>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover dataTables-example" >
					<thead>
						<tr>
							<th>Folio</th>
							<th>Fecha</th>
							<th>Total</th>
							<th>UIDE</th>
							<th>Método de pago</th>
							<th>Estatus SAT</th>
							<th class="text-center"></th>
						</tr>
					</thead>
					<tbody>
						
						
					</tbody>
				</table>
				</div>
				
				
			</div>
			<div class="modal-footer">
				<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoprodu" title="Reenviar">Enviar</a>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

