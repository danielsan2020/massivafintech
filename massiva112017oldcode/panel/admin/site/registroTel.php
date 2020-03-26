<?php
	//instanciamos el metodo para mostrar la informacion
	include 'modelo/registroTel.php';
    $registroTel = new registroTel();
    $rspTabla = $registroTel->informacionTabla();
?>
<!--seccion de contenido-->
<script src="js/vista/ratefon.js"></script>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Registro de atención telefónica</h5>
			</div>
			<div class="ibox-content">

			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover dataTables-example" >
					<thead>
						<tr>
							<th>#</th>
							<th>Asunto</th>
							<th>Nombre de persona que solicita llamada</th>
							<th>Número telefónico</th>
							<th>Fecha de registro</th>
						</tr>
					</thead>
					<tbody>
						<?php while($rspTablaInfo = $rspTabla->fetch_object()){ ?>
						<tr class="gradeX">
							<td><?= $rspTablaInfo->idConWeb;?></td>
							<td><?= $rspTablaInfo->asunto;?></td>
							<td><?= $rspTablaInfo->nombre;?></td>
							<td><?= $rspTablaInfo->numero;?></td>
							<td><?= $rspTablaInfo->fechaRegistro;?></td>
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


     