<?php
	include 'modelo/consultaTablas.php';
    $soporte = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
    $fechaCreacion = date("Y-m-d");

    //consultas de persona fisica
	$uno = $soporte->recordatorioClien();
?>
<!--seccion de contenido-->
<script src="js/vista/inventarioActivos.js"></script>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action">
			<a href="index.php?secc=dasconta" class="btn btn-primary"> Regresar</a>
		</div>
	</div>
</div>
<?php if($enviaRedor == 1){  ?>
<hr>
        <div class="col-lg-12"> <div class="alert alert-warning text-center" role="alert">Se envio el recordatorio</div></div>
<?php }?>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title"> <h5>Clientes massiva</h5></div>
			<div class="ibox-content">
				<div class="table-responsive">
				<table class="table table-bordered table-hover dataTables-example" >
					<thead>
						<tr>
							<th>No usuario</th>
							<th>Nombre</th>
							<th>RFC</th>
							<th>Correo</th>
							<th>Télefono</th>
							<th>Forma juridica</th>
							<th>Recordatorio</th>
							
						</tr>
					</thead>
					<tbody>
						<?php while($unoInfo = $uno->fetch_object()){
							$rfcConsu = $unoInfo->rfc;
						?>
						<tr>
							<td><?php echo $unoInfo->id_usuario;?></td>
							<td><?php echo $unoInfo->nombre;?> <?php echo $unoInfo->ape_paterno;?> <?php echo $unoInfo->ape_materno;?></td>
							<td><?php echo $unoInfo->rfc;?></td>
							<td><?php echo $unoInfo->correo;?></td>
							<td><?php echo $unoInfo->telefono;?></td>
							<td><?php echo ($unoInfo->formaJuridica == 'f')? "Persona fisica" :  "Persona Moral"?></td>
							<td class="text-center">
								<form action="controlador/recordatorioControlador.php" method="POST">
									<input type="hidden" name="correoRecordatorio" id="correoRecordatorio" value="<?php echo $unoInfo->correo;?>">
									<button type='submit' class="btn btn-primary">Enviar recordatorio</button>
								</form>
							</td>
							
						</tr>
						<?php  }?>
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
			</div>
			<div class="modal-body">
				
				<div class="row">
					<div class="alert alert-warning text-center">CIEF anterior</div>	
				</div>
				<div class="row">
					
					<input type="text" placeholder="Nueva clave CIEF" class="form-control">
					
				</div>
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" > Actualizar</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>
