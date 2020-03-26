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



   /* @toro 2018 tar.mx -- consultar estado de factura directo al SAT */
   //datos de factura RFC emisor, RFC receptor, Total, UUID
   $emisor="AME900523CM3";
   $receptor="CALI950424AYA";
   $total="2796.22";
   $uuid="346CCAF4-B339-439B-C7CE-06EC597C8DB0";
   //
   $soap = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tem="http://tempuri.org/"><soapenv:Header/><soapenv:Body><tem:Consulta><tem:expresionImpresa>?re='.$emisor.'&amp;rr='.$receptor.'&amp;tt='.$total.'&amp;id='.$uuid.'</tem:expresionImpresa></tem:Consulta></soapenv:Body></soapenv:Envelope>';
   //encabezados
   $headers = [
   'Content-Type: text/xml;charset=utf-8',
   'SOAPAction: http://tempuri.org/IConsultaCFDIService/Consulta',
   'Content-length: '.strlen($soap)
   ];

   $url = 'https://consultaqr.facturaelectronica.sat.gob.mx/ConsultaCFDIService.svc';
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $soap);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   $res = curl_exec($ch);
   curl_close($ch);
   $xml = simplexml_load_string($res);
   $data = $xml->children('s', true)->children('', true)->children('', true);
   $data = json_encode($data->children('a', true), JSON_UNESCAPED_UNICODE);
   print_r(json_decode($data));

