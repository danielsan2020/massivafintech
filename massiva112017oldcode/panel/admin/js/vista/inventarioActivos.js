//funcion para los numeros
function NumCheck(e, field) {
  key = e.keyCode ? e.keyCode : e.which;
  // backspace
  if (key == 8) return true;
  // 0-9
  if (key > 47 && key < 58) {
    if (field.value == "") return true;
    regexp = /.[0-9]{5}$/;
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
  ///funcion para la tabla
  $(".dataTables-example").DataTable({
    columns: [{ width: "20%", targets: 0 }],
    pageLength: 25,
    responsive: true,
    dom: '<"html5buttons"B>lTfgitp',
    buttons: [
      { extend: "pdf", title: "ExampleFile" },

      {
        extend: "print",
        customize: function(win) {
          $(win.document.body).addClass("white-bg");
          $(win.document.body).css("font-size", "10px");

          $(win.document.body)
            .find("table")
            .addClass("compact")
            .css("font-size", "inherit");
        }
      }
    ],
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
  //para el modal de nuevo
 

  /**********************************************************************************************/
  /****************************************eliminar servicio*************************************/
});
