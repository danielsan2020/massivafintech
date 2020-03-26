<?php

/**
 * Description of Regimenes_fiscales_model
 */
class Regimenes_fiscales_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_regimenes_fiscales() {
        $this->db->select("id, regimen");
        $this->db->from('regimenes_fiscales');
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae todos los registros activos de la tabla regimenes_fiscales
     */

    public function get_all() {
        $this->db->select('id, regimen, descripcion, tipo');
        $this->db->from('regimenes_fiscales');
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae un registro activo en base a el campo id
     */

    public function get_by_id($id) {
        $this->db->select('id, regimen, descripcion, tipo');
        $this->db->from('regimenes_fiscales');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->row_array();
    }
    
    public function get_all_regimenes_by_paquete_id($id) {
        $this->db->select('paquetes.id, regimenes_fiscales.id, regimenes_fiscales.regimen');
        $this->db->from('regimenes_fiscales');
        $this->db->join('paquetes_regimenes', 'regimenes_fiscales.id = paquetes_regimenes.regimen_fiscal_id');
        $this->db->join('paquetes', 'paquetes_regimenes.paquete_id = paquetes.id');
        $this->db->where('paquetes.id', $id);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae todos los registros inactivos
     */

    public function get_all_inactive() {
        $this->db->select('id, regimen, descripcion, tipo');
        $this->db->from('regimenes_fiscales');
        $this->db->where('status', -1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae la cantidad de todos los registros activos de la tabla preguntas_frecuentes
     */

    public function count_all_activos() {
        $this->db->from('regimenes_fiscales');
        $this->db->where('status', 1);
        return $this->db->count_all_results();
    }
    /*
      Metodo que trae la cantidad de todos los registros activos de la tabla preguntas_frecuentes
     */

    public function count_all_inactivos() {
        $this->db->from('regimenes_fiscales');
        $this->db->where('status', -1);
        return $this->db->count_all_results();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('regimenes_fiscales', $data)) ? $this->db->insert_id() : NULL;
    }

    /*
      Metodo para modificar un registro
     */

    public function update($id, $data) {
        return $this->db->update('regimenes_fiscales', $data, ['id' => $id]);
    }

}
