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
$("#btncerrAsingCon").click(function(){	
    $('#contrato').modal('hide');
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
    $('#contrato').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('unoo') 
        var modal = $(this)
        modal.find('.modal-body #idCodigo').val(recipient)
    });
	
	$("#agregarContr").click(function(){
		/*obtengo valores*/
		var accion = 'agregaContra';
		var idCodigo = $('#idCodigo').val();
		var contratof = $('#contratof').val();

		/*metodo ajax*/
		$.ajax({
            data: {accion,idCodigo,contratof},
            url: "controlador/codigoControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-success text-center">Se asigno el contrato al codigo</div>');
                $('#contrato').modal('hide');
				window.setTimeout('location.reload()', 3000);
            },
            error: function(response,status,error){
                $("#alertAccion").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
				$('#agregarContr').modal('hide');
				window.setTimeout('location.reload()', 3000);
            }
        })
		
		
	});
	
/**********************************************************************************************/
/****************************************editar elemento*************************************/	
 	$('#eliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('unoo') 
        var modal = $(this)
        modal.find('.modal-body #idCodigo2').val(recipient)
    });	
	
	$("#btnElimina").click(function(){
		/*obtengo valores*/
		var accion = 'eliminar';
		var idCodigo2 = $('#idCodigo2').val();

		/*metodo ajax*/
		$.ajax({
            data: {accion,idCodigo2},
            url: "controlador/codigoControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-success text-center">Se elimino el codigo</div>');
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
	
	
});