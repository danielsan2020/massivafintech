
/* global api_url */

angular.module('app').service('CategoriasPreguntasService', [
    '$uhttp',
    function ($uhttp) {
        // ----- GET -----
        /**
         @return {object}  categorias_preguntas_frecuentesList
         */
        this.getList = function () {
            return $uhttp({
                url: api_url + 'categorias_preguntas_frecuentes/get_all'
            });
        };
        /**
         @return {object} categorias_preguntas_frecuentesListInactive
         */

        this.getListInactive = function () {
            return $uhttp({
                url: api_url + 'categorias_preguntas_frecuentes/get_all_inactive'
            });
        };

        /**
         @param {int(10) unsigned} id
         @return {object} categorias_preguntas_frecuentes     
         */
        this.getById = function (id) {
            return $uhttp({
                url: api_url + 'categorias_preguntas_frecuentes/get_by_id',
                params: {
                    id: id
                }
            });
        };
        // ----- POST -----

        this.create = function (data) {
            return $uhttp({
                url: api_url + 'categorias_preguntas_frecuentes/create',
                method: 'POST',
                data: data
            });
        };
        /**
         @param {int} id
         */

        this.update = function (id, data) {
            return $uhttp({
                url: api_url + 'categorias_preguntas_frecuentes/update',
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
                url: api_url + 'categorias_preguntas_frecuentes/inactivate',
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
                url: api_url + 'categorias_preguntas_frecuentes/reactivate',
                method: 'POST',
                params: {
                    id: id
                }
            });
        };
    }
]);
