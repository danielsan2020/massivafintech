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
Class noticiasWeb{
	//Implementamos nuestro constructor
	public function __construct(){}
	
	/***********************Seccion para guardar los logs*****************************/
        public function accionLogagrega($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','1','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	public function accionLogEdita($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','2','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	public function accionLogElimina($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','3','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	/***********************termina Seccion para guardar los logs*****************************/
	
    /***********************Seccion de clientes por clientes*****************************/
    //consulto informacion de clientes
    public function informacionTabla(){
        $sql="SELECT * FROM tbl_noticiaweb ORDER BY idNoticiaWeb DESC";
		return ejecutarConsulta($sql); 
    }
	
	//agregamos la nueva noticia
	public function nuevaNoticiaWeb($titulo,$noticia,$fecha,$referencia,$nombreFinal,$id_usuario,$fechaAccion,$url){
		$sql = "INSERT INTO tbl_noticiaweb (titulo,noticia,fecha,referencia,url,imagen,usuarioCrea,fechaCrea)VALUES('$titulo','$noticia','$fecha','$referencia','$url','$nombreFinal','$id_usuario','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	
	//obtnemos informacion para edicion
	public function consultaEdita($idNoticiaWeb){
      	$sql = "SELECT * FROM tbl_noticiaweb WHERE idNoticiaWeb = '$idNoticiaWeb'";
        return ejecutarConsultaSimpleFila($sql);
    }
	
	///edicion de noticia web
	public function editarDatos2($idNoticiaWeb1,$titulo1,$noticia1,$fecha1,$referencia1,$url1,$nombreFinal){
		$sql = "UPDATE tbl_noticiaweb SET titulo='$titulo1',noticia='$noticia1',fecha='$fecha1',referencia='$referencia1',url='$url1',imagen='$nombreFinal' WHERE idNoticiaWeb='$idNoticiaWeb1'";
        return ejecutarConsulta($sql); 	
	}
	
	public function editarDatos($idNoticiaWeb1,$titulo1,$noticia1,$fecha1,$referencia1,$url1,$imRefe){
		$sql = "UPDATE tbl_noticiaweb SET titulo='$titulo1',noticia='$noticia1',fecha='$fecha1',referencia='$referencia1',url='$url1',imagen='$imRefe' WHERE idNoticiaWeb='$idNoticiaWeb1'";
        return ejecutarConsulta($sql); 	
	}
	 
	
	public function eliminaNoticia($idNoticiaWeb23){
            $sql = "DELETE FROM tbl_noticiaweb WHERE idNoticiaWeb = '$idNoticiaWeb23'";
        return ejecutarConsulta($sql); 
	}
    
}