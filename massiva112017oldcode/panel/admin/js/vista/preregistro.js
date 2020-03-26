//funcion para los numeros
function NumCheck(e, field) {
  key = e.keyCode ? e.keyCode : e.which;
  // backspace
  if (key == 12) return true;
  // 0-9
  if (key > 47 && key < 58) {
    if (field.value == "") return true;
    regexp = /.[0-9]{16}$/;
    return !regexp.test(field.value);
  }
  // .
  if (key == 46) {
    if (field.value == "") return false;
    regexp = /^[0-9]+$/;
    return regexp.test(field.value);
  }
  // other key
  return false;
}
//funcion para letras
function soloLetras(e) {
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toLowerCase();
  letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
  especiales = "8-37-39-46";

  tecla_especial = false;
  for (var i in especiales) {
    if (key == especiales[i]) {
      tecla_especial = true;
      break;
    }
  }

  if (letras.indexOf(tecla) == -1 && !tecla_especial) {
    return false;
  }
}
$(document).ready(function() {
  /**********************************************************************************************/
  /****************************************Seccion para el data table*************************************/
  $(".dataTables-example").DataTable({
    pageLength: 25,
    responsive: true,
    dom: '<"html5buttons"B>lTfgitp',
    buttons: [{ extend: "pdf", title: "ExampleFile" }, { extend: "csv" }],
    language: {
      processing: "Procesando...",
      search: "Buscar:",
      lengthMenu: "Mostrar: _MENU_ elementos",
      info: "Mostrando _START_ a _END_ de _TOTAL_ resultados",
      infoEmpty: "Elemento 0 de 0 elementos encontrados",
      infoFiltered: "(elementos filtrado _MAX_ de elementos maximos )",
      infoPostFix: "",
      loadingRecords: "Cambios en Curso...",
      zeroRecords: "No se encuentran elementos.",
      emptyTable: "Tabla no disponible",
      paginate: {
        first: "Adelante",
        previous: "Anterior",
        next: "Siguiente",
        last: "Atrás"
      }
    }
  });

  /**********************************************************************************************/
  /****************************************Botones para cerrar los modals*************************************/
  $("#btncerranuevo").click(function() {
    $("#formularioGeneralNuevo").trigger("reset");
    $("#nuevoClienteC").modal("hide");
    window.setTimeout("location.reload()");
  });
  $("#btnEliminar").click(function() {
    $("#ModalEliminar").modal("hide");
    window.setTimeout("location.reload()");
  });
  $("#btncerraeditar").click(function() {
    $("#editaCliente").modal("hide");
    window.setTimeout("location.reload()");
  });

  /**********************************************************************************************/
  /****************************************Botones para regresar en los preregistros*************************************/
  $("#btnRegresar2").click(function() {
    window.location.href = "preregistro.php?var=1";
  });
  /**********************************************************************************************/
  /****************************************borrar elemento*************************************/

  //agregar nueva publicacion
  $("#pfbtn").click(function() {
    /*obtengo valores*/
    $("#pf").css("display", "block");
    $("#pm").css("display", "none");
    $("#ex").css("display", "none");
  });

  $("#pmbtn").click(function() {
    /*obtengo valores*/
    $("#pf").css("display", "none");
    $("#pm").css("display", "block");
    $("#ex").css("display", "none");
  });

  $("#extrabtn").click(function() {
    /*obtengo valores*/
    $("#pf").css("display", "none");
    $("#pm").css("display", "none");
    $("#ex").css("display", "block");
  });
  /**********************************************************************************************/
  /****************************************funciones para la seleccion de paquetes*************************************/
  $("#btnUno").click(function() {
    /*obtengo valores*/
    $("#cuadro1").css("background-color", "#5b5b5f");
    $("#cuadro2").css("background-color", "");
    $("#cuadro3").css("background-color", "");
    $("#cuadro4").css("background-color", "");
    $("#cuadro5").css("background-color", "");
    $("#cuadro6").css("background-color", "");
    $("#cuadro7").css("background-color", "");
    $("#cuadro8").css("background-color", "");
    $("#selecciona").val("1");
    $("#costo").val("199");
    $("#ibnteres").modal("hide");
  });
  $("#btnDos").click(function() {
    /*obtengo valores*/
    $("#cuadro1").css("background-color", "");
    $("#cuadro2").css("background-color", "#5b5b5f");
    $("#cuadro3").css("background-color", "");
    $("#cuadro4").css("background-color", "");
    $("#cuadro5").css("background-color", "");
    $("#cuadro6").css("background-color", "");
    $("#cuadro7").css("background-color", "");
    $("#cuadro8").css("background-color", "");
    $("#selecciona").val("1");
    $("#costo").val("199");
    $("#asalariados").modal("hide");
  });
  $("#btnTres").click(function() {
    /*obtengo valores*/
    $("#cuadro1").css("background-color", "");
    $("#cuadro2").css("background-color", "");
    $("#cuadro3").css("background-color", "#5b5b5f");
    $("#cuadro4").css("background-color", "");
    $("#cuadro5").css("background-color", "");
    $("#cuadro6").css("background-color", "");
    $("#cuadro7").css("background-color", "");
    $("#cuadro8").css("background-color", "");
    $("#selecciona").val("2");
    $("#costo").val("199");
    $("#arrendamiento").modal("hide");
  });

  $("#btnCuatro").click(function() {
    /*obtengo valores*/
    $("#cuadro1").css("background-color", "");
    $("#cuadro2").css("background-color", "");
    $("#cuadro3").css("background-color", "");
    $("#cuadro4").css("background-color", "#5b5b5f");
    $("#cuadro5").css("background-color", "");
    $("#cuadro6").css("background-color", "");
    $("#cuadro7").css("background-color", "");
    $("#cuadro8").css("background-color", "");
    $("#selecciona").val("6");
    $("#costo").val("99");
    $("#rif").modal("hide");
  });
  $("#btnCinco").click(function() {
    /*obtengo valores*/
    $("#cuadro1").css("background-color", "");
    $("#cuadro2").css("background-color", "");
    $("#cuadro3").css("background-color", "");
    $("#cuadro4").css("background-color", "");
    $("#cuadro5").css("background-color", "#5b5b5f");
    $("#cuadro6").css("background-color", "");
    $("#cuadro7").css("background-color", "");
    $("#cuadro8").css("background-color", "");
    $("#selecciona").val("5");
    $("#costo").val("199");
    $("#empresarial").modal("hide");
  });
  $("#btnSies").click(function() {
    /*obtengo valores*/
    $("#cuadro1").css("background-color", "");
    $("#cuadro2").css("background-color", "");
    $("#cuadro3").css("background-color", "");
    $("#cuadro4").css("background-color", "");
    $("#cuadro5").css("background-color", "");
    $("#cuadro6").css("background-color", "#5b5b5f");
    $("#cuadro7").css("background-color", "");
    $("#cuadro8").css("background-color", "");
    $("#selecciona").val("3");
    $("#costo").val("199");
    $("#profesionalBasico").modal("hide");
  });
  $("#btnSiete").click(function() {
    /*obtengo valores*/
    $("#cuadro1").css("background-color", "");
    $("#cuadro2").css("background-color", "");
    $("#cuadro3").css("background-color", "");
    $("#cuadro4").css("background-color", "");
    $("#cuadro5").css("background-color", "");
    $("#cuadro6").css("background-color", "");
    $("#cuadro7").css("background-color", "#5b5b5f");
    $("#cuadro8").css("background-color", "");
    $("#selecciona").val("4");
    $("#costo").val("299");
    $("#profesionalPlus").modal("hide");
  });
  $("#btnOcho").click(function() {
    /*obtengo valores*/
    $("#cuadro1").css("background-color", "");
    $("#cuadro2").css("background-color", "");
    $("#cuadro3").css("background-color", "");
    $("#cuadro4").css("background-color", "");
    $("#cuadro5").css("background-color", "");
    $("#cuadro6").css("background-color", "");
    $("#cuadro7").css("background-color", "");
    $("#cuadro8").css("background-color", "#5b5b5f");
    //aqui obtenemos el valor del campos del resultado de la calculadora
    $("#selecciona").val("7");
    $("#costo").val($("#costoCal").val());
    $("#pfespecial").modal("hide");
  });

  ///////seccion de botones de persona moral
  $("#btnNueve").click(function() {
    /*obtengo valores*/
    $("#cuadro1").css("background-color", "");
    $("#cuadro2").css("background-color", "");
    $("#cuadro3").css("background-color", "");
    $("#cuadro4").css("background-color", "");
    $("#cuadro5").css("background-color", "");
    $("#cuadro6").css("background-color", "");
    $("#cuadro7").css("background-color", "");
    $("#cuadro8").css("background-color", "");
    $("#cuadro9").css("background-color", "#5b5b5f");
    $("#cuadro10").css("background-color", "");
    //aqui obtenemos el valor del campos del resultado de la calculadora
    $("#selecciona").val("8");
    $("#costo").val("0");
    $("#calculadora").modal("hide");
  });

  $("#btnDiez").click(function() {
    /*obtengo valores*/
    $("#cuadro1").css("background-color", "");
    $("#cuadro2").css("background-color", "");
    $("#cuadro3").css("background-color", "");
    $("#cuadro4").css("background-color", "");
    $("#cuadro5").css("background-color", "");
    $("#cuadro6").css("background-color", "");
    $("#cuadro7").css("background-color", "");
    $("#cuadro8").css("background-color", "");
    $("#cuadro9").css("background-color", "");
    $("#cuadro10").css("background-color", "#5b5b5f");
    //aqui obtenemos el valor del campos del resultado de la calculadora
    $("#selecciona").val("9");
    $("#costo").val("0");
    $("#calculadoraDos").modal("hide");
  });
  /*********************************************************************************************************/

  /****************************************funciones para datos de pago*************************************/
  //funcion para guardar la tarketas de credito
  $("#btnGuardarTarjetas").click(function() {
    //obtenemos valores
    var tipo = $("#tipo").val();
    var nombre = $("#nombre").val();
    var numero = $("#numero").val();
    var fechaMes = $("#fechaMes").val();
    var fechaAno = $("#fechaAno").val();
    var codigo = $("#codigo").val();

    //validamos la tarjeta princpial
    if (
      tipo != "" &&
      nombre != "" &&
      numero != "" &&
      fechaMes != "" &&
      fechaAno != "" &&
      codigo != ""
    ) {
      var accion = "tarjetas1";
      //en caso de que los datos de la tarjeta secundaria este llenos
      $.ajax({
        data: {
          accion,
          tipo,
          nombre,
          numero,
          fechaMes,
          fechaAno,
          codigo
        },
        url: "controlador/preregistroControlador.php",
        type: "POST",
        success: function(response) {
          $("#alertAccion").append(
            '<div class="alert alert-warning text-center">Se agregó tu tarjeta.</div>'
          );
          $("#tarjetaBancaria").modal("hide");
          $("#tarcre").val("1");
        },
        error: function(response, status, error) {
          $("#alertAccion").append(
            '<div class="alert alert-danger text-center">Ocurrió un error favor de verificar sus datos.</div>'
          );
          $("#calculadoraDos").modal("hide");
        }
      });
    } else {
      $("#alertAccion").html(
        '<div class="alert alert-danger" role="alert">Verificar los campos requeridos de la tarjeta principal.</div>'
      );
    }
  });

  //funcion para el boton de seguir
  $("#btnSig").click(function() {
    var Idncamos = $("#Idncamos").val();
    $.ajax({
      data: { Idncamos },
      url: "controlador/preregistroControlador.php",
      type: "POST",
      success: function(response) {
        window.location.href = "preregistro6.php";
      },
      error: function(response, status, error) {
        $("#alertAccion").append(
          '<div class="alert alert-danger text-center">Ocurrió un error favor de verificar sus datos.</div>'
        );
        $("#calculadoraDos").modal("hide");
      }
    });
  });

  //funcion para pasar de 6 a 7
  $("#pasasrsiete").click(function() {
    var aviPri = $("#aviPri:checked").val();
    var idRefe = $("#idRefe").val();

    if (aviPri == 1) {
      $.ajax({
        data: { idRefe },
        url: "controlador/preregistroControlador.php",
        type: "POST",
        success: function(response) {
          window.location.href = "preregistro7.php";
        },
        error: function(response, status, error) {
          $("#alertAccion").append(
            '<div class="alert alert-danger text-center">Ocurrió un error favor de verificar sus datos.</div>'
          );
          $("#calculadoraDos").modal("hide");
        }
      });
    } else {
      $("#alertAccion").append(
        '<div class="alert alert-danger text-center">Lee y acepta el Aviso de Privacidad.</div>'
      );
    }
  });
  /*********************************************************************************************************/
  /****************************************funciones para acciones finales*************************************/
  $("#btnSeguirFinalSanear").click(function() {
    var idSaneRef = $("#idSaneoijklRef").val();
    $.ajax({
      data: { idSaneRef },
      url: "controlador/preregistroControlador.php",
      type: "POST",
      success: function(response) {
        window.location.href = "index.php";
      },
      error: function(response, status, error) {
        window.location.href = "index.php";
      }
    });
  });
});
