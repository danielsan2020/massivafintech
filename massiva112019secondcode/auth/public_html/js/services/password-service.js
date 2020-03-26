/* global api_url, base_url */

angular.module('appPassword').service('PasswordService', [
    '$uhttp',
    function ($uhttp) {

        // ----- POST -----
        this.createUsuario = function (data) {
            return  $uhttp({
                url: api_url + 'registro/create_usuario_tipo_2',
                method: 'POST',
                data: data
            });
        };
        
        this.updatePassword = function(data){
            return $uhttp({
                url: api_url + 'usuarios/reestablecer_password',
                method: 'POST',
                data: data
            });
        };
    }
]);