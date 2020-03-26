//filtro para visualizacion de fechas
angular.module('app').filter('fecha', function () {
    return function (text) {
        if (typeof text !== "undefined"&& text !== null) {
            var meses = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
            return parseInt(text.substring(8, 10)) + ' de ' + meses[text.substring(5, 7) - 1] + ' de ' + text.substring(0, 4);
        } else {
            return "";
        }
    };
});
//filtro para mostrar el peso de los archivos en KB y MB
angular.module('app').filter('size_format', function () {
    return function (bytes) {
        bytes = parseInt(bytes);
        if (!isNaN(bytes)) {
            if (bytes === 0) {
                return '0 Byte';
            } else {
                if (bytes > 0) {
                    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
                } else {
                    return '';
                }
            }
        } else {
            return '';
        }
    };
});
angular.module('app').directive('autogrow', function () {
    return {
        restrict: 'A',
        link: function postLink(scope, element, attrs) {
            // hidding the scroll of textarea
            element.css('overflow', 'hidden');
            var update = function () {
                element.css("height", "auto");
                var height = element[0].scrollHeight;
                if (height > 0) {
                    element.css("height", height + "px");
                }
            };
            scope.$watch(attrs.ngModel, function () {
                update();
            });
            attrs.$set("ngTrim", "false");
        }
    };
});
angular.module('app').directive('linebreak', function () {
    return {
        restrict: 'A',
        priority: 450,
        link: function (scope, element) {
            scope.$watch(function () {
                return element[0].innerHTML;
            }, function (text) {
                if (typeof text === "string") {
                    var nuevo = text.trim();
                    if (nuevo.length > 0) {
                        nuevo = nuevo.split(/\r?\n/g);
                        element[0].innerHTML = nuevo.join('<br />');
                    }
                }
            });
        }
    };
});