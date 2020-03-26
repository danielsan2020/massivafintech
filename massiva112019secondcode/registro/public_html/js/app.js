/* global Noty, home_url, angular */
angular.module('app', [
    'ui.router',
    '$uhttp',
    'oc.lazyLoad',
    'ngSanitize',
    'jcs-autoValidate',
    'tooltips',
    'ui.select',
    'ngDialog'
]);
//configuracion de las notificaciones
angular.module('app').config([
    '$uhttpProvider',
    function ($uhttpProvider) {
        $uhttpProvider.setNotifications({
            status_callbacks: {
                401: function () {
                    $.notify('<i class="fa fa-exclamation-triangle fa-3x"></i> Para acceder a esta página, debes autenticarte', {
                        title: 'Atenci&oacute;n',
                        autoHideDelay: 5000,
                        position: 'top center',
                        autoHide: true,
                        className: 'warn'
                    });
                    setTimeout(function () {
                        location.href = home_url;
                    }, 3000);
                    return false;
                },
                403: function () {
                    $.notify('<i class="fa fa-exclamation-triangle fa-3x"></i> No tienes permisos suficientes para acceder a esta página', {
                        title: 'Atenci&oacute;n',
                        autoHideDelay: 5000,
                        position: 'top center',
                        autoHide: true,
                        className: 'warn'
                    });
                    setTimeout(function () {
                        location.href = home_url;
                    }, 3000);
                    return false;
                },
                404: function (response) {
                    var message = (typeof (response.data.message) !== 'undefined') ? response.data.message : 'Contenido no disponible';
                    $.notify(message, {
                        autoHideDelay: 5000,
                        position: 'top center',
                        autoHide: true,
                        className: 'warn'
                    });
                    return false;
                }
            },
            success: function (message, time, title) {
                $.notify(message, {
                    title: title,
                    autoHideDelay: time,
                    className: 'warn'
                });
            },
            warning: function (message, time, title) {
                $.notify(message, {
                    title: title,
                    autoHideDelay: time,
                    className: 'warn'
                });
            },
            error: function (message, time, title) {
                $.notify(message, {
                    title: title,
                    autoHideDelay: time,
                    className: 'warn'
                });
            }
        });
    }
]);