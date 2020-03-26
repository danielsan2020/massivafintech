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
    require_once "../modelo/misclientesModelo.php";
    $misClientes = new misClientes();

	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d");
	$usuarioSe = $_SESSION['id_usuario'];
    $accion = $_POST['accion'];
    
    //**********************valores formulario nuevo****************************//
	$nombre = ($_POST['nombre'] == '')? '' : $_POST['nombre']; 
	$apePaterno = ($_POST['apePaterno'] == '')? '' : $_POST['apePaterno'];
	$apeMaterno = ($_POST['apeMaterno'] == '')? '' : $_POST['apeMaterno'];
	$departamento = ($_POST['departamento'] == '')? '' : $_POST['departamento'];
	$puesto = ($_POST['puesto'] == '')? '' : $_POST['puesto'];
	$tel1 = ($_POST['tel1'] == '')? '' : $_POST['tel1'];
	$tel2 = ($_POST['tel2'] == '')? '' : $_POST['tel2'];
	$cel1 = ($_POST['cel1'] == '')? '' : $_POST['cel1'];
	$cel2 = ($_POST['cel2'] == '')? '' : $_POST['cel2'];
	$correo1 = ($_POST['correo1'] == '')? '' : $_POST['correo1'];
	$correo2 = ($_POST['correo2'] == '')? '' : $_POST['correo2'];
	$dir = ($_POST['dir'] == '')? '' : $_POST['dir'];
	$cp = ($_POST['cp'] == '')? '' : $_POST['cp'];
	$estado = ($_POST['estado'] == '')? '' : $_POST['estado'];
	$colonia = ($_POST['colonia'] == '')? '' : $_POST['colonia'];
	$ciudad = ($_POST['ciudad'] == '')? '' : $_POST['ciudad'];
	$observaciones = ($_POST['observaciones'] == '')? '' : $_POST['observaciones'];
	$nombreE = ($_POST['nombreE'] == '')? '' : $_POST['nombreE'];
	$razonSocialE = ($_POST['razonSocialE'] == '')? '' : $_POST['razonSocialE'];
	$rfcE = ($_POST['rfcE'] == '')? '' : $_POST['rfcE'];
	$dirE = ($_POST['dirE'] == '')? '' : $_POST['dirE'];
	$coloniaE = ($_POST['coloniaE'] == '')? '' : $_POST['coloniaE'];
	$cpE = ($_POST['cpE'] == '')? '' : $_POST['cpE'];
	$estadoE = ($_POST['estadoE'] == '')? '' : $_POST['estadoE'];
	$ciudadE = ($_POST['ciudadE'] == '')? '' : $_POST['ciudadE'];
	$paisE = ($_POST['paisE'] == '')? '' : $_POST['paisE'];
	$telE = ($_POST['telE'] == '')? '' : $_POST['telE'];
	$correo1E = ($_POST['correo1E'] == '')? '' : $_POST['correo1E'];
	$correo2E = ($_POST['correo2E'] == '')? '' : $_POST['correo2E'];
	$correo3E = ($_POST['correo3E'] == '')? '' : $_POST['correo3E'];
	$creditoE = ($_POST['creditoE'] == '')? '' : $_POST['creditoE'];
	$observacionesE = ($_POST['observacionesE'] == '')? '' : $_POST['observacionesE'];
	$estatus = '1';

	//**********************valores formulario de edicion****************************//
	$idClienteE1 = ($_POST['idClienteE1'] == '')? '' : $_POST['idClienteE1']; 
	$imgLogE1 = ($_POST['imgLogE1'] == '')? '' : $_POST['imgLogE1']; 

	$nombreE1 = ($_POST['nombreE1'] == '')? '' : $_POST['nombreE1'];
	$apePaternoE = ($_POST['apePaternoE'] == '')? '' : $_POST['apePaternoE'];
	$apeMaternoE = ($_POST['apeMaternoE'] == '')? '' : $_POST['apeMaternoE'];
	$departamentoE = ($_POST['departamentoE'] == '')? '' : $_POST['departamentoE'];
	$puestoE = ($_POST['puestoE'] == '')? '' : $_POST['puestoE'];
	$tel1E = ($_POST['tel1E'] == '')? '' : $_POST['tel1E'];
	$tel2E = ($_POST['tel2E'] == '')? '' : $_POST['tel2E'];
	$cel1E = ($_POST['cel1E'] == '')? '' : $_POST['cel1E'];
	$cel2E = ($_POST['cel2E'] == '')? '' : $_POST['cel2E'];
	$correo1E1 = ($_POST['correo1E1'] == '')? '' : $_POST['correo1E1'];
	$correo2E1 = ($_POST['correo2E1'] == '')? '' : $_POST['correo2E1'];
	$dirE1 = ($_POST['dirE1'] == '')? '' : $_POST['dirE1'];
	$cpE1 = ($_POST['cpE1'] == '')? '' : $_POST['cpE1'];
	$coloniaE1 = ($_POST['coloniaE1'] == '')? '' : $_POST['coloniaE1'];
	$ciudadE1 = ($_POST['ciudadE1'] == '')? '' : $_POST['ciudadE1'];
	$observacionesE1 = ($_POST['observacionesE1'] == '')? '' : $_POST['observacionesE1'];
	$nombreEE = ($_POST['nombreEE'] == '')? '' : $_POST['nombreEE'];
	$razonSocialEE = ($_POST['razonSocialEE'] == '')? '' : $_POST['razonSocialEE'];
	$rfcEE = ($_POST['rfcEE'] == '')? '' : $_POST['rfcEE'];
	$dirEE = ($_POST['dirEE'] == '')? '' : $_POST['dirEE'];
	$coloniaEE = ($_POST['coloniaEE'] == '')? '' : $_POST['coloniaEE'];
	$cpEE = ($_POST['cpEE'] == '')? '' : $_POST['cpEE'];
	$estadoEE = ($_POST['estadoEE'] == '')? '' : $_POST['estadoEE'];
	$ciudadEE = ($_POST['ciudadEE'] == '')? '' : $_POST['ciudadEE'];
	$telEE = ($_POST['telEE'] == '')? '' : $_POST['telEE'];
	$correo1EE = ($_POST['correo1EE'] == '')? '' : $_POST['correo1EE'];
	$correo2EE = ($_POST['correo2EE'] == '')? '' : $_POST['correo2EE'];
	$correo3EE = ($_POST['correo3EE'] == '')? '' : $_POST['correo3EE'];
	$observacionesEE = ($_POST['observacionesEE'] == '')? '' : $_POST['observacionesEE'];
	$estadoE1 = ($_POST['estadoE1'] == '')? '' : $_POST['estadoE1'];
	$creditoEE = ($_POST['creditoEE'] == '')? '' : $_POST['creditoEE'];
	
	//nombre de facturacion
	$primerLetra = substr($nombreE, 1);

	if($paisE == 'MX'){
		if($primerLetra = 'a'){ 	
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-001-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-001-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-001-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'b'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-002-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-002-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-002-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'c'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-003-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-003-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-003-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'd'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-004-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-004-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-004-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'e'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-005-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-005-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-005-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'f'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-006-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-006-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-006-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'g'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-007-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-007-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-007-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'h'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-008-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-008-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-008-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'i'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-009-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-009-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-009-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'j'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-010-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-010-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-010-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'k'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-011-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-011-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-011-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'l'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-012-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-012-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-012-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'm'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-013-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-013-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-013-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'n'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-014-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-014-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-014-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'o'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-015-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-015-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-015-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'p'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-016-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-016-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-016-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'q'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-017-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-017-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-017-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'r'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-018-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-018-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-018-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 's'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-019-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-019-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-019-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 't'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-020-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-020-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-020-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'u'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-021-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-021-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-021-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'v'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-022-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-022-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-022-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'w'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-023-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-023-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-023-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'x'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-024-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-024-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-024-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'y'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-025-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-025-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-025-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'z'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-026-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-026-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-026-00'.$numeroFinal;
            	}
	        }
		}

	}else{
		if($primerLetra = 'a'){ 	
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-001-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-001-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-001-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'b'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-002-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-002-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-002-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'c'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-003-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-003-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-003-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'd'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-004-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-004-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-004-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'e'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-005-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-005-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-005-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'f'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-006-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-006-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-006-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'g'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-007-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-007-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-007-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'h'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-008-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-008-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-008-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'i'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-009-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-009-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-009-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'j'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-010-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-010-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-010-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'k'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-011-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-011-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-011-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'l'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-012-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-012-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-012-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'm'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-013-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-013-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-013-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'n'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-014-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-014-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-014-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'o'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-015-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-015-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-015-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'p'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-016-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-016-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-016-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'q'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-017-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-017-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-017-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'r'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-018-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-018-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-018-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 's'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-019-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-019-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-019-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 't'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-020-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-020-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-020-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'u'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-021-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-021-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-021-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'v'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-001-022-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-001-022-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-001-022-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'w'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-023-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-023-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-023-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'x'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-024-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-024-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-024-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'y'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-025-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-025-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-025-00'.$numeroFinal;
            	}
	        }
		}
		if($primerLetra = 'z'){ 
			//verificamos si ya hay un registro en la bd
			$buscamos = $misClientes->buscamosReCuenta($usuarioSe);
			$buscamosInfo = $buscamos->fetch_object();
            $Verifi = $buscamosInfo->total;

            //obtenemos el ultimo numero
            if($Verifi == ''){
            	$cuenta = '1150-002-026-001';
            }else{
            	$numeroFinal = $Verifi+1;
            	$valor = strlen($numeroFinal);
            	if($valor > 2){
            		$cuenta = '1150-002-026-0'.$numeroFinal;
            	}else{
            		$cuenta = '1150-002-026-00'.$numeroFinal;
            	}
	        }
		}
	}
	
	//valor para eliminar
	$idCliente = ($_POST['idCliente'] == '')? '' : $_POST['idCliente'];
	$imgLog = ($_POST['imgLog'] == '')? '' : $_POST['imgLog'];
	
	//**********************valores formulario nuevo****************************//
    $idenEdita = $_POST['idenEdita'];
    if($idenEdita != ""){
        $data=$misClientes->consultaEdita($idenEdita);
		echo json_encode($data, JSON_FORCE_OBJECT);
    }
    //**********************Id para obtener la informacion de edicion****************************//
   
	/****************************Acciones dependiendo de la variable*************************************///
   switch ($accion) {
        case "nuevo":
			
			//verificamos que las imagenes pesen menos de un mega
			if ($_FILES['logo']['size'] <= 1000000) {
				$nombre_archivo = "logoCliente_".$_FILES['logo']["name"];
				$uploaddir = '../contenedor/logoClienteCliente/';
				$directorio = $uploaddir. basename($nombre_archivo);
				move_uploaded_file($_FILES["logo"]["tmp_name"], $directorio);
				//guardamos el valor en la base de datos
				$agregoRespuesta = $misClientes->insertarValor($cuenta,$usuarioSe,$fechaAccion,$nombre,$apePaterno,$apeMaterno,$departamento,$puesto,$tel1,$tel2,$cel1,$cel2,$correo1,$correo2,$dir,$cp,$estado,$colonia,$ciudad,$observaciones,$nombre_archivo,$nombreE,$razonSocialE,$rfcE,$dirE,$coloniaE,$cpE,$estadoE,$ciudadE,$paisE,$telE,$correo1E,$correo2E,$correo3E,$creditoE,$observacionesE,$estatus);
			   	
			   	if($agregoRespuesta){ 
			   		$inlog = $misClientes->accionSolicita($usuarioSe,$fechaAccion);
			   		header("location:../index.php?secc=misclientes&nueClien=1");
			   	}
			}else{ header("location:../index.php?secc=misclientes&nueClien=4");	}

		break;
		
		///elimino que en este caso solo cambio el status	
		case "eliminarVAl":
			//boramos la imagen de mi cliente
			$archivoBorro = "../contenedor/logoClienteCliente/".$imgLog;
			unlink($archivoBorro);
			
			$eliminaElme = $misClientes->eliminarCliente($idCliente);
            if($eliminaElme){ 
				$inlog = $misClientes->accionElimina($usuarioSe,$fechaAccion);
				header("location:../index.php?secc=misclientes&nueClien=3");
			}else{	header("location:../index.php?secc=misclientes&nueClien=4"); }
            
		break;

		case "edicion":
			//logoE
		
			//si el input viene lleno
			if (isset($_FILES['logoE1'])){
				//eliminados el archivo par actualizar el otro
				$archivoBorro = "../contenedor/logoClienteCliente/".$imgLogE1;
				unlink($archivoBorro);

				//carganmos el archivo al servidor
				if ($_FILES['logoE1']['size'] <= 1000000) {

					$nombre_archivo = "logoCliente_".$_FILES['logoE1']["name"];
					$uploaddir = '../contenedor/logoClienteCliente/';
					$directorio = $uploaddir. basename($nombre_archivo);
					move_uploaded_file($_FILES["logoE1"]["tmp_name"], $directorio);
					
					
					//guardamos el valor en la base de datos
					$editoRespues = $misClientes->EditamosClien($nombre_archivo,$idClienteE1,$nombreE1,$apePaternoE,$apeMaternoE,$departamentoE,$puestoE,$tel1E,$tel2E,$cel1E,$cel2E,$correo1E1,$correo2E1,$dirE1,$cpE1,$coloniaE1,$ciudadE1,$observacionesE1,$nombreEE,$razonSocialEE,$rfcEE,$dirEE,$coloniaEE,$cpEE,$estadoEE,$ciudadEE,$telEE,$correo1EE,$correo2EE,$correo3EE,$observacionesEE,$estadoE1,$creditoEE);
					
					if($editoRespues){ 
						$inlog = $misClientes->accionedita($usuarioSe,$fechaAccion);
						header("location:../index.php?secc=misclientes&nueClien=2");
					}
				}else{ header("location:../index.php?secc=misclientes&nueClien=4");	}
			}
			///si viene vacio
			else{	
				//guardamos el valor en la base de datos
				$editoRespues = $misClientes->editamosClienSin($imgLogE1,$idClienteE1,$nombreE1,$apePaternoE,$apeMaternoE,$departamentoE,$puestoE,$tel1E,$tel2E,$cel1E,$cel2E,$correo1E1,$correo2E1,$dirE1,$cpE1,$coloniaE1,$ciudadE1,$observacionesE1,$nombreEE,$razonSocialEE,$rfcEE,$dirEE,$coloniaEE,$cpEE,$estadoEE,$ciudadEE,$telEE,$correo1EE,$correo2EE,$correo3EE,$observacionesEE,$estadoE1,$creditoEE);
					
				if($editoRespues){ 
					$inlog = $misClientes->accionedita($usuarioSe,$fechaAccion);
					header("location:../index.php?secc=misclientes&nueClien=2");
				}

			}
            
		break;
			
       
    }
 
        
   
   
    



?>