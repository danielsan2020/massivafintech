<?php
	@session_start();
	//instanaciamos la funcion de php mailer
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../plugins/phpmailer/Exception.php';
	require '../plugins/phpmailer/PHPMailer.php';
	require '../plugins/phpmailer/SMTP.php';
	
    //session_start();
	//error_reporting(E_ALL);
	//ini_set('display_errors','1');

	/* incluimos libreria para crear archivo pdf */
	require('../plugins/fpdf/WriteHTML.php');
   
    /****************************************************************/
    // FUNCIONES GENERALES PARA EL SITIO                            //
    // CREACION DEL ARCHIVO: 27/08/2018                             //
    // MODIFICA Y/O TRABAJA: Azael HV                               //
    // PROYECTO: http://www.elinnovador.mx/                         //
    /****************************************************************/

    //instanciamos el modelo 
    require_once "../modelo/actualizaDasModelo.php";
    $actualiza = new actualiza();

	//*********************Variables generales***************************************//
	$fechaAccion = date("Y-m-d H:i:s");
	$fechaAccion2 = date("Y-m-d");
	$usuarioSe = $_SESSION['id_usuario'];
    $accion = $_POST['accion'];
 
	//**********************valores formulario edicion****************************//

 	switch ($accion) {
 		/* terminamos la actualziacion de las oblicaciones fiscales */
		case "terminarUno":
			/* obtenemos los valores */
			$idActu = ($_POST['idActu'] == '')? '' : $_POST['idActu'];
			$rfcCli = ($_POST['rfcCli'] == '')? '' : $_POST['rfcCli'];
			$correo = ($_POST['correo'] == '')? '' : $_POST['correo'];
			$hola = strip_tags($correo);
			/* subimos el archivo que suba el contador */
			$nombre_archivo_1 = "actualizacionDeObligaciones".$_FILES['documento']['name'];
			$uploaddir_1 = "../contenedor/clientes/".$rfcCli."/";
			$directorio_1 = $uploaddir_1.basename($nombre_archivo_1);
			move_uploaded_file($_FILES["documento"]["tmp_name"], $directorio_1);

			/* cambiamos el status y subimos el archivo */
			$rspta = $actualiza->terminoUno($idActu,$nombre_archivo_1);	

			/* enviamos el correo para avisar */
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
						$mail->addAddress('mrodriguez@massiva.mx');               // Name is optional

						$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
						$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

						//Content
						$mail->CharSet = 'UTF-8';
						$mail->isHTML(true);                                  // Set email format to HTML
						$mail->Subject = 'Actualización realizada';
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
										<td style='align-content: center'><img src='cid:cabeceraSuperior' width='500' height='210'></td>
									</tr>
									<tr><td><br></td></tr>
									<tr><td style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Actualización realizada<br></h1></font></td></tr>
									<tr><td><br></td></tr>
									<tr>
										<td style='width: 50%'>
											<p><font color='gray' face='arial'>Ya se realizó tu petición de actualización. <br><br>
											Podrás encontrar tu documento actualizado dentro de tu sección <br><b>Actualización ante el SAT</b>	exceptuando <br>
											para tu actualización de la e.firma que encontrarás tu .KEY y .CER en  <br><b>Documentación</b> y en <b>Tu Perfil contraseña e.firma.</b><br><br>
											¡Gracias!</font></p>
										</td>
									</tr>
									<tr><td></td></tr>
									<tr><td style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td></tr>
									<tr><td><br></td></tr>
									<tr><br><td><img src='cid:pieCorreo' width='500' height='210' ></td></tr>
								</table>
							</div>
						</body>
						</html>";
						//enviamos el correo
						$mail->send();
						/* redireccionamos  */
						header ('location:../index.php?secc=actuConta&actualizMod=1');
			                
			        } catch (Exception $e) {
			             $hola = '1';
					}
					if($accion2 == 'pre'){return true;}
		break;
		case "errorUno":
			/* obtenemos los valores */
			$idActu = ($_POST['idActu'] == '')? '' : $_POST['idActu'];
			$correo = ($_POST['correo'] == '')? '' : $_POST['correo'];
			$hola = strip_tags($correo);

			/* cambiamos el status y subimos el archivo */
			$rspta = $actualiza->errorUno($idActu);	

			/* enviamos el correo para avisar */
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
				$mail->addAddress('mrodriguez@massiva.mx');               // Name is optional

				$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
				$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

				//Content
				$mail->CharSet = 'UTF-8';
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Actualización realizada';
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
								<td style='align-content: center'><img src='cid:cabeceraSuperior' width='500' height='210'></td>
							</tr>
							<tr><td><br></td></tr>
							<tr><td style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Actualización no realizada<br></h1></font></td></tr>
							<tr><td><br></td></tr>
							<tr>
								<td style='width: 50%'>
									<p><font color='gray' face='arial'>
									Después de una revisión de tu petición de actualización se <br>
									encontraron posibles errores o impedimentos para realizarla.<br><br>
									Por favor ponte en contacto dentro de tu propio Perfil en <b>Consulta</b> <br>
									contable y comenta tu caso a nuestro equipo de contadores<br>
									para que puedan revisarlo y darte una solución lo antes posible.<br><br>
								
									¡Gracias!</font></p><br>
								</td>
							</tr>
							<tr><td></td></tr>
							<tr><td style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td></tr>
							<tr><td><br></td></tr>
							<tr><br><td><img src='cid:pieCorreo' width='500' height='210' ></td></tr>
						</table>
					</div>
				</body>
				</html>";
				//enviamos el correo
				$mail->send();
				/* redireccionamos  */
				header ('location:../index.php?secc=actuConta&actualizMod=2');
					
			} catch (Exception $e) {
					$hola = '1';
			}
			if($accion2 == 'pre'){return true;}
		break;
		/* terminar efirma */
		case "terminarDos":
			/* obtenemos los valores */
			$idActu = ($_POST['idActu'] == '')? '' : $_POST['idActu'];
			$rfcCli = ($_POST['rfcCli'] == '')? '' : $_POST['rfcCli'];
			$correo = ($_POST['correo'] == '')? '' : $_POST['correo'];
			
			$hola = strip_tags($correo);
			/* subimos el archivo que suba el contador */
			$nombre_archivo_1 = "actualizacionEfirma".$_FILES['documento']['name'];
			$uploaddir_1 = "../contenedor/clientes/".$rfcCli."/";
			$directorio_1 = $uploaddir_1.basename($nombre_archivo_1);
			move_uploaded_file($_FILES["documento"]["tmp_name"], $directorio_1);

			/* cambiamos el status y subimos el archivo */
			$rspta = $actualiza->terminoDos($idActu,$nombre_archivo_1);	

			/* enviamos el correo para avisar */
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
						$mail->addAddress('mrodriguez@massiva.mx');               // Name is optional

						$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
						$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

						//Content
						$mail->CharSet = 'UTF-8';
						$mail->isHTML(true);                                  // Set email format to HTML
						$mail->Subject = 'Actualización realizada';
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
										<td style='align-content: center'><img src='cid:cabeceraSuperior' width='500' height='210'></td>
									</tr>
									<tr><td><br></td></tr>
									<tr><td style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Actualización realizada<br></h1></font></td></tr>
									<tr><td><br></td></tr>
									<tr>
										<td style='width: 50%'>
											<p><font color='gray' face='arial'>Ya se realizó tu petición de actualización. <br><br>
											Podrás encontrar tu documento actualizado dentro de tu sección.<br><br>
											
											¡Gracias!</font></p>
										</td>
									</tr>
									<tr><td></td></tr>
									<tr><td style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td></tr>
									<tr><td><br></td></tr>
									<tr><br><td><img src='cid:pieCorreo' width='500' height='210' ></td></tr>
								</table>
							</div>
						</body>
						</html>";
						//enviamos el correo
						$mail->send();
						/* redireccionamos  */
						header ('location:../index.php?secc=actuConta&actualizMod=1');
			                
			        } catch (Exception $e) {
			             $hola = '1';
					}
					if($accion2 == 'pre'){return true;}
		break;
		/* termina error */
		case "errorDos":
			/* obtenemos los valores */
			$idActu = ($_POST['idActu'] == '')? '' : $_POST['idActu'];
			$correo = ($_POST['correo'] == '')? '' : $_POST['correo'];
			$hola = strip_tags($correo);

			/* cambiamos el status y subimos el archivo */
			$rspta = $actualiza->errorDos($idActu);	

			/* enviamos el correo para avisar */
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
				$mail->addAddress('mrodriguez@massiva.mx');               // Name is optional

				$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
				$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

				//Content
				$mail->CharSet = 'UTF-8';
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Actualización realizada';
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
								<td style='align-content: center'><img src='cid:cabeceraSuperior' width='500' height='210'></td>
							</tr>
							<tr><td><br></td></tr>
							<tr><td style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Actualización no realizada<br></h1></font></td></tr>
							<tr><td><br></td></tr>
							<tr>
								<td style='width: 50%'>
									<p><font color='gray' face='arial'>
									Después de una revisión de tu petición de actualización se <br>
									encontraron posibles errores o impedimentos para realizarla.<br><br>
									Por favor ponte en contacto dentro de tu propio Perfil en <b>Consulta</b> <br>
									contable y comenta tu caso a nuestro equipo de contadores<br>
									para que puedan revisarlo y darte una solución lo antes posible.<br><br>
								
									¡Gracias!</font></p><br>
								</td>
							</tr>
							<tr><td></td></tr>
							<tr><td style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td></tr>
							<tr><td><br></td></tr>
							<tr><br><td><img src='cid:pieCorreo' width='500' height='210' ></td></tr>
						</table>
					</div>
				</body>
				</html>";
				//enviamos el correo
				$mail->send();
				/* redireccionamos  */
				header ('location:../index.php?secc=actuConta&actualizMod=2');
					
			} catch (Exception $e) {
					$hola = '1';
			}
			if($accion2 == 'pre'){return true;}
		break;
		/* terminar suspension */
		case "terminarTres":
			/* obtenemos los valores */
			$idActu = ($_POST['idActu'] == '')? '' : $_POST['idActu'];
			$rfcCli = ($_POST['rfcCli'] == '')? '' : $_POST['rfcCli'];
			$correo = ($_POST['correo'] == '')? '' : $_POST['correo'];
			
			$hola = strip_tags($correo);
			/* subimos el archivo que suba el contador */
			$nombre_archivo_1 = "actualizacionSuspencionActividades".$_FILES['documento']['name'];
			$uploaddir_1 = "../contenedor/clientes/".$rfcCli."/";
			$directorio_1 = $uploaddir_1.basename($nombre_archivo_1);
			move_uploaded_file($_FILES["documento"]["tmp_name"], $directorio_1);

			/* cambiamos el status y subimos el archivo */
			$rspta = $actualiza->terminoTres($idActu,$nombre_archivo_1);	

			/* enviamos el correo para avisar */
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
						$mail->addAddress('mrodriguez@massiva.mx');               // Name is optional

						$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
						$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

						//Content
						$mail->CharSet = 'UTF-8';
						$mail->isHTML(true);                                  // Set email format to HTML
						$mail->Subject = 'Actualización realizada';
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
										<td style='align-content: center'><img src='cid:cabeceraSuperior' width='500' height='210'></td>
									</tr>
									<tr><td><br></td></tr>
									<tr><td style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Actualización realizada<br></h1></font></td></tr>
									<tr><td><br></td></tr>
									<tr>
										<td style='width: 50%'>
											<p><font color='gray' face='arial'>Ya se realizó tu petición de actualización. <br><br>
											Podrás encontrar tu documento actualizado dentro de tu sección.<br><br>
											
											¡Gracias!</font></p>
										</td>
									</tr>
									<tr><td></td></tr>
									<tr><td style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td></tr>
									<tr><td><br></td></tr>
									<tr><br><td><img src='cid:pieCorreo' width='500' height='210' ></td></tr>
								</table>
							</div>
						</body>
						</html>";
						//enviamos el correo
						$mail->send();
						/* redireccionamos  */
						header ('location:../index.php?secc=actuConta&actualizMod=1');
			                
			        } catch (Exception $e) {
			             $hola = '1';
					}
					if($accion2 == 'pre'){return true;}
		break;
		/* termina error */
		case "errorTres":
			/* obtenemos los valores */
			$idActu = ($_POST['idActu'] == '')? '' : $_POST['idActu'];
			$correo = ($_POST['correo'] == '')? '' : $_POST['correo'];
			$hola = strip_tags($correo);

			/* cambiamos el status y subimos el archivo */
			$rspta = $actualiza->errorTres($idActu);	

			/* enviamos el correo para avisar */
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
				$mail->addAddress('mrodriguez@massiva.mx');               // Name is optional

				$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
				$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

				//Content
				$mail->CharSet = 'UTF-8';
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Actualización realizada';
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
								<td style='align-content: center'><img src='cid:cabeceraSuperior' width='500' height='210'></td>
							</tr>
							<tr><td><br></td></tr>
							<tr><td style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Actualización no realizada<br></h1></font></td></tr>
							<tr><td><br></td></tr>
							<tr>
								<td style='width: 50%'>
									<p><font color='gray' face='arial'>
									Después de una revisión de tu petición de actualización se <br>
									encontraron posibles errores o impedimentos para realizarla.<br><br>
									Por favor ponte en contacto dentro de tu propio Perfil en <b>Consulta</b> <br>
									contable y comenta tu caso a nuestro equipo de contadores<br>
									para que puedan revisarlo y darte una solución lo antes posible.<br><br>
								
									¡Gracias!</font></p><br>
								</td>
							</tr>
							<tr><td></td></tr>
							<tr><td style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td></tr>
							<tr><td><br></td></tr>
							<tr><br><td><img src='cid:pieCorreo' width='500' height='210' ></td></tr>
						</table>
					</div>
				</body>
				</html>";
				//enviamos el correo
				$mail->send();
				/* redireccionamos  */
				header ('location:../index.php?secc=actuConta&actualizMod=2');
					
			} catch (Exception $e) {
					$hola = '1';
			}
			if($accion2 == 'pre'){return true;}
		break;
		/* terminar constancia de obligaciones */
		case "terminarCinco":
			/* obtenemos los valores */
			$idActu = ($_POST['idActu'] == '')? '' : $_POST['idActu'];
			$rfcCli = ($_POST['rfcCli'] == '')? '' : $_POST['rfcCli'];
			$correo = ($_POST['correo'] == '')? '' : $_POST['correo'];
			
			$hola = strip_tags($correo);
			/* subimos el archivo que suba el contador */
			$nombre_archivo_1 = "actualizacionConstanciaObligaciones".$_FILES['documento']['name'];
			$uploaddir_1 = "../contenedor/clientes/".$rfcCli."/";
			$directorio_1 = $uploaddir_1.basename($nombre_archivo_1);
			move_uploaded_file($_FILES["documento"]["tmp_name"], $directorio_1);

			/* cambiamos el status y subimos el archivo */
			$rspta = $actualiza->terminoCinco($idActu,$nombre_archivo_1);	

			/* enviamos el correo para avisar */
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
						$mail->addAddress('mrodriguez@massiva.mx');               // Name is optional

						$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
						$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

						//Content
						$mail->CharSet = 'UTF-8';
						$mail->isHTML(true);                                  // Set email format to HTML
						$mail->Subject = 'Actualización realizada';
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
										<td style='align-content: center'><img src='cid:cabeceraSuperior' width='500' height='210'></td>
									</tr>
									<tr><td><br></td></tr>
									<tr><td style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Actualización realizada<br></h1></font></td></tr>
									<tr><td><br></td></tr>
									<tr>
										<td style='width: 50%'>
											<p><font color='gray' face='arial'>Ya se realizó tu petición de actualización. <br><br>
											Podrás encontrar tu documento actualizado dentro de tu sección.<br><br>
											
											¡Gracias!</font></p>
										</td>
									</tr>
									<tr><td></td></tr>
									<tr><td style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td></tr>
									<tr><td><br></td></tr>
									<tr><br><td><img src='cid:pieCorreo' width='500' height='210' ></td></tr>
								</table>
							</div>
						</body>
						</html>";
						//enviamos el correo
						$mail->send();
						/* redireccionamos  */
						header ('location:../index.php?secc=actuConta&actualizMod=1');
			                
			        } catch (Exception $e) {
			             $hola = '1';
					}
					if($accion2 == 'pre'){return true;}
		break;
		/* termina error */
		case "errorCinco":
			/* obtenemos los valores */
			$idActu = ($_POST['idActu'] == '')? '' : $_POST['idActu'];
			$correo = ($_POST['correo'] == '')? '' : $_POST['correo'];
			$hola = strip_tags($correo);

			/* cambiamos el status y subimos el archivo */
			$rspta = $actualiza->errorCinco($idActu);	

			/* enviamos el correo para avisar */
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
				$mail->addAddress('mrodriguez@massiva.mx');               // Name is optional

				$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
				$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

				//Content
				$mail->CharSet = 'UTF-8';
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Actualización realizada';
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
								<td style='align-content: center'><img src='cid:cabeceraSuperior' width='500' height='210'></td>
							</tr>
							<tr><td><br></td></tr>
							<tr><td style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Actualización no realizada<br></h1></font></td></tr>
							<tr><td><br></td></tr>
							<tr>
								<td style='width: 50%'>
									<p><font color='gray' face='arial'>
									Después de una revisión de tu petición de actualización se <br>
									encontraron posibles errores o impedimentos para realizarla.<br><br>
									Por favor ponte en contacto dentro de tu propio Perfil en <b>Consulta</b> <br>
									contable y comenta tu caso a nuestro equipo de contadores<br>
									para que puedan revisarlo y darte una solución lo antes posible.<br><br>
								
									¡Gracias!</font></p><br>
								</td>
							</tr>
							<tr><td></td></tr>
							<tr><td style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td></tr>
							<tr><td><br></td></tr>
							<tr><br><td><img src='cid:pieCorreo' width='500' height='210' ></td></tr>
						</table>
					</div>
				</body>
				</html>";
				//enviamos el correo
				$mail->send();
				/* redireccionamos  */
				header ('location:../index.php?secc=actuConta&actualizMod=2');
					
			} catch (Exception $e) {
					$hola = '1';
			}
			if($accion2 == 'pre'){return true;}
		break;
		/* terminar constancia de defuncion */
		case "terminarSeis":
			/* obtenemos los valores */
			$idActu = ($_POST['idActu'] == '')? '' : $_POST['idActu'];
			$rfcCli = ($_POST['rfcCli'] == '')? '' : $_POST['rfcCli'];
			$correo = ($_POST['correo'] == '')? '' : $_POST['correo'];
			
			$hola = strip_tags($correo);
			/* subimos el archivo que suba el contador */
			$nombre_archivo_1 = "actualizacionDefuncion".$_FILES['documento']['name'];
			$uploaddir_1 = "../contenedor/clientes/".$rfcCli."/";
			$directorio_1 = $uploaddir_1.basename($nombre_archivo_1);
			move_uploaded_file($_FILES["documento"]["tmp_name"], $directorio_1);

			/* cambiamos el status y subimos el archivo */
			$rspta = $actualiza->terminoSeis($idActu,$nombre_archivo_1);	

			/* enviamos el correo para avisar */
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
						$mail->addAddress('mrodriguez@massiva.mx');               // Name is optional

						$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
						$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

						//Content
						$mail->CharSet = 'UTF-8';
						$mail->isHTML(true);                                  // Set email format to HTML
						$mail->Subject = 'Actualización realizada';
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
										<td style='align-content: center'><img src='cid:cabeceraSuperior' width='500' height='210'></td>
									</tr>
									<tr><td><br></td></tr>
									<tr><td style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Actualización realizada<br></h1></font></td></tr>
									<tr><td><br></td></tr>
									<tr>
										<td style='width: 50%'>
											<p><font color='gray' face='arial'>Ya se realizó tu petición de actualización. <br><br>
											Podrás encontrar tu documento actualizado dentro de tu sección.<br><br>
											
											¡Gracias!</font></p>
										</td>
									</tr>
									<tr><td></td></tr>
									<tr><td style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td></tr>
									<tr><td><br></td></tr>
									<tr><br><td><img src='cid:pieCorreo' width='500' height='210' ></td></tr>
								</table>
							</div>
						</body>
						</html>";
						//enviamos el correo
						$mail->send();
						/* redireccionamos  */
						header ('location:../index.php?secc=actuConta&actualizMod=1');
			                
			        } catch (Exception $e) {
			             $hola = '1';
					}
					if($accion2 == 'pre'){return true;}
		break;
		/* termina error */
		case "errorSeis":
			/* obtenemos los valores */
			$idActu = ($_POST['idActu'] == '')? '' : $_POST['idActu'];
			$correo = ($_POST['correo'] == '')? '' : $_POST['correo'];
			$hola = strip_tags($correo);

			/* cambiamos el status y subimos el archivo */
			$rspta = $actualiza->errorSeis($idActu);	

			/* enviamos el correo para avisar */
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
				$mail->addAddress('mrodriguez@massiva.mx');               // Name is optional

				$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
				$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

				//Content
				$mail->CharSet = 'UTF-8';
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Actualización realizada';
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
								<td style='align-content: center'><img src='cid:cabeceraSuperior' width='500' height='210'></td>
							</tr>
							<tr><td><br></td></tr>
							<tr><td style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Actualización no realizada<br></h1></font></td></tr>
							<tr><td><br></td></tr>
							<tr>
								<td style='width: 50%'>
									<p><font color='gray' face='arial'>
									Después de una revisión de tu petición de actualización se <br>
									encontraron posibles errores o impedimentos para realizarla.<br><br>
									Por favor ponte en contacto dentro de tu propio Perfil en <b>Consulta</b> <br>
									contable y comenta tu caso a nuestro equipo de contadores<br>
									para que puedan revisarlo y darte una solución lo antes posible.<br><br>
								
									¡Gracias!</font></p><br>
								</td>
							</tr>
							<tr><td></td></tr>
							<tr><td style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td></tr>
							<tr><td><br></td></tr>
							<tr><br><td><img src='cid:pieCorreo' width='500' height='210' ></td></tr>
						</table>
					</div>
				</body>
				</html>";
				//enviamos el correo
				$mail->send();
				/* redireccionamos  */
				header ('location:../index.php?secc=actuConta&actualizMod=2');
					
			} catch (Exception $e) {
					$hola = '1';
			}
			if($accion2 == 'pre'){return true;}
		break;

		/* terminar cambio de domicilio*/
		case "terminarCuatro":
			/* obtenemos los valores */
			$idActu = ($_POST['idActu'] == '')? '' : $_POST['idActu'];
			$rfcCli = ($_POST['rfcCli'] == '')? '' : $_POST['rfcCli'];
			$correo = ($_POST['correo'] == '')? '' : $_POST['correo'];
			
			$hola = strip_tags($correo);
			/* subimos el archivo que suba el contador */
			$nombre_archivo_1 = "actualizacionCambioDomicilio".$_FILES['documento']['name'];
			$uploaddir_1 = "../contenedor/clientes/".$rfcCli."/";
			$directorio_1 = $uploaddir_1.basename($nombre_archivo_1);
			move_uploaded_file($_FILES["documento"]["tmp_name"], $directorio_1);

			/* cambiamos el status y subimos el archivo */
			$rspta = $actualiza->terminoCuatro($idActu,$nombre_archivo_1);	

			/* enviamos el correo para avisar */
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
						$mail->addAddress('mrodriguez@massiva.mx');               // Name is optional

						$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
						$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

						//Content
						$mail->CharSet = 'UTF-8';
						$mail->isHTML(true);                                  // Set email format to HTML
						$mail->Subject = 'Actualización realizada';
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
										<td style='align-content: center'><img src='cid:cabeceraSuperior' width='500' height='210'></td>
									</tr>
									<tr><td><br></td></tr>
									<tr><td style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Actualización realizada<br></h1></font></td></tr>
									<tr><td><br></td></tr>
									<tr>
										<td style='width: 50%'>
											<p><font color='gray' face='arial'>Ya se realizó tu petición de actualización. <br><br>
											Podrás encontrar tu documento actualizado dentro de tu sección.<br><br>
											
											¡Gracias!</font></p>
										</td>
									</tr>
									<tr><td></td></tr>
									<tr><td style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td></tr>
									<tr><td><br></td></tr>
									<tr><br><td><img src='cid:pieCorreo' width='500' height='210' ></td></tr>
								</table>
							</div>
						</body>
						</html>";
						//enviamos el correo
						$mail->send();
						/* redireccionamos  */
						header ('location:../index.php?secc=actuConta&actualizMod=1');
			                
			        } catch (Exception $e) {
			             $hola = '1';
					}
					if($accion2 == 'pre'){return true;}
		break;

		/* termina error */
		case "errorCuatro":
			/* obtenemos los valores */
			$idActu = ($_POST['idActu'] == '')? '' : $_POST['idActu'];
			$correo = ($_POST['correo'] == '')? '' : $_POST['correo'];
			$hola = strip_tags($correo);

			/* cambiamos el status y subimos el archivo */
			$rspta = $actualiza->errorCuatro($idActu);	

			/* enviamos el correo para avisar */
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
				$mail->addAddress('mrodriguez@massiva.mx');               // Name is optional

				$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
				$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

				//Content
				$mail->CharSet = 'UTF-8';
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Actualización realizada';
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
								<td style='align-content: center'><img src='cid:cabeceraSuperior' width='500' height='210'></td>
							</tr>
							<tr><td><br></td></tr>
							<tr><td style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Actualización no realizada<br></h1></font></td></tr>
							<tr><td><br></td></tr>
							<tr>
								<td style='width: 50%'>
									<p><font color='gray' face='arial'>
									Después de una revisión de tu petición de actualización se <br>
									encontraron posibles errores o impedimentos para realizarla.<br><br>
									Por favor ponte en contacto dentro de tu propio Perfil en <b>Consulta</b> <br>
									contable y comenta tu caso a nuestro equipo de contadores<br>
									para que puedan revisarlo y darte una solución lo antes posible.<br><br>
								
									¡Gracias!</font></p><br>
								</td>
							</tr>
							<tr><td></td></tr>
							<tr><td style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td></tr>
							<tr><td><br></td></tr>
							<tr><br><td><img src='cid:pieCorreo' width='500' height='210' ></td></tr>
						</table>
					</div>
				</body>
				</html>";
				//enviamos el correo
				$mail->send();
				/* redireccionamos  */
				header ('location:../index.php?secc=actuConta&actualizMod=2');
					
			} catch (Exception $e) {
					$hola = '1';
			}
			if($accion2 == 'pre'){return true;}
		break;
		
 	}
?>