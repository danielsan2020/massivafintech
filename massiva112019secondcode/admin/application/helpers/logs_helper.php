<?php

if (!function_exists('insert_log')) {

    function insert_log($id_registro, $tabla, $data = array('nombre' => 'borrado')) {
        $CI = & get_instance();
        $CI->load->model('logs_model');
        date_default_timezone_set('America/Mexico_City');
        $log['usuario_id'] = $_SESSION[$CI->config->item('project_name')]['id'];
        $log['tabla'] = $tabla;
        $log['tabla_id'] = $id_registro;
        $log['data'] = json_encode($data);
        $log['created_at'] = date("Y-m-d H:i:s");
        $CI->logs_model->insert($log);
    }

}
