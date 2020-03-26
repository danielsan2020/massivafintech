/* global home_url */

angular.module("app").controller('MenuCtrl', [
    '$scope',
    '$state',
    '$rootScope',
    'SessionService',
    function ($scope, $state, $rootScope, SessionService) {
        $scope.menu_elements = [
            {
                icon: 'fas fa-home',
                text: 'Inicio',
                state: 'main.home'
            },
            {
                icon: 'fas fa-download',
                text: 'Descargas',
                state: 'main.descargas_list_personas'
            },
            {
                icon: 'fas fa-comments',
                text: 'Soporte',
                state: 'main.soporte_list'
            },
            {
                icon: 'far fa-file-alt',
                text: 'Declaraciones',
                state: 'main.show_declaraciones'
            },
            {
                icon: 'far fa-clock',
                text: 'Declaraciones Atrasadas',
                state: 'main.show_declaraciones_atrasadas'
            },
        ];
        $scope.logout = function () {
            SessionService.logout().then(function () {
                delete ($rootScope.usuario_acceso);
                $scope.intentos = 0;
                setTimeout(function () {
                    location.href = home_url;
                }, 500);
            });
        };
    }
]);
