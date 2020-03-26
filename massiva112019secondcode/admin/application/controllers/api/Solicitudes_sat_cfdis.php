<?php

/**
 * Description of SolicitudesSatCfdis
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
class Solicitudes_sat_cfdis extends REST_Controller {
    /*
      Método constructor de la clase
     */

    function __construct() {
        parent::__construct();
        $this->load->model('solicitudes_sat_cfdis_model');
        date_default_timezone_set('America/Mexico_City');
    }

    public function get_all_solicitudes_sat_cfdis_by_perona_id_get() {
        $persona_id = $this->get('persona_id');
        $data['solicitudes'] = $this->solicitudes_sat_cfdis_model->get_all_by_persona_id($persona_id);
        $this->response($data, REST_Controller::HTTP_OK);
    }

    public function descargar_cfdis_get() {
        $this->load->model('cfdis_model');
        $solicitud_id = $this->get('solicitud_id');
        $solicitud = $this->solicitudes_sat_cfdis_model->get_by_id($solicitud_id);

        require_once(APPPATH . 'libraries/SAT_XML.php');

        $persona_id = $solicitud['persona_id'];
        $files_path = $this->config->item("personas_path") . "/" . $persona_id . "/documentos/cfdis/";
        if (file_exists($files_path . $solicitud['solicitud_sat_id'] . '.zip')) {
            $zip = new ZipArchive;
            $res = $zip->open($files_path . $solicitud['solicitud_sat_id'] . '.zip');
            if ($res === TRUE) {
                $zip->extractTo($files_path);
                $zip->close();
                $xmls = scandir($files_path);
                for ($i = 0; $i < count($xmls); $i++) {
                    $xml_file_name = $xmls[$i];
                    if (strpos($xml_file_name, 'xml') !== FALSE) {
                        $xml_file_name_no_ext = substr($xml_file_name, 0, (strrpos($xml_file_name, ".")));
                        if ($this->cfdis_model->get_by_name_and_persona_id($xml_file_name_no_ext, $persona_id) == NULL) {
                            $this->_leer_cfdi_and_insert($files_path, $xml_file_name_no_ext, $persona_id);
                        }
                    }
                }
                $this->response(['message' => 'cfdis descargados'], REST_Controller::HTTP_CREATED);
            } else {
                $this->response(['message' => 'Error al descomprimir'], REST_Controller::HTTP_FAILED_DEPENDENCY);
            }
        } else {
            $this->response(['message' => 'No zip'], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function solicitar_cfdis_post() {
        $persona_id = $this->get('persona_id');
        $files_path = $this->config->item("personas_path") . "/" . $persona_id . "/documentos/fiscales/";

        $this->load->model(array('documentos_fiscales_model', 'personas_model'));
        $key_file_name = $this->documentos_fiscales_model->get_documento_by_persona_id_and_tipo($persona_id, 1);
        $key = file_get_contents($files_path . $key_file_name . '.pem');
        $cer_file_name = $this->documentos_fiscales_model->get_documento_by_persona_id_and_tipo($persona_id, 2);
        $cert = file_get_contents($files_path . $cer_file_name . '.cer');

        require_once(APPPATH . 'libraries/SAT_XML.php');
        $loginSAT = new LoginXmlRequest();
        $ResponseAuth = $loginSAT->soapRequest($cert, $key);
        $rfc = $this->personas_model->get_rfc_by_id($persona_id);
        //fecha de inicio
        $cur_time_1 = gmdate("Y-m-d H:i:s");
        $duration_1 = '-10 minutes';
        $fechaInicial = date('Y-m-d\TH:i:s', strtotime($duration_1, strtotime($cur_time_1)));
        //fecha de termino
        $cur_time_2 = gmdate("Y-m-d H:i:s");
        $duration_2 = '+10 minutes';
        $fechaFinal = date('Y-m-d\TH:i:s', strtotime($duration_2, strtotime($cur_time_2)));
        $TipoSolicitud = 'CFDI';
        $solicita = new RequestXmlRequest();
        $ResponseRequest = $solicita->soapRequest($cert, $key, $ResponseAuth->token, $rfc, $fechaInicial, $fechaFinal, $TipoSolicitud);
        $id_solicitud = $ResponseRequest->IdSolicitud;
        $insert_data = array(
            'persona_id' => $persona_id,
            'solicitud_sat_id' => $id_solicitud,
            'status' => 1,
            'created_at' => date('Y-m-d H:m:s')
        );
        $solicitud_id = $this->solicitudes_sat_cfdis_model->insert($insert_data);
        if ($solicitud_id != NULL) {
            $this->response(['message' => 'Socicitud realizada'], REST_Controller::HTTP_CREATED);
        }
    }

    private function _leer_cfdi_and_insert($files_path, $xml_file_name_no_ext, $persona_id) {
        $xml_content = file_get_contents($files_path . $xml_file_name_no_ext . '.xml');
        $xml = simplexml_load_string($xml_content);
        $ns = $xml->getNamespaces(true);
        $xml->registerXPathNamespace('c', $ns['cfdi']);
        $insert_data = array(
            'persona_id' => $persona_id,
            'name' => $xml_file_name_no_ext,
            'status' => 1,
            'created_at' => date('Y-m-d H:m:s')
        );
        foreach ($xml->xpath('//cfdi:Comprobante') as $cfdiComprobante) {
            $insert_data['fecha_emision'] = $cfdiComprobante['Fecha'];
            $insert_data['total'] = $cfdiComprobante['Total'];
            $insert_data['subtotal'] = $cfdiComprobante['SubTotal'];
        }
        foreach ($xml->xpath('//cfdi:Comprobante//cfdi:Receptor') as $Receptor) {
            $insert_data['receptor_rfc'] = $Receptor['Rfc'];
            $insert_data['receptor_razon_social'] = ($Receptor['Nombre'] !== NULL) ? $Receptor['Nombre'] : 'Sin asignar';
        }
        $this->cfdis_model->insert($insert_data);
    }

}
