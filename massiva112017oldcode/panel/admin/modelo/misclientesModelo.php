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
Class misClientes{
	//Implementamos nuestro constructor
	public function __construct(){}
    ////secciones para los logs
	public function accionSolicita($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','70','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	public function accionedita($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','72','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

	public function accionElimina($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','71','$fechaAccion')";
		return ejecutarConsulta($sql);
	}

    //inserto nuevo elemento
	public function insertarValor($cuenta,$usuarioSe,$fechaAccion,$nombre,$apePaterno,$apeMaterno,$departamento,$puesto,$tel1,$tel2,$cel1,$cel2,$correo1,$correo2,$dir,$cp,$estado,$colonia,$ciudad,$observaciones,$nombre_archivo,$nombreE,$razonSocialE,$rfcE,$dirE,$coloniaE,$cpE,$estadoE,$ciudadE,$paisE,$telE,$correo1E,$correo2E,$correo3E,$creditoE,$observacionesE,$estatus){
        $sql = "INSERT INTO tbl_clientesclientes (id_usuario,nombre,apePaterno,apeMaterno,departamento,puesto,tel1,tel2,cel1,cel2,correo1,correo2,dir,cp,estado,colonia,ciudad,observaciones,logo,nombreE,razonSocialE,rfcE,dirE,coloniaE,cpE,estadoE,ciudadE,paisE,telE,correo1E,correo2E,correo3E,creditoE,observacionesE,cuenta,fechaCreacion,estatus)VALUES('$usuarioSe','$nombre','$apePaterno','$apeMaterno','$departamento','$puesto','$tel1','$tel2','$cel1','$cel2','$correo1','$correo2','$dir','$cp','$estado','$colonia','$ciudad','$observaciones','$nombre_archivo','$nombreE','$razonSocialE','$rfcE','$dirE','$coloniaE','$cpE','$estadoE','$ciudadE','$paisE','$telE','$correo1E','$correo2E','$correo3E','$creditoE','$observacionesE','$cuenta','$fechaAccion','$estatus')";
		return ejecutarConsulta($sql);
    }
	
	//eliminacion de noticia
    public function eliminarCliente($idCliente){
        $sql = "UPDATE tbl_clientesclientes SET estatus='2' WHERE idCliente='$idCliente'";
        return ejecutarConsulta($sql); 
    }
	
	//obtenemos valores para la edicion de la noticia
    public function consultaEdita($idenEdita){
        $sql = "SELECT * FROM tbl_clientesclientes WHERE idCliente = '$idenEdita'";
        return ejecutarConsultaSimpleFila($sql);
		
    }
	
	//buscamos si hay un registro 
	 public function buscamosReCuenta($usuarioSe){
        $sql = "SELECT COUNT(*) as total FROM tbl_clientesclientes WHERE id_usuario ='$usuarioSe'";
        return ejecutarConsulta($sql);
		
	}
	
	///editamos el cliente con imagen
	public function EditamosClien($nombre_archivo,$idClienteE1,$nombreE1,$apePaternoE,$apeMaternoE,$departamentoE,$puestoE,$tel1E,$tel2E,$cel1E,$cel2E,$correo1E1,$correo2E1,$dirE1,$cpE1,$coloniaE1,$ciudadE1,$observacionesE1,$nombreEE,$razonSocialEE,$rfcEE,$dirEE,$coloniaEE,$cpEE,$estadoEE,$ciudadEE,$telEE,$correo1EE,$correo2EE,$correo3EE,$observacionesEE,$estadoE1,$creditoEE){
		$sql = "UPDATE tbl_clientesclientes SET nombre='$nombreE1',apePaterno='$apePaternoE',apeMaterno='$apeMaternoE',departamento='$departamentoE',puesto='$puestoE',tel1='$tel1E',tel2='$tel2E',cel1='$cel1E',cel2='$cel2E',correo1='$correo1E1',correo2='$correo2E1',dir='$dirE1',cp='$cpE1',estado='$estadoE1',colonia='$coloniaE1',ciudad='$ciudadE1',observaciones='$observacionesE1',logo='$nombre_archivo',nombreE='$nombreEE',razonSocialE='$razonSocialEE',rfcE='$rfcEE',dirE='$dirEE',coloniaE='$coloniaEE',cpE='$cpEE',estadoE='$estadoEE',ciudadE='$ciudadEE',telE='$telEE',correo1E='$correo1EE',correo2E='$correo2EE',correo3E='$correo3EE',creditoE='$creditoEE',observacionesE='$observacionesEE' WHERE idCliente='$idClienteE1' ";
	    return ejecutarConsulta($sql); 	
	}

	//editamos informacion sin imagen
	public function editamosClienSin($imgLogE1,$idClienteE1,$nombreE1,$apePaternoE,$apeMaternoE,$departamentoE,$puestoE,$tel1E,$tel2E,$cel1E,$cel2E,$correo1E1,$correo2E1,$dirE1,$cpE1,$coloniaE1,$ciudadE1,$observacionesE1,$nombreEE,$razonSocialEE,$rfcEE,$dirEE,$coloniaEE,$cpEE,$estadoEE,$ciudadEE,$telEE,$correo1EE,$correo2EE,$correo3EE,$observacionesEE,$estadoE1,$creditoEE){
		$sql = "UPDATE tbl_clientesclientes SET nombre='$nombreE1',apePaterno='$apePaternoE',apeMaterno='$apeMaternoE',departamento='$departamentoE',puesto='$puestoE',tel1='$tel1E',tel2='$tel2E',cel1='$cel1E',cel2='$cel2E',correo1='$correo1E1',correo2='$correo2E1',dir='$dirE1',cp='$cpE1',estado='$estadoE1',colonia='$coloniaE1',ciudad='$ciudadE1',observaciones='$observacionesE1',logo='$imgLogE1',nombreE='$nombreEE',razonSocialE='$razonSocialEE',rfcE='$rfcEE',dirE='$dirEE',coloniaE='$coloniaEE',cpE='$cpEE',estadoE='$estadoEE',ciudadE='$ciudadEE',telE='$telEE',correo1E='$correo1EE',correo2E='$correo2EE',correo3E='$correo3EE',creditoE='$creditoEE',observacionesE='$observacionesEE' WHERE idCliente='$idClienteE1' ";
	    return ejecutarConsulta($sql); 	
	}

	







}