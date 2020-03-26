<?php

/**
 * Description of Personas_clientes_contacto_model
 */
class Personas_clientes_contacto_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
      Metodo que trae todos los registros activos de la tabla personas_clientes_contacto
     */

    public function get_all() {
        $this->db->select('');
        $this->db->from('personas_clientes_contacto');
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae un registro activo en base a el campo id
     */

    public function get_by_id($id) {
        $this->db->select('id, persona_cliente_id, nombre, apellido_paterno, apellido_materno, departamento, puesto, telefono_1, telefono_2, celular_1, celular_2, email_1, email_2');
        $this->db->from('personas_clientes_contacto');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo que trae todos los registros inactivos
     */

    public function get_all_inactive() {
        $this->db->select('');
        $this->db->from('personas_clientes_contacto');
        $this->db->where('status', -1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('personas_clientes_contacto', $data)) ? $this->db->insert_id() : NULL;
    }

    /*
      Metodo para modificar un registro
     */

    public function update($id, $data) {
        return $this->db->update('personas_clientes_contacto', $data, ['id' => $id]);
    }

}
