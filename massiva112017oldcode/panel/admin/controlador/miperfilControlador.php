<?php
@session_start();	
	//error_reporting(E_ALL);
	//ini_set('display_errors','1');
	date_default_timezone_set("America/Mexico_City");
  	include "../modelo/miperfilModelo.php";
  	require_once "../modelo/datosKey.php";
  	
    $Mipefil = new Mipefil();

    
	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d");
    $id_usuario = $_SESSION['id_usuario'];
    $rfc = $_SESSION['rfc'];
    //obtenemos los valores del usuario
    $accion = $_POST['accion'];
    
    //*********************Datos para actualizar archivos ***************************************//
	$nombre = $_POST['nombre'];
	$ape_paterno = $_POST['ape_paterno'];
	$ape_materno = $_POST['ape_materno'];
	$telefono = $_POST['telefono'];
	$correo = $_POST['correo'];
	$tipoActividad = $_POST['tipoActividad'];
	$formaJuridica = $_POST['formaJuridica'];
	$cantidadTrabajadores = $_POST['cantidadTrabajadores'];
	$contabilidadAtrasada = $_POST['contabilidadAtrasada'];
	$tipoUsuario = $_POST['tipoUsuario'];
	$nacimiento = $_POST['nacimiento'];
	$dirfiscal = $_POST['dirfiscal'];
	$estado = $_POST['estado'];
	$ciudad = $_POST['ciudad'];
	$municipio = $_POST['municipio'];
	$codigoPromo = $_POST['codigoPromo'];

	//valores para edicion dentro del perfil	
	$fotoRefe = $_POST['fotoRefe'];
	$curp = $_POST['curp'];
	$clave = $_POST['clave'];
	$contraefirma = $_POST['contraefirma'];

	
	

	if($accion == 'EditaInfo'){
		///verificamos si ya hay un archivo y en caso de que si borramos la informacion
		$archivoBorro = "../contenedor/clientes/".$rfc."/".$fotoRefe;
		unlink($archivoBorro);

		//si no hay informacion agregamos archivo
		$nombre_archivo = "perfil_".$_FILES['foto']['name'];
		$nombreFinal = $nombre_archivo;
		$uploaddir = "../contenedor/clientes/".$rfc."/";
		$directorio = $uploaddir. basename($nombreFinal);
		move_uploaded_file($_FILES["foto"]["tmp_name"], $directorio);

		//actualizamos la informacion
		$rspta = $Mipefil->actualizac($nombre,$ape_paterno,$ape_materno,$telefono,$correo,$tipoActividad,$formaJuridica,$cantidadTrabajadores,$contabilidadAtrasada,$nacimiento,$dirfiscal,$estado,$ciudad,$municipio,$codigoPromo,$id_usuario,$nombreFinal,$tipoUsuario,$curp,$clave);

		if($rspta){
			//actualziamos la clave del sat

			//encriptamos la calve del sat
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($contraefirma, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			
			$rsptaLog = $Mipefil->actulicalveefir($id_usuario,$output);			

			$rsptaLog = $Mipefil->logActuPerfil($id_usuario,$fechaAccion);
			if($rsptaLog){
			 $_SESSION["foto"]=$nombreFinal;
				header ('location:../index.php?secc=perfil&reinfoactu=1');
			}
			else{
				header ('location:../index.php?secc=perfil&reinfoactu=2');	
			}	
			
			
		}
	}

