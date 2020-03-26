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
Class tsoporte{
	//Implementamos nuestro constructor
	public function __construct(){}
	//acciones para guardar los logs
    public function accionLogagrega($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','32','$fechaAccion')";
        return ejecutarConsulta($sql);
    }
    //funcion para log de terminar el ticket
    public function accionLogTermina($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','34','$fechaAccion')";
        return ejecutarConsulta($sql);
    }
    //funcion para log de calificacion
    public function accionLogCalifi($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','35','$fechaAccion')";
        return ejecutarConsulta($sql);
    }
     //funcion para log de comentario de cliente
    public function accionLogComeClie($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','33','$fechaAccion')";
        return ejecutarConsulta($sql);
    }
     //funcion para log de comentario de admin
    public function accionLogComeAdmin($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','36','$fechaAccion')";
        return ejecutarConsulta($sql);
    }
     //funcion para log de terminar el ticket
    public function accionLogTerminaAdmin($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','37','$fechaAccion')";
        return ejecutarConsulta($sql);
    }

    
    //inserto nuevo ticket de soporte
    public function insertar($id_usuario_reporta,$id_categoria_ticket,$titulo,$descripcion,$estatus,$usuarioSe,$fechaAccion){
        $sql = "INSERT INTO tbl_ticket_contable 
		(id_usuario_reporta,id_categoria_ticket,titulo,descripcion,estatus,fechaCreacion,usuarioCreacion,area)
		VALUES('$id_usuario_reporta','$id_categoria_ticket','$titulo','$descripcion','$estatus','$fechaAccion','$usuarioSe','2')";
		return ejecutarConsulta_retornarID($sql);
    }

    //funcion apra terminar el ticket
    public function terminar($idTermina,$califincal){
    	$sql = "UPDATE tbl_ticket_contable SET estatus='2',calificacion='".$califincal."' WHERE id_soporte='$idTermina'";
    	return ejecutarConsulta($sql);
    }
    
	//agregamos comentario de cliente
	public function comeClien($comenCli,$ideTiUS,$id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_ticket_contable_respuesta 
		(id_soporte,id_usuario_escribe,respuesta,tipo,fechaCrea)
		VALUES('$ideTiUS','$id_usuario','$comenCli','cliente','$fechaAccion')";
		return ejecutarConsulta_retornarID($sql);
    }

    //agregamos comentario de administrador
    public function nuevoComAd($idsoporteComen,$comentarioAdmin,$id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_ticket_contable_respuesta 
        (id_soporte,id_usuario_escribe,respuesta,tipo,fechaCrea)
        VALUES('$idsoporteComen','$id_usuario','$comentarioAdmin','soporte','$fechaAccion')";
        return ejecutarConsulta_retornarID($sql);
    }

    //obtenemos los comentarios del ticket
    public function consultaCome($recipient){
        $sql= "SELECT * FROM tbl_ticket_contable_respuesta WHERE id_soporte = $recipient";
        $valor = ejecutarConsulta($sql);
        while($valorFotoInfo = $valor->fetch_object()){ $array[] = $valorFotoInfo; }
        //$valorFotoInfo = $valor->fetch_object();
        return $array;

        /*//return ejecutarConsulta($sql); 
        $valor = ejecutarConsulta($sql);
        $valorFotoInfo = $valor->fetch_object();
        
        return $valorFotoInfo;*/
    }    

    //funcion apra terminar el ticket admin
    public function terminarAdmin($idTerminaADmin){
        $sql = "UPDATE tbl_ticket_contable SET estatus='2',calificacion='0' WHERE id_soporte='$idTerminaADmin'";
        return ejecutarConsulta($sql);
    }

    //agregamos movimientos a el contador de consultas
    public function sumacontador($id_usuario,$fechaAccion){
        $sql = "INSERT INTO tbl_contadorcontable (id_usuario,numero,fecha) VALUES('$id_usuario','1','$fechaAccion')";
        return ejecutarConsulta_retornarID($sql);
    }
       
    //actualizamos el contador de la consultas contables
    public function actualizacontador($id_usuario,$fechaAccion,$conteo){
        $sql = "UPDATE tbl_contadorcontable SET numero='$conteo',fecha='fechaAccion' WHERE id_usuario='$id_usuario'";
        return ejecutarConsulta($sql);
    }
        		
}