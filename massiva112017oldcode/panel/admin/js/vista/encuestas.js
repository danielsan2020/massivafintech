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
			{extend: 'excel', title: 'ExampleFile'},
			{extend: 'pdf', title: 'ExampleFile'},
			
			
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
    $('#ModalEliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever') 
        var modal = $(this)
        modal.find('.modal-title').text('Eliminar su cliente numero:  ' + recipient)
        modal.find('.modal-body #idCliente').val(recipient)
    });

    $("#btnElimina").click(function(){
		/*obtengo valores*/
		var accion = 'eliminar';
		var idCliente = $('#idCliente').val();
		/*metodo ajax*/
		$.ajax({
            data: {idCliente,accion},
            url: "controlador/miclientesControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-success text-center">:: Se elimino usuario ::</div>');
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
 



	
/**********************************************************************************************/
/****************************************editar elemento*************************************/

	$('#editaCliente').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('whatever');
		
		$.ajax({
			data:{idenEdita:recipient},
			url:'controlador/miclientesControlador.php',
            type:'POST',
			dataType: "json",
            success:function(data){
        		//console.log(data.nombre);
				$('#nombre1').val(data.nombre);
                $('#apePaterno1').val(data.apePaterno);
                $('#apeMaterno1').val(data.apeMaterno);
                $('#departamento1').val(data.departamento);
                $('#puesto1').val(data.puesto);
                $('#tel11').val(data.tel1);
                $('#tel21').val(data.tel2);
                $('#cel11').val(data.cel1);
                $('#cel21').val(data.cel2);
                $('#mail11').val(data.mail1);
                $('#mail21').val(data.mail2);
                $('#direccion1').val(data.direccion);
                $('#cp1').val(data.cp);
                $('#estado1').val(data.estado);
                $('#colonia1').val(data.colonia);
                $('#ciudad1').val(data.ciudad);
                $('#observaciones1').val(data.observaciones);
                $('#noEmpresa1').val(data.noEmpresa);
                $('#dirEmpresa1').val(data.dirEmpresa);
                $('#coloniaEmpresa1').val(data.coloniaEmpresa);
                $('#cpEmpresa1').val(data.cpEmpresa);
                $('#estadoEmpresa1').val(data.estadoEmpresa);
                $('#ciudadEmpresa1').val(data.ciudadEmpresa);
                $('#tel1Empresa1').val(data.tel1Empresa);
                $('#tel2Empresa1').val(data.tel2Empresa);
                $('#cel1Empresa1').val(data.cel1Empresa);
                $('#cel2Empresa1').val(data.cel2Empresa);
                $('#mail1Empresa1').val(data.mail1Empresa);
                $('#mail2Empresa1').val(data.mail2Empresa);
                $('#mail3Empresa1').val(data.mail3Empresa);
                $('#paginaWeb1').val(data.paginaWeb);
                $('#giroEmpresa1').val(data.giroEmpresa);
                $('#razonSocial1').val(data.razonSocial);
                $('#rfcEmpresa1').val(data.rfcEmpresa);
                $('#observacionesEmpresa1').val(data.observacionesEmpresa);
                $('#tiempoCredito1').val(data.tiempoCredito);
                $("#pais1 option[value='"+data.pais+"']").attr('selected', 'selected');
                $('#estatus1').val(data.estatus);
                
           }
        });
        //se abre el modal
        var modal = $(this);
        modal.find('.modal-title').text('Edición del usuario número:  ' + recipient);
        modal.find('.modal-body #idCliente1').val(recipient);
    });
	
	
	
	
});