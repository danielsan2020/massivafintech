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
    require_once "../modelo/simuladorModelo.php";
    $simula = new simula();

	//*********************Variables generales***************************************//
	$fechaAccion = date("Y-m-d H:i:s");
	$fechaAccion2 = date("Y-m-d");
	$usuarioSe = $_SESSION['id_usuario'];
    $accion = $_POST['accion'];
    $accion2 = $_POST['accion2'];
    
	//**********************valores para agregar nuevo seguro****************************//
	
	$montoCal = ($_POST['montoCal'] == '')? '' : $_POST['montoCal'];
	$rfcR = ($_POST['rfc'] == '')? '' : $_POST['rfc'];
	$rfc = strtoupper($rfcR);
	$nombre = ($_POST['nombre'] == '')? '' : $_POST['nombre'];
	$ape_paterno = ($_POST['ape_paterno'] == '')? '' : $_POST['ape_paterno'];
	$ape_materno = ($_POST['ape_materno'] == '')? '' : $_POST['ape_materno'];
	$correo = ($_POST['correo'] == '')? '' : $_POST['correo'];
	$periodoRegu = ($_POST['periodoRegu'] == '')? '' : $_POST['periodoRegu'];
	/* aqui obtenemos los valores de obligaciones */
	$obliga = ($_POST['obliga'] == '')? '' : $_POST['obliga'];
	$obliga2 = ($_POST['obliga2'] == '')? '' : $_POST['obliga2'];
	
	
	$num = count($obliga);
	for($n=0; $n<$num; $n++){
		$valorFinal .= $obliga[$n].',';
	}

	$cheInteres = ($_POST['cheInteres'] == '')? '' : $_POST['cheInteres'];
	$cheasalariado = ($_POST['cheasalariado'] == '')? '' : $_POST['cheasalariado'];
	$chearrendamiento = ($_POST['chearrendamiento'] == '')? '' : $_POST['chearrendamiento'];
	$cheservicios = ($_POST['cheservicios'] == '')? '' : $_POST['cheservicios'];
	$cheempresaria = ($_POST['cheempresaria'] == '')? '' : $_POST['rfc'];
	$cherif = ($_POST['cherif'] == '')? '' : $_POST['cherif'];
	$estatus = 1;
	$creado = 1;

	$montoCadena = "$".$montoCal." ";

	//valores para personas morales
		
	if($accion2 == 'pre'){
	$estatus = 2;
	$creado = 2;
	$estatus1 = 2;
	$creado1 = 2;
	$mesesin = $_POST['mesesin'];
	}
	else{
		$estatus = 1;
		$creado = 1;
		$estatus1 = 1;
		$creado1 = 1;
		$mesesin = $_POST['mesesin'];
	}

	$montoCadena1 = "$".$montoCal1." ";

	//valores para el reeenvio de la infomacion
	$montoEnvia = ($_POST['montoEnvia'] == '')? '' : $_POST['montoEnvia'];
	$correEnvia = ($_POST['correEnvia'] == '')? '' : $_POST['correEnvia'];

	//valores para eliminar
	$idContaAtrasada = ($_POST['idContaAtrasada'] == '')? '' : $_POST['idContaAtrasada'];
	
	/* valor de suaurio para la autorizacion */
	$idUsuArio = ($_POST['idUsuArio'] == '')? '' : $_POST['idUsuArio'];
	$rfcCoti = ($_POST['rfcCoti'] == '')? '' : $_POST['rfcCoti'];
	
	
	//**********************valores formulario edicion****************************//

 	switch ($accion) {
 		/* agregamos cotizacion de persona fisica desde atencion al cliente */
		case "agergarAte":
			/* guardamos los valores en la base de datos */
			if($accion2 == 'pre'){
			$rspta = $simula->agregacontaatrapf2($montoCal,$rfc,$nombre,$ape_paterno,$ape_materno,$correo,$periodoRegu,$obliga2,$cheInteres,$cheasalariado,$chearrendamiento,$cheservicios,$cheempresaria,$cherif,$estatus,$creado,$fechaAccion,$usuarioSe,$mesesin);	
			}else{
				$rspta = $simula->agregacontaatrapf2($montoCal,$rfc,$nombre,$ape_paterno,$ape_materno,$correo,$periodoRegu,$valorFinal,$cheInteres,$cheasalariado,$chearrendamiento,$cheservicios,$cheempresaria,$cherif,$estatus,$creado,$fechaAccion,$usuarioSe,$mesesin);	
			}
			if($rspta){
				///guardamo el evento en el log
				$rsptaLog = $simula->accionAgregoContapf($usuarioSe,$fechaAccion);
				if($rsptaLog){ 

					$hola = strip_tags($correo);
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
			                $mail->addAddress('ahernandez@massiva.mx');               // Name is optional

							$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
							$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

			                //Content
			                $mail->CharSet = 'UTF-8';
			                $mail->isHTML(true);                                  // Set email format to HTML
			                $mail->Subject = 'Cotización de contabilidad atrasada massiva';
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
													<td colspan='2' style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Cotización Contabilidad Atrasada<br></h1></font></td>
												</tr>

												<tr valign='middle'>
													<td colspan='2' style='align-content: center' face='arial' valign='middle'>
														<font face='arial'><h4 style='align-items: center;' face='arial'>
														<h5>
															<b>Forma jurídica:</b> Persona Física<br>
															<b>Costo: </b>  {$montoCadena} pesos.<br><br>

															<b>Ya recibimos tu registro con tu e-firma para el análisis de tu contabilidad con exactitud. <br> 
															Esta cotización podría variar después del análisis por massiva ante el SAT.
															
															 </b> 
															
														</h5>
														</font>
													</td>
												</tr>

												<tr><td><br></td></tr>

												<tr>
													<td colspan='2'>
														<font color='gray' face='arial'>El tiempo de análisis es de 2 días hábiles. Si existiera algún cambio, te lo haremos saber a través de un mail, sino existen cambios en tu cotización procederemos a la realización de tu contabilidad atrasada una vez nos autorices, este tiempo será de 5 a 7 días hábiles

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
			                
			        } catch (Exception $e) {
			             $hola = '1';
					}
					if($accion2 == 'pre'){return true;}
					else{ header ('location:../index.php?secc=simuladores&guaSim=1');}
				}
			}else{
				/* en caso de no se guarde bien  */
				if($accion2 == 'pre'){return false;}
				else{ header ('location:../index.php?secc=simuladores&guaSim=2');}
			}
		break;
			
		case "agergarAte1":
			
			$rspta = $simula->agregacontaatrapm($montoCal1,$rfc1,$nombre1,$ape_paterno1,$ape_materno1,$correo1,$periodoRegu2,$obliga2,$movIngUno2,$regeneral,$fineslucra,$estatus1,$creado1,$fechaAccion,$usuarioSe);
			 if($rspta){
				///guardamo el evento en el log
				$rsptaLog = $simula->accionAgregoContapm($usuarioSe,$fechaAccion);
				if($rsptaLog){ 

					$hola = strip_tags($correo1);
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
			                $mail->addAddress('atencionclientes@massiva.mx','Recuperación de claves');               // Name is optional
							$mail->addAddress('mrodriguez@massiva.mx','Recuperación de claves');               // Name is optional
							
							$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
							$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

			                //Content
			                $mail->CharSet = 'UTF-8';
			                $mail->isHTML(true);                                  // Set email format to HTML
			                $mail->Subject = 'Cotización de contabilidad atrasada massiva';
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
													<td colspan='2' style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Cotización Contabilidad Atrasada<br></h1></font></td>
												</tr>

												<tr valign='middle'>
													<td colspan='2' style='align-content: center' face='arial' valign='middle'>
														<font face='arial'><h4 style='align-items: center;' face='arial'>
														<h5>
															<b>Forma jurídica:</b> Persona Moral.<br>
															<b>Costo: </b>  {$montoCadena1} .<br><br>

															<b>Una vez obtengamos tu e-firma podremos analizar tu contabilidad con exactitud.
															<br> Esta cotización podría variar después del análisis por massiva.</b> 
															
														</h5>
														</font>
													</td>
												</tr>

												<tr><td><br></td></tr>

												<tr>
													<td colspan='2'>
														<font color='gray' face='arial'>El tiempo de análisis es de 2 días hábiles.<br>
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
			                
			        } catch (Exception $e) {
			             $hola = '1';
			        }
					header ('location:../index.php?secc=simuladores&guaSim=1');
				}	
			}else{
				header ('location:../index.php?secc=simuladores&guaSim=2');
			}
		break;
		
		/* reeenviamos la cotizacion desde el dashbord de contadores */
		case "reenviar":
			$hola = strip_tags($correEnvia);
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
	                $mail->addAddress('atencionclientes@massiva.mx','Recuperación de claves');               // Name is optional
	                $mail->addAddress('mrodriguez@massiva.mx','Recuperación de claves');               // Name is optional
					$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
							$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

	                //Content
	                $mail->CharSet = 'UTF-8';
	                $mail->isHTML(true);                                  // Set email format to HTML
	                $mail->Subject = 'Cotización de contabilidad atrasada massiva';
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
											<td colspan='2' style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Cotización Contabilidad Atrasada<br></h1></font></td>
										</tr>

										<tr valign='middle'>
											<td colspan='2' style='align-content: center' face='arial' valign='middle'>
												<font face='arial'><h4 style='align-items: center;' face='arial'>
												<h5>
													<b>Forma jurídica:</b> Persona Moral.<br>
													<b>Costo: </b>  {$montoEnvia} .<br><br>

													<b>Una vez obtengamos tu e-firma podremos analizar tu contabilidad con exactitud.
													<br> Esta cotización podría variar después del análisis por massiva.</b> 
													
												</h5>
												</font>
											</td>
										</tr>

										<tr><td><br></td></tr>

										<tr>
											<td colspan='2'>
												<font color='gray' face='arial'>El tiempo de análisis es de 1 a 2 días hábiles.<br>
												Se requiere el registro para realizar dicho análisis <a href='https://massiva.mx/'>clic aquí</a>

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
	                
	        } catch (Exception $e) {
	             $hola = '1';
	        }
			$rsptaLog = $simula->accionReenvio($usuarioSe,$fechaAccion);
			header ('location:../index.php?secc=contaAtrasadaFUno&EnviCo=1');
			
				
		break;

		/* eliminamos la cotizacion desde el dashboard */
		case "eliminar":
			$elimnmm = $simula->elimino($idContaAtrasada);
			if($elimnmm){
				$rsptaLog = $simula->accionElimina($usuarioSe,$fechaAccion);
				header ('location:../index.php?secc=contaAtrasadaFUno&EnviCo=2');
			}
		break;

		/* este reenvio para la autorizacion de los clientes con contabilidad atrasada*/
		case "reenviarDos":
			/* Aqui tenemos que generar el archivo para adjuintar */

			/* obtenemos la informacion guardada para el documento */
			$tresU = $simula->informacionContaa($rfcCoti);
			$tresUInfo = $tresU->fetch_object();
			$idContaAtrasadaEd = $tresUInfo->idContaAtrasada;
			$rfc = $tresUInfo->rfc;
			$nombre = $tresUInfo->nombre;
			$ape_paterno = $tresUInfo->ape_paterno;
			$ape_materno = $tresUInfo->ape_materno;
			$correo = $tresUInfo->correo;
			$periodo = $tresUInfo->periodo;
			/* dependiendo del resultado hacemos el nombre */
			if($periodo == 1){ $periodoFin = '1 año o menos';}
			if($periodo == 2){ $periodoFin = '2 años';}
			if($periodo == 3){ $periodoFin = '3 años';}
			if($periodo == 4){ $periodoFin = '4 años';}
			if($periodo == 5){ $periodoFin = '5 años';}
			if($periodo == 6){ $periodoFin = '5 a 10 años';}
			/* vemos que obligaciones estan registrada */
			$obligaciones = $tresUInfo->obligaciones;
			$porciones = explode(",", $obligaciones);
			$isr=  $porciones[0]; // porción1
			$iva = $porciones[1]; // porción2
			$diot =  $porciones[1]; // porción2
			
			$isr=  ($porciones[0] != '')? 'SI' : 'NO' ; // porción1
			$iva = ($porciones[1] != '')? 'SI' : 'NO' ; // porción1
			$diot =  ($porciones[2] != '')? 'SI' : 'NO' ; // porción1

			$cheInteres = ($tresUInfo->cheInteres > 0)? 'SI' : 'NO';
			$cheasalariado = ($tresUInfo->cheasalariado > 0)? 'SI' : 'NO';
			$chearrendamiento = ($tresUInfo->chearrendamiento > 0)? 'SI' : 'NO';
			$cheservicios = ($tresUInfo->cheservicios > 0)? 'SI' : 'NO';
			$cheempresaria = ($tresUInfo->cheempresaria > 0)? 'SI' : 'NO';
			$cherif = ($tresUInfo->cherif > 0)? 'SI' : 'NO';
			$monto = $tresUInfo->monto;
			$mesesin = ($tresUInfo->mesesin > 0)? $tresUInfo->mesesin : 'Pago Unico';
			
			/* teniendo todas las variables generamos el docuemnto */
			//creamos el pdf para mostrarlo despues
			$twxt = "<tr><td><br></td></tr><tr><td><br></td></tr>
				<table style='width: 100%' style='margin: 0 auto;'>
					<tr><td >Nuestro equipo de contadores después de un análisis y verificación de tu contabilidad atrasada a través del portal del SAT la cotización final quedaría de esta forma:<br></font></td></tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><b>  Nombre completo:</b> ".$nombre." ".$ape_paterno." ".$ape_materno."<br>
								<b>RFC:</b> ".$rfc."<br>
								<b>Periodos a regularizar:</b> ".$periodoFin."<br>
								<b>Oblicaciones pendientes:</b> ISR: ".$isr." | IVA: ".$iva." | DIOT: ".$diot."<br>
								<b>Régimen al que perteneces:</b> <br>
								INTERÉS: ".$cheInteres."<br>
								ASALARIADO: ".$cheasalariado."<br>
								ARRENDAMIENTO: ".$chearrendamiento."<br>
								SERVICIOS PROFESIONALES: ".$cheservicios."<br>
								ACTIVIDAD EMPRESARIAL: ".$cheempresaria."<br>
								RIF: ".$cherif."<br>
								<b>El monto final es:</b> $".$monto." pesos<br>
								<b>La forma de pago es:</b> ".$mesesin."
						</td>
					</tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td>Revisa a detalle si hubo algún cambio en esta nueva cotización respecto a la cotización que tu mismo realizaste a través de nuestro pre registro en massiva.mx.</td></tr>
					<tr><td><br><br></td></tr>
					<tr><td colspan='2'>Dicha cotización pudo haber cambiado, dependiendo de la verificación posterior de tu contabilidad en el portal del SAT.</td></tr>
					<tr><td><br><br></td></tr>
					<tr><td colspan='2'>Si no estás de acuerdo por favor ponte en contacto con nosotros en atencionclientes@massiva.mx reenviándonos esta misma cotización y la explicación del porqué no estás de acuerdo.</td></tr>
					<tr><td><br><br></td></tr>
					<tr><td colspan='2'>Si estás de acuerdo, dentro del correo electrónico que te enviamos ahora, da <a href='Aqui va el texto de la direccion a la que enviamos'>clic aquí</a>, autoriza dicha cotización y ¡listo! iniciaremos el trabajo para ponerte al día tu contabilidad en 5 a 7 días hábiles.</td>
					</tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><b>Atentamente,</b>El equipo de massiva<br><br></td></tr>
				</table>
				</div>";

			$pdf=new PDF_HTML();
			$pdf->AddPage('P', 'A4');
			$pdf->SetAutoPageBreak(true, 10);
			$pdf->SetFont('Arial', '', 10);
			$pdf->SetTopMargin(10);
			$pdf->SetLeftMargin(5);
			$pdf->SetRightMargin(5);

			/* --- Image --- */
			$pdf->Image('../img/logo.jpg', 70, 5, 70, 20);
			/* --- Cell --- */
			$pdf->SetXY(151, 35);
			$pdf->Cell(49, 6, 'Fecha: '.$fechaAccion2, 0, 1, 'L', false);
			$pdf->Cell(49, 6, '', 0, 1, 'L', false);
			/* --- MultiCell --- */
			$pdf->SetXY(10, 41);
			$pdf->WriteHTML($twxt);
			//$pdf->MultiCell(190, 236, $twxt, 0, 'L', false);
			$pdf->Output('../contenedor/clientes/'.$rfc.'/'.$rfc.'cotizacion_contabilidad_atrasada.pdf','F');

			/* Con estas lineas de codigo cambiamos los permisos de los archivos que se */
			//despues de crear el archivo le cambiamos los permisos
			$archivoCambiar = "../contenedor/clientes/".$rfc."/".$rfc."cotizacion_contabilidad_atrasada.pdf";
			// Asignamos todos los permisos al archivo
			chmod($archivoCambiar, 0755);

			/* Enviamos el correo */

			/* recuperamos el archivo recien generado */
			$sImagen = $archivoCambiar;
			
			/* genamos el correo para enviar y adjuntamos el documento */
			$hola = strip_tags($correEnvia);
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

					//archivo adjunto
					$mail->addAttachment($sImagen);

	                //Recipients
	                $mail->setFrom('atencionclientes@massiva.mx', 'Atención a clientes');
	                $mail->addAddress($hola, 'Cliente');     // Add a recipient
	                $mail->addAddress('atencionclientes@massiva.mx','Sistema');               // Name is optional
					$mail->addAddress('mrodriguez@massiva.mx','Sistema');               // Name is optional
					
					$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
						$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

	                //Content
	                $mail->CharSet = 'UTF-8';
	                $mail->isHTML(true);                                  // Set email format to HTML
	                $mail->Subject = 'Cotización de contabilidad atrasada massiva';
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
												<td colspan='2' style='align-content: center' face='arial' valign='middle'><img src='cid:cabeceraSuperior' width='500' height='210' style='display: block;'></td>
											</tr>
											<tr><td><br></td></tr>
										<tr>
											<td colspan='2' style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Resultado análisis de contabilidad atrasada<br></h1></font></td>
										</tr>

										<tr valign='middle'>
											<td colspan='2' style='align-content: center' face='arial' valign='middle'>
												<font face='arial'><h4 style='align-items: center;' face='arial'>
												<h5>
													<b>Adjuntamos el análisis final tras la verificación ante el SAT. <br>
												</h5>
												</font>
											</td>
										</tr>

										<tr><td><br></td></tr>

										<tr>
											<td colspan='2'>
												<font color='gray' face='arial'>Revisa los archivos adjuntos por si hubiera algún ajuste en tu cotización inicial.<br>
												Si estás de acuerdo, da <a href='https://app.massiva.mx/admin/atrasadaAutorizacion.php?dd=".$idUsuArio."'>clic aquí</a>. Si tienes dudas por favor escribe a atencionclientes@massiva.mx, reenviando este mismo correo.<br>
												Una vez que nos autorices este análisis, nuestro proceso para ponerte al día tarda de 5 a 7 días hábiles.
											</td>
										</tr>

										<tr><td></td></tr>
										<tr>
											<td colspan='2' style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td>
										</tr>
										<tr><td><br></td></tr>
												<tr>
												<br>
													<td colspan='2' style='align-content: center'><img src='cid:pieCorreo' width='500' height='210' style='display: block;'></td>
												</tr>
									</table>
									</div>
								</body>
								</html>";
	                //enviamos el correo
	                $mail->send();
					//redireccionamos a la pagina para enviar mensaje
					/*
						esta es la direccion para autorizar
						https://massiva.mx/panel/admin/atrasadaAutorizacion.php
					*/

	        } catch (Exception $e) {
	             $hola = '1';
			}
			/* guardamos la accion de eveneto */
			$rsptaLog = $simula->accionReenvio($usuarioSe,$fechaAccion);
			/* cambiamos el status de la cotizacion por 4 en espera de validacion */
			$rsptaLog2 = $simula->estatusEspera($idContaAtrasadaEd);
			header ('location:../index.php?secc=contaAtrasadaFDos&EnviCo=3');

		break;

		/* aqui editamos y enviamos la cotizacion al cliente */
		case "editaCotiEnvia":
			/* capturamos las nuevas variables */
			$montoCal = ($_POST['montoCal'] == '')? '' : $_POST['montoCal'];
			$periodoRegu = ($_POST['periodoRegu'] == '')? '' : $_POST['periodoRegu'];
			/* aqui obtenemos los valores de obligaciones */
			$obliga = ($_POST['obliga'] == '')? '' : $_POST['obliga'];
			$num = count($obliga);
			for($n=0; $n == $num; $n++){
				$valorFinal .= $obliga[$n].',';
			}

			$cheInteres = ($_POST['cheInteres'] == '')? '0' : $_POST['cheInteres'];
			$cheasalariado = ($_POST['cheasalariado'] == '')? '0' : $_POST['cheasalariado'];
			$chearrendamiento = ($_POST['chearrendamiento'] == '0')? '' : $_POST['chearrendamiento'];
			$cheservicios = ($_POST['cheservicios'] == '')? '0' : $_POST['cheservicios'];
			$cheempresaria = ($_POST['cheempresaria'] == '')? '0' : $_POST['cheempresaria'];
			$cherif = ($_POST['cherif'] == '')? '0' : $_POST['cherif'];
			$estatus = 2;
			$creado = 3; // 1 = atencion al cliente || 2 = usuario || 3 = contador
						
			$idContaAtrasadaEdi = ($_POST['idContaAtrasadaEdi'] == '')? '' : $_POST['idContaAtrasadaEdi'];
			$refcEd= $_POST['refcEd'];
			$correEnvia= $_POST['correEnvia'];
			$idUsuArio = ($_POST['idUsuArio'] == '')? '' : $_POST['idUsuArio'];
			
			/* creamos la carpeta de archivos sat */
			mkdir("../contenedor/clientes/".$refcEd."/archivosSat/", 0755);

			/* subimos el archivo que suba el contador */
			$nombre_archivo_1 = "multasRecargo_".$_FILES['documento']['name'];
			$uploaddir_1 = "../contenedor/clientes/".$refcEd."/archivosSat/";
			$directorio_1 = $uploaddir_1.basename($nombre_archivo_1);
			move_uploaded_file($_FILES["documento"]["tmp_name"], $directorio_1);

			/* teniendo los valores actualizamos la cotizacion */
			$rspta = $simula->editaContaatrad($periodoRegu,$valorFinal,$cheInteres,$cheasalariado,$chearrendamiento,$cheservicios,$cheempresaria,$cherif,$estatus,$creado,$montoCal,$idContaAtrasadaEdi,$nombre_archivo_1);	

			/* despues de actualizar el archivo procedemos a crear el archivo */
			$tresU = $simula->informacionContaa($refcEd);
			$tresUInfo = $tresU->fetch_object();
			$idContaAtrasadaEd = $tresUInfo->idContaAtrasada;
			$rfc = $tresUInfo->rfc;
			$nombre = $tresUInfo->nombre;
			$ape_paterno = $tresUInfo->ape_paterno;
			$ape_materno = $tresUInfo->ape_materno;
			$correo = $tresUInfo->correo;
			$periodo = $tresUInfo->periodo;
			/* dependiendo del resultado hacemos el nombre */
			if($periodo == 1){ $periodoFin = '1 año o menos';}
			if($periodo == 2){ $periodoFin = '2 años';}
			if($periodo == 3){ $periodoFin = '3 años';}
			if($periodo == 4){ $periodoFin = '4 años';}
			if($periodo == 5){ $periodoFin = '5 años';}
			if($periodo == 6){ $periodoFin = '5 a 10 años';}
			/* vemos que obligaciones estan registrada */
			$obligaciones = $tresUInfo->obligaciones;
			$porciones = explode(",", $obligaciones);
			$isr=  $porciones[0]; // porción1
			$iva = $porciones[1]; // porción2
			$diot =  $porciones[1]; // porción2
			
			$isr=  ($porciones[0] != '')? 'SI' : 'NO' ; // porción1
			$iva = ($porciones[1] != '')? 'SI' : 'NO' ; // porción1
			$diot =  ($porciones[2] != '')? 'SI' : 'NO' ; // porción1

			$cheInteres = ($tresUInfo->cheInteres > 0)? 'SI' : 'NO';
			$cheasalariado = ($tresUInfo->cheasalariado > 0)? 'SI' : 'NO';
			$chearrendamiento = ($tresUInfo->chearrendamiento > 0)? 'SI' : 'NO';
			$cheservicios = ($tresUInfo->cheservicios > 0)? 'SI' : 'NO';
			$cheempresaria = ($tresUInfo->cheempresaria > 0)? 'SI' : 'NO';
			$cherif = ($tresUInfo->cherif > 0)? 'SI' : 'NO';
			$monto = $tresUInfo->monto;
			$mesesin = ($tresUInfo->mesesin > 0)? $tresUInfo->mesesin : 'Pago Unico';
			
			/* teniendo todas las variables generamos el docuemnto */
			//creamos el pdf para mostrarlo despues
			$twxt = "<tr><td><br></td></tr><tr><td><br></td></tr>
				<table style='width: 100%' style='margin: 0 auto;'>
					<tr><td >Nuestro equipo de contadores después de un análisis y verificación de tu contabilidad atrasada a través del portal del SAT la cotización final quedaría de esta forma:<br></font></td></tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><b>  Nombre completo:</b> ".$nombre." ".$ape_paterno." ".$ape_materno."<br>
								<b>RFC:</b> ".$rfc."<br>
								<b>Periodos a regularizar:</b> ".$periodoFin."<br>
								<b>Oblicaciones pendientes:</b> ISR: ".$isr." | IVA: ".$iva." | DIOT: ".$diot."<br>
								<b>Régimen al que perteneces:</b> <br>
								INTERÉS: ".$cheInteres."<br>
								ASALARIADO: ".$cheasalariado."<br>
								ARRENDAMIENTO: ".$chearrendamiento."<br>
								SERVICIOS PROFESIONALES: ".$cheservicios."<br>
								ACTIVIDAD EMPRESARIAL: ".$cheempresaria."<br>
								RIF: ".$cherif."<br>
								<b>El monto final es:</b> $".$monto." pesos<br>
								<b>La forma de pago es:</b> ".$mesesin."
						</td>
					</tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td>Revisa a detalle si hubo algún cambio en esta nueva cotización respecto a la cotización que tu mismo realizaste a través de nuestro pre registro en massiva.mx.</td></tr>
					<tr><td><br><br></td></tr>
					<tr><td colspan='2'>Dicha cotización pudo haber cambiado, dependiendo de la verificación posterior de tu contabilidad en el portal del SAT.</td></tr>
					<tr><td><br><br></td></tr>
					<tr><td colspan='2'>Si no estás de acuerdo por favor ponte en contacto con nosotros en atencionclientes@massiva.mx reenviándonos esta misma cotización y la explicación del porqué no estás de acuerdo.</td></tr>
					<tr><td><br><br></td></tr>
					<tr><td colspan='2'>Si estás de acuerdo, dentro del correo electrónico que te enviamos ahora, da <a href='Aqui va el texto de la direccion a la que enviamos'>clic aquí</a>, autoriza dicha cotización y ¡listo! iniciaremos el trabajo para ponerte al día tu contabilidad en 5 a 7 días hábiles.</td>
					</tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><br></td></tr>
					<tr><td><b>Atentamente,</b>El equipo de massiva<br><br></td></tr>
				</table>
				</div>";

			$pdf=new PDF_HTML();
			$pdf->AddPage('P', 'A4');
			$pdf->SetAutoPageBreak(true, 10);
			$pdf->SetFont('Arial', '', 10);
			$pdf->SetTopMargin(10);
			$pdf->SetLeftMargin(5);
			$pdf->SetRightMargin(5);

			/* --- Image --- */
			$pdf->Image('../img/logo.jpg', 70, 5, 70, 20);
			/* --- Cell --- */
			$pdf->SetXY(151, 35);
			$pdf->Cell(49, 6, 'Fecha: '.$fechaAccion2, 0, 1, 'L', false);
			$pdf->Cell(49, 6, '', 0, 1, 'L', false);
			/* --- MultiCell --- */
			$pdf->SetXY(10, 41);
			$pdf->WriteHTML($twxt);
			//$pdf->MultiCell(190, 236, $twxt, 0, 'L', false);
			$pdf->Output('../contenedor/clientes/'.$rfc.'/'.$rfc.'cotizacion_contabilidad_atrasada.pdf','F');

			/* Con estas lineas de codigo cambiamos los permisos de los archivos que se */
			//despues de crear el archivo le cambiamos los permisos
			$archivoCambiar = "../contenedor/clientes/".$rfc."/".$rfc."cotizacion_contabilidad_atrasada.pdf";
			// Asignamos todos los permisos al archivo
			chmod($archivoCambiar, 0755);

			/* Enviamos el correo */

			/* recuperamos el archivo recien generado */
			$sImagen = $archivoCambiar;

			/* recuperamos el archivo que subio el contador */
			$nombre_archivo_1 = "../contenedor/clientes/".$refcEd."/archivosSat/multasRecargo_".$_FILES['documento']['name'];
			$sImagen2 = $nombre_archivo_1;


			/* genamos el correo para enviar y adjuntamos el documento */
			$hola = strip_tags($correEnvia);
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

					//archivo adjunto
					$mail->addAttachment($sImagen);
					$mail->addAttachment($sImagen2);

	                //Recipients
	                $mail->setFrom('atencionclientes@massiva.mx', 'Atención a clientes');
	                $mail->addAddress($hola, 'Cliente');     // Add a recipient
	                $mail->addAddress('atencionclientes@massiva.mx','Sistema');               // Name is optional
					$mail->addAddress('mrodriguez@massiva.mx','Sistema');               // Name is optional
					
					$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
					$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

	                //Content
	                $mail->CharSet = 'UTF-8';
	                $mail->isHTML(true);                                  // Set email format to HTML
	                $mail->Subject = 'Cotización de contabilidad atrasada massiva';
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
												<td colspan='2' style='align-content: center'><img src='cid:cabeceraSuperior' width='500' height='210' style='display: block;'></td>
											</tr>
											<tr><td><br></td></tr>
										<tr>
											<td colspan='2' style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Resultado análisis de contabilidad atrasada<br></h1></font></td>
										</tr>

										<tr valign='middle'>
											<td colspan='2' style='align-content: center' face='arial' valign='middle'>
												<font face='arial'><h4 style='align-items: center;' face='arial'>
												<h5>
													<b>Adjuntamos el análisis final tras la verificación ante el SAT. <br>
												</h5>
												</font>
											</td>
										</tr>

										<tr><td><br></td></tr>

										<tr>
											<td colspan='2'>
												<font color='gray' face='arial'>Revisa los archivos adjuntos por si hubiera algún ajuste en tu cotización inicial y por si tuvieras algún recargo o multa por el SAT, si así fuera deberás
												imprimir dicho acuse y pagarlo en cualquier banco o bien puedes pagarlo a través de tu banca digital.
												<br>
												Si estás de acuerdo, da <a href='https://app.massiva.mx/admin/atrasadaAutorizacion.php?dd=".$idUsuArio."'>clic aquí</a>. Si tienes dudas por favor escribe a atencionclientes@massiva.mx, reenviando este mismo correo.<br>
												Una vez que nos autorices este análisis, nuestro proceso para ponerte al día tarda de 5 a 7 días hábiles.
											</td>
										</tr>

										<tr><td></td></tr>
										<tr>
											<td colspan='2' style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td>
										</tr>
										<tr><td><br></td></tr>
												<tr>
												<br>
													<td colspan='2' style='align-content: center'><img src='cid:pieCorreo' width='500' height='210' style='display: block;'></td>
												</tr>
									</table>
									</div>
								</body>
								</html>";
	                //enviamos el correo
	                $mail->send();
					//redireccionamos a la pagina para enviar mensaje
					/*
						esta es la direccion para autorizar
						https://massiva.mx/panel/admin/atrasadaAutorizacion.php
					*/

	        } catch (Exception $e) {
	             $hola = '1';
			}
			/* guardamos la accion de eveneto */
			$rsptaLog = $simula->accionReenvio($usuarioSe,$fechaAccion);
			/* cambiamos el status de la cotizacion por 4 en espera de validacion */
			$rsptaLog2 = $simula->estatusEspera($idContaAtrasadaEd);
			header ('location:../index.php?secc=contaAtrasadaFDos&EnviCo=3');
			

		break;

		/* modificacion de autorizar o rechazar cotizacion */
		case "rechazacotizacion":
			/* obtenemos las variables */
			$estatus = $_POST['estatus'];
			$idContaAtrasada = $_POST['idContaAtrasada'];
			$dd = $_POST['dd'];
			/* cambiamos el estatus */
			$rsptaLog = $simula->cambioestatusAuto($estatus,$idContaAtrasada);
			if($estatus == 2){
				header ('location:../atrasadaAutorizacion.php?mov=1&dd='.$dd);
			}else{
				header ('location:../atrasadaAutorizacion.php?mov=2&dd='.$dd);
			}
		break;

		case "finalizaConta":
			$idContaAtrasadaEdi = $_POST['idContaAtrasadaEdi'];
			$refcEd = $_POST['refcEd'];
			$correEnvia = $_POST['correEnvia'];
			
			/* guardamos el archivo que finaliza */
			$nombre_archivo_1 = "documento_contabilidad_saneada_".$_FILES['documento']['name'];
			$uploaddir_1 = "../contenedor/clientes/".$refcEd."/archivosSat/";
			$directorio_1 = $uploaddir_1.basename($nombre_archivo_1);
			move_uploaded_file($_FILES["documento"]["tmp_name"], $directorio_1);

			/* actulizamos la cotizacion para finalizar */
			$rspta = $simula->finaCotia($idContaAtrasadaEdi,$nombre_archivo_1);	

			/* cambiamos el estatus  del usuario*/
			$rspta = $simula->camstatusfin($refcEd);	

			/* obtenemos los datos de clave y todo para enviar */
			$datosCorr = $simula->datosCorr($refcEd);
			$datosCorrInfo= $datosCorr->fetch_object();
			$rfcRUno = $rsptaConIfno->rfc;
			$clbe = $rsptaConIfno->clave;

			/* Enviamos el correo de finalizado */
			$hola = strip_tags($correEnvia);
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
	                $mail->addAddress('dsanchez@massiva.mx','Sistema');               // Name is optional
					$mail->addAddress('mrodriguez@massiva.mx','Sistema');               // Name is optional
					
					$mail->AddEmbeddedImage('../img/superiorMassiva.png', 'cabeceraSuperior');
						$mail->AddEmbeddedImage('../img/inferiorMassiva.png', 'pieCorreo');

	                //Content
	                $mail->CharSet = 'UTF-8';
	                $mail->isHTML(true);                                  // Set email format to HTML
	                $mail->Subject = 'Contabilidad al día';
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
													<td colspan='2'><img src='cid:pieCorreo' width='500' height='210' style='display: block;'></td>
													<td ><img src='cid:cabeceraSuperior' width='500' height='210' style='display: block;'></td>
										</tr>
										<tr><td><br></td></tr>
										<tr>
											<td colspan='2' style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Contabilidad al día<br></h1></font></td>
										</tr>
										<tr><td><br></td></tr>

										<tr>
											<td colspan='2'>
												<font color='gray' face='arial'>
												¡Felicidades! ya estás al día ante el SAT, ahora ya podrás acceder a tu perfil de massiva 
											</td>
										</tr>
										<tr><td></td></tr>
										<tr valign='middle'>
											<td colspan='2' style='align-content: center' face='arial' valign='middle'>
												<font face='arial'><h4 style='align-items: center;' face='arial'>
												<h5>
													<b>Usuario:</b> {$rfcRUno}<br>
													<b>Contraseña:</b> {$clbe}<br>
													<b>Liga de acceso: https://app.massiva.mx/</b><br>
												</h5>
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
													<td colspan='2'><img src='cid:pieCorreo' width='500' height='210' style='display: block;'></td>
												</tr>
									</table>
									</div>
								</body>
								</html>";
	                //enviamos el correo
	                $mail->send();
					//redireccionamos a la pagina para enviar mensaje
					/*
						esta es la direccion para autorizar
						https://massiva.mx/panel/admin/atrasadaAutorizacion.php
					*/

	        } catch (Exception $e) {
	             $hola = '1';
			}
			

			/* regresamos el mensaje de finalizacion */
			header ('location:../index.php?secc=contaAtrasadaFTres&EnviCoDOs=2');

		break;
 	}
?>