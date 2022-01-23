@extends('layouts.app')
@section('title', $showUser->nickname . '个人主页')
@section('description', $showUser->nickname . '个人主页')

@section('content')
  <div class="userhome-head">
    <div class="container ">
      <div class="el-row">
        <div class="el-col el-col-16">
          <div class="flex flex-center-v">
            <img class="avatar" src="{{ $showUser->avatar }}"/>
            <div class="user-head-desc">
              <h4>{{ $showUser->nickname }}</h4>
              <p>物联网行业专媒体物联网行业专媒体物联网行业专媒体物联网行业专媒体物联网行业专媒体</p>
            </div>
          </div>
        </div>
        <div class="el-col el-col-8">
          <ul>
            <li class="panel-heading" >
              <h4>精选文档</h4>
              <p>{{ $totalItems['doc'] }}</p>
            </li>
            <li class="panel-heading" >
              <h4>精选项目</h4>
              <p>{{ $totalItems['project'] }}</p>
            </li>
            <li class="panel-heading">
              <h4>总收藏</h4>
              <p>{{ $showUser->fav_count + $showUser->pj_fav_count }}</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-white box-shadow">
    <div class="container">
      <div class="user-home-tab @if ($tab != 'projects') current @endif"><a href="{{ route('user.home', ['user' => $showUser->id]) }}">发布的文章</a></div>
      <div class="user-home-tab @if ($tab == 'projects') current @endif"><a href="{{ route('user.home', ['user' => $showUser->id, 'tab' => 'projects']) }}">发布的项目</a></div>
    </div>
  </div>
  <div class="container clearpadding " style="margin-top: 30px;">
    @if ($tab == 'projects')
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
          <h5 class="no-list">他还没有发布项目哦~</h5>
        </div>
      @endif
    @else
      @if ($items->isNotEmpty())
        <!-- 精选作品 -->
        <div class="main-list-package bg-white">
          @foreach ($items as $item)
          <div class="content-list">
            <div class="info">
              <a href="{{ route('doc.detail', ['doc' => $item->id]) }}">
                <h4>{{ $item->title }}</h4>
              </a>
              <p class="description">{{ $item->description }}</p>
              <ul class="flex flex-center-v">
                  <li>
                    <i class="el-icon-time"></i>
                    <span>{{ $item->publish_at->format('Y-m-d') }}</span>
                  </li>
                  <li>
                    <i class="el-icon-view"></i>
                    <span>{{ $item->view_count }}</span>
                  </li>
              </ul>
            </div>
          </div>
          @endforeach
          {{ $items->links() }}
        </div>
      @else
        <div class="no-list-part">
          <img src="/img/icons/center-no-list.svg">
          <h5 class="no-list">他还没有发布作品哦~</h5>
        </div>
      @endif
    @endif
  </div>
@endsection
