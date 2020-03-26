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
Class codicxgos{
	//Implementamos nuestro constructor
	public function __construct(){}
    
    //acciones para guardar los logs
    public function accionLogagrega($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','21','$fechaAccion')";
        return ejecutarConsulta($sql);
    }
    public function accionLogEdita($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','22','$fechaAccion')";
        return ejecutarConsulta($sql);
    }
    public function accionLogElimina($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','23','$fechaAccion')";
        return ejecutarConsulta($sql);
    }


    /***********************Seccion de clientes por clientes*****************************/
     //agregamos nueva entrada
    public function insertar($empresa,$ciudad,$numero,$fechaVigencia,$id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_codigos (empresa,ciudad,numero,fechaVigencia,UsuarioCreacion,fechaCreacion,estatus)VALUES('$empresa','$ciudad','$numero','$fechaVigencia','$id_usuario','$fechaAccion','1')";
        return ejecutarConsulta($sql);
    }

     //agregamos nueva entrada
    public function ASigContr($idCodigo,$contratof){
        $sql = "UPDATE tbl_codigos SET contrato='$contratof' WHERE idCodigo='$idCodigo'";
        return ejecutarConsulta($sql);
    }
	
    //eliminar codigo
    public function Elinds($idCodigo2){
        $sql = "DELETE FROM tbl_codigos WHERE idCodigo='$idCodigo2'";
        return ejecutarConsulta($sql); 
    }
	
	
    
}