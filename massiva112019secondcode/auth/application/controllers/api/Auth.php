<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class Auth extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('session');
        date_default_timezone_set('America/Mexico_City');
    }

    public function form_login_get() {
        $this->load->helper('url');
        $this->load->view('login-form-view');
    }

//    public function password_change_post() {
//        $this->_password_change_validations();
//        $this->load->model('login_model');
//        $pass = $this->login_model->check_pass(check_id(), $this->_generate_pass($this->post('pass')));
//        if ($pass !== NULL) {
//            $this->db->trans_start();
//            $array_pass = array('password' => $this->_generate_pass($this->post('new_pass')), 'b_cambio_contrasenia' => -1, "updated_at" => date('Y-m-d H:i:s'));
//            $new_pass = $this->login_model->update(check_id(), $array_pass);
//            if ($new_pass) {
//                $this->db->trans_complete();
//                $this->response(array('message' => 'se ha Cambiado la Contraseña'), REST_Controller::HTTP_OK);
//            } else {
//                $this->response(array('message' => 'Error al cambiar la Contraseña'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
//            }
//        } else {
//            $this->response(array('message' => 'Error la Contraseña es incorrecta'), REST_Controller::HTTP_BAD_REQUEST);
//        }
//    }

    public function acceso_post() {
        $this->_validations_login();
        $captcha_passed = TRUE;
        if (check_ini() >= 3) {
//            $captcha = $this->post('captcha');
//            if ($captcha === '') {
//                $captcha_passed = FALSE;
//                $_SESSION[$this->config->item('project_name') . '_ini'] = check_ini() + 1;
//                $this->response(array('message' => 'te falta el captcha', 'intentos' => $_SESSION[$this->config->item('project_name') . '_ini']), REST_Controller::HTTP_BAD_REQUEST);
//            }
//            if ($this->_check_captcha($captcha)) {
//                $captcha_passed = FALSE;
//                $_SESSION[$this->config->item('project_name') . '_ini'] = check_ini() + 1;
//                $this->response(array('message' => 'captcha incorrecta', 'intentos' => $_SESSION[$this->config->item('project_name') . '_ini']), REST_Controller::HTTP_BAD_REQUEST);
//            }
        }
        if ($captcha_passed) {
            $this->load->model('login_model');
            $array_datos = array('username' => $this->post('user'), 'pass' => $this->post('pass'));
            $usuario = $this->login_model->search_users($array_datos);
            if ($usuario !== NULL) {
                $this->_session_inicialize($usuario);
                unset($_SESSION[$this->config->item('project_name') . '_captcha']);
                unset($_SESSION[$this->config->item('project_name') . '_ini']);
                $usuario['url'] = $this->_get_urls_users($usuario['tipo']);
                $data['usuario'] = $usuario;
                $this->response($data, REST_Controller::HTTP_OK);
            } else {
                $_SESSION[$this->config->item('project_name') . '_ini'] = check_ini() + 1;
                $this->response(array('message' => 'Usuario o contraseña incorrecta', 'intentos' => $_SESSION[$this->config->item('project_name') . '_ini']), REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    private function _get_urls_users($tipo) {
        switch ($tipo) {
            case "1"://admin
                return $this->config->item('admin_url');
            case "2"://clientes
                return $this->config->item('plataforma_url');
            case "3"://jefe Contador
                return $this->config->item('apanel_url');
            case "4"://Contadores
                return $this->config->item('bpanel_url');
        }
    }

    function password_change_post() {
        $this->load->model('usuarios_model');
        $email = $this->post('email');
        $id_usuario = $this->usuarios_model->get_id_by_email($email);
        $data = $this->_fill_insert_data($id_usuario);
        if ($data !== NULL) {
            $id_compressed = urlencode(base64_encode(gzdeflate($data['id'] . '|' . $data['username'] . '|' . $data['date'])));
            if ($this->_envio_correo_password($data['email'], $id_compressed)) {
                $this->response(['message' => 'Se envió un correo electrónico. Para continuar, revisa tu bandeja de entrada. '], REST_Controller::HTTP_OK);
            } else {
                $this->response(['message' => 'Verifica que el correo introducido pertenezca a un usuario de massiva'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    //funcion que inicializa la session de php con los datos del usuario
    private function _session_inicialize($usuario) {
        $_SESSION[$this->config->item('project_name')]['id'] = $usuario['id'];
        $_SESSION[$this->config->item('project_name')]['username'] = $usuario['username'];
        $_SESSION[$this->config->item('project_name')]['tipo'] = $usuario['tipo'];
        if ($usuario['tipo'] === "2") {
            $this->load->model("usuarios_personas_model");
            $persona = $this->usuarios_personas_model->get_persona_id_by_usuario_id($usuario['id']);
            if ($persona !== NULL) {
                $_SESSION[$this->config->item('project_name')]['contabilidad_atrasada'] = $persona['contabilidad_atrasada'];
                $_SESSION[$this->config->item('project_name')]['tiene_efirma_vigente'] = $persona['tiene_efirma_vigente'];
                $_SESSION[$this->config->item('project_name')]['persona_id'] = $persona['persona_id'];
            } else {
                $_SESSION[$this->config->item('project_name')]['persona_id'] = NULL;
            }
        }
//        $_SESSION[$this->config->item('project_name')]['permisos'] = json_decode($usuario['permisos']);
    }

    public function logout_post() {
        if (check_id()) {
            unset($_SESSION[$this->config->item('project_name')]);
            unset($_SESSION[$this->config->item('project_name') . '_ini']);
            if (isset($_SESSION[$this->config->item('project_name')]['permisos'])) {
                unset($_SESSION[$this->config->item('project_name')]['permisos']);
            }
            $this->response(['message' => 'Has cerrado sesión'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'No se ha iniciado la sesión'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    //checar la captcha para ver si son iguales
    private function _check_captcha($captcha = '') {
        return $captcha === $_SESSION[$this->config->item('project_name') . '_captcha'] ? FALSE : TRUE;
    }

    private function _generate_pass($pass) {
//generando la contraseña
        $this->load->helper(array('security'));
        return do_hash($pass, 'md5');
    }

    private function _envio_correo_password($destinatario, $id_url) {
        $this->load->helper('email');
        $envio_mail = generate_mail_change_password($destinatario, $id_url);
        if ($envio_mail) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    private function _fill_insert_data($id_usuario) {
        $data = array();
        $data['id'] = $id_usuario['id'];
        $data['email'] = $id_usuario['email'];
        $data['username'] = $id_usuario['username'];
        $data['date'] = date("Y-m-d H:i:s");
        return $data;
    }

    private function _validations_login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user', 'Usuario', 'trim|required');
        $this->form_validation->set_rules('pass', 'Contrase&ntilde;a', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->response(array('message' => validation_errors()), REST_Controller::HTTP_BAD_REQUEST);
        }
    }

//    private function _password_change_validations() {
//        $this->load->library('form_validation');
//        $this->form_validation->set_rules('pass', 'Contrase&ntilde;a', 'trim|required');
//        $this->form_validation->set_rules('new_pass', 'Contrase&ntilde;a', 'trim|required|min_length[8]');
//        $this->form_validation->set_rules('new_pass_confirm', 'Contrase&ntilde;a', 'trim|required|min_length[8]|matches[new_pass]');
//        if (!$this->form_validation->run()) {
//            $this->response(array('message' => validation_errors()), REST_Controller::HTTP_BAD_REQUEST);
//        }
//    }
}
