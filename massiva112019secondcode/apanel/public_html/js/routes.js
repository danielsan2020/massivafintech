angular.module("app").config(['$httpProvider', '$stateProvider', '$urlRouterProvider',
    function ($httpProvider, $stateProvider, $urlRouterProvider) {
        $urlRouterProvider.otherwise('/home');
        $stateProvider.state('main', {
            templateUrl: 'templates/menu.html',
            controller: 'MenuCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/menu-controllers.js',
                            'js/services/session-service.js',
                        ]);
                    }]
            }
        })
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

        //Personas para asignar un contador
        $stateProvider.state('main.personas_sin_contador_asignado_list', {
            url: '/personas-contadores/lista-personas-sin-contador',
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
            url: '/personas-contadores/asignar-persona-a-contador/:personas_contadores_id',
            templateUrl: 'templates/personas-contadores/asignar-persona-sin-contador-form.html',
            controller: 'PersonasSinContadorAsignarCtrl',
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
            url: '/personas-contadores/personas-con-contador-list',
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
        }).state('main.cambiar_contador_a_persona', {
            url: '/personas-contadores/cambiar-contador-a-persona/:personas_contadores_id',
            templateUrl: 'templates/personas-contadores/cambiar-contador-a-persona-form.html',
            controller: 'PersonasConContadorCambiarCtrl',
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

        $stateProvider.state('main.contadores_list', {
            url: '/contadores/contadores-list',
            templateUrl: 'templates/contadores/contadores-list.html',
            controller: "ContadoresListController",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/contadores-controllers.js',
                            'js/services/usuarios-service.js'
                        ]);
                    }]
            }
        }).state('main.show_personas', {
            url: '/show-personas/:contador_id',
            templateUrl: 'templates/personas/personas-list.html',
            controller: 'PersonasDeUnContadorList',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/personas-contadores-controllers.js',
                            'js/services/personas-contadores-service.js',
                        ]);
                    }]
            }
        });

        $stateProvider.state('main.contadores_list_para_mostrar_declaraciones', {
            url: '/declaraciones/contadores-list',
            templateUrl: 'templates/contadores/contadores-list.html',
            controller: "ContadoresListParaMostrarDeclaracionesController",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/contadores-controllers.js',
                            'js/services/usuarios-service.js'
                        ]);
                    }]
            }
        }).state('main.show_declaraciones', {
            url: '/show-declaraciones/:contador_id',
            templateUrl: 'templates/declaraciones/declaraciones-list.html',
            controller: 'DeclaracionesControllers',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/declaraciones-controllers.js',
                            'js/services/personas-contadores-service.js',
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.contadores_list_para_mostrar_declaraciones_atrasadas', {
            url: '/declaraciones_atrasadas/contadores-list',
            templateUrl: 'templates/contadores/contadores-list.html',
            controller: "ContadoresListParaMostrarDeclaracionesAtrasadasController",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/contadores-controllers.js',
                            'js/services/usuarios-service.js'
                        ]);
                    }]
            }
        }).state('main.show_declaraciones_atrasadas', {
            url: '/show-declaraciones-atrasadas/:contador_id',
            templateUrl: 'templates/declaraciones/declaraciones-list.html',
            controller: 'DeclaracionesAtrasadasControllers',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/declaraciones-controllers.js',
                            'js/services/personas-contadores-service.js',
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.declaraciones_adjuntar_para_pago', {
            url: '/declaraciones/adjuntar-para-pago/:persona_id/:declaracion_id',
            templateUrl: 'templates/declaraciones/adjuntar-form.html',
            controller: "DeclaracionesAdjuntarParaPagoController",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
//                            'js/controllers/declaraciones-controllers.js',
//                            'js/services/usuarios-service.js'
                            {
                                name: 'ngFileUpload',
                                serie: true,
                                files: [
                                    'js/modules/ng-file-upload.min.js',
                                    'js/modules/ng-file-upload-shim.min.js',
//                                    'js/filters/filters.js',
//                                    'js/controllers/personas-productos-controllers.js',
//                                    'js/services/unidades-de-medida-services.js',
//                                    'js/services/personas-productos-services.js',
//                                    'js/services/productos-sat-services.js'
                                    'js/controllers/declaraciones-controllers.js'
                                ]
                            }
                        ]);
                    }]
            }
        });
        $stateProvider.state('main.declaraciones_atrasadas_adjuntar_para_pago', {
            url: '/declaraciones_atrasadas/adjuntar-para-pago/:persona_id/:declaracion_id',
            templateUrl: 'templates/declaraciones/adjuntar-form.html',
            controller: "DeclaracionesAtrasadasAdjuntarParaPagoController",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
//                            'js/controllers/declaraciones-controllers.js',
//                            'js/services/usuarios-service.js'
                            {
                                name: 'ngFileUpload',
                                serie: true,
                                files: [
                                    'js/modules/ng-file-upload.min.js',
                                    'js/modules/ng-file-upload-shim.min.js',
//                                    'js/filters/filters.js',
//                                    'js/controllers/personas-productos-controllers.js',
//                                    'js/services/unidades-de-medida-services.js',
//                                    'js/services/personas-productos-services.js',
//                                    'js/services/productos-sat-services.js'
                                    'js/controllers/declaraciones-controllers.js'
                                ]
                            }
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
