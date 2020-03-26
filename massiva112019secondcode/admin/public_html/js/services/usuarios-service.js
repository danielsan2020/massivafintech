
/* global api_url */

angular.module('app').service('UsuariosService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        /**
         @return {object}  usuariosList
         */
        this.getList = function () {
            return $uhttp({
                url: api_url + 'usuarios/get_all'
            });
        };
        /**
         @return {object} usuariosListInactive
         */

        this.getListInactive = function () {
            return $uhttp({
                url: api_url + 'usuarios/get_all_inactive'
            });
        };

        /**
         @param {int(10) unsigned} id
         @return {object} usuarios     
         */
        this.getById = function (id) {
            return $uhttp({
                url: api_url + 'usuarios/get_by_id',
                params: {
                    id: id
                }
            });
        };

        /**
         @param {int(10) unsigned} id
         @return {object} usuarios     
         */
        this.getContadorById = function (id) {
            return $uhttp({
                url: api_url + 'usuarios/get_contador_by_id',
                params: {
                    id: id
                }
            });
        };
        this.getListJefesContadores = function () {
            return $uhttp({
                url: api_url + 'usuarios/get_all_contadores'
            });
        };

        this.getListContadoresAndPersonas = function () {
            return $uhttp({
                url: api_url + 'usuarios/get_all_contadores_y_personas_de_cada_contador'
            });
        };
        // ----- POST -----
        this.create = function (data) {
            return $uhttp({
                url: api_url + 'usuarios/create',
                method: 'POST',
                data: data
            });
        };
        /**
         @param {int} id
         */

        this.update = function (id, data) {
            return $uhttp({
                url: api_url + 'usuarios/update',
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
                url: api_url + 'usuarios/inactivate',
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
                url: api_url + 'usuarios/reactivate',
                method: 'POST',
                params: {
                    id: id
                }
            });
        };
    }
]);
