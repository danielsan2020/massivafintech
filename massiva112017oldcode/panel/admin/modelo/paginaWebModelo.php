<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES GENERALES                          //
// CREACION DEL ARCHIVO: 15/10/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: massiva                                            //
// AUTOR: Hevasoft.com                                          //
// PROPIETARIO: Massiva.mx                                      //
/****************************************************************/
require_once "panel/admin/modelo/Conexion.php";
Class pagina{
	//Implementamos nuestro constructor
	public function __construct(){}
    
    /***********************Seccion de clientes por clientes*****************************/
    //consulto informacion de clientes
    public function informacionTabla(){
        $sql="SELECT * FROM tbl_noticiaweb ORDER BY idNoticiaWeb DESC LIMIT 5";
	return ejecutarConsulta($sql); 
    }
    
    /////////////////seccion para las noticias
    //preguntas frecuentes
    public function rspuno(){
        $sql="SELECT * FROM cat_preguntas WHERE area LIKE 'PREGUNTAS GENERALES'";
	return ejecutarConsulta($sql); 
    }
    public function rsptres(){
        $sql="SELECT * FROM cat_preguntas WHERE area LIKE 'RIF, SAS Y OTRAS PERSONAS MORALES'";
	return ejecutarConsulta($sql); 
    }
    //facturas y cotizaciones
    public function rspcuatro(){
        $sql="SELECT * FROM cat_preguntas WHERE area LIKE 'FACTURAS Y COTIZACIONES'";
	return ejecutarConsulta($sql); 
    }
    //declaraciones
    public function rspcinco(){
        $sql="SELECT * FROM cat_preguntas WHERE area LIKE 'DECLARACIONES'";
	return ejecutarConsulta($sql); 
    }
    //plataforma
    public function rspseis(){
        $sql="SELECT * FROM cat_preguntas WHERE area LIKE 'PLATAFORMA'";
	return ejecutarConsulta($sql); 
    }
    //otras consultas
    public function rspsiete(){
        $sql="SELECT * FROM cat_preguntas WHERE area LIKE 'OTRAS CONSULTAS O DUDAS'";
	return ejecutarConsulta($sql); 
    }
	
	///guardar el registro de contacto de pagina web
    //seccion para agregar el movimiento del log de recuperacion 
    public function accionLogagrega($fechaEnvio){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('0','24','$fechaEnvio')";
        return ejecutarConsulta($sql);
    }
    //guardar el evento en el log
    public function agregoBd($Cnombre,$Cape,$Cmail,$cCel,$Cciudad,$cActi,$cMensaje,$fechaEnvio){
        $sql = "INSERT INTO tbl_formcontacto (nombre,apellidos,email,celular,ciudad,actividad,mensaje,fechaCreacion)VALUES('$Cnombre','$Cape','$cCel','$Cciudad','$cActi','$cMensaje','$fechaEnvio')";
        return ejecutarConsulta($sql);
    }
}