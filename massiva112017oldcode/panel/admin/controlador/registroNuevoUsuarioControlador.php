<?php
	date_default_timezone_set("America/Mexico_City");
    @session_start();
	//error_reporting(E_ALL);
	//ini_set('display_errors','1');

   
    /****************************************************************/
    // FUNCIONES GENERALES PARA EL SITIO                            //
    // CREACION DEL ARCHIVO: 27/08/2018                             //
    // MODIFICA Y/O TRABAJA: Azael HV                               //
    // PROYECTO: http://www.elinnovador.mx/                         //
    /****************************************************************/

    //instanciamos el modelo 
    require_once "../modelo/registroNuevoUsuarioModelo.php";
    $rweb = new rweb();

	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d");
    $accion = $_POST['accion'];
    
    //**********************valores formulario nuevo****************************//
	$nombre = ($_POST['nombre'] == '')? '' : $_POST['nombre']; 
	$numero = ($_POST['numero'] == '')? '' : $_POST['numero']; 

    //**********************valores de usuario nuevo****************************//
    $nombre1 = ($_POST['nombre1'] == '')? '' : $_POST['nombre1']; 
    $fecha_nacimiento = ($_POST['fecha_nacimiento'] == '')? '' : $_POST['fecha_nacimiento']; 
    $ape_paterno = ($_POST['ape_paterno'] == '')? '' : $_POST['ape_paterno']; 
    $telefono = ($_POST['telefono'] == '')? '' : $_POST['telefono']; 
    $ape_materno = ($_POST['ape_materno'] == '')? '' : $_POST['ape_materno']; 
    $mail = ($_POST['mail'] == '')? '' : $_POST['mail']; 
    $rfc = ($_POST['rfc'] == '')? '' : $_POST['rfc']; 
    $tpersona = ($_POST['tpersona'] == '')? '' : $_POST['tpersona']; 
    $facturasMes = ($_POST['facturasMes'] == '')? '' : $_POST['facturasMes']; 
    $tproducto = ($_POST['tproducto'] == '')? '' : $_POST['tproducto']; 
    $trabajadores = ($_POST['trabajadores'] == '')? '' : $_POST['trabajadores']; 
    $efirma = ($_POST['efirma'] == '')? '' : $_POST['efirma']; 
    $contaAtrasada = ($_POST['contaAtrasada'] == '')? '' : $_POST['contaAtrasada']; 
    $aviso = ($_POST['aviso'] == '')? '' : $_POST['aviso']; 
    $terminos = ($_POST['terminos'] == '')? '' : $_POST['terminos']; 

    $clave = substr( md5(microtime()), 1, 8);
    //hacemos la varificacion del estatus
    //consultamos el rfc
    $rsptaCon = $rweb->consulta($rfc);
    if($rsptaCon){	
        $estatus = "2";	
        ///se enviar correo de aceptacion
    }
	else{
        //el status dos es para negacion de acceso	
        $estatus = "1";
        //se envia correo con datos de rfc negro 
    }
    

   
	/****************************Acciones dependiendo de la variable*************************************///
    switch ($accion) {
        case "nuevo":
			$rspta = $rweb->insertar($nombre,$numero,$fechaAccion);
			if($rspta){	return true;	}
			else{	return false; }
        break;
        
        case "nusuario":
            $rspta = $rweb->nusuario($nombre1,$fecha_nacimiento,$ape_paterno,$telefono,$ape_materno,$mail,$rfc,$tpersona,$facturasMes,$tproducto,$trabajadores,$efirma,$contaAtrasada,$aviso,$terminos,$clave,$estatus);
            if($rspta){	return true;	}
            else{	return false; }
            
        break;
    }

?>