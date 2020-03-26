<?php
	@session_start();	
	ini_set('max_execution_time', 300);
	date_default_timezone_set("America/Mexico_City");
  	include "../modelo/preregistroModelo.php";
    $osPreregistro = new DatosPreregistro();
    require_once "../modelo/datosKey.php";
	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d");
	$id_usuario = $_SESSION['id_usuario'];
	
    //obtenemos los valores del usuario
    $rfcAr = $_POST['rfcAr'];
    $clave = $_POST['clave'];
    $sinFima = $_SESSION['noTengoEfirma'];

	//*********************Cargamos los archivos a la carpeta ***************************************//
	
	/* hacemos la prueba para verificar si los archivos son reales */
	if($_FILES["comprobante"]["type"]=="image/jpeg" || $_FILES["comprobante"]["type"]=="image/png" ||  mime_content_type($_FILES['comprobante']['tmp_name']) == 'application/pdf'){ $comprobanteValida = 1;}else{ $comprobanteValida = 2;}

	if($_FILES["iden1"]["type"]=="image/jpeg" || $_FILES["iden1"]["type"]=="image/png" ||  mime_content_type($_FILES['iden1']['tmp_name']) == 'application/pdf'){ $idenveri1 = 1;}else{ $idenveri1 = 2;}

	if($_FILES["iden2"]["type"]=="image/jpeg" || $_FILES["iden2"]["type"]=="image/png" ||  mime_content_type($_FILES['iden2']['tmp_name']) == 'application/pdf'){ $idenveri2 = 1;}else{ $idenveri2 = 2;}

	/* aqui verificamos si mandan el cer o key */
	if($sinFima == 0){
		if($_FILES["key"]["type"]=="application/octet-stream"){ $arckey = 1;}else{ $arckey = 2;}
		if($_FILES["cer"]["type"]=="application/x-x509-ca-cert"){ $arccer = 1;}else{ $arccer = 2;}

		/* aqui convertimos la clave para guardarla */
		$output=FALSE;
		$key=hash('sha256', SECRET_KEY);
		$iv=substr(hash('sha256', SECRET_IV), 0, 16);
		$output=openssl_encrypt($clave, METHOD, $key, 0, $iv);
		$output=base64_encode($output);
	    $claveFinal = $output;

	}else{
		$nombreFinal_4 = 0;
		$nombreFinal_5 = 0;
		$claveFinal = 0;
		$arckey = 1;
		$arccer = 1;
	}
	

	/* ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */

	/* dependiendo de la validacion anterior son los archivos que guardamos */
	if($comprobanteValida == 1){
		/* aqui subimos los archivos */
		if($_FILES["comprobante"]["size"] >= 30000){
    		$nombre_archivo_1 = "comprobante_".$_FILES['comprobante']['name'];
			$nombreFinal_1 = $nombre_archivo_1;
			$uploaddir_1 = "../contenedor/clientes/".$rfcAr."/";
			$directorio_1 = $uploaddir_1.basename($nombreFinal_1);
			move_uploaded_file($_FILES["comprobante"]["tmp_name"], $directorio_1);

		}else{	header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>El peso mayor del archivo es de 3mb, favor de verificar su comprobante.</div>");}
		
	}else{
		/* Aqui redireccionamos para mostrar el mensaje */
		header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>El tipo del archivo de comprobante no es aceptable favor de subir archivo tipo jpg, png o pdf.</div>");
	}

	/* ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	if($idenveri1 == 1){
		/* aqui subimos los archivos */
		//verificamos el tamaño
		if($_FILES["iden1"]["size"] >=30000){
			$nombre_archivo_2 = "iden1_".$_FILES['iden1']['name'];
			$nombreFinal_2 = $nombre_archivo_2;
			$uploaddir_2 = '../contenedor/clientes/'.$rfcAr.'/';
			$directorio_2 = $uploaddir_2. basename($nombreFinal_2);
			move_uploaded_file($_FILES["iden1"]["tmp_name"], $directorio_2);
		}else{header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>El peso mayor del archivo es de 3mb, favor de verificar su identificacion uno.</div>");}
	}else{
		/* Aqui redireccionamos para mostrar el mensaje */
		header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>El tipo del archivo de identificador uno no es aceptable favor de subir archivo tipo jpg, png o pdf.</div>");
	}

	/* ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */

	if($idenveri2 == 1){
		/* aqui subimos los archivos */
		if($_FILES["iden2"]["size"] >=30000){
			$nombre_archivo_3 = "iden2_".$_FILES['iden2']['name'];
			$nombreFinal_3 = $nombre_archivo_3;
			$uploaddir_3 = '../contenedor/clientes/'.$rfcAr.'/';
			$directorio_3 = $uploaddir_3. basename($nombreFinal_3);
			move_uploaded_file($_FILES["iden2"]["tmp_name"], $directorio_3);	
		}else{	header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>El peso mayor del archivo es de 3mb, favor de verificar su identificacion dos.</div");}
	}else{
		/* Aqui redireccionamos para mostrar el mensaje */
		header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>El tipo del archivo de identifacion dos no es aceptable favor de subir archivo tipo jpg, png o pdf.</div>");
	}

	/* ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	if($arckey == 1){
		$nombre_archivo_5 = "cer_".$_FILES['cer']['name'];
		$nombreFinal_5 = $nombre_archivo_5;
		$uploaddir_5 = '../contenedor/clientes/'.$rfcAr.'/';
		$directorio_5 = $uploaddir_5. basename($nombreFinal_5);
		move_uploaded_file($_FILES["cer"]["tmp_name"], $directorio_5);
		//aqui ya cargamos los datos en la bd
	}else{header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>Solo se aceptan archivos tipo cer.</div>");}
		
	/* ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	if($arccer == 1){
		$nombre_archivo_4 = "key_".$_FILES['key']['name'];
		$nombreFinal_4 = $nombre_archivo_4;
		$uploaddir_4 = '../contenedor/clientes/'.$rfcAr.'/';
		$directorio_4 = $uploaddir_4. basename($nombreFinal_4);
		move_uploaded_file($_FILES["key"]["tmp_name"], $directorio_4);	
	}else{header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>Solo se aceptan archivos tipo key.</div>");}
	

	/* ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
	/* terminando de cargar y validar los archivos pasamos a guardar los archivos */
	if($comprobanteValida == 1 && $idenveri1== 1 && $arckey == 1 && $arccer == 1){
		$respuesAgrega = $osPreregistro->gardocumen($nombreFinal_1,$nombreFinal_2,$nombreFinal_3,$nombreFinal_4,$nombreFinal_5,$id_usuario,$claveFinal,$fechaAccion);
		if($respuesAgrega){
			//actualziamos el campo en la tabla de usuario para el preregistro
			$actuPre = $osPreregistro->actpre($id_usuario);
			if($actuPre){
				$rsptaLog = $osPreregistro->lodgar($id_usuario,$fechaAccion);
				if($rsptaLog){
					header("Location: ../preregistro2.php")	;
				}	
			}
			
		}
	}else{
		header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>Error en cargar archivos.</div>");
	}
	

