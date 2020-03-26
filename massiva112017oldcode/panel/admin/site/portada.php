<?php 
    include 'modelo/consultaTablas.php';
	$id_usuario = $_SESSION['id_usuario'];
    $soporte = new consultaTabla();
    
    $ingresosValor = $soporte->ingresosValor($id_usuario);
	$ingresosValorInfo = $ingresosValor->fetch_object();
    $ingresoTotal = $ingresosValorInfo->total;
    $ingresoTotal = ($ingresoTotal == '')? 0 : $ingresoTotal;


	$egresosValor = $soporte->egresosValor($id_usuario);
	$egresosValorInfo = $egresosValor->fetch_object();
    $egresoTotal = $egresosValorInfo->total;
    $egresoTotal = ($egresoTotal == '')? 0 : $egresoTotal;

	$completoValor = $soporte->completoValor($id_usuario);
	$completoValorInfo = $completoValor->fetch_object();
    $totaltotal = $completoValorInfo->total;
    $totaltotal = ($totaltotal == '')? 0 : $totaltotal;
    
    /* obtenemos el paquete seleccioando por el cliente */
    $paqueteSelec = $soporte->paqueteSelec($id_usuario);
    $paqueteSelecInfo = $paqueteSelec->fetch_object();
    $nombPaquete = $paqueteSelecInfo->nombre;
    $fechbPaquete = $paqueteSelecInfo->fechaSeleccion;
    $monPaquete = $paqueteSelecInfo->montoM;

?>
<script>
$(function () {
   
    var doughnutData = {
        labels: ["Ingresos","Gastos" ],
        datasets: [{
            data: [<?= $ingresoTotal;?>,<?= $egresoTotal?>],
            backgroundColor: ["#eac52d","#5b5b5f"]
        }]
	} ;
	
    var doughnutOptions = { responsive: true };
    var ctx4 = document.getElementById("doughnutChart").getContext("2d");
    new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

	/* segunda grafica total */
	var doughnutData1 = {
        labels: ["Total" ],
        datasets: [{
            data: [<?= $totaltotal;?>],
            backgroundColor: ["#eac52d"]
        }]
	} ;

	var doughnutOptions1 = { responsive: true };
    var ctx41 = document.getElementById("doughnutChart2").getContext("2d");
    new Chart(ctx41, {type: 'doughnut', data: doughnutData1, options:doughnutOptions1});
   

});
</script>  

<div class="row">
    <div class="col-md-12 text-right">
        <?php if($_SESSION['VALPAQ'] != 1){?>
        <a  href="index.php?secc=moviConta"><button type="button" class="btn btn-outline btn-primary"><b>Pagar impuestos </button></a>
        <?php }?>
        <!-- boton para mostrar los paquetes contratados -->
        <?php if($_SESSION['formaJuridica'] == 'f'){?>

        <button type="button" class="btn btn-outline btn-default"><b>Plan contratado massiva: </b> <?=$nombPaquete;?> $<?=$monPaquete;?> | <small>Fecha de corte: <b><?= $fechbPaquete; ?></b> </small></button>
        
        <?php }else{?>
        <button type="button" class="btn btn-outline btn-default"><b>Cálculo inicial registrado: </b> $10,000 | <b>Pago anterior:</b> $10,000</button>
        <?php }?>

    </div>
</div>
<div class="row"><div class="col-md-12"><br></div></div>

<!-- logo de massiva -->
<div class="row  border-bottom white-bg dashboard-header"><div class="col-md-12 text-center"><img src="img/logo.png" style='height: 70px'></div></div>

<!--seccion de contador-->
<div class="row">
    
	<!--botones de status del sat-->
	<div class="tooltip-demo">
        
        <div class="col-lg-4"></div>
		<div class="col-lg-4" class="btn btn-primary" style="cursor:pointer"  data-toggle="popover" data-placement="auto bottom" data-content="¡Felicidades! Estás al día ante el SAT. No te preocupes si te llegan correos por el buzón tributario, es sólo informativo. ">
			<div class="widget style1 navy-bg" style='background-color:#eac52d' id="step3">
				<div class="row">
					<div class="col-xs-8 text-center" style='align-botton:center' >
						<span style='font-size:20px;'> <b>Status ante <br>el SAT </b></span>
					</div>
					<div class="col-xs-4"><i class="fa fa-check-circle fa-5x"></i></div>
				</div>
			</div>
		</div>
		
		<!--div class="col-lg-2" class="btn btn-primary" style="cursor:pointer"  data-toggle="popover" data-placement="auto bottom" data-content="Tienes algunos asuntos pendientes ante el SAT. Revisa tus notificaciones de massiva atrasadas. Estamos a tiempo de darle solución.">
			<div class="widget style1 navy-bg" style='background-color:#fe0002'>
				<div class="row">
					<div class="col-xs-8 text-center" style='align-botton:center'>
						<span style='font-size:20px;'> <b>Status ante <br>el SAT </b></span>
					</div>
					<div class="col-xs-4"><i class="fa fa-times-circle fa-5x"></i></div>
				</div>
			</div>
		</div>
		
		<div class="col-lg-2" class="btn btn-primary" style="cursor:pointer"  data-toggle="popover" data-placement="auto bottom" data-content="Tienes asuntos pendientes que debemos solucionar cuanto antes para no generarte complicaciones ante el SAT. Revisa todas las notificaciones ahora. Evitemos problemas ante el SAT.">
			<div class="widget style1 navy-bg" style='background-color:#ece417'>
				<div class="row">
					<div class="col-xs-8 text-center" style='align-botton:center'>
						<span style='font-size:20px;'> <b>Status ante <br>el SAT </b></span>
					</div>
					<div class="col-xs-4"><i class="fa fa-exclamation-circle fa-5x"></i></div>
				</div>
			</div>
		</div-->
		
	</div>
<!--termina la seccion de los botones del sat-->	
	
    <div class="col-lg-4"></div>
</div>
<hr>
<?php if($_SESSION['VALPAQ'] != 1){?>
 <div class="row">  
    <div class="col-lg-4" >
        <a href="index.php?secc=misclientes" id="step5">
        <div class="widget style1 navy-bg" style="background-color:  !important">
            <div class="row"><div class="col-xs-12 text-center"><span style='font-size:20px;'> Solicitar factura </span></div></div>
        </div></a>
    </div>
    
    <div class="col-lg-4">
         <a href="index.php?secc=ticketusu" id='step6'><div class="widget style1 navy-bg" style="background-color:#878991  !important">
            <div class="row">
                <div class="col-xs-12 text-center"><span style='font-size:20px;'> Facturar tickets de compra</span></div>
            </div>
        </div></a>
    </div>

    <div class="col-lg-4">
         <a href="index.php?secc=cotizacion"><div class="widget style1 navy-bg" style="background-color:  !important">
            <div class="row">
                <div class="col-xs-12 text-center"><span style='font-size:20px;'> Hacer cotización </span></div>
            </div>
        </div></a>
    </div>
    
	<div class="col-lg-4" id="step5">
		 <a href="index.php?secc=misclientes" >
            <div class="widget style1 navy-bg" style="background-color: #878991 !important" >
			<div class="row" >
				<div class="col-xs-12 text-center"><span style='font-size:20px;'> Nuevo cliente</span></div>
			</div>
		</div></a>
	</div>
	
	<div class="col-lg-4">
		 <a href="index.php?secc=misproveedores"><div class="widget style1 navy-bg" >
			<div class="row">
				<div class="col-xs-12 text-center"><span style='font-size:20px;'> Nuevo proveedor </span></div>
			</div>
		</div></a>
	</div>
	
    <div class="col-lg-4">
         <a href="index.php?secc=inventario"><div class="widget style1 navy-bg" style="background-color: #878991  !important">
            <div class="row">
                <div class="col-xs-12 text-center"><span style='font-size:20px;'>Servicios | Productos</span></div>
            </div>
        </div></a>
    </div>
    
</div>
<?php }?>
<div class="row">
    
    <div class='col-md-6'>
        <div class="ibox">
            <div class="ibox-content text-center">
                    <div class="ibox float-e-margins">
                    <div><canvas id="doughnutChart" height="60" ></canvas></div>
                </div>
            </div>
        </div>
    </div>

    <div class='col-md-6' >
        <div class="ibox">
            <div class="ibox-content text-center">
                    <div class="ibox float-e-margins">
                    <div><canvas id="doughnutChart2" height="60" ></canvas></div>
                </div>
            </div>
        </div>
    </div>

</div>

<hr>

<hr>

   