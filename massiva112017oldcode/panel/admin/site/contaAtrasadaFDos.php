<?php 
	
	require_once "modelo/datosKey.php";
	@session_start();
    include 'modelo/consultaTablas.php';
    $soporte = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
    $fechaCreacion = date("Y-m-d");
    //consultas de persona fisica
	$uno = $soporte->contaatraConregisFinal();
	
 ?>
 
 <div class="row white-bg page-heading">
	<div class="col-md-12">
		<div class="title-action"><a href="index.php?secc=dascontaf" class="btn btn-primary" > Regresar</a></div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12" >
		<?php if($EnviCoDOs == 1){?>
			<div class="alert alert-warning text-center">Se envio la cotización con los mismos datos</div>

		<?php } if($EnviCo == 2){?>
			<div class="alert alert-danger text-center">Se eliminó la cotización</div> 
		<?php } if($EnviCo == 3){?>
			<div class="alert alert-warning text-center">Se envio la cotización al cliente en espera de su validación</div> 
		<?php }?>

		
	</div>
</div>

<!--seccion de contenido-->
<hr>
<div class="row white-bg">
	<div class="col-md-12">
		<div class="ibox">
            <div class="ibox-title"><h5>Contabilidad atrasada de usuarios registrados</h5></div>
                <div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
								<tr>
									<th>Nombre</th>
									<th>RFC</th>
									<th>Fecha</th>
									<th>Correo</th>
									<th>Actividad</th>
									<th>Forma juridica</th>
									<th>Monto cotización</th>
									<th>Key / Cer</th>
									<th>Clave</th>
									<th>Acciones</th>
									<th>Detalles</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									/* recorremos el resultado pero verificamos si ya esta registrado en la tabla de contabilidad atrasada */
									while($unoInfo = $uno->fetch_object()){
										$rfcConsu = $unoInfo->rfc;

										$dos = $soporte->verifiConFisicAtra($rfcConsu);
										$dosInfo = $dos->fetch_object();
										$vriId = $dosInfo->idContaAtrasada;
										$est = $dosInfo->estatus;
										$monto = $dosInfo->monto;
										if($vriId != '' && $est == 2 || $est == 4){ 
								?>
									<tr>
										<td><?php echo $unoInfo->nombre; echo " "; $unoInfo->ape_paterno; echo " "; $unoInfo->ape_materno;?></td>
										<td><?php echo $unoInfo->rfc;?></td>
										<td><?php echo $unoInfo->fechaCrea;?></td>
										<td><?php echo $unoInfo->correo;?></td>
										<td><?php echo $unoInfo->tipoActividad;?></td>
										<td><?php $gorma = ($unoInfo->formaJuridica == 'f')?  "Persona Fisica" : "Persona moral"; echo $gorma;?></td>
										<td>$ <?php echo $monto;?> pesos</td>
										<td>
											<!-- Aqui obtenemos la documentacion del suuario -->
											<?php 
												$tres = $soporte->consuDatoscontaatraDo($unoInfo->id_usuario);
												$tresInfo = $tres->fetch_object();
												$keyaar = $tresInfo->keyaar;
												$cerar = $tresInfo->cerar;
												/* converitimos la clave */
												$calv = $tresInfo->clave;
												$key=hash('sha256', SECRET_KEY);
												$iv=substr(hash('sha256', SECRET_IV), 0, 16);
												$output=openssl_decrypt(base64_decode($calv), METHOD, $key, 0, $iv);

											?>
											<a href='contenedor/clientes/<?php echo $rfcConsu;?>/<?php echo $keyaar;?>' style='cursor:pointer' download="<?php echo $keyaar;?>"><i class='fa fa-file-code-o'></i></a> | 
											<a href='contenedor/clientes/<?php echo $rfcConsu;?>/<?php echo $cerar;?>' style='cursor:pointer' download="<?php echo $cerar;?>"><i class='fa fa-file-code-o'></i></a>
										</td>
										<td>
											<p id="copytext"><?php echo $output;?></p>
										</td>
										<?php if($dosInfo->estatus == 2){?>	
										<td class="text-center">
											<div class="col-md-6">
												<form action="controlador/simuladorControlador.php" method="POST">
													<input type="hidden" name="accion" id="accion" value="reenviarDos">
													<input type="hidden" name="montoEnvia" id="montoEnvia" value="<?php echo $unoInfo->monto;?>">
													<input type="hidden" name="correEnvia" id="correEnvia" value="<?php echo $unoInfo->correo;?>">
													<input type="hidden" name="idUsuArio" id="idUsuArio" value="<?php echo $unoInfo->id_usuario;?>">
													<input type="hidden" name="rfcCoti" id="rfcCoti" value="<?php echo $unoInfo->rfc;?>">
													<button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
												</form>
											</div>
											<div class="col-md-6"><button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myModal" data-unoo='<?php echo $vriId;?>'  data-fdod='<?php echo $unoInfo->rfc;?>' data-cuatro='<?php echo $unoInfo->id_usuario;?>' data-tres='<?php echo $unoInfo->correo;?>'><i class="fa fa-edit"></i></button></div>
										</td>
										<?php }else{?>
											<td class="text-center"><div class="col-md-12"><b>En espera de validación</b></div></td>
										<?php }?>
										
										<!-- boton para mostrar los detalles de la cotizacion -->
										<td class="text-center"><div class="col-md-12"><button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#detalles" data-unoo='<?php echo $vriId;?>'><i class="fa fa-search"></i></button></div></td>

										
									</tr>
								<?php } }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<br>
<hr>

<!-- modal para detalles -->
<div class="modal fade bs-example-modal-lg" id="detalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Valores de cotización</h4>
      </div>
      <div class="modal-body">
  	    	<!-- calculadora para contabilidad atrasada -->
			  	<div class="panel-body">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
			</div>
	    </div>
  </div>
</div>

<!--modal para eliminar-->
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar valores de cotización</h4>
      </div>
      <div class="modal-body">
       	<!-- calculadora para contabilidad atrasada -->
		   <div class="panel-body">
					<form class="input-group" action="controlador/simuladorControlador.php" style="width: 100% !important" method="POST" enctype="multipart/form-data">
						<input type="hidden" class="form-control" name="montoCal" id='montoCal'>
						<input type="hidden" class="form-control" name="accion" id="accion" value='editaCotiEnvia'>
						<input type="hidden" class="form-control" name="idContaAtrasadaEdi" id="idContaAtrasadaEdi" value=''>
						<input type="hidden" class="form-control" name="refcEd" id="refcEd" value=''>
						<input type="hidden" class="form-control" name="correEnvia" id="correEnvia" value=''>
						<input type="hidden" class="form-control" name="idUsuArio" id="idUsuArio" value=''>
						
					<hr>
					<div class="row">
						<div class="alert alert-success" style="background-color: #F7BD00; color: #FFFFFF">Subir archivo</div>
						<div class="col-md-12" class="input-group">
							<input type='file' name='documento' id='documento'>
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

								<div class="col-md-6">
									<input type="checkbox" id="cheInteres" name="cheInteres" value="1"> INTERÉS<br>
								</div>
								<div class="col-md-6">
									<input type="checkbox" id="cheasalariado" name="cheasalariado" value="2"> ASALARIADO<br>
								</div>
								<div class="col-md-6">
									<input type="checkbox" id="chearrendamiento" name="chearrendamiento" value="3"> ARRENDAMIENTO<br>
								</div>
								<div class="col-md-6">
									<input type="checkbox" id="cheservicios" name="cheservicios" value="4"> SERVICIOS PROFESIONALES<br>
								</div>
								<div class="col-md-6">
									<input type="checkbox" id="cheempresaria" name="cheempresaria" value="5"> ACTIVIDAD EMPRESARIAL<br>
								</div>
								<div class="col-md-6">
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
					</div>
					
				</div>
			
      </div>
      <div class="modal-footer">
		<button type="submit" class="btn btn-primary">Modificar y Enviar</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
	$('.dataTables-example').DataTable({
		pageLength: 25,
		responsive: true,
		dom: '<"html5buttons"B>lTfgitp',
		buttons: [
			{extend: 'pdf', title: 'ExampleFile'},

			{extend: 'print',
				customize: function (win){
					$(win.document.body).addClass('white-bg');
					$(win.document.body).css('font-size', '10px');

					$(win.document.body).find('table')
							.addClass('compact')
							.css('font-size', 'inherit');
			}
			}
		],
		language: {
			processing:     "Procesando...",
			search:         "Buscar:",
			lengthMenu:     "Mostrar: _MENU_ elementos",
			info:           "Mostrando _START_ a _END_ de _TOTAL_ resultados",
			infoEmpty:      "Elemento 0 de 0 elementos encontrados",
			infoFiltered:   "(elementos filtrado _MAX_ de elementos maximos )",
			infoPostFix:    "",
			loadingRecords: "Cambios en Curso...",
			zeroRecords:    "No se encuentran elementos.",
			emptyTable:     "Tabla no disponible",
			paginate: {
				first:      "Adelante",
				previous:   "Anterior",
				next:       "Siguiente",
				last:       "Atrás"
			}

		}
	});
	/* para el modla de eliminar */
	$('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
		var uno = button.data('unoo');
		var dos = button.data('fdod');
		var tres = button.data('tres');
		var cuatro = button.data('cuatro');
		
        var modal = $(this);
		modal.find('.modal-body #idContaAtrasadaEdi').val(uno);
		modal.find('.modal-body #refcEd').val(dos);
		modal.find('.modal-body #correEnvia').val(tres);
		modal.find('.modal-body #idUsuArio').val(cuatro);
		
		
	});

	/* realizar el recalculo de la cotizacion */
	$("#calcular").click(function() {
    /*obtengo valores*/
    $("#costofinal1").empty();
    var categorias = new Array();
    $("input[name='obliga[]']:checked").each(function() {
      categorias.push($(this).val());
    });

    //obtenemos las obligaciones seleccionadas.
    var cont = categorias.length;

    if (cont == 1) {
      var porcenObli = 0.4;
    } else if (cont == 2) {
      var porcenObli = 0.7;
    } else if (cont == 3) {
      var porcenObli = 1;
    }

    if (cont > 0) {
      //obtenemos el tiempó ya sea año o mees
      var peridio = $("#periodoRegu").val();
      var valorFinal = peridio;
      var vancontrece = valorFinal * 13; ///numero de declaracion que se tienen que presentar
      //alert("Tipo de periodo seleccionado: "+peridio);
      //alert("resultado del tiempo si aplica o no multiplcar por trece:" +vancontrece);
      //teniendo el periodo sacamos el porcentaje segun la seleccion
      switch (peridio) {
        case "0":
          var porcen = 0.97;
          break;
        case "1":
          var porcen = 0.95;
          break;
        case "2":
          var porcen = 0.9;
          break;
        case "3":
          var porcen = 0.85;
          break;
        case "4":
          var porcen = 0.8;
          break;
        case "5":
          var porcen = 0.75;
          break;
        case "6":
          var porcen = 0.72;
          break;
      }
      //alert('el porcentaje segun lo seleccionado es de: '+porcen);
      //alert('Seleccionaste '+cont+ ' Obligaciones');
      //alert('Obtuviste un descuento de:' +porcenObli);

      //obtenemos los regimenes del cliente
      if ($("#cheInteres").prop("checked")) {
        var uno = 15.3;
      } else {
        var uno = 0;
      }

      if ($("#cheasalariado").prop("checked")) {
        var dos = 15.3;
      } else {
        var dos = 0;
      }

      if ($("#chearrendamiento").prop("checked")) {
        var tres = 199;
      } else {
        var tres = 0;
      }

      if ($("#cheservicios").prop("checked")) {
        var cuatro = 299;
      } else {
        var cuatro = 0;
      }
      if ($("#cheempresaria").prop("checked")) {
        var cinco = 199;
      } else {
        var cinco = 0;
      }
      if ($("#cherif").prop("checked")) {
        var seis = 99;
      } else {
        var seis = 0;
      }

      /*alert("Seleccionas uno"+uno);
		alert("Seleccionas dos"+dos);
		alert("Seleccionas tres"+tres);
		alert("Seleccionas cuatro"+cuatro);
		alert("Seleccionas cinco"+cinco);
		alert("Seleccionas seis"+seis);*/

      if (uno > 0) {
        var sumaFinal1 = vancontrece * uno;
      } else {
        var sumaFinal1 = 0;
      }

      if (dos > 0) {
        var sumaFinal2 = vancontrece * dos;
      } else {
        var sumaFinal2 = 0;
      }

      if (tres > 0) {
        var sumaFinal3 = vancontrece * tres;
      } else {
        var sumaFinal3 = 0;
      }

      if (cuatro > 0) {
        var sumaFinal4 = vancontrece * cuatro;
      } else {
        var sumaFinal4 = 0;
      }

      if (cinco > 0) {
        var sumaFinal5 = vancontrece * cinco;
      } else {
        var sumaFinal5 = 0;
      }

      var total =
        sumaFinal1 + sumaFinal2 + sumaFinal3 + sumaFinal4 + sumaFinal5;
      //agregamos el porcentaje de las obligaciones

      var totalPDes = total * porcenObli;

      var totalAn = totalPDes * porcen;

      var Fiinal = Math.round(totalAn);

      //alert(Fiinal);
      $("#costofinal1").append(
        '<div class="alert alert-warning text-center"><b>Costo final: $' +
          Fiinal +
          "<br></b>Esta cotización solo incluye los servicios de massiva. No incluye las multas, recargos ni cantidades a favor del SAT. <br>Esta cotización podría variar después del análisis real de massiva. <br> <b>A partir de $2,000, massiva te ofrece de 3 a 6 meses sin intereses.</b></div>"
      );
      $("#montoCal").val(Fiinal);
    } else {
      alert("Selecciona una obligación");
    }
  });

});
</script>

