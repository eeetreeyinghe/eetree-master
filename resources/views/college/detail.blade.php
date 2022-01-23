@extends('layouts.app')
@section('title', $college->name)
@section('description', $college->name)

@section('content')
  <div class="userhome-head">
    <div class="container ">
      <div class="el-row">
        <div class="flex flex-center-v">
          @if ($college->cloud_id)
          <img class="avatar" src="{{ $college->cloud->url }}"/>
          @endif
          <div class="user-head-desc">
            <h2>{{ $college->name }}</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container clearpadding " style="margin-top: 30px;">
    @if ($items->isNotEmpty())
      <!-- 项目 -->
      <div class="pro-list-package">
        @foreach ($items as $item)
          @include('project.listdata', ['project' => $item])
        @endforeach
      </div>
      {{ $items->links() }}
    @else
      <div class="no-list-part">
        <img src="/img/icons/center-no-list.svg">
        <h5 class="no-list">该高校还没有相关项目哦~</h5>
      </div>
    @endif
  </div>
@endsection
