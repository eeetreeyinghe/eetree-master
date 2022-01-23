@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper phase3">
    <div class="topBanner">
      <!-- class="phone-hidden" -->
      <img alt="DK得捷购十期" title="DK得捷购十期" src="/storage/page/digikey-funpack/image/10/banner.png">
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
        <a title="怎么玩" alt="怎么玩" target="_blank" href="/page/digikey-funpack/rule10" class="route-item route-item-2">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/wandou.png"/>
          </div>
          <div class="route-item-right">
            <h4>怎么玩</h4>
          </div>
        </a>

        <a title="教你做" alt="教你做" target="_blank" href="https://class.eetree.cn/detail/l_60a31b36e4b07163a65d1e99/4?fromH5=true" class="route-item route-item-4">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/vide.png"/>
          </div>
          <div class="route-item-right">
            <h4>教你做</h4>
          </div>
        </a>
        <a title="展示秀" alt="展示秀" target="_blank" href="https://www.eetree.cn/project/detail/411" class="route-item route-item-3">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/tv.png"/>
          </div>
          <div class="route-item-right">
            <h4>展示秀</h4>
          </div>
        </a>
      </div>
      <div class="bg-white">
        <img src="/storage/page/digikey-funpack/image/10/desc.png" class="js-imgadbuy" style="cursor:pointer;" />
      </div>
      <!-- step进度条 -->
      <div class="bg-white">
        <h2>ARCADE 功能简介</h2>
        <div class="content-text content-text-new">
          <p class="font-p-normal">Kitronik ARCADE是一款功能丰富的可编程游戏手柄，搭配微软MakeCode Arcade编辑器一起使用，你可以参考丰富的教学材料从头开始创建一个游戏，或者，调整现有开放源码的方式学习制作一款游戏。</p>
          <div class="flex flex-between flex-wrap set-main-content-3">
            <div class="rules-text-p content-text-p">
              <p class="font-b">板卡布局：</p>
              <p>· 一个全彩的LCD屏幕</p>
              <p>· 一个用于音频反馈可以使用软件控制音量的压电蜂鸣器</p>
              <p>· 一个用于触觉反馈的振动马达</p>
              <p>· 六个输入按钮</p>
            </div>
            <div class="rules-text-p content-text-p rules-text-p-r">
              <p class="phone-hidden">&nbsp;</p>
              <p>· 一个菜单按钮</p>
              <p>· 一个复位按钮</p>
              <p>· 一个开关</p>
            </div>
          </div>
          <p class="font-p-normal">更硬核的是这些都被封装在一个透明的保护壳里，你可以清楚地看到每一个电子元件。</p>
          <img class="pro-img-4" src="/storage/page/digikey-funpack/image/10/project.png"/>
          <p class="font-p-normal">ARCADE上还包括2组扩展端口。这些端口直接与微处理器引脚相连。启用这些端口需要对ARCADE的引导程序进行重新配置和编程。</p>
          <p class="font-p-normal">定制处理器的引导程序代码是相对更高级的操作，需要使用SWD调试端口进行下载。<br />ARCADE为板载处理器提供了一个稳定的电源，可以用3节5号电池或通过microUSB接口供电。</p>
          <h3>特性表</h3>
          <table>
            <tr>
              <td>处理器</td>
              <td>Atmel SAMD51J19A</td>
            </tr>
            <tr>
              <td>工作电压</td>
              <td>3节5号电池（3.6-4.5V）或USB（通常为5V）</td>
            </tr>
            <tr>
              <td>LCD屏幕分辨率</td>
              <td>160 x 128</td>
            </tr>
            <tr>
              <td>LCD屏幕尺寸</td>
              <td>1.77英寸（对角线）</td>
            </tr>
            <tr>
              <td>电流消耗</td>
              <td>约80mA</td>
            </tr>
            <tr>
              <td>工作时长</td>
              <td>（3节5号电池 1500mAh电池）约20小时</td>
            </tr>
            <tr>
              <td>下载调试</td>
              <td>USB下载或SWD下载</td>
            </tr>
            <tr>
              <td>扩展IO</td>
              <td>8个IO和8个GND</td>
            </tr>
          </table>
        </div>
      </div>

      <div class="bg-white">
        <div id="stepDiv" class="stepDiv">
          <h2 class="phone-hidden">Digikey Funpack 流程介绍</h2>
          <img src="/storage/page/digikey-funpack/image/step.png" class="phone-hidden">
          <img src="/storage/page/digikey-funpack/image/phone/step.png" class="phone-show">
          <div class="bottom-text-desc phone-hidden">
            <p class="text-center">每期活动用户只有从硬禾指定链接购买才有效（即从"得捷购"进入购买页面）</p>
            <p class="text-center">用户邮件提交的视频、代码、文档将会用于在硬禾或得捷电子运营的网站、公众号、视频号上展示，且同意接收由Digi-Key得捷电子发出的电子通讯。</p>
            <p class="text-center">活动最终解释权归硬禾所有。</p>
          </div>
        </div>
        <div class="line-phone" class="phone-show"></div>
      </div>
      @include('page.digikey-funpack-history', ['index' => 10])

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
      <div class="bg-white">
        <div class="footer-logo">
          <h2>合作伙伴</h2>
          <img src="/storage/page/digikey-funpack/image/10/logo-bottom-01.png">
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    $('.js-imgadbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/474407919;280387567;a?https://www.digikey.cn/product-detail/zh/kitronik-ltd/5311/1927-5311-ND/10673115');
    })
    $('#adbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/474407919;280387567;a?https://www.digikey.cn/product-detail/zh/kitronik-ltd/5311/1927-5311-ND/10673115');
    })
    $('#addigikey').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/472049650;277661009;k?http://www.digikey.cn');
    })

  });
</script>
@endsection
