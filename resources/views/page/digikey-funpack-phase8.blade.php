@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper phase3">
    <div class="topBanner">
      <!-- class="phone-hidden" -->
      <img alt="DK得捷购八期" title="DK得捷购八期" src="/storage/page/digikey-funpack/image/8/banner.png">
    </div>
    <div class="content">
      <!-- 四模块 -->
      <div class="topRouteList">
        <div class="route-item route-item-1" id="adbuy">
            <div class="route-item-left">
              <img src="/storage/page/digikey-funpack/image/shop.png"/>
            </div>
            <div class="route-item-right">
              <h4>得捷购</h4>
            </div>
        </div>
        <a title="怎么玩" alt="怎么玩" target="_blank" href="/page/digikey-funpack/rule8" class="route-item route-item-2">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/wandou.png"/>
          </div>
          <div class="route-item-right">
            <h4>怎么玩</h4>
          </div>
        </a>

        <a title="教你做" alt="教你做" target="_blank" href="https://class.eetree.cn/detail/l_6050156ce4b07f419500063a/4?fromH5=true" class="route-item route-item-4">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/vide.png"/>
          </div>
          <div class="route-item-right">
            <h4>教你做</h4>
          </div>
        </a>
        <a title="展示秀" alt="展示秀" target="_blank" href="https://www.eetree.cn/project/detail/245" class="route-item route-item-3">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/tv.png"/>
          </div>
          <div class="route-item-right">
            <h4>展示秀</h4>
          </div>
        </a>
      </div>
      <div class="bg-white">
        <img src="/storage/page/digikey-funpack/image/8/desc.png?1" class="js-imgadbuy" style="cursor:pointer;" />
      </div>
      <!-- step进度条 -->
      <div class="bg-white">
        <h2>Arduino Nano 33 BLE Sense功能简介</h2>
        <div class="content-text content-text-new">
          <p class="font-p-normal">Arduino公司最新推出的NANO 33 BLE是一款基于nRF52840 SoC ARM-32位处理器的微型开发板，其主控芯片集成了蓝牙低功耗(BLE)。NANO 33 BLE不仅保留了与经典款NANO同样的尺寸与管脚，且在此基础上配有多种高性能传感器(角速度，加速度，压力，温湿度，距离，光感，姿态)等，在实现完全兼容的条件下增加了无限多种的组合玩法，可以迅速实现并验证转瞬即逝的灵感火花，是一款所有创客都梦寐以求的伴侣。</p>
          <img class="pro-img-4" src="/storage/page/digikey-funpack/image/8/project.png"/>
          <div class="flex flex-between flex-wrap set-main-content-3">
            <div class="rules-text-p content-text-p">
              <p>Arduino系列的开发板可以分为入门级和进阶级，而本次活动中介绍的Nano 33 BLE Sense毫无疑问是进阶系列中最受创客喜爱的开发板。它不仅继承了Arduino家族中近乎完美的生态基因，而且在保留硬件小巧轻便的基础上，提升了板卡的性能，可延展性与互动性，因此绝对是一款可以陪伴所有电子创客走得最长，最远，最久的伙伴。以下我们列举了Nano 33的几个亮点：</p>
              <p>· 首屈一指的Arduino开源硬件生态，可以最快速完成原型搭建，验证和测试</p>
              <p>· 具有多种物理传感器，能感应加速度，角速度，磁场，温湿度，距离，压强</p>
              <p>· 带有语音，颜色，手势等识别功能，可用于机器学习项目的开发</p>
              <p>· 可实现蓝牙低功耗无线通讯</p>
              <p>· DIP加邮票孔封装，同时满足面包板和扩展板搭配的使用需求</p>
            </div>
          </div>
          <img class="pro-img-4" src="/storage/page/digikey-funpack/image/8/project-b.png"/>
        </div>
      </div>

      <div class="bg-white">
        <div id="stepDiv" class="stepDiv">
          <h2 class="phone-hidden">Digikey Funpack 流程介绍</h2>
          <img src="/storage/page/digikey-funpack/image/2/step2x.png?1" class="phone-hidden">
          <img src="/storage/page/digikey-funpack/image/phone/phone-banner-step.png" class="phone-show">
          <div class="bottom-text-desc phone-hidden">
            <p class="text-center">每期活动用户只有从硬禾指定链接购买才有效（即从"得捷购"进入购买页面）</p>
            <p class="text-center">用户邮件提交的视频、代码、文档将会用于在硬禾或得捷电子运营的网站、公众号、视频号上展示，且同意接收由Digi-Key得捷电子发出的电子通讯。</p>
            <p class="text-center">活动最终解释权归硬禾所有。</p>
          </div>
        </div>
        <div class="line-phone" class="phone-show"></div>
      </div>
      @include('page.digikey-funpack-history', ['index' => 8])

      <div class="bg-white" style="margin-top:20px;">
        <img src="/storage/page/digikey-funpack/image/1200x145_engineer-support_CN.JPG" id="addigikey" style="cursor:pointer;">
        <div class="line-phone" class="phone-show"></div>
      </div>

      <!-- footer -->
      <div class="page-footer bg-white page-footer-3">
        <h2 class="">关于得捷</h2>
        <div class="page-footer-text">
          <div class="page-footer-left">
            <p>Digi-Key Electronics</p>
            <br />
            <p>
              得捷电子是一家全球性的<a href="https://scprod.digikey.com/products/en" target="_blank">电子元器件</a>综合服务授权分销商，总部设在美国明尼苏达州锡夫里弗福尔斯市，经销着来自 1100 多家优质品牌制造商的 990 多万种产品，其中 210 多万种现货供应，立即发货。Digi-Key 还提供各种各样的在线资源，如 <a href="https://scprod.digikey.com/en/resources/design-tools/design-tools" target="_blank">EDA 和设计工具</a>、规格书、<a href="https://scprod.digikey.com/reference-designs/en" target="_blank">参考设计</a>、教学文章和视频、<a href="https://scprod.digikey.com/videos/en" target="_blank">多媒体资料库</a>等。通过电子邮件、电话和在线客服提供 24/7 技术支持。如需其它信息或查询 Digi-Key 广泛的产品库，请访问<a href="https://www.digikey.com/" target="_blank">www.digikey.cn</a>并关注我们的 <a href="https://www.linkedin.com/company/digikey/" target="_blank">LinkedIn</a>, <a href="https://www.digikey.cn/zh/resources/wechat" target="_blank">微信</a>, <a href="https://weibo.com/digikeyelectronics" target="_blank">微博</a>, <a href="http://v.qq.com/biu/vplus?id=0bdc38b6513d84e53c127e842543015d&__t=1&ptag=1.sina&_out=1" target="_blank">QQ 视频</a> 和 <a href="https://space.bilibili.com/516262565" target="_blank">B站</a>。
            </p>
          </div>
          <div class="page-footer-r">
            <img src="/storage/page/digikey-funpack/image/eetree_funpack_500.png"/>
            <p class="phone-show text-center">关注得捷</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    $('.js-imgadbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/490877481;297771580;d?https://www.digikey.cn/zh/products/detail/arduino/ABX00035/10239974');
    })
    $('#adbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/490877481;297771580;d?https://www.digikey.cn/zh/products/detail/arduino/ABX00035/10239974');
    })
    $('#addigikey').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/472049650;277661009;k?http://www.digikey.cn');
    })

  });
</script>
@endsection
