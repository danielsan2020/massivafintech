<?php 
	@session_start();
	include 'modelo/consultaTablas.php';
    require('plugins/fpdf/WriteHTML.php');
    $soporte = new consultaTabla();
    $valoId = $_SESSION['id_usuario'];
    $id_usuario = $_SESSION['id_usuario'];
    $fechaCreacion = date("Y-m-d");
    $rfc = $_SESSION['rfc'];
    $nombreCompleto = $_SESSION['nombre']." ".$_SESSION['ape_paterno']." ".$_SESSION['ape_materno'];

    //echo $idevacoti;
    //valor si se visualizo o se creo el archivo
    if($vacoti == 1 || $vacoti != '' || $idevacoti != ''){

	    $rspCate = $soporte->cotizacionPrevia($id_usuario);
	    $rspCateInfo = $rspCate->fetch_object();
	    //obtenemos los valores
	    $idCotizacion = $rspCateInfo->idCotizacion;
	    $id_usuario = $rspCateInfo->id_usuario;
	    $dirigido = $rspCateInfo->dirigido;
	    $lugarFecha = $rspCateInfo->lugarFecha;
	    $titulo = $rspCateInfo->titulo;
	    $descripcion = $rspCateInfo->descripcion;
	    $notas = $rspCateInfo->notas;
	    $correo1 = $rspCateInfo->correo1;
	    $correo2 = $rspCateInfo->correo2;

	   //teniendo los valores creamos el pdf para enviar.

	    //eliminamos el archivo ya creado 
	    $archivoBorro = "../contenedor/clientes/".$rfc."/cotizaciones/".$idCotizacion."_cotizacion.pdf";
        unlink($archivoBorro);

	   //creamoe el contenido del archivo
	   $twxt = "
	   <html>
			<head><meta charset='utf-8'></head>
				<body>
				<table style='width: 100%; border: 1px solid;'>
					<tr align='right'>
						<td colspan='10'>                                                                                                              ".$lugarFecha."</td>
					</tr>
					<tr><td colspan='10'><br><hr></td></tr>
					<tr style='width: 100%;'>
						<td colspan='5' align='left'><h2><b>".$titulo."</b><br>
							<b>     ".$dirigido."<br></b></h2>
						<td>
						<td colspan='5'><td>
					</tr>
					<tr><td colspan='10'><br></td></tr>
					<tr><td colspan='10'>".$descripcion."</td></tr>
					<tr><td colspan='10'><br><br><hr></td></tr>
					<tr><td colspan='10'><b>Notas:</b> <small>".$notas."</small></td></tr>
					<tr><td colspan='10'><br><br><hr></td></tr>
					<tr>
					<td colspan='10'>
					<b>Atentamente:</b>".$nombreCompleto."<br> 
					<b>           Teléfono:</b>".$_SESSION['telefono']."<br>
					<b>            Correo:</b>".$_SESSION['correo']."<br>
						</td>
					</tr>
				</table>
				</body>
		</html>";

		//generamos el pdf autoamtico
		$pdf=new PDF_HTML();
		$pdf->AddPage('P', 'A4');
		$pdf->SetAutoPageBreak(true, 10);
		$pdf->SetFont('Arial', '', 10);
		$pdf->SetTopMargin(5);
		$pdf->SetLeftMargin(5);
		$pdf->SetRightMargin(5);

		/* --- MultiCell --- */
		$pdf->SetXY(10, 15);
		$pdf->WriteHTML($twxt);
		//$pdf->MultiCell(190, 236, $twxt, 0, 'L', false);

		$pdf->Output("contenedor/clientes/".$rfc."/cotizaciones/".$idCotizacion."_cotizacion.pdf","F");

    }

    //obtenemos el concentrado de las cotizaciones
    $coti = $soporte->concentradoCotizaciones($id_usuario);
    

 ?>
<script src="js/vista/cotizacion.js"></script>
<div class="row">
	<div class="col-md-12"><div class="alert text-center" style="background-color: darkgrey !important; color: #FFFFFF"><b>Realiza todas las cotizaciones que necesites y envíaselas a tus clientes.</b></div></div>
</div>

<?php if($vacoti == 4){?>
<div class="row">
	<div class="col-md-12"><div class="alert alert-warning text-center" ><b>Se canceló / eliminó tu cotización.</b></div></div>
</div>
<?php }?>

<?php if($vacoti == 3){?>
<div class="row">
	<div class="col-md-12"><div class="alert alert-warning text-center" ><b>Se envió tu cotización a los correos agregados.</b></div></div>
</div>
<?php }?>

<!--seccion de contenido-->
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="col-lg-6">
		<div class="ibox">
			<div class="ibox-title"><h5>Cotizaciones</h5></div>
			<div class="ibox-content text-center">
				<div class="ibox-content">
					<?php if($vacoti != 4 && $vacoti != '' && $vacoti != 3 && $vacoti != 2  ){?>
					<embed src="contenedor/clientes/<?php echo $rfc?>/cotizaciones/<?php echo  $idCotizacion;?>_cotizacion.pdf" type="application/pdf" width="100%" height="600">
					<?php }else{?>
					<div class="col-md-12 text-center"><b>Visualizador de cotizaciones</b></div>
					<?php }?>
                </div>
			</div>
		</div>
	</div>
	
	<div class="col-lg-6">
		<div class="ibox">
			<div class="ibox-title"><h5>Completa los campos</h5></div>
			<div class="ibox-content">

				<form action="controlador/cotizacionControlador.php" method="post" enctype="multipart/form-data">
					<?php if ($vacoti == '' || $vacoti == 4 || $vacoti == 3 || $idevacoti == ''){?>
					<input type="hidden" id="accion" name="accion" value="Agrega">
					<!--Valores para previsualizar por segunda vez--->
					<?php }elseif ($vacoti == 1 || $idevacoti != '' ) {	?>
					<input type="hidden" id="accion" name="accion" value="EditaPre">
					<input type="hidden" id="idCotizacion" name="idCotizacion" value="<?php echo  $idCotizacion ;?>">
					<?php }?>
					<div class="row">
						<div class="col-md-12">
							<div class="input-group m-b">
								<span class="input-group-addon">Dirigido a</span> 
								<input type="text" class="form-control" name="dirigido" id="dirigido" value="<?php echo  $dirigido;?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="input-group m-b">
								<span class="input-group-addon">Lugar y fecha de cotización</span> 
								<input type="text" class="form-control" name="lugarFecha" id="lugarFecha" value="<?php echo  $lugarFecha;?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="input-group m-b">
								<span class="input-group-addon">Título de cotización</span> 
								<input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo  $titulo;?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="input-group m-b">
								<span class="input-group-addon">Descripción</span> 
								<textarea class="from-control"  name="descripcion" id="descripcion" style="width:100%; resize: none;" rows="10" required><?php echo  $descripcion;?></textarea>
							</div>
						</div>
				
						<div class="col-md-12">
							<div class="input-group m-b">
								<span class="input-group-addon">Notas</span> 
								<textarea class="from-control"  name="notas" id="notas" style="width:100%; resize: none;" rows="10"><?php echo  $notas;?></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group m-b">
								<span class="input-group-addon">Correo cliente 1</span> 
								<input type="text" class="form-control" name="correo1" id="correo1" value="<?php echo  $correo1;?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group m-b">
								<span class="input-group-addon">Correo cliente 2</span> 
								<input type="text" class="form-control" name="correo2" id="correo2" value="<?php echo  $correo2;?>">
							</div>
						</div>
						
					</div>
					<div class="row text-center">
						<div class='col-md-3'>
							<button class="btn btn-primary" type="submit">Previsualizar</button>&nbsp; &nbsp;&nbsp; 
							</form>
						</div>

						<?php 
							if($vacoti == 1){
						?>
						<div class='col-md-3'>
							<form action="controlador/cotizacionControlador.php" method="post" enctype="multipart/form-data">
								<input type='hidden' name="accion" id="accion" value="despues">
								<input type='hidden' name="iddespues" id="iddespues" value="<?php echo  $idCotizacion;?>">
								<button class="btn btn-primary" data-toggle="modal" data-target="#nuevoClienteC">Enviar después</button>&nbsp; &nbsp;&nbsp; 
							</form>
						</div>
						<div class='col-md-3'>
							<form action="controlador/cotizacionControlador.php" method="post" enctype="multipart/form-data">
								<input type='hidden' name="accion" id="accion" value="ahora">
								<input type='hidden' name="idAhora" id="idAhora" value="<?php echo  $idCotizacion;?>">
								<button class="btn btn-primary" type='submit'>Enviar</button>&nbsp; &nbsp;&nbsp; 
							</form>
						</div>
						<div class='col-md-3'>
							<!--botono para cancelar la cotizacion-->
							<form action="controlador/cotizacionControlador.php" method="post" enctype="multipart/form-data">
								<input type='hidden' name="accion" id="accion" value="cancelar">
								<input type='hidden' name="idElimina" id="idElimina" value="<?php echo  $idCotizacion;?>">
								<button class="btn btn-danger" type="submit" >Cancelar</button>
							</form>
						</div>
					<?php }?>
					</div>
				
			</div>
		</div>
		
	</div>


	<br>
	<!--seccion de concentrado-->
	<div class="col-lg-12">
		<div class="ibox">
			<div class="ibox-title">
				<h5><b>Tus cotizaciones</b></h5>
			</div>
			<div class="ibox-content">
				<table class="table table-striped">
					<thead>
					<tr>
						<th>Cliente</th>
						<th>Lugar y fecha</th>
						<th class="text-center">Status</th>
						<th class="text-center"></th>
					</tr>
					</thead>
					<tbody>
					<?php while ($cotiInfo = $coti->fetch_object()){?>
						<tr>
							<td><?php echo  $cotiInfo->dirigido;?></td>
							<td><?php echo  $cotiInfo->lugarFecha;?></td>
							<td class="text-center">
								<?php if($cotiInfo->estatus == 2){ echo "Sin enviar"; } elseif ($cotiInfo->estatus == 3){ echo "Enviado";} ?>
								
							</td>

							<td class="text-center">
								<div class="row">
								<?php if($cotiInfo->estatus != 3){?>
									<div class="col-md-4">
										<form action="controlador/cotizacionControlador.php" method="post" enctype="multipart/form-data">
											<input type='hidden' name="accion" id="accion" value="ahora">
											<input type='hidden' name="idAhora" id="idAhora" value="<?php echo  $cotiInfo->idCotizacion;?>">
											<button class="btn btn-primary" type='submit'>Enviar / reenviar</button>&nbsp; &nbsp;&nbsp; 
										</form>
									</div>
								<?php }?>
									<div class="col-md-4 text-center">
										<!--button class="btn btn-primary" data-toggle="modal" data-target="#nuevoClienteC">Convertir a factura</button-->
										<button class="btn btn-danger" data-toggle="modal" data-target="#elimina" data-unoo="<?php echo  $cotiInfo->idCotizacion; ?>" ><i class="fa fa-trash"></i></button>
									</div>
							</td>
						</tr>
					<?php }?>
					</tbody>
				</table>

				<!--formulario extras-->
				
			</div>
		</div>
		<br>
	</div>

</div>
<br>

<script>
			var textarea = document.getElementById('descripcion');
			sceditor.create(textarea, {
				format: 'xhtml',
				icons: 'monocons',
				toolbar: 'bold,italic,underline|left,center,right,justify|bulletlist,orderedlist|table',
				style: '../dist/minified/themes/content/default.min.css'
			});

			var textarea = document.getElementById('notas');
			sceditor.create(textarea, {
				format: 'xhtml',
				icons: 'monocons',
				toolbar: 'bold,italic,underline|left,center,right,justify|bulletlist,orderedlist|table',
				style: '../dist/minified/themes/content/default.min.css'
			});
</script>


<!---seccion de modals--->
<div class="modal inmodal fade" id="elimina" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Eliminar cotización</h4>
            </div>
            <div class="modal-body">
                <form action="controlador/cotizacionControlador.php" method="post" enctype="multipart/form-data">
					<input type='hidden' name="accion" id="accion" value="cancelar">
					<input type='hidden' name="idElimina" id="idElimina" value="">
				

                <div class='row'>
                    <div class='col-md-12'>
                        <div class="alert alert-danger text-center">Recuerda que una vez eliminado no podrás ecuperar el archivo.</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id='borraArchivo'> Eliminar</button>
                </form>
                <button type="button" class="btn btn-white" data-dismiss="modal" id='btnTern'> Cerrar</button>
            </div>
        </div>
    </div>
</div>