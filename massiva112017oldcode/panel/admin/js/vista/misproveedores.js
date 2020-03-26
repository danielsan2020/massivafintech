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
  /* formulario de nuevo proveedor */
  $("#btncerranuevo").click(function() {
    $("#fornuefo").trigger("reset");
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
    var modal = $(this);
    modal.find(".modal-body #idproveedorEli").val(recipient);
  });

  

  /**********************************************************************************************/
  /****************************************editar elemento*************************************/

  $("#editapro").on("show.bs.modal", function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipient = button.data("unoo");
    var modal = $(this);
    modal.find(".modal-body #idproveedorEdiAc").val(recipient);
    
    $.ajax({
      data: { idenEdita: recipient },
      url: "controlador/proveedoresControlador.php",
      type: "POST",
      dataType: "json",
      success: function(data) {
        //console.log(data.nombre);
        $("#valogo").val(data.logo);
        $("#rfc1").val(data.rfcPro);
        $("#nombre1").val(data.nombre);
        $("#dir1").val(data.direcc);
        $("#colonia1").val(data.colonia);
        $("#cp1").val(data.cpPro);
        $("#estado1 option[value='" + data.estado + "']").attr(
          "selected",
          "selected"
        );

        $("#ciudad1").val(data.ciudad);

        $("#tel1").val(data.telefeo);
        $("#correo1").val(data.correo);
        $("#pagina1").val(data.pagina);
        $("#razon1").val(data.razon);
        $("#pais1 option[value='" + data.pais + "']").attr(
          "selected",
          "selected"
        );
        $("#dias1 option[value='" + data.dias + "']").attr(
          "selected",
          "selected"
        );
        $("#tipo1 option[value='" + data.tipo + "']").attr(
          "selected",
          "selected"
        );
        $("#observaciones1").html(data.observaciones);

        
        
      }
    });
    //se abre el modal
    
    
    
  });
});
