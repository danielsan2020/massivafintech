<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    /**
     * @title Metodo que te devuelve la pagina principal
     * @access public
     * @author Omar
     * @method GET
     */
    public function index() {
        $this->load->helper('url');
        $data['base_url'] = $this->config->item('base_url');
        $data['api_url'] = $this->config->item('api_url');
        $data['admin_url'] = $this->config->item('admin_url');
        $data['apanel_url'] = $this->config->item('apanel_url');
        $data['bpanel_url'] = $this->config->item('bpanel_url');
        $data['plataforma_url'] = $this->config->item('plataforma_url');
        $data['registro_url'] = $this->config->item('registro_url');
        $this->load->helper('session');
        if (check_id()) {
//            $data['tipo'] = $_SESSION[$this->config->item('project_name')]['tipo'];
            $usuario_json = array(
                'id' => $_SESSION[$this->config->item('project_name')]['id'],
                'username' => $_SESSION[$this->config->item('project_name')]['username'],
                'tipo' => $_SESSION[$this->config->item('project_name')]['tipo'],
                'url' => $this->_get_urls_users($_SESSION[$this->config->item('project_name')]['tipo']),
                'status' => $this->_get_status_by_usuario_id($_SESSION[$this->config->item('project_name')]['id'])
            );
            $data['usuario'] = str_replace("\"", "'", json_encode($usuario_json));
        } else {
            $data['usuario'] = 'false';
        }
        $this->load->view('main_view', $data);
    }

    private function _get_status_by_usuario_id($usuario_id) {
        $this->load->model("login_model");
        $status = $this->login_model->get_status_by_usuario_id($usuario_id);
        if ($status !== NULL) {
            return $status['status'];
        } else {
            echo "error al traer el status del usuario";
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

}
