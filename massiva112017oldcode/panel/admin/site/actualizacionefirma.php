<?php 
@session_start();	
if($_SESSION['id_usuario'] != ''){

	 include 'modelo/consultaTablas.php';
    $misClientes = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
	
	$rspTabla2 = $misClientes->tablaefirma($id_usuario);
    $rspTabla2Infos2 = $rspTabla2->fetch_object();
    $valor = $rspTabla2Infos2->idActu;

?>
<script>
function cambiar(){ document.getElementById('clavee').type = 'text'; }
</script>
</head>
<body>

	<div class='row'>
        <?php if($Actuefirma == 1){?>
        <div class="alert alert-warning text-center"><b>Se recibió tu solicitud, en un lapso de 24 horas se estará actualizando en tu sección de documentación los archivos de efirma.</b></div>
        <?php }if($Actuefirma == 2){?>
        <div class="alert alert-warning text-center">Lo sentimos ocurrio un error favor de volver a intentarlo o reportarlo a <a herf='mailto:atencionclientes@massiva.mx'>mailto:atencionclientes@massiva.mx</a></div>
        <?php }?>
    </div>
    <div class="gray-bg dashbard-1">
		
		<hr>
		<!--contrato-->
		<div class='row'>
			<div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Actualiza e.firma tu mismo</h5>
                        <div class="ibox-tools">
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                    </div>
                    <div class="ibox-content">
						<b>Pasos a seguir</b><br>
						1.-Sacar cita en el <a href="https://citas.sat.gob.mx/citasat/agregarcita.aspx" target="_blank" style='color:#f1005e'>SAT</a>.<br>
						2.-Adjunta nuevos archivos en tu sección de <b>Documentación</b>.
						<hr>
						<div class="row">
							<div class="col-md-12"><div class="alert alert-warning text-center"><b>Recuerda que si no contamos con tus archivos actualizados no podremos realizar tu contabilidad.</b></div></div>
						</div>
                    </div>
                </div>
			</div>

			<?php if($valor == ''){?>
			<!--carga de informacion-->
			<div class="col-md-6">
                <div class="ibox">
                  <div class="ibox-title">
                        <h5>¿Deseas actualizar tu e.firma?</h5>
                        <div class="ibox-tools">
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        </div>
                  </div>
				  <div class="ibox-content">
						
						<div class="product-box">
							<div class="product-imitation" style="background-image: url('contenedor/carrito/actu.jpg');  background-size: cover;  background-position: center; "></div>
							<div class="product-desc">
							<form action='controlador/actualizacionesControlador.php' method='POST'>
								<input type='hidden' name='costo' id='costo' value='49'>
								<input type='hidden' name='accion' id='accion' value='efirmam'>
								<span class="product-price" style="font-size: 25px !important;">$49</span>
								<a href="#" class="product-name">Actualización de e.firma </a>
								<div class="small m-t-xs">Renovación del Certificado de e.firma 24 horas antes del vencimiento.<br></div>
								<div class="text-right"><button class="btn btn-primary" type="submit">Comprar</button></div>
							</form>
							</div>
						</div>
                  </div>
                </div>
            </div>
			<?php }else{?>
			<div class="col-md-6">
				<div class='row'>
				<div class="alert alert-warning text-center">Actualmente cuentas con una solicitud de actualización ante el SAT, en cuanto massiva libere dicha solicitud podrás solicitar otra actualización.</a></div>
				</div>
			</div>
			<?php }?>
			
		</div>
		<hr>
		<!--pie de pagina-->
		<div class="row">
			<div class="col-lg-12">
				<div class="footer">
					<div><strong>Copyright</strong> Todos los derechos reservados massiva.mx &copy; 2018-2019</div>
				</div>
			</div>
		</div>   
    </div>



</body>
<?php }else{ header ('location:../index.php?act=3');}?>
</html>
