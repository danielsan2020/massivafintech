<?php 
@session_start();	
if($_SESSION['id_usuario'] != ''){
	///cabezera
include 'estructura/header.php';
///script
include 'estructura/script.php';
?>
<link rel="shortcut icon" type="image/x-icon" href="massiva.ico" />
</head>
<body>
<!--div class="alert alert-info" role="alert"><dev><?php $vars = get_defined_vars(); print_r($vars);  ?></dev></div-->

    <div class="gray-bg dashbard-1">
	
		<!--logo-->
		<div class="row  border-bottom white-bg dashboard-header"><div class="col-md-12 text-center"><img src="img/logo.png" style='height: 70px'></div></div>
		<hr>

		<div class='row text-center'><div class="alert alert-warning">Acabas de finalizar tu registro con massiva. Realiza la simulación del cálculo de tu contabilidad atrasada para ponerte al día cuanto antes.<br> <h3><b>
		<a href='preregistro7.php'><button class='btn btn-primary'>Realizar cotización</button></a>
		</b></h3> 
		</div></div>
		
		<br><hr>
		<!--pie de pagina-->
		<div class="row">
			<div class="col-lg-12">
				<div class="footer">
					<div><strong>Copyright</strong> Todos los derechos reservados massiva.mx &copy; 2019</div>
				</div>
			</div>
		</div>   
    </div>
</body>
<?php }else{ header ('location:../index.php?act=3');}?>
</html>

