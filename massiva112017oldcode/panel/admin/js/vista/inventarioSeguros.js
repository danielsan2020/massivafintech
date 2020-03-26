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
	
	///para editar
	$("#btnCierraEdita").click(function(){	
		$('#editar').modal('hide');
		window.setTimeout('location.reload()');
	});
	
	//boton para eliminar
	$("#btnEliminaDir").click(function(){	
		$('#ModalEliminar').modal('hide');
		window.setTimeout('location.reload()');
	});
	
	//boton para agregar entradad
	$("#btneditarSeguro").click(function(){	
		$('#editaseguro').modal('hide');
		window.setTimeout('location.reload()');
	});
	
		
	

	/**********************************************************************************************/
	/****************************************agregar seguro*************************************/
	$("#GuardarSeguri").click(function(){

		/*obtengo valores*/

		var accion = 'agreSeguro';
		var rfc = $('#rfc').val();
		var tipo = $('#tipo').val();
		var prima = $('#prima').val();
		var fechaInicio = $('#fechaInicio').val();
		var fechaTermino = $('#fechaTermino').val();
		var numeroPoliza = $('#numeroPoliza').val();
		var metodoPago = $('#metodoPago').val();
		var aseguradora = $('#aseguradora').val();
		var descripcion = $('#descripcion').val();

		$.ajax({
            data: {accion,rfc,tipo,prima,fechaInicio,fechaTermino,numeroPoliza,metodoPago,aseguradora,descripcion},
            url: "controlador/segurosControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-warning text-center">Se agregó tu nuevo seguro. </div>');
				$('#nuevoSeguro').modal('hide');
				window.setTimeout('location.reload()', 3000);
            },
            error: function(response,status,error){
                $("#alertAccion").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
				$('#nuevoSeguro').modal('hide');
				window.setTimeout('location.reload()', 3000);
            }
        })
	});

	
	/**********************************************************************************************/
	/****************************************eliminar*************************************/
	$('#ModalEliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
		var uno = button.data('doos');
        var modal = $(this);
        modal.find('.modal-body #idSeguroEli').val(uno);
		
  	});
	
	///eliminar
	$("#btnElimin").click(function(){
		/*obtengo valores*/
		var accion = 'eliminar';
		var idSeguroEli = $('#idSeguroEli').val();
		/*metodo ajax*/
		$.ajax({
            data: {accion,idSeguroEli},
            url: "controlador/segurosControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-warning text-center">Se eliminó tu seguro.</div>');
				$('#ModalEliminar').modal('hide');
				window.setTimeout('location.reload()', 3000);
            },
            error: function(response,status,error){
                $("#alertAccion").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
				$('#ModalEliminar').modal('hide');
				window.setTimeout('location.reload()', 3000);
            }
        })
		
		
	});


	////seccion para eeditar el seguro
	$('#editaseguro').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('unoo');
		
		$.ajax({
			data:{idenSegurrr:recipient},
			url:'controlador/segurosControlador.php',
            type:'POST',
			dataType: "json",
            success:function(data){
        		//console.log(data.nombre);

     			$('#rfc1').val(data.rfc);
                $('#tipo1').val(data.tipo);
                $('#prima1').val(data.prima);
                $('#fechaInicio1').val(data.fechaInicio);
                $('#fechaTermino1').val(data.fechaTermino);
                $('#numeroPoliza1').val(data.numeroPoliza);
                $("#metodoPago1").append('<option value='+data.metodoPago+' selected="selected">'+data.metodoPago+'</option>');
                $("#aseguradora1").append('<option value='+data.aseguradora+' selected="selected">'+data.aseguradora+'</option>');
                $('#descripcion1').val(data.descripcion);
           }
        });
        //se abre el modal
        var modal = $(this);
        modal.find('.modal-title').text('Editar seguro');
        modal.find('.modal-body #idSeguro1').val(recipient);
    });

	//editamos los valores
	$("#editarSeguro").click(function(){

		/*obtengo valores*/

		var accion = 'editarSeguro';
		var rfc1 = $('#rfc1').val();
		var tipo1 = $('#tipo1').val();
		var prima1 = $('#prima1').val();
		var fechaInicio1 = $('#fechaInicio1').val();
		var fechaTermino1 = $('#fechaTermino1').val();
		var numeroPoliza1 = $('#numeroPoliza1').val();
		var metodoPago1 = $('#metodoPago1').val();
		var aseguradora1 = $('#aseguradora1').val();
		var descripcion1 = $('#descripcion1').val();
		var idSeguroEdita = $('#idSeguro1').val();

		$.ajax({
            data: {accion,rfc1,tipo1,prima1,fechaInicio1,fechaTermino1,numeroPoliza1,metodoPago1,aseguradora1,descripcion1,idSeguroEdita},
            url: "controlador/segurosControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-success text-center">Se agrego su nuevo seguro</div>');
				$('#editaseguro').modal('hide');
				window.setTimeout('location.reload()', 3000);
            },
            error: function(response,status,error){
                $("#alertAccion").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
				$('#editaseguro').modal('hide');
				window.setTimeout('location.reload()', 3000);
            }
        })
	});
	



	
	
});