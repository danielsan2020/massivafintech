<?php
header('Content-Type: text/html; charset=UTF-8');
include("qrlib/qrlib.php");

### CÓDIGO FUENTE, FACTURACIÓN ELECTRÓNICA CFDI VERSIÓN 3.3 ACORDE A LOS REQUIRIMIENTOS DEL SAT, ANEXO 20.

echo '<div style="font-size: 12pt; color: #B40404; margin-bottom: 10px; margin-top: 8px; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'CREACIÓN DE ARCHIVO .XML DE CFDI VERSIÓN 3.3 SIN TIMBRAR.';
echo '</div>';    

### 1. CONFIGURACIÓN INICIAL ######################################################

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
    

    
### 3. DEFINICIÓN DE VARIABLES INICIALES ##########################################
    $noCertificado = "20001000000300005692";  // 3.1 Número de certificado.
    $file_cer      = "ACO560518KW7.cer.pem";  // 3.2 Nombre del archivo .cer.pem 
    $file_key      = "ACO560518KW7.key.pem";  // 3.3 Nombre del archivo .cer.key
    
###################################################################################
    
    
### 4. DATOS GENERALES DE LA FACTURA ##################################################
    $fact_serie        = "A";                             // 4.1 Número de serie.
    $fact_folio        = mt_rand(1000, 9999);             // 4.2 Número de folio (para efectos de demostración se asigna de manera aleatoria).
    $NoFac             = $fact_serie.$fact_folio;         // 4.3 Serie de la factura concatenado con el número de folio.
    $fact_tipcompr     = "I";                             // 4.4 Tipo de comprobante.
    $tasa_iva          = 16;                              // 4.5 Tasa del impuesto IVA.
    $subTotal          = 0;                               // 4.6 Subtotal, suma de los importes antes de descuentos e impuestos (se calculan mas abajo). 
    $descuento         = 0;                               // 4.7 Descuento (se calculan mas abajo).
    $IVA               = 0;                               // 4.8 IVA, suma de los impuestos (se calculan mas abajo).
    $total             = 0;                               // 4.9 Total, Subtotal - Descuentos + Impuestos (se calculan mas abajo). 
    $fecha_fact        = date("Y-m-d")."T".date("H:i:s"); // 4.10 Fecha y hora de facturación.
    $NumCtaPago        = "6473";                          // 4.11 Número de cuenta (sólo últimos 4 dígitos, opcional).
    $condicionesDePago = "CONDICIONES";                   // 4.12 Condiciones de pago.
    $formaDePago       = "01";                            // 4.13 Forma de pago.
    $metodoDePago      = "PUE";                           // 4.14 Clave del método de pago. Consultar catálogos de métodos de pago del SAT.
    $TipoCambio        = 1;                               // 4.15 Tipo de cambio de la moneda.
    $LugarExpedicion   = "45079";                         // 4.16 Lugar de expedición (código postal).
    $moneda            = "MXN";                           // 4.17 Moneda
    $totalImpuestosRetenidos   = 0;                       // 4.18 Total de impuestos retenidos (se calculan mas abajo).
    $totalImpuestosTrasladados = 0;                       // 4.19 Total de impuestos trasladados (se calculan mas abajo).
 
    
### 5. MUESTRA LA ZONA HORARIA PREDETERMINADA DEL SERVIDOR (OPCIONAL A MOSTRAR) ######
    echo '<div style="font-size: 10pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'FECHA Y HORA DE SOLICITUD DE TIMBRADO';
    echo '</div>';
    echo '<div style="font-size: 10pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo $fecha_fact; // 5.1 Se muestra solo para consultar y confirmar que sea la correcta.
    echo '</div><br>';    

    
### 6. ARRAYS QUE CONTIENEN LOS ARTICULOS QUE FORMAN PARTE DE LA VENTA #####################
    
    $Array_ClaveProdServ    = ['23241610', '20142900']; // 6.1 Clave del SAT correspondiente al artículo o servicio (consultar el catálogo de productos del SAT).
    $Array_NoIdentificacion = ['CORCOB', 'TANQG-BUT'];    // 6.2 Clave asignada al artículo o servicio, sistema local.
    $Array_Cantidad         = ['5', '3'];                           // 6.3 Cantidad.
    $Array_ClaveUnidad      = ['H87', 'H87'];                      // 6.4 Clave del SAT correspondiente a la unidad de medida (consultar el catálogo de productos del SAT).
    $Array_Unidad           = ['PIEZA', 'PIEZA'];             // 6.5 Descripción de la unidad de medida.
    $Array_Descripcion      = ['CORTADOR DE TUBO DE COBRE', 'TANQUE CON GAS BUTANO']; // 6.6 Descripción del artículo o servicio.
    $Array_ValorUnitario    = ['125.50', '35.80'];              // 6.7 Valor unitario del artículo o servicio.
    $Array_Importe          = ['627.50', '107.40'];          // 6.8 Importe del artículo o servicio.
    $Array_Descuento        = ['0', '0'];                             // 6.9 Descuento aplicado al artículo o servicio.
    
    
 ### 7. ARRAYS QUE CONTIENEN LOS IMPUESTOS TRASLADADOS Y RETENIDOS POR CONCEPTO #############

    // Trasladados.
    $ArrayTraslado_Base       = ['627.50', '107.40'];           // 7.1 Atributo requerido para señalar la base para el cálculo del impuesto, la determinación de la base se realiza de acuerdo con las disposiciones fiscales vigentes. No se permiten valores negativos
    $ArrayTraslado_Impuesto   = ['002', '002'];                      // 7.2 Atributo requerido para señalar la clave del tipo de impuesto trasladado aplicable al concepto (consultar catálogos del SAT).
    $ArrayTraslado_TipoFactor = ['Tasa', 'Exento'];                  // 7.3 Atributo requerido para señalar la clave del tipo de factor que se aplica a la base del impuesto (consultar catálogos del SAT).
    $ArrayTraslado_TasaOCuota = ['0.160000', '0.000000'];  // 7.4 Atributo condicional para señalar el valor de la tasa o cuota del impuesto que se traslada para el presente concepto. Es requerido cuando el atributo TipoFactor tenga una clave que corresponda a Tasa o Cuota (consultar catálogos del SAT).
    $ArrayTraslado_Importe    = ['100.40', '0.00'];                // 7.5 Atributo condicional para señalar el importe del impuesto trasladado que aplica al concepto. No se permiten valores negativos. Es requerido cuando TipoFactor sea Tasa o Cuota
    
    
### 8 DETERMINANDO TOTALES #####################################################
    
    $ArrayRetencion_Importe = [];
    
    // 8.1 Calculando subTotal.
    for ($i=0; $i<count($Array_Importe); $i++){
        
        $subTotal = $subTotal + $Array_Importe[$i];
    }
    
    $subTotal = number_format($subTotal,2,'.',''); 
    
    // 8.2 Total impuestos trasladados.
    for ($i=0; $i<count($ArrayTraslado_Importe); $i++){
        $totalImpuestosTrasladados = $totalImpuestosTrasladados + $ArrayTraslado_Importe[$i];
    }
    
    // 8.3 Total impuestos retenidos.
    for ($i=0; $i<count($ArrayRetencion_Importe); $i++){
        $totalImpuestosRetenidos = $totalImpuestosRetenidos + $ArrayRetencion_Importe[$i];
    }

    // 8.4 Calculando Total.
    $total = $subTotal - $descuento + $totalImpuestosTrasladados - $totalImpuestosRetenidos;
    
    
### 9. DATOS GENERALES DEL EMISOR #################################################  
    
    $emisor_rs     = "ENVACES Y EMPAQUES INTERNACIONALES";  // 9.1 Nombre o Razón social.
    $emisor_rfc    = "ACO560518KW7";                        // 9.2 RFC (al momento de timbrar el SAT comprueba que el RFC se encuentre registrado y vigente en su base de datos)
    $emisor_regfis = "REGIMEN GENERAL DE PERSONAS MORALES"; // 9.3 Régimen fiscal.    
        
    
### 10. DATOS GENERALES DEL RECEPTOR (CLIENTE) #####################################
    
    $RFC_Recep = "AAD990814BP7";                                                              // 10.1 RFC (al momento de timbrar el SAT comprueba que el RFC se encuentre registrado y vigente en su base de datos).
    if (strlen($RFC_Recep)==12){$RFC_Recep = " ".$RFC_Recep; }else{$RFC_Recep = $RFC_Recep;}  // 10.2 Al RFC de personas morales se le antecede un espacio en blanco para que su longitud sea de 13 caracteres ya que estos son de longitud 12.
    $receptor_rfc = $RFC_Recep;                                                               // 10.3 RFC.
    $receptor_rs  = "ASOCIACION DE AGRICULTORES";                       // 10.4 Nombre o razón social.
    

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
            "FormaPago"=>$formaDePago,
            "NoCertificado"=>$noCertificado,
            "CondicionesDePago"=>$condicionesDePago,
            "SubTotal"=>$subTotal,
            "Descuento"=>$descuento,
            "Moneda"=>$moneda,
            "TipoCambio"=>$TipoCambio,
            "Total"=>$total,
            "TipoDeComprobante"=>$fact_tipcompr,
            "MetodoPago"=>$metodoDePago,
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
                    "UsoCFDI"=>"G01"
                )
            );
    
    
    $conceptos = $xml->createElement("cfdi:Conceptos");
    $conceptos = $root->appendChild($conceptos);
    
    #== 11.4 Ciclo "for", recopilación de datos de artículos e integración de sus respectivos nodos =
    
    for ($i=0; $i<count($Array_Cantidad); $i++){
       	
        $concepto = $xml->createElement("cfdi:Concepto");
        $concepto = $conceptos->appendChild($concepto);
        cargaAtt($concepto, array(
               "ClaveProdServ"=>$Array_ClaveProdServ[$i],
               "NoIdentificacion"=>$Array_NoIdentificacion[$i],
               "Cantidad"=>$Array_Cantidad[$i],
               "ClaveUnidad"=>$Array_ClaveUnidad[$i],
               "Unidad"=>$Array_Unidad[$i],
               "Descripcion"=>$Array_Descripcion[$i],
               "ValorUnitario"=>number_format($Array_ValorUnitario[$i],2,'.',''),
               "Importe"=>number_format($Array_Importe[$i],6,'.',''),
               "Descuento"=>number_format($Array_Descuento[$i],2,'.','')
            )
        );
    
        $impuestos = $xml->createElement("cfdi:Impuestos");
        $impuestos = $concepto->appendChild($impuestos);

            $Traslados = $xml->createElement("cfdi:Traslados");
            $Traslados = $impuestos->appendChild($Traslados);
            
                $Traslado = $xml->createElement("cfdi:Traslado");
                $Traslado = $Traslados->appendChild($Traslado);
                
                if ($ArrayTraslado_TipoFactor[$i]=="Exento"){
                    cargaAtt($Traslado, array(
                           "Base"=>number_format($ArrayTraslado_Base[$i],2,'.',''),
                           "Impuesto"=>$ArrayTraslado_Impuesto[$i],
                           "TipoFactor"=>$ArrayTraslado_TipoFactor[$i]
                        ) 
                    );    
                }else{
                    cargaAtt($Traslado, array(
                           "Base"=>number_format($ArrayTraslado_Base[$i],2,'.',''),
                           "Impuesto"=>$ArrayTraslado_Impuesto[$i],
                           "TipoFactor"=>$ArrayTraslado_TipoFactor[$i],
                           "TasaOCuota"=>$ArrayTraslado_TasaOCuota[$i],
                           "Importe"=>number_format($ArrayTraslado_Importe[$i],2,'.','')
                        ) 
                    );    
                }
                  
        
//            $Retenciones = $xml->createElement("cfdi:Retenciones");
//            $Retenciones = $impuestos->appendChild($Retenciones);
//            
//                $Retencion = $xml->createElement("cfdi:Retencion");
//                $Retencion = $Retenciones->appendChild($Retencion);
//                
//                    cargaAtt($Retencion, array(
//                           "Base"=>number_format($ArrayRetencion_Base[$i],2,'.',''),
//                           "Impuesto"=>$ArrayRetencion_Impuesto[$i],
//                           "TipoFactor"=>$ArrayRetencion_TipoFactor[$i],
//                           "TasaOCuota"=>$ArrayRetencion_TasaOCuota[$i],
//                           "Importe"=>number_format($ArrayRetencion_Importe[$i],2,'.','')
//                        ) 
//                    );
              
}

#== 11.5 Impuestos retenidos y trasladados ==========================================

$Impuestos = $xml->createElement("cfdi:Impuestos");
$Impuestos = $root->appendChild($Impuestos);

//    $Retenciones = $xml->createElement("cfdi:Retenciones");
//    $Retenciones = $Impuestos->appendChild($Retenciones);    
//
//        $Retencion = $xml->createElement("cfdi:Retencion");
//        $Retencion = $Retenciones->appendChild($Retencion);
//
//            cargaAtt($Retencion, array(
//                   "Impuesto"=>"002",
//                   "Importe"=>number_format($totalImpuestosRetenidos,2,'.','')
//                ) 
//            );
//
//            cargaAtt($Impuestos, array(
//                            "TotalImpuestosRetenidos"=>number_format($totalImpuestosRetenidos,2,'.','')
//                        )
//                    );
            
            
    $Traslados = $xml->createElement("cfdi:Traslados");
    $Traslados = $Impuestos->appendChild($Traslados);

        $Traslado = $xml->createElement("cfdi:Traslado");
        $Traslado = $Traslados->appendChild($Traslado);

            cargaAtt($Traslado, array(
                   "Impuesto"=>"002",
                   "TipoFactor"=>"Tasa",
                   "TasaOCuota"=>"0.160000",
                   "Importe"=>number_format($totalImpuestosTrasladados,2,'.','')
                ) 
            );    
            
            cargaAtt($Impuestos, array(
                    "TotalImpuestosTrasladados"=>number_format($totalImpuestosTrasladados,2,'.','')
                )
            );

                         
    $complemento = $xml->createElement("cfdi:Complemento");
    $complemento = $root->appendChild($complemento);

    
    #== 11.6 Termina de conformarse la "Cadena original" con doble ||
    $cadena_original .= "|";   
    
        $file = fopen($SendaCFDI."CadenaOriginal_Factura_".$NoFac.".txt", "w");
        fwrite($file, $cadena_original . PHP_EOL);
        fclose($file);
        chmod($SendaCFDI."CadenaOriginal_Factura_".$NoFac.".txt", 0777);      
    
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
    $TipDocOrigen     = "PEDIDO";
    $FolioDocOrigen   = "A345";
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
                "TipoDocOrigen"=>$TipDocOrigen,
                "FolioDocOrigen"=>$FolioDocOrigen,
                "Observaciones"=>$Observaciones
            )
        );
        
    ## Fin de la integración de la Addenda. ####################################
    
    
    #== 11.8 Proceso para obtener el sello digital del archivo .pem.key ========
    $keyid = openssl_get_privatekey(file_get_contents($SendaPEMS.$file_key));
    openssl_sign($cadena_original, $crypttext, $keyid, OPENSSL_ALGO_SHA256);
    openssl_free_key($keyid);
    

    #== 11.9 Se convierte la cadena digital a Base 64 ==========================
    $sello = base64_encode($crypttext);    
    
    #=== Muestra el sello (opcional a mostrar) =================================
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'SELLO';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo $sello;
    echo '</div><br>';    
    
    #== 11.10 Proceso para extraer el certificado del sello digital ============
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
    
    #== 11.12 Se continua con la integración de nodos ===========================   
    $root->setAttribute("Sello",$sello);
    $root->setAttribute("Certificado",$certificado);   # Certificado.
    
    
    #== Fin de la integración de nodos =========================================
    
    $NomArchCFDI = $SendaCFDI."PreCFDI-33_Factura_".$NoFac.".xml";
    
    
    #=== 11.12 Se guarda el archivo .XML antes de ser timbrado =======================
    $cfdi = $xml->saveXML();
    $xml->formatOutput = true;             
    $xml->save($NomArchCFDI); // Guarda el archivo .XML (sin timbrar) en el directorio predeterminado.
    unset($xml);
    
    #=== 11.13 Se dan permisos de escritura al archivo .xml. =========================
    chmod($NomArchCFDI, 0777); 
    
    
    #=== Muestra el nombre del archivo .XML creado =========
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif; margin-bottom: 4px;">';
    echo 'ARCHIVO XML RESULTANTE:';
    echo '</div>';
    echo '<div style="font-size: 15pt; color: #5C5C5C; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo $NomArchCFDI;
    echo '</div><br>';      
    
    
##### FIN DE LA CREACIÓN DEL ARCHIVO .XML SIN TIMBRAR ###################################################
    
    
    
    
    
    
    
    

    
### 14. FUNCIONES DEL MÓDULO ###################################################
        
    # 14.1 Función que integra los nodos al archivo .XML y forma la "Cadena original".
    function cargaAtt(&$nodo, $attr){
        global $xml, $cadena_original;
        $quitar = array('sello'=>1,'noCertificado'=>1,'certificado'=>1);
        foreach ($attr as $key => $val){
            $val = preg_replace('/\s\s+/', ' ', $val);
            $val = trim($val);
            if (strlen($val)>0){
                 $val = str_replace("|","/",$val);
                 $nodo->setAttribute($key,$val);
                 if (!isset($quitar[$key])) 
                   if (substr($key,0,3) != "xml" &&
                       substr($key,0,4) != "xsi:")
                    $cadena_original .= $val . "|";
            }
         }
     }
     
     
    # 14.2 Función que integra los nodos al archivo .XML sin integrar a la "Cadena original". 
    function cargaAttSinIntACad(&$nodo, $attr){
        global $xml;
        $quitar = array('sello'=>1,'noCertificado'=>1,'certificado'=>1);
        foreach ($attr as $key => $val){
            $val = preg_replace('/\s\s+/', ' ', $val);
            $val = trim($val);
            if (strlen($val)>0){
                 $val = str_replace("|","/",$val);
                 $nodo->setAttribute($key,$val);
                 if (!isset($quitar[$key])) 
                   if (substr($key,0,3) != "xml" &&
                       substr($key,0,4) != "xsi:");
            }
         }
     }     

    
    # 14.3 Funciónes que da formato al "Importe total" como lo requiere el SAT para ser integrado al código QR.
     
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
    

   
    
    
    