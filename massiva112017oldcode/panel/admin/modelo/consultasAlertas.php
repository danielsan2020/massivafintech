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
Class consultaAlertaPO{
	//Implementamos nuestro constructor
	public function __construct(){}
    


    /***********************consultas para las alertas iniciales*****************************/
    /* Obtenemos el dato del perfil */
    public function alertaPerfil($id_usuario){
        $sql="SELECT ciega FROM tbl_usuarios WHERE id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql); 
    }
    /* Obtenemos los clientes */
    public function alertaClientes($id_usuario){
        $sql="SELECT idCliente FROM tbl_clientesclientes WHERE id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql); 
    }
	/* areas y activos */
    public function alertaAreasActivos($id_usuario){
        $sql="SELECT idActivo FROM tbl_activos WHERE id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql); 
    }
	/* servicios y productos */
    public function alertaProductos($id_usuario){
        $sql="SELECT idInventario FROM tbl_inventario_productos WHERE id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql); 
    }
    /* servicios y productos */
    public function alertaServicios($id_usuario){
        $sql="SELECT idServicio FROM tbl_servicios WHERE id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql); 
    }
	/* Cuentas bancarias */
    public function alertaCuentasBancr($id_usuario){
        $sql="SELECT idBanco FROM tbl_bancousuario WHERE id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql); 
    }


}   