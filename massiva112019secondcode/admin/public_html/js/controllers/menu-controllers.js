/* global home_url, moment, angular */

angular.module("app").controller('MenuCtrl', [
    '$scope',
    '$rootScope',
    'SessionService',
    '$interval',
    function ($scope, $rootScope, SessionService, $interval) {
        $scope.menu_elements = [
            {
                icon: 'fas fa-home',
                text: 'Inicio',
                state: 'main.home'
            },
            {
                icon: 'fas fa-box-open',
                text: 'Paquetes',
                submenu_elements: [
                    {
                        text: 'Planes',
                        state: 'main.paquetes_list'
                    },
                    {
                        text: 'Paquetes de tiquets',
                        state: 'main.paquetes_tickets_list'
                    }
                ]
            },
            {
                icon: 'fas fa-users',
                text: 'Usuarios',
                state: 'main.usuarios_list'

            },
            {
                icon: 'fas fa-users',
                text: 'Personas',
                state: 'main.personas_list'
            },
            {
                icon: 'fas fa-user-plus',
                text: 'Contadores - Personas',
                submenu_elements: [
                    {
                        text: 'Asignar personas a contador',
                        state: 'main.personas_contador_list'
                    },
                    {
                        text: 'Cambiar contador',
                        state: 'main.personas_con_contador_list'
                    }
                ]
            },
            {
                icon: 'fas fa-question',
                text: 'Preguntas frecuentes',
                state: 'main.categorias_preguntas_frecuentes_list'
            },
            {
                icon: 'fas fa-list',
                text: 'Catalogos',
                submenu_elements: [
                    {
                        text: 'Regímenes fiscales',
                        state: 'main.regimenes_fiscales_list'
                    },
                    {
                        text: 'Divisiones Sat',
                        state: 'main.divisiones_sat'
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