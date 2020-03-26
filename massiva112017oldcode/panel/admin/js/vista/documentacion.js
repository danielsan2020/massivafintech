//funcion para los numeros
function NumCheck(e, field) {
  key = e.keyCode ? e.keyCode : e.which
  // backspace
  if (key == 12) return true
  // 0-9
  if (key > 47 && key < 58) {
    if (field.value == "") return true
    regexp = /.[0-9]{16}$/
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
//cerramoe el modal de eliminar documentacion
$("#btnTern").click(function(){	
    $('#eliminar').modal('hide');
    window.setTimeout('location.reload()');
});
$("#btnEliminar").click(function(){	
    $('#ModalEliminar').modal('hide');
    window.setTimeout('location.reload()');
});
$("#btncerraeditar").click(function(){	
    $('#editaCliente').modal('hide');
    window.setTimeout('location.reload()');
});

/**********************************************************************************************/
/****************************************borrar elemento*************************************/

	//agregar nueva publicacion
	$('#eliminar').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
        var uno = button.data('unoo');
		var dos = button.data('doss');
		var modal = $(this);
        modal.find('.modal-body #idDocumentacion').val(uno);
		modal.find('.modal-body #tipo').val(dos);
		
    });



/*********************************************************************************************************/
/****************************************funciones borrar el documento*************************************/
	//funcion para guardar la tarketas de credito
	$("#borraArchivo").click(function(){
		//obtenemos valores
		var idDocumentacion = $('#idDocumentacion').val();
		var tipo = $('#tipo').val();
		var accion = 'elimina';

		//en caso de que los datos de la tarjeta secundaria este llenos 
		$.ajax({
            data: {idDocumentacion,tipo,accion},
            url: "controlador/documentacionControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-warning text-center">Se elimino el archivo seleccionado</div>');
                $('#eliminar').modal('hide');
                window.setTimeout('location.reload()', 3000);
            },
            error: function(response,status,error){
                $("#alertAccion").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
                $('#calculadoraDos').modal('hide');
            }
        })
		
	});

	//funcion para el boton de seguir
	$("#btnSig").click(function(){
		var Idncamos = $('#Idncamos').val();
		$.ajax({
            data: {Idncamos},
            url: "controlador/preregistroControlador.php",
            type: 'POST',
            success: function (response){
                window.location.href = "preregistro6.php";

            },
            error: function(response,status,error){
                $("#alertAccion").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
                $('#calculadoraDos').modal('hide');
				
            }
        })
		
	});

	//funcion para pasar de 6 a 7
	$("#pasasrsiete").click(function(){
		var aviPri = $('#aviPri:checked').val();
		var idRefe = $('#idRefe').val();
			
			if(aviPri == 1){
				$.ajax({
	            data: {idRefe},
	            url: "controlador/preregistroControlador.php",
	            type: 'POST',
	            success: function (response){
	                window.location.href = "preregistro7.php";

	            },
	            error: function(response,status,error){
	                $("#alertAccion").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
	                $('#calculadoraDos').modal('hide');
					
	            }
	        })
		}else{
			$("#alertAccion").append('<div class="alert alert-danger text-center">Lee y acepta el Aviso de Privacidad.</div>');
		}
		
		
	});
	/*********************************************************************************************************/
	/****************************************funciones para acciones finales*************************************/
	$("#btnSeguirFinalSanear").click(function(){
		var idSaneRef = $('#idSaneRef').val();
		$.ajax({
            data: {idSaneRef},
            url: "controlador/preregistroControlador.php",
            type: 'POST',
            success: function (response){
                window.location.href = "../index.php";

            },
            error: function(response,status,error){
            	window.location.href = "index.php";
            }
        })
		
	});
	
	
	
	
	
	
	
});