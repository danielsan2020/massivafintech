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
    require_once "../modelo/documentacionModelo.php";
    $documentacion = new documentacion();

	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d");
    $accion = $_POST['accion'];
    $rfc = $_SESSION['rfc'];
    $rfcAr = $_SESSION['rfc'];
    

    //obtenemos los valores para eliminar los archivos
    $idDocumentacion = $_POST['idDocumentacion'];
    $tipo = $_POST['tipo'];

    ///obtenemos los valores de lso archivos
    $id_usuario = $_POST['id_usuario'];
    $tipo = $_POST['tipo'];
    
    
    

    if($accion == 'elimina'){
        //obtenemos el tipo de archivo que hay que eliminar
        $eli = $documentacion->obtengoTipo($idDocumentacion);
        $eliInfo = $eli->fetch_object();
        if($tipo == '1'){
            $valorElimina = $eliInfo->comprobante;
            $archivoBorro = "../contenedor/clientes/".$rfc."/".$valorElimina;
            unlink($archivoBorro);
            $Eliactubs = $documentacion->ActuElim1($idDocumentacion);
            if($Eliactubs){
                $eliDos = $documentacion->eliminaDoc($id_usuario,$fechaAccion);
                return true;
            }

        }
        elseif ($tipo == '2') {
            $valorElimina = $eliInfo->iden1;
            $archivoBorro = "../contenedor/clientes/".$rfc."/".$valorElimina;
            unlink($archivoBorro);
            $Eliactubs = $documentacion->ActuElim2($idDocumentacion);
            if($Eliactubs){
                $eliDos = $documentacion->eliminaDoc($id_usuario,$fechaAccion);
                return true;
            }
        }
        elseif ($tipo == '3') {
            $valorElimina = $eliInfo->iden2;
            $archivoBorro = "../contenedor/clientes/".$rfc."/".$valorElimina;
            unlink($archivoBorro);
            $Eliactubs = $documentacion->ActuElim3($idDocumentacion);
            if($Eliactubs){
                $eliDos = $documentacion->eliminaDoc($id_usuario,$fechaAccion);
                return true;
            }
        }
        elseif ($tipo == '4') {
            $valorElimina = $eliInfo->keyaar;
            $archivoBorro = "../contenedor/clientes/".$rfc."/".$valorElimina;
            unlink($archivoBorro);
            $Eliactubs = $documentacion->ActuElim4($idDocumentacion);
            if($Eliactubs){
                $eliDos = $documentacion->eliminaDoc($id_usuario,$fechaAccion);
                return true;
            }
        }
        
        elseif ($tipo == '5') {
            $valorElimina = $eliInfo->cerar;
            $archivoBorro = "../contenedor/clientes/".$rfc."/".$valorElimina;
            unlink($archivoBorro);
            $Eliactubs = $documentacion->ActuElim5($idDocumentacion);
            if($Eliactubs){
                $eliDos = $documentacion->eliminaDoc($id_usuario,$fechaAccion);
                return true;
            }
        }
    }

    if($accion == 'subir'){
        
        if($tipo == 1){
            if($_FILES["imagen"]["type"]=="image/jpeg" || $_FILES["imagen"]["type"]=="image/png" ||  mime_content_type($_FILES['imagen']['tmp_name']) == 'application/pdf'){
                //verificamos que el tamaño no este mas de 2mb
                if($_FILES["imagen"]["size"] >= 30000){
                    $nombre_archivo_1 = "comprobante_".$_FILES['imagen']['name'];
                    $nombreFinal_1 = $nombre_archivo_1;
                    $uploaddir_1 = "../contenedor/clientes/".$rfcAr."/";
                    $directorio_1 = $uploaddir_1.basename($nombreFinal_1);
                    move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio_1);
                    //actualizamos el valor en la bd
                    $valor = $nombreFinal_1;
                    $erditArchi = $documentacion->ActuArchi1($valor, $id_usuario);
                    if($erditArchi){ 
                        $actu = $documentacion->actualizaDoc($id_usuario,$fechaAccion);
                        header('location:../index.php?secc=archivos&tiArchivo=1'); 
                    }
                    
                }else{  header ('location:../index.php?secc=archivos&tiArchivo=2');}
            }else{  header ('location:../index.php?secc=archivos&tiArchivo=2');}
        }

        if($tipo == 2){
            if($_FILES["imagen"]["type"]=="image/jpeg" || $_FILES["imagen"]["type"]=="image/png" ||  mime_content_type($_FILES['imagen']['tmp_name']) == 'application/pdf'){
                //verificamos el tamaño
                if($_FILES["imagen"]["size"] >=30000){
                    $nombre_archivo_2 = "iden1_".$_FILES['imagen']['name'];
                    $nombreFinal_2 = $nombre_archivo_2;
                    $uploaddir_2 = '../contenedor/clientes/'.$rfcAr.'/';
                    $directorio_2 = $uploaddir_2. basename($nombreFinal_2);
                    move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio_2);
                    
                    //actualizamos el archivo en la bd
                    $valor = $nombreFinal_2;
                    $erditArchi = $documentacion->ActuArchi2($valor, $id_usuario);
                    if($erditArchi){ 
                        $actu = $documentacion->actualizaDoc($id_usuario,$fechaAccion);
                        header('location:../index.php?secc=archivos&tiArchivo=1'); 
                     }
                    
                }else{  header ('location:../index.php?secc=archivos&tiArchivo=2');}
            }
        }

        if($tipo == 3){
            if($_FILES["imagen"]["type"]=="image/jpeg" || $_FILES["imagen"]["type"]=="image/png" ||  mime_content_type($_FILES['imagen']['tmp_name']) == 'application/pdf'){
                //verificamos el tamño
                if($_FILES["imagen"]["size"] >=30000){
                    $nombre_archivo_3 = "iden2_".$_FILES['imagen']['name'];
                    $nombreFinal_3 = $nombre_archivo_3;
                    $uploaddir_3 = '../contenedor/clientes/'.$rfcAr.'/';
                    $directorio_3 = $uploaddir_3. basename($nombreFinal_3);
                    move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio_3);    
                    
                    //actualizamos el archivo en la bd
                    $valor = $nombreFinal_3;
                    $erditArchi = $documentacion->ActuArchi3($valor, $id_usuario);
                    if($erditArchi){ 
                        $actu = $documentacion->actualizaDoc($id_usuario,$fechaAccion);
                        header('location:../index.php?secc=archivos&tiArchivo=1'); 
                    }

                }else{  header ('location:../index.php?secc=archivos&tiArchivo=2');}
            }
        }

        if($tipo == 4){
            if($_FILES["imagen"]["type"]=="application/octet-stream"){
                $nombre_archivo_4 = "key_".$_FILES['imagen']['name'];
                $nombreFinal_4 = $nombre_archivo_4;
                $uploaddir_4 = '../contenedor/clientes/'.$rfcAr.'/';
                $directorio_4 = $uploaddir_4. basename($nombreFinal_4);
                move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio_4);  
                
                //actualizamos el archivo en la bd
                $valor = $nombreFinal_4;
                $erditArchi = $documentacion->ActuArchi4($valor, $id_usuario);
                if($erditArchi){
                    $actu = $documentacion->actualizaDoc($id_usuario,$fechaAccion);
                    header('location:../index.php?secc=archivos&tiArchivo=1'); 
                 }

            }else{  header ('location:../index.php?secc=archivos&tiArchivo=2');}
        }

        if($tipo == 5){
            if($_FILES["imagen"]["type"]=="application/x-x509-ca-cert"){
                $nombre_archivo_5 = "cer_".$_FILES['imagen']['name'];
                $nombreFinal_5 = $nombre_archivo_5;
                $uploaddir_5 = '../contenedor/clientes/'.$rfcAr.'/';
                $directorio_5 = $uploaddir_5. basename($nombreFinal_5);
                move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio_5);
                
                //actualizamos el archivo en la bd
                $valor = $nombreFinal_5;
                $erditArchi = $documentacion->ActuArchi5($valor, $id_usuario);
                if($erditArchi){ 
                    $actu = $documentacion->actualizaDoc($id_usuario,$fechaAccion);
                    header('location:../index.php?secc=archivos&tiArchivo=1'); 
                }
            
            }else{  header ('location:../index.php?secc=archivos&tiArchivo=2'); }
        }
    }
