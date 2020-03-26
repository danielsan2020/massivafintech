<div class="row wrapper border-bottom white-bg page-heading">
	<!--seccion de botonera-->
	<div class="col-sm-12">
		<div class="title-action">
			<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoClienteC"><i class="fa fa-plus-circle"></i> Solicitar factura</a>
		</div>
	</div>
</div>

<!--seccion de contenido-->
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Concentrado de facturas</h5>
			</div>
			<div class="ibox-content">

				<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example" >
					<thead>
						<tr>
							<th>N.° Factura</th>
							<th>Cliente</th>
							<th>Monto</th>
							<th>Status</th>
							<th>Ver</th>
							<th>Solicitar</th>
						</tr>
					</thead>
					<tbody>
						<tr class="gradeX">
							<td>11</td>
							<td>Bodegas generales</td>
							<td>$4,00</td>
							<td>Pendiente</td>
							<td><a class="btn btn-white btn-bitbucket"><i class="fa fa-file-pdf-o"></i></a><a class="btn btn-white btn-bitbucket"><i class="fa fa-file-code-o"></i></a></td>
							<td>
								<button class="btn btn-primary " type="button"><i class="fa fa-pencil-square-o"></i> <span class="bold">Editar</span></button>
								<button class="btn btn-danger " type="button"><i class="fa fa-times"></i> <span class="bold">Cancelar</span></button>
								<button class="btn btn-default " type="button"><i class="fa fa-refresh"></i> Reutilizar</button>
							</td>
						</tr>
					</tbody>
					<tfoot>
					<tr>
						<th>N.° Factura</th>
						<th>Cliente</th>
						<th>Monto</th>
						<th>Status</th>
						<th>Ver</th>
						<th>Solicitar</th>
					</tr>
					</tfoot>
					</table>
				</div>

			</div>
		</div>
	</div>
	</div>
</div>
<script src="js/general.js"></script>

     