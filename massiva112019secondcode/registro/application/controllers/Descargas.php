<?php

/**
 * Description of Paquetes
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Descargas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('download');
        date_default_timezone_set('America/Mexico_City');
    }

    public function download_documentos_fiscales_by_id() {
        $this->load->model('documentos_fiscales_model');
        $file_id = $this->input->get('file_id');
        $persona_id = $this->input->get('persona_id');
        $file = $this->documentos_fiscales_model->get_file_name_extension_by_id_and_persona_id($file_id, $persona_id);
        if ($file !== NULL) {
            $name = $file['nombre'];
            $path = $this->config->item('personas_path') . "/" . $persona_id . "/documentos/fiscales/" . $file_id . "." . $file['extension'];
            $archivo = file_get_contents($path); // Read the file's contents
            force_download($name, $archivo);
        } else {
            $data['base_url'] = $this->config->item('base_url');
            $data['mensaje'] = "Archivo no encontrado";
            $this->load->view('file_not_found_view', $data);
        }
    }
    

}
