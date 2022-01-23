@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper phase3">
    <div class="topBanner">
      <!-- class="phone-hidden" -->
      <img alt="DK得捷购十一期" title="DK得捷购十一期" src="/storage/page/digikey-funpack/image/11/banner.png">
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
        <a title="怎么玩" alt="怎么玩" target="_blank" href="/page/digikey-funpack/rule11" class="route-item route-item-2">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/wandou.png"/>
          </div>
          <div class="route-item-right">
            <h4>怎么玩</h4>
          </div>
        </a>

        <a title="教你做" alt="教你做" target="_blank" href="https://class.eetree.cn/detail/l_61177593e4b0cce271bdf0e2/4?fromH5=true" class="route-item route-item-4">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/vide.png"/>
          </div>
          <div class="route-item-right">
            <h4>教你做</h4>
          </div>
        </a>
        <a title="展示秀" alt="展示秀" target="_blank" href="https://www.eetree.cn/project/detail/454" class="route-item route-item-3">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/tv.png"/>
          </div>
          <div class="route-item-right">
            <h4>展示秀</h4>
          </div>
        </a>
      </div>
      <div class="bg-white">
        <img src="/storage/page/digikey-funpack/image/11/desc.png" class="js-imgadbuy" style="cursor:pointer;" />
      </div>
      <!-- step进度条 -->
      <div class="bg-white">
        <h2>LPC55S69-EVK简介</h2>
        <div class="content-text content-text-new">
          <p class="font-p-normal">该电路板包括一个高性能板载调试器、音频子系统和加速度传感器，提供多个选项，可为网络、传感器、显示器和其他接口添加现成的附加板。</p>
          <h3>板卡技术和功能规格</h3>
          <img class="pro-img-4" src="/storage/page/digikey-funpack/image/11/project-t.png"/>
          <img class="pro-img-4" src="/storage/page/digikey-funpack/image/11/project-new.png" style="margin-top:20px;width:70%"/>
          <div class="flex flex-between set-main-content-3">
            <div class="rules-text-p content-text-p content-text-p-11">
              <p>LPC55S6x MCU家族是全球首款基于通用Cortex-M33的微控制器。</p>
              <p>该高效率MCU家族采用Armv8-M架构，性能和高级安全功能达到新水平，包括TrustZone-M和协处理器扩展。LPC55S6x家族利用协处理器扩展型号，大幅提高信号处理效率，采用专有DSP加速器，使计算的时钟周期减少了10倍。还可选择使用第二个Cortex-M33内核，支持灵活地平衡高性能与功率效率。</p>
              <p>此外，LPC55S6x MCU家族依托基于40nm NVM的处理技术，具备成本效益优势，提供广泛的可扩展封装和存储器选项，并提供强大的支持，包括MCUXpresso软件和工具生态系统及低成本开发板。</p>
            </div>
            <div class="content-text-p rules-text-p-r-11">
              <img src="/storage/page/digikey-funpack/image/11/project-b.png">
              <p style="text-align: center;">芯片功能图</p>
            </div>
          </div>
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
      @include('page.digikey-funpack-history', ['index' => 11])

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
      window.open('https://ad.doubleclick.net/ddm/clk/498090237;305336920;i?https://www.digikey.cn/zh/products/detail/nxp-usa-inc/LPC55S69-EVK/9865963');
    })
    $('#adbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/498090237;305336920;i?https://www.digikey.cn/zh/products/detail/nxp-usa-inc/LPC55S69-EVK/9865963');
    })
    $('#addigikey').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/472049650;277661009;k?http://www.digikey.cn');
    })

  });
</script>
@endsection
