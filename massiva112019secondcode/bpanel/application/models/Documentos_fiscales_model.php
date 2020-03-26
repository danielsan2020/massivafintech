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

    public function get_file_name_extension_by_id_and_persona_id($id, $persona_id) {
        $this->db->select('nombre,extension');
        $this->db->from('documentos_fiscales');
        $this->db->where('persona_id', $persona_id);
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function check_files_exist_documentos_fiscales_by_persona_id($persona_id) {
        $this->db->select("COUNT(id) as total_registros");
        $this->db->from('documentos_fiscales');
        $this->db->where('persona_id', $persona_id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        $resultado = $result->row_array();
        return ($resultado['total_registros'] > 0) ? 1 : -1;
    }
    
    public function get_files_by_persona_id($persona_id) {
        $this->db->select('id, nombre, tipo');
        $this->db->from('documentos_fiscales');
        $this->db->where('persona_id', $persona_id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

}
