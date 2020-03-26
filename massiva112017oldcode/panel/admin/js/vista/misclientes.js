// JavaScript Document

//funcion para los numeros
function NumCheck(e, field) {
  key = e.keyCode ? e.keyCode : e.which;
  // backspace
  if (key == 8) return true;
  // 0-9
  if (key > 47 && key < 58) {
    if (field.value == "") return true;
    regexp = /.[0-9]{15}$/;
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

  $("#btncerraeditar").click(function() {
    $("#editaCliente").modal("hide");
    window.setTimeout("location.reload()");
  });

  $("#btncerraeditar").click(function() {
    $("#alertAccion").append(
      '<div class="alert alert-success text-center">Estamos trabajando en tu factura</div>'
    );
  });

  /**********************************************************************************************/
  /****************************************borrar elemento*************************************/
  $("#ModalEliminar").on("show.bs.modal", function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipient = button.data("unoo");
    var recipient2 = button.data("doss");
    var modal = $(this);
    modal.find(".modal-body #idCliente").val(recipient);
    modal.find(".modal-body #imgLog").val(recipient2);
  });

  /* con esto guardamos parte de la factura y mostramos la seccion de productos */
  $("#agregarContr").click(function() {
    /*obtengo valores*/
    var accion = "agregaContra";
    var idCodigo = $("#idCodigo").val();
    var contratof = $("#contratof").val();

    /*metodo ajax*/
    $.ajax({
      data: { accion, idCodigo, contratof },
      url: "controlador/codigoControlador.php",
      type: "POST",
      success: function(response) {
        $("#alertAccion").append(
          '<div class="alert alert-success text-center">Se asigno el contrato al codigo</div>'
        );
        $("#contrato").modal("hide");
        window.setTimeout("location.reload()", 3000);
      },
      error: function(response, status, error) {
        $("#alertAccion").append(
          '<div class="alert alert-danger text-center">Ocurrio un error favor de verificar sus datos .</div>'
        );
        $("#agregarContr").modal("hide");
        window.setTimeout("location.reload()", 3000);
      }
    });
    $("#bloque_info").show();
  });

  /**********************************************************************************************/
  /****************************************editar elemento*************************************/

  $("#editaCliente").on("show.bs.modal", function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipient = button.data("unoo");
    var recipient2 = button.data("doss");

    $.ajax({
      data: { idenEdita: recipient },
      url: "controlador/miclientesControlador.php",
      type: "POST",
      dataType: "json",
      success: function(data) {
        //console.log(data.nombre);
        $("#nombreE1").val(data.nombre);
        $("#apePaternoE").val(data.apePaterno);
        $("#apeMaternoE").val(data.apeMaterno);

        $("#departamentoE").val(data.departamento);
        $("#puestoE").val(data.puesto);

        $("#tel1E").val(data.tel1);
        $("#tel2E").val(data.tel2);
        $("#cel1E").val(data.cel1);
        $("#cel2E").val(data.cel2);

        $("#correo1E1").val(data.correo1);
        $("#correo2E1").val(data.correo2);
        $("#dirE1").val(data.dir);
        $("#cpE1").val(data.cp);
        $("#coloniaE1").val(data.colonia);
        $("#ciudadE1").val(data.ciudad);
        $("#observacionesE1").val(data.observaciones);

        $("#nombreEE").val(data.nombreE);
        $("#razonSocialEE").val(data.razonSocialE);
        $("#rfcEE").val(data.rfcE);
        $("#dirEE").val(data.dirE);
        $("#coloniaEE").val(data.coloniaE);
        $("#cpEE").val(data.cpE);
        $("#estadoEE").val(data.estadoE);
        $("#ciudadEE").val(data.ciudadE);
        $("#paisEE").val(data.paisE);
        $("#telEE").val(data.telE);
        $("#correo1EE").val(data.correo1E);
        $("#correo2EE").val(data.correo2E);
        $("#correo3EE").val(data.correo3E);
        $("#observacionesEE").html(data.observacionesE);
        $("#estadoE1 option[value='" + data.estado + "']").attr(
          "selected",
          "selected"
        );

        $("#paisEE").val(data.paisE);
        $("#paisEE1").val(data.paisE);

        $("#creditoEE option[value='" + data.creditoE + "']").attr(
          "selected",
          "selected"
        );
      }
    });
    //se abre el modal
    var modal = $(this);
    modal.find(".modal-body #idClienteE1").val(recipient);
    modal.find(".modal-body #imgLogE1").val(recipient2);
  });
});
