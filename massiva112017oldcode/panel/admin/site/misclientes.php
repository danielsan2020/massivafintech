<?php 
    include 'modelo/consultaTablas.php';
    $misClientes = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
    
    if($busfaqCli == ''){
        $rspTabla = $misClientes->informacionTabla_cli($id_usuario);
    }else{
        $rspTabla = $misClientes->informacionTabla_cliBuis($id_usuario,$busfaqCli);
    }

    /* obtenemos el uso de cdfi */
    $rspUcdfi = $misClientes->obtenemoscdfi();
    
    /* obtenemos la forma de pago */
    $rspformaPago = $misClientes->FormaPago();
    
    /* obtenemos la moenda  */
    $rspmonedadd = $misClientes->monedadd();

    /* obtenemos los servicios que tenemos registrados */

    //obtenemos las consultas para datos predictivos
    $serviciosObt = $misClientes->serviciosObt($id_usuario);
    $texto = '';
    while($serviciosObtInfo = $serviciosObt->fetch_object()){
    	$texto .= "'".$serviciosObtInfo->idServicio." | ".$serviciosObtInfo->titulo."',";
    	//$texto .= "'".$valorDescriInfo->descripcion."',";
	}
    
?>
<script src="js/vista/misclientes.js"></script>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <div class="title-action">
            
                <form action='index.php' method='GET'>
                    <input type='hidden' name='secc' id='secc' value='directorioClientes'>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoClienteC" > Nuevo cliente</button>
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#terminados" > Directorio clientes</button>
                </form>
            
        </div>
    </div>
</div>
<hr>
<div id="alertAccion">
    <?php 
        //seccion para alertas de acciones
        if($nueClien == 1){ echo "<div class='row'> <div class='alert alert-warning text-center'><b>Se agregó tu cliente.</b></div></div>"; }
        if($nueClien == 2){ echo "<div class='row'> <div class='alert alert-warning text-center'><b>Se editó tu cliente.</b></div></div>"; }
        if($nueClien == 3){ echo "<div class='row'> <div class='alert alert-warning text-center'><b>Se eliminó tu cliente.</b></div></div>";}
        if($nueClien == 4){ echo "<div class='row'> <div class='alert alert-warning text-center'><b>Tu imagen es muy pesada, por favor súbe una más pequeña.</b></div></div>";}
    ?>
</div>
<div class="row">    
    <div class="col-sm-12">
        <div class="ibox-content text-center">
            <form action='index.php' method="GET">
                <input type='hidden' name='secc' id='secc' value='misclientes'>
                <label for="exampleInputPassword2" class="sr-only"></label>
                <input type="text" placeholder="Ingrese la palabra o palabras" id="busfaqCli" name="busfaqCli" class="form-control">
                <button class="form-control btn btn-primary" type="submit"><i class="fa fa-search"></i> Buscar</button>
                <hr>
            </form>
        </div>
    </div>
</div>


<div class="row">
    <div class="panel-body">
        <?php while($rspTablaInfo = $rspTabla->fetch_object()){ 
            //consulto la imagen dependiendo del usuario    
            $identi = $rspTablaInfo->idCliente;
        ?>
            <div class=" col-md-4">
                <div class="ibox panel panel-default">
                    <div class="ibox-title">
                        <h5><?php echo $rspTablaInfo->nombreE; ?> <small><?= $rspTablaInfo->rfcE;?></small></h5>
                    </div>

                    <!-- estos valores son para el usuario generico -->
                    <?php if($rspTablaInfo->fijo == 1){ ?>
                    <div class="ibox-content">
                            
                            <div class="col-sm-4">
                                <div class="text-center"><img alt="image" style='height:100px;' class="img-rounded m-t-xs img-responsive" src="img/<?= $rspTablaInfo->logo; ?>"></div>
                            </div>
                            
                            <div class="col-sm-8">
                                <!-- <p><i class="fa fa-map-marker"></i> <?= $rspTablaInfo->dirE; ?></p> -->
                                <address>
                                    <abbr title="Phone">C.P :</abbr> <?= $rspTablaInfo->cpE; ?><br>
                                    <abbr title="Phone">Correo:</abbr> <?= $rspTablaInfo->correo1E; ?><br><hr>
                                    <abbr title="mail"></abbr> <?= $rspTablaInfo->observacionesE; ?><br>
                                </address>
                            </div>
                            <div class="clearfix"></div>
                    </div>
                    <div class="ibox-footer text-left">
                        <div class="row form-horizontal">
                            <div class="col-md-6"><a href="index.php?secc=misfacturas" class="btn btn-primary" style='cursor: pointer; width: 100%'>Facturas</a></div>
                            <div class="col-md-6"><a href="index.php?secc=solicitaFactura&idCliFa=<?php echo $identi;?>" class="btn btn-primary" style='cursor: pointer; width: 100%'>Solicitar Facturas</a></div>
                        </div>
                    </div>
                    <!-- estos son los clientes normal -->
                    <?php }else{?>
                    <div class="ibox-content">
                            
                            <div class="col-sm-4">
                                <div class="text-center"><img alt="image" style='height:100px;' class="img-rounded m-t-xs img-responsive" src="contenedor/logoClienteCliente/<?= $rspTablaInfo->logo; ?>"></div>
                            </div>
                            
                            <div class="col-sm-8">
                                <!-- <p><i class="fa fa-map-marker"></i> <?= $rspTablaInfo->dirE; ?></p> -->
                                <address>
                                    <abbr title="Phone">Teléfono :</abbr> <?= $rspTablaInfo->tel1; ?><br>
                                    <abbr title="Phone">Correo:</abbr> <?= $rspTablaInfo->cel1; ?><br>
                                    <abbr title="mail"></abbr> <?= $rspTablaInfo->mail1; ?><br>
                                </address>
                            </div>
                            <div class="clearfix"></div>
                    </div>
                    <div class="ibox-footer text-left">
                        <div class="row">
                            <div class='container-fluid'>
                                <div class='row'>
                                    <div class="col-md-6"><a href="index.php?secc=misfacturas" class="btn btn-primary" style='cursor: pointer; width: 100%'>Facturas</a></div>
                                    <div class="col-md-6"><a href="index.php?secc=solicitaFactura&idCliFa=<?php echo $identi;?>" class="btn btn-primary" style='cursor: pointer; width: 100%'>Solicitar Facturas</a></div>
                                </div>
                                <hr>
                                <div class='row'>
                                    <div class="col-md-5"><a href="index.php?secc=cotizacion" class="btn btn-primary" style='cursor: pointer; width: 100%'>Cotizaciones</a></div>
                                    
                                    <div class="col-md-3"><a href="#" data-toggle="modal" data-target="#editaCliente" data-unoo="<?= $rspTablaInfo->idCliente; ?>" data-doss="<?= $rspTablaInfo->logo; ?>" class=" btn btn-primary" style='cursor: pointer; width: 100%'>Editar</a></div>
                                    <div class="col-md-4"><a href="#" data-toggle="modal" data-target="#ModalEliminar" data-unoo="<?= $rspTablaInfo->idCliente; ?>" data-doss="<?= $rspTablaInfo->logo; ?>" class=" btn btn-primary" style='cursor: pointer; width: 100%'>Eliminar</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>

                </div>
            </div>
        <?php }?>
    </div>
            
</div>    
<hr>

<!--seccion para modals--->
<!--modal para anuevo clientes-->
<div class="modal inmodal fade" id="nuevoClienteC" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header"> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>
			<div class="modal-body">
                <div>
                <h4>Datos de contacto</h4>
                <div class="form-group">
                     <form name="formularioGeneralNuevo" action="controlador/miclientesControlador.php" method="POST" enctype="multipart/form-data">
                        <input type='hidden' name='accion' id='accion' value='nuevo'>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="nombre" name="nombre" onkeypress="return soloLetras(event)" onkeypress="return lettersonly(event);" placeholder="Nombre" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="apePaterno" name="apePaterno" onkeypress="return soloLetras(event)" placeholder="Apellido Paterno" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="apeMaterno" name="apeMaterno" onkeypress="return soloLetras(event)" placeholder="Apellido Materno" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--//////////////////////////////-->
                        <div class="row">
                          
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="departamento" name="departamento"  onkeypress="return soloLetras(event)" placeholder="Departamento" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="puesto" name="puesto"  onkeypress="return soloLetras(event)" placeholder="Puesto" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="tel1" name="tel1"  onkeypress="return NumCheck(event, this)" placeholder="Teléfono 1" class="form-control">
                                </div>
                            </div>
                        </div>
                      
                        <!--//////////////////////////////-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="tel2" name="tel2"  onkeypress="return NumCheck(event, this)" placeholder="Télefono 2" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="cel1" name="cel1"  onkeypress="return NumCheck(event, this)" placeholder="Celular 1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="cel2" name="cel2"  onkeypress="return NumCheck(event, this)" placeholder="Celular 2" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--//////////////////////////////-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="correo1" name="correo1"  placeholder="Mail 1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="correo2" name="correo2"  placeholder="Mail 2" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="dir" name="dir" onkeypress="return soloLetras(event)" placeholder="Dirección" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--//////////////////////////////-->
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="cp" name="cp" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="CP" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                                    <select name="estado" id="estado" class="form-control">
                                       <option value="">Seleccione su estado</option>
                                       <option value="Aguascalientes">Aguascalientes</option>
                                       <option value="Baja California">Baja California</option>
                                       <option value="Baja California Sur">Baja California Sur</option>
                                       <option value="Campeche">Campeche</option>
                                       <option value="Coahuila">Coahuila</option>
                                       <option value="Colima">Colima</option>
                                       <option value="Chiapas">Chiapas</option>
                                       <option value="Chihuahua">Chihuahua</option>
                                       <option value="CDMX">CDMX</option>
                                       <option value="Durango">Durango</option>
                                       <option value="Guanajuato">Guanajuato</option>
                                       <option value="Guerrero">Guerrero</option>
                                       <option value="Hidalgo">Hidalgo</option>
                                       <option value="Jalisco">Jalisco</option>
                                       <option value="México">México</option>
                                       <option value="Michoacán">Michoacán</option>
                                       <option value="Morelos">Morelos</option>
                                       <option value="Nayarit">Nayarit</option>
                                       <option value="Nuevo León">Nuevo León</option>
                                       <option value="Oaxaca">Oaxaca</option>
                                       <option value="Puebla">Puebla</option>
                                       <option value="Querétaro">Querétaro</option>
                                       <option value="Quintana Roo">Quintana Roo</option>
                                       <option value="San Luis Potosí">San Luis Potosí</option>
                                       <option value="Sinaloa">Sinaloa</option>
                                       <option value="Sonora">Sonora</option>
                                       <option value="Tabasco">Tabasco</option>
                                       <option value="Tamaulipas">Tamaulipas</option>
                                       <option value="Tlaxcala">Tlaxcala</option>
                                       <option value="Veracruz">Veracruz</option>
                                       <option value="Yucatán">Yucatán</option>
                                       <option value="Zacatecas">Zacatecas</option>
                                                                                            
                                    </select>  
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="colonia" name="colonia" onkeypress="return soloLetras(event)" placeholder="Colonia" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--//////////////////////////////-->
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="ciudad" name="ciudad" maxlength="10" onkeypress="return soloLetras(event)" placeholder="Ciudad" class="form-control">
                                </div>
                            </div>
                           
                        </div>
                        <!--//////////////////////////////-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <textarea name="observaciones" id="observaciones" class="form-control" placeholder="Observaciones"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group m-b">
                                    <span class="input-group-addon">Logotipo</span> 
                                    <input type="file" name="logo" id="logo" class="form-control" >
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
				<hr>

                <div>
                    <h4>Datos de facturación<small>  *Obligatorios</small></h4>
                     
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="nombreE" name="nombreE" onkeypress="return soloLetras(event)" placeholder="*Nombre" class="form-control">
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="razonSocialE" name="razonSocialE"  onkeypress="return soloLetras(event)" placeholder="Razón Social" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="rfcE" name="rfcE" onkeypress="return lettersonly(event);" placeholder="*RFC" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        <!--//////////////////////////////-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="dirE" name="dirE" onkeypress="return soloLetras(event)" placeholder="Dirección" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="coloniaE" name="coloniaE" onkeypress="return soloLetras(event)" placeholder="Colonia" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="cpE" name="cpE" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="*CP" class="form-control">
                                </div>
                            </div>
                            
                        </div>  
                        <!--//////////////////////////////-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="estadoE" name="estadoE" onkeypress="return soloLetras(event)" placeholder="Estado" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="ciudadE" name="ciudadE" onkeypress="return soloLetras(event)" placeholder="Ciudad" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <select name="paisE" id="paisE" class="form-control">
                                        <option>Seleccione un país</option>
                                        <option>Afganistán</option><option>Albania</option><option>Alemania</option><option>Andorra</option>
                                        <option>Angola</option><option>Antigua y Barbuda</option><option>Arabia Saudita</option>
                                        <option>Argelia</option><option>Argentina</option><option>Armenia</option>
                                        <option>Australia</option><option>Austria</option><option>Azerbaiyán</option><option>Bahamas</option>
                                        <option>Bangladés</option><option>Barbados</option><option>Baréin</option><option>Bélgica</option>
                                        <option>Belice</option><option>Benín</option><option>Bielorrusia</option><option>Birmania</option>
                                        <option>Bolivia</option><option>Bosnia y Herzegovina</option><option>Botsuana</option>
                                        <option>Brasil</option><option>Brunéi</option><option>Bulgaria</option><option>Burkina Faso</option>
                                        <option>Burundi</option><option>Bután</option><option>Cabo Verde</option><option>Camboya</option>
                                        <option>Camerún</option><option>Canadá</option><option>Catar</option><option>Chad</option><option>Chile</option><option>China</option>
                                        <option>Chipre</option><option>Ciudad del Vaticano</option><option>Colombia</option><option>Comoras</option><option>Corea del Norte</option>
                                        <option>Corea del Sur</option><option>Costa de Marfil</option><option>Costa Rica</option><option>Croacia</option><option>Cuba</option>
                                        <option>Dinamarca</option><option>Dominica</option><option>Ecuador</option><option>Egipto</option><option>El Salvador</option>
                                        <option>Emiratos Árabes Unidos</option><option>Eritrea</option><option>Eslovaquia</option><option>Eslovenia</option><option>España</option>
                                        <option>Estados Unidos</option><option>Estonia</option><option>Etiopía</option><option>Filipinas</option><option>Finlandia</option>
                                        <option>Fiyi</option><option>Francia</option><option>Gabón</option><option>Gambia</option><option>Georgia</option><option>Ghana</option>
                                        <option>Granada</option><option>Grecia</option><option>Guatemala</option><option>Guyana</option><option>Guinea</option><option>Guinea-Bisáu</option>
                                        <option>Guinea Ecuatorial</option><option>Haití</option><option>Honduras</option><option>Hungría</option><option>India</option><option>Indonesia</option>
                                        <option>Irak</option><option>Irán</option><option>Irlanda</option><option>Islandia</option><option>Islas Marshall</option><option>Islas Salomón</option>
                                        <option>Israel</option><option>Italia</option><option>Jamaica</option><option>Japón</option><option>Jordania</option><option>Kazajistán</option>
                                        <option>Kenia</option><option>Kirguistán</option>
                                        <option>Kiribati</option>
                                        <option>Kuwait</option>
                                        <option>Laos</option>
                                        <option>Lesoto</option>
                                        <option>Letonia</option>
                                        <option>Líbano</option>
                                        <option>Liberia</option>
                                        <option>Libia</option>
                                        <option>Liechtenstein</option>
                                        <option>Lituania</option>
                                        <option>Luxemburgo</option>
                                        <option>Madagascar</option>
                                        <option>Malasia</option>
                                        <option>Malaui</option>
                                        <option>Maldivas</option>
                                        <option>Malí</option>
                                        <option>Malta</option>
                                        <option>Marruecos</option>
                                        <option>Mauricio</option>
                                        <option>Mauritania</option>
                                        <option value="MX">México</option>
                                        <option>Micronesia</option>
                                        <option>Moldavia</option>
                                        <option>Mónaco</option>
                                        <option>Mongolia</option>
                                        <option>Montenegro</option>
                                        <option>Mozambique</option>
                                        <option>Namibia</option>
                                        <option>Nauru</option>
                                        <option>Nepal</option>
                                        <option>Nicaragua</option>
                                        <option>Níger</option>
                                        <option>Nigeria</option>
                                        <option>Noruega</option>
                                        <option>Nueva Zelanda</option>
                                        <option>Omán</option>
                                        <option>Países Bajos</option>
                                        <option>Pakistán</option>
                                        <option>Palaos</option>
                                        <option>Panamá</option>
                                        <option>Papúa Nueva Guinea</option>
                                        <option>Paraguay</option>
                                        <option>Perú</option>
                                        <option>Polonia</option>
                                        <option>Portugal</option>
                                        <option>Reino Unido de Gran Bretaña e Irlanda del Norte</option>
                                        <option>República Centroafricana</option>
                                        <option>República Checa</option>
                                        <option>República de Macedonia</option>
                                        <option>República del Congo</option>
                                        <option>República Democrática del Congo</option>
                                        <option>República Dominicana</option>
                                        <option>República Sudafricana</option>
                                        <option>Ruanda</option>
                                        <option>Rumanía</option>
                                        <option>Rusia</option>
                                        <option>Samoa</option>
                                        <option>San Cristóbal y Nieves</option>
                                        <option>San Marino</option>
                                        <option>San Vicente y las Granadinas</option>
                                        <option>Santa Lucía</option>
                                        <option>Santo Tomé y Príncipe</option>
                                        <option>Senegal</option>
                                        <option>Serbia</option>
                                        <option>Seychelles</option>
                                        <option>Sierra Leona</option>
                                        <option>Singapur</option>
                                        <option>Siria</option>
                                        <option>Somalia</option>
                                        <option>Sri Lanka</option>
                                        <option>Suazilandia</option>
                                        <option>Sudán</option>
                                        <option>Sudán del Sur</option>
                                        <option>Suecia</option>
                                        <option>Suiza</option>
                                        <option>Surinam</option>
                                        <option>Tailandia</option>
                                        <option>Tanzania</option>
                                        <option>Tayikistán</option>
                                        <option>Timor Oriental</option>
                                        <option>Togo</option>
                                        <option>Tonga</option>
                                        <option>Trinidad y Tobago</option>
                                        <option>Túnez</option></option>
                                        <option>Turkmenistán</option>
                                        <option>Turquía</option>
                                        <option>Tuvalu</option>
                                        <option>Ucrania</option>
                                        <option>Uganda</option>
                                        <option>Uruguay</option>
                                        <option>Uzbekistán</option>
                                        <option>Vanuatu</option>
                                        <option>Venezuela</option>
                                        <option>Vietnam</option>
                                        <option>Yemen</option>
                                        <option>Yibuti</option>
                                        <option>Zambia</option>
                                        <option>Zimbabue</option>
                                    </select>
                                </div>
                            </div>

                           
                          
                           
                        </div>
                        <!--//////////////////////////////-->
                        <div class="row">

                             <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="telE" name="telE" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="Teléfono" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="correo1E" name="correo1E"  placeholder="*Mail 1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="correo2E" name="correo2E"  placeholder="Mail 2" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        <!--///////////////////////////////-->
                        <div class="row">
                             <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="correo3E" name="correo3E"  placeholder="Mail 3" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <select class="form-control" name="creditoE" id="creditoE">
                                        <option>Selecciona días de crédito</option>
                                        <option value="1">Contado</option>
                                        <option value="8">8 días</option>
                                        <option value="15">15 días</option>
                                        <option value="30">30 días</option>
                                        <option value="60">60 días</option>
                                        <option value="90">90 días</option>
                                        <option value="120">120 días</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--///////////////////////////////-->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <textarea name="observacionesE" id="observacionesE" class="form-control" placeholder="Observaciones"></textarea>
                                    
                                </div>
                            </div>
                        </div>
                    </div> 
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Guardar</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!--modal para eliminar el cliente-->
<div class="modal inmodal fade" id="ModalEliminar" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">Eliminar cliente</h4>
			</div>
            <form action='controlador/miclientesControlador.php' method='POST'>
                <input type='hidden' name='accion' id='accion' value='eliminarVAl'>
                <div class="modal-body">
                    <input type="hidden" name="idCliente" id="idCliente">
                    <input type="hidden" name="imgLog" id="imgLog">
                    
                    <div class="alert alert-danger text-center">¿Estás segúro de eliminar este cliente? Una vez eliminado no podrás recuperarlo.</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id='btnElimina' class="btn btn-w-m btn-danger"></i> Eliminar</button>
                    <button type="button" id='btnEliminar' class="btn btn-white" data-dismiss="modal"></i> Cerrar</button>
                </div>
            </form>
		</div>
	</div>
</div>
<!--modal para editar el cliente-->
<div class="modal inmodal fade" id="editaCliente" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header"><h4 class="modal-title" id="titulo">Editar cliente</h4> <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>
			<div class="modal-body">
                <div>
                <h4>Datos de contacto</h4>
                <div class="form-group">
                     <form name="formularioGeneralNuevo" action="controlador/miclientesControlador.php" method="POST" enctype="multipart/form-data">
                        <input type='hidden' name='accion' id='accion' value='edicion'>
                        <input type="hidden" name="idClienteE1" id="idClienteE1">
                        <input type="hidden" name="imgLogE1" id="imgLogE1">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="nombreE1" name="nombreE1" onkeypress="return soloLetras(event)" onkeypress="return lettersonly(event);" placeholder="Nombre" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="apePaternoE" name="apePaternoE" onkeypress="return soloLetras(event)" placeholder="Apellido Paterno" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="apeMaternoE" name="apeMaternoE" onkeypress="return soloLetras(event)" placeholder="Apellido Materno" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--//////////////////////////////-->
                        <div class="row">
                          
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="departamentoE" name="departamentoE"  onkeypress="return soloLetras(event)" placeholder="Departamento" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="puestoE" name="puestoE"  onkeypress="return soloLetras(event)" placeholder="Puesto" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="tel1E" name="tel1E"  onkeypress="return NumCheck(event, this)" placeholder="Teléfono 1" class="form-control">
                                </div>
                            </div>
                        </div>
                      
                        <!--//////////////////////////////-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="tel2E" name="tel2E"  onkeypress="return NumCheck(event, this)" placeholder="Télefono 2" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="cel1E" name="cel1E"  onkeypress="return NumCheck(event, this)" placeholder="Celular 1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="cel2E" name="cel2E"  onkeypress="return NumCheck(event, this)" placeholder="Celular 2" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--//////////////////////////////-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="correo1E1" name="correo1E1"  placeholder="Mail 1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="correo2E1" name="correo2E1"  placeholder="Mail 2" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="dirE1" name="dirE1" onkeypress="return soloLetras(event)" placeholder="Dirección" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--//////////////////////////////-->
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="cpE1" name="cpE1" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="CP" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                                    <select name="estadoE1" id="estadoE1" class="form-control">
                                       <option value="">Seleccione su estado</option>
                                       <option value="Aguascalientes">Aguascalientes</option>
                                       <option value="Baja California">Baja California</option>
                                       <option value="Baja California Sur">Baja California Sur</option>
                                       <option value="Campeche">Campeche</option>
                                       <option value="Coahuila">Coahuila</option>
                                       <option value="Colima">Colima</option>
                                       <option value="Chiapas">Chiapas</option>
                                       <option value="Chihuahua">Chihuahua</option>
                                       <option value="CDMX">CDMX</option>
                                       <option value="Durango">Durango</option>
                                       <option value="Guanajuato">Guanajuato</option>
                                       <option value="Guerrero">Guerrero</option>
                                       <option value="Hidalgo">Hidalgo</option>
                                       <option value="Jalisco">Jalisco</option>
                                       <option value="México">México</option>
                                       <option value="Michoacán">Michoacán</option>
                                       <option value="Morelos">Morelos</option>
                                       <option value="Nayarit">Nayarit</option>
                                       <option value="Nuevo León">Nuevo León</option>
                                       <option value="Oaxaca">Oaxaca</option>
                                       <option value="Puebla">Puebla</option>
                                       <option value="Querétaro">Querétaro</option>
                                       <option value="Quintana Roo">Quintana Roo</option>
                                       <option value="San Luis Potosí">San Luis Potosí</option>
                                       <option value="Sinaloa">Sinaloa</option>
                                       <option value="Sonora">Sonora</option>
                                       <option value="Tabasco">Tabasco</option>
                                       <option value="Tamaulipas">Tamaulipas</option>
                                       <option value="Tlaxcala">Tlaxcala</option>
                                       <option value="Veracruz">Veracruz</option>
                                       <option value="Yucatán">Yucatán</option>
                                       <option value="Zacatecas">Zacatecas</option>
                                                                                            
                                    </select>  
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="coloniaE1" name="coloniaE1" onkeypress="return soloLetras(event)" placeholder="Colonia" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--//////////////////////////////-->
                        <div class="row">
                            
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="ciudadE1" name="ciudadE1" maxlength="10" onkeypress="return soloLetras(event)" placeholder="Ciudad" class="form-control">
                                </div>
                            </div>
                           
                        </div>
                        <!--//////////////////////////////-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <textarea name="observacionesE1" id="observacionesE1" class="form-control" placeholder="Observaciones"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group m-b">
                                    <span class="input-group-addon">Logotipo</span> 
                                    <input type="file" name="logoE1" id="logoE1" class="form-control" required>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
				<hr>

                <div>
                    <h4>Datos de facturación<small>  *Obligatorios</small></h4>
                     
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="nombreEE" name="nombreEE" onkeypress="return soloLetras(event)" placeholder="*Nombre" class="form-control">
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="razonSocialEE" name="razonSocialEE"  onkeypress="return soloLetras(event)" placeholder="Razón Social" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="rfcEE" name="rfcEE" onkeypress="return lettersonly(event);" placeholder="*RFC" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        <!--//////////////////////////////-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="dirEE" name="dirEE" onkeypress="return soloLetras(event)" placeholder="Dirección" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="coloniaEE" name="coloniaEE" onkeypress="return soloLetras(event)" placeholder="Colonia" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="cpEE" name="cpEE" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="*CP" class="form-control">
                                </div>
                            </div>
                        </div>  
                        <!--//////////////////////////////-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="estadoEE" name="estadoEE" onkeypress="return soloLetras(event)" placeholder="Estado" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="ciudadEE" name="ciudadEE" onkeypress="return soloLetras(event)" placeholder="Ciudad" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="paisEE1" name="paisEE1" disabled class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--//////////////////////////////-->
                        <div class="row">
                             <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="telEE" name="telEE" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="Teléfono" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="correo1EE" name="correo1EE"  placeholder="*Mail 1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="correo2EE" name="correo2EE"  placeholder="Mail 2" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        <!--///////////////////////////////-->
                        <div class="row">
                             <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="correo3EE" name="correo3EE"  placeholder="Mail 3" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <select class="form-control" name="creditoEE" id="creditoEE">
                                        <option>Selecciona días de crédito</option>
                                        <option value="1">Contado</option>
                                        <option value="8">8 días</option>
                                        <option value="15">15 días</option>
                                        <option value="30">30 días</option>
                                        <option value="60">60 días</option>
                                        <option value="90">90 días</option>
                                        <option value="120">120 días</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--///////////////////////////////-->

                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <textarea name="observacionesEE" id="observacionesEE" class="form-control" placeholder="Observaciones"></textarea>
                                    
                                </div>
                            </div>
                        </div>
                    </div> 
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"> Guardar</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!--solicitar factura modal--->
<div class="modal inmodal fade" id="SolicitarFactura" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="titulo">Solicitar factura</h4>
            </div>
            <div class="modal-body">
                <div class='valorTexto'></div>
                <h4>¿Quieres mostrar esta información en la factura?</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><input type="checkbox" id="datoscompletos" name="datoscompletos"></span> 
                            <input class="form-control" type="text"   placeholder="Datos completos del cliente" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><input type="checkbox"  id="andire" name="andire"></span>
                            <input class="form-control" type="text" placeholder="Añadir dirección de entrega" disabled>
                        </div>
                    </div>
                </div>
                <hr>
                <h4>Datos de factura</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                            <select class="form-control" id="uso" name="uso">
                                <option>Uso de CFDI</option>
                                <?php while($rspUcdfiInfo = $rspUcdfi->fetch_object()){ ?>
                                    <option value='<?= $rspUcdfiInfo->clave;?>'><?= $rspUcdfiInfo->descripcion;?></option>
                                <?php }?>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <select class="form-control" >
                                <option>Método de pago</option>
                                <option>PUE - Pago en una sola exhibición</option>
                                <option>PPD - Pago en parcialidades diferido</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <select class="form-control" id="forma" name="forma">
                                <option>Forma de pago</option>
                                <?php while($rspformaPagoIfno = $rspformaPago->fetch_object()){ ?>
                                    <option value='<?= $rspformaPagoIfno->descripcion;?>'><?= $rspformaPagoIfno->descripcion;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <select class="form-control" id="moneda" name="moneda">
                                <option>Moneda</option>
                                <?php while($rspmonedaddInfo = $rspmonedadd->fetch_object()){ ?>
                                    <option value='<?= $rspmonedaddInfo->clave;?>'><?= $rspmonedaddInfo->clave;?></option>
                                <?php }?>
                            </select>
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <input class="form-control" type="text" id="tipoCambio" name="tipoCambio"  placeholder="Tipo de cambio">
                            
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-12'>
                        <button type="button" class="btn btn-primary" id='gareg'> Agregar servicios o productos</button>
                    </div>
                </div>
                <hr>
                <div id='pro' style='display:none;'>
                <h4>Agrega tus productos o servicios</h4>
                <input type='hidden' name='idFactura' id='idFactura'>
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                            <input class="form-control typeahead_1" type="text" id="claveSat" name="claveSat"  placeholder="Busca tu producto o servicio" >
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <input class="form-control" type="text" id="cantidadPro" name="cantidadPro" placeholder="Cantidad">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <input class="form-control" type="text" id="precioPro" name="precioPro" placeholder="Precio">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <input class="form-control" type="text" id="producto" name="prodcuto" placeholder="Descuento %">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <input class="form-control" type="text" id="producto" name="prodcuto" placeholder="Total" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="input-group m-b">
                            <span class="input-group-addon">Descripción</span>
                            <textarea class="form-control" placeholder="Descripción">
                            
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group m-b">
                            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoprodu" title="Agregar producto"><i class="fa fa-plus-square"></i></a>
                        </div>
                    </div>
                
                </div>
                <div class="row">
                    <div class="col-md-12">
                        
                    </div>
                </div>
                </div>
                <hr>
             
                <h4>Total de la factura</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                            <input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="Subtotal" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                            <input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="Descuentos" disabled>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <input class="form-control" type="text" id="producto" name="prodcuto" placeholder="Total" disabled>
                        </div>
                    </div>
                </div>
                
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" id='solicitttt' data-dismiss="modal"> Solicitar</button>
                <button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
<script>
$(document).ready(function(){ 
	/* Funcion para los mostrar predictivos los servicios */
	$('.typeahead_1').typeahead({ source: [<?php echo  $texto; ?>] });  
	/* Funcion para los mostrar predictivos los productos */
	
});
</script>