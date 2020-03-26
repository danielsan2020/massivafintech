<?php 
@session_start();	
if($_SESSION['id_usuario'] != ''){

///cabezera
include 'estructura/header.php';
///script
include 'estructura/script.php';

///datos que ya vienen
$_SESSION['id_usuario'];

//obtenemos la ifnormacion
include "modelo/preregistroModelo.php";
$osPreregistro = new DatosPreregistro();
$actuPre = $osPreregistro->datoGener($_SESSION['id_usuario']);
$actuPreInfo = $actuPre->fetch_object();
//valores para agregar a los cuadros
$id_usuario = $actuPreInfo->id_usuario;
$usuario = $actuPreInfo->usuario;
$clave = $actuPreInfo->clave;
$nombre = $actuPreInfo->nombre;
$ape_paterno = $actuPreInfo->ape_paterno;
$ape_materno = $actuPreInfo->ape_materno;
$telefono = $actuPreInfo->telefono;
$rfc = $actuPreInfo->rfc;
$correo = $actuPreInfo->correo;
$tipoActividad = $actuPreInfo->tipoActividad;
$formaJuridica = $actuPreInfo->formaJuridica;
$cantidadTrabajadores = $actuPreInfo->cantidadTrabajadores;
$noTengoEfirma = $actuPreInfo->noTengoEfirma;
$contabilidadAtrasada = $actuPreInfo->contabilidadAtrasada;
$tipoUsuario = $actuPreInfo->tipoUsuario;
$valorPre = $actuPreInfo->valorPre;
$fechaCrea = $actuPreInfo->fechaCrea;
$estatus = $actuPreInfo->estatus;
$nUsuario = $actuPreInfo->nUsuario;
$nacimiento = $actuPreInfo->nacimiento;
$dirfiscal = $actuPreInfo->dirfiscal;
$estado = $actuPreInfo->estado;
$ciudad = $actuPreInfo->ciudad;
$municipio = $actuPreInfo->municipio;
$codigoPromo = $actuPreInfo->codigoPromo;
$curp = $actuPreInfo->curp;

///obtenemos la documentacion que subio el usuario
$documm = $osPreregistro->datosDocum($_SESSION['id_usuario']);
$docummInfo = $documm->fetch_object();

$comprobante = $docummInfo->comprobante;
$iden1 = $docummInfo->iden1;
$iden2 = $docummInfo->iden2;
$keyaar = $docummInfo->keyaar;
$cerar = $docummInfo->cerar;
$clave = $docummInfo->clave;

//obtenemos la seleccion de paquete
$pqaque = $osPreregistro->obtenerSelecPaque($_SESSION['id_usuario']);
$pqaqueInfo = $pqaque->fetch_object();
$nombe =  $pqaqueInfo->nombre;
$montoM =  $pqaqueInfo->montoM;

//obtenemos los valores de pago
$id_usuario = $_SESSION['id_usuario'];
$tarhje = $osPreregistro->obteneFormaPag($id_usuario);
$tarhjeInfo = $tarhje->fetch_object();
$tipoTarjeta =  $tarhjeInfo->tipoTarjeta;
$numneroTarjeta =  $tarhjeInfo->numero;

echo $formaJuridica;

//verificamos si tiene cotizaciones pendiente
if($formaJuridica == 'f'){
	$coti = $osPreregistro->tieneCotizacionpf($rfc);
	$cotiInfo = $coti->fetch_object();
	$sitien = $cotiInfo->idContaAtrasada;
	$monn = $cotiInfo->monto;
}else{
	$coti = $osPreregistro->tieneCotizacionpm($rfc);
	$cotiInfo = $coti->fetch_object();
	$sitien = $cotiInfo->idContaAtrasada;
	$monn = $cotiInfo->monto;
}

/* valor para el anuncion de que los archivos cuando el usuario no tenga e firma no sean correctos */
$aviso = $_GET['valorReg'];

?>
<script>
function cambiar(){ document.getElementById('clavee').type = 'text'; }
function cambiar22(){ document.getElementById('claveesinefirma').type = 'text'; }
</script>
<!--script src="js/vista/preregistro.js"></script-->
<script src="js/vista/simuladores.js"></script>
</head>
<body>
<div class="gray-bg dashbard-1">
	<div class="row"><div class="alert alert-warning text-center"><b>Revisa tu resumen general.</b></div></div>
	
	<div class="row"><div class="col-md-12 text-center"><img src="img/logo.png" style="height: 60px"><br><br></div></div>
	
	<div class='container'>
	<!-- valor para imprimir el resultado si los archivos estan mal -->
	<div class='row text-center'><?php echo $aviso;?></div>
	
	<!--contrato-->
	<div class='row'>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h5><b>1. Datos generales</b></h5></div>
				<div class="panel-body">

					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">Nombre</span> 
							<input type="text" id="nombre" name="nombre" class="form-control" value="<?= $nombre;?>" disabled >
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">Apellido paterno</span> 
							<input type="text" id="ape_paterno" name="ape_paterno" class="form-control" value="<?= $ape_paterno;?>" disabled >
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">Apellido materno</span> 
							<input type="text" id="ape_materno" name="ape_materno" class="form-control" value="<?= $ape_materno;?>" disabled >
						</div>
					</div>

					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">Fecha de nacimiento</span> 
							<input type="text" id="nacimiento" name="nacimiento" class="form-control" value="<?= $nacimiento;?>" disabled>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">RFC</span> 
							<input type="text" id="nacimiento" name="nacimiento" class="form-control" value="<?= $rfc;?>" disabled>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">CURP</span> 
							<input type="text" id="telefono" name="telefono" class="form-control" value="<?= $curp;?>" disabled >
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">Télefono</span> 
							<input type="text" id="telefono" name="telefono" class="form-control" value="<?= $telefono;?>" disabled >
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">Correo</span> 
							<input type="text" id="correo" name="correo" class="form-control" value="<?= $correo;?>" disabled >
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">Estado</span> 
							<input type="text" id="estado" name="estado" class="form-control" value="<?= $estado;?>" disabled>
						</div>
					</div>
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon">Dirección fiscal</span> 
							<input type="text" id="dirfiscal" name="dirfiscal" class="form-control"  value="<?= $dirfiscal;?>" disabled>
						</div>
					</div>
					
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">Ciudad</span> 
							<input type="text" id="ciudad" name="ciudad" class="form-control" value="<?= $ciudad;?>" disabled>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">C.P</span> 
							<input type="text" id="municipio" name="municipio" class="form-control" value="<?= $municipio;?>" disabled>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">Código de promoción</span> 
							<input type="text" id="codigoPromo" name="codigoPromo" class="form-control" value="<?= $codigoPromo;?>" disabled>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">Tipo de actividad que ejerces</span> 
							<input type="text" id="tipoActividad" name="tipoActividad" class="form-control" value="<?= $tipoActividad;?>" disabled>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">Tu forma jurídica</span> 
							<input type="text" id="formaJuridica" name="formaJuridica" class="form-control" value="<?php if($formaJuridica == 'm'){ echo "´Persona Moral";}else{echo "Person Fsica";}?>" disabled>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">Cantidad de trabajadores</span> 
							<input type="text" id="cantidadTrabajadores" name="cantidadTrabajadores" class="form-control" 
							value="<?php 
							if($cantidadTrabajadores == 0){echo 'Tengo de 0 trabajadores';}
							if($cantidadTrabajadores == 1){echo 'Tengo de 1 a 5 trabajadores';}
							if($cantidadTrabajadores == 2){echo 'Tengo de 6 a 10 trabajadores';}
							if($cantidadTrabajadores == 3){echo 'Tengo de 11 a 20 trabajadores';}
							if($cantidadTrabajadores == 4){echo 'Tengo de 21 a 50 trabajadores';}
							if($cantidadTrabajadores == 5){echo 'Tengo más de 50 trabajadores';}
							?>" disabled>
						</div>
					</div>
					<?php 
						if($contabilidadAtrasada == 1){
					?>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">Tengo mi contabilidad atrasada</span> 
						</div>
					</div>
				<?php }?>

				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h5><b>2. Documentación</b></h5></div>
				<div class="panel-body">
					<div class="text-center">
						<img src="img/document.png" style='height: 50px;'>Comprobante de domicilio
						<img src="img/document.png" style='height: 50px;'>Identificación
						<?php if($noTengoEfirma  == 0){?>
						<img src="img/document.png" style='height: 50px;'>Archivo .KEY
						<img src="img/document.png" style='height: 50px;'>Archivo .CER
						<?php }?>
					</div>
				</div>

			</div>
		</div>

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h5><b>3. Selección de paquete</b></h5></div>
				<div class="panel-body" class="text-center">
					<div class="text-center">
						<b><?= $nombe;?></b> por inscripción mensual de <b>$<?= $montoM;?> </b>pesos.
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h5><b>4. Datos de pago</b></h5></div>
				<div class="panel-body">
					<div class="text-center">
						<?php if($numneroTarjeta != ''){
							
							//$numneroTarjetaFin = subsrt($numneroTarjeta,-3); 

						?>
							<b>Agregaste la tarjeta: <?php echo $numneroTarjeta; ?>, como método de pago.</b>
						<?php }else{?>
							<b>Seleccionaste depósito bancario o pago en efectivo.</b>
						<?php }?>
					</div>
				</div>

			</div>
		</div>
		
	</div>
	<hr>
	</div>
	<div class="row">
		<div class="col-md-12 text-center">
			<!--boton para regresar-->
			<a  href="preregistro6.php" style="color: #FFFFFF"><button class="btn btn-primary ">&nbsp;Regresar</button></a>
			<!--boton para cuando el usuario es nomral-->
			<?php if($noTengoEfirma == 0 && $contabilidadAtrasada == 0 ){?>
			<a  data-toggle="modal" data-target="#final" style="color: #FFFFFF"><button class="btn btn-primary " type="submit">&nbsp;Aceptar</button></a>
			<!--boton para cuando tiene contabilidad atrasada-->
			<?php 
				}
				elseif($contabilidadAtrasada == 1){
			?>
			<a  data-toggle="modal" data-target="#sanear" style="color: #FFFFFF"><button class="btn btn-primary " type="submit">&nbsp;Aceptar</button></a>
			<?php 
				}
				elseif($noTengoEfirma == 1){
			?>
			<!---boton para cuando no tiene e firma-->
			<a  data-toggle="modal" data-target="#sinefirma" style="color: #FFFFFF"><button class="btn btn-primary " type="submit">&nbsp;Guardar</button></a>
			<?php }?>

		</div>
	</div>
	<hr>
	<div class='row text-center'>
		<div class="alert alert-warning">¿Tienes dudas?, escríbenos a <a href="mailto:atencionclientes@massiva.mx" style="color:rgb(226, 0, 74)">atencionclientes@massiva.mx</a>	</div>
	</div>
	<br>
	<hr>
	<!--pie de pagina-->
	<div class="row">
		<div class="col-lg-12">
			<div class="footer">
				<div><strong>Copyright</strong> Todos los derechos reservados massiva.mx &copy; 2019</div>
			</div>
		</div>
	</div>   
</div>


<!--seccion para el modal cuando el usuario no tiene e firma -->
<div class="modal inmodal fade" id="sinefirma" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo"></h4>
			</div>
			<div class="modal-body">
			
				<div class='row text-center'>
					<img src="img/logo.png" style="height: 60px">
					<hr>
					<div class="alert alert-danger"><h5>Es tiempo de que saques tu cita en el SAT.</h5><a href="https://citas.sat.gob.mx/citasat/agregarcita.aspx" target="_blank"><button class="btn btn-w-m btn-primary">Sacar cita</button></a></div>
					<form action='controlador/preregistroControlador.php' method='POST'  enctype="multipart/form-data">
					<input type="hidden" class="form-control" name="id_usuarioEfirm" id='id_usuarioEfirm' value='<?php echo $id_usuario;?>'>
					<input type="hidden" class="form-control" name="accion" id="accion" value='presubeefirma'>
					<input type="hidden" class="form-control" name="rfcefir" id="rfcefir" value='<?php echo $_SESSION['rfc'];?>'>
					<hr>
					<div class="alert alert-warning"><h5>Solo te quedaría obtener y adjuntar los archivos de la e.firma. El cargo no se te hará hasta que los adjuntes.</h5></div>
					<div class="input-group m-b">
								<span class="input-group-addon">e.firma .KEY</span> 
								<input type="file" placeholder="efirma" name='keysinefirma' id='keysinefirma' class="form-control" required>
							</div>
							<div class="input-group m-b">
								<span class="input-group-addon">e.firma .CER <img src='img/CER.png' style='height:20px; cursor:pointer:'></span> 
								<input type="file" placeholder="efirma" name='cersinefirma' id='cersinefirma' class="form-control" required>
								
							</div>

							<div class="input-group m-b">
								<span class="input-group-addon">Contraseña de e.firma</span> 
								<input type="password" name='claveesinefirma' id='claveesinefirma'  class="form-control" required>
								<span class="input-group-addon"><i class="fa fa-eye" onclick="javascript: cambiar22()"></i></span>
							</div>
				</div>
    			
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-w-m btn-primary"> Subir archivos</button>
				<button type="button" id='btnEliminar' class="btn btn-white" data-dismiss="modal">Aceptar</button>
			</div>

			</form>
		</div>
	</div>
</div>

<!--modal para cuando la persona no tiene e firma--->
<div class="modal inmodal fade" id="final" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo"></h4>
			</div>
			<form action='controlador/preregistroControlador.php' method='POST'>
			<input type='hidden' name='accion' id='accion' value='terminoBien'>
			<input type='hidden' name='correo1E' id='correo1E' value='<?= $correo;?>'>
		
				<div class="modal-body">
					<div class='row text-center'>
						<img src="img/logo.png" style="height: 60px">
						<hr>
						<div class="alert alert-warning"><h3><b>¡Gracias!</b></h3> Asegúrate de elegir correctamente tu forma jurídica,<br>ya que de eso dependerá el servicio brindado y el cobro del mismo por massiva.</h5></div>
					</div>
					
				</div>
				<div class="modal-footer text-center">
					
					<button type="submit" class="btn btn-w-m btn-primary"> Aceptar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--modal para sanear--->
<div class="modal inmodal fade" id="sanear" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo"></h4>
			</div>
			<div class="modal-body">
				<div class='row text-center'>
					<img src="img/logo.png" style="height: 60px">
					<hr>
					<div class="alert alert-warning"><h5>Primero debemos actualizar y solucionar tu contabilidad anterior a massiva.</h5></div>
					<hr>
					<h4>PASOS para actualizar tu contabilidad</h4><hr>
					<div class="text-left">
						1. El tiempo para analizar tu contabilidad anterior a massiva será de 2 días hábiles.<br>
						2. Te enviaremos a tu mail registrado el costo total por actualizarte ante el SAT.<br>
						3. Si aceptas, te haremos el cargo automático a tu tarjeta registrada o deberás hacer la transferencia.<br>
						4. El tiempo de actualizar tu contabilidad para Persona Física será de 5 a 7 días hábiles.<br>
						4.1 El tiempo de actualizar tu contabilidad para Persona Moral será de 15 a 30 días hábiles.<br>
						5. Guardaremos tu información en tu perfil de massiva y te avisaremos para que ya puedas volver a entrar.<br>
						6. ¡Listo! Massiva ya puede ocuparse de tu contabilidad saneada.<br>

					</div>
				</div>
				<hr>
				
				<?php if($sitien != ''){?>
				<!---en caso de que el rfc ya tenga cotizacion-->
				<h4 class="text-center">Ya realizaste una cotización en atención al cliente con los siguientes datos:</h4><br>
				<div class="text-center">
					<b>Forma jurídica</b>: Persona Física.<br>
					<b>Costo</b>: $<?= $monn; ?> pesos.
				</div>
				<?php }else{?>
				<!---en caso de que todavia no tenga cotizacion--->
				<h4 class="text-center">Cotiza el costo <b>aproximado</b> por tu contabilidad atrasada, según tu forma jurídica.</h4><br>
				<div class="text-center">
					<button type="button" id='veoFisica' class="btn btn-w-m btn-primary"> Persona Física</button>&nbsp;&nbsp;&nbsp;&nbsp;
					<!--button type="button" id='VeoMoral' class="btn btn-w-m btn-primary"> Persona Moral</button-->
				</div>
				<?php }?>

				<hr>
				<!---calculadora persona fisica-->
				<div id="pfCal" style="display: none;">
					<div class="wrapper wrapper-content animated fadeInRight">
						<div class="row">
							<div class="text-center"><h4>Cotización de contabilidad atrasada</h4></div>
							<hr>
							<div class='row'><div class='col-md-12 text-center'><img src='img/bandos.jpg'></div></div>
							<hr>
							<!-- guardamos la cotizacion en la tabla de contabilidad atrasada  -->
							<form class="input-group" action="controlador/simuladorControlador.php" style="width: 100% !important" method="POST">

								<input type="hidden" class="form-control" name="montoCal" id='montoCal'>
								<input type="hidden" class="form-control" name="accion2" id="accion2" value='pre'>

								<div class="row">
									<div class="col-md-6"><input class="form-control" name="rfc" id="rfc" placeholder="*RFC" required onblur="ValidaRfc(this.value)" style="text-transform:uppercase" value="<?=$rfc;?>"></div>
									<div class="col-md-6"><input class="form-control" name="nombre" id="nombre" placeholder="Nombre" value="<?=$nombre;?>"></div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-6"><input class="form-control" name="ape_paterno" id="ape_paterno" placeholder="Apellido paterno" value="<?=$ape_paterno;?>"></div>
									<div class="col-md-6"><input class="form-control" name="ape_materno" id="ape_materno" placeholder="Apellido materno" value="<?=$ape_materno;?>"></div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-6"><input class="form-control" name="correo" id="correo" placeholder="*Correo electrónico" required value="<?=$correo;?>"></div>
									<div class="col-md-6">
										<select id='mesesin' name='mesesin' class='form-control'>
											<option value=''>Selecciona tus meses sin intereses</option>
											<option value='0'>Al contado</option>
											<option value='1'>3 meses</option>
											<option value='2'>6 meses</option>
											<option value='3'>9 meses</option>
										</select>
									</div>
 								</div>
								<hr>
								<!---uno--->
								<div class="row">
									<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Periodos a regularizar</div>
									<div class="col-md-12" class="input-group">
										<select name="periodoRegu" id="periodoRegu" class="form-control">
											<option>Selecciona</option>
											<option value="1">1 año o menos</option>
											<option value="2">2 años</option>
											<option value="3">3 años</option>
											<option value="4">4 años</option>
											<option value="5">5 años</option>
											<option value="6">5 a 10 años</option>
										</select>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
								</div>
								
								<hr>
								<!---dos--->
								<div class="row">
									<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Obligaciones pendientes <small>(Si el cliente no sabe que obligaciones señala las tres)</small></div>
									<div class="col-md-2">
										<input type="checkbox" name="obliga[]" id="obliga" value="1"> ISR<br>
									</div>
									<div class="col-md-2">
										<input type="checkbox" name="obliga[]" id="obliga"  value="2"> IVA<br>
									</div>
									<div class="col-md-2">
										<input type="checkbox" name="obliga[]" id="obliga" value="3"> DIOT<br>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
								</div>
								<hr>
								<!---tres--->
								<div class="row">
									<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Régimen al que pertenece</div>

											<div class="col-md-4">
												<input type="checkbox" id="cheInteres" name="cheInteres" value="1"> INTERÉS<br>
											</div>
											<div class="col-md-4">
												<input type="checkbox" id="cheasalariado" name="cheasalariado" value="2"> ASALARIADO<br>
											</div>
											<div class="col-md-4">
												<input type="checkbox" id="chearrendamiento" name="chearrendamiento" value="3"> ARRENDAMIENTO<br>
											</div>
											<div class="col-md-4">
												<input type="checkbox" id="cheservicios" name="cheservicios" value="4"> SERVICIOS PROFESIONALES<br>
											</div>
											<div class="col-md-4">
												<input type="checkbox" id="cheempresaria" name="cheempresaria" value="5"> ACTIVIDAD EMPRESARIAL<br>
											</div>
											<div class="col-md-4">
												<input type="checkbox" id="cherif" name="cherif" value="6"> RIF<br>
											</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
								</div>
								<hr>
								<div class="row">
									<div class="col-md-12 text-center"> <button class="btn btn-primary" id="calcular" type="button" style="width: 100% !important"> Calcular</button></div>
									<hr>
									<div class="col-md-12 text-center"> <div id="costofinal1"></div></div>
									<hr>
									<div class="col-md-12 text-center"> <div id="avisoPF"></div></div>
									<hr>
									<div class="col-md-12 text-center"><button class="btn btn-primary" type="button" id="EnviarGuardar" style="width: 100% !important"> Enviar a mi correo</button></div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<!---calculadora persona moral-->
				<!--div id="pmCal" style="display: none;">
					<div class="text-center"><h4>Cotización de contabilidad atrasada</h4></div>
							<hr>
							<div id="avisoPF2"></div>
					<form class="input-group" action="controlador/simuladorControlador.php" style="width: 100% !important" method="POST">

						<input type="hidden" class="form-control" name="montoCal1" id='montoCal1'>
						<input type="hidden" class="form-control" name="accion" id="accion" value='agergarAte1'>

						<div class="row">
							<div class="col-md-6"><input class="form-control" name="rfc1" id="rfc1" placeholder="*RFC" value="<?=$rfc;?>" required onblur="ValidaRfc(this.value)" style="text-transform:uppercase"></div>
							<div class="col-md-6"><input class="form-control" name="nombre1" id="nombre1" placeholder="Nombre" value="<?=$nombre;?>"></div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-6"><input class="form-control" name="ape_paterno1" id="ape_paterno1" placeholder="Apellido paterno" value="<?=$ape_paterno;?>"></div>
							<div class="col-md-6"><input class="form-control" name="ape_materno1" id="ape_materno1" placeholder="Apellido materno" value="<?=$ape_materno;?>"></div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-6"><input class="form-control" name="correo1" id="correo1" placeholder="*Correo electrónico" value="<?=$correo;?>" required></div>
						</div>
						<hr>
					
					
						<div class="row">
							<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Periodos a regularizar</div>
							<div class="col-md-12" class="input-group">
								<select name="periodoRegu2" id="periodoRegu2" class="form-control">
									<option>Selecciona</option>
									<option value="1">1 año o menos</option>
									<option value="2">2 años</option>
									<option value="3">3 años</option>
									<option value="4">4 años</option>
									<option value="5">5 años</option>
									<option value="6">5 a 10 años</option>
								</select>
							</div>
						</div>
						
						<hr>
						
						<div class="row">
							<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Obligaciones pendientes <small>(Si el cliente no sabe que obligaciones señala las tres)</small></div>
							<div class="col-md-2">
								<input type="checkbox" name="obliga2[]" id="obliga2[]" value="1"> ISR<br>
							</div>
							<div class="col-md-2">
								<input type="checkbox" name="obliga2[]" id="obliga2[]"  value="2"> IVA<br>
							</div>
							<div class="col-md-2">
								<input type="checkbox" name="obliga2[]" id="obliga2[]" value="3"> DIOT<br>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU2" name='datosU2'></div>
						</div>
						<hr>
						<div class="row">
							<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Ingresos Anuales</div>
							<div class="col-md-12" class="input-group">
								<select name="movIngUno2" id="movIngUno2" class="form-control">
									<option value="0">0</option>
									<option value="1049">1 a 10,000</option>
									<option value="2099">10,001 a 20,000</option>
									<option value="2999">20,001 a 30,000</option>
									<option value="3149">30,001 a 50,000</option>
									<option value="5999">50,001 a 100,000</option>
									<option value="6299">100,001 a 500,000</option>
									<option value="9449">500,001 a 1,000,000</option>
									<option value="10499">1,000,001 a 2,000,000</option>

								</select>
							</div>
						</div>
						<hr>
					
						<div class="row">
							<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Régimen al que pertenece</div>

									<div class="col-md-6 text-center">
										<input type="checkbox" id="regeneral" value="1"> RÉGIMEN GENERAL<br>
									</div>
									<div class="col-md-6 text-center">
										<input type="checkbox" id="fineslucra" value="2"> CON FINES NO LUCRATIVOS<br>
									</div>
						
							<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12 text-center">
								<button class="btn btn-primary" id="calcularPM" type="button" style="width: 100% !important"> Calcular</button>
							</div>
							<hr>
							<div class="col-md-12 text-center"> <div id="costofinal12"></div></div>
							<hr>
							<div class="col-md-12 text-center"> <div id="avisoCorreoEnvio"></div></div>
							<hr>
							
							<div class="col-md-12 text-center">
								<button class="btn btn-primary" id="guardarPM" type='button' style="width: 100% !important"> Guardar</button>
							</div>
						</div>
								
							
    				
    			</div-->
			</div>



			
			<div class="modal-footer">
				<input type="hidden" name="idSaneRef2" id="idSaneRef2" value="<?= $_SESSION['id_usuario']?>">
				<button type="button" id='btnSeguirFinalSanear2' class="btn btn-w-m btn-primary"> Aceptar</button>
				<button type="button" id='btnEliminar' class="btn btn-white" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
</body>
<?php }else{ header ('location:../index.php?act=3');}?>
</html>
