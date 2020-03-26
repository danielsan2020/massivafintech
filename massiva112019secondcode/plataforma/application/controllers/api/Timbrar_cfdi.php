<?php

/**
 * Description of Timbrar_cfdi
 *
 * @author dell
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class Timbrar_cfdi extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('facturas_model');
        date_default_timezone_set('America/Mexico_City');
    }

    public function timbrar_get() {
        $this->_validation_id();
        $factura_id = $this->get('id');
        $factura = $this->facturas_model->get_by_id_for_timbrar($factura_id);
        if ($factura !== NULL) {
            $formato_factura_completo = $this->_fill_formato_for_xml($factura);
            $xml = $this->load->view('formato_xml_view', $formato_factura_completo, TRUE);
            echo '<pre>';
            var_dump($xml);
            echo '</pre>';
        } else {
            $this->response(['message' => "Error al obtener los datos de la factura"], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function _fill_formato_for_xml($data) {
        $this->load->model(array('personas_model', 'personas_clientes_model', 'facturas_productos_model'));
        $formato_factura_completo = array();
        //datos del nodo comprobante
        $formato_factura_completo['comprobante'] = $this->_get_datos_comprobante($data);
        //datos del nodo emisor
        $formato_factura_completo['emisor'] = $this->_get_datos_emisor($data['persona_id']);
        //datos del nodo receptor
        $formato_factura_completo['receptor'] = $this->_get_datos_receptor($data['persona_cliente_id']);
        $formato_factura_completo['receptor']['uso_factura'] = $data['uso_factura'];
        //datos del nodo conceptos
        $formato_factura_completo['conceptos'] = $this->_get_productos($data['id'], $formato_factura_completo['comprobante']);
        return $formato_factura_completo;
    }

    private function _get_datos_comprobante($factura) {
        $created_at = new DateTime($factura['created_at']);
        $comprobante['fecha_emision'] = $created_at->format('Y-m-d\TH:i:s');
        $comprobante['tipo_factura'] = $factura['tipo_factura'];
        $comprobante['uso_factura'] = $factura['uso_factura'];
        $comprobante['forma_pago'] = $factura['forma_pago'];
        $comprobante['metodo_pago'] = $factura['metodo_pago'];
        $comprobante['moneda'] = $factura['moneda'];
        $comprobante['tipo_cambio'] = ($factura['tipo_cambio'] !== NULL) ? $factura['tipo_cambio'] : "";
        $comprobante['serie'] = ($factura['serie'] !== NULL) ? $factura['serie'] : "";
        $comprobante['sello'] = "sello";
        $cp = $this->personas_model->get_cp_persona_by_id_for_xml($factura['persona_id']);
        if ($cp !== FALSE) {
            $comprobante['codigo_postal_expedicion'] = $cp;
        } else {
            $this->response(['message' => "Error al obtener el codigo postal del emisor"], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $comprobante;
    }

    private function _get_datos_emisor($persona_id) {
        $emisor = $this->personas_model->get_persona_by_id_for_xml($persona_id);
        if ($emisor !== NULL) {
            return $emisor;
        } else {
            $this->response(['message' => "Error al obtener los datos del emisor"], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function _get_datos_receptor($persona_cliente_id) {
        $receptor = $this->personas_clientes_model->get_persona_cliente_by_id_for_xml($persona_cliente_id);
        if ($receptor !== NULL) {
            return $receptor;
        } else {
            $this->response(['message' => "Error al obtener los datos del receptor"], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function _get_productos($factura_id, &$comprobante) {
        $productos = $this->facturas_productos_model->get_productos_by_factura_id($factura_id);
        if (count($productos) > 0) {
            $comprobante['subtotal'] = 0;
            $comprobante['total'] = 0;
            $conceptos['total_iva_trasladados'] = 0;
            $conceptos['total_iva_retenidos'] = 0;
            $conceptos['total_isr_retenidos'] = 0;
            foreach ($productos as &$producto) {
                $producto['importe'] = ($producto['precio'] * $producto['cantidad']);
                $producto['iva_trasladado'] = ($producto['importe'] * $producto['iva']);
                $producto['iva_retenido_calculado'] = ($producto['iva_retenido'] * $producto['importe']);
                $producto['isr_retenido_calculado'] = ($producto['isr_retenido'] * $producto['importe']);
                $conceptos['total_iva_trasladados'] += $producto['iva_trasladado'];
                $conceptos['total_iva_retenidos'] += $producto['iva_retenido_calculado'];
                $conceptos['total_isr_retenidos'] += $producto['isr_retenido_calculado'];
                $comprobante['subtotal'] += $producto['importe'];
                $comprobante['total'] += ($producto['importe'] + $producto['iva_trasladado']) - ($producto['iva_retenido_calculado'] + $producto['isr_retenido_calculado']);
                unset($producto);
            }
            $conceptos['productos'] = $productos;
            return $conceptos;
        } else {
            $this->response(['message' => "Error al obtener los productos de la factura"], REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Reglas que tiene que pasar el metodo para poder recibir los datos
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

}
