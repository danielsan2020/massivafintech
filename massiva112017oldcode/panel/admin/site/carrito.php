<!--seccion de contenido-->
<script src="js/vista/carrito.js"></script>
<!--seccion para la seleccion de campos-->

<!--facturas-->
<input type="hidden" id="f1v" name="f1v">
<input type="hidden" id="f2v" name="f2v">
<input type="hidden" id="f3v" name="f3v">
<input type="hidden" id="f4v" name="f4v">

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


<div class="wrapper wrapper-content">
	<div class="row">
                        <div class="col-md-12"><div class="alert alert-warning text-center"><b>Compra tus nuevos productos y servicios.</b></div></div>
	</div>

	<?php if($vacarri == 1){?>
	<div class="row">
                            <div class="col-md-12"><div class="alert alert-warning text-center"><b>Se ha realizado la compra exitosamente, en breve se hará el cargo automático a tu cuenta.</b></div></div>
	</div>
	<?php }?>


	<div class="row">
		<div class="ibox-content text-center">
			<form action='index.php' method="GET">
				
				<div class='row '>
					<div class='col-xs-12 col-md-3'><a id="iTodos"><button class="btn btn-primary" type="button" style='width: 100%'> Todos</button></a><br></div>
					<div class="clearfix visible-xs"><hr></div>
					<div class='col-xs-12 col-md-3'><a id="ifacturas"><button class="btn btn-primary" type="button"style='width: 100%'> Facturas extras</button></a><br></div>
					<div class="clearfix visible-xs"><hr></div>
					<div class='col-xs-12 col-md-3'><a id="iticket"><button class="btn btn-primary" type="button" style='width: 100%'> Tickets de compra</button></a><br></div>
					<div class="clearfix visible-xs"><hr></div>
					<div class='col-xs-12 col-md-3'><a id="iotros"><button class="btn btn-primary" type="button" style='width: 100%'> Otros</button></a><br></div>
					<div class="clearfix visible-xs"><hr></div>
				</div>
				
				<!--a id="iactualizaciones"><button class="btn btn-primary" type="button"> Actualizaciones ante el SAT</button></a-->
			
			</form>
		</div>
	</div>
	<hr>

	<!---CDFI -->
	<div id="facturas">
		<div class="row">
			<div class="col-md-3">
				<div class="ibox">
					<div class="ibox-content product-box">
						<div class="product-imitation" style="background-image: url('contenedor/carrito/facturas.jpg') !important;  background-size: cover;" ></div>
						<div class="product-desc">
							<span class="product-price" style="font-size: 25px !important;">$49</span>
							<a href="#" class="product-name"> Facturas extras</a>
							<div class="small m-t-xs">Agrega <span style="color: #f1005e; font-size: 20px;"><b>10</b></span> CFDI adicionales a tu paquete contratado.</div>
							<input type="hidden" name="paquete1" id="paquete1" value='f1'>
							<input type="hidden" name="facturas1" id="facturas1" value='10'>
							<input type="hidden" name="costo1" id="costo1" value='49'>
							<div class="text-right"> <button class="btn btn-primary btn-seleccionar" id="f1B">Seleccionar</button> </div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="ibox">
					<div class="ibox-content product-box">
						<div class="product-imitation" style="background-image: url('contenedor/carrito/facturas.jpg') !important;  background-size: cover;" ></div>
						<div class="product-desc">
							<span class="product-price" style="font-size: 25px !important;">$99</span>
							<a href="#" class="product-name"> Facturas extras</a>
							<div class="small m-t-xs">Agrega <span style="color: #f1005e; font-size: 20px;"><b>25</b></span> CFDI adicionales a tu paquete contratado.</div>
							<input type="hidden" name="paquete2" id="paquete2" value='f2'>
							<input type="hidden" name="facturas2" id="facturas2" value='25'>
							<input type="hidden" name="costo2" id="costo2" value='99'>
							<div class="text-right"> <button class="btn btn-primary btn-seleccionar" id='f2B'>Seleccionar</button> </div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="ibox">
					<div class="ibox-content product-box">
						<div class="product-imitation" style="background-image: url('contenedor/carrito/facturas.jpg') !important;  background-size: cover;" ></div>
						<div class="product-desc">
							<span class="product-price" style="font-size: 25px !important;">$189</span>
							<a href="#" class="product-name"> Facturas extras</a>
							<div class="small m-t-xs">Agrega <span style="color: #f1005e; font-size: 20px;"><b>50</b></span> CFDI adicionales a tu paquete contratado.</div>
							<input type="hidden" name="paquete3" id="paquete3" value='f3'>
							<input type="hidden" name="facturas3" id="facturas3" value='50'>
							<input type="hidden" name="costo3" id="costo3" value='189'>
							<div class="text-right"> <button class="btn btn-primary btn-seleccionar" id='f3B'>Seleccionar</button> </div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="ibox">
					<div class="ibox-content product-box">
						<div class="product-imitation" style="background-image: url('contenedor/carrito/facturas.jpg') !important;  background-size: cover;" ></div>
						<div class="product-desc">
							<span class="product-price" style="font-size: 25px !important;">$289</span>
							<a href="#" class="product-name"> Facturas extras</a>
							<div class="small m-t-xs">Agrega <span style="color: #f1005e; font-size: 20px;"><b>100</b></span> CFDI adicionales a tu paquete contratado.</div>
							<input type="hidden" name="paquete4" id="paquete4" value='f4'>
							<input type="hidden" name="facturas4" id="facturas4" value='100'>
							<input type="hidden" name="costo4" id="costo4" value='289'>
							<div class="text-right"> <button class="btn btn-primary btn-seleccionar" id='f4B'>Seleccionar</button> </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	
	<!---Tickets -->
	<div id="ticket">
		<div class="row">
			<div class="col-md-3">
				<div class="ibox">
					<div class="ibox-content product-box">
						<div class="product-imitation" style="background-image: url('contenedor/carrito/ticket.jpg') !important;  background-size: cover;" ></div>
						<div class="product-desc">
							<span class="product-price" style="font-size: 25px !important;">$99</span>
							<a href="#" class="product-name">Tickets de compra </a>
							<div class="small m-t-xs">Factura automática de  <span style="color: #f1005e; font-size: 20px;"><b>10</b></span> ticket de compra. Tienen 3 meses de vigencia.<br></div>
							<input type="hidden" name="paquetet1" id="paquetet1" value='t1'>
							<input type="hidden" name="ticketst1" id="ticketst1" value='10'>
							<input type="hidden" name="costot1" id="costot1" value='99'>
							<div class="text-right"> <button class="btn btn-primary btn-seleccionar" id='t1B'>Seleccionar</button> </div>
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
							<a href="#" class="product-name">Tickets de compra </a>
							<div class="small m-t-xs">Factura automática de  <span style="color: #f1005e; font-size: 20px;"><b>25</b></span> ticket de compra. Tienen 3 meses de vigencia.</div>
							<input type="hidden" name="paquetet2" id="paquetet2" value='t2'>
							<input type="hidden" name="ticketst2" id="ticketst2" value='25'>
							<input type="hidden" name="costot2" id="costot2" value='199'>
							<div class="text-right"> <button class="btn btn-primary btn-seleccionar" id='t2B'>Seleccionar</button> </div>
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
							<a href="#" class="product-name">Tickets de compra </a>
							<div class="small m-t-xs">Factura automática de  <span style="color: #f1005e; font-size: 20px;"><b>50</b></span> ticket de compra. Tienen 3 meses de vigencia.</div>
							<input type="hidden" name="paquetet3" id="paquetet3" value='t3'>
							<input type="hidden" name="ticketst3" id="ticketst3" value='50'>
							<input type="hidden" name="costot3" id="costot3" value='349'>
							<div class="text-right"> <button class="btn btn-primary btn-seleccionar" id='t3B'>Seleccionar</button> </div>
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
							<a href="#" class="product-name">Tickets de compra </a>
							<div class="small m-t-xs">Factura automática de  <span style="color: #f1005e; font-size: 20px;"><b>100</b></span> ticket de compra. Tienen 3 meses de vigencia.</div>
							<input type="hidden" name="paquetet4" id="paquetet4" value='t4'>
							<input type="hidden" name="ticketst4" id="ticketst4" value='100'>
							<input type="hidden" name="costot4" id="costot4" value='699'>
							<div class="text-right"> <button class="btn btn-primary btn-seleccionar" id='t4B'>Seleccionar</button> </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	
	<hr>
	<!----->
	<div id="otros">
		<div class="row">
			<div class="col-md-3">
				<div class="ibox">
					<div class="ibox-content product-box">
						<div class="product-imitation" style="background-image: url('contenedor/carrito/venta.jpg') !important;  background-size: cover;" ></div>
						<div class="product-desc">
							<span class="product-price" style="font-size: 25px !important;">$0</span>
							<a href="#" class="product-name">Punto de venta on-line </a>
							<div class="small m-t-xs"><span style="color: #f1005e; font-size: 20px;"><b>Próximamente</b></span> </div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="ibox">
					<div class="ibox-content product-box">
						<div class="product-imitation" style="background-image: url('contenedor/carrito/checador.jpg') !important;  background-size: cover;" ></div>
						<div class="product-desc">
							<span class="product-price" style="font-size: 25px !important;">$0</span>
							<a href="#" class="product-name">Checador de personal</a>
							<div class="small m-t-xs"><span style="color: #f1005e; font-size: 20px;"><b>Próximamente</b></span> </div>
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
	
           
	
	<div class="row">
		<div class="col-md-12"><div class="alert alert-warning text-center"><b>Escríbenos a <a style="color: #f1005e;" href='mailto:atencionclientes@massiva.mx'>atencionclientes@massiva.mx</a> o pregunta tus dudas en Soporte contable.</b></div></div>
	</div>
</div>
<hr>

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

					<!--para facturas-->
					<input type='hidden' name="paquete1E" id="paquete1E" >
					<input type='hidden' name="facturas1E" id="facturas1E" >
					<input type='hidden' name="costo1E" id="costo1E" >

					<input type='hidden' name="paquete2E" id="paquete2E" >
					<input type='hidden' name="facturas2E" id="facturas2E" >
					<input type='hidden' name="costo2E" id="costo2E" >

					<input type='hidden' name="paquete3E" id="paquete3E" >
					<input type='hidden' name="facturas3E" id="facturas3E" >
					<input type='hidden' name="costo3E" id="costo3E" >

					<input type='hidden' name="paquete4E" id="paquete4E" >
					<input type='hidden' name="facturas4E" id="facturas4E" >
					<input type='hidden' name="costo4E" id="costo4E" >
					
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
					<input type='hidden' name="paqueteta1E" id="paqueteta1E" value='0' >
					<input type='hidden' name="costota1E" id="costota1E"  value='0'>

					<input type='hidden' name="paqueteta2E" id="paqueteta2E" value='0'> 
					<input type='hidden' name="costota2E" id="costota2E" value='0' >

					<input type='hidden' name="paqueteta3E" id="paqueteta3E"  value='0'>
					<input type='hidden' name="costota3E" id="costota3E"  value='0'>

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