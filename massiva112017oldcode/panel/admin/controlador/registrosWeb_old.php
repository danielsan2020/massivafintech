<?php
		@session_start();	   
	//instanaciamos la funcion de php mailer
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../plugins/phpmailer/Exception.php';
	require '../plugins/phpmailer/PHPMailer.php';
	require '../plugins/phpmailer/SMTP.php';

	date_default_timezone_set("America/Mexico_City");
    //session_start();
	//error_reporting(E_ALL);
	//ini_set('display_errors','1');

  
    //instanciamos el modelo 
    require_once "../modelo/registrowebModelo.php";
    $rweb = new rweb();

	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d");
    $accion = $_POST['accion'];
    
    //**********************valores formulario nuevo****************************//
	$nombre = ($_POST['nombre'] == '')? '' : $_POST['nombre']; 
	$numero = ($_POST['numero'] == '')? '' : $_POST['numero'];
	$asunto = ($_POST['asunto'] == '')? '' : $_POST['asunto'];

    //**********************valores de usuario nuevo****************************//
    $nombreR = ($_POST['nombreR'] == '')? '' : $_POST['nombreR']; 
    $ape_paternoR = ($_POST['ape_paternoR'] == '')? '' : $_POST['ape_paternoR']; 
	$ape_maternoR = ($_POST['ape_maternoR'] == '')? '' : $_POST['ape_maternoR']; 
    $telefonoR = ($_POST['telefonoR'] == '')? '' : $_POST['telefonoR']; 
	$rfcR = ($_POST['rfcR'] == '')? '' : $_POST['rfcR']; 
		$rfcR = strtoupper($rfcR);
	$correoR = ($_POST['correoR'] == '')? '' : $_POST['correoR']; 
	$tipoActividadR = ($_POST['tipoActividadR'] == '')? '' : $_POST['tipoActividadR']; 
	$formaJuridicaR = ($_POST['formaJuridicaR'] == '')? '' : $_POST['formaJuridicaR']; 
    $cantidadTrabajadoresR = ($_POST['cantidadTrabajadoresR'] == '')? '' : $_POST['cantidadTrabajadoresR']; 
    $noTengoEfirmaR = ($_POST['noTengoEfirmaR'] == '')? '' : $_POST['noTengoEfirmaR']; 
    $contabilidadAtrasadaR = ($_POST['contabilidadAtrasadaR'] == '')? '' : $_POST['contabilidadAtrasadaR']; 
    $efirma = ($_POST['efirma'] == '')? '' : $_POST['efirma']; 
    $contaAtrasada = ($_POST['contaAtrasada'] == '')? '' : $_POST['contaAtrasada']; 
    $aviso = ($_POST['aviso'] == '')? '' : $_POST['aviso']; 
    $terminos = ($_POST['terminos'] == '')? '' : $_POST['terminos']; 
	$clave = substr( md5(microtime()), 1, 8);

    $rsptaCon = $rweb->consulta($rfcR);
    $rsptaConIfno= $rsptaCon->fetch_object();
    $vallhu = $rsptaConIfno->rfc;
    
    ////////////////////VERIFICAR 

	//dependiendo del resultado de la consulta es el tipo de correo que enviamos 
    if($vallhu != ''){	$estatus = "2"; //echo $estatus;	
    } //en este caso  pasa
	else{ $estatus = "1"; //echo $estatus; 
	} //en este caso no paso el rfc

	//**********************valores para verificar si ya existe el rfco****************************//
	$strCorrecta = $_POST['strCorrecta'];
    if($strCorrecta != ""){
        $data=$rweb->consultaRFcbd($strCorrecta);
		echo json_encode($data);
    }

    //**********************vcreamos la variable de correo****************************//
    $hola = strip_tags($correoR);

	/****************************Acciones dependiendo de la variable*************************************///
    switch ($accion) {
        case "nuevo":
			$rspta = $rweb->insertar($nombre,$numero,$fechaAccion,$asunto);
			if($rspta){	return true;	}
			else{	return false; }
        break;
        
		//caso para registrar nuevo usuario a la plataforma
        case "nusuario":
        	//////////////*******************************Caso para el usuario denegado
			if($estatus == 2){ ///en caso de que el rfc sea negado desde el rfc black
				$numUlt = 0;//cuando no pasa el numero se queda en cero
				$rspta = $rweb->nusuario($nombreR,$ape_paternoR,$ape_maternoR,$telefonoR,$rfcR,$correoR,$tipoActividadR,$formaJuridicaR,$cantidadTrabajadoresR,$noTengoEfirmaR,$contabilidadAtrasadaR,$aviso,$terminos,$clave,$estatus,$numUlt,$fechaAccion);
				//guardamos el logs de usuario denegado
				$rsptaLog = $rweb->accionLogagrega($fechaAccion);
				//enviamos el correo al cliente con copia a soporte y administracion
				$mail = new PHPMailer(true);                              
		        try {
		                //Server settings
		                $mail->SMTPDebug = 0;
		                $mail->isSMTP();
		                $mail->Host = 'mail.massiva.mx'; 
		                $mail->SMTPAuth = true;
		                $mail->Username = 'registro@massiva.mx';
		                $mail->Password = 'Registro2019';
		                $mail->SMTPSecure = 'tls';
		                $mail->Port = 587;

		                //Recipients
		                $mail->setFrom('registro@massiva.mx', 'Registro plataforma');
		                $mail->addAddress($hola, 'Cliente');     // Add a recipient
		                $mail->addAddress('registro@massiva.mx','Recuperación de claves');               // Name is optional
		                $mail->addAddress('ahernandez@massiva.mx','Recuperación de claves');               // Name is optional

		                //Content
		                $mail->CharSet = 'UTF-8';
		                $mail->isHTML(true);                                  // Set email format to HTML
		                $mail->Subject = 'Registro massiva';
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
												<td colspan='2' style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Lo sentimos tu RFC: {$rfcR} se encuentra en la lista negra del SAT<br></h1></font></td>
											</tr>
											
											<tr>
												<td colspan='2'>
													<font color='gray' face='arial'>Si requieres apoyo de nuestra área legal, contacta con <a href='mailto:atencionclientes@massiva.mx'>atencionclientes@massiva.mx</a></font>
												</td>
											</tr>
											<tr><td></td></tr>
											<tr>
												<td colspan='2' style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td>
											</tr>
										</table>
										</div>
									</body>
									</html>";
		                //enviamos el correo
		                $mail->send();
		                //redireccionamos a la pagina para enviar mensaje
		                
		        } catch (Exception $e) {
		             $hola = '1';
		        }


			//////////////*******************************Caso para el usuario aceptado
			}else{
				//obtenemos el numero de usuario
				$rspNum = $rweb->ultimoNumero();
				$rspNumInfo = $rspNum->fetch_object();
				$ultimoNum = $rspNumInfo->nUsuario;
				//generamos el ultimo numero de usuario
				$numUlt = $ultimoNum + 1;
				$estatus = 1;

				//obtenemos el numero de usuario
				$rspta = $rweb->nusuario($nombreR,$ape_paternoR,$ape_maternoR,$telefonoR,$rfcR,$correoR,$tipoActividadR,$formaJuridicaR,$cantidadTrabajadoresR,$noTengoEfirmaR,$contabilidadAtrasadaR,$aviso,$terminos,$clave,$estatus,$numUlt,$fechaAccion);

				//creamos la carpeta en del usuario para su documentacion
				mkdir("../contenedor/clientes/".$rfcR."/", 0700);
				//creamos la carpeta para meter las cotizaciones
				mkdir("../contenedor/clientes/".$rfcR."/cotizaciones", 0700);

				//obtenemos la clave generado por el nuevo usuario con el rfc
				$rspclave = $rweb->claveNuevoUs($rfcR);
				$rspclaveInfo = $rspclave->fetch_object();
				$clbe = $rspclaveInfo->clave;

				//guardamos el los de usuario aceptado
				$rsptaLog = $rweb->accionLogagrega2($fechaAccion);
				//enviamos el correo de aceptacion
				$mail = new PHPMailer(true);                              
		        try {
		                //Server settings
		                $mail->SMTPDebug = 0;
		                $mail->isSMTP();
		                $mail->Host = 'mail.massiva.mx'; 
		                $mail->SMTPAuth = true;
		                $mail->Username = 'registro@massiva.mx';
		                $mail->Password = 'Registro2019';
		                $mail->SMTPSecure = 'tls';
		                $mail->Port = 587;

		                //Recipients
		                $mail->setFrom('registro@massiva.mx', 'Registro plataforma');
		                $mail->addAddress($hola, 'Cliente');     // Add a recipient
		                $mail->addAddress('registro@massiva.mx','Recuperación de claves');               // Name is optional
		                $mail->addAddress('ahernandez@massiva.mx','Recuperación de claves');               // Name is optional

		                //Content
		                $mail->CharSet = 'UTF-8';
		                $mail->isHTML(true);                                  // Set email format to HTML
		                $mail->Subject = 'Registro massiva';
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
												<td colspan='2' style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>¡Bienvenida/o a massiva!</h1></font></td>
											</tr>
											<tr>
												<td colspan='2'>
													<font color='gray' face='arial'>Inicia sesión y conéctate con tu contabilidad al día.<br>
													</font>
												</td>
											</tr>

											<tr valign='middle'>
												<td colspan='2' style='align-content: center' face='arial' valign='middle'>
													<font face='arial'><h4 style='align-items: center;' face='arial'>
													<h5>
														<b>Usuario:</b> {$rfcR}<br>
														<b>Clave:</b> {$clbe}<br>
														<b>Liga de acceso: https://app.massiva.mx/</b><br>
													</h5>
													</font>
												</td>
											</tr>
											<tr>
												<td colspan='2'>
													<font color='gray' face='arial'>Si requieres apoyo de nuestra área legal, contacta con <a href='mailto:atencionclientes@massiva.mx'>atencionclientes@massiva.mx</a></font>
												</td>
											</tr>
											<tr><td></td></tr>
											<tr>
												<td colspan='2' style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente:<br>El equipo de massiva<br><br>Massiva protegerá siempre tu privacidad y confidencialidad de datos.<br> Si quieres saber más, revisa el Aviso de Privacidad y en Términos y Condiciones dentro de www.massiva.mx</small></font></td>
											</tr>
										</table>
										</div>
									</body>
									</html>";
		                //enviamos el correo
		                $mail->send();
		                //redireccionamos a la pagina para enviar mensaje
		                
		        } catch (Exception $e) {
		             $hola = '1';
		        }
			}

        break;
			
		case "nuevoContacto": //envio de correo
			
			$Cnombre = ($_POST['Cnombre'] == '')? '' : $_POST['Cnombre']; 
			$Cape = ($_POST['Cape'] == '')? '' : $_POST['Cape']; 
			$Cmail = ($_POST['Cmail'] == '')? '' : $_POST['Cmail']; 
			$cCel = ($_POST['cCel'] == '')? '' : $_POST['cCel']; 
			$Cciudad = ($_POST['Cciudad'] == '')? '' : $_POST['Cciudad']; 
			$cActi = ($_POST['cActi'] == '')? '' : $_POST['cActi']; 
			$cMensaje = ($_POST['cMensaje'] == '')? '' : $_POST['cMensaje']; 
           	
			$subject = 'Mensajes de contacto'; // Subject of your email
			$to = 'atencionclientes@massiva.mx';  //Recipient's E-mail

			$email_from = $Cnombre.$Cape.'<'.$Cmail.'>';

			$headers = "MIME-Version: 1.1";
			$headers .= "Content-type: text/html; charset=iso-8859-1";
			$headers .= "From: ".$Cnombre.'<'.$Cmail.'>'."\r\n"; // Sender's E-mail
			$headers .= "Return-Path:"."From:" . $Cmail;

			$message .= 'Nombre : ' . $Cnombre.$Cape . "\n";
			$message .= 'Correo : ' . $Cmail . "\n";
			$message .= 'Celular : ' . $cCel . "\n";
			$message .= 'Ciudad : ' . $Cciudad . "\n";
			$message .= 'Actividad : ' . $cActi . "\n";
			$message .= 'Mensaje : ' . $cMensaje;

			if (@mail($to, $subject, $message, $email_from)) { return true;	}
			else{ return false; } 
        break;
    }

?>