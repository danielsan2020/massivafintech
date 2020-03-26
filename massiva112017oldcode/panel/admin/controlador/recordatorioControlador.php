<?php
	@session_start();
	//instanaciamos la funcion de php mailer
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../plugins/phpmailer/Exception.php';
	require '../plugins/phpmailer/PHPMailer.php';
	require '../plugins/phpmailer/SMTP.php';
	
	//*********************Variables generales***************************************//

	$correoRecordatorio = $_POST['correoRecordatorio'];
   
    
		$hola = strip_tags($correoRecordatorio);
		//envaismos el correo al cliente
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
				$mail->setFrom('atencionclientes@massiva.mx', 'Atención a clientes');
				$mail->addAddress($hola, 'Cliente');     // Add a recipient
				$mail->addAddress('atencionclientes@massiva.mx','');               // Name is optional

				$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
				$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

				//Content
				$mail->CharSet = 'UTF-8';
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Te seguimos esperando';
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
									<td><img src='cid:cabeceraSuperior' width='500' height='210' style='display: block;'></td>
								</tr>
								<tr><td><br></td></tr>
									<tr>
										<td colspan='2' style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Te seguimos esperando<br></h1></font></td>
									</tr>

									<tr valign='middle'>
										<td colspan='2' style='align-content: center' face='arial' valign='middle'>
											<font face='arial'>
												Hemos notado que no terminaste tu pre registro y nos gustaría saber en qué <br>
												te podemos apoyar para que lo finalices y puedas olvidarte de tu contabilidad<br>
												para que massiva se ocupe de ella.<br>
												Si tienes alguna duda escríbenos a atencionclientes@massiva.mx o a través <br>
												de nuestro whatsapp <b>55 5105 7038</b> en horarios de <b>9 am a 18.30 pm.</b><br><br><br>
											</font>
										</td>
									</tr>

									<tr><td></td></tr>
									<tr>
										<td colspan='2' style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td>
									</tr>
									<tr><td><br></td></tr>
									<tr>
									<br>
										<td><img src='cid:pieCorreo' width='500' height='210' style='display: block;'></td>
									</tr>
								</table>
								</div>
							</body>
							</html>";
				//enviamos el correo
				$mail->send();
				//redireccionamos a la pagina para enviar mensaje
				header ('location:../index.php?secc=clientesAte&enviaRedor=1');
		} catch (Exception $e) {
				$hola = '1';
		}

?>