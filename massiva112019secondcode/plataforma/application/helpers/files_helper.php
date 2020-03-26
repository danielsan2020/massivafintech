<?php

if (!function_exists('upload_file')) {

    function upload_file($path, $name, $name_field_form, $allowed_types = "pdf", $overwirite = FALSE) {
        $CI = &get_instance();
        if (!file_exists($path)) {
            if (!mkdir($path, 0777, TRUE)) {
                $CI->response(["message" => "ERROR: Directorio inexistente (" . $path . "), por favor contacte a soporte técnico"], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        unset($config);
        $config['upload_path'] = $path;
        $config['file_name'] = $name;
        $config['allowed_types'] = $allowed_types;
        $config['remove_spaces'] = TRUE;
        $config['max_size'] = $CI->config->item('FILE_MAX_SIZE');
        $config['max_width'] = $CI->config->item('FILE_MAX_WIDTH');
        $config['max_height'] = $CI->config->item('FILE_MAX_HEIGHT');
        $config['overwrite'] = $overwirite;
        $CI->load->library('upload');
        $CI->upload->initialize($config);
        if (!$CI->upload->do_upload($name_field_form)) {
            $CI->response(["message" => $CI->upload->display_errors()], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
if (!function_exists('remove_file')) {

    function remove_file($path, $name) {
        if (file_exists($path . $name)) {
            unlink($path . $name);
        }
    }

}
if (!function_exists('rename_file')) {

    function rename_file($path, $old_name, $new_name) {
        $result['success'] = true;
        if (file_exists($path . $old_name)) {
            if (!rename($path . $old_name, $path . $new_name)) {
                $result['success'] = false;
                $result['errors'] = "error al renombrar archivo " . $old_name;
            }
        }
        if (!$result['success']) {
            $CI = &get_instance();
            $CI->response(['message' => $result['errors']], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}