<?php
date_default_timezone_set("America/Mexico_City");
include '../modelo/recuperacion.php';
$consultaTabla = new recuperacion();

    
//instanaciamos la funcion de php mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../plugins/phpmailer/Exception.php';
require '../plugins/phpmailer/PHPMailer.php';
require '../plugins/phpmailer/SMTP.php';

//obtenemos la variable
$hola = (strip_tags($_POST['correo'])== '')? 'Vacio': strip_tags($_POST['correo']);
$fechaAccion = date("Y-m-d");

if($hola == 'vacio'){
    //regresamos si esta vacio
    header('Location: ../../recuperar.php?accion=2');
}else{
    //realizamos la consulta para obtener la informacion
    $rspTabla = $consultaTabla->recuperaCreden($hola);
    $rspTablaInfo = $rspTabla->fetch_object();
    $numeroCliente = $rspTablaInfo->id_usuario;
    
    if($rspTabla){
        //creamos viriables para enviar por correo
        $fechaEnvio = date("Y-m-d H:i:s");
        $usuario = $rspTablaInfo->usuario;
        $clave = $rspTablaInfo->clave;
        $nombre = $rspTablaInfo->nombre.$rspTablaInfo->ape_paterno.$rspTablaInfo->ape_materno;
        
        $mail = new PHPMailer(true);                              
        try {
                //Server settings
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'mail.massiva.mx'; 
                $mail->SMTPAuth = true;
                $mail->Username = 'recuperacion@massiva.mx';
                $mail->Password = 'Holalili11';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->AddEmbeddedImage('img/logo2.png', 'logo');

                //Recipients
                $mail->setFrom('recuperacion@massiva.mx', 'Recuperación de claves');
                $mail->addAddress($hola, 'Cliente');     // Add a recipient
                $mail->addAddress('dsanchez@massiva.mx','Recuperación de claves');               // Name is optional
                $mail->addAddress('recuperacion@massiva.mx','Recuperación de claves');               // Name is optional

                //para enviar archivos adjuntos
                /*$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name*/

                //Content
                $mail->CharSet = 'UTF-8';
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Formulario de requerimientos de clientes hevasoft';
                $mail->Body    = "
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
                                    <td colspan='2' style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Correo de recuperación de contraseña enviado</h1></font></td>
                                    <br>
                                </tr>
                                <tr>
                                    <td colspan='2'>
                                        <font color='gray' face='arial'>
                                        Estás recibiendo este mail porque recibimos desde massiva una petición de recuperación de contraseña.
                                        <br>
                                        </font>
                                    </td>
                                </tr>
                                <tr><td></td></tr>
                                <tr><td><b><font face='arial'>Número de usuario:</b> {$numeroCliente}</font><br></td></tr>
                                <tr><td valign='middle'><b><font face='arial'>Nombre:</b> {$nombre}</font><br></td></tr>
                                <tr><td><b><font face='arial'>Usuario:</b> {$usuario}</font><br></td></tr>
                                <tr><td><b><font face='arial'>Contraseña:</b> {$clave}</font><br></td></tr>
                                <tr valign='middle'>
                                    <td colspan='2' style='align-content: center' face='arial' valign='middle'><font face='arial'><h4 style='align-items: center;' face='arial'>Si no realizaste esta petición, te recomendamos que cambies tu contraseña inmediatamente o ponte en contacto con atención a clientes de massiva para apoyarte.</h4></font></td>
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
                //guardamos el log de envio de correo
                $rspLog = $consultaTabla->accionLogagrega($numeroCliente,$fechaAccion);
                //redireccionamos a la pagina para enviar mensaje
                if($rspLog){
                    header('Location: ../../recuperar.php?accion=1');
                }
        } catch (Exception $e) {
                header('Location: ../../recuperar.php?accion=3');
        }
    } 
}
