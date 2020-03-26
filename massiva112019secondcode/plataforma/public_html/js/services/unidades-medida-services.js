/* global api_url */

angular.module("app").service("UnidadesDeMedidaService", [
    '$uhttp',
    function ($uhttp) {
        this.getAll = function(){
            return $uhttp({
                url: api_url + 'unidades_medidas/get_all',
            });
        };
    }
    
]);


