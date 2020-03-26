<?php
@session_start();	
     //session_start();
    //error_reporting(E_ALL);
    //ini_set('display_errors','1');
    date_default_timezone_set("America/Mexico_City");

    //instanciamos el modelo 
    require_once "../modelo/codigos.php";
    $codigos = new codicxgos();

    //*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d");
    $accion = $_POST['accion'];
    $id_usuario = $_SESSION['id_usuario'];
    
    //**********************valores formulario nuevo****************************//
    $empresa = ($_POST['empresa'] == '')? '' : $_POST['empresa']; 
    $ciudad = ($_POST['ciudad'] == '')? '' : $_POST['ciudad']; 
    $numIni = ($_POST['numIni'] == '')? '' : $_POST['numIni']; 
    $numFin = ($_POST['numFin'] == '')? '' : $_POST['numFin']; 
    $fechaVigencia = ($_POST['fechaVigencia'] == '')? '' : $_POST['fechaVigencia']; 

    //**********************valores asignacion de contrato****************************//
    $idCodigo = ($_POST['idCodigo'] == '')? '' : $_POST['idCodigo']; 
    $contratof = ($_POST['contratof'] == '')? '' : $_POST['contratof']; 
    
    //**********************valores asignacion de contrato****************************//
    $idCodigo2 = ($_POST['idCodigo2'] == '')? '' : $_POST['idCodigo2']; 

    /****************************Acciones dependiendo de la variable*************************************///
    switch ($accion) {
        case "nuevoCodi":
        	//hacemos el recorrido con los numero iniciales
        	for ($i = $numIni; $i <= $numFin; $i++) {
        		$numero = $i;
				$rspta = $codigos->insertar($empresa,$ciudad,$numero,$fechaVigencia,$id_usuario,$fechaAccion);    
			}
            $rsptaLog = $codigos->accionLogagrega($id_usuario,$fechaAccion);
            if($rsptaLog){header ('location:../index.php?secc=codigos&nncod=1');}	
            
            else{	header ('location:../index.php?secc=codigos&nncod=2'); }
        break;
			
		
		case "agregaContra":
			$rsptawe = $codigos->ASigContr($idCodigo,$contratof);
			if($rsptawe){
				$rsptaLog = $codigos->accionLogEdita($id_usuario,$fechaAccion);
				if($rsptaLog){return true;}	
				else{return false; }
			}
        break;
			
		case "eliminar":
			$rsptEli = $codigos->Elinds($idCodigo2);
            if($rsptEli){
    			$rsptaLog = $codigos->accionLogElimina($id_usuario,$fechaAccion);
    				if($rsptaLog){return true;}	
    			else{return false; }
            }
        break;

    }

?>