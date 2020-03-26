
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
    require_once "../modelo/ticketsUsuarioModelo.php";
    $ticUsu = new ticUsu();

	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d");
	$id_usuario = $_SESSION['id_usuario'];
	$rfc = $_SESSION['rfc'];
    $accion = $_POST['accion'];
    
    //**********************valores para el nuevo negocio****************************//
	$comercio = ($_POST['comercio'] == '')? '' : $_POST['comercio'];
	$ciudad = ($_POST['ciudad'] == '')? '' : $_POST['ciudad'];

	//**********************valores para el nuevo tickets****************************//
	$fecha = ($_POST['fecha'] == '')? '' : $_POST['fecha'];
	$alias = ($_POST['alias'] == '')? '' : $_POST['alias'];

	//**********************valores para datos de contacto****************************//
	$comercioo = ($_POST['comercioo'] == '')? '' : $_POST['comercioo'];

	//**********************valores para subir xml****************************//
	$idTickets = ($_POST['idTickets'] == '')? '' : $_POST['idTickets'];

	//**********************valores para eliminar ticket****************************//
	$idTicketsEli = ($_POST['idTicketsEli'] == '')? '' : $_POST['idTicketsEli'];

	//**********************valores para factura massiva****************************//
	$valor = ($_POST['valor'] == '')? '' : $_POST['valor'];
	$mistic = ($_POST['mistic'] == '')? '' : $_POST['mistic'];

	
	
	
	
	/****************************Acciones dependiendo de la variable*************************************///
   switch ($accion) {
		/* Agregamos le nuevo negocio */
		case "nuevoNegocio":
			$agregoRespuesta = $ticUsu->nuevoNegocio($comercio,$ciudad,$id_usuario,$fechaAccion);
			
			if($agregoRespuesta){ 
				$inlog = $ticUsu->accionNuevoNegocio($id_usuario,$fechaAccion);
				header("location:../index.php?secc=ticketusu&tiusu=1");
			}
			else{ header("location:../index.php?secc=ticketusu&tiusu=4");	}

		break;

		/* Agregamos nuevo tickets */
		case "nuevotic":

			$nombre_archivo = "ticket_".$_FILES['fileinput']["name"];
			$uploaddir = '../contenedor/clientes/'.$rfc.'/tickets/';
			$directorio = $uploaddir. basename($nombre_archivo);
			move_uploaded_file($_FILES["fileinput"]["tmp_name"], $directorio);

			//guardamos el valor en la base de datos
			$editoRespues = $ticUsu->nuevotic($fecha,$alias,$nombre_archivo,$id_usuario,$fechaAccion);
			
			if($editoRespues){ 
				$inlog = $ticUsu->accionNuevoTick($id_usuario,$fechaAccion);
				header("location:../index.php?secc=ticketusu&tiusu=3");
			}

		break;

		/* se consulta el soporte del comercio */
		case "consultaTecn":

			$data=$ticUsu->consultaTemp($comercioo);
			echo json_encode($data);

		break;

		/* elimina el ticket */
		case "eliminar":
			$elimintic = $ticUsu->elimintic($idTicketsEli);
			
			if($elimintic){ 
				$inlog = $ticUsu->acionelimiTic($id_usuario,$fechaAccion);
				header("location:../index.php?secc=ticketusu&tiusu=5");
			}

		break;
		
		/* subir xml */
		case "subirxm":
			$nombre_archivo = "ticket_xml_".$_FILES['subirxml']["name"];
			$uploaddir = '../contenedor/clientes/'.$rfc.'/tickets/';
			$directorio = $uploaddir. basename($nombre_archivo);
			move_uploaded_file($_FILES["subirxml"]["tmp_name"], $directorio);

			$subirxm = $ticUsu->subirxm($idTickets,$nombre_archivo);
			
			if($subirxm){ 
				$inlog = $ticUsu->accionxml($id_usuario,$fechaAccion);
				header("location:../index.php?secc=ticketusu&tiusu=4");
			}

		break;

		/* factura massiva */
		case "facturaMassi":
			$facmss = $ticUsu->facmss($valor);
			$mistic = $mistic - 1;
			$actuTid = $ticUsu->actuTid($id_usuario,$mistic);
			
			if($facmss){ 
				$inlog = $ticUsu->accionfacmassi($id_usuario,$fechaAccion);
				return true;
			}

		break;

		case "terminarTickety":
		$idTickets = ($_POST['idTicketsTer'] == '')? '' : $_POST['idTicketsTer'];
			
		$elimintic = $ticUsu->terminatic($idTickets);
			
		if($elimintic){ 
			header("location:../index.php?secc=ticketConta&tickterm=1");
		}

		break;
		
		


		
		
			
       
    }
 
        
   
   
    



?>