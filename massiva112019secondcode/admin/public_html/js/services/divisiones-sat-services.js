
/* global api_url */

angular.module('app').service('DivisionesSatServices', [
    '$uhttp',
    function ($uhttp) {

        // ----- GET -----
        /**
         @return {object}  divisiones_sat_List
         */
        this.getList = function () {
            return $uhttp({
                url: api_url + 'divisiones_sat/get_all'
            });
        };
        /**
         @return {object} divisiones_satListInactive
         */

        this.getListInactive = function () {
            return $uhttp({
                url: api_url + 'divisiones_sat/get_all_inactive'
            });
        };
        /**
         @param {int(10) unsigned} id
         @return {object} divisiones_sat     
         */
        this.getById = function (id) {
            return $uhttp({
                url: api_url + 'divisiones_sat/get_by_id',
                params: {
                    id: id
                }
            });
        };

        //----- POST -----

        this.create = function (data) {
            return $uhttp({
                url: api_url + 'divisiones_sat/create',
                method: 'POST',
                data: data
            });
        };
        /**
         @param {int} id
         */

        this.update = function (id, data) {
            return $uhttp({
                url: api_url + 'divisiones_sat/update',
                method: 'POST',
                params: {
                    id: id
                },
                data: data
            });
        };

        this.inactivate = function (id) {
            return $uhttp({
                url: api_url + 'divisiones_sat/inactivate',
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
                url: api_url + 'divisiones_sat/reactivate',
                method: 'POST',
                params: {
                    id: id
                }
            });
        }
    }
]);

