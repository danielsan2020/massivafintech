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
    
    //**********************valores formulario nuevo****************************//
	$titulo = ($_POST['titulo'] == '')? '' : $_POST['titulo']; 
	$noticia = ($_POST['noticia'] == '')? '' : $_POST['noticia']; 
	$fecha = ($_POST['fecha'] == '')? '' : $_POST['fecha']; 
	$referencia = ($_POST['referencia'] == '')? '' : $_POST['referencia']; 
	$url = ($_POST['url'] == '')? '' : $_POST['url']; 
	
	////valor para obtener la informacion de la noticia
	$idNoticiaWeb = ($_POST['idNoticiaWeb'] == '')? '' : $_POST['idNoticiaWeb']; 
	if($idNoticiaWeb != ""){
        $data=$noticiasWeb->consultaEdita($idNoticiaWeb);
		echo json_encode($data);
    }

    //**********************valores para edicion****************************//       
	$titulo1 = ($_POST['titulo1'] == '')? '' : $_POST['titulo1']; 
	$noticia1 = ($_POST['noticia1'] == '')? '' : $_POST['noticia1']; 
	$fecha1 = ($_POST['fecha1'] == '')? '' : $_POST['fecha1']; 
	$referencia1 = ($_POST['referencia1'] == '')? '' : $_POST['referencia1']; 
	$url1 = ($_POST['url1'] == '')? '' : $_POST['url1'];

	$idNoticiaWeb1 = ($_POST['idNoticiaWeb1'] == '')? '' : $_POST['idNoticiaWeb1']; 
	$imRefe = ($_POST['imRefe'] == '')? '' : $_POST['imRefe']; 

	$tamano= $_FILES['iuno']['size'];

  
	/****************************Acciones dependiendo de la variable*************************************///
	
	

	/****************************Acciones dependiendo de la variable*************************************///
    switch ($accion) {
        case "nuevaNoticia":
			$nombre_archivo = "noticia_".$_FILES['imagen']['name'];
			$nombreFinal = $nombre_archivo;
			$uploaddir = '../contenedor/noticiasWeb/';
			$directorio = $uploaddir. basename($nombreFinal);
			move_uploaded_file($_FILES["imagen"]["tmp_name"], $directorio);
			$rspta = $noticiasWeb->nuevaNoticiaWeb($titulo,$noticia,$fecha,$referencia,$nombreFinal,$id_usuario,$fechaAccion,$url);
			if($rspta){
				///guardamo el evento en el log
				$rsptaLog = $noticiasWeb->accionLogagrega($id_usuario,$fechaAccion);
				if(rsptaLog){ $resultado = "<div class='alert alert-success text-center'>Se agrego satisfactoriamente la noticia .</div>";}
			}else{
				$resultado = "<div class='alert alert-danger text-center'>Ocurrio un error favor de verificar sus datos .</div>";
			}
        break;
			 
		case "editar":
			if ($tamano > 0 ){ ////caso cuando el usuario cambie la imagen
		
				///primero borramos la imagen
				$archivoBorro = "../contenedor/noticiasWeb/".$imRefe;
				unlink($archivoBorro);

				$nombre_archivo = $_FILES['iuno']["name"];
				$nombreFinal = $nombre_archivo;
				$uploaddir = '../contenedor/noticiasWeb/';
				$directorio = $uploaddir. basename($nombreFinal);
				move_uploaded_file($_FILES["iuno"]["tmp_name"], $directorio);
				//guardamos el valor en la base de datos
				
				$datosInf = $noticiasWeb->editarDatos($idNoticiaWeb1,$titulo1,$noticia1,$fecha1,$referencia1,$url1,$nombreFinal);
				if($datosInf){ 
					$rsptaLog = $noticiasWeb->accionLogEdita($id_usuario,$fechaAccion);
					if($rsptaLog){$resultado = "<div class='alert alert-success text-center'>Se edito su noticia web.</div>";}
				}else{
					$resultado = "<div class='alert alert-danger text-center'>Ocurrio un error favor de verificar sus datos .</div>";
				}
			}else{
				
				$rsptaLog = $noticiasWeb->accionLogEdita($id_usuario,$fechaAccion);
				$datosInf = $noticiasWeb->editarDatos2($idNoticiaWeb1,$titulo1,$noticia1,$fecha1,$referencia1,$url1,$imRefe);
				if($datosInf){ 	$resultado = "<div class='alert alert-success text-center'>Se edito su noticia web.</div>";	}
				else{ $resultado = "<div class='alert alert-danger text-center'>Ocurrio un error favor de verificar sus datos .</div>";	}
			}
        break;
			
			
        
    }

?>
<html>
	<?php include '../estructura/header_acciones.php';?>	
	<body style="background-color: #FFFFFF !important;">
		<?php echo $resultado;?>
	</body>
</html>

