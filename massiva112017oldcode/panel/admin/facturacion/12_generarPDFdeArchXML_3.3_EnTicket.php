<?php
header('Content-Type: text/html; charset=UTF-8');
require('fpdf/fpdf.php');
include("qrlib/qrlib.php");
include("funciones.php");
require('ext_pdf_factura.php');

$Fec1 = date("d/m/Y");
$Fec2 = date("Y/m/d");
$Hora = date("H:i:s");

#== Definición de constantes ===============================================
$SumaImportes=0; $TotImpuestos=0; $UUID_Ori=""; $IdEmpr=""; $ClaSuc=""; $X=0; $Y=0;
$NomArch=""; $Senda=""; $Archivo="";


$NomArch = "CFDI_3.3_Factura.xml";
$Senda = "";
$SendaArchsGraf = "archs_graf/";

$Archivo = $NomArch;
$xml = file_get_contents($Archivo);

#== Leyendo datos del archivo .XML =========================================

    #== 2. Obteniendo datos del archivo .XML =========================================

        $DOM = new DOMDocument('1.0', 'utf-8');
        $DOM->preserveWhiteSpace = FALSE;
        $DOM->loadXML($xml);

        $params = $DOM->getElementsByTagName('TimbreFiscalDigital');
        foreach ($params as $param) {
               $UUID     = $param->getAttribute('UUID');
               $noCertificadoSAT = $param->getAttribute('NoCertificadoSAT');
               $selloCFD = $param->getAttribute('SelloCFD');
               $selloSAT = $param->getAttribute('SelloSAT');
               $FechaCert = $param->getAttribute('FechaTimbrado');
        }      

        $params = $DOM->getElementsByTagName('Emisor');
        foreach ($params as $param) {
               $Emisor_Nom = $param->getAttribute('Nombre');
               $Emisor_RFC = $param->getAttribute('Rfc');
               $Emisor_Regimen = $param->getAttribute('RegimenFiscal');
        }    

        $params = $DOM->getElementsByTagName('Receptor');
        foreach ($params as $param) {
               $Receptor_Nom = $param->getAttribute('Nombre');
               $Receptor_RFC = $param->getAttribute('Rfc');
               $Receptor_UsoCFDI = $param->getAttribute('UsoCFDI');
        }    


        $params = $DOM->getElementsByTagName('Comprobante');
        foreach ($params as $param) {
               $Fact_Fecha    = $param->getAttribute('Fecha');
               $Fact_Serie    = $param->getAttribute('Serie');
               $Fact_Folio    = $param->getAttribute('Folio');
               $Fact_NoFact   = $Fact_Serie.$Fact_Folio;
               $descuento     = $param->getAttribute('Descuento');
               $subTotal      = $param->getAttribute('SubTotal');
               $total         = $param->getAttribute('Total');
               $version       = $param->getAttribute('Version');
               $noCertificado = $param->getAttribute('NoCertificado');
               $formaDePago   = $param->getAttribute('FormaPago');
               $metodoDePago  = $param->getAttribute('MetodoPago');
               $NumCtaPago    = "";
               $LugarExpedicion = $param->getAttribute('LugarExpedicion');
        }

        if (strlen($Fact_NoFact)==0){
            $Fact_NoFact = "S/N";
        }

        $i=0; $ImpTot = 0;
        $params = $DOM->getElementsByTagName('Concepto');
        foreach ($params as $param) {
               $ArrayClaveProdServ[$i] = $param->getAttribute('ClaveProdServ');
               $ArrayClaveUnidad[$i]   = $param->getAttribute('ClaveUnidad');
               $ArrayUnidad[$i]        = $param->getAttribute('Unidad');
               $ArrayCant[$i]          = $param->getAttribute('Cantidad');
               $ArrayUniMed[$i]        = $param->getAttribute('Unidad');
               $ArrayArtSer[$i]        = $param->getAttribute('Descripcion');
               $ArrayPreUni[$i]        = $param->getAttribute('ValorUnitario');
               $ArrayImporte[$i]       = $param->getAttribute('Importe');
               $SumaImportes = $SumaImportes + $ArrayImporte[$i];
               $i++;
        }       

        $ImporteTotalIVA = 0;
        $ImporteTotalIEPS = 0;
        $ultimoImporteIVA = 0;
        $ultimoImporteIEPS = 0;
        
        $params = $DOM->getElementsByTagName('Traslado');
        foreach ($params as $param) {
            $TotImpuestos =  $TotImpuestos + $param->getAttribute('Importe');

            if ($param->getAttribute('Impuesto')=="002"){ // IVA
                $ImporteTotalIVA  = $ImporteTotalIVA + $param->getAttribute('Importe');
                $ultimoImporteIVA = $param->getAttribute('Importe');
            }

            if ($param->getAttribute('Impuesto')=="003"){ // IEPS
                $ImporteTotalIEPS  = $ImporteTotalIEPS + $param->getAttribute('Importe');
                $ultimoImporteIEPS = $param->getAttribute('Importe');
            }
        }
        
        $ImporteTotalIVA  = $ImporteTotalIVA - $ultimoImporteIVA;
        $ImporteTotalIEPS = $ImporteTotalIEPS - $ultimoImporteIEPS;
        

        // Datos de un campo de la Addenda: "SistemaLocal" =========================
        $params = $DOM->getElementsByTagName('SistemaLocal');
        foreach ($params as $param) {
               $Obs = $param->getAttribute('Observaciones');
        }       

        $CadOri = "||".$UUID."|".$Fact_Fecha."|".$selloCFD."|".$noCertificado."||";

        #== 3. Crear archivo .PNG con codigo bidimensional =================================
        $filename = $SendaArchsGraf."/Img_".$UUID.".png";
        $CadImpTot = ProcesImpTot($total);
        $Cadena = "?re=".$Emisor_RFC."&rr=".$Receptor_RFC."&tt=".$CadImpTot."&id=".$UUID;
        QRcode::png($Cadena, $filename, 'H', 3, 2);    
        chmod($filename, 0777);  



//==================================================================================
// A partir de este punto se construye el documento para DETERMINAR las dimensiones
// del ticket.

    $Array[0] = 8;
    $Array[1] = 10;  
        
    $pdf=new FPDF('P','cm',$Array);

    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $pdf->SetMargins(0, 0, 0);

    $pdf->AddFont('IDAutomationHC39M','','IDAutomationHC39M.php');
    $pdf->AddFont('verdana','','verdana.php');
    $pdf->SetLineWidth(0.02);
    $pdf->SetFillColor(0,0,0);

    $X = 0;
    $Y = -0.5;
    $YY = 0;
    $YYY = 0;

    $pdf->SetFont('arial','B',12);
    $pdf->SetXY($X+0.3,$Y+1.6);
    $pdf->Cell(0.8, 0.30, utf8_decode("FACTURA V. 3.3"), 0, 1,'L', 0);
    
    $pdf->SetFont('arial','B',11);
    $pdf->SetXY($X+6.8,$Y+1.6);
    $pdf->Cell(0.8, 0.30, "No. ".$Fact_NoFact, 0, 1,'R', 0);
    
    $pdf->Line($X+0.4, $Y+2.2, $X+7.5, $Y+2.2);
    
    $Y = $Y + 0.3;
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3,$Y+2.2);
    $pdf->Cell(2, 0.25, "Folio fiscal:", 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7,$Y+2.6);
    $pdf->Cell(2, 0.25, $UUID, 0, 1,'L', 0);
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3,$Y+2.2+0.9);
    $pdf->Cell(2, 0.25, "Certificado SAT:", 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7,$Y+2.6+0.9);
    $pdf->Cell(2, 0.25, $noCertificadoSAT, 0, 1,'L', 0);

    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3,$Y+2.2+(0.9*2));
    $pdf->Cell(2, 0.25, "Certicado del emisor:", 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7,$Y+2.6+(0.9*2));
    $pdf->Cell(2, 0.25, $noCertificado, 0, 1,'L', 0);
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3,$Y+2.2+(0.9*3));
    $pdf->Cell(2, 0.25, utf8_decode("Lugar, fecha y hora de emisión:"), 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7,$Y+2.6+(0.9*3));
    $pdf->MultiCell(6.8, 0.35, utf8_decode($Emisor_Localidad." ".$Emisor_Estado." ".$Fact_Fecha), 0, 'L');

    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.20;
        
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3, $YY);
    $pdf->Cell(2, 0.25, utf8_decode("Régimen fiscal:"), 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7, $YY + 0.44);
    $pdf->Cell(2, 0.25, utf8_decode($Emisor_Regimen), 0, 1,'L', 0);

    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.3;
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3, $YY);
    $pdf->Cell(2, 0.25, utf8_decode("Efecto del comprobante:"), 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7, $YY + 0.44);
    $pdf->Cell(2, 0.25, 'ingreso', 0, 1,'L', 0);
    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.3;
    
    $pdf->Line($X+0.4, $YY, $X+7.5, $YY);
    

    //= DATOS DEL EMISOR =======================================================

    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.5;
    
    $pdf->SetFont('arial','B',10);
    $pdf->SetXY($X+0.3,$YY);
    $pdf->Cell(1, 0.25, "EMISOR", 0, 1,'L', 0);

    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.3;
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3, $YY);
    $pdf->Cell(2, 0.25, utf8_decode("Nombre:"), 0, 1,'L', 0);
    
    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7, $YY + 0.34);
    $pdf->MultiCell(6.8, 0.35, utf8_decode($Emisor_Nom), 0, 'L');
    
    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.25;
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3, $YY);
    $pdf->Cell(2, 0.25, "RFC", 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7, $YY + 0.34);
    $pdf->Cell(2, 0.25, $Emisor_RFC, 0, 1,'L', 0);
    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.3;
    
    $pdf->Line($X+0.4, $YY, $X+7.5, $YY);
    
//    //== DATOS DEL RECEPTOR ====================================================
    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.4;
    
    $pdf->SetFont('arial','B',10);
    $pdf->SetXY($X+0.3,$YY);
    $pdf->Cell(1, 0.25, "RECEPTOR", 0, 1,'L', 0);
    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.3;
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3, $YY);
    $pdf->Cell(2, 0.25, utf8_decode("Nombre:"), 0, 1,'L', 0);
    
    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7, $YY + 0.34);
    $pdf->MultiCell(6.8, 0.35, utf8_decode($Receptor_Nom), 0, 'L');
        
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.25;
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3, $YY);
    $pdf->Cell(2, 0.25, "RFC", 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7, $YY + 0.34);
    $pdf->Cell(2, 0.25, $Receptor_RFC, 0, 1,'L', 0);    
    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.3;

    $pdf->Line($X+0.4, $YY, $X+7.5, $YY);

    
    //=== ARTÍCULOS ============================================================

    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.44;

    $pdf->SetFont('arial','B',10);
    $pdf->SetXY($X+0.3,$YY);
    $pdf->Cell(1, 0.25, utf8_decode("ARTÍCULOS / SERVICIOS"), 0, 1,'L', 0);
    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.4;
    
    $pdf->SetFont('arial','B',7);

        $pdf->SetXY($X+0.4,$YY);
        $pdf->Cell(0.8, 0.30, "CANT", 0, 1,'C', 0);
        
        $pdf->SetXY($X+1.3,$YY);
        $pdf->Cell(0.8, 0.30, utf8_decode("[UNI MED] DESCRIP. [CLAVE]"), 0, 1,'L', 0);

        $pdf->SetXY($X+5.4,$YY);
        $pdf->Cell(0.8, 0.30, "PRE UNI", 0, 1,'R', 0);

        $pdf->SetXY($X+6.85,$YY);
        $pdf->Cell(0.8, 0.30, "IMPORTE", 0, 1,'R', 0);
    
    $pdf->SetFont('arial','',8);    
        
    $Y = $YY + 0.5;
    
    for ($idx=0; $idx<count($ArrayCant); $idx++){

        $pdf->SetXY($X+0.5,$Y);
        $pdf->Cell(0.8, 0.30, $ArrayCant[$idx], 0, 1,'C', 0);

        $ClaArtSer = "";
        if (strlen($ArrayClaArtSer[idx])>0){
            $ClaArtSer = " [".$ArrayClaArtSer[idx]."]";
        }

        $pdf->SetXY($X+1.3,$Y);
        $pdf->MultiCell(3.7, 0.30, utf8_decode("[".$ArrayUniMed[$idx]."] ". $ArrayArtSer[$idx].$ClaArtSer), 0, 'L', 0);
        $pdf->Write(0.4,' ');
        $YY=$pdf->GetY()+0.18;

        $pdf->SetXY($X+5,$Y);
        $pdf->Cell(1.2, 0.30, number_format($ArrayPreUni[$idx],2), 0, 1,'R', 0);

        $pdf->SetXY($X+6.2,$Y);
        $pdf->Cell(1.4, 0.30, number_format($ArrayImporte[$idx],2), 0, 1,'R', 0);

        $Total = $Total + $ArrayImporte[$idx];
        $Y = $YY;

    }

    $pdf->Line($X+0.4, $YY, $X+7.5, $YY);


    //=== TOTALES ==============================================================

    $YY = $YY  +0.25;

    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+3.5,$YY);
    $pdf->Cell(2.1, 0.30, "Sub Total:", 0, 1,'R', 0);    

    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+5.6,$YY);
    $pdf->Cell(2, 0.30, number_format($subTotal,2), 0, 1,'R', 0);
    
    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+3.5,$YY + 0.4);
    $pdf->Cell(2.1, 0.30, "IVA:", 0, 1,'R', 0);    
    
    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+5.6,$YY + 0.4);
    $pdf->Cell(2, 0.30, number_format($TotImpuestos,2), 0, 1,'R', 0);
    
    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+3.5,$YY + (0.4*2));
    $pdf->Cell(2.1, 0.30, "Descuento:", 0, 1,'R', 0);
    
    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+5.6,$YY + (0.4*2));
    $pdf->Cell(2, 0.30, number_format($descuento,2), 0, 1,'R', 0);
    
    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+3.5,$YY + (0.4*3));
    $pdf->Cell(2.1, 0.30, "Total:", 0, 1,'R', 0);
    
    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+5.6,$YY + (0.4*3));
    $pdf->Cell(2, 0.30, number_format($total,2), 0, 1,'R', 0);
    
    $pdf->Write(0.4,' ');
    $YY=$pdf->GetY()+0.1;

    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+0.4,$YY);
    $pdf->Cell(2.1, 0.30, "Total con letra:", 0, 1,'L', 0);
    
    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+0.4,$YY+0.4);
    $pdf->MultiCell(7.1, 0.30, utf8_decode(NumLet($total)), 0, 'L', 0);
    

    //=== PIÉ DEL TICKET =======================================================
    
    $pdf->Write(0.4,' ');
    $YY=$pdf->GetY()+0.15;
    
    $pdf->Line($X+0.4, $YY, $X+7.5, $YY);
    
    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+0.4,$YY+0.4);
    $pdf->Cell(1.7,0.30, "Sello digital del CFDI:", 0, 1,'L', 0);  
    
    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+0.4,$YY+0.4+0.4);
    $pdf->MultiCell(7.1, 0.30, $selloCFD, 0, 'L', 0);
    
    
    $pdf->Write(0.4,' ');
    $YY=$pdf->GetY()+0.05;

    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+0.4,$YY+0.4);
    $pdf->Cell(1.7,0.30, "Sello del SAT:", 0, 1,'L', 0);  
    
    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+0.4,$YY+0.4+0.4);
    $pdf->MultiCell(7.1, 0.30, $selloSAT, 0, 'L', 0);

    
    $pdf->Write(0.4,' ');
    $YY=$pdf->GetY()+0.05;

    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+0.4,$YY+0.4);
    $pdf->MultiCell(7.1, 0.35, utf8_decode("Cadena original del complemento de certificación digital del SAT:"), 0, 'L', 0);
    
    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+0.4,$YY+1.22);
    $pdf->MultiCell(7.1, 0.30, $CadOri, 0, 'L', 0);

    $pdf->Write(0.4,' ');
    $YY=$pdf->GetY()+0.05;

    $pdf->SetFont('arial','B',10); 
    $pdf->SetXY($X+0.4,$YY+0.4);
    $pdf->MultiCell(7.1, 0.35, utf8_decode("Este documento es una representación impresa de un CFDI."), 0, 'L', 0);

    $pdf->Write(0.4,' ');
    $YY=$pdf->GetY()+0.05;
    
    $pdf->Image($filename,0.4,$YY+0.2,3.5,3.5,PNG);    
    
    $YYY = $pdf->GetY()+0.2;

    if ($YYY<7.5){$YYY=7.5;}

    $pdf->Close(); // Se cierra el documento, hasta aquí no se genera el PDF.
    
    
    
    
###########################################################################################
    
//=========================================================================================
// A partir de aquí se repite TODO el procedimiento para generar el PDF con las dimensiones
// resultantes del proceso anterior.
    
    $Array[0] = 8;
    $Array[1] = $YYY+4.5;  
    
    $pdf=new FPDF('P','cm',$Array);

    $pdf->AddPage();
    $pdf->SetAutoPageBreak(false);
    $pdf->SetMargins(0, 0, 0);

    $pdf->AddFont('IDAutomationHC39M','','IDAutomationHC39M.php');
    $pdf->AddFont('verdana','','verdana.php');
    $pdf->SetLineWidth(0.02);
    $pdf->SetFillColor(0,0,0);

    $X = 0;
    $Y = -0.5;
    $YY = 0;
    $YYY = 0;

    $pdf->SetFont('arial','B',12);
    $pdf->SetXY($X+0.3,$Y+1.6);
    $pdf->Cell(0.8, 0.30, utf8_decode("FACTURA V. 3.3"), 0, 1,'L', 0);
    
    $pdf->SetFont('arial','B',11);
    $pdf->SetXY($X+6.8,$Y+1.6);
    $pdf->Cell(0.8, 0.30, "No. ".$Fact_NoFact, 0, 1,'R', 0);
    
    $pdf->Line($X+0.4, $Y+2.2, $X+7.5, $Y+2.2);
    
    $Y = $Y + 0.3;
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3,$Y+2.2);
    $pdf->Cell(2, 0.25, "Folio fiscal:", 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7,$Y+2.6);
    $pdf->Cell(2, 0.25, $UUID, 0, 1,'L', 0);
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3,$Y+2.2+0.9);
    $pdf->Cell(2, 0.25, "Certificado SAT:", 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7,$Y+2.6+0.9);
    $pdf->Cell(2, 0.25, $noCertificadoSAT, 0, 1,'L', 0);

    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3,$Y+2.2+(0.9*2));
    $pdf->Cell(2, 0.25, "Certicado del emisor:", 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7,$Y+2.6+(0.9*2));
    $pdf->Cell(2, 0.25, $noCertificado, 0, 1,'L', 0);
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3,$Y+2.2+(0.9*3));
    $pdf->Cell(2, 0.25, utf8_decode("Lugar, fecha y hora de emisión:"), 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7,$Y+2.6+(0.9*3));
    $pdf->MultiCell(6.8, 0.35, utf8_decode($Emisor_Localidad." ".$Emisor_Estado." ".$Fact_Fecha), 0, 'L');

    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.20;
        
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3, $YY);
    $pdf->Cell(2, 0.25, utf8_decode("Régimen fiscal:"), 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7, $YY + 0.44);
    $pdf->Cell(2, 0.25, utf8_decode($Emisor_Regimen), 0, 1,'L', 0);

    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.3;
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3, $YY);
    $pdf->Cell(2, 0.25, utf8_decode("Efecto del comprobante:"), 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7, $YY + 0.44);
    $pdf->Cell(2, 0.25, 'ingreso', 0, 1,'L', 0);
    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.3;
    
    $pdf->Line($X+0.4, $YY, $X+7.5, $YY);
    

    //= DATOS DEL EMISOR =======================================================

    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.5;
    
    $pdf->SetFont('arial','B',10);
    $pdf->SetXY($X+0.3,$YY);
    $pdf->Cell(1, 0.25, "EMISOR", 0, 1,'L', 0);

    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.3;
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3, $YY);
    $pdf->Cell(2, 0.25, utf8_decode("Nombre:"), 0, 1,'L', 0);
    
    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7, $YY + 0.34);
    $pdf->MultiCell(6.8, 0.35, utf8_decode($Emisor_Nom), 0, 'L');
    
    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.25;
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3, $YY);
    $pdf->Cell(2, 0.25, "RFC", 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7, $YY + 0.34);
    $pdf->Cell(2, 0.25, $Emisor_RFC, 0, 1,'L', 0);
    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.3;
    
    $pdf->Line($X+0.4, $YY, $X+7.5, $YY);
    
//    //== DATOS DEL RECEPTOR ====================================================
    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.4;
    
    $pdf->SetFont('arial','B',10);
    $pdf->SetXY($X+0.3,$YY);
    $pdf->Cell(1, 0.25, "RECEPTOR", 0, 1,'L', 0);
    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.3;
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3, $YY);
    $pdf->Cell(2, 0.25, utf8_decode("Nombre:"), 0, 1,'L', 0);
    
    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7, $YY + 0.34);
    $pdf->MultiCell(6.8, 0.35, utf8_decode($Receptor_Nom), 0, 'L');
        
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.25;
    
    $pdf->SetFont('arial','B',9);
    $pdf->SetXY($X+0.3, $YY);
    $pdf->Cell(2, 0.25, "RFC", 0, 1,'L', 0);

    $pdf->SetFont('arial','',9);
    $pdf->SetXY($X+0.7, $YY + 0.34);
    $pdf->Cell(2, 0.25, $Receptor_RFC, 0, 1,'L', 0);    
    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.3;

    $pdf->Line($X+0.4, $YY, $X+7.5, $YY);

    
    //=== ARTÍCULOS ============================================================

    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.44;

    $pdf->SetFont('arial','B',10);
    $pdf->SetXY($X+0.3,$YY);
    $pdf->Cell(1, 0.25, utf8_decode("ARTÍCULOS / SERVICIOS"), 0, 1,'L', 0);
    
    $pdf->Write(0.4,'');
    $YY=$pdf->GetY()+0.4;
    
    $pdf->SetFont('arial','B',7);

        $pdf->SetXY($X+0.4,$YY);
        $pdf->Cell(0.8, 0.30, "CANT", 0, 1,'C', 0);
        
        $pdf->SetXY($X+1.3,$YY);
        $pdf->Cell(0.8, 0.30, utf8_decode("[UNI MED] DESCRIP. [CLAVE]"), 0, 1,'L', 0);

        $pdf->SetXY($X+5.4,$YY);
        $pdf->Cell(0.8, 0.30, "PRE UNI", 0, 1,'R', 0);

        $pdf->SetXY($X+6.85,$YY);
        $pdf->Cell(0.8, 0.30, "IMPORTE", 0, 1,'R', 0);
    
    $pdf->SetFont('arial','',8);    
        
    $Y = $YY + 0.5;
    
    for ($idx=0; $idx<count($ArrayCant); $idx++){

        $pdf->SetXY($X+0.5,$Y);
        $pdf->Cell(0.8, 0.30, $ArrayCant[$idx], 0, 1,'C', 0);

        $ClaArtSer = "";
        if (strlen($ArrayClaArtSer[idx])>0){
            $ClaArtSer = " [".$ArrayClaArtSer[idx]."]";
        }

        $pdf->SetXY($X+1.3,$Y);
        $pdf->MultiCell(3.7, 0.30, utf8_decode("[".$ArrayUniMed[$idx]."] ". $ArrayArtSer[$idx].$ClaArtSer), 0, 'L', 0);
        $pdf->Write(0.4,' ');
        $YY=$pdf->GetY()+0.18;

        $pdf->SetXY($X+5,$Y);
        $pdf->Cell(1.2, 0.30, number_format($ArrayPreUni[$idx],2), 0, 1,'R', 0);

        $pdf->SetXY($X+6.2,$Y);
        $pdf->Cell(1.4, 0.30, number_format($ArrayImporte[$idx],2), 0, 1,'R', 0);

        $Total = $Total + $ArrayImporte[$idx];
        $Y = $YY;

    }

    $pdf->Line($X+0.4, $YY, $X+7.5, $YY);


    //=== TOTALES ==============================================================

    $YY = $YY  +0.25;

    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+3.5,$YY);
    $pdf->Cell(2.1, 0.30, "Sub Total:", 0, 1,'R', 0);    

    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+5.6,$YY);
    $pdf->Cell(2, 0.30, number_format($subTotal,2), 0, 1,'R', 0);
    
    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+3.5,$YY + 0.4);
    $pdf->Cell(2.1, 0.30, "IVA:", 0, 1,'R', 0);    
    
    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+5.6,$YY + 0.4);
    $pdf->Cell(2, 0.30, number_format($TotImpuestos,2), 0, 1,'R', 0);
    
    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+3.5,$YY + (0.4*2));
    $pdf->Cell(2.1, 0.30, "Descuento:", 0, 1,'R', 0);
    
    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+5.6,$YY + (0.4*2));
    $pdf->Cell(2, 0.30, number_format($descuento,2), 0, 1,'R', 0);
    
    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+3.5,$YY + (0.4*3));
    $pdf->Cell(2.1, 0.30, "Total:", 0, 1,'R', 0);
    
    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+5.6,$YY + (0.4*3));
    $pdf->Cell(2, 0.30, number_format($total,2), 0, 1,'R', 0);
    
    $pdf->Write(0.4,' ');
    $YY=$pdf->GetY()+0.1;

    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+0.4,$YY);
    $pdf->Cell(2.1, 0.30, "Total con letra:", 0, 1,'L', 0);
    
    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+0.4,$YY+0.4);
    $pdf->MultiCell(7.1, 0.30, utf8_decode(NumLet($total)), 0, 'L', 0);
    

    //=== PIÉ DEL TICKET =======================================================
    
    $pdf->Write(0.4,' ');
    $YY=$pdf->GetY()+0.15;
    
    $pdf->Line($X+0.4, $YY, $X+7.5, $YY);
    
    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+0.4,$YY+0.4);
    $pdf->Cell(1.7,0.30, "Sello digital del CFDI:", 0, 1,'L', 0);  
    
    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+0.4,$YY+0.4+0.4);
    $pdf->MultiCell(7.1, 0.30, $selloCFD, 0, 'L', 0);
    
    
    $pdf->Write(0.4,' ');
    $YY=$pdf->GetY()+0.05;

    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+0.4,$YY+0.4);
    $pdf->Cell(1.7,0.30, "Sello del SAT:", 0, 1,'L', 0);  
    
    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+0.4,$YY+0.4+0.4);
    $pdf->MultiCell(7.1, 0.30, $selloSAT, 0, 'L', 0);

    
    $pdf->Write(0.4,' ');
    $YY=$pdf->GetY()+0.05;

    $pdf->SetFont('arial','B',9); 
    $pdf->SetXY($X+0.4,$YY+0.4);
    $pdf->MultiCell(7.1, 0.35, utf8_decode("Cadena original del complemento de certificación digital del SAT:"), 0, 'L', 0);
    
    $pdf->SetFont('arial','',9); 
    $pdf->SetXY($X+0.4,$YY+1.22);
    $pdf->MultiCell(7.1, 0.30, $CadOri, 0, 'L', 0);

    $pdf->Write(0.4,' ');
    $YY=$pdf->GetY()+0.05;

    $pdf->SetFont('arial','B',10); 
    $pdf->SetXY($X+0.4,$YY+0.4);
    $pdf->MultiCell(7.1, 0.35, utf8_decode("Este documento es una representación impresa de un CFDI."), 0, 'L', 0);

    $pdf->Write(0.4,' ');
    $YY=$pdf->GetY()+0.05;
    
    $pdf->Image($filename,0.4,$YY+0.2,3.5,3.5,PNG);    
    
    $YYY = $pdf->GetY()+0.2;

    if ($YYY<7.5){$YYY=7.5;}
    
    $pdf->Output(); // Se genera el ticket en PDF


//#### FUNCIONES ###############################################################

    function ProcesImpTot($ImpTot){
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

     