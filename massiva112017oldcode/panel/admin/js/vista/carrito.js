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
	$("#ifacturas").click(function(){
		$("#facturas").css("display", "block");
		$("#nomina").css("display", "none");
		$("#ticket").css("display", "none");
		$("#actualizaciones").css("display", "none");
		$("#otros").css("display", "none");
	
	});
	
	$("#inomina").click(function(){
		$("#facturas").css("display", "none");
		$("#nomina").css("display", "block");
		$("#ticket").css("display", "none");
		$("#actualizaciones").css("display", "none");
		$("#otros").css("display", "none");
	
	});
	$("#iticket").click(function(){
		$("#facturas").css("display", "none");
		$("#nomina").css("display", "none");
		$("#ticket").css("display", "block");
		$("#actualizaciones").css("display", "none");
		$("#otros").css("display", "none");
	
	});
	$("#iactualizaciones").click(function(){
		$("#facturas").css("display", "none");
		$("#nomina").css("display", "none");
		$("#ticket").css("display", "none");
		$("#actualizaciones").css("display", "block");
		$("#otros").css("display", "none");
	
	});
	$("#iotros").click(function(){
		$("#facturas").css("display", "none");
		$("#nomina").css("display", "none");
		$("#ticket").css("display", "none");
		$("#actualizaciones").css("display", "none");
		$("#otros").css("display", "block");
	
	});

	$("#iTodos").click(function(){
		$("#facturas").css("display", "block");
		$("#nomina").css("display", "block");
		$("#ticket").css("display", "block");
		$("#actualizaciones").css("display", "block");
		$("#otros").css("display", "block");
	
	});

	//seccion de facturas
	$("#f1B").click(function(){
		var valor = $('#f1v').val();
		if(valor == 1){
			$("#f1B").css('background-color', '');
			$('#f1v').val('');
		}else{
			$('#f1v').val('1');
			$("#f1B").css('background-color', '#5b5b5f');
		}
    });

    $("#f2B").click(function(){
		var valor = $('#f2v').val();
		if(valor == 1){
			$("#f2B").css('background-color', '');
			$('#f2v').val('');
		}else{
			$('#f2v').val('1');
			$("#f2B").css('background-color', '#5b5b5f');
		}
    });

    $("#f3B").click(function(){
		var valor = $('#f3v').val();
		if(valor == 1){
			$("#f3B").css('background-color', '');
			$('#f3v').val('');
		}else{
			$('#f3v').val('1');
			$("#f3B").css('background-color', '#5b5b5f');
		}
    });

    $("#f4B").click(function(){
		var valor = $('#f4v').val();
		if(valor == 1){
			$("#f4B").css('background-color', '');
			$('#f4v').val('');
		}else{
			$('#f4v').val('1');
			$("#f4B").css('background-color', '#5b5b5f');
		}
    });
        
	//seccion de tickets
	$("#t1B").click(function(){
		var valor = $('#t1v').val();

		if(valor == 1){
			$("#t1B").css('background-color', '');
			$('#t1v').val('');
		}else{
			$('#t1v').val('1');
			$("#t1B").css('background-color', '#5b5b5f');
		}
    });

    $("#t2B").click(function(){
		var valor = $('#t2v').val();
		if(valor == 1){
			$("#t2B").css('background-color', '');
			$('#t2v').val('');
		}else{
			$('#t2v').val('1');
			$("#t2B").css('background-color', '#5b5b5f');
		}
    });

    $("#t3B").click(function(){
		var valor = $('#t3v').val();
		if(valor == 1){
			$("#t3B").css('background-color', '');
			$('#t3v').val('');
		}else{
			$('#t3v').val('1');
			$("#t3B").css('background-color', '#5b5b5f');
		}
    });

    $("#t4B").click(function(){
		var valor = $('#t4v').val();
		if(valor == 1){
			$("#t4B").css('background-color', '');
			$('#t4v').val('');
		}else{
			$('#t4v').val('1');
			$("#t4B").css('background-color', '#5b5b5f');
		}
    });

    //seccion de actualizaciones
    $("#a1B").click(function(){
		var valor = $('#a1v').val();
		if(valor == 1){
			$("#a1B").css('background-color', '');
			$('#a1v').val('');
		}else{
			$('#a1v').val('1');
			$("#a1B").css('background-color', '#5b5b5f');
		}
    });

    $("#a2B").click(function(){
		var valor = $('#a2v').val();
		if(valor == 1){
			$("#a2B").css('background-color', '');
			$('#a2v').val('');
		}else{
			$('#a2v').val('1');
			$("#a2B").css('background-color', '#5b5b5f');
		}
    });

    $("#a3B").click(function(){
		var valor = $('#a3v').val();
		if(valor == 1){
			$("#a3B").css('background-color', '');
			$('#a3v').val('');
		}else{
			$('#a3v').val('1');
			$("#a3B").css('background-color', '#5b5b5f');
		}
    });

    $("#a4B").click(function(){
		var valor = $('#a4v').val();
		if(valor == 1){
			$("#a4B").css('background-color', '');
			$('#a4v').val('');
		}else{
			$('#a4v').val('1');
			$("#a4B").css('background-color', '#5b5b5f');
		}
    });

    $("#a5B").click(function(){
		var valor = $('#a5v').val();
		if(valor == 1){
			$("#a5B").css('background-color', '');
			$('#a5v').val('');
		}else{
			$('#a5v').val('1');
			$("#a5B").css('background-color', '#5b5b5f');
		}
    });

    $("#a6B").click(function(){
		var valor = $('#a6v').val();
		if(valor == 1){
			$("#a6B").css('background-color', '');
			$('#a6v').val('');
		}else{
			$('#a6v').val('1');
			$("#a6B").css('background-color', '#5b5b5f');
		}
    });

    $("#realizaCompra").click(function(){
		var f1v = $('#f1v').val();
		var f2v = $('#f2v').val();
		var f3v = $('#f3v').val();
		var f4v = $('#f4v').val();
		var t1v = $('#t1v').val();
		var t2v = $('#t2v').val();
		var t3v = $('#t3v').val();
		var t4v = $('#t4v').val();
		var a1v = $('#a1v').val();
		var a2v = $('#a2v').val();
		var a3v = $('#a3v').val();
		var a4v = $('#a4v').val();
		var a5v = $('#a5v').val();
		var a6v = $('#a6v').val();

		
		if(f1v == 1){
			var paquete1 = $('#paquete1').val();
			var facturas1 = $('#facturas1').val();
			var costo1 = $('#costo1').val();
		}else{ 
			var paquete1 = 0;
			var facturas1 = 0;
			var costo1 = 0;
		}
		
		if(f2v == 1){
			var paquete2 = $('#paquete2').val();
			var facturas2 = $('#facturas2').val();
			var costo2 = $('#costo2').val();
		}else{ 
			var paquete2 = 0;
			var facturas2 = 0;
			var costo2 = 0;
		}

		if(f3v == 1){
			var paquete3 = $('#paquete3').val();
			var facturas3 = $('#facturas3').val();
			var costo3 = $('#costo3').val();
		}else{ 
			var paquete3 = 0;
			var facturas3 = 0;
			var costo3 = 0;
		}

		if(f4v == 1){
			var paquete4 = $('#paquete4').val();
			var facturas4 = $('#facturas4').val();
			var costo4 = $('#costo4').val();
		}else{ 
			var paquete4 = 0;
			var facturas4 = 0;
			var costo4 = 0;
		}

		//tickets

		if(t1v == 1){
			var paquetet1 = $('#paquetet1').val();
			var ticketst1 = $('#ticketst1').val();
			var costot1 = $('#costot1').val();
		}else{ 
			var paquetet1 = 0;
			var ticketst1 = 0;
			var costot1 = 0;
		}

		if(t2v == 1){
			var paquetet2 = $('#paquetet2').val();
			var ticketst2 = $('#ticketst2').val();
			var costot2 = $('#costot2').val();
		}else{ 
			var paquetet2 = 0;
			var ticketst2 = 0;
			var costot2 = 0;
		}

		if(t3v == 1){
			var paquetet3 = $('#paquetet3').val();
			var ticketst3 = $('#ticketst3').val();
			var costot3 = $('#costot3').val();
		}else{ 
			var paquetet3 = 0;
			var ticketst3 = 0;
			var costot3 = 0;
		}

		if(t4v == 1){
			var paquetet4 = $('#paquetet4').val();
			var ticketst4 = $('#ticketst4').val();
			var costot4 = $('#costot4').val();
		}else{ 
			var paquetet4 = 0;
			var ticketst4 = 0;
			var costot4 = 0;
		}

		if(a1v == 1){
			var paqueteta1 = $('#paquetea1').val();
			var costota1 = $('#costoa1').val();
		}else{ 
			var paqueteta1 = 0;
			var costota1 = 0;
		}

		if(a2v == 1){
			var paqueteta2 = $('#paquetea2').val();
			var costota2 = $('#costoa2').val();
		}else{ 
			var paqueteta2 = 0;
			var costota2 = 0;
		}

		if(a3v == 1){
			var paqueteta3 = $('#paquetea3').val();
			var costota3 = $('#costoa3').val();
		}else{ 
			var paqueteta3 = 0;
			var costota3 = 0;
		}

		if(a4v == 1){
			var paqueteta4 = $('#paquetea4').val();
			var costota4 = $('#costoa4').val();
		}else{ 
			var paqueteta4 = 0;
			var costota4 = 0;
		}

		if(a5v == 1){
			var paqueteta5 = $('#paquetea5').val();
			var costota5 = $('#costoa5').val();
		}else{ 
			var paqueteta5 = 0;
			var costota5 = 0;
		}

		if(a6v == 1){
			var paqueteta6 = $('#paquetea6').val();
			var costota6 = $('#costoa6').val();
		}else{ 
			var paqueteta6 = 0;
			var costota6 = 0;
		}

		//despues de obtener todos los valores registrados obtenemos la suma de todos lso valores

		var valorFinal = parseInt(costo1) + parseInt(costo2) + parseInt(costo3) + parseInt(costo4) + parseInt(costot1) + parseInt(costot2) + parseInt(costot3) + parseInt(costot4) + parseInt(costota1) + parseInt(costota2) + parseInt(costota3) + parseInt(costota4) + parseInt(costota5) + parseInt(costota6);

		//alert("Este es el valor final de los seleccionado: "+valorFinal);

		$("#realizarpago").modal("show");
		$('#montoFin').val(valorFinal);
		$('#texto').html("El costo de tu compra es: <b>$"+valorFinal+" pesos</b>");

		//agregamos los valores seleccionados a los input para enviar
		//facturas
		$('#paquete1E').val(paquete1);
		$('#facturas1E').val(facturas1);
		$('#costo1E').val(costo1);

		$('#paquete2E').val(paquete2);
		$('#facturas2E').val(facturas2);
		$('#costo2E').val(costo2);

		$('#paquete3E').val(paquete3);
		$('#facturas3E').val(facturas3);
		$('#costo3E').val(costo3);

		$('#paquete4E').val(paquete4);
		$('#facturas4E').val(facturas4);
		$('#costo4E').val(costo4);
		
		//tickets
		$('#paquetet1E').val(paquetet1);
		$('#ticketst1E').val(ticketst1);
		$('#costot1E').val(costot1);

		$('#paquetet2E').val(paquetet2);
		$('#ticketst2E').val(ticketst2);
		$('#costot2E').val(costot2);

		$('#paquetet3E').val(paquetet3);
		$('#ticketst3E').val(ticketst3);
		$('#costot3E').val(costot3);

		$('#paquetet4E').val(paquetet4);
		$('#ticketst4E').val(ticketst4);
		$('#costot4E').val(costot4);

		
		//actualizaciones
		$('#paqueteta1E').val(paqueteta1);
		$('#costota1E').val(costota1);

		$('#paqueteta2E').val(paqueteta2);
		$('#costota2E').val(costota2);

		$('#paqueteta3E').val(paqueteta3);
		$('#costota3E').val(costota3);

		$('#paqueteta4E').val(paqueteta4);
		$('#costota4E').val(costota4);

		$('#paqueteta5E').val(paqueteta5);
		$('#costota5E').val(costota5);

		$('#paqueteta6E').val(paqueteta6);
		$('#costota6E').val(costota6);
		
				

    });

    
});