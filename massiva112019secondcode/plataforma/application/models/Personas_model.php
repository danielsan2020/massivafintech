<?php

/**
 * Description of Paquetes_model
 */
class Personas_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_persona_by_id_for_xml($persona_id) {
        $this->db->select('personas.rfc,personas.razon_social,regimenes_fiscales.clave as clave_regimen_fiscal');
        $this->db->from('personas');
        $this->db->join('personas_regimenes', 'personas.id=personas_regimenes.persona_id', 'INNER');
        $this->db->join('regimenes_fiscales', 'regimenes_fiscales.id=personas_regimenes.regimen_fiscal_id', 'INNER');
        $this->db->where('personas.id', $persona_id);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_cp_persona_by_id_for_xml($persona_id) {
        $this->db->select('colonias.cp as codigo_postal_expedicion');
        $this->db->from('personas');
        $this->db->join('domicilios_fiscales', 'personas.id=domicilios_fiscales.persona_id', 'INNER');
        $this->db->join('colonias', 'colonias.id=domicilios_fiscales.colonia_id', 'INNER');
        $this->db->where('personas.id', $persona_id);
        $this->db->where('personas.status', 1);
        $this->db->where('domicilios_fiscales.status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        $cp = $result->row_array();
        return ($cp['codigo_postal_expedicion'] !== NULL) ? $cp['codigo_postal_expedicion'] : FALSE;
    }

}
