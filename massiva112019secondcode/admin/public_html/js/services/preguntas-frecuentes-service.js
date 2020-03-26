
/* global api_url, angular */

angular.module('app').service('PreguntasFrecuentesService', [
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
         @return {object} preguntas_frecuentesListInactive
         */

        this.getListInactiveByCategoriaId = function (categoria_id) {
            return $uhttp({
                url: api_url + 'preguntas_frecuentes/get_all_inactive_by_categoria_id',
                 params: {
                    categoria_id: categoria_id
                }
            });
        };

        /**
         @param {int(10) unsigned} id
         @return {object} preguntas_frecuentes     
         */
        this.getById = function (id, categoria_id) {
            return $uhttp({
                url: api_url + 'preguntas_frecuentes/get_by_id',
                params: {
                    id: id,
                    categoria_id: categoria_id
                }
            });
        };
        /**
         @param {int(10) unsigned} categoria_id
         @return {object} preguntas_frecuentes     
         */
        this.getByCategoriasPreguntasFrecuentesId = function (categoria_id) {
            return $uhttp({
                url: api_url + 'preguntas_frecuentes/get_by_categoria_id',
                params: {
                    categoria_id: categoria_id
                }
            });
        };
        // ----- POST -----
        //   /**
        //   @param {int(10) unsigned} categoria_id
        //*/
        this.create = function (categoria_id, data) {
            return $uhttp({
                url: api_url + 'preguntas_frecuentes/create',
                method: 'POST',
                params: {
                    categoria_id: categoria_id
                },
                data: data
            });
        };
        /**
         @param {int} id
         */

        this.update = function (id,categoria_id, data) {
            return $uhttp({
                url: api_url + 'preguntas_frecuentes/update',
                method: 'POST',
                params: {
                    id: id,
                    categoria_id: categoria_id
                },
                data: data
            });
        };
        /**
         @param {int} id
         */
        this.inactivate = function (id) {
            return $uhttp({
                url: api_url + 'preguntas_frecuentes/inactivate',
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
                url: api_url + 'preguntas_frecuentes/reactivate',
                method: 'POST',
                params: {
                    id: id
                }
            });
        };
    }
]);
