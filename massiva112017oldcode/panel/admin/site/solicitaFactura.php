<?php 
    @session_start();	
    include 'modelo/consultaTablas.php';
    $misClientes = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];

    /* obtenemos el id del cliente que pide factura */
    $idCliFa = ($_GET['idCliFa'] == '')? $_POST['idCliFa'] : $_GET['idCliFa'];
   
    echo $idCliFa;
    
    /* obtenemos cuantos cdfi */    
    $rspTabla = $misClientes->cuantoscdfiFIN($id_usuario);
    $rspTablaInfo = $rspTabla->fetch_object();
    $mistic = $rspTablaInfo->facturas;


    /* obtenemos el uso de cdfi */
    $rspUcdfi = $misClientes->obtenemoscdfi();
    
    /* obtenemos la forma de pago */
    $rspformaPago = $misClientes->FormaPago();
    
    /* obtenemos la moenda  */
    $rspmonedadd = $misClientes->monedadd();

    /* obtenemos los servicios que tenemos registrados */

    //obtenemos las consultas para datos predictivos
    $serviciosObt = $misClientes->serviciosObt($id_usuario);
    $texto = '';
    while($serviciosObtInfo = $serviciosObt->fetch_object()){
    	$texto .= "'".$serviciosObtInfo->idServicio." | ".$serviciosObtInfo->titulo."',";
    	//$texto .= "'".$valorDescriInfo->descripcion."',";
	}
    
    /* variabale para cuando sea el primer paso */
    //obtenemios los valores del primer paso del registro
    if($priPaso != ''){
        $priPaso = $misClientes->obtenerPrimerPas($id_usuario);
        $priPasoInfo = $priPaso->fetch_object();

        $datoscompletos = $priPasoInfo->datoscompletos;
        $andire = $priPasoInfo->andire;
        $uso = $priPasoInfo->uso;
        $metodo = $priPasoInfo->metodo;
        $forma = $priPasoInfo->forma;
        $moneda = $priPasoInfo->moneda;
        $tipoCambio = $priPasoInfo->tipoCambio;

        /* valor para veri si ya guardo el primer paso */
        $idFactura = $priPasoInfo->idFactura;

        /* obtenemos los productos para mostrarlo en el predictivo */
        $produc = $misClientes->ObtenemosPro($id_usuario);
        $textoDos2 = '';
        while($producInfo = $produc->fetch_object()){
          $textoDos2 .= "'".$producInfo->satdes." | ".$producInfo->unidadsat."',";
          //$texto .= "'".$valorDescriInfo->descripcion."',";
        }
        /* obtenemos los servicios */
        $servio = $misClientes->obteneServicios($id_usuario);
        while($servioInfo = $servio->fetch_object()){
          $textoDos2 .= "'".$servioInfo->satcodigo." | ".$servioInfo->titulo."',";
          //$texto .= "'".$valorDescriInfo->descripcion."',";
        }
        


        /* obtenemos los productos agregados a la factura */
        $producFacc = $misClientes->obteproductosFac($idFactura);

        /* obtenemos el subtotal de los productos */
        $subtotal = $misClientes->subapropa($idFactura);
        $subtotalInfo = $subtotal->fetch_object();
        $subtotalFinal = $subtotalInfo->subtotal;

    }
    
?>
<script>
function cambio() {
     
        element = document.getElementById("content");
        check = document.getElementById("andirett");
        if (check.checked) {
            element.style.display='block';
        }
        else {
            element.style.display='none';
        }
    }
</script>
<!--seccion de contenido-->

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action">
			<a href="index.php?secc=misclientes" class="btn btn-primary"> Regresar</a>
		</div>
	</div>
</div>
<hr>
<!-- alerta de cantidad de facturas -->
<div class="row">
	<div class="col-md-12">
		<?php if($mistic ==''){?>
			<div class="alert alert-warning text-right"><b>Lo sentimos, no cuentas con créditos suficientes para solicitar otra Factura. <br>Ve a Carrito y compras más facturas.</b>
		<?php }else{?>
			<div class="alert alert-warning text-right"><b>Para este mes te quedan: <span style="color: #f1005e; font-size: 20px;"><b><?php echo $mistic;?></b></span> facturas. </b>
		<?php }?>
		<input type='hidden' name='mistic' id='mistic' value='<?php echo $mistic;?>'>
		</div>
	</div>
</div>
<hr>
<!-- alertas de acciones -->

<hr>
<?php if($mistic != ''){?>
<div class='row'>
<form action='controlador/solicitaFacturasControlador.php' method="post">
    <?php if($idFactura == ''){?>
    <input type='hidden' name='accion' id='accion' value='primerPaso'>
    <input type='hidden' name='idCliente' id='idCliente' value='<?php echo $idCliFa;?>'>
    <input type='hidden' name='idCliFa' id='idCliFa' value='<?php echo $idCliFa;?>'>
    <?php }else{?>
    <input type='hidden' name='accion' id='accion' value='segundoPaso'>
    <input type='hidden' name='idFactura' id='idFactura' value='<?php echo  $idFactura;?>'>
    <input type='hidden' name='idCliFa' id='idCliFa' value='<?php echo $idCliFa;?>'>
    <?php }?>

   <!-- seccio para el primer paso  -->
	<div class='col-md-12'>
		<div class="ibox">
			<div class="ibox-title"><h5>¿Quieres mostrar esta información en la factura?</h5></div>
			<div class="ibox-content text-center">
				<div class="row">
            <div class="col-md-6">
                <div class="input-group m-b">
                    <span class="input-group-addon"><input type="checkbox" id="datoscompletos" name="datoscompletos" value='1' <?php if($datoscompletos == 1){ echo "checked"; }?> ></span> 
                    <input class="form-control" type="text"   placeholder="Datos completos del cliente" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group m-b">
                    <span class="input-group-addon"><input type="checkbox"  id="andirett" name="andirett" onclick="cambio()" value='1' <?php if($andire != 0){ echo "checked"; }?>></span>
                    <input class="form-control" type="text" placeholder="Añadir dirección de entrega" disabled>
                </div>
            </div>
        </div>

    <div id='content' name='content' <?php if($andire != 0){ echo "style='display: block;'"; }else{echo "style='display: none;'";}?>>
        <div class="row">
            <div class="col-md-12 text-left">
                <h5>Ingresa la dirección</h5><hr>
                <textarea class="form-control" style='width:100%' id="andire" name="andire"><?php echo $andire;?></textarea>
            </div>
        </div>
        </div>
			</div>
		</div>
	</div>
	<!-- datos generales de la factura -->
	<div class='col-md-6'>
		<div class="ibox">
			<div class="ibox-title"><h5>Datos de factura</h5></div>
			<div class="ibox-content text-center">
            
				<div class="row">
                    <div class="col-md-12">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                            <select class="form-control" id="uso" name="uso" required>
                                <?php if($uso != ''){ echo "<option>".$uso."</option>"; }?>
                                <option>Uso de CFDI</option>
                                <?php while($rspUcdfiInfo = $rspUcdfi->fetch_object()){ ?>
                                    <option value='<?= $rspUcdfiInfo->clave;?>'><?= $rspUcdfiInfo->descripcion;?></option>
                                <?php }?>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <select class="form-control" name='metodo' id='metodo' required>
                                <?php if($metodo != ''){ echo "<option>".$metodo."</option>"; }?>
                                <option>Método de pago</option>
                                <option value='PUE'>PUE - Pago en una sola exhibición</option>
                                <option value='PPD'>PPD - Pago en parcialidades diferido</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <select class="form-control" id="forma" name="forma" required>
                                <?php if($forma != ''){ echo "<option>".$forma."</option>"; }?>
                                <option>Forma de pago</option>
                                <?php while($rspformaPagoIfno = $rspformaPago->fetch_object()){ ?>
                                    <option value='<?= $rspformaPagoIfno->descripcion;?>'><?= $rspformaPagoIfno->descripcion;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>

				      <div class="row">
                    <div class="col-md-6">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <select class="form-control" id="moneda" name="moneda" required>
                                <?php if($moneda != ''){ echo "<option>".$moneda."</option>"; }?>
                                <option>Moneda</option>
                                <?php while($rspmonedaddInfo = $rspmonedadd->fetch_object()){ ?>
                                    <option value='<?= $rspmonedaddInfo->clave;?>'><?= $rspmonedaddInfo->clave;?></option>
                                <?php }?>
                            </select>
                            
                        </div>
                    </div>
                </div>
                    <!--div class="col-md-6">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <input class="form-control" type="text" id="tipoCambio" name="tipoCambio"  placeholder="Tipo de cambio" required  value='<?php if($tipoCambio != ''){ echo $tipoCambio; }?>''>
                            
                        </div>
                    </div-->
                    <div class="row">  
                        <?php if($idFactura == ''){?>
                            <div class='col-lg-12 text-center'>
                                <button type="submit" class="btn btn-primary" style='width:100%' data-dismiss="modal"> Guardar datos</button>
                            </div>
                            </form>
                        <?php } else{?>
                            <div class='col-md-6 text-center'>
                                <button type="submit" class="btn btn-primary" style='width:100%' data-dismiss="modal"> Actualizar datos</button>
                            </div>
                            </form>
                            <!-- boton para eliminar -->
                            <form action='controlador/solicitaFacturasControlador.php' method="post">
                            <input type='hidden' name='accion' id='accion' value='eliminar'>
                            <input type='hidden' name='idFactura' id='idFactura' value='<?php echo  $idFactura;?>'>
                            <input type='hidden' name='idCliFa' id='idCliFa' value='<?php echo $idCliFa;?>'>
                            <div class='col-md-6 text-center'>
                                <button type="submit" class="btn btn-danger" style='width:100%'> Cancelar Factura</button>
                            </div>
                            </form>
                        <?php } ?>
    
                </div>
			</div>
		</div>
    
	</div>

	<!-- cracion de los productos -->
  <div class='col-md-6' <?php if($priPaso == ''){?>style='display: none' <?php }?>>
		<div class="ibox">
			<div class="ibox-title"><h5>Agregar servicios o productos</h5></div>
			<div class="ibox-content text-center">
      <!-- formulario para agregar productos -->
      <form action='controlador/solicitaFacturasControlador.php' method="post">

        <!-- valores para agregar productos de la factura -->
        <input type='hidden' name='idFacturaPro' id='idFacturaPro' value='<?php echo $idFactura;?>'>
        <input type='hidden' name='accion' id='accion' value='agregaProd'>
        <input type='hidden' name='idCliFa' id='idCliFa' value='<?php echo $idCliFa;?>'>
        
				<div class="row">
          <div class="col-md-12">
              <div class="input-group m-b">
                  <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                  <input class="form-control typeahead_1" type="text" id="nombre" name="nombre"  placeholder="Busca tu producto o servicio" required>
              </div>
          </div>
          <div class="col-md-6">
              <div class="input-group m-b">
                  <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                  <input class="form-control" type="text" id="cantidad" name="cantidad" placeholder="Cantidad" required>
              </div>
          </div>
          <div class="col-md-6">
              <div class="input-group m-b">
                  <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                  <input class="form-control" type="text" id="precio" name="precio" placeholder="Costo" required>
              </div>
          </div>
          <!--div class="col-md-6">
              <div class="input-group m-b">
                  <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                  <input class="form-control" type="text" id="descuento" name="descuento" placeholder="Descuento %">
              </div>
          </div-->
          <div class="col-md-6">
              <div class="input-group m-b">
                  <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                  <input class="form-control" type="hidden" id="total" name="total" required>
                  <input class="form-control" type="text" id="Totalmues" name="Totalmues" placeholder="Total" disabled>
              </div>
          </div>
          <div class='col-lg-12 text-center'>
              <button type="submit" class="btn btn-primary" id='btnOcho' style='width:100%' disabled> Agregar</button>
          </div>
        </div>
      </form>
		</div>
	</div>
  </div>

	<!-- tabla de productos -->
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-content">
				<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover dataTables-example" >
					<thead>
						<tr>
							<th>Producto / Servicio</th>
							<th>Cantidad</th>
							<th>Precio</th>
							<th>Total</th>
              <th></th>
						</tr>
					</thead>
					<tbody>
              <?php  while($producFaccInfo = $producFacc->fetch_object()){?>
                <tr>
                  <td><?php echo $producFaccInfo->nombreSat?> | <?php echo $producFaccInfo->clavesat?> </td>
                  <td><?php echo $producFaccInfo->cantidad?></td>
                  <td><?php echo $producFaccInfo->precio?></td>
                  <td><?php echo $producFaccInfo->total?></td>
                  <form action='controlador/solicitaFacturasControlador.php' method="post">
                  <input type='hidden' name='accion' id='accion' value='eliminoProduList'>
                  <input type='hidden' name='idProFac' id='idProFac' value='<?php echo $producFaccInfo->idProFac?>'>
                  <input type='hidden' name='idCliFa' id='idCliFa' value='<?php echo $idCliFa;?>'>
                  <td><button class='btn btn-danger' type='submit' style='cursor: pointer; width: 100%'><i class='fa fa-times'></i></a></td>
                  </form>
                </tr>
              <?php }?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
	<!-- tabla de todales -->
  <hr>
  <div class="row">
	<div class="col-md-12" >
		<?php if($priPaso == 1){?>
			<div class="alert alert-warning text-center">Se agregaron todos los datos de tu factura, revísala antes de darle Solicitar.</div>
		<?php } if($EliminFAc == 1){?>
			<div class="alert alert-warning text-center">Se cancelo tu factura.</div> 
		<?php } if($priPaso == 2){?>
			<div class="alert alert-warning text-center">Se agregó tu producto a la factura.</div>
		<?php } if($priPaso == 3){?>
			<div class="alert alert-warning text-center">Se eliminó su producto de la factura.</div> 
		<?php } ?>

	</div>
</div>
  <hr>
	<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title"> <h5>Total de la factura</h5></div>
			<div class="ibox-content">
        <form action='controlador/solicitaFacturasControlador.php' method="post">
        <input type='hidden' name='idFacturaProUltimo' id='idFacturaProUltimo' value='<?php echo $idFactura;?>'>
        <input type='hidden' name='idCline' id='idCline' value='<?php echo $idCliFa;?>'>
        <input type='hidden' name='accion' id='accion' value='idFacUltimoPaso'>
        <div class="row">
            <div class="col-md-2">
                <div class="input-group m-b">
                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                    <input class="form-control" type="hidden" id="subtotal" name="subtotal"  placeholder="Subtotal" value='<?php echo  $subtotalFinal;?>'>
                    <input class="form-control" type="text" placeholder="Subtotal" disabled value='<?php echo  $subtotalFinal;?>'>
                    
                </div>
            </div>
            <div class="col-md-4">
                <div class="input-group m-b">
                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                    <?php if($subtotalFinal > 0){?> 
                    <input class="form-control" type="text" id="descuentos" name="descuentos" required onkeypress="return NumCheck(event, this)"  placeholder="Si no aplica descuento poner 0" >
                    <?php }else{?>
                    <input class="form-control" type="text" placeholder="Descuento" disabled>
                    <?php }?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group m-b">
                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                    <?php if($subtotalFinal > 0){?> 
                    <input class="form-control" type="hidden" id="iva" name="iva" placeholder="IVA" value='16' onkeypress="return NumCheck(event, this)">
                    <input class="form-control" type="text" placeholder="IVA" value='16' disabled>
                    <?php }else{?>
                    <input class="form-control" type="text" placeholder="IVA" disabled>
                    <?php }?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group m-b">
                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                    <input class="form-control" type="hidden" id="totalFac" name="totalFac" placeholder="Total" >
                    <input class="form-control" type="text" id="totalFin" name="totalFin"  placeholder="Total" disabled>
                </div>
            </div>
        </div>

			</div>
		</div>
	</div>
	<!-- boton de solicitar -->
	<div class='col-lg-12 text-center'>
		<button type="submit" class="btn btn-primary" id='solicitttt' style='width:100%' data-dismiss="modal"> Solicitar</button>
	</div>
  </form>
</div>
<?php }?>

<div class="wrapper wrapper-content animated fadeInRight">
</div>

<!-- seccion de javascript -->
<script src="js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
<script>
   

function NumCheck(e, field) {
    key = e.keyCode ? e.keyCode : e.which;
    // backspace
    if (key == 12) return true;
    // 0-9
    if (key > 47 && key < 58) {
      if (field.value == "") return true;
      regexp = /.[0-9]{16}$/;
      return !regexp.test(field.value);
    }
    // .
    if (key == 46) {
      if (field.value == "") return false;
      regexp = /^[0-9]+$/;
      return regexp.test(field.value);
    }
    // other key
    return false;
  }

$(document).ready(function(){

	$('.dataTables-example').DataTable({
		pageLength: 25,
		responsive: true,
		dom: '<"html5buttons"B>lTfgitp',
		buttons: [
		
			
			
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

  /* mostramos el valor */
  $('#andirett').on('change', function(){
		alert('si entra');
    $("#direcciocu").css("display", "block");
	});
 

  /* accion para obtener el precio */
  $("#precio").blur(function(){
    		var cantidad = $('#cantidad').val();
        var precio = $('#precio').val();
        //var descuento = $('#descuento').val();
        var uno = cantidad * precio;
        $('#total').val(uno);
        $('#Totalmues').val(uno);
        if(uno == 0){
          alert('Agrega una cantidad o el precio');
        }else{
          $("#btnOcho").removeAttr('disabled');
        }
	});

  /* accion par aobtener el descuento */
  $("#descuentos").blur(function(){
        var subtotal = $('#subtotal').val();
        var descuento = $('#descuentos').val();
        var iva = $('#iva').val();

        if(descuento == 0){
          /* en caso de que no aplique descuentos */
          var uno = parseInt(subtotal) * parseInt(iva);
          var dos = parseInt(uno) / 100;
          var tres =  parseInt(subtotal) +  parseInt(dos);
          $('#totalFac').val(parseInt(tres).toFixed(2));
          $('#totalFin').val(parseInt(tres).toFixed(2));

        }else{
          /* en caso de que aplique descuento */
          /* obtenemos primero el descuento */
          var uno = parseInt(subtotal) * parseInt(descuento);
          var dos = parseInt(uno) / 100;
          var tres = parseInt(subtotal) - parseInt(dos);

          /* obtenemos el iva */
          var cuatro = parseInt(tres) * parseInt(iva);
          var cinco = parseInt(cuatro) / 100;
          var seis =  parseInt(tres) +  parseInt(cinco);
          $('#totalFac').val(parseInt(seis).toFixed(2));
          $('#totalFin').val(parseInt(seis).toFixed(2));

        }

  });

  $("#iva").blur(function(){
        var subtotal = $('#subtotal').val();
        var descuento = $('#descuentos').val();
        var iva = $('#iva').val();

        if(descuento == 0){
          /* en caso de que no aplique descuentos */
          var uno = parseInt(subtotal) * parseInt(iva);
          var dos = parseInt(uno) / 100;
          var tres =  parseInt(subtotal) +  parseInt(dos);
          $('#totalFac').val(parseInt(tres).toFixed(2));
          $('#totalFin').val(parseInt(tres).toFixed(2));

        }else{
          /* en caso de que aplique descuento */
          /* obtenemos primero el descuento */
          var uno = parseInt(subtotal) * parseInt(descuento);
          var dos = parseInt(uno) / 100;
          var tres = parseInt(subtotal) - parseInt(dos);

          /* obtenemos el iva */
          var cuatro = parseInt(tres) * parseInt(iva);
          var cinco = parseInt(cuatro) / 100;
          var seis =  parseInt(tres) +  parseInt(cinco);
          $('#totalFac').val(parseInt(seis).toFixed(2));
          $('#totalFin').val(parseInt(seis).toFixed(2));

        }

  });

   

	/* accion para cuando se selecciona el tipo de producto */
	$('#tipo').on('change', function(){
		var val = $(this).val();
		var name = $('#tipo option:selected').text();
		if(name == 'Materia prima'){
			$("#alias1").css("display", "none");
			$("#alias2").css("display", "block");
			$("#alias3").css("display", "none");
		}
		if(name == 'Producto terminado'){
			$("#alias1").css("display", "none");
			$("#alias2").css("display", "none");
			$("#alias3").css("display", "block");
		}
	});

	

	/* Funcion para los mostrar predictivos los servicios */
	$('.typeahead_1').typeahead({ source: [<?php echo  $textoDos2; ?>] }); 

	
	/* Funcion para los mostrar predictivos los productos */

	 $("#eliminaServicios").on("show.bs.modal", function(event) {
    
		var button = $(event.relatedTarget); // Button that triggered the modal
		var uvano = button.data("doohs");
		var modal = $(this);
		modal.find(".modal-body #idServicio").val(uvano);
	});

	 $("#ModalEliminar").on("show.bs.modal", function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var uno = button.data("doos");
    var dos = button.data("dooss");

    var modal = $(this);

    modal.find(".modal-body #idInventario2").val(uno);
    modal.find(".modal-body #imgref2").val(dos);
  });

  $("#btnElimin").click(function() {
    /*obtengo valores*/
    var accion = "eliminar";
    var idInventario2 = $("#idInventario2").val();
    var imgref2 = $("#imgref2").val();
    /*metodo ajax*/
    $.ajax({
      data: { accion, idInventario2, imgref2 },
      url: "controlador/inventarioActivoControlador2.php",
      type: "POST",
      success: function(response) {
        $("#alertAccion").append(
          '<div class="alert alert-warning text-center">Se elimino el producto</div>'
        );
        $("#ModalEliminar").modal("hide");
        window.setTimeout("location.reload()", 3000);
      },
      error: function(response, status, error) {
        $("#alertAccion").append(
          '<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>'
        );
        $("#ModalEliminar").modal("hide");
        window.setTimeout("location.reload()", 3000);
      }
    });
	});
	
	$("#btncerranuevo").click(function() {
    $("#nuevoPro").trigger("reset");
    $("#nuevoprodu").modal("hide");
    window.setTimeout("location.reload()");
  });

  ///para editar
  $("#btnCierraEdita").click(function() {
    $("#editar").modal("hide");
    window.setTimeout("location.reload()");
  });

  //boton para eliminar
  $("#btnEliminaDir").click(function() {
    $("#ModalEliminar").modal("hide");
    window.setTimeout("location.reload()");
  });

  //boton para agregar entradad
  $("#btnCierEntrad").click(function() {
    $("#agregarentrada").modal("hide");
    window.setTimeout("location.reload()");
  });

  //boton para salida
  $("#btnCierSalia").click(function() {
    $("#agregaSalida").modal("hide");
    window.setTimeout("location.reload()");
  });

  /**********************************************************************************************/
  /****************************************editar*************************************/
  $("#editar").on("show.bs.modal", function(event) {
		
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipient = button.data("unoo");
    var recipientttt = button.data("doss");

    $.ajax({
      data: { idInventarioEdi: recipient },
      url: "controlador/inventarioActivoControlador.php",
      type: "POST",
			dataType: "json",
      success: function(data) {
        /* texto del producto */
				$('#prodes').html('<strong>Tipo:'+data.tipo+' | '+data.satdes+' | '+data.unidadsat+'</strong>');
				$("#satdesT1").val(data.satdes);
				$("#unidadsatt1").val(data.unidadsat);
				$("#tipo1 option[value='" + data.tipo + "']").attr(
          "selected",
          "selected"
        );

				$("#cantidad1").val(data.cantidad);
				$("#precioCompra1").val(data.precioCompra);
				$("#precioVenta1").val(data.precioVenta);
				$("#descuento1").val(data.descuento);
				$("#proveedor1").val(data.proveedor);
				$("#comentarios1").html(data.comentarios);


      }
    });

    //se abre el modal
    var modal = $(this);
    modal.find(".modal-body #idInventarioEdi").val(recipient);
    modal.find(".modal-body #fotova").val(recipientttt);
  });

  
  /**********************************************************************************************/
  /****************************************agregar entrada de producto*************************************/
  $("#agregarentrada").on("show.bs.modal", function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var unoo = button.data("unoo");
    var doso = button.data("doso");

    var modal = $(this);

    modal.find(".modal-body #idInventarioE").val(unoo);
    modal.find(".modal-body #CasntE").val(doso);
  });

  //agregar la entrada
  $("#agreEntrada").click(function() {
    /*obtengo valores*/
    var accion = "agreEntrada";
    var idInventarioE = $("#idInventarioE").val();
    var fechaEntradaE = $("#fechaEntradaE").val();
    var cantidadE = $("#cantidadE").val();
    var precioE = $("#precioE").val();
    var proveedorE = $("#proveedorE").val();
    var unidadE = $("#unidadE").val();
    var CasntE = $("#CasntE").val();

    /*metodo ajax*/
    $.ajax({
      data: {
        accion,
        idInventarioE,
        fechaEntradaE,
        cantidadE,
        precioE,
        proveedorE,
        unidadE,
        CasntE
      },
      url: "controlador/inventarioActivoControlador2.php",
      type: "POST",
      success: function(response) {
        $("#alertAccion").append(
          '<div class="alert alert-warning text-center">Se agregó tu entrada al producto</div>'
        );
        $("#agregarentrada").modal("hide");
        window.setTimeout("location.reload()", 3000);
      },
      error: function(response, status, error) {
        $("#alertAccion").append(
          '<div class="alert alert-danger text-center">Ocurrió un error, por favor verificar tus datos .</div>'
        );
        $("#agregarentrada").modal("hide");
        window.setTimeout("location.reload()", 3000);
      }
    });
  });

  /**********************************************************************************************/
  /****************************************agregar entrada de producto*************************************/
  $("#agregaSalida").on("show.bs.modal", function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var unoo = button.data("unoo");
    var doso = button.data("doso");

    var modal = $(this);

    modal.find(".modal-body #idInventarioE1").val(unoo);
    modal.find(".modal-body #CasntE1").val(doso);
  });

  //agregar salida
  $("#agreSalidaddf").click(function() {
    /*obtengo valores*/
    var accion = "agreSalida";
    var idInventarioE1 = $("#idInventarioE1").val();
    var fechaEntradaE1 = $("#fechaEntradaE1").val();
    var cantidadE1 = $("#cantidadE1").val();
    var precioE1 = $("#precioE1").val();
    var proveedorE1 = $("#proveedorE1").val();
    var unidadE1 = $("#unidadE1").val();
    var CasntE1 = $("#CasntE1").val();

    /*metodo ajax*/
    $.ajax({
      data: {
        accion,
        idInventarioE1,
        fechaEntradaE1,
        cantidadE1,
        precioE1,
        proveedorE1,
        unidadE1,
        CasntE1
      },
      url: "controlador/inventarioActivoControlador2.php",
      type: "POST",
      success: function(response) {
        $("#alertAccion").append(
          '<div class="alert alert-warning text-center">Se agregó tu salida al producto</div>'
        );
        $("#agregaSalida").modal("hide");
        window.setTimeout("location.reload()", 3000);
      },
      error: function(response, status, error) {
        $("#alertAccion").append(
          '<div class="alert alert-danger text-center">Ocurrió un error, por favor verificar tus datos .</div>'
        );
        $("#agregaSalida").modal("hide");
        window.setTimeout("location.reload()", 3000);
      }
    });
  });
	
});
</script>


