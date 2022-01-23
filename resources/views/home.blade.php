@extends('layouts.app')
@section('title', '电子森林')

@section('content')
@if (!empty($recommends['recommend.area.HOME_SLIDE']))
    <div class="slide-wrapper" >
        <div id="focus">
            <ul>
                @foreach ($recommends['recommend.area.HOME_SLIDE'] as $slide)
                <li>
                    <a href="{{ $slide['link'] }}" title="{{ $slide['title'] }}" target="_blank">
                        <img src="{{ $slide['cloud_url'] }}"  />
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@else
<div class="top-no-space">
    <img src="/img/home-bg.png" alt="首页" title="首页">
</div>
@endif

@if (!empty($recommends['recommend.area.HOME_PROJECT']))
<div class="container clearpadding index-home">
    <div class="index-title flex flex-between flex-center-v">
        <h3>精选项目</h3>
        <a href="{{ route('explore.project') }}" target="_blank"> 查看更多 <i class="el-icon-arrow-right"></i></a>
    </div>
    <div class="pro-list-package">
        @foreach ($recommends['recommend.area.HOME_PROJECT'] as $recommend)
            @include('project.listdata', ['project' => $recommend['obj_data']])
        @endforeach
    </div>
</div>
@endif

@if (!empty($recommends['recommend.area.HOME_COURSE']))
<div class="bg-white">
    <div class="container clearpadding index-home">
        <div class="index-title flex flex-between flex-center-v">
            <h3>精选课堂</h3>
            <a href="//class.eetree.cn" target="_blank"> 查看更多 <i class="el-icon-arrow-right"></i></a>
        </div>
        <div class="pro-list-package class-list-package">
            @foreach ($recommends['recommend.area.HOME_COURSE'] as $recommend)
            <div class="content-list">
                <a href="{{ $recommend['link'] }}" target="_blank">
                    @if (!empty($recommend['cloud_url']))<img class="content-list-img" src="{{ $recommend['cloud_url'] }}" alt="">@endif
                    <div class="class-title-h4 over-ellipsis">{{ $recommend['title'] }}</div>
                    <div class="class-desc-p">
                    {{ $recommend['description'] }}
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@if (!empty($recommends['recommend.area.HOME_DOC']))
<div class="bg-white">
    <div class="container clearpadding index-home">
        <div class="index-title flex flex-between flex-center-v">
            <h3>精选文档</h3>
            <a href="{{ route('explore.doc') }}" target="_blank"> 查看更多 <i class="el-icon-arrow-right"></i></a>
        </div>
        <div class="index-card-list flex flex-between bread-wrap padding-b-30">
            @foreach ($recommends['recommend.area.HOME_DOC'] as $recommend)
            <div class="card-doc">
                <a href="{{ $recommend['link'] }}" target="_blank">
                    <div class="gray-bg-title">{{ $recommend['title'] }}</div>
                </a>
                <p class="index-desc">{{ $recommend['description'] }}</p>
                @if ($recommend['obj_data'])
                <ul class="list-desc-bottom flex flex-center-v">
                    <li>
                        <img class="avatar margin-r-8" src="{{ $recommend['obj_data']['user']['avatar'] }}"/>
                        <span>{{ $recommend['obj_data']['user']['nickname'] }}</span>
                    </li>
                    <li>
                        <i class="el-icon-view margin-r-8"></i>
                        <span>{{ $recommend['obj_data']['view_count'] }}</span>
                    </li>
                    <li>
                        <img class="margin-r-8" src="/img/icons/thumbs-up.svg" alt="点赞数">
                        <span>{{ $recommend['obj_data']['like_count'] }}</span>
                    </li>
                    <li>
                        <i class="el-icon-time margin-r-8"></i>
                        <span>{{ $recommend['obj_data']['publish_at'] }}</span>
                    </li>
                </ul>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@if (!empty($firstWiki))
<div class="container clearpadding index-home">
    <div class="index-title flex flex-between flex-center-v">
        <h3>百科知识库</h3>
        <a href="/wiki" target="_blank"> 查看更多 <i class="el-icon-arrow-right"></i></a>
    </div>
    <div class="index-know flex flex-between padding-b-30">
        <a href="{{ $firstWiki['link'] }}" target="_blank">
            <img class="index-know-left" src="{{ $firstWiki['cloud_url'] }}">
        </a>
        <div class="index-know-right flex bread-wrap flex-center-v">
            @foreach ($recommends['recommend.area.HOME_WIKI'] as $recommend)
            <a class="know-a" href="{{ $recommend['link'] }}" target="_blank">
                <h4>· {{ $recommend['title'] }}</h4>
                <p>{{ $recommend['description'] }}</p>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection
