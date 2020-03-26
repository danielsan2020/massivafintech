/* global angular */

angular.module("app").config(['$stateProvider', '$urlRouterProvider',
    function ($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.otherwise('/home');
        $stateProvider.state('main', {
            templateUrl: 'templates/menu.html',
            controller: 'MenuCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/menu-controllers.js',
                            'js/services/session-service.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.home', {
            url: '/home',
            templateUrl: 'templates/home.html',
//            controller: "HomeCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
//                            'js/controllers/home_controllers.js',
                        ]);
                    }]
            }
        });
        //PAQUETES
        $stateProvider.state('main.paquetes_tickets_list', {
            url: '/paquetes/lista-de-paquetes-tickets',
            templateUrl: 'templates/paquetes-tickets/paquetes-tickets-list.html',
            controller: "PaquetesTicketsListCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/paquetes-tickets-controllers.js',
                            'js/services/paquetes-tickets-service.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.paquetes_tickets_list_inactive', {
            url: '/paquetes/lista-de-paquetes-tickets-inactivos',
            templateUrl: 'templates/paquetes-tickets/paquetes-tickets-inactive-list.html',
            controller: "PaquetesTicketsListInactiveCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/paquetes-controllers.js',
                            'js/services/paquetes-service.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.paquetes_tickets_create', {
            url: '/paquetes/agregar-paquete-tickets',
            templateUrl: 'templates/paquetes-tickets/paquetes-tickets-form.html',
            controller: "PaquetesTicketsCreateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/paquetes-tickets-controllers.js',
                            'js/services/paquetes-tickets-service.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.paquetes_tickets_edit', {
            url: '/paquetes/editar-paquete-tickets/:id',
            templateUrl: 'templates/paquetes-tickets/paquetes-tickets-form.html',
            controller: "PaquetesTicketsUpdateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/paquetes-tickets-controllers.js',
                            'js/services/paquetes-tickets-service.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.paquetes_list', {
            url: '/paquetes/lista-de-paquetes',
            templateUrl: 'templates/paquetes/paquetes_list.html',
            controller: "PaquetesListCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/paquetes-controllers.js',
                            'js/services/paquetes-service.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.paquetes_list_inactive', {
            url: '/paquetes/lista-de-paquetes-inactivos',
            templateUrl: 'templates/paquetes/paquetes_list_inactive.html',
            controller: "PaquetesListInactiveCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/paquetes-controllers.js',
                            'js/services/paquetes-service.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.paquetes_create', {
            url: '/paquetes/agregar-paquete',
            templateUrl: 'templates/paquetes/paquetes_form.html',
            controller: "PaquetesCreateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/directives/u-validations.js',
                            'js/controllers/paquetes-controllers.js',
                            'js/services/paquetes-service.js',
                            'js/services/regimenes-fiscales-service.js'
                        ]);
                    }]
            }
        });
//        Route para el update de paquetes. No borrar.
//        $stateProvider.state('main.paquetes_edit', {
//            url: '/paquetes/editar-paquete/:id',
//            templateUrl: 'templates/paquetes/paquetes_form.html',
//            controller: "PaquetesUpdateCtrl",
//            resolve: {
//                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
//                        return $ocLazyLoad.load([
//                            'js/directives/u-validations.js',
//                            'js/controllers/paquetes-controllers.js',
//                            'js/services/paquetes-service.js',
//                            'js/services/regimenes-fiscales-service.js'
//                        ]);
//                    }]
//            }
//        });
        $stateProvider.state('main.paquetes_informacion', {
            url: '/paquetes/informacion-paquete/:id',
            templateUrl: 'templates/paquetes/paquetes-informacion-form.html',
            controller: "PaquetesUpdateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/directives/u-validations.js',
                            'js/controllers/paquetes-controllers.js',
                            'js/services/paquetes-service.js',
                            'js/services/regimenes-fiscales-service.js'
                        ]);
                    }]
            }
        });
        //USUARIOS
        $stateProvider.state('main.usuarios_list', {
            url: '/usuarios/lista-de-usuarios',
            templateUrl: 'templates/usuarios/usuarios_list.html',
            controller: "UsuariosListCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/usuarios-controllers.js',
                            'js/services/usuarios-service.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.usuarios_list_inactive', {
            url: '/usuarios/lista-de-usuarios-inactivos',
            templateUrl: 'templates/usuarios/usuarios_list_inactive.html',
            controller: "UsuariosListInactiveCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/usuarios-controllers.js',
                            'js/services/usuarios-service.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.usuarios_create', {
            url: '/usuarios/agregar-usuario',
            templateUrl: 'templates/usuarios/usuarios_form.html',
            controller: "UsuariosCreateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/usuarios-controllers.js',
                            'js/services/usuarios-service.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.usuarios_edit', {
            url: '/usuarios/editar-usuario/:id',
            templateUrl: 'templates/usuarios/usuarios_form.html',
            controller: "UsuariosUpdateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/usuarios-controllers.js',
                            'js/services/usuarios-service.js'
                        ]);
                    }]
            }
        });
        //PERSONAS
        $stateProvider.state('main.personas_list', {
            url: '/personas/lista-de-personas',
            templateUrl: 'templates/personas/personas_list.html',
            controller: "PersonasListCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-controllers.js',
                            'js/services/personas-service.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.solicitudes_sat_cfdis', {
            url: '/personas/solicitudes-sat-cfdis/:persona_id',
            templateUrl: 'templates/personas/solicitudes_sat_cfdis.html',
            controller: "SolicitudesSatCfdisListCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/solicitudes-sat-cfdis-controllers.js',
                            'js/services/solicitudes-sat-cfdis-service.js',
                            'js/services/personas-service.js'
                        ]);
                    }]
            }
        });
        //PERSONAS Y CONTADORES
        $stateProvider.state('main.personas_contador_list', {
            url: '/personas-contadores/lista-de-personas-sin-contador',
            templateUrl: 'templates/personas-contadores/personas-sin-contador-list.html',
            controller: 'PersonasSinContadorListCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-contadores-controllers.js',
                            'js/services/personas-service.js'
                        ]);
                    }]
            }
        }).state('main.asignar_contador_a_persona', {
            url: '/personas-contadores/asignar-contador-a-persona/:persona_id',
            templateUrl: 'templates/personas-contadores/personas-asignar-contador-form.html',
            controller: 'PersonasContadoresAsignarContadorCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-contadores-controllers.js',
                            'js/services/personas-contadores-service.js',
                            'js/services/personas-service.js',
                            'js/services/usuarios-service.js'
                        ]);
                    }]
            }
        }).state('main.personas_con_contador_list', {
            url: '/personas-contadores/lista-personas-con-contador',
            templateUrl: 'templates/personas-contadores/personas-con-contador-list.html',
            controller: 'PersonasConContadorListCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-contadores-controllers.js',
                            'js/services/personas-service.js'
                        ]);
                    }]
            }
        }).state('main.persona_contador_edit', {
            url: '/personas-contadores/editar-contador-de-persona/:persona_contador_id',
            templateUrl: 'templates/personas-contadores/personas-contadores-cambiar-form.html',
            controller: 'PersonasContadoresUpdateCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-contadores-controllers.js',
                            'js/services/personas-contadores-service.js',
                            'js/services/personas-service.js',
                            'js/services/usuarios-service.js'
                        ]);
                    }]
            }
        });
        //preguntas frecuentes
        $stateProvider.state('main.categorias_preguntas_frecuentes_list', {
            url: '/categorias-preguntas-frecuentes',
            templateUrl: 'templates/categorias-preguntas-frecuentes/categorias-preguntas-frecuentes-list.html',
            controller: 'CategoriasPreguntasListCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/categorias-preguntas-frecuentes-controllers.js',
                            'js/services/categorias-preguntas-frecuentes-service.js'
                        ]);
                    }]
            }}).state('main.categorias_preguntas_frecuentes_create', {
            url: '/crear-categoria-preguntas-frecuentes',
            templateUrl: 'templates/categorias-preguntas-frecuentes/categorias-preguntas-frecuentes-form.html',
            controller: 'CategoriasPreguntasCreateCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/categorias-preguntas-frecuentes-controllers.js',
                            'js/services/categorias-preguntas-frecuentes-service.js'
                        ]);
                    }]
            }
        }).state('main.categorias_preguntas_frecuentes_update', {
            url: '/actualizar-categoria-preguntas-frecuentes/:id',
            templateUrl: 'templates/categorias-preguntas-frecuentes/categorias-preguntas-frecuentes-form.html',
            controller: 'CategoriasPreguntasUpdateCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/categorias-preguntas-frecuentes-controllers.js',
                            'js/services/categorias-preguntas-frecuentes-service.js'
                        ]);
                    }]
            }
        }).state('main.categorias_preguntas_frecuentes_inactive', {
            url: '/categorias-preguntas-frecuentes-inactivas',
            templateUrl: 'templates/categorias-preguntas-frecuentes/categorias-preguntas-frecuentes-inactive-list.html',
            controller: 'CategoriasPreguntasListInactiveCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/categorias-preguntas-frecuentes-controllers.js',
                            'js/services/categorias-preguntas-frecuentes-service.js'
                        ]);
                    }]
            }
        }).state('main.preguntas_frecuentes_by_categoria_list', {
            url: '/lista-preguntas-frecuentes/:categoria_id',
            templateUrl: 'templates/preguntas-frecuentes/preguntas-frecuentes-list.html',
            controller: 'PreguntasFrecuentesListCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/preguntas-frecuentes-controllers.js',
                            'js/services/preguntas-frecuentes-service.js',
                            'js/controllers/categorias-preguntas-frecuentes-controllers.js',
                            'js/services/categorias-preguntas-frecuentes-service.js'
                        ]);
                    }]
            }
        }).state('main.preguntas_frecuentes_by_categoria_create', {
            url: '/crear-pregunta-frecuente/:categoria_id',
            templateUrl: 'templates/preguntas-frecuentes/preguntas-frecuentes-form.html',
            controller: 'PreguntasFrecuentesCreateCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/preguntas-frecuentes-controllers.js',
                            'js/services/preguntas-frecuentes-service.js',
                            'js/controllers/categorias-preguntas-frecuentes-controllers.js',
                            'js/services/categorias-preguntas-frecuentes-service.js'
                        ]);
                    }]
            }
        }).state('main.preguntas_frecuentes_by_categoria_update', {
            url: '/actualizar-pregunta-frecuente/:categoria_id/:id',
            templateUrl: 'templates/preguntas-frecuentes/preguntas-frecuentes-form.html',
            controller: 'PreguntasFrecuentesUpdateCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/preguntas-frecuentes-controllers.js',
                            'js/services/preguntas-frecuentes-service.js',
                            'js/controllers/categorias-preguntas-frecuentes-controllers.js',
                            'js/services/categorias-preguntas-frecuentes-service.js'
                        ]);
                    }]
            }
        }).state('main.preguntas_frecuentes_by_categoria_inactivate', {
            url: '/pregpreguntas_frecuentes_by_categoria_inactivateuntas-frecuentes-by-categoria-inactive-list/:categoria_id',
            templateUrl: 'templates/preguntas-frecuentes/preguntas-frecuentes-by-categoria-inactive-list.html',
            controller: 'PreguntasFrecuentesListInactiveCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/preguntas-frecuentes-controllers.js',
                            'js/services/preguntas-frecuentes-service.js',
                            'js/controllers/categorias-preguntas-frecuentes-controllers.js',
                            'js/services/categorias-preguntas-frecuentes-service.js'
                        ]);
                    }]
            }
        });
//Regimenes fiscales
        $stateProvider.state('main.regimenes_fiscales_list', {
            url: '/catalogos/regimenes-fiscales',
            templateUrl: 'templates/regimenes-fiscales/regimenes-fiscales-list.html',
            controller: "RegimenesFiscalesListCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/regimenes-fiscales-controllers.js',
                            'js/services/regimenes-fiscales-service.js'
                        ]);
                    }]
            }
        }).state('main.regimenes_fiscales_create', {
            url: '/catalogos/crear-regimen-fiscal',
            templateUrl: 'templates/regimenes-fiscales/regimenes-fiscales-form.html',
            controller: "RegimenesFiscalesCreateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/regimenes-fiscales-controllers.js',
                            'js/services/regimenes-fiscales-service.js'
                        ]);
                    }]
            }
        }).state('main.regimenes_fiscales_edit', {
            url: '/catalogos/editar-regimen-fiscal/:{id:int}',
            templateUrl: 'templates/regimenes-fiscales/regimenes-fiscales-form.html',
            controller: "RegimenesFiscalesUpdateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/regimenes-fiscales-controllers.js',
                            'js/services/regimenes-fiscales-service.js'
                        ]);
                    }]
            }
        }).state('main.regimenes_fiscales_list_inactive', {
            url: '/catalogos/regimenes-fiscales-inactivos',
            templateUrl: 'templates/regimenes-fiscales/regimenes-fiscales-list-inactive.html',
            controller: "RegimenesFiscalesListInactiveCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/regimenes-fiscales-controllers.js',
                            'js/services/regimenes-fiscales-service.js'
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.notificaciones', {
            url: '/notificaciones',
            templateUrl: 'templates/notificaciones/notificaciones.html',
            controller: "NotificacionesCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/notificaciones-controllers.js',
                            'js/services/notificaciones-service.js'
                        ]);
                    }]
            }
        });
        //catalogo divisiones sat
        $stateProvider.state('main.divisiones_sat', {
            url: '/divisiones-sat',
            templateUrl: 'templates/divisiones/divisiones-sat-list.html',
            controller: "DivisionesSatListCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/divisiones-sat-controllers.js',
                            'js/services/divisiones-sat-services.js'
                        ]);
                    }]
            }
        }).state('main.divisiones_sat_create', {
            url: '/catalogos/crear-divisiones-sat',
            templateUrl: 'templates/divisiones/divisiones-sat-form.html',
            controller: "DivisionesSatCreateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/divisiones-sat-controllers.js',
                            'js/services/divisiones-sat-services.js'
                        ]);
                    }]
            }
        }).state('main.divisiones_sat_list_inactive', {
            url: '/catalogos/divisiones-sat-list-inactive',
            templateUrl: 'templates/divisiones/divisiones-sat-list-inactive.html',
            controller: "DivisionesSatListInactiveCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/divisiones-sat-controllers.js',
                            'js/services/divisiones-sat-services.js'
                        ]);
                    }]
            }
        }).state('main.divisiones_sat_edit', {
            url: '/catalogos/editar-divisiones-sat/:{id:int}',
            templateUrl: 'templates/divisiones/divisiones-sat-form.html',
            controller: "DivisionesSatUpdateCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/divisiones-sat-controllers.js',
                            'js/services/divisiones-sat-services.js'
                        ]);
                    }]
            }
        }).state('main.grupos_sat_by_divisiones_sat_list', {
            url: '/lista-grupos-sat/:id',
            templateUrl: 'templates/grupos-sat/grupos-sat-list.html',
            controller: "GruposSatListCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/grupos-sat-controllers.js',
                            'js/services/grupos-sat-service.js',
                            'js/controllers/divisiones-sat-controllers.js',
                            'js/services/divisiones-sat-services.js'
                        ]);
                    }]
            }
        }).state('main.grupos_sat_by_divisiones_sat_inactiva', {
            url: '/grupos-sat-by-divisiones-sat-inactive-list/:division_sat_id',
            templateUrl: 'templates/grupos-sat/grupos-sat-inactive-list.html',
            controller: 'GruposSatListInactiveCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/grupos-sat-controllers.js',
                            'js/services/grupos-sat-service.js',
                            'js/controllers/divisiones-sat-controllers.js',
                            'js/services/divisiones-sat-services.js'
                        ]);
                    }]
            }
        }).state('main.grupos_sat_create', {
            url: '/crear-grupos-sat/:division_id',
            templateUrl: 'templates/grupos-sat/grupos-sat-form.html',
            controller: 'GruposSatCreateCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/grupos-sat-controllers.js',
                            'js/services/grupos-sat-service.js',
                            'js/controllers/divisiones-sat-controllers.js',
                            'js/services/divisiones-sat-services.js'
                        ]);
                    }]
            }
        }).state('main.grupos_sat_by_division_update', {
            url: '/actualizar-grupo-sat/:division_id/:id',
            templateUrl: 'templates/grupos-sat/grupos-sat-form.html',
            controller: 'GruposSatUpdateCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/grupos-sat-controllers.js',
                            'js/services/grupos-sat-service.js',
                            'js/controllers/divisiones-sat-controllers.js',
                            'js/services/divisiones-sat-services.js'
                        ]);
                    }]
            }
        }).state('main.productos_sat_by_grupos_sat_list', {
            url: '/lista-productos-sat/:grupo_sat_id/:division_sat_id',
            templateUrl: 'templates/productos_sat/productos-sat-list.html',
            controller: "ProductosSatListCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/productos-sat-controllers.js',
                            'js/services/productos-sat-services.js',
                            'js/controllers/grupos-sat-controllers.js',
                            'js/services/grupos-sat-service.js'
                        ]);
                    }]
            }
        }).state('main.main.productos_sat_list_inactive', {
            url: '/productos-sat-inactive-list/:grupo_sat_id/:division_sat_id',
            templateUrl: 'templates/productos_sat/productos-sat-inactive-list.html',
            controller: 'ProductosSatListInactiveCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/productos-sat-controllers.js',
                            'js/services/productos-sat-services.js',
                            'js/controllers/grupos-sat-controllers.js',
                            'js/services/grupos-sat-service.js'
                        ]);
                    }]
            }
        });

    }
]);
//.state('cms.form_pass', {
//            url: '/form_pass',
//            templateUrl: 'templates/form_pass.html',
//            controller: 'NewPassCtrl',
//            resolve: {
//                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
//                        return $ocLazyLoad.load([
//                            'js/controllers/home_controllers.js',
//                            'js/factories/login_model_factory.js'
//                        ]);
//                    }]
//            }
//        });
