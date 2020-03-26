<?php
	//instanciamos el metodo para mostrar la informacion
	include 'modelo/blogModelo.php';
    $blogMo = new blogMo();
    $rspTabla = $blogMo->informacionTabla();
?>
<!--seccion de contenido-->
<script src="js/vista/blog.js"></script>
<div class="row white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action"><a href="index.php?secc=dascontaF" class="btn btn-primary" > Regresar</a></div>
	</div>
</div>
<hr>
<div class="row wrapper border-bottom page-heading">
	<div class="row">
		<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title"> <h5>Declaraciones</h5></div>
			<div class="ibox-content">
				<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover dataTables-example" >
					<thead>
						<tr>
							<th>Periodo</th>
							<th>Declaración</th>
							<th>RFC</th>
							<th>CIEF</th>
							<th>Acuse mensual</th>
							<th>Fecha acuse</th>
							<th>Impuestos pagados</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>Marzo</th>
							<th class="text-center"><i class="fa fa-file-pdf-o"></i></th>
							<th>HEVA870404mp6</th>
							<th>**********</th>
							<th class="text-center"><i class="fa fa-file-pdf-o"></i></th>
							<th>2019/03/21</th>
							<th class="text-center"><i class="fa fa-check"></i></th>
							<th class="text-center">
								<a href="index.php?secc=mensActual" class="btn btn-primary" > Declaración mensual</a>
								<a href="#" class="btn btn-primary" > Subir documento</a>
								<a href="#" class="btn btn-primary" > Historial</a>

								<a href="#" class="btn btn-primary" > Liberar</a>
							</th>
						</tr>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
<br>


