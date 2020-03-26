<?php

class Descargas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('download', 'session');
    }

    public function download_files_soporte_by_id() {
        $this->load->model('soporte_comentarios_model');
        $this->_params_validation();
        $file_id = $this->input->get('file_id');
        $soporte_ticket_id = $this->input->get('soporte_ticket_id');
        $file = $this->soporte_comentarios_model->get_file_name_extension_by_id_and_soporte_ticket_id($file_id, $soporte_ticket_id);
        if ($file !== NULL) {
            $file = json_decode($file['comentario'],TRUE);
            $name = $file['name'] . "." . $file['extension'];
            $path = $this->config->item('personas_path') . "/" . get_persona_id() . "/soporte/" . $soporte_ticket_id . "/" . $file_id . "/" . $file_id . "." . $file['extension'];
            $archivo = file_get_contents($path); // Read the file's contents
            if ($archivo) {
                force_download($name, $archivo);
            } else {
                $data['base_url'] = $this->config->item('base_url');
                $data['mensaje'] = "Archivo no encontrado";
                $this->load->view('file_not_found_view', $data);
            }
        } else {
            $data['base_url'] = $this->config->item('base_url');
            $data['mensaje'] = "Archivo no encontrado";
            $this->load->view('file_not_found_view', $data);
        }
    }

    private function _params_validation() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('file_id', 'File', 'trim|required|integer|is_natural_no_zero');
        $this->params_validation->set_rules('soporte_ticket_id', 'Soporte ticket', 'trim|required|integer|is_natural_no_zero');
        if (!$this->params_validation->run()) {
            $this->load->view('errors/html/error_params');
            exit();
        }
    }

}
