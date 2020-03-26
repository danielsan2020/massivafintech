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
class Declaraciones extends REST_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('America/Mexico_City');
    }
    public function subir_archivos_adjuntos_para_pago_post(){
        $this->_validation_data();
        $persona_id = $this->post('persona_id');
        $declaracion_id = $this->post('declaracion_id');
        $this->load->helper('session');
        $contador_id = check_id();
        $this->_validation_datos_de_la_declaracion($persona_id, $declaracion_id, $contador_id);
        $data['declaracion'] = $this->declaraciones_model->get_declaracion_by_persona_id_and_declaracion_id($persona_id, $declaracion_id);
        $data['persona_id'] = $persona_id;
        $this->_upload_files($data);
        $this->response(array('mensaje'=>'se ha subido el archivo'), REST_Controller::HTTP_OK);
    }
    private function _validation_data(){
        $this->load->library('form_validation');
         $this->form_validation->set_rules('persona_id', 'Id', 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('declaracion_id', 'Id', 'trim|required|is_natural_no_zero');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    private function _validation_datos_de_la_declaracion($persona_id, $declaracion_id, $contador_id) {
        if (!($this->_existe_relacion_entre_persona_and_contador($persona_id, $contador_id))) {
            $this->response(['message' => 'la persona no esta asignada al contador'], REST_Controller::HTTP_BAD_REQUEST);
        }

        if (!($this->_es_la_declaracion_de_la_persona($persona_id, $declaracion_id))) {
            $this->response(['message' => 'la declaracion no es de esa persona'], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    private function _existe_relacion_entre_persona_and_contador($persona_id, $contador_id){
        $this->load->model('personas_contadores_model');
        $relacion_contador_persona=$this->personas_contadores_model->get_by_contador_id_and_persona_id($contador_id, $persona_id);
        if ((count($relacion_contador_persona) === 0)){
            return false;
        }
        return true;
    }
    private function _es_la_declaracion_de_la_persona($persona_id, $declaracion_id){
        $this->load->model('declaraciones_model');
        $relacion_persona_declaracion=$this->declaraciones_model->get_by_id_and_persona_id($declaracion_id, $persona_id);
        if ((count($relacion_persona_declaracion) === 0)){
            return false;
        }
        return true;
    }
    private function _upload_files($data){
        if($this->post('pdf')){
            $this->_upload_file('pdf', 'file_pdf', $data);
        }
        if($this->post('zip')){
            $this->_upload_file('zip', 'file_zip', $data);
        }
    }
    private function _upload_file($extension, $file_name_form, $data){
        $this->load->helper(array('files_helper', 'path_helper'));
        path_create(array("documentos", $data['persona_id']), $this->config->item("personas_path")); //generamos los paths correspodientes
        $path_upload = $this->config->item("personas_path") . "/" . "documentos" . "/".$data['persona_id']."/";
        upload_file($path_upload, $this->_get_file_name($data), $file_name_form, $extension, TRUE);
    }
    private function _get_file_name($data){
        return "declaracion_".$data["declaracion"]["rfc"]."_".$data["declaracion"]["anio_correspondiente"]."_".$data["declaracion"]["mes_correspondiente"];
    }
}
