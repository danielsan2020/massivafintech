<?php
	include 'modelo/consultaTablas.php';
    $soporte = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
    $fechaCreacion = date("Y-m-d");

    //consultas de persona fisica
	$uno = $soporte->totalClientesTotal();
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
<div class="row">
	<div class="col-md-12" id="alertAccion"></div>
</div>
<hr>
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
							<th>Comprobante</th>
							<th>Identificación</th>
							<th>Archivo .key</th>
							<th>Archivo .cer</th>
							<th>Clave FIEL</th>
							<th>Clave CIEC</th>
							
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
							<?php 
								$id_usuarioCon = $unoInfo->id_usuario;
								/* obtenemos los datos de documentos */
								$dos = $soporte->docclien($id_usuarioCon);
								while($dosInfo = $dos->fetch_object()){
							?>
							<td class='text-center'>
								<a href='contenedor/clientes/<?php echo $rfcConsu;?>/<?php echo $dosInfo->comprobante;?>' style='cursor:pointer' download="<?php echo $dosInfo->comprobante;?>"><i class='fa fa-file-code-o'></i></a> 
											
							</td>
							<td class='text-center'>
								<a href='contenedor/clientes/<?php echo $rfcConsu;?>/<?php echo $dosInfo->iden1;?>' style='cursor:pointer' download="<?php echo $dosInfo->iden1;?>"><i class='fa fa-file-code-o'></i></a> 
											
							</td>
							<td class='text-center'>
								<a href='contenedor/clientes/<?php echo $rfcConsu;?>/<?php echo $dosInfo->iden2;?>' style='cursor:pointer' download="<?php echo $dosInfo->iden2;?>"><i class='fa fa-file-code-o'></i></a> 
											
							</td>
							<td class='text-center'>
								<a href='contenedor/clientes/<?php echo $rfcConsu;?>/<?php echo $dosInfo->keyaar;?>' style='cursor:pointer' download="<?php echo $dosInfo->keyaar;?>"><i class='fa fa-file-code-o'></i></a> 
											
							</td>
							<td class='text-center'>
								<a href='contenedor/clientes/<?php echo $rfcConsu;?>/<?php echo $dosInfo->cerar;?>' style='cursor:pointer' download="<?php echo $dosInfo->cerar;?>"><i class='fa fa-file-code-o'></i></a> 
											
							</td>
							<td class="text-center">
								<a href="" class="btn btn-primary" data-toggle="modal" data-target="#verdetalle" title="Descuento">Actualizar CIEC</a>
							</td>
							
						</tr>
						<?php } }?>
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
