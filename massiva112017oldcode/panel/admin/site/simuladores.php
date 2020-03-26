<?php
	//instanciamos el metodo para mostrar la informacion
	include 'modelo/blogModelo.php';
    $blogMo = new blogMo();
    $rspTabla = $blogMo->informacionTabla();
?>
<!--seccion de contenido-->
<script src="js/vista/simuladores.js"></script>
<script>
function cambiarDisplay() 
{
	if (document.getElementById("cheInteres").disabled){
		document.getElementById("cheInteres").disabled = false;
		
	}else{
		document.getElementById("cheInteres").disabled = true;
		document.getElementById("cheInteres").checked=false;
	}
	
	if (document.getElementById("cheasalariado").disabled){
		document.getElementById("cheasalariado").disabled = false;
		
	}else{
		document.getElementById("cheasalariado").disabled = true;
		document.getElementById("cheasalariado").checked=false;
	}
	
	if (document.getElementById("chearrendamiento").disabled){
		document.getElementById("chearrendamiento").disabled = false;
		
		
	}else{
		document.getElementById("chearrendamiento").disabled = true;
		document.getElementById("chearrendamiento").checked=false;
	}
	
	if (document.getElementById("cheservicios").disabled){
		document.getElementById("cheservicios").disabled = false;
		
	}else{
		document.getElementById("cheservicios").disabled = true;
		document.getElementById("cheservicios").checked=false;
	}
	
	if (document.getElementById("cheempresaria").disabled){
		document.getElementById("cheempresaria").disabled = false;
		
	}else{
		document.getElementById("cheempresaria").disabled = true;
		document.getElementById("cheempresaria").checked=false;
	}

}

function cambiarDisplay2() 
{
	if (document.getElementById("cheInteres2").disabled){
		document.getElementById("cheInteres2").disabled = false;
		
	}else{
		document.getElementById("cheInteres2").disabled = true;
		document.getElementById("cheInteres2").checked=false;
	}
	
	if (document.getElementById("cheasalariado2").disabled){
		document.getElementById("cheasalariado2").disabled = false;
		
	}else{
		document.getElementById("cheasalariado2").disabled = true;
		document.getElementById("cheasalariado2").checked=false;
	}
	
	if (document.getElementById("chearrendamiento2").disabled){
		document.getElementById("chearrendamiento2").disabled = false;
		
		
	}else{
		document.getElementById("chearrendamiento2").disabled = true;
		document.getElementById("chearrendamiento2").checked=false;
	}
	
	if (document.getElementById("cheservicios2").disabled){
		document.getElementById("cheservicios2").disabled = false;
		
	}else{
		document.getElementById("cheservicios2").disabled = true;
		document.getElementById("cheservicios2").checked=false;
	}
	
	if (document.getElementById("cheempresaria2").disabled){
		document.getElementById("cheempresaria2").disabled = false;
		
	}else{
		document.getElementById("cheempresaria2").disabled = true;
		document.getElementById("cheempresaria2").checked=false;
	}

}
function cambiarD() 
{
	if (document.getElementById("casalariado").disabled){
		document.getElementById("casalariado").disabled = false;
		
	}else{
		document.getElementById("casalariado").disabled = true;
		document.getElementById("casalariado").checked=false;
	}
	
	if (document.getElementById("cempresaria").disabled){
		document.getElementById("cempresaria").disabled = false;
		
	}else{
		document.getElementById("cempresaria").disabled = true;
		document.getElementById("cempresaria").checked=false;
	}
}
function cambri(){
	if (document.getElementById("cempresaria").checked && document.getElementById("casalariado").checked){
		document.getElementById("crif").disabled = true;
		document.getElementById("crif").checked=false;
		
		
	}else{
		document.getElementById("crif").disabled = false;
		document.getElementById("crif").checked=false;
	}
}
</script>
<?php if($guaSim == 1){?>
<div class="row">
	<div class="col-md-12" id="alertAccion">
		<div class="alert alert-warning text-center"> se envió y se guardó la información </div></div>
</div>
<?php }?>

<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row m-t-lg">
		<div class="col-lg-12">
			<div class="tabs-container">
				
					
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#tab-1"> Regularización PF</a></li>
						<li><a data-toggle="tab" href="#tab-2"> Regularización PM</a></li>
						<li><a data-toggle="tab" href="#tab-3"> Cobro mensual PM</a></li>
						<!--li><a data-toggle="tab" href="#tab-4"> Nóminas sueldos y salarios </a></li-->
						<li><a data-toggle="tab" href="#tab-4"> PF Especial </a></li>
					</ul>

					<div class="tab-content ">
						<!--regularizacion personal fisica--->
						<div id="tab-1" class="tab-pane active">
								<div class="panel-body">
									<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Datos generales</div>
									<form class="input-group" action="controlador/simuladorControlador.php" style="width: 100% !important" method="POST">

										<input type="hidden" class="form-control" name="montoCal" id='montoCal'>
										<input type="hidden" class="form-control" name="accion" id="accion" value='agergarAte'>

										<div class="row">
											<div class="col-md-6"><input class="form-control" name="rfc" id="rfc" placeholder="*RFC" required onblur="ValidaRfc(this.value)" style="text-transform:uppercase"></div>
											<div class="col-md-6"><input class="form-control" name="nombre" id="nombre" placeholder="Nombre"></div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-6"><input class="form-control" name="ape_paterno" id="ape_paterno" placeholder="Apellido paterno"></div>
											<div class="col-md-6"><input class="form-control" name="ape_materno" id="ape_materno" placeholder="Apellido materno"></div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-6"><input class="form-control" name="correo" id="correo" placeholder="*Correo electrónico" required></div>
											
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
											<input type="checkbox" name="obliga[]" id="obliga[]" value="1"> ISR<br>
										</div>
										<div class="col-md-2">
											<input type="checkbox" name="obliga[]" id="obliga[]"  value="2"> IVA<br>
										</div>
										<div class="col-md-2">
											<input type="checkbox" name="obliga[]" id="obliga[]" value="3"> DIOT<br>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
									</div>
									<hr>
									<!---tres--->
									<div class="row">
										<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Régimen al que pertenece</div>

												<div class="col-md-2">
													<input type="checkbox" id="cheInteres" name="cheInteres" value="1"> INTERÉS<br>
												</div>
												<div class="col-md-2">
													<input type="checkbox" id="cheasalariado" name="cheasalariado" value="2"> ASALARIADO<br>
												</div>
												<div class="col-md-2">
													<input type="checkbox" id="chearrendamiento" name="chearrendamiento" value="3"> ARRENDAMIENTO<br>
												</div>
												<div class="col-md-2">
													<input type="checkbox" id="cheservicios" name="cheservicios" value="4"> SERVICIOS PROFESIONALES<br>
												</div>
												<div class="col-md-2">
													<input type="checkbox" id="cheempresaria" name="cheempresaria" value="5"> ACTIVIDAD EMPRESARIAL<br>
												</div>
												<div class="col-md-2">
													<input type="checkbox" id="cherif" name="cherif" onclick="cambiarDisplay()" value="6"> RIF<br>
												</div>
									
										<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-12 text-center"> <button class="btn btn-primary" id="calcular" type="button" style="width: 100% !important"> Calcular</button></div>
										<hr>
										<div class="col-md-12 text-center"> <div id="costofinal1"></div></div>
										<hr>
										<div class="col-md-12 text-center"><button class="btn btn-primary" type="submit" style="width: 100% !important"> Enviar y guardar</button></div>
									</div>
								</div>
							</form>
						</div>
						<!--regularizacion personal moral--->
						<div id="tab-2" class="tab-pane ">
							<div class="panel-body">
								<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Datos generales</div>
								<form class="input-group" action="controlador/simuladorControlador.php" style="width: 100% !important" method="POST">

									<input type="hidden" class="form-control" name="montoCal1" id='montoCal1'>
									<input type="hidden" class="form-control" name="accion" id="accion" value='editaCotiEnvia'>

									<div class="row">
										<div class="col-md-6"><input class="form-control" name="rfc1" id="rfc1" placeholder="*RFC" required onblur="ValidaRfc(this.value)" style="text-transform:uppercase"></div>
										<div class="col-md-6"><input class="form-control" name="nombre1" id="nombre1" placeholder="Nombre"></div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-6"><input class="form-control" name="ape_paterno1" id="ape_paterno1" placeholder="Apellido paterno"></div>
										<div class="col-md-6"><input class="form-control" name="ape_materno1" id="ape_materno1" placeholder="Apellido materno"></div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-6"><input class="form-control" name="correo1" id="correo1" placeholder="*Correo electrónico" required></div>
										
									</div>
								<hr>
								<!---uno--->
								
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
								<!---dos--->
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
								<!---tres--->
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
									
									<div class="col-md-12 text-center">
										<button class="btn btn-primary" id="guardar" style="width: 100% !important"> Enviar y guardar</button>
									</div>
								</div>
								
							</div>
						</div>
						<!--cobro mensual PM--->
						<div id="tab-3" class="tab-pane ">
							<div class="panel-body">
								<!---uno--->
								<form class="input-group" style="width: 100% !important">
									<div class="row">
										<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Movimiento de ingresos</div>
										<div class="col-md-6" class="input-group">
											<select name="movingreoUno" id="movingreoUno" class="form-control">
												<option value="0">0</option>
												<option value="199">1 a 20</option>
												<option value="399">21 a 50</option>
												<option value="699">51 a 100</option>
												<option value="1">101 en adelante</option><!--se toma el ultimo maximo se le resta el valor puesto manual-->
											</select>
										</div>
										<div class="col-md-6" class="input-group">
										<input disabled class="form-control" name="moviUno" id="moviUno" onkeypress="return numbersonly(event);" onblur="primeraOperacion()" placeholder="Ingresa cuantos movimientos">
									</div>
										<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
									</div>
								</form>
								<hr>
								<!---dos--->
								<div class="row">
									<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Movimientos de gastos</div>
									<div class="col-md-6" class="input-group">
										<select name="movGasUno" id="movGasUno" class="form-control">
											<option value="0">0</option>
											<option value="199">1 a 20</option>
											<option value="399">21 a 50</option>
											<option value="699">51 a 100</option>
											<option value="1">101 en adelante</option>
										</select>
									</div>
									<div class="col-md-6" class="input-group">
										<input disabled class="form-control" name="moviDos" id="moviDos" onkeypress="return numbersonly(event);" onblur="primeraOperacion()" placeholder="Ingresa cuantos movimientos">
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
								</div>
								<hr>
								<!---tres--->
								<div class="row">
									<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Total de ingresos</div>
									
									<div class="col-md-6" class="input-group">
										<select name="movIngUno" id="movIngUno" class="form-control">
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
										<input disabled class="form-control" name="catMonUNO" id="catMonUNO" onkeypress="return numbersonly(event);" onblur="primeraOperacion()" placeholder="Ingresa el monto aproximado">
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
								</div>
								
								<hr>
								<div class="row">
									<div class="col-md-12 text-center">
										<button class="btn btn-primary" id="cobromensu" style="width: 100% !important"> Calcular</button>
									</div>
									<hr>
									<div class="col-md-12 text-center">
										<div id="cosfinmensj"></div>
									</div>
								</div>
							</div>
						</div>
						<!--cobro mensual persona fisica especial--->
						<div id="tab-4" class="tab-pane ">
							<div class="panel-body">
								<!---uno--->
								<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Datos generales</div>
								<form class="input-group" style="width: 100% !important">
									<div class="row">
										<div class="col-md-6"><input class="form-control" placeholder="RFC"></div>
										<div class="col-md-6"><input class="form-control" placeholder="Nombre"></div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-6"><input class="form-control" placeholder="Apellido paterno"></div>
										<div class="col-md-6"><input class="form-control" placeholder="Apellido materno"></div>
									</div>
								</form>
								<hr>
								<!---uno--->
								<form class="input-group" style="width: 100% !important">
									<div class="row">
										<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Selecciona tus regímenes</div>
										<div class="col-md-12" class="input-group">
											<div class="col-md-2">
												<input type="checkbox" id="cInteres" > INTERÉS<br>
											</div>
											<div class="col-md-2">
												<input type="checkbox" id="casalariado" onclick="cambri()"> ASALARIADO<br>
											</div>
											<div class="col-md-2">
												<input type="checkbox" id="carrendamiento" > ARRENDAMIENTO<br>
											</div>
											<div class="col-md-2">
												<input type="checkbox" id="cservicios" > SERVICIOS PROFESIONALES<br>
											</div>
											<div class="col-md-2">
												<input type="checkbox" id="cempresaria" onclick="cambri()"> ACTIVIDAD EMPRESARIAL<br>
											</div>
											<div class="col-md-2">
												<input type="checkbox" id="crif"  onclick="cambiarD()"> RIF<br>
											</div>
										</div>
										
										<div class="col-xs-12 col-sm-12 col-md-12 col-xl-12" id="datosU" name='datosU'></div>
									</div>
								</form>
								<hr>
							
								<div class="row">
									<div class="col-md-12 text-center">
										<button class="btn btn-primary" id="calcularPFE" style="width: 100% !important"> Calcular</button>
									</div>
									<hr>
									<div class="alert alert-warning text-center">Si eres RIF no puedes ser asalariado y actividad empresarial, y viceversa.</div>
									<hr>
									<div class="col-md-12 text-center">
										<div id="costofinal21"></div>
									</div>
								</div>
							</div>
						</div>
					</div>

				
			</div>
		</div>
     </div>	
</div>
<hr>
<!--seccion de modal para agregar nueva publicacion-->


     