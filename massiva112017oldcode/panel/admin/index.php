<?php 
error_reporting(0);
@session_start();
if($_SESSION['id_usuario'] != ''){	
date_default_timezone_set("America/Mexico_City");
//if($_SESSION['id_usuario'] != ''){
///cabezera
include 'estructura/header.php';
include 'estructura/fecha.php';
include 'estructura/varvar.php'
?>
    <script>

    $(document).ready(function (){

        /*var dia = <?=$soloDia;?>;
 
        var contMuestraModal = sessionStorage.getItem("contador");

        if(contMuestraModal == null){
            contMuestraModal = 0;
        }

        if(dia <= 5){
            if(contMuestraModal == 0){
                $('#unoacinco').modal('toggle');
                contMuestraModal++;
                sessionStorage.setItem("contador", contMuestraModal);
            }
        }
        if(dia == 6 && dia< 10){
            if(contMuestraModal == 0){
                $('#moddos').modal('toggle');
                contMuestraModal++;
                sessionStorage.setItem("contador", contMuestraModal);
            }
        }
        if(dia == 11 && dia < 16){
            if(contMuestraModal == 0){
                $('#modtres').modal('toggle');
                contMuestraModal++;
                sessionStorage.setItem("contador", contMuestraModal);
            }
        }
        if(dia >= 17){
            if(contMuestraModal == 0){  
                $('#modcuatro').modal('toggle');
                contMuestraModal++;
                sessionStorage.setItem("contador", contMuestraModal);
            }
        }*/

        // Instance the tour
        var tour = new Tour({
            steps: [{

                    element: "#step1",
                    title: "Alertas",
                    content: "Te avisaremos cuando necesitemos algo de ti, mientras tanto massiva se ocupará de todo.",
                    placement: "bottom"

                },
                {
                    element: "#step2",
                    title: "Carrito",
                    content: "Compra facturas extras y tickets de compra para facturar sí lo requieres y mucho más.",
                    placement: "bottom"
                },

                {
                    element: "#step3",
                    title: "Status ante el SAT",
                    content: "Te diremos a través de colores tu status ante el SAT y que debes hacer.",
                    placement: "bottom"
                },


                {
                    element: "#step4",
                    title: "Pago de impuestos",
                    content: "Verás cuando tengas que pagar tus impuestos, descargar tu línea de captura y pagar en tu banco.",
                    placement: "bottom"
                },

                {
                    element: "#step5",
                    title: "Solicitar Factura",
                    content: "Desde aquí puedes solicitar una factura en 3 sencillos pasos. Te tomará menos de 1 minuto.",
                    placement: "bottom"
                },
                {
                    element: "#step6",
                    title: "Facturar tickets de compra",
                    content: "Sube y factura tus tickets de compra de forma sencilla.",
                    placement: "bottom"
                },
                {
                    element: "#step7",
                    title: "Clientes",
                    content: "Accede a la sección de tus clientes para registrar nuevos clientes, cotizaciones o facturas.",
                    placement: "right"
                },

                {
                    element: "#step8",
                    title: "Perfil",
                    content: "Modifica tus datos generales y bancarios, sube tu logotipo, revisa tu contraseña e.firma y solicita el cambio de forma jurídica.",
                    placement: "right"
                },

                {
                    element: "#step9",
                    title: "Mis Clientes",
                    content: "Registra nuevos clientes, revisa las facturas realizadas, realiza cotizaciones o haz el complemento de pago entre otras cosas.",
                    placement: "right"
                },

                {
                    element: "#step10",
                    title: "Mis Proveedores",
                    content: "Registra nuevos proveedores, revisa sus facturas o asigna un gasto a un proveedor para que puedas deducir.",
                    placement: "right"
                },

                {
                    element: "#step11",
                    title: "Mi Contabilidad",
                    content: "Factura tus tickets de compra, realiza cotizaciones, consulta las declaraciones y pagos de impuestos realizados.",
                    placement: "right"
                },

                {
                    element: "#step12",
                    title: "Mi Empresa",
                    content: "Activa tus áreas de trabajo, refleja tus activos si tienes para deducir impuestos, revisa tus cuentas bancarias, precarga tus servicios, lleva un inventario y registra tu seguro si tienes.",
                    placement: "right"
                },

                {
                    element: "#step13",
                    title: "Documentación",
                    content: "Tendrás guardado tu comprobante de domicilio, INE, contratos con massiva y tus archivos de e.firma.",
                    placement: "right"
                },


                {
                    element: "#step14",
                    title: "Actualizaciones ante el SAT",
                    content: "Actualiza tus obligaciones fiscales, tu e.firma, cambio de domicilio, suspensión de actividades o defunción por $49. ",
                    placement: "right"
                }
                
            ]});

        // Initialize the tour
        tour.init();

        $('.startTour').click(function(){ tour.restart(); })

    });

</script>
</head>
<body>
    <div id="wrapper">
        <?php include 'estructura/menu.php'; ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">
       	<?php include 'estructura/barra.php';?>
		<div class="row">
			<div class="alert alert-warning text-right">
				<b>Usuario: <?PHP echo  $_SESSION['id_usuario']; ?></b> <small>(Para cualquier trámite o reporte se te solicitará este número)</small>
			</div>
		</div>
        <?php 
			//en esta seccion vamos a hacer las secciones
			if ($secc == 'misclientes' || $secc == 'sopte' || $secc == 'sopco' || $secc == 'faq' || $secc == 'contrato' || $secc == 'bancos' || $secc == 'fisicasUsuario' ||
				$secc == 'moralUsuario' || $secc == 'reciboPagos' || $secc == 'archivos' || $secc == 'facturaUsu' || $secc == 'delcracionesUsu' || $secc == 'pagoImpuesto' ||
				$secc == 'portada' || $secc == 'productoServicio' || $secc == 'carrito' || $secc == 'autorizaRegistro' || $secc == 'areasTrabajo' || $secc == 'misProveedores' ||
				$secc == 'misEmpleados' || $secc == 'cincidencia' || $secc == 'reporte' || $secc == 'tnomina' || $secc == 'impuesto' || $secc == 'ticketusu' || $secc == 'estadoCuenta' || 
				$secc == 'cotizacion' || $secc == 'inventario' || $secc == 'registroTel' ||  $secc == 'registroNuevoUsuario' || $secc == 'encuestas' || $secc == 'blogCliente' || 
				$secc == 'blog' || $secc == 'blogClienteU' || $secc == 'misproveedores' || $secc == 'perfil' || $secc == 'simuladores' || $secc == 'constanciaFiscal' || $secc == 'obligacionesFiscales_inicio' || $secc == 'suspencionActividades' || $secc == 'cambioDomicilio' || $secc == 'defuncion' || $secc == 'actualizacionefirma' || 
				$secc == 'noticiasWeb' || $secc == 'prefa' || $secc == 'logMovimientos' || $secc == 'logIngreso' || $secc == 'inventarioGeneral' || $secc == 'inventarioParticular' || 
				$secc == 'seguros' || $secc == 'moviConta' || $secc == 'codigos' || $secc == 'misfacturas' || $secc == 'misfacturas2' || $secc == 'empresa' || $secc == 'contaClientes' ||
				$secc == 'sopteAdmin' || $secc == 'logSopTec' || $secc == 'logSopCon' || $secc == 'sopcoAdmin' || $secc == 'logCompras' || $secc == 'contaatrasasF' || $secc == 'contaatrasasM' 
                || $secc == 'respaldo' || $secc == 'cuentaBancarias'  || $secc == 'dasconta' || $secc == 'dascontaf' || $secc == 'dascontaM'  || $secc == 'panelConta' || $secc == 'dascontaFDecla'
                || $secc == 'dascontaMDecla' || $secc == 'clientesContabilidad' || $secc == 'ticketConta' || $secc == 'ticketContaT' || $secc == 'actuConta' || $secc == 'basicos' 
                || $secc == 'mensActual' || $secc == 'complemen' || $secc == 'resumenDecla' || $secc == 'dascontaFDeclaIntereses' || $secc == 'resumenDeclaIntereses' || $secc == 'dascontaFDeclaArrendamiento' || $secc == 'resumenDeclaArrendamiento' || $secc == 'dascontaFDeclaActividad' || $secc == 'dascontafActividad' || $secc == 'resumenDeclaActividad'  
                || $secc == 'resumenDeclaArrendamientoAnual' || $secc == 'directorioClientes' || $secc =='solicitaFactura' || $secc =='contaAtrasadaFUno' || $secc =='contaAtrasadaFDos' || $secc =='contaAtrasadaFTres' 
                || $secc == 'muestraFacturaREsultado' || $secc == 'clientesAte'
                
			   ){
			
			include 'site/'.$secc.'.php'; 
				
			}elseif($secc == ''){ include 'site/portada.php'; }
			else{ include 'site/404.php'; }
		?> 
		<div class="row">
			<div class="col-lg-12">
				<div class="footer">
					<div><strong>Copyright</strong> Todos los derechos reservados massiva.mx &copy; 2019</div>
				</div>
			</div>
		</div>     
    </div>

    <!--seccion de modals para las alertas-->
    <div class="modal fade" tabindex="-1" id="moduno" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">1° Aviso de declaraciones</h3>
                  </div>
                  <div class="modal-body">
                    <div class="alert alert-warning text-center">Massiva ya puede presentar tus declaraciones. Estamos a tiempo. <br>¿Nos autorizas que la hagamos ahora? o ¿nos esperamos?</div>
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Autorizo</button>
                    <button type="button" class="btn btn-primary"  data-dismiss="modal">Espérate</button>
                </div>
            </div>
        </div>
    </div>
    <!--seccion de modals para las alertas-->
    <div class="modal fade" tabindex="-1" id="moddos" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">2° Aviso de declaraciones</h3>
                  </div>
                  <div class="modal-body">
                    <div class="alert alert-warning text-center">Massiva ya puede presentar tus declaraciones, estamos justo a tiempo.<br>¿Nos autorizas que la hagamos ahora? o ¿nos esperamos un poco más?</div>
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Autorizo</button>
                    <button type="button" class="btn btn-primary"  data-dismiss="modal">Espérate un poco más</button>
                </div>
            </div>
        </div>
    </div>
    <!--seccion de modals para las alertas-->
    <div class="modal fade" tabindex="-1" id="modtres" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">3° Aviso de declaraciones</h3>
                  </div>
                  <div class="modal-body">
                    <div class="alert alert-warning text-center">Massiva ya debe presentar tus declaraciones, no debes esperarte más.<br>Autorízanos que la hagamos ahora. No te arriesgues a tener recargos o multas.</div>
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Autorizo</button>
                </div>
            </div>
        </div>
    </div>
    <!--seccion de modals para las alertas-->
    <div class="modal fade" tabindex="-1" id="modcuatro" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Último aviso de declaraciones</h3>
                  </div> 
                  <div class="modal-body">
                    <div class="alert alert-warning text-center">Massiva ya debió presentar tus declaraciones, estás fuera de tiempo. <br> Autorízanos que la hagamos ahora. Es probable que puedas tener recargos o multas, si es así, te lo haremos saber.</div>
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Autorizo</button>
                </div>
            </div>
        </div>
    </div>

    <!--seccion de modals banco-->
    <div class="modal inmodal fade" id="alertaaa" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3>¿Este movimiento fue?</h3>
                </div>
                <div class="modal-body text-center">
                   <a href="" class="btn btn-primary" data-toggle="modal" data-target="#devolucion" title="Ver detalles">Personal</a>
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#emprr" title="emprr">Empresa</a>
                    </th>
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-white" data-dismiss="modal" id='btnTern'> Cerrar</button>
                </div>
            </div>
        </div>
    </div>


</body>
<?php }else{ header ('location:../index.php?act=3');}?>
</html>
