/* global api_url */

angular.module("app").service("PersonasProductosService", [
    '$uhttp',
    function ($uhttp) {
        this.UpdateMonthlyDeclaration = function () {
            return $uhttp({
                url: api_url + 'declaraciones_mensuales/status_update_autorizado',
                method: 'POST'
            });
        };
        this.getList = function () {
            return $uhttp({
                url: api_url + 'personas_productos/get_all_by_persona_id',
            });
        };

        /**
         @return {object} personas_clientesListInactive
         */

        this.getListInactive = function () {
            return $uhttp({
                url: api_url + 'personas_productos/get_all_inactive'
            });
        };
        /**
         @param {int(10) unsigned} persona_id
         @return {object} personas_clientes     
         */
        this.getProductoById = function (producto_id) {
            return $uhttp({
                url: api_url + 'personas_productos/get_producto_by_producto_id',
                params: {
                    producto_id: producto_id
                }
            });
        };
        /**
         @param {string:} clave
         @return {object} producto     
         */
        this.getProductoByClave = function (clave_producto) {
            return $uhttp({
                url: api_url + 'personas_productos/get_producto_by_clave',
                params: {
                    clave: clave_producto
                }
            });
        };
        /**
         @param {int} id
         */
        this.inactivate = function (id) {
            return $uhttp({
                url: api_url + 'personas_productos/inactivate',
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
                url: api_url + 'personas_productos/reactivate',
                method: 'POST',
                params: {
                    id: id
                }
            });
        };
        //         ----- POST -----
        /**
         //*/
        this.createPersonaProducto = function (data) {
            return $uhttp({
                url: api_url + 'personas_productos/create',
                method: 'POST',
                data: data
            });
        };
        /**
         @param {int} id
         */

        this.updatePersonaProducto = function (id, data) {
            return $uhttp({
                url: api_url + 'personas_productos/update',
                method: 'POST',
                params: {
                    id: id
                },
                data: data
            });
        };
    }


]);


