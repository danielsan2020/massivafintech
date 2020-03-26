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
	$("#nuevoActivobtn").click(function(){

		/*obtengo valores*/

		var accion = 'agreAcitvo';
		var fechaCompra = $('#fechaCompra').val();
		var monto = $('#monto').val();
		var tipo = $('#tipo').val();
		var depreciacion = $('#depreciacion').val();
		var descripcion = $('#descripcion').val();

		$.ajax({
            data: {accion,fechaCompra,monto,tipo,depreciacion,descripcion},
            url: "controlador/activosSeguros.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-warning text-center">Se agregó tu nuevo activo.</div>');
				$('#nuevoactivo').modal('hide');
				window.setTimeout('location.reload()', 3000);
            },
            error: function(response,status,error){
                $("#alertAccion").append('<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>');
				$('#nuevoactivo').modal('hide');
				window.setTimeout('location.reload()', 3000);
            }
        })
	});

	///funcion para obtener la depreciacion de activos
	$("#monto").blur(function(){
    	//obtenemlos los valores de los campos necesarios
    	var fechaUno = $('#fechaCompra').val();
    	
		var monto = $('#monto').val();

		if(fechaCompra == '' ){
			alert('Para el cálculo automático de la depreciación recuerda llenar la fecha de compra y el monto');
		}else{
	
	        var values=fechaUno.split("-");
	        var dia = values[2];
	        var mes = values[1];
	        var ano = values[0];

	        var fecha_hoy = new Date();
	        var ahora_ano = fecha_hoy.getYear();
	        var ahora_mes = fecha_hoy.getMonth()+1;
	        var ahora_dia = fecha_hoy.getDate();

	        var edad = (ahora_ano + 1900) - ano;
	        if ( ahora_mes < mes ){ edad--; }
	        if ((mes == ahora_mes) && (ahora_dia < dia)){ edad--; }
	        if (edad > 1900){  edad -= 1900; }

	        var meses=0;
	        if(ahora_mes>mes){ meses=ahora_mes-mes; }

	        if(ahora_mes<mes){ meses=12-(mes-ahora_mes);}

	        if(ahora_mes==mes && dia>ahora_dia){ meses=11; }

	        var dias=0;
	        if(ahora_dia>dia){ dias=ahora_dia-dia; }
	        if(ahora_dia<dia){ 
	        	ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
	            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
	        }
	        //alert("Tienes "+edad+" años, "+meses+" meses y "+dias+" días");
	        //obtenemos los años
	        var ano = edad;
	        var uno = parseInt(edad) * 12;
	        //alert("12 * edad = :"+uno);
	        var dos = parseInt(monto) / parseInt(uno);
			
			if(dos = 'Infinity'){
				dos = 'Procesando';
			}
			
	        $('#depreciacion').val(dos);
	        $('#depreciacionInfo').val(dos);

		}

	});

	
	/**********************************************************************************************/
	/****************************************eliminar*************************************/
	$('#ModalEliminar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
		var uno = button.data('doos');
        var modal = $(this);
        modal.find('.modal-body #idActivioEli').val(uno);
		
  	});
	
	///eliminar
	$("#btnElimina").click(function(){
		/*obtengo valores*/
		var idActivioEli = $('#idActivioEli').val();
		/*metodo ajax*/
		$.ajax({
            data: {idActivioEli},
            url: "controlador/areasTrabajoControlador.php",
            type: 'POST',
            success: function (response){
                $("#alertAccion").append('<div class="alert alert-warning text-center">Se elimino el activo</div>');
				$('#ModalEliminar').modal('hide');
				window.setTimeout('location.reload()', 3000);
            },
            error: function(response,status,error){
                $("#alertAccion").append('<div class="alert alert-warning text-center">Se eliminó el activo.</div>');
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
        modal.find('.modal-title').text('Edición del seguro número:  ' + recipient);
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
                $("#alertAccion").append('<div class="alert alert-warning text-center">Se agrego su nuevo seguro</div>');
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