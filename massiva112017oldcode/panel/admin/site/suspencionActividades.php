<?php 
@session_start();	
if($_SESSION['id_usuario'] != ''){
	
	include 'modelo/consultaTablas.php';
    $misClientes = new consultaTabla();
	$id_usuario = $_SESSION['id_usuario'];
	$rfc = $_SESSION['rfc'];

    /* obtenemos los valores */
    $rspTabla = $misClientes->tablaSus($id_usuario);
    $rspTabla2 = $misClientes->tablaSusDos($id_usuario);
    $rspTabla2Infos2 = $rspTabla2->fetch_object();
    $valor = $rspTabla2Infos2->idActu;

	$rspTablaAr = $misClientes->tablaOblidARchivoSus($id_usuario);
    $rspTablaArInfo = $rspTablaAr->fetch_object();
    $valorAr = $rspTablaArInfo->archivo;

?>
<script>
function cambiar(){ document.getElementById('clavee').type = 'text'; }
</script>
</head>
<body>
	<div class='row'>
        <?php if($Actususpencion == 1){?>
        <div class="alert alert-warning text-center"><b>Se recibió tu solicitud, en un lapso de 24 horas se estará actualizando en esta sección el comprobante de suspensión.<br>
			Antes de darte de baja debemos revisar que estés al corriente, sino es así te lo haremos saber. <br>
			Si estás al corriente realizaremos la suspensión de actividades.
			</b></div>
        <?php }if($Actususpencion == 2){?>
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
                        <h5>Constancia de suspensión de actividades</h5>
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
                        <h5>¿Deseas suspender actividades?</h5>
                        <div class="ibox-tools">
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                  </div>
				  <div class="ibox-content">
						<div class="product-box">
							<div class="product-imitation" style="background-image: url('contenedor/carrito/actu.jpg');  background-size: cover;  background-position: center; "></div>
							<div class="product-desc">
							<form action='controlador/actualizacionesControlador.php' method='POST'>
								<input type='hidden' name='costo' id='costo' value='49'>
								<input type='hidden' name='accion' id='accion' value='suspension'>	
								<span class="product-price" style="font-size: 25px !important;">$49</span>
								<a href="#" class="product-name">Suspensión de actividades </a>
								<div class="small m-t-xs">Personas Físicas que interrumpan todas las actividades económicas que den lugar a la presentación de declaraciones.<br></div>
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
					<div class="ibox-title">
                        <h5>Historial de suspensión de actividades</h5>
                        <div class="ibox-tools"><a class="fullscreen-link"><i class="fa fa-expand"></i></a></div>
                  </div>
				  <div class="ibox-content">
					<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
							<tr>
								<th>Fecha</th>
								<th></th>
							</tr>
							</thead>
							<tbody>
							 	<?php while($rspTablaInfo = $rspTabla->fetch_object()){ ?>
                                <tr class="gradeX">
                                    <td><?php echo $rspTablaInfo->fecha;?></td>
									
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
<?php }else{ header ('location:../index.php?act=3');}?>
</html>
