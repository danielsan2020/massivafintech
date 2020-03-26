<?php
header('Content-Type: text/html; charset=UTF-8');

echo '<div style="font-size: 12pt; color: #B40404; margin-bottom: 10px; margin-top: 8px; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'PROCESO DE TIMBRADO PARA "CANCELAR". CFDI VERSIÓN 3.2';
echo '</div>';   

### SE MUESTRA EL FOLIO FISCAL DEL CFDI A CANCELAR (OPCIONAL A MOSTRAR) #########################################
echo '<div style="font-size: 11pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'FOLIO FISCAL A CANCELAR:';
echo '</div>';
echo '<div style="font-size: 12pt; color: #0830D2; font-family: Verdana, Arial, Helvetica, sans-serif; margin-bottom: 10px;">';
echo $_GET["FolioFiscal"];
echo '</div>';


### SE MUESTRA EL FOLIO FISCAL DEL CFDI A CANCELAR (OPCIONAL A MOSTRAR) #########################################
echo '<div style="font-size: 11pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'No. DE FACTURA ASIGNADO POR EL SISTEMA LOCAL:';
echo '</div>';
echo '<div style="font-size: 12pt; color: #B71616; font-family: Verdana, Arial, Helvetica, sans-serif; margin-bottom: 10px;">';
echo $_GET["NoFact"];
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
   $NomArchCerPem     = "ACO560518KW7.cer.pem"; 
   $NomArchKeyPem     = "ACO560518KW7.key.pem"; 
   $NomArchKeyEncCert = "ACO560518KW7.key.enc.pem";
      
   $FolioFiscal = $_GET["FolioFiscal"]; // 2.5 Folio fiscal de CFDI a cancelar.
   $NoFact      = $_GET["NoFact"];

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

    if ($status===0){
        # Dar permisos de lectura y escritura (necesario en sistemas que se ejecuten en Linux).
        chmod($SendaPEMS.$NomArchKeyEncCert, 0777); //<-- Archivo encriptado resultante.

        echo '<div style="font-size: 11pt; color: #196B02; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
        echo '*** PROCESO DE ENCRIPTADO CORRECTO ***';
        echo '</div><br>';
    }else{
        echo '<div style="font-size: 11pt; color: #A70202; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
        echo '*** ERROR DE ENCRIPTACIÓN ***';
        echo '</div><br>';
    }


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
               <can1:string>$FolioFiscal</can1:string>
            </apps:uuids>
         </can:UUIDS>
         <can:username>$username</can:username>
         <can:password>$password</can:password>
         <can:taxpayer_id>$taxpayer_id</can:taxpayer_id>
         <can:cer>$cer_content</can:cer>
         <can:key>$key_content</can:key>
         <can:store_pending>T</can:store_pending>
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

    if (file_exists ($SendaCFDI."soap_cancel_".$NoFact.".xml")==true){
        unlink($SendaCFDI."soap_cancel_".$NoFact.".xml");
    }    

    #=== Guardando el SOAP =====================================================
    $NomArchSoap = $SendaCFDI."soap_cancel_".$NoFact.".xml";

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
                $domResp->save($SendaCFDI."RespServ_Cancel_".$NoFact.".xml");
                chmod($SendaCFDI."RespServ_Cancel_".$NoFact.".xml", 0777);
                

                ## TAG UUID ####################################################
                $tagUUID = $domResp->getElementsByTagName('EstatusUUID');

                foreach($tagUUID as $ObjTag ){
                    $ValorUUID = $ObjTag->nodeValue; // Código de error o acierto.
                }

                ## .XML ACUSE DE CANCELACIÓN ###################################
                $tagAcuse = $domResp->getElementsByTagName('Acuse');

                foreach($tagAcuse as $ObjTag ){
                    $contenido_del_nodo_acuse = $ObjTag->nodeValue; // Contiene todo un .XML
                }

                ### SE MUESTRA EL CONTENIDO .XML DEL ACUSE (OPCIONAL A MOSTRAR) #########################################
                echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
                echo 'XML DEL ACUSE DE CANCELACION';
                echo '</div>';
                echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
                echo htmlspecialchars($contenido_del_nodo_acuse);
                echo '</div><br>';
                

                ################################################################
                $CodResp = $ValorUUID;


                if($CodResp == 201 || $CodResp == "201" ){
                    # 201: UUID Cancelado Exitoso

                    ###### GUARDANDO EL .XML DEL ACUSE #############################
                    $xmlt = new DOMDocument();
                    $xmlt->loadXML($contenido_del_nodo_acuse);
                    $xmlt->save($SendaCFDI."Fact_CFDI_".$NoFact."_AcuseCancel.xml");
                    chmod($SendaCFDI."Fact_CFDI_".$NoFact."_AcuseCancel.xml", 0777);
                    unset($xmlt);
                    
                    
                    ### SE ASIGNA EL CONTENIDO DEL ACUSE A UNA VARIABLE DE TIPO DOM PARA LA LECTURA DE DATOS ####################
                    $DOM = new DOMDocument('1.0', 'utf-8');
                    $DOM->preserveWhiteSpace = FALSE;
                    $DOM->loadXML($contenido_del_nodo_acuse);

                    ### LECTURA DE ATRIBUTOS ###################################

                    #== Fecha de cancelación ===================================
                    $params = $DOM->getElementsByTagName('CancelaCFDResult');
                    foreach ($params as $param) {
                        $FecCanc = $param->getAttribute('Fecha');
                        echo 'Fecha de cancelación: <span style="color: #088A29;">'.$FecCanc.'</span><br>';
                    }

                    #== Sello digital del SAT (cancelación) ===========================
                    $nodoSignatureValue = $DOM->getElementsByTagName('SignatureValue');

                    foreach($nodoSignatureValue as $param){
                        $SelloCanc = $param->nodeValue;
                        echo 'Sello digital SAT: <span style="color: #088A29;">'.$SelloCanc.'</span><br><br><br><br><br>';
                    }
                }

                if($CodResp == 704 || $CodResp == "704"){
                    echo "<h1>Error con la contraseña de la llave privada</h1>";
                }

                if($CodResp == 708 || $CodResp == "708"){
                    echo "<h1>Error de conexion del SAT ....</h1>";
                }

                if($CodResp == 202 || $CodResp == "202"){
                    echo "<h1> 202: UUID Cancelado Previamente</h1>";
                }

                if($CodResp == 203 || $CodResp == "203"){
                    echo "<h1>203: UUID No corresponde el RFC del emisor y de quien solicita la cancelación</h1>";
                }

                if($CodResp == 205 || $CodResp == "205"){
                    echo "<h1>205: UUID No existente</h1>";
                }
           }

        curl_close($process);
        
        
        

### CÓDIGO HTML Y JAVASCRIPT PARA LA IMPRESIÓN Y DESCARGA DEL CFDI ###########################

echo '<input type="button" value="Descargar archivo .XML que contiene el SOAP"  onclick="DescargArchXMLSoap()" />';
echo '&nbsp;&nbsp;';

echo '<script type="text/javascript">';

    echo 'function DescargArchXMLSoap(){';
        echo 'window.open("descargar_xml_soap_cancel.php?NomArchXML=soap_cancel_'.$NoFact.'.xml","_blank");';
    echo '}';

echo '</script>';

echo '<br><br><br><br><br><br><br><br>';

#== Fin de la codificación HTML y JavaScript ======================================================        
        
