<?php
header('Content-Type: text/html; charset=UTF-8');

echo '<div style="font-size: 12pt; color: #000000; margin-bottom: 10px; margin-top: 8px; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'PROCESO DE VERIFICACIÓN DE FORMA POSIBLE DE CANCELACIÓN Y STATUS DE UN CFDI.';
echo '</div>';   


   ### 2. ASIGNACIÓN DE VALORES A VARIABLES ####################################
   $SendaPEMS  = "archs_pem/";  // 2.1 Directorio en donde se encuentran los archivos *.cer.pem y *.key.pem
   $SendaCFDI  = "archs_cfdi/"; // 2.2 Directorio en donde se almacenarán los archivos *.xml
   $SendaGRAFS = "archs_graf/"; // 2.3 Directorio en donde se almacenan los archivos .jpg (logo de la empresa) y .png (códigos bidimensionales).
   $SendaXSD   = "archs_xsd/";  // 2.4 Directorio en donde se almacenan los archivos .xsd (esquemas de validación);
   $contenido_del_nodo_acuse = "";
   $ValorUUID = "";

    #== RFC del contribuyente (emisor) =========================================
    $taxpayer_id = "ACO560518KW7";

   // Nombres de archivos. 
   $NomArchCerPem     = "TCM970625MB1.cer.pem"; 
   $NomArchKeyPem     = "TCM970625MB1.key.pem"; 
   $NomArchKeyEncCert = "ACO560518KW7.key.enc.pem";
   
   $RFC_Emisor = "TCM970625MB1";
   $RFC_Receptor = "AAD990814BP7";
   
   // Datos del CFDI a cancelar.
   $UUID   = $_GET["UUID"];   // Folio fiscal del CFDI a cancelar.
   $ImpTot = $_GET["ImpTot"]; // Importe total del CFDI a cancelar.
   $NoFac  = $_GET["NoFac"];  // No. de factura.
   
   // Datos de acceso del usuario.
   $username = $_GET["UserName"];
   $password = $_GET["PassWord"];


### MUESTRA LOS DATOS DEL USUARIO QUE ESTÁ TIMBRANDO (OPCIONAL A MOSTRAR) ######
echo '<div style="font-size: 10pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'DATOS DEL CFDI A CANCELAR.';
echo '</div>';
echo '<div style="font-size: 10pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'UUID: <span style="color: #A70202; font-size: 11pt;">'.$UUID."</span><br>";
echo 'IMPORTE TOTAL: <span style="color: #A70202; font-size: 11pt;">'.$ImpTot."</span><br>";
echo '</div><br>';       
   
   
### MUESTRA LOS DATOS DEL USUARIO QUE ESTÁ TIMBRANDO (OPCIONAL A MOSTRAR) ######
echo '<div style="font-size: 10pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'DATOS DEL USUARIO QUE ESTÁ TIMBRANDO.';
echo '</div>';
echo '<div style="font-size: 10pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'USUARIO: <span style="color: #088A29; font-size: 11pt;">'.$username."</span><br>";
echo 'PASSWORD: <span style="color: #088A29; font-size: 11pt;">'.$password."</span><br>";
echo '</div><br>';       

//== Creando el SOAP de envío ==================================================
$Cadena = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:can="http://facturacion.finkok.com/cancel">
   <soapenv:Header/>
   <soapenv:Body>
      <can:get_sat_status>
         <can:username>$username</can:username>
         <can:password>$password</can:password>
         <can:taxpayer_id>$RFC_Emisor</can:taxpayer_id>
         <can:rtaxpayer_id>$RFC_Receptor</can:rtaxpayer_id>
         <can:uuid>$UUID</can:uuid>
         <can:total>$ImpTot</can:total>
      </can:get_sat_status>
   </soapenv:Body>
</soapenv:Envelope>      
XML;


    #== Se muestra el contenido del SOAP de envío (opcional)====================================================
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'CONTENIDO DEL SOAP QUE SE ENVIA AL SERVIDOR DEL PAC';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo htmlspecialchars($Cadena);
    echo '</div><br>';

    if (file_exists ($SendaCFDI."soap_get_sat_status.xml")==true){
        unlink($SendaCFDI."soap_get_sat_status_".$NoFac.".xml");
    }    

    #=== Guardando el SOAP =====================================================
    $NomArchSoap = $SendaCFDI."soap_get_sat_status_".$NoFac.".xml";

    $fp = fopen($NomArchSoap,"a");
    fwrite($fp, $Cadena);
    fclose($fp);

    #== Dando permisoso de lectura/escritura al archivo .XML del SOAP ==========
    chmod($NomArchSoap, 0777);

    ### URL PRUEBAS ########################################################
    $process = curl_init('https://demo-facturacion.finkok.com/servicios/soap/cancel.wsdl');

    ### URL PRODUCCION #####################################################
    // $process = curl_init('https://facturacion.finkok.com/servicios/soap/cancel.wsdl');

    curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Type: text/xml',' charset=utf-8'));
    curl_setopt($process, CURLOPT_POSTFIELDS,$Cadena);
    curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($process, CURLOPT_POST, true);
    curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);
    $RespServ = curl_exec($process);

    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'RESPUESTA DEL SERVIDOR DEL PAC';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo htmlspecialchars($RespServ);
    echo '</div><br>';

    // =====================================================================

    $NomArchRespStatusCancel = "Resp_Solicit_StatusCancel_$NoFac.xml";

    $file = fopen($SendaCFDI.$NomArchRespStatusCancel, "w");
    fwrite($file, $RespServ . PHP_EOL);
    fclose($file);
    chmod($SendaCFDI.$NomArchRespStatusCancel, 0777);     

    $err = 0;

    if (!$RespServ){
        echo "<h1>Error: ".$RespServ."</h1><br>";
        return(curl_error($process));
    }else{

        // En este punto se leen los datos guardados en el archivo .XML 

        $xml = file_get_contents($SendaCFDI.$NomArchRespStatusCancel);

        $DOM = new DOMDocument('1.0', 'utf-8');
        $DOM->preserveWhiteSpace = FALSE;
        $DOM->loadXML($xml);

        $EsCancelable = $DOM->getElementsByTagName("EsCancelable")->item(0)->nodeValue;
        $CodigoEstatus = $DOM->getElementsByTagName("CodigoEstatus")->item(0)->nodeValue;
        $Estado = $DOM->getElementsByTagName("Estado")->item(0)->nodeValue;

        echo '<div style="font-size: 14pt; line-height: 30px;">';
        echo '<span style=" color: #000099;">Status cancelabe:</span> ' . $EsCancelable.'<br>';
        echo '<span style=" color: #000099;">Código estatus:</span> ' . $CodigoEstatus.'<br>';
        echo '<span style=" color: #000099;">Estado:</span> ' . $Estado;
        echo '</div>';
    }

    curl_close($process);
        
        

