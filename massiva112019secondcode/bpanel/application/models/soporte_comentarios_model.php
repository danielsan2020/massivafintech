<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Soporte_comentarios_model
 */
class Soporte_comentarios_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_list_comentarios_by_soporte_ticket_id($soporte_ticket_id) {
        $this->db->select('soporte_comentarios.id, soporte_comentarios.comentario, soporte_comentarios.tipo, soporte_comentarios.status');
        $this->db->from('soporte_comentarios');
        $this->db->join('soporte_tickets', 'soporte_comentarios.soporte_ticket_id = soporte_tickets.id');
        $this->db->where('soporte_comentarios.soporte_ticket_id', $soporte_ticket_id);
        $this->db->where('soporte_comentarios.status', 1);
        $this->db->order_by('id', 'desc');
        $this->db->limit(3);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_next_by_soporte_ticket_id($soporte_ticket_id, $registro_id) {
        $this->db->select('id,tipo,comentario');
        $this->db->from('soporte_comentarios');
        $this->db->where('id <', $registro_id);
        $this->db->where('soporte_ticket_id', $soporte_ticket_id);
        $this->db->where('status', 1);
        $this->db->limit(5);
        $this->db->order_by('id', 'desc');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_last_by_soporte_ticket_id($soporte_ticket_id, $registro_id) {
        $this->db->select('id,tipo,comentario');
        $this->db->from('soporte_comentarios');
        $this->db->where('id >', $registro_id);
        $this->db->where('soporte_ticket_id', $soporte_ticket_id);
        $this->db->where('status', 1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_file_name_extension_by_id_and_soporte_ticket_id($id, $soporte_ticket_id) {
        $this->db->select('comentario');
        $this->db->from('soporte_comentarios');
        $this->db->where('soporte_ticket_id', $soporte_ticket_id);
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function insert($data) {
        return ($this->db->insert('soporte_comentarios', $data)) ? $this->db->insert_id() : NULL;
    }

}
