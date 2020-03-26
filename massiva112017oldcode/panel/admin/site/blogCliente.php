<?php
	//instanciamos el metodo para mostrar la informacion
	include 'modelo/blogModelo.php';
    $blogMo = new blogMo();
    $rspTabla = $blogMo->informacionTabla();
?>
<!--seccion de contenido-->
<script src="js/vista/blog.js"></script>

<div class="row">
	<div class="col-md-12" id="alertAccion"></div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight blog">
	<div class="row">
		
		<?php while($rspTablaInfo = $rspTabla->fetch_object()){ ?>
		<div class="col-lg-4">
			<div class="ibox-content marginBottomIbox">
				<a href="index.php?secc=blogClienteU&idBlog=<?= $rspTablaInfo->idBlog;?>" class="btn-link">
					<h2><?= $rspTablaInfo->titulo; ?></h2>
				</a>
				<div class="small m-b-xs">
					<strong>Massiva</strong> <span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo fechaCastellano($rspTablaInfo->fecha);?></span>
				</div>
				<p>
					<?php 
						$size = 300;
						$str = trim(substr( $rspTablaInfo->noticia, 0, $size));
						$str .= "...";
						echo $str;
					?>
				</p>
				<div class="row">
					<div class="col-md-12">
						<div class="small text-right">
							<?php 
								$cantidadComen = $blogMo->cantidadComen($rspTablaInfo->idBlog);
								$cantidadComenInfo = $cantidadComen->fetch_object();
							?>
							<div> <i class="fa fa-comments-o"> </i><?= $cantidadComenInfo->cantidad;?> Comentarios 
							<i class="fa fa-eye"> </i> <?= $rspTablaInfo->vistas; ?> Vistas </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
	</div>
</div>
<hr>


     