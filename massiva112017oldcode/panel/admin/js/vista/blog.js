//funcion para los numeros
function NumCheck(e, field) {
  key = e.keyCode ? e.keyCode : e.which
  // backspace
  if (key == 8) return true
  // 0-9
  if (key > 47 && key < 58) {
    if (field.value == "") return true
    regexp = /.[0-9]{5}$/
    return !(regexp.test(field.value))
  }
  // .
  if (key == 46) {
    if (field.value == "") return false
    regexp = /^[0-9]+$/
    return regexp.test(field.value)
  }
  // other key
  return false
 
}
//funcion para letras
function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
$(document).ready(function(){
/**********************************************************************************************/
/****************************************Seccion para el data table*************************************/
    $('.dataTables-example').DataTable({
		pageLength: 25,
		responsive: true,
		dom: '<"html5buttons"B>lTfgitp',
		buttons: [
			{extend: 'pdf', title: 'ExampleFile'},
			{extend: 'csv'},
			
		],
		 language: {
		processing:     "Procesando...",
		search:         "Buscar:",
		lengthMenu:     "Mostrar: _MENU_ elementos",
		info:           "Mostrando _START_ a _END_ de _TOTAL_ resultados",
		infoEmpty:      "Elemento 0 de 0 elementos encontrados",
		infoFiltered:   "(elementos filtrado _MAX_ de elementos maximos )",
		infoPostFix:    "",
		loadingRecords: "Cambios en Curso...",
		zeroRecords:    "No se encuentran elementos.",
		emptyTable:     "Tabla no disponible",
		paginate: {
			first:      "Adelante",
			previous:   "Anterior",
			next:       "Siguiente",
			last:       "Atrás"
		}

	}

	});
	
/**********************************************************************************************/
/****************************************Botones para cerrar los modals*************************************/
$("#btncerranuevo").click(function(){	
    $('#formularioGeneralNuevo').trigger("reset");
    $('#nuevoClienteC').modal('hide');
    window.setTimeout('location.reload()');
});
	
//para eliminar el elemento
$("#nbtelim").click(function(){	
    $('#eliminar').modal('hide');
    window.setTimeout('location.reload()');
});

//para la edicion
$("#editaBlog").click(function(){	
    $('#editar').modal('hide');
    window.setTimeout('location.reload()');
});

/**********************************************************************************************/
/****************************************borrar elemento*************************************/
    $('#eliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('unoo') 
        var modal = $(this)
        modal.find('.modal-body #idBlog2').val(recipient)
    });
	
	$("#btnElimina").click(function(){
		/*obtengo valores*/
		var accion = 'eliminaBlog';
		var idBlog2 = $('#idBlog2').val();
		/*metodo ajax*/
		$.ajax({
            data: {accion,idBlog2},
            url: "controlador/blogControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-success text-center">Se elimino su publicación</div>');
				$('#eliminar').modal('hide');
				window.setTimeout('location.reload()', 3000);
            },
            error: function(response,status,error){
                $("#alertAccion").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
				$('#eliminar').modal('hide');
				window.setTimeout('location.reload()', 3000);
            }
        })
		
		
	});
	
/**********************************************************************************************/
/****************************************editar elemento*************************************/	
	//editamos la noticia
	$('#editar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('unoo') 
        var modal = $(this)
		
		$.ajax({
			 data:{idBlog1:recipient},
			url: "controlador/blogControlador.php", //url de donde obtener los datos
			dataType: 'json', //tipo de datos retornados
			type: 'post' //enviar variables como post
		  }).done(function (data){
			  var json_string = JSON.stringify(data);
			  var obj = $.parseJSON(json_string);

				 $('#titulo1').val(obj.titulo);
				 $('#noticia1').html(obj.noticia);
			  
			});

		
        modal.find('.modal-body #idBlog1').val(recipient)
    });
	//editamos la publicacion
	$("#editaPublica").click(function(){
		/*obtengo valores*/
		var accion = 'editaBlog';
		var titulo1 = $('#titulo1').val();
		var noticia1 = $('#noticia1').val();
		var idBlog1 = $('#idBlog1').val();
		/*metodo ajax*/
		$.ajax({
            data: {accion,titulo1,noticia1,idBlog1},
            url: "controlador/blogControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-success text-center">Se edito su publicación</div>');
				$('#editar').modal('hide');
				window.setTimeout('location.reload()', 3000);
            },
            error: function(response,status,error){
                $("#alertAccion").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
				$('#editar').modal('hide');
				window.setTimeout('location.reload()', 3000);
            }
        })
		
		
	});
	
	
/**********************************************************************************************/
/****************************************agregar elemento*************************************/		
		
	//agregar nueva publicacion
	$("#apubli").click(function(){
		/*obtengo valores*/
		var accion = 'nuevoBlog';
		var titulo = $('#titulo').val();
		var noticia = $('#noticia').val();
		/*metodo ajax*/
		$.ajax({
            data: {accion,titulo,noticia},
            url: "controlador/blogControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-success text-center">Se agrego su nueva entrada</div>');
				$('#nuevaPubli').modal('hide');
				window.setTimeout('location.reload()', 3000);
            },
            error: function(response,status,error){
                $("#alertAccion").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
				$('#nuevaPubli').modal('hide');
				window.setTimeout('location.reload()', 3000);
            }
        })
		
		
	});
	
/**********************************************************************************************/
/****************************************editar elemento*************************************/		
	//agregamos comentario por parte del cliente
	$("#AgregaComenCli").click(function(){
		/*obtengo valores*/
		var accion = 'coCliente';
		var comentarioCliente = $('#comentarioCliente').val();
		var idProducto = $('#idProducto').val();
		
		/*metodo ajax*/
		$.ajax({
            data: {accion,comentarioCliente,idProducto},
            url: "controlador/blogControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-success text-center">Gracias por su comentario, en breve nos comunicaremos con usted</div>');
				window.setTimeout('location.reload()', 5000);
            },
            error: function(response,status,error){
                $("#alertAccion").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
				window.setTimeout('location.reload()', 5000);
            }
        })
		
		
	});
	
	//agregamos el comentario de administrador
	$("#AgregaComenAdmin").click(function(){
		/*obtengo valores*/
		alert('si agrega el comentario de administrador');
		var idencomenclient = $('#comentarioCliente').val();
		var nomCom = 'comentar';
		//obtenemos los valores
		var comentarioCliente = $('#comentarioCliente').val();
		var idProducto = $('#idProducto').val();
		
		
		$.ajax({
            data: {accion,comentarioCliente,idProducto},
            url: "controlador/blogControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-success text-center">:: Se agrego su nueva entrada ::</div>');
				window.setTimeout('location.reload()', 5000);
            },
            error: function(response,status,error){
                $("#alertAccion").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
				window.setTimeout('location.reload()', 5000);
            }
        })
		
		
	});
	
	//agregar comentario de usuario
	$("#ageCoAdmin").click(function(){
		/*obtengo valores*/
		var idBlogCo12 = $('#idBlogCo12').val();
		var ComAdm = $('#ComAdm').val();
		//obtenemos los valores
		var accion = 'AgregaAdmin';
		
		$.ajax({
            data: {accion,idBlogCo12,ComAdm},
            url: "controlador/blogControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertsss").append('<div class="alert alert-success text-center">Nuevo comentario de administrador</div>');
				window.setTimeout('location.reload()', 5000);
            },
            error: function(response,status,error){
                $("#alertsss").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
				window.setTimeout('location.reload()', 5000);
            }
        })
		
		
	});
	

	//accion para el modal de contestar el comentario
	$('#idBlogComen').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('whatever');
        var modal = $(this);
        modal.find('.modal-body #idBlogCo12').val(recipient);
    });
	
	////obtenemos los comentarios para usuarios
	$('#comentariosu').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
        var idBlogUno = button.data('unoo');
        var modal = $(this);

		$.ajax({
            data: {idBlogUno},
            url: "controlador/blogControlador.php",
            type: 'POST',
            success: function (response){
               var valores = JSON.parse(response);
                console.log(valores);
				//primer bloque de la tabla
				var contenido = "<div class='table-responsive'>"+
				"<table class='table table-striped table-bordered table-hover dataTables-example'>"+
							"<thead>"+
								"<tr>"+
									"<th>Comentario</th>"+
									"<th>Usuario</th>"+
									"<th>Fecha creación</th>"+
								"</tr>"+
							"</thead>"+
					
							"<tbody>";
				
							$.each(valores, function(){

								contenido +="<tr>"+
									
									"<td>"+this.pregunta+"</td>"+
									"<td>"+this.nombre+" "+this.ape_paterno+" "+this.ape_materno+"</td>"+
									"<td>"+this.fechaCreacion+"</td>"+
								"</tr>";
							});

							contenido +="</tbody>"+
									"</table>"+
									"</div>";
				
				$("#tablaComenU").html(contenido);
				
            },
            error: function(response,status,error){
               alert('error en encontrar lso datos');
            }
        })
		
        
    });
	
	//obtenemos los comentarios de los administrador
	$('#comentariosA').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
        var idBlogUno = button.data('unoo');
        var modal = $(this);

		$.ajax({
            data: {idBlogUno},
            url: "controlador/blogControlador.php",
            type: 'POST',
            success: function (response){
               var valores = JSON.parse(response);
                console.log(valores);
				//primer bloque de la tabla
				var contenido = "<div class='table-responsive'>"+
				"<table class='table table-striped table-bordered table-hover dataTables-example'>"+
							"<thead>"+
								"<tr>"+
									"<th>Comentario</th>"+
									"<th>Usuario</th>"+
									"<th>Fecha creación</th>"+
								"</tr>"+
							"</thead>"+
					
							"<tbody>";
				
							$.each(valores, function(){

								contenido +="<tr>"+
									
									"<td>"+this.pregunta+"</td>"+
									"<td>"+this.nombre+" "+this.ape_paterno+" "+this.ape_materno+"</td>"+
									"<td>"+this.fechaCreacion+"</td>"+
								"</tr>";
							});

							contenido +="</tbody>"+
									"</table>"+
									"</div>";
				
				$("#tablaComenU").html(contenido);
            },
            error: function(response,status,error){
               alert('error en encontrar lso datos');
            }
        })
		
        
    });
	
	
	
});