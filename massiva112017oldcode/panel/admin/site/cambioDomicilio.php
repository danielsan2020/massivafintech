<?php 
@session_start();	
if($_SESSION['id_usuario'] != ''){

    include 'modelo/consultaTablas.php';
    $misClientes = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
    $rfc = $_SESSION['rfc'];

    /* obtenemos los valores */
    $rspTabla = $misClientes->tablaDom($id_usuario);
    $rspTabla2 = $misClientes->tablaDomDos($id_usuario);
    $rspTabla2Infos2 = $rspTabla2->fetch_object();
    $valor = $rspTabla2Infos2->idActu;

    $rspTablaAr = $misClientes->tablaOblidARchivoDomm($id_usuario);
    $rspTablaArInfo = $rspTablaAr->fetch_object();
    $valorAr = $rspTablaArInfo->archivo;

    


?>
<script>
function cambiar(){ document.getElementById('clavee').type = 'text'; }
</script>
</head>
<body>
    <div class='row'>
        <?php if($Actudomi == 1){?>
        <div class="alert alert-warning text-center"><b>Se recibio su solicitud, en un lapso de 24 horas se estará actualizando en esta sección el comprobante de cambio de domicilio. </b></div>
        <?php }if($Actudomi == 2){?>
        <div class="alert alert-warning text-center">Lo sentimos ocurrio un error favor de volver a intentarlo o reportarlo a <a herf='mailto:atencionclientes@massiva.mx'>mailto:atencionclientes@massiva.mx</a></div>
        <?php }?>
    </div>

    <div class="gray-bg dashbard-1">
		
		<hr>
		<!--contrato-->
		<div class='row'>
			<div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Obligaciones fiscales actuales</h5>
                        <div class="ibox-tools">
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                    </div>
                    <div class="ibox-content">
                    <?php if($valorAr == ''){?>
                            <embed src="documentacion/blank.pdf" type="application/pdf" width="100%" height="600"></embed>
                        <?php } else{?>
                            <embed src="contenedor/clientes/<?php echo $rfc;?>/<?php echo $valorAr;?>" type="application/pdf" width="100%" height="600"></embed>
                        <?php }?>
                    </div>
                </div>
			</div>
            <?php if($valor == ''){?>
			<!--carga de informacion-->
			<div class="col-md-6">
                <div class="ibox">
                  <div class="ibox-title">
                        <h5>¿Deseas actualizar tu domicilio fiscal?</h5>
                        <div class="ibox-tools">
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                  </div>
				  <div class="ibox-content">
						<div class="product-box">
							<div class="product-imitation" style="background-image: url('contenedor/carrito/actu.jpg');  background-size: cover;  background-position: center; "></div>
							<div class="product-desc">
								<span class="product-price" style="font-size: 25px !important;">$49</span>
                        <a href="#" class="product-name">Cambio de domicilio </a>
                        <div class="small m-t-xs">Personas Físicas que realizan cambio de domicilio o actualizan sus datos de ubicación en el RFC.<br></div>
								<div class="text-right"><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#nuevoDomici">Comprar</button></div>

							</div>
						</div>
                  </div>
                </div>
            </div>
            <?php }?>

			<div class="col-md-6">
                <div class="ibox">
					<div class="ibox-title">
                        <h5>Historial de obligaciones fiscales</h5>
                        <div class="ibox-tools">
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                  </div>
				  <div class="ibox-content">
					<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
							<tr>
								<th>Dirección</th>
								<th>Estado</th>
								<th>Fecha</th>
                                <th></th>
							</tr>
							</thead>
							<tbody>
							<?php while($rspTablaInfo = $rspTabla->fetch_object()){ ?>
                                <tr class="gradeX">
                                    <td><?= $rspTablaInfo->direccion;?></td>
                                    <td><?= $rspTablaInfo->estado;?></td>
                                    <td><?= $rspTablaInfo->fechaSolicitud;?></td>
                                    <td class='text-center'> <a href='contenedor/clientes/<?php echo $rfc;?>/<?php echo $rspTablaInfo->archivo;?>' style='cursor:pointer' download="<?php echo $rspTablaInfo->archivo;?>">
                                            <button class="btn btn-primary " type="button" title='Descargar'><i class="fa fa-cloud-download"></i> <span class="bold"></span></button>
                                        </a>
                                    </td>
                                </tr>
                           	<?php }?>
							</tbody>
							</table>
						</div>	
                  </div>

                </div>
            </div>
		</div>
		<hr>
		<!--pie de pagina-->
		<div class="row">
			<div class="col-lg-12">
				<div class="footer">
					<div><strong>Copyright</strong> Todos los derechos reservados massiva.mx &copy; 2018-2019</div>
				</div>
			</div>
		</div>   
    </div>
	
<!--seccion para el modal-->
<div class="modal inmodal fade" id="nuevoDomici" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
			<div class="modal-body">
            <form action='controlador/actualizacionesControlador.php' method='POST' enctype="multipart/form-data">
            <input type='hidden' name='costo' id='costo' value='49'>
            <input type='hidden' name='accion' id='accion' value='domicilio'>
                <div class="row">
                        <div class="col-md-6">
                            <div class="input-group m-b">
                                <span class="input-group-addon">Dirección</span> 
                                <input type="text" id="direccion" name="direccion" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                                <div class="input-group m-b">
                                    <span class="input-group-addon">Estado</span> 
                                    <select name="estado" id="estado" class="form-control">
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
                                    <input type="text" id="ciudad" name="ciudad" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group m-b">
                                    <span class="input-group-addon">Municipio</span> 
                                    <input type="text" id="municipio" name="municipio" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group m-b">
                                    <span class="input-group-addon">C.P</span> 
                                    <input type="text" id="cppp" name="cppp" class="form-control" >
                                </div>
                            </div>
                        <div class="col-md-12">
                            <div class="input-group m-b">
                                <span class="input-group-addon">Sube el comprobante del nuevo domicilio</span> 
                                <input type="file" id="comprobante" name="comprobante" placeholder="" class="form-control">
                            </div>
                        </div>
                </div>
                    
            </div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Aceptar</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal">Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>


</body>
<?php }else{ header ('location:../index.php?act=3');}?>
</html>
