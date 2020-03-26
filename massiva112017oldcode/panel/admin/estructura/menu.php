<?php 
	include 'modelo/consultasAlertas.php';
	$soporte = new consultaAlertaPO();
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
<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<?php
			/*$tipoUsuario = $_SESSION['tipoUsuario'];
			//seccion para administrador
			if ($tipoUsuario == 1){*/
			$foto =$_SESSION['foto'];
		?>

		<ul class="nav metismenu" id="side-menu">
			<!--seccion para el nombre y datos del usuario-->
			
			<li class="nav-header" id="step8">
				<div class="dropdown profile-element" > <span>
					<?php if($foto != ''){?>
						<img alt="image" class="img-rounded" src="contenedor/clientes/<?= $_SESSION['rfc'];?>/<?= $foto;?>" style='height: 40px ;' />
					<?php }else{?>
						<img alt="image" class="img-circle img-responsive" src="img/pictu.png" style='height: 40px;'>
					<?php }?>

				</span>
					<a href="index.php?secc=perfil"  >
						<span class="clear"> 
							<span class="block m-t-xs"> 
								<strong class="font-bold"><?= $usuario;?></strong>
							</span>
							<span class="text-muted text-xs block">
								Mi perfil</b>
							</span> 
						</span> 
						
					</a>
					
				</div>
				<!--logotipo para el el mini menu-->
				<div class="logo-element">
					<?php if($foto != ''){?>
						<img alt="image" class="img-circle" src="contenedor/clientes/<?= $_SESSION['rfc'];?>/<?= $foto;?>" style='height: 20px;' />
					<?php }else{?>
						<img alt="image" class="img-circle" src="img/pictu.png" style='height: 40px;'>
					<?php }?>
				</div>
			</li>

			<!----**********************************************Seccion para los clientes***********************************************---->
			<?php if($nusuario = $_SESSION['tipoUsuario'] != 0 || $nusuario = $_SESSION['tipoUsuario'] == 0 || $nusuario = $_SESSION['tipoUsuario'] != 7){?>
			<!--Inicia seccion de menu-->
			<li><a href="index.php?secc=portada"><i class="fa fa-home"></i> <span class="nav-label">Inicio</span></a></li>
			<li class="divider"></li>
			<?php if($_SESSION['VALPAQ'] != 1){?>
			<li id="step9">
				<a href="index.php?secc=misclientes"><i class="fa fa-users"></i> <span class="nav-label" >Mis clientes</span> 
					<?php if($alertaClientesInfo->idCliente == ''){	?>
						<span class="label label-danger pull-right"><i class="fa fa-chevron-left"></i></span>
					<?php }?>
				</a></li>
					
			<li class="divider"></li>
			<li id="step10"><a href="index.php?secc=misproveedores"><i class="fa fa-truck"></i> <span class="nav-label" >Mis proveedores</a></li>
			<?php }?>
			<li class="divider"></li>

			<li id="step11">
				<a href="#"><i class="fa fa-dot-circle-o"></i> <span class="nav-label" >Mi contabilidad</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="active"></li>
					<?php if($_SESSION['VALPAQ'] != 1){?>
					<li><a href="index.php?secc=ticketusu"><i class="fa fa-align-center"></i> Facturar tickets</a></li>
					<li><a href="index.php?secc=cotizacion"><i class="fa fa-reorder"></i> Cotizaciones</a></li>
					<?php }?>
					<li><a href="index.php?secc=moviConta"><i class="fa fa-list"></i>Movimientos</a></li>
					<li><a href="index.php?secc=respaldo"><i class="fa fa-hdd-o"></i>Mi respaldo</a></li>
				</ul>
			</li>
			<li class="divider"></li>
			<li id="step12">
				<a href="#"><i class="fa fa-building-o"></i> <span class="nav-label" >Mi Empresa</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="active"></li>
					<?php if($_SESSION['VALPAQ'] != 1){?>
					<li><a href="index.php?secc=areasTrabajo" >
						<?php if($alertaAreasActivosInfo->idAreasTrabajo == ''){	?>
						<span class="label label-danger pull-left"><i class="fa fa-chevron-right"></i></span>&nbsp;
						<?php }?>
						<i class="fa fa-briefcase"></i> Áreas y Activos</a></li>
					<li><a href="index.php?secc=inventario">
						<?php if($alertaProductosInfo->idInventario == '' || $alertaServiciosInfo->idServicio == ''){	?>
						<span class="label label-danger pull-left"><i class="fa fa-chevron-right"></i></span>&nbsp;
						<?php }?>
						<i class="fa fa-cube"></i> Servicios | Productos</a></li>
					<?php }?>
					<li><a href="index.php?secc=cuentaBancarias">
						<?php if($alertaCuentasBancrInfo->idBanco == ''){	?>
						<span class="label label-danger pull-left"><i class="fa fa-chevron-right"></i></span>&nbsp;
						<?php }?>

						<i class="fa fa-line-chart"></i> Cuentas bancarias</a></li><!--afterbanks-->
					<?php if($_SESSION['VALPAQ'] != 1){?>
					<li><a href="index.php?secc=seguros"><i class="fa fa-wpforms"></i>Seguros</a></li>
					<?php }?>
				</ul>
			</li>
			<!--li>
				<a href="#"><i class="fa fa-dot-circle-o"></i> <span class="nav-label">Beneficios</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					
				</ul>
			</li-->
			
			<li class="divider"></li>
			<!--seccion de nomina-->
			<!--li>
				<a href="#"><i class="fa fa-id-card-o"></i> <span class="nav-label">Nómina</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="index.php?secc=empresa"><i class="fa fa-keyboard-o"></i>Sucursales</a></li>
					<li><a href="index.php?secc=misEmpleados"><i class="fa fa-keyboard-o"></i>Empleados</a></li>
					<li><a href="index.php?secc=cincidencia"><i class="fa fa-keyboard-o"></i>Nóminas</a></li>
					<li><a href="index.php?secc=reporte"><i class="fa fa-keyboard-o"></i>Finiquitos</a></li>
					<li><a href="index.php?secc=impuesto"><i class="fa fa-keyboard-o"></i>Simuladores</a></li>
					<li><a href="index.php?secc=tnomina"><i class="fa fa-keyboard-o"></i>Reportes</a></li>
				</ul>
			</li-->
			<!--termina seccion de nomina-->
			
			<!--termina seccion de nomina-->
			<li class="divider"></li>
		
			<!--termina seccion de nomina-->
			
			<li class="divider"></li>
			<li id="step13"><a href="index.php?secc=archivos"><i class="fa fa-folder-open"></i> <span class="nav-label" >Documentación</span></a></li>
						<li class="divider"></li>
			
			<li class="divider"></li>
			<?php if($_SESSION['VALPAQ'] != 1){?>
			<li id="step14">
				<a href="#"><i class="fa fa-cogs"></i> <span class="nav-label" >Actualizaciones</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					
					<li><a href="index.php?secc=obligacionesFiscales_inicio"><i class="fa fa-spinner"></i> Cambio de actividades </a></li>
					<li><a href="index.php?secc=actualizacionefirma"><i class="fa fa-refresh"></i> e-firma </a></li>
					<li><a href="index.php?secc=suspencionActividades"><i class="fa fa-pause-circle-o"></i> Suspensión de actividades </a></li>
					<li><a href="index.php?secc=cambioDomicilio"><i class="fa fa-map-pin"></i> Cambio de domicilio </a></li>
					<li><a href="index.php?secc=constanciaFiscal"><i class="fa fa-folder"></i> Constancia </a></li>
					<li><a href="index.php?secc=defuncion"><i class="fa fa-minus-square"></i> Defunción </a></li>
					
				</ul>
			</li>
			<?php }?>
			<!------->
			<li><a href="index.php?secc=faq"><i class="fa fa-question-circle"></i> <span class="nav-label">Preguntas Frecuentes</span></a></li>
			<li><a href="index.php?secc=sopco"><i class="fa fa-id-badge"></i> <span class="nav-label">Soporte contable</span></a></li>
			<li><a href="index.php?secc=sopte"><i class="fa fa-plug"></i> <span class="nav-label">Soporte técnico</span></a></li>
			<li class="divider"></li>
			<!--li>
				<a href="#"><i class="fa fa-asterisk"></i> <span class="nav-label">Consejos</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="active"><a href="#"></a></li>
					<li><a href="index.php?secc=bancos" ><i class="fa fa-bank"></i> Bancos</a></li>
					<li><a href="index.php?secc=fisicasUsuario" ><i class="fa fa-bolt"></i> Personas Físicas </a></li>
					<li><a href="index.php?secc=moralUsuario" ><i class="fa fa-bolt"></i> Personas Morales </a></li>
					
				</ul>
			</li-->
			
			<!----**********************************************Termina Seccion para los clientes***********************************************---->
			<?php }?>

			<?php if($nusuario = $_SESSION['tipoUsuario'] == 0 || $nusuario = $_SESSION['tipoUsuario'] == 7){?>
			<!----**********************************************Seccion para administracion***********************************************---->
			<li class="divider"><hr></li>
			<!--seccion para trabajadores-->
			<li><a href="index.php?secc=registroNuevoUsuario"><i class="fa fa-user"></i> <span class="nav-label">Registros clientes web</span></a></li>
			<li><a href="index.php?secc=codigos"><i class="fa fa-history"></i> <span class="nav-label">Códigos</span></a></li>
			<li><a href="index.php?secc=sopteAdmin"><i class="fa fa-crosshairs"></i> <span class="nav-label">Soporte técnico</span></a></li>
			<li><a href="index.php?secc=sopcoAdmin"><i class="fa fa-crosshairs"></i> <span class="nav-label">Soporte contable</span></a></li>
			<li>
				<a href="#"><i class="fa fa-sliders"></i> <span class="nav-label">Catálogos</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="active"><a href="#"></a></li>
					<li><a href="modulos/ligas.php" target="trabajo"><i class="fa fa-slack"></i> Ligas</a></li>
					<li><a href="modulos/facturacion.php" target="trabajo"><i class="fa fa-question-circle"></i> Aseguradoras</a></li>
					<li><a href="modulos/canales.php" target="trabajo"><i class="fa fa-dribbble"></i> Canales</a></li>
					<li><a href="modulos/canales.php" target="trabajo"><i class="fa fa-dribbble"></i> Comercios</a></li>
					<li><a href="modulos/canales.php" target="trabajo"><i class="fa fa-dribbble"></i> Tipo de pagos</a></li>
					<li><a href="modulos/canales.php" target="trabajo"><i class="fa fa-dribbble"></i> Bancos</a></li>
					<li><a href="modulos/canales.php" target="trabajo"><i class="fa fa-dribbble"></i> Sat productos</a></li>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-keyboard-o"></i> <span class="nav-label">Contabilidad</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="active"><a href="#"></a></li>
					<li><a href="index.php?secc=dasconta"><i class="fa fa-keyboard-o"></i>Dasboard</a></li>
					<li><a href="index.php?secc=panelConta"><i class="fa fa-keyboard-o"></i>Panel administrador</a></li>
					
				</ul>
			</li>
			
			<!--termina seccion de nomina-->
			<li>
				<a href="#"><i class="fa fa-id-card-o"></i> <span class="nav-label">Logs</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li><a href="index.php?secc=logMovimientos"><i class="fa fa-keyboard-o"></i>Movimientos</a></li>
					<li><a href="index.php?secc=logIngreso"><i class="fa fa-keyboard-o"></i>Ingreso Plataforma</a></li>
					<li><a href="dashboard_2.html"><i class="fa fa-keyboard-o"></i>Pagos</a></li>
					<li><a href="index.php?secc=logCompras"><i class="fa fa-keyboard-o"></i>Compras</a></li>
					<li><a href="index.php?secc=logSopTec"><i class="fa fa-keyboard-o"></i>Soporte técnico</a></li>
					<li><a href="index.php?secc=logSopCon"><i class="fa fa-keyboard-o"></i>Soporte contable</a></li>
				</ul>
			</li>
			<li>
				<a href="#"><i class="fa fa-bell"></i> <span class="nav-label">Atención al cliente</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="active"><a href="#"></a></li>
					<li><a href="index.php?secc=simuladores"><i class="fa fa-space-shuttle"></i> Simuladores</a></li>
					<li><a href="index.php?secc=prefa"><i class="fa fa-info-circle"></i> FAQs</a></li>
					<li><a href="index.php?secc=basicos" target="trabajo"><i class="fa fa-dribbble"></i>Básicos</a></li>
					<li><a href="index.php?secc=sopco"><i class="fa fa-id-badge"></i> <span class="nav-label">Soporte contable</span></a></li>
					<li><a href="index.php?secc=registroTel"><i class="fa fa-headphones"></i> <span class="nav-label">Registro de atención telefonica</span></a></li>
					<li><a href="index.php?secc=registroTel"><i class="fa fa-superpowers"></i> <span class="nav-label">Cambio de plan</span></a></li>
					<li><a href="index.php?secc=encuestas"><i class="fa fa-angellist"></i> <span class="nav-label">Encuestas de calidad</span></a></li>
					<li><a href="index.php?secc=clientesAte"><i class="fa fa-hand-o-up"></i> <span class="nav-label">Recuerda cliente</span></a></li>
					
					
				</ul>
			</li>
			<li><a href="index.php?secc=blog"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Consejos</span></a></li>
			<li><a href="index.php?secc=noticiasWeb"><i class="fa fa-newspaper-o"></i> <span class="nav-label">Noticias web</span></a></li>
		<?php }?>
		 </ul>
		 <?php //}
		 ?>
		
	</div>
</nav>