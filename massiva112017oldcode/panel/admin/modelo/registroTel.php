<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES GENERALES                          //
// CREACION DEL ARCHIVO: 15/10/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: massiva                                            //
// AUTOR: Hevasoft.com                                          //
// PROPIETARIO: Massiva.mx                                      //
/****************************************************************/
require_once "modelo/Conexion.php";
Class registroTel{
	//Implementamos nuestro constructor
	public function __construct(){}
    
    /***********************Seccion de clientes por clientes*****************************/
    //consulto informacion de clientes
    public function informacionTabla(){
        $sql="SELECT * FROM tbl_registro_contacto_tel ORDER BY idConWeb DESC";
		return ejecutarConsulta($sql); 
    }
    
    
}