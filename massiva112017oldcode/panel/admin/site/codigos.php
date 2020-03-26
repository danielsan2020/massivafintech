<?php
    //instanciamos el metodo para mostrar la informacion
    include 'modelo/codigoModelo.php';
    $codg = new codg();
    $rspTabla = $codg->informacionTabla();
?>
<!--seccion de contenido-->
<script src="js/vista/codigos.js"></script>
<div class="wrapper wrapper-content animated fadeInRight">
    <?php if($nncod == 1){  ?>
        <div class="col-lg-12"> <div class="alert alert-warning text-center" role="alert">Se agregó tu código</div></div>
    <?php }?>
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title"><h5>Generación de códigos</h5></div>
                <div class="ibox-content">
                    <form name="ncodi" action="controlador/codigoControlador.php" method="POST">
                    <input type="hidden" id="accion" name='accion' value="nuevoCodi">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group m-b">
                                <span class="input-group-addon">Empresa o referencia</span> 
                                <input type="text" class="form-control" name="empresa" id="empresa">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group m-b">
                                <span class="input-group-addon">Ciudad </span> 
                                <select class="form-control" name="ciudad" id="ciudad">
                                    <option>AGU</option><option>BCN</option>
                                    <option>BCS</option><option>CAM</option>
                                    <option>CHP</option><option>CHH</option>
                                    <option>COA</option><option>COL</option>
                                    <option>CMX</option><option>DUR</option>
                                    <option>GUA</option><option>GRO</option>
                                    <option>HID</option><option>JAL</option>
                                    <option>MEX</option><option>MIC</option>
                                    <option>MOR</option><option>NAY</option>
                                    <option>NLE</option><option>OAX</option>
                                    <option>PUE</option><option>QUE</option>
                                    <option>ROO</option><option>SLP</option>
                                    <option>SIN</option><option>SON</option>
                                    <option>TAB</option><option>TAM</option>
                                    <option>TLA</option><option>VER</option>
                                    <option>YUC</option><option>ZAC</option>
                                </select>
                             </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group m-b">
                                <span class="input-group-addon">Número inicial</span> 
                                <input type="text" class="form-control" name="numIni" id="numIni">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group m-b">
                                <span class="input-group-addon">Número final</span> 
                                <input type="text" class="form-control" name="numFin" id='numFin'>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group m-b">
                                <span class="input-group-addon">Fecha vigencia</span> 
                                <input type="date" class="form-control" name='fechaVigencia' id="fechaVigencia">
                            </div>
                        </div>
                    </div>
                    <div class="row text-center"><button type="submit" class="btn btn-primary" >Generar</button></div>
                </form>
                </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12" id="alertAccion"></div>
    </div>
    <!--seccion de concentrado-->
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5><b>Códigos</b></h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Número de código</th>
                        <th>Código</th>
                        <th>Fecha de vigencia</th>
                        <th>Contrato</th>
                        <th>Estatus</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while($rspTablaInfo = $rspTabla->fetch_object()){ 
                        $numero = $rspTablaInfo->empresa."_".$rspTablaInfo->ciudad."_".$rspTablaInfo->numero;
                    ?>
                    <tr>
                        <td><?= $rspTablaInfo->idCodigo;?></td>
                        <td><?= $numero;?></td>
                        <td><?= $rspTablaInfo->fechaVigencia;?></td>
                        <td>
                            <?php 
                                if($rspTablaInfo->contrato == ''){
                                    echo "Sin asignar";
                                }else{
                                   echo $rspTablaInfo->contrato; 
                                }
                            ?>
                            
                        </td>
                        <td>
                            <?php
                                if($rspTablaInfo->estatus == 1 ){
                                    echo "Activo";
                                }else{ echo "Inactivo";}
                            ?>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-primary" data-toggle="modal" title="Agregar a contrato" data-target="#contrato" data-unoo="<?= $rspTablaInfo->idCodigo; ?>">Asignar</button>
                            <button class="btn btn-primary" data-toggle="modal" title="Editar publicación" data-target="#eliminar" data-unoo="<?= $rspTablaInfo->idCodigo; ?>">Eliminar</button>
                        </td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        <br>
    </div>
</div>
<br>

<!--modal par agaregra a contacto-->
<div class="modal inmodal fade" id="contrato" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <div class="row text-center"><h3>Asignar contrato a código</h3></div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type='hidden' name='idCodigo' id='idCodigo'>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="contratof" name="contratof" placeholder="Numero de contrato" class="form-control">
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="modal-footer">
                <button type="button" id='agregarContr' class="btn btn-primary"> Asignar contrato</button>
                <button type="button" class="btn btn-white" id='btncerrAsingCon' data-dismiss="modal"> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!--modal para eliminar-->
<div class="modal inmodal fade" id="eliminar" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="titulo">Eliminar código</h4>
            </div>
            <div class="modal-body">
                <input type="text" name="idCodigo2" id="idCodigo2">
                <div class="alert alert-danger text-center">¿Está de acuerdo de eliminar el código? Recuerda que al eliminarlo no habrá forma de recuperar la información.</div>
            </div>
            <div class="modal-footer">
                <button type="button" id='btnElimina' class="btn btn-w-m btn-danger"> Eliminar </button>
                <button type="button" class="btn btn-white" id="nbtelim" data-dismiss="modal"> Cerrar</button>
            </div>
        </div>
    </div>
</div>