<?php 
    include 'modelo/consultaTablas.php';
    $id_usuario = $_SESSION['id_usuario'];
    $misClientes = new consultaTabla();
    $rspUsuTabla = $misClientes->informacionUsuario($id_usuario);
    $rspUsuTablaInfo = $rspUsuTabla->fetch_object();
    
    //valor de regreso de la carga de imagen
    
    //verificamos los campos que son de session
    $nombreCompleto = $_SESSION['nombre']." ".$_SESSION['ape_paterno']." ".$_SESSION['ape_materno'];
    

    $id_usuario = $rspUsuTablaInfo->id_usuario;
    $usuario = $rspUsuTablaInfo->usuario;
    $clave = $rspUsuTablaInfo->clave;
    $rfc = $rspUsuTablaInfo->rfc;
    $nombre = $rspUsuTablaInfo->nombre;
    $ape_paterno = $rspUsuTablaInfo->ape_paterno;
    $ape_materno = $rspUsuTablaInfo->ape_materno;
    $telefono = $rspUsuTablaInfo->telefono;
    $correo = $rspUsuTablaInfo->correo;
    $tipoActividad = $rspUsuTablaInfo->tipoActividad;
    $formaJuridica = $rspUsuTablaInfo->formaJuridica;
    $cantidadTrabajadores = $rspUsuTablaInfo->cantidadTrabajadores;
    $noTengoEfirma = $rspUsuTablaInfo->noTengoEfirma;
    $contabilidadAtrasada = $rspUsuTablaInfo->contabilidadAtrasada;
    $tipoUsuario = $rspUsuTablaInfo->tipoUsuario;
    $valorPre = $rspUsuTablaInfo->valorPre;
    $fechaCrea = $rspUsuTablaInfo->fechaCrea;
    $estatus = $rspUsuTablaInfo->estatus;
    $nUsuario = $rspUsuTablaInfo->nUsuario;
    $nacimiento = $rspUsuTablaInfo->nacimiento;
    $celular = $rspUsuTablaInfo->celular;
    $correo2 = $rspUsuTablaInfo->correo2;
    $dirfiscal = $rspUsuTablaInfo->dirfiscal;
    $estado = $rspUsuTablaInfo->estado;
    $ciudad = $rspUsuTablaInfo->ciudad;
    $municipio = $rspUsuTablaInfo->municipio;
    $codigoPromo = $rspUsuTablaInfo->codigoPromo;
    $foto = $rspUsuTablaInfo->foto;
    $claveEfi = $rspUsuTablaInfo->claveEfi;
    $curp = $rspUsuTablaInfo->curp;
    

    //obtenemos la informacion de las tarjetas de credito
    $rspTarje = $misClientes->tarjetaRegis($id_usuario);
	$rspTarjeInfo = $rspTarje->fetch_object();
	/* declaramos las variables necesarias */
	   $idCard = $rspTarjeInfo->idCard;
	   $numTar = $rspTarjeInfo->numero;

	/* obtenemos el plan */

	$paqueteSelec = $misClientes->paqueteSelec($id_usuario);
    $paqueteSelecInfo = $paqueteSelec->fetch_object();
    $nombPaquete = $paqueteSelecInfo->nombre;
    $fechbPaquete = $paqueteSelecInfo->fechaSeleccion;
    $monPaquete = $paqueteSelecInfo->montoM;
?>
<script src="js/vista/miperfil.js"></script>
<script>
function cambiarDos(){ document.getElementById('clave').type = 'text'; }
</script>
<!--seccion para el buscador y el abecedario-->
<div class='row'>
	
	<?php if($reinfoactu !=''){	?>	
		<div class="col-lg-12"> <div class="alert alert-warning text-center" role="alert">Se actualizó tu información.</div></div>
	<?php }?>

</div>
<!-- datos generales del usuario -->
<div class="row">
	<div class="col-md-12">
		<div class="ibox-content text-center">
			<h1><?= $nombreCompleto;?></h1>
			<div class="m-b-sm">
			<?php if($foto != ''){?>
				<img alt="image" class="img-rounded image-responsive" src="contenedor/clientes/<?= $rfc;?>/<?= $foto;?>" style='height: 120px;'>
			<?php }else{?>
				<img alt="image" class="img-circle" src="img/pictu.png" style='height: 120px;'>
			<?php }?>
			</div>
			<p class="font-bold"><?= $_SESSION['rfc'];?></p>
		</div>
	</div>
</div>
<hr>
<!-- pestañas de opciones -->
<div class="tabs-container">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#tab-1"> Datos generales</a></li>
        <li class=""><a data-toggle="tab" href="#tab-2">Datos de pago</a></li>
        <!--li class=""><a data-toggle="tab" href="#tab-3">Datos de patronales</a></li-->
		<li class=""><a data-toggle="tab" href="#tab-4">Plan contratado</a></li>
		<!-- este se activa para arrendamiento -->
		<!--li class=""><a data-toggle="tab" href="#tab-5">Declaraciones</a></li-->
    </ul>
    <div class="tab-content">
    	<!---seccion para datos personales-->
        <div id="tab-1" class="tab-pane active">
            <div class="panel-body">

            	<form action="controlador/miperfilControlador.php" method="POST" enctype="multipart/form-data">
            	<input type="hidden" name="accion" value="EditaInfo">
            	<input type="hidden" name="fotoRefe" value="<?= $foto;?>">
            	<div class='row'>
					<div class="col-md-12">
			     		<div class="form-group">
							<div class="col-md-6">
								<div class="input-group m-b">
			                        <span class="input-group-addon">*Nombre</span> 
			                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?= $nombre;?>" required>
			                    </div>
							</div>
							<div class="col-md-6">
								<div class="input-group m-b">
			                        <span class="input-group-addon">Fecha de nacimiento</span> 
			                        <input type="date" id="nacimiento" name="nacimiento" class="form-control" value="<?= $nacimiento;?>">
			                    </div>
							</div>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class="col-md-12">
			     		<div class="form-group">
							<div class="col-md-6">
								<div class="input-group m-b">
			                        <span class="input-group-addon">*Apellido paterno</span> 
			                        <input type="text" id="ape_paterno" name="ape_paterno" class="form-control" value="<?= $ape_paterno;?>" required>
			                    </div>
							</div>
							<div class="col-md-6">
								<div class="input-group m-b">
			                        <span class="input-group-addon">*Apellido materno</span> 
			                        <input type="text" id="ape_materno" name="ape_materno" class="form-control" value="<?= $ape_materno;?>" required>
			                    </div>
							</div>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class="col-md-12">
			     		<div class="form-group">
							<div class="col-md-6">
								<div class="input-group m-b">
			                        <span class="input-group-addon">CURP</span> 
			                        <input type="text" id="curp" name="curp" class="form-control" value="<?= $curp;?>" >
			                    </div>
							</div>
							<div class="col-md-6">
								<div class="input-group m-b">
			                        <span class="input-group-addon">Télefono</span> 
			                        <input type="text" id="telefono" name="telefono" class="form-control" value="<?= $telefono;?>" onkeypress="return NumCheck(event, this)">
			                    </div>
							</div>
							
						</div>
					</div>
				</div>
				<div class='row'>
					<div class="col-md-12">
			     		<div class="form-group">
							<div class="col-md-6">
								<div class="input-group m-b">
			                        <span class="input-group-addon">*Correo</span> 
			                        <input type="text" id="correo" name="correo" class="form-control" value="<?= $correo;?>" required>
			                    </div>
							</div>
							<div class="col-md-6">
								<div class="input-group m-b">
			                        <span class="input-group-addon">*Dirección fiscal</span> 
			                        <input type="text" id="dirfiscal" name="dirfiscal" class="form-control" required value="<?= $dirfiscal;?>">
			                    </div>
							</div>
							
						</div>
					</div>
				</div>
				<div class='row'>
					<div class="col-md-12">
			     		<div class="form-group">
							<div class="col-md-6">
								<div class="input-group m-b">
			                        <span class="input-group-addon">Estado</span> 
			                        <select name="estado" id="estado" class="form-control">
                                       <option value="<?php echo $estado;?>"><?php echo $estado;?></option>
									   <option value="Aguascalientes">Aguascalientes</option>
									   <option value="Baja California">Baja California</option>
									   <option value="Baja California Sur">Baja California Sur</option>
									   <option value="Campeche">Campeche</option>
									   <option value="Coahuila">Coahuila</option>
									   <option value="Colima">Colima</option>
									   <option value="Chiapas">Chiapas</option>
									   <option value="Chihuahua">Chihuahua</option>
									   <option value="CDMX">CDMX</option>
									   <option value="Durango">Durango</option>
									   <option value="Guanajuato">Guanajuato</option>
									   <option value="Guerrero">Guerrero</option>
									   <option value="Hidalgo">Hidalgo</option>
									   <option value="Jalisco">Jalisco</option>
									   <option value="México">México</option>
									   <option value="Michoacán">Michoacán</option>
									   <option value="Morelos">Morelos</option>
									   <option value="Nayarit">Nayarit</option>
									   <option value="Nuevo León">Nuevo León</option>
									   <option value="Oaxaca">Oaxaca</option>
									   <option value="Puebla">Puebla</option>
									   <option value="Querétaro">Querétaro</option>
									   <option value="Quintana Roo">Quintana Roo</option>
									   <option value="San Luis Potosí">San Luis Potosí</option>
									   <option value="Sinaloa">Sinaloa</option>
									   <option value="Sonora">Sonora</option>
									   <option value="Tabasco">Tabasco</option>
									   <option value="Tamaulipas">Tamaulipas</option>
									   <option value="Tlaxcala">Tlaxcala</option>
									   <option value="Veracruz">Veracruz</option>
									   <option value="Yucatán">Yucatán</option>
									   <option value="Zacatecas">Zacatecas</option>
                                                                                            
                                    </select>
			                    </div>
							</div>
							<div class="col-md-6">
								<div class="input-group m-b">
			                        <span class="input-group-addon">Ciudad</span> 
			                        <input type="text" id="ciudad" name="ciudad" class="form-control" value="<?= $ciudad;?>">
			                    </div>
							</div>
							
						</div>
					</div>
				</div>
				<div class='row'>
					<div class="col-md-12">
			     		<div class="form-group">
							<div class="col-md-6">
								<div class="input-group m-b">
			                        <span class="input-group-addon">*CP</span> 
			                        <input type="text" id="municipio" name="municipio" class="form-control" value="<?= $municipio;?>" required>
			                    </div>
							</div>
							<div class="col-md-6">
								<div class="input-group m-b">
			                        <span class="input-group-addon">*Tipo de actividad que ejerces</span> 
			                        <input type="text" id="tipoActividad" name="tipoActividad" class="form-control" value="<?= $tipoActividad;?>" required>
			                    </div>
							</div>
						</div>
					</div>
				</div>
				<div class='row'>
					<div class="col-md-12">
			     		<div class="form-group">
							
							<div class="col-md-6">
								<div class="input-group m-b">
			                        <span class="input-group-addon">*Tu forma jurídica</span> 
			                        <select class="form-control" id="formaJuridica" name='formaJuridica' required >
										<option value="f" <?php if($formaJuridica == 'f'){ echo "selected='selected'";}?>>Persona Física</option>
										<option value="m" <?php if($formaJuridica == 'm'){ echo "selected='selected'";}?>>Persona Moral</option>
									</select>
			                    </div>
							</div>
							<div class="col-md-6">
								<div class="input-group m-b">
			                        <span class="input-group-addon">Cantidad de trabajadores</span> 
			                        <select class="form-control" id="cantidadTrabajadores" name='cantidadTrabajadores' >
		                              <option value="0" <?php if($cantidadTrabajadores == 0){ echo "selected='selected'";}?>>Tengo 0 trabajadores</option>
		                              <option value="1" <?php if($cantidadTrabajadores == 1){ echo "selected='selected'";}?>>Tengo de 1 a 5 trabajadores</option>
		                              <option value="2" <?php if($cantidadTrabajadores == 2){ echo "selected='selected'";}?>> Tengo de 6 a 10 trabajadores</option>
		                              <option value="3" <?php if($cantidadTrabajadores == 3){ echo "selected='selected'";}?>>Tengo de 11 a 20 trabajadores</option>
		                              <option value="4" <?php if($cantidadTrabajadores == 4){ echo "selected='selected'";}?>>Tengo de 21 a 50 trabajadores</option>
		                              <option value="5" <?php if($cantidadTrabajadores == 5){ echo "selected='selected'";}?>>Tengo más de 50 trabajadores</option>
		                            </select>
			                    </div>
							</div>
						</div>
					</div>
				</div>
				<!--seccion para la image-->
				<div class='row'>
					<div class="col-md-12">
			     		<div class="form-group">
							<div class="col-md-12">
								<div class="input-group m-b">
			                        <span class="input-group-addon">Imagen de perfil</span> 
			                        <input type="file" id="foto" name="foto" class="form-control" >
			                    </div>
							</div>
						</div>
					</div>
				</div>
				<!--seccion codigo y claves-->
				<div class='row'>
					<div class="col-md-12">
			     		<div class="form-group">
							
							<div class="col-md-4">
								<div class="input-group m-b">
			                        <span class="input-group-addon">Código de promoción</span> 
			                        <input type="text" id="codigoPromo" name="codigoPromo" class="form-control" value="<?= $codigoPromo;?>">
			                    </div>
							</div>
							<div class="col-md-4">
								<div class="input-group m-b">
			                        <span class="input-group-addon">Contraseña e.firma</span> 
			                        <input type="password" id="contraefirma" name="contraefirma" class="form-control" value="<?= $claveEfi;?>">
			                    </div>
							</div>
							<div class="col-md-4">
								<div class="input-group m-b">
			                        <span class="input-group-addon">Contraseña del sistema</span> 
			                        <input type="password" id="clave" name="clave" class="form-control" value="<?= $clave;?>" required>
									<span class="input-group-addon"><i class="fa fa-eye" onclick="javascript: cambiarDos()"></i></span>
			                    </div>
							</div>
						</div>
					</div>
				</div>
				<hr>
				<!-----Solo para arrendamiento------>
				

				<!---boton par aeditar-->
				<div class="row">
					<div class="form-group">
						<div class='col-md-12 text-center'>
							<button class="btn btn-primary" type="submit" id='actuInfoPerfil'>&nbsp;Actualizar </button>
						</div>
					</div>
				</div>

				</form>
            </div>
        </div>

        <!---seccion para tarjeta-->
        <div id="tab-2" class="tab-pane">
            <div class="panel-body text-center">
	            <div class="row">
					<img src="img/cards1.png">&nbsp;&nbsp;
					<img src="img/cards2.png">&nbsp;&nbsp;
				</div>
				<hr>
				<!-- aviso en caso de que tenga registrada una tarjeta de credito -->
				<?php if($idCard == ''){?>
				<div class='row'>
					<div class="col-lg-12"> <div class="alert alert-warning text-center" role="alert">Por el momento no tienes registrada ninguna tarjeta y tu forma de pago es por deposito bancario, si deseas puedes registrar en este momento una tarjeta</div></div>
				</div>
				<?php }else{?>
					<div class='row'>
						<div class="col-lg-12"> <div class="alert alert-warning text-center" role="alert">Tienes registrada una tarjeta con el numero <?php echo $numer;?>, si deceas actualizarla ingresa los nuevos valores</div></div>
					</div>
				<?php }?>
				<hr>
				<!-- formulario para nueva tarjeta -->
				<form >
				<div class="row">
					<div class="col-md-12">
						<div class="input-group m-b">
							<span class="input-group-addon">*Nombre del titular</span> 
							<input type="text" name="nombre" id="nombre" class="form-control" value='<?= $rspTarjeUnoInfo->nombre; ?>'>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">*Tipo de tarjeta</span> 
							<select class="form-control" name="tipoTarjeta" id="tipoTarjeta">
								<option>Selecciona opción</option>
								<option value="1" >Crédito</option>
								<option value="2" >Débito</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">*Número de tarjeta</span> 
							<input type="text" name="numero" id="numero" class="form-control" maxlength="16" onkeypress="return NumCheck(event, this)">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">*Fecha de expiración (Mes)</span> 
							<input type="text" name="fechaMes" id="fechaMes" class="form-control" style="width: 70%"  maxlength="2" onkeypress="return NumCheck(event, this)" value='<?php echo $rspTarjeUnoInfo->fechaMes; ?>'>
						</div>
					</div>

					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">*Fecha de expiración (Año)</span> 
							<input type="text" name="fechaAno" id="fechaAno" class="form-control" style="width: 70%"  maxlength="2"onkeypress="return NumCheck(event, this)" value='<?php echo $rspTarjeUnoInfo->fechaAno; ?>' >
						</div>
					</div>

					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">*CVV</span> 
							<input type="text" name="codigo" id="codigo" class="form-control" style="width: 40%" maxlength="4" value='****' onkeypress="return NumCheck(event, this)">
						</div>
					</div>
				</div>
				<hr>
				<div class="row"><img src="img/security.png">&nbsp;&nbsp; Tus pagos se realizan de forma segura con encriptación de 256 bits</div>
				<hr>
				<div class="row">
					<div class="col-md-12 text-center">
						<button type="button" id='btnGuardarTarjetas' class="btn btn-w-m btn-primary"> Actualizar</button>
					</div>
				</div>
				</form>
			</div>

        </div>

        <!--Seccion pendiente--->
        <div id="tab-3" class="tab-pane">
            <div class="panel-body text-center">
                <strong>Módulo disponible solo si tienes contratado Nóminas.</strong>
            </div>
        </div>
        <!---plan contratado--->
        <div id="tab-4" class="tab-pane">
            <div class="panel-body text-center">
               <div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading"><h5><b> Plan contratado:</b></h5></div>
						<div class="panel-body" class="text-center">
							<div class="text-center">
						
								<b><?= $nombPaquete;?></b> por inscripción mensual de <b>$<?= $monPaquete;?> </b>pesos, régimen <?php if($formaJuridica == 'f'){ echo "Persona Física";}  if($formaJuridica == 'm'){ echo "Persona Moral";}?>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
			        <div class="col-md-12">
			            <a href="mailto:atencionclientes@massiva.mx" class="btn btn-primary" style='width: 100%' > Solicitar cambio de plan</a>
			        </div>
			    </div>
            </div>
        </div>
		<!-- Seccion para declaraciones -->
		<div class='tab-pane' id='tab-5'>
			<div class="panel-body">
				<div class='row'>
					<div class="alert alert-warning text-center">
						<b>¿Quieres deducir el 35% de ISR o los gastos estrictamente necesarios para la realización de tu actividad?<br> 
						</b>Ejemplo: Servicios (luz, gas, agua) a tu nombre con la dirección del local. </div>
						
						<div class="panel-body text-center">
							<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-body" class="text-center">
											<div class="text-center">
												<select class='form-control'>
													<option>Selecciona una opción</option>
													<option>Sí</option>
													<option>No</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<a href="index.php?secc=dascontaFDecla" class="btn btn-primary" style='width: 100%' > Guardar</a>
									</div>
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