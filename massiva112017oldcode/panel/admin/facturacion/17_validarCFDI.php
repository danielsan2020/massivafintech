<?php
header('Content-Type: text/html; charset=UTF-8');

echo '<div style="font-size: 12pt; color: #000099; margin-bottom: 10px; margin-top: 8px; font-family: Verdana, Arial, Helvetica, sans-serif;">';
echo 'VALIDACIÓN DEL STATUS DE UN CFDI EN EL SERVIDOR DEL SAT';
echo '</div>';    

// CFDI Vigente =========================================
$rfc_emisor   = "FLA111215I55";
$rfc_receptor = "SACO640815KA4";
$UUID         = "738FE106-4EE0-4285-A3F32EB60836DE6C";
$total        = "4370.65";

// CFDI Cancelado =======================================
// $rfc_emisor   = "RUTR7201209H5";
// $rfc_receptor = "SALJ951023GB6";
// $UUID         = "15B8AF3E-9E59-444F-815C-9536B567598D";
// $total        = "2320.00";


echo '<div style="font-size: 13pt; color: #5C5C5C; margin-bottom: 8px;">RFC emisor: <span style="color: #000000;">'.$rfc_emisor.'</span></div>';
echo '<div style="font-size: 13pt; color: #5C5C5C; margin-bottom: 8px;">RFC receptor: <span style="color: #000000;">'.$rfc_receptor.'</span></div>';
echo '<div style="font-size: 13pt; color: #5C5C5C; margin-bottom: 8px;">UUID: <span style="color: #000000;">'.$UUID.'</span></div>';
echo '<div style="font-size: 13pt; color: #5C5C5C; margin-bottom: 8px;">Total: <span style="color: #000000;">'.number_format($total,2).'</span></div>';

$url = "https://consultaqr.facturaelectronica.sat.gob.mx/ConsultaCFDIService.svc";

$opt = array("http"=>array("timeout"=>1));
$context = stream_context_create($opt);

$options=array(
    'trace'=>true,
    'stream_context'=>$context
);

$impo = (double)$total;
$impo = sprintf("%.6f", $impo);
$impo = str_pad($impo,17,"0",STR_PAD_LEFT);
$uuid = strtoupper($UUID);

$CadIdent = "?re=$rfc_emisor&rr=$rfc_receptor&tt=$impo&id=$uuid";

$prm = array('expresionImpresa'=>$CadIdent);

// SoapClient ==================================================================
try {
    $soapclient = new SoapClient($url,$options);
    $buscar=$soapclient->Consulta($prm);
    
    $CodResp    = $buscar->ConsultaResult->CodigoEstatus;
    $StatusCFDI = strtoupper($buscar->ConsultaResult->Estado);
    
    echo '<div style="font-size: 13pt; color: #5C5C5C; margin-bottom: 8px;">Código de respuesta: <span style="color: #000099;">'.$CodResp.'</span></div>';
    
    if ($StatusCFDI=="VIGENTE"){
        echo '<div style="font-size: 13pt; color: #5C5C5C; margin-bottom: 8px;">Status del CFDI: <span style="color: #0F780F;">'.$StatusCFDI.'</span></div>';
    }else{
        echo '<div style="font-size: 13pt; color: #5C5C5C; margin-bottom: 8px;">Status del CFDI: <span style="color: #A70202;">'.$StatusCFDI.'</span></div>';
    }
    
    
} catch (Exception $e) {

    echo '<div style="font-size: 13pt; color: #5C5C5C; margin-bottom: 8px;">No se pudo accesar el portal del SAT: <span style="color: #A70202;">'.$e.'</span></div>';
}









