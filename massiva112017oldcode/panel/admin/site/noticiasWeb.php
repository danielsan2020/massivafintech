<?php
	//instanciamos el metodo para mostrar la informacion
	include 'modelo/noticiasWeb.php';
    $noticiasWeb = new noticiasWeb();
    $rspTabla = $noticiasWeb->informacionTabla();
?>
<!--seccion de contenido-->
<script src="js/vista/noticiaWeb.js"></script>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action"><a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevaPubli"> Nueva noticia</a></div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" id="alertAccion"></div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title"><h5>Noticias web</h5></div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
								<tr>
									<th>#</th>
									<th>Titulo</th>
									<th>Noticia</th>
									<th>Fecha</th>
									<th>Referencia</th>
									<th>Imagen</th>
									<th class="text-center">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php while($rspTablaInfo = $rspTabla->fetch_object()){ ?>
								<tr class="gradeX">
									<td><?= $rspTablaInfo->idNoticiaWeb;?></td>
									<td><img src="contenedor/noticiasWeb/<?= $rspTablaInfo->imagen;?>" style="height: 50px;"></td>
									<td><?= $rspTablaInfo->titulo;?></td>
									<td><?= $rspTablaInfo->noticia;?></td>
									<td><?= $rspTablaInfo->referencia;?></td>
									<td><?= $rspTablaInfo->url;?></td>
									<td class="text-center">
										
										<button class="btn btn-primary" data-toggle="modal" title="Editar noticia" data-target="#editar" data-dos="<?= $rspTablaInfo->imagen; ?>" data-uno="<?= $rspTablaInfo->idNoticiaWeb; ?>">
											<i class="fa fa-pencil" title="Editar"></i>
										</button>
										
										<button class="btn btn-danger" data-toggle="modal" title="Eliminar noticia" data-target="#eliminar" data-unoo="<?= $rspTablaInfo->idNoticiaWeb; ?>" data-doss="<?= $rspTablaInfo->imagen; ?>">
											<i class="fa fa-times" title="Eliminar"></i>
										</button>
										
									</td>
								</tr>
								<?php }?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--seccion de modal para agregar nueva publicacion-->
<div class="modal inmodal fade" id="nuevaPubli" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Nueva noticia web</h3>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<div class="row text-center"></div>
			</div>
			<div class="modal-body">
				<iframe name="agrocampo" id="agrocampo" style="width: 100%; height: 70px; border: none"></iframe>
				<div class="form-group">
					<input type='hidden' name='accion' id='accion' value='nuevo'>
					<form action="controlador/noticiasWeb.php" target="agrocampo" method="post" enctype="multipart/form-data">
						<input name="accion" type="hidden" value="nuevaNoticia">
						<div class="row">
						<div class="col-md-8">
							<div class="input-group m-b">
								<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
								<input type="text" id="titulo" name="titulo" placeholder="Titulo de noticia" class="form-control">
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group m-b">
								<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
								<input type="date" id="fecha" name="fecha" placeholder="fecha de noticia" class="form-control">
							</div>
						</div>
						<div class="col-md-12">
							<div class="input-group m-b">
								<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
								<input type="text" id="url" name="url" placeholder="URL de noticia" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group m-b">
								<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
								<input type="text" id="referencia" name="referencia" placeholder="Referencia de noticia" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="input-group m-b">
								<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
								<input type="file" id="imagen" name="imagen" placeholder="Titulo de noticia" class="form-control">
							</div>
						</div>
						<div class="col-md-12">
							<div class="input-group m-b">
								<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
								<textarea class="form-control" placeholder="Texto de la noticia" name='noticia' id='noticia'></textarea> 
							</div>
						</div>
					</div>
					
				 </div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Agregar noticia</button>
				<button type="button" class="btn btn-white" id='btncerraeditar' data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!--modal para editar-->
<div class="modal inmodal fade" id="editar" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header"> <h3>Edición de noticia web</h3></div>
			<div class="modal-body">
				<iframe name="editaNoti" id="editaNoti" style="width: 100%; height: 70px; border: none"></iframe>
				<div class="form-group">
					<form action="controlador/noticiasWeb.php" name="edintc" target="editaNoti" method="post" enctype="multipart/form-data">
						
						<input name="accion" type="hidden" value="editar">
						<input type='hidden' name='idNoticiaWeb1' id='idNoticiaWeb1' >
						<input type='hidden' name='imRefe' id='imRefe' >
						
						<div class="row">
							
							<div class="col-md-8">
								<div class="input-group m-b">
									<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
									<input type="text" id="titulo1" name="titulo1" placeholder="Titulo de noticia" class="form-control">
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group m-b">
									<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
									<input type="date" id="fecha1" name="fecha1" placeholder="fecha de noticia" class="form-control">
								</div>
							</div>
							<div class="col-md-12">
								<div class="input-group m-b">
									<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
									<input type="text" id="url1" name="url1" placeholder="URL de noticia" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group m-b">
									<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
									<input type="text" id="referencia1" name="referencia1" placeholder="Referencia de noticia" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group m-b">
									<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
									<input type="file" id="iuno" name="iuno" placeholder="Titulo de noticia" class="form-control">
								</div>
							</div>
							<div class="col-md-12">
								<div class="input-group m-b">
									<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
									<textarea class="form-control" placeholder="Texto de la noticia" name='noticia1' id='noticia1'></textarea> 
								</div>
							</div>
						</div>
					
				 </div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Editar noticia</button>
				<button type="button" class="btn btn-white" id='editcerr' data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!--modal para eliminar-->
<div class="modal inmodal fade" id="eliminar" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Eliminar ingreso</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="idNoticiaWeb23" id="idNoticiaWeb23">
				<input type="hidden" name="imRefe2" id="imRefe2">
    			<div class="alert alert-danger text-center">Esta de acuerdo eliminar la noticia, recuerde que al eliminarlo no habra forma de recuperar la información.</div>
			</div>
			<div class="modal-footer">
				<button type="button" id='btnElimina' class="btn btn-w-m btn-danger"><i class="fa fa-times"></i> Eliminar </button>
				<button type="button" class="btn btn-white" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
			</div>
		</div>
	</div>
</div>


     