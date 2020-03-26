/*
 Controlador SolicitudesSatCfdis
 */
/* global angular */

angular.module('app').controller("SolicitudesSatCfdisListCtrl", [
    '$scope',
    '$stateParams',
    'SolicitudesSatCfdisService',
    'PersonasService',
    function ($scope, $stateParams, SolicitudesSatCfdisService, PersonasService) {
        var persona_id = $stateParams.persona_id;
        $scope.solicitudes = [];
        SolicitudesSatCfdisService.getListByPersonaId(persona_id).then(function (data) {
            $scope.solicitudes = data.solicitudes;
        });
        $scope.solicitar_cfdis = function () {
            SolicitudesSatCfdisService.solicitarCfdis(persona_id).then(function () {
                SolicitudesSatCfdisService.getListByPersonaId(persona_id).then(function (data) {
                    $scope.solicitudes = data.solicitudes;
                });
            });
        };
        $scope.descargar = function(solicitud_id){
            SolicitudesSatCfdisService.descargarCfdis(solicitud_id).then(function () {
                SolicitudesSatCfdisService.getListByPersonaId(persona_id).then(function (data) {
                    $scope.solicitudes = data.solicitudes;
                });
            });
        };
    }
]);