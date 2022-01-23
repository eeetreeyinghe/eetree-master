@extends('layouts.kity')

@section('content')
<body ng-app="editDocApp" ng-controller="MainController">
@include('layouts.modal')
<div class="editor-title">
    @if ($docDraft['user_category_id'])
    <a class="doc-ope doc-return-up" href="{{ route('user.center') }}#/doc/list/{{ $docDraft['user_category_id'] ? $docDraft['user_category_id'] : '' }}">
        <i class="fa fa-reply" aria-hidden="true"></i>返回上级
    </a>
    <span class="doc-ope doc-share"><i class="fa fa-share-alt-square" aria-hidden="true"></i>分享</span>
    @elseif ($docDraft['type'] == 'cv')
        <span class="doc-ope doc-lock @if (!$isPublish) hide @endif"><i class="fa fa-lock" aria-hidden="true"></i>取消公开</span>
        <span class="doc-ope doc-lock @if ($isPublish) hide @endif"><i class="fa fa-unlock" aria-hidden="true"></i>公开</span>
        @isset($reviewReason)
        <span class="doc-ope doc-reviewreason" style="color:#dc3545"><i class="fa fa-question-circle-o" aria-hidden="true"></i>审核未通过</span>
        <p class="hide">{{ $reviewReason }}</p>
        @endisset
    @endif
    <span class="doc-ope doc-publish"><i class="fa fa-share-alt" aria-hidden="true"></i>前台发布</span>
    <span class="doc-ope doc-save"><i class="fa fa-save" aria-hidden="true"></i>保存</span>
    <a target="_blank" href="{{ route('docDraft.preview', ['docDraft' => $docDraft['id']]) }}" class="doc-ope doc-preview"><i class="fa fa-eye" aria-hidden="true"></i>预览</a>
    <h1 class="doc-ope doc-name">
        {{ $docDraft['title'] }}
    </h1>
</div>
<kityminder-editor on-init="initEditor(editor, minder)"></kityminder-editor>

<script src="{{ mix('js/pages/manifest.js') }}"></script>
<script src="{{ mix('js/pages/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('vendor/kityminder/kityminder.js') }}"></script>
<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
<script>
    function copyurl() {
        var copyText = document.getElementById('shareLink');
        copyText.select();
        document.execCommand("copy");
        toastr.success('链接已复制');
    }
    $('.doc-reviewreason').click(function(){
        Modal.alert({
            title: '原因',
            msg: $(this).next('p').html(),
        })
    });
    var pageOptions = {
        docDraft: @php
            echo json_encode(array(
                'doc_id' => $docDraft['doc_id'],
                'title' => htmlspecialchars($docDraft['title']),
                'desc' => htmlspecialchars($docDesc),
                'content' => $docDraft['content'],
                'type' => $docDraft['type'],
                'isPublish' => $isPublish,
                'setShareUrl' => route('docDraft.setShare', ['docDraft' => $docDraft['id']]),
                'shareUrl' => route('docDraft.setShare', ['docDraft' => $docDraft['id']]),
                'publishUrl' => route('docDraft.publish', ['docDraft' => $docDraft['id']]),
                'lockUrl' => route('doc.lock', ['doc' => $docDraft['doc_id']]),
                'saveUrl' => route('docDraft.save', ['docDraft' => $docDraft['id']]),
                'uploadUrl' => route('upload.docImage', ['docDraft' => $docDraft['id']]),
            )); @endphp
    };
</script>
<script src="{{ mix('js/validate.js') }}"></script>
<script src="{{ mix('js/pages/doc_edit.js') }}"></script>
</body>
@endsection
