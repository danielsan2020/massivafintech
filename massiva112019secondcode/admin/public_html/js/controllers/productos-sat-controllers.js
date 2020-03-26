/*
 Controlador Lista de productos sat     
 */
/* global angular */

angular.module('app').controller("ProductosSatListCtrl", [
    '$scope',
    '$stateParams',
    'ProductosSatService',
    'GruposSatService',
    '$state',
    function ($scope, $stateParams, ProductosSatService, GruposSatService, $state) {
        var grupo_sat_id = $stateParams.grupo_sat_id;
        var division_sat_id = $stateParams.division_sat_id;
        $scope.grupos_sat = [];
        GruposSatService.getById(grupo_sat_id, division_sat_id).then(function (data) {
            $scope.grupos_sat = data.grupos_sat;

        });
        ProductosSatService.getProductosSatByGrupoId(grupo_sat_id).then(function (data) {
            $scope.productos_sat = data.productos_sat;
        });
//        $scope.inactivate = function (id) {
//            GruposSatService.inactivate(id).then(function () {
//                GruposSatService.getByDivisionesIdGruposSat(division_id).then(function (data) {
//                    $scope.grupos_sat = data.grupos_sat;
//                });
//            });
//        };
//        $scope.reactivate = function (id) {
//            PreguntasFrecuentesService.reactivate(id).then(function () {
//                PreguntasFrecuentesService.getList().then(function (data) {
//                    $scope.preguntas_frecuentes = data.preguntas_frecuentes;
//                });
//            });
//        };
    }
]);
/*
 Controlador Lista inactiva de Grupos_sat   
 */
angular.module("app").controller('GruposSatListInactiveCtrl', [
    '$scope',
    '$stateParams',
    '$state',
    'GruposSatService',
    'ProductosSatService',
    function ($scope, $stateParams, $state, GruposSatService, ProductosSatService) {
        var grupo_sat_id = $stateParams.grupo_sat_id;
        var division_sat_id = $stateParams.division_sat_id;
        $scope.grupos_sat = [];
        GruposSatService.getById(grupo_sat_id, division_sat_id).then(function (data) {
            $scope.grupos_sat = data.grupos_sat;

        });
        GruposSatService.getListInactiveByDivisionId(division_id, ).then(function (data) {
            $scope.grupos_sat = data.grupos_sat;
        });
        $scope.reactivate = function (id) {
            GruposSatService.reactivate(id).then(function () {
                GruposSatService.getListInactiveByDivisionId(division_id, ).then(function (data) {
                    $scope.grupos_sat = data.grupos_sat;

                });
            });
        };

    }
]);
