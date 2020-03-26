<?php
@session_start();	
	date_default_timezone_set("America/Mexico_City");
    //session_start();
	//error_reporting(E_ALL);
	//ini_set('display_errors','1');

   
    /****************************************************************/
    // FUNCIONES GENERALES PARA EL SITIO                            //
    // CREACION DEL ARCHIVO: 27/08/2018                             //
    // MODIFICA Y/O TRABAJA: Azael HV                               //
    // PROYECTO: http://www.elinnovador.mx/                         //
    /****************************************************************/

    //instanciamos el modelo 
    require_once "../modelo/blogModelo2.php";
    $blog = new blog();

	//*********************Variables generales***************************************//
    $fechaAccion = date("Y-m-d");
    $accion = $_POST['accion'];
	$id_usuario = $_SESSION['id_usuario'];
    
    //**********************valores formulario nuevo****************************//
	$titulo = ($_POST['titulo'] == '')? '' : $_POST['titulo']; 
	$noticia = ($_POST['noticia'] == '')? '' : $_POST['noticia']; 
	//comentario de cliente
	$comentarioCliente = ($_POST['comentarioCliente'] == '')? '' : $_POST['comentarioCliente']; 
	$idProducto = ($_POST['idProducto'] == '')? '' : $_POST['idProducto']; 
	
	//obtenemos los comentarios de los usuarios
	$idBlogUno = ($_POST['idBlogUno'] == '')? '' : $_POST['idBlogUno']; 
	
           
	/****************************Acciones dependiendo de la variable*************************************///
    switch ($accion) {
        case "nuevoBlog":
			$rspta = $blog->insertar($titulo,$noticia,$fechaAccion);
			if($rspta){	return true;	}
			else{	return false; }
        break;
			
		
		case "coCliente":
			$rspta = $blog->coCliente($comentarioCliente,$fechaAccion,$idProducto,$id_usuario);
			if($rspta){	return true;	}
			else{return false; }
        break;
			
			
        
    }

?>