<?php
header('Content-Type: text/html; charset=UTF-8');
include("qrlib/qrlib.php");

### CÓDIGO FUENTE, FACTURACIÓN ELECTRÓNICA CFDI VERSIÓN 3.3 ACORDE A LOS REQUIRIMIENTOS DEL SAT, ANEXO 20.

echo '<div style="font-size: 12pt; color: #B40404; margin-bottom: 10px; margin-top: 8px; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'PROCESO DE TIMBRADO PARA "FACTURAR". CFDI VERSIÓN 3.3 CON COMPLEMENTO "DETALLISTA".';
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
    
    
    // 2.5 Datos de acceso del usuario (proporcionados por www.finkok.com) modo de integración (para pruebas) o producción.
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
    $fact_serie        = "D";                             // 4.1 Número de serie.
    $fact_folio        = mt_rand(1000, 9999);             // 4.2 Número de folio (para efectos de demostración se asigna de manera aleatoria).
    $NoFac             = $fact_serie.$fact_folio;         // 4.3 Serie de la factura concatenado con el número de folio.
    $fact_tipcompr     = "I";                             // 4.4 Tipo de comprobante.
    $tasa_iva          = 16;                              // 4.5 Tasa del impuesto IVA.
    $subTotal          = 0;                               // 4.6 Subtotal, suma de los importes antes de descuentos e impuestos (se calculan mas abajo). 
    $descuento         = number_format(0,2,'.','');       // 4.7 Descuento (se calculan mas abajo).
    $IVA               = number_format(0,2,'.','');       // 4.8 IVA, suma de los impuestos (se calculan mas abajo).
    $total             = 0;                               // 4.9 Total, Subtotal - Descuentos + Impuestos (se calculan mas abajo). 
    $fecha_fact        = date("Y-m-d")."T".date("H:i:s"); // 4.10 Fecha y hora de facturación.
    $NumCtaPago        = "6473";                          // 4.11 Número de cuenta (sólo últimos 4 dígitos, opcional).
    $condicionesDePago = "CONDICIONES";                   // 4.12 Condiciones de pago.
    $formaDePago       = "01";                            // 4.13 Forma de pago.
    $metodoDePago      = "PUE";                           // 4.14 Clave del método de pago. Consultar catálogos de métodos de pago del SAT.
    $TipoCambio        = 18.8362;                         // 4.15 Tipo de cambio de la moneda.
    $LugarExpedicion   = "45079";                         // 4.16 Lugar de expedición (código postal).
    $moneda            = "USD";                           // 4.17 Moneda
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
    
    $Array_ClaveProdServ    = ['12352100', '12352100']; // 6.1 Clave del SAT correspondiente al artículo o servicio (consultar el catálogo de productos del SAT).
    $Array_NoIdentificacion = ['BTE1195TRA5W000', 'BTE1183TRA5W000'];    // 6.2 Clave asignada al artículo o servicio, sistema local.
    $Array_Cantidad         = ['16571.000000', '227.000000'];                           // 6.3 Cantidad.
    $Array_ClaveUnidad      = ['KGM', 'KGM'];                      // 6.4 Clave del SAT correspondiente a la unidad de medida (consultar el catálogo de productos del SAT).
    $Array_Unidad           = ['PIEZA', 'PIEZA'];             // 6.5 Descripción de la unidad de medida.
    $Array_Descripcion      = ['Betapeg 1000 NF BR', 'Betapeg 1000']; // 6.6 Descripción del artículo o servicio.
    $Array_ValorUnitario    = ['1.700000', '1.700000'];              // 6.7 Valor unitario del artículo o servicio.
    $Array_Importe          = ['28170.70', '385.90'];          // 6.8 Importe del artículo o servicio.
    $Array_Descuento        = ['0.00', '0.00'];                             // 6.9 Descuento aplicado al artículo o servicio.
    
    
 ### 7. ARRAYS QUE CONTIENEN LOS IMPUESTOS TRASLADADOS Y RETENIDOS POR CONCEPTO #############

    // Trasladados.
    $ArrayTraslado_Base = ['28170.70', '385.90'];          // 7.1 Atributo requerido para señalar la base para el cálculo del impuesto, la determinación de la base se realiza de acuerdo con las disposiciones fiscales vigentes. No se permiten valores negativos
    $ArrayTraslado_Impuesto = ['002', '002'];              // 7.2 Atributo requerido para señalar la clave del tipo de impuesto trasladado aplicable al concepto (consultar catálogos del SAT).
    $ArrayTraslado_TipoFactor = ['Tasa', 'Tasa'];          // 7.3 Atributo requerido para señalar la clave del tipo de factor que se aplica a la base del impuesto (consultar catálogos del SAT).
    $ArrayTraslado_TasaOCuota = ['0.000000', '0.000000'];  // 7.4 Atributo condicional para señalar el valor de la tasa o cuota del impuesto que se traslada para el presente concepto. Es requerido cuando el atributo TipoFactor tenga una clave que corresponda a Tasa o Cuota (consultar catálogos del SAT).
    $ArrayTraslado_Importe = ['0.000000', '0.000000'];     // 7.5 Atributo condicional para señalar el importe del impuesto trasladado que aplica al concepto. No se permiten valores negativos. Es requerido cuando TipoFactor sea Tasa o Cuota
    
    
    // Retenidos.
//    $ArrayRetencion_Base = ['0', '0', '0'];                // 7.6 Atributo requerido para señalar la base para el cálculo de la retención, la determinación de la base se realiza de acuerdo con las disposiciones fiscales vigentes. No se permiten valores negativos.
//    $ArrayRetencion_Impuesto = ['0', '0', '0'];            // 7.7 Atributo requerido para señalar la clave del tipo de impuesto retenido aplicable al concepto (consultar catálogos del SAT).
//    $ArrayRetencion_TipoFactor = ['Tasa', 'Tasa', 'Tasa']; // 7.8 Atributo requerido para señalar la clave del tipo de factor que se aplica a la base del impuesto (consultar catálogos del SAT).
//    $ArrayRetencion_TasaOCuota = ['0.10', '0.10', '0.10']; // 7.9 Atributo requerido para señalar la tasa o cuota del impuesto que se retiene para el presente concepto (consultar catálogos del SAT).
//    $ArrayRetencion_Importe = ['0', '0', '0'];             // 7.10 Atributo requerido para señalar el importe del impuesto retenido que aplica al concepto. No se permiten valores negativos.
    
    
### 7.1 ARRAYS QUE CONTIENEN LAS MERCANCIAS PARA EL COMPLEMENTO DE COMERCIO EXTERIOR #############


    // Mercancias.
//    $ArrayMerc_NoIdentificacion = ['BTE1195TRA5W000', 'BTE1183TRA5W000'];
//    $ArrayMerc_FraccionArancelaria = ['34042001', '34042001'];
//    $ArrayMerc_CantidadAduana = ['16571.00', '227.00'];
//    $ArrayMerc_UnidadAduana = ['01', '01'];
//    $ArrayMerc_ValorUnitarioAduana = ['1.70', '1.70'];
//    $ArrayMerc_ValorDolares = ['28170.70', '385.90'];

    
    
    
    
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
    $emisor_rfc    = "TCM970625MB1";                        // 9.2 RFC (al momento de timbrar el SAT comprueba que el RFC se encuentre registrado y vigente en su base de datos)
    $emisor_regfis = "REGIMEN GENERAL DE PERSONAS MORALES"; // 9.3 Régimen fiscal.    
        
    
### 10. DATOS GENERALES DEL RECEPTOR (CLIENTE) #####################################
    
    $RFC_Recep = "XEXX010101000";                                                              // 10.1 RFC (al momento de timbrar el SAT comprueba que el RFC se encuentre registrado y vigente en su base de datos).
    if (strlen($RFC_Recep)==12){$RFC_Recep = " ".$RFC_Recep; }else{$RFC_Recep = $RFC_Recep;}  // 10.2 Al RFC de personas morales se le antecede un espacio en blanco para que su longitud sea de 13 caracteres ya que estos son de longitud 12.
    $receptor_rfc = $RFC_Recep;                                                               // 10.3 RFC.
    $receptor_rs  = "FABRICANTE Y COMERCIALIZADORA BETA SA DE CV";                       // 10.4 Nombre o razón social.
    

### 11. CREACIÓN Y ALMACENAMIENTO DEL ARCHIVO .XML (CFDI) ANTES DE SER TIMBRADO ###################
    
    #== 11.1 Creación de la variable de tipo DOM, aquí se conforma el XML a timbrar posteriormente.
    $xml = new DOMdocument('1.0', 'UTF-8'); 
    $root = $xml->createElement("cfdi:Comprobante");
    $root = $xml->appendChild($root); 
    
    $cadena_original='||';
    $noatt=  array();
    
    #== 11.2 Se crea e inserta el primer nodo donde se declaran los namespaces ======
    cargaAtt($root, array(
            "xsi:schemaLocation"=>"http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd http://www.sat.gob.mx/detallista http://www.sat.gob.mx/sitio_internet/cfd/detallista/detallista.xsd",
            "xmlns:cfdi"=>"http://www.sat.gob.mx/cfd/3",
            "xmlns:detallista"=>"http://www.sat.gob.mx/detallista",
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
                    "ResidenciaFiscal"=>"USA",
                    "NumRegIdTrib"=>"821816654",
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
                
                    cargaAtt($Traslado, array(
                           "Base"=>number_format($ArrayTraslado_Base[$i],2,'.',''),
                           "Impuesto"=>$ArrayTraslado_Impuesto[$i],
                           "TipoFactor"=>$ArrayTraslado_TipoFactor[$i],
                           "TasaOCuota"=>$ArrayTraslado_TasaOCuota[$i],
                           "Importe"=>number_format($ArrayTraslado_Importe[$i],2,'.','')
                        ) 
                    );    
                  
        
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
                   "TasaOCuota"=>"0.000000",
                   "Importe"=>number_format($totalImpuestosTrasladados,2,'.','')
                ) 
            );    
            
            cargaAtt($Impuestos, array(
                    "TotalImpuestosTrasladados"=>number_format($totalImpuestosTrasladados,2,'.','')
                )
            );
                         
    
// 11.5.1 COMPLEMENTO "DETALLISTA" =============================================
            
    $complemento = $xml->createElement("cfdi:Complemento");
    $root->appendChild($complemento);
            
            
    $Detallista = $xml->createElement("detallista:detallista");
    $complemento->appendChild($Detallista);
    cargaAttSinIntACad($Detallista, array(
            "contentVersion"=>"1.3.1",
            "documentStatus"=>"ORIGINAL"
        )
    );

    cargaAtt($Detallista, array(
            "documentStructureVersion"=>"AMC8.1"  // <= Se integra a la "Cadena original" para se sellada.
        )
    );
    
    cargaAttSinIntACad($Detallista, array(
            "type"=>"SimpleInvoiceType"
        )
    );

    //==========================================================================
    
    $Detall_ReqForPayIde = $xml->createElement("detallista:requestForPaymentIdentification");
    $Detallista->appendChild($Detall_ReqForPayIde);
    
        $Detall_entityType = $xml->createElement("detallista:entityType","INVOICE");
        $Detall_ReqForPayIde->appendChild($Detall_entityType);    
       
    //==========================================================================
        
    $Detall_SpecialIns = $xml->createElement("detallista:specialInstruction");
    $Detallista->appendChild($Detall_SpecialIns);
    
    cargaAttSinIntACad($Detall_SpecialIns, array(
                        "code"=>"ZZZ"
                        )
                    );
    
        $Detall_SpecialInsText = $xml->createElement("detallista:text","TRES MIL TRESCIENTOS NOVENTA Y TRES PESOS 04/100 M.N.");
        $Detall_SpecialIns->appendChild($Detall_SpecialInsText);    
                    
    //==========================================================================
        
    $Detall_OrderIdent = $xml->createElement("detallista:orderIdentification");
    $Detallista->appendChild($Detall_OrderIdent);
    
        $Detall_ReferIdent = $xml->createElement("detallista:referenceIdentification","15749759");
        $Detall_OrderIdent->appendChild($Detall_ReferIdent);    
        
        $cadena_original .= "15749759"."|";  // <= Se integra a la "Cadena original" para se sellada.

        cargaAttSinIntACad($Detall_ReferIdent, array(
                            "type"=>"ON"
                            )
                        );
            
        
        $Detall_ReferDate = $xml->createElement("detallista:ReferenceDate","2009-05-11");
        $Detall_OrderIdent->appendChild($Detall_ReferDate);
        
            $cadena_original .= "2009-05-11"."|";  // <= Se integra a la "Cadena original" para se sellada.
    
    //==========================================================================
        
    $Detall_AditInf = $xml->createElement("detallista:AdditionalInformation");
    $Detallista->appendChild($Detall_AditInf);
    
        $Detall_ReferIdent = $xml->createElement("detallista:referenceIdentification","A");
        $Detall_AditInf->appendChild($Detall_ReferIdent);
        
        cargaAttSinIntACad($Detall_ReferIdent, array(
                            "type"=>"IV"
                            )
                        );
        
        $Detall_ReferIdent = $xml->createElement("detallista:referenceIdentification","27534");
        $Detall_AditInf->appendChild($Detall_ReferIdent);
        
        cargaAttSinIntACad($Detall_ReferIdent, array(
                            "type"=>"ATZ"
                            )
                        );
        
    //==========================================================================
        
    $Detall_DeliNot = $xml->createElement("detallista:DeliveryNote");
    $Detallista->appendChild($Detall_DeliNot);
    
        $Detall_ReferIdent = $xml->createElement("detallista:referenceIdentification","97276954");
        $Detall_DeliNot->appendChild($Detall_ReferIdent);
        
        $Detall_ReferDate = $xml->createElement("detallista:ReferenceDate","2009-05-13");
        $Detall_DeliNot->appendChild($Detall_ReferDate);    
        
    //==========================================================================

    $Detall_buyer = $xml->createElement("detallista:buyer");
    $Detallista->appendChild($Detall_buyer);
    
        $Detall_gln = $xml->createElement("detallista:gln","7504000107903");
        $Detall_buyer->appendChild($Detall_gln);
        
            $cadena_original .= "7504000107903"."|";  // <= Se integra a la "Cadena original" para se sellada.

        $Detall_ContInfo = $xml->createElement("detallista:contactInformation");
        $Detall_buyer->appendChild($Detall_ContInfo);    

        $Detall_PersonOrDepNam = $xml->createElement("detallista:personOrDepartmentName");
        $Detall_ContInfo->appendChild($Detall_PersonOrDepNam);    

        $Detall_PersonOrDepNam_Text = $xml->createElement("detallista:text","0390");
        $Detall_PersonOrDepNam->appendChild($Detall_PersonOrDepNam_Text);    

    //==========================================================================

    $Detall_seller = $xml->createElement("detallista:seller");
    $Detallista->appendChild($Detall_seller);
    
        $Detall_gln = $xml->createElement("detallista:gln","7504000107903");
        $Detall_seller->appendChild($Detall_gln);    
        
            $cadena_original .= "7504000107903"."|";  // <= Se integra a la "Cadena original" para se sellada.

        $Detall_AlterPartIdent = $xml->createElement("detallista:alternatePartyIdentification","109");
        $Detall_seller->appendChild($Detall_AlterPartIdent);
        
            $cadena_original .= "109"."|";  // <= Se integra a la "Cadena original" para se sellada.
        
        cargaAttSinIntACad($Detall_AlterPartIdent, array(
                            "type"=>"SELLER_ASSIGNED_IDENTIFIER_FOR_A_PARTY"
                            )
                        );

    //==========================================================================

    $Detall_AllowanceCharge = $xml->createElement("detallista:allowanceCharge");
    $Detallista->appendChild($Detall_AllowanceCharge);
    
    cargaAttSinIntACad($Detall_AllowanceCharge, array(
                        "allowanceChargeType"=>"ALLOWANCE_GLOBAL",
                        "settlementType"=>"BILL_BACK"
                        )
                    );
    
        $Detall_SpeSerType = $xml->createElement("detallista:specialServicesType","AJ");
        $Detall_AllowanceCharge->appendChild($Detall_SpeSerType);    

        $Detall_MonOrPerc = $xml->createElement("detallista:monetaryAmountOrPercentage");
        $Detall_AllowanceCharge->appendChild($Detall_MonOrPerc);

            $Detall_Rate = $xml->createElement("detallista:rate");
            $Detall_MonOrPerc->appendChild($Detall_Rate);

            cargaAttSinIntACad($Detall_Rate, array(
                                "base"=>"INVOICE_VALUE"
                                )
                            );
            
            $Detall_Percent = $xml->createElement("detallista:percentage", "3.00");
            $Detall_Rate->appendChild($Detall_Percent);

            
    //==========================================================================

    $Detall_lineItem = $xml->createElement("detallista:lineItem");
    $Detallista->appendChild($Detall_lineItem);
            
        cargaAttSinIntACad($Detall_lineItem, array(
                            "number"=>"1",
                            "type"=>"SimpleInvoiceLineItemType"
                            )
                        );

    $Detall_tradeItemIdent = $xml->createElement("detallista:tradeItemIdentification");
    $Detall_lineItem->appendChild($Detall_tradeItemIdent);
    
    $Detall_gtin = $xml->createElement("detallista:gtin", "00636398");
    $Detall_tradeItemIdent->appendChild($Detall_gtin);
        
   
    $Detall_AltTraIteIde = $xml->createElement("detallista:alternateTradeItemIdentification", "00636398");
    $Detall_lineItem->appendChild($Detall_AltTraIteIde);
    
    cargaAttSinIntACad($Detall_AltTraIteIde, array(
                        "type"=>"SUPPLIER_ASSIGNED"
                        )
                    );
        
    $Detall_TradeItemDesInf = $xml->createElement("detallista:tradeItemDescriptionInformation");
    $Detall_lineItem->appendChild($Detall_TradeItemDesInf);
    
    cargaAttSinIntACad($Detall_TradeItemDesInf, array(
                        "language"=>"ES"
                        )
                    );

    $Detall_LongText = $xml->createElement("detallista:longText", "cacahuate acaramelado");
    $Detall_TradeItemDesInf->appendChild($Detall_LongText);
    
    
    $Detall_InvQuan = $xml->createElement("detallista:invoicedQuantity", "10.00");
    $Detall_lineItem->appendChild($Detall_InvQuan);
    
    cargaAttSinIntACad($Detall_InvQuan, array(
                        "unitOfMeasure"=>"PCE"
                        )
                    );

    $Detall_GrossPrice = $xml->createElement("detallista:grossPrice");
    $Detall_lineItem->appendChild($Detall_GrossPrice);
    
    $Detall_Amount = $xml->createElement("detallista:Amount", "40.00");
    $Detall_GrossPrice->appendChild($Detall_Amount);
    
    
    $Detall_NetPrice = $xml->createElement("detallista:netPrice");
    $Detall_lineItem->appendChild($Detall_NetPrice);
    
    $Detall_Amount = $xml->createElement("detallista:Amount", "34.32");
    $Detall_NetPrice->appendChild($Detall_Amount);
    

    $Detall_TotLinAmount = $xml->createElement("detallista:totalLineAmount");
    $Detall_lineItem->appendChild($Detall_TotLinAmount);

        $Detall_GrossAmount = $xml->createElement("detallista:grossAmount");
        $Detall_TotLinAmount->appendChild($Detall_GrossAmount);

        $Detall_Amount = $xml->createElement("detallista:Amount", "400.00");
        $Detall_GrossAmount->appendChild($Detall_Amount);

            $Detall_netAmount = $xml->createElement("detallista:netAmount");
            $Detall_TotLinAmount->appendChild($Detall_netAmount);

            $Detall_Amount = $xml->createElement("detallista:Amount", "343.17");
            $Detall_netAmount->appendChild($Detall_Amount);
    
    
    $Detall_TotalAmount = $xml->createElement("detallista:totalAmount");
    $Detallista->appendChild($Detall_TotalAmount);    
            
        $Detall_Amount = $xml->createElement("detallista:Amount", "3955.00");
        $Detall_TotalAmount->appendChild($Detall_Amount);
        
            $cadena_original .= "3955.00"."|";
            
    $Detall_TotAllChar = $xml->createElement("detallista:TotalAllowanceCharge");
    $Detallista->appendChild($Detall_TotAllChar);

    cargaAttSinIntACad($Detall_TotAllChar, array(
                        "allowanceOrChargeType"=>"ALLOWANCE"
                        )
                    );
    
        $Detall_SpecSercType = $xml->createElement("detallista:specialServicesType", "AJ");
        $Detall_TotAllChar->appendChild($Detall_SpecSercType);
        
            $cadena_original .= "AJ"."|";

        $Detall_Amount = $xml->createElement("detallista:Amount", "561.96");
        $Detall_TotAllChar->appendChild($Detall_Amount);
        
            $cadena_original .= "561.96"."|";
        
            
        
// FIN DEL COMPLEMENTO "DETALLISTA" ============================================
    
    
    #== 11.6 Termina de conformarse la "Cadena original" con doble ||
    $cadena_original .= "|";   
    
        $file = fopen($SendaCFDI."CadenaOriginal_Factura_Detallista_".$NoFac.".txt", "w");
        fwrite($file, $cadena_original . PHP_EOL);
        fclose($file);
        chmod($SendaCFDI."CadenaOriginal_Factura_Detallista_".$NoFac.".txt", 0777);      
    
    #=== Muestra la cadena original (opcional a mostrar) =======================
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'CADENA ORIGINAL';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo $cadena_original;
    echo '</div><br>';
    
    
    
    
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
    
    
    $NomArchCFDI = $SendaCFDI."PreCFDI-33_Factura_Detallista_".$NoFac.".xml";
    
    
    #=== 11.12 Se guarda el archivo .XML antes de ser timbrado =======================
    $cfdi = $xml->saveXML();
    $xml->formatOutput = true;             
    $xml->save($NomArchCFDI); // Guarda el archivo .XML (sin timbrar) en el directorio predeterminado.
    unset($xml);
    
    #=== 11.13 Se dan permisos de escritura al archivo .xml. =========================
    chmod($NomArchCFDI, 0777); 
    
    
##### FIN DE LA CREACIÓN DEL ARCHIVO .XML ANTES DE SER TIMBRADO ####################################################   
    
    
    
    
### 12. PROCESO DE TIMBRADO ########################################################
    
    #=== Se muestra el .XML antes de ser timbrado (opcional a mostrar)==========
    echo '<div style="font-size: 11pt; color: #000099; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'FACTURA .XML A TIMBRAR';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo htmlspecialchars($cfdi);
    echo '</div><br>';    
    
    #== 12.1 Se crea una variable de tipo DOM y se le carga el CFDI =================================
    $xml2 = new DOMDocument();
    $xml2->loadXML($cfdi); 

    
    #== 12.2 Convirtiendo el contenido del CFDI a BASE 64 ======================
    $xml_cfdi_base64 = base64_encode($cfdi);

    
    #== 12.3 Datos de acceso al servidor de pruebas ============================
    $process  = curl_init('https://demo-facturacion.finkok.com/servicios/soap/stamp.wsdl');     
    
    #== 12.4 Datos de acceso al servidor de producción =========================
    # $process = curl_init('https://facturacion.finkok.com/servicios/soap/stamp.wsdl');    
    
    
#== 12.5 Creando el SOAP de envío ==============================================
    
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
  
    #== 12.6 Proceso para guardar los datos que se envían al servidor en un archivo .XML ========================
    $NomArchSoap = $SendaCFDI."DatosEnvio_Factura_Detallista_".$NoFac.".xml";

        #== 12.6.1 Si el archivo ya se encuentra se elimina ===========================
        if (file_exists ($NomArchSoap)==true){
            unlink($NomArchSoap);
        }
    
        #== 12.6.2 Se crea el archivo .XML con el SOAP ================================
//        $fp = fopen($NomArchSoap,"a");
//        fwrite($fp, $cfdixml);
//        fclose($fp);     
//        chmod($NomArchSoap, 0777);
    
    
    #=== 12.7 Muestra el contenido del SOAP que se envía al servidor del PAC (REQUEST) =========================
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'CONTENIDO DEL SOAP QUE SE ENVIA AL SERVIDOR DEL PAC';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo htmlspecialchars($cfdixml);
    echo '</div><br>';      

    #== 12.8 Se envía el contenido del SOAP al servidor del PAC =====================
    curl_setopt($process, CURLOPT_HTTPHEADER, array('Content-Type: text/xml',' charset=utf-8'));
    curl_setopt($process, CURLOPT_POSTFIELDS, $cfdixml);  
    curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($process, CURLOPT_POST, true);
    curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($process, CURLOPT_SSL_VERIFYHOST, false);
    $RespServ = curl_exec($process);

    #== 12.9 Se muestra la respuesta del servidor del PAC (opcional a mostrar) ================
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'RESPUESTA DEL SERVIDOR DEL PAC';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo htmlspecialchars($RespServ);
    echo '</div><br>';              

    curl_close($process);    
    
## FIN DEL PROCESO DE TIMBRADO #################################################
    
    
    
    
## 13. PROCESOS POSTERIORES AL TIMBRADO ########################################
    
    #== 13.1 Se asigna la respuesta del servidor a una variable de tipo DOM ====
    $VarXML = new DOMDocument();
    $VarXML->loadXML($RespServ);

    #== 13.2 Se graba la respuesta del servidor a un archivo .xml
    $VarXML->save($SendaCFDI."RespServ_Factura_Detallista_".$NoFac.".xml");
    chmod($SendaCFDI."RespServ_Factura_Detallista_".$NoFac.".xml", 0777);

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

            #=== 13.6 Guardando el CFDI en archivo .XML  ============================

            $NomArchXML = "CFDI-33_Factura_Detallista_".$NoFac.".xml";
            $NomArchPDF = "CFDI-33_Factura_Detallista_".$NoFac.".pdf";

            $xmlt = new DOMDocument();
            $xmlt->loadXML($valor_del_nodo);
            $xmlt->save($SendaCFDI.$NomArchXML); 
            chmod($SendaCFDI.$NomArchXML, 0777);
            
                #== 13.6.1 Convertir archivo .XML a UTF-8 (OPCIONAL).
//                $file_name = $SendaCFDI.$NomArchXML;
//                $f = file_get_contents($file_name);
//                $f = iconv("WINDOWS-1252", "UTF-8", $f);
//                file_put_contents($file_name, "\xEF\xBB\xBF".$f);
                

            #== 13.7 Procesos para extraer datos del Timbre Fiscal del CFDI =========
            $docXML = new DOMDocument();
            $docXML->load($SendaCFDI."CFDI-33_Factura_Detallista_".$NoFac.".xml");
            
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
            
            #== 13.8.1 Se muestra el número de factura asignado por el sistema local (no asingado por el SAT).
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
            
            #== 13.9 Se crea el archivo .PNG con codigo bidimensional =================================
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
                        
                    <input type="button" value="Imprimir factura" onclick="ImprimirFact()" />
                    &nbsp;&nbsp;
                    <input type="button" value="Descargar archivo .XML del CFDI"  onclick="DescargarFact()" />
                    &nbsp;&nbsp;
                    <input type="button" value="Cancelar CFDI"  onclick="CancelarFact()" />
                    &nbsp;&nbsp;
                    

                    <script type="text/javascript">
                        
                        function ImprimirFact(){
                            window.open("pdf_fact.php?NomArchXML=<?php echo $NomArchXML ?>&NomArchPDF=<?php echo $NomArchPDF ?>","_blank");
                        }
                        
                        function DescargarFact(){
                            window.open("descargar_xml.php?NomArchXML=<?php echo $NomArchXML ?>","_blank");
                        }

                        function CancelarFact(){;
                            window.open("07_cancelar.php?FolioFiscal=<?php echo $tim_uuid ?>&NoFact=<?php echo $NoFac ?>&UserName=<?php echo $username ?>&PassWord=<?php echo $password ?>","_blank");;
                        };

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

        
    
    
### 14. FUNCIONES DEL MÓDULO #########################################################
        
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
    

   
    
    
    