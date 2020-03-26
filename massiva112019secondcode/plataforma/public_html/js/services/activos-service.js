

/* global api_url */

angular.module('app').service('ActivosService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        /**
         @return {object}  activosList
         */
        this.getList = function () {
            return $uhttp({
                url: api_url + 'activos/get_all'
            });
        };
        /**
         @return {object} activosListInactive
         */

        this.getListInactive = function () {
            return $uhttp({
                url: api_url + 'Activos/get_all_inactive'
            });
        };

        /**
         @param {int(10) unsigned} id
         @return {object} activos     
         */
        this.getById = function (id) {
            return $uhttp({
                url: api_url + 'activos/get_by_id',
                params: {
                    id: id
                }
            });
        };
        /**
         @param {int(10) unsigned} persona_id
         @return {object} activos     
         */
        this.getByPersonaId = function (persona_id) {
            return $uhttp({
                url: api_url + 'activos/get_by_persona_id',
                params: {
                    persona_id: persona_id
                }
            });
        };
        this.create = function (data) {
            return $uhttp({
                url: api_url + 'activos/create',
                method: 'POST',
                data: data
            });
        };
        this.update = function (id, data) {
            return $uhttp({
                url: api_url + 'activos/update',
                method: 'POST',
                params: {
                    id: id
                },
                data: data
            });
        };
        this.inactivate = function (id, data) {
            return $uhttp({
                url: api_url + 'activos/inactivate',
                method: 'POST',
                params: {
                    id: id
                }
            });
        };
        // ----- POST -----
        //   /**
        //               //*/
//            this.create = function (data) {
//                return $uhttp({
//                    url: api_url + 'activos/create',
//                    method: 'POST',
//                     data: data
        //                });
        //            };
        //             /**
        //            @param {int} id
        //            */
        //
        //            this.update = function (id, data) {
        //                return $uhttp({
        //                  url: api_url + 'activos/update',
        //                    method: 'POST',
        //                    params: {
        //                        id: id
        //                    },
        //                    data: data
        //                });
        //            };
        //            /**
        //            @param {int} id
        //            */
        //            this.inactivate = function (id) {
        //                return $uhttp({
        //                    url: api_url + 'activos/inactivate',
        //                    method: 'POST',
        //                    params: {
        //                        id: id
        //                    }
        //                });
        //            };
        //            /**
        //            @param {int} id
        //            */
        //            
        //       this.reactivate = function (id) {
        //            return $uhttp({
        //                url: api_url + 'activos/reactivate',
//                method: 'POST',
//                params: {
//                    id: id
//                }
//            });
//        };
    }
]);
