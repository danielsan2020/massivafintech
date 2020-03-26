<?php
	@session_start();
	//instanaciamos la funcion de php mailer
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
	date_default_timezone_set("America/Mexico_City");

    require_once "../modelo/proveedorModelo.php";
    $proveedorMod = new proveedorMod();

	//*********************Variables generales***************************************//
	$fechaAccion = date("Y-m-d H:i:s");
	$fechaAccion2 = date("Y-m-d");
	$usuarioSe = $_SESSION['id_usuario'];
	$rfcClien = $_SESSION['rfc'];
	$accion = $_POST['accion'];
	
	/* obtenemos lso valores para la edicion */
	
	
	////valor para obtener la informacion de la noticia
	$idenEdita = ($_POST['idenEdita'] == '')? '' : $_POST['idenEdita']; 
	if($idenEdita != ""){
        $data=$proveedorMod->consultaEdita($idenEdita);
		echo json_encode($data);
    }
	
	switch ($accion) {
		/* nuevo proveedor */
		case "nuevoPro":
			/* obten4emos las variables del formulario */
			
			$id_usuario = $usuarioSe;
			$rfc = $_POST['rfc'];
			$nombre= $_POST['nombre'];
			$dir= $_POST['dir'];
			$colonia= $_POST['colonia'];
			$cp= $_POST['cp'];
			$estado= $_POST['estado'];
			$ciudad= $_POST['ciudad'];
			$tel= $_POST['tel'];
			$correo= $_POST['correo'];
			$pagina= $_POST['pagina'];
			$razon= $_POST['razon'];
			$pais= $_POST['pais'];
			$dias= $_POST['dias'];
			$tipo= $_POST['tipo'];
			$observaciones= $_POST['observaciones'];
			$estatus= 1;

			/* subimos el archivo de proveedores */
			$nombre_archivo_1 = "logo_proveedor_".$_FILES['logo']['name'];
			$uploaddir_1 = "../contenedor/clientes/".$rfcClien."/proveedores/";
			$directorio_1 = $uploaddir_1.basename($nombre_archivo_1);
			move_uploaded_file($_FILES["logo"]["tmp_name"], $directorio_1);

			echo "termina de cargar el archivo <br>";

			/* guardamos el nuevo proveedor */
			$proveedoRes = $proveedorMod->nuevoProveedor($id_usuario,$rfc,$nombre,$dir,$colonia,$cp,$estado,$ciudad,$tel,$correo,$pagina,$razon,$pais,$dias,$tipo,$observaciones,$nombre_archivo_1,$estatus);
			/* guardamos el movimiento */
			$rsptalog = $proveedorMod->accionAgregoPro($usuarioSe,$fechaAccion);
			header ('location:../index.php?secc=misproveedores&vapro=1');

		break;

		/* edito proveedor */
		case "EditaPro":
			/* capturamos las variables */
			$idproveedor = $_POST['idproveedorEdiAc'];
			$rfc = $_POST['rfc1'];
			$nombre= $_POST['nombre1'];
			$dir= $_POST['dir1'];
			$colonia= $_POST['colonia1'];
			$cp= $_POST['cp1'];
			$estado= $_POST['estado1'];
			$ciudad= $_POST['ciudad1'];
			$tel= $_POST['tel1'];
			$correo= $_POST['correo1'];
			$pagina= $_POST['pagina1'];
			$razon= $_POST['razon1'];
			$pais= $_POST['pais1'];
			$dias= $_POST['dias1'];
			$tipo= $_POST['tipo1'];
			$observaciones= $_POST['observaciones1'];
			$valogo = $_POST['valogo'];
			
			/* verificamos si actualizan la imagen de logo */
			$logo1 = $_FILES["logo1"];
			if ($_FILES['logo1']['name'] != null) { 
				/* si no vienen vacio subimos el nuevo archivo */
				$nombre_archivo_1 = "logo_proveedor_".$_FILES['logo1']['name'];
				$uploaddir_1 = "../contenedor/clientes/".$rfcClien."/proveedores/";
				$directorio_1 = $uploaddir_1.basename($nombre_archivo_1);
				move_uploaded_file($_FILES["logo1"]["tmp_name"], $directorio_1);

				/* editamos el proveedor */
				$rspta = $proveedorMod->editaPro($idproveedor,$rfc,$nombre,$dir,$colonia,$cp,$estado,$ciudad,$tel,$correo,$pagina,$razon,$pais,$dias,$tipo,$observaciones,$nombre_archivo_1);	

				/* guardamos el movimiento */
				$rspta = $proveedorMod->accionEditoPro($usuarioSe,$fechaAccion);
				
				/* redireccionamos a la pagina */
				header ('location:../index.php?secc=misproveedores&vapro=2');

			} 
			else{ 
				/* en caso de que venga vacio solo actualizamos los campos normales */

				/* editamos el proveedor */
				$rspta = $proveedorMod->editaProSin($idproveedor,$rfc,$nombre,$dir,$colonia,$cp,$estado,$ciudad,$tel,$correo,$pagina,$razon,$pais,$dias,$tipo,$observaciones);	

				/* guardamos el movimiento */
				$rspta = $proveedorMod->accionEditoPro($usuarioSe,$fechaAccion);
				
				/* redireccionamos a la pagina */
				header ('location:../index.php?secc=misproveedores&vapro=2');
			}

			

		break;

		/* elimino proveedor */
		case "eliminaPro":

			/* obtenemos los datos */
			$idproveedor = $_POST['idproveedorEli'];

			/* Eliminamos el proveedor */
			$rspta = $proveedorMod->eliPro($idproveedor);	

			/* guardamos el movimiento */
			$rspta = $proveedorMod->accionEliPro($usuarioSe,$fechaAccion);
			
			/* redireccionamos a la pagina */
			header ('location:../index.php?secc=misproveedores&vapro=3');
		
		break;
	}

?>