<?php 
    include 'modelo/consultaTablas.php';
    $misClientes = new consultaTabla();
    $rspTabla = $misClientes->informacionTabla();
?>
<script src="js/vista/misclientes.js"></script>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-12">
        <div class="title-action"><a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoClienteC"> Nuevo cliente</a>
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoClienteC"> Importar cliente</a>
        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoClienteC"> Reporte general</a></div>
    </div>
    <br>
    
    <div class="col-sm-12">
        <div class="ibox-content text-center">
            <form action='index.php' method="GET">
                <input type="hidden" name="secc" id="secc" value="faq">
                <label for="exampleInputPassword2" class="sr-only"></label>
                <input type="text" placeholder="Ingrese la palabra o palabras" id="busfaq" name="busfaq" class="form-control">
                <button class="form-control btn btn-primary" type="submit"><i class="fa fa-search"></i> Buscar</button>
                <hr>
            </form>
        </div>
    </div>
</div>
<div id="alertAccion"></div>

<div class="wrapper wrapper-content">
   <div class="col-lg-12">
        <div class="tabs-container">

            <div class="tabs-left">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-6"> Todos</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7">A</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7">B</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7">C</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7"></a></li>
                </ul>

                <div class="tab-content ">
                    <div id="tab-12" class="tab-pane active">
                        <div class="panel-body">

                                    <?php while($rspTablaInfo = $rspTabla->fetch_object()){ 
                                        //consulto la imagen dependiendo del usuario    
                                        $identi = $rspTablaInfo->idCliente;
                                        $rspImg = $misClientes->imgCliente($identi);
                                        $rspImgInfo = $rspImg->fetch_object();
                                        $imggg = $rspImgInfo->archivo;
                                    ?>
                                        <div class="col-lg-6">
                                            <div class="ibox panel panel-default">
                                                <div class="ibox-title">
                                                    <h5><?php echo $rspTablaInfo->noEmpresa; ?> <small><?= $rspTablaInfo->rfcEmpresa;?></small></h5>
                                                </div>
                                                <div class="ibox-content">
                                                        <div class="col-sm-4">
                                                            <div class="text-center"><img alt="image" class="img-rounded m-t-xs img-responsive" src="contenedor/logoClienteCliente/<?= $imggg; ?>"></div>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <p><i class="fa fa-map-marker"></i> <?= $rspTablaInfo->Dirección; ?></p>
                                                            <address>
                                                                <abbr title="Phone">Teléfono :</abbr> <?= $rspTablaInfo->tel1; ?><br>
                                                                <abbr title="Phone">Celular:</abbr> <?= $rspTablaInfo->cel1; ?><br>
                                                                <abbr title="mail"></abbr> <?= $rspTablaInfo->mail1; ?><br>
                                                            </address>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                </div>
                                                <div class="ibox-footer text-left">
                                                    <a href="index.php?secc=misfacturas" style='cursor: pointer'><button class="btn btn-primary" type="button">Facturas</button></a>
                                                    <button class="btn btn-primary" type="button"> Cotizaciones</button>
                                                    <button class="btn btn-primary" type="button"  data-toggle="modal" data-target="#SolicitarFactura"> Solicitar factura</button>
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#editaCliente" data-whatever="<?= $identi; ?>">Editar</button>
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#ModalEliminar" data-whatever="<?= $identi; ?>"> Eliminar</button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }?>
                        </div>
                    </div>


                    <div id="tab-7" class="tab-pane">
                        <div class="panel-body"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--seccion de contenido-->

<!--seccion para modals--->
<!--modal para anuevo clientes-->
<div class="modal inmodal fade" id="nuevoClienteC" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<div class="row text-center">
					<div class="cold-md-12 text-center">
						<iframe name="guardar" id="guardar" style="width: 90%; align-content: center; border: hidden; height: 30px;" class="text-center"></iframe>	
					</div>
				</div>
			</div>
			<div class="modal-body">
                <div>
                <h4>Datos de contacto</h4>
                <div class="form-group">
                     <form name="formularioGeneralNuevo" action="controlador/miclientesControlador.php" method="POST" target="guardar" enctype="multipart/form-data">
                        <input type='hidden' name='accion' id='accion' value='nuevo'>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="nombre" name="nombre" onkeypress="return soloLetras(event)"onkeypress="return lettersonly(event);" placeholder="Nombre" class="form-control">
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
                                    <input type="text" id="mail1" name="mail1" onkeypress="return lettersonly(event);" placeholder="Mail 1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="mail2" name="mail2" onkeypress="return lettersonly(event);" placeholder="Mail 2" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="direccion" name="direccion" onkeypress="return soloLetras(event)" placeholder="Dirección" class="form-control">
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
                                    <input type="file" name="archivo" id="archivo" class="form-control">
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
                                    <input type="text" id="noEmpresa" name="noEmpresa" onkeypress="return soloLetras(event)" placeholder="*Nombre" class="form-control">
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="razonSocial" name="razonSocial"  onkeypress="return soloLetras(event)" placeholder="Razón Social" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="rfcEmpresa" name="rfcEmpresa" onkeypress="return lettersonly(event);" placeholder="*RFC" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        <!--//////////////////////////////-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="dirEmpresa" name="dirEmpresa" onkeypress="return soloLetras(event)" placeholder="Dirección" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="coloniaEmpresa" name="coloniaEmpresa" onkeypress="return soloLetras(event)" placeholder="Colonia" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="cpEmpresa" name="cpEmpresa" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="*CP" class="form-control">
                                </div>
                            </div>
                            
                        </div>  
                        <!--//////////////////////////////-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="estadoEmpresa" name="estadoEmpresa" onkeypress="return soloLetras(event)" placeholder="Estado" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="ciudadEmpresa" name="ciudadEmpresa" onkeypress="return soloLetras(event)" placeholder="Ciudad" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <select name="pais" id="pais" class="form-control">
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
                                    <input type="text" id="tel1Empresa" name="tel1Empresa" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="Teléfono" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="mail1Empresa" name="mail1Empresa" onkeypress="return lettersonly(event);" placeholder="*Mail 1" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="mail2Empresa" name="mail2Empresa"  onkeypress="return lettersonly(event);" placeholder="Mail 2" class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        
                        
                        <!--///////////////////////////////-->
                        <div class="row">
                             <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <input type="text" id="mail3Empresa" name="mail3Empresa" onkeypress="return lettersonly(event);" placeholder="Mail 3" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group m-b">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                    <select class="form-control">
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
                                    <textarea name="observacionesEmpresa" id="observacionesEmpresa" class="form-control" placeholder="Observaciones"></textarea>
                                    
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
				<h4 class="modal-title" id="titulo">Eliminar</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="idCliente" id="idCliente">
    			<div class="alert alert-danger text-center">¿Estás seguro de eliminar este cliente? Una vez eliminado no podrás recuperarlo.</div>
			</div>
			<div class="modal-footer">
				<button type="button" id='btnElimina' class="btn btn-w-m btn-danger"></i> Eliminar</button>
				<button type="button" id='btnEliminar' class="btn btn-white" data-dismiss="modal"></i> Cerrar</button>
			</div>
		</div>
	</div>
</div>
<!--modal para la edicion del cliente-->
<div class="modal inmodal fade" id="editaCliente" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<div class="row text-center">
					<div class="cold-md-12 text-center">
						<iframe name="editar" id="editar" style="width: 90%; align-content: center; border: hidden; height: 30px;" class="text-center"></iframe>	
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="panel panel-default">
                    <div class="panel-heading">Datos de contacto <small>*Datos necesarios</small></div>
                        <div class="panel-body">
                            <div class="form-group">
                                 <form name="formularioGeneralEdicion" action="controlador/miclientesControlador.php" method="POST" target="editar" enctype="multipart/form-data">
                                    <input type='hidden' name='accion' id='accion' value='editar'>
                                    <input type="hidden" name="idCliente1" id="idCliente1">
									<div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="nombre1" name="nombre1" onkeypress="return soloLetras(event)" placeholder="Nombre" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="apePaterno1" name="apePaterno1" onkeypress="return soloLetras(event)"" placeholder="Apellido Paterno" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="apeMaterno1" name="apeMaterno1" onkeypress="return soloLetras(event)" placeholder="Apellido Materno" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--//////////////////////////////-->
                                    <!--//////////////////////////////-->
                                    <div class="row">
                                      
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="departamento1" name="departamento1"  onkeypress="return soloLetras(event)" placeholder="Departamento" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="puesto1" name="puesto1"  onkeypress="return soloLetras(event)" placeholder="Puesto" class="form-control">
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="tel11" name="tel11"  onkeypress="return NumCheck(event, this)" placeholder="Télefono 1" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <!--//////////////////////////////-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="tel21" name="tel21" onkeypress="return NumCheck(event, this)" placeholder="Télefono 2" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="cel11" name="cel11"  onkeypress="return NumCheck(event, this)" placeholder="Celular 1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="cel21" name="cel21"  onkeypress="return NumCheck(event, this)" placeholder="Celular 2" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--//////////////////////////////-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="mail11" name="mail11" onkeypress="return lettersonly(event);" placeholder="Mail 1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="mail21" name="mail21" onkeypress="return lettersonly(event);" placeholder="Mail 2" class="form-control">
                                            </div>
                                        </div>
										<div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="direccion1" name="direccion1" onkeypress="return soloLetras(event)" placeholder="Dirección" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--//////////////////////////////-->
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="cp1" name="cp1" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="CP" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                                                <select name="estado1" id="estado1" class="form-control">
                                                   <option value="">:: Seleccione su estado ::</option>
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
                                                <input type="text" id="colonia1" name="colonia1" onkeypress="return soloLetras(event)" placeholder="Colonia" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--//////////////////////////////-->
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="ciudad1" name="ciudad1" onkeypress="return soloLetras(event)" placeholder="Ciudad" class="form-control">
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <!--//////////////////////////////-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <textarea name="observaciones1" id="observaciones1" class="form-control" placeholder="Observaciones"></textarea>
                                            </div>
                                        </div>
									</div>
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon">Logotipo</span> 
                                                <input type="file" name="archivo1" id="archivo1" class="form-control" required>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="panel panel-default">
                            <div class="panel-heading">Datos de la empresa</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="noEmpresa1" name="noEmpresa1" onkeypress="return soloLetras(event)" placeholder="*Nombre de la empresa" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="dirEmpresa1" name="dirEmpresa1" onkeypress="return soloLetras(event)" placeholder="*Dirección" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="coloniaEmpresa1" name="coloniaEmpresa1" onkeypress="return soloLetras(event)" placeholder="Colonia" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--//////////////////////////////-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="cpEmpresa1" name="cpEmpresa1" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="*CP" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="estadoEmpresa1" name="estadoEmpresa1" onkeypress="return soloLetras(event)" placeholder="Estado" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="ciudadEmpresa1" name="ciudadEmpresa1" onkeypress="return soloLetras(event)" placeholder="Ciudad" class="form-control">
                                            </div>
                                        </div>
                                    </div>  
                                    <!--//////////////////////////////-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="tel1Empresa1" name="tel1Empresa1" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="Teléfono 1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="tel2Empresa1" name="tel2Empresa1" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="Teléfono 2" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="cel1Empresa1" name="cel1Empresa1" maxlength="10" onkeypress="return numbersonly(event);" placeholder="Celular 1" class="form-control">                                          
                                            </div>
                                        </div>
                                    </div>
                                    <!--//////////////////////////////-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="cel2Empresa1" name="cel2Empresa1" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="Celular 2" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="mail1Empresa1" name="mail1Empresa1" onkeypress="return lettersonly(event);" placeholder="*Mail 1" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="mail2Empresa1" name="mail2Empresa1"  onkeypress="return lettersonly(event);" placeholder="Mail 2" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--//////////////////////////////-->
                                    <div class="row">
										 <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="mail3Empresa1" name="mail3Empresa1" onkeypress="return lettersonly(event);" placeholder="Mail 3" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="paginaWeb1" name="paginaWeb1" onkeypress="return lettersonly(event);" placeholder="Pagina Web" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="giroEmpresa1" name="giroEmpresa1" onkeypress="return soloLetras(event)" placeholder="Giro" class="form-control">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!--//////////////////////////////-->
                                    <div class="row">
										<div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="razonSocial1" name="razonSocial1"  onkeypress="return soloLetras(event)" placeholder="*Razón Social" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="rfcEmpresa1" name="rfcEmpresa1" onkeypress="return lettersonly(event);" placeholder="*RFC" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <select name="pais1" id="pais1" class="form-control">
                                                <option>Afganistán</option>
                                                <option>Albania</option>
                                                <option>Alemania</option>
                                                <option>Andorra</option>
                                                <option>Angola</option>
                                                <option>Antigua y Barbuda</option>
                                                <option>Arabia Saudita</option>
                                                <option>Argelia</option>
                                                <option>Argentina</option>
                                                <option>Armenia</option>
                                                <option>Australia</option>
                                                <option>Austria</option>
                                                <option>Azerbaiyán</option>
                                                <option>Bahamas</option>
                                                <option>Bangladés</option>
                                                <option>Barbados</>
                                                <option>Baréin</option>
                                                <option>Bélgica</option>
                                                <option>Belice</option>
                                                <option>Benín</option>
                                                <option>Bielorrusia</option>
                                                <option>Birmania</option>
                                                <option>Bolivia</option>
                                                <option>Bosnia y Herzegovina</option>
                                                <option>Botsuana</option>
                                                <option>Brasil</option>
                                                <option>Brunéi</option>
                                                <option>Bulgaria</option>
                                                <option>Burkina Faso</option>
                                                <option>Burundi</option>
                                                <option>Bután</option>
                                                <option>Cabo Verde</option>
                                                <option>Camboya</option>
                                                <option>Camerún</option>
                                                <option>Canadá</option>
                                                <option>Catar</option>
                                                <option>Chad</option>
                                                <option>Chile</option>
                                                <option>China</option>
                                                <option>Chipre</option>
                                                <option>Ciudad del Vaticano</option>
                                                <option>Colombia</option>
                                                <option>Comoras</option>
                                                <option>Corea del Norte</option>
                                                <option>Corea del Sur</option>
                                                <option>Costa de Marfil</option>
                                                <option>Costa Rica</option>
                                                <option>Croacia</option>
                                                <option>Cuba</>
                                                <option>Dinamarca</option>
                                                <option>Dominica</option>
                                                <option>Ecuador</option>
                                                <option>Egipto</option>
                                                <option>El Salvador</option>
                                                <option>Emiratos Árabes Unidos</option>
                                                <option>Eritrea</option>
                                                <option>Eslovaquia</option>
                                                <option>Eslovenia</option>
                                                <option>España</option>
                                                <option>Estados Unidos</option>
                                                <option>Estonia</option>
                                                <option>Etiopía</>
                                                <option>Filipinas</option>
                                                <option>Finlandia</option>
                                                <option>Fiyi</option>
                                                <option>Francia</option>
                                                <option>Gabón</option>
                                                <option>Gambia</option>
                                                <option>Georgia</option>
                                                <option>Ghana</option>
                                                <option>Granada</option>
                                                <option>Grecia</option>
                                                <option>Guatemala</option>
                                                <option>Guyana</option>
                                                <option>Guinea</option>
                                                <option>Guinea-Bisáu</option>
                                                <option>Guinea Ecuatorial</option>
                                                <option>Haití</option>
                                                <option>Honduras</>
                                                <option>Hungría</option>
                                                <option>India</option>
                                                <option>Indonesia</option>
                                                <option>Irak</option>
                                                <option>Irán</option>
                                                <option>Irlanda</option>
                                                <option>Islandia</option>
                                                <option>Islas Marshall</option>
                                                <option>Islas Salomón</option>
                                                <option>Israel</option>
                                                <option>Italia</option>
                                                <option>Jamaica</option>
                                                <option>Japón</option>
                                                <option>Jordania</option>
                                                <option>Kazajistán</option>
                                                <option>Kenia</option>
                                                <option>Kirguistán</option>
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
                                                <option>México</option>
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
                                    <!--///////////////////////////////-->
                                    <div class="row">
										<div class="col-md-4">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <input type="text" id="tiempoCredito1" name="tiempoCredito1"  onkeypress="return NumCheck(event, this)" placeholder="Fecha de crédito por dias" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!--///////////////////////////////-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group m-b">
                                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                                <textarea name="observacionesEmpresa1" id="observacionesEmpresa1" class="form-control" placeholder="Observaciones de la empresa"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                 
                            </div>
                        </div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"></i> Editar</button>
				<button type="button" class="btn btn-white" id='btncerraeditar' data-dismiss="modal"></i>Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!--solicitamos factura--->
<!--solicitar factura modal--->
<div class="modal inmodal fade" id="SolicitarFactura" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="titulo">Solicitar factura</h4>
            </div>
            <div class="modal-body">
                <h4>¿Quieres mostrar esta información en la factura?</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><input type="checkbox"></span> 
                            <input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="Datos completos del cliente" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><input type="checkbox"></span>
                            <input class="form-control" type="text" id="producto" name="prodcuto" placeholder="Añadir dirección de entrega" disabled>
                        </div>
                    </div>
                </div>
                <hr>
                <h4>Datos de factura</h4>
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                            <select class="form-control">
                                <option>Uso de CFDI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <select class="form-control">
                                <option>Método de pago</option>
                                <option>PUE - Pago en una sola exhibición</option>
                                <option>PPD - Pago en parcialidades diferido</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <select class="form-control">
                                <option>Forma de pago</option>
                                <option>Catálogo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <select class="form-control">
                                <option>Moneda</option>
                                <option>Catálogo</option>
                            </select>
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="Tipo de cambio">
                            
                        </div>
                    </div>
                </div>
                <hr>
                <h4>Agrega tus productos o servicios</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                            <input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="Busca tu producto o servicio">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <input class="form-control" type="text" id="producto" name="prodcuto" placeholder="Cantidad">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <input class="form-control" type="text" id="producto" name="prodcuto" placeholder="Precio">
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
                <!--div class="row">
                    <div class="col-md-12">
                        <div class="input-group m-b">
                            <p>Producto Unn , Cantidad : 35 , Precio: 099, Descripción: hola <a href="" class="btn"  style="background-color: #f1005e; color: #FFFFFF" data-toggle="modal" data-target="#nuevoprodu" title="Cancelar"><i class="fa fa-trash-o"></i></a></p>
                        </div>
                    </div>
                </div-->
                <hr>
                <h4>Total de la factura</h4>
                <!--h4>Total de la factura moral y el producto servicios profesionales</h4-->
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
                            <input class="form-control" type="text" id="claveSat" name="claveSat"  placeholder="IVA" disabled>
                            <input class="form-control" type="hidden" id="claveSat" name="claveSat"  placeholder="subtotal-descuentos*0.16 = IVA" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <input class="form-control" type="text" id="producto" name="prodcuto" placeholder="ISR" disabled>
                            <input class="form-control" type="hidden" id="producto" name="prodcuto" placeholder="ISR(subtotal*.1) | IVA (subtotal*.106666667) Impuestos retenidos" disabled>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group m-b">
                            <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                            <input class="form-control" type="text" id="producto" name="prodcuto" placeholder="Total" disabled>
                            <input class="form-control" type="hidden" id="producto" name="prodcuto" placeholder="subtotal-decuentos+iva-retenciones = Total" disabled>
                        </div>
                    </div>
                </div>
                <!--h4>Total de la factura física</h4>
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
                            <input class="form-control" type="text" id="producto" name="prodcuto" placeholder="subtotal-decuentos = Total" disabled>
                        </div>
                    </div>
                </div-->
                
                
                
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#nuevoprodu" title="Reenviar">Solicitar</a>
                <button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
            </div>
            </form>
        </div>
    </div>
</div>
