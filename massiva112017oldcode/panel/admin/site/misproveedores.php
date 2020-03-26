<?php 
    @session_start();
    include 'modelo/consultaTablas.php';
    $misClientes = new consultaTabla();
    $id_usuario = $_SESSION['id_usuario'];
    $rfc = $_SESSION['rfc'];
    /* aqui verificamos qsi realizamos una busqueda de proveeores */
    if($busProvee == ''){
        $rspTabla = $misClientes->proveeconsiu($id_usuario);
    }else{
        $rspTabla = $misClientes->proveeconsiuBus($id_usuario,$busProvee);
    }
?>
<script src="js/vista/misproveedores.js"></script>
<div class='container-fluid'>
    <!-- menu -->
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-md-12">
            <div class="title-action">
                <form action='index.php' method='GET'>
                    <input type='hidden' name='secc' id='secc' value='directorioClientes'>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevoClienteC" > Nuevo proveedor</button>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <!-- texto -->
    <div class="row">
        <div class="col-md-12" >
            <div class="alert alert-warning text-center"> 
                <b>Tus tickets de compra</b>, son también tus proveedores, cuando factures tus tickets se registrarán automáticamente en <b>Mis proveedores</b>.
                <br>Si tu proveedor no tiene tickets de compra, tú debes de dar de alta al proveedor en esta misma sección, <b>no te tomará más de 1 minuto.</b>
                <br><b>Facturas sin asignar</b>, son aquellas facturas que un proveedor te realizó pero no están asignadas a un gasto tuyo, ya sea en efectivo o por transferencia bancaria.
                <br>El asignar un gasto con una factura de un proveedor te ayuda a deducir impuestos y a tener al día tu contabilidad.
                <br>¿Sigues teniendo dudas? <a data-toggle="modal" data-target="#aviso79" style='color:  rgb(226, 0, 74)'> Clic aquí</a>
        </div>
        <br>
    </div>
    <!-- seccion de avisos -->
    <br>
    <hr>
        <?php
            //seccion para alertas de acciones
            if($vapro == 1){ echo "<br><div class='row'><div class='col-md-12'> <div class='alert alert-warning text-center'><b>Se agregó tu proveedor.</b></div></div></div>"; }
            if($vapro == 2){ echo "<br><div class='row'><div class='col-md-12'> <div class='alert alert-warning text-center'><b>Se editó tu proveedor.</b></div></div></div>"; }
            if($vapro == 3){ echo "<br><div class='row'><div class='col-md-12'> <div class='alert alert-warning text-center'><b>Se eliminó tu cliente.</b></div></div></div>";}
        ?>
    <hr>
    <!--seccion para el buscador y el abecedario-->
    <div class="row">    
        <div class="col-sm-12">
            <div class="ibox-content text-center">
                <form action='index.php' method="GET">
                    <input type='hidden' name='secc' id='secc' value='misproveedores'>
                    <label for="exampleInputPassword2" class="sr-only"></label>
                    <input type="text" placeholder="Ingrese la palabra o palabras" id="busProvee" name="busProvee" class="form-control">
                    <button class="form-control btn btn-primary" type="submit"><i class="fa fa-search"></i> Buscar</button>
                    <hr>
                </form>
            </div>
        </div>
    </div>
    <!--seccion de contenido-->
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="panel-body">
            <?php while($rspTablaInfo = $rspTabla->fetch_object()){ ?>
                <div class=" col-md-4">
                    <div class="ibox panel panel-default">
                        <div class="ibox-title"><h5><?php echo $rspTablaInfo->razon;?><small></small></h5></div>
                        <div class="ibox-content">
                                <div class="col-sm-4"><div class="text-center"><img alt="image" style='height:100px;' class="img-rounded m-t-xs img-responsive" src="contenedor/clientes/<?php echo $rfc;?>/proveedores/<?php echo $rspTablaInfo->logo?>"></div></div>
                                <div class="col-sm-8">
                                    <address>
                                        <abbr title="Phone">RFC:</abbr> <?php echo $rspTablaInfo->rfcPro;?><br>
                                        <abbr title="Phone">Dirección:</abbr> <?php echo $rspTablaInfo->direcc;?> <br>
                                        <abbr title="Phone">Télefono:</abbr> <?php echo $rspTablaInfo->telefeo;?><br>
                                        <abbr title="Phone">Correo:</abbr> <?php echo $rspTablaInfo->correo;?><br><hr>
                                        
                                        <abbr title="mail"></abbr> <br>
                                    </address>
                                </div>
                                <div class="clearfix"></div>
                        </div>
                        <div class="ibox-footer text-left">
                            <div class="row">
                                <div class='container-fluid'>
                                    <!--div class='row'>
                                        <div class="col-md-6"><a href="index.php?secc=misfacturas" class="btn btn-primary" style='cursor: pointer; width: 100%'>Facturas</a></div>
                                        <div class="col-md-6"><a href="index.php?secc=solicitaFactura&idCliFa=" class="btn btn-primary" style='cursor: pointer; width: 100%'>Solicitar Facturas</a></div>
                                    </div>
                                    <hr-->
                                    <div class='row'>
                                    <div class="col-md-6"><a href="#" data-toggle="modal" data-target="#editapro" data-unoo='<?php echo $rspTablaInfo->idproveedor;?>' class=" btn btn-primary" style='cursor: pointer; width: 100%'>Editar</a></div>
                                    <div class="col-md-6"><a href="#" data-toggle="modal" data-target="#ModalEliminar" data-unoo='<?php echo $rspTablaInfo->idproveedor;?>'  class=" btn btn-primary" style='cursor: pointer; width: 100%'>Eliminar</a></div>        
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class='row'>
                            </div>
                        </div>
                        <!-- estos son los clientes normal -->
                    </div>
                </div>
            <?php }?>
            </div>
        </div>
    </div>
</div>

<!--seccion para modals--->
<!--modal para anuevo clientes-->
<div class="modal inmodal fade" id="nuevoClienteC" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
            <form class="input-group" action="controlador/proveedoresControlador.php" method="POST" name='fornuefo' id='fornuefo' enctype="multipart/form-data">
            <input type='hidden' name='accion' id='accion' value='nuevoPro'>
			<div class="modal-body">
                <h4 >Datos de la empresa</h4>
                <div class="form-group">
                    <div class="row">
						<div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="rfc" name="rfc" onkeypress="return lettersonly(event);" placeholder="*RFC" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="nombre" name="nombre" onkeypress="return soloLetras(event)" placeholder="*Nombre de la empresa" class="form-control">
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
                                <input type="text" id="colonia" name="colonia" onkeypress="return soloLetras(event)" placeholder="Colonia" class="form-control">
                            </div>
                        </div>
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
                    </div>
                    <!--//////////////////////////////-->
                    <div class="row">
                         <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="ciudad" name="ciudad" onkeypress="return soloLetras(event)" placeholder="Ciudad" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="tel" name="tel" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="Teléfono " class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="correo" name="correo" onkeypress="return lettersonly(event);" placeholder="Mail" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!--//////////////////////////////-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="pagina" name="pagina" onkeypress="return lettersonly(event);" placeholder="Pagina Web" class="form-control">
                            </div>
                        </div>
						<div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="razon" name="razon"  onkeypress="return soloLetras(event)" placeholder="Razón Social" class="form-control">
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
                                    <option>Israel</option><option>Italia</option><option>Jamaica</option><option>Japón</option><option>Jordania</option><option>Kazajistán</option><option>Kenia</option><option>Kirguistán</option><option>Kiribati</option><option>Kuwait</option><option>Laos</option><option>Lesoto</option><option>Letonia</option><option>Líbano</option><option>Liberia</option><option>Libia</option><option>Liechtenstein</option><option>Lituania</option><option>Luxemburgo</option><option>Madagascar</option><option>Malasia</option><option>Malaui</option><option>Maldivas</option><option>Malí</option><option>Malta</option><option>Marruecos</option><option>Mauricio</option><option>Mauritania</option><option>México</option><option>Micronesia</option><option>Moldavia</option><option>Mónaco</option><option>Mongolia</option><option>Montenegro</option><option>Mozambique</option><option>Namibia</option><option>Nauru</option><option>Nepal</option><option>Nicaragua</option><option>Níger</option><option>Nigeria</option><option>Noruega</option><option>Nueva Zelanda</option><option>Omán</option><option>Países Bajos</option><option>Pakistán</option><option>Palaos</option><option>Panamá</option><option>Papúa Nueva Guinea</option><option>Paraguay</option><option>Perú</option><option>Polonia</option><option>Portugal</option><option>Reino Unido de Gran Bretaña e Irlanda del Norte</option><option>República Centroafricana</option><option>República Checa</option><option>República de Macedonia</option><option>República del Congo</option><option>República Democrática del Congo</option><option>República Dominicana</option><option>República Sudafricana</option><option>Ruanda</option><option>Rumanía</option><option>Rusia</option><option>Samoa</option><option>San Cristóbal y Nieves</option><option>San Marino</option><option>San Vicente y las Granadinas</option><option>Santa Lucía</option><option>Santo Tomé y Príncipe</option><option>Senegal</option><option>Serbia</option><option>Seychelles</option><option>Sierra Leona</option><option>Singapur</option><option>Siria</option><option>Somalia</option><option>Sri Lanka</option><option>Suazilandia</option><option>Sudán</option><option>Sudán del Sur</option><option>Suecia</option><option>Suiza</option><option>Surinam</option><option>Tailandia</option><option>Tanzania</option><option>Tayikistán</option><option>Timor Oriental</option><option>Togo</option><option>Tonga</option><option>Trinidad y Tobago</option><option>Túnez</option><option>Turkmenistán</option><option>Turquía</option><option>Tuvalu</option><option>Ucrania</option><option>Uganda</option><option>Uruguay</option><option>Uzbekistán</option><option>Vanuatu</option><option>Venezuela</option><option>Vietnam</option><option>Yemen</option><option>Yibuti</option><option>Zambia</option><option>Zimbabue</option>
                                    </select>
                            </div>
                        </div>
                    </div>
                    <!--///////////////////////////////-->
                    <div class="row">
						<div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                 <select class="form-control" name='dias' id='dias'>
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
						<div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <select class="form-control" name='tipo' id='tipo'>
									<option>Selecciona tipo de proveedor</option>
									<option>Proveedor de mercancías</option>
									<option>Proveedor de servicios</option>
									<option>Gastos en general</option>
								</select>
                            </div>
                        </div>
                    </div>
                    <!--///////////////////////////////-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <textarea name="observaciones" id="observaciones" class="form-control" placeholder="Observaciones de la empresa"></textarea>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-12">
                            <div class="input-group m-b">
                                <span class="input-group-addon">Logotipo</span> 
                                <input type="file" name="logo" id="logo" class="form-control">
                            </div>
                         </div>
                    </div>
                </div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Guardar</button>
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
			</div>

			<form action="controlador/proveedoresControlador.php" method="POST" name='fornuefo' id='fornuefo' enctype="multipart/form-data">
            <div class="modal-body">
                <div class='row'>
                    <div class='col-md-12'>
                        <input type="hidden" name="idproveedorEli" id="idproveedorEli">
                        <input type="hidden" name="accion" id="accion" value='eliminaPro'>
                        <div class="alert alert-danger text-center" style='width:100%'>Recuerda que al eliminarlo no podrás recuperar la información.</div>
                    </div>
                </div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-w-m btn-danger"> Eliminar</button>
				<button type="button" id='btnEliminar' class="btn btn-white" data-dismiss="modal"> Cerrar</button>
			</div>
            </form>

		</div>
	</div>
</div>
<!--modal para la edicion del cliente-->
<div class="modal inmodal fade" id="editapro" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			</div>
            <form class="input-group" action="controlador/proveedoresControlador.php" method="POST" enctype="multipart/form-data">
			<div class="modal-body">
            
            <input type='hidden' name='accion' id='accion' value='EditaPro'>
            <input type='hidden' name='idproveedorEdiAc' id='idproveedorEdiAc' >
            <input type='hidden' name='valogo' id='valogo' >

                <h4 >Datos de la empresa</h4>
                <div class="form-group">
                    <div class="row">
						<div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="rfc1" name="rfc1" onkeypress="return lettersonly(event);" placeholder="*RFC" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="nombre1" name="nombre1" onkeypress="return soloLetras(event)" placeholder="*Nombre de la empresa" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="dir1" name="dir1" onkeypress="return soloLetras(event)" placeholder="Dirección" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!--//////////////////////////////-->
                    <div class="row">
                         <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="colonia1" name="colonia1" onkeypress="return soloLetras(event)" placeholder="Colonia" class="form-control">
                            </div>
                        </div>
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
                    </div>
                    <!--//////////////////////////////-->
                    <div class="row">
                         <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="ciudad1" name="ciudad1" onkeypress="return soloLetras(event)" placeholder="Ciudad" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="tel1" name="tel1" maxlength="10" onkeypress="return NumCheck(event, this)" placeholder="Teléfono " class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="correo1" name="correo1" onkeypress="return lettersonly(event);" placeholder="Mail" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!--//////////////////////////////-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="pagina1" name="pagina1" onkeypress="return lettersonly(event);" placeholder="Pagina Web" class="form-control">
                            </div>
                        </div>
						<div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <input type="text" id="razon1" name="razon1"  onkeypress="return soloLetras(event)" placeholder="Razón Social" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <select name="pais1" id="pais1" class="form-control">
                                    <option value='Afganistán' >Afganistán</option>
                                        <option value='Albania'>Albania</option>
                                        <option value='Alemania'>Alemania</option>
                                        <option value='Andorra'>Andorra</option>
                                        <option value='Angola'>Angola</option>
                                        <option value='Antigua y Barbuda'>Antigua y Barbuda</option>
                                        <option value='Arabia Saudita'>Arabia Saudita</option>                     
                                        <option value='Argelia'>Argelia</option>
                                        <option value='Argentina'>Argentina</option>
                                        <option value='Armenia'>Armenia</option>
                                        <option value='Australia'>Australia</option>
                                        <option value='Austria'>Austria</option>
                                        <option value='Azerbaiyán'>Azerbaiyán</option>
                                        <option value='Bahamas'>Bahamas</option>
                                        <option value='Bangladés'>Bangladés</option>
                                        <option value='Barbados'>Barbados</option>
                                        <option value='Baréin'>Baréin</option>
                                        <option value='Bélgica'>Bélgica</option> 
                                        <option value='Belice'>Belice</option>
                                        <option value='Benín'>Benín</option>
                                        <option value='Bielorrusia'>Bielorrusia</option>
                                        <option value='Birmania'>Birmania</option>
                                        <option value='Bolivia'>Bolivia</option>
                                        <option value='Bosnia y Herzegovina'>Bosnia y Herzegovina</option>
                                        <option value='Botsuana'>Botsuana</option>
                                        <option value='Brasil'>Brasil</option>
                                        <option value='Brunéi'>Brunéi</option>
                                        <option value='Bulgaria'>Bulgaria</option>
                                        <option value='Burkina'>Burkina Faso</option>
                                        <option value='Burundi'>Burundi</option>
                                        <option value='Bután'>Bután</option>
                                        <option value='Cabo Verde'>Cabo Verde</option>
                                        <option value='Camboya'>Camboya</option>
                                        <option value='Camerún'>Camerún</option>
                                        <option value='Canadá'>Canadá</option>
                                        <option value='Catar'>Catar</option>
                                        <option value='Chad'>Chad</option>
                                        <option value='Chile'>Chile</option>
                                        <option value='China'>China</option>
                                        <option value='Chipre'>Chipre</option>
                                        <option value='Ciudad del Vaticano'>Ciudad del Vaticano</option>
                                        <option value='Colombia'>Colombia</option>
                                        <option value='Comoras'>Comoras</option>
                                        <option value='Corea del Norte'>Corea del Norte</option>
                                        <option value='Corea del Sur'>Corea del Sur</option>
                                        <option value='Costa de Marfil'>Costa de Marfil</option>
                                        <option value='Costa Rica'>Costa Rica</option>
                                        <option value='Croacia'>Croacia</option>
                                        <option value='Cuba'>Cuba</option>
                                        <option value='Dinamarca'>Dinamarca</option>
                                        <option value='Dominica'>Dominica</option>
                                        <option value='Ecuador'>Ecuador</option>
                                        <option value='Egipto'>Egipto</option>
                                        <option value='El Salvador'>El Salvador</option>
                                        <option value='Emiratos Árabes Unidos'>Emiratos Árabes Unidos</option>
                                        <option value='Eritrea'>Eritrea</option>
                                        <option value='Eslovaquia'>Eslovaquia</option>
                                        <option value='Eslovenia'>Eslovenia</option>
                                        <option value='España'>España</option>
                                        <option value='Estados Unidos'>Estados Unidos</option>
                                        <option value='Estonia'>Estonia</option>
                                        <option value='Etiopía'>Etiopía</option>
                                        <option value='Filipinas'>Filipinas</option>
                                        <option value='Finlandia'>Finlandia</option>
                                        <option value='Fiyi'>Fiyi</option>
                                        <option value='Francia'>Francia</option>
                                        <option value='Gabón'>Gabón</option>
                                        <option value='Gambia'>Gambia</option>
                                        <option value='Georgia'>Georgia</option>
                                        <option value='Ghana'>Ghana</option>
                                        <option value='Granada'>Granada</option>
                                        <option value='Grecia'>Grecia</option>
                                        <option value='Guatemala'>Guatemala</option>
                                        <option value='Guayana'>Guyana</option>
                                        <option value='Guinea'>Guinea</option>
                                        <option value='Guinea-Bisáu'>Guinea-Bisáu</option>
                                        <option value='Guinea Ecuatorial'>Guinea Ecuatorial</option>
                                        <option value='Haití'>Haití</option>
                                        <option value='Honduras'>Honduras</option>
                                        <option value='Hungría'>Hungría</option>
                                        <option value='India'>India</option>
                                        <option value='Indonesia'>Indonesia</option>
                                        <option value='Irak'>Irak</option>
                                        <option value='Irán'>Irán</option>
                                        <option value='Irlanda'>Irlanda</option>
                                        <option value='Islandia'>Islandia</option>
                                        <option value='Islas Marshall'>Islas Marshall</option>
                                        <option value='Islas Salomón'>Islas Salomón</option>
                                        <option value='Israel'>Israel</option>
                                        <option value='Italia'>Italia</option>
                                        <option value='Jamaica'>Jamaica</option>
                                        <option value='Japón'>Japón</option>
                                        <option value='Jordania'>Jordania</option>
                                        <option value='Kazajistán'>Kazajistán</option>
                                        <option value='Kenia'>Kenia</option>
                                        <option value='Kirguistán'>Kirguistán</option>
                                        <option value='Kiribati'>Kiribati</option>
                                        <option value='Kuwait'>Kuwait</option>
                                        <option value='Laos'>Laos</option>
                                        <option value='Lesoto'>Lesoto</option>
                                        <option value='Letonia'>Letonia</option>
                                        <option value='Líbano'>Líbano</option>
                                        <option value='Liberia'>Liberia</option>
                                        <option value='Libia'>Libia</option>
                                        <option value='Liechtenstein'>Liechtenstein</option>
                                        <option value='Lituania'>Lituania</option>
                                        <option value='Luxemburgo'>Luxemburgo</option>
                                        <option value='Madagascar'>Madagascar</option>
                                        <option value='Malasia'>Malasia</option>
                                        <option value='Malaui'>Malaui</option>
                                        <option value='Maldivas'>Maldivas</option>
                                        <option value='Malí'>Malí</option>
                                        <option value='Malta'>Malta</option>
                                        <option value='Marruecos'>Marruecos</option>
                                        <option value='Mauricio'>Mauricio</option>
                                        <option value='Mauritania'>Mauritania</option>
                                        <option value='México'>México</option>
                                        <option value='Micronesia'>Micronesia</option>
                                        <option value='Moldavia'>Moldavia</option>
                                        <option value='Mónaco'>Mónaco</option>
                                        <option value='Mongolia'>Mongolia</option>
                                        <option value='Montenegro'>Montenegro</option>
                                        <option value='Mozambique'>Mozambique</option>
                                        <option value='Namibia'>Namibia</option>
                                        <option value='Nauru'>Nauru</option>
                                        <option value='Nepal'>Nepal</option>
                                        <option value='Nicaragua'>Nicaragua</option>
                                        <option value='Níger'>Níger</option>
                                        <option value='Nigeria'>Nigeria</option>
                                        <option value='Noruega'>Noruega</option>
                                        <option value='Nueva Zelanda'>Nueva Zelanda</option>
                                        <option value='Omán'>Omán</option>
                                        <option value='Países Bajos'>Países Bajos</option>
                                        <option value='Pakistán'>Pakistán</option>
                                        <option value='Palaos'>Palaos</option>
                                        <option value='Panamá'>Panamá</option>
                                        <option value='Papúa Nueva Guinea'>Papúa Nueva Guinea</option>
                                        <option value='Paraguay'>Paraguay</option>
                                        <option value='Perú'>Perú</option>
                                        <option value='Polonia'>Polonia</option>
                                        <option value='Portugal'>Portugal</option>
                                        <option value='Reino Unido de Gran Bretaña e Irlanda del Norte'>Reino Unido de Gran Bretaña e Irlanda del Norte</option>
                                        <option value='República Centroafricana'>República Centroafricana</option>
                                        <option value='República Checa'>República Checa</option>
                                        <option value='República de Macedonia'>República de Macedonia</option>
                                        <option value='República del Congo'>República del Congo</option>
                                        <option value='República Democrática del Congo'>República Democrática del Congo</option>
                                        <option value='República Dominicana'>República Dominicana</option>
                                        <option value='República Sudafricana'>República Sudafricana</option>
                                        <option value='Ruanda'>Ruanda</option>
                                        <option value='Rumanía'>Rumanía</option>
                                        <option value='Rusia'>Rusia</option>
                                        <option value='Samoa'>Samoa</option>
                                        <option value='San Cristóbal y Nieves'>San Cristóbal y Nieves</option>
                                        <option value='San Marino'>San Marino</option>
                                        <option value='San Vicente y las Granadinas'>San Vicente y las Granadinas</option>
                                        <option value='Santa Lucía'>Santa Lucía</option>
                                        <option value='Santo tomé y Príncipe'>Santo Tomé y Príncipe</option>
                                        <option value='Senegal'>Senegal</option>
                                        <option value='Serbia'>Serbia</option>
                                        <option value='Seychelles'>Seychelles</option>
                                        <option value='Sierra Leona'>Sierra Leona</option>
                                        <option value='Singapur'>Singapur</option>
                                        <option value='Siria'>Siria</option>
                                        <option value='Somalia'>Somalia</option>
                                        <option value='Sri Lanka'>Sri Lanka</option>
                                        <option value='Suazilandia'>Suazilandia</option>
                                        <option value='Sudán'>Sudán</option>
                                        <option value='Sudán del sur'>Sudán del Sur</option>
                                        <option value='Suecia'>Suecia</option>
                                        <option value='Suiza'>Suiza</option>
                                        <option value='Surinam'>Surinam</option>
                                        <option value='Tailandia'>Tailandia</option>
                                        <option value='Tanzania'>Tanzania</option>
                                        <option value='Tayikistán'>Tayikistán</option>
                                        <option value='Timor Oriental'>Timor Oriental</option>
                                        <option value='Togo'>Togo</option>
                                        <option value='Tonga'>Tonga</option>
                                        <option value='Trinidad y Tobago'>Trinidad y Tobago</option>
                                        <option value='Túnez'>Túnez</option>
                                        <option value='Turkmenistán'>Turkmenistán</option>
                                        <option value='Turquía'>Turquía</option>
                                        <option value='Tuvalu'>Tuvalu</option>
                                        <option value='Ucrania'>Ucrania</option>
                                        <option value='Uganda'>Uganda</option>
                                        <option value='Uruguay'>Uruguay</option>
                                        <option value='Uzbekistán'>Uzbekistán</option>
                                        <option value='Vanuatu'>Vanuatu</option>
                                        <option value='Venezuela'>Venezuela</option>
                                        <option value='Vietnam'>Vietnam</option>
                                        <option value='Yemen'>Yemen</option>
                                        <option value='Yibuti'>Yibuti</option>
                                        <option value='Zambia'>Zambia</option>
                                        <option value='Zimbabue'>Zimbabue</option>
                                    </select>
                            </div>
                        </div>
                    </div>
                    <!--///////////////////////////////-->
                    <div class="row">
						<div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                 <select class="form-control" name='dias1' id='dias1'>
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
						<div class="col-md-4">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <select class="form-control" name='tipo1' id='tipo1'>
									<option>Selecciona tipo de proveedor</option>
									<option value='Proveedor de mercancías'>Proveedor de mercancías</option>
									<option value='Proveedor de servicios'>Proveedor de servicios</option>
									<option value='Gastos en general'>Gastos en general</option>
								</select>
                            </div>
                        </div>
                    </div>
                    <!--///////////////////////////////-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group m-b">
                                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 
                                <textarea name="observaciones1" id="observaciones1" class="form-control" placeholder="Observaciones de la empresa"></textarea>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-12">
                            <div class="input-group m-b">
                                <span class="input-group-addon">Logotipo</span> 
                                <input type="file" name="logo1" id="logo1" class="form-control">
                            </div>
                         </div>
                    </div>
                </div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Guardar</button>
				<button type="button" class="btn btn-white" id='btncerranuevo' data-dismiss="modal"> Cerrar</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!--modal para aviso -->
<div class="modal inmodal fade" id="aviso79" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="titulo">DIFERENCIA ENTRE PROVEEDOR CON TICKET DE COMPRA Y PROVEEDOR CON FACTURA.</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="idCliente" id="idCliente">
    			<div class="alert alert-warning text-center">Un <b>proveedor con ticket de compra</b> es cuando tu vas a comprar un producto en un comercio y te dan el ticket de compra. Este ticket tu debes facturarlo o bien solicitas que massiva lo facture por ti. Esta última opción tiene un costo adicional, <b>revisa Carrito</b>.<br>
                Este proveedor no debes registrarlo porque se registra automáticamente cuando realizas la factura del ticket de compra.<br><br>

                <b>Proveedor con factura</b> es cuando tu compras un producto o productos y ellos te entregan la factura (CFDI) directamente, por lo tanto este proveedor si debes registrarlo en <b>Mis proveedores</b>.</div>
			</div>
			<div class="modal-footer">
				<button type="button" id='btnEliminar' class="btn btn-white" data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
	</div>
</div>