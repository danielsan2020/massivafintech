<?php
/****************************************************************/
// MODELO PARA LAS FUNCIONES GENERALES                          //
// CREACION DEL ARCHIVO: 15/10/2018                             //
// MODIFICA Y/O TRABAJA: Azael HV                               //
// PROYECTO: massiva                                            //
// AUTOR: Hevasoft.com                                          //
// PROPIETARIO: Massiva.mx                                      //
/****************************************************************/
require_once "modelo/Conexion.php";
Class blogMo{
	//Implementamos nuestro constructor
	public function __construct(){}
    
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
	
	//obtengo la noticia individual
	public function obtengoBlogInd($idBlog){
        $sql="SELECT * FROM tbl_blog WHERE idBlog = $idBlog";
		return ejecutarConsulta($sql); 
    }
	
	//agrego nueva vista a
	public function agregavista($valor,$idBlog){
		$sql="SELECT * FROM tbl_blog WHERE idBlog = $idBlog";
		$val = ejecutarConsulta($sql); 
		$valInfo = $val->fetch_object();
		$uno = $valInfo->vistas;
		$dos = $valor+ $uno;
		
		$sql2 = "UPDATE tbl_blog SET vistas='$dos' WHERE idBlog='$idBlog'";
		return ejecutarConsulta($sql2); 
    }
	
	//obtengo el comentario del cliente
	public function Comentario($idBlog){
        $sql="SELECT TBC.*,
		TBU.usuario
		FROM tbl_blog_comentario as TBC 
		LEFT JOIN tbl_usuarios AS TBU On TBC.id_usuario = TBU.id_usuario
		WHERE idBlog = $idBlog AND idBlogAdmin IS NULL
		";
		return ejecutarConsulta($sql); 
    }
	public function cantidadComen($idBlog){
        $sql="SELECT count(*) as cantidad
			FROM tbl_blog_comentario
			WHERE idBlog = $idBlog";
		return ejecutarConsulta($sql); 
    }
	
	//obtenemos los comentarios de administrador
	public function ComentarioADmin($busAdmin){
        $sql="SELECT * FROM tbl_blog_comentario WHERE idBlog = $busAdmin AND idBlogAdmin = 1";
		return ejecutarConsulta($sql); 
    }
	
    
}