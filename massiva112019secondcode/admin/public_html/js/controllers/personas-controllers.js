/* global angular */

/**
 Controlador Personas
 */
angular.module('app').controller("PersonasListCtrl", [
    '$scope',
    'PersonasService',
    function ($scope, PersonasService) {
        $scope.personas = [];
        PersonasService.getList().then(function (data) {
            $scope.personas = data.personas;
        });
        $scope.inactivate = function (id) {
            PersonasService.inactivate(id).then(function () {
                PersonasService.getList().then(function (data) {
                    $scope.personas = data.personas;
                });
            });
        };
    }
]);
/**
 Controlador Lista inactiva de Diviciones_sat   
 */
angular.module("app").controller('DivisionesSatListInactiveCtrl', [
    '$scope',
    'DivisionesSatServices',
    function ($scope, DivisionesSatServices) {
        var tipos = [
            {id: "1", tipo: 'Productos'},
            {id: "2", tipo: 'Servicios'}
        ];
        DivisionesSatServices.getListInactive().then(function (data) {
            $scope.divisiones_sat = data.divisiones_sat;
            for (var i = 0; i < $scope.divisiones_sat.length; i++) {
                $scope.divisiones_sat[i].tipo_texto = getTypeText($scope.divisiones_sat[i].tipo);
            }
        });
        function getTypeText(tipo_id) {
            for (var i = 0; i < tipos.length; i++) {
                if (tipo_id === tipos[i].id) {
                    return tipos[i].tipo;
                }
            }
        }
        $scope.reactivate = function (id) {
            DivisionesSatServices.reactivate(id).then(function () {
                DivisionesSatServices.getListInactive().then(function (data) {
                    $scope.divisiones_sat = data.divisiones_sat;
                    for (var i = 0; i < $scope.divisiones_sat.length; i++) {
                        $scope.divisiones_sat[i].tipo_texto = getTypeText($scope.divisiones_sat[i].tipo);
                    }
                });
            });
        };
    }
]);
/*
 * Controlador Alta de Divisiones_sat         
 */
angular.module('app').controller("DivisionesSatCreateCtrl", [
    '$scope',
    '$state',
    'DivisionesSatServices',
    function ($scope, $state, DivisionesSatServices) {
        $scope.heading = 'Agregar';
        $scope.form_divisiones_sat = {clave: '', descripcion: '', tipo: '', iva_texto: '', iva_retenido_texto: '', isr_retenido_texto: ''};
        $scope.tipos = [
            {id: "1", tipo: 'Productos'},
            {id: "2", tipo: 'Servicios'}
        ];
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_divisiones_sat);
            data_send.iva = conversion(data_send.iva_texto);
            data_send.iva_retenido = conversion(data_send.iva_retenido_texto);
            data_send.isr_retenido = conversion(data_send.isr_retenido_texto);

            DivisionesSatServices.create(data_send).then(function () {
                $state.go('main.divisiones_sat');
            });
        };
        function conversion(num_texto) {
            if (num_texto > 10) {
                return parseFloat("0." + num_texto);
            } else {
                return parseFloat("0.0" + num_texto);
            }
        }
    }
]);
/*
 Controlador modificacion de Regimenes_fiscales         
 */
angular.module('app').controller('DivisionesSatUpdateCtrl', [
    '$scope',
    '$state',
    '$stateParams',
    'DivisionesSatServices',
    function ($scope, $state, $stateParams, DivisionesSatServices) {
        $scope.heading = 'Editar';
        $scope.form_divisiones_sat = {clave: '', descripcion: '', tipo: '', iva_texto: '', iva_retenido_texto: '', isr_retenido_texto: ''};
        var id = $stateParams.id;
        $scope.tipos = [
            {id: "1", tipo: 'Productos'},
            {id: "2", tipo: 'Servicios'}
        ];
        DivisionesSatServices.getById(id).then(function (data) {
            $scope.form_divisiones_sat = data.division_sat;
            $scope.form_divisiones_sat.iva_texto = $scope.form_divisiones_sat.iva_texto.replace("%", "");
            $scope.form_divisiones_sat.iva_retenido_texto = $scope.form_divisiones_sat.iva_retenido_texto.replace("%", "");
            $scope.form_divisiones_sat.isr_retenido_texto = $scope.form_divisiones_sat.isr_retenido_texto.replace("%", "");
        });
        $scope.submit = function () {
            var data_send = angular.copy($scope.form_divisiones_sat);
            data_send.iva = conversion(data_send.iva_texto);
            data_send.iva_retenido = conversion(data_send.iva_retenido_texto);
            data_send.isr_retenido = conversion(data_send.isr_retenido_texto);
            DivisionesSatServices.update(id, data_send).then(function () {
                $state.go('main.divisiones_sat');
            });
        };
        function conversion(num_texto) {
            if (num_texto > 10) {
                return parseFloat("0." + num_texto);
            } else {
                return parseFloat("0.0" + num_texto);
            }
        }
    }
]);