<?php
	//instanciamos el metodo para mostrar la informacion
	
	include 'modelo/consultaTablas.php';
    $consultaTabla = new consultaTabla();
	$rspTabla = $consultaTabla->infProInvActivo($valInvAc);
	$rcCli = $_SESSION['rfc'];
?>
<!--seccion de contenido-->
<script src="js/vista/inventarioActivos.js"></script>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action">
			<a href="index.php?secc=inventario" class="btn btn-primary" > Regresar a mis productos</a>
			
		</div>
	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title"> <h5>Reporte general de tus productos</h5></div>
			<div class="ibox-content">
				<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover" >
					<thead>
						<tr>
							<th>Imagen producto</th>
							<th>Nombre</th>
							<th>Código</th>
							<th>Total</th>
							<th>Descripción</th>
						</tr>
					</thead>
					<tbody>
						<?php while($rspTablaInfo = $rspTabla->fetch_object()){ ?>
								<tr class="gradeX">
									<td align="center"><img src="contenedor/clientes/<?php echo $rcCli;?>/<?php echo $rspTablaInfo->foto;?>" style="height: 50px;" class="img-rounded"></td>
									<td><?= $rspTablaInfo->unidadsat;?></td>
									<td><?= $rspTablaInfo->satdes;?></td>
									<td><?= $rspTablaInfo->cantidad;?></td>
									<td>
										<b>Descripción:</b> <?= $rspTablaInfo->comentarios;?><br>
										<b>Precio venta:</b> <?= $rspTablaInfo->precioVenta;?><br>
										<b>Descuento:</b> <?= $rspTablaInfo->descuento;?><br>
										<b>proveedor:</b> <?= $rspTablaInfo->proveedor;?><br>
										<b>Precio compra:</b> <?= $rspTablaInfo->precioCompra;?><br>
									</td>
								</tr>
								<!---Seccion para movimientos-->
								<tr>
									<td><b>Movimientos</b></td>
									<td colspan="2">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<tr>
													<td colspan="5" class="text-center"><b>Entradas</b></td>
												</tr>
												<tr>
													<td><b>Fecha de entrada</b></td>
													<td><b>Cantidad</b></td>
													<td><b>Precio</b></td>
													<td><b>Proveedor</b></td>
													<td><b>Unidad</b></td>
												</tr>
												<!--consulta de entradas-->
												<?php 
													$consEntra = $consultaTabla->consEntra($rspTablaInfo->idInventario);
													while($consEntraInfo = $consEntra->fetch_object()){
												?>
												<tr>
													<td><?= $consEntraInfo->fechaEntrada;?></td>
													<td><?= $consEntraInfo->cantidad;?></td>
													<td><?= $consEntraInfo->precio;?></td>
													<td><?= $consEntraInfo->proveedor;?></td>
													<td><?= $consEntraInfo->unidad;?></td>
												</tr>
												<?php }?>
											</table>
										</div>
									</td>
									<td colspan="2">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<tr>
													<td colspan="5" class="text-center"><b>Salidas</b></td>
												</tr>
												<tr>
													<td><b>Fecha de salida</b></td>
													<td><b>Cantidad</b></td>
													<td><b>Precio</b></td>
													<td><b>Proveedor</b></td>
													<td><b>Unidad</b></td>
												</tr>
												<!--consulta de salidas-->
												<?php 
													$consSalidas = $consultaTabla->consSalidas($rspTablaInfo->idInventario);
													while($consSalidasInfo = $consSalidas->fetch_object()){
												?>
												<tr>
													<td><?= $consSalidasInfo->fechaSalida;?></td>
													<td><?= $consSalidasInfo->cantidad;?></td>
													<td><?= $consSalidasInfo->precio;?></td>
													<td><?= $consSalidasInfo->proveedor;?></td>
													<td><?= $consSalidasInfo->unidad;?></td>
												</tr>
												<?php }?>
											</table>
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

<!---seccion para los modals-->
<div class="modal inmodal fade" id="nuevoprodu" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Nuevo producto</h4>
			</div>
			<div class="modal-body">
				<iframe name="agrpro" id="agrpro" style="width: 100%; height: 70px; border: none"></iframe>
				<form action="controlador/inventarioActivoControlador.php" target="agrpro" method="post" name="nuevoPro" enctype="multipart/form-data">
				<input type="hidden" name="accion" id="accion" value="nuevoProducto">	
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="nombre" name="nombre" placeholder="*Nombre" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="codigo" name="codigo"  placeholder="*codigo" class="form-control">
						</div>
					</div>
				</div>
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control" name="unidad" id="unidad">
								<option>Selecciona una unidad</option>
								<option>Pieza</option>
								<option>Gramos</option>
								<option>Litros</option>
								<option>Mililitros</option>
								<option>Caja</option>
								<option>Bolsa</option>
								<option>Otros</option>
							</select>

						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="cantidad" name="cantidad" onkeypress="return NumCheck(event)" placeholder="Cantidad" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="ubicacion" name="ubicacion" placeholder="Ubicación" class="form-control">
						</div>
					</div>
				</div>  
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="precio" name="precio" onkeypress="return NumCheck(event, this)" placeholder="Precio compra" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="precioFinal" name="precioFinal"  onkeypress="return NumCheck(event, this)" placeholder="Precio venta" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="descuentos" name="descuentos" onkeypress="return NumCheck(event, this)" placeholder="Descuento" class="form-control">                                          
						</div>
					</div>
				</div>
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="proveedor" name="proveedor" placeholder="Proveedor" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">Foto</span> 
							<input type="file" id="imagen" name="imagen" class="form-control">
						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripción"></textarea>

						</div>
					</div>
				</div>   
				
				<div class="row">
					<div class="alert alert-warning text-center">Estás añadiendo un nuevo producto a tu inventario.</div>	
				</div>
					
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Guardar producto</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!--modal para la edicion--->
<div class="modal inmodal fade" id="editar" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Editar producto</h4>
			</div>
			<div class="modal-body">
				<iframe name="agrpro1" id="agrpro1" style="width: 100%; height: 70px; border: none"></iframe>
				<form action="controlador/inventarioActivoControlador.php" target="agrpro1" method="post" name="nuevoPro" enctype="multipart/form-data">
					
				<input type="hidden" name="accion" id="accion" value="editarProducto">
				<input type="hidden" name="idInventario" id="idInventario">
				<input type="hidden" name="imagen1" id="imagen1">
					
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="nombre1" name="nombre1" placeholder="*Nombre" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="codigo1" name="codigo1"  placeholder="*codigo" class="form-control">
						</div>
					</div>
				</div>
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control" name="unidad1" id="unidad1">
								<option>Selecciona una unidad</option>
								<option value="Pieza">Pieza</option>
								<option value="Gramos">Gramos</option>
								<option value="Litros">Litros</option>
								<option value="Mililitros">Mililitros</option>
								<option value="Caja">Caja</option>
								<option value="Bolsa">Bolsa</option>
								<option value="Otros">Otros</option>
							</select>

						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="cantidad1" name="cantidad1" onkeypress="return NumCheck(event)" placeholder="Cantidad" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="ubicacion1" name="ubicacion1" placeholder="Ubicación" class="form-control">
						</div>
					</div>
				</div>  
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="precio1" name="precio1" onkeypress="return NumCheck(event, this)" placeholder="Precio compra" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="precioFinal1" name="precioFinal1"  onkeypress="return NumCheck(event, this)" placeholder="Precio venta" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="descuentos1" name="descuentos1" onkeypress="return NumCheck(event, this)" placeholder="Descuento" class="form-control">                                          
						</div>
					</div>
				</div>
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="proveedor1" name="proveedor1" placeholder="Proveedor" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">Foto</span> 
							<input type="file" id="imagensube" name="imagensube" class="form-control">
						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<textarea name="descripcion1" id="descripcion1" class="form-control" placeholder="Descripción"></textarea>

						</div>
					</div>
				</div>   
				
				<div class="row">
					<div class="alert alert-warning text-center">Estás añadiendo un nuevo producto a tu inventario.</div>	
				</div>
					
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Editar producto</button>
				<button type="button" class="btn btn-white" id='btnCierraEdita' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!--modal para eliminar el producto-->
<div class="modal inmodal fade" id="ModalEliminar" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Eliminar tu producto</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="idInventario2" id="idInventario2">
				<input type="hidden" name="imgref2" id="imgref2">
    			<div class="alert alert-danger text-center">Si eliminas el producto eliminarlo no podrás recuperarlo.</div>
			</div>
			<div class="modal-footer">
				<button type="button" id='btnElimin' class="btn btn-w-m btn-danger"> Eliminar producto</button>
				<button type="button" id='btnEliminaDir' class="btn btn-white" data-dismiss="modal">Cerrar ventana</button>
			</div>
		</div>
	</div>
</div>

<!--modal para la agregar movimientos--->
<div class="modal inmodal fade" id="agregarentrada" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Agregar entrada de producto</h4>
			</div>
			<div class="modal-body">
				<input type="text" name="idInventarioE" id="idInventarioE">	
				<input type="text" name="CasntE" id="CasntE">	
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="date" id="fechaEntradaE" name="fechaEntradaE" placeholder="* Fecha de entrada" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="cantidadE" name="cantidadE" onkeypress="return NumCheck(event)"  placeholder="*cantidad" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="precioE" name="precioE" onkeypress="return NumCheck(event)" placeholder="Precio" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="proveedorE" name="proveedorE" placeholder="Proveedor" class="form-control">
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control" name="unidadE" id="unidadE">
								<option>Selecciona una unidad</option>
								<option>Pieza</option>
								<option>Gramos</option>
								<option>Litros</option>
								<option>Mililitros</option>
								<option>Caja</option>
								<option>Bolsa</option>
								<option>Otros</option>
							</select>

						</div>
					</div>
				</div>  
				<div class="row">
					<div class="alert alert-warning text-center">Estas añadiendo más cantidad a tu inventario.</div>	
				</div>
					
			</div>
			<div class="modal-footer">
				<button id='agreEntrada' class="btn btn-primary"> Agregar</button>
				<button type="button" class="btn btn-white" id='btnCierEntrad' data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!--modal para la agregar salidas--->
<div class="modal inmodal fade" id="agregaSalida" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Agregar salida de producto</h4>
			</div>
			<div class="modal-body">
				<input type="text" name="idInventarioE1" id="idInventarioE1">	
				<input type="text" name="CasntE1" id="CasntE1">	
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="date" id="fechaEntradaE1" name="fechaEntradaE1" placeholder="* Fecha de entrada" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="cantidadE1" name="cantidadE1" onkeypress="return NumCheck(event)"  placeholder="*cantidad" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="precioE1" name="precioE1" onkeypress="return NumCheck(event)" placeholder="Precio" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="proveedorE1" name="proveedorE1" placeholder="Proveedor" class="form-control">
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control" name="unidadE1" id="unidadE1">
								<option>Selecciona una unidad</option>
								<option>Pieza</option>
								<option>Gramos</option>
								<option>Litros</option>
								<option>Mililitros</option>
								<option>Caja</option>
								<option>Bolsa</option>
								<option>Otros</option>
							</select>

						</div>
					</div>
				</div>  
				<div class="row">
					<div class="alert alert-warning text-center">Estás restando cantidad a tu inventario.</div>	
				</div>
					
			</div>
			<div class="modal-footer">
				<button id='agreSalidaddf' class="btn btn-primary"> Agregar salida de producto</button>
				<button type="button" class="btn btn-white" id='btnCierSalia' data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
	</div>
</div>

