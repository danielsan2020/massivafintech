<?php
	/*error_reporting(E_ALL);
	ini_set('display_errors','1');*/
	@session_start();	
	date_default_timezone_set("America/Mexico_City");
  	include "../modelo/preregistroModelo.php";
  	require_once "../modelo/datosKey.php";
    $osPreregistro = new DatosPreregistro();

    //*********************funcion para generar numeros aleatorios***************************************//
    function generarCodigo($longitud) {
		 $key = '';
		 $pattern = '1234567890';
		 $max = strlen($pattern)-1;
		 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
		 return $key;
	}


	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d");
    $id_usuario = $_SESSION['id_usuario'];
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
	$curp = $_POST['curp'];

	if($accion == 'actualizaInformacion'){
		$rspta = $osPreregistro->actualizac($nombre,$ape_paterno,$ape_materno,$telefono,$correo,$tipoActividad,$formaJuridica,$cantidadTrabajadores,$contabilidadAtrasada,$nacimiento,$dirfiscal,$estado,$ciudad,$municipio,$codigoPromo,$id_usuario,$curp);
		if($rspta){
			//actualziamos el campo en la tabla de usuario para el preregistro
			$actuPre = $osPreregistro->actpre2($id_usuario);
			if($actuPre){
				$rsptaLog = $osPreregistro->accionLogActualiza($id_usuario,$fechaAccion);
				if($rsptaLog){
					header("Location: ../preregistro4.php")	;
				}	
			}
			
		}
	}
	
	//*********************Datos para actualizar archivos ***************************************//
	$selecciona = $_POST['selecciona'];
	$costo = $_POST['costo'];
	
	//generamos el codigo para el pago a mano 
	$codigoPagoManual = generarCodigo(16);

	//*********************Datos para guardar tarjetas ***************************************//
	$tipo = $_POST['tipo'];
	$nombre = $_POST['nombre'];
	$numero = $_POST['numero'];
	$fechaMes = $_POST['fechaMes'];
	$fechaAno = $_POST['fechaAno'];
	//cambiamos el codigo por conversion
	$codigo = $_POST['codigo'];
	$output=FALSE;
	$key=hash('sha256', SECRET_KEY);
	$iv=substr(hash('sha256', SECRET_IV), 0, 16);
	$output=openssl_encrypt($clave, METHOD, $key, 0, $iv);
	$output=base64_encode($output);
	$codigo = $output;

	$tipo1 = $_POST['tipo1'];
	$nombre1 = $_POST['nombre1'];
	$numero1 = $_POST['numero1'];
	$fechaMes1 = $_POST['fechaMes1'];
	$fechaAno1 = $_POST['fechaAno1'];
	//cambiamos el codigo por conversion
	$codigo1 = $_POST['codigo1'];
	$output1=FALSE;
	$key1=hash('sha256', SECRET_KEY);
	$iv1=substr(hash('sha256', SECRET_IV), 0, 16);
	$output1=openssl_encrypt($clave1, METHOD, $key1, 0, $iv1);
	$output1=base64_encode($output1);
	$codigo1 = $output1;

	if($tipo != ''){
		if($tipo1){
			$rspta = $osPreregistro->agregtajeta($tipo,$nombre,$numero,$fechaMes,$fechaAno,$codigo,$id_usuario,$fechaAccion);
			if($rspta){
				$rspta2 = $osPreregistro->agregtajetaDos($tipo1,$nombre1,$numero1,$fechaMes1,$fechaAno1,$codigo1,$id_usuario,$fechaAccion);
				if($rspta2){
					//actualziamos el campo en la tabla de usuario para el preregistro
					$rsptaLog = $osPreregistro->accionLogagretarje($id_usuario,$fechaAccion);
					if($rsptaLog){
						return true;
					}		
				}
				
			}
		}else{
			//verificamos si ya existe un paquete seleccionado
		$rspta = $osPreregistro->agregtajeta($tipo,$nombre,$numero,$fechaMes,$fechaAno,$codigo,$id_usuario,$fechaAccion);
		if($rspta){
			//actualziamos el campo en la tabla de usuario para el preregistro
			$rsptaLog = $osPreregistro->accionLogagretarje($id_usuario,$fechaAccion);
			if($rsptaLog){
				
				return true;
			}	
		}	
		}
		
	}

	//*********************Valores para el cambio del sinco al 6 ***************************************//
	$Idncamos = $_POST['Idncamos'];
	if($Idncamos){
		$rspta = $osPreregistro->cambiosincoseis($id_usuario);
		if($rspta){
			return true;
		}
	}
	
	//*********************Valores para el cambio del 6 al 7 ***************************************//
	$idRefe = $_POST['idRefe'];
	if($idRefe){
		$rspta = $osPreregistro->cambioseisSite($id_usuario);
		if($rspta){
			return true;
		}
	}
	
	//*********************Valores para finalzar el formulario de ingreso ***************************************//
	/*
	$idSaneRef = $_POST['idSaneRef'];
	if($idSaneRef){
		$rspta = $osPreregistro->finalSanear($id_usuario);
		
	
		$rspta = $osPreregistro->agregocliPre($id_usuario);
		if($rspta){
			return true;
		}
	}*/
	$atrasada = $_POST['atrasada'];
	$idSaneRef2 = $_POST['idSaneRef2'];
	if($idSaneRef2){
		if($atrasada == 1){
			$rspta = $osPreregistro->finalSanearAtrasada($id_usuario);	
		}else{
		$rspta = $osPreregistro->finalSanear($id_usuario);
		}
		/* agregamos el cliente predeterminado */
		$rspta = $osPreregistro->agregocliPre($id_usuario);
		if($rspta){
			return true;
		}
	}
	
	//if($selecciona > 0){
	    switch ($accion) {
	    	////////actualizamos la informacion en el preregistro
	        
	        //par ala seleccion de paquete
	        case "seLPaquete":
	        		//verificamos si ya existe un paquete seleccionado
	        /*		$rsptaVeri = $osPreregistro->Verificpaqu($id_usuario);
	        		$rsptaVeriInfo = $rsptaVeri->fetch_object();
					//valores para agregar a los cuadros
					$idSeleccion = $rsptaVeriInfo->idSeleccion;*/

					//if($idSeleccion == ''){
						//en caso de que no exista un registro
						$rspta = $osPreregistro->seleccpaquete($selecciona,$costo,$id_usuario,$fechaAccion,$codigoPagoManual);
						if($rspta){
							//actualziamos el campo en la tabla de usuario para el preregistro
							$actuPre = $osPreregistro->actpre2($id_usuario);

							/* obtenemos el numero de facturas del cliente en base a la selecciono */
							//echo $selecciona;
							$numpa = $osPreregistro->numfac($selecciona);
							$numpaInfo = $numpa->fetch_object();
							$numfacfinal = $numpaInfo->cfdi;

							//echo $numfacfinal;

							/* creamos el registro de facturas dependiendo del paquete */
							$creafac = $osPreregistro->agregofac($id_usuario,$numfacfinal);

							if($actuPre){
								$rsptaLog = $osPreregistro->accionLogSelecPaquete($id_usuario,$fechaAccion);
								
								echo "<script>window.location.href='../preregistro5.php';</script>";
								/*header_remove();
								header("Location: ../preregistro5.php");*/
							}
						}
				/*	}else{
						//en caso de que ya exista un registro actualizamos el valor
						$rspta = $osPreregistro->seleccpaqueteAcu($selecciona,$costo,$id_usuario,$fechaAccion,$codigoPagoManual);
						if($rspta){
							//actualziamos el campo en la tabla de usuario para el preregistro
							$actuPre = $osPreregistro->actpre2($id_usuario);
							if($actuPre){
								$rsptaLog = $osPreregistro->accionLogSelecPaquete($id_usuario,$fechaAccion);
								if($rsptaLog){
									header("Location: ../preregistro5.php")	;
								}	
							}
						}*/
					
			break;
			case "terminoBien":
				/* cambiamos status del usuario para registrar */
				$rspta = $osPreregistro->finalSanear($id_usuario);
				/* obtenemos valores para agregar nuevo cliente */
				$nombreE = 'Público general';
				$rfcE = 'XAXX010101000';
				$cpE = '06700';
				$correo1E = $_POST['correo1E'];
				$logo = 'logo_cli.png';
				$observacionesE = 'Este Cliente aplica solo cuando requieres hacer una factura de tus ingresos pero nadie te solicitó facturas pero el SAT te solicita demostrar esos ingresos. En esta ocasión utiliza Público en general.';
				$fijo = '1';
				

				/* agregamos valor del cliente */
				$rspta = $osPreregistro->primerCliente($id_usuario,$nombreE,$rfcE,$cpE,$correo1E,$observacionesE,$fijo,$logo);

				header("Location: ../index.php");

			break;
			
			/* seccion de subir archivos cuando el usuario no tiene e firma en el ultimo paso */
			case "presubeefirma":
				/* obtenemos los valores para guardar */
				$id_usuarioEfirm = $_POST['id_usuarioEfirm'];
				$claveesinefirma = $_POST['claveesinefirma'];
				$rfcefir = $_POST['rfcefir'];

				/* validamos que lso archivos cer y key sean el valor */
				if($_FILES["cersinefirma"]["type"]=="application/x-x509-ca-cert"){ $arcceree = 1;}else{ $arcceree = 2;}
				if($_FILES["keysinefirma"]["type"]=="application/octet-stream"){ $arckeyee = 1;}else{ $arckeyee = 2;}
				

				/* ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
				if($arcceree == 1){
					$nombre_archivo_5 = "cer_".$_FILES['cersinefirma']['name'];
					$nombreFinal_5 = $nombre_archivo_5;
					$uploaddir_5 = '../contenedor/clientes/'.$rfcefir.'/';
					$directorio_5 = $uploaddir_5. basename($nombreFinal_5);
					move_uploaded_file($_FILES["cersinefirma"]["tmp_name"], $directorio_5);
					//aqui ya cargamos los datos en la bd
				}else{header("Location: ../preregistro7.php?valorReg=<div class='alert alert-danger text-center'>Solo se aceptan archivos tipo cer.</div>");}
					
				/* ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
				if($arckeyee == 1){
					$nombre_archivo_4 = "key_".$_FILES['keysinefirma']['name'];
					$nombreFinal_4 = $nombre_archivo_4;
					$uploaddir_4 = '../contenedor/clientes/'.$rfcefir.'/';
					$directorio_4 = $uploaddir_4. basename($nombreFinal_4);
					move_uploaded_file($_FILES["keysinefirma"]["tmp_name"], $directorio_4);	
				}else{header("Location: ../preregistro7.php?valorReg=<div class='alert alert-danger text-center'>Solo se aceptan archivos tipo key.</div>");}

				/* validamos si los archivos estan validados */
				if($arcceree == 1 && $arckeyee== 1){
					/* guardamos la documentacion en la tabla */
					$respuesAgrega = $osPreregistro->gardocumensinefirm($nombre_archivo_5,$nombre_archivo_4,$id_usuarioEfirm,$claveesinefirma,$fechaAccion);
					/* ahora actualizamos el valor del preregistro */
					$actuPre = $osPreregistro->sinefirmAct($id_usuarioEfirm);
					header("Location: ../index.php");
				}else{ header("Location: ../preregistro7.php?valorReg=<div class='alert alert-danger text-center'>Error en cargar archivos.</div>");	}

				

			break;
				


	    }

    /*}else{
    	header("Location: ../preregistro4.php?val=1")	;
    }*/


