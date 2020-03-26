<?php 
    include 'modelo/consultaTablas.php';
    require('plugins/fpdf/WriteHTML.php');
    $soporte = new consultaTabla();
  

 ?>

<script src="js/vista/cuentasbancarias.js"></script>
<script src="js/plugins/chartJs/Chart.min.js"></script>
<script src="js/demo/chartjs-demo.js"></script>
<!--seccion de contenido-->
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="alert alert-warning text-center">Tus datos solo se usarán para realizar la conciliación bancaria y poder tener tu contabilidad al día. <br>Todos tus datos de solo lectura están seguros con massiva, no se pueden realizar transacciones.</div>
	</div>
	<div class="row">
		<div class="col-md-12">
				<div class="ibox">
					<div class="ibox-title"><h5>Agrega tus bancos</h5></div>
					<div class="ibox-content text-center">
						<div class="row">
							<div class="col-md-12">
								<img src="contenedor/bancos/bancoppel.png" style="height: 40px;" alt="">
								<img src="contenedor/bancos/banbajio-logo.png" style="height: 40px;" alt="">
								<img src="contenedor/bancos/bbva_bancomermx.png" style="height: 40px;" alt="">
								<img src="contenedor/bancos/citibanamez-logo.png" style="height: 40px;" alt="">
								<img src="contenedor/bancos/hsbc-logo-png-transparent.png" style="height: 40px;" alt="">

							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-2">
								<div class="input-group m-b">
									<span class="input-group-addon">Usuario</span> 
									<input type="text" class="form-control" name="dirigido" id="dirigido" value="<?= $dirigido;?>">
								</div>
							</div>
							<div class="col-md-2">
								<div class="input-group m-b">
									<span class="input-group-addon">Clave</span> 
									<input type="text" class="form-control" name="dirigido" id="dirigido" value="<?= $dirigido;?>">
								</div>
							</div>
							<div class="col-md-2">
								<div class="input-group m-b">
									<button class="btn btn-primary" type="submit">Registrar</button>&nbsp; &nbsp;&nbsp; 
								</div>
							</div>
							<div class="col-md-3"></div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<p>¿Tu institución no está en la lista? Solicítala aquí.</p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-3"></div>
							<div class="col-md-2">
								<div class="input-group m-b">
									<span class="input-group-addon">Usuario</span> 
									<input type="text" class="form-control" name="dirigido" id="dirigido" value="<?= $dirigido;?>">
								</div>
							</div>
							<div class="col-md-2">
								<div class="input-group m-b">
									<span class="input-group-addon">Clave</span> 
									<input type="text" class="form-control" name="dirigido" id="dirigido" value="<?= $dirigido;?>">
								</div>
							</div>
							<div class="col-md-2">
								<div class="input-group m-b">
									<button class="btn btn-primary" type="submit">Registrar</button>&nbsp; &nbsp;&nbsp; 
								</div>
							</div>
							<div class="col-md-3"></div>
						</div>
					</div>
				</div>
			</div>
	</div>
	<div class="row">
		<div class="col-lg-4">
			<div class="row">
				<div class="col-md-12">
					<div class="ibox">
						<div class="ibox-title"><h5>Balance</h5></div>
						<div class="ibox-content text-center">
							 <div class="ibox float-e-margins">
	                            <div>
	                                <canvas id="doughnutChart" height="140"></canvas>
	                            </div>
		                    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-8">
			<div class="ibox">
				<div class="ibox-title"><h5>Transacciones</h5></div>
				<div class="ibox-content">
					<div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example" >
						<thead>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th class="text-center">¿Este movimiento fue?</th>
							</tr>
						</thead>
						<tbody>
							<th>Uno</th>
							<th>dir</th>
							<th>DSGGDFS518561dsfsddf</th>
							<td>2019/05/02</td>
							<th class="text-center">

								<a href="" class="btn btn-primary" data-toggle="modal" data-target="#devolucion" title="Ver detalles">Personal</a>
								<a href="" class="btn btn-primary" data-toggle="modal" data-target="#emprr" title="emprr">Empresa</a>
							</th>
						</tbody>
					</table>
					</div>
					
				</div>
			</div>
			
            
		</div>
	</div>
	<br>





 <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</div>

<!--seccion de modals-->
<div class="modal inmodal fade" id="emprr" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
               <div class="table-responsive">
					<table class="table table-striped table-bordered table-hover dataTables-example" >
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Fecha</th>
								<th>Monto</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<th>Uno</th>
							<th>dir</th>
							<th>DSGGDFS518561dsfsddf</th>
							<th class="text-center">
								<a href="" class="btn btn-primary" data-toggle="modal" data-target="#devolucion" title="Ver detalles">Asignar</a>
							</th>
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

