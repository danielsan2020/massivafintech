<?php

/**
 * Description of Soporte_tickets_model
 */
class Soporte_tickets_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
      Metodo que trae un registro activo en base a el campo id
     */

    public function get_by_id($id) {
        $this->db->select('id, numero_ticket,descripcion,status');
        $this->db->from('soporte_tickets');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo que trae todos los registros activos en base a el campo persona_id
     */

    public function get_all_by_persona_id_by_status($persona_id, $status) {
        $this->db->select('soporte_tickets.id,soporte_categorias.categoria, numero_ticket,soporte_tickets.status,descripcion');
        $this->db->from('soporte_tickets');
        $this->db->join('soporte_categorias', 'soporte_categorias.id=soporte_tickets.soporte_categoria_id');
        $this->db->where('persona_id', $persona_id);
        $this->db->where_in('soporte_tickets.status', $status);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_last_numero_ticket_by_soporte_categoria_id($soporte_categoria_id) {
        $this->db->select('numero_ticket');
        $this->db->from('soporte_tickets');
        $this->db->where("soporte_categoria_id", $soporte_categoria_id);
        $this->db->where("status", 1);
        $this->db->limit(1);
        $this->db->order_by('id', 'desc');
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('soporte_tickets', $data)) ? $this->db->insert_id() : NULL;
    }

}

