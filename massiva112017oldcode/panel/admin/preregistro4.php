<?php 
@session_start();	
if($_SESSION['id_usuario'] != ''){
include 'estructura/header.php';
include 'estructura/script.php';
$nombreCompleto = $_SESSION['nombre']." ".$_SESSION['ape_paterno']." ".$_SESSION['ape_materno'];
//obtengo el valor si no seleccionan nada
$vale = $_GET['val'];

//esto es para cuando regreso de la otra ventana y mostrar el valor seleccionado
if($vale == 2){
	include "modelo/preregistroModelo.php";
	$osPreregistro = new DatosPreregistro();
	$actuPre = $osPreregistro->obtenerSelecPaque($_SESSION['id_usuario']);
	$actuPreInfo = $actuPre->fetch_object();
	//valores para agregar a los cuadros
	$idPaquete = $actuPreInfo->idPaquete;
	$montoM =  $actuPreInfo->montoM;
	$nombre =  $actuPreInfo->nombre;
}

?>
<script src="js/vista/preregistro.js"></script>
</head>
<body>

    <div class="gray-bg dashbard-1">
		
		<div class="row"><div class="alert alert-warning text-center"><b>Bienvenido <?= $nombreCompleto?></b></div></div>
		<!--logo-->
		<div class="row  border-bottom white-bg dashboard-header"><div class="col-md-12 text-center"><img src="img/logo.png" style='height: 70px'></div></div>
		<hr>
		<div class="row"><div class="alert alert-warning text-center"><b>Selecciona tu régimen fiscal.</b></div></div>
		<hr>
		
		<?php if($vale == 1){?>
		<div class='row text-center'><div class="alert alert-danger">Seleccionar un paquete.</div></div>
		<?php }?>
		
		<!--botones primarios-->
		<div class='row text-center'>
			<div class="col-lg-4"></div>

			<div class="col-lg-4">
				<a id="pfbtn" name="pfbtn" style="cursor: pointer">
					<div class="widget style1 navy-bg">
						<div class="row" >
							<div class="col-xs-4"><i class="fa fa-user-o fa-5x"></i></div>
							<div class="col-xs-8 text-right"><h2 class="font-bold">Persona Física</h2></div>
						</div>
					</div>
				</a>
            </div>
			
			<!--div class="col-lg-4">
				<a id="pmbtn" name="pfbtn" style="cursor: pointer">
					<div class="widget style1 navy-bg">
						<div class="row" id=""><div class="col-xs-4"><i class="fa fa-building-o fa-5x"></i></div>
							<div class="col-xs-8 text-right">						<h2 class="font-bold" >Persona Moral</h2>
							</div>
						</div>
					</div>
				</a>
            </div-->
			<!--div class="col-lg-3">
				<a id="extrabtn" name="pfbtn" style="cursor: pointer">
					<div class="widget style1 navy-bg">
						<div class="row" id="">
							<div class="col-xs-4">
								<i class="fa fa-shopping-basket fa-5x"></i>
							</div>
							<div class="col-xs-8 text-right">
								<h2 class="font-bold" >Extras</h2>
							</div>
						</div>
					</div>
				</a>
            </div-->
			<div class="col-lg-4"></div>		
		</div>
		<!--botones de persona fisica-->
		<div id="pf" style="display:none">
			<div class='row'>
				<div class="col-lg-3">
					<div class="widget style1 navy-bg" id="cuadro1">
						<div class="row">
							<a  data-toggle="modal" data-target="#ibnteres" style="color: #FFFFFF">
								<div class="col-xs-12 text-center">
									<h2 class="font-bold"><b>INTERÉS</b></h2><br>
									<span style="font-size: 32px;"><b>$199</b></span> <span style="font-size: 22px;">anual</span> 
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="widget style1 navy-bg" id="cuadro2">
						<div class="row">
							<a  data-toggle="modal" data-target="#asalariados" style="color: #FFFFFF">
								<div class="col-xs-12 text-center">
									<h2 class="font-bold"><b>ASALARIADOS</b></h2><br>
									<span style="font-size: 32px;"><b>$199</b></span> <span style="font-size: 22px;">anual</span>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="widget style1 navy-bg" id="cuadro3">
						<div class="row">
							<a  data-toggle="modal" data-target="#arrendamiento" style="color: #FFFFFF">
								<div class="col-xs-12 text-center">
									<h2 class="font-bold"><b>ARRENDAMIENTO</b></h2><br>
									<span style="font-size: 32px;"><b>$199</b></span> <span style="font-size: 22px;">mensual</span>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="widget style1 navy-bg" id="cuadro4">
						<div class="row">
							<a  data-toggle="modal" data-target="#rif" style="color: #FFFFFF">
								<div class="col-xs-12 text-center">
									<h2 class="font-bold"><b>RIF</b></h2><br>
									<span style="font-size: 32px;"><b>$99</b></span> <span style="font-size: 22px;">mensual</span>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		
			<div class='row'>
				<div class="col-lg-3">
					<div class="widget style1 navy-bg" id="cuadro5">
						<div class="row">
							<a  data-toggle="modal" data-target="#empresarial" style="color: #FFFFFF">
								<div class="col-xs-12 text-center">
									<h2 class="font-bold"><b>ACTIVIDAD EMPRESARIAL</b></h2><br>
									<span style="font-size: 32px;"><b>$199</b></span> <span style="font-size: 22px;">mensual</span>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="widget style1 navy-bg" id="cuadro6">
						<div class="row">
							<a  data-toggle="modal" data-target="#profesionalBasico" style="color: #FFFFFF">
								<div class="col-xs-12 text-center">
									<h2 class="font-bold"><b>SERVICIOS PROFESIONALES BÁSICO</b></h2><br>
									<span style="font-size: 32px;"><b>$199</b></span> <span style="font-size: 22px;">mensual</span><br><br>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="widget style1 navy-bg" id="cuadro7">
						<div class="row">
							<a  data-toggle="modal" data-target="#profesionalPlus" style="color: #FFFFFF">
								<div class="col-xs-12 text-center">
									<h2 class="font-bold"><b>SERVICIOS PROFESIONALES PLUS</b></h2><br>
									<span style="font-size: 32px;"><b>$299</b></span> <span style="font-size: 22px;">mensual</span><br><br>
								</div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="widget style1 navy-bg" id="cuadro8">
						<div class="row">
							<a  data-toggle="modal" data-target="#pfespecial" style="color: #FFFFFF">
							<div class="col-xs-12 text-center">
								<h2 class="font-bold"><b>ESPECIAL</b></h2><br>
								<span style="font-size: 18px;">Costo total mensual basado en la suma de Personas Físicas seleccionadas</span><br><br>
								<i class="fa fa-calculator" style="font-size: 35px;"></i><br>
								<span style="font-size: 12px;">Simulación cobro mensual </span> 
							</div>
							</a>
						</div>
					</div>
				</div>
				
				
			</div>
		</div>

		<!--botones de persona morales-->
		<div id="pm" style="display:none">
			<div class='row'>
				<div class="col-lg-6">
	                <div class="widget style navy-bg" id="cuadro9">
	                    <div class="row">
	                        <a  data-toggle="modal" data-target="#calculadora" style="color: #FFFFFF">
								<div class="col-xs-12 text-center">
		                            <h2 class="font-bold"><b>RÉGIMEN GENERAL</b></h2><br>
									<span style="font-size: 22px;">Cobro mensual basado sobre ingresos, gastos y contabilidad general</span><br><br>
									<i class="fa fa-calculator" style="font-size: 35px;"></i><br>
									<span style="font-size: 12px;">Simulación cobro mensual </span> 
		                        </div>
							</a>
	                    </div>
	                </div>
	            </div>

				<div class="col-lg-6">
	                <div class="widget style1 navy-bg" id="cuadro10">
	                    <div class="row">
							<a  data-toggle="modal" data-target="#calculadoraDos" style="color: #FFFFFF">
		                        <div class="col-xs-12 text-center">
		                            <h2 class="font-bold"><b>CON FINES NO LUCRATIVOS</b></h2><br>
									<span style="font-size: 22px;">Cobro mensual basado sobre ingresos, gastos y contabilidad general</span><br><br>
									<i class="fa fa-calculator" style="font-size: 35px;"></i><br>
									<span style="font-size: 12px;">Simulación cobro mensual </span> 
		                        </div>
							</a>
	                    </div>
	                </div>
	            </div>

			</div>
		</div>
		<hr>
		
		<!---seccion de nominas oculto-->
		<!--div id="ex" style="display:none">
			<div class='row'>
			<div class="col-lg-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h2 class="font-bold"><b>Nóminas</b></h2><br>
							<span style="font-size: 32px;"><b>$299</b></span> <span style="font-size: 22px;">mensual por trabajador<br> De 1 a 25 trabajadores.</span><br><br>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-lg-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h2 class="font-bold"><b>Nóminas</b></h2><br>
							
							<span style="font-size: 32px;"><b>$199</b></span> <span style="font-size: 22px;">mensual por trabajador<br> De 26 a 50 trabajadores.</span><br><br>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-lg-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-12 text-center">
                            <h2 class="font-bold"><b>Nóminas</b></h2><br>
							
							<span style="font-size: 32px;"><b>$99</b></span><span style="font-size: 22px;"> mensual por trabajador<br> De 51 trabajadores en adelante.</span><br><br>
                        </div>
                    </div>
                </div>
            </div>
		</div>
		</div-->

		<div class="row">
			<div class="col-md-12 text-center">
				
				<!--formlario para el envio del siguiente paso-->
				<form action="controlador/preregistroControlador.php" method="POST">
					<input type="hidden" id="accion" name="accion" value="seLPaquete">
					<input type="hidden" id="selecciona" name="selecciona" value="<?= $idPaquete;?>">
					<input type="hidden" id="costo" name="costo" value="<?= $montoM;?>">
					<a href="preregistro2.php"><button type="button" class="btn btn-w-m btn-primary"> Regresar</button></a>
					<button class="btn btn-primary" type="submit">&nbsp;Siguiente </button>		
				</form>
			</div>
		</div>
		<hr>
		<div class='row text-center'>
			<div class="alert alert-warning">¿Tienes dudas?, escríbenos a <a href="mailto:atencionclientes@massiva.mx" style="color:rgb(226, 0, 74)">atencionclientes@massiva.mx</a>	</div>
		</div>

		<hr>				
		<!--pie de pagina-->
		<div class="row">
			<div class="col-lg-12">
				<div class="footer">
					<div><strong>Copyright</strong> Todos los derechos reservados massiva.mx &copy; 2019</div>
				</div>
			</div>
		</div>
		
		<?php include 'estructura/footer.php'; ?>    
    </div>
</body>
<!--seccion de modals--->

<!--------/////////////////////////Personas fisicas/////////////////////------------------------------>
<!--uno-->
<div class="modal inmodal fade" id="ibnteres" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Tu plan de <span style="font-size: 35px; color:rgb(226, 0, 74) ">$199</span> anual incluye:</h4>
			</div>
			<div class="modal-body">
				• Análisis de situación fiscal antes del comienzo del servicio.<br>
				• Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
				• Presentación de declaración de ISR anual en el portal SAT.<br>
				• Almacenamiento y pre rellenado para facturación de tickets de compra. *<br>
				• Asesorías telefónicas.<br>
				• MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>
				<p style="font-size: 10px;">
				*El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.	
				</p><br>
   			
			</div>
			<div class="modal-footer">
				<button type="button" id='btnUno' class="btn btn-w-m btn-primary"> Seleccionar</button>
				
			</div>
		</div>
	</div>
</div>
<!--dos-->
<div class="modal inmodal fade" id="asalariados" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Tu plan de <span style="font-size: 35px; color:rgb(226, 0, 74) ">$199</span> anual incluye:</h4>
			</div>
			<div class="modal-body">
				• Análisis de situación fiscal antes del comienzo del servicio.<br>
				• Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
				• Presentación de declaración de ISR anual en el portal SAT.<br>
				• Almacenamiento y pre rellenado para facturación de tickets de compra. *<br>
				• Asesorías telefónicas.<br>
				• MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>
				<p style="font-size: 10px;">
				*El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.	
				</p><br>
    			
			</div>
			<div class="modal-footer">
				<button type="button" id='btnDos' class="btn btn-w-m btn-primary"> Seleccionar</button>
				
			</div>
		</div>
	</div>
</div>
<!--tres-->
<div class="modal inmodal fade" id="arrendamiento" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Tu plan de <span style="font-size: 35px; color:rgb(226, 0, 74) ">$199</span> mensual incluye:</h4>
			</div>
			<div class="modal-body">
			• Análisis de situación fiscal antes del comienzo del servicio.<br>
			• Facturación de 10 CFDI al mes.<br>
			• Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
			• Presentación de declaración de ISR, IVA y DIOT en el portal SAT.<br>
			• Almacenamiento y pre rellenado para facturación de tickets de compra. *<br>
			• Asesorías telefónicas.<br>
			• MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>

	
				</p><br>
    			
			</div>
			<div class="modal-footer">
				<button type="button" id='btnTres' class="btn btn-w-m btn-primary"> Seleccionar</button>
				
			</div>
		</div>
	</div>
</div>
<!--cuatro-->
<div class="modal inmodal fade" id="rif" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Tu plan de <span style="font-size: 35px; color:rgb(226, 0, 74) ">$99</span> mensual incluye:</h4>
			</div>
			<div class="modal-body">
				• Análisis de situación fiscal antes del comienzo del servicio.<br>
				• Facturación de 12 CFDI al mes.<br>
				• Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
				• Presentación de declaración bimestral de ISR e IVA en el portal SAT.<br>
				• Plantilla de cotización para tus clientes.<br>
				• Almacenamiento y pre rellenado para facturación de tickets de compra. *<br>
				• Asesorías telefónicas.<br>
				• MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>
				<p style="font-size: 10px;">
				*El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.	
				</p><br>
			</div>
			<div class="modal-footer">
				<button type="button" id='btnCuatro' class="btn btn-w-m btn-primary"> Seleccionar</button>
				
			</div>
		</div>
	</div>
</div>
<!--cinco-->
<div class="modal inmodal fade" id="empresarial" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Tu plan de <span style="font-size: 35px; color:rgb(226, 0, 74) ">$199</span> mensual incluye:</h4>
			</div>
			<div class="modal-body">
				• Análisis de situación fiscal antes del comienzo del servicio.<br>
				• Facturación de 12 CFDI al mes.<br>
				• Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
				• Presentación de declaración de ISR, IVA y DIOT en el portal SAT.<br>
				• Plantilla de cotización para tus clientes.<br>
				• Almacenamiento y pre rellenado para facturación de tickets de compra.*<br>
				• Asesorías telefónicas.<br>
				• MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>
				
			</div>
			<div class="modal-footer">
				<button type="button" id='btnCinco' class="btn btn-w-m btn-primary"> Seleccionar</button>
				
			</div>
		</div>
	</div>
</div>
<!--seis-->
<div class="modal inmodal fade" id="profesionalBasico" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Tu plan de <span style="font-size: 35px; color:rgb(226, 0, 74) ">$199</span> mensual incluye:</h4>
			</div>
			<div class="modal-body">
				• Análisis de situación fiscal antes del comienzo del servicio.<br>
				• Facturación de 12 CFDI al mes.<br>
				• Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
				• Presentación de declaración de ISR, IVA y DIOT en el portal SAT.<br>
				• Plantilla de cotización para tus clientes.<br>
				• Almacenamiento y pre rellenado para facturación de tickets de compra.*<br>
				• Asesorías telefónicas.<br>
				• MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>
				<p style="font-size: 10px;">
				*El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.	
				</p><br>
			</div>
			<div class="modal-footer">
				<button type="button" id='btnSies' class="btn btn-w-m btn-primary"> Seleccionar</button>
				
			</div>
		</div>
	</div>
</div>
<!--siete-->
<div class="modal inmodal fade" id="profesionalPlus" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Tu plan de <span style="font-size: 35px; color:rgb(226, 0, 74) ">$299</span> mensual incluye:</h4>
			</div>
			<div class="modal-body">
				• Análisis de situación fiscal antes del comienzo del servicio.<br>
				• Facturación de 20 CFDI al mes.<br>
				• Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
				• Presentación de declaración de ISR, IVA y DIOT en el portal SAT.<br>
				• Plantilla de cotización para tus clientes.<br>
				• Almacenamiento y pre rellenado para facturación de tickets de compra.*<br>
				• Asesorías telefónicas.<br>
				• MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>
				<p style="font-size: 10px;">
				*El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.	
				</p><br>
				
			</div>
			<div class="modal-footer">
				<button type="button" id='btnSiete' class="btn btn-w-m btn-primary"> Seleccionar</button>
				
			</div>
		</div>
	</div>
</div>
<!--ocho-->
<div class="modal inmodal fade" id="pfespecial" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Tu plan anual incluye:</h4>
			</div>
			<div class="modal-body">
				Puedes seleccionar hasta 5 formas jurídicas a la vez.<br>
				• Análisis de situación fiscal antes del comienzo del servicio.<br>
				• Facturación de 12 CFDI al mes.<br>
				• Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
				• Presentación de declaración de ISR, IVA y DIOT en el portal SAT.<br>
				• Plantilla de cotización para tus clientes.<br>
				• Almacenamiento y pre rellenado para facturación de tickets de compra.*<br>
				• Asesorías telefónicas.<br>
				• MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>

				<p style="font-size: 10px;">
					*A la Persona Física de más valor seleccionada se suma el resto de las Personas Físicas, cobrando el 80% de su costo a la segunda y el resto de las Personas Físicas seleccionadas el 50% sobre su valor.<br>
					*El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.<br>
				</p><br>
				
    			<form class="input-group" style="width: 100% !important">
									<div class="row">
										<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Selecciona tus regímenes</div>
										<div class="col-md-12" class="input-group">
											<div class="col-md-4">
												<input type="checkbox" id="cInteres" > INTERÉS<br>
											</div>
											<div class="col-md-4">
												<input type="checkbox" id="casalariado" onclick="cambri()"> ASALARIADO<br>
											</div>
											<div class="col-md-4">
												<input type="checkbox" id="carrendamiento" > ARRENDAMIENTO<br>
											</div>
											<div class="col-md-4">
												<input type="checkbox" id="cservicios" > SERVICIOS PROFESIONALES<br>
											</div>
											<div class="col-md-4">
												<input type="checkbox" id="cempresaria" onclick="cambri()"> ACTIVIDAD EMPRESARIAL<br>
											</div>
											<div class="col-md-4">
												<input type="checkbox" id="crif" > RIF<br>
											</div>
										</div>
										
										<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
									</div>
								</form>
								<hr>
							
								<div class="row">
									
									
									<div class="col-md-12 text-center">
										<input type="hidden" name="costoCal" id="costoCal">
										<button class="btn btn-primary" id="calcularPFE2" style="width: 100% !important"> Calcular</button>
									</div>
									<hr>
									<div class="alert alert-warning text-center">Si eres RIF no puedes ser asalariado y actividad empresarial, y viceversa.</div>
									<hr>
									<div class="col-md-12 text-center">
										<div id="costofinal21"></div>
									</div>
								</div>
			</div>
			<div class="modal-footer">
				<button type="button" id='btnOcho' disabled class="btn btn-w-m btn-primary"> Seleccionar</button>
				
			</div>
		</div>
	</div>
</div>

<!--------/////////////////////////Personas morales/////////////////////------------------------------>
<div class="modal inmodal fade" id="calculadora" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Tu plan mensual incluye:</h4>
			</div>
			<div class="modal-body">
				Cobro accesible mensual basado sobre ingresos, gastos y contabilidad general<br><br>
				•	Análisis de situación fiscal antes del comienzo del servicio.<br>
				•	Facturación de cfdi por ingresos al mes.<br>
				•	Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
				•	Presentación de declaración de ISR, IVA y DIOT, RETENCIONES e IEPS en el portal SAT.<br>
				•	Asesorías telefónicas ilimitadas.<br>
				•	Generación de reportes auxiliares.<br>
				•	Envío de contabilidad mensual al SAT.<br>
				•	Generación de libros contables y contabilidad electrónica.<br>
				•	Plantilla de cotización para tus clientes. <br>
				•	Almacenamiento y pre rellenado para facturación de tickets de compra. *<br>
				•	MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>


				*El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.<br><hr>
				<div class="alert alert-warning" role="alert">
					- Se te cobrará $199 los primeros meses hasta tu primer ingreso.<br>
					<b>¿Sin ingresos durante algún mes?</b> Se te cobrará durante ese mes $199.
				</div>
				<hr>
				<input type="hidden" name="idCliente" id="idCliente">
    			<!---uno--->
				<form class="input-group" style="width: 100% !important">
									<div class="row">
										<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Movimiento de ingresos</div>
										<div class="col-md-6" class="input-group">
											<select name="movingreoUno2" id="movingreoUno2" class="form-control">
												<option value="0">0</option>
												<option value="199">1 a 20</option>
												<option value="399">21 a 50</option>
												<option value="699">51 a 100</option>
												<option value="1">101 en adelante</option><!--se toma el ultimo maximo se le resta el valor puesto manual-->
											</select>
										</div>
										<div class="col-md-6" class="input-group">
										<input disabled class="form-control" name="moviUno2" id="moviUno2" onkeypress="return numbersonly(event);" onblur="primeraOperacion()" placeholder="Ingresa cuantos movimientos">
									</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
									</div>
								</form>
								<hr>
								<!---dos--->
								<div class="row">
									<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Movimientos de gastos</div>
									<div class="col-md-6" class="input-group">
										<select name="movGasUno2" id="movGasUno2" class="form-control">
											<option value="0">0</option>
											<option value="199">1 a 20</option>
											<option value="399">21 a 50</option>
											<option value="699">51 a 100</option>
											<option value="1">101 en adelante</option>
										</select>
									</div>
									<div class="col-md-6" class="input-group">
										<input disabled class="form-control" name="moviDos2" id="moviDos2" onkeypress="return numbersonly(event);" onblur="primeraOperacion()" placeholder="Ingresa cuantos movimientos">
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
								</div>
								<hr>
								<!---tres--->
								<div class="row">
									<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Total de ingresos</div>
									
									<div class="col-md-6" class="input-group">
										<select name="movIngUno2" id="movIngUno2" class="form-control">
											<option value="0">0</option>
											<option value="999">1 a 10,000</option>
											<option value="1999">10,001 a 20,000</option>
											<option value="2999">20,001 a 30,000</option>
											<option value="4999">30,001 a 50,000</option>
											<option value="5999">50,001 a 100,000</option>
											<option value="7999">100,001 a 500,000</option>
											<option value="8999">500,001 a 1,000,000</option>
											<option value="9999">1,000,001 a 2,000,000</option>
											<option value="1">2,000,001 en adelante</option><!--se toman lo 2 millones menos el vbalor manual se divide entre 1000 y eso multilicado por 10-->

										</select>
									</div>
									<div class="col-md-6" class="input-group"><!--El valor final es la suma de todos los anteriores--->
										<input disabled class="form-control" name="catMonUNO2" id="catMonUNO2" onkeypress="return numbersonly(event);" onblur="primeraOperacion()" placeholder="Ingresa el monto aproximado">
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
								</div>
								
								<hr>
								<div class="row">
									<div class="col-md-12 text-center">
										<button class="btn btn-primary" id="cobromensu2" style="width: 100% !important"> Calcular</button>
									</div>
									<hr>
									<div class="col-md-12 text-center">
										<div id="cosfinmensj"></div>
									</div>
								</div>	
			</div>
			<div class="modal-footer">
				<button type="button" id='btnNueve' class="btn btn-w-m btn-primary"> Seleccionar</button>
				
			</div>
		</div>
	</div>
</div>

<div class="modal inmodal fade" id="calculadoraDos" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Tu plan mensual incluye:</h4>
			</div>
			<div class="modal-body">
				Cobro accesible mensual basado sobre ingresos, gastos y contabilidad general<br><br>
				•	Análisis de situación fiscal antes del comienzo del servicio.<br>
				•	Facturación de cfdi por ingresos al mes.<br>
				•	Hoja de trabajo con concentrado de ingresos y egresos, así como cálculo de impuestos.<br>
				•	Presentación de declaración de ISR, IVA y DIOT, RETENCIONES e IEPS en el portal SAT.<br>
				•	Asesorías telefónicas ilimitadas.<br>
				•	Generación de reportes auxiliares.<br>
				•	Envío de contabilidad mensual al SAT.<br>
				•	Generación de libros contables y contabilidad electrónica.<br>
				•	Plantilla de cotización para tus clientes. <br>
				•	Almacenamiento y pre rellenado para facturación de tickets de compra. *<br>
				•	MASSIVA MX resguarda todos tus comprobantes fiscales (declaraciones, pago de impuestos y facturas) dentro de tu propio perfil hasta por 5 años.<br><br>


				*El cliente decide a través de la plataforma ticket de compra, si massiva realiza la facturación, con un costo adicional. Consulta en tu perfil.<br><hr>
				<div class="alert alert-warning" role="alert">
					- Se te cobrará $199 los primeros meses hasta tu primer ingreso.<br>
					<b>¿Sin ingresos durante algún mes?</b> Se te cobrará durante ese mes $199.
				</div>
				<hr>
				<input type="hidden" name="idCliente" id="idCliente">
    			<!---uno--->
					<form class="input-group" style="width: 100% !important">
						<div class="row">
							<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Movimiento de ingresos</div>
							<div class="col-md-6" class="input-group">
								<select name="movingreo" id="movingreo" class="form-control">
									<option value=""></option>
									<option value="199">1 a 20</option>
									<option value="399">21 a 50</option>
									<option value="699">51 a 100</option>
									<option value="1">101 en adelante</option><!--se toma el ultimo maximo se le resta el valor puesto manual-->
								</select>
							</div>
							<div class="col-md-6" class="input-group">
							<input disabled class="form-control" name="cantmovingreo" id="cantmovingreo" onkeypress="return numbersonly(event);" onblur="primeraOperacion()" placeholder="Ingresa cuantos movimientos">
						</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
						</div>
					</form>
					<hr>
					<!---dos--->
					<div class="row">
						<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Movimientos de gastos</div>
						<div class="col-md-6" class="input-group">
							<select name="movGas" id="movGas" class="form-control">
								<option value=""></option>
								<option value="199">1 a 20</option>
								<option value="399">21 a 50</option>
								<option value="699">51 a 100</option>
								<option value="1">101 en adelante</option>
							</select>
						</div>
						<div class="col-md-6" class="input-group">
							<input disabled class="form-control" name="cantmovGas" id="cantmovGas" onkeypress="return numbersonly(event);" onblur="primeraOperacion()" placeholder="Ingresa cuantos movimientos">
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
					</div>
					<hr>
					<!---tres--->
					<div class="row">
						<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Total de ingresos</div>

						<div class="col-md-6" class="input-group">
							<select name="movIngreo" id="movIngreo" class="form-control">
								<option value=""></option>
								<option value="999">1 a 10,000</option>
								<option value="1999">10,001 a 20,000</option>
								<option value="2999">20,001 a 30,000</option>
								<option value="4999">30,001 a 50,000</option>
								<option value="5999">50,001 a 100,000</option>
								<option value="7999">100,001 a 500,000</option>
								<option value="8999">500,001 a 1,000,000</option>
								<option value="9999">1,000,001 a 2,000,000</option>
								<option value="1">2,000,001 en adelante</option><!--se toman lo 2 millones menos el vbalor manual se divide entre 1000 y eso multilicado por 10-->

							</select>
						</div>
						<div class="col-md-6" class="input-group"><!--El valor final es la suma de todos los anteriores--->
							<input disabled class="form-control" name="catMonto" id="catMonto" onkeypress="return numbersonly(event);" onblur="primeraOperacion()" placeholder="Ingresa el monto aproximado">
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
					</div>

					<hr>
					<div class="row">
						<div class="col-md-12 text-center">
							<button class="btn btn-primary" id="calcularcobroMensual" style="width: 100% !important"> Calcular</button>
						</div>
						<hr>
						<div class="col-md-12 text-center">
							<div id="costofinal1"></div>
						</div>
						<hr>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" id='btnDiez' class="btn btn-w-m btn-primary"> Seleccionar</button>
				
			</div>
		</div>
	</div>
</div>


<script src="js/vista/simuladores.js"></script>
<script src="js/vista/preregistro.js"></script>

<?php }else{ header ('location:../index.php?act=3');}?>

</html>
