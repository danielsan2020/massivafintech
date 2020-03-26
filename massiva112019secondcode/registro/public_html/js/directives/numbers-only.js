/* global App, app */

angular.module("app").directive('numbersOnly', numbersOnly);
function numbersOnly() {
    var directive = {
        restrict: 'A',
        scope: {
            ngModel: '=ngModel'
        },
        link: link
    };
    return directive;
    function link(scope, element, attrs) {
        var loaded = false;
        scope.$watch('ngModel', function (newVal, oldVal) {
            if (loaded) {
                var arr = (newVal) ? (newVal.toString().split('')) : [];
                if (arr.length === 0)
                    return;
                if (isNaN(newVal) || arr[arr.length - 1] === " " || (!scope.$eval(attrs.allowdecimals) && arr[arr.length - 1] === "." )) {
                    arr.pop();
                    scope.ngModel = arr.join('');
                }
                if (scope.$eval(attrs.lowerthan) && scope.$eval(attrs.lowerthan) - 1 < scope.ngModel) {
                    arr.pop();
                    scope.ngModel = arr.join('');
                }
            }
            loaded = true;
        });
    }
}