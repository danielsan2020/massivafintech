/* global angular */

angular.module("app").controller('SoporteListaTicketAbiertoPendienteCtrl', [
    '$scope',
    '$rootScope',
    'SoporteTicketsService',
    function ($scope, $rootScope, SoporteTicketsService) {
        $scope.lista_tickets = [];
        SoporteTicketsService.getListTicketsAbiertoCerrado($rootScope.usuario_acceso.persona_id).then(function (data_response) {
            $scope.lista_tickets = data_response.lista_tickets;
        });

    }
]);
angular.module("app").controller('SoporteCreateTicketCtrl', [
    '$scope',
    '$state',
    'SoporteCategoriasService',
    'SoporteTicketsService',
    function ($scope, $state, SoporteCategoriasService, SoporteTicketsService) {
        $scope.soporte_ticket_form = {
            categoria_id: '',
            descripcion: '',
            comentario: '',
            number_files_uploading: 0
        };
        $scope.requerido = true;
        $scope.soporte_categorias_contables = [];
        $scope.soporte_categorias_tecnicos = [];
        $scope.archivos = {nuevos: []};
        SoporteCategoriasService.getAllSoporteCategoriasByTipo(1).then(function (data_response) {
            $scope.soporte_categorias_contables = data_response.soporte_categorias;
            SoporteCategoriasService.getAllSoporteCategoriasByTipo(2).then(function (data_response) {
                $scope.soporte_categorias_tecnicos = data_response.soporte_categorias;
            });
        });
        $scope.removeArchivoNuevo = function (index) {
            $scope.archivos.nuevos.splice(index, 1);
        };
        $scope.submit = function () {
            var data_send = angular.copy($scope.soporte_ticket_form);
            if ($scope.archivos.nuevos.length > 0) {
                data_send.new_files_uploading = [];
                data_send.number_files_uploading = $scope.archivos.nuevos.length;
                for (var i = 0; i < $scope.archivos.nuevos.length; i++) {
                    data_send['new_files_uploading_' + i] = $scope.archivos.nuevos[i];
                }
            } else {
                data_send.number_files_uploading = 0;
            }
            SoporteTicketsService.create(data_send).then(function (data_response) {
                $state.go("main.soporte_lista_tickets_abierto_pendiente");
            });
        };
    }
]);

