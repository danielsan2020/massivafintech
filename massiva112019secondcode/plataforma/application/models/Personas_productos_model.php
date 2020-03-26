<?php

/**
 * Description of Personas_productos_model
 *
 * @author dell
 */
class Personas_productos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /*
      Metodo que trae los registros activos de la tabla personas_productos
     */

    public function get_all_by_persona_id($persona_id) {
        $this->db->select('id, clave, producto, cantidad, precio_compra, precio_venta, proveedor, tiene_foto_producto');
        $this->db->from('personas_productos');
        $this->db->where('status', 1);
        $this->db->where('persona_id', $persona_id);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae todos los registros inactivos
     */

    public function get_all_inactive() {
        $this->db->select('id, clave, producto, cantidad, precio_compra, precio_venta, proveedor');
        $this->db->from('personas_productos');
        $this->db->where('status', -1);
        $this->db->order_by('id', 'asc');
        $result = $this->db->get();
        return $result->result_array();
    }

    /*
      Metodo que trae un registro por medio de su id
     */

    public function get_producto_by_producto_id($producto_id) {
        $this->db->select('unidades_de_medida.id AS unidad_de_medida_id, personas_productos.tipo, personas_productos.producto,  personas_productos.clave, personas_productos.cantidad, personas_productos.precio_compra, personas_productos.tiene_foto_producto, personas_productos.producto_sat_id,
                           personas_productos.precio_venta, personas_productos.proveedor, personas_productos.comentario, productos_sat.clave AS clave_sat, productos_sat.descripcion AS descripcion, grupos_sat.descripcion AS unidad_sat');
        $this->db->from('personas_productos');
        $this->db->join('productos_sat', 'personas_productos.producto_sat_id = productos_sat.id');
        $this->db->join('unidades_de_medida', 'personas_productos.unidad_de_medida_id = unidades_de_medida.id');
        $this->db->join('grupos_sat', ' productos_sat.grupo_sat_id = grupos_sat.id');
        $this->db->where('personas_productos.id', $producto_id);
        $this->db->where('personas_productos.status', 1);
        $result = $this->db->get();
        return $result->row_array();
    }

    public function get_producto_by_clave($clave, $persona_id) {
        $this->db->select('personas_productos.id,personas_productos.comentario,divisiones_sat.iva_retenido,divisiones_sat.isr_retenido,divisiones_sat.iva,divisiones_sat.iva_texto,divisiones_sat.iva_retenido_texto,divisiones_sat.isr_retenido_texto');
        $this->db->from('personas_productos');
        $this->db->join('productos_sat', 'personas_productos.producto_sat_id = productos_sat.id');
        $this->db->join('grupos_sat', ' productos_sat.grupo_sat_id = grupos_sat.id');
        $this->db->join('divisiones_sat', 'divisiones_sat.id = grupos_sat.division_sat_id');
        $this->db->where('personas_productos.clave', $clave);
        $this->db->where('personas_productos.persona_id', $persona_id);
        $this->db->where('personas_productos.status', 1);
        $this->db->limit(1);
        $result = $this->db->get();
        return $result->row_array();
    }

    /*
      Metodo para dar de alta un registro
     */

    public function insert($data) {
        return ($this->db->insert('personas_productos', $data)) ? $this->db->insert_id() : NULL;
    }

    /*
      Metodo para modificar un registro
     */

    public function update($id, $data) {
        return $this->db->update('personas_productos', $data, ['id' => $id]);
    }

}
