$(document).ready(function () {
  OpenPay.setId('mfwfupejgk3jzhblyipn');
  OpenPay.setApiKey('pk_3a7e7190c2cc4cae8ad11d31dc1b9d8a');
  OpenPay.setSandboxMode(true);
  //implementaciópn de sistema antifraude; generación de id para el dispositivo
  var deviceSessionId = OpenPay.deviceData.setup("card-form", "deviceIdHiddenFieldName");
  console.log("Dentro del script");
});
//En lugar del submit se atrapa el evento clic
$('#save-button').on('click', function (event) {
  console.log("event Button");
  event.preventDefault();
  $("#save-button").prop("disabled", true);
  OpenPay.token.extractFormAndCreate('card-form', success_callbak, error_callbak);
});
//Si fue correcta la llamada se le asignara un tokeId al campo toke_Id
var success_callbak = function (response) {
  var token_id = response.data.id;
  $('#token_id').val(token_id);
  $('#card-form').submit();
};
//Si existe un problema se mustra un alert
var error_callbak = function (response) {
  console.log("Error");
  var desc = response.data.description != undefined ? response.data.description : response.message;
  alert("ERROR [" + response.status + "] " + desc);
  $("#save-button").prop("disabled", false);
};
