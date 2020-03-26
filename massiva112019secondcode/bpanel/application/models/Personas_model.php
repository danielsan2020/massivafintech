<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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

    public function get_all_personas_by_contador_id($contador_id) {
        $this->db->select('personas.id, personas.rfc, personas.razon_social, personas.efirma');
        $this->db->from('personas');
        $this->db->join('personas_contadores', 'personas.id = personas_contadores.persona_id');
        $this->db->where('personas_contadores.status', 1);
        $this->db->where('personas_contadores.contador_id', $contador_id);
        $result = $this->db->get();
        return $result->result_array();
    }
}
