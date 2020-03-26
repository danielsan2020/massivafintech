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
	/****************************************Botones para cerrar los modals*************************************/
	$("#btncerranuevo").click(function(){	
		$('#formularioGeneralNuevo').trigger("reset");
		$('#nuevoClienteC').modal('hide');
		window.setTimeout('location.reload()');
	});
	
	$("#btnEliminar").click(function(){	
		$('#ModalEliminar').modal('hide');
		window.setTimeout('location.reload()');
	});
	
	$("#editcerr").click(function(){	
		$('#editar').modal('hide');
		window.setTimeout('location.reload()');
	});

	/**********************************************************************************************/
	/****************************************editar*************************************/
	$('#editar').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
        var unocvl = button.data('uno');
		var doscvl = button.data('dos');
		var modal = $(this);
		
		 $.ajax({
			 data:{idNoticiaWeb:unocvl},
			url: "controlador/noticiasWeb2.php", //url de donde obtener los datos
			dataType: 'json', //tipo de datos retornados
			type: 'post' //enviar variables como post
		  }).done(function (data){
			  var json_string = JSON.stringify(data);
			  var obj = $.parseJSON(json_string);

				 $('#titulo1').val(obj.titulo);
				 $('#noticia1').val(obj.noticia);
				 $('#fecha1').val(obj.fecha);
				 $('#referencia1').val(obj.referencia);
				 $('#url1').val(obj.url);
			  
			});

        modal.find('.modal-body #idNoticiaWeb1').val(unocvl);
		modal.find('.modal-body #imRefe').val(doscvl);
		
    });
	
	/**********************************************************************************************/
	/****************************************eliminar*************************************/
	$('#eliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        
		var unoo = button.data('unoo');
		var doscs = button.data('doss');
        var modal = $(this);
		
        modal.find('.modal-title').text('Eliminar la noticia numero:  ' + unoo)
        modal.find('.modal-body #idNoticiaWeb23').val(unoo);
		modal.find('.modal-body #imRefe2').val(doscs);
  	});
	
	$("#btnElimina").click(function(){
		/*obtengo valores*/
		var modal = $(this);
		var accion = 'eliminar';
		var idNoticiaWeb23 = $('#idNoticiaWeb23').val();
		var imRefe2 = $('#imRefe2').val();
		 
		/*metodo ajax*/
		$.ajax({
            data: {idNoticiaWeb23,accion,imRefe2},
            url: "controlador/noticiasWeb2.php",
            type: 'POST',
            success: function (response){
                $('#eliminar').modal('hide');
				$("#alertAccion").append('<div class="alert alert-success text-center">Se elimino su noticia</div>');
				window.setTimeout('location.reload()', 3000);
            },
            error: function(response,status,error){
                $("#alertAccion").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
				$('#eliminar').modal('hide');
				window.setTimeout('location.reload()', 3000);
            }
        })
		
		
	});
 
	
	
});