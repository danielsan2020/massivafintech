<?php
	//instanciamos el metodo para mostrar la informacion
	include 'modelo/blogModelo.php';
    $blogMo = new blogMo();
    $rspTabla = $blogMo->informacionTabla();
?>
<!--seccion de contenido-->
<script src="js/vista/blog.js"></script>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
		<div class="title-action"><a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevaPubli"> Nueva publicación</a></div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" id="alertAccion"></div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title"><h5>Sección de Consejos</h5></div>
				<div class="ibox-content">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover dataTables-example" >
							<thead>
								<tr>
									<th>#</th>
									<th>Titulo</th>
									<th>Noticia</th>
									<th>Fecha</th>
									<th>Ver comentarios</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php while($rspTablaInfo = $rspTabla->fetch_object()){ ?>
								<tr class="gradeX">
									<td><?= $rspTablaInfo->idBlog;?></td>
									<td><?= $rspTablaInfo->titulo;?></td>
									<td><?= $rspTablaInfo->noticia;?></td>
									<td><?= $rspTablaInfo->fecha;?></td>
									<td class="text-center">
										<button class="btn btn-primary" data-toggle="modal" title="Ver comentarios usuario" data-target="#comentariosu" data-unoo="<?= $rspTablaInfo->idBlog; ?>">
											<i class="fa fa-search"></i>
										</button>
										<!--button class="btn btn-primary" data-toggle="modal" title="Ver comentarios Administrador" data-target="#comentariosa" data-unoo="<?= $rspTablaInfo->idBlog; ?>">
											<i class="fa fa-search-plus"></i>
										</button-->
									</td>
									<td class="text-center">
										<button class="btn btn-primary" data-toggle="modal" title="Editar publicación" data-target="#editar" data-unoo="<?= $rspTablaInfo->idBlog; ?>">
											<i class="fa fa-edit" title="Editar"></i>
										</button>
										<button class="btn btn-danger" data-toggle="modal" title="Eliminar noticia" data-target="#eliminar" data-unoo="<?= $rspTablaInfo->idBlog; ?>">
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
<!--modal para agregar-->
<div class="modal inmodal fade" id="nuevaPubli" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<div class="row text-center"></div>
			</div>
			<div class="modal-body">
				<div class="panel panel-default">
                    <div class="panel-heading">Nueva entrada del blog</div>
                        <div class="panel-body">
                            <div class="form-group">
								<input type='hidden' name='accion' id='accion' value='nuevo'>
								<div class="row">
									<div class="col-md-12">
										<div class="input-group m-b">
											<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
											<input type="text" id="titulo" name="titulo" placeholder="Titulo de publicación" class="form-control">
										</div>
									</div>
									<div class="col-md-12">
										<div class="input-group m-b">
											<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
											<textarea class="form-control" placeholder="Texto" name='noticia' id='noticia'></textarea> 
										</div>
									</div>
								</div>
                             </div>
                         </div>
                   </div>
			</div>

			<div class="modal-footer">
				<button type="button" id='apubli' class="btn btn-primary"> Agregar</button>
				<button type="button" class="btn btn-white" id='btncerraeditar' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!--modal para ver comentarios usuarios-->
<div class="modal inmodal fade" id="comentariosu" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Comentarios del usuario en la noticia</h3>
			</div>
			<!--tabla de comentarios-->
			<div class="modal-body"> 
				<div id="tablaComenU"></div> 
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-white" id='btncerraeditar' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

 <!--modal para ver comentarios de administrador--->    
<div class="modal inmodal fade" id="comentariosa" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Comentarios del administrador en la noticia</h3>
				
			</div>
			<div class="modal-body">
				<div id="tablaComenA"></div> 
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-white" id='btncerraeditar' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!--modal para editar-->
<div class="modal inmodal fade" id="editar" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
			<div class="modal-body">
				<div class="panel panel-default">
                    <div class="panel-heading">Editar entrada del blog</div>
                        <div class="panel-body">
                            <div class="form-group">
								<input type='hidden' name='accion' id='accion' value='editar'>
								<input type='hidden' name='idBlog1' id='idBlog1'>
								<div class="row">
									<div class="col-md-12">
										<div class="input-group m-b">
											<span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
											<input type="text" id="titulo1" name="titulo1" placeholder="Titulo de publicación" class="form-control">
										</div>
									</div>
									<div class="col-md-12">
										<div class="input-group m-b">
											<span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
											<textarea class="form-control" placeholder="Texto" name='noticia1' id='noticia1'></textarea> 
										</div>
									</div>
								</div>
                             </div>
                         </div>
                   </div>
			</div>

			<div class="modal-footer">
				<button type="button" id='editaPublica' class="btn btn-primary"> Editar publicación</button>
				<button type="button" class="btn btn-white" id='editaBlog' data-dismiss="modal"> Cerrar</button>
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
				<input type="hidden" name="idBlog2" id="idBlog2">
    			<div class="alert alert-danger text-center">Esta de acuerdo eliminar la publicación, recuerde que al eliminarlo no habra forma de recuperar la información.</div>
			</div>
			<div class="modal-footer">
				<button type="button" id='btnElimina' class="btn btn-w-m btn-danger"> Eliminar </button>
				<button type="button" class="btn btn-white" id="nbtelim" data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
	</div>
</div>
