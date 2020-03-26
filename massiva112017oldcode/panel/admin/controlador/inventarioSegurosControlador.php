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
    $invseguros = new invseguros();

	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d H:i:s");
	$usuarioSe = $_SESSION['id_usuario'];
    $accion = $_POST['accion'];
    
	//**********************valores para agregar nuevo seguro****************************//
	$rfc = ($_POST['rfc'] == '')? '' : $_POST['rfc'];
	$tipoSeguro = ($_POST['tipoSeguro'] == '')? '' : $_POST['tipoSeguro'];
	$prima = ($_POST['prima'] == '')? '' : $_POST['prima'];
	$fechaInicio = ($_POST['fechaInicio'] == '')? '' : $_POST['fechaInicio'];
	$fechaTermino = ($_POST['fechaTermino'] == '')? '' : $_POST['fechaTermino'];
	$descripcion = ($_POST['descripcion'] == '')? '' : $_POST['descripcion'];
	$numeroPoliza = ($_POST['numeroPoliza'] == '')? '' : $_POST['numeroPoliza'];
	$MetodoPago = ($_POST['MetodoPago'] == '')? '' : $_POST['MetodoPago'];
	


	//**********************valores formulario edicion****************************//
    $idInventario = ($_POST['idInventario'] == '')? '' : $_POST['idInventario'];
    if($idInventario != ""){
        $data=$invactivo->ConsulEdita($idInventario);
 		echo json_encode($data, JSON_FORCE_OBJECT);
    }
    
 	switch ($accion) {
		case "agreSeguro":
			
			$rspta = $invseguros->agreSeguro($rfc,$tipoSeguro,$prima,$fechaInicio,$fechaTermino,$descripcion,$numeroPoliza,$MetodoPago,$fechaAccion,$usuarioSe);
			if($rspta){
				///guardamo el evento en el log
				$rsptaLog = $invseguros->accionLogAgregCan($usuarioSe,$fechaAccion);
				if($rsptaLog){ return true;}	
			}else{
				 return false;
			}
	
		break;
			
		case "eliminaSeguro":
			
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