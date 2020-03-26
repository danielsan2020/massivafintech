<?php 
    include 'modelo/consultaTablas.php';
    $misClientes = new consultaTabla();
    $rspTabla = $misClientes->informacionTabla();
?>
<script src="js/vista/misclientes.js"></script>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action"><a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoClienteC"> Nuevo empleado</a>
		<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoClienteC"> Importar empleados</a>
		<a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoClienteC"> Directorio de empleados</a></div>
	</div>
</div>
<div id="alertAccion"></div>
<!--seccion para el buscador y el abecedario-->
<div class="row">
	<div class="ibox-content text-center">
		<form action='index.php' method="GET">
			<input type="hidden" name="secc" id="secc" value="faq">
			<label for="exampleInputPassword2" class="sr-only"></label>
			<input type="text" placeholder="Ingrese la palabra o palabras" id="busfaq" name="busfaq" class="form-control">
			<button class="form-control btn btn-primary" type="submit"><i class="fa fa-search"></i> Buscar</button>
			<hr>
			<button class="btn btn-primary" type="button"> TODOS</button>
			<button class="btn btn-primary" type="button"> A</button>
			<button class="btn btn-primary" type="button"> B</button>
			<button class="btn btn-primary" type="button"> C</button>
			<button class="btn btn-primary" type="button"> D</button>
			<button class="btn btn-primary" type="button"> E</button>
			<button class="btn btn-primary" type="button"> F</button>
			<button class="btn btn-primary" type="button"> G</button>
			<button class="btn btn-primary" type="button"> H</button>
			<button class="btn btn-primary" type="button"> I</button>
			<button class="btn btn-primary" type="button"> J</button>
			<button class="btn btn-primary" type="button"> K</button>
			<button class="btn btn-primary" type="button"> L</button>
			<button class="btn btn-primary" type="button"> M</button>
			<button class="btn btn-primary" type="button"> N</button>
			<button class="btn btn-primary" type="button"> Ñ</button>
			<button class="btn btn-primary" type="button"> O</button>
			<button class="btn btn-primary" type="button"> P</button>
			<button class="btn btn-primary" type="button"> Q</button>
			<button class="btn btn-primary" type="button"> R</button>
			<button class="btn btn-primary" type="button"> S</button>
			<button class="btn btn-primary" type="button"> T</button>
			<button class="btn btn-primary" type="button"> U</button>
			<button class="btn btn-primary" type="button"> V</button>
			<button class="btn btn-primary" type="button"> W</button>
			<button class="btn btn-primary" type="button"> X</button>
			<button class="btn btn-primary" type="button"> Y</button>
			<button class="btn btn-primary" type="button"> Z</button>
		</form>
	</div>
</div>
<!--seccion de contenido-->
<div class="wrapper wrapper-content">
	<div class="row">
        <?php while($rspTablaInfo = $rspTabla->fetch_object()){ 
            //consulto la imagen dependiendo del usuario    
            $identi = $rspTablaInfo->idCliente;
            $rspImg = $misClientes->imgCliente($identi);
            $rspImgInfo = $rspImg->fetch_object();
            $imggg = $rspImgInfo->archivo;
        ?>
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Nombre completo</h5>
                    </div>
                    <div class="ibox-content">
                            <div class="col-sm-4">
                                <div class="text-center"><img alt="image" class="img-rounded m-t-xs img-responsive" src="contenedor/logoClienteCliente/<?= $imggg; ?>"></div>
                            </div>
                            <div class="col-sm-8">
                                <p><i class="fa fa-map-marker"></i> <?= $rspTablaInfo->direccion; ?></p>
                                <address>
                                    <abbr title="Phone">Teléfono :</abbr> <?= $rspTablaInfo->tel1; ?><br>
                                    <abbr title="Phone">Celular:</abbr> <?= $rspTablaInfo->cel1; ?><br>
                                    <abbr title="mail"></abbr> <?= $rspTablaInfo->mail1; ?><br>
                                </address>
                            </div>
                            <div class="clearfix"></div>
                    </div>
                    <div class="ibox-footer text-left">
                        <a class="btn btn-primary" data-toggle="modal" data-target="#premios"><button class="btn btn-primary" type="button">Premios de puntualidad</button></a>
                        <button class="btn btn-primary" type="button"> Premios asistencia</button>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#editaCliente" data-whatever="<?= $identi; ?>">Vacaciones</button>
						<button class="btn btn-primary" data-toggle="modal" data-target="#editaCliente" data-whatever="<?= $identi; ?>">Prima vacacional</button>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#ModalEliminar" data-whatever="<?= $identi; ?>"> Aguinaldo</button>
						<button class="btn btn-primary" data-toggle="modal" data-target="#ModalEliminar" data-whatever="<?= $identi; ?>"> Horas extras</button>
						<button class="btn btn-primary" data-toggle="modal" data-target="#ModalEliminar" data-whatever="<?= $identi; ?>"> Descuentos</button>
						<button class="btn btn-primary" data-toggle="modal" data-target="#ModalEliminar" data-whatever="<?= $identi; ?>"> Bonos</button>
						<button class="btn btn-primary" data-toggle="modal" data-target="#ModalEliminar" data-whatever="<?= $identi; ?>"> Timblar nomina</button>
                    </div>
                </div>
            </div>
        <?php }?>

	</div>
</div>
<!--seccion para modals--->
<!--modal para anuevo clientes-->
<div class="modal inmodal fade" id="nuevoClienteC" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<div class="row text-center">
					<div class="cold-md-12 text-center">
						<iframe name="guardar" id="guardar" style="width: 90%; align-content: center; border: hidden; height: 30px;" class="text-center"></iframe>	
					</div>
				</div>
			</div>
			<div class="modal-body">
				<h4>Datos generales</h4>
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="nombre" name="nombre" onkeypress="return soloLetras(event)"onkeypress="return lettersonly(event);" placeholder="Nombre" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="apePaterno" name="apePaterno" onkeypress="return soloLetras(event)" placeholder="Apellido Paterno" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="apeMaterno" name="apeMaterno" onkeypress="return soloLetras(event)" placeholder="Apellido Materno" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="apeMaterno" name="apeMaterno" onkeypress="return soloLetras(event)" placeholder="RFC con homoclave (Validar con HOMOclave)" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="apeMaterno" name="apeMaterno" onkeypress="return soloLetras(event)" placeholder="CURP " class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon">Fecha de ingreso</span> 
							<input type="date" id="apeMaterno" name="apeMaterno" onkeypress="return soloLetras(event)" placeholder="CURP " class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="apeMaterno" name="apeMaterno" onkeypress="return soloLetras(event)" placeholder="NSS " class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control">
								<option>Selecciona matriz o sucursal</option>
								<option>Matriz</option>
								<option>SUc1</option>
								<option>Suc2</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="apeMaterno" name="apeMaterno" onkeypress="return soloLetras(event)" placeholder="Area o departamento " class="form-control">
						</div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="apeMaterno" name="apeMaterno" onkeypress="return soloLetras(event)" placeholder="Puesto " class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control">
								<option>Tipo de nomina</option>
								<option>Mensual</option>
								<option>Quincenal</option>
								<option>Semanal</option>
								<option>Catorcenal</option>
							</select>
						</div>
					</div>
					
					
				</div>
				<div class="row">
					
					
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control">
								<option>Selecciona un estado</option>
								<option>Efecto ( menor de 2,000 pesos)</option>
								<option>Cheque / transparencia (Mayor de $2,000 pesos)</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control">
								<option>Selecciona una ciudad</option>
								<option>Efecto ( menor de 2,000 pesos)</option>
								<option>Cheque / transparencia (Mayor de $2,000 pesos)</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control">
								<option>Tipo de contrato</option>
								<option>Efecto ( menor de 2,000 pesos)</option>
								<option>Cheque / transparencia (Mayor de $2,000 pesos)</option>
							</select>
						</div>
					</div>
				</div>
				<hr>
				<h4>Salario</h4>
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="apeMaterno" name="apeMaterno" onkeypress="return soloLetras(event)" placeholder="Salario diario" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="apeMaterno" name="apeMaterno" onkeypress="return soloLetras(event)" placeholder="Salario integrado" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control">
								<option>Tipo de jornada</option>
								<option>Efecto ( menor de 2,000 pesos)</option>
								<option>Cheque / transparencia (Mayor de $2,000 pesos)</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="apeMaterno" name="apeMaterno" onkeypress="return soloLetras(event)" placeholder="Salario x dia" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="apeMaterno" name="apeMaterno" onkeypress="return soloLetras(event)" placeholder="Salario por hora" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="apeMaterno" name="apeMaterno" onkeypress="return soloLetras(event)" placeholder="Horas por dia" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="apeMaterno" name="apeMaterno" onkeypress="return soloLetras(event)" placeholder="Dia por semana" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<input type="text" id="apeMaterno" name="apeMaterno" onkeypress="return soloLetras(event)" placeholder="dias por periodo" class="form-control">
						</div>
					</div>
					<div class="col-md-4">
						<div class="input-group m-b">
							<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
							<select class="form-control">
								<option>Forma de pago</option>
								<option>Efecto ( menor de 2,000 pesos)</option>
								<option>Cheque / transparencia (Mayor de $2,000 pesos)</option>
							</select>
						</div>
					</div>
				</div>
				<hr>
				<h4>Documentación</h4>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">Comporbante de domicilio</span> 
							<input type="file" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">Identificación oficial</span> 
							<input type="file" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">NSS</span> 
							<input type="file" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">CURP</span> 
							<input type="file" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">Fotografia</span> 
							<input type="file" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group m-b">
							<span class="input-group-addon">Contrato</span> 
							<input type="file" class="form-control">
						</div>
					</div>
				</div>

			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Guardar</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!---premios-->
<div class="modal inmodal fade" id="premios" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<div class="row text-center">
					<div class="cold-md-12 text-center">
						<iframe name="guardar" id="guardar" style="width: 90%; align-content: center; border: hidden; height: 30px;" class="text-center"></iframe>	
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 text-center">
						<button class="btn btn-primary" data-toggle="modal" data-target="#ModalEliminar" data-whatever="<?= $identi; ?>"> Asignar premio de puntualidad</button>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
								<tr>
									<th>Fecha Creacion</th>
									<th>Monto</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<th>19/08/2019</th>
								<th>DSGDFBCVBFGDFS518561dsfsddf</th>

								<th class="text-center">
									<a href="" class="btn" style="background-color: #f1005e; color: #FFFFFF" data-toggle="modal" data-target="#nuevoprodu" title="No asignar"><i class="fa fa-times"></i></a>
								</th>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Guardar</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

