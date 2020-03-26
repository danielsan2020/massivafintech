angular.module('app').directive('atLeastOneChecked', function (defaultErrorMessageResolver) {
    return {
        restrict: 'A',
        require: 'ngModel',
        scope: {
            atLeastOneChecked: '=atLeastOneChecked'
        },
        link: function (scope, element, attributes, ngModel) {
            ngModel.$validators.atLeastOneChecked = function (modelValue) {
                var valido = true;
                if (typeof (modelValue) !== "undefined") {
                    if (Array.isArray(modelValue)) {
                        if (modelValue.length === 0) {
                            valido = false;
                        }
                    } else {
                        valido = false;
                    }
                }
                if (!valido) {
                    defaultErrorMessageResolver.getErrorMessages().then(function (errorMessages) {
                        errorMessages['atLeastOneChecked'] = 'Es necesario seleccionar al menos un elemento';
                    });
                }
                return valido;
            };
            scope.$watch('atLeastOneChecked', function () {
                ngModel.$validate();
            });
        }
    };
});