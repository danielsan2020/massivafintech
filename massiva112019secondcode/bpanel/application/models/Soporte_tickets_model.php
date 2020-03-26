<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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

    public function get_tickets_by_contador_id() {
        $this->db->select('soporte_tickets.status, soporte_tickets.soporte_categoria_id, soporte_categorias.categoria, personas.rfc, soporte_tickets.numero_ticket, soporte_tickets.id, soporte_tickets.descripcion, personas_contadores.contador_id, personas.id AS persona_id');
        $this->db->from('soporte_tickets');
        $this->db->join('personas_contadores', 'personas_contadores.persona_id = soporte_tickets.persona_id');
        $this->db->join('personas', 'personas.id = personas_contadores.persona_id');
        $this->db->join('soporte_categorias', 'soporte_categorias.id = soporte_tickets.soporte_categoria_id');
        $this->db->where('personas_contadores.contador_id', $contador_id);
        $this->db->where('personas_contadores.status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_ticket_by_id($ticket_id) {
        $this->db->select('soporte_tickets.id, soporte_tickets.numero_ticket, soporte_comentarios.comentario');
        $this->db->from('soporte_tickets');
        $this->db->join('soporte_comentarios', 'soporte_comentarios.soporte_ticket_id = soporte_tickets.id');
        $this->db->where('soporte_tickets.id', $ticket_id);
        $this->db->where('soporte_tickets.status', 1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo que trae la cantidad de todos los registros inactivos de la tabla paquetes
     */

    public function count_all_tickets_by_contador_id($contador_id) {
        $this->db->from('soporte_tickets');
        $this->db->join('personas_contadores', 'personas_contadores.persona_id = soporte_tickets.persona_id');
        $this->db->join('personas', 'personas.id = personas_contadores.persona_id');
        $this->db->join('soporte_categorias', 'soporte_categorias.id = soporte_tickets.soporte_categoria_id');
        $this->db->where('personas_contadores.contador_id', $contador_id);
        $this->db->where('personas_contadores.status', 1);
        return $this->db->count_all_results();
    }

}
