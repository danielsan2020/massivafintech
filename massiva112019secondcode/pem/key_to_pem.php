<?php

$cert_path = '../pem/';
$der_file = 'Claveprivada_FIEL_MCI1902072A6_20190211_114451.key';

//$pem_data = file_get_contents($cert_path . $pem_file);
//$pem2der = pem2der($pem_data);

$der_data = file_get_contents($cert_path . $der_file);
$der2pem = der2pem($der_data);
file_put_contents($cert_path . 'llavetemp.pem', $der2pem);

//function pem2der($pem_data) {
//    $begin = "CERTIFICATE-----";
//    $end = "-----END";
//    $pem_data = substr($pem_data, strpos($pem_data, $begin) + strlen($begin));
//    $pem_data = substr($pem_data, 0, strpos($pem_data, $end));
//    $der = base64_decode($pem_data);
//    return $der;
//}

function der2pem($der_data) {
    $pem = chunk_split(base64_encode($der_data), 64, "\n");
    $pem = "-----BEGIN CERTIFICATE-----\n" . $pem . "-----END CERTIFICATE-----\n";
    return $pem;
}
