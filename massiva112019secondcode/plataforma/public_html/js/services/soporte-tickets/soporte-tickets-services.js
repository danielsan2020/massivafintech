
/* global api_url */

angular.module('app').service('SoporteTicketsService', [
    '$uhttp',
    function ($uhttp) {
        /**
         @param {int(10) unsigned} id
         @return {object} soporte_ticket     
         */
        this.getById = function (id) {
            return $uhttp({
                url: api_url + 'soporte_tickets/get_by_id',
                params: {
                    id: id
                }
            });
        };
        // ----- GET -----
        /**
         @return {object}  lista de tickets
         */
        this.getListTicketsAbiertoCerrado = function (persona_id) {
            return $uhttp({
                url: api_url + 'soporte_tickets/get_all_tickets_abierto_pendiente_by_persona_id',
                params: {persona_id: persona_id}
            });
        };
        // ----- POST -----
        this.create = function (data) {
            return $uhttp({
                url: api_url + 'soporte_tickets/create',
                method: 'POST',
                data: data
            });
        };
//        /**
//         @return {object} paquetesListInactive
//         */
//
//        this.getListInactive = function () {
//            return $uhttp({
//                url: api_url + 'Paquetes/get_all_inactive'
//            });
//        };
//

//        /**
//         @param {tinyint(4)} tipo
//         @return {object} paquetes     
//         */
//        this.getByTipo = function (tipo) {
//            return $uhttp({
//                url: api_url + 'paquetes/get_by_tipo',
//                params: {
//                    tipo: tipo
//                }
//            });
//        };
//        /**
//         @param {int} id
//         */
//
//        this.update = function (id, data) {
//            return $uhttp({
//                url: api_url + 'paquetes/update',
//                method: 'POST',
//                params: {
//                    id: id
//                },
//                data: data
//            });
//        };
//        /**
//         @param {int} id
//         */
//        this.inactivate = function (id) {
//            return $uhttp({
//                url: api_url + 'paquetes/inactivate',
//                method: 'POST',
//                params: {
//                    id: id
//                }
//            });
//        };
//        /**
//         @param {int} id
//         */
//
//        this.reactivate = function (id) {
//            return $uhttp({
//                url: api_url + 'paquetes/reactivate',
//                method: 'POST',
//                params: {
//                    id: id
//                }
//            });
//        };
    }
]);



