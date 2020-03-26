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
    require_once "../modelo/faqModelo.php";
    $faqPr = new faqPr();

	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d H:i:s");
	$usuarioSe = $_SESSION['idUsuario'];
    $accion = $_POST['accion'];
    
	//**********************valores formulario nuevo****************************//
	$pregunta = ($_POST['pregunta'] == '')? '' : $_POST['pregunta'];
	$respuesta = ($_POST['respuesta'] == '')? '' : $_POST['respuesta'];
	$area = ($_POST['area'] == '')? '' : $_POST['area'];
	$estatus = ($_POST['estatus'] == '')? '' : $_POST['estatus'];
      
	//**********************valores formulario edicion****************************//

    $idPregunta = ($_POST['idPregunta'] == '')? '' : $_POST['idPregunta'];
    if($idPregunta != ""){
        $data=$faqPr->consultaEdita($idPregunta);
 		echo json_encode($data, JSON_FORCE_OBJECT);
    }
    
	//**************************valores para la edicion *************************************//
	$pregunta1 = ($_POST['pregunta1'] == '')? '' : $_POST['pregunta1'];
	$respuesta1 = ($_POST['respuesta1'] == '')? '' : $_POST['respuesta1'];
	$area1 = ($_POST['area1'] == '')? '' : $_POST['area1'];
	$estatus1 = ($_POST['estatus1'] == '')? '' : $_POST['estatus1'];
	$idPregunta1 = ($_POST['idPregunta1'] == '')? '' : $_POST['idPregunta1'];

    //**********************valor para eliminar el registro***************************//
	$idPregunta2 = ($_POST['idPregunta2'] == '')? '' : $_POST['idPregunta2'];
   
	/****************************Acciones dependiendo de la variable*************************************///
    switch ($accion) {
        case "nuevaPregunta":
            
				$rspta = $faqPr->nuevaPregunta($pregunta,$respuesta,$area,$estatus,$usuarioSe,$fechaAccion);
				if($rspta){
					$rsptaLog = $faqPr->accionLogagrega($usuarioSe,$fechaAccion);
					if($rsptaLog){return true;}	
				}
				else{	return false; }
                
        break;
        case "eliminar":
			
            $eliminaElme = $faqPr->eliminar($idPregunta2);
            if($eliminaElme){ 
				$rsptaLog = $faqPr->accionLogElimina($usuarioSe,$fechaAccion);
					if($rsptaLog){return true;}
			
			}else{	return false; }
            
		break;
		 case "edicionPregunta":
			
            $editarElem = $faqPr->edicionPregunta($pregunta1,$respuesta1,$area1,$estatus1,$idPregunta1);
            if($editarElem){ 
				$rsptaLog = $faqPr->accionLogEdita($usuarioSe,$fechaAccion);
					if($rsptaLog){return true;}
			}else{	return false; }
            
		break;
			
       
    }
 
?>