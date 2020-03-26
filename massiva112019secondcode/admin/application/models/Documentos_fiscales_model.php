<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Documentos_fiscales_model
 *
 * @author dell
 */
class Documentos_fiscales_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_documento_by_persona_id_and_tipo($persona_id, $tipo) {
        $this->db->select('id');
        $this->db->from('documentos_fiscales');
        $this->db->where('tipo', $tipo);
        $this->db->where('persona_id', $persona_id);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        $row = $result->row_array();
        return $row['id'];
    }

}
