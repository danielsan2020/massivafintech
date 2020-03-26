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
Class consultaFac{
	//Implementamos nuestro constructor
	public function __construct(){}

    /***********************Seccion para los movimienos de facturacion*****************************/
    //consulto informacion de clientes
    public function informacionARchivos($id_usuario){
        $sql="SELECT * FROM tbl_documentacion WHERE id_usuario = $id_usuario";
		return ejecutarConsulta($sql); 
    }

    public function informacionFactura($idfactura){
        $sql="SELECT * FROM tbl_facturas_solicitadas WHERE idFactura = $idfactura";
		return ejecutarConsulta($sql); 
    }

    public function guardamosar($id_usuario,$NoCert,$PEM_NomArchCER,$PEM_NomArchKEY){
        $sql = "UPDATE tbl_documentacion SET keypem = '$PEM_NomArchKEY', cerpem = '$PEM_NomArchCER', certificado ='$NoCert' WHERE id_usuario='$id_usuario'";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos lso datos del cliente */
    public function informacinCliente($idCliente){
        $sql="SELECT * FROM tbl_clientesclientes WHERE idCliente = $idCliente";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos los productos de la factura */
    public function productoFac($idfactura){
        $sql="SELECT * FROM tbl_productos_factura WHERE idFactura = $idfactura";
		return ejecutarConsulta($sql); 
    }

    /* obtenemos la informacion del cliente */
    public function informacionUsu($id_usuario){
        $sql="SELECT * FROM tbl_usuarios WHERE id_usuario = $id_usuario";
		return ejecutarConsulta($sql); 
    }
    
    
}
