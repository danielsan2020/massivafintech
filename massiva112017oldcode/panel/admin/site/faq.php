<?php 
//instanaciamos el metodo para la tabla
include 'modelo/faqModelo.php';
$faqPr = new faqPr();

if ($busfaq != ''){ $rspTabla = $faqPr->informacionTablaBus($busfaq);}
else{ $rspTabla = $faqPr->informacionTabla();}


?>

<!--seccion de contenido-->
<div class="wrapper wrapper-content">
	<div class="col-lg-12">
		<div class="ibox">
			<div class="ibox-title">
				<h5>Preguntas frecuentes</h5>
			</div>
			<div class="ibox-content">
				<form action='index.php' method="GET">
					<input type="hidden" name="secc" id="secc" value="faq">
					<label for="exampleInputPassword2" class="sr-only"></label>
					<input type="text" placeholder="Ingrese la palabra o palabras" id="busfaq" name="busfaq" class="form-control">
					<button class="form-control btn btn-primary" type="submit"><i class="fa fa-search"></i> Buscar</button>
				</form>
			</div>
		</div>
	</div>

	
	<div class="row">
		<div class="col-lg-12">
			<div class="wrapper wrapper-content animated fadeInRight">
				<?php while($rspTablaInfo = $rspTabla->fetch_object()){ ?>
				<div class="faq-item">
					<div class="row">
						<div class="col-md-7">
							<a data-toggle="collapse" href="#faq<?= $rspTablaInfo->idPregunta;?>" class="faq-question"><?= $rspTablaInfo->pregunta;?></a>
							<small>Area de atención <strong><?= $rspTablaInfo->atiende;?></strong></small>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div id="faq<?= $rspTablaInfo->idPregunta;?>" class="panel-collapse collapse ">
								<div class="faq-answer"><p> <?= $rspTablaInfo->respuesta;?></p></div>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
			</div>
		</div>
	</div>
</div>
<?php include 'modal.php';?>