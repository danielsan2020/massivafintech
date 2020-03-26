

/* global Noty, angular */
/*
 Controlador Lista de Paquetes     
 */
angular.module('app').controller("PaquetesListCtrl", [
    '$scope',
    'PaquetesService',
    function ($scope, PaquetesService) {
        $scope.paquetes = [];
        PaquetesService.getList().then(function (data) {
            $scope.paquetes = data.paquetes;
            $scope.total_paquetes = data.total_paquetes;
        });
        $scope.inactivate = function (id) {
            PaquetesService.inactivate(id).then(function () {
                PaquetesService.getList().then(function (data) {
                    $scope.paquetes = data.paquetes;
                    $scope.total_paquetes = data.total_paquetes;
                });
            });
        };
    }
]);
/*
 Controlador Lista inactiva de Paquetes   
 */
angular.module("app").controller('PaquetesListInactiveCtrl', [
    '$scope',
    'PaquetesService',
    function ($scope, PaquetesService) {
        PaquetesService.getListInactive().then(function (data) {
            $scope.paquetes = data.paquetes;
            $scope.total_paquetes = data.total_paquetes;
        });
        $scope.reactivate = function (id) {
            PaquetesService.reactivate(id).then(function () {
                PaquetesService.getListInactive().then(function (data) {
                    $scope.paquetes = data.paquetes;
                    $scope.total_paquetes = data.total_paquetes;
                });
            });
        };
    }
]);
/*
 * Controlador Alta de Paquetes         
 */
angular.module('app').controller("PaquetesCreateCtrl", [
    '$scope',
    '$state',
    'PaquetesService',
    'RegimenesFiscalesService',
    function ($scope, $state, PaquetesService, RegimenesFiscalesService) {
        $scope.heading = 'Crear ';
        $scope.paquete_form = {nombre: '', precio: '', periodo: '', tipo: '', cfdis_al_mes: '', mostrar_en_principal: '-1'};
        $scope.tipos = [{
                tipo: 'Persona Física',
                value: 1,
                selected: true
            }];
        $scope.paquete_form.tipo = 1;
        RegimenesFiscalesService.getAllRegimenesFiscales().then(function (data) {
            $scope.regimenes_fiscales = data.regimenes_fiscales;
        });
        $scope.submit = function () {
            var data_send = angular.copy($scope.paquete_form);
            PaquetesService.create(data_send).then(function () {
                $state.go('main.paquetes_list');
            });
        };
    }
]);
/*
 Controlador modificacion de Paquetes         
 */
angular.module('app').controller('PaquetesUpdateCtrl', [
    '$scope',
    '$state',
    '$stateParams',
    'PaquetesService',
    'RegimenesFiscalesService',
    '$timeout',
    function ($scope, $state, $stateParams, PaquetesService, RegimenesFiscalesService, $timeout) {
        $scope.heading = 'Detalles del ';
        var paquete_id = $stateParams.id;
        $scope.tipos = [
            {
                tipo: 'Persona Física',
                value: 1,
                selected: true
            }
        ];
        RegimenesFiscalesService.getAllRegimenesByPaqueteId(paquete_id).then(function (data_regimenes) {
            $scope.regimenes_fiscales = data_regimenes.regimenes_fiscales;
            PaquetesService.getById(paquete_id).then(function (data) {
                $scope.paquete_form = data.paquete;
                $scope.paquete_form.tipo = 1;
                if ($scope.paquete_form.mostrar_en_principal === '1') {
                    $scope.paquete_form.mostrar_en_principal = "Sí";
                } else {
                    $scope.paquete_form.mostrar_en_principal = "No";
                }
            });
        });
//        $scope.submit = function () {
//            var data_send = angular.copy($scope.paquete_form);
//            PaquetesService.update(id, data_send).then(function () {
//                $state.go('main.paquetes_list');
//            });
//        };
    }
]);

