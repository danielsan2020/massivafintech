<?php

/**
 * Description of Personas_model
 */
class Personas_model extends CI_Model {
    /*
      Metodo constructor de la clase
     */

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_by_id($id) {
        $this->db->select('id, rfc, razon_social, tipo, curp, actividad, cantidad_trabajadores, contabilidad_atrasada, tiene_efirma_vigente');
        $this->db->from('personas');
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_usuario_by_persona_id($persona_id) {
        $this->db->select('usuarios.email, usuarios.nombre, usuarios.apellido_paterno, usuarios.apellido_materno');
        $this->db->from('usuarios');
        $this->db->join('usuarios_personas', 'usuarios_personas.usuario_id = usuarios.id', 'INNER');
        $this->db->join('personas', 'usuarios_personas.persona_id = personas.id', 'INNER');
        $this->db->where('usuarios_personas.persona_id', $persona_id);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_efirma_by_persona_id($id) {
        $this->db->select('efirma');
        $this->db->from('personas');
        $this->db->where('id', $id);
        $this->db->limit(1);
        $result = $this->db->get();
        if ($result->row_array() !== "") {
            $row = $result->row_array();
            return $row['efirma'];
        } else {
            return NULL;
        }
    }

    public function get_regimenes_by_persona_id($id) {
        $this->db->select('id, regimen_fiscal_id');
        $this->db->from('personas_regimenes');
        $this->db->where('persona_id', $id);
        $this->db->where('status', 1);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_paquete_by_persona_id($id) {
        $this->db->select('id, paquete_id, vigencia_termino, vigencia_inicio, status');
        $this->db->from('compras_paquetes');
        $this->db->where('persona_id', $id);
        $this->db->where('compras_paquetes.status<>', -1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_rfc_and_id($persona_id, $rfc) {
        $this->db->select('id, rfc');
        $this->db->from('personas');
        $this->db->where('id', $persona_id);
        $this->db->where('rfc', $rfc);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_rfc($rfc) {
        $this->db->select('id, rfc');
        $this->db->from('personas');
        $this->db->where('rfc', $rfc);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert_regimen_persona($data) {
        return ($this->db->insert('personas_regimenes', $data)) ? $this->db->insert_id() : NULL;
    }

    public function insert_persona_paquete($data) {
        return ($this->db->insert('compras_paquetes', $data)) ? $this->db->insert_id() : NULL;
    }

    public function insert($data) {
        return ($this->db->insert('personas', $data)) ? $this->db->insert_id() : NULL;
    }

    public function update_paquete_persona($id, $data) {
        return $this->db->update('compras_paquetes', $data, ['id' => $id]);
    }

    public function update_regimen_persona($id, $data) {
        return $this->db->update('personas_regimenes', $data, ['id' => $id]);
    }

    public function update($id, $data) {
        return $this->db->update('personas', $data, ['id' => $id]);
    }

}
