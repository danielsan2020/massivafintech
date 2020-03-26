/* global api_url */

angular.module('app').service('SoporteComentariosService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        /**
         @return {object}  lista de comentarios
         */
        this.getListComentariosBySoporteTicketID = function (soporte_ticket_id) {
            return $uhttp({
                url: api_url + 'soporte_comentarios/get_all_comentarios_by_soporte_ticket_id',
                params: {soporte_ticket_id: soporte_ticket_id}
            });
        };
        this.getNextComentariosBySoporteTicketID = function (soporte_ticket_id, first_id) {
            return $uhttp({
                url: api_url + 'soporte_comentarios/get_next_comentarios_by_soporte_ticket_id',
                params: {soporte_ticket_id: soporte_ticket_id,
                registro_id:first_id}
            });
        };
        this.getLastComentariosBySoporteTicketdID = function (soporte_ticket_id, last_id) {
            return $uhttp({
                url: api_url + 'soporte_comentarios/get_last_comentarios_by_soporte_ticket_id',
                params: {soporte_ticket_id: soporte_ticket_id,
                registro_id:last_id}
            });
        };
        this.createTexto = function (soporte_ticket_id, data) {
            return $uhttp({
                url: api_url + 'soporte_comentarios/create_texto',
                method: 'POST',
                params: {soporte_ticket_id: soporte_ticket_id},
                data: data
            });
        };
        this.createFile = function (soporte_ticket_id, data) {
            return $uhttp({
                url: api_url + 'soporte_comentarios/create_file',
                method: 'POST',
                params: {soporte_ticket_id: soporte_ticket_id},
                data: data
            });
        };
    }
]);


