@extends('layouts.app')
@isset($metaTitle)
    @section('title', $metaTitle)
@endisset
@section('content')
<div class="bg-white detail-top">
    <div class="container clearpadding flex flex-between flex-center-v">
        <img class="pro-left" src="{{ $project->cloud->url }}" alt="{{ $project->title }}">
        <div class="pro-right">
            <h2>{{ $project->title }}</h2>
            @include('project.bar', ['project' => $project, 'preview' => false])
            <div class="button-ground flex flex-between">
                <div class="normal-btns flex flex-center-v">
                    <button type="button" class="el-button el-button--default toggle-fav-prj">
                        <i class="@empty($project->favorite_id) el-icon-star-off @else el-icon-star-on @endif" data-id="{{ $project->favorite_id }}" data-fav_id="{{ $project->id }}"></i>
                    </button>
                    <div class="share-div js-showshare">
                        <button type="button" class="el-button el-button--default">
                            <i class="el-icon-share"></i>
                        </button>
                        <div id="js-share" class="share-div-bottom hide">
                            <div class="bdsharebuttonbox">
                                <a href="#" class="bds_tsina fa fa-weibo" data-cmd="tsina"></a>
                                <a href="#" class="bds_sqq fa fa-qq" data-cmd="sqq"></a>
                                <a href="#" class="bds_weixin fa fa-weixin" data-cmd="weixin"></a>
                            </div>
                        </div>
                    </div>
                    <div class="project-meta">
                        <span class="radius-fa"><i class="el-icon-view"></i></span> {{ $project->view_count }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab-switch-content">
    <div class="detail-tabs bg-white">
        <div class="tab-switch flex flex-center-v container clearpadding">
            <h4 class="tab-h4 @if ($defaultTab == 'basic') hover-color @endif">????????????</h4>
            @if ($project->rule) <h4 class="tab-h4">??????</h4> @endif
            @if ($schedules->isNotEmpty()) <h4 class="tab-h4">????????????</h4> @endif
            @if ($courses->isNotEmpty()) <h4 class="tab-h4">????????????</h4> @endif
            @if ($cases->isNotEmpty()) <h4 class="tab-h4 @if ($defaultTab == 'case') hover-color @endif">??????</h4> @endif
            <h4 class="tab-h4">??????</h4>
        </div>
    </div>
    <div class="container clearpadding flex flex-between margin-t-30">
        <div class="left-doc">
            <div class="tab-content @if ($defaultTab == 'basic') show @endif">
                <div class="bg-white margin-b-20">
                    <h4 class="title-border">????????????</h4>
                    <div class="main-content">
                        @if (!empty($project->video_code))
                        <div class="text-center">
                            {!! $project->video_code !!}
                        </div>
                        @endif
                        <div v-html="prjDes"></div>
                    </div>
                </div>
                @if (!empty($products['COMPONENT']) || !empty($products['SOFTWARE']) || !empty($products['TOOL']) || $relates->isNotEmpty() || $pClouds['DIAGRAM'])
                <div class="bg-white margin-b-20">
                    <h4 class="title-border">?????? & ??????</h4>
                    @if (!empty($products['COMPONENT']))
                        <h4 class="title-h4">?????????</h4>
                        @include('project.product', ['products' => $products['COMPONENT']])
                    @endif
                    @if (!empty($products['SOFTWARE']))
                        <div class="line-bottom-eee margin-b-15 margin-t-15"></div>
                        <h4 class="title-h4">??????</h4>
                        @include('project.product', ['products' => $products['SOFTWARE']])
                        <div class="line-bottom-eee margin-b-15 margin-t-15"></div>
                    @endif
                    @if (!empty($products['TOOL']))
                        <h4 class="title-h4">??????</h4>
                        @include('project.product', ['products' => $products['TOOL']])
                        <div class="line-bottom-eee margin-b-15 margin-t-15"></div>
                    @endif
                    @if ($relates->isNotEmpty())
                        <h4 class="title-h4">??????</h4>
                        @include('project.product', ['products' => $relates])
                        <div class="line-bottom-eee margin-b-15 margin-t-15"></div>
                    @endif
                    @if ($pClouds['DIAGRAM'])
                    <h4 class="title-h4">?????????</h4>
                    <div class="detail-content">
                        @foreach ($pClouds['DIAGRAM'] as $cloud)
                        <img class="curcuit-img" src="{{ $cloud->cloud_url }}">
                        @endforeach
                    </div>
                    <div class="line-bottom-eee margin-b-15 margin-t-15"></div>
                    @endif
                </div>
                @endif
                @if ($pClouds['HTML'])
                    <div class="bg-white margin-b-20">
                        <h4 class="title-border">????????????</h4>
                        @foreach ($pClouds['HTML'] as $cloud)
                        <iframe src="{{ $cloud->cloud_url }}" width="100%" height="600px"></iframe>
                        @endforeach
                    </div>
                @endif
                @if ($pClouds['ATTACHMENT'])
                <div class="bg-white">
                    <h4 class="title-border">??????</h4>
                    <div class="list-zip">
                        <ul>
                            @foreach ($pClouds['ATTACHMENT'] as $cloud)
                            <li class="zip-list-li">
                                <a href="{{ $cloud->cloud_url }}" target="_blank">
                                    <div class="flex flex-center-v flex-between">
                                        <h5>{{ $cloud->cloud_fname }}</h5>
                                        <div class="image-father"><img class="icon-center margin-r-5" src="/img/icons/icon-zip.svg"/></div>
                                    </div>
                                </a>
                                <p>{{ $cloud->description }} </p>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
            @if ($project->rule)
            <div class="tab-content">
                <div class="bg-white">
                    <div class="detail-content padding-b-30 padding-t-25">
                        {!! $project->rule !!}
                    </div>
                </div>
            </div>
            @endif
            @if ($schedules->isNotEmpty())
            <div class="tab-content">
                <div class="bg-white js-pro-step">
                    @foreach ($schedules as $schedule)
                    <h4 class="title-border flex flex-between">
                        {{ $schedule->title }}
                        <span class="prj-schedule-item">??????????????? {{ $schedule->submit_at->format('Y???m???d???') }}<i class="el-icon-arrow-down"></i></span>
                    </h4>
                    <div class="detail-content padding-b-30 padding-t-25">
                        @if (!empty($schedule->video_code))
                        <div class="text-center">
                            {!! $schedule->video_code !!}
                        </div>
                        @endif
                        {!! $schedule->description !!}
                        <div class="line-bottom-eee margin-b-15 margin-t-15"></div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @if ($courses->isNotEmpty())
            <div class="tab-content">
                <div class="main-list-package tab-list-courses">
                    @foreach ($courses as $course)
                    <a href="{{ $course->link }}" target="_blank" >
                    <div class="content-list flex flex-center-v pointer">
                        <img class="content-list-img" src="{{ $course->cloud_url }}">
                        <div class="content-list-desc">
                            <h4 class="title">{{ $course->title }}</h4>
                            <p class="description">{{ $course->description }}</p>
                        </div>
                    </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
            @if ($cases->isNotEmpty())
            <div class="tab-content @if ($defaultTab == 'case') show @endif">
                <div class="main-list-package tab-list-cases">
                    @foreach ($cases as $case)
                    <a href="{{ $case->link }}" target="_blank" >
                    <div class="content-list flex flex-center-v pointer">
                        <img class="content-list-img" src="{{ $case->cloud_url }}">
                        <div class="content-list-desc">
                            <h4 class="title">{{ $case->title }}</h4>
                            <p class="description">{{ $case->description }}</p>
                        </div>
                    </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
            <div class="tab-content">
                <xy-comment
                    :uid="@guest 0 @else {{ Auth::id() }} @endguest"
                    :comment-item="{{ $project->id }}"
                    :comment-type="{{ $projectType }}"
                    url-index="{{ route('comment.index') }}"
                    url-store="{{ route('comment.store') }}"
                    url-delete="{{ route('comment.delete', ['comment' => 'placeholder']) }}"
                    url-reply-list="{{ route('comment.replyList', ['comment' => 'placeholder']) }}"
                    url-reply="{{ route('comment.reply', ['target' => 'placeholder']) }}"
                    url-login="{{ route('login') }}"
                >
                </xy-comment>
            </div>
        </div>
        @if ($goods->isNotEmpty() || $promoteGoods->isNotEmpty())
        <div class="right-doc bg-white">
            @foreach ($goods as $goodsRow)
            <div class="right-img-list">
                @if (!empty($goodsRow->link))
                <a href="{{ $goodsRow->link }}" target="_blank">
                @endif
                    <div class="content-list-img">
                        <img src="{{ $goodsRow->cloud_url }}">
                    </div>
                    <h4 class="title">{{ $goodsRow->name }}</h4>
                @if (!empty($goodsRow->link))
                </a>
                @endif
                <p>{{ $goodsRow->description }}</p>
                @if ($goodsRow->price > 0)
                <div class="price-ground flex flex-center-v flex-between">
                    <div class="price-hover hover-color">??{{ $goodsRow->price }}</div>
                    @if (!empty($goodsRow->link))
                        <a class="el-button el-button--primary is-plain" href="{{ $goodsRow->link }}" target="_blank">
                            <span>????????????</span>
                        </a>
                    @elseif ($prjActive)
                        <button type="button" class="el-button el-button--primary is-plain buy-goods" data-id="{{ $goodsRow->id }}" @if ($goodsRow->xform_id) data-fid="{{ $goodsRow->xform_id }}" @endif>
                            <span>????????????</span>
                        </button>
                    @endif
                </div>
                @endif
            </div>
            @endforeach
            @foreach ($promoteGoods as $goodsRow)
            <div class="right-img-list">
                @if (!empty($goodsRow->link))
                <a href="{{ $goodsRow->link }}" target="_blank">
                @endif
                    <div class="content-list-img">
                        <img src="{{ $goodsRow->cloud->url }}">
                    </div>
                    <h4 class="title">{{ $goodsRow->name }}</h4>
                @if (!empty($goodsRow->link))
                </a>
                @endif
                <p>{{ $goodsRow->description }}</p>
                @if ($goodsRow->price > 0)
                <div class="price-ground flex flex-center-v flex-between">
                    <div class="price-hover hover-color">??{{ $goodsRow->price }}</div>
                    @if (!empty($goodsRow->link))
                        <a class="el-button el-button--primary is-plain" href="{{ $goodsRow->link }}" target="_blank">
                            <span>????????????</span>
                        </a>
                    @else
                        <button type="button" class="el-button el-button--primary is-plain buy-goods" data-id="{{ $goodsRow->id }}" data-promote="{{ $project->user_id }}" @if ($goodsRow->xform_id) data-fid="{{ $goodsRow->xform_id }}" @endif>
                            <span>????????????</span>
                        </button>
                    @endif
                </div>
                @endif
            </div>
            @endforeach
        </div>

        <xy-form
        >
        </xy-form>
        @endif
    </div>
</div>
@if ($project->college)
<div class="container clearpadding margin-t-30 margin-b-20 @if ($defaultTab != 'basic') hide @endif">
    <div class="bg-white">
        <h4 class="title-border">??????</h4>
        <div class="college-detail">
            <a href="{{ route('college.detail', ['college' => $project->college_id]) }}" target="_blank">
                @if ($project->college->cloud_id)
                <img src="{{ $project->college->cloud->url }}"/>
                @endif
            </a>
            <div class="right-part">
                <a href="{{ route('college.detail', ['college' => $project->college_id]) }}" target="_blank">
                    <h6>{{ $project->college->name }}</h6>
                </a>
            </div>
        </div>
    </div>
</div>
@endif
@if (!empty($project->team_intro) || $teams->isNotEmpty())
<div class="container clearpadding margin-t-30 margin-b-20 @if ($defaultTab != 'basic') hide @endif" id="teamPart">
    <div class="bg-white padding-b-30">
        @if (!empty($project->team_intro))
        <h4 class="title-border">????????????</h4>
        <div class="teamList-detail-desc">
            <ul>
                <li>
                    <p class="teamlist-desc">
                        {{ $project->team_intro }}
                    </p>
                </li>
            </ul>
        </div>
        @endif
        @if ($teams->isNotEmpty())
        <h4 class="title-border">????????????</h4>
        <div class="teamList teamList-detail">
            <ul>
                @foreach ($teams as $team)
                <li>
                    @if ($team->user_url)
                    <a href="{{ $team->user_url }}" target="_blank">
                    @endif
                        <img class="avatar" src="{{ $team->cloud_url }}"/>
                    @if ($team->user_url)
                    </a>
                    @endif
                    <div class="right-part">
                        @if ($team->user_url)
                        <a href="{{ $team->user_url }}" target="_blank">
                        @endif
                            <h6>{{ $team->name }}</h6>
                        @if ($team->user_url)
                        </a>
                        @endif
                        <p class="teamlist-desc">
                            {{ $team->description }}
                        </p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@endif
<!-- ???????????? -->
@if ($relatedProjects->isNotEmpty())
<div class="container clearpadding margin-t-30 detail-likes">
    <h4 class="margin-b-20">????????????</h4>
    <div class="pro-list-package">
        @foreach ($relatedProjects as $relatedProject)
            @include('project.listdata', ['project' => $relatedProject])
        @endforeach
    </div>
</div>
@endif
@endsection

@section('scripts')
<script type="text/html" id="prjDes">
    {!! $project->description !!}
</script>
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
<script src="{{ mix('js/pages/prj_detail.js') }}"></script>
<script src="{{ asset('vendor/prism/prism.js') }}"></script>
<script>
    window._bd_share_config={"common":{"bdSnsKey":{},"bdText":'{{ $project->title }}',"bdDesc":"","bdMini":"2","bdPic":'{{ $project->cloud->url }}',"bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src="{{ asset('vendor/bdshare/api/js/share.js') }}"+'?version='+~(-new Date()/36e5)];

    $('.buy-goods').click(function() {
        @guest
            location.href = '{{ route('login') }}'
            return
        @endguest
        var fid = $(this).data('fid');
        @if ($project->has_agreement === 1)
            var show_agreement = true;
        @else
            var show_agreement = false;
        @endif
        var url = '{{ route('pay.confirm') }}?goods_id=' + $(this).data('id');
        if ($(this).data('promote')) {
            url += '&promote=' + $(this).data('promote');
            show_agreement = false;
        }
        if (show_agreement) {
            // ??????????????????
            Modal.confirm({
                title: '????????????',
                msg: `<div class="rule-div">{!! $project->agreement !!}</div>`,
                btnok:'??????'
            }).on(function (e) {
                e.stopPropagation();
                Modal.close();
                gotoPay(url, fid);
            });
        } else {
            gotoPay(url, fid);
        }
    })
    function gotoPay(url, fid) {
        if (fid) {
            showXform(url, fid);
        } else {
            location.href = url;
        }
    }
</script>
@isset($wxJssdk)
<script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    wx.config({!! $wxJssdk !!});
    wx.ready(function () {
        wx.updateAppMessageShareData({
            title: '{{ $project->title }}',
            desc: '{{ $project->summary }}',
            link: '{{ url()->current() }}',
            imgUrl: '{{ $project->cloud->url }}',
            success: function () {
            }
        });
        wx.updateTimelineShareData({
            title: '{{ $project->title }}',
            link: '{{ url()->current() }}',
            imgUrl: '{{ $project->cloud->url }}',
            success: function () {
            }
        })
    });
</script>
@endisset
<style lang="css" scoped>
    .share-div-bottom .bdsharebuttonbox{
        display: flex;
        justify-content: space-between;
    }
    .share-div-bottom .bdsharebuttonbox:after{
        display:none;
    }
    .share-div-bottom .bdsharebuttonbox .bds_tsina,
    .share-div-bottom .bdsharebuttonbox .bds_sqq,
    .share-div-bottom .bdsharebuttonbox .bds_weixin{
        background-position: 0 0;
    }
    .bdshare-button-style0-16 a{
        padding-left: 21px;
        line-height: 19px;
        height: 19px;
    }
    .fa-weibo:before,.fa-qq:before,.fa-weixin:before{
        content:'';
    }
    .share-div-bottom .bdsharebuttonbox .bds_tsina{
        background-image:url("/img/icons/xinlang.svg")
    }
    .share-div-bottom .bdsharebuttonbox .bds_sqq{
        background-image:url("/img/icons/qq.svg")
    }
    .share-div-bottom .bdsharebuttonbox .bds_weixin {
        background-image:url("/img/icons/weixin.svg")
    }
    .el-progress-bar__outer{
        height: 20px;
    }
    .list-mini-desc{
        width:100%;
    }
    .list-mini-desc .el-icon-link{
        float: right;
        border: 1px solid #222;
        border-radius: 5px;
        padding: 2px;
    }
    .list-mini-desc:hover .el-icon-link{
        border-color:#007bff;
    }
    .rule-div{
        max-height: 165px;
        overflow: scroll;
    }
    .rule-div ul li{
        list-style: unset;
    }
</style>
@endsection
