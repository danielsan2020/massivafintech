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
    require_once "../modelo/noticiasWeb.php";
    $noticiasWeb = new noticiasWeb();

	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d");
    $accion = $_POST['accion'];
	$id_usuario = $_SESSION['id_usuario'];
    
	$idNoticiaWeb23 = ($_POST['idNoticiaWeb23'] == '')? '' : $_POST['idNoticiaWeb23']; 
	$imRefe2 = ($_POST['imRefe2'] == '')? '' : $_POST['imRefe2']; 


    //**********************valores formulario nuevo****************************//
		
	////valor para obtener la informacion de la noticia
	$idNoticiaWeb = ($_POST['idNoticiaWeb'] == '')? '' : $_POST['idNoticiaWeb']; 
	if($idNoticiaWeb != ""){
        $data=$noticiasWeb->consultaEdita($idNoticiaWeb);
		echo json_encode($data);
    }
	
	if($accion){
		
		$archivoBorro = "../contenedor/noticiasWeb/".$imRefe2;
		unlink($archivoBorro);

		$eliminaElme = $noticiasWeb->eliminaNoticia($idNoticiaWeb23);
		 if($eliminaElme){ 
			 $rsptaLog = $noticiasWeb->accionLogElimina($id_usuario,$fechaAccion);
		 	if($rsptaLog){return true;}
		 }else{
			 return false;
		 }
	}

?>
