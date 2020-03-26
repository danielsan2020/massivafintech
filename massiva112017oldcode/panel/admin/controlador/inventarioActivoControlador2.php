<?php
	@session_start();	
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
    $accion = $_POST['accion'];
    
	//**********************valores para eliminar****************************//
	$idInventario2 = ($_POST['idInventario2'] == '')? '' : $_POST['idInventario2'];
	$imgref2 = ($_POST['imgref2'] == '')? '' : $_POST['imgref2'];

	///valores para la entrada
	$idInventarioE = ($_POST['idInventarioE'] == '')? '' : $_POST['idInventarioE'];
	$fechaEntradaE = ($_POST['fechaEntradaE'] == '')? '' : $_POST['fechaEntradaE'];
	$cantidadE = ($_POST['cantidadE'] == '')? '' : $_POST['cantidadE'];
	$precioE = ($_POST['precioE'] == '')? '' : $_POST['precioE'];
	$proveedorE = ($_POST['proveedorE'] == '')? '' : $_POST['proveedorE'];
	$unidadE = ($_POST['unidadE'] == '')? '' : $_POST['unidadE'];
	$CasntE = ($_POST['CasntE'] == '')? '' : $_POST['CasntE'];

	///valores para la entrada
	$idInventarioE1 = ($_POST['idInventarioE1'] == '')? '' : $_POST['idInventarioE1'];
	$fechaEntradaE1 = ($_POST['fechaEntradaE1'] == '')? '' : $_POST['fechaEntradaE1'];
	$cantidadE1 = ($_POST['cantidadE1'] == '')? '' : $_POST['cantidadE1'];
	$precioE1 = ($_POST['precioE1'] == '')? '' : $_POST['precioE1'];
	$proveedorE1 = ($_POST['proveedorE1'] == '')? '' : $_POST['proveedorE1'];
	$unidadE1 = ($_POST['unidadE1'] == '')? '' : $_POST['unidadE1'];
	$CasntE1 = ($_POST['CasntE1'] == '')? '' : $_POST['CasntE1'];

//$idInventario,$id_usuario,$nombre,$descripcion,$cantidad,$unidad,$ubicacion,$codigo,$precioFinal,$descuentos,$imagen,$proveedor,$precio

	//**********************valores formulario edicion****************************//
    $idInventario = ($_POST['idInventario'] == '')? '' : $_POST['idInventario'];
    if($idInventario != ""){
        $data=$invactivo->ConsulEdita($idInventario);
 		echo json_encode($data, JSON_FORCE_OBJECT);
    }
 	switch ($accion) {
	
		case "eliminar":
			
			$archivoBorro = "../contenedor/inventarioActivos/".$imgref2;
			unlink($archivoBorro);

			$eliminaElme = $invactivo->eliminaPro($idInventario2);
			 if($eliminaElme){ 
				 $rsptaLog = $invactivo->accionLogElimina($id_usuario,$fechaAccion);
				if($rsptaLog){return true;}
			 }else{
				 return false;
			 }
		break;
			
		case "agreEntrada":
			
			$rspta = $invactivo->agreEntrda($idInventarioE,$fechaEntradaE,$cantidadE,$precioE,$proveedorE,$unidadE,$usuarioSe,$fechaAccion);
			if($rspta){
				//actualizamos el monto del prodcuto en inicial
				$actMonto = $CasntE + $cantidadE;
				$actmon = $invactivo->actMontoOri($actMonto,$idInventarioE);
				if($actmon){
					///guardamo el evento en el log
					$rsptaLog = $invactivo->accionLogAgregCan($usuarioSe,$fechaAccion);
					if($rsptaLog){ return true;}	
				}

			}else{
				 return false;
			}
	
		break;
			
		case "agreSalida":
			
			$rspta = $invactivo->agreSald($idInventarioE1,$fechaEntradaE1,$cantidadE1,$precioE1,$proveedorE1,$unidadE1,$usuarioSe,$fechaAccion);
			if($rspta){
				//actualizamos el monto del prodcuto en inicial
				$actMonto1 = $CasntE1 - $cantidadE1;
				$actmon = $invactivo->actMontoOri2($actMonto1,$idInventarioE1);
				if($actmon){
					///guardamo el evento en el log
					$rsptaLog = $invactivo->accionLogQuitCan($usuarioSe,$fechaAccion);
					if($rsptaLog){ return true;}	
				}

			}else{
				 return false;
			}
	
		break;
			
			
 	}
?>