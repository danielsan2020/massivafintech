<?php
header('Content-Type: text/html; charset=UTF-8');
include ("class.phpmailer.php");

### CÓDIGO FUENTE, ENVIO DE E-MAIL CON EL CFDI ADJUNTO (ARCHIVOS .XML Y .PDF).

echo '<div style="font-size: 12pt; color: #B40404; margin-bottom: 10px; margin-top: 8px; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'PROCESO PARA EL ENVIO DE E-MAIL CON EL CFDI ADJUNTO (ARCHIVOS .XML Y .PDF)';
echo '</div>';    
echo "<hr size=2 color=blue >";

### 1. CONFIGURACIÓN INICIAL ######################################################
$NomArchXML     = "CFDI_33_Factura_A9303.pdf";
$NomArchPDF     = "CFDI_33_Factura_A9303.xml";
$NoFact         = "A9303";
$Email_Receptor = "reneruedatorres@hotmail.com";

### ARCHIVO .XML DEL CFDI A ENVIAR (OPCIONAL A MOSTRAR) #########################################
echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'ARCHIVO .XML A ENVIAR:';
echo '</div>';
echo '<div style="font-size: 12pt; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; margin-bottom: 10px;">';
echo $NomArchXML;
echo '</div>';

### ARCHIVO .PDF DEL CFDI A ENVIAR (OPCIONAL A MOSTRAR) #########################################
echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'ARCHIVO .PDF A ENVIAR';
echo '</div>';
echo '<div style="font-size: 12pt; color: #00000; font-family: Verdana, Arial, Helvetica, sans-serif; margin-bottom: 10px;">';
echo $NomArchPDF;
echo '</div>';

### E-MAILS DESTINATARIOS QUE RECIBIRAN EL CFDI (ARCHIVOS .XML Y .PDF). (OPCIONAL A MOSTRAR) #########################################
echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'E-MAIL DESTINATARIO.';
echo '</div>';
echo '<div style="font-size: 12pt; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; margin-bottom: 10px;">';
echo $EmailDest."<br>";
echo '</div>';
echo "<hr size=2 color=blue >";


//== 2. Envío a e-mail's mediante la librería PHPMailer. ==================

$Host         = "www.puntodeventaweb.com.mx";
$Email_Emisor = "facturacion@puntodeventaweb.com.mx";
$NombreEmisor = "Factura: ".$NoFact;
$Asunto       = 'Envío de CFDI.';

$CodHTML = '';
$CodHTML .= '<div style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12pt; color:#5C5C5C; margin-left: 10px; margin-top: 15px;">Se adjuntan archivos .XML y .PDF de la factura electrónica.</div>';

$email = new PHPMailer();
$email->IsHTML(true);
$email->CharSet = "UTF-8";
$email->host = $Host;
$email->From = $Email_Emisor;
$email->AddAddress($Email_Receptor); // E-mail del receptor.

$email->FromName = $NombreEmisor;
$email->Subject  = $Asunto;
$email->Body     = $CodHTML;
$email->AddAttachment($NomArchPDF); // Se adjunta el archivo .PDF
$email->AddAttachment($NomArchXML); // Se adjunta el archivo .XML

$email->WordWrap = 50;
$email->Send(); // Se envía el correo electrónico ya con los archivos adjuntos .XML y .PDF (CFDI).
    
    
//======================================================================

echo '<div style="font-size: 11pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'ARCHIVO .PDF Y .XML DEL CFDI CORRESPONDIENTE A LA FACTURA No. <span style="color: #A70202; font-size: 13pt;">'.$NoFact.'</span> CORRECTAMENTE ENVIADOS.';
echo '</div>';
