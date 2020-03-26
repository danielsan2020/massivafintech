<?php
	//instanciamos el metodo para mostrar la informacion
	include 'modelo/blogModelo.php';
    $blogMo = new blogMo();
    $rspTabla = $blogMo->obtengoBlogInd($idBlog);
	$rspTablaInfo = $rspTabla->fetch_object();
	//agregamos visita
	$valor = 1;
	$agregavista = $blogMo->agregavista($valor,$idBlog);
	
	$cantidadComen = $blogMo->cantidadComen($idBlog);
	$cantidadComenInfo = $cantidadComen->fetch_object();
	
?>
<!--seccion de contenido-->
<script src="js/vista/blog.js"></script>

<div class="wrapper wrapper-content  animated fadeInRight article">
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action">
			<a href="index.php?secc=blogCliente" class="btn btn-primary"> Regresar</a>
		</div>
	</div>
</div>
<hr>
	<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<div class="ibox">
					<div class="ibox-content">
						<input type="hidden" id='idProducto' value="<?php echo $idBlog;?>">
						<div class="text-center article-title">
						<span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo fechaCastellano($rspTablaInfo->fecha);?></span>
							<h1><?= $rspTablaInfo->titulo; ?></h1>
						</div>
						<p><?= $rspTablaInfo->noticia;?></p>
						
						<hr>
						<div class="row">
							<div class="col-md-12">
								<div class="small text-right">
									<div> <i class="fa fa-comments-o"> </i> <?= $cantidadComenInfo->cantidad;?> Comentarios 
									<i class="fa fa-eye"> </i> <?= $rspTablaInfo->vistas; ?> Vistas </div>
								</div>
							</div>
						</div>
						<!--seccion para ver comentarios-->
						<div class="row">
							<div class="col-lg-12">
								<h2>Comentarios:</h2>
								<?php
									//obtenemos los comentarios
									$comen = $blogMo->Comentario($idBlog);
									while($comenInfo = $comen->fetch_object()){
								?>
									<div class="social-feed-box">
										<div class="social-avatar">
											<div class="media-body">
												<a href="#" style="color: #f7bd00 !important"><?= $comenInfo->usuario;?></a>
												<small class="text-muted"><?php echo fechaCastellano($comenInfo->fechaCreacion);?></small>
											</div>
										</div>
										<div class="social-body">
											<p><?php echo $comenInfo->pregunta;?></p>
											<br>
											<?php 
												//consultamos si existe comentario de administrador
												$busAdmin = $comenInfo->idBlogComentario;
												
												$comends = $blogMo->ComentarioADmin($busAdmin);
												$comendsInfo = $comends->fetch_object();
												$nom = $comendsInfo->pregunta;
												if($nom != ''){
											?>
											<div class="alert alert-warning text-center"><?php echo $nom;?></div>
											<?php }?>
										</div>
									</div>

									<!--verificamos que el comentario no ha contestado el administrador-->
									<?php if($_SESSION['id_usuario'] == 19 ){?>
									<div class="col-md-12">
										<div class="col-md-12 text-right">
											<a class="btn btn-primary" data-toggle="modal" data-target="#idBlogComen" data-whatever="<?= $comenInfo->idBlogComentario; ?>">responder Comentario</a>
										</div>
									</div>
									<hr>
									<?php 	}
										
								}?>
							</div>
							<hr>
						</div>
						<!--Seccion para agregar comentario Usuarios-->
						<hr>
						<div class='row'><div class='col-md-12' id='alertAccion' name='alertAccion'></div></div>
						<div class="row">
							<div class="col-md-12">
								<h3>Agregar comentario</h3>
								<textarea class="form-control" id="comentarioCliente"></textarea><br>
							</div>
							<div class="col-md-12 text-right">
								<a class="btn btn-primary" id='AgregaComenCli'>Agregar Comentario</a>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
</div>

<!--modal para contestar administrador-->
<div class="modal inmodal fade" id="idBlogComen" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Contestar comentario del cliente</h4>
			</div>
			<div class="modal-body">
				<div id="alertsss"></div>
				<input type="hidden" id="idBlogCo12" name="idBlogCo12">
				<textarea class="form-control" id="ComAdm" name='ComAdm'></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" id='ageCoAdmin' name="ageCoAdmin" class="btn btn-primary">Agregar comentario</button>
				<button type="button" id='btnCrrcomen' class="btn btn-white" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<hr>


     