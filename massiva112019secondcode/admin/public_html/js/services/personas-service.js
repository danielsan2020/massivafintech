/* global api_url, angular */

angular.module('app').service('PersonasService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        this.getList = function () {
            return $uhttp({
                url: api_url + 'personas/get_all_personas'
            });
        };
        /**
         @return {object}  PersonasSinJefeContadoresListCtrl
         */
        this.getListPersonasSinJefeContador = function () {
            return $uhttp({
                url: api_url + 'personas/get_all_personas_sin_contador'
            });
        };
        /**
         @return {object}  PersonasConJefeContadorListCtrl
         */
        this.getListPersonasConContador = function () {
            return $uhttp({
                url: api_url + 'personas/get_all_personas_con_contador'
            });
        };

        this.getById = function (id) {
            return $uhttp({
                url: api_url + 'personas/get_by_id',
                params: {
                    id: id
                }
            });
        };

    }
]);
