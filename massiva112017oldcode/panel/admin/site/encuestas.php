<?php
	//instanciamos el metodo para mostrar la informacion
	/*include 'modelo/registroTel.php';
    $registroTel = new registroTel();
    $rspTabla = $registroTel->informacionTabla();*/
?>
<!--seccion de contenido-->
<script src="js/vista/encuestas.js"></script>

	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-md-12">
			<div class="title-action"><a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoClienteC"><i class="fa fa-plus-circle"></i> Nueva encuestas</a></div>
		</div>
	</div>


<div class="wrapper wrapper-content animated fadeInRight">

	<div class="row">
		<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Encuestas internas</h5>
			</div>
			
			<div class="ibox-content">

			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover dataTables-example" >
					<thead>
						<tr>
							<th>#</th>
							<th>Titulo encuesta</th>
							<th>Pregunta uno</th>
							<th>Pregunta dos</th>
							<th>Pregunta tres</th>
							<th>Fecha Inicio</th>
							<th>Fecha final</th>
							<th>Ver resultados</th>
						</tr>
					</thead>
					<tbody>
						<?php while($rspTablaInfo = $rspTabla->fetch_object()){ ?>
						<tr class="gradeX">
							<td><?= $rspTablaInfo->idConWeb;?></td>
							<td><?= $rspTablaInfo->nombre;?></td>
							<td><?= $rspTablaInfo->numero;?></td>
							<td><?= $rspTablaInfo->fechaRegistro;?></td>
						</tr>
						<?php }?>

					</tbody>
					<tfoot>
						<tr>
							<th>#</th>
							<th>Titulo encuesta</th>
							<th>Pregunta uno</th>
							<th>Pregunta dos</th>
							<th>Pregunta tres</th>
							<th>Fecha Inicio</th>
							<th>Fecha Fecha</th>
							<th>Ver resultados</th>
						</tr>
					</tfoot>
				</table>
			</div>

			</div>
		</div>
	</div>
	</div>
</div>


     