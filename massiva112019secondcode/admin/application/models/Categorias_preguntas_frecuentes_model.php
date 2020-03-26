<?php

/**
 * Description of Categorias_preguntas_frecuentes_model
 */
class Categorias_preguntas_frecuentes_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
      Metodo que trae todos los registros activos de la tabla categorias_preguntas_frecuentes
     */

    public function get_all() {
        $this->db->select('id, categoria');
        $this->db->from('categorias_preguntas_frecuentes');
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }
    
    public function get_all_generate_json (){
         $this->db->select('id, categoria');
        $this->db->from('categorias_preguntas_frecuentes');
        $this->db->where('status', 1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_by_id($id) {
        $this->db->select('id, categoria');
        $this->db->from('categorias_preguntas_frecuentes');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->order_by('id', 'asc');
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo que trae todos los registros inactivos
     */

    public function get_all_inactive() {
        $this->db->select('id, categoria');
        $this->db->from('categorias_preguntas_frecuentes');
        $this->db->where('status', -1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae la cantidad de todos los registros activos de la tabla categorias
     */

    public function count_all_activos() {
        $this->db->from('categorias_preguntas_frecuentes');
        $this->db->where('status', 1);
        return $this->db->count_all_results();
    }

    /*
      Metodo que trae la cantidad de todos los registros activos de la tabla categorias
     */

    public function count_all_inactivos() {
        $this->db->from('categorias_preguntas_frecuentes');
        $this->db->where('status', -1);
        return $this->db->count_all_results();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('categorias_preguntas_frecuentes', $data)) ? $this->db->insert_id() : NULL;
    }

    /*
      Metodo para modificar un registro
     */

    public function update($id, $data) {
        return $this->db->update('categorias_preguntas_frecuentes', $data, ['id' => $id]);
    }

}
