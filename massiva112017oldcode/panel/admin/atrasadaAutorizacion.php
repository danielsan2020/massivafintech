<?php 
	@session_start();	
			///cabezera
	include 'estructura/header.php';
	///script
	include 'estructura/script.php';
	/* obtenemos las variables que obtenemos */
	$id_usuario = $_GET['dd'];
	/* con el id del usuario obtenemos su informacion */
	/* obtenemos los datos del usuario */
	include 'modelo/consultaTablas.php';
	$soporte = new consultaTabla();
	$uno = $soporte->datosAuto($id_usuario);
	$unoInfo = $uno->fetch_object();
	$nombre = $unoInfo->nombre;
	$ape_paterno = $unoInfo->ape_paterno;
	$ape_materno = $unoInfo->ape_materno;
	$rfc = $unoInfo->rfc;

	/* obtenemos los valores de la cotizacion */
	$dos = $soporte->datoscoti($rfc);
	$dosInfo = $dos->fetch_object();
	
	$idContaAtrasada= $dosInfo->idContaAtrasada;
	/* seccion para el periodod */
	$periodo= $dosInfo->periodo;
	if($periodo == 1){ $periodoFin = '1 año o menos';}
	if($periodo == 2){ $periodoFin = '2 años';}
	if($periodo == 3){ $periodoFin = '3 años';}
	if($periodo == 4){ $periodoFin = '4 años';}
	if($periodo == 5){ $periodoFin = '5 años';}
	if($periodo == 6){ $periodoFin = '5 a 10 años';}
	$obligaciones= $dosInfo->obligaciones;
	$porciones = explode(",", $obligaciones);
	$isr=  $porciones[0]; // porción1
	$iva = $porciones[1]; // porción2
	$diot =  $porciones[1]; // porción2
	
	$isr=  ($porciones[0] != '')? 'SI' : 'NO' ; // porción1
	$iva = ($porciones[1] != '')? 'SI' : 'NO' ; // porción1
	$diot =  ($porciones[2] != '')? 'SI' : 'NO' ; // porción1

	$cheInteres= ($dosInfo->cheInteres > 0)? 'SI' : 'NO';
	$cheasalariado= ($dosInfo->cheasalariado > 0)? 'SI' : 'NO';
	$chearrendamiento= ($dosInfo->chearrendamiento > 0)? 'SI' : 'NO';
	$cheservicios= ($dosInfo->cheservicios > 0)? 'SI' : 'NO';
	$cheempresaria= ($dosInfo->cheempresaria > 0)? 'SI' : 'NO';
	$cherif= ($dosInfo->cherif > 0)? 'SI' : 'NO';
	$monto= $dosInfo->monto;
	$mesesin= ($dosInfo->mesesin> 0)? $dosInfo->mesesin." Meses"  : 'Pago en una sola exibición';

	/* variables de autorizacion */

	$mov = $_GET['mov'];


?>
<link rel="shortcut icon" type="image/x-icon" href="massiva.ico" />
</head>
<body>

    <div class="gray-bg dashbard-1">
	
		<!--logo-->
		<div class="row  border-bottom white-bg dashboard-header"><div class="col-md-12 text-center"><img src="img/logo.png" style='height: 70px'></div></div>
		<hr>

		<div class='row text-center'><div class="alert alert-warning"><b>Bienvenido <?php echo $nombre;?> <?php echo $ape_paterno;?> <?php echo $ape_materno;?></b></div></div>
		<hr>

		<div class='container-fluid'>
			<div class='row'>
					<div class='col-md-12'>
						<div class="ibox">
							<div class="ibox-title"><h5>Cotización de tu contabilidad atrasada</h5></div>
								<div class="ibox-content">
									
									<div class='row'>
										<div class='col-md-12 text-center'>
											<b>Periodos a regularizar:</b> <?php echo $periodoFin;?><br>
											<b>Obligaciones pendientes:</b> ISR: <?php echo $isr; ?> | IVA: <?php echo $iva;?> | DIOT: <?php echo $diot;?><br>
											<b>Régimen al que perteneces:</b><br>
												<b>INTERÉS:</b></b> <?php echo $cheInteres; ?><br>
												<b>ASALARIADO:</b> <?php echo $cheasalariado; ?><br>
												<b>ARRENDAMIENTO:</b> <?php echo $chearrendamiento; ?><br>
												<b>SERVICIOS PROFESIONALES:</b> <?php echo $cheservicios; ?><br>
												<b>ACTIVIDAD EMPRESARIAL:</b> <?php echo $cheempresaria; ?><br>
												<b>RIF:</b> <?php echo $cherif; ?><br>
											<b>Costo final:</b> $<?php echo $monto; ?> Pesos<br>
											<b>Tu pago se realizará:</b> <?php echo $mesesin; ?><br>
										</div>
									</div>
									<hr>
									<?php if($mov == ''){?>
									<div class='row'>
										<div class='col-md-6 text-center'>
											<form action="controlador/simuladorControlador.php" method='POST'>
												<input type='hidden' name='idContaAtrasada' id='idContaAtrasada' value='<?php echo $idContaAtrasada;?>'>
												<input type='hidden' name='accion' id='accion' value='rechazacotizacion'>
												<input type='hidden' name='estatus' id='estatus' value='2'>
												<input type='hidden' name='dd' id='dd' value='<?php echo $id_usuario;?>'>
												<button class='btn btn-danger' style='width:100%'>Rechazar</button>
											</form>
										</div>
										<div class='col-md-6 text-center'>
											<form action="controlador/simuladorControlador.php" method='POST'>
												<input type='hidden' name='idContaAtrasada' id='idContaAtrasada' value='<?php echo $idContaAtrasada;?>'>
												<input type='hidden' name='accion' id='accion' value='rechazacotizacion'>
												<input type='hidden' name='estatus' id='estatus' value='3'>
												<input type='hidden' name='dd' id='dd' value='<?php echo $id_usuario;?>'>
												<button class='btn btn-primary' style='width:100%'>Autorizar</button>
											</form>
										</div>
									</div>
									<?php }else{?>
										<?php if($mov == 1){?>
											<div class='row text-center'><div class="alert alert-warning"><b>Rechazaste la cotización para sanear tu contabilidad</b></div></div>
										<?php }if($mov == 2){?>
											<div class='row text-center'><div class="alert alert-warning"><b>Estás autorizando que massiva te realice tu contabilidad atrasada en 5 a 7 días hábiles después de un análisis previo de tu contabilidad en el portal del SAT.
											<br>Gracias por tu confianza.</b></div></div>
									<?php }}?>

								</div>
							</div>
						</div>					
					</div>
			</div>
		</div>

		<br><hr>
		<!--pie de pagina-->
		<div class="row">
			<div class="col-lg-12">
				<div class="footer">
					<div><strong>Copyright</strong> Todos los derechos reservados massiva.mx &copy; 2019</div>
				</div>
			</div>
		</div>   
    </div>
</body>

</html>
