<?php

    include 'modelo/consultaTablas.php';
    $consultaTabla = new consultaTabla();
		$usuarioSe = $_SESSION['id_usuario'];
		$rcCli = $_SESSION['rfc'];
		

		//obtenemos las consultas para datos predictivos
			$valorDescri = $consultaTabla->descripcionClaveServicios();
			$texto = '';
			while($valorDescriInfo = $valorDescri->fetch_object()){
				$texto .= "'".$valorDescriInfo->clave." | ".$valorDescriInfo->descripcion."',";
				//$texto .= "'".$valorDescriInfo->descripcion."',";
		}

		/* Obtenemos los productos para el materia prima */
		$valorDescriDos = $consultaTabla->descripcionClaveProductosMateria();
			$textoDos = '';
			while($valorDescriDosInfo = $valorDescriDos->fetch_object()){
				$textoDos .= "'".$valorDescriDosInfo->clave." | ".$valorDescriDosInfo->descripcion."',";
				//$texto .= "'".$valorDescriInfo->descripcion."',";
			}
			
		/* para productos */
		$valorDescriDosII = $consultaTabla->descripcionClaveProductosPro();
		$textoDos2 = '';
		while($valorDescriDosInfor = $valorDescriDosII->fetch_object()){
			$textoDos2 .= "'".$valorDescriDosInfor->clave." | ".$valorDescriDosInfor->descripcion."',";
			//$texto .= "'".$valorDescriInfo->descripcion."',";
		}

		/* Obtenemos los valores de las tablas */
		/* Valores para servicios */
		$sertabla = $consultaTabla->serviciosTabla($usuarioSe);
		/* Valores para porduictos */
		$protabla = $consultaTabla->productosTabla($usuarioSe);

?>

<!-- alerta -->
<div class="row">
    <div class="col-md-12" >
        <div class="alert alert-warning text-center"> <b>En Productos</b> podrás agregar todos los productos que tengas en tu comercio para el control correcto de tu inventario y así tener al día tu contabilidad. <br><b>En Servicios</b> podrás agregar los servicios que realiza tu empresa y así poder precargarlos a la hora de solicitar tus facturas.</div>
    </div>
</div>

<!-- alertas de acciones -->
<div class="row">
	<div class="col-md-12" >
		<?php if($serpro == 1){?>
			<div class="alert alert-warning text-center">Se agregó tu servicio.</div>
		<?php } if($serpro == 2){?>
			<div class="alert alert-warning text-center">Se eliminó tu servicio.</div> 
		<?php } if($serpro == 3){?>
			<div class="alert alert-warning text-center">Se agregó tu nuevo producto.</div>
		<?php } if($serpro == 4){?>
			<div class="alert alert-warning text-center">Se agregó tu nueva entrada al producto.</div> 
		<?php } if($serpro == 5){?>
			<div class="alert alert-warning text-center">Se agregó tu salida entrada al producto.</div> 
			<?php } if($serpro == 6){?>
			<div class="alert alert-warning text-center">Se editó tu producto.</div> 
		<?php } if($serpro == 9){?>
			<div class="alert alert-danger text-center">Ocurrió un error.</div> 
		<?php }?>
	</div>
</div>

<!-- botones de opciones -->    
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action">
			<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoservi"> Nuevo servicio</a>
			<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoprodu"> Nuevo producto</a>
			<!--a href="" class="btn btn-primary" data-toggle="modal" data-target="#reporte"> Carga masiva por proveedor</a-->
			<!--a href="" class="btn btn-primary" data-toggle="modal" data-target="#reporte"> Carga por xml</a-->
			<!--a href="index.php?secc=inventarioGeneral" class="btn btn-primary"> Reporte general</a-->
		</div>
	</div>
</div>

<!-- Alerta de accion -->
<div class="row"><div class="col-md-12" id="alertAccion"></div></div>

<!-- contenido de tablas -->
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
	        <div class="tabs-container">
	            <ul class="nav nav-tabs">
	                <li class="active"><a data-toggle="tab" href="#tab-1"> Servicios</a></li>
	                <li class=""><a data-toggle="tab" href="#tab-2">Productos</a></li>
	            </ul>

				<!-- seccion de servicios -->
	            <div class="tab-content">
	                <div id="tab-1" class="tab-pane active">
	                    <div class="panel-body">
	                    	<div class='col-md-12'>
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover dataTables-example" >
										<thead>
											<tr>
												<th>Nombre</th>
												<th>Código</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<?php while($sertablaInfo = $sertabla->fetch_object()){ ?>
													<tr class="gradeX">
														<td><?= $sertablaInfo->titulo;?></td>
														<td><?= $sertablaInfo->satcodigo;?></td>
														<th class="text-center">
														<a class="btn btn-danger" data-toggle="modal" data-target="#eliminaServicios" title="Eliminar" data-doohs="<?php echo $sertablaInfo->idServicio; ?>"><i class="fa fa-trash"></i> </a>
														</th>
													</tr>
											<?php }?>
										</tbody>
									</table>
								</div> 
							</div>   
	                    </div>
	                </div>

					<!-- seccion de productos -->
	                <div id="tab-2" class="tab-pane">
	                    <div class="panel-body">
	                    	<div class="table-responsive">
													<table class="table table-striped table-bordered table-hover dataTables-example" >
														<thead>
															<tr>
																<th></th>
																<th>Título</th>
																<th>Clave SAT</th>
																<th>Tipo</th>
																<th style='width: 10px !important;'>Cantidad</th>
																<th>Precio Compra</th>
																<th>Precio Venta</th>
																<th>Descuento</th>
																<th>Proveedor</th>
																<th>comentario</th>
																<th>Entradas / salidas</th>
																<th>Acciones</th>
																<th> Reporte</th>
																
															</tr>
														</thead>
														<tbody>
														<?php while($protablaInfo = $protabla->fetch_object()){ ?>
																	<tr class="gradeX">
																		<td class='text-center'><img src="contenedor/clientes/<?php echo $rcCli;?>/<?php echo $protablaInfo->foto;?>" style="height: 50px;" class="img-rounded"></td>
																		<td><?= $protablaInfo->satdes;?></td>
																		<td><?= $protablaInfo->unidadsat;?></td>
																		<td><?= $protablaInfo->tipo;?></td>
																		<td style='width: 10px !important;'><?= $protablaInfo->cantidad;?></td>
																		<td><?= $protablaInfo->precioCompra;?></td>
																		<td><?= $protablaInfo->precioVenta;?></td>
																		<td><?= $protablaInfo->descuento;?></td>
																		<td><?= $protablaInfo->proveedor;?></td>
																		<td><?= $protablaInfo->comentarios;?></td>
																		<td class="text-center">
																					<a class="btn btn-primary" data-toggle="modal" data-target="#agregarentrada" title="Nueva entrada" data-unoo="<?= $protablaInfo->idInventario; ?>"  data-doso="<?= $protablaInfo->cantidad; ?>"><i class="fa fa-caret-square-o-up"></i> </a>
																					<a class="btn btn-primary" data-toggle="modal" data-target="#agregaSalida" title="Nueva salida" data-unoo="<?= $protablaInfo->idInventario; ?>"  data-doso="<?= $protablaInfo->cantidad; ?>"><i class="fa fa-caret-square-o-down"></i> </a>
																			</div>
																		</td>
																		<td class="text-center">
																				<a href="" class="btn btn-primary" data-toggle="modal" data-target="#editar" title="Ver detalles / editar" data-unoo="<?= $protablaInfo->idInventario; ?>" data-doss="<?= $protablaInfo->foto; ?>"><i class="fa fa-search"></i> </a>
																				<a class="btn btn-danger" data-toggle="modal" data-target="#ModalEliminar" title="Eliminar" data-doos="<?= $protablaInfo->idInventario; ?>" data-dooss="<?= $protablaInfo->imagen; ?>"><i class="fa fa-trash"></i> </a>
																		</td>
																		<td class="text-center">
																				<a href="index.php?secc=inventarioParticular&valInvAc=<?= $protablaInfo->idInventario; ?>" class="btn btn-primary" title="Entradas|Salidas"><i class="fa fa-bar-chart-o"></i> </a>
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
	</div>
</div>

<!-- /////////////////////////////////////////Servicios///////////////////////////////////////////////////////////////////// -->
<!--nuevo servicio--->
<div class="modal inmodal fade" id="nuevoservi" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" >Nuevo servicio</h4>
			</div>
			<div class="modal-body">
			<form action="controlador/inventarioActivoControlador.php" method="post">
				<input type="hidden" name="accion" id="accion" value="nuevoServicio">	
				<input type="hidden" id="satcodigo" name="satcodigo" class="form-control ">
				<input type="hidden" id="titulo" name="titulo"  class="form-control ">
				<div class="row">
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="tituloGen" name="tituloGen" placeholder="Título" class="form-control typeahead_1">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="alert alert-warning text-center">Estás añadiendo un nuevo servicio.</div>	
				</div>
					
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Guardar</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal para eliminar servicio -->
<div class="modal inmodal fade" id="eliminaServicios" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Eliminar tu servicio</h4>
			</div>
			<form action="controlador/inventarioActivoControlador.php" method="post">
			<div class="modal-body">
				<input type="hidden" name="idServicio" id="idServicio">
				<input type="hidden" name="accion" id="accion" value='eliminaServicio'>
    			<div class="alert alert-danger text-center">Si eliminas el servicio no podrás recuperarlo.</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id='' class="btn btn-w-m btn-danger"> Eliminar</button>
				<button type="button" id='btnEliminaDir' class="btn btn-white" data-dismiss="modal">Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- /////////////////////////////////////////Productos///////////////////////////////////////////////////////////////////// -->
<!--nuevo producto--->
<div class="modal inmodal fade" id="nuevoprodu" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Nuevo Producto</h4>
			</div>
			<div class="modal-body">
				<form action="controlador/inventarioActivoControlador.php" method="post" name="nuevoPro" enctype="multipart/form-data">
				<input type="hidden" name="accion" id="accion" value="nuevoProducto">	
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control" name="tipo" id="tipo">
								<option>Tipo de producto</option>
								<option value='Materia prima'>Materia prima</option>
								<option value='Producto terminado'>Producto terminado</option>
							</select>

						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
								
								<input type="text" id="alias1" name="alias" placeholder="*Producto" class="form-control typeahead_2" disabled>
								<input type="text" id="alias2" name="alias" placeholder="*Producto" class="form-control typeahead_2" style="display:none;">
								<input type="text" id="alias3" name="alias" placeholder="*Producto" class="form-control typeahead_3" style="display:none;">
							
						</div>
					</div>
					
				</div>
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="hidden" placeholder="" name='satdes' id='satdes' class="form-control" />
							<input type="text" placeholder="*Descripción SAT" name='satdesT' id='satdesT' class="form-control" disabled />
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="hidden" placeholder="" name='unidadsat' id='unidadsat' class="form-control" />
							<input type="text" id="unidadsatt" name="unidadsatt"  placeholder="*Unidad SAT" class="form-control" disabled>

						</div>
					</div>
					
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="cantidad" name="cantidad" onkeypress="return NumCheck(event)" placeholder="Cantidad" class="form-control">
						</div>
					</div>
				</div>  
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="precioCompra" name="precioCompra" onkeypress="return NumCheck(event, this)" placeholder="Precio compra" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="precioVenta" name="precioVenta"  onkeypress="return NumCheck(event, this)" placeholder="Precio venta" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="descuento" name="descuento" onkeypress="return NumCheck(event, this)" placeholder="Descuento" class="form-control">                                          
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
							<input type="file" id="foto" name="foto" class="form-control">
						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<textarea name="comentarios" id="comentarios" class="form-control" placeholder="Comentarios"></textarea>

						</div>
					</div>
				</div>   
				
				
					
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Guardar</button>
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
				<h4 class="modal-title" id="titulo">Editar Producto</h4>
			</div>
			<div class="modal-body">
				<form action="controlador/inventarioActivoControlador.php" method="POST" name="nuevoPro" enctype="multipart/form-data">
				<input type="hidden" name="accion" id="accion" value="editarProducto">	
				<input type="hidden" name="idInventarioEdi" id="idInventarioEdi" value="">	
				<input type="hidden" name="fotova" id="fotova" value="">	
				
				<!-- seccion para poner el producto que se selecciono -->
				<div class='row'><div class='col-md-12 text-center' id='prodes'></div></div><hr>

				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control" name="tipo1" id="tipo1">
								<option>Tipo de producto</option>
								<option value='Materia prima'>Materia prima</option>
								<option value='Producto terminado'>Producto terminado</option>
							</select>

						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
								
								<input type="text" id="alias11" name="alias1" placeholder="*Producto" class="form-control typeahead_2" disabled>
								<input type="text" id="alias21" name="alias1" placeholder="*Producto" class="form-control typeahead_2" style="display:none;">
								<input type="text" id="alias31" name="alias1" placeholder="*Producto" class="form-control typeahead_3" style="display:none;">
							
						</div>
					</div>
					
				</div>
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="hidden" placeholder="" name='satdes1' id='satdes1' class="form-control" />
							<input type="text" placeholder="*Descripción SAT" name='satdesT1' id='satdesT1' class="form-control" disabled />
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="hidden" placeholder="" name='unidadsat1' id='unidadsat1' class="form-control" />
							<input type="text" id="unidadsatt1" name="unidadsatt1"  placeholder="*Unidad SAT" class="form-control" disabled>

						</div>
					</div>
					
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="cantidad1" name="cantidad1" onkeypress="return NumCheck(event)" placeholder="Cantidad" class="form-control">
						</div>
					</div>
				</div>  
				<!--//////////////////////////////-->
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="precioCompra1" name="precioCompra1" onkeypress="return NumCheck(event, this)" placeholder="Precio compra" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="precioVenta1" name="precioVenta1"  onkeypress="return NumCheck(event, this)" placeholder="Precio venta" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="descuento1" name="descuento1" onkeypress="return NumCheck(event, this)" placeholder="Descuento" class="form-control">                                          
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
							<input type="file" id="foto1" name="foto1" class="form-control">
						</div>
					</div>

				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<textarea name="comentarios1" id="comentarios1" class="form-control" placeholder="Comentarios"></textarea>

						</div>
					</div>
				</div>   
				
				
					
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Guardar</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
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
    			<div class="alert alert-danger text-center">Si lo eliminas no podrás recuperarlo.</div>
			</div>
			<div class="modal-footer">
				<button type="button" id='btnElimin' class="btn btn-w-m btn-danger"> Eliminar</button>
				<button type="button" id='btnEliminaDir' class="btn btn-white" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!--modal para la agregar movimientos de productos--->
<div class="modal inmodal fade" id="agregarentrada" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Agregar nuevas antidades</h4>
			</div>
			<form action="controlador/inventarioActivoControlador.php" method="post">
			<div class="modal-body">
				<input type="hidden" name="accion" id="accion" value='agregamosEntradaProducto'>	
				<input type="hidden" name="idInventarioE" id="idInventarioE">	
				<input type="hidden" name="CasntE" id="CasntE">	
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
							<input type="text" id="cantidadE" name="cantidadE" onkeypress="return NumCheck(event)"  placeholder="*Cantidad" class="form-control">
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
					<div class="alert alert-warning text-center">Estás añadiendo más cantidad a tu inventario.</div>	
				</div>
					
			</div>
			<div class="modal-footer">
				<button type='submit' class="btn btn-primary"> Agregar</button>
				<button type="button" class="btn btn-white" id='btnCierEntrad' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!--modal para la agregar salidas--->
<div class="modal inmodal fade" id="agregaSalida" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Agregar salidas de producto</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="idInventarioE1" id="idInventarioE1">	
				<input type="hidden" name="CasntE1" id="CasntE1">	
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
				<button id='agreSalidaddf' class="btn btn-primary"> Agregar</button>
				<button type="button" class="btn btn-white" id='btnCierSalia' data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!--seccion para el script de autocomepletado--->
<script src="js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
<script>
//funcion para los numeros
function NumCheck(e, field) {
  key = e.keyCode ? e.keyCode : e.which;
  // backspace
  if (key == 8) return true;
  // 0-9
  if (key > 47 && key < 58) {
    if (field.value == "") return true;
    regexp = /.[0-9]{5}$/;
    return !regexp.test(field.value);
  }
  // .
  if (key == 46) {
    if (field.value == "") return false;
    regexp = /^[0-9]+$/;
    return regexp.test(field.value);
  }
  // other key
  return false;
}
//funcion para letras
function soloLetras(e) {
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toLowerCase();
  letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
  especiales = "8-37-39-46";

  tecla_especial = false;
  for (var i in especiales) {
    if (key == especiales[i]) {
      tecla_especial = true;
      break;
    }
  }

  if (letras.indexOf(tecla) == -1 && !tecla_especial) {
    return false;
  }
}
$(document).ready(function(){ 
	$('.dataTables-example').DataTable({
		pageLength: 25,
		responsive: true,
		dom: '<"html5buttons"B>lTfgitp',
		buttons: [
			{extend: 'excel', title: 'ExampleFile'},
			{extend: 'pdf', title: 'ExampleFile'},
			
			
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



	/* accion para cuando se selecciona el tipo de producto */
	$('#tipo').on('change', function(){
		var val = $(this).val();
		var name = $('#tipo option:selected').text();
		if(name == 'Materia prima'){
			$("#alias1").css("display", "none");
			$("#alias2").css("display", "block");
			$("#alias3").css("display", "none");
		}
		if(name == 'Producto terminado'){
			$("#alias1").css("display", "none");
			$("#alias2").css("display", "none");
			$("#alias3").css("display", "block");
		}
	});

	$('#tipo1').on('change', function(){
		var val = $(this).val();
		var name = $('#tipo1 option:selected').text();
		if(name == 'Materia prima'){
			$("#alias11").css("display", "none");
			$("#alias21").css("display", "block");
			$("#alias31").css("display", "none");
		}
		if(name == 'Producto terminado'){
			$("#alias11").css("display", "none");
			$("#alias21").css("display", "none");
			$("#alias31").css("display", "block");
		}
	});

	/* seccion para dividir el producto */
	$("#alias2").blur(function(){

				var cadena = $('#alias2').val();
				var codigo = cadena.split('|')[0];
				var descripcion = cadena.split('|')[1];
				
				$('#satdes').val(codigo);
				$('#satdesT').val(codigo);

				$('#unidadsat').val(descripcion);
				$('#unidadsatt').val(descripcion);

    		
	});

	$("#alias3").blur(function(){

		var cadena = $('#alias3').val();
		var codigo = cadena.split('|')[0];
		var descripcion = cadena.split('|')[1];

		$('#satdes').val(codigo);
		$('#satdesT').val(codigo);

		$('#unidadsat').val(descripcion);
		$('#unidadsatt').val(descripcion);


	});

	$("#alias21").blur(function(){

		var cadena = $('#alias21').val();
		var codigo = cadena.split('|')[0];
		var descripcion = cadena.split('|')[1];

		$('#satdes1').val(codigo);
		$('#satdesT1').val(codigo);

		$('#unidadsat1').val(descripcion);
		$('#unidadsatt1').val(descripcion);


		});

		$("#alias31").blur(function(){

		var cadena = $('#alias31').val();
		var codigo = cadena.split('|')[0];
		var descripcion = cadena.split('|')[1];

		$('#satdes1').val(codigo);
		$('#satdesT1').val(codigo);

		$('#unidadsat1').val(descripcion);
		$('#unidadsatt1').val(descripcion);


	});

	/* Funcion para los mostrar predictivos los servicios */
	$('.typeahead_1').typeahead({ source: [<?php echo  $texto; ?>] }); 

	/* para materia prima */
	$('.typeahead_2').typeahead({ source: [<?php echo  $textoDos; ?>] });  

	/* para producto terminado */
	$('.typeahead_3').typeahead({ source: [<?php echo  $textoDos2; ?>] });  


	/* Funcion para los mostrar predictivos los productos */

	 $("#eliminaServicios").on("show.bs.modal", function(event) {
    
		var button = $(event.relatedTarget); // Button that triggered the modal
		var uvano = button.data("doohs");
		var modal = $(this);
		modal.find(".modal-body #idServicio").val(uvano);
	});

	 $("#ModalEliminar").on("show.bs.modal", function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var uno = button.data("doos");
    var dos = button.data("dooss");

    var modal = $(this);

    modal.find(".modal-body #idInventario2").val(uno);
    modal.find(".modal-body #imgref2").val(dos);
  });

  $("#btnElimin").click(function() {
    /*obtengo valores*/
    var accion = "eliminar";
    var idInventario2 = $("#idInventario2").val();
    var imgref2 = $("#imgref2").val();
    /*metodo ajax*/
    $.ajax({
      data: { accion, idInventario2, imgref2 },
      url: "controlador/inventarioActivoControlador2.php",
      type: "POST",
      success: function(response) {
        $("#alertAccion").append(
          '<div class="alert alert-warning text-center">Se elimino el producto</div>'
        );
        $("#ModalEliminar").modal("hide");
        window.setTimeout("location.reload()", 3000);
      },
      error: function(response, status, error) {
        $("#alertAccion").append(
          '<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>'
        );
        $("#ModalEliminar").modal("hide");
        window.setTimeout("location.reload()", 3000);
      }
    });
	});
	
	$("#btncerranuevo").click(function() {
    $("#nuevoPro").trigger("reset");
    $("#nuevoprodu").modal("hide");
    window.setTimeout("location.reload()");
  });

  ///para editar
  $("#btnCierraEdita").click(function() {
    $("#editar").modal("hide");
    window.setTimeout("location.reload()");
  });

  //boton para eliminar
  $("#btnEliminaDir").click(function() {
    $("#ModalEliminar").modal("hide");
    window.setTimeout("location.reload()");
  });

  //boton para agregar entradad
  $("#btnCierEntrad").click(function() {
    $("#agregarentrada").modal("hide");
    window.setTimeout("location.reload()");
  });

  //boton para salida
  $("#btnCierSalia").click(function() {
    $("#agregaSalida").modal("hide");
    window.setTimeout("location.reload()");
  });

  /**********************************************************************************************/
  /****************************************editar*************************************/
  $("#editar").on("show.bs.modal", function(event) {
		
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipient = button.data("unoo");
    var recipientttt = button.data("doss");

    $.ajax({
      data: { idInventarioEdi: recipient },
      url: "controlador/inventarioActivoControlador.php",
      type: "POST",
			dataType: "json",
      success: function(data) {
        /* texto del producto */
				$('#prodes').html('<strong>Tipo:'+data.tipo+' | '+data.satdes+' | '+data.unidadsat+'</strong>');
				$("#satdesT1").val(data.satdes);
				$("#unidadsatt1").val(data.unidadsat);
				$("#tipo1 option[value='" + data.tipo + "']").attr(
          "selected",
          "selected"
        );

				$("#cantidad1").val(data.cantidad);
				$("#precioCompra1").val(data.precioCompra);
				$("#precioVenta1").val(data.precioVenta);
				$("#descuento1").val(data.descuento);
				$("#proveedor1").val(data.proveedor);
				$("#comentarios1").html(data.comentarios);


      }
    });

    //se abre el modal
    var modal = $(this);
    modal.find(".modal-body #idInventarioEdi").val(recipient);
    modal.find(".modal-body #fotova").val(recipientttt);
  });

  
  /**********************************************************************************************/
  /****************************************agregar entrada de producto*************************************/
  $("#agregarentrada").on("show.bs.modal", function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var unoo = button.data("unoo");
    var doso = button.data("doso");

    var modal = $(this);

    modal.find(".modal-body #idInventarioE").val(unoo);
    modal.find(".modal-body #CasntE").val(doso);
  });

  //agregar la entrada
  $("#agreEntrada").click(function() {
    /*obtengo valores*/
    var accion = "agreEntrada";
    var idInventarioE = $("#idInventarioE").val();
    var fechaEntradaE = $("#fechaEntradaE").val();
    var cantidadE = $("#cantidadE").val();
    var precioE = $("#precioE").val();
    var proveedorE = $("#proveedorE").val();
    var unidadE = $("#unidadE").val();
    var CasntE = $("#CasntE").val();

    /*metodo ajax*/
    $.ajax({
      data: {
        accion,
        idInventarioE,
        fechaEntradaE,
        cantidadE,
        precioE,
        proveedorE,
        unidadE,
        CasntE
      },
      url: "controlador/inventarioActivoControlador2.php",
      type: "POST",
      success: function(response) {
        $("#alertAccion").append(
          '<div class="alert alert-warning text-center">Se agregó tu entrada al producto</div>'
        );
        $("#agregarentrada").modal("hide");
        window.setTimeout("location.reload()", 3000);
      },
      error: function(response, status, error) {
        $("#alertAccion").append(
          '<div class="alert alert-danger text-center">Ocurrió un error, por favor verificar tus datos .</div>'
        );
        $("#agregarentrada").modal("hide");
        window.setTimeout("location.reload()", 3000);
      }
    });
  });

  /**********************************************************************************************/
  /****************************************agregar entrada de producto*************************************/
  $("#agregaSalida").on("show.bs.modal", function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var unoo = button.data("unoo");
    var doso = button.data("doso");

    var modal = $(this);

    modal.find(".modal-body #idInventarioE1").val(unoo);
    modal.find(".modal-body #CasntE1").val(doso);
  });

  //agregar salida
  $("#agreSalidaddf").click(function() {
    /*obtengo valores*/
    var accion = "agreSalida";
    var idInventarioE1 = $("#idInventarioE1").val();
    var fechaEntradaE1 = $("#fechaEntradaE1").val();
    var cantidadE1 = $("#cantidadE1").val();
    var precioE1 = $("#precioE1").val();
    var proveedorE1 = $("#proveedorE1").val();
    var unidadE1 = $("#unidadE1").val();
    var CasntE1 = $("#CasntE1").val();

    /*metodo ajax*/
    $.ajax({
      data: {
        accion,
        idInventarioE1,
        fechaEntradaE1,
        cantidadE1,
        precioE1,
        proveedorE1,
        unidadE1,
        CasntE1
      },
      url: "controlador/inventarioActivoControlador2.php",
      type: "POST",
      success: function(response) {
        $("#alertAccion").append(
          '<div class="alert alert-warning text-center">Se agregó tu salida al producto</div>'
        );
        $("#agregaSalida").modal("hide");
        window.setTimeout("location.reload()", 3000);
      },
      error: function(response, status, error) {
        $("#alertAccion").append(
          '<div class="alert alert-danger text-center">Ocurrió un error, por favor verificar tus datos .</div>'
        );
        $("#agregaSalida").modal("hide");
        window.setTimeout("location.reload()", 3000);
      }
    });
  });
	
});
</script>