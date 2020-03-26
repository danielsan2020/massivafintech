
/* global Noty */
/*
 Controlador Lista de Paquetes     
 */
angular.module('app').controller("DeclaracionesAtrasadasListCtrl", [
    '$scope',
    'DeclaracionesAtrasadasService',
    function ($scope, DeclaracionesAtrasadasService) {
        DeclaracionesAtrasadasService.getMonthlyDeclarationsPrev().then(function (data) {
            $scope.lista_declaraciones_atrasadas = data.lista_declaraciones_atrasadas;
            for (var i = 0; i < $scope.lista_declaraciones_atrasadas.length; i++) {
                var mes_y_anio = moment($scope.lista_declaraciones_atrasadas[i].anio_correspondiente + "-" + $scope.lista_declaraciones_atrasadas[i].mes_correspondiente, "YYYY-MM");
                $scope.lista_declaraciones_atrasadas[i].mes_y_anio = mes_y_anio.format("YYYY MMM");
            }
        });
        $scope.inactivate = function (id) {
            DeclaracionesAtrasadasService.inactivate(id).then(function () {
                DeclaracionesAtrasadasService.getMonthlyDeclarationsPrev().then(function (data) {
                    $scope.lista_declaraciones_atrasadas = data.lista_declaraciones_atrasadas;
                    for (var i = 0; i < $scope.lista_declaraciones_atrasadas.length; i++) {
                        var mes_y_anio = moment($scope.lista_declaraciones_atrasadas[i].anio_correspondiente + "-" + $scope.lista_declaraciones_atrasadas[i].mes_correspondiente, "YYYY-MM");
                        $scope.lista_declaraciones_atrasadas[i].mes_y_anio = mes_y_anio.format("YYYY MMM");
                    }
                });
            });
        };
        $scope.activate = function (id) {
            DeclaracionesAtrasadasService.activate(id).then(function () {
                DeclaracionesAtrasadasService.getMonthlyDeclarationsPrev().then(function (data) {
                    $scope.lista_declaraciones_atrasadas = data.lista_declaraciones_atrasadas;
                    for (var i = 0; i < $scope.lista_declaraciones_atrasadas.length; i++) {
                        var mes_y_anio = moment($scope.lista_declaraciones_atrasadas[i].anio_correspondiente + "-" + $scope.lista_declaraciones_atrasadas[i].mes_correspondiente, "YYYY-MM");
                        $scope.lista_declaraciones_atrasadas[i].mes_y_anio = mes_y_anio.format("YYYY MMM");
                    }
                });
            });
        };
    }
]);
