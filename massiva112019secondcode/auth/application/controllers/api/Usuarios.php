<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class Usuarios extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('usuarios_model');
        date_default_timezone_set('America/Mexico_City');
    }

    public function reestablecer_password_post() {
        $data = $this->_fill_insert_usuario_id();
//        $datos_usuario = $this->usuarios_model->get_usuario_by_id($data['usuario_id']);
         $this->db->trans_start();
        if ($this->usuarios_model->update($data['usuario_id'], $data['password'])) {
            $this->db->trans_complete();
            $this->response(['message' => 'Cambios guardados'], REST_Controller::HTTP_CREATED);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function _fill_insert_usuario_id() {
        $data = array();
        $data['usuario_id'] = $this->post('usuario_id');
        $data['password'] = $this->post('password');
        return $data;
    }

}
