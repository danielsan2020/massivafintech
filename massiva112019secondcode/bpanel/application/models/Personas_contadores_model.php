<?php

class Personas_contadores_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_by_id($id) {
        $this->db->select('id, contador_id, persona_id');
        $this->db->from('personas_contadores');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->row_array();
    }
    
    public function get_by_contador_id_and_persona_id($contador_id, $persona_id){
        $this->db->select('id');
        $this->db->from('personas_contadores');
        $this->db->where('contador_id', $contador_id);
        $this->db->where('persona_id', $persona_id);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }
    
    public function get_persona_by_id($id) {
        $this->db->select('personas.rfc, personas.razon_social, personas_contadores.id, personas.id, personas_contadores.contador_id');
        $this->db->from('personas_contadores');
        $this->db->join('personas', 'personas.id = personas_contadores.persona_id');
        $this->db->where('personas_contadores.id', $id);
        $this->db->where('personas_contadores.status', 1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_all_declaraciones_by_contador_id($contador_id) {
        $this->db->select('personas.rfc, personas.id AS persona_id, declaraciones_mensuales.mes_correspondiente, declaraciones_mensuales.anio_correspondiente, declaraciones_mensuales.status, declaraciones_mensuales.id');
        $this->db->from('personas_contadores');
        $this->db->join('personas', 'personas.id = personas_contadores.persona_id');
        $this->db->join('declaraciones_mensuales', 'personas.id = declaraciones_mensuales.persona_id');
        $this->db->where('personas_contadores.contador_id', $contador_id);
        $result = $this->db->get();
        return $result->result_array();
    }
    public function get_all_declaraciones_declaraciones_contador_id($contador_id) {
        $this->db->select('personas.rfc, personas.id AS persona_id, declaraciones_mensuales_atrasadas.mes_correspondiente, declaraciones_mensuales_atrasadas.anio_correspondiente, declaraciones_mensuales_atrasadas.status, declaraciones_mensuales_atrasadas.id');
        $this->db->from('personas_contadores');
        $this->db->join('personas', 'personas.id = personas_contadores.persona_id');
        $this->db->join('declaraciones_mensuales_atrasadas', 'personas.id = declaraciones_mensuales_atrasadas.persona_id');
        $this->db->where('personas_contadores.contador_id', $contador_id);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function insert($data) {
        return ($this->db->insert('personas_contadores', $data)) ? $this->db->insert_id() : NULL;
    }

    public function update($id, $data) {
        return $this->db->update('personas_contadores', $data, ['id' => $id]);
    }

}
