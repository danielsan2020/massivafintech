 <?php 
	@session_start();
	$id_usuario = $_SESSION['id_usuario'];

	/* Obtenemos el dato del perfil */
	$alertaPerfil = $soporte->alertaPerfil($id_usuario);
	$alertaPerfilInfo = $alertaPerfil->fetch_object();
	/* Obtenemos los clientes */
	$alertaClientes = $soporte->alertaClientes($id_usuario);
	$alertaClientesInfo = $alertaClientes->fetch_object();
	/* areas y activos */
	$alertaAreasActivos = $soporte->alertaAreasActivos($id_usuario);
	$alertaAreasActivosInfo = $alertaAreasActivos->fetch_object();
	/* productos */
	$alertaProductos = $soporte->alertaProductos($id_usuario);
	$alertaProductosInfo = $alertaProductos->fetch_object();
	/* servicios  */
	$alertaServicios = $soporte->alertaServicios($id_usuario);
	$alertaServiciosInfo = $alertaServicios->fetch_object();
	/* Cuentas bancarias */
	$alertaCuentasBancr = $soporte->alertaCuentasBancr($id_usuario);
	$alertaCuentasBancrInfo = $alertaCuentasBancr->fetch_object();

 ?>
 <div class="row border-bottom">
	<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header"><a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a></div>
		<ul class="nav navbar-top-links navbar-right">
			<li><span class="m-r-sm text-muted welcome-message"><?php echo $fechaGlobal;?> - <span id="liveclock" ></span>
				<script language="JavaScript" type="text/javascript">
				function show5(){
				if (!document.layers&&!document.all&&!document.getElementById)
				return

				 var Digital=new Date()
				 var hours=Digital.getHours()
				 var minutes=Digital.getMinutes()
				 var seconds=Digital.getSeconds()

				var dn="PM"
				if (hours<12){dn="AM"}
				if (hours>12){hours=hours-12}
				if (hours==0){hours=12}

				 if (minutes<=9){ minutes="0"+minutes}
				 if (seconds<=9){ seconds="0"+seconds}
				//change font size here to your desire
				 myclock="<font size='2' face='Arial' >"+hours+":"+minutes+":"+seconds+" "+dn+"</font>"
				if (document.layers){
					document.layers.liveclock.document.write(myclock)
					document.layers.liveclock.document.close()
				}
				else if (document.all){ liveclock.innerHTML=myclock }
				else if (document.getElementById)
				document.getElementById("liveclock").innerHTML=myclock
				setTimeout("show5()",1000)
				 }
				window.onload=show5
			 </script>
             </span></li>
			<!--alerta de campana-->
			<li class="dropdown">
				
				
					<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" id="step1">
					<?php if($alertaClientesInfo->idCliente == '' || $alertaClientesInfo->idActivo == '' || $alertaClientesInfo->idInventario == '' || $alertaClientesInfo->idServicio == '' || $alertaClientesInfo->idBanco == ''){	?>
						<i class="fa fa-bell"></i><span class="label " style="background-color: #f1005e; color: #FFFFFF">1</span>
						<?php }?>
					</a>
				

				<ul class="dropdown-menu dropdown-messages" >
						<?php if($alertaClientesInfo->idCliente == ''){	?>
						<li>
                            <div class="dropdown-messages-box">
                                <div>
                                    <strong>Agrega tus clientes</strong><br>
									<b>Sección:</b> Mis clientes<br>
                                    Identifícalo en la barra de menú <span class="label label-danger pull-right"><i class="fa fa-chevron-left"></i></span> <br>
                                </div>
                            </div>
                            <hr>
                        </li>
						<?php }?>

						<?php if($alertaAreasActivosInfo->idActivo == ''){	?>
						<li>
                            <div class="dropdown-messages-box">
                                <div>
                                    <strong>Agrega tus Áreas y activos</strong><br>
									<b>Sección:</b> Mi empresa - Áreas y Activos<br>
                                    Identifícalo en la barra de menú <span class="label label-danger pull-right"><i class="fa fa-chevron-left"></i></span> <br>
                                </div>
                            </div>
                            <hr>
                        </li>
						<?php }?>

						<?php if($alertaProductosInfo->idInventario == ''){	?>
						<li>
                            <div class="dropdown-messages-box">
                                <div>
                                    <strong>Agrega tus productos (Si los tienes)</strong><br>
									<b>Sección:</b> Mi empresa - Servicios y Productos<br>
                                    Identifícalo en la barra de menú <span class="label label-danger pull-right"><i class="fa fa-chevron-left"></i></span> <br>
                                </div>
                            </div>
                            <hr>
                        </li>
						<?php }?>
						
						<?php if($alertaServiciosInfo->idServicio == ''){	?>
						<li>
                            <div class="dropdown-messages-box">
                                <div>
                                    <strong>Agrega tus servicios (Si los tienes)</strong><br>
									<b>Sección:</b> Mi empresa - Servicios y Productos<br>
                                    Identifícalo en la barra de menú <span class="label label-danger pull-right"><i class="fa fa-chevron-left"></i></span> <br>
                                </div>
                            </div>
                            <hr>
                        </li>
						<?php }?>

						<?php if($alertaCuentasBancrInfo->idBanco == ''){	?>
						<li>
                            <div class="dropdown-messages-box">
                                <div>
                                    <strong>Agrega tus cuentas bancarias</strong><br>
									<b>Sección:</b> Mi empresa - Cuentas bancarias<br>
                                    Identifícalo en la barra de menú <span class="label label-danger pull-right"><i class="fa fa-chevron-left"></i></span> <br>
                                </div>
                            </div>
                            <hr>
                        </li>
						<?php }?>
                 </ul>
			</li>
			
			
			<li class="dropdown"><a href="index.php?secc=carrito" id="step2" style='text-decoration: none'><i class="fa fa-shopping-cart"></i></a></li>
			<li class="dropdown"><a href="index.php?secc=blogCliente" style='text-decoration: none'><i class="fa fa-newspaper-o" title='Consejos'></i></a></li>
			<li class="dropdown "><a href="#" class="startTour" style='text-decoration: none'><i class="fa fa-info-circle startTour" title='Tour de orientación'></i></a></li>
			<li><a href="login/salir.php" style='text-decoration: none'><i class="fa fa-sign-out"></i> Salir</a></li>
		</ul>
	</nav>
</div>