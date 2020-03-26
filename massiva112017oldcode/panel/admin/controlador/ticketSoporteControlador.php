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
    require_once "../modelo/tsoporteModelo.php";
    $tsoporte = new tsoporte();

	//*********************Variables generales***************************************//
   $fechaAccion = date("Y-m-d H:i:s");
    $accion = $_POST['accion'];
    $id_usuario = $_SESSION['id_usuario'];
    
    //**********************valores formulario nuevo****************************//
	$id_usuario_reporta = ($_POST['id_usuario_reporta'] == '')? '' : $_POST['id_usuario_reporta']; 
	$id_categoria_ticket = ($_POST['id_categoria_ticket'] == '')? '' : $_POST['id_categoria_ticket']; 
	$titulo = ($_POST['titulo'] == '')? '' : $_POST['titulo']; 
	$descripcion = ($_POST['descripcion'] == '')? '' : $_POST['descripcion']; 
	$estatus = 1;

	//**********************valores par aterminar el ticket****************************//
	$idTermina = ($_POST['idTermina'] == '')? '' : $_POST['idTermina']; 
	$califincal = ($_POST['califincal'] == '')? '' : $_POST['califincal']; 

	//**********************valores par agregar un comentario al ticket por medio del clientet****************************//
	$comenCli = ($_POST['comenCli'] == '')? '' : $_POST['comenCli']; 
	$ideTiUS = ($_POST['ideTiUS'] == '')? '' : $_POST['ideTiUS']; 

	//**********************valores par agregar un comentario al ticket por medio del administrador****************************//
	$idsoporteComen = ($_POST['idsoporteComen'] == '')? '' : $_POST['idsoporteComen']; 
	$comentarioAdmin = ($_POST['comentarioAdmin'] == '')? '' : $_POST['comentarioAdmin']; 
	   
	//**********************valores par obtener los comentarios del ticket****************************//
	$recipient = ($_POST['recipient'] == '')? '' : $_POST['recipient']; 
	if($recipient != ""){
        $rspta = $tsoporte->consultaCome($recipient);
         //Codificar el resultado utilizando json
        $vaFin =  json_encode($rspta);
        print_r($vaFin);
    }
    //**********************valores par aterminar el ticket admin****************************//
	$idTerminaADmin = ($_POST['idTerminaADmin'] == '')? '' : $_POST['idTerminaADmin']; 

	/****************************Acciones dependiendo de la variable*************************************///
    switch ($accion) {
        case "nuevo":
			$rspta = $tsoporte->insertar($id_usuario_reporta,$id_categoria_ticket,$titulo,$descripcion,$estatus,$usuarioSe,$fechaAccion);
			if($rspta){
				$inlog = $tsoporte->accionLogagrega($id_usuario,$fechaAccion);
				return true;
			}
			else{	return false; }
		break;

		case "terminar":
			$rspta = $tsoporte->terminar($idTermina,$califincal);
			if($rspta){
				$inlog = $tsoporte->accionLogTermina($id_usuario,$fechaAccion);
				if($califincal > 0){ $inlog2 = $tsoporte->accionLogCalifi($id_usuario,$fechaAccion);}
				
				return true;
			}
			else{	return false; }
		break;

		case "terminarAdmin":
			$rspta = $tsoporte->terminarAdmin($idTerminaADmin);
			if($rspta){
				$inlog = $tsoporte->accionLogTerminaAdmin($id_usuario,$fechaAccion);
				return true;
			}
			else{	return false; }
		break;

		case "nuevoComCli":
			$rspta = $tsoporte->comeClien($comenCli,$ideTiUS,$id_usuario,$fechaAccion);
			if($rspta){
				$inlog = $tsoporte->accionLogComeClie($id_usuario,$fechaAccion);
				return true;
			}
			else{	return false; }
		break;

		case "nuevoComAd":
			$rspta = $tsoporte->nuevoComAd($idsoporteComen,$comentarioAdmin,$id_usuario,$fechaAccion);
			if($rspta){
				$inlog = $tsoporte->accionLogComeAdmin($id_usuario,$fechaAccion);
				return true;
			}
			else{	return false; }
		break;
		
		
		
       
    }
 
        
    
   
    



?>