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
Class rweb{
	//Implementamos nuestro constructor
	public function __construct(){}
    
    //registro de atencion via telefonica
    public function insertar($nombre,$numero,$fechaAccion,$asunto){
        $sql = "INSERT INTO tbl_registro_contacto_tel (nombre,numero,fechaRegistro,asunto)	VALUES('$nombre','$numero','$fechaAccion','$asunto')";
		return ejecutarConsulta($sql);
    }
    
    //registro de nuevo usuario
    public function nusuario($nombreR,$ape_paternoR,$ape_maternoR,$telefonoR,$rfcR,$correoR,$tipoActividadR,$formaJuridicaR,$cantidadTrabajadoresR,$noTengoEfirmaR,$contabilidadAtrasadaR,$aviso,$terminos,$clave,$estatus,$numUlt,$fechaAccion){
        $sql = "INSERT INTO tbl_usuarios (
		usuario,clave,nombre,ape_paterno,ape_materno,telefono,rfc,correo,tipoActividad,formaJuridica,cantidadTrabajadores,noTengoEfirma,contabilidadAtrasada,tipoUsuario,valorPre,nUsuario,fechaCrea,estatus) 
        VALUES ('$rfcR','$clave','$nombreR','$ape_paternoR','$ape_maternoR','$telefonoR','$rfcR','$correoR','$tipoActividadR','$formaJuridicaR','$cantidadTrabajadoresR','$noTengoEfirmaR','$contabilidadAtrasadaR','2','1','$numUlt','$fechaAccion','$estatus')";
        return ejecutarConsulta($sql);
    }
	
	public function ultimoNumero(){
		$sql= "SELECT nUsuario FROM  tbl_usuarios ORDER BY id_usuario DESC LIMIT 1";
		return ejecutarConsulta($sql);
	}
	
    //consulta de rfc para blacklist
    public function consulta($rfc){
        $sql = "SELECT * FROM tbl_black_rfc WHERE rfc LIKE '$rfcR'";
        return ejecutarConsulta($sql);
    }
    
	//se registra el nuevo valor de registro de contacto
	public function nForContacto($Cnombre,$Cape,$Cmail,$cCel,$Cciudad,$cActi,$cMensaje,$fechaAccion){
		$sql = "INSERT INTO tbl_formcontacto (nombre,apellidos,email,celular,ciudad,actividad,mensaje,fechaCreacion) 
        VALUES ('$Cnombre','$Cape','$Cmail','$cCel','$Cciudad','$cActi','$cMensaje','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	//verificamos si el rfc ya se encuentra registrado en el sistema
	 public function consultaRFcbd($strCorrecta){
        $sql = "SELECT * FROM tbl_usuarios WHERE rfc LIKE '$strCorrecta' ORDER BY id_usuario DESC LIMIT 1";
        return ejecutarConsultaSimpleFila($sql);
    }

    //funcion para agregar el log de usuario denegados por blacklista
     public function accionLogagrega($fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('0','39','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	//funcio para agregar el log de registro de usuario de bien registrado
     public function accionLogagrega2($fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('0','38','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	//obtenemos la clave del nuevo usuario
	 public function claveNuevoUs($rfcc){
		$sql = "SELECT * FROM tbl_usuarios WHERE rfc LIKE '$rfcc'";
		return ejecutarConsulta($sql);
	}	
	
	/* asignamos el ticket de cortesia del usuario */
	public function unotic($pritic,$ultimoNum,$fechaAccion){
		$sql = "INSERT INTO tbl_tickets (id_usuario,tickets,fechaCreacion)VALUES('$ultimoNum','$pritic','$fechaAccion')";
		return ejecutarConsulta($sql);
	}


}