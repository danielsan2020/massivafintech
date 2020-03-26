<?php

/**
 * Description of Soporte_categorias_model
 *
 * @author dell
 */
class Soporte_categorias_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
      Metodo que trae todos los registros activos de la tabla soporte_categorias
     */

    public function get_all_by_tipo($tipo) {
        $this->db->select('id, categoria, clave, tipo');
        $this->db->from('soporte_categorias');
        $this->db->where('status', 1);
        $this->db->where('tipo', $tipo);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_clave_by_id($id) {
        $this->db->select('clave');
        $this->db->from('soporte_categorias');
        $this->db->where('soporte_categorias.id', $id);
        $this->db->limit(1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->row_array();
    }

}
