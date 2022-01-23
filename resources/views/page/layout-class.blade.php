<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,minimum-scale=1.0,user-scalable=0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="renderer" content="webkit">
  @isset($pageParams['head'])
    @yield('head')
  @else
    <title>Digikey Funpack</title>
    <link rel="stylesheet"  href="/storage/page/digikey-funpack/css/iconfont.css" type="text/css">
    <link rel="stylesheet"  href="/storage/page/digikey-funpack/css/index.css?v=202108" type="text/css">
  @endif
</head>

<body>
  <!-- 导航 -->
  <div class="navbar-wrapper">
    <div class="nav-main__wrapper phone-hidden">
      <div class="navbar-main">
        <div class="navbar-logo-common" style="background-image: url(&quot;http://wechatapppro-1252524126.file.myqcloud.com/appU1KFqMYL7963/image/44d838b990171176e5c55c2b73894db7.png&quot;);"></div>
        <div class="navbar-list">
          <div class="navbar-left">
            <a href="https://class.eetree.cn/" class="">首页</a>
            <a href="https://www.eetree.cn" class="">电子森林</a>
            @isset($pageParams['nav'])
              @yield('nav')
            @else
              <a href="https://www.eetree.cn/page/digikey-funpack" class="">Funpack</a>
            @endif
            <a href="https://www.eetree.cn/war/circuitjs.html?lang=zh" class="">电路仿真</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  @yield('content')

  <!-- 页面底部 -->
  <div class="footer">
    <div class="template2-wrapper">
      <div class="info-left">
        <div class="contact-us">联系我们</div>
        <div class="info-left-icon">
          <div class="weixin-wrapper">
            <img src="http://wechatapppro-1252524126.file.myqcloud.com/appU1KFqMYL7963/image/cGNQYWdlRGVzaWduLWZvb3RlclNldHRpbmctNjM4ODI4MzQ.jpg" alt="" class="weixin-qrc">
            <div class="Triangle"></div>
            <i class="iconfont iconweixin"></i>
          </div>
          <a href="https://jq.qq.com/?_wv=1027&amp;k=5uYcu9T">
            <i class="iconfont iconQQ" data-v-e81ed668=""></i>
          </a>
        </div>
      </div>
      <div class="info-line" data-v-e81ed668=""></div>
      <div class="info-right" data-v-e81ed668="">
        <div class="text1" data-v-e81ed668="">联系电话：0512-67862536</div>
        <div class="text2" data-v-e81ed668="">江苏省苏州市工业园区新平街388号腾飞创新园A2-815</div>
      </div>
    </div>
    <div class="company-info-wrapper template2" data-v-e81ed668="">
      <div class="record-wrapper" data-v-e81ed668="">
        <a href="https://beian.miit.gov.cn" target="_blank" class="imfo" data-v-e81ed668="">
          <img src="https://cache-page.xiaoeknow.com/_pc/2020-07-20-15-38-18/img/beian.png" alt="" class="pic" data-v-e81ed668="">苏ICP备19040198号</a>
      </div>
      <div class="company-info" data-v-e81ed668="">
        <span data-v-e81ed668="">Copyright © 2020 -  苏州硬禾信息科技有限公司 All Rights Reserved. </span>
        <a href="https://beian.miit.gov.cn" target="_blank" class="a-decoration" data-v-e81ed668="">苏ICP备19040198号</a>
      </div>
    </div>
  </div>
</body>
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js"></script>
@yield('scripts')
<!-- Google Analytics -->
<script type="text/javascript">
    window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
    ga("create", "UA-135936562-2", "auto");
    ga("send", "pageview");
</script>
<script type="text/javascript" async="" src="//www.google-analytics.com/analytics.js"></script>
<!-- End Google Analytics -->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?64dd9a5ee37934f24a10fd37a20dc63c";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>
</html>
