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
//funcion para quitar ceros
function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}

$(document).ready(function(){
	///funcion para la tabla
	$('.dataTables-example').DataTable({
	pageLength: 25,
	responsive: true,
	dom: '<"html5buttons"B>lTfgitp',
	buttons: [
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
	//para el modal de nuevo
	$("#btncerranuevo").click(function(){	
		$('#nuevoPro').trigger("reset");
		$('#nuevoprodu').modal('hide');
		window.setTimeout('location.reload()');
	});
	
	/**********************************************************************************************/
	/****************************************Facturar por el cliente*************************************/
	$('#nuevoTic').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
		var comercioo = button.data('unoo');
		var accion = 'consultaTecn';
		$.ajax({
			data:{accion,comercioo},
			url:'controlador/ticketsUsuarioControlador.php',
            type:'POST',
			dataType: "json",
            success:function(data){
        		//console.log(data.nombre);
				 $('#botonSoporte').append('<a href="'+data.url+'" target="_blank"><button class="btn btn-primary">Ir al sitio del comercio</button></a> &nbsp;&nbsp;&nbsp; <button type="button" class="btn btn-outline btn-default"><b>'+data.descripcion+'<b></button>');
           }
        });
		
        var modal = $(this);
        modal.find('.modal-body #comer').val(comercioo);
		
  	});

	/**********************************************************************************************/
	/****************************************Subior xml*************************************/
	$('#subir').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
		var comercioo = button.data('unoo');
        var modal = $(this);
        modal.find('.modal-body #idTickets').val(comercioo);
		
	  });
	/**********************************************************************************************/
	/****************************************Elimina ticket*************************************/
	  
	  $('#ModalEliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
		var comercioo = button.data('unoo');
        var modal = $(this);
        modal.find('.modal-body #idTicketsEli').val(comercioo);
		
	  });
	
	/**********************************************************************************************/
	/****************************************Factura massiva*************************************/
	  
	  $("#facma").click(function(){	
		var valor =  $(this).val();
		var mistic =  $('#mistic').val();
		var accion = 'facturaMassi';

		$.ajax({
			data:{accion,valor,mistic},
			url:'controlador/ticketsUsuarioControlador.php',
			type:'POST',
			success: function (response){
                $("#alertAccion").append('<div class="alert alert-warning text-center">Se envió su solicitud.</div>');
                window.setTimeout('location.reload()', 2000);
            },
			
        });
		
	});

	/* para la cnacelacion */
	$('#nuevoTicTer').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var comercioo = button.data('unoo');
		var doss = button.data('doss');

var accion = 'consultaTecn';
$.ajax({
	data:{accion,comercioo},
	url:'controlador/ticketsUsuarioControlador.php',
				type:'POST',
	dataType: "json",
				success:function(data){
				//console.log(data.nombre);
		 $('#botonSoporte').append('<a href="'+data.url+'" target="_blank"><button class="btn btn-primary">Ir al sitio del comercio</button></a> &nbsp;&nbsp;&nbsp; <button type="button" class="btn btn-outline btn-default"><b>'+data.descripcion+'<b></button>');
			 }
		});

		var modal = $(this);
		modal.find('.modal-body #comer').val(comercioo);
		modal.find('.modal-body #idTicketsTer').val(doss);
		

});


	
	
});