<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuarios_personas_model
 *
 * @author dell
 */
class Usuarios_personas_model extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_persona_id_by_usuario_id($usuario_id) {
        $this->db->select('usuarios_personas.persona_id, personas.contabilidad_atrasada, personas.tiene_efirma_vigente');
        $this->db->from('usuarios_personas');
        $this->db->join('personas', 'usuarios_personas.persona_id = personas.id');
        $this->db->where('usuarios_personas.usuario_id', $usuario_id);
        $this->db->where('usuarios_personas.status', 1);
        $this->db->limit(1);
        $this->db->order_by('usuarios_personas.id', 'asc');
        $result = $this->db->get();
        return $result->row_array();
    }

}
