<?php 
//instanaciamos el metodo para la tabla
include 'modelo/bancosModelo.php';
$bancos = new bancos();
$rspTabla = $bancos->informacionTabla();

?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12"><h2><i class="fa fa-bank"></i> Sección de consejos para bancos</h2></div>
</div>

<!--seccion de contenido-->
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-lg-12">
			<div class="wrapper wrapper-content animated fadeInRight">
				<?php while($rspTablaInfo = $rspTabla->fetch_object()){ ?>
					<div class="faq-item">
						<div class="row">
							<div class="col-md-7">
								<a data-toggle="collapse" href="#faq<?= $rspTablaInfo->id_banco;?>" class="faq-question"><?= $rspTablaInfo->nombre;?></a>
								<small><strong>Recomendaciones</strong></small>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<div id="faq<?= $rspTablaInfo->id_banco;?>" class="panel-collapse collapse ">
									<div class="faq-answer">
										<p>
											<?= $rspTablaInfo->concepto;?><br><br><?= $rspTablaInfo->observaciones;?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
</div>
