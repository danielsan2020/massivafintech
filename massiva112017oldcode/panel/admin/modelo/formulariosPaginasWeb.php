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
Class paform{
	//Implementamos nuestro constructor
	public function __construct(){}

    //seccion para agregar el movimiento del log de recuperacion 
    public function accionLogagrega($fechaEnvio){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('0','24','$fechaEnvio')";
        return ejecutarConsulta($sql);
    }
    //guardar el evento en el log
    public function agrgg($Cnombre,$Cape,$Cmail,$cCel,$Cciudad,$cActi,$cMensaje,$fechaEnvio){
        $sql = "INSERT INTO tbl_formcontacto (nombre,apellidos,email,celular,ciudad,actividad,mensaje,fechaCreacion)VALUES('$Cnombre','$Cape','$cCel','$Cciudad','$cActi','$cMensaje','$fechaEnvio')";
        return ejecutarConsulta($sql);
    }
    //agregamos el registro de solicitud de llamda por la pagina web
    public function accionLogagregaMO($fechaEnvio){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('0','25','$fechaEnvio')";
        return ejecutarConsulta($sql);
    }
    //agrego a la tabla el registro
    public function agregoaalabsess($nombre,$numero,$asunto,$fechaEnvio){
        $sql = "INSERT INTO tbl_registro_contacto_tel (nombre,numero,fechaRegistro,asunto)VALUES('$nombre','$numero','$fechaEnvio','$asunto')";
        return ejecutarConsulta($sql);
    }
    
}