<?php

/**
 * Description of Personas_clientes_contacto
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
class Personas_productos extends REST_Controller {
    /*
      Metodo constructor de la clase
     */

    function __construct() {
        parent::__construct();
        $this->load->model('personas_productos_model');
        date_default_timezone_set('America/Mexico_City');
    }

    public function get_all_by_persona_id_get() {
        $persona_id = get_persona_id();
        $data['personas_productos'] = $this->personas_productos_model->get_all_by_persona_id($persona_id);
        if ($data['personas_productos'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        }
    }

    /**
     * @title Metodo para obtener todo los registros inactivos de la tablapersonas_productos
     * @url /personas_productos/get_all_inactive
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    public function get_all_inactive_get() {
        $data['personas_productos'] = $this->personas_productos_model->get_all_inactive();
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * @title Metodo para obtener todo los registros inactivos de la tablapersonas_productos
     * @url /personas_productos/get_all_inactive
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    public function get_producto_by_producto_id_get() {
        $this->_validation_get_producto_id();
        $producto_id = $this->get('producto_id');
        $data['persona_producto'] = $this->personas_productos_model->get_producto_by_producto_id($producto_id);
        if ($data['persona_producto'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo para obtener el producto por clave
     * @url /personas_productos/get_producto_by_clave_get
     * @access public
     * @method GET
     * @successResponse Code: 200 HTTP_OK 
     */
    public function get_producto_by_clave_get() {
        $this->_validation_producto_clave();
        $clave_producto = $this->get('clave');
        $persona_id = get_persona_id();
        $data['producto'] = $this->personas_productos_model->get_producto_by_clave($clave_producto, $persona_id);
        if ($data['producto'] !== NULL) {
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(["message" => "Producto no encontrado"], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    /**
     * @title Metodo para crear un registro.
     * @url /personas_productos/create
     * @access public
     * @method POST
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

        $this->db->trans_start();
        $id = $this->personas_productos_model->insert($data);
        if ($id === NULL) {
            $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->helper('logs');
        insert_log($id, 'personas_productos', 1);
        if ($data['tiene_foto_producto'] === '1') {
            $this->_upload_file($id, $extension_imagen);
        }
        $this->db->trans_complete();
        $this->response(['id' => $id, 'message' => 'Contenido actualizado correctamente'], REST_Controller::HTTP_CREATED);
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
        if ($this->personas_productos_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, 'personas_productos', $data);
            if ($data['tiene_foto_producto'] === '1' && $file_editado === '1') {
                $this->_upload_file($id, $extension_imagen);
//                $this->_resize_file($id);
            }
            $this->db->trans_complete();
            $this->response(['message' => 'Cambios guardados'], REST_Controller::HTTP_CREATED);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * intenta subir un archivo a la carpeta de productos de la persona
     * 
     * @access protected
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    private function _upload_file($producto_id, $extension_file) {
        $this->load->helper(array('files_helper', 'path_helper'));
        path_create(array(get_persona_id(), "productos", $producto_id, "imagen_producto"), $this->config->item("personas_path")); //generamos los paths correspodientes
        $path_upload = $this->config->item("personas_path") . "/" . get_persona_id() . "/productos/" . $producto_id . "/" . 'imagen_producto';
        upload_file($path_upload, 'prueba', 'file_producto', "*", TRUE);
        if ($extension_file === 'image/png') {
            $src = $this->config->item("personas_path") . "/" . get_persona_id() . "/productos/" . $producto_id . "/" . 'imagen_producto/prueba.png';
            $png = imagecreatefrompng($src);
            $src_jpeg = $this->config->item("personas_path") . "/" . get_persona_id() . "/productos/" . $producto_id . "/" . 'imagen_producto/prueba.jpg';
            imagejpeg($png, $src_jpeg);
            unlink($src);
        }
        $this->_resize_file($producto_id);
        $this->_create_imagen_producto($producto_id);
    }

    /**
     * Método para redimensionar la imágen de la carpeta productos
     * 
     * @access protected
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    private function _resize_file($producto_id) {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $this->config->item("personas_path") . "/" . get_persona_id() . "/productos/" . $producto_id . "/" . 'imagen_producto/prueba.jpg';
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 600;
        $config['height'] = 600;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }

    private function _create_imagen_producto($producto_id) {
        $imagen = imagecreate(600, 600);
        imagecolorallocate($imagen, 255, 255, 255);
        header('Content-type: image/png');
        imagejpeg($imagen, $this->config->item("personas_path") . "/" . get_persona_id() . "/productos/" . $producto_id . "/" . 'imagen_producto/background.jpg');
        $src_prueba = $this->config->item("personas_path") . "/" . get_persona_id() . "/productos/" . $producto_id . "/" . 'imagen_producto/prueba.jpg';
        $src_background = $this->config->item("personas_path") . "/" . get_persona_id() . "/productos/" . $producto_id . "/" . 'imagen_producto/background.jpg';
        $imagen_destino = imagecreatefromjpeg($this->config->item("personas_path") . "/" . get_persona_id() . "/productos/" . $producto_id . "/" . 'imagen_producto/background.jpg');
        $imagen_original = imagecreatefromjpeg($this->config->item("personas_path") . "/" . get_persona_id() . "/productos/" . $producto_id . "/" . 'imagen_producto/prueba.jpg');
        $tamanio = getimagesize($this->config->item("personas_path") . "/" . get_persona_id() . "/productos/" . $producto_id . "/" . 'imagen_producto/prueba.jpg');
        $width_imagen_original = $tamanio[0];
        $height_imagen_original = $tamanio[1];
        if ($width_imagen_original > $height_imagen_original) {
            $padding_top = (600 - $height_imagen_original) / 2;
            imagecopy($imagen_destino, $imagen_original, 0, $padding_top, 0, 0, $width_imagen_original, $height_imagen_original);
            $path = $this->config->item("personas_path") . "/" . get_persona_id() . "/productos/" . $producto_id . "/" . 'imagen_producto/producto.jpg';
            imagejpeg($imagen_destino, $path);
        } else if ($width_imagen_original < $height_imagen_original) {
            $padding_left = (600 - $width_imagen_original) / 2;
            imagecopy($imagen_destino, $imagen_original, $padding_left, 0, 0, 0, $width_imagen_original, $height_imagen_original);
            $path = $this->config->item("personas_path") . "/" . get_persona_id() . "/productos/" . $producto_id . "/" . 'imagen_producto/producto.jpg';
            imagejpeg($imagen_destino, $path);
        }

        unlink($src_prueba);
        unlink($src_background);
    }

    /*
     * @title Metodo para borrar un registro
     * @url /personas_productos/inactivate/id/:id
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
        if ($this->personas_productos_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "personas_productos");
            $this->response(['message' => 'El registro se dio de baja con &eacute;xito.'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /*
     * @title Metodo para recuperar un registro
     * @url /personas_productos/reactive/id/:id
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
        if ($this->personas_productos_model->update($id, $data)) {
            $this->load->helper('logs');
            insert_log($id, "personas_productos", $data);
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
        $data['producto_sat_id'] = $this->post('producto_sat_id');
        $data['persona_id'] = get_persona_id();
        $data['unidad_de_medida_id'] = $this->post('unidad_de_medida_id');
        $data['tipo'] = $this->post('tipo');
        $data['producto'] = $this->post('producto');
        $data['clave'] = $this->post('clave');
        $data['cantidad'] = $this->post('cantidad');
        $data['precio_compra'] = $this->post('precio_compra');
        $data['precio_venta'] = $this->post('precio_venta');
        $data['proveedor'] = $this->post('proveedor');
        $data['comentario'] = $this->post('comentario');
        $data['tiene_foto_producto'] = $this->post('tiene_foto_producto');
        $data['status'] = 1;
        $data['created_at'] = date('Y-m-d H:i:s');
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
        $data['producto_sat_id'] = $this->post('producto_sat_id');
        $data['persona_id'] = get_persona_id();
        $data['unidad_de_medida_id'] = $this->post('unidad_de_medida_id');
        $data['tipo'] = $this->post('tipo');
        $data['producto'] = $this->post('producto');
        $data['clave'] = $this->post('clave');
        $data['cantidad'] = $this->post('cantidad');
        $data['precio_compra'] = $this->post('precio_compra');
        $data['precio_venta'] = $this->post('precio_venta');
        $data['proveedor'] = $this->post('proveedor');
        $data['comentario'] = $this->post('comentario');
        $data['tiene_foto_producto'] = $this->post('tiene_foto_producto');
        $data['updated_at'] = date('Y-m-d H:m:s');
        return $data;
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
     * Reglas que tienen que pasar el formulario recibido
     * 
     * @access protected
     * @errorResponse Code: 401 HTTP_BAD_REQUEST Content: {message:[string]}
     */
    private function _validation_insert() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('producto_sat_id', 'producto SAT id', 'trim|required');
        $this->form_validation->set_rules('unidad_de_medida_id', 'unidad de medida id', 'trim|required');
        $this->form_validation->set_rules('tipo', 'tipo', 'trim|required|integer');
        $this->form_validation->set_rules('producto', ' producto', 'trim|required');
        $this->form_validation->set_rules('cantidad', 'cantidad', 'trim|required|numeric');
        $this->form_validation->set_rules('precio_compra', 'precio compra', 'trim|required|numeric');
        $this->form_validation->set_rules('precio_venta', 'precio venta', 'trim|required|numeric');
        $this->form_validation->set_rules('proveedor', 'proveedor', 'trim|required');
        $this->form_validation->set_rules('tiene_foto_producto', 'tiene foto de producto', 'trim|required');
        if (!$this->form_validation->run()) {
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
    private function _validation_get_producto_id() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('producto_id', 'Persona_id', 'trim|required|integer|is_natural');
        if (!$this->params_validation->run()) {
            $this->response(['message' => params_validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    private function _validation_producto_clave() {
        $this->load->library('params_validation');
        $this->params_validation->set_rules('clave', 'Clave', 'trim|required');
        if (!$this->params_validation->run()) {
            $this->response(['message' => params_validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
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
        $this->form_validation->set_rules('producto_sat_id', 'producto SAT id', 'trim|required');
        $this->form_validation->set_rules('unidad_de_medida_id', 'unidad de medida id', 'trim|required');
        $this->form_validation->set_rules('tipo', 'tipo', 'trim|required|integer');
        $this->form_validation->set_rules('producto', 'clave producto', 'trim|required');
        $this->form_validation->set_rules('cantidad', 'cantidad', 'trim|required|numeric');
        $this->form_validation->set_rules('precio_compra', 'precio compra', 'trim|required|numeric');
        $this->form_validation->set_rules('precio_venta', 'precio venta', 'trim|required|numeric');
        $this->form_validation->set_rules('proveedor', 'proveedor', 'trim|required');
        $this->form_validation->set_rules('tiene_foto_producto', 'tiene foto de producto', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}
