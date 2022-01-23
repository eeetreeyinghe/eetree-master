@extends('layouts.app')

@section('content')
    <div class="container main">
        <router-view />
    </div>
@endsection

@section('scripts')
<script src="{{ mix('js/ucenter.js') }}"></script>
@endsection
