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
                icon: 'fas fa-comments',
                text: 'Soporte',
                state: 'main.soporte',
                submenu_elements: [
                    {
                        text: 'Lista de contadores',
                        state: 'main.contadores_list'
                    }
                ]
            },
            {
                icon: 'far fa-file-alt',
                text: 'Declaraciones',
                state: 'main.contadores_list_para_mostrar_declaraciones'
            },
            {
                icon: 'far fa-clock',
                text: 'Declaraciones Atrasadas',
                state: 'main.contadores_list_para_mostrar_declaraciones_atrasadas'
            },
            {
                icon: 'fas fa-user-plus',
                text: 'Asignar personas a contador',
                submenu_elements: [
                    {
                        text: 'Asignar contador a persona',
                        state: 'main.personas_sin_contador_asignado_list'
                    },
                    {
                        text: 'Cambiar contador a persona',
                        state: 'main.personas_con_contador_list'
                    }
                ]
            }
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
