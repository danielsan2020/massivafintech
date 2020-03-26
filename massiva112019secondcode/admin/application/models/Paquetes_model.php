<?php

/**
 * Description of Paquetes_model
 */
class Paquetes_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
      Metodo que trae todos los registros activos de la tabla paquetes
     */

    public function get_all() {
        $this->db->select('id, nombre, precio, tipo, periodo');
        $this->db->from('paquetes');
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae la cantidad de todos los registros activos de la tabla paquetes
     */

    public function count_all_activos() {
        $this->db->from('paquetes');
        $this->db->where('status', 1);
        return $this->db->count_all_results();
    }

    /*
      Metodo que trae la cantidad de todos los registros inactivos de la tabla paquetes
     */

    public function count_all_inactivos() {
        $this->db->from('paquetes');
        $this->db->where('status', -1);
        return $this->db->count_all_results();
    }

    /*
      Metodo que trae un registro activo en base a el campo id
     */

    public function get_by_id($id) {
        $this->db->select('id, nombre, precio, periodo, mostrar_en_principal, descripcion, tipo, cfdis_al_mes, open_pay_id');
        $this->db->from('paquetes');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo que trae todos los registros activos en base a el campo tipo
     */

    public function get_all_by_tipo($tipo) {
        $this->db->select('id, nombre, precio, periodo');
        $this->db->from('paquetes');
        $this->db->where('tipo', $tipo);
        $this->db->where('status', 1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae todos los registros inactivos
     */

    public function get_all_inactive() {
        $this->db->select('id, nombre, precio, tipo, periodo');
        $this->db->from('paquetes');
        $this->db->where('status', -1);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_all_generate_json() {
        $this->db->select('id, nombre, precio, descripcion, tipo, periodo');
        $this->db->from('paquetes');
        $this->db->where('status', 1);
        $this->db->where('mostrar_en_principal', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('paquetes', $data)) ? $this->db->insert_id() : NULL;
    }

    /*
      Metodo para modificar un registro
     */

    public function update($id, $data) {
        return $this->db->update('paquetes', $data, ['id' => $id]);
    }

}
