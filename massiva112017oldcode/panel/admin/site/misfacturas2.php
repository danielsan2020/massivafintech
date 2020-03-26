<?php
	//instanciamos el metodo para mostrar la informacion
	/*include 'modelo/inventarioActivoModelo.php';
    $invactivo = new invactivo();
    $rspTabla = $invactivo->informacionTabla();*/
?>
<!--seccion de contenido-->
<script src="js/vista/inventarioActivos.js"></script>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action">
			<!--a href="" class="btn btn-primary" data-toggle="modal" data-target="#reporte"> Carga masiva por proveedor</a-->
			<!--a href="" class="btn btn-primary" data-toggle="modal" data-target="#reporte"> Carga por xml</a-->
			<a href="index.php?secc=inventarioGeneral" class="btn btn-primary"> Reporte</a>
			<a href="index.php?secc=misproveedores" class="btn btn-primary"> Regresar</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" id="alertAccion"></div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="col-lg-12">
		<div class="row">
							<div class="col-lg-12">
							<div class="ibox float-e-margins">
								
								<div class="ibox-content">
									<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover dataTables-example" >
										<thead>
											<tr>
												<th>Folio</th>
												<th>Fecha</th>
												<th>UIDE</th>
												<th>Metodo de pago</th>
												<th>Estatus SAT</th>
												<th>Total</th>
												<th class="text-center">Acciones</th>
											</tr>
										</thead>
										<tbody>
											<th>BGRE-0512</th>
											<th>19/08/2019</th>
											<th>DSGDFBCVBFGDFS518561dsfsddf</th>
											
											<th></th>
											<th></th>
											<th>$25,000</th>
											
											<th class="text-center">
												<a href="" class="btn " style="background-color: #f1005e; color: #FFFFFF" data-toggle="modal" data-target="#reenviar" title="Asignar"><i class="fa fa-chain"></i></a>
												<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoprodu" title="Descargar"><i class="fa fa-download"></i></a>
												<a href="" class="btn btn-default" data-toggle="modal" data-target="#verdetalle" title="Ver"><i class="fa fa-search-plus"></i></a>
												<!---este boton cuando se activa se quita de la lista y el formulario es igual de crear uno nuevo y los datos ya vienen en el xml-->
												<a href="" class="btn" style="background-color: #f1005e; color: #FFFFFF" data-toggle="modal" data-target="#nuevoprodu" title="No asignar"><i class="fa fa-times"></i></a>
											</th>
										</tbody>
									</table>
									</div>
								</div>
							</div>
						</div>
		
		</div>
	</div>
	<br>
</div>
<hr>
<br><br>
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
						fecha y lugar de expedicion del emisor
					</div>	
					<p>: <b>01-Nota de crédito de los documentos relacionados.</b></p>
					<p>Tipo de relacion: <b>01-Nota de crédito de los documentos relacionados.</b></p>
					<p>Uso de CFDI<b> G02-Devoluciones, descuentos o bonificaciones.</b></p>
					<p>Tipo de comprobante: 02-Egreso</p>
					<p>Metodo de pago: <b>PPD-Pago en parcialidades o diferido.</b></p>
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
						fecha y lugar de expedicion del emisor
					</div>	
					<p>Tipo de relacion: <b>03	Devolución de mercancía sobre facturas o traslados previos.</b></p>
					<p>Uso de CFDI<b> G02-Devoluciones, descuentos o bonificaciones.</b></p>
					<p>Tipo de comprobante: 02-Egreso</p>
					<p>Metodo de pago: <b>PPD-Pago en parcialidades o diferido.</b></p>
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
						fecha y lugar de expedicion del emisor
					</div>	
					<p>Tipo de relacion: <b>08	Factura generada por pagos en parcialidades.</b></p>
					<p>Uso de CFDI<b> P01	Por definir.</b></p>
					<p>Tipo de comprobante: P-Pago</p>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<select class="form-control">
								<option>Aqui van los metodos de pago</option>
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
							<input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="Agrega las cuentas de correo extras separadas por coma" >
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
							<th>Metodo de pago</th>
							<th>Estatus SAT</th>
							<th class="text-center"></th>
						</tr>
					</thead>
					<tbody>
						<th>BGRE-0512</th>
						<th>19/08/2019</th>
						<th>$25,000</th>
						<th>DSGDFBCVBFGDFS518561dsfsddf</th>
						<td>PDD</td>
						<th>Activo</th>
						<th class="text-center">
							
							<!--Solo palica para pdd-->
							<a href="" class="btn btn-primary" data-toggle="modal" data-target="#verdetalle" title="Ver"><i class="fa fa-search-plus"></i></a>
						
							<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoprodu" title="Descargar"><i class="fa fa-download"></i></a>
							<a href="" class="btn btn-primary" data-toggle="modal" data-target="#reenviar" title="Reenviar"><i class="fa fa-send"></i></a>
							<!---Se qued activado con leyenda de que de preferencia se cancelen solo en el mes de emicion-->
							<a href="" class="btn"  style="background-color: #f1005e; color: #FFFFFF" data-toggle="modal" data-target="#nuevoprodu" title="Cancelar"><i class="fa fa-trash-o"></i></a>
						</th>
						
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

<!--solicitar factura modal--->
<div class="modal inmodal fade" id="SolicitarFactura" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Solicitar factura</h4>
			</div>
			<div class="modal-body">
				<h4>¿Quieres mostrar esta información en la factura?</h4>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><input type="checkbox"></span> 
							<input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="Datos completos del cliente" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><input type="checkbox"></span>
							<input class="form-control" type="text" id="producto" name="prodcuto" placeholder="Añadir dirección de entrega" disabled>
						</div>
					</div>
				</div>
				<hr>
				<h4>Datos de factura</h4>
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control">
								<option>Uso de CFDI</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<select class="form-control">
								<option>Método de pago</option>
								<option>PUE - Pago en una sola exhibición</option>
								<option>PPD - Pago en parcialidades diferido</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<select class="form-control">
								<option>Forma de pago</option>
								<option>Catalogo</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<select class="form-control">
								<option>Moneda</option>
								<option>Catalogo</option>
							</select>
							
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="Tipo de cambio">
							
						</div>
					</div>
				</div>
				<hr>
				<h4>Agrega tus productos o servicios</h4>
				<div class="row">
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="Busca tu producto o servicio">
						</div>
					</div>
					<div class="col-md-3">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<input class="form-control" type="text" id="producto" name="prodcuto" placeholder="Cantidad">
						</div>
					</div>
					<div class="col-md-3">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<input class="form-control" type="text" id="producto" name="prodcuto" placeholder="Precio">
						</div>
					</div>
					<div class="col-md-3">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<input class="form-control" type="text" id="producto" name="prodcuto" placeholder="Descuento %">
						</div>
					</div>
					<div class="col-md-3">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<input class="form-control" type="text" id="producto" name="prodcuto" placeholder="Total" disabled>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
						<div class="input-group m-b">
							<span class="input-group-addon">Descripción</span>
							<textarea class="form-control" placeholder="Descripción">
							
							</textarea>
						</div>
					</div>
					<div class="col-md-2">
						<div class="input-group m-b">
							<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoprodu" title="Agregar producto"><i class="fa fa-plus-square"></i></a>
						</div>
					</div>
				
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="input-group m-b">
							<p>Producto Unn , Cantidad : 35 , Precio: 099, Descripcion: hola <a href="" class="btn"  style="background-color: #f1005e; color: #FFFFFF" data-toggle="modal" data-target="#nuevoprodu" title="Cancelar"><i class="fa fa-trash-o"></i></a></p>
						</div>
					</div>
				</div>
				<hr>
				<h4>Total de la factura moral y el producto servicios profesionales</h4>
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="Subtotal" disabled>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="Descuentos" disabled>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="subtotal-descuentos*0.16 = IVA" disabled>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<input class="form-control" type="text" id="producto" name="prodcuto" placeholder="ISR(subtotal*.1) | IVA (subtotal*.106666667) Impuestos retenidos" disabled>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<input class="form-control" type="text" id="producto" name="prodcuto" placeholder="subtotal-decuentos+iva-retenciones = Total" disabled>
						</div>
					</div>
				</div>
				<h4>Total de la factura fisica</h4>
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="Subtotal" disabled>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="Descuentos" disabled>
						</div>
					</div>

					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
							<input class="form-control" type="text" id="producto" name="prodcuto" placeholder="subtotal-decuentos = Total" disabled>
						</div>
					</div>
				</div>
				
				
				
			</div>
			<div class="modal-footer">
				<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoprodu" title="Reenviar">Solicitar</a>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>
>>>>>>