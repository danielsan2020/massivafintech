
/* global api_url */

angular.module('app').service('PaquetesService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        /**
         @return {object}  paquetesList
         */
        this.getList = function () {
            return $uhttp({
                url: api_url + 'paquetes/get_all'
            });
        };
        /**
         @return {object} paquetesListInactive
         */

        this.getListInactive = function () {
            return $uhttp({
                url: api_url + 'paquetes/get_all_inactive'
            });
        };

        /**
         @param {int(10) unsigned} id
         @return {object} paquetes     
         */
        this.getById = function (id) {
            return $uhttp({
                url: api_url + 'paquetes/get_by_id',
                params: {
                    id: id
                }
            });
        };
        /**
         @param {tinyint(4)} tipo
         @return {object} paquetes     
         */
        this.getByTipo = function (tipo) {
            return $uhttp({
                url: api_url + 'paquetes/get_by_tipo',
                params: {
                    tipo: tipo
                }
            });
        };
        // ----- POST -----
        this.create = function (data) {
            return $uhttp({
                url: api_url + 'paquetes/create',
                method: 'POST',
                data: data
            });
        };
        /**
         @param {int} id
         */

        this.update = function (id, data) {
            return $uhttp({
                url: api_url + 'paquetes/update',
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
                url: api_url + 'paquetes/inactivate',
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
                url: api_url + 'paquetes/reactivate',
                method: 'POST',
                params: {
                    id: id
                }
            });
        };
    }
]);
