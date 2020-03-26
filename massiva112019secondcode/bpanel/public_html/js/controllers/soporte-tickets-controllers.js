/* global angular */

angular.module("app").controller('SoporteListCtrl', [
    '$scope',
    '$rootScope',
    'SoporteTicketsService',
    function ($scope, $rootScope, SoporteTicketsService) {
        var usuario_id = $rootScope.usuario_acceso.id;
        $scope.lista_tickets = [];
        SoporteTicketsService.getTicketsByContadorId(usuario_id).then(function (data) {
            $scope.lista_tickets = data.tickets;
            $scope.total_tickets = data.total_tickets;
        });
    }
]);