<?php
//session_start();
    error_reporting(E_ALL);
    ini_set('display_errors','1');
date_default_timezone_set("America/Mexico_City");
include '../modelo/formulariosPaginasWeb.php';
$paform = new paform();
    
//instanaciamos la funcion de php mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../plugins/phpmailer/Exception.php';
require '../plugins/phpmailer/PHPMailer.php';
require '../plugins/phpmailer/SMTP.php';
//variable para la accion
$fechaEnvio = date("Y-m-d H:i:s");
$accion = ($_POST['accion']== '')? 'N/A': $_POST['accion'];

//obtenemos del formulario de contacto
$Cnombre = (strip_tags($_POST['name2'])== '')? 'N/A': strip_tags($_POST['name2']);
$Cape = (strip_tags($_POST['apellidos2'])== '')? 'N/A': strip_tags($_POST['apellidos2']);
$Cmail = (strip_tags($_POST['correo2'])== '')? 'N/A': strip_tags($_POST['correo2']);
$cCel = (strip_tags($_POST['celular2'])== '')? 'N/A': strip_tags($_POST['celular2']);
$Cciudad = (strip_tags($_POST['ciudad2'])== '')? 'N/A': strip_tags($_POST['ciudad2']);
$cActi = (strip_tags($_POST['cActividad'])== '')? 'N/A': strip_tags($_POST['cActividad']);
$cMensaje = (strip_tags($_POST['message'])== '')? 'N/A': strip_tags($_POST['message']);
$nombreCompl = $Cnombre.$Cape;
////RECAPTCHA
$captcha = $_POST['g-recaptcha-response'];
$secret ='6LfdeZsUAAAAABM8wCuwoTlyC1MVXRJx-6bxMaKH';

////obtenemos los valores del fomrulario de llamada
$nombre = ($_POST['nombre']== '')? 'N/A': $_POST['nombre'];
$numero = ($_POST['numero']== '')? 'N/A': $_POST['numero'];
$asunto = ($_POST['asunto']== '')? 'N/A': $_POST['asunto'];

/////////////////realizamos la accion de solicitud de llamda

//Verificar si el reCaptcha fue seleccionado
if(!$captcha){
    echo "Por favor verifica el captcha";
    return;
}
//Optención de respuesta de API de google para validar el reCaptcha
$reponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
//Se codifica respuesta de google en Json.
$arr = json_decode($reponse, TRUE);

if($arr['success']){
    if($accion == 'nuevaLlamada'){
        $rspAhgre = $paform->agregoaalabsess($nombre,$numero,$asunto,$fechaEnvio);
       
            $mail = new PHPMailer(true);                              
            try {
                    //Server settings
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host = 'mail.massiva.mx'; 
                    $mail->SMTPAuth = true;
                    $mail->Username = 'plataforma@massiva.mx';
                    $mail->Password = 'Holalili11';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    //Recipients
                    $mail->setFrom('plataforma@massiva.mx', 'Plataforma');
                    $mail->addAddress('ahernandez@massiva.mx','aza');
                    $mail->addAddress('dsanchez@massiva.mx','daniel');
                    $mail->addAddress('atencionclientes@massiva.mx', 'AtenciónClientes');
                    
                    $mail->CharSet = 'UTF-8';
                    $mail->isHTML(true);
                    $mail->Subject = 'Solicitud de llamada del cliente';
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
                                        <td colspan='2' style='align-content: center' face='arial'>
                                        <font face='arial'><h1 style='align-items: center;' face='arial'>Un cliente ha solicitado una llamas de atención al cliente con los siguientes datos</h1></font>
                                        </td>
                                    </tr>
                                    <tr><td></td></tr>
                                    <tr><td><b><font face='arial'>Asunto:</b> {$nombre}</font><br></td></tr>
                                    <tr><td valign='middle'><b><font face='arial'>Nombre:</b> {$numero}</font><br></td></tr>
                                    <tr><td><b><font face='arial'>Numero:</b> {$asunto}</font><br></td></tr>
                                </table>
                                </div>
                            </body>
                            </html>";
                    //enviamos el correo
                    $mail->send();
                    return true;

            } catch (Exception $e) { return false; }
    }
}else{
    echo '<h3>Error al comprobar Captcha </h3>'
    return;
}



////////////////////////realizamois la accion del formulario de contacto
if($arr['success']){
    if ($accion == 'nuevocontracto') {

        //guardamos los datos en la base de datos
        $rspagrega = $paform->agrgg($Cnombre,$Cape,$Cmail,$cCel,$Cciudad,$cActi,$cMensaje,$fechaEnvio);    
      
            //creamos viriables para enviar por correo
            $mail = new PHPMailer(true);   
                                       
            try {//Server settings
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
                $mail->addAddress('atencionclientes@massiva.mx', 'Cliente');     // Add a recipient
                $mail->addAddress('dsanchez@massiva.mx','Recuperación de claves');               // Name is optional
                $mail->addAddress('ahernandez@massiva.mx','Recuperación de claves');               // Name is optional
                    
                    $mail->CharSet = 'UTF-8';
                    $mail->isHTML(true);
                    $mail->Subject = 'Formulario de contacto pagina web massiva.mx';
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
                                            <td colspan='2' style='align-content: center' face='arial'><font face='arial'><h1 style='align-items: center;' face='arial'>Formulario de contacto de pagina web</h1></font></td>
                                        </tr>
                                        <tr><td></td></tr>
                                        <tr><td><b><font face='arial'>Nombre:</b> {$nombreCompl}</font><br></td></tr>
                                        <tr><td valign='middle'><b><font face='arial'>Correo:</b> {$Cmail}</font><br></td></tr>
                                        <tr><td><b><font face='arial'>Celular:</b> {$cCel}</font><br></td></tr>
                                        <tr><td><b><font face='arial'>Ciudad:</b> {$Cciudad}</font><br></td></tr>
                                        <tr><td><b><font face='arial'>Actividad:</b> {$cActi}</font><br></td></tr>
                                        <tr><td><b><font face='arial'>Mensaje:</b> {$cMensaje}</font><br></td></tr>
                                    
                                    </table>
                                </div>
                            </body>
                            </html>";
                    //enviamos el correo
                    $mail->send();
                    header ('location:../../../index.php?contacto=1');
    
            } catch (Exception $e) { header ('location:../../../index.php?contacto=2'); }
        
    }
}else{
    echo '<h3>Error al comprobar Captcha </h3>'
    return;
}



