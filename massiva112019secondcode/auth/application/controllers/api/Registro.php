<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class Registro extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('preregistros_model');
        date_default_timezone_set('America/Mexico_City');
    }

    public function index_post() {
        $this->_validation_insert();
        $data = $this->_fill_insert_data_preregistro();
        $this->db->trans_start();
        $preregistro_id = $this->preregistros_model->insert($data);
        if ($preregistro_id !== NULL) {
            $id_compressed = urlencode(base64_encode(gzdeflate($preregistro_id . '|' . $data['email'])));
            if ($this->_envio_correo_registro($data['email'], $id_compressed)) {
                $this->db->trans_complete();
                $this->response(['message' => 'El registro se guardó con &eacute;xito.'], REST_Controller::HTTP_OK);
            } else {
                $this->response(['message' => 'Error: No se envió el correo'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $this->response(['message' => 'Error: No se guardó el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    

    public function create_usuario_tipo_2_post() {
        $this->load->model('usuarios_model');
        $usuario_id = $this->_fill_insert_usuario_id();
        $datos_preregistro = $this->preregistros_model->get_preregistro_by_id($usuario_id['usuario_id']);
        if ($datos_preregistro !== NULL) {
            $data_usuario = array_merge($datos_preregistro, $usuario_id);
            $data = $this->_fill_insert_data_usuario($data_usuario);
            $this->db->trans_start();
            $id = $this->usuarios_model->insert($data);
            $data_preregistro = $this->_fill_update_status_by_preregistro_id($usuario_id['usuario_id']);
            $this->preregistros_model->update($usuario_id['usuario_id'], $data_preregistro);
            if ($id === NULL) {
                $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
            $this->db->trans_complete();
            $this->response(['id' => $id, 'message' => 'Contenido actualizado correctamente'], REST_Controller::HTTP_CREATED);
        }
    }

    private function _fill_update_status_by_preregistro_id($id) {
        $data_preregistro = array();
        $data_preregistro['id'] = $id;
        $data_preregistro['status'] = 2;
        return $data_preregistro;
    }

    private function _fill_insert_usuario_id() {
        $usuario_id = array();
        $usuario_id['usuario_id'] = $this->post('usuario_id');
        $usuario_id['password'] = $this->post('password');
        return $usuario_id;
    }

    private function _fill_insert_data_preregistro() {
        $data = array();
        $data['username'] = $this->post('email');
        $data['email'] = $this->post('email');
        $data['rfc'] = $this->post('rfc');
        $data['telefono'] = $this->post('telefono');
        $data['nombre'] = $this->post('nombre');
        $data['apellido_paterno'] = $this->post('apellido_paterno');
        $data['apellido_materno'] = $this->post('apellido_materno');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        return $data;
    }

    private function _fill_insert_data_usuario($data_usuario) {
        $data = array();
        $data['username'] = $data_usuario['email'];
        $data['password'] = $data_usuario['password'];
        $data['tipo'] = 2;
        $data['email'] = $data_usuario['email'];
        $data['telefono'] = $data_usuario['telefono'];
        $data['nombre'] = $data_usuario['nombre'];
        $data['apellido_paterno'] = $data_usuario['apellido_paterno'];
        $data['apellido_materno'] = $data_usuario['apellido_materno'];
        $data['status'] = 2;
        $data['created_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    private function _envio_correo_registro($destinatario, $id_url) {
        $this->load->helper('email');
        $envio_mail = generate_mail($destinatario, $id_url);
        if ($envio_mail) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Reglas que tienen que pasar el formulario recibido
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_insert() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[preregistros.email]', array('is_unique' => 'El correo que intentas registrar ya se encuentra en el sistema.'));
        $this->form_validation->set_rules('rfc', 'RFC', 'trim|required|is_unique[preregistros.rfc]', array('is_unique' => 'El RFC que intentas registrar ya se encuentra en el sistema.'));
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|alpha_dash_space_period_utf8_numbers');
        $this->form_validation->set_rules('apellido_paterno', 'apellido paterno', 'trim|alpha_dash_space_period_utf8_numbers');
        $this->form_validation->set_rules('apellido_materno', 'apellido materno', 'trim|alpha_dash_space_period_utf8_numbers');
        $this->form_validation->set_rules('telefono', 'Telefono', 'trim');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}
