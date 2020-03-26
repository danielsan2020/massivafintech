<?php 
@session_start();	
if($_SESSION['id_usuario'] != ''){
	date_default_timezone_set("America/Mexico_City");
	$fechaAccion = date("Y-m-d");
///cabezera
include 'estructura/header.php';
///script
include 'estructura/script.php';
$nombreCompleto = $_SESSION['nombre']." ".$_SESSION['ape_paterno']." ".$_SESSION['ape_materno'];
$correoCliente = $_SESSION['correo'];
//obtenemos los valores para el pago
	include "modelo/preregistroModelo.php";
	$osPreregistro = new DatosPreregistro();
	$actuPre = $osPreregistro->obtenerSelecPaque($_SESSION['id_usuario']);
	$actuPreInfo = $actuPre->fetch_object();
	//valores para agregar a los cuadros
	$idPaquete = $actuPreInfo->idPaquete;
	$montoM =  $actuPreInfo->montoM;
	$nombre =  $actuPreInfo->nombre;
	$codigoPagoManual =  $actuPreInfo->codigoPagoManual;

?>
<link href="css/pago.css" rel="stylesheet" type="text/css">
<script>
	function printDiv() 
{

  var divToPrint=document.getElementById('pagoEfectivo');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}

</script>
<script src="js/vista/preregistro.js"></script>
</head>
<body>
	
    <div class="gray-bg dashbard-1">
		<div class="container-fluid"></div>
		<div class="row"><div class="alert alert-warning text-center"><b>Bienvenido <?= $nombreCompleto?></b></div></div>
		<!--logo-->
		<div class="row  border-bottom white-bg dashboard-header">
			<div class="col-md-12 text-center">
				<img src="img/logo.png" style='height: 70px'>
			</div>
		</div>
		
		<div class='row text-center'>
			<div class="alert alert-warning">Selecciona tu tipo de pago.</div>
		</div>

		<div class='row'><div class='col-md-12' id='alertAccion' name='alertAccion'></div></div>
		
		<!--botones primarios-->
		<div class='row'>
			<div class="col-lg-2">
            </div>
			<div class="col-lg-3">
                <div class="widget style1 navy-bg" data-toggle="modal" data-target="#tarjetaBancaria" style="cursor: pointer">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-cc-mastercard fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <h2 class="font-bold">Tarjeta bancaria</h2>
                        </div>
                    </div>
                </div>
            </div>
			<div class="col-lg-3">
                <div class="widget style1 navy-bg" data-toggle="modal" data-target="#Transferencia" style="cursor: pointer">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-money fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <h3 class="font-bold" >Transferencia bancaria</h3>
                        </div>
                    </div>
                </div>
            </div>
			<!--pago en efectivo-->
			<div class="col-lg-3">
                <div class="widget style1 navy-bg" id='pagoEf' name='pagoEf' style="cursor: pointer;">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-dollar fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <h2 class="font-bold" >Pagos en efectivo</h2>
                        </div>
                    </div>
                </div>
            </div>
			
		</div>
		<br>
		
		<!--botones de pago en efectivo-->
		<div id='pagoEfectivo' style="display: none;">
			<div class='row'>
				<div class="col-md-3"></div>
				<div class="col-md-6 text-center">
					<h4>Tu Código de pago</h4>
					<div class="whitepaper">
						
						<div class="Header">
							<div class="Logo_empresa"><img src="img/comrpobante/logo.png" alt="Logo"></div>
						    <div class="Logo_paynet"><div>Servicio a pagar</div><img src="img/comrpobante/paynet_logo.png" alt="Logo Paynet"></div>
					    </div>
					    
					    <div class="Data">
					    	<div class="Big_Bullet"><span></span></div>
					    	<div class="col1">
					        	<!--h3>Fecha límite de pago</h3>
					            <h4>30 de Noviembre 2018</h4-->
					            <img width="300" src="https://api.openpay.mx/barcode/<?= $codigoPagoManual;?>?height=30" alt="Código de Barras">
					        	<center><span><?= $codigoPagoManual;?></span></center>
					            <small>En caso de que el escáner no sea capaz de leer el código de barras, escribir la referencia tal como se muestra.</small>
					        </div>
					        <div class="col2">
					        	<h2>Total a pagar</h2>
					            <h1>$<?= $montoM;?><span>.00</span><small> MXN</small></h1>
					            <span class="note">La comisión por recepción del pago varía de acuerdo a los Términos y Condiciones que cada cadena comercial establece.</span>
					        </div>
					    </div>

					    <div class="DT-margin"></div>
					    <div class="Data">
					    	<div class="Big_Bullet"><span></span></div>
					    	<div class="col1"><h3>Detalles de la compra</h3></div>
						</div>

					    <div class="Table-Data">
					    	<div class="table-row color1">
					        	<div>Descripción</div>
					            <span>Inscripción mensual con massiva</span>
					        </div>
					    
					    	<div class="table-row color2">
					        	<div>Nombre del cliente</div>
					            <span><?= $nombreCompleto;?></span>
					        </div>
					    	
					    	<div class="table-row color1">
					        	<div>Correo del cliente</div>
					            <span><?= $correoCliente;?></span>
					        </div>

					        <div class="table-row color2">
					        	<div>Número de usuario</div>
					            <span><?= $_SESSION['id_usuario'];?></span>
					        </div>
					        
					        <div class="table-row color1">
					        	<div>Fecha y hora</div>
					            <span><?php echo $fechaAccion?></span>
					        </div>

					    </div>

					    <div class="DT-margin"></div>
					    
					    <div>
					        <div class="Big_Bullet">
					        	<span></span>
					        </div>
					    	<div class="col1 text-left">
					        	<h3>Como realizar el pago</h3>
					            <ol>
					            	<li>Acude a cualquier tienda afiliada</li>
					                <li>Entrega al cajero el código de barras y menciona que realizarás un pago de servicio Paynet</li>
					                <li>Realizar el pago en efectivo por $<?= $montoM;?> MXN </li>
					                <li>Conserva el ticket para cualquier aclaración</li>
					            </ol>
					            <small>Si tienes dudas comunícate a atencionclientes@massiva.mx</small>
					        </div>
					    	<div class="col1 text-left">
					        	<h3>Instrucciones para el cajero</h3>
					            <ol>
					            	<li>Ingresar al menú de Pago de Servicios</li>
					                <li>Seleccionar Paynet</li>
					                <li>Escanear el código de barras o ingresar el núm. de referencia</li>
					                <li>Ingresa la cantidad total a pagar</li>
					                <li>Cobrar al cliente el monto total más la comisión</li>
					                <li>Confirmar la transacción y entregar el ticket al cliente</li>
					            </ol>
					            
					        </div>
					        <br>
					    </div>
						<hr><br>
					    <div class="row">
						    	<br>
							    <img src="img/comrpobante/01.png" width="80" height="35">
							    <img src="img/comrpobante/02.png" width="80" height="35">
							    <img src="img/comrpobante/03.png" width="80" height="35">
							    <img src="img/comrpobante/04.png" width="80" height="35">
							    <img src="img/comrpobante/05.png" width="80" height="35">
							    <img src="img/comrpobante/06.png" width="80" height="35">
							    <img src="img/comrpobante/07.png" width="80" height="35">
							    <img src="img/comrpobante/08.png" width="80" height="35">
						    <br>
							<img src="img/comrpobante/powered_openpay.png" alt="Powered by Openpay" width="150">
						</div>

					</div>	
				</div>
				<div class="col-md-3"></div>
			</div>
			<hr>

			<div class='row text-center'>
				<div class="col-md-3"></div>
				<div class="col-lg-2">
					<div class="widget" style=" background-color:rgb(226, 0, 74); color: #FFFFFF">
					   <a data-toggle="modal" data-target="#lugares" style="text-decoration: none; color: #FFFFFF" ><h5 class="font-bold" >Ver todas las tiendas afiliadas</h5></a>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="widget" style=" background-color:rgb(226, 0, 74); color: #FFFFFF">
					   <a data-toggle="modal" data-target="#mapa" style="text-decoration: none; color: #FFFFFF" ><h5 class="font-bold" >Buscar tiendas afiliadas</h5></a>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="widget" style=" background-color:rgb(226, 0, 74); color: #FFFFFF">
					   <a  onclick='printDiv();'  style="text-decoration: none; color: #FFFFFF" ><h5 class="font-bold" >Imprimir</h5></a>
					</div>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>

		<hr>
		<div class="row">
			<div class="col-md-12 text-center">
				<a data-toggle="modal" data-target="#altaR" style="color:rgb(226, 0, 74)"><b>¿No tienes tarjeta de crédito o débito?</b></a>
			</div>
		</div>
		<br>

		<div class="row">
			<div class="col-md-12 text-center">
				
				<input type="hidden" name="tarcre" id="tarcre">
				<a href="preregistro4.php?val=2"><button type="button" class="btn btn-w-m btn-primary"> Regresar</button></a>
				<button type="button" data-toggle="modal" data-target="#btnSeguir" class="btn btn-w-m btn-primary"> Siguiente</button>
				
			</div>
		</div><br>
		<hr>
		<!--pie de pagina-->
		<div class="row">
			<div class="col-lg-12">
				<div class="footer">
					<div><strong>Copyright</strong> Todos los derechos reservados massiva.mx &copy; 2019</div>
				</div>
			</div>
		</div> 
		
		<!--seccion de modal-->
		<div class="modal inmodal fade" id="altaR" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog  modal-lg">
				<div class="modal-content">
					<div class="modal-header text-center">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<img src="img/amazon.png" style="height:120px; cursor: pointer" id="amazonBtn">
						<img src="img/tipoTarjetas/albo.png" style="height:120px; cursor: pointer" id="albobtn">
					</div>
					<!--valores ocultos-->
					<div class="modal-body">
						<div id="amazon">
							<p>
								<b>TARJETA AMAZON RECARGABLE</b><br>
								Solicítala en línea.<br>
								No requiere verificación de historial crediticio para obtenerla.<br>
								Sin costo de apertura, comisiones mensuales ni saldo mínimo requerido.<br>
								Recibe tu tarjeta física en tu domicilio al acumular depósitos por $500 o más.<br>
								Una vez que hayas recibido tu tarjeta física, realiza compras en establecimientos nacionales e internacionales.<br><br>

								Recárgala en más de 25 mil establecimientos.<br>
								Retira efectivo en cajeros automáticos. Sin costo en los más de 7,000 cajeros Banorte.<br>
								Recárgala a través de transferencias bancarias y en tiendas como OXXO, Farmacias del Ahorro, 7 Eleven, entre otros.<br>
								Recarga hasta $18,000 pesos.<br><br>

								<a href="http://www.amazon.com.mx/b?ie=UTF8&node=17702865011" target="_blank">Solicitarla Ahora</a><br><br>

								<small style="font-size: 8px;">
								1 La Tarjeta Amazon Recargable es un producto emitido y operado por Banco Mercantil del Norte SA, Institución de Banca Múltiple, Grupo Financiero Banorte.<br>
								2 Otros productos nivel 2 de Banorte son Socio 7 y Enlace Digital.<br>
								3 La aplicación se realiza directamente en el portal del banco. No hay validación de historial crediticio, el resultado depende exclusivamente del cumplimiento de los requisitos definidos por la autoridad.<br>
								4 El envío de la tarjeta física ocurre una vez que el usuario ha acumulado depósitos de $500 pesos o más.<br>
								Utiliza la aplicación de Banorte Móvil para administrar tu tarjeta. Descárgala desde Google Play o la App Store.<br>
								Si ya eres cliente Banorte o fuiste cliente IXE y no tienes un correo registrado, tendrás que acudir a la sucursal de tu preferencia para actualizarlo.<br>
								</small>

							</p>
						</div>
						<div id="albo" style="display: none">
							<p>
								<b>TARJETA PREPAGO ALBO</b><br>
								Solicítala en línea.<br>
								Adiós sucursales, adiós filas.<br>
								Albo no está en sucursales, va contigo a donde vayas.<br>
								Desde la app, puedes acceder a todos los beneficios de albo estés donde estés y cuando lo necesites.<br>
								Sin comisiones ocultas, sin saldo mínimo y sin cuota mensual/anual.<br>
								$0 por apertura de cuenta.<br>
								$0 por envío de primera tarjeta a domicilio.<br>
								<br>
								<b>REQUISITOS</b><br>
									•	Identificación Oficial.<br>
									•	Persona Física.<br>
									•	Mayor de edad.<br>
									•	Smartphone con acceso a internet.<br>
									•	Android versión 5.0 en adelante.<br>
									•	iOS versión 7.0 en adelante.<br>

								<br>
								<a href="https://www.albo.mx/comisiones" target="_blank" >Solicitarla Ahora</a><br><br>

								<small style="font-size: 8px;">
								Las tarjetas Mastercard bajo la marca “albo” son emitidas tanto por Evertec México Servicios de Procesamiento SA de CV y operada por Cacao Paycard Solutions SAPI de CV, así como por Financiera Cuallix, S.A. de C.V., SOFOM ENR, bajo licencia de Mastercard Internacional. albo es una aplicación para smartphones mediante la cual se puede administrar la tarjeta Mastercard bajo la marca “albo”. Inteligencia en Finanzas, S.A.P.I. de C.V. no es un banco ni una entidad financiera. En términos de la disposición octava transitoria de la Ley para Regular las Instituciones de Tecnología Financiera (Ley), la autorización para llevar a cabo operaciones dentro de esta plataforma de fondos de pago electrónico, se solicitará dentro del plazo indicado por dicha Ley; por lo que la operación actual de la plataforma no es una actividad supervisada por las autoridades mexicanas.
								</small>

							</p>
						</div>
					</div>
					<div class="modal-footer text-center">
						<button type="button" class="btn btn-default" id="btnce" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
		
		<!--modal para mostrar los lugares de pago-->
		<div class="modal inmodal fade" id="lugares" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog  modal-lg">
				<div class="modal-content">
					
					<div class="modal-header text-center">
						<h3>Tiendas afiliadas</h3>
					</div>
					<!--valores ocultos-->
					<div class="modal-body text-center">
						<img src="img/tiendas/7-eleven.jpg" class="" class="img-thumbnail" style="height: 100px;">
						<img src="img/tiendas/aurrera.png" class="" class="img-thumbnail" style="height: 100px;">
						<img src="img/tiendas/circlek.jpg" class="" class="img-thumbnail" style="height: 100px;">
						<img src="img/tiendas/extra.jpg" class="" class="img-thumbnail" style="height: 100px;">
						<img src="img/tiendas/farmacia del ahorro.jpg" class="" class="img-thumbnail" style="height: 100px;">
						<img src="img/tiendas/guadalajara.jpg" class="" class="img-thumbnail" style="height: 100px;">
						<img src="img/tiendas/k.jpg" class="" class="img-thumbnail" style="height: 100px;">
						<img src="img/tiendas/sams.png" class="" class="img-thumbnail" style="height: 100px;">
						<img src="img/tiendas/Superama.png" class="" class="img-thumbnail" style="height: 100px;">
						<img src="img/tiendas/waldos.jpg" class="" class="img-thumbnail" style="height: 100px;">
						<img src="img/tiendas/walmart.png" class="" class="img-thumbnail" style="height: 100px;">
						<br>
						<hr>
						<b>Se te mandará la orden de pago mensual 7 días antes de tu corte de pago.</b>
												
					</div>
					<div class="modal-footer text-center">
						<button type="button" class="btn btn-default" id="btnce" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>

		<!--modal para mostrar el mapa y buscar lugares lugares de pago-->
		<div class="modal inmodal fade" id="mapa" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog  modal-lg">
				<div class="modal-content">
					
					<div class="modal-header text-center">
						<h3>Buscador de tiendas</h3>
						<div>
						    <iframe style='width: 100%; border: none; height: 450px;' src="https://www.paynet.com.mx/mapa-tiendas/index.html?locationNotAllowed=true""></iframe>
						</div>
					</div>
					
					<div class="modal-footer text-center">
						<button type="button" class="btn btn-default" id="btnce" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
		
		<!--modal para tarejteas de credito-->
		<div class="modal inmodal fade" id="tarjetaBancaria" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog  modal-lg">
				<div class="modal-content">
				
					<div class="modal-header text-center">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4>Ingresa tus datos bancarios</h4>
						<small>*Todos los datos son necesarios</small>
						
					</div>
					<!--valores ocultos-->
					<div class="modal-body text-center">
						<div class="row">
							<img src="img/cards1.png">&nbsp;&nbsp;
							<img src="img/cards2.png">&nbsp;&nbsp;
						</div>
						<hr>
						<br>
						<div class="row">
							
							<div class="col-md-12">
								<div class="input-group m-b">
									<span class="input-group-addon">*Nombre del titular</span> 
									<input type="text" name="nombre" id="nombre" placeholder="" class="form-control" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="input-group m-b">
									<span class="input-group-addon">*Tipo de tarjeta</span> 
									<select class="form-control" name="tipo" id="tipo">
										<option>Selecciona opción</option>
										<option value="1">Crédito</option>
										<option value="2">Débito</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group m-b">
									<span class="input-group-addon">*Número de tarjeta</span> 
									<input type="text" name="numero" id="numero" class="form-control" onkeypress="return NumCheck(event, this)">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="input-group m-b">
									<span class="input-group-addon">*Fecha de expiración (mes)</span> 
									<input type="text" name="fechaMes" id="fechaMes" class="form-control" style="width: 70%"  maxlength="2" onkeypress="return NumCheck(event, this)">
								</div>
							</div>

							<div class="col-md-4">
								<div class="input-group m-b">
									<span class="input-group-addon">*Fecha de expiración (año)</span> 
									<input type="text" name="fechaAno" id="fechaAno" class="form-control" style="width: 70%"  maxlength="2"onkeypress="return NumCheck(event, this)" >
								</div>
							</div>

							<div class="col-md-4">
								<div class="input-group m-b">
									<span class="input-group-addon">*CVV</span> 
									<input type="text" name="codigo" id="codigo" class="form-control" style="width: 40%" maxlength="4" onkeypress="return NumCheck(event, this)">
								</div>
							</div>
						</div>

						<hr>
						<!--h4>Tarjeta secundaria</h4>
						<small>*Los campos solo serán requeridos en caso de agregar una tarjeta secundaria</small>
						<br>
						<div class="row">
							
							<div class="col-md-12">
								<div class="input-group m-b">
									<span class="input-group-addon">*Nombre del titular</span> 
									<input type="text" name="nombre1" id="nombre1" placeholder="" class="form-control" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="input-group m-b">
									<span class="input-group-addon">*Tipo de tarjeta</span> 
									<select class="form-control" name="tipo1" id="tipo1">
										<option>Selecciona opción</option>
										<option value="1">Crédito</option>
										<option value="2">Débito</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group m-b">
									<span class="input-group-addon">*Número de tarjeta</span> 
									<input type="text" name="numero1" id="numero1" class="form-control" maxlength="16">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="input-group m-b">
									<span class="input-group-addon">*Fecha de expiración(Mes)</span> 
									<input type="text" name="fechaMes1" id="fechaMes1" class="form-control" style="width: 70%"  maxlength="2" >
								</div>
							</div>

							<div class="col-md-4">
								<div class="input-group m-b">
									<span class="input-group-addon">*Fecha de expiración (Año)</span> 
									<input type="text" name="fechaAno1" id="fechaAno1" class="form-control" style="width: 70%"  maxlength="2" >
								</div>
							</div>

							<div class="col-md-4">
								<div class="input-group m-b">
									<span class="input-group-addon">*CVV</span> 
									<input type="text" name="codigo1" id="codigo1" class="form-control" style="width: 40%" maxlength="4" >
								</div>
							</div>
						</div-->
						<hr>
						<div class="row"><img src="img/security.png">&nbsp;&nbsp; Tus pagos se realizan de forma segura con encriptación de 256 bits</div>
						<hr>
						<div class="row">
							<div class="col-md-12 text-center"><button type="button" id='btnGuardarTarjetas' class="btn btn-w-m btn-primary"> Guardar</button></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		<!--modal para mostrar los lugares de pago-->
		<div class="modal inmodal fade" id="Transferencia" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog  modal-lg">
				<div class="modal-content">
					
					<div class="modal-header text-center">
						<h4>Datos massiva para transferencia</h4>
					</div>
					<!--valores ocultos-->
					<div class="modal-body text-center">
						<div class="row">
							<div class="col-md-8">
								<div class="input-group m-b">
									<span class="input-group-addon">Beneficiario</span> 
									<input type="text"  placeholder="" value="MASSIVA CONTABILIDAD INNOVADORA S.C" class="form-control" disabled>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group m-b">
									<span class="input-group-addon">Banco</span> 
									<input type="text" value="BanRegio" class="form-control" disabled>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="input-group m-b">
									<span class="input-group-addon">Número de cuenta</span> 
									<input type="text"  placeholder="" value="220-93562-001-5" class="form-control" disabled>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group m-b">
									<span class="input-group-addon">Clabe interbancaria</span> 
									<input type="text" placeholder="" class="form-control" value="058180000002766829" disabled>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="input-group m-b">
									<span class="input-group-addon">Concepto</i></span> 
									<input type="text"  placeholder="" class="form-control" value="Inscripción mensual con massiva. Usuario: <?= $_SESSION['id_usuario']?>" disabled>
								</div>
							</div>
						</div>
												
					</div>
					<div class="modal-footer text-center">
						<button type="button" class="btn btn-default" id="btnce" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		<br>
		</div>

		<!--modal para el boton de continuar o-->
		<div class="modal inmodal fade" id="btnSeguir" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog  modal-lg">
				<div class="modal-content">
					
					<!--valores ocultos-->
					<div class="modal-body text-center">
						<img src="img/logo.png" style='height: 60px;'>
						<hr>
						<div class="alert alert-warning text-center"><b>Si no registraste una tarjeta bancaria se te mandará un aviso de pago mensual.<br>
						Siempre te recomendaremos que poseas una tarjeta bancaria por tu comodidad y seguridad.
						</b></div>
					</div>
					<div class="modal-footer text-center">
						<input type="hidden" name="Idncamos" id="Idncamos" value="<?= $_SESSION['id_usuario']?>">
						<button type="button" id='btnSig' class="btn btn-w-m btn-primary"> Aceptar</button>
						<button type="button" class="btn btn-default" id="btnce" data-dismiss="modal">Cerrar</button>
					</div>	
				</div>
			</div>
		</div>
		
		<?php include 'estructura/footer.php'; ?>    
    </div>
<script>

	$("#pagoEf").click(function(evento){
		
     if ($("#pagoEfectivo").css("display", "none")){
		 $("#pagoEfectivo").css("display", "block");
      }else{
		  
         $("#pagoEfectivo").css("display", "none");
		  
      }
   	});

	$("#amazonBtn").click(function(evento){
		$("#amazon").css("display", "block");
		$("#albo").css("display", "none");
     
   	});
	
	$("#albobtn").click(function(evento){
		$("#albo").css("display", "block");
		$("#amazon").css("display", "none");
     
   	});

</script>
</body>
<?php }else{ header ('location:../index.php?act=3');}?>
</html>
