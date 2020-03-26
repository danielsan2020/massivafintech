<?php
@session_start();	
//instanaciamos la funcion de php mailer
	   
    /****************************************************************/
    // FUNCIONES GENERALES PARA EL SITIO                            //
    // CREACION DEL ARCHIVO: 27/08/2018                             //
    // MODIFICA Y/O TRABAJA: Azael HV                               //
    // PROYECTO: http://www.elinnovador.mx/                         //
    /****************************************************************/

	//error_reporting(E_ALL);
	//ini_set('display_errors','1');

    //instanciamos el modelo 
    require_once "../modelo/bancosModelo.php";
    require_once "../modelo/datosKey.php";
    $simula = new bancos();

	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d H:i:s");
	$usuarioSe = $_SESSION['id_usuario'];
    $accion = $_POST['accion'];
    
	//**********************valores formulario edicion****************************//
 	switch ($accion) {
 		//agregamos el nuevo seguro
 		
		case "solicita":
			$nombreBanco = ($_POST['nombreBanco'] == '')? '' : $_POST['nombreBanco'];
		    $url = ($_POST['url'] == '')? '0' : $_POST['url'];
		    $estatus = '1';
			$rspta = $simula->solicitudBanco($nombreBanco,$url,$estatus,$usuarioSe,$fechaAccion);	
			if($rspta){ 
				$rsptaLog = $simula->accionSolicita($usuarioSe,$fechaAccion);
				header ('location:../index.php?secc=cuentaBancarias&vaBan=1'); 
			}	
			else{ header ('location:../index.php?secc=cuentaBancarias&vaBan=2'); }
		break;
			
		case "nuevoBan":
			echo "entro a la segunda<br>";
			//valores para registrar el bancos
			$claveBanco = $_POST['claveBanco'];
			$fecha = $_POST['fecha'];
			$usuarioBanco = $_POST['usuarioBanco'];
			$contraBanco = $_POST['contraBanco'];
	
		/*    //convertimos los valores para guardarlos

		    ///convertimos el usuario
		    $output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($usuarioBanco, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			$usuarioBanco = $output;

			///convertimos el clave
		    $output2=FALSE;
			$key2=hash('sha256', SECRET_KEY);
			$iv2=substr(hash('sha256', SECRET_IV), 0, 16);
			$output2=openssl_encrypt($contraBanco, METHOD, $key2, 0, $iv2);
			$output2=base64_encode($output2);
			$contraBanco = $output2;

			///convertimos el fecha
		    $output3=FALSE;
			$key3=hash('sha256', SECRET_KEY);
			$iv3=substr(hash('sha256', SECRET_IV), 0, 16);
			$output3=openssl_encrypt($fecha, METHOD, $key3, 0, $iv3);
			$output3=base64_encode($output3);
			$fecha = $output3;*/

			$respuestaBanco = $simula->bancoUsuario($claveBanco,$fecha,$usuarioBanco,$contraBanco,$fechaAccion,$usuarioSe);	
			if($respuestaBanco){ 
				$rsptaLog = $simula->accionagrega($usuarioSe,$fechaAccion);
				header ('location:../index.php?secc=cuentaBancarias&vaBan=3'); 
			}	
			else{ header ('location:../index.php?secc=cuentaBancarias&vaBan=2'); }
		break;

		case "elimina":
			$idBanco = $_POST['idBanco'];
			$eliBannn = $simula->eliminaBanco($idBanco);	
			if($eliBannn){ 
				$rsptaLog = $simula->accionElin($usuarioSe,$fechaAccion);
				header ('location:../index.php?secc=cuentaBancarias&vaBan=4'); 
			}	
			else{ header ('location:../index.php?secc=cuentaBancarias&vaBan=2'); }
		break;

		case "movimiento":
			$cuentamm = $_POST['cuentamm'];
			$tipomm = $_POST['tipomm'];
			$balancemm = $_POST['balancemm'];
			$monedamm = $_POST['monedamm'];
			$id_usuariomm = $_SESSION['id_usuario'];

			$moviManulk = $simula->moviManulk($cuentamm,$tipomm,$balancemm,$monedamm,$id_usuariomm,$fechaAccion);	
			
			if($moviManulk){ 
				$rsptaLog = $simula->agregaManu($usuarioSe,$fechaAccion);
				header ('location:../index.php?secc=cuentaBancarias&vaBan=5'); 
			}	
			else{ header ('location:../index.php?secc=cuentaBancarias&vaBan=2'); }
			
		break;

		/* para contemplar */
		case "movidecla1":
			$unooM1 = $_POST['unooM1'];
			$unooM11 = $_POST['unooM11'];

			$moviManulk = $simula->consideramos1($unooM1,$unooM11);
			if($moviManulk){ 
				$rsptaLog = $simula->considreamosSI($usuarioSe,$fechaAccion);
				header ('location:../index.php?secc=cuentaBancarias&vaBan=8'); 
			}	
			else{ header ('location:../index.php?secc=cuentaBancarias&vaBan=2');  }	

		break;

		case "movidecla2":
			$unooM2 = $_POST['unooM2'];
			$unooM22 = $_POST['unooM22'];

			$moviManulk = $simula->consideramos2($unooM2,$unooM22);
			if($moviManulk){ 
				$rsptaLog = $simula->considreamosNO($usuarioSe,$fechaAccion);
				header ('location:../index.php?secc=cuentaBancarias&vaBan=9');
			}	
			else{ header ('location:../index.php?secc=cuentaBancarias&vaBan=2');  }	

		break;

		/* Tipo de movimiento */
		case "movideclaT1":
			$unooT1 = $_POST['unooT1'];
			$unooT11 = $_POST['unooT11'];

			$moviManulk = $simula->quesCals1($unooT1,$unooT11);
			if($moviManulk){ 
				$rsptaLog = $simula->quees1($usuarioSe,$fechaAccion);
				header ('location:../index.php?secc=cuentaBancarias&vaBan=10'); 
			}	
			else{ header ('location:../index.php?secc=cuentaBancarias&vaBan=2');  }	

		break;

		case "movideclaT2":
			$unooT2 = $_POST['unooT2'];
			$unooT22 = $_POST['unooT22'];

			$moviManulk = $simula->quesCals2($unooT2,$unooT22);
			if($moviManulk){ 
				$rsptaLog = $simula->quees1($usuarioSe,$fechaAccion);
				header ('location:../index.php?secc=cuentaBancarias&vaBan=11');
			}	
			else{ header ('location:../index.php?secc=cuentaBancarias&vaBan=2');  }	

		break;
 	}
?>