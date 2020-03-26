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

    public function get_all_personas_sin_contador($jefe_id) {
        $this->db->select('personas.rfc, personas.id, personas.razon_social, personas_contadores.jefe_id, personas_contadores.id AS personas_contadores_id');
        $this->db->from('personas');
        $this->db->join('personas_contadores', 'personas.id = personas_contadores.persona_id');
//        $this->db->join('datos_fiscales', 'personas.id = datos_fiscales.persona_id');
        $this->db->where('personas.status', 1);
        $this->db->where('personas_contadores.status', 1);
        $this->db->where('personas_contadores.jefe_id', $jefe_id);
        $this->db->where('personas_contadores.contador_id', $jefe_id);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_all_personas_con_contador($jefe_id) {
        $this->db->select('personas.rfc, personas.razon_social, personas_contadores.jefe_id, personas_contadores.id AS personas_contadores_id, personas_contadores.contador_id, CONCAT_WS(" ",usuarios.nombre, usuarios.apellido_paterno, usuarios.apellido_materno) AS nombre');
        $this->db->from('personas');
        $this->db->join('personas_contadores', 'personas.id = personas_contadores.persona_id');
//        $this->db->join('datos_fiscales', 'personas.id = datos_fiscales.persona_id');
        $this->db->join('usuarios', 'personas_contadores.contador_id = usuarios.id');
        $this->db->where('personas.status', 1);
        $this->db->where('personas_contadores.status', 1);
        $this->db->where('personas_contadores.jefe_id', $jefe_id);
        $this->db->where('personas_contadores.jefe_id <> personas_contadores.contador_id');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_by_id($id) {
        $this->db->select('id, rfc, razon_social');
        $this->db->from('personas');
//        $this->db->join('datos_fiscales', 'personas.id = datos_fiscales.persona_id');
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

}
