<?php 
@session_start();	
if($_SESSION['id_usuario'] != ''){
$sinFima = $_SESSION['noTengoEfirma'];
///cabezera

?>
<script>
function cambiar(){ document.getElementById('clave').type = 'text'; }
</script>
</head>
<body>
<!--div class="alert alert-info" role="alert"><dev><?php $vars = get_defined_vars(); print_r($vars);  ?></dev></div-->

    <div class="gray-bg dashbard-1">
		<div class="container-fluid"><div class="row"><div class="alert alert-warning text-center"><b>Bienvenido <?= $nombre?></b></div></div></div>
		<!--logo-->
		<div class="row  border-bottom white-bg dashboard-header"><div class="col-md-12 text-center"><img src="img/logo.png" style='height: 70px'></div></div>
	
		
		<!--mensaje de error-->
		<?php if($error == 1){?>
		<div class='row'> <div class="alert alert-danger text-center">Recuerda cargar todos los documentos solicitados.</div></div>
		<?php }?>
		<hr>
		<!--contrato-->
		<div class='row text-center'>
			<?php echo $aviso;?>
		</div>

		<div class='row'>
			<div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Básicos para asesores</h5>
                        <div class="ibox-tools"><a class="fullscreen-link"><i class="fa fa-expand"></i></a></div>
                    </div>
                    <div class="ibox-content"><embed src="documentacion/basicos.pdf" type="application/pdf" width="100%" height="600"></embed></div>
                </div>
			</div>
			<!--carga de informacion-->
			<div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>¿Eres persona física o moral?</h5>
                        <div class="ibox-tools"><a class="fullscreen-link"><i class="fa fa-expand"></i></a></div>
                    </div>
                    <div class="ibox-content"><embed src="documentacion/formula.pdf" type="application/pdf" width="100%" height="600"></embed></div>
                </div>
			</div>
		</div>
		<div class='row'>
			<div class="col-md-4">
                <div class="ibox">
                    <div class="ibox-content"><img src="documentacion/efirma.png" class="img-responsive" style=""></div>
                </div>
			</div>
			<!--carga de informacion-->
			<div class="col-md-4">
                <div class="ibox">
                    <div class="ibox-content"><img src="documentacion/personaf.png" class="img-responsive"></div>
                </div>
			</div>
			<div class="col-md-4">
                <div class="ibox">
                    <div class="ibox-content"><img src="documentacion/personam.png" class="img-responsive"></div>
                </div>
			</div>
		</div>
		<hr>
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
