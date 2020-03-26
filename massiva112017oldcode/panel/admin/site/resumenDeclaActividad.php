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
	<div class="col-md-12">
		<div class="title-action"><a href="index.php?secc=dascontaFDeclaActividad" class="btn btn-primary" > Regresar</a></div>
	</div>
</div>
<div class="row">
    <div class="alert alert-warning text-center">
        RFC: | Actividad: | Régimen: | ejercicio | periodo
    </div>
</div>
<!--seccion de contenido-->
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Ingresos <small>(facturas emitidas cobradas seleccionadas con afterbank)</small></h3><!--Todo entra-->
                    <ul class="sortable-list connectList agile-list" id="todo">
                        <li class="warning-element" id="task1"> HEVA870404MP6 |Cuenta: |Fecha: | Monto: </li>
                        <li class="warning-element" id="task1"> HEVA870404MP6 |Cuenta: |Fecha: | Monto: </li>
                        <li class="warning-element" id="task1"> HEVA870404MP6 |Cuenta: |Fecha: | Monto: </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Egreso <small>(En afterbak categorizo en ingresos pagado)</small></h3>
                    <ul class="sortable-list connectList agile-list" id="todo">
                        <li class="warning-element" id="task1"> 
                            HEVA870404MP6 |Razón social | Impuesto: | Cuenta contable: | Fecha: | Monto: 
                            <a href="index.php?secc=dascontaFDecla" class="pull-right btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
                            <a href="index.php?secc=dascontaFDecla" class="pull-right btn btn-xs btn-primary">No deducible</a>
                            <a href="index.php?secc=dascontaFDecla" class="pull-right btn btn-xs btn-primary">Deducible</a>
                            <a href="index.php?secc=dascontaFDecla" class="pull-right btn btn-xs btn-primary">Deducible parcial</a>
                        </li>
                         <li class="warning-element" id="task1"> 
                            HEVA870404MP6 |Razón social | Impuestos: | Cuenta contable: | Fecha: | Monto: 
                            <a href="index.php?secc=dascontaFDecla" class="pull-right btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
                            <a href="index.php?secc=dascontaFDecla" class="pull-right btn btn-xs btn-primary">No deducible</a>
                            <a href="index.php?secc=dascontaFDecla" class="pull-right btn btn-xs btn-primary">Deducible</a>
                            <a href="index.php?secc=dascontaFDecla" class="pull-right btn btn-xs btn-primary">Deducible parcial</a>
                        </li>
                         <li class="warning-element" id="task1"> 
                            HEVA870404MP6 |Razón social | Impuestos: | Cuenta contable: | Fecha: | Monto: 
                            <a href="index.php?secc=dascontaFDecla" class="pull-right btn btn-xs btn-primary"><i class="fa fa-search"></i></a>
                            <a href="index.php?secc=dascontaFDecla" class="pull-right btn btn-xs btn-primary">No deducible</a>
                            <a href="index.php?secc=dascontaFDecla" class="pull-right btn btn-xs btn-primary">Deducible</a>
                            <a href="index.php?secc=dascontaFDecla" class="pull-right btn btn-xs btn-primary">Deducible parcial</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">

            <div class="ibox">
                <div class="ibox-content">
                    <h3>Total ingresos (este valro se guarda cada mes)</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            Total
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Total iva cobrado</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            Total
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3">

            <div class="ibox">
                <div class="ibox-content">
                    <h3>Total egresos (esto se guarda cada mes)</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            Total
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Total iva pagado</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            Total
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    
    <hr>


    <div class="row">
        <div class="col-lg-6"><h3>Calculo de impuestos</h3></div>
    </div>
    <div class="row">
        <div class="col-md-12">
             <ul class="sortable-list connectList agile-list" id="todo">
                <li class="warning-element" id="task1"> <b>IVA</b></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">

            <div class="ibox">
                <div class="ibox-content">
                    <h3>Pago de iva</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><span class="badge">14</span>Iva cobrado -</li>
                        <li class="list-group-item"><span class="badge">14</span>Iva retenido -</li>
                        <li class="list-group-item"><span class="badge">14</span>Iva pagado -</li>
                        <li class="list-group-item"><span class="badge">14</span>Total a paga (sale negativo guardar a iva a favor) si no ponerlo en cero</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Iva a favor</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            Total si es negativo el otro
                        </li>
                    </ul>
                    <hr>
                    <h3>Iva a cargo</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            Total si aqui es psotivo
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Iva a favor meses anteriores</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            Total (este es el iva anterior)
                        </li>
                    </ul>
                    <hr>
                    <h3>Iva a favor aplicable</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            aqui va el valor del iva a cargo si tengo algo en el iva a favor en meses interiores mayor a iva a cargo
                        </li>
                    </ul>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Iva a pagar</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            Total ( si iva a favor tiene valor poner cero
                            si no es iva a cargo menors iva a favor aplicable)
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
             <ul class="sortable-list connectList agile-list" id="todo">
                <li class="warning-element" id="task1"> <b>ISR</b></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">

            <div class="ibox">
                <div class="ibox-content">
                    <h3>Ingresos acumulados de periodos anteriores (este valor es total ingresos guardarlos para que se vallan acumulador )(1)(acumula)</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><span class="badge">14</span>Iva cobrado</li>
                    </ul>
                    <hr>
                    <h3>Ingresos del periodo (que es total de ingresos)(2)</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            Total si es negativo el otro
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Deducciones acumuladas de periodos anteriores (3)</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            Total si aqui es psotivo
                        </li>
                    </ul>
                    <hr>
                    <h3>Deducciones del periodo(4)(acumula)</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            Total si aqui es psotivo
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Base para calculo de ISR</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            Total (1+2-3-4)
                        </li>
                    </ul>
                    <hr>
                    <h3>ISR determinado</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                            (este es el que anote en la libre)
                        </li>
                    </ul>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Pagos provisionales realizados con anterioridad(acumula)</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><span class="badge">14</span>esto es el acomulador de que se paga con anteriores del isr en el sat</li>
                    </ul>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Total a pagar</h3>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">14</span>
                             si el ISR determinado - isr retenido de perido retenido -isr del periodo - Pagos provisionales realizados con anterioridad =9 si da positivo es ponerlo si da negativo cero 
                        </li>
                    </ul>
                    <hr>
                </div>
            </div>
        </div>
       
      
    </div>
    <div class="row">
        
        
      
    </div>

    <hr>

     <div class="row">
        <div class="col-md-6">
            <a href="index.php?secc=dascontaFDecla" class="btn btn-primary" style='width: 100%' > Copiar CIEC</a>
        </div>
        <div class="col-md-6">
            <a href="https://loginda.siat.sat.gob.mx/nidp/wsfed/ep?id=ciec&sid=0&option=credential&sid=0" target="_blank" class="btn btn-primary" style='width: 100%' > Ir al SAT</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <a href="index.php?secc=dascontaFDecla" class="btn btn-primary" style='width: 100%' > Terminar</a>
        </div>
    </div>

</div><br><hr>


     