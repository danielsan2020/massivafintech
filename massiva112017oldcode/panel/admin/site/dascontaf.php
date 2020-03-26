<?php 
    
    include 'modelo/consultaTablas.php';
    $soporte = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
    $fechaCreacion = date("Y-m-d");

    
    /* consultamos las tablas para mostrar los numeros de la contabilidad atrasada  */
    /* usuarios sin registro */
    $uno = $soporte->contaatraSinregistro();
    $unoInfo = $uno->fetch_object();
    $totalUno = $unoInfo->tolta;

    /* usuario registrado */
    $dos = $soporte->contaatraConregis();
    $totalDos = 0;
    while($dosInfo = $dos->fetch_object()){
        $rfcConsu = $dosInfo->rfc;
        /* despues verificamos si ya esta en la tala de contabilidad atrasada */
        $dosDos = $soporte->verifiConFisicAtraCon($rfcConsu);
        $dosDosIndo = $dosDos->fetch_object();
        $totalD = $dosDosIndo->idContaAtrasada;
        if($totalD != ''){
            $totalDos = $totalDos + 1;
        }
    }


    /* usuario registrado con contabilidad en proceso */
    $tres = $soporte->contaatraProceso();
    $tresInfo = $tres->fetch_object();
    $totalTres = $tresInfo->tolta;

 ?>
 
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
<!--seccion de contenido-->
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <!-- seccion de contabilidad al dia por tipo de regimen -->
        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Contabilidad al día</h3>
                    <button type="button" class="btn btn-outline btn-default"><b>Solicitudes totales: </b> 10,000 </button>
                    <div class="ibox ">
                        <div class="dd" id="nestable2">
                                <ol class="dd-list">
                                    
                                    <li class="dd-item" data-id="1">
                                        <div class="dd-handle">
                                            <h3><b>Interés</b></h3> <span style="color: #f1005e;" class="text-right"><h4> 30 solicitudes</h4></span><!----*-->
                                        </div>
                                         <ul class="sortable-list connectList agile-list" id="todo">
                                            <li class="warning-element" id="task1">
                                                HEVA870404MP6
                                                <div class="agile-detail">
                                                    <a href="index.php?secc=dascontaFDeclaIntereses" class="pull-right btn btn-xs btn-primary">Atender</a>
                                                    <i class="fa fa-clock-o"></i> 12.10.2015
                                                </div>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="dd-item" data-id="5">
                                        <div class="dd-handle">
                                            <h3><b>Arrendamiento</b></h3> <span style="color: #f1005e;" class="text-right"><h4> 30 solicitudes</h4></span><!----*-->
                                            
                                        </div>
                                        <ul class="sortable-list connectList agile-list" id="todo">
                                            <li class="warning-element" id="task1">
                                                HEVA870404MP6
                                                <div class="agile-detail">
                                                    <a href="index.php?secc=dascontaFDeclaArrendamiento" class="pull-right btn btn-xs btn-primary">Atender</a>
                                                    <i class="fa fa-clock-o"></i> 12.10.2015
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dd-item" data-id="5">
                                        <div class="dd-handle">
                                            <h3><b>Asalariados</b></h3> <span style="color: #f1005e;" class="text-right"><h4> 30 solicitudes</h4></span><!----*-->
                                        </div>
                                        <ul class="sortable-list connectList agile-list" id="todo">
                                            <li class="warning-element" id="task1">
                                                HEVA870404MP6
                                                <div class="agile-detail">
                                                    <a href="index.php?secc=dascontaFDeclaIntereses" class="pull-right btn btn-xs btn-primary">Atender</a>
                                                    <i class="fa fa-clock-o"></i> 12.10.2015
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dd-item" data-id="5">
                                        <div class="dd-handle">
                                            <h3><b>Servicios profesionales</b></h3> <span style="color: #f1005e;" class="text-right"><h4> 30 solicitudes</h4></span><!----*-->
                                            
                                        </div>
                                        <ul class="sortable-list connectList agile-list" id="todo">
                                            <li class="warning-element" id="task1">
                                                HEVA870404MP6
                                                <div class="agile-detail">
                                                    <a href="index.php?secc=dascontaFDecla" class="pull-right btn btn-xs btn-primary">Atender</a>
                                                    <i class="fa fa-clock-o"></i> 12.10.2015
                                                </div>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="dd-item" data-id="5">
                                        <div class="dd-handle">
                                            <h3><b>RIF</b></h3> <span style="color: #f1005e;" class="text-right"><h4> 30 solicitudes</h4></span>
                                            
                                        </div>
                                        <ul class="sortable-list connectList agile-list" id="todo">
                                            <li class="warning-element" id="task1">
                                                HEVA870404MP6
                                                <div class="agile-detail">
                                                    <a href="index.php?secc=dascontaFDecla" class="pull-right btn btn-xs btn-primary">Atender</a>
                                                    <i class="fa fa-clock-o"></i> 12.10.2015
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    
                                    <li class="dd-item" data-id="5">
                                        <div class="dd-handle">
                                            <h3><b>Actividad empresarial</b></h3> <span style="color: #f1005e;" class="text-right"><h4> 30 solicitudes</h4></span><!----*-->
                                            
                                        </div>
                                        <ul class="sortable-list connectList agile-list" id="todo">
                                            <li class="warning-element" id="task1">
                                                HEVA870404MP6
                                                <div class="agile-detail">
                                                    <a href="index.php?secc=dascontaFDeclaActividad" class="pull-right btn btn-xs btn-primary">Atender</a>
                                                    <i class="fa fa-clock-o"></i> 12.10.2015
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ol>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- seccion de cotnabilidad atrasa -->
        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Contabilidad atrasada</h3>

                    <ul class="sortable-list connectList agile-list">
                        <a href="index.php?secc=contaAtrasadaFUno" style='color:#727277;' >
                            <li class="warning-element">
                                Solicitudes sin registro total: <?php echo $totalUno;?><br>
                            </li>
                        </a>
                        <a href="index.php?secc=contaAtrasadaFDos" style='color:#727277;' >
                            <li class="warning-element">
                                Solicitudes para análisis: <?php echo $totalDos;?>
                            </li>
                        </a>
                        <a href="index.php?secc=contaAtrasadaFTres" style='color:#727277;' >
                            <li class="warning-element">
                                Solicitudes ejecutando total: <?php echo $totalTres;?>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><br><hr>
