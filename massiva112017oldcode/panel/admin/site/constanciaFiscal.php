<?php 

	include 'modelo/consultaTablas.php';
    $misClientes = new consultaTabla();
	$id_usuario = $_SESSION['id_usuario'];
	$rfc = $_SESSION['rfc'];
	
    /* obtenemos los valores */
	$rspTabla = $misClientes->obtenconsta($id_usuario);
	
    $rspTabla2 = $misClientes->tablaconstanciaDos($id_usuario);
    $rspTabla2Infos2 = $rspTabla2->fetch_object();
	$valor = $rspTabla2Infos2->idActu;
	
	$rspTablaAr = $misClientes->tablaconstanciaDosDD($id_usuario);
    $rspTablaArInfo = $rspTablaAr->fetch_object();
    $valorAr = $rspTablaArInfo->archivo;

?>

</head>
<script src="js/vista/actualizaciones.js"></script>
<body>

	<div class='row'>
        <?php if($ActuconsFis == 1){?>
        <div class="alert alert-warning text-center"><b>Hemos recibido tu solicitud. Massiva obtendrá tu Constancia en 48 horas máximo y la subirá a esta misma sección.</b></div>
        <?php }if($ActuconsFis == 2){?>
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
                        <h5>Constancia situación fiscal actual</h5>
                        <div class="ibox-tools"><a class="fullscreen-link"><i class="fa fa-expand"></i></a></div>
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
                        <h5>¿Deseas una Constancia fiscal?</h5>
                        <div class="ibox-tools">
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                  </div>
				  <div class="ibox-content">
						<div class="product-box">
							<div class="product-imitation" style="background-image: url('contenedor/carrito/actu.jpg');  background-size: cover;  background-position: center; "></div>
							<div class="product-desc">
							<form action='controlador/actualizacionesControlador.php' method='POST'>
								<input type='hidden' name='costo' id='costo' value='29'>
								<input type='hidden' name='accion' id='accion' value='constancia'>	
								<span class="product-price" style="font-size: 25px !important;">$29</span>
								<a href="#" class="product-name">Constancia fiscal. </a>
								<div class="text-right"><button class="btn btn-primary" type="submit">Comprar</button></div>
							</form>
							</div>
						</div>
                  </div>
                </div>
            </div>
			<?php }?>

			<div class="col-md-6">
                <div class="ibox">
					<div class="ibox-title"><h5>Historial de Constancias.</h5> </div>
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
					<div><strong>Copyright</strong> Todos los derechos reservados massiva.mx &copy; 2019</div>
				</div>
			</div>
		</div>   
    </div>



</body>

</html>
