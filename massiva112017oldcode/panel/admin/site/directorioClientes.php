<?php 
    include 'modelo/consultaTablas.php';
    $soporte = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
    $fechaCreacion = date("Y-m-d");

    //consultas de persona fisica
    $Valorclien = $soporte->Valorclien($id_usuario);
    

 ?>
 <script src="js/vista/activos.js"></script>
 <div class="row  border-bottom white-bg dashboard-header">
	<div class="col-md-12 text-center">
		<img src="img/logo.png" style='height: 70px'>
	</div>
</div>

<div class="row white-bg page-heading">
	<div class="col-md-12">
		<div class="title-action"><a href="index.php?secc=misclientes" class="btn btn-primary" > Regresar</a></div>
	</div>
</div>
<div class="row"> <div class="alert alert-warning text-center"> Directorio de tus clientes </div></div>
<!--seccion de contenido-->
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
                    <div class="ibox float-e-margins">
                       
                        <div class="ibox-content">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Razon social</th>
                                    <th>Telefonos</th>
                                    <th>Celulares</th>
                                    <th>Correos</th>
                                    <th>Dirección fiscal</th>
                                    <th>RFC</th>
                                </tr>
                                </thead><img >
                                <tbody>
                                     <?php while($ValorclienInfo = $Valorclien->fetch_object()){ ?>
                                    <tr>
                                        <td><?php echo "<img style='height:100px;' class='img-rounded m-t-xs img-responsive' src='contenedor/logoClienteCliente/".$ValorclienInfo->logo."'"; ?></td>
                                        <td><?php echo $ValorclienInfo->nombre." ".$ValorclienInfo->apePaterno." ".$ValorclienInfo->apeMaterno; ?></td>
                                        <td><?php echo $ValorclienInfo->razonSocialE; ?></td>
                                        <td><?php echo $ValorclienInfo->tel1." | ".$ValorclienInfo->tel2." | ".$ValorclienInfo->telE; ?></td>
                                        <td><?php echo $ValorclienInfo->cel1." | ".$ValorclienInfo->cel2; ?></td>
                                        <td><?php echo $ValorclienInfo->correo1." | ".$ValorclienInfo->correo2." | ".$ValorclienInfo->correo1E." | ".$ValorclienInfo->correo2E." | ".$ValorclienInfo->correo3E; ?></td>
                                        <td><?php echo $ValorclienInfo->dirE; ?></td>
                                        <td><?php echo $ValorclienInfo->rfcE; ?></td>
                                        
                                    </tr>
                                     <?php }?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

    </div>


</div><br><hr>


     