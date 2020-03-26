<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES GENERALES                          //
// CREACION DEL ARCHIVO: 15/10/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: massiva                                            //
// AUTOR: Hevasoft.com                                          //
// PROPIETARIO: Massiva.mx                                      //
/****************************************************************/
require_once "../modelo/Conexion.php";
Class recuperacion{
    //Implementamos nuestro constructor
    public function __construct(){}
        
    //function para encontrar los datos de recuperacion de credenciales
    public function recuperaCreden($correo){
        $sql = "SELECT id_usuario,usuario,clave,nombre,ape_paterno,ape_materno FROM tbl_usuarios WHERE correo = '$correo'";
        return ejecutarConsulta($sql);
    }
    
    //seccion para agregar el movimiento del log de recuperacion 
    public function accionLogagrega($id_usuario,$fechaAccion){
            $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','20','$fechaAccion')";
            return ejecutarConsulta($sql);
    }
    
}