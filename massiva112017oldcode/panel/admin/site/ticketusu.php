<?php 
	@session_start();
	include 'modelo/consultaTablas.php';
    $consultaTabla = new consultaTabla();
	$id_usuario = $_SESSION['id_usuario'];
	$rfc = $_SESSION['rfc'];
	
	$valorDescri = $consultaTabla->negocios();
    $texto = '';
    while($valorDescriInfo = $valorDescri->fetch_object()){
    	$texto .= "'".$valorDescriInfo->nombre."',";
    	//$texto .= "'".$valorDescriInfo->descripcion."',";
	}
	/* consultamos cuantos tickets tiene el usuario */
	$cantitic = $consultaTabla->cuantotic($id_usuario);
	$cantiticInfo = $cantitic->fetch_object();
	$mistic = $cantiticInfo->tickets;

	/* consultamos sus tickets guardados */
	$todostic = $consultaTabla->todostic($id_usuario);
?>


<script src="js/vista/carrito.js"></script>
<script src="js/vista/ticketsUsuarioSecci.js"></script>
<!-- aviso de tickets -->
<div class="row">
	<div class="col-md-12"><div class="alert text-center" style="background-color: darkgrey !important; color: #FFFFFF"><b>Almacena, visualiza y factura todos tus tickets de compra de forma sencilla.</b><br><br>
	La facturación puedes realizarla tú mismo o massiva lo puede hacer por ti, con un costo adicional.
	</div></div>
</div>

<!-- avisos para mnovimientos -->
<?php if ($tiusu == 1){?>
	<div class="row"><div class="alert alert-warning text-center">Tu solicitud de nuevo comercio se ha recibido, en un lapso de 12 horas estará disponible tu comercio.</div></div>
<?php }?>
<?php if ($tiusu == 3){?>
	<div class="row"><div class="alert alert-warning text-center">Se guardó en Tus tickets de compra.</div></div>
<?php }?>
<?php if ($vacarri == 1){?>
	<div class="row"><div class="alert alert-warning text-center">Tu compra se realizó con éxito.</div></div>
<?php }?>
<?php if ($tiusu == 5){?>
	<div class="row"><div class="alert alert-warning text-center">Se eliminó tu ticket.</div></div>
<?php }?>
<?php if ($tiusu == 2){?>
		<div class="row"><div class="alert alert-danger text-center">Ocurrió un error.</div></div>
	<?php }?>
	
<div class='row'><div id='alertAccion'></div></div>
<!--seccion de contenido-->
<div class="wrapper wrapper-content animated fadeInRight">
	<!-- seccion para la imagen -->
	<div class="col-md-2 text-center">
		<div class="ibox text-center">
			<div class="ibox-title"><h5>Ticket de compra</h5></div>
			<div class="ibox-content">
				<div class='row'>
				<div class='col-md-12 text-center'>
					<img src="img/tejemplo.png" id="imgSalida" style='width:100% !important; height:350px;'>
				</div>
				</div>
			</div>
		</div>
	</div>
	<!--facturas-->
<input type="hidden" id="f1v" name="f1v" value='0'>
<input type="hidden" id="f2v" name="f2v" value='0'>
<input type="hidden" id="f3v" name="f3v" value='0'>
<input type="hidden" id="f4v" name="f4v" value='0'>

<!--tickets-->
<input type="hidden" id="t1v" name="t1v">
<input type="hidden" id="t2v" name="t2v">
<input type="hidden" id="t3v" name="t3v">
<input type="hidden" id="t4v" name="t4v">

<!--actualizaciones-->
<input type="hidden" id="a1v" name="a1v" value='0'>
<input type="hidden" id="a2v" name="a2v" value='0'>
<input type="hidden" id="a3v" name="a3v" value='0'>
<input type="hidden" id="a4v" name="a4v" value='0'>
<input type="hidden" id="a5v" name="a5v" value='0'>
<input type="hidden" id="a6v" name="a6v" value='0'>
	<!-- formulario de registro -->
	<div class="col-md-10">
		<div class="ibox">
			<div class="ibox-title"><h5>Ticket de compra</h5></div>
			<div class="ibox-content">
				<div class="row">
				
				<form name="formularioGeneralNuevo" action="controlador/ticketsUsuarioControlador.php" method="POST" enctype="multipart/form-data">
                <input type='hidden' name='accion' id='accion' value='nuevotic'>	
				<div class='row'>
					<div class="col-md-6">
						<div class="input-group ">
							<span class="input-group-addon">Subir foto</span> 
							<div id="divFileUpload">
								<input type="file" class='form-control' name="fileinput" id="fileinput" accept="image/x-png,image/jpeg" capture='camera'>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group ">
							<span class="input-group-addon">Fecha de compra</span> 
							<input type="date" class="form-control" name='fecha' id='fecha'>
						</div>
					</div>
				</div>
				<hr>
				<div class='row'>
					<div class="col-md-4">
						<div class="input-group ">
							<span class="input-group-addon">Comercio</span> 
							<input type="text" id="alias" name="alias" class="form-control typeahead_1">
						</div>
					</div>
					<div class="col-md-6 text-center">
						<div class="input-group text-center">
							<button class="btn btn-primary" type='submit'>Guardar</button>
						</div>
					</div>
				</div>
				</div>
				<div class="row text-center">
				<br>
					<!--button class="btn btn-primary" data-toggle="modal" data-target="#nuevoTic">Facturar ahora</button-->&nbsp; &nbsp;&nbsp; 
				</form>
					<a class="btn btn-primary" data-toggle="modal" data-target="#nuevoCommmercio">¿No encuentras tu comercio? agrégalo</a>
				</div>
				<hr>
				<div class="text-left" >
					<small style="color:#9A9A9A !important">
						Recuerda que no todos los comercios facilitan su página para facturar pero desde massiva te ayudaremos para que puedas obtener dicha factura. Podemos facilitarte su número de teléfono, su correo para adjuntar el ticket y solicitar la factura o su página para facturar directamente.<br><br>
						
					</small>
				</div>
			</div>
		</div>
	</div>

	<!-- seccion para mostrar los tickets que tienes -->
	<div class="row">
		<div class="col-md-12">
			<?php if($mistic ==''){?>
				<div class="alert alert-warning text-right"><b>Lo sentimos, no cuentas con tickets comprados.</b>
			<?php }else{?>
				<div class="alert alert-warning text-right"><b>Tienes <span style="color: #f1005e; font-size: 20px;"><b><?php echo $mistic;?></b></span> ticket para que massiva facture. <small>(3 meses de vigencia)</small></b>
			<?php }?>
			<input type='hidden' name='mistic' id='mistic' value='<?php echo $mistic;?>'>
			</div>
		</div>
	</div>

	<br>
	<!--seccion de concentrado-->
	<div class="col-lg-12">
		<div class="ibox">
			<div class="ibox-title"><h5><b>Tus tickets de compra</b></h5></div>
			<div class="ibox-content">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
						<tr >
							<th class='text-center'>Ticket</th>
							<th class='text-center'>Fecha compra</th>
							<th class='text-center'>Comercio</th>
							<th class='text-center'>Status</th>
							<th class="text-center">Días para que factures</th>
							<th class='text-center'></th>
						</tr>
						</thead>
						<tbody>
						<?php while($todosticInfo = $todostic->fetch_object()){?>
							<tr>
								<th class='text-center'><a href='contenedor/clientes/<?php echo $rfc;?>/tickets/<?php echo $todosticInfo->foto;?>' target='_blank'><img src='contenedor/clientes/<?php echo $rfc;?>/tickets/<?php echo $todosticInfo->foto;?>' style='height:20px !important'></a></th>
								<th class="text-center"><?php echo $todosticInfo->fecha;?></th>
								<th class="text-center"><?php echo  $todosticInfo->comercio;?></th>
								<th class="text-center">
									<?php 
										$estatusValor = $todosticInfo->estatus;
										//echo $estatusValor;
										if($todosticInfo->estatus == '1'){
											if($todosticInfo->xmll == ''){
												echo "<b>Pendiente</b>";
											}else{
												echo "<b>Facturado</b>";
											}
										}
										if($todosticInfo->estatus == '2'){
													echo "Enviado";
												}
										
									?>
								</th>
								
								<th class="text-center">
									<?php 
										/* consultamos los dias del comercio */
										$comercioNombre = $todosticInfo->comercio;
										$diasComercio = $consultaTabla->diasComercio($comercioNombre);
										$diasComercioInfo = $diasComercio->fetch_object();
										$tiempo = $diasComercioInfo->tiempo;
										echo $tiempo;
									?>
								</th>
								<th class="text-center">
									<?php 
									if($todosticInfo->estatus =='1'){
									if( $todosticInfo->xmll == '' ){?>
									<button class="btn btn-primary" data-toggle="modal" data-target="#nuevoTic" data-unoo="<?php echo $comercioNombre; ?>">Facturar ahora</button>&nbsp;&nbsp;&nbsp;
									
									<!-- verifiamos que tenemos tickets disponbibles -->
									<?php if($mistic > 0){?>
									<button class="btn btn-primary" id='facma' value='<?php echo $todosticInfo->idTickets; ?>'>Facturar por massiva</button>&nbsp;&nbsp;&nbsp;
									<?php }else{ echo "Compra tickets para que facture massiva."; }?>

									<i class="fa fa-info-circle" title="Si quieres que massiva facture por ti, presiona el botón Facturar por massiva."></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<!--button class="btn btn-primary" data-toggle="modal" data-target="#subir" data-unoo="<?php echo $todosticInfo->idTickets; ?>">Subir XML</button-->&nbsp;&nbsp;&nbsp;
									<?php }}?>
									<?php if($todosticInfo->estatus =='2'){?>
										<button class="btn btn-danger" data-toggle="modal" data-target="#ModalEliminar" data-unoo="<?php echo $todosticInfo->idTickets; ?>">Borrar</button>&nbsp;&nbsp;&nbsp;
									<?php } if($todosticInfo->estatus == '3'){?>
										<b>Tu ticket se a facturado por massiva.</b>
									<?php }?>
								</th>
							</tr>
						<?php }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<br>
	</div>
	<br>
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-warning text-right"><b>¿Deseas que massiva facture por ti los tickets? Cómpra tú paquete de tickets aquí.</b>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-3">
			<div class="ibox">
				<div class="ibox-content product-box">
					<div class="product-imitation" style="background-image: url('contenedor/carrito/ticket.jpg') !important;  background-size: cover;" ></div>
					<div class="product-desc">
						<span class="product-price" style="font-size: 25px !important;">$99</span>
						<a href="#" class="product-name">Tickets de compras </a>
						<input type="hidden" name="paquetet1" id="paquetet1" value='t1'>
							<input type="hidden" name="ticketst1" id="ticketst1" value='10'>
							<input type="hidden" name="costot1" id="costot1" value='99'>
						<div class="small m-t-xs">Factura <span style="color: #f1005e; font-size: 20px;"><b>10</b></span> tickets de compra.<br></div>
						<div class="text-right">
							<br><button class="btn btn-primary btn-seleccionar" id='t1B'>Seleccionar</button>
						</div>
						
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="ibox">
				<div class="ibox-content product-box">
					<div class="product-imitation" style="background-image: url('contenedor/carrito/ticket.jpg') !important;  background-size: cover;" ></div>
					<div class="product-desc">
						<span class="product-price" style="font-size: 25px !important;">$199</span>
						<a href="#" class="product-name">Tickets de compras </a>
						<input type="hidden" name="paquetet2" id="paquetet2" value='t2'>
							<input type="hidden" name="ticketst2" id="ticketst2" value='25'>
							<input type="hidden" name="costot2" id="costot2" value='199'>
						<div class="small m-t-xs">Factura <span style="color: #f1005e; font-size: 20px;"><b>25</b></span> tickets de compra.</div>
						<div class="text-right">
							<br><button class="btn btn-primary btn-seleccionar" id='t2B'>Seleccionar</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="ibox">
				<div class="ibox-content product-box">
					<div class="product-imitation" style="background-image: url('contenedor/carrito/ticket.jpg') !important;  background-size: cover;" ></div>
					<div class="product-desc">
						<span class="product-price" style="font-size: 25px !important;">$349</span>
						<a href="#" class="product-name">Tickets de compras </a>
						<input type="hidden" name="paquetet3" id="paquetet3" value='t3'>
							<input type="hidden" name="ticketst3" id="ticketst3" value='50'>
							<input type="hidden" name="costot3" id="costot3" value='349'>
						<div class="small m-t-xs">Factura <span style="color: #f1005e; font-size: 20px;"><b>50</b></span> tickets de compra.</div>
						<div class="text-right">
							<br><button class="btn btn-primary btn-seleccionar" id='t3B'>Seleccionar</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="ibox">
				<div class="ibox-content product-box">
					<div class="product-imitation" style="background-image: url('contenedor/carrito/ticket.jpg') !important;  background-size: cover;" ></div>
					<div class="product-desc">
						<span class="product-price" style="font-size: 25px !important;">$699</span>
						<input type="hidden" name="paquetet4" id="paquetet4" value='t4'>
							<input type="hidden" name="ticketst4" id="ticketst4" value='100'>
							<input type="hidden" name="costot4" id="costot4" value='699'>
						<a href="#" class="product-name">Tickets de compras </a>
						<div class="small m-t-xs">Factura <span style="color: #f1005e; font-size: 20px;"><b>100</b></span> tickets de compra.</div>
						<div class="text-right">
							<br><button class="btn btn-primary btn-seleccionar" id='t4B'>Seleccionar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
<!--seccion de boton de compras-->
	<div class="row">
		<div class="col-md-12 text-center">
		<button class="btn btn-primary" type="button" id="realizaCompra">Realizar compra</button>	
		</div>
	</div>
	<br>
<hr>
<!-- modal para agregar nuevo comercio -->
<div class="modal inmodal fade" id="nuevoCommmercio" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-12">
						<input type="text" id="comercio" name="comercio" placeholder="Comercio" class="form-control" required>
					</div>
					<hr>
					<div class="col-md-12">
						<select class='form-control' name='ciudad' id='ciudad' required>
							<option>Selecciona una ciudad</option>
							<option value="Aguascalientes">Aguascalientes</option>
							<option value="Baja California">Baja California</option>
							<option value="Baja California Sur">Baja California Sur</option>
							<option value="Campeche">Campeche</option>
							<option value="Coahuila">Coahuila</option>
							<option value="Colima">Colima</option>
							<option value="Chiapas">Chiapas</option>
							<option value="Chihuahua">Chihuahua</option>
							<option value="CDMX">CDMX</option>
							<option value="Durango">Durango</option>
							<option value="Guanajuato">Guanajuato</option>
							<option value="Guerrero">Guerrero</option>
							<option value="Hidalgo">Hidalgo</option>
							<option value="Jalisco">Jalisco</option>
							<option value="México">México</option>
							<option value="Michoacán">Michoacán</option>
							<option value="Morelos">Morelos</option>
							<option value="Nayarit">Nayarit</option>
							<option value="Nuevo León">Nuevo León</option>
							<option value="Oaxaca">Oaxaca</option>
							<option value="Puebla">Puebla</option>
							<option value="Querétaro">Querétaro</option>
							<option value="Quintana Roo">Quintana Roo</option>
							<option value="San Luis Potosí">San Luis Potosí</option>
							<option value="Sinaloa">Sinaloa</option>
							<option value="Sonora">Sonora</option>
							<option value="Tabasco">Tabasco</option>
							<option value="Tamaulipas">Tamaulipas</option>
							<option value="Tlaxcala">Tlaxcala</option>
							<option value="Veracruz">Veracruz</option>
							<option value="Yucatán">Yucatán</option>
							<option value="Zacatecas">Zacatecas</option>
						</select>
					</div>
				</div>				
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Agregar</button>
				
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			
		</div>
	</div>
</div> 

<!-- modal para mostrar la informacion de comercio -->
<div class="modal inmodal fade" id="nuevoTic" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<!-- titulo -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
			<!-- Texto -->
			<div class="modal-body">
				<div class='row'>
					<div class="col-md-12">
						<div class="alert alert-danger text-center">
							<b>Estás a punto de salir al sitio del comercio para realizar la factura directa.<br>
							
						</div>
					</div>
					<div class="col-md-12 text-center">
						<div id='botonSoporte'></div>
					</div>
				</div>
			</div>

			<!-- pie del modal -->
			<div class="modal-footer">
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
	</div>
</div> 

<div class="modal inmodal fade" id="subir" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<!-- titulo -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>

			<!-- Texto -->
			<div class="modal-body">
				<form name="formularioGeneralNuevo" action="controlador/ticketsUsuarioControlador.php" method="POST" enctype="multipart/form-data">
				<input type='hidden' name='accion' id='accion' value='subirxm'>
				<input type='hidden' name='idTickets' id='idTickets' >
				<div class='row'>
					<div class="col-md-12">
						<input type='file' class='form-control' name='subirxml' id='subirxml'>
					</div>
				</div>
			</div>
			<!-- pie del modal -->
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Subir</button>
				</form>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
	</div>
</div> 

<!-- modal para elimianr ticket -->
<div class="modal inmodal fade" id="ModalEliminar" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
			<div class="modal-body">
			<form name="formularioGeneralNuevo" action="controlador/ticketsUsuarioControlador.php" method="POST" enctype="multipart/form-data">
				<input type='hidden' name='accion' id='accion' value='eliminar'>
				<input type="hidden" name="idTicketsEli" id="idTicketsEli">
    			<div class="alert alert-danger text-center">Si eliminas el ticket no podrás recuperarlo.</div>
			</div>
			<div class="modal-footer">
				<button type="submit" id='btnElimin' class="btn btn-w-m btn-danger"> Eliminar </button>
				<button type="button" id='btnEliminaDir' class="btn btn-white" data-dismiss="modal">Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal inmodal fade" id="facturaMa" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<div class="row text-center">
					<div class="cold-md-12 text-center">
						<iframe name="guardar" id="guardar" style="width: 90%; align-content: center; border: hidden; height: 30px;" class="text-center"></iframe>	
					</div>
				</div>
			</div>
			<div class="modal-body">
				
				<div class="col-md-12">
					<div class="alert alert-danger text-center"><b>Antes de presionar Enviar, revisa que hayas seleccionado los tickets deseados para que massiva los facture por ti.<br><br>
						Recuerda que se te descontarán automáticamente tus tickets comprados.<br><br> Si necesitas más, solo ve a Mi Carrito y compra la mejor opción para ti.
						</b> 
						</b></div>
				</div>
							
			</div>
				

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id='btncerranuevo' data-dismiss="modal"> Enviar</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>  

<!-- modal para realizar el pago de los tickets -->
<!--seccion de modal-->
<div class="modal inmodal fade" id="realizarpago" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Resumen de compra</h4>
            </div>
            <div class="modal-body">
                <form action="controlador/carritoControlador.php" method="post" enctype="multipart/form-data">
					<input type='hidden' name="montoFin" id="montoFin" value="">
					<input type='hidden' name="diferente" id="diferente" value="seccion">

					<!--para facturas-->
					<input type='hidden' name="paquete1E" id="paquete1E" value='0'>
					<input type='hidden' name="facturas1E" id="facturas1E"value='0' >
					<input type='hidden' name="costo1E" id="costo1E" value='0'>

					<input type='hidden' name="paquete2E" id="paquete2E" value='0'>
					<input type='hidden' name="facturas2E" id="facturas2E" value='0'>
					<input type='hidden' name="costo2E" id="costo2E" value='0'>

					<input type='hidden' name="paquete3E" id="paquete3E" value='0'>
					<input type='hidden' name="facturas3E" id="facturas3E" value='0'>
					<input type='hidden' name="costo3E" id="costo3E" value='0'>

					<input type='hidden' name="paquete4E" id="paquete4E" value='0'>
					<input type='hidden' name="facturas4E" id="facturas4E" value='0'>
					<input type='hidden' name="costo4E" id="costo4E" value='0'>
					
					<!--para tickets-->
					<input type='hidden' name="paquetet1E" id="paquetet1E" >
					<input type='hidden' name="ticketst1E" id="ticketst1E" >
					<input type='hidden' name="costot1E" id="costot1E" >

					<input type='hidden' name="paquetet2E" id="paquetet2E" >
					<input type='hidden' name="ticketst2E" id="ticketst2E" >
					<input type='hidden' name="costot2E" id="costot2E" >

					<input type='hidden' name="paquetet3E" id="paquetet3E" >
					<input type='hidden' name="ticketst3E" id="ticketst3E" >
					<input type='hidden' name="costot3E" id="costot3E" >

					<input type='hidden' name="paquetet4E" id="paquetet4E" >
					<input type='hidden' name="ticketst4E" id="ticketst4E" >
					<input type='hidden' name="costot4E" id="costot4E" >

					<!--para actualziaciones-->
					<input type='hidden' name="paqueteta1E" id="paqueteta1E"  value='0' >
					<input type='hidden' name="costota1E" id="costota1E" value='0' >

					<input type='hidden' name="paqueteta2E" id="paqueteta2E" value='0' >
					<input type='hidden' name="costota2E" id="costota2E" value='0' >

					<input type='hidden' name="paqueteta3E" id="paqueteta3E" value='0' >
					<input type='hidden' name="costota3E" id="costota3E" value='0' >

					<input type='hidden' name="paqueteta4E" id="paqueteta4E" value='0' >
					<input type='hidden' name="costota4E" id="costota4E" value='0' >

					<input type='hidden' name="paqueteta5E" id="paqueteta5E" value='0' >
					<input type='hidden' name="costota5E" id="costota5E" value='0' >

					<input type='hidden' name="paqueteta6E" id="paqueteta6E" value='0' >
					<input type='hidden' name="costota6E" id="costota6E" value='0' >

					
                <div class='row'>
                    <div class='col-md-12'>
                        <div class="alert alert-warning text-center" id="texto"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id='borraArchivo'> Proceder al pago</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!--seccion para el script de autocomepletado--->

<script src="js/plugins/typehead/bootstrap3-typeahead.min.js"></script>

<script>
$(document).ready(function(){ 
	/* Funcion para los mostrar predictivos los servicios */
	$('.typeahead_1').typeahead({ source: [<?php echo  $texto; ?>] });  
	/* Funcion para los mostrar predictivos los productos */
	 $('#fileinput').change(function(e) { addImage(e); });

             function addImage(e){
              var file = e.target.files[0],
              imageType = /image.*/;
            
              if (!file.type.match(imageType))
               return;
          
              var reader = new FileReader();
              reader.onload = fileOnload;
              reader.readAsDataURL(file);
             }
          
             function fileOnload(e) {
              var result=e.target.result;
              $('#imgSalida').attr("src",result);
             }
});
</script>