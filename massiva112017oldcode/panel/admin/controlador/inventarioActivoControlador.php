<?php
	@session_start();
	date_default_timezone_set("America/Mexico_City");
    //session_start();
	//error_reporting(E_ALL);
	//ini_set('display_errors','1');

    /****************************************************************/
    // FUNCIONES GENERALES PARA EL SITIO                            //
    // CREACION DEL ARCHIVO: 27/08/2018                             //
    // MODIFICA Y/O TRABAJA: Azael HV                               //
    // PROYECTO: http://www.elinnovador.mx/                         //
    /****************************************************************/

    //instanciamos el modelo
    require_once "../modelo/inventarioActivoModelo.php";
    $invactivo = new invactivo();

	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d H:i:s");
	$usuarioSe = $_SESSION['id_usuario'];
	$rfcCliejjn = $_SESSION['rfc'];
    $accion = $_POST['accion'];

	/* Valores para agregar servicios */
	$tituloGen = ($_POST['tituloGen'] == '')? '' : $_POST['tituloGen'];
	$porciones = explode(" | ", $tituloGen);
	$satcodigo = $porciones[0];
	$titulo = $porciones[1];

	/* Valor para eliminar el servicio */
	$idServicio = ($_POST['idServicio'] == '')? '' : $_POST['idServicio'];

	//**********************valores producto nuevo****************************//
	$satdes = ($_POST['satdes'] == '')? '' : $_POST['satdes'];
	$unidadsat = ($_POST['unidadsat'] == '')? '' : $_POST['unidadsat'];
	$tipo = ($_POST['tipo'] == '')? '' : $_POST['tipo'];
	$cantidad = ($_POST['cantidad'] == '')? '' : $_POST['cantidad'];
	$precioCompra = ($_POST['precioCompra'] == '')? '' : $_POST['precioCompra'];
	$precioVenta = ($_POST['precioVenta'] == '')? '' : $_POST['precioVenta'];
	$descuento = ($_POST['descuento'] == '')? '' : $_POST['descuento'];
	$proveedor = ($_POST['proveedor'] == '')? '' : $_POST['proveedor'];
	$comentarios = ($_POST['comentarios'] == '')? '' : $_POST['comentarios'];

	//**********************valores para agregar entradas a productos nuevos****************************//
	$idInventarioE = ($_POST['idInventarioE'] == '')? '' : $_POST['idInventarioE'];
	$CasntE = ($_POST['CasntE'] == '')? '' : $_POST['CasntE'];///este no se envia
	$fechaEntradaE = ($_POST['fechaEntradaE'] == '')? '' : $_POST['fechaEntradaE'];
	$cantidadE = ($_POST['cantidadE'] == '')? '' : $_POST['cantidadE'];
	$precioE = ($_POST['precioE'] == '')? '' : $_POST['precioE'];
	$proveedorE = ($_POST['proveedorE'] == '')? '' : $_POST['proveedorE'];
	$unidadE = ($_POST['unidadE'] == '')? '' : $_POST['unidadE'];

	//**********************valores para agregar Salidas a productos nuevos****************************//
	$idInventarioE1 = ($_POST['idInventarioE1'] == '')? '' : $_POST['idInventarioE1'];
	$CasntE1 = ($_POST['CasntE1'] == '')? '' : $_POST['CasntE1'];///este no se envia
	$fechaEntradaE1 = ($_POST['fechaEntradaE1'] == '')? '' : $_POST['fechaEntradaE1'];
	$cantidadE1 = ($_POST['cantidadE1'] == '')? '' : $_POST['cantidadE1'];
	$precioE1 = ($_POST['precioE1'] == '')? '' : $_POST['precioE1'];
	$proveedorE1 = ($_POST['proveedorE1'] == '')? '' : $_POST['proveedorE1'];
	$unidadE1 = ($_POST['unidadE1'] == '')? '' : $_POST['unidadE1'];

	//**********************hacemos consulta para editar el producto****************************//
	$idInventarioEdi = $_POST['idInventarioEdi'];
    if($idInventarioEdi != ""){
        $data=$invactivo->consultaEdita($idInventarioEdi);
		echo json_encode($data);
	}

	/****************************Acciones dependiendo de la variable*************************************///
    switch ($accion) {
		/* agregamos un nuevo servicio */
		case "nuevoServicio":
			$rspta = $invactivo->nuevoServicio($satcodigo,$titulo,$usuarioSe,$fechaAccion);
			if($rspta){
				///guardamo el evento en el log
				$rsptaLog = $invactivo->accionNuevoSerivio($usuarioSe,$fechaAccion);
				if($rsptaLog){  header('location:../index.php?secc=inventario&serpro=1');}
			
			}else{	header('location:../index.php?secc=inventario&serpro=2');}
		break;

		/* Eliminamos el servicio */
		case "eliminaServicio":
			$rspta = $invactivo->eliminoServicio($idServicio);
			if($rspta){
				///guardamo el evento en el log
				$rsptaLog = $invactivo->accionEliminoiSer($usuarioSe,$fechaAccion);
				if($rsptaLog){  header('location:../index.php?secc=inventario&serpro=2');}
			
			}else{	header('location:../index.php?secc=inventario&serpro=9');}
        break;

		case "nuevoProducto":
			/* subimos archivo */
			$nombre_archivo = "foto_producto_".$usuarioSe."_".$_FILES['foto']['name'];
			$nombreFinal = $nombre_archivo;
			$uploaddir_1 = "../contenedor/clientes/".$rfcCliejjn."/";
			$directorio = $uploaddir_1. basename($nombreFinal);
			move_uploaded_file($_FILES["foto"]["tmp_name"], $directorio);

			$rspta = $invactivo->nuevoProdcuto($usuarioSe,$satdes,$unidadsat,$tipo,$cantidad,$precioCompra,$precioVenta,$descuento,$proveedor,$nombreFinal,$comentarios,$fechaAccion);
			if($rspta){
				///guardamo el evento en el log
				$rsptaLog = $invactivo->accionAgregaProd($usuarioSe,$fechaAccion);
				if($rsptaLog){  header('location:../index.php?secc=inventario&serpro=3');}
			}else{	header('location:../index.php?secc=inventario&serpro=9');}
		break;

		/* entradas de prodcutos */
		case "agregamosEntradaProducto":
			$rspta = $invactivo->agreEntrda($idInventarioE,$fechaEntradaE,$cantidadE,$precioE,$proveedorE,$unidadE,$usuarioSe,$fechaAccion);
			if($rspta){
				//actualizamos el monto del prodcuto en inicial
				$actMonto = $CasntE + $cantidadE;
				$actmon = $invactivo->actMontoOri($actMonto,$idInventarioE);
				if($actmon){
					///guardamo el evento en el log
					$rsptaLog = $invactivo->accionLogAgregCan($usuarioSe,$fechaAccion);
					  header('location:../index.php?secc=inventario&serpro=4');
				}
			}else{	header('location:../index.php?secc=inventario&serpro=9');}
		break;

		/* Agregamos salida al producto */
		case "agreSalida":
			
			$rspta = $invactivo->agreSald($idInventarioE1,$fechaEntradaE1,$cantidadE1,$precioE1,$proveedorE1,$unidadE1,$usuarioSe,$fechaAccion);
			if($rspta){
				//actualizamos el monto del prodcuto en inicial
				$actMonto1 = $CasntE1 - $cantidadE1;
				$actmon = $invactivo->actMontoOri2($actMonto1,$idInventarioE1);
				if($actmon){
					///guardamo el evento en el log
					$rsptaLog = $invactivo->accionAgregaSalida($usuarioSe,$fechaAccion);
					  header('location:../index.php?secc=inventario&serpro=5');
				}
			}else{	header('location:../index.php?secc=inventario&serpro=9');}
	
		break;

		//editra producto
		case "editarProducto":
			/* obtenemos los valores */
			$idInventario = ($_POST['idInventarioEdi'] == '')? '' : $_POST['idInventarioEdi'];
			$fotova = ($_POST['fotova'] == '')? '' : $_POST['fotova'];
			$tipo = ($_POST['tipo1'] == '')? '' : $_POST['tipo1'];
			$satdes = ($_POST['satdes1'] == '')? '' : $_POST['satdes1'];
			$unidadsat = ($_POST['unidadsat1'] == '')? '' : $_POST['unidadsat1'];
			$cantidad = ($_POST['cantidad1'] == '')? '' : $_POST['cantidad1'];
			$precioCompra = ($_POST['precioCompra1'] == '')? '' : $_POST['precioCompra1'];
			$precioVenta = ($_POST['precioVenta1'] == '')? '' : $_POST['precioVenta1'];
			$descuento = ($_POST['descuento1'] == '')? '' : $_POST['descuento1'];
			$proveedor = ($_POST['proveedor1'] == '')? '' : $_POST['proveedor1'];
			$comentarios = ($_POST['comentarios1'] == '')? '' : $_POST['comentarios1'];

			/* verificamos si la foto viene vacio */
			$foto1 = $_FILES["foto1"];

			if ($_FILES['foto1']['name'] != null) { 
				/* si no vienen vacio subimos el nuevo archivo */
				$nombre_archivo_1 = "foto_producto_".$_FILES['foto1']['name'];
				$uploaddir_1 = "../contenedor/clientes/".$rfcCliejjn."/";
				$directorio_1 = $uploaddir_1.basename($nombre_archivo_1);
				move_uploaded_file($_FILES["foto1"]["tmp_name"], $directorio_1);
				/* editamos el proveedor */
				$rspta = $invactivo->editaProducConimag($idInventario,$satdes,$unidadsat,$tipo,$cantidad,$precioCompra,$precioVenta,$descuento,$proveedor,$comentarios,$nombre_archivo_1);	
				/* guardamos el movimiento */
				$rspta = $invactivo->accionEditaProducto($usuarioSe,$fechaAccion);
				/* redireccionamos a la pagina */
				header ('location:../index.php?secc=inventario&serpro=6');
			} 
			else{ 
				/* en caso de que venga vacio solo actualizamos los campos normales */
				/* editamos el proveedor */
				$rspta = $invactivo->editaProducSinimag($idInventario,$satdes,$unidadsat,$tipo,$cantidad,$precioCompra,$precioVenta,$descuento,$proveedor,$comentarios);	
				/* guardamos el movimiento */
				$rspta = $invactivo->accionEditaProducto($usuarioSe,$fechaAccion);
				/* redireccionamos a la pagina */
				header ('location:../index.php?secc=inventario&serpro=6');
			}
		break;

    }

?>
