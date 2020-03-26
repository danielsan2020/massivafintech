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
Class blog{
	//Implementamos nuestro constructor
	public function __construct(){}
	
	/***********************Seccion para guardar los logs*****************************/
    public function accionLogagrega($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','4','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	public function accionLogEdita($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','5','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	public function accionLogElimina($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','6','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	
	//agrego comentario de usuario
	public function accionComent($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','7','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
	
	//agregar comentario administrador
	public function comentAdmin($id_usuario,$fechaAccion){
		$sql = "INSERT INTO tbl_log_acciones (id_usuario,idLogs,fechaCreacion)VALUES('$id_usuario','8','$fechaAccion')";
		return ejecutarConsulta($sql);
	}
    
    /***********************Seccion de clientes por clientes*****************************/
    //consulto informacion de clientes
    public function informacionTabla(){
        $sql="SELECT * FROM tbl_blog ORDER BY idBlog DESC";
		return ejecutarConsulta($sql); 
    }
    
	//agregamos nueva entrada
	public function insertar($titulo,$noticia,$fechaAccion){
        $sql = "INSERT INTO tbl_blog (titulo,noticia,fecha)VALUES('$titulo','$noticia','$fechaAccion')";
		return ejecutarConsulta($sql);
		 
    }
    
	//agregamos comentario de cliente
	public function coCliente($comentarioCliente,$fechaAccion,$idProducto,$id_usuario){
        $sql = "INSERT INTO tbl_blog_comentario (idBlog,pregunta,fechaCreacion,id_usuario)VALUES('$idProducto','$comentarioCliente','$fechaAccion','$id_usuario')";
		return ejecutarConsulta($sql);
		 
    }
	
	//obtenemos los comentarios de los usuarios
	
	public function comentariosusuario($idBlogUno){
		$sql="SELECT TBCO.pregunta,
				TBCO.fechaCreacion,
				TBUS.nombre,
				TBUS.ape_paterno,
				TBUS.ape_materno
				FROM tbl_blog AS TBLO
				LEFT JOIN tbl_blog_comentario AS TBCO ON TBLO.idBlog = TBCO.idBlog
				LEFT JOIN tbl_usuarios AS TBUS ON TBCO.id_usuario = TBUS.id_usuario
				WHERE TBLO.idBlog = $idBlogUno";
		$valor = ejecutarConsulta($sql);
		while($valorFotoInfo = $valor->fetch_object()){ $array[] = $valorFotoInfo; }
		//$valorFotoInfo = $valor->fetch_object();
		return $array;
		
	}
    
	
	///obtenemos la informacion de la noticia para editar
	public function consultaEdita($idBlog1){
      	$sql = "SELECT * FROM tbl_blog WHERE idBlog = $idBlog1";
        return ejecutarConsultaSimpleFila($sql);
    }
	
	//editamos la publicacion
	public function edita($titulo1,$noticia1,$idBlog1){
		$sql = "UPDATE tbl_blog SET titulo='$titulo1',noticia='$noticia1' WHERE idBlog='$idBlog1'";
        return ejecutarConsulta($sql); 
	}
	
	//elimina blog
	public function elimina($idBlog2){
		$sql = "DELETE FROM tbl_blog WHERE idBlog = '$idBlog2'";
        return ejecutarConsulta($sql); 
	}
	
	//agregar comentario de administrador
	public function agregaComenAdmin($ComAdm,$fechaAccion,$idBlogCo12,$id_usuario){
        $sql = "INSERT INTO tbl_blog_comentario (idBlog,pregunta,fechaCreacion,id_usuario,idBlogAdmin)VALUES('$idBlogCo12','$ComAdm','$fechaAccion','$id_usuario','1')";
		return ejecutarConsulta($sql);
		 
    }
	
}