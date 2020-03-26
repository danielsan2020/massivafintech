<?php
@session_start();	
	date_default_timezone_set("America/Mexico_City");
    //session_start();
	/*error_reporting(E_ALL);
	ini_set('display_errors','1');*/

   
    /****************************************************************/
    // FUNCIONES GENERALES PARA EL SITIO                            //
    // CREACION DEL ARCHIVO: 27/08/2018                             //
    // MODIFICA Y/O TRABAJA: Azael HV                               //
    // PROYECTO: http://www.elinnovador.mx/                         //
    /****************************************************************/

    //instanciamos el modelo 
    require_once "../modelo/actualizacionesModelo.php";
    $actuali = new actuali();

	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d H:i:s");
	$usuarioSe = $_SESSION['id_usuario'];
	$rfc = $_SESSION['rfc'];
    $accion = $_POST['accion'];

   
	/****************************Acciones dependiendo de la variable*************************************///
   switch ($accion) {

        case "obligaciones":
			/* obtenemos los valores */
			$costo = $_POST['costo'];
			$fecha = $_POST['fecha'];
			$actividad = $_POST['actividad'];

				//guardamos el valor en la base de datos
				$agregoRespuesta = $actuali->ActuObli($costo,$fecha,$actividad,$usuarioSe,$fechaAccion);
				/* en esta seccion realizamos el cobro con openbay */
				   
			   	if($agregoRespuesta){ 
			   		$inlog = $actuali->accionObligaciones($usuarioSe,$fechaAccion);
			   		header("location:../index.php?secc=obligacionesFiscales_inicio&ActuObli=1");
			   	}
				else{ header("location:../index.php?secc=obligacionesFiscales_inicio&ActuObli=2");	}

		break;

		 case "efirmam":
			/* obtenemos los valores */
			$costo = $_POST['costo'];

				//guardamos el valor en la base de datos
				$agregoRespuesta = $actuali->actuEfirma($costo,$fechaAccion,$usuarioSe);
				/* en esta seccion realizamos el cobro con openbay */
				   
			   	if($agregoRespuesta){ 
			   		$inlog = $actuali->accionefirma($usuarioSe,$fechaAccion);
			   		header("location:../index.php?secc=actualizacionefirma&Actuefirma=1");
			   	}
				else{ header("location:../index.php?secc=actualizacionefirma&Actuefirma=2");	}

		break;
		case "suspension":
			/* obtenemos los valores */
			$costo = $_POST['costo'];

			//guardamos el valor en la base de datos
			$agregoRespuesta = $actuali->actuSuspen($costo,$fechaAccion,$usuarioSe);
			/* en esta seccion realizamos el cobro con openbay */
				
			if($agregoRespuesta){ 
				$inlog = $actuali->accionsuspension($usuarioSe,$fechaAccion);
				header("location:../index.php?secc=suspencionActividades&Actususpencion=1");
			}
			else{ header("location:../index.php?secc=suspencionActividades&Actususpencion=2");	}	

		break;

		case "domicilio":
			/* obtenemos los valores */
			$costo = $_POST['costo'];
			$direccion = $_POST['direccion'];
			$estado = $_POST['estado'];
			$ciudad = $_POST['ciudad'];
			$municipio = $_POST['municipio'];
			$cppp = $_POST['cppp'];

			$nombre_archivo = "comprobante_actualiza_Domi_".$_FILES['comprobante']["name"];
			$uploaddir = "../contenedor/clientes/".$rfc."/";
			$directorio = $uploaddir. basename($nombre_archivo);
			move_uploaded_file($_FILES["comprobante"]["tmp_name"], $directorio);

			//guardamos el valor en la base de datos
			$agregoRespuesta = $actuali->actuDomn($costo,$direccion,$estado,$ciudad,$municipio,$cppp,$nombre_archivo,$usuarioSe,$fechaAccion);
			/* en esta seccion realizamos el cobro con openbay */
				
			if($agregoRespuesta){ 
				$inlog = $actuali->accionsuspension($usuarioSe,$fechaAccion);
				header("location:../index.php?secc=cambioDomicilio&Actudomi=1");
			}
			else{ header("location:../index.php?secc=cambioDomicilio&Actudomi=2");	}	
		break;
		
		case "constancia":
			/* obtenemos los valores */
			$costo = $_POST['costo'];

			//guardamos el valor en la base de datos
			$agregoRespuesta = $actuali->actuConsss($costo,$fechaAccion,$usuarioSe);
			/* en esta seccion realizamos el cobro con openbay */
				
			if($agregoRespuesta){ 
				$inlog = $actuali->accionconstancia($usuarioSe,$fechaAccion);
				header("location:../index.php?secc=constanciaFiscal&ActuconsFis=1");
			}
			else{ header("location:../index.php?secc=constanciaFiscal&ActuconsFis=2");	}	

		break;

		case "defuncion":
			/* obtenemos los valores */
			$costo = $_POST['costo'];

			$nombre_archivo = "acta_defuncion_".$_FILES['defuncion']["name"];
			$uploaddir = "../contenedor/clientes/".$rfc."/";
			$directorio = $uploaddir. basename($nombre_archivo);
			move_uploaded_file($_FILES["defuncion"]["tmp_name"], $directorio);

			//guardamos el valor en la base de datos
			$agregoRespuesta = $actuali->actudefuncion($costo,$nombre_archivo,$usuarioSe,$fechaAccion);
			/* en esta seccion realizamos el cobro con openbay */
				
			if($agregoRespuesta){ 
				$inlog = $actuali->acciondefuncion($usuarioSe,$fechaAccion);
				header("location:../index.php?secc=defuncion&Actudefu=1");
			}
			else{ header("location:../index.php?secc=defuncion&Actudefu=2");	}	
		break;
			
       
    }
 
        
   
   
    



?>