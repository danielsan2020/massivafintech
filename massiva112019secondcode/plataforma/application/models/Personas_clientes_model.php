<?php

/**
 * Description of Personas_clientes_model
 */
class Personas_clientes_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
      Metodo que trae todos los registros activos de la tabla personas_clientes
     */

    public function get_all($persona_id) {
        $this->db->select('');
        $this->db->from('personas_clientes');
        $this->db->where('persona_id', $persona_id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae un registro activo en base a el campo id
     */

    public function get_by_id($id) {
        $this->db->select('id, colonia_id, persona_id, nombre, razon_social, rfc, calle, numero_interior, numero_exterior, email, tiene_logotipo');
        $this->db->from('personas_clientes');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_persona_cliente_by_id_for_xml($id) {
        $this->db->select('razon_social, rfc');
        $this->db->from('personas_clientes');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo que trae un registro activo en base a el campo id
     */

    public function get_persona_by_rfc($rfc) {
        $this->db->select('id,razon_social');
        $this->db->from('personas_clientes');
        $this->db->where('rfc', $rfc);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo que trae todos los registros activos en base a el campo persona_id
     */

    public function get_all_by_persona_id($persona_id) {
        $this->db->select('nombre, razon_social, rfc, direccion, email, tiene_logotipo');
        $this->db->from('personas_clientes');
        $this->db->where('persona_id', $persona_id);
        $this->db->where('status', 1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae todos los registros inactivos
     */

    public function get_all_inactive() {
        $this->db->select('id, nombre, razon_social, rfc, email, tiene_logotipo');
        $this->db->from('personas_clientes');
        $this->db->where('status', -1);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function count_all_activos($persona_id) {
        $this->db->from('personas_clientes');
        $this->db->where('persona_id', $persona_id);
        $this->db->where('status', 1);
        return $this->db->count_all_results();
    }

    public function count_all_inactivos() {
        $this->db->from('personas_clientes');
        $this->db->where('status', -1);
        return $this->db->count_all_results();
    }

    /*
      Metodo para buscar un rfc perteneciente a una persona
     */

    public function existe_rfc_by_persona_id($persona_id, $rfc) {
        $this->db->select('id, persona_id, rfc');
        $this->db->from('personas_clientes');
        $this->db->where('persona_id', $persona_id);
        $this->db->where('rfc', $rfc);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_rfc_by_persona_id($cliente_id, $persona_id, $rfc) {
        $this->db->select('id, rfc');
        $this->db->from('personas_clientes');
        $this->db->where('id <>', $cliente_id);
        $this->db->where('persona_id', $persona_id);
        $this->db->where('rfc', $rfc);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_rfc($rfc) {
        $this->db->select('id, rfc');
        $this->db->from('personas_clientes');
        $this->db->where('rfc', $rfc);
//        $this->db->where('persona_id !=', $persona_id);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('personas_clientes', $data)) ? $this->db->insert_id() : NULL;
    }

    /*
      Metodo para modificar un registro
     */

    public function update($id, $data) {
        return $this->db->update('personas_clientes', $data, ['id' => $id]);
    }

}
