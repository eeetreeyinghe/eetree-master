angular.module('kityminderEditor')
    .directive('xyvideoBtn', ['$modal', function($modal) {
        return {
            restrict: 'E',
            templateUrl: 'ui/directive/xyvideoBtn/xyvideoBtn.html',
            scope: {
                minder: '='
            },
            replace: true,
            link: function($scope) {
                var minder = $scope.minder;

                $scope.addXyvideo = function() {

                    var xyvideo = minder.queryCommandValue('video');

                    var xyvideoModal = $modal.open({
                        animation: true,
                        templateUrl: 'ui/dialog/xyvideo/xyvideo.tpl.html',
                        controller: 'xyvideo.ctrl',
                        size: 'md',
                        resolve: {
                            video: function() {
                                return xyvideo;
                            }
                        }
                    });

                    xyvideoModal.result.then(function(result) {
                        minder.execCommand('image', '')
                        minder.execCommand('video', result.url, '', result.video);
                    });
                }
            }
        }
    }]);