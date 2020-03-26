<?php 
@session_start();	
    include 'modelo/consultaTablas.php';
    $soporte = new consultaTabla();
    $rspCate = $soporte->categoria();
    ///aqui realizamos la consulta para saber si tenemos tickets abiertos
    $valoId = $_SESSION['id_usuario'];
    $rfcClien = $_SESSION['rfc'];
    $vaTick = $soporte->documenPlatafroma($valoId);
    /*echo $rfcClien;
    echo "<br>";
    echo $valoId;*/
?>

<script src="js/vista/documentacion.js"></script>
<div class="row">
	<div class="col-md-12"><div class="alert text-center" style="background-color: darkgrey !important; color: #FFFFFF"><b>Aquí puedes administrar tus documentos.</b></div></div>
</div>

<div class="row">
    <div class="col-md-12" id="alertAccion"></div>
</div>

<div class="row">
    <div class="col-md-12" >
        <?php if($tiArchivo == 1){?>
            <div class="alert alert-warning text-center">Se actualizó tu archivo</div>

        <?php } if($tiArchivo == 2){?>
            <div class="alert alert-danger text-center">Revisa el tipo de archivo que subió</div> 
        <?php }?>
    </div>
</div>

<!--seccion de contenido-->
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <form action="controlador/documentacionControlador.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?= $valoId;?>">
                        <input type="hidden" name="accion" id="accion" value="subir">
                        <div class="file-manager">
                            <div class="hr-line-dashed"></div>
    						<div id="subir" name='subir'>
                                  <select class="form-control" name="tipo" id="tipo" required>
                                    <option value="1">Comprobante de domicilio</option>
                                    <option value="2">Identificación frontal</option>
                                    <option value="3">Identificación trasera</option>
                                    <option value="4">e.firma CER</option>
                                    <option value="5">e.firma KEY</option>
                                </select>
                                <hr>
    							<input class="form-control" name="imagen" id="imagen" type="file" required><hr>
    							<button class="btn btn-primary btn-block" type="submit">Actualizar documentación</button><br>
                                <small>*Archivos permitidos: JPG/PNG/PDF/KEY/CER</small>
    						</div>
                            <div class="hr-line-dashed"></div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-9 animated fadeInRight">
			<div class="row">
                <div class="col-lg-12">
                    <h4>Documentación personal</h4>
                    <?php 
                        while($rspTickInfo = $vaTick->fetch_object() ){
                    ?>
                        
                        <?php if($rspTickInfo->comprobante != ''){?>
                        <div class="file-box">
                            <div class="file">
                                <a href="contenedor/clientes/<?php echo $rfcClien;?>/<?php echo $rspTickInfo->comprobante ?>" style="color:#eac52d;" target='_blank'>
                                    <span class="corner"></span>
                                    <?php 
                                        /* obtenemos que tipo de estencion */
                                        $finn = substr($rspTickInfo->comprobante,-3);
                                        if($finn == 'pdf'){
                                    ?>
                                    <div class="icon"><i class="fa fa-file"></i></div>
                                    <?php }else{?>

                                    <div class="image">
                                        <img  class="img-responsive" src="contenedor/clientes/<?= $rfcClien;?>/<?= $rspTickInfo->comprobante ?>">
                                    </div>
                                    <?php }?>
                                    <div class="file-name" style="color:#eac52d">
                                        

                                        <span style="color:#eac52d"><?php echo substr($rspTickInfo->comprobante, -6); ?></span></a>
                                        <br/>
                                        <small> <?php echo $rspTickInfo->fechaCarga;?></small><br>
                                        <div class="text-right">
                                            <button class="btn btn- btn-danger" class="btn btn-primary" data-toggle="modal" data-target="#eliminar" data-unoo="<?= $rspTickInfo->idDocumentacion; ?>" data-doss="1" ><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <?php }?>

                        <?php if($rspTickInfo->iden1 != ''){?>
                        <div class="file-box">
                            <div class="file">
                                <a href="contenedor/clientes/<?= $rfcClien;?>/<?= $rspTickInfo->iden1 ?>" style="color:#eac52d" target='_blank'>
                                    <span class="corner"></span>
                                    <div class="image"><img  class="img-responsive" src="contenedor/clientes/<?= $rfcClien;?>/<?= $rspTickInfo->iden1 ?>"></div>
                                    <div class="file-name" style="color:#eac52d">
                                        <span style="color:#eac52d"><?php echo substr($rspTickInfo->iden1, -6); ?></span><br/>
                                        <small> <?= $rspTickInfo->fechaCarga; ?></small><br></a>
                                        <div class="text-right">
                                            <button class="btn btn- btn-danger" class="btn btn-primary" data-toggle="modal" data-target="#eliminar" data-unoo="<?= $rspTickInfo->idDocumentacion; ?>" data-doss="2" ><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>
                        <?php }?>
                        <?php if($rspTickInfo->iden2 != ''){?>
                        <div class="file-box">
                            <div class="file">
                                <a href="contenedor/clientes/<?= $rfcClien;?>/<?= $rspTickInfo->iden2 ?>" target='_blank'>
                                    <span class="corner"></span>
                                    <div class="image"><img  class="img-responsive" src="contenedor/clientes/<?= $rfcClien;?>/<?= $rspTickInfo->iden2 ?>"></div>
                                    <div class="file-name" style="color:#eac52d">
                                        <span style="color:#eac52d"><?php echo substr($rspTickInfo->iden2, -6); ?></span><br/>
                                        <small> <?= $rspTickInfo->fechaCarga; ?></small><br></a>
                                        <div class="text-right">
                                            <button class="btn btn- btn-danger" class="btn btn-primary" data-toggle="modal" data-target="#eliminar" data-unoo="<?= $rspTickInfo->idDocumentacion; ?>" data-doss="3" ><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                

                            </div>
                        </div>
                        <?php }?>
                        <?php if($rspTickInfo->keyaar != ''){?>
                        <div class="file-box">
                            <div class="file">
                                <a href="#">
                                    <span class="corner"></span>
                                    <div class="icon"><i class="fa fa-file"></i></div>
                                    <div class="file-name">
                                        <a style="color:#eac52d" download="contenedor/clientes/<?= $rfcClien;?>/<?= $rspTickInfo->keyaar; ?>" href="contenedor/clientes/<?= $rfcClien;?>/<?= $rspTickInfo->keyaar; ?>" target='_blank'>
                                            <?php echo substr($rspTickInfo->keyaar, -6); ?>
                                        </a><br/>
                                        
                                        <small> <?= $rspTickInfo->fechaCarga; ?></small><br></a>
                                        <div class="text-right">
                                            <button class="btn btn- btn-danger" class="btn btn-primary" data-toggle="modal" data-target="#eliminar" data-unoo="<?= $rspTickInfo->idDocumentacion; ?>" data-doss="4" ><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        <?php }?>
                        <?php if($rspTickInfo->cerar != ''){?>
                        <div class="file-box">
                            <div class="file">
                                <a href="#">
                                    <span class="corner"></span>
                                    <div class="icon"><i class="fa fa-file"></i></div>
                                    <div class="file-name">
                                        <a style="color:#eac52d" download="contenedor/clientes/<?= $rfcClien;?>/<?= $rspTickInfo->cerar; ?>" href="contenedor/clientes/<?= $rfcClien;?>/<?= $rspTickInfo->cerar; ?>" target='_blank'>
                                            <?= $rspTickInfo->cerar;?>
                                        </a><br/>
                                        <small> <?= $rspTickInfo->fechaCarga; ?></small><br></a>
                                        <div class="text-right">
                                            <button class="btn btn- btn-danger" class="btn btn-primary" data-toggle="modal" data-target="#eliminar" data-unoo="<?= $rspTickInfo->idDocumentacion; ?>" data-doss="5" ><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                        <?php }?>
                    <?php }?>
                </div>
                <hr>

                <!--seccion de contratos-->
                <div class="col-lg-12">
                    <h4>Sección de contratos</h4>
                    <div class="file-box">
                        <div class="file">
                            <a href="#">
                                <span class="corner"></span>
                                <div class="icon"><i class="fa fa-file"></i></div>
                                <div class="file-name text-center">
                                    <a style="color:#eac52d;" download="contenedor/clientes/<?= $rfcClien;?>/<?= $rfcClien?>_contratoServicios.pdf" href="contenedor/clientes/<?= $rfcClien;?>/<?= $rfcClien; ?>_contratoServicios.pdf">
                                        Contrato de servicio massiva
                                    </a><br/>
                                </div>
                        </div>
                    </div>

                    <div class="file-box">
                        <div class="file">
                            <a href="#">
                                <span class="corner"></span>
                                <div class="icon"><i class="fa fa-file"></i></div>
                                <div class="file-name text-center">
                                    <a style="color:#eac52d;" download="contenedor/clientes/<?= $rfcClien;?>/<?= $rfcClien?>_AcuerdoEntregaEfirmaDocumentosFiscales.pdf" href="contenedor/clientes/<?= $rfcClien;?>/<?= $rfcClien; ?>_AcuerdoEntregaEfirmaDocumentosFiscales.pdf">
                                        Acuerdo por entrega de documentación
                                    </a><br/>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>

<!---seccion de modals--->
<div class="modal inmodal fade" id="eliminar" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Eliminar documento</h4>
            </div>
            <div class="modal-body">
                <input type='hidden' name='idDocumentacion' id='idDocumentacion'>
                <input type='hidden' name='tipo' id='tipo'>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class="alert alert-danger text-center">Si lo eliminas no podrás recuperarlo.</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id='borraArchivo'> Eliminar</button>
                <button type="button" class="btn btn-white" data-dismiss="modal" id='btnTern'> Cerrar</button>
            </div>
        </div>
    </div>
</div>
