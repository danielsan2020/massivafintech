/* global api_url */

angular.module("app").service("DeclaracionesAtrasadasService", [
    '$uhttp',
    function ($uhttp) {
        this.getMonthlyDeclarationsPrev = function () {
            return $uhttp({
                url: api_url + 'declaraciones_mensuales_atrasadas/get_declaraciones_mensuales_atrasadas'
            });
        };
        this.inactivate = function (id) {
            return $uhttp({
                url: api_url + 'declaraciones_mensuales_atrasadas/status_update_no_autorizado',
                method: 'POST',
                params: {
                    id: id                    
                }
            });
        };
        this.activate = function (id) {
            return $uhttp({
                url: api_url + 'declaraciones_mensuales_atrasadas/status_update_autorizado',
                method: 'POST',
                params: {
                    id: id                    
                }
            });
        };
        

    }
]);
