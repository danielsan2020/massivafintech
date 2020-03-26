<?php
header('Content-Type: text/html; charset=UTF-8');
include("qrlib/qrlib.php");

### CÓDIGO FUENTE, FACTURACIÓN ELECTRÓNICA CFDI VERSIÓN 3.3 ACORDE A LOS REQUIRIMIENTOS DEL SAT, ANEXO 20.

echo '<div style="font-size: 12pt; color: #B40404; margin-bottom: 10px; margin-top: 8px; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'PROCESO DE TIMBRADO DE CFDI 3.3 DE RECEPCIÓN DE PAGOS';
echo '</div>';    

### 1. CONFIGURACIÓN INICIAL ###################################################

    # 1.1 Configuración de zona horaria
    date_default_timezone_set('America/Mexico_City'); // 

    # 1.2 Muestra la zona horaria predeterminada del servidor (opcional a mostrar)
    echo '<div style="font-size: 10pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'ZONA HORARIA PREDETERMINADA';
    echo '</div>';
    
    echo '<div style="font-size: 10pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo date_default_timezone_get();
    echo '</div><br>';


### 2. ASIGNACIÓN DE VALORES A VARIABLES ###################################################
    $SendaPEMS  = "archs_pem/";   // 2.1 Directorio en donde se encuentran los archivos *.cer.pem y *.key.pem (para efectos de demostración se utilizan los que proporciona el SAT para pruebas).
    $SendaCFDI  = "archs_cfdi/";  // 2.2 Directorio en donde se almacenarán los archivos *.xml (CFDIs).
    $SendaGRAFS = "archs_graf/";  // 2.3 Directorio en donde se almacenan los archivos .jpg (logo de la empresa) y .png (códigos bidimensionales).
    $SendaXSD   = "archs_xsd/";   // 2.4 Directorio en donde se almacenan los archivos .xsd (esquemas de validación, especificaciones de campos del Anexo 20 del SAT);
    
    // 2.1 Datos de acceso del usuario (proporcionados por www.finkok.com).
     $username = "controlescolarenlinea@gmail.com";
     $password = "CtrlEsc@26";

    
    ### MUESTRA LOS DATOS DEL USUARIO QUE ESTÁ TIMBRANDO (OPCIONAL A MOSTRAR) ######
    echo '<div style="font-size: 10pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'DATOS DEL USUARIO QUE ESTÁ TIMBRANDO';
    echo '</div>';
    echo '<div style="font-size: 10pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'USUARIO: <span style="color: #088A29; font-size: 11pt;">'.$username."</span><br>";
    echo 'PASSWORD: <span style="color: #088A29; font-size: 11pt;">'.$password."</span><br>";
    echo '</div><br>';    
    
    
### 3. DEFINICIÓN DE VARIABLES INICIALES ##########################################
    $noCertificado = "20001000000300022762";  // 3.1 Número de certificado.
    $file_cer      = "TCM970625MB1.cer.pem";  // 3.2 Nombre del archivo .cer.pem 
    $file_key      = "TCM970625MB1.key.pem";  // 3.3 Nombre del archivo .cer.key
    
###################################################################################
    
    
### 4. DATOS GENERALES DE LA FACTURA ##############################################
    $fact_serie        = "A";                               // 4.1 Número de serie.
    $fact_folio        = mt_rand(1000, 9999);               // 4.2 Número de folio (para efectos de demostración se asigna de manera aleatoria).
    $NoFac             = $fact_serie.$fact_folio;           // 4.3 Serie de la factura concatenado con el número de folio.
    $fact_tipcompr     = "P";                               // 4.4 Tipo de comprobante.
    $subTotal          = 0;                                 // 4.5 Subtotal (suma de los importes antes de descuentos e impuestos).
    $IVA               = number_format(536,2,'.','');       // 4.6 IVA (suma de los impuestos).
    $total             = 0;                                 // 4.7 Total (Subtotal - Descuentos + Impuestos). 
    $fecha_fact        = date("Y-m-d")."T".date("H:i:s");   // 4.8 Fecha y hora de facturación.
    $LugarExpedicion   = "45079";                           // 4.9 Lugar de expedición (código postal).
    $moneda            = "XXX";                             // 4.10 Moneda
    
    
### 5. MUESTRA LA ZONA HORARIA PREDETERMINADA DEL SERVIDOR (OPCIONAL A MOSTRAR) ######
    echo '<div style="font-size: 10pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'FECHA Y HORA DE SOLICITUD DE TIMBRADO';
    echo '</div>';
    echo '<div style="font-size: 10pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo $fecha_fact; // 5.1 Se muestra solo para consultar y confirmar que sea la correcta.
    echo '</div><br>';    

    
### 6. VARIABLES QUE CONTIENEN EL CONCEPTO DE VENTA ############################
    
    $ConcepVenta_ClaveProdServ = '84111506'; // 6.1 
    $ConcepVenta_Cantidad      = '1';        // 6.2 
    $ConcepVenta_ClaveUnidad   = 'ACT';      // 6.3 
    $ConcepVenta_Descripcion   = 'Pago';     // 6.4 
    $ConcepVenta_ValorUnitario = '0';        // 6.5 
    $ConcepVenta_Importe       = '0';        // 6.6 
    
    
### 7. ARRAYS QUE CONTIENEN LAS RECEPCIONES DE PAGOS ###########################
    
    $ArrayDocRel_IdDocumento = ['8B797440-C422-4900-A9BA-DCC74A7BBC02', '320C2B8F-DC38-496D-ACBF-DE5838C457C6'];  // 7.1 
    $ArrayDocRel_Serie = ['A', 'A'];                      // 7.2 
    $ArrayDocRel_Folio = ['001', '002'];                  // 7.3 
    $ArrayDocRel_MonedaDR = ['MXN', 'MXN'];               // 7.4 
    $ArrayDocRel_MetodoDePagoDR = ['PPD', 'PPD'];         // 7.5 
    $ArrayDocRel_NumParcialidad = ['1', '4'];             // 7.6 
    $ArrayDocRel_ImpSaldoAnt = ['10000.00', '8000'];      // 7.7 
    $ArrayDocRel_ImpPagado = ['2000.00', '2000'];         // 7.8 
    $ArrayDocRel_ImpSaldoInsoluto = ['8000.00', '6000'];  // 7.9     
   
    
### 9. DATOS GENERALES DEL EMISOR #################################################    
    
    $emisor_rs     = "ENVACES Y EMPAQUES INTERNACIONALES";  // 9.1 Nombre o Razón social.
    $emisor_rfc    = "TCM970625MB1";                        // 9.2 RFC (Al momento de timbrar el PAC verifica que el RFC se encuentre activo en el SAT).
    $emisor_regfis = "REGIMEN GENERAL DE PERSONAS MORALES"; // 9.3 Régimen fiscal.    
        
    
### 10. DATOS GENERALES DEL RECEPTOR (CLIENTE) #####################################
    $RFC_Recep = "AAD990814BP7";   // 10.1 RFC (Al momento de timbrar el PAC verifica que el RFC se encuentre activo en el SAT).
    if (strlen($RFC_Recep)==12){$RFC_Recep = " ".$RFC_Recep; }else{$RFC_Recep = $RFC_Recep;} // 10.2 Al RFC de personas morales se le antecede un espacio en blanco para que su longitud sea de 13 caracteres ya que estos son de longitud 12.
    $receptor_rfc = $RFC_Recep;    // 10.3 RFC.
    $receptor_rs  = "ASOCIACION DE AGRICULTORES"; // 10.4 Nombre o razón social.
    

### 11. CREACIÓN Y ALMACENAMIENTO DEL ARCHIVO .XML (CFDI) ANTES DE SER TIMBRADO ###################
    
    #== 11.1 Creación de la variable de tipo DOM, aquí se conforma el XML a timbrar posteriormente.
    $xml = new DOMdocument('1.0', 'UTF-8'); 
    $root = $xml->createElement("cfdi:Comprobante");
    $root = $xml->appendChild($root); 
    
    $cadena_original='||';
    $noatt=  array();
    
    #== 11.2 Se crea e inserta el primer nodo donde se declaran los namespaces ======
    cargaAtt($root, array("xsi:schemaLocation"=>"http://www.sat.gob.mx/cfd/3",
            "xmlns:cfdi"=>"http://www.sat.gob.mx/cfd/3",
            "xmlns:xsi"=>"http://www.w3.org/2001/XMLSchema-instance"
        )
    );
    
    #== 11.3 Rutina de integración de nodos =========================================
    cargaAtt($root, array(
             "Version"=>"3.3", 
             "Serie"=>$fact_serie,
             "Folio"=>$fact_folio,
             "Fecha"=>date("Y-m-d")."T".date("H:i:s"),
             "NoCertificado"=>$noCertificado,
             "SubTotal"=>$subTotal,
             "Moneda"=>$moneda,
             "Total"=>$total,
             "TipoDeComprobante"=>$fact_tipcompr,
             "LugarExpedicion"=>$LugarExpedicion
          )
       );
    
    $emisor = $xml->createElement("cfdi:Emisor");
    $emisor = $root->appendChild($emisor);
    cargaAtt($emisor, array("Rfc"=>$emisor_rfc,
                            "Nombre"=>$emisor_rs,
                            "RegimenFiscal"=>"601"
                             )
                        );
    
    
    $receptor = $xml->createElement("cfdi:Receptor");
    $receptor = $root->appendChild($receptor);
    cargaAtt($receptor, array("Rfc"=>$receptor_rfc,
                    "Nombre"=>$receptor_rs,
                    "UsoCFDI"=>"P01"
                )
            );
    
    
    $conceptos = $xml->createElement("cfdi:Conceptos");
    $conceptos = $root->appendChild($conceptos);
    
        $concepto = $xml->createElement("cfdi:Concepto");
        $concepto = $conceptos->appendChild($concepto);
        cargaAtt($concepto, array(
               "ClaveProdServ"=>$ConcepVenta_ClaveProdServ,
               "Cantidad"=>$ConcepVenta_Cantidad,
               "ClaveUnidad"=>$ConcepVenta_ClaveUnidad,
               "Descripcion"=>$ConcepVenta_Descripcion,
               "ValorUnitario"=>$ConcepVenta_ValorUnitario,
               "Importe"=>$ConcepVenta_Importe
            )
        );
        
                        
// 11.4 COMPLEMENTO PARA RECEPCIÓN DE PAGOS =========================================
    
    $complemento = $xml->createElement("cfdi:Complemento");
    $complemento = $root->appendChild($complemento);
    
    
    $pagos = $xml->createElement("pago10:Pagos");
    $pagos = $complemento->appendChild($pagos);
    cargaAtt($pagos, array(
            "xmlns:pago10"=>"http://www.sat.gob.mx/Pagos",
            "Version"=>"1.0",
            "xsi:schemaLocation"=>"http://www.sat.gob.mx/Pagos http://www.sat.gob.mx/sitio_internet/cfd/Pagos/Pagos10.xsd"
        )
    );
    
    $pago = $xml->createElement("pago10:Pago");
    $pago = $pagos->appendChild($pago);
    cargaAtt($pago, array(
            "FechaPago"=>"2017-03-22T09:00:00",
            "FormaDePagoP"=>"06",
            "MonedaP"=>"MXN",
            "Monto"=>"4000.00",
            "NumOperacion"=>"AUT. 898872"
        )
    );
    
    for ($i=0; $i<count($ArrayDocRel_IdDocumento); $i++){
        
        $docRel = $xml->createElement("pago10:DoctoRelacionado");
        $docRel = $pago->appendChild($docRel);
        cargaAtt($docRel, array(
               "IdDocumento"=>$ArrayDocRel_IdDocumento[$i],
               "Serie"=>$ArrayDocRel_Serie[$i],
               "Folio"=>$ArrayDocRel_Folio[$i],
               "MonedaDR"=>$ArrayDocRel_MonedaDR[$i],
               "MetodoDePagoDR"=>$ArrayDocRel_MetodoDePagoDR[$i],
               "NumParcialidad"=>$ArrayDocRel_NumParcialidad[$i],
               "ImpSaldoAnt"=>number_format($ArrayDocRel_ImpSaldoAnt[$i],2,'.',''),
               "ImpPagado"=>number_format($ArrayDocRel_ImpPagado[$i],2,'.',''),
               "ImpSaldoInsoluto"=>number_format($ArrayDocRel_ImpSaldoInsoluto[$i],2,'.','')
            )
        );        
    }    
    
//==============================================================================
    
    #== 11.5 Termina de conformarse la "Cadena original" con doble ||
    $cadena_original .= "|";   
    
        $file = fopen($SendaCFDI."CadenaOriginal_Pagos_".$NoFac.".txt", "w");
        fwrite($file, $cadena_original . PHP_EOL);
        fclose($file);
        chmod($SendaCFDI."CadenaOriginal_Pagos_".$NoFac.".txt", 0777);      
    
    #=== Muestra la cadena original (opcional a mostrar) =======================
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'CADENA ORIGINAL';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo $cadena_original;
    echo '</div><br>';
    
    
    # 11.7 PROCESO OPCIONAL, NO NECESARIO PARA TIMBRAR UN DOCUMENTO FISCAL #####
    #== Proceso para agregar una Addenda con datos del sistema local (estos datos son ignorados por el PAC al momento de timbrar el documento XML). 
    
    // 11.17.1 Datos a integrar a la Addenda ===================================
    $IdEmpresa        = "TX34JK83";
    $UsuarioDeSistema = "ALEJANDRA OROSIO";
    $Fecha            = date("d/m/Y");
    $Hora             = date("H:i:s");
    $Observaciones    = "ESTE ES UN EJEMPLO DE TEXTO CORRESPONDIENTE A OBSERVACIONES CAPTURADAS POR EL USUARIO QUE SE INTEGRAN AL DOCUMENTO .XML DEL CFDI COMO UNA ADDENDA DEL SISTEMA LOCAL, NO ES REQUISITO PARA TIMBRAR UN CFDI VERSION 3.3";
    
    // 11.17.2 Integración del nodo "Addenda" al documento .XML ================
    $Addenda = $xml->createElement("cfdi:Addenda");
    $Addenda = $root->appendChild($Addenda);     
    
        $SisLoc = $xml->createElement("cfdi:SistemaLocal");
        $SisLoc = $Addenda->appendChild($SisLoc);
    
        cargaAttSinIntACad($SisLoc, array(
                "IdEmpresa"=>$IdEmpresa,
                "UsuarioDeSistema"=>$UsuarioDeSistema,
                "Fecha"=>$Fecha,
                "Hora"=>$Hora,
                "Observaciones"=>$Observaciones
            )
        );
        
    ## Fin de la integración de la Addenda. ####################################    
    
        
    
    #== 11.6 Proceso para obtener el sello digital del archivo .pem.key ========
    $keyid = openssl_get_privatekey(file_get_contents($SendaPEMS.$file_key));
    openssl_sign($cadena_original, $crypttext, $keyid, OPENSSL_ALGO_SHA256);
    openssl_free_key($keyid);
    

    #== 11.7 Se convierte la cadena digital a Base 64 ==========================
    $sello = base64_encode($crypttext);    
    
    #=== Muestra el sello (opcional a mostrar) =================================
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'SELLO';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo $sello;
    echo '</div><br>';    
    
    #== 11.8 Proceso para extraer el certificado del sello digital ============
    $file = $SendaPEMS.$file_cer;      // Ruta al archivo
    $datos = file($file);
    $certificado = ""; 
    $carga=false;  
    for ($i=0; $i<sizeof($datos); $i++){
        if (strstr($datos[$i],"END CERTIFICATE")) $carga=false;
        if ($carga) $certificado .= trim($datos[$i]);

        if (strstr($datos[$i],"BEGIN CERTIFICATE")) $carga=true;
    } 
    
    #=== Muestra el certificado del sello digital (opcional a mostrar) =========
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'CERTIFICADO DEL SELLO DIGITAL';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo $certificado;
    echo '</div><br>';    
    
    #== 11.9 Se continua con la integración de nodos ==========================
    $root->setAttribute("Sello",$sello);
    $root->setAttribute("Certificado",$certificado);   # Certificado.
    
    
    #== Fin de la integración de nodos =========================================
    
    
    $NomArchCFDI = $SendaCFDI."PreCFDI-33_Pagos_".$NoFac.".xml";
    
    #=== 11.10 Se guarda el archivo .XML antes de ser timbrado =================
    $cfdi = $xml->saveXML();
    $xml->formatOutput = true;             
    $xml->save($NomArchCFDI); // Guarda el archivo .XML (sin timbrar) en el directorio predeterminado.
    unset($xml);
    
    #=== 11.11 Se dan permisos de escritura al archivo .xml. ===================
    chmod($NomArchCFDI, 0777); 
    
    
##### FIN DE LA CREACIÓN DEL ARCHIVO .XML ANTES DE SER TIMBRADO ################
    
    
    
    
### 12. PROCESO DE TIMBRADO ####################################################
    
    #=== Se muestra el .XML antes de ser timbrado (opcional a mostrar)==========
    echo '<div style="font-size: 11pt; color: #000099; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'FACTURA .XML A TIMBRAR';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo htmlspecialchars($cfdi);
    echo '</div><br>';    
    
    #== 12.1 Se crea una variable de tipo DOM y se le carga el CFDI ============
    $xml2 = new DOMDocument();
    $xml2->loadXML($cfdi); 
    
    #== 12.2 Convirtiendo el contenido del CFDI a BASE 64 ======================
    $xml_cfdi_base64 = base64_encode($cfdi);

    
    #== 12.3 Datos de acceso al servidor de pruebas ============================
    $process  = curl_init('https://demo-facturacion.finkok.com/servicios/soap/stamp.wsdl');     
    
    #== 12.3 Datos de acceso al servidor de producción =========================
    # $process = curl_init('https://facturacion.finkok.com/servicios/soap/stamp.wsdl');    
    
    
#== 12.4 Creando el SOAP de envío ==============================================
    
$cfdixml = <<<XML
<?xml version="1.0" encoding="UTF-8"?> 
<SOAP-ENV:Envelope xmlns:ns0="http://schemas.xmlsoap.org/soap/envelope/"
    xmlns:ns1="http://facturacion.finkok.com/stamp"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
    <SOAP-ENV:Header/>
    <ns0:Body>
        <ns1:stamp>
            <ns1:xml>$xml_cfdi_base64</ns1:xml>
            <ns1:username>$username</ns1:username>
            <ns1:password>$password</ns1:password>
        </ns1:stamp>
    </ns0:Body>
</SOAP-ENV:Envelope>
XML;
  
    #== 12.5 Proceso para guardar los datos que se envían al servidor en un archivo .XML ======================
    $NomArchSoap = $SendaCFDI."DatosEnvio_Pagos_".$NoFac.".xml";

        #== 12.5.1 Si el archivo ya se encuentra se elimina ===========================
        if (file_exists ($NomArchSoap)==true){
            unlink($NomArchSoap);
        }

    
    #=== Muestra el contenido del SOAP que se envía al servidor del PAC (REQUEST) =========================
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'CONTENIDO DEL SOAP QUE SE ENVIA AL SERVIDOR DEL PAC';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo htmlspecialchars($cfdixml);
    echo '</div><br>';      

    #== 12.6 Se envía el contenido del SOAP al servidor del PAC ===============================
    curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Type: text/xml',' charset=utf-8'));
    curl_setopt($process, CURLOPT_POSTFIELDS, $cfdixml);  
    curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($process, CURLOPT_POST, true);
    curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);
    $RespServ = curl_exec($process);

    #== 12.7 Se muestra la respuesta del servidor del PAC (opcional a mostrar) ===============
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'RESPUESTA DEL SERVIDOR DEL PAC';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo htmlspecialchars($RespServ);
    echo '</div><br>';              

    curl_close($process);    
    
## FIN DEL PROCESO DE TIMBRADO #################################################
    
    
    
    
## 13. PROCESOS POSTERIORES AL TIMBRADO ########################################
    
    $tim_uuid ="";
    $Emisor_RFC="";
    $Receptor_RFC="";
    
    #== 13.1 Se asigna la respuesta del servidor a una variable de tipo DOM ====
    $VarXML = new DOMDocument();
    $VarXML->loadXML($RespServ);

    #== 13.2 Se graba la respuesta del servidor a un archivo .xml
//    $VarXML->save($SendaCFDI."RespServ_Pagos_".$NoFac.".xml");
//    chmod($SendaCFDI."RespServ_Pagos_".$NoFac.".xml", 0777);

    echo "<hr size=2 color=blue >";

    #== 13.3 Se asigna el contenido del tag "xml" a una variable ===============
    $RespServ = $VarXML->getElementsByTagName('xml');


    #== 13.4 Se obtiene el valor del nodo ======================================
    foreach($RespServ as $Nodo){
        $valor_del_nodo = $Nodo->nodeValue; 
    }

        
        #== Si el nodo contiene datos se realizan los siguientes procesos ======
        if($valor_del_nodo != ""){

            // unlink($SendaCFDI."xlst_".$NoFac.".xml"); <-- Puede ser descomentado para eliminar el archivo .XML sin timbrar.

            #== 13.5 Se muestra el .XML ya timbrado (CFDI V 3.2), opcional a mostrar =====
            echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
            echo 'FACTURA .XML (CFDI) YA TIMBRADA';
            echo '</div>';
            echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
            echo htmlspecialchars($Nodo->nodeValue);
            echo '</div><br>';              

            #=== 13.6 Guardando el CFDI en archivo .XML  =======================
            $NomArchXML = "CFDI-33_Pagos_".$NoFac.".xml";
            $NomArchPDF = "CFDI-33_Pagos_".$NoFac.".pdf";

            $xmlt = new DOMDocument();
            $xmlt->loadXML($valor_del_nodo);
            $xmlt->save($SendaCFDI.$NomArchXML); 
            chmod($SendaCFDI.$NomArchXML, 0777);
            
                // 13.6.1 Convertir archivo .XML a UTF-8 (OPCIONAL).
//                $file_name = $SendaCFDI.$NomArchXML;
//                $f = file_get_contents($file_name);
//                $f = iconv("WINDOWS-1252", "UTF-8", $f);
//                file_put_contents($file_name, "\xEF\xBB\xBF".$f);
                

            #== 13.7 Procesos para extraer datos del Timbre Fiscal del CFDI ====
            $docXML = new DOMDocument();
            $docXML->load($SendaCFDI."CFDI-33_Pagos_".$NoFac.".xml");
            
            $params = $docXML->getElementsByTagName("Comprobante");
            foreach ($params as $param) {
                $VersionCFDI = $param->getAttribute("Version");
            }      
            
            $comprobante = $docXML->getElementsByTagName("TimbreFiscalDigital");

            #== 13.8 Se obtienen contenidos de los atributos y se asignan a variables para ser mostrados =======
            foreach($comprobante as $timFis){
                    $version_timbre = $timFis->getAttribute('Version');
                    $sello_SAT      = $timFis->getAttribute('SelloSAT');
                    $cert_SAT       = $timFis->getAttribute('NoCertificadoSAT'); 
                    $sello_CFD      = $timFis->getAttribute('SelloCFD'); 
                    $tim_fecha      = $timFis->getAttribute('FechaTimbrado'); 
                    $tim_uuid       = $timFis->getAttribute('UUID'); 

                    echo 'Versión de CFDI: <span style="color: #088A29;">'.$VersionCFDI.'</span><br>';
                    echo 'Versión de timbre: <span style="color: #088A29;">'.$version_timbre.'</span><br>';
                    echo 'Sello del SAT: <span style="color: #088A29">'.$sello_SAT.'</span><br>';
                    echo 'Certificado del SAT: <span style="color: #088A29">'.$cert_SAT.'</span><br>';
                    echo 'Sello del CFDI: <span style="color: #088A29">'.$sello_CFD.'</span><br>';
                    echo 'Fecha de timbrado: <span style="color: #088A29">'.$tim_fecha.'</span><br>';
                    echo 'Folio fiscal: <span style="color: #0830D2">'.$tim_uuid.'</span><br>';
            }
            
            #== Se muestra el número de factura asignado por el sistema local (no asingado por el SAT).
            echo 'No. de factura asignado por el sistema local: <span style="color: #B71616">'.$NoFac.'</span><br><br>';
            
            $params = $docXML->getElementsByTagName('Emisor');
            foreach ($params as $param) {
                $Emisor_RFC = $param->getAttribute('Rfc');
            }  
            
            $params = $docXML->getElementsByTagName('Receptor');
            foreach ($params as $param) {
                $Receptor_RFC = $param->getAttribute('Rfc');
            }              
            
            $params = $docXML->getElementsByTagName('Comprobante');
            foreach ($params as $param) {
                $total = $param->getAttribute('Total');
            }        
            
            
            #== 13.9 Se crea el archivo .PNG con codigo bidimensional ==========
            $filename = "archs_graf/Img_".$tim_uuid.".png";
            $CadImpTot = ProcesImpTot($total);
            $Cadena = "?re=".$Emisor_RFC."&rr=".$Receptor_RFC."&tt=".$CadImpTot."&id=".$tim_uuid;
            QRcode::png($Cadena, $filename, 'H', 3, 2);    
            chmod($filename, 0777); 
            
            echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
            echo 'GRÁFICO "QR" RESULTANTE.';
            echo '</div>';
            echo '<img src="'.$filename.'" width="159" height="159" alt="'.$filename.'" style="margin-right: 20px;" />';      
            
            #== 13.10 Se crea código HTML para mostrar opciones al usuario.
            ?>
            
            <html>
                <head>
                    <title>TODO supply a title</title>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                </head>
                <body>
                    
                    <div style="margin-top: 15px; margin-bottom: 300px;" >
                        
                    <input type="button" value="Imprimir CFDI de Recepción de pagos" onclick="ImprimirFact()" />
                    &nbsp;&nbsp;
                    <input type="button" value="Descargar archivo .XML del CFDI"  onclick="DescargarFact()" />
                    &nbsp;&nbsp;
                    

                    <script type="text/javascript">
                        
                        function ImprimirFact(){
                            window.open("pdf_recepPag.php?NomArchXML=<?php echo $NomArchXML ?>&NomArchPDF=<?php echo $NomArchPDF ?>","_blank");
                        }
                        
                        function DescargarFact(){
                            window.open("descargar_xml.php?NomArchXML=<?php echo $NomArchXML ?>","_blank");
                        }

                    </script>
                        
                    </div>
                    
                </body>
                
            </html>
            
            <?php
          
        }else{
            
            #== 13.11 En caso de error de timbrado se muestran los detalles al usuario.
            
            $codigoError = $VarXML->getElementsByTagName('CodigoError');

            foreach($codigoError as $NodoStatus){
                $valorNod = $NodoStatus->nodeValue; 
            }        
            
            echo '<div style="font-size: 11pt; color: #000099; font-family: Verdana, Arial, Helvetica, sans-serif;">';
            echo 'CÓDIGO DE ERROR.';
            echo '</div>';
            echo '<div style="font-size: 14pt; color: #A70202; font-family: Verdana, Arial, Helvetica, sans-serif; margin-bottom: 100px;" >';
            echo $valorNod;
            echo '</div>';
        }
        
##### FIN DE PROCEDIMIENTOS ####################################################   

        
    
    
### 14. FUNCIONES DEL MÓDULO ###################################################
        
    # 14.1 Función que integra los nodos al archivo .XML y forma la "Cadena original".
    function cargaAtt(&$nodo, $attr){
        global $xml, $cadena_original;
        $quitar = array('sello'=>1,'noCertificado'=>1,'certificado'=>1);
        foreach ($attr as $key => $val){
            $val = preg_replace('/\s\s+/', ' ', $val);
            $val = trim($val);
            if (strlen($val)>0){
                 $val = utf8_encode(str_replace("|","/",$val));
                 $nodo->setAttribute($key,$val);
                 if (!isset($quitar[$key])) 
                   if (substr($key,0,3) != "xml" &&
                       substr($key,0,4) != "xsi:")
                    $cadena_original .= $val . "|";
            }
         }
    }
    
     
    function cargaAttSinIntACad(&$nodo, $attr){
        global $xml;
        $quitar = array('sello'=>1,'noCertificado'=>1,'certificado'=>1);
        foreach ($attr as $key => $val){
            $val = preg_replace('/\s\s+/', ' ', $val);
            $val = trim($val);
            if (strlen($val)>0){
                 $val = utf8_encode(str_replace("|","/",$val));
                 $nodo->setAttribute($key,$val);
                 if (!isset($quitar[$key])) 
                   if (substr($key,0,3) != "xml" &&
                       substr($key,0,4) != "xsi:");
            }
         }
     }     
     

    
    # 14.2 Funciónes que da formato al "Importe total" como lo requiere el SAT para ser integrado al código QR.
     
    function ProcesImpTot($ImpTot){
        $ImpTot = number_format($ImpTot, 4); // <== Se agregó el 30 de abril de 2017.
        $ArrayImpTot = explode(".", $ImpTot);
        $NumEnt = $ArrayImpTot[0];
        $NumDec = ProcesDecFac($ArrayImpTot[1]);
        
        return $NumEnt.".".$NumDec;
    }
    
    
    
    function ProcesDecFac($Num){
        $FolDec = "";
        if ($Num < 10){$FolDec = "00000".$Num;}
        if ($Num > 9 and $Num < 100){$FolDec = $Num."0000";}
        if ($Num > 99 and $Num < 1000){$FolDec = $Num."000";}
        if ($Num > 999 and $Num < 10000){$FolDec = $Num."00";}
        if ($Num > 9999 and $Num < 100000){$FolDec = $Num."0";}
        return $FolDec;
    }        
    

   
    
    
    