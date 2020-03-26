<?php
	//instanciamos el metodo para mostrar la informacion
	include 'modelo/blogModelo.php';
    $blogMo = new blogMo();
    $rspTabla = $blogMo->informacionTabla();
?>
<!--seccion de contenido-->
<script src="js/vista/blog.js"></script>
<div class="row wrapper border-bottom page-heading">
	<div class="col-lg-12">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
			<?php if($_SESSION['VALPAQ'] != 1){?>
                <li class="active"><a data-toggle="tab" href="#tab-4">Pago de impuestos</a></li>
				<li ><a data-toggle="tab" href="#tab-5">Declaraciones</a></li>
			<?php }
			if($_SESSION['VALPAQ'] == 1){
			?>
				<li class='active'><a data-toggle="tab" href="#tab-5">Declaraciones</a></li>
			<?php }?>
			
            </ul>
            <div class="tab-content">

                <div id="tab-4" class="tab-pane <?php if($_SESSION['VALPAQ'] != 1){ echo "active";}?> ">
                    <div class="panel-body">
                        <div class="row">
							<div class="col-lg-12">
								<div class="ibox float-e-margins">

									<div class="ibox-content">
										<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover dataTables-example" >
											<thead>
												<tr>
													<th>Mes</th>
													<th>Status</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												
												<!--th>Agosto</th>
												<th class="text-center">
													<div class="row">
														<div class="col-md-6">
															
														</div>
													</div>
												</th>

												<th-- class="text-center">
													<a href="" class="btn btn-default" data-toggle="modal" data-target="#pimpu" title="Ver"><i class="fa fa-search-plus"></i></a>
													<a href="" class="btn btn-primary" data-toggle="modal" data-target="#pbancos" title="Pagar"><i class="fa fa-bank"></i></a>

												</th-->
											</tbody>
										</table>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>

                <div id="tab-5" class="tab-pane <?php if($_SESSION['VALPAQ'] == 1){ echo "active";}?> ">
                    <div class="panel-body">
                          <div class="row">
							<div class="col-lg-12">
							<div class="ibox float-e-margins">

								<div class="ibox-content">
									<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover dataTables-example" >
										<thead>
											<tr>
												<th>Mes</th>
												<th>Status</th>
												<th>Saldo a favor</th>
												<th class="text-center"></th>

											</tr>
										</thead>
										<tbody>
											<!--th>Agosto</th>
											<th class="text-center">
												<div class="progress">
															  <div class="progress-bar progress-bar-warining" role="progressbar" aria-valuenow="40"
															  aria-valuemin="0" aria-valuemax="100" style="width:50%">
																40% Completado
															  </div>
															</div>
											</th>
											<th>$0</th>
											<th-- class="text-center">
												<a href="" class="btn btn-default" data-toggle="modal" data-target="#verdetalle" title="Ver"><i class="fa fa-search-plus"></i></a>
												<a href="" class="btn btn-primary" data-toggle="modal" data-target="#soliciCuen" title="Ver">Tengo un problema</a>

											</th-->
										</tbody>
									</table>
									</div>
								</div>
							</div>
						</div>
						</div>
						<div class="row"><div class="alert alert-warning text-center">Recuerda que si tu declaración es automática no tiene costo pero si es manual massiva cobra el 5% de lo devuelto.<br>
						Cuando el SAT realice la devolución se depositará automáticamente a tu cuenta registrada con massiva.</div></div>
						
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<br>

<!---seccion de modals-->
<div class="modal fade" tabindex="-1" id="pimpu" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<embed src="documentacion/blank.pdf" type="application/pdf" width="100%" height="600"></embed>			
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" id="pbancos" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
						<div class='row text-center'>
							<img src="img/bancos/afirme.png" class="" class="img-thumbnail" style="height: 50px;">
							<img src="img/bancos/amex.png" class="" class="img-thumbnail" style="height: 50px;">
							<img src="img/bancos/bancoazteca.png" class="" class="img-thumbnail" style="height: 50px;">
							<img src="img/bancos/banjercito.png" class="" class="img-thumbnail" style="height: 50px;">
							<img src="img/bancos/banjio.png" class="" class="img-thumbnail" style="height: 50px;">
						</div>
						<hr>
						<div class='row text-center'>
							<img src="img/bancos/banorte.png" class="" class="img-thumbnail" style="height: 50px;">
							<img src="img/bancos/banregio.png" class="" class="img-thumbnail" style="height: 50px;">
							<img src="img/bancos/bansefi.png" class="" class="img-thumbnail" style="height: 50px;">
							<img src="img/bancos/bansi.png" class="" class="img-thumbnail" style="height: 50px;">
							<img src="img/bancos/bbva.png" class="" class="img-thumbnail" style="height: 50px;">
						</div>
						<hr>
						<div class='row text-center'>
							<img src="img/bancos/cibanco.png" class="" class="img-thumbnail" style="height: 50px;">
							<img src="img/bancos/citibanamex.png" class="" class="img-thumbnail" style="height: 50px;">
							<img src="img/bancos/hsbc.png" class="" class="img-thumbnail" style="height: 50px;">
							<img src="img/bancos/inbursa.png" class="" class="img-thumbnail" style="height: 50px;">
							<img src="img/bancos/multiva.png" class="" class="img-thumbnail" style="height: 50px;">
						</div>
						<hr>
						<div class='row text-center'>
							<img src="img/bancos/santander.png" class="" class="img-thumbnail" style="height: 50px;">
							<img src="img/bancos/scotiabank.png" class="" class="img-thumbnail" style="height: 50px;">
						</div>
						
						
						
						<br>

				 </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" id="soliciCuen" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 text-center">
						<img src="img/logo.png" style="height:40px;" alt="">
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<!---Esto generar un ticket de soporte----->
						<label for="exampleInputPassword1">¿Qué problema tienes?</label>
						<select class="form-control">
							<option>Tuve un error en la captura de información</option>
							<option>Siento que voy a pagar mucho de impuestos</option>
							<option>Siento que hay un error por parte de massiva</option>
							<option>Ninguna de las anteriores</option>
						</select>
					</div>
					<br>
					<hr>
					<div class="col-md-12">
						<label for="exampleInputPassword1">Describe tu problema</label>
						<textarea name="" class="form-control"></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Enviar</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>