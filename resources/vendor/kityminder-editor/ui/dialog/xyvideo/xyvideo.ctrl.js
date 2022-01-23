angular.module('kityminderEditor')
    .controller('xyvideo.ctrl', ['$http', '$scope', '$modalInstance', 'video', 'server', function($http, $scope, $modalInstance, video, server) {

        $scope.data = {
            video: video.video || '',
            R_VIDEO: /^\<iframe.*\<\/iframe\>$/
        };

        setTimeout(function() {
            var $videoSrc = $('#video-src');
            $videoSrc.focus();
            $videoSrc[0].setSelectionRange(0, $scope.data.video);
        }, 300);

        $scope.shortCut = function(e) {
            e.stopPropagation();

            if (e.keyCode == 13) {
                $scope.ok();
            } else if (e.keyCode == 27) {
                $scope.cancel();
            }
        };

        $scope.ok = function () {
            if($scope.data.R_VIDEO.test($scope.data.video)) {
                $scope.data.video = $scope.data.video.replace("'allowfullscreen'", "allowfullscreen");
                $scope.data.video = $scope.data.video.replace("http://", "https://");
                $modalInstance.close({
                    url: '/vendor/kityminder/images/video-icon.png',
                    video: $scope.data.video
                });
            } else {
                $scope.videoPassed = false;

                var $videoSrc = $('#video-src');
                if ($videoSrc) {
                    $videoSrc.focus();
                    $videoSrc[0].setSelectionRange(0, $scope.data.video.length);
                }

            }

            editor.receiver.selectAll();
        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
            editor.receiver.selectAll();
        };
    }]);