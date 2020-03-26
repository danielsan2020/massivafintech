<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES GENERALES                          //
// CREACION DEL ARCHIVO: 15/10/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: Ruta                                               //
/****************************************************************/

require_once "Conexion.php";

Class faqPr{
	
	/***********************Seccion para guardar los logs*****************************/
    public function accionLogagrega($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$usuarioSe','9','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	public function accionLogEdita($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (usuarioSe,idLogs,fechaCreacion)VALUES('$usuarioSe','10','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	public function accionLogElimina($usuarioSe,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (usuarioSe,idLogs,fechaCreacion)VALUES('$usuarioSe','11','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	
	//Implementamos nuestro constructor
	public function __construct(){}
    
    //informacion para la datatable
    public function informacionTabla(){
        $sql="SELECT * FROM cat_preguntas ORDER BY idPregunta ASC";
		return ejecutarConsulta($sql); 
    }
	
	//obtenemos las informacion de las preguntas con el buscador
	public function informacionTablaBus($busfaq){
        $sql="SELECT * FROM cat_preguntas WHERE pregunta LIKE '%$busfaq%' ORDER BY idPregunta DESC";
		return ejecutarConsulta($sql); 
    }
	
	
	//agregamos nueva pregunta
	public function nuevaPregunta($pregunta,$respuesta,$area,$estatus,$usuarioSe,$fechaAccion){
		$sql = "INSERT INTO cat_preguntas (pregunta,respuesta,area,usuarioCreacion,fechaCreacion,estatus)VALUES('$pregunta','$respuesta','$area','$usuarioSe','$fechaAccion','$estatus')";
		return ejecutarConsulta($sql);
	}
	
	//obtenemos valores para la edicion de la noticia
    public function consultaEdita($idPregunta){
        $sql = "SELECT * FROM cat_preguntas WHERE idPregunta = '$idPregunta'";
        return ejecutarConsultaSimpleFila($sql);
		
    }
	
	//edicion de pregunta
	public function edicionPregunta($pregunta1,$respuesta1,$area1,$estatus1,$idPregunta1){
		 $sql = "UPDATE cat_preguntas SET pregunta='".$pregunta1."',respuesta='".$respuesta1."',area='".$area1."',estatus='".$estatus1."' WHERE idPregunta='$idPregunta1'";
        //ejecutamos la consulta
        return ejecutarConsulta($sql);
	}
	
	//eliminacion de pregunta
    public function eliminar($idPregunta2){
        $sql = "DELETE FROM cat_preguntas WHERE idPregunta = '$idPregunta2'";
        return ejecutarConsulta($sql); 
    }
	
	

}