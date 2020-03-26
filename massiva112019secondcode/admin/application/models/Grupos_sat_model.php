<?php

/**
 * Description of Grupos_sat_model
 */
class Grupos_sat_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
      Metodo que trae todos los registros activos de la tabla preguntas_frecuentes
     */

    public function get_all() {
        $this->db->select('id, pregunta, respuesta');
        $this->db->from('preguntas_frecuentes');
        $this->db->where('status', 1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae un registro activo en base a el campo id
     */

    public function get_by_id($id, $division_id) {

        $this->db->select('grupos_sat.id, grupos_sat.clave,grupos_sat.descripcion');
        $this->db->from('grupos_sat');
        $this->db->join('divisiones_sat', 'divisiones_sat.id = grupos_sat.division_sat_id');
        $this->db->where('divisiones_sat.id', $division_id);
        $this->db->where('divisiones_sat.status', 1);
        $this->db->where('grupos_sat.id', $id);
        $this->db->where('grupos_sat.status', 1);
        $this->db->order_by('id', 'asc');
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo que trae todos los registros activos en base a el campo division_sat_id
     */

    public function get_all_by_categoria_id($division_id) {
        $this->db->select('id, division_sat_id, clave, descripcion');
        $this->db->from('grupos_sat');
        $this->db->where('division_sat_id', $division_id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_all_by_categoria_id_json($categoria_id) {
        $this->db->select('id, categoria_id, pregunta, respuesta');
        $this->db->from('preguntas_frecuentes');
        $this->db->where('categoria_id', $categoria_id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae la cantidad de todos los registros activos de la tabla Grupos_sat
     */

    public function count_all_activos($division_id) {
        $this->db->from('grupos_sat');
        $this->db->where('division_sat_id', $division_id);
        $this->db->where('status', 1);
        return $this->db->count_all_results();
    }

    /*
      Metodo que trae la cantidad de todos los registros activos de la tabla preguntas_frecuentes
     */

    public function count_all_inactivos($division_id) {
        $this->db->from('grupos_sat');
        $this->db->where('division_sat_id', $division_id);
        $this->db->where('status', -1);
        return $this->db->count_all_results();
    }

    /*
      Metodo que trae todos los registros inactivos
     */

    public function get_all_inactive() {
        $this->db->select('id, clave, descripcion');
        $this->db->from('grupos_sat');
        $this->db->where('status', -1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_all_inactive_by_division_id($division_id) {
        $this->db->select('grupos_sat.id, grupos_sat.clave,grupos_sat.descripcion');
        $this->db->from('grupos_sat');
        $this->db->join('divisiones_sat', 'divisiones_sat.id = grupos_sat.division_sat_id');
        $this->db->where('grupos_sat.division_sat_id ', $division_id);
        $this->db->where('grupos_sat.status', -1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('grupos_sat', $data)) ? $this->db->insert_id() : NULL;
    }

    /*
      Metodo para modificar un registro
     */

    public function update($id, $data) {
        return $this->db->update('grupos_sat', $data, ['id' => $id]);
    }

}
