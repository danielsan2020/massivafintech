<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * crea una carpeta del proyecto si no existe
 */
if (!function_exists('path_create')) {

    function path_create($path, $path_server) {
        $CI = &get_instance();
        if (is_array($path)) {
            $temp_path = $path_server;
            foreach ($path as $carpeta) {
                $temp_path .= "/" . $carpeta;
                if (!file_exists($temp_path)) {
                    if (!mkdir($temp_path, 0777, TRUE)) {
                        $CI->response(["message" => "ERROR:No se creo el directorio, por favor contacte a soporte técnico"], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                    }
                }
            }
        }
        if (is_string($path)) {
            $temp_path = $path_server . "/" . $path;
            if (!file_exists($temp_path)) {
                if (!mkdir($temp_path, 0777, TRUE)) {
                    $CI->response(["message" => "ERROR:No se creo el directorio, por favor contacte a soporte técnico"], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
        }
    }

}