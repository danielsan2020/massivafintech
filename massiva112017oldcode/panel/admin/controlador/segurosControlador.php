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
    require_once "../modelo/segurosModelo.php";
    $seguros = new seguros();

	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d H:i:s");
	$usuarioSe = $_SESSION['id_usuario'];
    $accion = $_POST['accion'];
    
	//**********************valores para agregar nuevo seguro****************************//
	$rfc = ($_POST['rfc'] == '')? '' : $_POST['rfc'];
	$tipo = ($_POST['tipo'] == '')? '' : $_POST['tipo'];
	$prima = ($_POST['prima'] == '')? '' : $_POST['prima'];
	$fechaInicio = ($_POST['fechaInicio'] == '')? '' : $_POST['fechaInicio'];
	$fechaTermino = ($_POST['fechaTermino'] == '')? '' : $_POST['fechaTermino'];
	$descripcion = ($_POST['descripcion'] == '')? '' : $_POST['descripcion'];
	$numeroPoliza = ($_POST['numeroPoliza'] == '')? '' : $_POST['numeroPoliza'];
	$metodoPago = ($_POST['metodoPago'] == '')? '' : $_POST['metodoPago'];
	$aseguradora = ($_POST['aseguradora'] == '')? '' : $_POST['aseguradora'];
	
	///valor para eliminar el seguro
	$idSeguroEli = ($_POST['idSeguroEli'] == '')? '' : $_POST['idSeguroEli'];
	
	//valores para edicion
	$rfc1 = ($_POST['rfc1'] == '')? '' : $_POST['rfc1'];
	$tipo1 = ($_POST['tipo1'] == '')? '' : $_POST['tipo1'];
	$prima1 = ($_POST['prima1'] == '')? '' : $_POST['prima1'];
	$fechaInicio1 = ($_POST['fechaInicio1'] == '')? '' : $_POST['fechaInicio1'];
	$fechaTermino1 = ($_POST['fechaTermino1'] == '')? '' : $_POST['fechaTermino1'];
	$descripcion1 = ($_POST['descripcion1'] == '')? '' : $_POST['descripcion1'];
	$numeroPoliza1 = ($_POST['numeroPoliza1'] == '')? '' : $_POST['numeroPoliza1'];
	$metodoPago1 = ($_POST['metodoPago1'] == '')? '' : $_POST['metodoPago1'];
	$aseguradora1 = ($_POST['aseguradora1'] == '')? '' : $_POST['aseguradora1'];
	$idSeguroEdita = ($_POST['idSeguroEdita'] == '')? '' : $_POST['idSeguroEdita'];


	//valro para la edicion de seguro	
	$idenSegurrr = ($_POST['idenSegurrr'] == '')? '' : $_POST['idenSegurrr'];
    if($idenSegurrr != ""){
        $data=$seguros->ConsulEdita($idenSegurrr);
 		echo json_encode($data, JSON_FORCE_OBJECT);
    }

	//**********************valores formulario edicion****************************//

 	switch ($accion) {
 		//agregamos el nuevo seguro
		case "agreSeguro":
			
			$rspta = $seguros->agreSeguro($rfc,$tipo,$prima,$fechaInicio,$fechaTermino,$descripcion,$numeroPoliza,$metodoPago,$aseguradora,$fechaAccion,$usuarioSe);
			if($rspta){
				///guardamo el evento en el log
				$rsptaLog = $seguros->accionNuevoseguro($usuarioSe,$fechaAccion);
				if($rsptaLog){ return true;}	
			}else{
				 return false;
			}
	
		break;
			
		case "eliminar":
			
			$eliminaElme = $seguros->eliminaSeguro($idSeguroEli);
			 if($eliminaElme){ 
				 $rsptaLog = $seguros->accionEliminaeguro($id_usuario,$fechaAccion);
				if($rsptaLog){return true;}
			 }else{
				 return false;
			 }
		break;
			
		
			
		case "editarSeguro":
			
			$rspta = $seguros->editarSeguro($rfc1,$tipo1,$prima1,$fechaInicio1,$fechaTermino1,$descripcion1,$numeroPoliza1,$metodoPago1,$aseguradora1,$idSeguroEdita);
			if($rspta){
				///guardamo el evento en el log
				$rsptaLog = $seguros->accioneditaeguro($usuarioSe,$fechaAccion);
				if($rsptaLog){ return true;}	
			}else{
				 return false;
			}
	
		break;
			
			
 	}
?>