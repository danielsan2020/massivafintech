
// JavaScript Document

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
    $('#tnuevoElemento').modal('hide');
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
//cerrar el ticket
$("#btnTern").click(function(){  
    $('#termina').modal('hide');
    window.setTimeout('location.reload()');
});
//cerrar nuevo comentario por el administrador
$("#btnnuevoComen").click(function(){  
    $('#nuevoComentario').modal('hide');
    window.setTimeout('location.reload()');
});

/**********************************************************************************************/
/****************************************Nuevo tickt*************************************/

$("#nuevoTicket").click(function(){
    /*obtengo valores*/
    var accion = 'nuevo';
    var id_usuario_reporta = $('#id_usuario_reporta').val();
    var id_categoria_ticket = $('#id_categoria_ticket').val();
    var titulo = $('#titulo').val();
    var descripcion = $('#descripcion').val();
    
    if(id_usuario_reporta != '' && id_categoria_ticket != '' && titulo != ''){
        
        $.ajax({
            data: {accion,id_usuario_reporta,id_categoria_ticket,titulo,descripcion},
            url: "controlador/ticketSoporteControlador.php",
            type: 'POST',
            success: function (response){
                console.log(response);
                $("#alertAccion").append('<div class="alert alert-warning text-center"><b>Se ha creado su nuevo ticket, en breve atenderemos su solicitud</b></div>');
                $('#tnuevoElemento').modal('hide');
                window.setTimeout('location.reload()', 2000);
            },
            error: function(response){
                $("#alertAccion").append('<div class="alert alert-danger text-center">:: Ocurrio un error favor de verificar sus datos ::</div>');
                $('#tnuevoElemento').modal('hide');
                window.setTimeout('location.reload()', 2000);
            }
        })
        
    }else{
        $('#mensaje').html('<div class="alert alert-danger" role="alert">Favor de verificar los campos requeridos</div>');
    }
    
});	
 /**********************************************************************************************/
/****************************************termina ticket*************************************/
$('#termina').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') 
    var modal = $(this)
    modal.find('.modal-body #idTermina').val(recipient)
});

$("#terminarTicke").click(function(){
    /*obtengo valores*/
    var accion = 'terminar';
    var idTermina = $('#idTermina').val();
    var califincal =  $('input:radio[name=estrellas]:checked').val();

    $.ajax({
        data: {accion,idTermina,califincal},
        url: "controlador/ticketSoporteControlador.php",
        type: 'POST',
        success: function (response){
            console.log(response);
            $("#alertAccion").append('<div class="alert alert-warning text-center">Se termino su ticket</div>');
            $('#termina').modal('hide');
            window.setTimeout('location.reload()', 2000);
        },
        error: function(response){
            $("#alertAccion").append('<div class="alert alert-danger text-center">:: Ocurrio un error favor de verificar sus datos ::</div>');
            $('#termina').modal('hide');
            window.setTimeout('location.reload()', 2000);
        }
    })
    
}); 
/**********************************************************************************************/
/****************************************borrar elemento*************************************/
$("#agregaResClien").click(function(){
    /*obtengo valores*/
    var accion = 'nuevoComCli';
    var comenCli = $('#comenCli').val();
    var ideTiUS = $('#ideTiUS').val();
    
    if(comenCli != ''){
        
        $.ajax({
            data: {accion,comenCli,ideTiUS},
            url: "controlador/ticketSoporteControlador.php",
            type: 'POST',
            success: function (response){
                console.log(response);
                $("#alertAccion").append('<div class="alert alert-warning text-center"><b>Se agrego su comentario, en breve tendra respuesta.</b></div>');
                window.setTimeout('location.reload()', 2000);
            },
            error: function(response){
                $("#alertAccion").append('<div class="alert alert-danger text-center">:: Ocurrio un error favor de verificar sus datos ::</div>');
                window.setTimeout('location.reload()', 2000);
            }
        })
        
    }else{
        $('#alertAccion').html('<div class="alert alert-danger" role="alert">Favor de escribir la respuesta</div>');
    }
    
}); 
/**********************************************************************************************************************/
/****************************************Seccion para el administrador de tickets*************************************/
$('#nuevoComentario').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('unoo') 
    var modal = $(this)
    modal.find('.modal-body #idsoporteComen').val(recipient)
});

///	agregamos el comentario
 $("#nuevComnAd").click(function(){
    /*obtengo valores*/
    var accion = 'nuevoComAd';
    var idsoporteComen = $('#idsoporteComen').val();
    var comentarioAdmin = $('#comentarioAdmin').val();
    
    if(comentarioAdmin != ''){
        
        $.ajax({
            data: {accion,idsoporteComen,comentarioAdmin},
            url: "controlador/ticketSoporteControlador.php",
            type: 'POST',
            success: function (response){
                console.log(response);
                $('#nuevoComentario').modal('hide');
                $("#alertAccion").append('<div class="alert alert-warning text-center"><b>Se agrego su comentario.</b></div>');
                
                window.setTimeout('location.reload()', 2000);
            },
            error: function(response){
                $("#alertAccion").append('<div class="alert alert-danger text-center">:: Ocurrio un error favor de verificar sus datos ::</div>');
                $('#nuevoComentario').modal('hide');
                window.setTimeout('location.reload()', 2000);
            }
        })
        
    }else{
        $('#alertAccion').html('<div class="alert alert-danger" role="alert">Favor de escribir su comentarios</div>');
    }
    
}); 

//cargamos los comentarios del ticket
$('#vercomentarios').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipient = button.data('unoo');
    var modal = $(this);
     $.ajax({
            data: {recipient},
            url: "controlador/ticketSoporteControlador.php",
            type: 'POST',
            success: function (response){
                console.log(response);
                var response = JSON.parse(response);
                var contenido = "<div class='row'>"+
                    "<div class='col-md-12'>"+
                        "<div class='table-responsive'>"+
                        "<table class='table table-bordered'>"+
                            "<thead>"+
                                "<tr>"+
                                    "<td>Respuesta</td>"+
                                    "<td>Tipo</td>"+
                                    "<td>Fecha creación</td>"+
                                "</tr>"+
                            "</thead>"+
                            "<tbody>";
                
                $.each(response, function(){
              
                    contenido +="<tr>"+
                        "<td>"+this.respuesta+"</td>"+
                        "<td>"+this.tipo+"</td>"+
                        "<td>"+this.fechaCrea+"</td>"+
                    "</tr>";
                });
                
                contenido +="</tbody>"+
                        "</table>"+
                        "</div>"+
                    "</div>"+
                "</div>";
                
                $("#InvColor").html(contenido);
                
            },
            error: function(response){
                $("#alertAccion").append('<div class="alert alert-danger text-center">:: Ocurrio un error favor de verificar sus datos ::</div>');
                $('#nuevoComentario').modal('hide');
                window.setTimeout('location.reload()', 2000);
            }
        })

});
 /**********************************************************************************************/
/****************************************termina ticket admin*************************************/
$('#terminaAdmin').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('unoo') 
    var modal = $(this)
    modal.find('.modal-body #idTermina').val(recipient)
});

$("#terminarTickeADmin").click(function(){
    /*obtengo valores*/
    var accion = 'terminarAdmin';
    var idTerminaADmin = $('#idTermina').val();

    $.ajax({
        data: {accion,idTerminaADmin},
        url: "controlador/ticketSoporteControlador.php",
        type: 'POST',
        success: function (response){
            console.log(response);
            $("#alertAccion").append('<div class="alert alert-warning text-center">Se termino su ticket</div>');
            $('#terminaAdmin').modal('hide');
            window.setTimeout('location.reload()', 2000);
        },
        error: function(response){
            $("#alertAccion").append('<div class="alert alert-danger text-center">:: Ocurrio un error favor de verificar sus datos ::</div>');
            $('#terminaAdmin').modal('hide');
            window.setTimeout('location.reload()', 2000);
        }
    })
        
   
    
}); 
	
	
});