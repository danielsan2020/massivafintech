<?php
	@session_start();
	//instanaciamos la funcion de php mailer
	//session_start();
	/*error_reporting(E_ALL);
	ini_set('display_errors','1');*/

    /****************************************************************/
    // FUNCIONES GENERALES PARA EL SITIO                            //
    // CREACION DEL ARCHIVO: 27/08/2018                             //
    // MODIFICA Y/O TRABAJA: Azael HV                               //
    // PROYECTO: http://www.elinnovador.mx/                         //
    /****************************************************************/

	//instanciamos el modelo 
	date_default_timezone_set("America/Mexico_City");

    require_once "../modelo/solicitaFacturasModelo.php";
    $solifac = new solifac();

	//*********************Variables generales***************************************//
	$fechaAccion = date("Y-m-d");
	$usuarioSe = $_SESSION['id_usuario'];
	$accion = $_POST['accion'];
	
	/* obtenemos lso valores para la edicion */
	
	
	
	
	switch ($accion) {
		/* nueva factura */
		case "primerPaso":
			/* obten4emos las variables del formulario */
			
			$id_usuario = $usuarioSe;
			//Estos se tienes que verificar
			$datoscompletos = ($_POST['datoscompletos'] != '')? $_POST['datoscompletos'] : '0';
			$andire= ($_POST['andire'] != '')? $_POST['andire'] : '0';
			//Valores generales
			$uso= $_POST['uso'];
			$metodo= $_POST['metodo'];
			$forma= $_POST['forma'];
			$moneda= $_POST['moneda'];
			$tipoCambio= $_POST['tipoCambio'];
			$idCliente= $_POST['idCliente'];
			$idCliFa = $_POST['idCliFa'];
			$estatus= 1;

			/* guardamos el nuevo proveedor */
			$proveedoRes = $solifac->nuevaFactuPriPaso($id_usuario,$datoscompletos,$andire,$uso,$metodo,$forma,$moneda,$tipoCambio,$estatus,$fechaAccio,$idCliente);
			/* guardamos el movimiento */
			$rsptalog = $solifac->accionAgregoFac($usuarioSe,$fechaAccion);

			header ('location:../index.php?secc=solicitaFactura&priPaso=1&idCliFa='.$idCliFa);

		break;

		/* editamos factura */
		case "segundoPaso":
			/* obten4emos las variables del formulario */
			
			$id_usuario = $usuarioSe;
			//Estos se tienes que verificar
			$datoscompletos = ($_POST['datoscompletos'] != '')? $_POST['datoscompletos'] : '0';
			$andire= ($_POST['andire'] != '')? $_POST['andire'] : '0';
			//Valores generales
			$uso= $_POST['uso'];
			$metodo= $_POST['metodo'];
			$forma= $_POST['forma'];
			$moneda= $_POST['moneda'];
			$tipoCambio= $_POST['tipoCambio'];
			$idFactura= $_POST['idFactura'];
			$idCliFa = $_POST['idCliFa'];

			/* guardamos el nuevo proveedor */
			$proveedoRes = $solifac->nuevaFactuSePaso($id_usuario,$datoscompletos,$andire,$uso,$metodo,$forma,$moneda,$tipoCambio,$idFactura);
			/* guardamos el movimiento */
			$rsptalog = $solifac->accionEditoFac($usuarioSe,$fechaAccion);

			header ('location:../index.php?secc=solicitaFactura&priPaso=1&idCliFa='.$idCliFa);

		break;

		/* cancelar factura */
		case "eliminar":
			/* capturamos las variables */
			$idFactura = $_POST['idFactura'];
			$idCliFa = $_POST['idCliFa'];

			/* verificamos si actualizan la imagen de logo */
			/* guardamos el nuevo proveedor */
			$proveedoRes = $solifac->cancelacioFac($idFactura);
			/* guardamos el movimiento */
			$rsptalog = $solifac->accionCanFac($usuarioSe,$fechaAccion);

			header ('location:../index.php?secc=solicitaFactura&priPaso=&EliminFAc=1&idCliFa='.$idCliFa);
		break;

		/* elimino proveedor */
		case "agregaProd":

			/* capturamos la primera variable */
			$idFacturaPro = $_POST['idFacturaPro'];
			$cantidad = $_POST['cantidad'];
			$precio = $_POST['precio'];
			$total = $_POST['total'];
			$nombre = $_POST['nombre'];
			$idCliFa = $_POST['idCliFa'];

			$porciones = explode(" | ", $nombre);
			$clavesat = $porciones[0];
			$nombreSat = $porciones[1];

			/* Eliminamos el proveedor */
			$rspta = $solifac->agreProdaFac($idFacturaPro,$cantidad,$precio,$total,$clavesat,$nombreSat,$usuarioSe);	

			/* guardamos el movimiento */
			$rsptaho = $solifac->accionagregoProo($usuarioSe,$fechaAccion);
			
			/* redireccionamos a la pagina */
			header ('location:../index.php?secc=solicitaFactura&priPaso=2&idCliFa='.$idCliFa);
		
		break;

		/* eliminamos productos de la factura */
		case "eliminoProduList":
			/* capturamos la primera variable */
			$idProFac = $_POST['idProFac'];

			/* Eliminamos el proveedor */
			$rspta = $solifac->eliprofac($idProFac);	

			/* guardamos el movimiento */
			$rsptaho = $solifac->accionEliprolista($usuarioSe,$fechaAccion);
			$idCliFa = $_POST['idCliFa'];
			/* redireccionamos a la pagina */
			header ('location:../index.php?secc=solicitaFactura&priPaso=3&idCliFa='.$idCliFa);

		break;

		/* agregamos el ultimo paso de la factura */
		case "idFacUltimoPaso":

			/* obtenemos los ultimos valores */
			$subtotal = $_POST['subtotal'];
			$descuentos = $_POST['descuentos'];
			$iva = $_POST['iva'];
			$totalFac = $_POST['totalFac'];
			$idFacturaProUltimo = $_POST['idFacturaProUltimo'];
			$idCline = $_POST['idCline'];
			

			/* agregamos los ultimos valores cambiando estatus */
			$rspta = $solifac->ultimosValores($subtotal,$descuentos,$iva,$totalFac,$idFacturaProUltimo,$fechaAccion);	

			/* guardamos acciones */
			$rsptaho = $solifac->accionultimosDatos($usuarioSe,$fechaAccion);

			/* quitamos el numero de facturas del contador */
			$rspTabla = $solifac->cuantoscdfiFIN($usuarioSe);
			$rspTablaInfo = $rspTabla->fetch_object();
			$mistic = $rspTablaInfo->facturas;
			$idFafa = $rspTablaInfo->idFacturas;

			/* le restamos el valor  */
			$valorFinCon = $mistic - 1;
			
			/* actualizamos el contador */
			$rsptaho = $solifac->actualizamosValor($valorFinCon,$idFafa);

			/* creamos los archivos pem */
			header ('location:creacionPem.php?idFactura='.$idFacturaProUltimo.'&idCliente='.$idCline);
			

		break;
	}

?>