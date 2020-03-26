//funcion para los numeros
function NumCheck(e, field) {
    key = e.keyCode ? e.keyCode : e.which
    // backspace
    if (key == 8) return true
    // 0-9
    if (key > 47 && key < 58) {
      if (field.value == "") return true
      regexp = /.[0-9]{11}$/
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
  /**********************************************************************************************/
  /****************************************funcion para validar el rfc*************************************/
  function ValidaRfc(rfcStr) {
    var strCorrecta;
    strCorrecta = rfcStr; 
    if (rfcStr.length == 12){
      var valid = '^(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
    }else{
      var valid = '^(([A-Z]|[a-z]|\s){1})(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
    }
    var validRfc=new RegExp(valid);
    var matchArray=strCorrecta.match(validRfc);
    if (matchArray==null) {
      alert('Tu RFC es incorrecto');
      return false;
    }else{
      //hacemos la comunicacion ajax para verificar si el rfc ya esta registrado
      $.ajax({
            data: {strCorrecta},
            url: "panel/admin/controlador/registrosWeb.php",
            type: 'POST',
           
            success: function (data){
                 //ert(data);
                  //alert(data);                  
                  if(data == 'null'){
                    $("#alertAccion2").empty();
                  }else{
                    $("#alertAccion2").empty();
                    $("#alertAccion2").append('<div class="alert alert-danger text-center"> El RFC ya se encuentra registrado en la plataforma.<br> Si olvidaste tus credenciales da clic en <a href="panel/recuperar.php">recuperar credenciales</a></div>');  
                  }
                  

            },
        })
    }
} 



$(document).ready(function(){
  //accion de tooltips
   $('[data-toggle="tooltip"]').tooltip(); 


  /**********************************************************************************************/
  /****************************************Botones para cerrar los modals*************************************/
 
  $("#btnEliminar").click(function(){	
      $('#ModalEliminar').modal('hide');
      window.setTimeout('location.reload()');
  });
  $("#btncerraeditar").click(function(){	
      $('#editaCliente').modal('hide');
      window.setTimeout('location.reload()');
  });
  //para cerrar el modal de llamdas
   $("#btnCerrarLlama").click(function(){ 
      $('#registro').modal('hide');
      window.setTimeout('location.reload()');
  });

  //cerrar el modal de nuevo registro
  $("#btnce").click(function(){	
    $('#altaR').modal('hide');
    $("#fregistro")[0].reset();
    window.setTimeout('location.reload()');
});
  
  /**********************************************************************************************/
  /****************************************Nuevo tickt*************************************/
  
   ///seccion de la web
   jQuery("#revolution-slider").revolution({
        sliderType: "standard",
        sliderLayout: "fullwidth",
        delay: 5000,
        navigation: {
            arrows: { enable: true }
        },
        parallax: {
            type: "mouse",
            origo: "slidercenter",
            speed: 2000,
            levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50],
        },
        spinner: "off",
        gridwidth: 1140,
        gridheight: 600,
        disableProgressBar: "on"
    });

  
 
/***********************************************************************************************************/
/****************************************Funcion para guardar el registro de nuevo usuario*************************************/
$('#btnRes').click(function(){

  $('#btnRes').attr('disabled', true);
  ///obtenemos los valores obligatorios del usuario
  var accion = "nusuario";
	var nombreR = $('#nombreR').val();
  var ape_paternoR = $('#ape_paternoR').val();
  var ape_maternoR = $('#ape_maternoR').val();
	var telefonoR = $('#telefonoR').val();
  var rfcR = $('#rfcR').val();
  var tipoActividadR = $('#tipoActividadR').val();
  var formaJuridicaR = $('#formaJuridicaR').val();
  var cantidadTrabajadoresR = $('#cantidadTrabajadoresR').val();
  //verificamos si los check estan seleccionados
  var noTengoEfirmaR = $('#noTengoEfirmaR:checked').val();
  var contabilidadAtrasadaR = $('#contabilidadAtrasadaR:checked').val();
  var aviso = $('#aviso:checked').val();
  var terminos = $('#terminos:checked').val();
  //verificamos si el correo esta bien escrito
  var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
  if (regex.test($('#correoR').val().trim())) {
    //si el correo esta bien seguimos con el proceso
    var correoR = $('#correoR').val();
    //Validamos que este activado los avisos y terminos 
    if (typeof(aviso)  != "undefined" && typeof(terminos)  !== "undefined"){
      //seguimos con el registro del usuario
      if(nombreR != ''  && ape_paternoR != '' && ape_maternoR != '' && rfcR != '' && correoR != '' && tipoActividadR != '' && formaJuridicaR != ''){
        //cargamos el gif
        $('#contentCargador').html('<div class="loading text-center"><img src="images/creative.gif" style="height:120px !important" alt="loading" /><br/>Un momento, por favor...</div>');
        ///realizamos el registro
        $.ajax({
            data: {accion,nombreR,ape_paternoR,ape_maternoR,telefonoR,rfcR,correoR,tipoActividadR,formaJuridicaR,cantidadTrabajadoresR,noTengoEfirmaR,contabilidadAtrasadaR,aviso,terminos},
            url: "panel/admin/controlador/registrosWeb.php",
            type: 'POST',
            success: function (response){
                console.log(response);
                $("#alertAccion2").empty();
                $("#alertAccion2").append('<div class="alert alert-warning text-center"> Tu registro fue exitoso, en breve recibirás un correo con tu usuario y contraseña para el acceso.</div>');
                $('#contentCargador').empty();
            },
            error: function(response){
              $("#alertAccion2").empty();
               $("#alertAccion2").append('<div class="alert alert-danger text-center"> Ocurrió un error, por favor verifica tus datos </div>');
               $('#btnRes').attr('disabled', false);
            }
        })
      }else{
          $("#alertAccion2").empty();
          $('#alertAccion2').html('<div class="alert alert-danger text-center" role="alert">Verifica los campos requeridos</div>');
          $('#btnRes').attr('disabled', false);
      }
    }
    else{
      $("#alertAccion2").empty();
      $("#alertAccion2").append('<div class="alert alert-danger text-center"> Debes aceptar el Aviso de Privacidad y Términos y Condiciones.</div>');
      $('#btnRes').attr('disabled', false);
    }
  } else { //validacion si el correo esta mal
    $("#alertAccion2").empty();
    $("#alertAccion2").append('<div class="alert alert-danger text-center"> La dirección de email es incorrecta.</div>');
    $('#btnRes').attr('disabled', false);
  }  
   
});
	  
/**********************************************************************************************/
  /****************************************Formualario de contacto*************************************/
  $("#envioCofm").click(function(){
      var accion = 'nuevocontracto';
      var Cnombre = $('#name2').val();
      var Cape = $('#apellidos2').val();
	    var Cmail = $('#correo2').val();
	    var cCel = $('#celular2').val();
	    var Cciudad = $('#ciudad2').val();
	    var cActi = $('#cActividad').val();
	    var cMensaje = $('#message').val();
	    
      if(Cnombre != '' && Cape != '' && Cmail != '' && cCel != '' && cMensaje != ''){
            $.ajax({
                data: {Cnombre,Cape,Cmail,cCel,Cciudad,cActi,cMensaje,accion},
                url: "panel/admin/correos/contactoWeb.php",
                type: 'POST',
                success: function (response){
                    $("#alertaContacto").append('<div class="alert alert-warning text-center"> Gracias por escribirnos, en breve nos pondremos en contacto contigo.</div>');
                },
                error: function(response){
                    $("#alertaContacto").append('<div class="alert alert-danger text-center"> Ocurrió un error, verifica tus datos.</div>');
                }
            })
        }else{
            $('#alertaContacto').html('<div class="alert alert-danger" role="alert">Verifica los campos requeridos</div>');
        }
        
    });	
  /**********************************************************************************************/
  /****************************************formulario de llamda*************************************/
  $("#RNuevaLlamaREd").click(function(){
        /*obtengo valores*/
        var accion = 'nuevaLlamada';
        var nombre = $('#nombre').val();
        var numero = $('#numero').val();
        var asunto = $('#asunto').val();
        if(nombre != '' && numero != '' && asunto != ''){
            $.ajax({
                data: {nombre,numero,accion,asunto},
                url: "panel/admin/correos/contactoWeb.php",
                type: 'POST',
                success: function (response){
                    $("#alertaLlama").append('<div class="alert alert-warning text-center"> Nos comunicaremos lo antes posible, gracias.</div>');
                },
                error: function(response){
                    $("#alertaLlama").append('<div class="alert alert-danger text-center"> Ocurrió un error favor de verificar sus datos </div>');
                }
            })
        }else{
            $('#alertaLlama').html('<div class="alert alert-danger" role="alert">Favor de verificar los campos requeridos</div>');
        }
        
    }); 

  

    

});

/**********************************************************************************************/
  /****************************************par abloquar los campos*************************************/
function comprobar(obj)
{   
    if (obj.checked)
        document.getElementById('contabilidadAtrasadaR').disabled = true;
    else
        document.getElementById('contabilidadAtrasadaR').disabled = false;
}

function comprobar2(obj)
{   
    if (obj.checked)
        document.getElementById('noTengoEfirmaR').disabled = true;
    else
        document.getElementById('noTengoEfirmaR').disabled = false;
}
