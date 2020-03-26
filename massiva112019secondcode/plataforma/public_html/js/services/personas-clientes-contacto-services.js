/* global api_url */

angular.module('app').service('PersonasClientesService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        /**
         @return {object}  personas_clientes_contactoList
         */
        this.getList = function () {
            return $uhttp({
                url: api_url + 'personas_clientes_contacto/get_all'
            });
        };
        /**
         @return {object} personas_clientes_contactoListInactive
         */

        this.getListInactive = function () {
            return $uhttp({
                url: api_url + 'Personas_clientes_contacto/get_all_inactive'
            });
        };

        /**
         @param {int(10) unsigned} id
         @return {object} personas_clientes_contacto     
         */
        this.getById = function (id) {
            return $uhttp({
                url: api_url + 'personas_clientes_contacto/get_by_id',
                params: {
                    id: id
                }
            });
        };
        /**
         @param {int(10) unsigned} persona_cliente_id
         @return {object} personas_clientes_contacto     
         */
        this.getByPersonaClienteId = function (persona_cliente_id) {
            return $uhttp({
                url: api_url + 'personas_clientes_contacto/get_by_persona_cliente_id',
                params: {
                    persona_cliente_id: persona_cliente_id
                }
            });
        };
        // ----- POST -----
        //   /**
        //               //*/
//            this.create = function (data) {
//                return $uhttp({
//                    url: api_url + 'personas_clientes_contacto/create',
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
        //                  url: api_url + 'personas_clientes_contacto/update',
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
        //                    url: api_url + 'personas_clientes_contacto/inactivate',
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
        //                url: api_url + 'personas_clientes_contacto/reactivate',
//                method: 'POST',
//                params: {
//                    id: id
//                }
//            });
//        };
    }
]);
