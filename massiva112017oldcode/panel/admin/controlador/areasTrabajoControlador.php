<?php
    @session_start();	
	date_default_timezone_set("America/Mexico_City");
    //session_start();
	error_reporting(E_ALL);
	ini_set('display_errors','1');

    /****************************************************************/
    // FUNCIONES GENERALES PARA EL SITIO                            //
    // CREACION DEL ARCHIVO: 27/08/2018                             //
    // MODIFICA Y/O TRABAJA: Azael HV                               //
    // PROYECTO: http://www.elinnovador.mx/                         //
    /****************************************************************/

    //instanciamos el modelo
    require_once "../modelo/areasTrabajoModelo.php";
    $areasTra = new areasTra();

	//*********************Variables generales***************************************//
    $fechaCreacion = date("Y-m-d");
    $id_usuario = $_SESSION['id_usuario'];
    //obtenemos los valores para eliminar los archivos

    $idActivioEli = $_POST['idActivioEli'];

    if($idActivioEli != ''){
        $connn = $areasTra->elimnAct($idActivioEli);
        if($connn){
            $Actuelem = $areasTra->accionElimiActi($idActivioEli);
            return true;
        }else{ return false;}
    }else{

        /* verificamos si ya cuenta con una area de trabajo guardada */
        $idAreasTrabajo = ($_POST['idAreasTrabajo'] == '')? '0' : $_POST['idAreasTrabajo'];
        $administracion = ($_POST['administracion'] == '')? '0' : $_POST['administracion'];
        $produccion = ($_POST['produccion'] == '')? '0' : $_POST['produccion'];
        $transporte = ($_POST['transporte'] == '')? '0' : $_POST['transporte'];
        if($idAreasTrabajo == ''){
            /* en caso de que no tengamos una area de trabajo guardada generamos el nuevo registros */
            //encaso de que ya exista registro actualizamos
            $connn = $areasTra->agregaAtra($administracion,$produccion,$transporte,$fechaCreacion,$id_usuario);
            if($connn){
                $rsptaLog = $areasTra->accionLogarea($id_usuario,$fechaCreacion);
                header('location:../index.php?secc=areasTrabajo&tarsTRa=1');
            }
            else{  header ('location:../index.php?secc=areasTrabajo&tarsTRa=2');
            }
        }
        else{
            //encaso de que ya exista registro actualizamos
            $connn = $areasTra->actualiza($administracion,$produccion,$transporte,$fechaCreacion,$idAreasTrabajo);
            if($connn){
                $rsptaLog = $areasTra->accionLogarea($id_usuario,$fechaCreacion);
                header('location:../index.php?secc=areasTrabajo&tarsTRa=1');
            }
            else{  header ('location:../index.php?secc=areasTrabajo&tarsTRa=2'); }
        }

    }
