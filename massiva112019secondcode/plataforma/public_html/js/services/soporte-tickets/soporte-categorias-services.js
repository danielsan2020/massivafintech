angular.module('app').service('SoporteCategoriasService', [
    '$uhttp',
    function ($uhttp) {
        /**
         @return {object}  paquetesList
         */

        this.getAllSoporteCategoriasByTipo = function (tipo) {
            return $uhttp({
                url: api_url + 'soporte_categorias/get_all',
                params: {tipo: tipo}
            });
        };
    }
]);

