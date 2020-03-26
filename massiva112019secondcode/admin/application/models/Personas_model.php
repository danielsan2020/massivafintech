<?php

/**
 * Description of Personas_model
 */
class Personas_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_personas() {
        $this->db->select('id, rfc, razon_social, created_at AS fecha_registro');
        $this->db->from('personas');
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }
    
    public function get_rfc_by_id($id) {
        $this->db->select('rfc');
        $this->db->from('personas');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        $row = $result->row_array();
        return $row['rfc'];
    }
    
    public function get_all_personas_sin_contador() {
        $this->db->select('personas.rfc, personas.id, personas.razon_social, personas.created_at AS fecha_registro');
        $this->db->from('personas_contadores');
        $this->db->join('personas', 'personas_contadores.persona_id = personas.id', 'right');
        $this->db->where('personas.status', 1);
        $this->db->where('personas_contadores.persona_id', NULL);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_all_personas_con_contador() {
        $this->db->select("personas.rfc, personas.id, personas.razon_social, usuarios.nombre, usuarios.apellido_paterno, usuarios.apellido_materno,"
                . "        personas_contadores.id AS persona_contador_id, personas.created_at AS fecha_registro");
        $this->db->from('personas');
        $this->db->join('personas_contadores', 'personas.id = personas_contadores.persona_id');
        $this->db->join('usuarios', 'personas_contadores.contador_id = usuarios.id');
        $this->db->where('personas.status', 1);
        $this->db->where('personas_contadores.status', 1);
        $this->db->where('usuarios.status', 1);
        $this->db->where('personas_contadores.status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_by_id($id) {
        $this->db->select('id, rfc, razon_social');
        $this->db->from('personas');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_cantidad_de_personas_by_contador($id) {
        $this->db->select('count(personas.id) as numero_personas');
        $this->db->from('personas');
        $this->db->join('personas_contadores', 'personas.id = personas_contadores.persona_id');
        $this->db->where('personas.status', 1);
        $this->db->where('personas_contadores.status', 1);
        $this->db->where('personas_contadores.contador_id', $id);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function count_all_personas_sin_contador() {
        $this->db->from('personas_contadores');
        $this->db->join('personas', 'personas_contadores.persona_id = personas.id', 'right');
        $this->db->where('personas.status', 1);
        $this->db->where('personas_contadores.persona_id', NULL);
        return $this->db->count_all_results();
    }

}
