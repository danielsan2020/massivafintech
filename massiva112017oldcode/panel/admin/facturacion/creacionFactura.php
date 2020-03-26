<?php
@session_start();
header('Content-Type: text/html; charset=UTF-8');
include("qrlib/qrlib.php");

/* instanciamos el archivo para las consutlas */
include '../modelo/consultaGeneraFac.php';
require_once "../modelo/datosKey.php";
$consultaFac = new consultaFac();

/* obtenemos las variablkes que s eutilizar par la creacion de la factura */
$idfactura = $_GET['idFactura'];
$id_usuario = $_SESSION['id_usuario'];
$rfc = $_SESSION['rfc'];

/* obtenemos los datos del cliente */
$rspUsuario = $consultaFac->informacionUsu($id_usuario);
$rspUsuarioInfo = $rspUsuario->fetch_object();
$cpEmi = $rspUsuarioInfo->municipio;
$nombreEmi = $rspUsuarioInfo->nombre." ".$rspUsuarioInfo->ape_paterno." ".$rspUsuarioInfo->ape_materno;
$rfcEmi = $rspUsuarioInfo->rfc;
echo "<br>";
echo $cpEmi;
echo "<br>";
echo $nombreEmi;
echo "<br>";
echo $rfcEmi;
echo "<br>";



/* archivos para facturacion del cliente */
$rspTabla = $consultaFac->informacionARchivos($id_usuario);
$rspTablaInfo = $rspTabla->fetch_object();
/* sacamos los archivos */
$keyaar = $rspTablaInfo->keyaar;
$cerar = $rspTablaInfo->cerar;
$keyaarPem = $rspTablaInfo->keypem;
$cerarPem = $rspTablaInfo->cerpem;
$certificado = $rspTablaInfo->certificado;
$clave = $rspTablaInfo->clave;

/* obtenemos la clave original */
$calv = $clave;
$key=hash('sha256', SECRET_KEY);
$iv=substr(hash('sha256', SECRET_IV), 0, 16);
$output=openssl_decrypt(base64_decode($calv), METHOD, $key, 0, $iv);

/* obtenemos los valores de la factura en cuestion */
$rspFac = $consultaFac->informacionFactura($idfactura);
$rspFacInfo = $rspFac->fetch_object();

$idFactura = $rspFacInfo->idFactura;
$datoscompletos = $rspFacInfo->datoscompletos;
$andire = $rspFacInfo->andire;
$uso = $rspFacInfo->uso;
$metodo = $rspFacInfo->metodo;
$forma = $rspFacInfo->forma;
$moneda = $rspFacInfo->moneda;
$tipoCambio = $rspFacInfo->tipoCambio;
$subtotal = $rspFacInfo->subtotal;
$descuentos = $rspFacInfo->descuentos;
$total = $rspFacInfo->total;
$fechaSolicitud = $rspFacInfo->fechaSolicitud;
$estatus = $rspFacInfo->estatus;
$idCliente = $rspFacInfo->idCliente;
$iva = $rspFacInfo->iva;

echo "<hr>";
echo $idFactura;
echo "<br>";
echo $datoscompletos;
echo "<br>";
echo $andire;
echo "<br>";
echo $uso;
echo "<br>";
echo $metodo;
echo "<br>";
echo $forma;
echo "<br>";
echo $moneda;
echo "<br>";
echo $tipoCambio;
echo "<br>";
echo $subtotal;
echo "<br>";
echo $descuentos;
echo "<br>";
echo $total;
echo "<br>";
echo $fechaSolicitud;
echo "<br>";
echo $estatus;
echo "<br>";
echo $idCliente;
echo "<br>";
echo $iva;

/* obtenemos los datos del cliente */
$rspClien = $consultaFac->informacinCliente($idCliente);
$rspClienInfo = $rspClien->fetch_object();

$logo = $rspClienInfo->logo; 
$nombreE = $rspClienInfo->nombreE;
$razonSocialE = $rspClienInfo->razonSocialE;
$rfcE = $rspClienInfo->rfcE;
$dirE = $rspClienInfo->dirE;
$coloniaE = $rspClienInfo->coloniaE;
$cpE = $rspClienInfo->cpE;
$estadoE = $rspClienInfo->estadoE;
$ciudadE = $rspClienInfo->ciudadE;
$paisE = $rspClienInfo->paisE;
$telE = $rspClienInfo->telE;
$correo1E = $rspClienInfo->correo1E;
$correo2E = $rspClienInfo->correo2E;
$correo3E = $rspClienInfo->correo3E;
$creditoE = $rspClienInfo->creditoE;
$observacionesE = $rspClienInfo->observacionesE;
$cuenta = $rspClienInfo->cuenta;
$fechaCreacion = $rspClienInfo->fechaCreacion;
$estatus = $rspClienInfo->estatus;
$fijo = $rspClienInfo->fijo;

echo "<hr>";
echo $logo;
echo "<br>";
echo $nombreE;
echo "<br>";
echo $razonSocialE;
echo "<br>";
echo $rfcE;
echo "<br>";
echo $dirE;
echo "<br>";
echo $coloniaE;
echo "<br>";
echo $cpE;
echo "<br>";
echo $estadoE;
echo "<br>";
echo $ciudadE;
echo "<br>";
echo $paisE;
echo "<br>";
echo $telE;
echo "<br>";
echo $correo1E;
echo "<br>";
echo $correo2E;
echo "<br>";
echo $correo3E;
echo "<br>";
echo $creditoE;
echo "<br>";
echo $observacionesE;
echo "<br>";
echo $cuenta;
echo "<br>";
echo $fechaCreacion;
echo "<br>";
echo $estatus;
echo "<br>";
echo $fijo;

/* obtenemos los productos de la factua */
$productoFac1 = $consultaFac->productoFac($idfactura);
$productoFac2 = $consultaFac->productoFac($idfactura);
$productoFac3 = $consultaFac->productoFac($idfactura);
$productoFac4 = $consultaFac->productoFac($idfactura);
$productoFac5 = $consultaFac->productoFac($idfactura);
$productoFac6 = $consultaFac->productoFac($idfactura);

/* variables para arrays */
$nombreSatInfo = '';
$clavesatInfo = '';
$cantidadsatInfo = '';
$preciosatInfo = '';
$totalsatInfo = '';
$desceuntoInfo = '';

/* creacion de los array */
while($productoFacInfo = $productoFac1->fetch_object()){
    $nombreSatInfo .= "".$productoFacInfo->nombreSat."',";
}
$nombreSatInfo = substr($nombreSatInfo, 0, -1);

/*  */
while($productoFacInfo = $productoFac2->fetch_object()){
    $clavesatInfo .= "'".$productoFacInfo->clavesat."',";
}
$clavesatInfo = substr($clavesatInfo, 0, -1);

/*  */
while($productoFacInfo = $productoFac3->fetch_object()){
    $cantidadsatInfo .= "'".$productoFacInfo->cantidad."',";
}
$cantidadsatInfo = substr($cantidadsatInfo, 0, -1);

/*  */
while($productoFacInfo = $productoFac4->fetch_object()){
    $preciosatInfo .= "'".$productoFacInfo->precio."',";
}
$preciosatInfo = substr($preciosatInfo, 0, -1);

/*  */
while($productoFacInfo = $productoFac5->fetch_object()){
    $totalsatInfo .= "'".$productoFacInfo->total."',";
}
$totalsatInfo = substr($totalsatInfo, 0, -1);


/* valores para descuento */
while($descuentocInfo = $productoFac6->fetch_object()){
    $desceuntoInfo .= "'0',";
}
$descuentocInfo = substr($descuentocInfo, 0, -1);



echo "<hr>";
echo $nombreSatInfo;
echo "<br>";
echo $clavesatInfo;
echo "<br>";
echo $cantidadsatInfo;
echo "<br>";
echo $preciosatInfo;
echo "<br>";
echo $totalsatInfo;
echo "<br>";

### CÓDIGO FUENTE, FACTURACIÓN ELECTRÓNICA CFDI VERSIÓN 3.3 ACORDE A LOS REQUIRIMIENTOS DEL SAT, ANEXO 20.

echo '<div style="font-size: 12pt; color: #B40404; margin-bottom: 10px; margin-top: 8px; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'PROCESO DE TIMBRADO PARA "FACTURAR". CFDI VERSIÓN 3.3';
echo '</div>';    

### 1. CONFIGURACIÓN INICIAL ######################################################

    # 1.1 Configuración de zona horaria
    date_default_timezone_set('America/Mexico_City'); 
    
    
    # 1.2 Muestra la zona horaria predeterminada del servidor (opcional a mostrar)
    echo '<div style="font-size: 10pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'ZONA HORARIA PREDETERMINADA';
    echo '</div>';
    echo '<div style="font-size: 10pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo date_default_timezone_get();
    echo '</div><br>';


### 2. ASIGNACIÓN DE VALORES A VARIABLES ###################################################
    $SendaPEMS  = "../contenedor/clientes/".$rfc."/";   // 2.1 Directorio en donde se encuentran los archivos *.cer.pem y *.key.pem (para efectos de demostración se utilizan los que proporciona el SAT para pruebas).
    $SendaCFDI  = "../contenedor/clientes/".$rfc."/facturas/";  // 2.2 Directorio en donde se almacenarán los archivos *.xml (CFDIs).
    $SendaGRAFS = "archs_graf/";  // 2.3 Directorio en donde se almacenan los archivos .jpg (logo de la empresa) y .png (códigos bidimensionales).
    $SendaXSD   = "archs_xsd/";   // 2.4 Directorio en donde se almacenan los archivos .xsd (esquemas de validación, especificaciones de campos del Anexo 20 del SAT);
    
    // 2.5 Datos de acceso del usuario (proporcionados por www.finkok.com) modo de integración (para pruebas) o producción.
    $username = "MCI190207D33";
    $password = "contRa$3na"; 
    
    ### MUESTRA LOS DATOS DEL USUARIO QUE ESTÁ TIMBRANDO (OPCIONAL A MOSTRAR) ######
    echo '<div style="font-size: 10pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'DATOS DEL USUARIO QUE ESTÁ TIMBRANDO';
    echo '</div>';
    echo '<div style="font-size: 10pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'USUARIO: <span style="color: #088A29; font-size: 11pt;">'.$username."</span><br>";
    echo 'PASSWORD: <span style="color: #088A29; font-size: 11pt;">'.$password."</span><br>";
    echo '</div><br>';    
    
    
### 3. DEFINICIÓN DE VARIABLES INICIALES ##########################################
    $noCertificado = $certificado;  // 3.1 Número de certificado.
    $file_cer      = $cerarPem;  // 3.2 Nombre del archivo .cer.pem 
    $file_key      = $keyaarPem;  // 3.3 Nombre del archivo .cer.key

    echo "<br>";
    echo $noCertificado;
    echo "<br>";
    echo $file_cer;
    echo "<br>";
    echo $file_key;
    echo "<hr>";
    
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
    $metodoDePago      = $metodo;                           // 4.14 Clave del método de pago. Consultar catálogos de métodos de pago del SAT.
    $TipoCambio        = 1;                               // 4.15 Tipo de cambio de la moneda.
    $LugarExpedicion   = $cpE;                         // 4.16 Lugar de expedición (código postal).
    $moneda            = $moneda;                           // 4.17 Moneda
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
    
    $Array_ClaveProdServ    = [$clavesatInfo]; // 6.1 Clave del SAT correspondiente al artículo o servicio (consultar el catálogo de productos del SAT).
    $Array_NoIdentificacion = [$nombreSatInfo];    // 6.2 Clave asignada al artículo o servicio, sistema local.
    $Array_Cantidad         = [$cantidadsatInfo];                           // 6.3 Cantidad.
    $Array_ClaveUnidad      = [$descuentocInfo];                      // 6.4 Clave del SAT correspondiente a la unidad de medida (consultar el catálogo de productos del SAT).
    $Array_Unidad           = [$descuentocInfo];             // 6.5 Descripción de la unidad de medida.
    $Array_Descripcion      = [$nombreSatInfo]; // 6.6 Descripción del artículo o servicio.
    $Array_ValorUnitario    = [$preciosatInfo];              // 6.7 Valor unitario del artículo o servicio.
    $Array_Importe          = [$totalsatInfo];          // 6.8 Importe del artículo o servicio.
    $Array_Descuento        = [$descuentocInfo];                             // 6.9 Descuento aplicado al artículo o servicio.
    
    
 ### 7. ARRAYS QUE CONTIENEN LOS IMPUESTOS TRASLADADOS Y RETENIDOS POR CONCEPTO #############

    // Trasladados.
    $ArrayTraslado_Base       = ['627.50', '107.40', '458.50', '50.00'];           // 7.1 Atributo requerido para señalar la base para el cálculo del impuesto, la determinación de la base se realiza de acuerdo con las disposiciones fiscales vigentes. No se permiten valores negativos
    $ArrayTraslado_Impuesto   = ['002', '002', '002', '002'];                      // 7.2 Atributo requerido para señalar la clave del tipo de impuesto trasladado aplicable al concepto (consultar catálogos del SAT).
    $ArrayTraslado_TipoFactor = ['Tasa', 'Tasa', 'Tasa', 'Exento'];                  // 7.3 Atributo requerido para señalar la clave del tipo de factor que se aplica a la base del impuesto (consultar catálogos del SAT).
    $ArrayTraslado_TasaOCuota = ['0.160000', '0.160000', '0.160000', '0.000000'];  // 7.4 Atributo condicional para señalar el valor de la tasa o cuota del impuesto que se traslada para el presente concepto. Es requerido cuando el atributo TipoFactor tenga una clave que corresponda a Tasa o Cuota (consultar catálogos del SAT).
    $ArrayTraslado_Importe    = ['100.40', '17.18', '73.36', '0'];                // 7.5 Atributo condicional para señalar el importe del impuesto trasladado que aplica al concepto. No se permiten valores negativos. Es requerido cuando TipoFactor sea Tasa o Cuota
    
    
    // Retenidos.
//    $ArrayRetencion_Base = ['0', '0', '0'];                // 7.6 Atributo requerido para señalar la base para el cálculo de la retención, la determinación de la base se realiza de acuerdo con las disposiciones fiscales vigentes. No se permiten valores negativos.
//    $ArrayRetencion_Impuesto = ['0', '0', '0'];            // 7.7 Atributo requerido para señalar la clave del tipo de impuesto retenido aplicable al concepto (consultar catálogos del SAT).
//    $ArrayRetencion_TipoFactor = ['Tasa', 'Tasa', 'Tasa']; // 7.8 Atributo requerido para señalar la clave del tipo de factor que se aplica a la base del impuesto (consultar catálogos del SAT).
//    $ArrayRetencion_TasaOCuota = ['0.10', '0.10', '0.10']; // 7.9 Atributo requerido para señalar la tasa o cuota del impuesto que se retiene para el presente concepto (consultar catálogos del SAT).
//    $ArrayRetencion_Importe = ['0', '0', '0'];             // 7.10 Atributo requerido para señalar el importe del impuesto retenido que aplica al concepto. No se permiten valores negativos.
    
    
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
    
    $emisor_rs     = $nombreEmi;  // 9.1 Nombre o Razón social.
    $emisor_rfc    = $rfcEmi;                        // 9.2 RFC (al momento de timbrar el SAT comprueba que el RFC se encuentre registrado y vigente en su base de datos)
    $emisor_ClaRegFis = "601"; // 9.3 Clave del Régimen fiscal.    
        
    
### 10. DATOS GENERALES DEL RECEPTOR (CLIENTE) #####################################
    
    $RFC_Recep = $rfcE;                                                              // 10.1 RFC (al momento de timbrar el SAT comprueba que el RFC se encuentre registrado y vigente en su base de datos).
    if (strlen($RFC_Recep)==12){$RFC_Recep = " ".$RFC_Recep; }else{$RFC_Recep = $RFC_Recep;}  // 10.2 Al RFC de personas morales se le antecede un espacio en blanco para que su longitud sea de 13 caracteres ya que estos son de longitud 12.
    $receptor_rfc = $RFC_Recep;                                                               // 10.3 RFC.
    $receptor_rs  = $razonSocialE;                       // 10.4 Nombre o razón social.
    

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
                            "RegimenFiscal"=>$emisor_ClaRegFis
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
        
          // Descomentar si se desea obtener en archivo .TXT la Cadena Original.
//        $file = fopen($SendaCFDI."CadenaOriginal_Factura_".$NoFac.".txt", "w");
//        fwrite($file, $cadena_original . PHP_EOL);
//        fclose($file);
//        chmod($SendaCFDI."CadenaOriginal_Factura_".$NoFac.".txt", 0777);      
    
    #=== Muestra la cadena original (opcional a mostrar) =======================
    echo '<div style="font-size: 11pt; color: #000099; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo 'CADENA ORIGINAL';
    echo '</div>';
    echo '<div style="font-size: 9pt; color: #000000; ; font-family: Verdana, Arial, Helvetica, sans-serif;">';
    echo $cadena_original;
    echo '</div><br>';
    
    
    # 11.7 PROCESO OPCIONAL, NO NECESARIO PARA TIMBRAR UN DOCUMENTO FISCAL #####
    #== Proceso para agregar una Addenda con datos del sistema local (estos datos son ignorados por el PAC al momento de timbrar el documento XML). 
    
//    // 11.17.1 Datos a integrar a la Addenda ===================================
//    $IdEmpresa        = "TX34JK83";
//    $UsuarioDeSistema = "ALEJANDRA OROSIO";
//    $Fecha            = date("d/m/Y");
//    $Hora             = date("H:i:s");
//    $TipDocOrigen     = "PEDIDO";
//    $FolioDocOrigen   = "A345";
//    $Observaciones    = "ESTE ES UN EJEMPLO DE TEXTO CORRESPONDIENTE A OBSERVACIONES CAPTURADAS POR EL USUARIO QUE SE INTEGRAN AL DOCUMENTO .XML DEL CFDI COMO UNA ADDENDA DEL SISTEMA LOCAL, NO ES REQUISITO PARA TIMBRAR UN CFDI VERSION 3.3";
//    
//    // 11.17.2 Integración del nodo "Addenda" al documento .XML ================
//    $Addenda = $xml->createElement("cfdi:Addenda");
//    $Addenda = $root->appendChild($Addenda);     
//    
//        $SisLoc = $xml->createElement("cfdi:SistemaLocal");
//        $SisLoc = $Addenda->appendChild($SisLoc);
//    
//        cargaAttSinIntACad($SisLoc, array(
//                "IdEmpresa"=>$IdEmpresa,
//                "UsuarioDeSistema"=>$UsuarioDeSistema,
//                "Fecha"=>$Fecha,
//                "Hora"=>$Hora,
//                "TipoDocOrigen"=>$TipDocOrigen,
//                "FolioDocOrigen"=>$FolioDocOrigen,
//                "Observaciones"=>$Observaciones
//            )
//        );
        
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
    $process  = curl_init('https://app.fel.mx/WSTimbrado33Test/WSCFDI33.svc?WSDL');    //http://www.fel.mx/WSTimbrado33Test/WSCFDI33.svc?wsdl
    
    #== 12.4 Datos de acceso al servidor de producción =========================
    # $process = curl_init('https://facturacion.finkok.com/servicios/soap/stamp.wsdl');    
    
    
#== 12.5 Creando el SOAP de envío ==============================================
    
$cfdixml = <<<XML
<?xml version="1.0" encoding="UTF-8"?> 
<SOAP-ENV:Envelope xmlns:ns0="http://schemas.xmlsoap.org/soap/envelope/"
    xmlns:ns1="http://www.fel.mx/WSTimbrado33Test/WSCFDI33.svc?wsdl"
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
    $NomArchSoap = $SendaCFDI."DatosEnvio_Factura_".$NoFac.".xml";

        #== 12.6.1 Si el archivo ya se encuentra se elimina ===========================
        if (file_exists ($NomArchSoap)==true){
            unlink($NomArchSoap);
        }
    
        #== 12.6.2 Se crea el archivo .XML con el SOAP ================================
        $fp = fopen($NomArchSoap,"a");
        fwrite($fp, $cfdixml);
        fclose($fp);     
        chmod($NomArchSoap, 0777);
    
    
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
    $RespServ = ($process);

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
    $VarXML->save($SendaCFDI."RespServ_Factura_".$NoFac.".xml");
    chmod($SendaCFDI."RespServ_Factura_".$NoFac.".xml", 0777);

    echo "<hr size=2 color=blue >";

    #== 13.3 Se asigna el contenido del tag "xml" a una variable ===============
    $RespServ = $VarXML->getElementsByTagName('xml');


    #== 13.4 Se obtiene el valor del nodo ======================================
    
    $valor_del_nodo = "";
    
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

            $NomArchXML = "CFDI-33_Factura_".$NoFac.".xml";
            $NomArchPDF = "CFDI-33_Factura_".$NoFac.".pdf";

            $xmlt = new DOMDocument();
            $xmlt->loadXML($valor_del_nodo);
            $xmlt->save($SendaCFDI.$NomArchXML); 
            chmod($SendaCFDI.$NomArchXML, 0777);
            

            #== 13.7 Procesos para extraer datos del Timbre Fiscal del CFDI =========
            $docXML = new DOMDocument();
            $docXML->load($SendaCFDI."CFDI-33_Factura_".$NoFac.".xml");
            
            $params = $docXML->getElementsByTagName("Comprobante");
            foreach ($params as $param) {
                $VersionCFDI = $param->getAttribute("Version");
                $Total       = $param->getAttribute('Total');
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

                echo '<div style="font-size: 14pt; line-height: 26px;">';
                    echo 'Versión de CFDI: <span style="color: #088A29;">'.$VersionCFDI.'</span><br>';
                    echo 'Versión de timbre: <span style="color: #088A29;">'.$version_timbre.'</span><br>';
                    echo 'Sello del SAT: <span style="color: #088A29">'.$sello_SAT.'</span><br>';
                    echo 'Certificado del SAT: <span style="color: #088A29">'.$cert_SAT.'</span><br>';
                    echo 'Sello del CFDI: <span style="color: #088A29">'.$sello_CFD.'</span><br>';
                    echo 'Fecha de timbrado: <span style="color: #088A29">'.$tim_fecha.'</span><br>';
                    echo 'Folio fiscal: <span style="color: #000099">'.$tim_uuid.'</span><br>';
                    echo 'Importe total: <span style="color: #000099;">'.$Total.'</span><br><br>';
                echo '</div>';
            }
            
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
                    <br><br>
                    <div style="color: #5C5C5C;">Antes de verifica si un CFDI es cancelable o no <span style="color: #A70202;">espere unos 3 min.</span>  para que<br>el UUID del CFDI recien timbrado esté disponible en el servidor del SAT.</div>
                    <br>
                    <input type="button" value="Verificar si el CFDI es cacelable sin aceptación."  onclick="VerifSatusCFDI()" />
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
                        
                        function VerifSatusCFDI(){
                            window.open("02_StatusCancel.php?UUID=<?php echo $tim_uuid ?>&ImpTot=<?php echo $Total ?>&NoFac=<?php echo $NoFac ?>&UserName=<?php echo $username ?>&PassWord=<?php echo $password ?>","_blank");;
                        }

                        function CancelarFact(){;
                            window.open("03_CancelarCFDI.php?UUID=<?php echo $tim_uuid ?>&ImpTot=<?php echo $Total ?>&NoFac=<?php echo $NoFac ?>&UserName=<?php echo $username ?>&PassWord=<?php echo $password ?>","_blank");;
                        };

                    </script>
                        
                    </div>
                    
                </body>
                
            </html>
            .0
            <?php
          
        }else{
            
            #== 13.11 En caso de error de timbrado se muestran los detalles al usuario.
            
            $valorNod = "";
            
            $codigoError = $VarXML->getElementsByTagName('CodigoError');

            foreach($codigoError as $NodoStatus){
                $valorNod = $NodoStatus->nodeValue; 
            }        
            
            echo '<div style="font-size: 11pt; color: #000099; font-family: Verdana, Arial, Helvetica, sans-serif;">';
            echo 'CÓDIGO DE ERROR.';
            echo '</div>';
            echo '<div style="font-size: 14pt; color: #A70202; font-family: Verdana, Arial, Helvetica, sans-serif; margin-bottom: 200px;" >';
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
 