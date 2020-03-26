<div class="row white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action"><a href="index.php?secc=ticketConta" class="btn btn-primary" > Regresar</a>
		<a href="index.php?secc=" class="btn btn-primary" > Terminados</a></div>
	</div>
</div>
<hr>
<!--seccion de contenido-->
<div class="wrapper wrapper-content animated fadeInRight">

	<!--seccion de concentrado-->
	<div class="col-lg-12">
		<div class="ibox">
			<div class="ibox-title">
				<h5><b>Tickets de compra pendientes</b></h5>
			</div>
			<div class="ibox-content">
				

				<table class="table table-striped">
					<thead>
					<tr>
						<th>Ticket</th>
						<th>XML</th>
						<th>Fecha compra</th>
						<th>Fecha terminación</th>
						<th>Comercio</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<th><img></th>
						<th></th>
						<th>28/01/2019</th>
						<th>28/01/2019</th>
						<th>Wallmart</th>
					
					</tr>
					<tr>
						<th><img></th>
						<th></th>
						<th>28/01/2019</th>
						<th>28/01/2019</th>
						<th>Wallmart</th>
						
					</tr>
					</tbody>
				</table>

			</div>
		</div>
		<br>
	</div>
	
	
</div>
<br>
<script src="js/general.js"></script>

 <div class="modal inmodal fade" id="nuevoClienteC" tabindex="-1" role="dialog"  aria-hidden="true">
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
					<div class="alert alert-danger text-center"><b>Estás a punto de salir al sitio del comercio para realizar la factura directa.<br><br>Es importante que subas inmediatamente después de realizar la factura el XML en Tus tickets de compra para tener un registro correcto de tus gastos en la sección Mis Proveedores y en el Balance general.
						</b></div>
				</div>
				<div class="col-md-12 text-center">
					<a href="http://venta.odm.com.mx/FacturacionElectronica/IndexFacturaElec.html" target="_blank"><button class="btn btn-primary" data-toggle="modal" data-target="#nuevoClienteC">Ir al sitio del comercio</button></a>
					<a href="http://venta.odm.com.mx/FacturacionElectronica/IndexFacturaElec.html" target="_blank"><button class="btn btn-primary" data-toggle="modal" data-target="#nuevoClienteC">Soporte del comercio</button></a>
				</div>
				<div class="col-md-12 text-center"><br></div>
				<div class="col-md-12">
					<div class="input-group m-b">
						
						<span class="input-group-addon">Subir archivo XML</span> 
						<input type="file" class="form-control">
					</div>
				</div>
				<br>
							
			</div>
				

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id='btncerranuevo' data-dismiss="modal"> Guardar XML</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>  


