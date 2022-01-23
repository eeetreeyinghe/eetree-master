@extends('layouts.app')
@isset($metaTitle)
    @section('title', $metaTitle)
@endisset

@section('content')
<!-- 模拟项目列表页 -->
<div class="top-no-space">
    <img src="/img/project-head-img.png" alt="项目众筹集地" title="项目众筹集地">
</div>
@if (!empty($searchQ))
<div class="bg-white box-shadow">
    <div class="container">
        <div class="user-home-tab clk-tab-doc">文档</div>
        <div class="user-home-tab clk-tab-project current">项目</div>
    </div>
</div>
@endif
@if ($pageId === 'tag')
<div class="bg-white box-shadow">
    <div class="container">
        <a href="{{ route('tag.items', ['tag' => $currentTag]) }}"><div class="user-home-tab">文档</div></a>
        <div class="user-home-tab current">项目</div>
    </div>
</div>
<!-- 项目标签页条件 -->
<div class="search-tabs">
    <div class="bg-white container flex flex-center tag-grounds">
        <h4>标签：</h4>
        <div class="flex flex-center">{{ $currentTag->name }}</div>
    </div>
</div>
@elseif (empty($searchQ))
<div class="search-tabs">
    <!-- 项目列表页条件 -->
    <div class="bg-white container">
        <form action="" id="projectSearch" class="flex flex-between flex-center-v">
            <div class="left-search-tab">
                <select class="select-tabs" name="platform_id">
                    <option value="">按平台</option>
                    @foreach  ($platforms as $platform)
                    <option value="{{ $platform->id }}" @if (isset($searchParams['platform_id']) && $searchParams['platform_id'] == $platform->id) selected="selected" @endif>{{ $platform->name }}</option>
                    @endforeach
                </select>
                <select class="select-tabs" name="type">
                    <option value ="">按类型</option>
                    @foreach  ($projectEnums['type'] as $type)
                    <option value="{{ $type['k'] }}" @if (isset($searchParams['type']) && $searchParams['type'] == $type['k']) selected="selected" @endif>{{ $type['l'] }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>
</div>
@endif
<div class="container clearpadding " style="margin-top: 30px;">
    @if ($projects->isEmpty() && (!isset($topProjects) || $topProjects->isEmpty()))
    <div class="no-list-part">
        <img src="/img/icons/center-no-list.svg">
        <h5 class="no-list">抱歉，未查询到相关项目</h5>
    </div>
    @else
    <!-- <h3>
        <span class="explore-title">{{ $pageTitle }}</span>
    </h3> -->
    <div class="pro-list-package">
        @if (isset($topProjects) && $topProjects->isNotEmpty())
            @foreach ($topProjects as $project)
                @include('project.listdata', ['project' => $project])
            @endforeach
        @endif
        @if ($projects->isNotEmpty())
            <!-- 项目列表 -->
            @foreach ($projects as $project)
                @include('project.listdata', ['project' => $project])
            @endforeach
        @endif
    </div>
    {{ $projects->links() }}
    @endif
  </div>
  <!-- 模拟项目列表页结束 -->
@endsection

@section('scripts')
<script>
$('.select-tabs').change(function(){
    $('#projectSearch').submit()
});
</script>
@endsection
