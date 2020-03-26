<?php 
    require_once "modelo/datosKey.php";
    include 'modelo/consultaTablas.php';
    $soporte = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
    $fechaCreacion = date("Y-m-d");

   /* seccion para el conteo */
    $uno = $soporte->totalSumaUno();
	$unoInfo = $uno->fetch_object();
    $totalUno = $unoInfo->total;
    
    $dos = $soporte->totalSumaDos();
	$dosInfo = $dos->fetch_object();
    $totalDos = $dosInfo->total;
    
    $tres = $soporte->totalSumaTres();
	$tresInfo = $tres->fetch_object();
    $totalTres = $tresInfo->total;
    
    $cuatro = $soporte->totalSumaCuatro();
	$cuatroInfo = $cuatro->fetch_object();
    $totalCuatro = $cuatroInfo->total;
    
    $cinco = $soporte->totalSumaCinco();
	$cincoInfo = $cinco->fetch_object();
    $totalCinco = $cincoInfo->total;
    
    $seis = $soporte->totalSumaSeis();
	$seisInfo = $seis->fetch_object();
	$totalSeis = $seisInfo->total;
   
   /* seccion para las tablas */

   /* contenido de obligaciones fiscales */
   $pendiobli = $soporte->pendiobli();

   /* contenido para la efirma */
   $pendioefirma = $soporte->pendiefirma();

   /* contenido para cambios de domicilio */
   $suspension = $soporte->suspension();
   
    /* cotnenido para la constancia de obligaciones */
    $constanciaObli = $soporte->constanciaObli();

    /* cotnenido para la defuncion*/
    $defuncion = $soporte->defuncion();

     /* cotnenido para el cambio de domicilio*/
     $domicilio = $soporte->domicilio();
    
 ?>
 
<script>
$(document).ready(function(){
    ///funcion para la tabla
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

    /*/////////////////////////// funciones para la actualzicion de obligaciones /////////////////////////// */
    $('#terminarUno').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('unoo');
        var dos = button.data('doss');
        var tres = button.data('tress');
       
        var modal = $(this)
        modal.find('.modal-body #idActu').val(recipient);
        modal.find('.modal-body #rfcCli').val(dos);
        modal.find('.modal-body #correo').val(tres);
    });

    /*/////////////////////////// funciones para la actualzicion de efirma /////////////////////////// */
    $('#terminarDos').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('unoo');
        var dos = button.data('doss');
        var tres = button.data('tress');
       
        var modal = $(this)
        modal.find('.modal-body #idActu').val(recipient);
        modal.find('.modal-body #rfcCli').val(dos);
        modal.find('.modal-body #correo').val(tres);
    });
    /*/////////////////////////// funciones para la actualzicion de suspencion /////////////////////////// */
    $('#terminarTres').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('unoo');
        var dos = button.data('doss');
        var tres = button.data('tress');
       
        var modal = $(this)
        modal.find('.modal-body #idActu').val(recipient);
        modal.find('.modal-body #rfcCli').val(dos);
        modal.find('.modal-body #correo').val(tres);
    });
    /*/////////////////////////// funciones para la actualzicion de constancia de obligaciones /////////////////////////// */
    $('#terminarCinco').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('unoo');
        var dos = button.data('doss');
        var tres = button.data('tress');
       
        var modal = $(this)
        modal.find('.modal-body #idActu').val(recipient);
        modal.find('.modal-body #rfcCli').val(dos);
        modal.find('.modal-body #correo').val(tres);
    });
    /*/////////////////////////// funciones para la actualzicion de defuncion /////////////////////////// */
    $('#terminarSeis').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('unoo');
        var dos = button.data('doss');
        var tres = button.data('tress');
       
        var modal = $(this)
        modal.find('.modal-body #idActu').val(recipient);
        modal.find('.modal-body #rfcCli').val(dos);
        modal.find('.modal-body #correo').val(tres);
    });

     /*/////////////////////////// funciones para el cambio de domicilio /////////////////////////// */
     $('#terminarCuatro').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('unoo');
        var dos = button.data('doss');
        var tres = button.data('tress');
       
        var modal = $(this)
        modal.find('.modal-body #idActu').val(recipient);
        modal.find('.modal-body #rfcCli').val(dos);
        modal.find('.modal-body #correo').val(tres);
    });

    
    
    
});
</script>
 <div class="row  border-bottom white-bg dashboard-header">
	<div class="col-md-12 text-center">
		<img src="img/logo.png" style='height: 70px'>
	</div>
</div>

<div class="row white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action"><a href="index.php?secc=dasconta" class="btn btn-primary" > Regresar</a></div>
	</div>
</div>
<hr>
<!-- seccion para avisos -->
<?php if ($actualizMod == 1){?>
	<div class="row"><div class="alert alert-warning text-center">Se finalizo la actualización y se envio el correo al cliente.</div></div>
<?php }?>
<?php if ($actualizMod == 2){?>
	<div class="row"><div class="alert alert-warning text-center">Se envio al cliente el mensaje de error.</div></div>
<?php }?>
<?php if ($actualizMod == 4){?>
	<div class="row"><div class="alert alert-warning text-center">Tu compra se realizó con éxito.</div></div>
<?php }?>
<?php if ($tiusu == 5){?>
	<div class="row"><div class="alert alert-warning text-center">Se eliminó tu ticket.</div></div>
<?php }?>
<?php if ($tiusu == 2){?>
		<div class="row"><div class="alert alert-danger text-center">Ocurrió un error.</div></div>
    <?php }?>
<hr>
<!--seccion de contenido-->
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-md-4 text-center"><button type="button" class="btn btn-outline btn-default"><b>Obligaciones fiscales Solicitudes totales: </b> <?php echo $totalUno;?> </button><br></div>
        <div class="col-md-4 text-center"><button type="button" class="btn btn-outline btn-default"><b>E-firma Solicitudes totales: </b> <?php echo $totalDos;?> </button><br></div>
        <div class="col-md-4 text-center"><button type="button" class="btn btn-outline btn-default"><b>Suspención de actividades Solicitudes totales: </b> <?php echo $totalTres;?> </button><br></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-4 text-center"><button type="button" class="btn btn-outline btn-default"><b>Cambio de domicilio Solicitudes totales: </b> <?php echo $totalCuatro;?> </button><br></div>
        <div class="col-md-4 text-center"><button type="button" class="btn btn-outline btn-default"><b>Constancia de Obligaciones Solicitudes totales: </b> <?php echo $totalCinco;?> </button><br></div>
        <div class="col-md-4 text-center"><button type="button" class="btn btn-outline btn-default"><b>Defuncion Solicitudes totales: </b> <?php echo $totalSeis;?> </button><br></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Obligaciones fiscales</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">E-firma</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Suspención de actividades</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4">Cambio de domicilio</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-5">Constancia de Obligaciones</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-6">Defuncion</a></li>
                </ul>
                <div class="tab-content">
                    <!-- seccion para obligaciones -->
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Solicita</th>
                                            <th>Actividades</th>
                                            <th>Fecha Solicitud</th>
                                            <th>RFC</th>
                                            <th>Forma juridica</th>
                                            <th>CER</th>
                                            <th>KEY</th>
                                            <th>Clave</th>
                                            <th class="text-center">Terminar</th>
                                            <th class="text-center">Error</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($pendiobliInfo = $pendiobli->fetch_object()){?>
                                            <tr>
                                                <td><?php echo $pendiobliInfo->nombre;?> <?php echo $pendiobliInfo->ape_paterno;?> <?php echo $pendiobliInfo->ape_materno;?></td>
                                                <td><?php echo $pendiobliInfo->actividad;?></td>
                                                <td><?php echo $pendiobliInfo->fechaSolicitud;?></td>
                                                <td><?php echo $pendiobliInfo->rfc;?></td>
                                                <td><?php $gorma = ($pendiobliInfo->formaJuridica == 'f')?  "Persona Fisica" : "Persona moral"; echo $gorma;?></td>
                                                <td><a href='contenedor/clientes/<?php echo $pendiobliInfo->rfc;?>/<?php echo $pendiobliInfo->cerar;?>' style='cursor:pointer' download="<?php echo $pendiobliInfo->cerar;?>"><i class='fa fa-file-code-o'></i></a></td>
                                                <td><a href='contenedor/clientes/<?php echo $pendiobliInfo->rfc;?>/<?php echo$pendiobliInfo->keyaar?>' style='cursor:pointer' download="<?php echo $pendiobliInfo->keyaar;?>"><i class='fa fa-file-code-o'></i></a></td>
                                                <?php 
                                                    /* converitimos la clave */
                                                    $calv = $pendiobliInfo->tdcla;
                                                    $key=hash('sha256', SECRET_KEY);
                                                    $iv=substr(hash('sha256', SECRET_IV), 0, 16);
                                                    $output=openssl_decrypt(base64_decode($calv), METHOD, $key, 0, $iv);
                                                ?>
                                                <td><?php echo $output;?></td>
                                                <td><div class="col-md-12 text-center"> <button class="btn btn-primary" data-toggle="modal" data-target="#terminarUno" data-unoo="<?= $pendiobliInfo->idActu; ?>" data-doss="<?= $pendiobliInfo->rfc; ?>" data-tress="<?= $pendiobliInfo->correo; ?>" style="width: 100% !important"> Terminar</button></div></td>
                                                <td><div class="col-md-12 text-center"> 
                                                <!-- validamos si ya se le envio el error -->
                                                <?php if($pendiobliInfo->estapara != 3){ ?>
                                                <!-- formulario para enviar cuando hay un error -->
                                                <form name="formularioGeneralNuevo" action="controlador/actualizaDasControlador.php" method="POST" enctype="multipart/form-data">
                                                    <input type='hidden' name='accion' id='accion' value='errorUno'>
                                                    <input type='hidden' name='idActu' id='idActu' value='<?= $pendiobliInfo->idActu; ?>'>
                                                    <input type='hidden' name='correo' id='correo' value='<?= $pendiobliInfo->correo; ?>'>
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#terminarDos" data-unoo="" data-doss="<?= $pendiobliInfo->rfc; ?>" data-tress="" style="width: 100% !important"> Error</button>
                                                </form>
                                                </div>
                                                <?php }?>
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- seccion de efirma -->
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Solicita</th>
                                            <th>Fecha Solicitud</th>
                                            <th>RFC</th>
                                            <th>Forma juridica</th>
                                            <th>CER</th>
                                            <th>KEY</th>
                                            <th>Clave</th>
                                            <th class="text-center">Terminar</th>
                                            <th class="text-center">Error</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($pendioefirmaInfo = $pendioefirma->fetch_object()){?>
                                            <tr>
                                                <td><?php echo $pendioefirmaInfo->nombre;?> <?php echo $pendioefirmaInfo->ape_paterno;?> <?php echo $pendioefirmaInfo->ape_materno;?></td>
                                                <td><?php echo $pendioefirmaInfo->fechaSolicitud;?></td>
                                                <td><?php echo $pendioefirmaInfo->rfc;?></td>
                                                <td><?php $gorma = ($pendioefirmaInfo->formaJuridica == 'f')?  "Persona Fisica" : "Persona moral"; echo $gorma;?></td>
                                                <td><a href='contenedor/clientes/<?php echo $pendioefirmaInfo->rfc;?>/<?php echo $pendioefirmaInfo->cerar;?>' style='cursor:pointer' download="<?php echo $pendioefirmaInfo->cerar;?>"><i class='fa fa-file-code-o'></i></a></td>
                                                <td><a href='contenedor/clientes/<?php echo $pendioefirmaInfo->rfc;?>/<?php echo$pendioefirmaInfo->keyaar?>' style='cursor:pointer' download="<?php echo $pendioefirmaInfo->keyaar;?>"><i class='fa fa-file-code-o'></i></a></td>
                                                <?php 
                                                    /* converitimos la clave */
                                                    $calv = $pendioefirmaInfo->tdcla;
                                                    $key=hash('sha256', SECRET_KEY);
                                                    $iv=substr(hash('sha256', SECRET_IV), 0, 16);
                                                    $output=openssl_decrypt(base64_decode($calv), METHOD, $key, 0, $iv);
                                                ?>
                                                <td><?php echo $output;?></td>
                                                <td><div class="col-md-12 text-center"> <button class="btn btn-primary" data-toggle="modal" data-target="#terminarDos" data-unoo="<?= $pendioefirmaInfo->idActu; ?>" data-doss="<?= $pendioefirmaInfo->rfc; ?>" data-tress="<?= $pendioefirmaInfo->correo; ?>" style="width: 100% !important"> Terminar</button></div></td>
                                                <td><div class="col-md-12 text-center"> 
                                                <!-- validamos si ya se le envio el error -->
                                                <?php if($pendioefirmaInfo->estapara != 3){ ?>
                                                <!-- formulario para enviar cuando hay un error -->
                                                <form name="formularioGeneralNuevo" action="controlador/actualizaDasControlador.php" method="POST" enctype="multipart/form-data">
                                                    <input type='hidden' name='accion' id='accion' value='errorDos'>
                                                    <input type='hidden' name='idActu' id='idActu' value='<?= $pendioefirmaInfo->idActu; ?>'>
                                                    <input type='hidden' name='correo' id='correo' value='<?= $pendioefirmaInfo->correo; ?>'>
                                                    <button class="btn btn-primary" type='submit'> Error</button>
                                                </form>
                                                </div>
                                                <?php }?>
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- seccion de suspencion de actividaedss -->
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">
                        <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Solicita</th>
                                            <th>Fecha Solicitud</th>
                                            <th>RFC</th>
                                            <th>Forma juridica</th>
                                            <th>CER</th>
                                            <th>KEY</th>
                                            <th>Clave</th>
                                            <th class="text-center">Terminar</th>
                                            <th class="text-center">Error</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($suspensionInfo = $suspension->fetch_object()){?>
                                            <tr>
                                                <td><?php echo $suspensionInfo->nombre;?> <?php echo $suspensionInfo->ape_paterno;?> <?php echo $suspensionInfo->ape_materno;?></td>
                                                <td><?php echo $suspensionInfo->fecha;?></td>
                                                <td><?php echo $suspensionInfo->rfc;?></td>
                                                <td><?php $gorma = ($suspensionInfo->formaJuridica == 'f')?  "Persona Fisica" : "Persona moral"; echo $gorma;?></td>
                                                <td><a href='contenedor/clientes/<?php echo $suspensionInfo->rfc;?>/<?php echo $suspensionInfo->cerar;?>' style='cursor:pointer' download="<?php echo $suspensionInfo->cerar;?>"><i class='fa fa-file-code-o'></i></a></td>
                                                <td><a href='contenedor/clientes/<?php echo $suspensionInfo->rfc;?>/<?php echo$suspensionInfo->keyaar?>' style='cursor:pointer' download="<?php echo $suspensionInfo->keyaar;?>"><i class='fa fa-file-code-o'></i></a></td>
                                                <?php 
                                                    /* converitimos la clave */
                                                    $calv = $suspensionInfo->tdcla;
                                                    $key=hash('sha256', SECRET_KEY);
                                                    $iv=substr(hash('sha256', SECRET_IV), 0, 16);
                                                    $output=openssl_decrypt(base64_decode($calv), METHOD, $key, 0, $iv);
                                                ?>
                                                <td><?php echo $output;?></td>
                                                <td><div class="col-md-12 text-center"> <button class="btn btn-primary" data-toggle="modal" data-target="#terminarTres" data-unoo="<?= $suspensionInfo->idActu; ?>" data-doss="<?= $suspensionInfo->rfc; ?>" data-tress="<?= $suspensionInfo->correo; ?>" style="width: 100% !important"> Terminar</button></div></td>
                                                <td><div class="col-md-12 text-center"> 
                                                <!-- validamos si ya se le envio el error -->
                                                <?php if($suspensionInfo->estapara != 3){ ?>
                                                <!-- formulario para enviar cuando hay un error -->
                                                <form name="formularioGeneralNuevo" action="controlador/actualizaDasControlador.php" method="POST" enctype="multipart/form-data">
                                                    <input type='hidden' name='accion' id='accion' value='errorTres'>
                                                    <input type='hidden' name='idActu' id='idActu' value='<?= $suspensionInfo->idActu; ?>'>
                                                    <input type='hidden' name='correo' id='correo' value='<?= $suspensionInfo->correo; ?>'>
                                                    <button class="btn btn-primary" type='submit'> Error</button>
                                                </form>
                                                </div>
                                                <?php }?>
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- cambio de domicilio -->
                    <div id="tab-4" class="tab-pane">
                    <div class="panel-body">
                        <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Solicita</th>
                                            <th>Dirección</th>
                                            <th>Estado</th>
                                            <th>Ciudad</th>
                                            <th>Municipio</th>
                                            <th>C.P</th>
                                            <th>Comprobante</th>
                                            <th>Fecha Solicitud</th>
                                            <th>RFC</th>
                                            <th>Forma juridica</th>
                                            <th>CER</th>
                                            <th>KEY</th>
                                            <th>Clave</th>
                                            <th class="text-center">Terminar</th>
                                            <th class="text-center">Error</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($domicilioInfo = $domicilio->fetch_object()){?>
                                            <tr>
                                                <td><?php echo $domicilioInfo->nombre;?> <?php echo $domicilioInfo->ape_paterno;?> <?php echo $domicilioInfo->ape_materno;?></td>
                                                
                                                <td><?php echo $domicilioInfo->dir1;?></td>
                                                <td><?php echo $domicilioInfo->esta1;?></td>
                                                <td><?php echo $domicilioInfo->ciud1;?></td>
                                                <td><?php echo $domicilioInfo->mun1;?></td>
                                                <td><?php echo $domicilioInfo->cp1;?></td>
                                                <td>
                                                <a href='contenedor/clientes/<?php echo $domicilioInfo->rfc;?>/<?php echo $domicilioInfo->compo1;?>' style='cursor:pointer' download="<?php echo $domicilioInfo->compo1;?>"><i class='fa fa-file-code-o'></i></a>
                                                </td>

                                                <td><?php echo $domicilioInfo->fechaSolicitud;?></td>
                                                <td><?php echo $domicilioInfo->rfc;?></td>
                                                <td><?php $gorma = ($domicilioInfo->formaJuridica == 'f')?  "Persona Fisica" : "Persona moral"; echo $gorma;?></td>
                                                <td><a href='contenedor/clientes/<?php echo $domicilioInfo->rfc;?>/<?php echo $domicilioInfo->cerar;?>' style='cursor:pointer' download="<?php echo $domicilioInfo->cerar;?>"><i class='fa fa-file-code-o'></i></a></td>
                                                <td><a href='contenedor/clientes/<?php echo $domicilioInfo->rfc;?>/<?php echo$domicilioInfo->keyaar?>' style='cursor:pointer' download="<?php echo $domicilioInfo->keyaar;?>"><i class='fa fa-file-code-o'></i></a></td>
                                                <?php 
                                                    /* converitimos la clave */
                                                    $calv = $domicilioInfo->tdcla;
                                                    $key=hash('sha256', SECRET_KEY);
                                                    $iv=substr(hash('sha256', SECRET_IV), 0, 16);
                                                    $output=openssl_decrypt(base64_decode($calv), METHOD, $key, 0, $iv);
                                                ?>
                                                <td><?php echo $output;?></td>
                                                <td><div class="col-md-12 text-center"> <button class="btn btn-primary" data-toggle="modal" data-target="#terminarCuatro" data-unoo="<?= $domicilioInfo->idActu; ?>" data-doss="<?= $domicilioInfo->rfc; ?>" data-tress="<?= $domicilioInfo->correo; ?>" style="width: 100% !important"> Terminar</button></div></td>
                                                <td><div class="col-md-12 text-center"> 
                                                <!-- validamos si ya se le envio el error -->
                                                <?php if($domicilioInfo->estapara != 3){ ?>
                                                <!-- formulario para enviar cuando hay un error -->
                                                <form name="formularioGeneralNuevo" action="controlador/actualizaDasControlador.php" method="POST" enctype="multipart/form-data">
                                                    <input type='hidden' name='accion' id='accion' value='errorCuatro'>
                                                    <input type='hidden' name='idActu' id='idActu' value='<?= $domicilioInfo->idActu; ?>'>
                                                    <input type='hidden' name='correo' id='correo' value='<?= $domicilioInfo->correo; ?>'>
                                                    <button class="btn btn-primary" type='submit'> Error</button>
                                                </form>
                                                </div>
                                                <?php }?>
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- seccion de cosntancia de obligaciones -->
                    <div id="tab-5" class="tab-pane">
                    <div class="panel-body">
                        <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Solicita</th>
                                            <th>Fecha Solicitud</th>
                                            <th>RFC</th>
                                            <th>Forma juridica</th>
                                            <th>CER</th>
                                            <th>KEY</th>
                                            <th>Clave</th>
                                            <th class="text-center">Terminar</th>
                                            <th class="text-center">Error</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($constanciaObliInfo = $constanciaObli->fetch_object()){?>
                                            <tr>
                                                <td><?php echo $constanciaObliInfo->nombre;?> <?php echo $constanciaObliInfo->ape_paterno;?> <?php echo $constanciaObliInfo->ape_materno;?></td>
                                                <td><?php echo $constanciaObliInfo->fecha;?></td>
                                                <td><?php echo $constanciaObliInfo->rfc;?></td>
                                                <td><?php $gorma = ($constanciaObliInfo->formaJuridica == 'f')?  "Persona Fisica" : "Persona moral"; echo $gorma;?></td>
                                                <td><a href='contenedor/clientes/<?php echo $constanciaObliInfo->rfc;?>/<?php echo $constanciaObliInfo->cerar;?>' style='cursor:pointer' download="<?php echo $constanciaObliInfo->cerar;?>"><i class='fa fa-file-code-o'></i></a></td>
                                                <td><a href='contenedor/clientes/<?php echo $constanciaObliInfo->rfc;?>/<?php echo$constanciaObliInfo->keyaar?>' style='cursor:pointer' download="<?php echo $constanciaObliInfo->keyaar;?>"><i class='fa fa-file-code-o'></i></a></td>
                                                <?php 
                                                    /* converitimos la clave */
                                                    $calv = $constanciaObliInfo->tdcla;
                                                    $key=hash('sha256', SECRET_KEY);
                                                    $iv=substr(hash('sha256', SECRET_IV), 0, 16);
                                                    $output=openssl_decrypt(base64_decode($calv), METHOD, $key, 0, $iv);
                                                ?>
                                                <td><?php echo $output;?></td>
                                                <td><div class="col-md-12 text-center"> <button class="btn btn-primary" data-toggle="modal" data-target="#terminarCinco" data-unoo="<?= $constanciaObliInfo->idActu; ?>" data-doss="<?= $constanciaObliInfo->rfc; ?>" data-tress="<?= $constanciaObliInfo->correo; ?>" style="width: 100% !important"> Terminar</button></div></td>
                                                <td><div class="col-md-12 text-center"> 
                                                <!-- validamos si ya se le envio el error -->
                                                <?php if($constanciaObliInfo->estapara != 3){ ?>
                                                <!-- formulario para enviar cuando hay un error -->
                                                <form name="formularioGeneralNuevo" action="controlador/actualizaDasControlador.php" method="POST" enctype="multipart/form-data">
                                                    <input type='hidden' name='accion' id='accion' value='errorCinco'>
                                                    <input type='hidden' name='idActu' id='idActu' value='<?= $constanciaObliInfo->idActu; ?>'>
                                                    <input type='hidden' name='correo' id='correo' value='<?= $constanciaObliInfo->correo; ?>'>
                                                    <button class="btn btn-primary" type='submit'> Error</button>
                                                </form>
                                                </div>
                                                <?php }?>
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- defuncion -->
                    <div id="tab-6" class="tab-pane">
                    <div class="panel-body">
                        <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Solicita</th>
                                            <th>Fecha Solicitud</th>
                                            <th>RFC</th>
                                            <th>Forma juridica</th>
                                            <th>CER</th>
                                            <th>KEY</th>
                                            <th>Clave</th>
                                            <th class="text-center">Terminar</th>
                                            <th class="text-center">Error</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($defuncionInfo = $defuncion->fetch_object()){?>
                                            <tr>
                                                <td><?php echo $defuncionInfo->nombre;?> <?php echo $defuncionInfo->ape_paterno;?> <?php echo $defuncionInfo->ape_materno;?></td>
                                                <td><?php echo $defuncionInfo->fecha;?></td>
                                                <td><?php echo $defuncionInfo->rfc;?></td>
                                                <td><?php $gorma = ($defuncionInfo->formaJuridica == 'f')?  "Persona Fisica" : "Persona moral"; echo $gorma;?></td>
                                                <td><a href='contenedor/clientes/<?php echo $defuncionInfo->rfc;?>/<?php echo $defuncionInfo->cerar;?>' style='cursor:pointer' download="<?php echo $defuncionInfo->cerar;?>"><i class='fa fa-file-code-o'></i></a></td>
                                                <td><a href='contenedor/clientes/<?php echo $defuncionInfo->rfc;?>/<?php echo$defuncionInfo->keyaar?>' style='cursor:pointer' download="<?php echo $defuncionInfo->keyaar;?>"><i class='fa fa-file-code-o'></i></a></td>
                                                <?php 
                                                    /* converitimos la clave */
                                                    $calv = $defuncionInfo->tdcla;
                                                    $key=hash('sha256', SECRET_KEY);
                                                    $iv=substr(hash('sha256', SECRET_IV), 0, 16);
                                                    $output=openssl_decrypt(base64_decode($calv), METHOD, $key, 0, $iv);
                                                ?>
                                                <td><?php echo $output;?></td>
                                                <td><div class="col-md-12 text-center"> <button class="btn btn-primary" data-toggle="modal" data-target="#terminarSeis" data-unoo="<?= $defuncionInfo->idActu; ?>" data-doss="<?= $defuncionInfo->rfc; ?>" data-tress="<?= $defuncionInfo->correo; ?>" style="width: 100% !important"> Terminar</button></div></td>
                                                <td><div class="col-md-12 text-center"> 
                                                <!-- validamos si ya se le envio el error -->
                                                <?php if($defuncionInfo->estapara != 3){ ?>
                                                <!-- formulario para enviar cuando hay un error -->
                                                <form name="formularioGeneralNuevo" action="controlador/actualizaDasControlador.php" method="POST" enctype="multipart/form-data">
                                                    <input type='hidden' name='accion' id='accion' value='errorSeis'>
                                                    <input type='hidden' name='idActu' id='idActu' value='<?= $defuncionInfo->idActu; ?>'>
                                                    <input type='hidden' name='correo' id='correo' value='<?= $defuncionInfo->correo; ?>'>
                                                    <button class="btn btn-primary" type='submit'> Error</button>
                                                </form>
                                                </div>
                                                <?php }?>
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
    </div>
</div><br><hr>
<!-- seccion para los modals -->
<!-- //////////////////////////////////////////////modals para oblicaciones fiscales ///////////////////////////////////////////////////-->
<!--modal para anuevo clientes-->
<div class="modal inmodal fade" id="terminarUno" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>
			<div class="modal-body">
                <div>
                <h4>Para finalizar favor de ingresar el comprobante</h4><hr>
                <div class="form-group">
                     <form name="formularioGeneralNuevo" action="controlador/actualizaDasControlador.php" method="POST" enctype="multipart/form-data">
                        <input type='hidden' name='accion' id='accion' value='terminarUno'>
                        <input type='text' name='idActu' id='idActu' value=''>
                        <input type='text' name='rfcCli' id='rfcCli' value=''>
                        <input type='text' name='correo' id='correo' value=''>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group m-b">
                                    <span class="input-group-addon">Comprobante</span> 
                                    <input type="file" name="documento" id="documento" class="form-control" >
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
				<hr>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Terminar actualización</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- modal para actualziacion efirma -->
<div class="modal inmodal fade" id="terminarDos" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>
			<div class="modal-body">
                <div>
                <h4>Para finalizar favor de ingresar el comprobante de efirma</h4><hr>
                <div class="form-group">
                     <form name="formularioGeneralNuevo" action="controlador/actualizaDasControlador.php" method="POST" enctype="multipart/form-data">
                        <input type='hidden' name='accion' id='accion' value='terminarDos'>
                        <input type='text' name='idActu' id='idActu' value=''>
                        <input type='text' name='rfcCli' id='rfcCli' value=''>
                        <input type='text' name='correo' id='correo' value=''>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group m-b">
                                    <span class="input-group-addon">Comprobante</span> 
                                    <input type="file" name="documento" id="documento" class="form-control" >
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
				<hr>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Terminar actualización</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- modal para actualziacion de suspencion -->
<div class="modal inmodal fade" id="terminarTres" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>
			<div class="modal-body">
                <div>
                <h4>Para finalizar favor de ingresar el comprobante de efirma</h4><hr>
                <div class="form-group">
                     <form name="formularioGeneralNuevo" action="controlador/actualizaDasControlador.php" method="POST" enctype="multipart/form-data">
                        <input type='hidden' name='accion' id='accion' value='terminarTres'>
                        <input type='text' name='idActu' id='idActu' value=''>
                        <input type='text' name='rfcCli' id='rfcCli' value=''>
                        <input type='text' name='correo' id='correo' value=''>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group m-b">
                                    <span class="input-group-addon">Comprobante</span> 
                                    <input type="file" name="documento" id="documento" class="form-control" >
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
				<hr>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Terminar actualización</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- modal para actualziacion de constancia de obligacion -->
<div class="modal inmodal fade" id="terminarCinco" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>
			<div class="modal-body">
                <div>
                <h4>Para finalizar favor de ingresar el comprobante de constancia de obligaciones</h4><hr>
                <div class="form-group">
                     <form name="formularioGeneralNuevo" action="controlador/actualizaDasControlador.php" method="POST" enctype="multipart/form-data">
                        <input type='hidden' name='accion' id='accion' value='terminarCinco'>
                        <input type='text' name='idActu' id='idActu' value=''>
                        <input type='text' name='rfcCli' id='rfcCli' value=''>
                        <input type='text' name='correo' id='correo' value=''>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group m-b">
                                    <span class="input-group-addon">Comprobante</span> 
                                    <input type="file" name="documento" id="documento" class="form-control" >
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
				<hr>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Terminar actualización</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- modal para actualziacion de constancia de obligacion -->
<div class="modal inmodal fade" id="terminarSeis" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>
			<div class="modal-body">
                <div>
                <h4>Para finalizar favor de ingresar el comprobante de defuncion</h4><hr>
                <div class="form-group">
                     <form name="formularioGeneralNuevo" action="controlador/actualizaDasControlador.php" method="POST" enctype="multipart/form-data">
                        <input type='hidden' name='accion' id='accion' value='terminarSeis'>
                        <input type='text' name='idActu' id='idActu' value=''>
                        <input type='text' name='rfcCli' id='rfcCli' value=''>
                        <input type='text' name='correo' id='correo' value=''>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group m-b">
                                    <span class="input-group-addon">Comprobante</span> 
                                    <input type="file" name="documento" id="documento" class="form-control" >
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
				<hr>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Terminar actualización</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- modal para actualziacion de constancia de obligacion -->
<div class="modal inmodal fade" id="terminarCuatro" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>
			<div class="modal-body">
                <div>
                <h4>Para finalizar favor de ingresar el cambio de domicilio</h4><hr>
                <div class="form-group">
                     <form name="formularioGeneralNuevo" action="controlador/actualizaDasControlador.php" method="POST" enctype="multipart/form-data">
                        <input type='hidden' name='accion' id='accion' value='terminarCuatro'>
                        <input type='text' name='idActu' id='idActu' value=''>
                        <input type='text' name='rfcCli' id='rfcCli' value=''>
                        <input type='text' name='correo' id='correo' value=''>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group m-b">
                                    <span class="input-group-addon">Comprobante</span> 
                                    <input type="file" name="documento" id="documento" class="form-control" >
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
				<hr>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Terminar actualización</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

