<?php
	//instanciamos el metodo para mostrar la informacion
	/*include 'modelo/inventarioActivoModelo.php';
    $invactivo = new invactivo();
    $rspTabla = $invactivo->informacionTabla();*/
?>
<!--seccion de contenido-->
<script src="js/vista/inventarioActivos.js"></script>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action">
			<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevaempresa"> Nueva sucursales</a>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" id="alertAccion"></div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title"> <h5>Empresas</h5></div>
			<div class="ibox-content">
				<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover dataTables-example" >
					<thead>
						<tr>
							<th>Razon social</th>
							<th>Dirección</th>
							<th>Registro patronal</th>
							<th>Fecha de preregistro</th>
							<th class="text-center">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<th>Uno</th>
						<th>dir</th>
						<th>DSGGDFS518561dsfsddf</th>
						<td>2019/05/02</td>
						<th class="text-center">

							<a href="" class="btn btn-primary" data-toggle="modal" data-target="#devolucion" title="Ver detalles"><i class="fa fa-search"></i></a>
							<a href="" class="btn btn-primary" data-toggle="modal" data-target="#devolucion" title="Ver empleados"><i class="fa fa-vcard"></i></a>
							<a href="" class="btn"  style="background-color: #f1005e; color: #FFFFFF" data-toggle="modal" data-target="#nuevoprodu" title="Eliminar"><i class="fa fa-trash-o"></i>
							</a>
						</th>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>

<!---detalle de factura-->
<div class="modal inmodal fade" id="nuevaempresa" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Detalle de factura</h4>
			</div>
			<div class="modal-body">
				
				<div class="row">
					<div class="alert alert-warning text-center">
						nombre o numero<br>
						Registro patronal<br>
						direccion<br>
						telefono<br>
						
						
						Aqui mostramos el pdf de la factura.</div>	
				</div>
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>
