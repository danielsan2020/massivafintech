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

function ValidaRfc(rfcStr) {
  var strCorrecta;
  strCorrecta = rfcStr;
  if (rfcStr.length == 12) {
    var valid = "^(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))";
  } else {
    var valid =
      "^(([A-Z]|[a-z]|s){1})(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))";
  }
  var validRfc = new RegExp(valid);
  var matchArray = strCorrecta.match(validRfc);
  if (matchArray == null) {
    alert("Tu RFC es incorrecto");
    return false;
  } else {
    //hacemos la comunicacion ajax para verificar si el rfc ya esta registrado
    $.ajax({
      data: { strCorrecta },
      url: "panel/admin/controlador/registrosWeb.php",
      type: "POST",

      success: function(data) {
        //ert(data);
        //alert(data);
        if (data == "null") {
          $("#alertAccion2").empty();
        } else {
          $("#alertAccion2").empty();
          $("#alertAccion2").append(
            '<div class="alert alert-danger text-center"> El RFC ya se encuentra registrado en el sistema.<br> Si olvidó sus credenciales da clic en <a href="panel/recuperar.php">recuperar credenciales</a></div>'
          );
        }
      }
    });
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
  /****************************************borrar elemento*************************************/
  $("#ModalEliminar").on("show.bs.modal", function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var recipient = button.data("whatever");
    var modal = $(this);
    modal
      .find(".modal-title")
      .text("Eliminar su cliente numero:  " + recipient);
    modal.find(".modal-body #idCliente").val(recipient);
  });

  $("#periodoRegu").change(function() {
    //alert($('select[name=idUnidad]').val());
    var periodoRegu = $("select[name=periodoRegu]").val();
    if (periodoRegu == 6 || periodoRegu == 0) {
      $("#cantPeriodo").prop("disabled", false);
    } else {
      $("#cantPeriodo").prop("disabled", true);
    }
  });

  //funcion del boton para generar la calculadora
  $("#calcular").click(function() {
    /*obtengo valores*/
    $("#costofinal1").empty();
    var categorias = new Array();
    $("input[name='obliga[]']:checked").each(function() {
      categorias.push($(this).val());
    });

    //obtenemos las obligaciones seleccionadas.
    var cont = categorias.length;

    if (cont == 1) {
      var porcenObli = 0.4;
    } else if (cont == 2) {
      var porcenObli = 0.7;
    } else if (cont == 3) {
      var porcenObli = 1;
    }

    if (cont > 0) {
      //obtenemos el tiempó ya sea año o mees
      var peridio = $("#periodoRegu").val();
      var valorFinal = peridio;
      var vancontrece = valorFinal * 13; ///numero de declaracion que se tienen que presentar
      //alert("Tipo de periodo seleccionado: "+peridio);
      //alert("resultado del tiempo si aplica o no multiplcar por trece:" +vancontrece);
      //teniendo el periodo sacamos el porcentaje segun la seleccion
      switch (peridio) {
        case "0":
          var porcen = 0.97;
          break;
        case "1":
          var porcen = 0.95;
          break;
        case "2":
          var porcen = 0.9;
          break;
        case "3":
          var porcen = 0.85;
          break;
        case "4":
          var porcen = 0.8;
          break;
        case "5":
          var porcen = 0.75;
          break;
        case "6":
          var porcen = 0.72;
          break;
      }
      //alert('el porcentaje segun lo seleccionado es de: '+porcen);
      //alert('Seleccionaste '+cont+ ' Obligaciones');
      //alert('Obtuviste un descuento de:' +porcenObli);

      //obtenemos los regimenes del cliente
      if ($("#cheInteres").prop("checked")) {
        var uno = 15.3;
      } else {
        var uno = 0;
      }

      if ($("#cheasalariado").prop("checked")) {
        var dos = 15.3;
      } else {
        var dos = 0;
      }

      if ($("#chearrendamiento").prop("checked")) {
        var tres = 199;
      } else {
        var tres = 0;
      }

      if ($("#cheservicios").prop("checked")) {
        var cuatro = 299;
      } else {
        var cuatro = 0;
      }
      if ($("#cheempresaria").prop("checked")) {
        var cinco = 199;
      } else {
        var cinco = 0;
      }
      if ($("#cherif").prop("checked")) {
        var seis = 99;
      } else {
        var seis = 0;
      }

      /*alert("Seleccionas uno"+uno);
		alert("Seleccionas dos"+dos);
		alert("Seleccionas tres"+tres);
		alert("Seleccionas cuatro"+cuatro);
		alert("Seleccionas cinco"+cinco);
		alert("Seleccionas seis"+seis);*/

      if (uno > 0) {
        var sumaFinal1 = vancontrece * uno;
      } else {
        var sumaFinal1 = 0;
      }

      if (dos > 0) {
        var sumaFinal2 = vancontrece * dos;
      } else {
        var sumaFinal2 = 0;
      }

      if (tres > 0) {
        var sumaFinal3 = vancontrece * tres;
      } else {
        var sumaFinal3 = 0;
      }

      if (cuatro > 0) {
        var sumaFinal4 = vancontrece * cuatro;
      } else {
        var sumaFinal4 = 0;
      }

      if (cinco > 0) {
        var sumaFinal5 = vancontrece * cinco;
      } else {
        var sumaFinal5 = 0;
      }

      if (seis > 0) {
        var sumaFinal6 = vancontrece * seis;
      } else {
        var sumaFinal6 = 0;
      }

      var total =
        sumaFinal1 + sumaFinal2 + sumaFinal3 + sumaFinal4 + sumaFinal5 + sumaFinal6;
      //agregamos el porcentaje de las obligaciones

      var totalPDes = total * porcenObli;

      var totalAn = totalPDes * porcen;

      var Fiinal = Math.round(totalAn);

      //alert(Fiinal);
      $("#costofinal1").append(
        '<div class="alert alert-warning text-center"><b>Costo final: $' +
          Fiinal +
          "<br></b>Esta cotización solo incluye los servicios de massiva. No incluye las multas, recargos ni cantidades a favor del SAT. <br>Esta cotización podría variar después del análisis real de massiva. <br> <b>A partir de $2,000, massiva te ofrece de 3 a 6 meses sin intereses.</b></div>"
      );
      $("#montoCal").val(Fiinal);
    } else {
      alert("Selecciona una obligación");
    }
  });

  //regularicaion del personas morales YAAAAAAAAAAAAAAAAAAAAAAAAAA NO MOVER
  $("#calcularPM").click(function() {
    /*obtengo valores*/
    $("#costofinal1").empty();

    var categorias = new Array();
    $("input[name='obliga2[]']:checked").each(function() {
      categorias.push($(this).val());
    });

    var cont = categorias.length;

    if (cont == 1) {
      var porcenObli = 0.3;
    } else if (cont == 2) {
      var porcenObli = 0.15;
    } else if (cont == 3) {
      var porcenObli = 0;
    }
    //alert('seleccionaste '+cont+' obligaciones');

    if (cont > 0) {
      ///obtener el valor del primer rubro
      var peridio = $("#periodoRegu2").val();
      var vancontrece = peridio * 13;

      //alert('El perido que seleccionaste se multiplica por 13 : '+peridio);
      //alert('y el resutaldo es ' + vancontrece)

      //obtenemos el porcentaje que necesita por meses
      switch (peridio) {
        case "1":
          var porcen = 0.04;
          break;
        case "2":
          var porcen = 0.08;
          break;
        case "3":
          var porcen = 0.12;
          break;
        case "4":
          var porcen = 0.15;
          break;
        case "5":
          var porcen = 0.2;
          break;
        case "6":
          var porcen = 0.22;
          break;
      }
      //alert('el porcentaje de desceunto por periodo es de' +porcen);

      //obtenemos los regimen seleccionados
      if ($("#regeneral").prop("checked")) {
        var uno = 15.3;
      } else {
        var uno = 0;
      }
      if ($("#fineslucra").prop("checked")) {
        var dos = 15.3;
      } else {
        var dos = 0;
      }

      //realizamos el proceso
      if (uno > 0) {
        var sumaFinal1 = uno * vancontrece;
      } else {
        var sumaFinal1 = 0;
      }

      if (dos > 0) {
        var sumaFinal2 = dos * vancontrece;
      } else {
        var sumaFinal2 = 0;
      }

      //obtenemos ingresos anauales
      var inGAnuale = $("#movIngUno2").val();

      //alert("este es el valor de los ingreso:" + inGAnuale);

      var total = sumaFinal1 + sumaFinal2 + inGAnuale;
      //alert("este es el total de la suma::::"+ total)
      //agregamos el porcentaje de las obligaciones

      var totalPDes = porcenObli * total;
      //alert("este es el total por el porcentaje que es .30 ///////"+ totalPDes)
      //var totalPDes = totalPDes.substring(1);
      var totalAn = porcen * totalPDes;
      //var totalAn = totalAn.substring(1);
      var fif = totalPDes - totalAn;
      var fif2 = fif + inGAnuale;
      var fif3 = fif2 * 12;
      var Fiinal = Math.round(fif3);

      //alert(Fiinal);
      $("#costofinal12").empty();
      $("#costofinal12").append(
        '<div class="alert alert-warning text-center"><b>Costo final: $' +
          Fiinal +
          "<br></b>Esta cotización solo incluye los servicios de massiva. No incluye las multas, recargos ni cantidades a favor del SAT. <br>Esta cotización podría variar después del análisis real de massiva.<br> <b>A partir de $7,000, masssiva te ofrece 3,6 y 9 meses sin intereses</b> </div>"
      );
      $("#montoCal1").val(Fiinal);
    } else {
      alert("Selecciona una obligación");
    }
  });

  //caluladora de personas fisicas especial atencion a clientes
  $("#calcularPFE").click(function() {
    /*obtengo valores*/
    $("#costofinal1").empty();

    var datosSelec = 0;

    //obtenemos los regimen seleccionados
    if ($("#cInteres").prop("checked")) {
      var uno = 199;
      var vsele1 = 1;
    } else {
      var uno = 0;
      var vsele1 = 0;
    }
    if ($("#casalariado").prop("checked")) {
      var dos = 199;
      var vsele2 = 1;
    } else {
      var dos = 0;
      var vsele2 = 0;
    }

    if ($("#carrendamiento").prop("checked")) {
      var tres = 199;
      var vsele3 = 1;
    } else {
      var tres = 0;
      var vsele3 = 0;
    }

    if ($("#cservicios").prop("checked")) {
      var cuatro = 299;
      var vsele4 = 1;
    } else {
      var cuatro = 0;
      var vsele4 = 0;
    }

    if ($("#cempresaria").prop("checked")) {
      var cinco = 199;
      var vsele5 = 1;
    } else {
      var cinco = 0;
      var vsele5 = 0;
    }

    if ($("#crif").prop("checked")) {
      var seis = 99;
      var vsele6 = 1;
    } else {
      var seis = 0;
      var vsele6 = 0;
    }

    var datosSelecFin =
      datosSelec + vsele1 + vsele2 + vsele3 + vsele4 + vsele5 + vsele6;
    //alert(datosSelecFin);
    var CostoFin = uno + dos + tres + cuatro + cinco + seis;
    //alert(CostoFin);

    if (datosSelecFin == 0) {
      alert("Selecciona un régimen");
    } else {
      //alert('Seleccionaste: ' + datosSelecFin);
      //alert('Monto final '+CostoFin);

      if (datosSelecFin == 1) {
        var ffionmF = CostoFin;
      }

      if (datosSelecFin == 2) {
        var ffionm = CostoFin * 0.2;
        var ffionmF = CostoFin - ffionm;
      }
      if (datosSelecFin == 3) {
        var ffionm = CostoFin * 0.3;
        var ffionmF = CostoFin - ffionm;
      }
      if (datosSelecFin == 4) {
        var ffionm = CostoFin * 0.4;
        var ffionmF = CostoFin - ffionm;
      }
      if (datosSelecFin == 5) {
        var ffionm = CostoFin * 0.5;
        var ffionmF = CostoFin - ffionm;
      }

      var totalapagar = Math.round(ffionmF);
      $("#costofinal21").empty();
      $("#costofinal21").append(
        '<div class="alert alert-warning text-center"><b>Costo mensual: $' +
          totalapagar +
          "</b> </div>"
      );
    }
  });

  //activar u desactivar de cobro mensual de pm
  $("#movingreo").change(function() {
    //alert($('select[name=idUnidad]').val());
    var movingreo = $("select[name=movingreo]").val();
    if (movingreo == 1) {
      $("#cantmovingreo").prop("disabled", false);
    } else {
      $("#cantmovingreo").prop("disabled", true);
    }
  });

  $("#movGas").change(function() {
    //alert($('select[name=idUnidad]').val());
    var movGas = $("select[name=movGas]").val();
    if (movGas == 1) {
      $("#cantmovGas").prop("disabled", false);
    } else {
      $("#cantmovGas").prop("disabled", true);
    }
  });

  //funciones de los select de cobro mensual
  $("#movingreoUno").change(function() {
    //alert($('select[name=idUnidad]').val());
    var movingreo = $("select[name=movingreoUno]").val();
    if (movingreo == 1) {
      $("#moviUno").prop("disabled", false);
    } else {
      $("#moviUno").prop("disabled", true);
    }
  });

  $("#movGasUno").change(function() {
    //alert($('select[name=idUnidad]').val());
    var movingreo = $("select[name=movGasUno]").val();
    if (movingreo == 1) {
      $("#moviDos").prop("disabled", false);
    } else {
      $("#moviDos").prop("disabled", true);
    }
  });

  $("#movIngUno").change(function() {
    //alert($('select[name=idUnidad]').val());
    var movingreo = $("select[name=movIngUno]").val();
    if (movingreo == 1) {
      $("#catMonUNO").prop("disabled", false);
    } else {
      $("#catMonUNO").prop("disabled", true);
    }
  });

  //funcion calculadora cobro mensual PM YAAAAAAAAAAAAAAAAAAAAAAAAAA NO MOVER
  $("#cobromensu").click(function() {
    $("#cosfinmensj").empty();

    var movingreoUno = $("#movingreoUno").val();
    var movGasUno = $("#movGasUno").val();
    var movIngUno = $("#movIngUno").val();

    if (movingreoUno > 0 && movGasUno > 0 && movIngUno > 0) {
      if (movingreoUno == 1) {
        var escritop = $("#moviUno").val();
        var unop = escritop - 100;
        var dosp = unop * 5;
        var tresp = dosp + 699;
        var finUno = tresp; //200 = 100
        //alert(finUno);
      } else {
        var finUno = movingreoUno;
      }

      if (movGasUno == 1) {
        var escritor = $("#moviDos").val();
        var unor = escritor - 100;
        var dosr = unor * 5;
        var tresr = dosp + 699;
        var finDos = tresr; //200 = 100
        //alert(finDos);
      } else {
        var finDos = movGasUno;
      }

      if (movIngUno == 1) {
        var escritot = $("#catMonUNO").val();
        var unot = escritot - 2000000;
        var dost = unot / 1000;
        var trest = dost * 10;
        var cuatrot = trest + 9999;
        var finTres = cuatrot;
        //alert(finTres);
      } else {
        var finTres = movIngUno;
      }

      var totalAn = parseInt(finUno) + parseInt(finDos) + parseInt(finTres);

      var Fiinal = Math.round(totalAn);

      $("#cosfinmensj").append(
        '<div class="alert alert-warning text-center"><b>Costo final: $' +
          Fiinal +
          "<br> </div>"
      );
    } else {
      var costoFinal = 199;
      $("#cosfinmensj").append(
        '<div class="alert alert-warning text-center"><b>Costo final: $' +
          costoFinal +
          "<br></b> </div>"
      );
    }
  });

  ///regularizacion persona moral
  $("#movingreoUno2").change(function() {
    //alert($('select[name=idUnidad]').val());
    var movingreo = $("select[name=movingreoUno2]").val();
    if (movingreo == 1) {
      $("#moviUno2").prop("disabled", false);
    } else {
      $("#moviUno2").prop("disabled", true);
    }
  });

  $("#movGasUno2").change(function() {
    //alert($('select[name=idUnidad]').val());
    var movingreo = $("select[name=movGasUno2]").val();
    if (movingreo == 1) {
      $("#moviDos2").prop("disabled", false);
    } else {
      $("#moviDos2").prop("disabled", true);
    }
  });

  $("#movIngUno2").change(function() {
    //alert($('select[name=idUnidad]').val());
    var movingreo = $("select[name=movIngUno2]").val();
    if (movingreo == 1) {
      $("#catMonUNO2").prop("disabled", false);
    } else {
      $("#catMonUNO2").prop("disabled", true);
    }
  });

  //////////////////////////////////////////////////////******************************************funciones para el preregistro
  //caluladora de personas fisicas especial preregistro
  $("#calcularPFE2").click(function() {
    /*obtengo valores*/
    $("#costofinal1").empty();
    $("#btnOcho").removeAttr('disabled');
    var datosSelec = 0;

    //obtenemos los regimen seleccionados
    if ($("#cInteres").prop("checked")) {
      var uno = 199;
      var vsele1 = 1;
    } else {
      var uno = 0;
      var vsele1 = 0;
    }
    if ($("#casalariado").prop("checked")) {
      var dos = 199;
      var vsele2 = 1;
    } else {
      var dos = 0;
      var vsele2 = 0;
    }

    if ($("#carrendamiento").prop("checked")) {
      var tres = 199;
      var vsele3 = 1;
    } else {
      var tres = 0;
      var vsele3 = 0;
    }

    if ($("#cservicios").prop("checked")) {
      var cuatro = 299;
      var vsele4 = 1;
    } else {
      var cuatro = 0;
      var vsele4 = 0;
    }

    if ($("#cempresaria").prop("checked")) {
      var cinco = 199;
      var vsele5 = 1;
    } else {
      var cinco = 0;
      var vsele5 = 0;
    }

    if ($("#crif").prop("checked")) {
      var seis = 99;
      var vsele6 = 1;
    } else {
      var seis = 0;
      var vsele6 = 0;
    }

    var datosSelecFin =
      datosSelec + vsele1 + vsele2 + vsele3 + vsele4 + vsele5 + vsele6;
    //alert(datosSelecFin);
    var CostoFin = uno + dos + tres + cuatro + cinco + seis;
    //alert(CostoFin);

    if (datosSelecFin == 0) {
      alert("Selecciona un régimen");
    } else {
      //alert('Seleccionaste: ' + datosSelecFin);
      //alert('Monto final '+CostoFin);

      if (datosSelecFin == 1) {
        var ffionmF = CostoFin;
      }

      if (datosSelecFin == 2) {
        var ffionm = CostoFin * 0.2;
        var ffionmF = CostoFin - ffionm;
      }
      if (datosSelecFin == 3) {
        var ffionm = CostoFin * 0.3;
        var ffionmF = CostoFin - ffionm;
      }
      if (datosSelecFin == 4) {
        var ffionm = CostoFin * 0.4;
        var ffionmF = CostoFin - ffionm;
      }
      if (datosSelecFin == 5) {
        var ffionm = CostoFin * 0.5;
        var ffionmF = CostoFin - ffionm;
      }

      var totalapagar = Math.round(ffionmF);
      $("#costofinal21").empty();
      $("#costofinal21").append(
        '<div class="alert alert-warning text-center"><b>Costo mensual: $' +
          totalapagar +
          "</b> </div>"
      );
      $("#costoCal").val(ffionmF);
    }
  });
  ///cobro mensual para el preregistro UNo
  $("#cobromensu2").click(function() {
    $("#cosfinmensj2").empty();

    var movingreoUno = $("#movingreoUno2").val();
    var movGasUno = $("#movGasUno2").val();
    var movIngUno = $("#movIngUno2").val();

    if (movingreoUno > 0 && movGasUno > 0 && movIngUno > 0) {
      if (movingreoUno == 1) {
        var escritop = $("#moviUno2").val();
        var unop = escritop - 100;
        var dosp = unop * 5;
        var tresp = dosp + 699;
        var finUno = tresp; //200 = 100
        //alert(finUno);
      } else {
        var finUno = movingreoUno;
      }

      if (movGasUno == 1) {
        var escritor = $("#moviDos2").val();
        var unor = escritor - 100;
        var dosr = unor * 5;
        var tresr = dosp + 699;
        var finDos = tresr; //200 = 100
        //alert(finDos);
      } else {
        var finDos = movGasUno;
      }

      if (movIngUno == 1) {
        var escritot = $("#catMonUNO2").val();
        var unot = escritot - 2000000;
        var dost = unot / 1000;
        var trest = dost * 10;
        var cuatrot = trest + 9999;
        var finTres = cuatrot;
        //alert(finTres);
      } else {
        var finTres = movIngUno;
      }

      var totalAn = parseInt(finUno) + parseInt(finDos) + parseInt(finTres);

      var Fiinal = Math.round(totalAn);

      $("#cosfinmensj2").append(
        '<div class="alert alert-warning text-center"><b>Costo final: $' +
          Fiinal +
          "<br> </div>"
      );
    } else {
      var costoFinal = 199;
      $("#cosfinmensj2").append(
        '<div class="alert alert-warning text-center"><b>Costo final: $' +
          costoFinal +
          "<br></b> </div>"
      );
    }
  });
  ///cobro mensual para el preregistro DOS
  //////////////////////////////////////////////////////******************************************funciones para el preregistro
  $("#cobromensu3").click(function() {
    $("#cosfinmensj").empty();

    var movingreoUno = $("#movingreoUno").val();
    var movGasUno = $("#movGasUno").val();
    var movIngUno = $("#movIngUno").val();

    if (movingreoUno > 0 && movGasUno > 0 && movIngUno > 0) {
      if (movingreoUno == 1) {
        var escritop = $("#moviUno").val();
        var unop = escritop - 100;
        var dosp = unop * 5;
        var tresp = dosp + 699;
        var finUno = tresp; //200 = 100
        //alert(finUno);
      } else {
        var finUno = movingreoUno;
      }

      if (movGasUno == 1) {
        var escritor = $("#moviDos").val();
        var unor = escritor - 100;
        var dosr = unor * 5;
        var tresr = dosp + 699;
        var finDos = tresr; //200 = 100
        //alert(finDos);
      } else {
        var finDos = movGasUno;
      }

      if (movIngUno == 1) {
        var escritot = $("#catMonUNO").val();
        var unot = escritot - 2000000;
        var dost = unot / 1000;
        var trest = dost * 10;
        var cuatrot = trest + 9999;
        var finTres = cuatrot;
        //alert(finTres);
      } else {
        var finTres = movIngUno;
      }

      var totalAn = parseInt(finUno) + parseInt(finDos) + parseInt(finTres);

      var Fiinal = Math.round(totalAn);

      $("#cosfinmensj").append(
        '<div class="alert alert-warning text-center"><b>Costo final: $' +
          Fiinal +
          "<br> </div>"
      );
    } else {
      var costoFinal = 199;
      $("#cosfinmensj").append(
        '<div class="alert alert-warning text-center"><b>Costo final: $' +
          costoFinal +
          "<br></b> </div>"
      );
    }
  });

  ////////////******************************************seccion para envio de informacion desde el preregistro *****************************************/////////////////////

  $("#EnviarGuardar").click(function() {
    /*obtengo valores*/
    var accion = "agergarAte";
    var accion2 = "pre";
    /* valores de formulario */
    var rfc = $("#rfc").val();
    var nombre = $("#nombre").val();
    var ape_paterno = $("#ape_paterno").val();
    var ape_materno = $("#ape_materno").val();
    var correo = $("#correo").val();
    var mesesin = $("#mesesin").val(); 
    var montoCal = $("#montoCal").val();/* monto calculado  */
    /* valor de periodo */
    var periodoRegu = $("#periodoRegu").val();
    /* valores de checkbox */
    var listaCompras = '';
    $("input[id=obliga]").each(function (index) {  
       if($(this).is(':checked')){
          listaCompras += ''+$(this).val()+',';
       }
    });
    

    var obliga2 = listaCompras.substring(0, listaCompras.length-1);;
    //alert(obliga2);
    //var obliga = $("#obliga:checked").val();
    /* valores de  */
    var cheInteres = $("#cheInteres:checked").val();
    var cheasalariado = $("#cheasalariado:checked").val();
    var chearrendamiento = $("#chearrendamiento:checked").val();
    var cheservicios = $("#cheservicios:checked").val();
    var cheempresaria = $("#cheempresaria:checked").val();
    var cherif = $("#cherif:checked").val();
    

    /*metodo ajax*/
    $.ajax({
      data: {
        accion,
        accion2,
        rfc,
        nombre,
        ape_paterno,
        ape_materno,
        correo,
        obliga2,
        cheInteres,
        cheasalariado,
        chearrendamiento,
        cheservicios,
        cheempresaria,
        cherif,
        montoCal,
        periodoRegu,
        mesesin
      },
      url: "controlador/simuladorControlador.php",
      type: "POST",
      success: function(response) {
        $("#avisoPF").append(
          '<div class="alert alert-warning text-center">Se envió por correo la cotización.</div>'
        );
      },
      error: function(response, status, error) {
        $("#avisoPF").append(
          '<div class="alert alert-danger text-center">Ocurrió un error favor de verificar sus datos.</div>'
        );
      }
    });
  });

  $("#guardarPM").click(function() {
    /*obtengo valores*/
    var accion = "agergarAte1";
    var accion2 = "pre";
    var rfc1 = $("#rfc1").val();
    var nombre1 = $("#nombre1").val();
    var ape_paterno1 = $("#ape_paterno1").val();
    var ape_materno1 = $("#ape_materno1").val();
    var correo1 = $("#correo1").val();
    var periodoRegu2 = $("#periodoRegu2").val();
    var obliga2 = $("#obliga2").val();
    var movIngUno2 = $("#movIngUno2").val();
    var regeneral = $("#regeneral").val();
    var fineslucra = $("#fineslucra").val();
    var montoCal1 = $("#montoCal1").val();

    /*metodo ajax*/
    $.ajax({
      data: {
        accion,
        accion2,
        rfc1,
        nombre1,
        ape_paterno1,
        ape_materno1,
        correo1,
        periodoRegu2,
        obliga2,
        movIngUno2,
        regeneral,
        fineslucra,
        montoCal1
      },
      url: "controlador/simuladorControlador.php",
      type: "POST",
      success: function(response) {
        $("#avisoPF2").append(
          '<div class="alert alert-success text-center">Se envió por correo la cotización.</div>'
        );
      },
      error: function(response, status, error) {
        $("#avisoPF2").append(
          '<div class="alert alert-danger text-center">Ocurrió un error favor de verificar sus datos.</div>'
        );
      }
    });
  });

  //botones para ver calmodal perfil
  $("#veoFisica").click(function() {
    $("#pfCal").css("display", "");
    $("#pmCal").css("display", "none");
  });

  $("#VeoMoral").click(function() {
    $("#pfCal").css("display", "none");
    $("#pmCal").css("display", "");
  });

  $("#btnSeguirFinalSanear2").click(function() {
    var idSaneRef2 = $("#idSaneRef2").val();
    var atrasada = 1;
    $.ajax({
      data: { idSaneRef2, atrasada },
      url: "controlador/preregistroControlador.php",
      type: "POST",
      success: function(response) {
        window.location.href = "atrasada.php";
      },
      error: function(response, status, error) {
        window.location.href = "atrasada.php";
      }
    });

    /*  */
  });


  /* seccion para la seleccion de persona fisica especial cuando seleccionamos RIF */
  $("#cherif").click(function() {
        
    $("#cheInteres").prop("checked",false);
    $("#cheasalariado").prop("checked",false);
    $("#chearrendamiento").prop("checked",false);
    $("#cheservicios").prop("checked",false);
    $("#cheempresaria").prop("checked",false);
    
  });
  

});
