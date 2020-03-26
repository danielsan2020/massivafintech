<?php 
@session_start();	
if($_SESSION['id_usuario'] != ''){

///cabezera
include 'estructura/header.php';
///script
include 'estructura/script.php';

$nombreCompleto = $_SESSION['nombre']." ".$_SESSION['ape_paterno']." ".$_SESSION['ape_materno'];
$sinFima = $_SESSION['noTengoEfirma'];

?>
<script src="js/vista/preregistro.js"></script>
</head>
<body>

    <div class="gray-bg dashbard-1">
		<div class="row"><div class="alert alert-warning text-center"><b>Bienvenido <?= $nombreCompleto;?></b></div></div>
		<!--logo-->
		<div class="row  border-bottom white-bg dashboard-header">
			<div class="col-md-12 text-center">
				<img src="img/logo.png" style='height: 70px'>
			</div>
		</div>
		
		<div class='row text-center'>
			<div class="alert alert-warning">Se requiere validar y complementar tu información.	</div>
		</div>
		<!--contrato-->
		<form action="controlador/preregistroControlador.php" method="post">
			<input type="hidden" name="accion" id="accion" value="actualizaInformacion">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class='row'>
						<div class="col-md-12">
				     		<div class="form-group">
								<div class="col-md-6">
									<div class="input-group m-b">
				                        <span class="input-group-addon">*Nombre</span> 
				                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?= $_SESSION['nombre'];?>" required>
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="input-group m-b">
				                        <span class="input-group-addon">Fecha de nacimiento</span> 
				                        <input type="date" id="nacimiento" name="nacimiento" class="form-control" value="<?= $_SESSION['nacimiento'];?>">
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
				                        <input type="text" id="ape_paterno" name="ape_paterno" class="form-control" value="<?= $_SESSION['ape_paterno'];?>" required>
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="input-group m-b">
				                        <span class="input-group-addon">*Apellido materno</span> 
				                        <input type="text" id="ape_materno" name="ape_materno" class="form-control" value="<?= $_SESSION['ape_materno'];?>" required>
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
				                        <span class="input-group-addon">CURP </span> 
				                        <input type="text" id="curp" name="curp" class="form-control" value="<?= $_SESSION['curp'];?>">
				                        <span class="input-group-addon">¿No te lo sabes? <a href="https://www.gob.mx/curp/" style='color:  rgb(226, 0, 74)' target="_blank">clic aquí</a></span> 
				                    </div>
								</div>

								<div class="col-md-6">
									<div class="input-group m-b">
				                        <span class="input-group-addon">Télefono</span> 
				                        <input type="text" id="telefono" name="telefono" class="form-control" value="<?= $_SESSION['telefono'];?>" >
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
				                        <input type="text" id="correo" name="correo" class="form-control" value="<?= $_SESSION['correo'];?>" required>
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="input-group m-b">
				                        <span class="input-group-addon">*Dirección fiscal</span> 
				                        <input type="text" id="dirfiscal" name="dirfiscal" class="form-control" required value="<?= $_SESSION['dirfiscal'];?>">
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
	                                       <option value="<?= $_SESSION['estado'];?>"><?= $_SESSION['estado'];?></option>
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
				                        <input type="text" id="ciudad" name="ciudad" class="form-control" value="<?= $_SESSION['ciudad'];?>">
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
				                        <input type="text" id="municipio" name="municipio" class="form-control" value="<?= $_SESSION['municipio'];?>" required>
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="input-group m-b">
				                        <span class="input-group-addon">Código de promoción</span> 
				                        <input type="text" id="codigoPromo" name="codigoPromo" class="form-control" value="<?= $_SESSION['codigoPromo'];?>">
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
				                        <span class="input-group-addon">*Tipo de actividad que ejerces</span> 
				                        <input type="text" id="tipoActividad" name="tipoActividad" class="form-control" value="<?= $_SESSION['tipoActividad'];?>" required>
				                    </div>
								</div>
								<div class="col-md-6">
									<div class="input-group m-b">
				                        <span class="input-group-addon">*Tu forma jurídica</span> 
				                        <select class="form-control" id="formaJuridica" name='formaJuridica' required >
											<option value="f" <?php if($_SESSION['formaJuridica'] == 'f'){ echo "selected='selected'";}?>>Persona Física</option>
											<option value="m" <?php if($_SESSION['formaJuridica'] == 'm'){ echo "selected='selected'";}?>>Persona Moral</option>
										</select>
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
				                        <span class="input-group-addon">Cantidad de trabajadores</span> 
				                        <select class="form-control" id="cantidadTrabajadores" name='cantidadTrabajadores' >
			                              <option value="0" <?php if($_SESSION['cantidadTrabajadores'] == 0){ echo "selected='selected'";}?>>Tengo 0 trabajadores</option>
			                              <option value="1" <?php if($_SESSION['cantidadTrabajadores'] == 1){ echo "selected='selected'";}?>>Tengo de 1 a 5 trabajadores</option>
			                              <option value="2" <?php if($_SESSION['cantidadTrabajadores'] == 2){ echo "selected='selected'";}?>> Tengo de 6 a 10 trabajadores</option>
			                              <option value="3" <?php if($_SESSION['cantidadTrabajadores'] == 3){ echo "selected='selected'";}?>>Tengo de 11 a 20 trabajadores</option>
			                              <option value="4" <?php if($_SESSION['cantidadTrabajadores'] == 4){ echo "selected='selected'";}?>>Tengo de 21 a 50 trabajadores</option>
			                              <option value="5" <?php if($_SESSION['cantidadTrabajadores'] == 5){ echo "selected='selected'";}?>>Tengo más de 50 trabajadores</option>
			                            </select>
				                    </div>
								</div>
								<div class="col-md-6">
			                        <div class="col-md-4">
			                            <input type="checkbox" class="" value="1" id="contabilidadAtrasada" name='contabilidadAtrasada' <?php if($_SESSION['contabilidadAtrasada'] == 1){ echo "checked";}?> > Tengo mi contabilidad atrasada
			                        </div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							<div class='col-md-12 text-center'>
								<button type="button" id='btnRegresar2' class="btn btn-w-m btn-primary"> Regresar</button>
								<button class="btn btn-primary" type="submit" id='actuseguir'>&nbsp;Actualizar y seguir</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
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

		
		<?php include 'estructura/footer.php'; ?>    
    </div>
</body>
<?php }else{ header ('location:../index.php?act=3');}?>
</html>
