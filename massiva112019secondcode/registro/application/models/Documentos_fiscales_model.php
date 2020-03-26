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

    public function get_files_by_persona_id($persona_id) {
        $this->db->select('id, nombre, tipo, extension');
        $this->db->from('documentos_fiscales');
        $this->db->where('persona_id', $persona_id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_documento_by_persona_id_and_tipo($persona_id, $tipo) {
        $this->db->select('id');
        $this->db->from('documentos_fiscales');
        $this->db->where('tipo', $tipo);
        $this->db->where('persona_id', $persona_id);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
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

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('documentos_fiscales', $data)) ? $this->db->insert_id() : NULL;
    }

    public function update($id, $data) {
        return $this->db->update('documentos_fiscales', $data, ['id' => $id]);
    }

}
