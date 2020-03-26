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
	
	//obtenemos la informacion de la publicacion para editar
	$idBlog1 = ($_POST['idBlog1'] == '')? '' : $_POST['idBlog1']; 

	if($idBlog1 != ''){
		$data=$blog->consultaEdita($idBlog1);
		echo json_encode($data);
	}

	//obtenemos la ifnormacion de los comentarios del blog
	$idBlogUno = ($_POST['idBlogUno'] == '')? '' : $_POST['idBlogUno']; 

	if($idBlogUno != ''){
		$data=$blog->comentariosusuario($idBlogUno);
		echo json_encode($data);
	}

	//valores para la edicion de publicacion
	$titulo1 = ($_POST['titulo1'] == '')? '' : $_POST['titulo1']; 
	$noticia1 = ($_POST['noticia1'] == '')? '' : $_POST['noticia1']; 

	//valor para eliminar
	$idBlog2 = ($_POST['idBlog2'] == '')? '' : $_POST['idBlog2']; 

	//valores para agregar comentario de administrador
	$idBlogCo12 = ($_POST['idBlogCo12'] == '')? '' : $_POST['idBlogCo12']; 
	$ComAdm = ($_POST['ComAdm'] == '')? '' : $_POST['ComAdm']; 


	/****************************Acciones dependiendo de la variable*************************************///
    switch ($accion) {
        case "nuevoBlog":
			$rspta = $blog->insertar($titulo,$noticia,$fechaAccion);
			if($rspta){	
				$rsptaLog = $blog->accionLogagrega($id_usuario,$fechaAccion);
				if($rsptaLog){return true;}	
			}
			else{	return false; }
        break;
			
		
		case "editaBlog":
			$rspta = $blog->edita($titulo1,$noticia1,$idBlog1);
			$rsptaLog = $blog->accionLogEdita($id_usuario,$fechaAccion);
				if($rsptaLog){return true;}	
			else{return false; }
        break;
			
		case "eliminaBlog":
			$rspta = $blog->elimina($idBlog2);
			$rsptaLog = $blog->accionLogElimina($id_usuario,$fechaAccion);
				if($rsptaLog){return true;}	
			else{return false; }
        break;
			
		case "coCliente":
			$rspta = $blog->coCliente($comentarioCliente,$fechaAccion,$idProducto,$id_usuario);
			if($rspta){	
				$rsptaLog = $blog->accionComent($id_usuario,$fechaAccion);
					if($rsptaLog){return true;}	
				else{return false; }
			}
        break;
			
		case "AgregaAdmin":
			$rspta = $blog->agregaComenAdmin($ComAdm,$fechaAccion,$idBlogCo12,$id_usuario);
			if($rspta){	
				$rsptaLog = $blog->comentAdmin($id_usuario,$fechaAccion);
					if($rsptaLog){return true;}	
				else{return false; }
			}
        break;
			
			
			
        
    }

?>