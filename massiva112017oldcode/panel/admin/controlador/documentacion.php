<?php
	@session_start();	
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
    //verificamos el comprabante
    if($_FILES["comprobante"]["type"]=="image/jpeg" || $_FILES["comprobante"]["type"]=="image/png" ||  mime_content_type($_FILES['comprobante']['tmp_name']) == 'application/pdf'){
    	//verificamos que el tamaño no este mas de 2mb
    	if($_FILES["comprobante"]["size"] >= 30000){
    		$nombre_archivo_1 = "comprobante_".$_FILES['comprobante']['name'];
			$nombreFinal_1 = $nombre_archivo_1;
			$uploaddir_1 = "../contenedor/clientes/".$rfcAr."/";
			$directorio_1 = $uploaddir_1.basename($nombreFinal_1);
			move_uploaded_file($_FILES["comprobante"]["tmp_name"], $directorio_1);
    	}else{	header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>El peso mayor del archivo es de 3mb, favor de verificar su comprobante.</div>");}
    }else{	header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>Solo se aceptan comprobantes en formato jpg, png y pdf .</div>");}
    
    //verificamos iden 1
	if($_FILES["iden1"]["type"]=="image/jpeg" || $_FILES["iden1"]["type"]=="image/png" ||  mime_content_type($_FILES['iden1']['tmp_name']) == 'application/pdf'){
		//verificamos el tamaño
		if($_FILES["iden1"]["size"] >=30000){
			$nombre_archivo_2 = "iden1_".$_FILES['iden1']['name'];
			$nombreFinal_2 = $nombre_archivo_2;
			$uploaddir_2 = '../contenedor/clientes/'.$rfcAr.'/';
			$directorio_2 = $uploaddir_2. basename($nombreFinal_2);
			move_uploaded_file($_FILES["iden1"]["tmp_name"], $directorio_2);
		}else{header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>El peso mayor del archivo es de 3mb, favor de verificar su identificacion uno.</div>");}
	}else{ header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>Solo se aceptan identificaciones en formato jpg, png y pdf .</div>");}

    //verificamos iden2
    if($_FILES["iden2"]["type"]=="image/jpeg" || $_FILES["iden2"]["type"]=="image/png" ||  mime_content_type($_FILES['iden2']['tmp_name']) == 'application/pdf'){
		//verificamos el tamño
		if($_FILES["iden2"]["size"] >=30000){
			$nombre_archivo_3 = "iden2_".$_FILES['iden2']['name'];
			$nombreFinal_3 = $nombre_archivo_3;
			$uploaddir_3 = '../contenedor/clientes/'.$rfcAr.'/';
			$directorio_3 = $uploaddir_3. basename($nombreFinal_3);
			move_uploaded_file($_FILES["iden2"]["tmp_name"], $directorio_3);	
		}else{	header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>El peso mayor del archivo es de 3mb, favor de verificar su identificacion dos.</div");}

	}else{header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>Solo se aceptan identificaciones en formato jpg, png y pdf .</div>");}

	//guardamos estos valores si no vale en uno 
	if($sinFima == 0){
	    //verificamos el archivo key
		if($_FILES["key"]["type"]=="application/octet-stream"){
			$nombre_archivo_4 = "key_".$_FILES['key']['name'];
			$nombreFinal_4 = $nombre_archivo_4;
			$uploaddir_4 = '../contenedor/clientes/'.$rfcAr.'/';
			$directorio_4 = $uploaddir_4. basename($nombreFinal_4);
			move_uploaded_file($_FILES["key"]["tmp_name"], $directorio_4);	
		}else{header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>Solo se aceptan archivos tipo key.</div>");}

	    //verificamos el archivo cer
		if($_FILES["cer"]["type"]=="application/x-x509-ca-cert"){
			$nombre_archivo_5 = "cer_".$_FILES['cer']['name'];
			$nombreFinal_5 = $nombre_archivo_5;
			$uploaddir_5 = '../contenedor/clientes/'.$rfcAr.'/';
			$directorio_5 = $uploaddir_5. basename($nombreFinal_5);
			move_uploaded_file($_FILES["cer"]["tmp_name"], $directorio_5);
			//aqui ya cargamos los datos en la bd
		}else{header("Location: ../preregistro.php?valorReg=<div class='alert alert-danger text-center'>Solo se aceptan archivos tipo cer.</div>");}

		//encriptamos la clave
	    $output=FALSE;
		$key=hash('sha256', SECRET_KEY);
		$iv=substr(hash('sha256', SECRET_IV), 0, 16);
		$output=openssl_encrypt($clave, METHOD, $key, 0, $iv);
		$output=base64_encode($output);

		//decodificar
		/*
		$key=hash('sha256', SECRET_KEY);
				$iv=substr(hash('sha256', SECRET_IV), 0, 16);
				$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
				return $output;
		*/
		
	    $claveFinal = $output;
    }else{
    	$nombreFinal_4 = 0;
    	$nombreFinal_5 = 0;
    	$claveFinal = 0;
    }

    //echo "llega hasta aca";
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
	


