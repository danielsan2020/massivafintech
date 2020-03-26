/*
 Controlador Lista de Grupos sat     
 */
/* global angular */

angular.module('app').controller("GruposSatListCtrl", [
    '$scope',
    '$stateParams',
    'DivisionesSatServices',
    'GruposSatService',
    '$state',
    function ($scope, $stateParams, DivisionesSatServices, GruposSatService, $state) {
        var division_id = $stateParams.id;
        $scope.grupos_sat = [];
        DivisionesSatServices.getById(division_id).then(function (data) {
            $scope.division_sat = data.division_sat;

        });
        GruposSatService.getByDivisionesIdGruposSat(division_id).then(function (data) {
            $scope.grupos_sat = data.grupos_sat;
        });
        $scope.inactivate = function (id) {
            GruposSatService.inactivate(id).then(function () {
                GruposSatService.getByDivisionesIdGruposSat(division_id).then(function (data) {
                    $scope.grupos_sat = data.grupos_sat;
                });
            });
        };
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
    'DivisionesSatServices',
    function ($scope, $stateParams, $state, GruposSatService, DivisionesSatServices) {
        var division_id = $stateParams.division_sat_id;
        DivisionesSatServices.getById(division_id).then(function (data) {
            $scope.division_sat = data.division_sat;

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
/*
 * Controlador Alta de Preguntas_frecuentes         
 */
angular.module('app').controller("GruposSatCreateCtrl", [
    '$scope',
    '$state',
    '$stateParams',
    'GruposSatService',
    'DivisionesSatServices',
    function ($scope, $state, $stateParams, GruposSatService, DivisionesSatServices) {
        $scope.heading = 'Crear ';
        var division_id = $stateParams.division_id;
        DivisionesSatServices.getById(division_id).then(function (data) {
            $scope.division_sat = data.division_sat;
        });
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_grupos_sat);
            GruposSatService.create(division_id, data_send).then(function () {
                $state.go('main.grupos_sat_by_divisiones_sat_list', {
                    id: division_id
                });
            });
        };
    }
]);
/*
 Controlador modificacion de Preguntas_frecuentes         
 */
angular.module('app').controller('GruposSatUpdateCtrl', [
    '$scope',
    '$state',
    '$stateParams',
    'GruposSatService',
    'DivisionesSatServices',
    function ($scope, $state, $stateParams, GruposSatService, DivisionesSatServices) {
        $scope.heading = "Editar ";
        var id = $stateParams.id;
        var division_id = $stateParams.division_id;
        DivisionesSatServices.getById(division_id).then(function (data) {
            $scope.division_sat = data.division_sat;
        });
        GruposSatService.getById(id, division_id).then(function (data) {
            $scope.form_grupos_sat = data.grupos_sat;
        });
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_grupos_sat);
            GruposSatService.update(id, division_id, data_send).then(function () {
                $state.go('main.grupos_sat_by_divisiones_sat_list', {
                    id: division_id
                });
            });
        };
    }
]);



