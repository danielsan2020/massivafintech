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
Class documentacion{
	//Implementamos nuestro constructor
	public function __construct(){}
    	
    //generamos la seccion para el logs
    public function actualizaDoc($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','46','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	public function eliminaDoc($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','47','$fechaAccion')";
		return ejecutarConsulta($sql);
	}




    //inserto nuevo elemento
    public function insertar($id_usuario,$nombreFinal1,$nombreFinal2,$nombreFinal3,$nombreFinal4,$nombreFinal5,$clavee){
        $sql = "INSERT INTO tbl_documentacion (id_usuario,domicilio,ife,curp,key,cer,clavee) VALUES ('$id_usuario','$nombreFinal1','$nombreFinal2','$nombreFinal3','$nombreFinal4','$nombreFinal5','$clavee')";
		return ejecutarConsulta_retornarID($sql);
    }
	//obtengo la informacion para validar
	public function consulto($id_usuario){
		$sql= "SELECT * FROM tbl_usuarios WHERE id_usuario = $id_usuario";
		return ejecutarConsulta($sql);
	}
	
	public function actualiza($nombre1,$fecha_nacimiento,$ape_paterno,$telefono,$ape_materno,$mail,$rfc,$tpersona,$facturasMes,$tproducto,$trabajadores,$efirma,$contaAtrasada,$aviso,$terminos,$clave,$estatus){
        $sql = "INSERT INTO tbl_usuarios (usuario,nombre,fecha_nacimiento,ape_paterno,telefono,ape_materno,mail,rfc,tpersona,facturasMes,tproducto,trabajadores,efirma,contaAtrasada,aviso,terminos,clave,estatus,contaAtrasada) 
        VALUES ('$rfc','$nombre1','$fecha_nacimiento','$ape_paterno','$telefono','$ape_materno','$mail','$rfc','$tpersona','$facturasMes','$tproducto','$trabajadores','$efirma','$contaAtrasada','$aviso','$terminos','$clave','$estatus','1')";
        return ejecutarConsulta($sql);
    }
	

	///////////////////////seccion para la carga de documentacion dentro de la plataforma
	//obtengo la informacion para eliminar el archivo seleccionado
	public function obtengoTipo($valoId){
        $sql = "SELECT * FROM tbl_documentacion WHERE idDocumentacion = $valoId";
        return ejecutarConsulta($sql);     
    }
    //realizamos la eliminacion de los archivo actualizando el valor
    public function ActuElim1($idDocumentacion){
		$sql = "UPDATE tbl_documentacion SET comprobante='' WHERE idDocumentacion='$idDocumentacion'";
        return ejecutarConsulta($sql); 	
	}
	public function ActuElim2($idDocumentacion){
		$sql = "UPDATE tbl_documentacion SET iden1='' WHERE idDocumentacion='$idDocumentacion'";
        return ejecutarConsulta($sql); 	
	}
	public function ActuElim3($idDocumentacion){
		$sql = "UPDATE tbl_documentacion SET iden2='' WHERE idDocumentacion='$idDocumentacion'";
        return ejecutarConsulta($sql); 	
	}
	public function ActuElim4($idDocumentacion){
		$sql = "UPDATE tbl_documentacion SET keyaar='' WHERE idDocumentacion='$idDocumentacion'";
        return ejecutarConsulta($sql); 	
	}
	public function ActuElim5($idDocumentacion){
		$sql = "UPDATE tbl_documentacion SET cerar='' WHERE idDocumentacion='$idDocumentacion'";
        return ejecutarConsulta($sql); 	
	}

	//actualizamos los arcxhivos subidos
	public function ActuArchi1($valor,$id_usuario){
		$sql = "UPDATE tbl_documentacion SET comprobante='$valor' WHERE id_usuario='$id_usuario'";
        return ejecutarConsulta($sql); 	
	}
	public function ActuArchi2($valor,$id_usuario){
		$sql = "UPDATE tbl_documentacion SET iden1='$valor' WHERE id_usuario='$id_usuario'";
        return ejecutarConsulta($sql); 	
	}
	public function ActuArchi3($valor,$id_usuario){
		$sql = "UPDATE tbl_documentacion SET iden2='$valor' WHERE id_usuario='$id_usuario'";
        return ejecutarConsulta($sql); 	
	}
	public function ActuArchi4($valor,$id_usuario){
		$sql = "UPDATE tbl_documentacion SET keyaar='$valor' WHERE id_usuario='$id_usuario'";
        return ejecutarConsulta($sql); 	
	}
	public function ActuArchi5($valor,$id_usuario){
		$sql = "UPDATE tbl_documentacion SET cerar='$valor' WHERE id_usuario='$id_usuario'";
        return ejecutarConsulta($sql); 	
	}

	/*	
		id_cliente,id_usuario,nombre,apePaterno,apeMaterno,departamento,puesto,tel1,tel2,cel1,cel2,mail1,mail2,direccion,cp,estado,colonia,ciudad,observaciones,noEmpresa,dirEmpresa,coloniaEmpresa,cpEmpresa,estadoEmpresa,ciudadEmpresa,tel1Empresa,tel2Empresa,cel1Empresa,cel2Empresa,mail1Empresa,mail2Empresa,mail3Empresa,paginaWeb,giroEmpresa,razonSocial,rfcEmpresa,observacionesEmpresa,usuarioCreacion,fechaCreacion,status,usuarioModificacion,fechaModificacion
	*/  

}