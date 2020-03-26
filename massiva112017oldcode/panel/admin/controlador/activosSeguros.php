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
    require_once "../modelo/activosModelo.php";
    $activos = new activos();

	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d H:i:s");
	$usuarioSe = $_SESSION['id_usuario'];
    $accion = $_POST['accion'];
    
	//**********************valores para agregar nuevo seguro****************************//
	$fechaCompra = ($_POST['fechaCompra'] == '')? '' : $_POST['fechaCompra'];
	$monto = ($_POST['monto'] == '')? '' : $_POST['monto'];
	$tipo = ($_POST['tipo'] == '')? '' : $_POST['tipo'];
	$depreciacion = ($_POST['depreciacion'] == '')? '' : $_POST['depreciacion'];
	$descripcion = ($_POST['descripcion'] == '')? '' : $_POST['descripcion'];
	
	

	///valor para eliminar el seguro
	$idSeguroEli = ($_POST['idSeguroEli'] == '')? '' : $_POST['idSeguroEli'];
	
	//**********************valores formulario edicion****************************//

 	switch ($accion) {
 		//agregamos el nuevo activos
		case "agreAcitvo":
			$rspta = $activos->agreActi($fechaCompra,$monto,$tipo,$depreciacion,$descripcion,$fechaAccion,$usuarioSe);
			if($rspta){
				///guardamo el evento en el log
				$rsptaLog = $activos->accionNuevoActivo($usuarioSe,$fechaAccion);
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