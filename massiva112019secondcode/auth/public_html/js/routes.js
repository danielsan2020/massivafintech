/* global base_url */

angular.module("app").config(['$httpProvider', '$stateProvider', '$urlRouterProvider',
    function ($httpProvider, $stateProvider, $urlRouterProvider) {
        $urlRouterProvider.otherwise('/login');
        $stateProvider.state('login', {
            url: '/login',
            controller: 'LoginCtrl',
            templateUrl: api_url + 'auth/form_login',
            authenticate: false,
            resolve: {
                loadMyCtrl: ['$ocLazyLoad',
                    function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/auth-controllers.js',
                            'js/services/auth-service.js'
                        ]);
                    }
                ]
            }
        });
        $stateProvider.state('reset_pass', {
            url: '/olvide-contrasena',
            templateUrl: 'templates/solicitud-correo-form.html',
            controller: 'ResetCtrl',
            authenticate: false,
            resolve: {
                loadMyCtrl: ['$ocLazyLoad',
                    function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/auth-controllers.js',
                            'js/services/auth-service.js'
                        ]);
                    }
                ]
            }
        });
        $stateProvider.state('main', {
            templateUrl: 'templates/submenu.html',
            controller: 'LogoutCtrl',
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/auth-controllers.js',
                            'js/services/auth-service.js'
                        ]);
                    }]
            }
        }).state('main.home', {
            url: '/home',
            templateUrl: 'templates/home.html',
            controller: "HomeCtrl",
            resolve: {
                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                        return $ocLazyLoad.load([
                            'js/controllers/home-controllers.js',
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
