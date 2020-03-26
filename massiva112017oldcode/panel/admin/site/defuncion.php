<?php 
@session_start();	
if($_SESSION['id_usuario'] != ''){

	include 'modelo/consultaTablas.php';
    $misClientes = new consultaTabla();
	$id_usuario = $_SESSION['id_usuario'];
	$rfc = $_SESSION['rfc'];
	
	$rspTabla = $misClientes->obtenerdefuncion($id_usuario);
	
    $rspTabla2 = $misClientes->obtenerdefuncionDos($id_usuario);
    $rspTabla2Infos2 = $rspTabla2->fetch_object();
	$valor3 = $rspTabla2Infos2->idActu;
	
	$rspTablaAr = $misClientes->obtenerdefuncionDosmmm($id_usuario);
    $rspTablaArInfo = $rspTablaAr->fetch_object();
    $valorAr = $rspTablaArInfo->archivo;

?>
<script>
function cambiar(){ document.getElementById('clavee').type = 'text'; }
</script>
</head>
<script src="js/vista/actualizaciones.js"></script>
<body>

	<div class='row'>
        <?php if($Actudefu == 1){?>
        <div class="alert alert-warning text-center"><b>Hemos recibido tu solicitud. Massiva obtendrá tu Constancia en 48 horas máximo y la subirá a esta misma sección.</b></div>
        <?php }if($Actudefu == 2){?>
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
                        <h5>Comprobante de defunción</h5>
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
			<?php if($valor3 == ''){?>
			<!--carga de informacion-->
			<div class="col-md-6">
                <div class="ibox">
                  <div class="ibox-title">
                        <h5>¿Deseas la Constancia de Defunción?</h5>
                        <div class="ibox-tools">
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                  </div>
				  <div class="ibox-content">
						<div class="product-box">
							<div class="product-imitation" style="background-image: url('contenedor/carrito/actu.jpg');  background-size: cover;  background-position: center; "></div>
							<div class="product-desc">
								<span class="product-price" style="font-size: 25px !important;">$49</span>
								<a href="#" class="product-name">Defunción</a>
								<div class="small m-t-xs">Documento que contiene la Constancia de Defunción.<br></div>
								<div class="text-right"><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#nuevoClienteC">Comprar</button></div>

							</div>
						</div>
                  </div>
                </div>
            </div>
			<?php }?>
			<div class="col-md-6">
                <div class="ibox">
					<div class="ibox-title">
                        <h5>Defunción</h5>
                        <div class="ibox-tools">
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                  </div>
				  <div class="ibox-content">
					<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
							<tr>
								<th>Fecha</th>
								<th>Costo</th>
								<th></th>
							</tr>
							</thead>
							<tbody>
							<?php while($rspTablaInfo = $rspTabla->fetch_object()){ ?>
                                <tr class="gradeX">
                                    <td><?= $rspTablaInfo->fecha;?></td>
                                    <td><?= $rspTablaInfo->costo;?></td>
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
                <div class="row">
                    <form action='controlador/actualizacionesControlador.php' method='POST' enctype="multipart/form-data">
						<input type='hidden' name='costo' id='costo' value='49'>
						<input type='hidden' name='accion' id='accion' value='defuncion'>	
                        <div class="col-md-12">
                            <div class="input-group m-b">
                                <span class="input-group-addon">Subir el acta de defunción</span> 
                                <input type="file" id="defuncion" name="defuncion" placeholder="" class="form-control">
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
