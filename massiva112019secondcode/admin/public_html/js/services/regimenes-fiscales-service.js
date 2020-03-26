

/* global api_url */

angular.module('app').service('RegimenesFiscalesService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        /**
         @return {object}  PersonasSinJefeContadoresListCtrl
         */
        this.getAllRegimenesFiscales = function () {
            return $uhttp({
                url: api_url + 'regimenes_fiscales/get_all_regimenes_fiscales'
            });
        };
        // ----- GET -----
        /**
         @return {object}  regimenes_fiscalesList
         */
        this.getList = function () {
            return $uhttp({
                url: api_url + 'regimenes_fiscales/get_all'
            });
        };
        /**
         @return {object} regimenes_fiscalesListInactive
         */

        this.getListInactive = function () {
            return $uhttp({
                url: api_url + 'regimenes_fiscales/get_all_inactive'
            });
        };

        /**
         @param {int(10) unsigned} id
         @return {object} regimenes_fiscales     
         */
        this.getById = function (id) {
            return $uhttp({
                url: api_url + 'regimenes_fiscales/get_by_id',
                params: {
                    id: id
                }
            });
        };
        /**
         @param {int(10) unsigned} id
         @return {object} regimenes_fiscales     
         */
        this.getAllRegimenesByPaqueteId = function (paquete_id) {
            return $uhttp({
                url: api_url + 'regimenes_fiscales/get_all_regimenes_by_paquete_id',
                params: {
                    id: paquete_id
                }
            });
        };

        /**
         @param {int(10) unsigned} id
         @return {object} regimenes_fiscales     
         */
        this.getByPaqueteId = function (paquete_id) {
            return $uhttp({
                url: api_url + 'paquetes_regimenes/get_by_paquete_id',
                params: {
                    id: paquete_id
                }
            });
        };
        // ----- POST -----

        this.create = function (data) {
            return $uhttp({
                url: api_url + 'regimenes_fiscales/create',
                method: 'POST',
                data: data
            });
        };
        /**
         @param {int} id
         */

        this.update = function (id, data) {
            return $uhttp({
                url: api_url + 'regimenes_fiscales/update',
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
                url: api_url + 'regimenes_fiscales/inactivate',
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
                url: api_url + 'regimenes_fiscales/reactivate',
                method: 'POST',
                params: {
                    id: id
                }
            });
        };
    }
]);
