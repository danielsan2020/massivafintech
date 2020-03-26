<?php 
    include 'modelo/consultaTablas.php';
    $soporte = new consultaTabla();
	$rspCate = $soporte->categoria();
	///aqui realizamos la consulta para saber si tenemos tickets abiertos
	$valoId = $_SESSION['nUsuario'];

	$vaTick = $soporte->verificoTickety($valoId);
	$rspTickInfo = $vaTick->fetch_object();
	$idT = $rspTickInfo->id_soporte; //variable que nos dice si ya hay un ticket

	//obtenemos los tickets terminados modal
	$vaTickTermin = $soporte->ticketTerminados($valoId);
?>
<style>
	#form {
  width: 250px;
  margin: 0 auto;
  height: 50px;
}

#form p {
  text-align: center;
}

#form label {
  font-size: 80px;
}

input[type="radio"] {
  display: none;
  height:50px;
}

label {
  color: grey;
}

.clasificacion {
  direction: rtl;
  unicode-bidi: bidi-override;
  cursor: pointer;
}

label:hover,
label:hover ~ label {
  color: orange;
}

input[type="radio"]:checked ~ label {
  color: orange;
}

</style>
<script src="js/vista/soporteTecnico.js"></script>

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action">
			<?php if($idT == ''){?>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tnuevoElemento" > Nueva consulta</button>
			<?php }?>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#terminados" > Consultas terminadas</button>
		</div>
	</div>
</div>

<div class='row'><div class='col-md-12' id='alertAccion' name='alertAccion'></div></div>

<!--seccion de contenido-->
<div class="wrapper wrapper-content">
	<!--aviso en caso de que no tenga ningun ticket-->
	<?php if($idT == ''){?><div class="row text-center"><div class="col-lg-12"><div class="alert alert-warning"><b>Por el momento no cuentas con ninguna consulta abierta.</b></div></div></div><?php }?>

	<?php if($idT != ''){?>
	<div class="row text-center">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title"><h5>Número de Ticket <?= $idT;?><small class="m-l-sm">(Estatus: <?php if($rspTickInfo->estatus == 1){echo "Activo";}?>)</small></h5></div>
				<div class="ibox-content text-left">

					<h2><?= $rspTickInfo->titulo;?><br></h2>
					<p class="text-left"><?= $rspTickInfo->descripcion;?></p>
					<input type="hidden" value="<?= $idT;?>" id='ideTiUS' name='ideTiUS'><br>
					<?php 
						//seccion para los comentarios del cliente o soporte tecnico
						$resTic = $soporte->ticketsRespues2($idT);
						//imprimimos los comentarios
						while($resTicInfo = $resTic->fetch_object()){
							if($resTicInfo->tipo == 'cliente'){
								echo "<div class='alert alert-warning'><b>Respuesta: </b>".$resTicInfo->respuesta."<br><b>Escribe:</b> Usuario | <b>Fecha:</b> ".$resTicInfo->fechaCrea."</div>";
							}else{
								echo "<div style='background-color: #878991 !important; color:#fff' class='alert alert-secondary text-right' bg-secondary text-white><b>Respuesta</b>".$resTicInfo->respuesta."<br><b>Escribe:</b> Soporte tecnico | <b>Fecha:</b> ".$resTicInfo->fechaCrea."</div>";
							}
						}
					?>
					<div class="row text-right">
						<div class="input-group m-b">

							<span class="input-group-addon">Comentario y/o respuesta</span> 
							<textarea placeholder="" class="form-control" id="comenCli" name="comenCli"></textarea>
						</div>
					</div>
					
					<div class="row text-right">
						<a class="btn btn-primary" id="agregaResClien" ></i> Agregar Respuesta y/o comentario</a>
						<a class="btn btn-danger"  data-toggle="modal" data-target="#termina"  data-whatever="<?= $idT; ?>">Terminar</a>
					</div>

				</div>
				<div class="ibox-footer text-right">
					<span class="pull-left"><b>Fecha y hora de la consulta:</b> <?= $rspTickInfo->fechaCreacion;?> </span>
					<b>Atiende:</b> Soporte técnico
				</div>
			</div>
		</div>
	</div>
	<?php }?>

</div>

<!--seccion de modals-->
<div class="modal inmodal fade" id="tnuevoElemento" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Nueva consulta</h4>
				<small class="font-bold">*Recuerda que para una mejor atención solo puedes tener una consulta abierta.</small>
			</div>
			<!--valores ocultos-->
			<input type='hidden' name='id_usuario_reporta' id='id_usuario_reporta' value='<?php echo $_SESSION['nUsuario'];?>'>
			<div class="modal-body">
				
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="titulo" name="titulo" placeholder="Título" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class='form-control' nmae='id_categoria_ticket' id='id_categoria_ticket'>
								<option>Selecciona una categoría</option>
								<?php while($rspTablaInfocat = $rspCate->fetch_object()){ ?>
									<option value='<?= $rspTablaInfocat->id_categoria_soporte;?>'><?= $rspTablaInfocat->nombre;?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-12'>
					<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<textarea class='form-control' id='descripcion' name='descripcion' placeholder='Descripción de la consulta'></textarea>
						</div>
					
					</div>
				</div>

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id='nuevoTicket'> Generar</button>
				<button type="button" class="btn btn-white" data-dismiss="modal" id='btncerranuevo'> Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!--terminar ticket-->
<div class="modal inmodal fade" id="termina" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Terminar consulta</h4>
			</div>
			<div class="modal-body">
				<input type='hidden' name='idTermina' id='idTermina'>
				<div class='row'>
					<div class='col-md-12'>
						<div class="alert alert-danger text-center">¿Estás de acuerdo en terminar la consulta?</div>
					</div>
				</div>
				<div class='row'>
					<div class='col-md-12'>
						<div class="alert alert-warning text-center">
							Tu opinión es muy importante para nosotros, ayúdanos con tu calificación.<br>
							<form>
							<p class="clasificacion">
								<input id="radio1" type="radio" name="estrellas" value="5" style="cursor: pointer;">
								<label for="radio1" style="font-size: 40px;">★</label>
								<input id="radio2" type="radio" name="estrellas" value="4" style="cursor: pointer;">
								<label for="radio2" style="font-size: 40px;">★</label>
								<input id="radio3" type="radio" name="estrellas" value="3" style="cursor: pointer;">
								<label for="radio3" style="font-size: 40px;">★</label>
								<input id="radio4" type="radio" name="estrellas" value="2" style="cursor: pointer;">
								<label for="radio4" style="font-size: 40px;">★</label>
								<input id="radio5" type="radio" name="estrellas" value="1" style="cursor: pointer;">
								<label for="radio5" style="font-size: 40px;">★</label>
								</p>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id='terminarTicke'> Terminar</button>
				<button type="button" class="btn btn-white" data-dismiss="modal" id='btnTern'> Cerrar</button>
			</div>
		</div>
	</div>
</div>

<!--mostramos los tickets terminados-->
<div class="modal inmodal fade" id="terminados" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Consultas terminadas</h4>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
								<tr>
									<th>#</th>
									<th>Título</th>
									<th>Descripción</th>
									<th>Fecha</th>
									<th>Respuestas</th>
								</tr>
							</thead>
							<tbody>
								<?php while($vaTickTerminInfo = $vaTickTermin->fetch_object()){ ?>
								<tr class="gradeX">
									<td><?= $vaTickTerminInfo->id_soporte;?></td>
									<td><?= $vaTickTerminInfo->titulo;?></td>
									<td><?= $vaTickTerminInfo->descripcion;?></td>
									<td><?= $vaTickTerminInfo->fechaCreacion;?></td>
									<td>
										<?php
											///obtenemos las respuestas del ticket
											$IdenTick = $vaTickTerminInfo->id_soporte;
											//realizamos la consulta
											$resTickREs = $soporte->ticketTerminados($IdenTick);
											while($ticketsRespuesInfo = $resTickREs->fetch_object()){
												if($ticketsRespuesInfo->tipo == 'cliente'){
													echo "<b>Escribe:</b> Tu.<br> <b>Respuesta:</b> ".$ticketsRespuesInfo->respuesta."<br> <b>Fecha y hora: </b>".$ticketsRespuesInfo->fechaCrea;
												}elseif($ticketsRespuesInfo->tipo == 'soporte'){
													echo "<b>Escribe:</b> Massiva.<br> <b>Respuesta:</b> ".$ticketsRespuesInfo->respuesta."<br> <b>Fecha y hora: </b>".$ticketsRespuesInfo->fechaCrea;
												}else{
													echo "Sin respuesta";
												}
											}
										?>
									</td>
								</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal" id='btnTern'> Cerrar</button>
			</div>
		</div>
	</div>
</div>

     