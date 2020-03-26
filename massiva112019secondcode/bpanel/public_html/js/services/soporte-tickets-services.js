/* global api_url */

angular.module('app').service('SoporteTicketsService', [
    '$uhttp',
    function ($uhttp) {
        this.getTicketsByContadorId = function (id) {
            return $uhttp({
                url: api_url + 'soporte_tickets/get_tickets_by_contador_id',
                params: {
                    id: id
                }
            });
        };

        this.getById = function (id) {
            return $uhttp({
                url: api_url + 'soporte_tickets/get_ticket_by_id',
                params: {
                    id: id
                }
            });
        };
    }
]);