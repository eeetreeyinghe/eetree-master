@extends('layouts.kity')

@section('content')
<body ng-app="viewDocApp" ng-controller="MainController">
<div class="editor-title">
    <h1 class="doc-ope doc-name" style="width:100%; margin-left:0;">
        {{ $doc['title'] }}
    </h1>
</div>
<kityminder-viewer on-init="initEditor(editor, minder)"></kityminder-viewer>

<script src="{{ mix('js/pages/manifest.js') }}"></script>
<script src="{{ mix('js/pages/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('vendor/kityminder/kityminder.js') }}"></script>
<script>
    angular.module('viewDocApp', ['kityminderEditor'])
    .controller('MainController', ['$scope', function($scope) {
        $scope.initEditor = function(editor, minder) {
            minder.importJson(@json($doc['content']));
            minder.disable();
            minder.execCommand('camera');
            minder.execCommand('hand');
            minder.on('dblclick', function(e) {
                var shape = e.kityEvent.targetShape
                if (shape.__KityClassName === 'Image' && shape.getData('video')) {
                    minder.videoViewer.open(shape.getData('video'));
                }
            })
        };
    }]);
</script>

</body>
@endsection
