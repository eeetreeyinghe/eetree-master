@extends('layouts.nonav')
@section('title', $doc->title)
@section('description', $doc->description)

@section('content')
<span class="no-login"></span>
<link href="{{ asset('vendor/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card detail-card">
                <xy-doc :root-node="rootNode" :doc-id="{{ $doc->id }}" ref="xyDoc"></xy-doc-node>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
var pageOptions = @json([
    'content' => $doc['content'],
]);
</script>
<script src="{{ mix('js/pages/doc_detail.js') }}"></script>
@endsection
