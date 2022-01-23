@extends('layouts.app')
@section('title', $doc->title)
@section('description', $doc->description)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="detail-top-nav">
                <a href="/">首页</a>
                @foreach($docBreadcrumbs as $breadcrumb)
                    &gt; <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
                @endforeach
                &gt; <span>{{ $doc->title }}</span>
            </div>
            <div class="card detail-card">
                <div class="left-nav">
                    <ul>
                        <!-- <li>
                            <a href="#">
                                <p class="square square-radius"><i class="fa fa-eye" aria-hidden="true"></i></p>
                                查看
                            </a>
                        </li> -->
                        <li class="toggle-like">
                            <a href="javascript:void(0);">
                                <p class="square">
                                    <i class="fa @empty($doc->like_id) fa-thumbs-o-up @else fa-thumbs-up @endif" aria-hidden="true" data-id="{{ $doc->like_id }}" data-like_id="{{ $doc->id }}"></i>
                                </p>
                                点赞
                            </a>
                        </li>
                        <li class="toggle-fav">
                            <a href="javascript:void(0);">
                                <p class="square">
                                    <i class="fa @empty($doc->favorite_id) fa-star-o @else fa-star @endif" aria-hidden="true" data-id="{{ $doc->favorite_id }}" data-fav_id="{{ $doc->id }}"></i>
                                </p>
                                收藏
                            </a>
                        </li>
                        <li>
                            <a href="#wantComment">
                                <p class="square">
                                    <i class="fa fa-comment-o"></i>
                                </p>
                                评论
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" id="mindBtn">
                                <p class="square">
                                    <i class="fa fa-sitemap" aria-hidden="true"></i>
                                </p>
                                脑图
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" rel="external nofollow" data-toggle="modal" data-target="#historymodal" >
                                <p class="square square-radius"><i class="fa fa-history" aria-hidden="true"></i></p>
                                历史
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" @click="saveDoc">
                                <p class="square">
                                    <i class="fa fa-save" aria-hidden="true"></i>
                                </p>
                                保存
                            </a>
                        </li>
                        <li>
                            <div class="share-div" onclick="js_showshare()">
                                <p class="square">
                                    <i class="fa fa-share-alt-square" aria-hidden="true"></i>
                                </p>
                                分享
                                <div id="js-share" class="hide share-div">
                                    <div class="bdsharebuttonbox">
                                        <a href="#" class="bds_tsina fa fa-weibo" data-cmd="tsina"></a>
                                        <a href="#" class="bds_sqq fa fa-qq" data-cmd="sqq"></a>
                                        <a href="#" class="bds_weixin fa fa-weixin" data-cmd="weixin"></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <h3 class="detail-title">{{ $doc->title }}</h3>

                @if (!$useJs)
                <div class="card-list" id="doc-novue">
                    @include('doc._docrow', ['node' => $doc->parsed_content['root'], 'depth' => 1])
                </div>
                @endif
                <xy-doc :root-node="rootNode" :doc-id="{{ $doc->id }}" ref="xyDoc"></xy-doc-node>
            </div>
            <xy-comment
                :uid="@guest 0 @else {{ Auth::id() }} @endguest"
                :comment-item="{{ $doc->id }}"
                url-index="{{ route('comment.index') }}"
                url-store="{{ route('comment.store') }}"
                url-delete="{{ route('comment.delete', ['comment' => 'placeholder']) }}"
                url-reply-list="{{ route('comment.replyList', ['comment' => 'placeholder']) }}"
                url-reply="{{ route('comment.reply', ['target' => 'placeholder']) }}"
                url-login="{{ route('login') }}"
            >
            </xy-comment>
        </div>
        <div class="col-md-2 detail-user-dl">
            <dl class="active">
                <dd class="left"><a href="{{ route('user.home', ['user' => $docUser->id]) }}"><img class="user-avatar" src="{{ $docUser->avatar }}"></dd><dd class="right"><span class="user-name">{{ $docUser->nickname }}</span></a></dd>
            </dl>
            <dl>
                <dd class="left"><span class="radius-fa"><i class="el-icon-view"></i></span></dd><dd class="right">{{ $doc->view_count }}次阅读</dd>
            </dl>
            <dl>
                <dd class="left"><span class="radius-fa"><i class="el-icon-date"></i></span></dd><dd class="right">{{ $doc->publish_at->format('Y-m-d') }}</dd>
            </dl>
            <dl>
                <dd class="left"><span class="radius-fa"><i class="el-icon-price-tag"></i></span></dd>
                <dd class="right">
                @foreach ($doc->tags as $tag)
                    <a href="{{ route('tag.items', ['tag' => $tag]) }}" target="_blank">{{ $tag->name }}</a>
                @endforeach
                </dd>
            </dl>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="historymodal" tabindex="-1" role="dialog" aria-labelledby="historymodal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">修订记录</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="history-panle">
                    <ul>
                        @if ($docHistory->isNotEmpty())
                            @foreach ($docHistory as $history)
                            <li>
                                <h4>{{ $history->created_at->format('Y-m-d') }}</h4>
                                <p>{{ $history->description }}</p>
                            </li>
                            @endforeach
                        @endif
                        <li>
                            <h4>{{ $doc->created_at->format('Y-m-d') }}</h4>
                            <p>{{ $doc->description }}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
var sharePic = '';
if ($('.card-list img').length > 0) {
    sharePic = $('.card-list img').eq(0).attr('src');
}
window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdPic":sharePic,"bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src="{{ asset('vendor/bdshare/api/js/share.js') }}"+'?version='+~(-new Date()/36e5)];

if (sharePic == '') {
    sharePic = '{{ asset('/img/logo300.jpeg') }}';
}
function js_showshare(){
    $('#js-share').toggle();
}
var pageOptions = @json([
    'content' => $doc['content'],
    'mindmapUrl' => route('doc.mindmap', ['doc' => $doc['id']])
]);
</script>
<script src="{{ mix('js/pages/doc_detail.js') }}"></script>
@isset($wxJssdk)
<script src="https://res.wx.qq.com/open/js/jweixin-1.4.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    wx.config({!! $wxJssdk !!});
    wx.ready(function () {
        wx.updateAppMessageShareData({
            title: '{{ $doc->title }}',
            desc: '{{ $doc->description }}',
            link: '{{ url()->current() }}',
            imgUrl: sharePic,
            success: function () {
            }
        });
        wx.updateTimelineShareData({
            title: '{{ $doc->title }}',
            link: '{{ url()->current() }}',
            imgUrl: sharePic,
            success: function () {
            }
        })
    });
</script>
@endisset
@endsection
