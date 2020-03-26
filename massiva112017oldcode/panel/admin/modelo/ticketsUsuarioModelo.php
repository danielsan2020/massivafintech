<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES GENERALES                          //
// CREACION DEL ARCHIVO: 15/10/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: massiva                                            //
// AUTOR: Hevasoft.com                                          //
// PROPIETARIO: Massiva.mx                                      //
/****************************************************************/
require_once "Conexion.php";
Class ticUsu{
	//Implementamos nuestro constructor
	public function __construct(){}
    
    //acciones para guardar los logs
    public function accionNuevoNegocio($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','82','$fechaAccion')";
        return ejecutarConsulta($sql);
    }
    /* accion de nuevo */
    public function accionNuevoTick($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','83','$fechaAccion')";
        return ejecutarConsulta($sql);
    }
    /* accion para aregar xml de tickets */
    public function accionxml($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','84','$fechaAccion')";
        return ejecutarConsulta($sql);
    }

     /* accion para aregar xml de tickets */
    public function acionelimiTic($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','85','$fechaAccion')";
        return ejecutarConsulta($sql);
    }

     /* accion para factura massiva xml de tickets */
    public function accionfacmassi($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','86','$fechaAccion')";
        return ejecutarConsulta($sql);
    }

    
    
    

    /***********************Seccion de clientes por clientes*****************************/
     //agregamos nueva entrada
    public function nuevoNegocio($comercio,$ciudad,$id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_solicita_negocio (comercio,ciudad,fechaSolicitud,id_usuario)VALUES('$comercio','$ciudad','$fechaAccion','$id_usuario')";
        return ejecutarConsulta($sql);
    }
    /* agregamos nuevo ticket */
    public function nuevotic($fecha,$alias,$nombre_archivo,$id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_tickets_cliente (foto,fecha,comercio,fechaCreacion,estatus,id_usuario)VALUES('$nombre_archivo','$fecha','$alias','$fechaAccion','1','$id_usuario')";
        return ejecutarConsulta($sql);
    }
    
    /* buscamos el soprote tecnico */
    public function consultaTemp($comercioo){
        $sql = "SELECT descripcion,url FROM cat_negocios WHERE nombre LIKE '$comercioo'";
        return ejecutarConsultaSimpleFila($sql);
    }
    
    /* agregamos el xml */
    public function subirxm($idTickets,$nombre_archivo){
        $sql = "UPDATE tbl_tickets_cliente SET xmll='$nombre_archivo' WHERE idTickets='$idTickets' ";
        return ejecutarConsulta($sql);
    }

     /* eliminamos ticket */
    public function elimintic($idTicketsEli){
        $sql = "DELETE FROM tbl_tickets_cliente WHERE idTickets = '$idTicketsEli'";
        return ejecutarConsulta($sql);
    }
    
    /* factura massiva */
    public function facmss($valor){
        $sql = "UPDATE tbl_tickets_cliente SET estatus='2' WHERE idTickets='$valor' ";
        return ejecutarConsulta($sql);
    }

    /* actualizamos nuemero de tickets */
    public function actuTid($id_usuario,$mistic){
        $sql = "UPDATE tbl_tickets SET tickets='$mistic' WHERE id_usuario='$id_usuario' ";
        return ejecutarConsulta($sql);
    }
    
    /* actualizamo el status del ticket */
    public function terminatic($idTickets){
        $sql = "UPDATE tbl_tickets_cliente SET estatus='3' WHERE idTickets='$idTickets' ";
        return ejecutarConsulta($sql);
    }

    

}