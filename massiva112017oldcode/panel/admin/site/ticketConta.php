<?php 
	@session_start();
	include 'modelo/consultaTablas.php';
    $consultaTabla = new consultaTabla();
	$id_usuario = $_SESSION['id_usuario'];
	$rfc = $_SESSION['rfc'];

	/* consultamos sus tickets guardados */
	$todostic = $consultaTabla->todosticConta();
?>


<script src="js/vista/carrito.js"></script>
<script src="js/vista/ticketsUsuarioSecci.js"></script>
<!-- aviso de tickets -->
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action">
			<a href="index.php?secc=dasconta" class="btn btn-primary"> Regresar</a>
		</div>
	</div>
</div>
<hr>


<!-- avisos para mnovimientos -->
<?php if ($tickterm == 1){?>
	<div class="row"><div class="alert alert-warning text-center">Se termino el ticket.</div></div>
<?php }?>


<!--seccion de contenido-->
<div class="wrapper wrapper-content animated fadeInRight">

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
									<button class="btn btn-primary" data-toggle="modal" data-target="#nuevoTicTer" data-unoo="<?php echo $comercioNombre; ?> " data-doss="<?php echo $todosticInfo->idTickets; ?>">Facturar ahora</button>&nbsp;&nbsp;&nbsp;
									<!-- verifiamos que tenemos tickets disponbibles -->
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
	
	
</div>
<!--seccion de boton de compras-->
	
<hr>
<!-- modal para mostrar la informacion de comercio -->
<div class="modal inmodal fade" id="nuevoTicTer" tabindex="-1" role="dialog"  aria-hidden="true">
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
							<b>Enseguida se muestra la dirección del sitio para para facturar.<br>
							
						</div>
					</div>
					<div class="col-md-12 text-center">
						<div id='botonSoporte'></div>
					</div>
				</div>
				<form name="formularioGeneralNuevo" action="controlador/ticketsUsuarioControlador.php" method="POST" enctype="multipart/form-data">
					<input type='text' name='accion' id='accion' value='terminarTickety'>
					<input type='text' name='idTicketsTer' id='idTicketsTer' >
			</div>

			<!-- pie del modal -->
			<div class="modal-footer">
				
					<button type="submit" class="btn btn-primary"> Terminar ticket</button>
				</form>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
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