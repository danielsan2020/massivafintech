/* global api_url */

angular.module("app").service("ProductosSatService", [
    '$uhttp',
    function ($uhttp) {
        this.getProductoByClave = function(clave){
            return $uhttp({
                url: api_url + 'productos_sat/get_producto_by_clave',
                params:{
                    clave: clave
                }
            });
        };
    }
    
]);


