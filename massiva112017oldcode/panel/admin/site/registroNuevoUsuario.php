<?php
	//instanciamos el metodo para mostrar la informacion
	include 'modelo/registroNuevoUsuarioModelo.php';
    $registroTel = new registroTel();
    $rspTabla = $registroTel->informacionTabla();
?>
<!--seccion de contenido-->
<script src="js/vista/ratefon.js"></script>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Registro de nuevos usuarios</h5>
			</div>
			<div class="ibox-content">

			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover dataTables-example" >
					<thead>
						<tr>
							<th>#</th>
							<th>Usuario</th>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>Fecha de nacimiento</th>
							<th>Correo</th>
							<th>Teléfono</th>
							<th>RFC</th>
							<th>Tiene efirma</th>
							<th>Contabilidad Atrasada</th>
							<th>Estatus</th>
							

						</tr>
					</thead>
					<tbody>
						<?php while($rspTablaInfo = $rspTabla->fetch_object()){ ?>
						<tr class="gradeX">
							<td><?= $rspTablaInfo->id_usuario;?></td>
							<td><?= $rspTablaInfo->usuario;?></td>
							<td><?= $rspTablaInfo->nombre;?></td>
							<td><?= $rspTablaInfo->ape_paterno;?> <?= $rspTablaInfo->ape_materno;?></td>
							<td><?= $rspTablaInfo->fecha_nacimiento;?></td>
							<td><?= $rspTablaInfo->mail;?></td>
							<td><?= $rspTablaInfo->telefono;?></td>
							<td><?= $rspTablaInfo->rfc;?></td>
							<td><?= $rspTablaInfo->efirma;?></td>
							<td><?= $rspTablaInfo->contaAtrasada;?></td>
							<td><?php
							 if($rspTablaInfo->estatus == 1){
								 echo "Aceptado";
							 }else{
								 echo "Rechazado";
							 }
							 ?></td>
						</tr>
						<?php }?>

					</tbody>
					<tfoot>
						<tr>
							<th>#</th>
							<th>Usuario</th>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>Fecha de nacimiento</th> 
							<th>Correo</th>
							<th>Teléfono</th>
							<th>RFC</th>
							<th>Tiene efirma</th>
							<th>Contabilidad Atrasada</th>
							<th>Estatus</th>
						</tr>
					</tfoot>
				</table>
			</div>

			</div>
		</div>
	</div>
	</div>
</div>


     