/* global Noty, angular */
/*
 Controlador Lista de Personas que no tienen un contador asignado  
 */
angular.module('app').controller('PersonasSinContadorListCtrl', [
    '$scope',
    'PersonasService',
    function ($scope, PersonasService) {
        $scope.personas = [];
        PersonasService.getListPersonasSinJefeContador().then(function (data) {
            $scope.personas = data.personas;
            for (var i = 0; i < $scope.personas.length; i++) {
                var day = moment($scope.personas[i].fecha_registro);
                $scope.personas[i].fecha_registro = day.format("D/MMM/YYYY h:mm");
            }
        });
    }
]);

/*
 Controlador para asignar un contador  
 */
angular.module('app').controller('PersonasContadoresAsignarContadorCtrl', [
    '$scope',
    '$stateParams',
    '$state',
    'PersonasContadoresService',
    'PersonasService',
    'UsuariosService',
    function ($scope, $stateParams, $state, PersonasContadoresService, PersonasService, UsuariosService) {
        var persona_id = $stateParams.persona_id;
        var contador_selected_id = null;
        $scope.form_persona = [];
        PersonasService.getById(persona_id).then(function (data) {
            $scope.form_persona = data.persona;
            UsuariosService.getListContadoresAndPersonas().then(function (data) {
                $scope.contadores = data.contadores;
            });
        });
        $scope.submit = function () {
            var data_send = {persona_id: persona_id, contador_id: contador_selected_id};
            PersonasContadoresService.create(data_send).then(function () {
                $state.go('main.personas_contador_list');
            });
        };
        $scope.get_id_contador = function (id) {
            contador_selected_id = id;
        };
    }
]);
/*
 Controlador Lista de Personas que tienen un contador asignado  
 */
angular.module('app').controller('PersonasConContadorListCtrl', [
    '$scope',
    'PersonasService',
    function ($scope, PersonasService) {
        $scope.personas = [];
        PersonasService.getListPersonasConContador().then(function (data) {
            $scope.personas = data.personas;
            for (var i = 0; i < $scope.personas.length; i++) {
                var day = moment($scope.personas[i].fecha_registro);
                $scope.personas[i].fecha_registro = day.format("D/MMM/YYYY h:mm");
            }
        });
    }
]);

angular.module('app').controller('PersonasContadoresUpdateCtrl', [
    '$scope',
    '$stateParams',
    '$state',
    'PersonasContadoresService',
    'UsuariosService',
    function ($scope, $stateParams, $state, PersonasContadoresService, UsuariosService) {
        var persona_contador_id = $stateParams.persona_contador_id;
        var contador_selected_id = null;
        PersonasContadoresService.getPersonaByPersonaContadorId(persona_contador_id).then(function (data) {
            $scope.form_persona = data.persona;
            UsuariosService.getListContadoresAndPersonas().then(function (data) {
                $scope.contadores = data.contadores;
                for (var k = 0; k < $scope.contadores.length; k++) {
                    var contador_id = parseInt($scope.contadores[k].id);
                    var persona_contador_asignado_id = parseInt($scope.form_persona.contador_id); 
                    if (contador_id === persona_contador_asignado_id) {
                        $scope.form_persona.contador = angular.copy($scope.contadores[k]);
                        $scope.contador_selected = angular.copy($scope.contadores[k]);
                        $scope.contadores.splice(k, 1);
                    }
                }
            });
        });
        $scope.submit = function () {
            var data_send = {persona_id: $scope.form_persona.id, contador_id: contador_selected_id};
            PersonasContadoresService.update(persona_contador_id, data_send).then(function () {
                PersonasContadoresService.create(data_send).then(function () {
                    $state.go('main.personas_con_contador_list');

                });
            });
        };
        $scope.get_id_contador = function (id) {
            contador_selected_id = id;

        };
    }
]);
