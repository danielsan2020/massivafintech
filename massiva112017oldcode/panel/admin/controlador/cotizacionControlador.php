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
    require_once "../modelo/cotizacionModelo.php";
    $cotiza = new cotiza();

	//*********************Variables generales***************************************//
    $fechaCreacion = date("Y-m-d");
    $id_usuario = $_SESSION['id_usuario'];
    $accion = $_POST['accion'];
    $rfc = $_SESSION['rfc'];
    $correo = $_SESSION['correo'];
    $nombreCompleto = $_SESSION['nombre']." ".$_SESSION['ape_paterno']." ".$_SESSION['ape_materno'];
    
    //obtenemos los valores para guardar datos y previsualizar
    $idCotizacion = ($_POST['idCotizacion'] == '')? '' : $_POST['idCotizacion'];
    $id_usuario = $id_usuario;
    $dirigido = $_POST['dirigido'];
    $lugarFecha = $_POST['lugarFecha'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $notas = $_POST['notas'];
    $correo1 = $_POST['correo1'];
    $correo2 = $_POST['correo2'];
    $usuarioCreacion = $id_usuario;
    $fechaCreacion = $fechaCreacion;
    $estatus = '1';  

    //valor para eliminar 
    $idElimina = ($_POST['idElimina'] == '')? '' : $_POST['idElimina'];

    //valor para enviar despues
    $iddespues = ($_POST['iddespues'] == '')? '' : $_POST['iddespues'];

    //valor para enviar ahora
    $idAhora = ($_POST['idAhora'] == '')? '' : $_POST['idAhora'];
    

    //en caso de que se la primera previzualizacion
    if($accion == 'Agrega'){
        $agreg = $cotiza->Agragr($id_usuario,$dirigido,$lugarFecha,$titulo,$descripcion,$notas,$correo1,$correo2,$usuarioCreacion,$fechaCreacion,$estatus);
        if($agreg){
            //agregamos el movimiento al log
            $moviLog = $cotiza->accionPrevizualizacion($id_usuario,$fechaCreacion);
            header('location:../index.php?secc=cotizacion&vacoti=1'); 
        }
    }
    

    //en caso de que se la segunda previzualizacion
    if($accion == 'EditaPre'){
        $EditaPrevi = $cotiza->EditaPrevi($dirigido,$lugarFecha,$titulo,$descripcion,$notas,$correo1,$correo2,$idCotizacion);
        if($EditaPrevi){
            //agregamos el movimiento al log
            $moviLog = $cotiza->accionAcutaliz($id_usuario,$fechaCreacion);
            header('location:../index.php?secc=cotizacion&vacoti=1'); 
        }
    }

    //en caso que la accion se de eliminar
    if($accion == 'cancelar'){

        //primero borramos el archivo que esta en la carpeta
        $archivoBorro = "../contenedor/clientes/".$rfc."/cotizaciones/".$idElimina."_cotizacion.pdf";
        unlink($archivoBorro);

        $elimina = $cotiza->eliminar($idElimina);
        if($elimina){
            //agregamos el movimiento al log
            $moviLog = $cotiza->accioncancela($id_usuario,$fechaCreacion);
            header('location:../index.php?secc=cotizacion&vacoti=4'); 
        }
    }

    //en caso de que la cotizacion la quieran enviar despues
    if($accion == 'despues'){

        $guarda = $cotiza->guardodespues($iddespues);
        if($guarda){
            //agregamos el movimiento al log
            $moviLog = $cotiza->acciondespues($id_usuario,$fechaCreacion);
            header('location:../index.php?secc=cotizacion&vacoti=2'); 
        }
    }

     //en caso de que la cotizacion la quieran enviar ahora
    if($accion == 'ahora'){

        $guarda = $cotiza->guardoAhora($idAhora);

        if($guarda){
            //obtenemos la informacion de la cotizacion
            $rspCate = $cotiza->obtenemosinfocoti($idAhora);
            $rspCateInfo = $rspCate->fetch_object();
            //obtenemos los valores
            $idCotizacion = $rspCateInfo->idCotizacion;
            $id_usuario = $rspCateInfo->id_usuario;
            $dirigido = $rspCateInfo->dirigido;
            $lugarFecha = $rspCateInfo->lugarFecha;
            $titulo = $rspCateInfo->titulo;
            $descripcion = $rspCateInfo->descripcion;
            $notas = $rspCateInfo->notas;
            $correo1 = $rspCateInfo->correo1;
            $correo2 = ($rspCateInfo->correo2 == '')? 'cotizaciones@massiva.mx' : $rspCateInfo->correo2;

            $hola1 = strip_tags($correo1);
            $hola2 = strip_tags($correo2);
            //obtenemos el archivo
            $archivo = "contenedor/clientes/".$rfc."/cotizaciones/". $idCotizacion."_cotizacion.pdf";
            //enviamos el correo con la cotizacion
            $mail = new PHPMailer(true);                                                         
                try {
                    //Server settings
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = 'mail.massiva.mx'; 
                    $mail->SMTPAuth = true;
                    $mail->Username = 'noreply@massiva.mx';
                    $mail->Password = 'noreply2019';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->AddEmbeddedImage('img/logo2.jpeg', 'logo');

                    //Recipients
                    $mail->setFrom('noreply@massiva.mx', 'Cotizaciones massiva');
                    $mail->addAddress($hola1, 'Cliente');     // Add a recipient
                    $mail->addAddress($hola2, 'Cliente');
                    

                    //adjuntamos el archivo
                    $mail->addAttachment($archivo);
                    //Content
                    $mail->CharSet = 'UTF-8';
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Recibiste una cotización de un colaborador ';
                    $mail->Body = "
                             <!DOCTYPE html>
                                <html lang='es'>
                                <head>
                                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/> 
                                </head>
                                <body>
                                    <div style='text-align:center;'>
                                    <table style='width: 20%'>
                                        <tr>
                                            <td><img src='cid:logo' style='height: 50px; width: 50px;'></td>
                                        </tr>
                                    </table>
                                    <table style='width: 100%' style='margin: 0 auto;'>
                                        <tr>
                                            <td colspan='2' style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Cotización<br></h1></font></td>
                                        </tr>
                                        
                                        <tr>
                                            <td colspan='2'>
                                                <font color='gray' face='arial'>Revisa la cotización adjunta que te envió tu colaborador:
                                            </td>
                                        </tr>

                                        <tr valign='middle'>
                                            <td colspan='2' style='align-content: center' face='arial' valign='middle'>
                                                <font face='arial'><h4 style='align-items: center;' face='arial'>
                                                <h5>
                                                    <b>{$nombreCompleto}</b><br>
                                                </h5>
                                                </font>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan='2'>
                                                <font color='gray' face='arial'>Si requieres responder a esta cotización o ponerte en contacto con el, escribe a:</font><br>
                                                {$correo}
                                            </td>
                                        </tr>
                                        
                                        <tr><td></td></tr>
                                        <tr>
                                            <td colspan='2' style='align-content: center' face='arial' valign='middle'><font face='arial' color='gray'><small face='arial'>Atentamente.<br>El equipo de massiva</small></font></td>
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
                        
                } catch (Exception $e) { $hola = '1'; }

            //agregamos el movimiento al log
            $moviLog = $cotiza->accionAhora($id_usuario,$fechaCreacion);
            header('location:../index.php?secc=cotizacion&vacoti=3'); 
        }
    }
    

