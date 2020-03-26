/* global api_url */

angular.module('app').service('SoporteComentariosService', [
    '$uhttp',
    function ($uhttp) {
        this.getListComentariosBySoporteTicketId = function (id) {
            return $uhttp({
                url: api_url + 'soporte_comentarios/get_list_comentarios_by_soporte_ticket_id',
                params: {
                    id: id
                }
            });
        };
        this.getNextComentariosBySoporteTicketID = function (soporte_ticket_id, first_id) {
            return $uhttp({
                url: api_url + 'soporte_comentarios/get_next_comentarios_by_soporte_ticket_id',
                params: {soporte_ticket_id: soporte_ticket_id,
                    registro_id: first_id}
            });
        };
        this.getLastComentariosBySoporteTicketID = function (soporte_ticket_id, last_id) {
            return $uhttp({
                url: api_url + 'soporte_comentarios/get_last_comentarios_by_soporte_ticket_id',
                params: {soporte_ticket_id: soporte_ticket_id,
                registro_id:last_id}
            });
        };
        this.createComentarioText = function (soporte_ticket_id, data) {
            return $uhttp({
                url: api_url + 'soporte_comentarios/create_comentario_text',
                method: 'POST',
                params: {soporte_ticket_id: soporte_ticket_id},
                data: data
            });
        };
        this.createComentarioFile = function (soporte_ticket_id, persona_id, data) {
            return $uhttp({
                url: api_url + 'soporte_comentarios/create_comentario_file',
                method: 'POST',
                params: {soporte_ticket_id: soporte_ticket_id, persona_id: persona_id},
                data: data
            });
        };
    }
]);