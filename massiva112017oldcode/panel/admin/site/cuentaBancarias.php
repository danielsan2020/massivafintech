<?php 
	@session_start();	
	include 'modelo/consultaTablas.php';
	$id_usuario = $_SESSION['id_usuario'];
	$soporte = new consultaTabla();
	
	$rspBann = $soporte->bancosClientes($id_usuario);
	/* para los movimeintos */
	$rspBannMoiv = $soporte->movimientoCliente($id_usuario);
	
	/* para las cuentas */
	$rspBannMoiv2 = $soporte->movimientoFinalCliente($id_usuario);

	/* para ver si se muestra el banco */
	$rspbancoBoton = $soporte->bancoBoton($id_usuario);
	$rspbancoBotonInfo = $rspbancoBoton->fetch_object();
	$validaBton = $rspbancoBotonInfo->idBanco;
	
	/* consultamos los valores de movimientos para las graficas */
	$ingresosValor = $soporte->ingresosValor($id_usuario);
	$ingresosValorInfo = $ingresosValor->fetch_object();
	$ingresoTotal = $ingresosValorInfo->total;

	$egresosValor = $soporte->egresosValor($id_usuario);
	$egresosValorInfo = $egresosValor->fetch_object();
	$egresoTotal = $egresosValorInfo->total;

	$completoValor = $soporte->completoValor($id_usuario);
	$completoValorInfo = $completoValor->fetch_object();
	$totaltotal = $completoValorInfo->total;

?>

<script>
$(function () {
   
    var doughnutData = {
        labels: ["Ingresos","Gastos" ],
        datasets: [{
            data: [<?= $ingresoTotal;?>,<?= $egresoTotal?>],
            backgroundColor: ["#eac52d","#5b5b5f"]
        }]
	} ;
	
    var doughnutOptions = { responsive: true };
    var ctx4 = document.getElementById("doughnutChart").getContext("2d");
    new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

	/* segunda grafica total */
	var doughnutData1 = {
        labels: ["Total" ],
        datasets: [{
            data: [<?= $totaltotal;?>],
            backgroundColor: ["#eac52d"]
        }]
	} ;

	var doughnutOptions1 = { responsive: true };
    var ctx41 = document.getElementById("doughnutChart2").getContext("2d");
    new Chart(ctx41, {type: 'doughnut', data: doughnutData1, options:doughnutOptions1});
});
</script>

<script src="js/plugins/chartJs/Chart.min.js"></script>
<!--seccion de contenido-->
<div class="wrapper wrapper-content animated fadeInRight">
	<!-- boton para actualziacion manual  -->
	<?php if($validaBton != ''){ ?>
	<div class='row'>
		<div class='col-md-12'>
			<form action="controlador/apiafter.php" method="POST" id="atcdd" name="atcdd">
				<input type='hidden' id='id_usuario' name='id_usuario' value='<?= $id_usuario;?>'>
				<button class='btn btn-primary ladda-button ' data-style="slide-right" style='width:100%' type='submit'>Actualizar ahora mis cuentas </button>
			</form>
		</div>
	</div>
	<hr>
	<?php }?>
	<!-- seccion de graficas -->
	<div class='row'>
		<div class='col-md-6'>
			<div class="ibox">
				<div class="ibox-content text-center">
						<div class="ibox float-e-margins">
							<div><canvas id="doughnutChart" height="60" ></canvas></div>
						</div>
				</div>
			</div>
		</div>
		<div class='col-md-6'>
			<div class="ibox">
				<div class="ibox-content text-center">
						<div class="ibox float-e-margins">
						<div>
							<canvas id="doughnutChart2" height="60" ></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="alert alert-warning text-center">Tus datos solo se usarán para realizar la conciliación bancaria y poder tener tu contabilidad al día. <br><b>
		Los datos registrados serán de solo lectura y no se pueden realizar transacciones. Nunca se compartirán con terceros ya que massiva no comparte datos confidenciales.</b></div>
	</div>
	<br>

	<div class="row"><div id='alertAccion'></div></div>

	<?php if ($vaBan == 1){?>
		<div class="row"><div class="alert alert-warning text-center">Tu solicitud de nuevo banco se registró con éxito</div></div>
	<?php }?>
	<?php if ($vaBan == 3){?>
		<div class="row"><div class="alert alert-warning text-center">Se agregó tu banco</div></div>
	<?php }?>
	<?php if ($vaBan == 4){?>
		<div class="row"><div class="alert alert-warning text-center">Se eliminó tu banco</div></div>
	<?php }?>
	<?php if ($vaBan == 5){?>
		<div class="row"><div class="alert alert-warning text-center">Se agregó tu movimiento manual</div></div>
	<?php }?>
	<?php if ($vaBan == 6){?>
		<div class="row"><div class="alert alert-warning text-center">Se agregaron nuevos movimientos</div></div>
	<?php }?>
	<?php if ($vaBan == 7){?>
		<div class="row"><div class="alert alert-warning text-center">No se encontraron nuevos movimientos</div></div>
	<?php }?>
	<?php if ($vaBan == 8){?>
		<div class="row"><div class="alert alert-warning text-center">Se tomará en cuenta tu movimiento seleccionado</div></div>
	<?php }?>
	<?php if ($vaBan == 9){?>
		<div class="row"><div class="alert alert-warning text-center">No se tomará en cuenta tu movimiento seleccionado</div></div>
	<?php }?>
	<?php if ($vaBan == 10){?>
		<div class="row"><div class="alert alert-warning text-center">Tu movimiento seleccionado es un ingreso</div></div>
	<?php }?>
	<?php if ($vaBan == 11){?>
		<div class="row"><div class="alert alert-warning text-center">Tu movimiento seleccionado es un gasto</div></div>
	<?php }?>
	<?php if ($vaBan == 2){?>
		<div class="row"><div class="alert alert-danger text-center">Ocurrió un problema</div></div>
	<?php }?>

	<div class='row'>
		<!-- forularios de bancos -->
		<div class='col-md-12'>
			<div class="ibox">
			<div class="ibox-title"><h5>Agrega tus bancos</h5></div>
				<div class="ibox-content text-center">
					<div class="row">
						<div class="col-md-12">
							<img src="contenedor/bancos/bancoazteca.png" class="logoBanco" id='des1' style='cursor:pointer; height:40px;'>
							<!--imgsrc="contenedor/bancos/banjio.png" class="logoBanco" id='des1' -->
							<img src="contenedor/bancos/bancoppel.png" class="logoBanco" id='des2'   style='cursor:pointer'>
							<img src="contenedor/bancos/banorte.png" class="logoBanco" id='des3'  style='cursor:pointer'>
							<img src="contenedor/bancos/bancomer.png" class="logoBanco" id='des4'   style='cursor:pointer'>
							<img src="contenedor/bancos/citibanamex.png"  class="logoBanco" id='des5'  style='cursor:pointer'>
						</div>
						<div class="row">
						<div class="col-md-12">
							<img src="contenedor/bancos/hsbc.png"  class="logoBanco" id='des6'  style='cursor:pointer'>
							<!--img"src="contenedor/bancos/inbursa.png" class="logoBanco" id='des1' -->
							<img src="contenedor/bancos/santander.png"  class="logoBanco" id='des7'  style='cursor:pointer'>
							<img src="contenedor/bancos/scotiabank.png"  class="logoBanco" id='des8'  style='cursor:pointer'>
							<img src="contenedor/bancos/amex.png" class="logoBanco" id='des9'  style='cursor:pointer;'>
							<img src="contenedor/bancos/banjio.png" class="logoBanco" id='des10'  style='cursor:pointer;'>
						</div>
					</div>
					<hr>

					<!-- Azteca -->
					<div class="row" id="azteca" style='display:none'>
						
						<form action="controlador/bancosControlador.php" method="POST" id="atcdd1" name="atcdd1">
							<input type="hidden" name="accion"  value="nuevoBan">
							<input type="hidden" name="claveBanco"  value="azteca_mx">
							<input type="hidden" name="fecha"  value="0">
							
							<div class="col-md-3 text-center">
								<img src="contenedor/bancos/bancoazteca.png" style='height:50px;' >
							</div>

							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">Usuario</span> 
									<input type="text" class="form-control" name="usuarioBanco" >
								</div>
							</div>

							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">Contraseña</span> 
									<input type="text" class="form-control" name="contraBanco" >
								</div>
							</div>

							<div class="col-md-3">
								<div class="input-group m-b">
									<button class="btn btn-primary" type="submit" style='width:100% !important'>Agregar</button>&nbsp; &nbsp;&nbsp; 
								</div>
							</div>
						</form>
						<hr>
					</div>

					<!-- Banjio -->
					<div class="row bank" id="banjio" style='display:none'>
						
						<form action="controlador/bancosControlador.php" method="POST" id="atcdd2" name="atcdd2">
							<input type="hidden" name="accion"  value="nuevoBan">
							<input type="hidden" name="claveBanco"  value="banbajio_mx">
							<input type="hidden" name="fecha" value="0">
							<div class="col-md-1"></div>
							<div class="col-md-2">
								<img src="contenedor/bancos/banjio.png" style="cursor: pointer;" class="logoBancoSeleccionado" alt="">
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">Usuario</span> 
									<input type="text" class="form-control" name="usuarioBanco" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">Clave de acceso</span> 
									<input type="text" class="form-control" name="contraBanco" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<button class="btn btn-primary" type="submit">Agregar</button>&nbsp; &nbsp;&nbsp; 
								</div>
							</div>
						</form>
						<hr>
					</div>

					<!-- BanCoppel -->
					<div class="row" id="bancoppel" style='display:none'>
						
						<form action="controlador/bancosControlador.php" method="POST" id="atcdd3" name="atcdd3">
							<input type="hidden" name="accion" value="nuevoBan">
							<input type="hidden" name="claveBanco"  value="bancoppel_mx">
							<input type="hidden" name="fecha"  value="0">
							
							<div class="col-md-3">
								<img src="contenedor/bancos/bancoppel.png" style="height:50px;">
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">Usuario</span> 
									<input type="text" class="form-control" name="usuarioBanco"  >
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">Contraseña</span> 
									<input type="text" class="form-control" name="contraBanco" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<button class="btn btn-primary" type="submit">Agregar</button>&nbsp; &nbsp;&nbsp; 
								</div>
							</div>
						</form>
						<hr>
					</div>

					<!-- Banorte -->
					<div class="row" id="banorte" style='display:none'>
						
						<form action="controlador/bancosControlador.php" method="POST" id="atcdd4" name="atcdd4">
							<input type="hidden" name="accion"  value="nuevoBan">
							<input type="hidden" name="claveBanco"  value="banorte_mx">
							<input type="hidden" name="fecha" value="0">

							<div class="col-md-3">
								<img src="contenedor/bancos/banorte.png" style='height:50px;'>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">Usuario</span> 
									<input type="text" class="form-control" name="usuarioBanco">
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">Contraseña</span> 
									<input type="text" class="form-control" name="contraBanco" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<button class="btn btn-primary" type="submit">Agregar</button>&nbsp; &nbsp;&nbsp; 
								</div>
							</div>
						</form>
						<hr>
					</div>

					<!-- BBVA -->
					<div class="row" id="bbva" style='display:none'>
						
						<form action="controlador/bancosControlador.php" method="POST" id="atcdd5" name="atcdd5">
							<input type="hidden" name="accion"  value="nuevoBan">
							<input type="hidden" name="claveBanco"  value="bbva_mx">
							<input type="hidden" name="fecha"  value="0">
							<div class="col-md-3">
								<img src="contenedor/bancos/bancomer.png" style='height:50px;'>	
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">Usuario</span> 
									<input type="text" class="form-control" name="usuarioBanco" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">Clave</span> 
									<input type="text" class="form-control" name="contraBanco" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<button class="btn btn-primary" type="submit">Agregar</button>&nbsp; &nbsp;&nbsp; 
								</div>
							</div>
						</form>
						<hr>
					</div>

					<!-- Citibanamex -->
					<div class="row " id="citibanamex" style='display:none'>
						
						<form action="controlador/bancosControlador.php" method="POST" id="atcdd6" name="atcdd6">
							<input type="hidden" name="accion"  value="nuevoBan">
							<input type="hidden" name="claveBanco"  value="banamex">
							<input type="hidden" name="fecha"  value="0">
							<div class="col-md-1"></div>
							<div class="col-md-2">
								<img src="contenedor/bancos/citibanamex.png" style='height:50px;'>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">Número cliente</span> 
									<input type="text" class="form-control" name="usuarioBanco" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">Clave de acceso</span> 
									<input type="text" class="form-control" name="contraBanco">
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<button class="btn btn-primary" type="submit">Agregar</button>&nbsp; &nbsp;&nbsp; 
								</div>
							</div>
						</form>
						<hr>
					</div>

					<!-- HSBC -->
					<div class="row " id="hsbc" style='display:none'>
						<form action="controlador/bancosControlador.php" method="POST" id="atcdd7" name="atcdd7">
							<input type="hidden" name="accion"  value="nuevoBan">
							<input type="hidden" name="claveBanco"  value="hsbcmx">
							<div class="col-md-2">
								<img src="contenedor/bancos/hsbc.png" style='height:50px;'>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">Usuario</span> 
									<input type="text" class="form-control" name="usuarioBanco">
								</div>
							</div>
							<div class="col-md-2">
								<div class="input-group m-b">
									<span class="input-group-addon">Contraseña</span> 
									<input type="text" class="form-control" name="contraBanco">
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">Fecha de nacimiento</span> 
									<input type="text" class="form-control" name="fecha" id="fecha">
								</div>
							</div>
							<div class="col-md-2">
								<div class="input-group m-b">
									<button class="btn btn-primary" type="submit">Agregar</button>&nbsp; &nbsp;&nbsp; 
								</div>
							</div>
						</form>
						<hr>
					</div>

					<!-- Inbursa -->
					<div class="row " id="inbursa" style='display:none'>
						
						<form action="controlador/bancosControlador.php" method="POST" id="atcdd8" name="atcdd8">
							<input type="hidden" name="accion"  value="nuevoBan">
							<input type="hidden" name="claveBanco" value="inbursa_mx">
							<input type="hidden" name="fecha" value="0">
							<div class="col-md-3">
								<img onClick="muestra_oculta('inbursa')"src="contenedor/bancos/inbursa.png" class="logoBancoSeleccionado" alt="" style="cursor: pointer;">
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">Usuario</span> 
									<input type="text" class="form-control" name="usuarioBanco" >
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<span class="input-group-addon">NIP</span> 
									<input type="text" class="form-control" name="contraBanco"  >
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<input type="text" class="form-control" name="dirigido"  >
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group m-b">
									<button class="btn btn-primary" type="submit">Agregar</button>&nbsp; &nbsp;&nbsp; 
								</div>
							</div>
						</form>
						<hr>
					</div>

					<!-- Santander -->
					<div class="row " id="santander" style='display:none'>
						
						<form action="controlador/bancosControlador.php" method="POST" id="atcdd9" name="atcdd9">
							<input type="hidden" name="accion" value="nuevoBan">
							<input type="hidden" name="claveBanco" value="santandermx">
							<input type="hidden" name="fecha" value="0">
							
							<div class="col-md-3">
								<img  src="contenedor/bancos/santander.png" style='height:60px;'>	
							</div>
							<div class="col-md-3"><br>
								<div class="input-group m-b">
									<span class="input-group-addon">Código de cliente</span> 
									<input type="text" class="form-control" name="usuarioBanco">
								</div>
							</div>
							<div class="col-md-3"><br>
								<div class="input-group m-b">
									<span class="input-group-addon">Contraseña</span> 
									<input type="text" class="form-control" name="contraBanco">
								</div>
							</div>
							<div class="col-md-3"><br>
								<div class="input-group m-b">
									<button class="btn btn-primary" type="submit">Agregar</button>&nbsp; &nbsp;&nbsp; 
								</div>
							</div>
						</form>
						<hr>
						
					</div>

					<!-- Scotiabank -->
					<div class="row " id="scotiabank" style='display:none'>
						<form action="controlador/bancosControlador.php" method="POST" id="atcdd88" name="atcdd88">
							<input type="hidden" name="accion" value="nuevoBan">
							<input type="hidden" name="claveBanco" value="scotiabank_mx">
							<input type="hidden" name="fecha" value="0">
							<div class="col-md-3">
								<img onClick="muestra_oculta('scotiabank')"src="contenedor/bancos/scotiabank.png" style='height:60px;'  >
							</div>
							<div class="col-md-3"><br>
								<div class="input-group m-b">
									<span class="input-group-addon">Usuario</span> 
									<input type="text" class="form-control" name="usuarioBanco" >
								</div>
							</div>
							<div class="col-md-3"><br>
								<div class="input-group m-b">
									<span class="input-group-addon">Clave</span> 
									<input type="text" class="form-control" name="contraBanco" >
								</div>
							</div>
							<div class="col-md-3"><br>
								<div class="input-group m-b">
									<button class="btn btn-primary" type="submit">Agregar</button>&nbsp; &nbsp;&nbsp; 
								</div>
							</div>
							</form>
						<div class="col-md-3"></div>
						<hr>
					</div>

					<!-- banbajio -->
					<div class="row " id="banbajio" style='display:none'>
						<form action="controlador/bancosControlador.php" method="POST" id="atcdd88" name="atcdd88">
							<input type="hidden" name="accion" value="nuevoBan">
							<input type="hidden" name="claveBanco" value="banbajio_mx">
							<input type="hidden" name="fecha" value="0">
							<div class="col-md-3">
								<img onClick="muestra_oculta('scotiabank')"src="contenedor/bancos/banjio.png" style='height:60px;'  >
							</div>
							<div class="col-md-3"><br>
								<div class="input-group m-b">
									<span class="input-group-addon">Usuario</span> 
									<input type="text" class="form-control" name="usuarioBanco" >
								</div>
							</div>
							<div class="col-md-3"><br>
								<div class="input-group m-b">
									<span class="input-group-addon">Clave</span> 
									<input type="text" class="form-control" name="contraBanco" >
								</div>
							</div>
							<div class="col-md-3"><br>
								<div class="input-group m-b">
									<button class="btn btn-primary" type="submit">Agregar</button>&nbsp; &nbsp;&nbsp; 
								</div>
							</div>
							</form>
						<div class="col-md-3"></div>
						<hr>
					</div>

					<!-- amex -->
					<div class="row " id="amex" style='display:none'>
						<form action="controlador/bancosControlador.php" method="POST" id="atcdd88" name="atcdd88">
							<input type="hidden" name="accion" value="nuevoBan">
							<input type="hidden" name="claveBanco" value="amex_mx">
							<input type="hidden" name="fecha" value="0">
							<div class="col-md-3">
								<img onClick="muestra_oculta('scotiabank')"src="contenedor/bancos/amex.png" style='height:60px;'  >
							</div>
							<div class="col-md-3"><br>
								<div class="input-group m-b">
									<span class="input-group-addon">Usuario</span> 
									<input type="text" class="form-control" name="usuarioBanco" >
								</div>
							</div>
							<div class="col-md-3"><br>
								<div class="input-group m-b">
									<span class="input-group-addon">Clave</span> 
									<input type="text" class="form-control" name="contraBanco" >
								</div>
							</div>
							<div class="col-md-3"><br>
								<div class="input-group m-b">
									<button class="btn btn-primary" type="submit">Agregar</button>&nbsp; &nbsp;&nbsp; 
								</div>
							</div>
							</form>
						<div class="col-md-3"></div>
						<hr>
					</div>
					
					<!--solicitar banco-->
					<div class="row">
						<div class="col-md-12">
							<p>¿Tu banco no está en la lista? <a href="#" style="color:#eac52d" data-toggle="modal" data-target="#solicitaBanco">Solicítalo aquí.</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<hr>
	<!-- mensaje antes de las tablas -->
	<div class="row">
		<div class='col-md-12'>
		<div class="alert alert-warning text-center">Selecciona la<b> X </b>en <b>Transacciones</b> cuando decidas que ese movimiento (gasto/ingreso) no quieres que se refleje en tu contabilidad. <br>
		Cuando hagas un depósito o pago en <b>efectivo</b> debes reflejarlo en <b>Añadir transacciones manuales</b>, para poder considerarlo en tu contabilidad. <br>Sino quieres considerar ese pago en efectivo en tu contabilidad, no lo añadas.</div>
		</div>
	</div>

	<div class='row'>
		<div class='col-md-12'>
			<div class="ibox">
				<div class="ibox-title"><h5>Movimientos financieros</h5></div>
					<div class="ibox-content">
						<div class="tabs-container">
							
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#tab-3">Transacciones</a></li>
								<li ><a data-toggle="tab" href="#tab-2">Añadir transacciones manuales</a></li>
								<li ><a data-toggle="tab" href="#tab-5">Cuentas de bancos</a></li>
								<li ><a data-toggle="tab" href="#tab-1"> Bancos registrados</a></li>
								<li ><a data-toggle="tab" href="#tab-4"> Añadir criptomonedas</a></li>
							</ul>

							<div class="tab-content">
								<!-- bancos registrados -->
								<div id="tab-1" class="tab-pane ">
									<div class="panel-body">
										<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover dataTables-example" >
											<thead>
												<tr>
													<th>Banco</th>
													<th>Fecha de registro</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<?php  while($rspBannInfo = $rspBann->fetch_object() ){ ?>
													<tr>
														<td>
															<?php
																	if($rspBannInfo->banco == 'azteca_mx'){ echo "Banco Azteca";}
																	if($rspBannInfo->banco == 'bancoppel_mx'){ echo "Bancopel";}
																	if($rspBannInfo->banco == 'banorte_mx'){ echo "Banorte";}
																	if($rspBannInfo->banco == 'bbva_mx'){ echo "BBVA Bancomer";}
																	if($rspBannInfo->banco == 'banamex'){ echo "City banamex";}
																	if($rspBannInfo->banco == 'inbursa_mx'){ echo "Banco inbursa";}
																	if($rspBannInfo->banco == 'hsbcmx'){ echo "HSBC";}
																	if($rspBannInfo->banco == 'santandermx'){ echo "Banco Santander";}
																	if($rspBannInfo->banco == 'scotiabank_mx'){ echo "Scotiabank";}
																	if($rspBannInfo->banco == 'amex_mx'){ echo "American Express";}
																	if($rspBannInfo->banco == 'banbajio_mx'){ echo "Banbajio";}
															?>
														</td>
														<td><?php echo $rspBannInfo->fechaCreacion; ?></td>
														<td>
															<button class="btn btn- btn-danger" class="btn btn-primary" data-toggle="modal" data-target="#eliminar" data-unoo="<?php echo $rspBannInfo->idBanco; ?>" ><i class="fa fa-times"></i></button>
														</td>
													</tr>
												<?php }?>	
											</tbody>
										</table>
										</div>
									</div>
								</div>
								
								<!-- transacciones manuales -->
								<div id="tab-2" class="tab-pane">
								<form action="controlador/bancosControlador.php" method="POST">	
									<input type="hidden" name="accion" value="movimiento">
									<input type="hidden" name="cuentamm" value="N/A">
									<div class="panel-body">
										<!-- formulario para agregar  -->
										<div class="row">
											
											<div class="col-md-6">
												<div class="input-group m-b">
													<span class="input-group-addon">Tipo de movimiento</span> 
													<select name='tipomm' class='form-control' >
														<option></option>
														<option value='Pago de impuestos'>Pago de impuestos</option>
														<option value='Efectivo'>Efectivo</option>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="input-group m-b">
													<span class="input-group-addon">Monto</span> 
													<input type="text" class="form-control" name="balancemm"  onkeypress="return NumCheck(event, this)" >
												</div>
											</div>
											
											<div class="col-md-3">
												<div class="input-group m-b">
													<span class="input-group-addon">Moneda</span> 
													<select name='monedamm'  class='form-control'>
														<option></option>
														<option value='MXN'>MXN</option>
														<option value='DLLS'>DLLS</option>
													</select>
												</div>
											</div>

											<div class="col-md-12">
												<button class='btn btn-primary' style='width:100%' type='submit'>Añadir movimiento</button>
											</div>
											
										</div>
										
									</div>
								</form>
								</div>

								<!-- Movimientos -->
								<div id="tab-3" class="tab-pane active">
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover dataTables-example2" >
												<thead>
													<tr>
														<th>Banco</th>
														<th>Cuenta</th>
														<th>Fecha</th>
														<th>Monto</th>
														<th>Descripción</th>
														<th>Balance</th>
														<th>Transacción</th>
														<th>Tipo movimiento</th>
														<th>¿Movimiento manual?</th>
														<th>¿Quieres considerar este movimiento para tu declaración?</th>
													</tr>
												</thead>
												<tbody>
													<?php  while($rspBannMoivInfo2 = $rspBannMoiv2->fetch_object() ){ ?>
														<tr>
															<td class='text-center'>
																<?php
																	if($rspBannMoivInfo2->banco == 'azteca_mx'){ echo "<img src='img/bancos/afirme.png' style='height:35px;'>";}
																	if($rspBannMoivInfo2->banco == 'bancoppel_mx'){ echo "<img src='img/bancos/bancoppel.png' style='height:35px;'>";}
																	if($rspBannMoivInfo2->banco == 'banorte_mx'){ echo "<img src='img/bancos/banorte.png' style='height:35px;'>";}
																	if($rspBannMoivInfo2->banco == 'bbva_mx'){ echo "<img src='img/bancos/bbva.png' style='height:35px;'>";}
																	if($rspBannMoivInfo2->banco == 'banamex'){ echo "<img src='img/bancos/citibanamex.png' style='height:35px;'>";}
																	if($rspBannMoivInfo2->banco == 'inbursa_mx'){ echo "<img src='img/bancos/inbursa.png' style='height:35px;'>";}
																	if($rspBannMoivInfo2->banco == 'hsbcmx'){ echo "<img src='img/bancos/hsbc.png' style='height:35px;'>";}
																	if($rspBannMoivInfo2->banco == 'santandermx'){ echo "<img src='img/bancos/santander.png' style='height:35px;'>";}
																	if($rspBannMoivInfo2->banco == 'scotiabank_mx'){ echo "<img src='img/bancos/scotiabank.png' style='height:35px;''>";}
																	if($rspBannMoivInfo2->banco == 'amex_mx'){ echo "<img src='img/bancos/amex.png' style='height:35px;''>";}
																	if($rspBannMoivInfo2->banco == 'banbajio_mx'){ echo "<img src='img/bancos/banjio.png' style='height:35px;''>";}
																	if($rspBannMoivInfo2->banco == 'Manual'){ echo "<img src='img/bancos/money.png' style='height:35px;'>";}
																?>
															</td>
															<td><?php echo $rspBannMoivInfo2->cuenta; ?></td>
															<td><?php echo $rspBannMoivInfo2->fechaUno; ?></td>
															<td><?php echo $rspBannMoivInfo2->monto; ?></td>
															<td><?php echo $rspBannMoivInfo2->descripcion; ?></td>
															<td><?php echo $rspBannMoivInfo2->balance; ?></td>
															<td><?php echo $rspBannMoivInfo2->idTransaccion; ?></td>
															
															<!-- mosttramos el tipo de movimiento que es -->
															<td><?php if($rspBannMoivInfo2->quees == '1'){ echo "Ingreso"; } else{ echo "Egreso";} ?></td>
															<td><?php if($rspBannMoivInfo2->manual == '1'){ echo "Si"; } else{ echo "No";} ?></td>
														
															<td class='text-center'>
																<div class='row'>
																	<div class='col-md-6'>
																		<?php if( $rspBannMoivInfo2->considera == '1'){ echo "<b>Considerado</b>";}else{?>
																			<form action="controlador/bancosControlador.php" id='ingreso<?php echo $rspBannMoivInfo2->idMovimiento;?>' name='ingreso<?php echo $rspBannMoivInfo2->idMovimiento;?>' method="POST">
																				<input type='hidden' name='unooM1' value='<?php echo $rspBannMoivInfo2->idMovimiento; ?>'>	
																				<input type='hidden' name='unooM11' value='1'>	
																				<input type='hidden' name='accion' value='movidecla1'>	
																				<button class="btn btn-primary" type='submit' ><i class="fa fa-check"></i></button>	
																			</form>
																		<?php }?>
																	</div>
																	<div class='col-md-6'>
																		<?php if( $rspBannMoivInfo2->considera == '2'){ echo "<b>No considerado</b>";}else{?>
																			<form action="controlador/bancosControlador.php" id='egreso<?php echo $rspBannMoivInfo2->idMovimiento; ?>' name='egreso<?php echo $rspBannMoivInfo2->idMovimiento; ?>' method="POST">	
																				<input type='hidden' name='unooM2' value='<?php echo $rspBannMoivInfo2->idMovimiento; ?>'>	
																				<input type='hidden' name='unooM22' value='2'>
																				<input type='hidden' name='accion' value='movidecla2'>		
																				<button class="btn btn-danger" type='submit'><i class="fa fa-times"></i></button>
																			</form>
																		<?php }?>
																	</div>
																</div>
															</td>
														</tr>
													<?php }?>	
												</tbody>
											</table>
										</div>
										
									</div>
								</div>

								<!-- nuemero de cuentas -->
								<div id="tab-5" class="tab-pane">
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover dataTables-example" >
												<thead>
													<tr>
														<th>Banco</th>
														<th>Cuenta</th>
														<th>Tipo de cuenta</th>
														<th>Balance</th>
														<th>Moneda</th>
														<th>Fecha consulta</th>
													</tr>
												</thead>
												<tbody>
													<?php  while($rspBannMoivInfo = $rspBannMoiv->fetch_object() ){ ?>
														<tr>
															<td class='text-center'>
																<?php
																	if($rspBannMoivInfo->banco == 'azteca_mx'){ echo "<img src='img/bancos/afirme.png' style='height:35px;'>";}
																	if($rspBannMoivInfo->banco == 'bancoppel_mx'){ echo "<img src='img/bancos/bancoppel.png' style='height:35px;'>";}
																	if($rspBannMoivInfo->banco == 'banorte_mx'){ echo "<img src='img/bancos/banorte.png' style='height:35px;'>";}
																	if($rspBannMoivInfo->banco == 'bbva_mx'){ echo "<img src='img/bancos/bbva.png' style='height:35px;'>";}
																	if($rspBannMoivInfo->banco == 'banamex'){ echo "<img src='img/bancos/citibanamex.png' style='height:35px;'>";}
																	if($rspBannMoivInfo->banco == 'inbursa_mx'){ echo "<img src='img/bancos/inbursa.png' style='height:35px;'>";}
																	if($rspBannMoivInfo->banco == 'hsbcmx'){ echo "<img src='img/bancos/hsbc.png' style='height:35px;'>";}
																	if($rspBannMoivInfo->banco == 'santandermx'){ echo "<img src='img/bancos/santander.png' style='height:35px;'>";}
																	if($rspBannMoivInfo->banco == 'scotiabank_mx'){ echo "<img src='img/bancos/scotiabank.png' style='height:35px;''>";}
																	if($rspBannMoivInfo->banco == 'Manual'){ echo "<img src='img/bancos/money.png' style='height:35px;'>";}
																?>
															</td>
															<td><?php echo $rspBannMoivInfo->cuenta; ?></td>
															
															<td>
																<?php
																	$tiCun = $rspBannMoivInfo->tipo;
																	if($tiCun == 'investment'){ echo "Inversiones";}
																	else{echo "Cheques";} 
																?>
															</td>
															
															<td><?php echo $rspBannMoivInfo->balance; ?></td>
															<td><?php echo $rspBannMoivInfo->moneda; ?></td>
														
															<td><?php echo $rspBannMoivInfo->fechaCreacion; ?></td>
														</tr>
													<?php }?>	
												</tbody>
											</table>
										</div>
										
									</div>
								</div>
								
								<!-- criptomonedas -->
								<div id="tab-4" class="tab-pane ">
									<div class="panel-body text-center">
										<img src='img/bancos/coin.png' style='height:45px;'>
										<h3>Próximamente</h3>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
</div>
<!--modal para solictar bancos-->
<div class="modal inmodal fade" id="solicitaBanco" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h3>Solicitar nuevo banco</h3>
			</div>
			<div class="modal-body">
			<form action="controlador/bancosControlador.php" method="POST">	
				<input type="hidden" name="accion" value="solicita">
                <div class="row">
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" name="nombreBanco" placeholder="Nombre del banco" class="form-control">
						</div>
					</div>
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" name="url" placeholder="Página web del banco" class="form-control">
						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Solicitar</button>
			</form>
				<button type="button" class="btn btn-white" id='btncerraeditar' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- modal para eliminar -->
<div class="modal inmodal fade" id="eliminar" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Eliminar banco</h4>
            </div>
            <div class="modal-body">
			<form action="controlador/bancosControlador.php" method="POST">	
				<input type="hidden" name="accion" value="elimina">
                <input type='hidden' name='idBanco' id='idBanco'>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class="alert alert-danger text-center">Si lo eliminas no podrás recuperarlo.</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"> Eliminar</button>
                <button type="button" class="btn btn-white" data-dismiss="modal" id='btnTern'> Cerrar</button>
            </div>
			</form>
        </div>
    </div>
</div>
<script>
$(document).ready(function (){

	$('.dataTables-example').DataTable({
		pageLength: 25,
		responsive: true,
		dom: '<"html5buttons"B>lTfgitp',
		buttons: [
			{extend: 'pdf', title: 'ExampleFile'},
			{extend: 'csv'},
			
		],
		 language: {
		processing:     "Procesando...",
		search:         "Buscar:",
		lengthMenu:     "Mostrar: _MENU_ elementos",
		info:           "Mostrando _START_ a _END_ de _TOTAL_ resultados",
		infoEmpty:      "Elemento 0 de 0 elementos encontrados",
		infoFiltered:   "(elementos filtrado _MAX_ de elementos maximos )",
		infoPostFix:    "",
		loadingRecords: "Cambios en Curso...",
		zeroRecords:    "No se encuentran elementos.",
		emptyTable:     "Tabla no disponible",
		paginate: {
			first:      "Adelante",
			previous:   "Anterior",
			next:       "Siguiente",
			last:       "Atrás"
		}

	}
	});

	$('.dataTables-example2').DataTable({
		pageLength: 25,
		responsive: true,
		dom: '<"html5buttons"B>lTfgitp',
		buttons: [
			{extend: 'pdf', title: 'ExampleFile'},
			{extend: 'csv'},
			
		],
		 language: {
		processing:     "Procesando...",
		search:         "Buscar:",
		lengthMenu:     "Mostrar: _MENU_ elementos",
		info:           "Mostrando _START_ a _END_ de _TOTAL_ resultados",
		infoEmpty:      "Elemento 0 de 0 elementos encontrados",
		infoFiltered:   "(elementos filtrado _MAX_ de elementos maximos )",
		infoPostFix:    "",
		loadingRecords: "Cambios en Curso...",
		zeroRecords:    "No se encuentran elementos.",
		emptyTable:     "Tabla no disponible",
		paginate: {
			first:      "Adelante",
			previous:   "Anterior",
			next:       "Siguiente",
			last:       "Atrás"
		}

	}
	});
	
	/* modal para eliminar */
	 $("#eliminar").on("show.bs.modal", function(event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var uno = button.data("unoo");
		var modal = $(this);
		modal.find(".modal-body #idBanco").val(uno);
	});

	$("#des1").click(function(){
		$("#azteca").css("display", "block");
		$("#banjio").css("display", "none");
		$("#bancoppel").css("display", "none");
		$("#banorte").css("display", "none");
		$("#bbva").css("display", "none");
		$("#citibanamex").css("display", "none");
		$("#hsbc").css("display", "none");
		$("#inbursa").css("display", "none");
		$("#santander").css("display", "none");
		$("#scotiabank").css("display", "none");
		$("#banbajio").css("display", "none");
		$("#amex").css("display", "none");
	});
	$("#des2").click(function(){
		$("#azteca").css("display", "none");
		$("#banjio").css("display", "none");
		$("#bancoppel").css("display", "block");
		$("#banorte").css("display", "none");
		$("#bbva").css("display", "none");
		$("#citibanamex").css("display", "none");
		$("#hsbc").css("display", "none");
		$("#inbursa").css("display", "none");
		$("#santander").css("display", "none");
		$("#scotiabank").css("display", "none");
		$("#banbajio").css("display", "none");
		$("#amex").css("display", "none");
	});
	$("#des3").click(function(){
		$("#azteca").css("display", "none");
		$("#banjio").css("display", "none");
		$("#bancoppel").css("display", "none");
		$("#banorte").css("display", "block");
		$("#bbva").css("display", "none");
		$("#citibanamex").css("display", "none");
		$("#hsbc").css("display", "none");
		$("#inbursa").css("display", "none");
		$("#santander").css("display", "none");
		$("#scotiabank").css("display", "none");
		$("#banbajio").css("display", "none");
		$("#amex").css("display", "none");
	});
	$("#des4").click(function(){
		$("#azteca").css("display", "none");
		$("#banjio").css("display", "none");
		$("#bancoppel").css("display", "none");
		$("#banorte").css("display", "none");
		$("#bbva").css("display", "block");
		$("#citibanamex").css("display", "none");
		$("#hsbc").css("display", "none");
		$("#inbursa").css("display", "none");
		$("#santander").css("display", "none");
		$("#scotiabank").css("display", "none");
		$("#banbajio").css("display", "none");
		$("#amex").css("display", "none");
	});
	$("#des5").click(function(){
		$("#azteca").css("display", "none");
		$("#banjio").css("display", "none");
		$("#bancoppel").css("display", "none");
		$("#banorte").css("display", "none");
		$("#bbva").css("display", "none");
		$("#citibanamex").css("display", "block");
		$("#hsbc").css("display", "none");
		$("#inbursa").css("display", "none");
		$("#santander").css("display", "none");
		$("#scotiabank").css("display", "none");
		$("#banbajio").css("display", "none");
		$("#amex").css("display", "none");
	});
	$("#des6").click(function(){
		$("#azteca").css("display", "none");
		$("#banjio").css("display", "none");
		$("#bancoppel").css("display", "none");
		$("#banorte").css("display", "none");
		$("#bbva").css("display", "none");
		$("#citibanamex").css("display", "none");
		$("#hsbc").css("display", "block");
		$("#inbursa").css("display", "none");
		$("#santander").css("display", "none");
		$("#scotiabank").css("display", "none");
		$("#banbajio").css("display", "none");
		$("#amex").css("display", "none");
	});
	$("#des7").click(function(){
		$("#azteca").css("display", "none");
		$("#banjio").css("display", "none");
		$("#bancoppel").css("display", "none");
		$("#banorte").css("display", "none");
		$("#bbva").css("display", "none");
		$("#citibanamex").css("display", "none");
		$("#hsbc").css("display", "none");
		$("#inbursa").css("display", "none");
		$("#santander").css("display", "block");
		$("#scotiabank").css("display", "none");
		$("#banbajio").css("display", "none");
		$("#amex").css("display", "none");
	});
	$("#des8").click(function(){
		$("#azteca").css("display", "none");
		$("#banjio").css("display", "none");
		$("#bancoppel").css("display", "none");
		$("#banorte").css("display", "none");
		$("#bbva").css("display", "none");
		$("#citibanamex").css("display", "none");
		$("#hsbc").css("display", "none");
		$("#inbursa").css("display", "none");
		$("#santander").css("display", "none");
		$("#scotiabank").css("display", "block");
		$("#banbajio").css("display", "none");
		$("#amex").css("display", "none");
	});
	$("#des9").click(function(){
		$("#azteca").css("display", "none");
		$("#banjio").css("display", "none");
		$("#bancoppel").css("display", "none");
		$("#banorte").css("display", "none");
		$("#bbva").css("display", "none");
		$("#citibanamex").css("display", "none");
		$("#hsbc").css("display", "none");
		$("#inbursa").css("display", "none");
		$("#santander").css("display", "none");
		$("#scotiabank").css("display", "none");
		$("#banbajio").css("display", "none");
		$("#amex").css("display", "block");
	});
	$("#des10").click(function(){
		$("#azteca").css("display", "none");
		$("#banjio").css("display", "none");
		$("#bancoppel").css("display", "none");
		$("#banorte").css("display", "none");
		$("#bbva").css("display", "none");
		$("#citibanamex").css("display", "none");
		$("#hsbc").css("display", "none");
		$("#inbursa").css("display", "none");
		$("#santander").css("display", "none");
		$("#scotiabank").css("display", "none");
		$("#banbajio").css("display", "block");
		$("#amex").css("display", "none");
	});

	// Bind normal buttons
	Ladda.bind( '.ladda-button',{ timeout: 1000000 });

	// Bind progress buttons and simulate loading progress
	Ladda.bind( '.progress-demo .ladda-button',{
		callback: function( instance ){
			var progress = 0;
			var interval = setInterval( function(){
				progress = Math.min( progress + Math.random() * 0.1, 1 );
				instance.setProgress( progress );

				if( progress === 1 ){
					instance.stop();
					clearInterval( interval );
				}
			}, 200 );
		}
	});
    var l = $( '.ladda-button-demo' ).ladda();
    l.click(function(){
        l.ladda( 'start' );
        setTimeout(function(){ l.ladda('stop'); },12000)
    });

});
</script>
