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
    require_once "../modelo/misclientesModelo.php";
    $misClientes = new misClientes();

	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d");
	$usuarioSe = $_SESSION['nusuario'];
    $accion = $_POST['accion'];
    
    //**********************valores formulario nuevo****************************//
	$id_usuario = $_SESSION['nusuario'];
	$nombre = ($_POST['nombre'] == '')? '' : $_POST['nombre']; 
	$apePaterno = ($_POST['apePaterno'] == '')? '' : $_POST['apePaterno'];
	$apeMaterno = ($_POST['apeMaterno'] == '')? '' : $_POST['apeMaterno'];
	$departamento = ($_POST['departamento'] == '')? '' : $_POST['departamento'];
	$puesto = ($_POST['puesto'] == '')? '' : $_POST['puesto'];
	$tel1 = ($_POST['tel1'] == '')? '' : $_POST['tel1'];
	$tel2 = ($_POST['tel2'] == '')? '' : $_POST['tel2'];
	$cel1 = ($_POST['cel1'] == '')? '' : $_POST['cel1'];
	$cel2 = ($_POST['cel2'] == '')? '' : $_POST['cel2'];
	$mail1 = ($_POST['mail1'] == '')? '' : $_POST['mail1'];
	$mail2 = ($_POST['mail2'] == '')? '' : $_POST['mail2'];
	$direccion = ($_POST['direccion'] == '')? '' : $_POST['direccion'];
	$cp = ($_POST['cp'] == '')? '' : $_POST['cp'];
	$estado = ($_POST['estado'] == '')? '' : $_POST['estado'];
	$colonia = ($_POST['colonia'] == '')? '' : $_POST['colonia'];
	$ciudad = ($_POST['ciudad'] == '')? '' : $_POST['ciudad'];
	$observaciones = ($_POST['observaciones'] == '')? '' : $_POST['observaciones'];
	$noEmpresa = ($_POST['noEmpresa'] == '')? '' : $_POST['noEmpresa'];
	$dirEmpresa = ($_POST['dirEmpresa'] == '')? '' : $_POST['dirEmpresa'];
	$coloniaEmpresa = ($_POST['coloniaEmpresa'] == '')? '' : $_POST['coloniaEmpresa'];
	$cpEmpresa = ($_POST['cpEmpresa'] == '')? '' : $_POST['cpEmpresa'];
	$estadoEmpresa = ($_POST['estadoEmpresa'] == '')? '' : $_POST['estadoEmpresa'];
	$ciudadEmpresa = ($_POST['ciudadEmpresa'] == '')? '' : $_POST['ciudadEmpresa'];
	$tel1Empresa = ($_POST['tel1Empresa'] == '')? '' : $_POST['tel1Empresa'];
	$tel2Empresa = ($_POST['tel2Empresa'] == '')? '' : $_POST['tel2Empresa'];
	$cel1Empresa = ($_POST['cel1Empresa'] == '')? '' : $_POST['cel1Empresa'];
	$cel2Empresa = ($_POST['cel2Empresa'] == '')? '' : $_POST['cel2Empresa'];
	$mail1Empresa = ($_POST['mail1Empresa'] == '')? '' : $_POST['mail1Empresa'];
	$mail2Empresa = ($_POST['mail2Empresa'] == '')? '' : $_POST['mail2Empresa'];
	$mail3Empresa = ($_POST['mail3Empresa'] == '')? '' : $_POST['mail3Empresa'];
	$paginaWeb = ($_POST['paginaWeb'] == '')? '' : $_POST['paginaWeb'];
	$giroEmpresa = ($_POST['giroEmpresa'] == '')? '' : $_POST['giroEmpresa'];
	$razonSocial = ($_POST['razonSocial'] == '')? '' : $_POST['razonSocial'];
	$rfcEmpresa = ($_POST['rfcEmpresa'] == '')? '' : $_POST['rfcEmpresa'];
	$pais = ($_POST['pais'] == '')? '' : $_POST['pais'];
	$observacionesEmpresa = ($_POST['observacionesEmpresa'] == '')? '' : $_POST['observacionesEmpresa'];
	$estatus = '1';

	//nombre de facturacion
	$nombre = 'a'; //primera letra del nombre


	if($pais == 'MX'){
		if($nombre = 'a'){ 
			$continuo = '2110-001-001-';
			//continuo dependiendo si tiene registro en la bd


		}
		if($nombre = 'b'){ 
			$continuo = '2110-001-002-';
		}
		if($nombre = 'c'){ 
			$continuo = '2110-001-003-';
		}
		if($nombre = 'd'){ 
			$continuo = '2110-001-004-';
		}
		if($nombre = 'e'){ 
			$continuo = '2110-001-005-';
		}
		if($nombre = 'f'){ 
			$continuo = '2110-001-006-';
		}
		if($nombre = 'g'){ 
			$continuo = '2110-001-007-';
		}
		if($nombre = 'h'){ 
			$continuo = '2110-001-008-';
		}
		if($nombre = 'i'){ 
			$continuo = '2110-001-009-';
		}
		if($nombre = 'j'){ 
			$continuo = '2110-001-010-';
		}
		if($nombre = 'k'){ 
			$continuo = '2110-001-011-';
		}
		if($nombre = 'l'){ 
			$continuo = '2110-001-012-';
		}
		if($nombre = 'm'){ 
			$continuo = '2110-001-013-';
		}
		if($nombre = 'n'){ 
			$continuo = '2110-001-014-';
		}
		if($nombre = 'o'){ 
			$continuo = '2110-001-015-';
		}
		if($nombre = 'p'){ 
			$continuo = '2110-001-016-';
		}
		if($nombre = 'q'){ 
			$continuo = '2110-001-017-';
		}
		if($nombre = 'r'){ 
			$continuo = '2110-001-018-';
		}
		if($nombre = 's'){ 
			$continuo = '2110-001-019-';
		}
		if($nombre = 't'){ 
			$continuo = '2110-001-020-';
		}
		if($nombre = 'u'){ 
			$continuo = '2110-001-021-';
		}
		if($nombre = 'v'){ 
			$continuo = '2110-001-022-';
		}
		if($nombre = 'w'){ 
			$continuo = '2110-001-023-';
		}
		if($nombre = 'x'){ 
			$continuo = '2110-001-024-';
		}
		if($nombre = 'y'){ 
			$continuo = '2110-001-025-';
		}
		if($nombre = 'z'){ 
			$continuo = '2110-001-026-';
		}

	}else{
		if($nombre = 'a'){ 
			$continuo = '2110-002-001-';
		}
		if($nombre = 'b'){ 
			$continuo = '2110-002-002-';
		}
		if($nombre = 'c'){ 
			$continuo = '2110-002-003-';
		}
		if($nombre = 'd'){ 
			$continuo = '2110-002-004-';
		}
		if($nombre = 'e'){ 
			$continuo = '2110-002-005-';
		}
		if($nombre = 'f'){ 
			$continuo = '2110-002-006-';
		}
		if($nombre = 'g'){ 
			$continuo = '2110-002-007-';
		}
		if($nombre = 'h'){ 
			$continuo = '2110-002-008-';
		}
		if($nombre = 'i'){ 
			$continuo = '2110-002-009-';

		}
		if($nombre = 'j'){ 
			$continuo = '2110-002-010-';
		}
		if($nombre = 'k'){ 
			$continuo = '2110-002-011-';
		}
		if($nombre = 'l'){ 
			$continuo = '2110-002-012-';
		}
		if($nombre = 'm'){ 
			$continuo = '2110-002-013-';
		}
		if($nombre = 'n'){ 
			$continuo = '2110-002-014-';
		}
		if($nombre = 'o'){ 
			$continuo = '2110-002-015-';
		}
		if($nombre = 'p'){ 
			$continuo = '2110-002-016-';
		}
		if($nombre = 'q'){ 
			$continuo = '2110-002-017-';
		}
		if($nombre = 'r'){ 
			$continuo = '2110-002-018-';
		}
		if($nombre = 's'){ 
			$continuo = '2110-002-019-';
		}
		if($nombre = 't'){ 
			$continuo = '2110-002-020-';
		}
		if($nombre = 'u'){ 
			$continuo = '2110-002-021-';
		}
		if($nombre = 'v'){ 
			$continuo = '2110-002-022-';
		}
		if($nombre = 'w'){ 
			$continuo = '2110-002-023-';
		}
		if($nombre = 'x'){ 
			$continuo = '2110-002-024-';
		}
		if($nombre = 'y'){ 
			$continuo = '2110-002-025-';
		}
		if($nombre = 'z'){ 
			$continuo = '2110-002-026-';
		}
	}
	


	


	



	
	//**********************valores formulario edicion****************************//
	$idCliente1 = ($_POST['idCliente1'] == '')? '' : $_POST['idCliente1']; 
	$id_usuario1 = $_SESSION['idUsuario'];
	$nombre1 = ($_POST['nombre1'] == '')? '' : $_POST['nombre1']; 
	$apePaterno1 = ($_POST['apePaterno1'] == '')? '' : $_POST['apePaterno1'];
	$apeMaterno1 = ($_POST['apeMaterno1'] == '')? '' : $_POST['apeMaterno1'];
	$departamento1 = ($_POST['departamento1'] == '')? '' : $_POST['departamento1'];
	$puesto1 = ($_POST['puesto1'] == '')? '' : $_POST['puesto1'];
	$tel11 = ($_POST['tel11'] == '')? '' : $_POST['tel11'];
	$tel21 = ($_POST['tel21'] == '')? '' : $_POST['tel21'];
	$cel11 = ($_POST['cel11'] == '')? '' : $_POST['cel11'];
	$cel21 = ($_POST['cel21'] == '')? '' : $_POST['cel21'];
	$mail11 = ($_POST['mail11'] == '')? '' : $_POST['mail11'];
	$mail21 = ($_POST['mail21'] == '')? '' : $_POST['mail21'];
	$direccion1 = ($_POST['direccion1'] == '')? '' : $_POST['direccion1'];
	$cp1 = ($_POST['cp1'] == '')? '' : $_POST['cp1'];
	$estado1 = ($_POST['estado1'] == '')? '' : $_POST['estado1'];
	$colonia1 = ($_POST['colonia1'] == '')? '' : $_POST['colonia1'];
	$ciudad1 = ($_POST['ciudad1'] == '')? '' : $_POST['ciudad1'];
	$observaciones1 = ($_POST['observaciones1'] == '')? '' : $_POST['observaciones1'];
	$noEmpresa1 = ($_POST['noEmpresa1'] == '')? '' : $_POST['noEmpresa1'];
	$dirEmpresa1 = ($_POST['dirEmpresa1'] == '')? '' : $_POST['dirEmpresa1'];
	$coloniaEmpresa1 = ($_POST['coloniaEmpresa1'] == '')? '' : $_POST['coloniaEmpresa1'];
	$cpEmpresa1 = ($_POST['cpEmpresa1'] == '')? '' : $_POST['cpEmpresa1'];
	$estadoEmpresa1 = ($_POST['estadoEmpresa1'] == '')? '' : $_POST['estadoEmpresa1'];
	$ciudadEmpresa1 = ($_POST['ciudadEmpresa1'] == '')? '' : $_POST['ciudadEmpresa1'];
	$tel1Empresa1 = ($_POST['tel1Empresa1'] == '')? '' : $_POST['tel1Empresa1'];
	$tel2Empresa1 = ($_POST['tel2Empresa1'] == '')? '' : $_POST['tel2Empresa1'];
	$cel1Empresa1 = ($_POST['cel1Empresa1'] == '')? '' : $_POST['cel1Empresa1'];
	$cel2Empresa1 = ($_POST['cel2Empresa1'] == '')? '' : $_POST['cel2Empresa1'];
	$mail1Empresa1 = ($_POST['mail1Empresa1'] == '')? '' : $_POST['mail1Empresa1'];
	$mail2Empresa1 = ($_POST['mail2Empresa1'] == '')? '' : $_POST['mail2Empresa1'];
	$mail3Empresa1 = ($_POST['mail3Empresa1'] == '')? '' : $_POST['mail3Empresa1'];
	$paginaWeb1 = ($_POST['paginaWeb1'] == '')? '' : $_POST['paginaWeb1'];
	$giroEmpresa1 = ($_POST['giroEmpresa1'] == '')? '' : $_POST['giroEmpresa1'];
	$razonSocial1 = ($_POST['razonSocial1'] == '')? '' : $_POST['razonSocial1'];
	$rfcEmpresa1 = ($_POST['rfcEmpresa1'] == '')? '' : $_POST['rfcEmpresa1'];
	$pais1 = ($_POST['pais1'] == '')? '' : $_POST['pais1'];
	$observacionesEmpresa1 = ($_POST['observacionesEmpresa1'] == '')? '' : $_POST['observacionesEmpresa1'];
	$estatus1 = "1";


	//**********************valor para eliminar elemento****************************//
	$idCliente = ($_POST['idCliente'] == '')? '' : $_POST['idCliente'];;
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
				if (isset($_FILES['archivo'])){
					//insertamos el nuevo cliente
					$rspta = $misClientes->insertar($id_usuario,$nombre,$apePaterno,$apeMaterno,$departamento,$puesto,$tel1,$tel2,$cel1,$cel2,$mail1,$mail2,$direccion,$cp,$estado,$colonia,$ciudad,$observaciones,$noEmpresa,$dirEmpresa,$coloniaEmpresa,$cpEmpresa,$estadoEmpresa,$ciudadEmpresa,$tel1Empresa,$tel2Empresa,$cel1Empresa,$cel2Empresa,$mail1Empresa,$mail2Empresa,$mail3Empresa,$paginaWeb,$giroEmpresa,$razonSocial,$rfcEmpresa,$observacionesEmpresa,$usuarioSe,$fechaAccion,$estatus,$pais,$tiempoCredito);
					//obtenemos el id para subir al archivo
					$idRegistro = $rspta;
					//verificamos que las imagenes pesen menos de un mega
					if ($_FILES['archivo']['size'] <= 1000000) {
						//generamos la direccion a donde se guardan
						$nombre_archivo = "logoCliente_".$idRegistro."_".$_FILES['archivo']["name"];
						$nombreFinal = $nombre_archivo;
						$uploaddir = 'contenedor/logoClienteCliente/';
						$directorio = $uploaddir. basename($nombreFinal);
						//Subimos el fichero al servidor
						move_uploaded_file($_FILES["archivo"]["tmp_name"], $directorio);
						//guardamos el valor en la base de datos
						$guadarDirImagen = $misClientes->guardarImagenDir($idRegistro,$nombreFinal,$usuarioSe,$fechaAccion);
						//despues de cada movimiento se inserta el movimiento al log
						$idmovi = 1;
					   	$inlog = $misClientes->logAgrego($usuarioSe,$idmovi,$idRegistro,$usuarioSe,$fechaAccion);
					   	if($inlog){ print_r( "<span style='color:green'><b>Se agrego su nuevo cliente</b><span>");}
						///termina seccion para el log
					}else{ print_r( "<span style='color:red'><b>El archivo es demasiado pesado</b><span>");	}
			}else{	print_r( "<span style='color:red'><b>Favor de ingresar un archivo</b><span>");	}
        break;
		///elimino que en este caso solo cambio el status	
        case "eliminar":
			
			$eliminaElme = $misClientes->eliminar($idCliente);
            if($eliminaElme){ 
				$idmovi = 2;
				$inlog = $misClientes->logAgrego($usuarioSe,$idmovi,$idCliente,$usuarioSe,$fechaAccion);
				return true; }else{	return false; }
            
		break;
		 case "editar":
			
			if (isset($_FILES['archivo1'])){
				//insertamos el nuevo cliente
				$rspta = $misClientes->editar($idCliente1,$id_usuario1,$nombre1,$apePaterno1,$apeMaterno1,$departamento1,$puesto1,$tel11,$tel21,$cel11,$cel21,$mail11,$mail21,$direccion1,$cp1,$estado1,$colonia1,$ciudad1,$observaciones1,$noEmpresa1,$dirEmpresa1,$coloniaEmpresa1,$cpEmpresa1,$estadoEmpresa1,$ciudadEmpresa1,$tel1Empresa1,$tel2Empresa1,$cel1Empresa1,$cel2Empresa1,$mail1Empresa1,$mail2Empresa1,$mail3Empresa1,$paginaWeb1,$giroEmpresa1,$razonSocial1,$rfcEmpresa1,$observacionesEmpresa1,$usuarioSe,$fechaAccion,$estatus1,$pais1,$tiempoCredito1);
				if ($rspta){
					//obtenemos el id para subir al archivo
					$idRegistro = $idCliente1;
					//verificamos que las imagenes pesen menos de un mega
					if ($_FILES['archivo1']['size'] <= 1000000) {
						//generamos la direccion a donde se guardan
						$nombre_archivo = "logoCliente_".$idRegistro."_".$_FILES['archivo1']["name"];
						$nombreFinal = $nombre_archivo;
						$uploaddir = 'contenedor/logoClienteCliente/';
						$directorio = $uploaddir. basename($nombreFinal);
						//Subimos el fichero al servidor
						move_uploaded_file($_FILES["archivo1"]["tmp_name"], $directorio);
						//guardamos el valor en la base de datos
						$guadarDirImagen = $misClientes->guardarImagenDir($idRegistro,$nombreFinal,$usuarioSe,$fechaAccion);
						//despues de cada movimiento se inserta el movimiento al log
						$idmovi = 3;
						$inlog = $misClientes->logAgrego($usuarioSe,$idmovi,$idRegistro,$usuarioSe,$fechaAccion);
						if($inlog){ print_r( "<span style='color:green'><b>Se Edito su  cliente</b><span>");}
						///termina seccion para el log
					}else{ print_r( "<span style='color:red'><b>El archivo es demasiado pesado</b><span>");	}
				}
			}else{	print_r( "<span style='color:red'><b>Favor de ingresar un archivo</b><span>");	}
            
		break;
			
       
    }
 
        
    
   
    



?>