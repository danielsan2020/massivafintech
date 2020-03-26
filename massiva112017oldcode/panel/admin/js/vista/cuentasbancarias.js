function muestra_oculta(id) {
  var azteca = document.getElementById("azteca");
  var banjio = document.getElementById("banjio");
  var bancoppel = document.getElementById("bancoppel");
  var banorte = document.getElementById("banorte");
  var bbva = document.getElementById("bbva");
  var citibanamex = document.getElementById("citibanamex");
  var hsbc = document.getElementById("hsbc");
  var inbursa = document.getElementById("inbursa");
  var santander = document.getElementById("santander");
  var scotiabank = document.getElementById("scotiabank");

  azteca.style.display = azteca.style.display == "block" ? "none" : "none";
  banjio.style.display = banjio.style.display == "block" ? "none" : "none";
  bancoppel.style.display =
    bancoppel.style.display == "block" ? "none" : "none";
  banorte.style.display = banorte.style.display == "block" ? "none" : "none";
  bbva.style.display = bbva.style.display == "block" ? "none" : "none";
  citibanamex.style.display =
    citibanamex.style.display == "block" ? "none" : "none";
  hsbc.style.display = hsbc.style.display == "block" ? "none" : "none";
  inbursa.style.display = inbursa.style.display == "block" ? "none" : "none";
  santander.style.display =
    santander.style.display == "block" ? "none" : "none";
  scotiabank.style.display =
    scotiabank.style.display == "block" ? "none" : "none";

  if (document.getElementById) {
    var rowDiv = document.getElementById(id);
    rowDiv.style.display = rowDiv.style.display == "none" ? "block" : "none";
  }
}

window.onload = function() {};
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

 
});
