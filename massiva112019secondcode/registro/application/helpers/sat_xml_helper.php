<?php

require(APPPATH . 'libraries/sat-xml-conecction/LoginXmlRequest.php');

if (!function_exists('sat_xml_sat')) {

    function upload_file() {
        $loginSAT = new LoginXmlRequest();

        $cert = file_get_contents('resources/vete940528v58.cer');
        $key = file_get_contents('resources/' . $nombreKey . '.pem');
        $ResponseAuth = $loginSAT->soapRequest($cert, $key);
    }

}
if (!function_exists('sat_xml_key_to_pem')) {

    function sat_xml_key_to_pem($persona_id, $file_id, $password) {
        require(APPPATH . 'libraries/sat-xml-conecction/Utils.php');
        $CI = &get_instance();
        $personas_path = $CI->config->item('personas_path');
        $key_pem_route = $personas_path . '/' . $persona_id . '/documentos/fiscales/';
        if (file_exists($key_pem_route . $file_id . '.key')) {
            //echo $key_pem_route . $file_id . '.key';
            return shell_exec('openssl pkcs8 -inform DER -in ' . $key_pem_route . $file_id . '.key -out ' . $key_pem_route . $file_id . '.pem -passin pass:' . $password . ' 2>&1');
        } else {
            return FALSE;
        }
    }

}