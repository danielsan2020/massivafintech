<?php
	//instanciamos el metodo para mostrar la informacion
	include 'modelo/consultaTablas.php';
    $consultaTabla = new consultaTabla();
    $rspTabla = $consultaTabla->logSoporteContable();
?>
<!--seccion de contenido-->
<script src="js/vista/ratefon.js"></script>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Registro de movimientos de tickets contables</h5>
			</div>
			<div class="ibox-content">

			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover dataTables-example" >
					<thead>
						<tr>
							<th>#</th>
							<th>Acciones</th>
							<th>Usuario</th>
							<th>Sección</th>
							<th>Fecha </th>
						</tr>
					</thead>
					<tbody>
						<?php while($rspTablaInfo = $rspTabla->fetch_object()){ ?>
						<tr class="gradeX">
							<td><?= $rspTablaInfo->idLogMoviento;?></td>
							<td><?= $rspTablaInfo->accion;?></td>
							<td><?= $rspTablaInfo->usuario;?></td>
							<td><?= $rspTablaInfo->seccion;?></td>
							<td><?= $rspTablaInfo->fechaCreacion;?></td>
							 
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


     