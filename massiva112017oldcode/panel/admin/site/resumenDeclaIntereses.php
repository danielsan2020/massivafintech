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
		<div class="title-action"><a href="index.php?secc=dascontaFDeclaIntereses" class="btn btn-primary" > Regresar</a></div>
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
        <div class="col-lg-4">

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
        
        <div class="col-lg-4">

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

        <div class="col-lg-4">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Total ISR retenido (acumula)</h3>
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
                <li class="warning-element" id="task1"> <b>ISR</b></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">

            <div class="ibox">
                <div class="ibox-content">
                    
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
                   
                    <h3>ISR retenido del periodo(acumula)</h3>
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
      
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h3>Saldo a favor de ISR(acumula)</h3>
                    <ul class="list-group">
                        <li class="list-group-item"><span class="badge">14</span>Se saca de las declaraciones anuales anteriores</li>
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
                             iSR determinado - isr retenido del periodo - saldo a favor = total a pagar si sale negativo en a favor si es positivo es a pagar
                        </li>
                    </ul>
                    <hr>
                </div>
            </div>
        </div>
       
        
      
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


     