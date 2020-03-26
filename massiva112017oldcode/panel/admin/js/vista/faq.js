// JavaScript Document
$(document).ready(function(){
	
/**********************************************************************************************/
/****************************************Carga de la tabla*************************************/
$('.dataTables-example').DataTable({
	pageLength: 25,
	responsive: true,
	dom: '<"html5buttons"B>lTfgitp',
	buttons: [
		{ extend: 'copy'},
		{extend: 'csv'},
		{extend: 'excel', title: 'ExampleFile'},
		{extend: 'pdf', title: 'ExampleFile'},

		{extend: 'print',
			customize: function (win){
				$(win.document.body).addClass('white-bg');
				$(win.document.body).css('font-size', '10px');

				$(win.document.body).find('table')
						.addClass('compact')
						.css('font-size', 'inherit');
		}
		}
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
/****************************************Agregar elemento*************************************/
$("#btnNuevo").click(function(){
		/*obtengo valores*/
		var accion = 'nuevo';
		var nombre = $('#nombre').val();
		var descripcion = $('#descripcion').val();
		
		if(nombre != '' && descripcion != ''){
			
			$.ajax({
				data: {nombre,descripcion,accion},
				url: "controlador/rutaControlador.php",
				type: 'POST',
				success: function (response){
					console.log(response);
					$("#alertAccion").append('<div class="alert alert-success text-center">:: Se ha creado su nueva ruta ::</div>');
					$('#modalNuevo').modal('hide');
					window.setTimeout('location.reload()', 3000);
				},
				error: function(response){
					$("#alertAccion").append('<div class="alert alert-danger text-center">:: Ocurrio un error favor de verificar sus datos ::</div>');
					$('#modalNuevo').modal('hide');
					window.setTimeout('location.reload()', 3000);
				}
			})
			
		}else{
			$('#mensaje').html('<div class="alert alert-danger" role="alert">Favor de verificar los campos requeridos</div>');
		}
		
	});	




	
/**********************************************************************************************/
/****************************************editar elemento*************************************/

	$('#modalEdicion').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('whatever');
		
		$.ajax({
			data:{idenEdita:recipient},
			url:'controlador/rutaControlador.php',
            type:'POST',
			dataType: "json",
            success:function(data){
        		//console.log(data.nombre);
				$('#nombre1').val(data.nombre);
				$('#descripcion1').text(data.descripcion);
           }
        });
        //se abre el modal
        var modal = $(this);
        modal.find('.modal-title').text('Edición de la ruta número:  ' + recipient);
        modal.find('.modal-body #idRuta1').val(recipient);
    });
	
	$("#btnEdita").click(function(){
		/*obtengo valores*/
		var accion = 'editar';
		var nombre1=$('#nombre1').val();
		var descripcion1=$('#descripcion1').val();
		var idRuta1 = $('#idRuta1').val();
		/*metodo ajax*/
		$.ajax({
            data: {accion,nombre1,descripcion1,idRuta1},
            url: "controlador/rutaControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-success text-center">:: Se edito su ruta ::</div>');
				$('#modalEdicion').modal('hide');
				window.setTimeout('location.reload()', 3000);
            },
            error: function(response){
                $("#alertAccion").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
				$('#modalEdicion').modal('hide');
				window.setTimeout('location.reload()', 3000);
            }
        })
		
		
	});
	
//agregamos nueva pregunta
$("#agregarPreg").click(function(){
		/*obtengo valores*/
		var accion = 'nuevaPregunta';
		var pregunta = $('#pregunta').val();
		var respuesta = $('#respuesta').val();
		var area = $('#area').val();
		var estatus = $('#estatus').val();
		
			$.ajax({
				data: {accion,pregunta,respuesta,area,estatus},
				url: "controlador/faqControlador.php",
				type: 'POST',
				success: function (response){
					console.log(response);
					$("#alertAccion").append('<div class="alert alert-success text-center">Se agrego la nueva pregunta</div>');
					$('#nuevo').modal('hide');
					window.setTimeout('location.reload()', 3000);
				},
				error: function(response){
					$("#alertAccion").append('<div class="alert alert-danger text-center">:: Ocurrio un error favor de verificar sus datos ::</div>');
					$('#nuevo').modal('hide');
					window.setTimeout('location.reload()', 3000);
				}
			})

	});	
//cerramos modal
$("#cerrarNueaNot").click(function(){	
    $('#nuevo').modal('hide');
    window.setTimeout('location.reload()');
});
	
//mostramos informacion para la edicion de la pregunta
$('#editar').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget); // Button that triggered the modal
	var idPregunta = button.data('unoo');

	$.ajax({
		data:{idPregunta:idPregunta},
		url:'controlador/faqControlador.php',
		type:'POST',
		dataType: "json",
		success:function(data){
			//console.log(data.nombre);
			$('#pregunta1').val(data.pregunta);
			$('#respuesta1').text(data.respuesta);
			if(data.estatus == 1){
				var esva = 'Activa';
			}else{
				var esva = 'Inactiva';
			}
			$("#area1").append('<option value='+data.area+' selected="selected">'+data.area+'</option>');
			$("#estatus1").append('<option value='+data.estatus+' selected="selected">'+esva+'</option>');
			
	   }
	});
	//se abre el modal
	var modal = $(this);
	modal.find('.modal-body #idPregunta1').val(idPregunta);
});	

//editamos la pregunta	
$("#ediatPree").click(function(){
		/*obtengo valores*/
		var accion = 'edicionPregunta';
		var pregunta1 = $('#pregunta1').val();
		var respuesta1 = $('#respuesta1').val();
		var area1 = $('#area1').val();
		var estatus1 = $('#estatus1').val();
		var idPregunta1 = $('#idPregunta1').val();
		
			$.ajax({
				data: {accion,pregunta1,respuesta1,area1,estatus1,idPregunta1},
				url: "controlador/faqControlador.php",
				type: 'POST',
				success: function (response){
					console.log(response);
					$("#alertAccion").append('<div class="alert alert-success text-center">Se edito su pregunta</div>');
					$('#editar').modal('hide');
					window.setTimeout('location.reload()', 3000);
				},
				error: function(response){
					$("#alertAccion").append('<div class="alert alert-danger text-center">:: Ocurrio un error favor de verificar sus datos ::</div>');
					$('#editar').modal('hide');
					window.setTimeout('location.reload()', 3000);
				}
			})

	});	

	
//para el boton de cerrar en edicion
$("#cerarEditaPr").click(function(){	
    $('#editar').modal('hide');
    window.setTimeout('location.reload()');
});
/**********************************************************************************************/
/****************************************borrar elemento*************************************/
	$("#btnElimina").click(function(){
		/*obtengo valores*/
		var accion = 'eliminar';
		var idPregunta2 = $('#idPregunta2').val();
		/*metodo ajax*/
		$.ajax({
            data: {idPregunta2,accion},
            url: "controlador/faqControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-success text-center">Se elimino la pregunta</div>');
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
 $('#eliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('unooo') 
        var modal = $(this)
        modal.find('.modal-body #idPregunta2').val(recipient)
  });

//boton para cerrar el modal
$("#nbtelim").click(function(){	
    $('#eliminar').modal('hide');
    window.setTimeout('location.reload()');
});
	

	
});