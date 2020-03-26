
/* global api_url, angular */

angular.module('app').service('GruposSatService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        /**
         @return {object}  preguntas_frecuentesList
         */
        this.getList = function () {
            return $uhttp({
                url: api_url + 'preguntas_frecuentes/get_all'
            });
        };
        /**
         @return {object} preguntas_frecuentesListInactive
         */

        this.getListInactive = function () {
            return $uhttp({
                url: api_url + 'preguntas_frecuentes/get_all_inactive',
            });
        };

        /**
         @return {object} grupos_sat ListInactive
         */

        this.getListInactiveByDivisionId = function (division_id) {
            return $uhttp({
                url: api_url + 'grupos_sat/get_all_inactive_by_division_id',
                params: {
                    division_id: division_id
                }
            });
        };

        /**
         @param {int(10) unsigned} id
         @return {object} grupos_sat     
         */
        this.getById = function (id, division_id) {
            return $uhttp({
                url: api_url + 'grupos_sat/get_by_id',
                params: {
                    id: id,
                    division_id: division_id
                }
            });
        };
        /**
         @param {int(10) unsigned} division_id
         @return {object} grupos_sat     
         */
        this.getByDivisionesIdGruposSat = function (division_id) {
            return $uhttp({
                url: api_url + 'grupos_sat/get_by_division_id',
                params: {
                    division_id: division_id
                }
            });
        };
        // ----- POST -----
        //   /**
        //   @param {int(10) unsigned} division_id
        //*/
        this.create = function (division_id, data) {
            return $uhttp({
                url: api_url + 'grupos_sat/create',
                method: 'POST',
                params: {
                    division_id: division_id
                },
                data: data
            });
        };
        /**
         @param {int} id
         */

        this.update = function (id, division_id, data) {
            return $uhttp({
                url: api_url + 'grupos_sat/update',
                method: 'POST',
                params: {
                    id: id,
                    division_id: division_id
                },
                data: data
            });
        };
        /**
         @param {int} id
         */
        this.inactivate = function (id) {
            return $uhttp({
                url: api_url + 'grupos_sat/inactivate',
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
                url: api_url + 'grupos_sat/reactivate',
                method: 'POST',
                params: {
                    id: id
                }
            });
        };
    }
]);


