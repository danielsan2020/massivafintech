<?php
header('Content-Type: text/html; charset=UTF-8');

echo '<div style="font-size: 12pt; color: #B40404; margin-bottom: 10px; margin-top: 8px; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'PROCESO DE TIMBRADO PARA "CANCELAR" CON ACEPTACIÓN.';
echo '</div>';   


   ### 2. ASIGNACIÓN DE VALORES A VARIABLES ####################################
   $SendaPEMS  = "archs_pem/";  // 2.1 Directorio en donde se encuentran los archivos *.cer.pem y *.key.pem
   $SendaCFDI  = "archs_cfdi/"; // 2.2 Directorio en donde se almacenarán los archivos *.xml
   $SendaGRAFS = "archs_graf/"; // 2.3 Directorio en donde se almacenan los archivos .jpg (logo de la empresa) y .png (códigos bidimensionales).
   $SendaXSD   = "archs_xsd/";  // 2.4 Directorio en donde se almacenan los archivos .xsd (esquemas de validación);
   $contenido_del_nodo_acuse = "";
   $ValorUUID = "";

    #== RFC del contribuyente (emisor) =========================================
    $taxpayer_id = "TCM970625MB1";

   // Nombres de archivos. 
   $NomArchCerPem     = "TCM970625MB1.cer.pem"; 
   $NomArchKeyPem     = "TCM970625MB1.key.pem"; 
   $NomArchKeyEncCert = "TCM970625MB1.key.enc.pem";
      
      // Datos del CFDI a cancelar.
   $UUID   = $_GET["UUID"];   // Folio fiscal del CFDI a cancelar.
   $NoFac  = $_GET["NoFac"];  // No. de factura.

   
   // Datos de acceso del usuario.
   $username = $_GET["UserName"];
   $password = $_GET["PassWord"];


    ### MUESTRA LOS DATOS DEL USUARIO QUE ESTÁ TIMBRANDO (OPCIONAL A MOSTRAR) ######
    echo '<div style="font-size: 10pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'DATOS DEL USUARIO QUE ESTÁ TIMBRANDO.';
    echo '</div>';
    echo '<div style="font-size: 10pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'USUARIO: <span style="color: #088A29; font-size: 11pt;">'.$username."</span><br>";
    echo 'PASSWORD: <span style="color: #088A29; font-size: 11pt;">'.$password."</span><br>";
    echo '</div><br>';       
   
    #== Obtener el certificado del archivo .cer.pem ============================
    $cer_path = $SendaPEMS.$NomArchCerPem;
    $cer_file = fopen($cer_path, "r");
    $cer_content = fread($cer_file, filesize($cer_path));


    #== Se muetra el certificado (opcional) ====================================
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'CERTIFICADO DEL ARCHIVO .CER';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo htmlspecialchars($cer_content);
    echo '</div><br>';


    #== Conviritien el contenido del certificado a BASE 64 y asignarlo a una variable ======
    $cer_content = base64_encode($cer_content);
    fclose($cer_file);


        #== Encriptar con DES3 =====================================================

        $ArchivoKeyPem = $SendaPEMS.$NomArchKeyPem; //<-- Archivo .key.pem SIN encriptar.
        $ArchivoKeyEncripPem = $SendaPEMS.$NomArchKeyEncCert; //<-- Archivo .key.pem ENCRIPTADO.

        $Comando_Encriptar = "rsa -in '$ArchivoKeyPem' -des3 -out '$ArchivoKeyEncripPem' -passout pass:".$password;
        exec('openssl '.$Comando_Encriptar, $arr, $status); //<-- Se ejecuta el comando para encriptar.

//        if ($status==0){
//            # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
//            chmod($SendaPEMS.$NomArchKeyEncCert, 0777); //<-- Archivo encriptado resultante.
//
//            echo '<div style="font-size: 11pt; color: #196B02; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
//            echo '*** PROCESO DE ENCRIPTADO CORRECTO ***';
//            echo '</div><br>';
//        }else{
//            echo '<div style="font-size: 11pt; color: #A70202; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
//            echo '*** ERROR DE ENCRIPTACIÓN ***';
//            echo '</div><br>';
//        }
    
    
    #== Obtener contenido de archivo .key.pem ==================================
    $key_path = $SendaPEMS.$NomArchKeyEncCert;
    $key_file = fopen($key_path, "r");
    $key_content = fread($key_file, filesize($key_path));


    #== Se muetra el certificado (opcional) ====================================
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'CERTIFICADO DEL ARCHIVO .KEY';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo htmlspecialchars($key_content);
    echo '</div><br>';


    $key_content = base64_encode($key_content);
    fclose($key_file);


//== Creando el SOAP de envío ==================================================
$Cadena = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:can="http://facturacion.finkok.com/cancel" xmlns:apps="apps.services.soap.core.views" xmlns:can1="http://facturacion.finkok.com/cancellation">
   <soapenv:Header/>
   <soapenv:Body>
      <can:cancel>
         <can:UUIDS>
            <apps:uuids>
               <can1:string>$UUID</can1:string>
            </apps:uuids>
         </can:UUIDS>
         <can:username>$username</can:username>
         <can:password>$password</can:password>
         <can:taxpayer_id>$taxpayer_id</can:taxpayer_id>
         <can:cer>$cer_content</can:cer>
         <can:key>$key_content</can:key>
         <can:store_pending>TRUE</can:store_pending>
      </can:cancel>
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

    if (file_exists ($SendaCFDI."soap_cancel_".$NoFac.".xml")==true){
        unlink($SendaCFDI."soap_cancel_".$NoFac.".xml");
    }    

    #=== Guardando el SOAP =====================================================
    $NomArchSoap = $SendaCFDI."soap_cancel_".$NoFac.".xml";

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

        $err = 0;

        if (!$RespServ){
                  echo "<h1>Error: ".$RespServ."</h1><br>";
        	  return(curl_error($process));
           }else{

                #### DATOS DEVUELTOS POR EL SERVIDOR DE FINKOK #################
                $domResp = new DOMDocument();
                $domResp->loadXML($RespServ);
                
                // Se guarda la respuesta del servidor
                $domResp->save($SendaCFDI."RespServ_Cancel_".$NoFac.".xml");
                chmod($SendaCFDI."RespServ_Cancel_".$NoFac.".xml", 0777);

                ################################################################

                $Fecha              = $domResp->getElementsByTagName("Fecha")->item(0)->nodeValue;
                $RfcEmisor          = $domResp->getElementsByTagName("RfcEmisor")->item(0)->nodeValue;
                $EstatusUUID        = $domResp->getElementsByTagName("EstatusUUID")->item(0)->nodeValue;
                $EstatusCancelacion = $domResp->getElementsByTagName("EstatusCancelacion")->item(0)->nodeValue;
                $UUID               = $domResp->getElementsByTagName("UUID")->item(0)->nodeValue;

                echo '<div style="font-size: 14pt; line-height: 30px; margin-bottom: 300px;">';
                echo '<span style=" color: #000099;">EstatusUUID:</span> <span style=" color: #A70202;">' . $EstatusUUID.'</span><br>';
                echo '<span style=" color: #000099;">EstatusCancelacion:</span> ' . $EstatusCancelacion.'<br>';
                echo '<span style=" color: #000099;">Fecha:</span> ' . $Fecha.'<br>';
                echo '<span style=" color: #000099;">RFC Emisor:</span> ' . $RfcEmisor.'<br>';
                echo '<span style=" color: #000099;">UUID:</span> ' . $UUID;
                echo '</div>';
           }

        curl_close($process);
        
        

