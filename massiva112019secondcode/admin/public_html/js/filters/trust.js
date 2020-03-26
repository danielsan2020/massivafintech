angular.module('app').filter('trusted', [
    '$sce',
    function ($sce) {
        return function (text) {
            return $sce.trustAsHtml(text);
        };
    }
]);
angular.module('app').filter('trustedUrl', [
    '$sce',
    function ($sce) {
        return function (url) {
            if (url.includes("youtube")) {
                var video_id = url.split('v=')[1].split('&')[0];
                url = "https://www.youtube.com/embed/" + video_id;
            } else {
                if (url.includes("vimeo")) {
                    var video_id = url.split('/')[1];
                    url = "https://player.vimeo.com/video/" + video_id;
                }
            }
            return $sce.trustAsResourceUrl(url);
        };
    }
]);