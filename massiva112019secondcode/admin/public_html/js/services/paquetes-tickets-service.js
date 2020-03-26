

/* global api_url */

angular.module('app').service('PaquetesTicketsService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        /**
         @return {object}  paquetes_ticketsList
         */
        this.getList = function () {
            return $uhttp({
                url: api_url + 'paquetes_tickets/get_all'
            });
        };
        /**
         @return {object} paquetes_ticketsListInactive
         */

        this.getListInactive = function () {
            return $uhttp({
                url: api_url + 'paquetes_tickets/get_all_inactive'
            });
        };

        /**
         @param {int(10) unsigned} id
         @return {object} paquetes_tickets     
         */
        this.getById = function (id) {
            return $uhttp({
                url: api_url + 'paquetes_tickets/get_by_id',
                params: {
                    id: id
                }
            });
        };
        // ----- POST -----
        this.create = function (data) {
            return $uhttp({
                url: api_url + 'paquetes_tickets/create',
                method: 'POST',
                data: data
            });
        };
        /**
         @param {int} id
         */

        this.update = function (id, data) {
            return $uhttp({
                url: api_url + 'paquetes_tickets/update',
                method: 'POST',
                params: {
                    id: id
                },
                data: data
            });
        };
        /**
         @param {int} id
         */
        this.inactivate = function (id) {
            return $uhttp({
                url: api_url + 'paquetes_tickets/inactivate',
                method: 'POST',
                params: {
                    id: id
                }
            });
        };
        /**
         @param {int} id
         */

        this.reactivate = function (id) {
            return $uhttp({
                url: api_url + 'paquetes_tickets/reactivate',
                method: 'POST',
                params: {
                    id: id
                }
            });
        };
    }
]);
