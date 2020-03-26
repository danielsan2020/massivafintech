<?php

/**
 * Description of Paquetes
 *
 */defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

/**
 * CodeIgniter Rest Controller
 * A fully RESTful server implementation for CodeIgniter using one library, one config file and one controller.
 *
 * @package         API
 * @subpackage      Poner
 * @category        Poner
 * @author          Poner
 */
class Personas extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('personas_model');
        date_default_timezone_set('America/Mexico_City');
    }

    public function get_all_personas_by_contador_id_get() {
        $this->load->model('documentos_fiscales_model');
        $contador_id = get_id('id');
        $data['personas'] = $this->personas_model->get_all_personas_by_contador_id($contador_id);
        for ($k = 0; $k < count($data['personas']); $k++) {
            $this->load->library('encryption');
            $this->encryption->initialize(
                    array(
                        'cipher' => 'aes-256',
                        'mode' => 'ctr',
                        'key' => $this->config->item('encryption_key')
                    )
            );
            $data['personas'][$k]['efirma'] = $this->encryption->decrypt($data['personas'][$k]['efirma']);
        }
        foreach ($data['personas'] as &$persona) {
            $persona['file_exist_zip'] = $this->_check_file_exist_zip($persona['id']);
            $persona['files_exist_documentos_fiscales'] = $this->documentos_fiscales_model->check_files_exist_documentos_fiscales_by_persona_id($persona['id']);
            unset($persona);
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    private function _check_file_exist_zip($persona_id) {
        $name = "fiscales.zip";
        $path = $this->config->item('personas_path') . "/" . $persona_id . "/cfdi/" . $name;
        return (file_exists($path)) ? 1 : -1;
    }

}
