<?php

/**
 * Description of Personas_clientes
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
class Personas_clientes extends REST_Controller {
    /*
      Metodo constructor de la clase
     */

    function __construct() {
        parent::__construct();
        $this->load->model('personas_clientes_model');
        date_default_timezone_set('America/Mexico_City');
    }

    /**
     * @title Metodo para obtener todos los registros activos de la tablapersonas_clientes
     * @url /personas_clientes/get_all_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_all_get() {
        $persona_id = $this->get('id');
        $data['total_personas_clientes'] = $this->personas_clientes_model->count_all_activos($persona_id);
        if ($data['total_personas_clientes'] === 0) {
            $data['personas_clientes'] = [];
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $data['personas_clientes'] = $this->personas_clientes_model->get_all($persona_id);
            $this->response($data, REST_Controller::HTTP_OK);
        }
    }

    /**
     * @title Metodo para obtener un registro activo de la tablapersonas_clientes en base aid
     * @url /personas_clientes/get_by_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_by_id_get() {
        $this->_validation_get_id();
        $id = $this->get('id');
        $data['personas_clientes'] = $this->personas_clientes_model->get_by_id($id);
        if ($data['personas_clientes'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo para obtener un registro activo de la tablapersonas_clientes en base apersona_id
     * @url /personas_clientes/get_by_persona_id_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_by_persona_id_get() {
        $this->_validation_get_persona_id();
        $persona_id = $this->get('persona_id');
        $data['personas_clientes'] = $this->personas_clientes_model->get_by_persona_id($persona_id);
        if ($data['personas_clientes'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo para obtener el id del cliente de la persona por medio del rfc
     * @url /personas_clientes/get_persona_by_rfc_get
     * @access public
     * @param string $rfc
     * @method GET
     * @successResponse Code: 200 HTTP_OK
     */
    public function get_persona_by_rfc_get() {
        $this->_validation_rfc();
        $rfc = $this->get('rfc');
        $data['persona'] = $this->personas_clientes_model->get_persona_by_rfc($rfc);
        if ($data['persona'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'No se encontró ningún cliente con ese rfc'], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    /**
     * @title Metodo para obtener todo los registros inactivos de la tablapersonas_clientes
     * @url /personas_clientes/get_all_inactive
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    public function get_all_inactive_get() {
        $data['total_personas_clientes'] = $this->personas_clientes_model->count_all_inactivos();
        if ($data['total_personas_clientes'] === 0) {
            $data['personas_clientes'] = [];
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $data['personas_clientes'] = $this->personas_clientes_model->get_all_inactive();
            $this->response($data, REST_Controller::HTTP_OK);
        }
    }

    /**
     * @title Metodo para crear un registro.
     * @url /personas_clientes/create
     * @access public
     * @method POST
     * @dataParams colonia_id: [int(10) unsigned]
     * @dataParams nombre: [tinytext]
     * @dataParams razon_social: [mediumtext]
     * @dataParams rfc: [varchar(13)]
     * @dataParams direccion: [mediumtext]
     * @dataParams numero_interior: [varchar(20)]
     * @dataParams pais: [varchar(45)]
     * @dataParams numero_exterior: [varchar(20)]
     * @dataParams ciudad: [varchar(245)]
     * @dataParams email: [varchar(245)]
     * @dataParams tiene_logotipo: [tinyint(4)]
     * @successResponse Code: 201 HTTP_CREATED Content: {id:[integer], message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    /*
      Creando un nuevo registro
     */
    public function create_post() {
        $this->_validation_insert();
        $data = $this->_fill_insert_data();
        $extension_imagen = $this->post('file_type');
        $existe_rfc = $this->personas_clientes_model->existe_rfc_by_persona_id($data['persona_id'], $data['rfc']);
        if ($existe_rfc !== NULL) {
            $this->response(['message' => 'Error: El RFC ya se encuentra registrado'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        } else {
            $this->db->trans_start();
            $id = $this->personas_clientes_model->insert($data);
            if ($id === NULL) {
                $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
            $this->load->helper('logs');
            insert_log($id, 'personas_clientes', $data);
            if ($data['tiene_logotipo'] === '1') {
                $this->_upload_file($id, $extension_imagen);
            }
            $this->db->trans_complete();
            $this->response(['id' => $id, 'message' => 'Contenido actualizado correctamente'], REST_Controller::HTTP_CREATED);
        }
    }

    /*
     * @title Metodo para actualizar una variable
     * @url /personas_clientes/update/id/:id
     * @access public
     * @method POST
     * @urlParams id: [int(10) unsigned]
     * @dataParams colonia_id: [int(10) unsigned]
     * @dataParams nombre: [tinytext]
     * @dataParams razon_social: [mediumtext]
     * @dataParams rfc: [varchar(13)]
     * @dataParams direccion: [mediumtext]
     * @dataParams numero_interior: [varchar(20)]
     * @dataParams pais: [varchar(45)]
     * @dataParams numero_exterior: [varchar(20)]
     * @dataParams ciudad: [varchar(245)]
     * @dataParams email: [varchar(245)]
     * @dataParams tiene_logotipo: [tinyint(4)]
     * @urlParams id: [integer]
     * @dataParams variable : [string]
     * @successResponse Code: 201 HTTP_CREATED Content: {message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */

    public function update_post() {
        $this->_validation_update();
        $id = $this->get('id');
        $extension_imagen = $this->post('file_type');
        $file_editado = $this->post('file_editado');
        $data = $this->_fill_update_data();
        $this->db->trans_start();
        if ($this->personas_clientes_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, 'personas_clientes', $data);
            if ($data['tiene_logotipo'] === '1' && $file_editado === '1') {
                $this->_upload_file($id, $extension_imagen);
//                $this->_resize_file($id);
            }
            $this->db->trans_complete();
            $this->response(['message' => 'Cambios guardados'], REST_Controller::HTTP_CREATED);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
     * @title Metodo para borrar un registro
     * @url /personas_clientes/inactivate/id/:id
     * @access public
     * @method POST
     * @urlParams id: [integer]
     * @successResponse Code: 200 HTTP_OK Content: {message:[string]}
     * @errorResponse Code: 400 HTTP_BAD_REQUEST Content: {message:[string]}
     */

    public function inactivate_post() {
        $this->_validation_id();
        $id = $this->get('id');
        $data['status'] = -1;
        $data['updated_at'] = date('Y-m-d H:i:s');
        if ($this->personas_clientes_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "personas_clientes");
            $this->response(['message' => 'El registro se dio de baja con &eacute;xito.'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * intenta subir un archivo a la carpeta de soporte de la persona
     * 
     * @access protected
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    private function _upload_file($cliente_id, $extension_file) {
        $this->load->helper(array('files_helper', 'path_helper'));
        path_create(array(get_persona_id(), "clientes", $cliente_id, "logotipo"), $this->config->item("personas_path")); //generamos los paths correspodientes
        $path_upload = $this->config->item("personas_path") . "/" . get_persona_id() . "/clientes/" . $cliente_id . "/" . 'logotipo';
        upload_file($path_upload, 'prueba', 'file_logotipo', "*", TRUE);
        if ($extension_file === 'image/png') {
            $src = $this->config->item("personas_path") . "/" . get_persona_id() . "/clientes/" . $cliente_id . "/" . 'logotipo/prueba.png';
            $png = imagecreatefrompng($src);
            $src_jpeg = $this->config->item("personas_path") . "/" . get_persona_id() . "/clientes/" . $cliente_id . "/" . 'logotipo/prueba.jpg';
            imagejpeg($png, $src_jpeg);
            unlink($src);
        }
        $this->_resize_file($cliente_id);
        $this->_create_logotipo($cliente_id);
    }

    /**
     * intenta subir un archivo a la carpeta de soporte de la persona
     * 
     * @access protected
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    private function _resize_file($cliente_id) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $this->config->item("personas_path") . "/" . get_persona_id() . "/clientes/" . $cliente_id . "/" . 'logotipo/prueba.jpg';
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 200;
        $config['height'] = 200;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }

    private function _create_logotipo($cliente_id) {
        $imagen = imagecreate(200, 200);
        imagecolorallocate($imagen, 255, 255, 255);
        header('Content-type: image/jpeg');
        imagejpeg($imagen, $this->config->item("personas_path") . "/" . get_persona_id() . "/clientes/" . $cliente_id . "/" . 'logotipo/background.jpg');
        $src_prueba = $this->config->item("personas_path") . "/" . get_persona_id() . "/clientes/" . $cliente_id . "/" . 'logotipo/prueba.jpg';
        $src_background = $this->config->item("personas_path") . "/" . get_persona_id() . "/clientes/" . $cliente_id . "/" . 'logotipo/background.jpg';
        $imagen_destino = imagecreatefromjpeg($this->config->item("personas_path") . "/" . get_persona_id() . "/clientes/" . $cliente_id . "/" . 'logotipo/background.jpg');
        $imagen_original = imagecreatefromjpeg($this->config->item("personas_path") . "/" . get_persona_id() . "/clientes/" . $cliente_id . "/" . 'logotipo/prueba.jpg');
        $tamanio = getimagesize($this->config->item("personas_path") . "/" . get_persona_id() . "/clientes/" . $cliente_id . "/" . 'logotipo/prueba.jpg');
        $width_imagen_original = $tamanio[0];
        $height_imagen_original = $tamanio[1];
        if ($width_imagen_original > $height_imagen_original) {
            $padding_top = (200 - $height_imagen_original) / 2;
            imagecopy($imagen_destino, $imagen_original, 0, $padding_top, 0, 0, $width_imagen_original, $height_imagen_original);
            $path = $this->config->item("personas_path") . "/" . get_persona_id() . "/clientes/" . $cliente_id . "/" . 'logotipo/logotipo.jpg';
            imagejpeg($imagen_destino, $path);
        } else if ($width_imagen_original < $height_imagen_original) {
            $padding_left = (200 - $width_imagen_original) / 2;
            imagecopy($imagen_destino, $imagen_original, $padding_left, 0, 0, 0, $width_imagen_original, $height_imagen_original);
            $path = $this->config->item("personas_path") . "/" . get_persona_id() . "/clientes/" . $cliente_id . "/" . 'logotipo/logotipo.jpg';
            imagejpeg($imagen_destino, $path);
        }

        unlink($src_prueba);
        unlink($src_background);
    }

    /*
     * @title Metodo para recuperar un registro
     * @url /personas_clientes/reactive/id/:id
     * @access public
     * @method POST
     * @urlParams id: [integer]
     * @successResponse Code: 200 HTTP_OK Content: {message:[string]}
     * @errorResponse Code: 400 HTTP_BAD_REQUEST Content: {message:[string]}
     */

    public function reactivate_post() {
        $this->_validation_id();
        $id = $this->get('id');
        $data['status'] = 1;
        $data['updated_at'] = date('Y-m-d H:m:s');
        if ($this->personas_clientes_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "personas_clientes", $data);
            $this->response(['message' => 'El registro se dio de alta con &eacute;xito.'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Llena el arreglo con los datos que se actualizan en la bd
     * 
     * @access protected
     * @return array
     */
    private function _fill_insert_data() {
        $data = array();
        $data['colonia_id'] = $this->post('colonia_id');
        $data['persona_id'] = $this->get('persona_id');
        $data['nombre'] = $this->post('nombre');
        $data['razon_social'] = $this->post('razon_social');
        $data['rfc'] = $this->post('rfc');
        $data['calle'] = $this->post('calle');
        $data['numero_interior'] = $this->post('numero_interior');
        $data['numero_exterior'] = $this->post('numero_exterior');
        $data['pais'] = 'México';
        $data['email'] = $this->post('email');
        $data['tiene_logotipo'] = $this->post('tiene_logotipo');
        $data['created_at'] = date('Y-m-d H:m:s');
        $data['status'] = 1;
        return $data;
    }

    /**
     * Llena el arreglo con los datos que se insertan en la bd
     * 
     * @access protected
     * @return array
     */
    private function _fill_update_data() {
        $data = array();
        $data['id'] = $this->get('id');
        $data['colonia_id'] = $this->post('colonia_id');
        $data['nombre'] = $this->post('nombre');
        $data['razon_social'] = $this->post('razon_social');
        $data['rfc'] = $this->post('rfc');
        $data['calle'] = $this->post('calle');
        $data['numero_interior'] = $this->post('numero_interior');
        $data['numero_exterior'] = $this->post('numero_exterior');
        $data['email'] = $this->post('email');
        $data['tiene_logotipo'] = $this->post('tiene_logotipo');
        $data['updated_at'] = date('Y-m-d H:m:s');
        return $data;
    }

    /**
     * Reglas que tienen que pasar el formulario recibido
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_insert() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('colonia_id', 'Colonia_id', 'trim|required|integer');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('razon_social', 'Razon_social', 'trim|required');
        $this->form_validation->set_rules('rfc', 'Rfc', 'trim|rfc|required');
        $this->form_validation->set_rules('calle', 'calle', 'trim|required');
        $this->form_validation->set_rules('numero_interior', 'Numero_interior', 'trim');
        $this->form_validation->set_rules('numero_exterior', 'Numero_exterior', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
        $this->form_validation->set_rules('tiene_logotipo', 'Tiene logotipo', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Reglas que tienen que pasar el formulario recibido para poder ser actualizado
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_update() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('id', 'Id', 'trim|required');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('rfc', 'RFC', 'trim|required|rfc|callback_is_unique_update', array('rfc' => 'El RFC que intentas registrar no es valido.'));
        $this->form_validation->set_rules('colonia_id', 'Colonia_id', 'trim|required|integer');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('razon_social', 'Razon_social', 'trim|required');
        $this->form_validation->set_rules('calle', 'calle', 'trim|required');
        $this->form_validation->set_rules('numero_interior', 'Numero_interior', 'trim');
        $this->form_validation->set_rules('numero_exterior', 'Numero_exterior', 'trim');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
        $this->form_validation->set_rules('tiene_logotipo', 'Tiene_logotipo', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Reglas que tienen que pasar el formulario recibido para poder ser inactivado o reactivado
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_id() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('id', 'Id', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Reglas que tiene que pasar el metodo para poder recibir los datos
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    /*
      Realizando las validaciones para el metodo get_by_id_get
     */
    private function _validation_get_id() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('id', 'Id', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Reglas que tiene que pasar el metodo para poder recibir los datos
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    /*
      Realizando las validaciones para el metodo get_by_persona_id_get
     */
    private function _validation_get_persona_id() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('persona_id', 'Persona_id', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    /**
     * Reglas que tiene que pasar el metodo para poder recibir los datos
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    /*
      Realizando las validaciones para el metodo get_by_persona_id_get
     */
    private function _validation_rfc() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('rfc', 'R.F.C.', 'trim|required');
        if (!$this->params_validation->run()) {
            $this->response(['message' => params_validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function is_unique_update() {
        $persona_id = get_persona_id();
        $rfc = $this->post('rfc');
        $cliente_id = $this->get('id');
        $existe_rfc_con_persona_id = $this->personas_clientes_model->get_rfc_by_persona_id($cliente_id, $persona_id, $rfc);
        $existe_rfc = $this->personas_clientes_model->get_rfc($persona_id, $rfc);
        if ($existe_rfc_con_persona_id) {
            $this->form_validation->set_message('is_unique_update', 'El RFC ya existe.');
            return FALSE;
        } else if (!$existe_rfc) {
            return TRUE;
        }
    }

}
