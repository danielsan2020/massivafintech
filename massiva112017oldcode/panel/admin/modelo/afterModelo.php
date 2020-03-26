<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES la api de afterbank                //
// CREACION DEL ARCHIVO: 01/04/2019                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: Massiva                                            //
/****************************************************************/

require_once "Conexion.php";

Class afterbank{
	
	//Implementamos nuestro constructor
	public function __construct(){}
	
	/***********************Seccion para guardar los logs*****************************/
    //nuevo seguro
    public function consultamosBancos($id_usuario){
        $sql = "SELECT * FROM tbl_bancousuario WHERE id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql);
	}

    /* verifiamos que no exista el movimiento */
    public function consultamosMovimiento($id_usuario,$cuenta,$tipo,$balance,$moneda,$descripcion){
        $sql = "SELECT idMovimiento FROM tbl_movimientosbancos WHERE id_usuario = '$id_usuario' AND cuenta LIKE '$cuenta' AND tipo LIKE '$tipo' AND balance LIKE '$balance' AND moneda LIKE '$moneda' AND descripcion LIKE '$descripcion'";
		return ejecutarConsulta($sql);
	}
    
    /* Agregamos movimiento a la bd */
    public function agregamosMovimiento($id_usuario,$cuenta,$tipo,$balance,$moneda,$descripcion,$tipoMov,$estatus,$banco,$fechaCreacion){
		$sql = "INSERT INTO tbl_movimientosbancos (id_usuario,cuenta,tipo,balance,moneda,descripcion,tipoMov,estatus,banco,fechaCreacion)
		VALUES('$id_usuario','$cuenta','$tipo','$balance','$moneda','$descripcion','$tipoMov','$estatus','$banco','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}
    
    /* recorremos las cuentas del usuario */
    public function obteneCuentas($id_usuario){
		$sql = "SELECT * FROM tbl_movimientosbancos WHERE id_usuario = '$id_usuario'";
		return ejecutarConsulta($sql);
	}
    
    /* verificamos si existe el movimiento */
    public function veriMovimi($idTransaccion){
		$sql = "SELECT * FROM tbl_movimientosbancos_movi WHERE idTransaccion LIKE '$idTransaccion'";
		return ejecutarConsulta($sql);
	}
    
    /* agregamos las cuentas */
    public function agreMovCuenta($id_usuario,$cuenta,$fechaUno,$fechaDos,$monto,$descripcion,$balance,$idTransaccion,$categoria,$fechaCreacion,$quees,$banco){
		$sql = "INSERT INTO tbl_movimientosbancos_movi (id_usuario,cuenta,fechaUno,fechaDos,monto,descripcion,balance,idTransaccion,categoria,fechaCreacion,quees,banco)
		VALUES('$id_usuario','$cuenta','$fechaUno','$fechaDos','$monto','$descripcion','$balance','$idTransaccion','$categoria','$fechaCreacion','$quees','$banco')";
		return ejecutarConsulta($sql);
	}



}