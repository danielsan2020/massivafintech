/* global Noty */
/*
 Controlador lista de contadores de un jefe contador 
 */
angular.module('app').controller('ContadoresListController', [
    '$scope',
    'UsuariosService',
    function ($scope, UsuariosService) {
        $scope.etiqueta_boton = 'Ver Personas';
        $scope.getState = function(contador_id){
            return "main.show_personas({contador_id:" + contador_id + "})";
        };
        $scope.contadores=[];
        UsuariosService.getContadoresAsignadosList().then(function(data){
            $scope.contadores = data.contadores;
        });
    }
]);

angular.module('app').controller('ContadoresListParaMostrarDeclaracionesController', [
    '$scope',
    'UsuariosService',
    function ($scope, UsuariosService) {
        $scope.etiqueta_boton = 'Ver Declaraciones';
        $scope.getState = function(contador_id){
            return "main.show_declaraciones({contador_id:" + contador_id + "})";
        };
        $scope.contadores=[];
        UsuariosService.getContadoresAsignadosList().then(function(data){
            $scope.contadores = data.contadores;
        });
    }
]);

angular.module('app').controller('ContadoresListParaMostrarDeclaracionesAtrasadasController', [
    '$scope',
    'UsuariosService',
    function ($scope, UsuariosService) {
        $scope.etiqueta_boton = 'Ver Declaraciones Atrasadas';
        $scope.getState = function(contador_id){
            return "main.show_declaraciones_atrasadas({contador_id:" + contador_id + "})";
        };
        $scope.contadores=[];
        UsuariosService.getContadoresAsignadosList().then(function(data){
            $scope.contadores = data.contadores;
        });
    }
]);
