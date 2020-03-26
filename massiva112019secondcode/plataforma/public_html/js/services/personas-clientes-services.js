

/* global api_url */

angular.module('app').service('PersonasClientesService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        /**
         @return {object}  personas_clientesList
         */
        this.getList = function (persona_id, ) {
            return $uhttp({
                url: api_url + 'personas_clientes/get_all',
                params: {
                    id: persona_id
                }
            });
        };
        /**
         @return {object} personas_clientesListInactive
         */

        this.getListInactive = function () {
            return $uhttp({
                url: api_url + 'Personas_clientes/get_all_inactive'
            });
        };

        /**
         @param {int(10) unsigned} id
         @return {object} personas_clientes     
         */
        this.getById = function (id) {
            return $uhttp({
                url: api_url + 'personas_clientes/get_by_id',
                params: {
                    id: id
                }
            });
        };
        /**
         @param {int(10) unsigned} persona_id
         @return {object} personas_clientes     
         */
        this.getByPersonaId = function (persona_id) {
            return $uhttp({
                url: api_url + 'personas_clientes/get_by_persona_id',
                params: {
                    persona_id: persona_id
                }
            });
        };
        /**
         @param {int(10) unsigned} id
         @return {object} personas_clientes     
         */
        this.getPersonaByRFC = function (rfc) {
            return $uhttp({
                url: api_url + 'personas_clientes/get_persona_by_rfc',
                params: {
                    rfc: rfc
                }
            });
        };
//         ----- POST -----
        /**
         //*/
        this.create = function (persona_id, data) {
            return $uhttp({
                url: api_url + 'personas_clientes/create',
                method: 'POST',
                params: {
                    persona_id: persona_id
                },
                data: data
            });
        };


        /**
         @param {int} id
         */

        this.update = function (id, data) {
            return $uhttp({
                url: api_url + 'personas_clientes/update',
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
                url: api_url + 'personas_clientes/inactivate',
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
                url: api_url + 'personas_clientes/reactivate',
                method: 'POST',
                params: {
                    id: id
                }
            });
        };
    }
]);
