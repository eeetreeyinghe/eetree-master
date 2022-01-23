@extends('layouts.app')
@isset($metaTitle)
    @section('title', $metaTitle)
@endisset
<!-- 文档标签页 -->
@section('content')
<!-- 模拟文档标签页 -->
<div class="top-no-space">
    <img src="/img/doc-bg.png" alt="精选文档" title="精选文档">
</div>
@if (!empty($searchQ))
<div class="bg-white box-shadow">
    <div class="container">
        <div class="user-home-tab clk-tab-doc current">文档</div>
        <div class="user-home-tab clk-tab-project">项目</div>
    </div>
</div>
@endif
@if ($pageId === 'tag')
<div class="bg-white box-shadow">
    <div class="container">
        <div class="user-home-tab current">文档</div>
        <a href="{{ route('tag.items', ['tag' => $currentTag, 'type' => 'project']) }}"><div class="user-home-tab">项目</div></a>
    </div>
</div>
<!-- 项目标签页条件 -->
<div class="search-tabs">
    <div class="bg-white container flex flex-center tag-grounds">
        <h4>标签：</h4>
        <div class="flex flex-center">{{ $currentTag->name }}</div>
    </div>
</div>
@endif
<div class="container clearpadding flex flex-between doc-container" style="margin-top: 20px;">
    <div class="left-doc bg-white">
        <h4 class="title-border">{{ $pageTitle }}</h4>
        <div class="main-list-package">
            @if ($docs->isEmpty() && (!isset($topProjects) || $topDocs->isEmpty()))
                <div class="no-list-part">
                    <img src="/img/icons/center-no-list.svg">
                    <h5 class="no-list">抱歉，未查询到相关文档</h5>
                </div>
            @else
                @if (isset($topProjects) && $topDocs->isNotEmpty())
                    @foreach ($topDocs as $doc)
                    <div class="content-list">
                        <div class="info">
                            <a href="{{ route('doc.detail', ['doc' => $doc->id, 'from' => 't']) }}" class="max-height-90"> 
                                <h4>{{ $doc->title }}</h4>
                                <p class="description">{{ $doc->description }}</p>
                            </a>
                            <ul class="flex flex-center-v doc-bottom-list">
                                <li>
                                    <div class="portrait">
                                        <a href="{{ route('user.home', ['user' => $doc->user->id]) }}">
                                            <img src="{{ $doc->user->avatar }}">
                                            <span class="name">{{ $doc->user->nickname }}</span>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <i class="el-icon-time"></i>
                                    <span>{{ $doc->publish_at->format('Y-m-d') }}</span>
                                </li>
                                <li>
                                    <i class="el-icon-view"></i>
                                    <span>{{ $doc->view_count }}</span>
                                </li>
                                <li>
                                    <img class="margin-r-8" src="/img/icons/thumbs-up.svg" alt="点赞数">
                                    <span>{{ $doc->like_count }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @endforeach
                @endif

                @if ($docs->isNotEmpty())
                @foreach ($docs as $doc)
                <div class="content-list">
                    <div class="info">
                        <a href="{{ route('doc.detail', ['doc' => $doc->id]) }}"><h4>{{ $doc->title }}</h4></a>
                        <p class="description">{{ $doc->description }}</p>
                        <ul class="flex flex-center-v doc-bottom-list">
                            <li>
                                <div class="portrait">
                                    <a href="{{ route('user.home', ['user' => $doc->user->id]) }}">
                                        <img src="{{ $doc->user->avatar }}">
                                        <span class="name">{{ $doc->user->nickname }}</span>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <i class="el-icon-time"></i>
                                <span>{{ $doc->publish_at->format('Y-m-d') }}</span>
                            </li>
                            <li>
                                <i class="el-icon-view"></i>
                                <span>{{ $doc->view_count }}</span>
                            </li>
                            <li>
                                <img class="margin-r-8" src="/img/icons/thumbs-up.svg" alt="点赞数">
                                <span>{{ $doc->like_count }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach
                @endif
            @endif
            {{ $docs->links() }}
        </div>
    </div>
    <div class="right-doc bg-white">
        <h4 class="title-border">热门标签</h4>
        <div class="tags-list tag-grounds flex flex-center-v flex-wrap">
            @foreach ($hotTags as $hotTag)
            <a href="{{ $hotTag['link'] }}"><div class="flex flex-center">{{ $hotTag['title'] }}</div></a>
            @endforeach
        </div>
    </div>
</div>
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script>
  $('.user-home-tab').click(function(e){
    $('.user-home-tab').removeClass('current')
    $(e.currentTarget).addClass('current')
  })
</script>
@endsection
