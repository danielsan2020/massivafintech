/* global api_url */

angular.module("app").service("DeclaracionesService", [
    '$uhttp',
    function ($uhttp) {
        this.getValidationMonthlyDeclarationByPerson = function () {
            return $uhttp({
                url: api_url + 'declaraciones_mensuales/validate_declaracion_pendiente'
            });
        };
  
        this.UpdateMonthlyDeclaration = function () {
            return $uhttp({
                url: api_url + 'declaraciones_mensuales/status_update_autorizado',
                method: 'POST',
            });
        };
    }
]);
