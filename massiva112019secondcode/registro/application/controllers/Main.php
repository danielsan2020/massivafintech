<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $this->load->helper('url');
        $data['base_url'] = $this->config->item('base_url');
        $data['api_url'] = $this->config->item('api_url');
        $data['home_url'] = $this->config->item('home_url');
        $this->load->helper('session');
        if (check_id()) {
            $usuario_json = array(
                'id' => $_SESSION[$this->config->item('project_name')]['id'],
                'username' => $_SESSION[$this->config->item('project_name')]['username'],
                'tipo' => $_SESSION[$this->config->item('project_name')]['tipo'],
                'persona_id' => $_SESSION[$this->config->item('project_name')]['persona_id']
            );
            if (isset($_SESSION[$this->config->item('project_name')]['contabilidad_atrasada'])) {
                $usuario_json['contabilidad_atrasada'] = $_SESSION[$this->config->item('project_name')]['contabilidad_atrasada'];
            }
            if (isset($_SESSION[$this->config->item('project_name')]['tiene_efirma_vigente'])) {
                $usuario_json['tiene_efirma_vigente'] = $_SESSION[$this->config->item('project_name')]['tiene_efirma_vigente'];
            }
            $data['usuario'] = str_replace("\"", "'", json_encode($usuario_json));
        } else {
            $data['usuario'] = 'false';
        }
        $this->load->view('main_view', $data);
    }

}
