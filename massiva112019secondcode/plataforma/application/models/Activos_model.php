<?php

/**
 * Description of Activos_model
 */
class Activos_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
      Metodo que trae todos los registros activos de la tabla activos
     */

    public function get_all() {
        print_r($_SESSION);
        $this->db->select('activos.id, activos.fecha_compra, activos.monto_compra_sin_impuestos, activos.tipo, activos.descripcion');
        $this->db->from('activos');
        $this->db->join('personas', 'personas.id = persona_id');
        $this->db->where('personas.id', $_SESSION['persona_id']);
        $this->db->where('activos.status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae un registro activo en base a el campo id
     */

    public function get_by_id($id) {
        $this->db->select('id, fecha_compra, monto_compra_sin_impuestos, tipo, descripcion');
        $this->db->from('activos');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo que trae todos los registros activos en base a el campo persona_id
     */

    public function get_all_by_persona_id($persona_id) {
        $this->db->select('activos.id, activos.fecha_compra, activos.monto_compra_sin_impuestos, activos.tipo, activos.descripcion');
        $this->db->from('activos');
        $this->db->where('persona_id', $persona_id);
        $this->db->where('status', 1);
        $this->db->order_by('fecha_compra', 'asc');
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae todos los registros inactivos
     */

    public function get_all_inactive($persona_id) {
        $this->db->select('activos.id, personas.id, activos.fecha_compra, activos.monto_compra_sin_impuestos, activos.tipo, activos.descripcion');
        $this->db->from('activos');
        $this->db->join('personas', 'personas.id = persona_id');
        $this->db->where('personas.id', $persona_id);
        $this->db->where('activos.status', -1);
        $result = $this->db->get();
        return $result->result_array();
    }    

    public function count_all_activos_by_persona_id($persona_id) {
        $this->db->select('activos.id');
        $this->db->from('activos');
        $this->db->where('activos.status', 1);
        $this->db->where('activos.persona_id', $persona_id);
        return $this->db->count_all_results();
    }

    /*
      retorna el conteo de registros activos
     */

    public function count_all_activos($persona_id) {
        $this->db->select('activos.id, personas.id, activos.fecha_compra, activos.monto_compra_sin_impuestos, activos.tipo, activos.descripcion');
        $this->db->from('activos');
        $this->db->join('personas', 'personas.id = persona_id');
        $this->db->where('personas.id', $persona_id);
        $this->db->where('activos.status', -1);
        return $this->db->count_all_results();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('activos', $data)) ? $this->db->insert_id() : NULL;
    }

    /*
      Metodo para modificar un registro
     */

    public function update($id, $data) {
        return $this->db->update('activos', $data, ['id' => $id]);
    }

}
