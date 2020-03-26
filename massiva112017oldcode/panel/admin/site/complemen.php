<?php 
    include 'modelo/consultaTablas.php';
    $soporte = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
    $fechaCreacion = date("Y-m-d");

    //consultas de persona fisica
    $uno = $soporte->conatrapfUno();
    $dos = $soporte->conatrapfDos();
    $tres = $soporte->conatrapfTres();

 ?>
 <script src="js/vista/activos.js"></script>
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
        <div class="col-lg-12">

            <div class="ibox">
                <div class="ibox-content">
                    <h3>Complementarias</h3>
                    <button type="button" class="btn btn-outline btn-default"><b>Solicitudes totales: </b> 10,000 </button><br>
                    <div class="ibox ">

                            <div class="dd" id="nestable2">
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="1">
                                        <div class="dd-handle">
                                            <h3><b>Interés</b></h3> <span style="color: #f1005e;" class="text-right"><h4> 30 solicitudes</h4></span>
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
                                        	<h3><b>Arrendamiento</b></h3> <span style="color: #f1005e;" class="text-right"><h4> 30 solicitudes</h4></span>
                                            
                                        </div>
                                        <ul class="sortable-list connectList agile-list" id="todo">
					                        <li class="warning-element" id="task1">
					                            HEVA870404MP6
					                            <div class="agile-detail">
					                                <a href="#" class="pull-right btn btn-xs btn-primary">Atender</a>
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
    </div>
</div><br><hr>


     