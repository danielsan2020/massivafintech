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
	$("#personal").click(function(){
		$("#subir").prop("disabled", true);
	});
	$("#recibos").click(function(){
		$("#subir").prop("disabled", false);
		
	});
	$("#constancia").click(function(){
		$("#subir").prop("disabled", false);
		
	});
	$("#contrato").click(function(){
		$("#subir").prop("disabled", false);
		
	});
	
	
	
	
	
	
});