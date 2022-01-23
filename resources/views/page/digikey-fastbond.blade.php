@extends('page.layout-class', ['pageParams' => [
  'head' => true,
  'nav' => true
]])
@section('head')
  <title>Digikey FastBond</title>
   <link rel="stylesheet"  href="/vendor/bxslider/jquery.bxslider.css" type="text/css">
  <link rel="stylesheet"  href="/storage/page/digikey-funpack/css/iconfont.css" type="text/css">
  <link rel="stylesheet"  href="/storage/page/digikey-fastbond/css/index.css?v=2021065" type="text/css">
@endsection
@section('nav')
<a href="/page/digikey-fastbond" class="">FastBond</a>
@endsection
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper">
    <div class="topBanner">
      <img alt="硬禾学堂" title="硬禾学堂" src="/storage/page/digikey-fastbond/image/banner.png">
    </div>
    <div class="content">
      <!-- 四模块 -->
      <div class="topRouteList">
        <a target="_blank" href="/page/digikey-fastbond-rule" class="route-item route-item-1" >
          <img src="/storage/page/digikey-fastbond/image/top-list-01.png"/>
        </a>
        <a target="_blank" href="https://appu1kfqmyl7963.h5.xiaoeknow.com/v1/course/column/p_60dc3f22e4b057a4e7296dde?type=3" class="route-item route-item-2">
          <img src="/storage/page/digikey-fastbond/image/top-list-02.png"/>
        </a>

        <a target="_blank" href="https://appu1kfqmyl7963.h5.xiaoeknow.com/v1/course/column/p_60dc3ffae4b057a4e7296e4f?type=3" class="route-item route-item-4">
          <img src="/storage/page/digikey-fastbond/image/top-list-03.png"/>
        </a>
        <a target="_blank" href="https://bbs.eetree.cn/forum.php?mod=viewthread&tid=11442&extra=page%3D1" class="route-item route-item-3">
          <img src="/storage/page/digikey-fastbond/image/top-list-04.png"/>
        </a>
      </div>
    </div>
    <div class="bg-white-img">
        <div class="content">
          <h2>FastBond活动简介</h2>
          <div class="desc-panle flex flex-between flex-center-v flex-center">
            <div class="panle01-l">
              <img class="phone-show" src="/storage/page/digikey-fastbond/image/panle-r-img.png"/>
              <p class="size16">FastBond活动，精选5个主题方向，“智能可穿戴”、“体外诊断”、“环境监测”、“工业机器人”、“智能建筑”，让大家进行项目创意发挥。</p>
              <p class="size16">如果你能在10月20日之前成功在得捷电子购买元器件，且利用它们实现相关功能并提交项目，极大机会获得3重豪礼（3重豪礼：订单返款￥300+前100名加赠￥200+TOP 10额外赠送ADALM2000）。</p>
              <p class="red-text size16">注：所购元器件中必须包含“ADI和美信”的产品，使用推荐芯片，项目评选额外加10分。</p>
            </div>
            <div class="panle01-r phone-hidden">
              <img src="/storage/page/digikey-fastbond/image/panle-r-img.png"/>
            </div>
          </div>
          <a href="https://ad.doubleclick.net/ddm/clk/500898489;308256424;u?https://www.digikey.cn/" target="_blank" class="button-img">
            <img src="/storage/page/digikey-fastbond/image/button.png"/>
          </a>
        </div>
    </div>

    <div class="bg-panle2 father-parent">
      <a href="/project/detail/414" target="_blank" id="jsChangeBg" class="bg-blue-img0"></a>
      <div class="content father-parent slider-content">
        <h2>项目展示</h2>
        <div class="sub-title">主题一：智能可穿戴</div>
        <div class="slider-part">
          <div class="slider2">
            <div class="slide">
              <div class="slide-two-list">
                  <iframe class="slide-img" src="//player.bilibili.com/player.html?aid=931686267&bvid=BV1JM4y1K7rn&cid=369070694&page=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>
                  <div class="video-desc">
                    行业背景
                  </div>
              </div>
              <div class="slide-two-list">
                <iframe class="slide-img" src="//player.bilibili.com/player.html?aid=931493477&bvid=BV1wM4y1M75C&cid=364563122&page=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>
                <div class="video-desc">
                  方案介绍
                </div>
              </div>
            </div>
            <div class="slide">
              <div class="slide-two-list">
              <iframe class="slide-img" src="//player.bilibili.com/player.html?aid=589113044&bvid=BV1aB4y1N7ry&cid=368502404&page=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>
                <div class="video-desc">行业背景</div>
              </div>
              <div class="slide-two-list">
              <iframe class="slide-img" src="//player.bilibili.com/player.html?aid=674103888&bvid=BV1qU4y137do&cid=368504225&page=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>
                <div class="video-desc">方案介绍</div>
              </div>
            </div>
            <div class="slide">
              <div class="slide-two-list">
              <iframe class="slide-img" src="//player.bilibili.com/player.html?aid=291823704&bvid=BV13f4y157MT&cid=372530491&page=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>
                <div class="video-desc">行业背景</div>
              </div>
              <div class="slide-two-list">
              <iframe class="slide-img" src="//player.bilibili.com/player.html?aid=376846059&bvid=BV1go4y1Q7rs&cid=373432028&page=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>
                <div class="video-desc">方案介绍</div>
              </div>
            </div>
            <div class="slide">
              <div class="slide-two-list">
                <iframe class="slide-img" src="//player.bilibili.com/player.html?aid=206939769&bvid=BV1th411z7pg&cid=376905098&page=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>
                <div class="video-desc">行业背景</div>
              </div>
              <div class="slide-two-list">
                <iframe class="slide-img" src="//player.bilibili.com/player.html?aid=589376951&bvid=BV1xq4y1X7kK&cid=376906333&page=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>
                <div class="video-desc">方案介绍</div>
              </div>
            </div>
            <div class="slide">
              <div class="slide-two-list">
                <iframe class="slide-img" src="//player.bilibili.com/player.html?aid=716966907&bvid=BV17Q4y1f7JK&cid=376907446&page=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>
                <div class="video-desc">行业背景</div>
              </div>
              <div class="slide-two-list">
                <iframe class="slide-img" src="//player.bilibili.com/player.html?aid=804429688&bvid=BV1yy4y1j7ac&cid=376908658&page=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>
                <div class="video-desc">方案介绍</div>
              </div>
            </div>
          </div>
        </div>
        <div class="slider-bottom-desc" id="sliderBottom0">
          <p>智能可穿戴推荐芯片</p>
          <p class="margin-b30">购买推荐芯片，项目评选额外加10分，<a href="/project/detail/414" target="_blank" ><span class="red-text">查看详情</span></a></p>
          <p>ADI：AD5940 | ADPD4100 | ADA4505-2 | AD8233 | ADXL362 <br/>Maxim：MAXM86146 | MAX32660 | MAXREFDES103 | MAXM17623 | MAX77655 | TMC2300</p>
        </div>
        <div class="slider-bottom-desc" id="sliderBottom1">
          <p>体外诊断推荐芯片</p>
          <p class="margin-b30">购买推荐芯片，项目评选额外加10分，<a href="/project/detail/415" target="_blank" class="red-text">查看详情</a></p>
          <p>ADI：ADUCM355 | ADAS1000 | ADT7320 | ADA4254 | AD7172-4 | LTC6655 <br/>Maxim：TMC2130 | MAX17634 | MAX17691</p>
        </div>
        <div class="slider-bottom-desc" id="sliderBottom2">
          <p>环境监测推荐芯片</p>
          <p class="margin-b30">购买推荐芯片，项目评选额外加10分，<a href="/project/detail/418" target="_blank" class="red-text">查看详情</a></p>
          <p>ADI：ADUCM355 | AD5940 | ADPD4101 | LTC6078 <br/>Maxim：MAX19713 | TMC5130 | MAX17624 | MAX17662</p>
        </div>
        <div class="slider-bottom-desc" id="sliderBottom3">
          <p>工业机器人推荐芯片</p>
          <p class="margin-b30">购买推荐芯片，项目评选额外加10分，<a href="/project/detail/417" target="_blank" class="red-text">查看详情</a></p>
          <p>ADI：ADXL355 | ADUM7701 | ADA4571 <br/>Maxim：MAX15062 | TMC4671 | MAX78000 | MAX17504 | MAX22515 | MAXM17632</p>
        </div>
        <div class="slider-bottom-desc" id="sliderBottom4">
          <p>智能建筑推荐芯片</p>
          <p class="margin-b30">购买推荐芯片，项目评选额外加10分，<a href="/project/detail/416" target="_blank" class="red-text">查看详情</a></p>
          <p>ADI：ADUCM355 | ADAS1000 | ADT7320 | ADA4254 | AD7172-4 | LTC6655 <br/>Maxim：TMC2130 | MAX17634 | MAX17691</p>
        </div>
      </div>
    </div>

    <div class="bg-white">
      <div class="content text-center">
        <h2>FastBond 流程介绍</h2>
        <img class="phone-show" src="/storage/page/digikey-fastbond/image/phone/panle3.png"/>
        <img class="phone-hidden" src="/storage/page/digikey-fastbond/image/panle3.png"/>
        <p class="margin-t70 padding-b50">参加FastBond活动的用户的得捷订单中，必须包含ADI和美信的2种产品。<br/>
          用户邮件提交的视频、代码、文档将会用于在硬禾或得捷电子运营的网站、公众号、视频号上展示，且同意接收由Digi-Key得捷电子发出的电子通讯。<br/>
          活动最终解释权归硬禾所有。
        </p>
      </div>
    </div>
    <div class="content text-center">
      <h2>活动福利</h2>
      <div class="panle3-list flex flex-between flex-center margin-b30">
        <div class="panle3-list-li">
          <img src="/storage/page/digikey-fastbond/image/panle4-list-1.png"/>
          <p class="margin-b-20">福利一</p>
          <p>得捷购买器件，发布方案＆PCB板图：返300元京东券</p>
        </div>
        <div class="panle3-list-li">
          <img src="/storage/page/digikey-fastbond/image/panle4-list-2.png"/>
          <p class="margin-b-20">福利二</p>
          <p>前100提交项目并通过审核：加赠200元等值奖品</p>
        </div>
        <div class="panle3-list-li">
          <img src="/storage/page/digikey-fastbond/image/panle4-list-3.png"/>
          <p class="margin-b-20">福利三</p>
          <p>TOP 10 有机会进行 Digi-Key VIP采访</p>
        </div>
        <div class="panle3-list-li">
          <img src="/storage/page/digikey-fastbond/image/panle4-list-4.png"/>
          <p class="margin-b-20">福利四</p>
          <p>Top 10 项目评选：ADALM2000</p>
        </div>
      </div>
      <a class="phone-hidden" href="https://ad.doubleclick.net/ddm/clk/500898450;308256424;i?https://www.digikey.cn/" target="_blank">
        <img style="max-width: 100%;" src="/storage/page/digikey-fastbond/image/ad.jpg"/>
      </a>
      <a class="phone-show" href="https://ad.doubleclick.net/ddm/clk/500600330;308256424;m?https://www.digikey.cn/" target="_blank">
        <img style="max-width: 100%;" src="/storage/page/digikey-fastbond/image/phone/ad.jpg"/>
      </a>
    </div>
    <!-- footer -->
    <div class="page-footer bg-white page-footer-3">
      <div class="content">
        <h2 class="">关于得捷电子</h2>
        <div class="page-footer-text">
          <div class="page-footer-left">
            <p>Digi-Key Electronics</p>
            <br />
            <p>
              得捷电子是一家全球性的<a href="https://www.digikey.cn/zh/products" target="_blank">电子元器件</a>综合服务授权分销商，总部设在美国明尼苏达州锡夫里弗福尔斯市，经销着来自 1100 多家优质品牌制造商的 990 多万种产品，立即发货。Digi-Key 还提供各种各样的在线资源，如 <a href="https://www.digikey.cn/zh/resources/design-tools/design-tools" target="_blank">EDA 和设计工具</a>、规格书、<a href="https://www.digikey.cn/reference-designs/zh" target="_blank">参考设计</a>、教学文章和视频、<a href="https://www.digikey.cn/zh/videos" target="_blank">多媒体资料库</a>等。通过电子邮件、电话和在线客服提供 24/7 技术支持。如需其它信息或查询 Digi-Key 广泛的产品库，请访问<a href="https://www.digikey.com/" target="_blank">www.digikey.cn</a>并关注我们的 <a href="https://www.linkedin.com/company/digikey/" target="_blank">LinkedIn</a>, <a href="https://www.digikey.cn/zh/resources/wechat" target="_blank">微信</a>, <a href="https://weibo.com/digikeyelectronics" target="_blank">微博</a>, <a href="http://v.qq.com/biu/vplus?id=0bdc38b6513d84e53c127e842543015d&__t=1&ptag=1.sina&_out=1" target="_blank">QQ 视频</a> 和 <a href="https://space.bilibili.com/516262565" target="_blank">B站</a>。
            </p>
          </div>
          <div class="page-footer-r">
            <img src="/storage/page/digikey-fastbond/image/FastBond_300.png"/>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-logo">
      <h2>合作伙伴</h2>
      <div class="footer-firend flex flex-between flex-center flex-center-v margin-b30">
        <img src="/storage/page/digikey-fastbond/image/firend01.png">
        <img src="/storage/page/digikey-fastbond/image/firend02.png">
      </div>
    </div>
  </div>


@endsection
@section('scripts')
<script type="text/javascript" src="/vendor/bxslider/jquery.bxslider.js"></script>
<script>
$(document).ready(function(){
  let windowWidth = $(window).width();
  let option = {}
  if(windowWidth>=800){
    option.slideWidth=1100
    option.slideMargin = 20
    // option.mode="horizontal"
  }else if(windowWidth>=376 && windowWidth<=418){
    option.slideWidth=400
    // option.slideMargin = 450
    // option.slideWidth= windowWidth*0.9
    // option.mode="vertical"
  }else if(windowWidth>=325 && windowWidth<=375){
    option.slideWidth=350
  }else if(windowWidth>=300 && windowWidth<=324){
    option.slideWidth=300
  }
  let bxSlider = $('.slider2').bxSlider({
    // pc
    slideWidth: option.slideWidth,
    slideMargin:option.slideMargin,
    bottomHeight:30, //幻灯片底部边距，新增参数勿删
    auto: true,
    // auto: false,
    minSlides: 1,
    maxSlides: 1,
    autoHover:true,
    speed:1000,
    mode:"horizontal",
    // slideWidth: 380,
    // bottomHeight:30,
    onSlideNext: function () {
      jsChangeBgFun()
    },
    onSlidePrev: function () {
      jsChangeBgFun()
    },
    onSlideBefore: function () {
      jsChangeBgFun()
    },
    onSlideAfter: function () {
      jsChangeBgFun()
    },
  });
  var pageurl = ""
  function jsChangeBgFun(){
      let currentIndex = bxSlider.getCurrentSlide()
      let bgClassName = 'bg-blue-img'+currentIndex
      $('#jsChangeBg').removeClass()
      $('#jsChangeBg').addClass(bgClassName)
      let bottomDescName = '#sliderBottom'+currentIndex
      $('.slider-bottom-desc').hide()
      $(bottomDescName).show()
      switch (currentIndex) {
        case 1:
          pageurl = '/project/detail/415'
          $('.sub-title').text('主题二：体外诊断')
          break;
        case 2:
          pageurl = '/project/detail/418'
          $('.sub-title').text('主题三：环境监测')
          break;
        case 3:
          pageurl = '/project/detail/417'
          $('.sub-title').text('主题四：工业机器人')
          break;
        case 4:
          pageurl = '/project/detail/416'
          $('.sub-title').text('主题五：智能建筑')
          break;
        default:
          pageurl = '/project/detail/414'
          $('.sub-title').text('主题一：智能可穿戴')
          break;
      }
      $('#jsChangeBg').attr('href',pageurl)
  }
});
</script>
@endsection
