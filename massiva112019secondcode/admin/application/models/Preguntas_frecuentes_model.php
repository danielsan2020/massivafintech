<?php

/**
 * Description of Preguntas_frecuentes_model
 */
class Preguntas_frecuentes_model extends CI_Model {
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

    public function get_by_id($id, $categoria_id) {

        $this->db->select('preguntas_frecuentes.id,preguntas_frecuentes.pregunta,preguntas_frecuentes.respuesta');
        $this->db->from('categorias_preguntas_frecuentes');
        $this->db->join('preguntas_frecuentes', 'categorias_preguntas_frecuentes.id = preguntas_frecuentes.categoria_id', 'INNER');
        $this->db->where('categorias_preguntas_frecuentes.id', $categoria_id);
        $this->db->where('categorias_preguntas_frecuentes.status', 1);
        $this->db->where('preguntas_frecuentes.id', $id);
        $this->db->where('preguntas_frecuentes.status', 1);
        $this->db->order_by('id', 'asc');
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo que trae todos los registros activos en base a el campo categoria_id
     */

    public function get_all_by_categoria_id($categoria_id) {
        $this->db->select('id, categoria_id, pregunta, respuesta');
        $this->db->from('preguntas_frecuentes');
        $this->db->where('categoria_id', $categoria_id);
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
      Metodo que trae la cantidad de todos los registros activos de la tabla preguntas_frecuentes
     */

    public function count_all_activos($categoria_id) {
        $this->db->from('preguntas_frecuentes');
        $this->db->where('categoria_id', $categoria_id);
        $this->db->where('status', 1);
        return $this->db->count_all_results();
    }

    /*
      Metodo que trae todos los registros inactivos
     */

    public function get_all_inactive() {
        $this->db->select('id, pregunta, respuesta');
        $this->db->from('preguntas_frecuentes');
        $this->db->where('status', -1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_all_inactive_by_categoria_id($categoria_id) {
        $this->db->select('preguntas_frecuentes.id, preguntas_frecuentes.pregunta, preguntas_frecuentes.respuesta');
        $this->db->from('preguntas_frecuentes');
        $this->db->join('categorias_preguntas_frecuentes', 'categorias_preguntas_frecuentes.id = preguntas_frecuentes.categoria_id');
        $this->db->where('preguntas_frecuentes.categoria_id ', $categoria_id);
        $this->db->where('preguntas_frecuentes.status', -1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae la cantidad de todos los registros activos de la tabla preguntas_frecuentes
     */

    public function count_all_inactivos($categoria_id) {
        $this->db->from('preguntas_frecuentes');
        $this->db->where('categoria_id', $categoria_id);
        $this->db->where('status', -1);
        return $this->db->count_all_results();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('preguntas_frecuentes', $data)) ? $this->db->insert_id() : NULL;
    }

    /*
      Metodo para modificar un registro
     */

    public function update($id, $data) {
        return $this->db->update('preguntas_frecuentes', $data, ['id' => $id]);
    }

}
