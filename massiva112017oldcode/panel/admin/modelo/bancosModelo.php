<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES GENERALES                          //
// CREACION DEL ARCHIVO: 15/10/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: Ruta                                               //
/****************************************************************/

require_once "Conexion.php";

Class bancos{

	//Implementamos nuestro constructor
	public function __construct(){}
    
	//accion para el log
	///accion de solicitar banco
	public function accionSolicita($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','67','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}
	///accion de agregar banco
	public function accionagrega($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','68','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}

	///accion de agregar banco
	public function accionElin($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','76','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}

	///accion de agregar movimiento manual
	public function agregaManu($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','77','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}

	///accion de considerear para contabilidad
	public function considreamosSI($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','78','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}

	///accion de no considerear
	public function considreamosNo($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','79','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}

	///categorizamos como ingreso
	public function quees1($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','80','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}

		///accion categorizamos como egrespo
	public function quees2($id_usuario,$fechaCreacion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','81','$fechaCreacion')";
		return ejecutarConsulta($sql);
	}
	
		
	////////////////**************************************************************************///////////////////// */

	//solicitud de nuevo banco
	public function solicitudBanco($nombreBanco,$url,$estatus,$usuarioSe,$fechaAccion){
    $sql = "INSERT INTO tbl_solicitudbanco (nombreBanco,url,id_usuario,estatus,fechaCreacion)VALUES('$nombreBanco','$url','$usuarioSe','$estatus','$fechaAccion')";
		return ejecutarConsulta($sql);
  }
    
  //se agrega el banco del usuario
  public function bancoUsuario($claveBanco,$fecha,$usuarioBanco,$contraBanco,$fechaAccion,$usuarioSe){
    $sql = "INSERT INTO tbl_bancousuario(usuarioBanco,claveBanco,fechaNacimiento,fechaCreacion,id_usuario,banco)VALUES('$usuarioBanco','$contraBanco','$fecha','$fechaAccion','$usuarioSe','$claveBanco')";
		return ejecutarConsulta($sql);
	}
	
	///se elimina el banco
	public function eliminaBanco($idBanco){
		$sql = "DELETE FROM tbl_bancousuario WHERE idBanco = '$idBanco'";
		return ejecutarConsulta($sql); 
	}

	/* agregar movimiento manual */
	public function moviManulk($cuentamm,$tipomm,$balancemm,$monedamm,$id_usuariomm,$fechaAccion){
		$sql = "INSERT INTO tbl_movimientosbancos_movi(id_usuario,cuenta,fechaUno,fechaDos,monto,descripcion,balance,idTransaccion,categoria,fechaCreacion,considera,quees,banco,manua)
		VALUES('$id_usuariomm','$cuentamm','','','$balancemm','$tipomm','$balancemm','','','$fechaAccion','','2','Manual','1')";
		return ejecutarConsulta($sql); 
	}

	/* cambiamos la consideracion para delcraciones */
  public function consideramos1($unooM1,$unooM11){
		$sql = "UPDATE tbl_movimientosbancos_movi SET considera='$unooM11' WHERE idMovimiento='$unooM1'";
        return ejecutarConsulta($sql); 	
	}

	public function consideramos2($unooM2,$unooM22){
		$sql = "UPDATE tbl_movimientosbancos_movi SET considera='$unooM22' WHERE idMovimiento='$unooM2'";
        return ejecutarConsulta($sql); 	
	}

	/* clsificamos movimiento */
	public function quesCals1($unooT1,$unooT11){
		$sql = "UPDATE tbl_movimientosbancos SET quees='$unooT11' WHERE idMovimiento='$unooT1'";
        return ejecutarConsulta($sql); 	
	}

	public function quesCals2($unooT2,$unooT22){
		$sql = "UPDATE tbl_movimientosbancos SET quees='$unooT22' WHERE idMovimiento='$unooT2'";
        return ejecutarConsulta($sql); 	
	}
	

	
	


}


