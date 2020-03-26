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

    public function __construct() {
        parent::__construct();
        $this->load->model('personas_model');
        date_default_timezone_set('America/Mexico_City');
        $this->load->helper('session');
    }

    public function get_datos_get() {
        $this->load->model('domicilios_fiscales_model');
        $persona_id = get_persona_id();
        $persona = $this->personas_model->get_by_id($persona_id);
        if ($persona !== NULL) {
            $domicilio_fiscal = $this->domicilios_fiscales_model->get_by_persona_id($persona_id);
            $data['persona'] = array_merge($persona, $domicilio_fiscal);
            $this->response($data, REST_Controller::HTTP_OK);
        } else {
            $this->response(array('Error al obtener los datos'), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo que trae la efirma de la persona por persona_id.
     * @url /personas/get_efirma_by_persona_id
     * @access public
     * @method GET
     * @sessionParams[persona_id:int]
     * @successResponse Code: 201 HTTP_CREATED Content: {id:[integer], message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    public function get_efirma_by_persona_id_get() {
        $persona_id = get_persona_id();
        $tiene_efirma = $this->personas_model->get_efirma_by_persona_id($persona_id);
        if ($tiene_efirma !== NULL) {
            $this->response(TRUE, REST_Controller::HTTP_OK);
        } else {
            $this->response(FALSE, REST_Controller::HTTP_OK);
        }
    }

    /**
     * @title Metodo que trae los regimenes de la persona por persona_id.
     * @url /personas/get_regimenes_by_persona_id_get
     * @access public
     * @method GET
     * @sessionParams[persona_id:int]
     * @successResponse Code: 201 HTTP_CREATED Content: {id:[integer], message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    public function get_regimenes_by_persona_id_get() {
        $persona_id = get_persona_id();
        $data['regimenes'] = [];
        $data['regimenes'] = $this->personas_model->get_regimenes_by_persona_id($persona_id);
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * @title Metodo que trae los paquetes de la persona por persona_id.
     * @url /personas/get_paquetes_by_persona_id_get
     * @access public
     * @method GET
     * @sessionParams[persona_id:int]
     * @successResponse Code: 201 HTTP_CREATED Content: {id:[integer], message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    public function get_paquetes_by_persona_id_get() {
        $persona_id = get_persona_id();
        $data['paquete'] = [];
        $persona_paquete = $this->personas_model->get_paquete_by_persona_id($persona_id);
        if ($persona_paquete !== NULL) {
            $data['paquete'] = $persona_paquete;
        }
        $this->response($data, REST_Controller::HTTP_OK);
    }

    /**
     * @title Metodo para crear una pagar en openpay.
     * @url /personas/create
     * @access public
     * @method POST
     * @successResponse Code: 201 HTTP_CREATED Content: {id:[integer], message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    /*
      Creando un nuevo registro
     */
    public function pay_with_tarjeta_bancaria_post() {
        $this->_validation_tarjeta();
        $persona_id = get_persona_id();
        $paquete_persona = $this->personas_model->get_paquete_by_persona_id($persona_id);
        if ($paquete_persona['status'] === 1 && $paquete_persona['vigencia_termino'] < date('Y-m-d') && $paquete_persona['vigencia_inicio'] > date('Y-m-d')) {
            $this->response(['message' => 'Usted ya tiene un plan activo, si desea cambiarlo contacte con soporte'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $usuario = $this->personas_model->get_usuario_by_persona_id($persona_id);
        $customer_data = $this->_fill_customer_data($usuario);
        $card_data = $this->_fill_card_data();
        $this->load->helper('openpay_helper');
        $customer_id = create_customer($customer_data);
        $data = array('openpay_id' => $customer_id);
        $this->db->trans_start();
        $this->personas_model->update($persona_id, $data);
        $card = add_card_to_customer($customer_id, $card_data);
        if (!is_object($card)) {
            $this->response(['message' => $card['message']], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->model('paquetes_model');
        $paquete = $this->paquetes_model->get_by_id($paquete_persona['paquete_id']);
        $subscription_data = $this->_fill_subscription_data($paquete, $card);
        $subscription = subscribe_customer_to_plan($customer_id, $subscription_data);
        if (!is_object($subscription)) {
            $this->response(['message' => $subscription['message']], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $data_compra_paquete = $this->_fill_update_compra_paquete($subscription->id, $paquete, 1);
        if ($this->personas_model->update_paquete_persona($paquete_persona['id'], $data_compra_paquete)) {
            $this->db->trans_complete();
            $this->response(['message' => 'Se realizo el pago con &eacute;xito'], REST_Controller::HTTP_CREATED);
        }
        $this->response(['message' => 'Hubo un error al actualizar los datos'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * @title Metodo para crear un registro.
     * @url /personas/create
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
        $data_persona = $this->_fill_insert_data_persona();
        $this->db->trans_start();
        $persona_id = $this->personas_model->insert($data_persona);
        $contabilidad_atrasada = $data_persona['contabilidad_atrasada'];
        $tiene_efirma_vigente = $data_persona['tiene_efirma_vigente'];
        if ($persona_id === NULL) {
            $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->model('domicilios_fiscales_model');
        $data_domicilio_fiscal = $this->_fill_insert_data_domicilio_fiscal($persona_id);
        $domicilio_fiscal_id = $this->domicilios_fiscales_model->insert($data_domicilio_fiscal);
        if ($domicilio_fiscal_id === NULL) {
            $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->load->model('usuarios_personas_model');
        $data_usuario_persona = $this->_fill_insert_data_usuario_persona($persona_id);
        $usuario_persona_id = $this->usuarios_personas_model->insert($data_usuario_persona);
        if ($usuario_persona_id === NULL) {
            $this->response(['message' => 'Error: No se guardo el contenido'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->_create_pdf($persona_id, $data_persona['razon_social'], $data_persona['tipo'], $data_persona['rfc']);
        $this->db->trans_complete();
        set_persona_id($persona_id);
        set_contabilidad_atrasada($contabilidad_atrasada);
        set_tiene_efirma_vigente($tiene_efirma_vigente);
        $this->response(['persona_id' => $persona_id, 'contabilidad_atrasada' => $contabilidad_atrasada, 'tiene_efirma_vigente' => $tiene_efirma_vigente, 'message' => 'Contenido actualizado correctamente'], REST_Controller::HTTP_CREATED);
    }

    /**
     * @title Metodo para crear la efirma de la persona
     * @url /personas/update_efirma
     * @access public
     * @method POST
     * @successResponse Code: 201 HTTP_CREATED Content: {id:[integer], message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    /*
      Creando un nuevo registro
     */
    public function update_efirma_post() {
        $data_efirma = $this->_fill_insert_efirma();
        if (!$data_efirma['tiene_efirma'] || $data_efirma['cambiar_efirma']) {
            $this->_validation_efirma();
            $this->load->library('encryption');
            $this->encryption->initialize(
                    array(
                        'cipher' => 'aes-256',
                        'mode' => 'ctr',
                        'key' => $this->config->item('encryption_key')
                    )
            );
            $data['efirma'] = $this->encryption->encrypt($data_efirma['efirma']);
            $persona_id = get_persona_id();
            if ($this->personas_model->update($persona_id, $data)) {
                $this->response(['message' => 'Se actualizo la efirma de la persona'], REST_Controller::HTTP_CREATED);
            } else {
                $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    /**
     * @title Metodo para crear un registro.
     * @url /personas/update
     * @access public
     * @method POST
     * @successResponse Code: 201 HTTP_CREATED Content: {id:[integer], message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    /*
      Editando un registro ya existente
     */
    public function update_post() {
        $this->_validation_update();
        $persona_id = get_persona_id();
        $this->load->model('domicilios_fiscales_model');
        $data_persona = $this->_fill_update_data_persona();
        $contabilidad_atrasada = $data_persona['contabilidad_atrasada'];
        $tiene_efirma_vigente = $data_persona['tiene_efirma_vigente'];
        $this->db->trans_start();
        if ($this->personas_model->update($persona_id, $data_persona)) {
            $data_domicilio_fiscal = $this->_fill_update_data_domicilio_fiscal($persona_id);
            $this->domicilios_fiscales_model->update($persona_id, $data_domicilio_fiscal);
            $this->_create_pdf($persona_id, $data_persona['razon_social'], $data_persona['tipo'], $data_persona['rfc']);
            $this->db->trans_complete();
            set_contabilidad_atrasada($contabilidad_atrasada);
            set_tiene_efirma_vigente($tiene_efirma_vigente);
            $this->response(['contabilidad_atrasada' => $contabilidad_atrasada, 'tiene_efirma_vigente' => $tiene_efirma_vigente, 'message' => 'Cambios guardados'], REST_Controller::HTTP_CREATED);
        } else {
            $this->response(['message' => 'Error no se pudieron actualizar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @title Metodo para crear un registro de paquetes y registros
     * @url /personas/save_paquete_and_regimenes
     * @access public
     * @method POST
     * @successResponse Code: 201 HTTP_CREATED Content: {id:[integer], message:[string]}
     * @errorResponse Code: 500 HTTP_INTERNAL_SERVER_ERROR Content: {message:[string]}
     */
    /*
      Editando un registro ya existente
     */
    public function save_paquete_and_regimenes_post() {
        $this->_validation_paquete_regimenes();
        $persona_id = get_persona_id();
        $this->db->trans_start();
        $regimenes_persona = $this->personas_model->get_regimenes_by_persona_id($persona_id);
        $paquete_persona = $this->personas_model->get_paquete_by_persona_id($persona_id);
        $data['status'] = -1;
        if ($this->_inactivate_previous_regimenes($regimenes_persona, $data)) {
            if ($this->personas_model->update_paquete_persona($paquete_persona['id'], $data)) {
                $regimenes = $this->post('regimenes');
                if ($this->_save_regimenes($persona_id, $regimenes)) {
                    $data_paquete = $this->_fill_insert_data_paquetes($persona_id);
                    if ($this->personas_model->insert_persona_paquete($data_paquete)) {
                        $this->load->model('paquetes_model');
                        $paquete = $this->paquetes_model->get_by_id($data_paquete['paquete_id']);
                        $usuario = $this->personas_model->get_usuario_by_persona_id($persona_id);
                        $paquete['plazo_de_contrato'] = $paquete['periodo'] === '12' ? 'anual' : 'mensual';
                        $this->load->helper('openpay_helper');
                        $barcode_data = $this->_fill_barcode_data($paquete, $usuario);
                        $barcode = create_barcode($barcode_data);
                        $this->_create_payment_pdf($persona_id, $paquete, $usuario, $barcode->payment_method);
                        $this->db->trans_complete();
                        $this->response(['message' => 'Datos guardados'], REST_Controller::HTTP_CREATED);
                    }
                }
            }
        }
        $this->response(['message' => 'Error no se pudieron guardar los cambios'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * inserta los regimenes de la persona
     * 
     * @access protected
     * @return array
     */
    private function _save_regimenes($persona_id, $regimenes) {
        foreach ($regimenes as $regimen) {
            $data_regimenes = $this->_fill_insert_data_regimenes($persona_id, $regimen[0]);
            if (!$this->personas_model->insert_regimen_persona($data_regimenes)) {
                return FALSE;
            }
        }
        return TRUE;
    }

    private function _inactivate_previous_regimenes($regimenes_persona, $data) {
        foreach ($regimenes_persona as $regimen) {
            if (!$this->personas_model->update_regimen_persona($regimen['id'], $data)) {
                return FALSE;
            }
        }
        return TRUE;
    }

    /**
     * Envia correo a usuario cuya persona no tienen efirma vigente
     * 
     * @access protected
     * @return array
     */
    public function enviar_correo_no_tengo_efirma_vigente_by_usuario_id_get() {
        $this->load->model('usuarios_model');
        $usuario_id = $this->get('id');
        $data_usuario = $this->usuarios_model->get_email_by_id_usuario($usuario_id);
        if ($this->_envio_correo($data_usuario['email'], $data_usuario['nombre_usuario'])) {
            $this->response(['message' => 'Se envio el correo de manera éxitosa'], REST_Controller::HTTP_OK);
        } else {
            $this->response(['message' => 'Error: No se envio el correo'], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function _envio_correo($email_usuario, $nombre_usuario) {
        $this->load->helper('email');
        $envio_mail = generate_email_no_tengo_efirma_vigente($email_usuario, $nombre_usuario);
        if ($envio_mail) {
//            $id = $this->usuarios_contactados_model->insert($);
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Llena el arreglo con los datos que se actualizan en la bd
     * 
     * @access protected
     * @return array
     */
    private function _fill_insert_data_persona() {
        $data_persona = array();
        $data_persona['rfc'] = $this->post('rfc');
        $data_persona['razon_social'] = $this->post('razon_social');
        $data_persona['tipo'] = $this->post('tipo');
        $data_persona['curp'] = $this->post('curp');
        $data_persona['actividad'] = $this->post('actividad');
        $data_persona['cantidad_trabajadores'] = $this->post('cantidad_trabajadores');
        $data_persona['contabilidad_atrasada'] = $this->post('contabilidad_atrasada');
        $data_persona['tiene_efirma_vigente'] = $this->post('tiene_efirma_vigente');
        $data_persona['created_at'] = date('Y-m-d H:i:s');
        $data_persona['status'] = 1;
        return $data_persona;
    }

    private function _fill_insert_data_domicilio_fiscal($persona_id) {
        $data = array();
        $data['persona_id'] = $persona_id;
        $data['colonia_id'] = $this->post('colonia_id');
        $data['nombre'] = $this->post('nombre');
        $data['calle'] = $this->post('calle');
        $data['numero_interior'] = $this->post('numero_interior');
        $data['numero_exterior'] = $this->post('numero_exterior');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        return $data;
    }

    private function _fill_insert_data_usuario_persona($persona_id) {
        $data = array();
        $data['usuario_id'] = check_id();
        $data['persona_id'] = $persona_id;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        return $data;
    }

    private function _fill_insert_data_paquetes($persona_id) {
        $data = array();
        $data['paquete_id'] = $this->post('paquete_id');
        $data['persona_id'] = $persona_id;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['status'] = 2;
        return $data;
    }

    private function _fill_insert_data_regimenes($persona_id, $regimen) {
        $data = array();
        $data['regimen_fiscal_id'] = $regimen;
        $data['persona_id'] = $persona_id;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['status'] = 1;
        return $data;
    }

    private function _fill_customer_data($usuario) {
        $data = array();
        $data['name'] = $usuario['nombre'] . ' ' . $usuario['apellido_paterno'] . ' ' . $usuario['apellido_materno'];
        $data['email'] = $usuario['email'];
        return $data;
    }

    private function _fill_card_data() {
        $data = array();
        $data['holder_name'] = $this->post('nombre_titular');
        $data['card_number'] = $this->post('numero_tarjeta');
        $data['cvv2'] = $this->post('codigo');
        $data['expiration_month'] = $this->post('mes_expiracion');
        $data['expiration_year'] = $this->post('anio_expiracion');
        return $data;
    }

    private function _fill_subscription_data($paquete, $card) {
        $data = array();
        $data['plan_id'] = $paquete['open_pay_id'];
        $data['card_id'] = $card->id;
        return $data;
    }

    private function _fill_update_data_domicilio_fiscal($persona_id) {
        $data_domicilio_fiscal = array();
        $data_domicilio_fiscal['persona_id'] = $persona_id;
        $data_domicilio_fiscal['colonia_id'] = $this->post('colonia_id');
        $data_domicilio_fiscal['nombre'] = $this->post('nombre');
        $data_domicilio_fiscal['calle'] = $this->post('calle');
        $data_domicilio_fiscal['numero_interior'] = $this->post('numero_interior');
        $data_domicilio_fiscal['numero_exterior'] = $this->post('numero_exterior');
        $data_domicilio_fiscal['updated_at'] = date('Y-m-d H:i:s');
        $data_domicilio_fiscal['status'] = 1;
        return $data_domicilio_fiscal;
    }

    private function _fill_insert_efirma() {
        $data_efirma = array();
        $data_efirma['efirma'] = $this->post('efirma');
        $data_efirma['tiene_efirma'] = $this->post('tiene_efirma');
        $data_efirma['cambiar_efirma'] = $this->post('cambiar_efirma');

        if ($data_efirma['tiene_efirma'] === 'true') {
            $data_efirma['tiene_efirma'] = TRUE;
        } else {
            $data_efirma['tiene_efirma'] = FALSE;
        }
        if ($data_efirma['cambiar_efirma'] === 'true') {
            $data_efirma['cambiar_efirma'] = TRUE;
        } else {
            $data_efirma['cambiar_efirma'] = FALSE;
        }
        return $data_efirma;
    }

    /**
     * Llena el arreglo con los datos que se actualizan en la bd
     * 
     * @access protected
     * @return array
     */
    private function _fill_update_data_persona() {
        $data_persona = array();
        $data_persona['rfc'] = $this->post('rfc');
        $data_persona['razon_social'] = $this->post('razon_social');
        $data_persona['tipo'] = $this->post('tipo');
        $data_persona['curp'] = $this->post('curp');
        $data_persona['actividad'] = $this->post('actividad');
        $data_persona['cantidad_trabajadores'] = $this->post('cantidad_trabajadores');
        $data_persona['contabilidad_atrasada'] = $this->post('contabilidad_atrasada');
        $data_persona['tiene_efirma_vigente'] = $this->post('tiene_efirma_vigente');
        $data_persona['updated_at'] = date('Y-m-d H:i:s');
        $data_persona['status'] = 1;
        return $data_persona;
    }

    /**
     * Llena el arreglo con los datos que se actualizan en la bd
     * 
     * @access protected
     * @return array
     */
    private function _fill_update_compra_paquete($pago_id, $paquete, $tipo_pago) {
        $data_compra_paquete = array();
        $data_compra_paquete['tipo_de_pago'] = $tipo_pago;
        $data_compra_paquete['vigencia_inicio'] = date('Y-m-d');
        $data_compra_paquete['vigencia_termino'] = date('Y-m-d', strtotime('+' . $paquete['periodo'] . 'months', strtotime($data_compra_paquete['vigencia_inicio'])));
        $data_compra_paquete['openpay_pago_id'] = $pago_id;
        $data_compra_paquete['status'] = 1;
        return $data_compra_paquete;
    }

    private function _fill_barcode_data($paquete, $usuario) {
        $data = array();
        $data['method'] = 'store';
        $data['amount'] = $paquete['precio'];
        $data['description'] = 'Inscripción ' . $paquete['plazo_de_contrato'] . ' con massiva';
        $data['customer'] = array();
        $data['customer']['name'] = $usuario['nombre'];
        $data['customer']['last_name'] = $usuario['apellido_paterno'] . ' ' . $usuario['apellido_materno'];
        $data['customer']['email'] = $usuario['email'];
        return $data;
    }

//    private function _create_pdf($razon_social, $tipo, $rfc) {
//        $contrato_html = $this->load->view('contrato/pdf', array('razon_social' => $razon_social, 'tipo' => $tipo, 'rfc' => $rfc), TRUE);
//        require_once __DIR__ . '../../../../../vendor/autoload.php';
//        $mpdf = new \Mpdf\Mpdf();
//        $mpdf->WriteHTML($contrato_html);
////        $mpdf->Output();
//        $this->load->helper(array('files_helper', 'path_helper'));
//        path_create(array(get_persona_id(), "documentos", "contrato"), $this->config->item("personas_path")); //generamos los paths correspodientes
//        $pdf_path = $this->config->item("personas_path") . "/" . get_persona_id() . "/documentos/contrato/";
//        $mpdf->Output($pdf_path . 'contrato');
//    }
    private function _create_pdf($persona_id, $razon_social, $tipo, $rfc) {
        $contrato_html = $this->load->view('contrato/pdf', array('razon_social' => $razon_social, 'tipo' => $tipo, 'rfc' => $rfc), TRUE);
        require_once __DIR__ . '../../../../../vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($contrato_html);
        $this->load->helper(array('files_helper', 'path_helper'));
        path_create(array($persona_id, "documentos", "contrato"), $this->config->item("personas_path")); //generamos los paths correspodientes
        $pdf_path = $this->config->item("personas_path") . "/" . $persona_id . "/documentos/contrato/";
        $mpdf->Output($pdf_path . 'contrato.pdf');
    }

    private function _create_payment_pdf($persona_id, $paquete, $usuario, $barcode) {
        $payment = $this->load->view('pago/efectivo_pdf', array('paquete' => $paquete, 'usuario' => $usuario, 'persona_id' => $persona_id, 'barcode' => $barcode), TRUE);
        require_once __DIR__ . '../../../../../vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($payment);
        $this->load->helper(array('files_helper', 'path_helper'));
        path_create(array($persona_id, "documentos", "payment"), $this->config->item("personas_path")); //generamos los paths correspodientes
        $pdf_path = $this->config->item("personas_path") . "/" . $persona_id . "/documentos/payment/";
        $mpdf->Output($pdf_path . 'pago_efectivo.pdf');
    }

    private function _validation_insert() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('rfc', 'RFC', 'trim|rfc|required|is_unique[personas.rfc]', array('is_unique' => 'El RFC que intentas registrar ya existe.'));
        $this->form_validation->set_rules('razon_social', 'razón social ', 'trim|required');
        $this->form_validation->set_rules('tipo', 'forma juridica', 'trim|integer|required');
        $this->form_validation->set_rules('curp', 'CURP', 'trim|curp|required');
        $this->form_validation->set_rules('actividad', 'actividad', 'trim|required');
        $this->form_validation->set_rules('cantidad_trabajadores', 'cantidad trabajadores', 'trim|integer|required');
        $this->form_validation->set_rules('contabilidad_atrasada', 'contabilidad atrasada', 'trim|integer|required');
        $this->form_validation->set_rules('colonia_id', 'colonia', 'trim|integer|required');
        $this->form_validation->set_rules('nombre', 'nombre domicilio fiscal', 'trim|required');
        $this->form_validation->set_rules('calle', 'calle', 'trim|required');
        $this->form_validation->set_rules('numero_interior', 'numero interior', 'trim|required');
        $this->form_validation->set_rules('numero_exterior', 'numero exterior', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    private function _validation_tarjeta() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nombre_titular', 'Nombre del titular', 'trim|required');
        $this->form_validation->set_rules('numero_tarjeta', 'N&uacute;mero de tarjeta', 'integer|trim|required');
        $this->form_validation->set_rules('mes_expiracion', 'M&eacute;s de expiracion', 'integer|trim|required');
        $this->form_validation->set_rules('anio_expiracion', 'A&ntilde;o de expiracion', 'integer|trim|required');
        $this->form_validation->set_rules('codigo', 'CVV', 'integer|trim|required');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    private function _validation_paquete_regimenes() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('regimenes[]', 'Regimenes', 'required');
        $this->form_validation->set_rules('paquete_id', 'Plan', 'trim|integer|required');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    private function _validation_efirma() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('efirma', 'E firma', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    private function _validation_update() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('rfc', 'RFC', 'trim|required|rfc|callback_is_unique_update');
        $this->form_validation->set_rules('razon_social', 'razón social ', 'trim|required');
        $this->form_validation->set_rules('tipo', 'forma juridica', 'trim|integer|required');
        $this->form_validation->set_rules('curp', 'CURP', 'trim|required|curp');
        $this->form_validation->set_rules('actividad', 'actividad', 'trim|required');
        $this->form_validation->set_rules('cantidad_trabajadores', 'cantidad trabajadores', 'trim|integer|required');
        $this->form_validation->set_rules('contabilidad_atrasada', 'contabilidad atrasada', 'trim|integer|required');
        $this->form_validation->set_rules('colonia_id', 'colonia', 'trim|integer|required');
        $this->form_validation->set_rules('nombre', 'nombre domicilio fiscal', 'trim|required');
        $this->form_validation->set_rules('calle', 'calle', 'trim|required');
        $this->form_validation->set_rules('numero_interior', 'numero interior', 'trim|required');
        $this->form_validation->set_rules('numero_exterior', 'numero exterior', 'trim|required');
        if (!$this->form_validation->run()) {
            $this->response(['message' => validation_errors()], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function is_unique_update() {
        $persona_id = get_persona_id();
        $rfc = $this->post('rfc');
        $existe_rfc_con_persona_id = $this->personas_model->get_rfc_and_id($persona_id, $rfc);
        $existe_rfc = $this->personas_model->get_rfc($rfc);
        if ($existe_rfc_con_persona_id) {
            return TRUE;
        } else if (!$existe_rfc) {
            return TRUE;
        } else {
            $this->form_validation->set_message('is_unique_update', 'El RFC ya existe.');
            return FALSE;
        }
    }

}
