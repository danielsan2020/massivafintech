<?php
	@session_start();	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../plugins/phpmailer/Exception.php';
	require '../plugins/phpmailer/PHPMailer.php';
	require '../plugins/phpmailer/SMTP.php';

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
    require_once "../modelo/tcontableModelo.php";
    $tsoporte = new tsoporte();

	//*********************Variables generales***************************************//
   $fechaAccion = date("Y-m-d H:i:s");
    $accion = $_POST['accion'];
    $id_usuario = $_SESSION['id_usuario'];
    
    //**********************valores formulario nuevo****************************//
	$id_usuario_reporta = ($_POST['id_usuario_reporta'] == '')? '' : $_POST['id_usuario_reporta']; 
	$id_categoria_ticket = ($_POST['id_categoria_ticket'] == '')? '' : $_POST['id_categoria_ticket']; 
	$titulo = ($_POST['titulo'] == '')? '' : $_POST['titulo']; 
	$descripcion = ($_POST['descripcion'] == '')? '' : $_POST['descripcion']; 
	$estatus = 1;

	//**********************valores par aterminar el ticket****************************//
	$idTermina = ($_POST['idTermina'] == '')? '' : $_POST['idTermina']; 
	$califincal = ($_POST['califincal'] == '')? '' : $_POST['califincal']; 

	//**********************valores par agregar un comentario al ticket por medio del clientet****************************//
	$comenCli = ($_POST['comenCli'] == '')? '' : $_POST['comenCli']; 
	$ideTiUS = ($_POST['ideTiUS'] == '')? '' : $_POST['ideTiUS']; 

	//**********************valores par agregar un comentario al ticket por medio del administrador****************************//
	$idsoporteComen = ($_POST['idsoporteComen'] == '')? '' : $_POST['idsoporteComen']; 
	$comentarioAdmin = ($_POST['comentarioAdmin'] == '')? '' : $_POST['comentarioAdmin']; 

	//valor para el conteo
	$conteo = ($_POST['conteo'] == '')? '' : $_POST['conteo']; 
	   
	//**********************valores par obtener los comentarios del ticket****************************//
	$recipient = ($_POST['recipient'] == '')? '' : $_POST['recipient']; 
	if($recipient != ""){
        $rspta = $tsoporte->consultaCome($recipient);
         //Codificar el resultado utilizando json
        $vaFin =  json_encode($rspta);
        print_r($vaFin);
    }
    //**********************valores par aterminar el ticket admin****************************//
	$idTerminaADmin = ($_POST['idTerminaADmin'] == '')? '' : $_POST['idTerminaADmin']; 

	$idReportar = ($_POST['idReportar'] == '')? '' : $_POST['idReportar']; 

	/****************************Acciones dependiendo de la variable*************************************///
    switch ($accion) {
        case "nuevo":
			$rspta = $tsoporte->insertar($id_usuario_reporta,$id_categoria_ticket,$titulo,$descripcion,$estatus,$usuarioSe,$fechaAccion);
			if($rspta){
				$inlog = $tsoporte->accionLogagrega($id_usuario,$fechaAccion);
				//agregamos contador de suma
				if($conteo >= 1){
					$conteo = $conteo + 1;
					$conta = $tsoporte->actualizacontador($id_usuario,$fechaAccion,$conteo);
				}else{
					$conta = $tsoporte->sumacontador($id_usuario,$fechaAccion);	
				}
				
				return true;
			}
			else{	return false; }
		break;

		case "terminar":
			$rspta = $tsoporte->terminar($idTermina,$califincal);
			if($rspta){
				$inlog = $tsoporte->accionLogTermina($id_usuario,$fechaAccion);
				if($califincal > 0){ $inlog2 = $tsoporte->accionLogCalifi($id_usuario,$fechaAccion);}
				
				return true;
			}
			else{	return false; }
		break;

		case "terminarAdmin":
			$rspta = $tsoporte->terminarAdmin($idTerminaADmin);
			if($rspta){
				$inlog = $tsoporte->accionLogTerminaAdmin($id_usuario,$fechaAccion);
				return true;
			}
			else{	return false; }
		break;

		case "nuevoComCli":
			$rspta = $tsoporte->comeClien($comenCli,$ideTiUS,$id_usuario,$fechaAccion);
			if($rspta){
				$inlog = $tsoporte->accionLogComeClie($id_usuario,$fechaAccion);
				return true;
			}
			else{	return false; }
		break;

		case "nuevoComAd":
			$rspta = $tsoporte->nuevoComAd($idsoporteComen,$comentarioAdmin,$id_usuario,$fechaAccion);
			if($rspta){
				$inlog = $tsoporte->accionLogComeAdmin($id_usuario,$fechaAccion);
				return true;
			}
			else{	return false; }
		break;

		case "enviarcorreo":
			$mail = new PHPMailer(true);                              
		        try {
		                //Server settings
		                $mail->SMTPDebug = 0;
		                $mail->isSMTP();
		                $mail->Host = 'mail.massiva.mx'; 
		                $mail->SMTPAuth = true;
		                $mail->Username = 'atencionclientes@massiva.mx';
		                $mail->Password = 'AtenCli_19';
		                $mail->SMTPSecure = 'tls';
		                $mail->Port = 587;

		                //Recipients
		                $mail->setFrom('atencionclientes@massiva.mx', 'Atención al cliente');
		                $mail->addAddress('mrodriguez@massiva.mx','Soporte Contable');               // Name is optional
		                $mail->addAddress('atencionclientes@massiva.mx','Atención al cliente');               // Name is optional

		                //Content
		                $mail->CharSet = 'UTF-8';
		                $mail->isHTML(true);                                  // Set email format to HTML
		                $mail->Subject = 'Asignación de ticket de soporte contable';
		                $mail->Body    = "
		                         <!DOCTYPE html>
									<html lang='es'>
									<head>
									<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/> 
									</head>
									<body>
										<div style='text-align:center;'>
										<table style='width: 100%' style='margin: 0 auto;'>
											<tr>
												<td colspan='2' style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Atención al cliente te asignó el número {$idReportar} de soporte contable, trabaja huevón (.|.).<br></h1></font></td>
											</tr>
											
											<tr>
												<td colspan='2'>
													<font color='gray' face='arial'>Recuerda que el tiempo de respuesta es menos de 24 horas, entendiste guey.</font>
												</td>
											</tr>
											<tr><td></td></tr>
											
										</table>
										</div>
									</body>
									</html>";
		                //enviamos el correo
		                $mail->send();
		                //redireccionamos a la pagina para enviar mensaje
		                return true;
		        } catch (Exception $e) {
		             $hola = '1';
		        }
			
			
		break;
		
		
		
       
    }
 
        
    
   
    



?>