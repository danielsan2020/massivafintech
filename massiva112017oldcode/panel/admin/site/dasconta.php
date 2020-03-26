<?php 
	
	include 'modelo/consultaTablas.php';
    $soporte = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
    $fechaCreacion = date("Y-m-d");

    //consultas de persona fisica
	$uno = $soporte->totalClientes();
	$unoInfo = $uno->fetch_object();
	$totalClientes = $unoInfo->total;

	/* contuls ade tickets */
	$dos = $soporte->totalTijke();
	$dosInfo = $dos->fetch_object();
	$totalTick = $dosInfo->total;


 ?>
 <script src="js/vista/activos.js"></script>
 <div class="row  border-bottom white-bg dashboard-header">
	<div class="col-md-12 text-center">
		<img src="img/logo.png" style='height: 70px'>
	</div>
</div>
<div class="row">
	<div class="alert alert-warning text-center">
		<h4><b>Administrador contable</b></h4>
	</div>
</div>
<!--seccion de contenido-->
<div class="wrapper wrapper-content">
	<div class="row">  
	    <div class="col-lg-3" ></div>
	    <div class="col-lg-6" >
	        <a href="index.php?secc=dascontaf"><div class="widget style1 navy-bg" style="background-color:  !important">
	            <div class="row">
	                <div class="col-xs-12 text-center">
	                    <span style='font-size:20px;'> Personas Físicas</span>
	                </div>
	            </div>
	        </div></a>
	    </div>
	
	
	    <!--div class="col-lg-3" >
	        <a href="index.php?secc=dascontaM" id="step5"><div class="widget style1 navy-bg" style="background-color:  !important">
	            <div class="row">
	                
	                <div class="col-xs-12 text-center">
	                    <span style='font-size:20px;'> Personas Morales</span>
	                </div>
	            </div>
	        </div></a>
	    </div-->
	    <div class="col-lg-3" ></div>
	</div>
	
	<hr>
	<div class="row">  
	    
	    <div class="col-lg-4 text-center" >
	    	<button type="button" class="btn btn-outline btn-default"><b>Solicitudes totales: </b> <?php echo $totalTick;?> </button>
	        <a href="index.php?secc=ticketConta" id="step5"><div class="widget style1 navy-bg" style="background-color:  !important">
	            <div class="row">
	        		        
	                <div class="col-xs-12 text-center">
	                    <span style='font-size:20px;'> Tickets de compra</span>
	                </div>
	            </div>
	        </div></a>
	    </div>
	
	
	    <div class="col-lg-4 text-center" >
	    	<button type="button" class="btn btn-outline btn-default"><b><br> </b> </button>
	        <a href="index.php?secc=actuConta" id="step5"><div class="widget style1 navy-bg" style="background-color:  !important">
	            <div class="row">
	                
	                <div class="col-xs-12 text-center">
	                    <span style='font-size:20px;'> Actualizaciones ante el SAT</span>
	                </div>
	            </div>
	        </div></a>
	    </div>

	    <div class="col-lg-4 text-center" >
	    	<button type="button" class="btn btn-outline btn-default"><b>Totales: </b> <?php echo $totalClientes;?> </button>
	        <a href="index.php?secc=clientesContabilidad" id="step5"><div class="widget style1 navy-bg" style="background-color:  !important">
	            <div class="row">
	                
	                <div class="col-xs-12 text-center">
	                    <span style='font-size:20px;'> Clientes</span>
	                </div>
	            </div>
	        </div></a>
	    </div>

	     <!--div class="col-lg-3 text-center" >
	    	<button type="button" class="btn btn-outline btn-default"><b>Totales: </b> 10,000 </button>
	        <a href="index.php?secc=complemen" id="step5"><div class="widget style1 navy-bg" style="background-color:  !important">
	            <div class="row">
	                
	                <div class="col-xs-12 text-center">
	                    <span style='font-size:20px;'> Complementarias</span>
	                </div>
	            </div>
	        </div></a>
	    </div-->
	    
	</div>
	
</div><br><hr>


     