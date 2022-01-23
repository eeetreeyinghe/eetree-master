@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper">
    <div class="topBanner">
      <img class="phone-hidden" lt="DK得捷购二期" title="DK得捷购二期" src="/storage/page/digikey-funpack/image/2/banner.png">
      <img class="phone-show" lt="DK得捷购二期" title="DK得捷购二期" src="/storage/page/digikey-funpack/image/2/phone/banner2x.png">
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
        <a title="怎么玩" alt="怎么玩" target="_blank" href="/page/digikey-funpack/rule2" class="route-item route-item-2">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/wandou.png"/>
          </div>
          <div class="route-item-right">
            <h4>怎么玩</h4>
          </div>
        </a>

        <a title="教你做" alt="教你做" target="_blank" href="https://class.eetree.cn/detail/l_5f695aaee4b0d59c87b76767/4" class="route-item route-item-4">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/vide.png"/>
          </div>
          <div class="route-item-right">
            <h4>教你做</h4>
          </div>
        </a>
        <a title="展示秀" alt="展示秀" target="_blank" href="https://www.bilibili.com/video/BV1Ci4y1L7xD" class="route-item route-item-3">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/tv.png"/>
          </div>
          <div class="route-item-right">
            <h4>展示秀</h4>
          </div>
        </a>
      </div>
      <div class="bg-white">
        <img src="/storage/page/digikey-funpack/image/2/desc2x.png" class="js-imgadbuy phone-hidden" style="cursor:pointer;" />
        <img src="/storage/page/digikey-funpack/image/2/phone/desc2x.png" class="js-imgadbuy phone-show"/>
      </div>
      <!-- step进度条 -->
      <div class="bg-white">
        <h2>SparkFun RED-V RedBoard 规格参数</h2>
        <div class="content-text content-text-new">
          <p class="font-p-normal">RED-V RedBoard采用了大家熟悉的Arduino UNO R3规格，板上包括SiFive Freedom E310内核、32MB QSPI闪存、NXP K22 ARM Cortex-M4控制器用于USB链接和JTAG接口，以及Qwiic连接器（I2C接口）。</p>
          <img src="/storage/page/digikey-funpack/image/2/phone/pro-phone01.png" class="phone-show"/>
          <p class="font-b">规格参数：</p>
          <div class="flex flex-between flex-wrap">
            <div class="rules-text-p content-text-p">
              <p>· 兼容Arduino UNO R3布局</p>
              <p>· 核心控制器: SiFive Freedom E310 SoC(FE310-G002)</p>
              <div class="content-text-child">
                <p>
                  · CPU: SiFive E31 CPU<br>
                  · 架构: 32-bit RV32IMAC<br>
                  · 速度: 256 MHz (默认), 320MHz (最大)<br>
                  · 性能: 1.61 DMIPs/MHz<br>
                  · 存储: 16 KB指令缓存, 16 KB 数据缓存<br>
                  · 其它: 硬件乘法/除法器, Debug模块, 片上振荡器和锁相环
                </p>
              </div>
              <p>· 工作电压: 3.3 V和1.8 V</p>
            </div>
            <div class="rules-text-p content-text-p">
              <p>· 输入电压: 5 V USB7-15 VDC插座</p>
              <p>· IO电压: 同时支持3.3 V或5 V</p>
              <p>· 数字I/O引脚数: 19</p>
              <p>· PWM引脚数: 9</p>
              <p>· SPI接口支持3路片选</p>
              <p>· 外部中断引脚数: 19</p>
              <p>· 外部唤醒引脚数: 1 (可通过按键)</p>
              <p>· 主控接口(USB-Type C): 编程，调试，串行通信</p>
              <p>· Qwiic连接器</p>
            </div>
          </div>
          <img src="/storage/page/digikey-funpack/image/2/phone/pro-phone02.png" class="phone-show"/>
          <img src="/storage/page/digikey-funpack/image/2/phone/pro-phone03.png" class="phone-show"/>
          <img src="/storage/page/digikey-funpack/image/2/project.png" style="margin-bottom: 24px;margin-top: 15px;" class="phone-hidden" />
        </div>
      </div>

      <div class="bg-white">
        <div id="stepDiv" class="stepDiv">
          <h2 class="phone-hidden">Digikey Funpack 流程介绍</h2>
          <img src="/storage/page/digikey-funpack/image/2/step2x.png" class="phone-hidden">
          <img src="/storage/page/digikey-funpack/image/phone/phone-banner-step.png" class="phone-show">
          <div class="bottom-text-desc phone-hidden">
            <p class="text-center">每期活动用户只有从硬禾指定链接购买才有效（即从"得捷购"进入购买页面）</p>
            <p class="text-center">用户邮件提交的视频、代码、文档将会用于在硬禾或得捷电子运营的网站、公众号、视频号上展示，最终解释权归硬禾所有。</p>
          </div>
        </div>
        <div class="line-phone" class="phone-show"></div>
      </div>
      <div class="bg-white" style="margin-top:20px;">
        <a href="/page/digikey-funpack/phase1" target="_blank">
          <img src="/storage/page/digikey-funpack/image/2/desc-bottom2x.png" class="phone-hidden">
          <img src="/storage/page/digikey-funpack/image/2/phone/desc-bottom2x.png" class="phone-show">
        </a>
        <div class="line-phone" class="phone-show"></div>
      </div>

      <div class="bg-white" style="margin-top:20px;">
        <img src="/storage/page/digikey-funpack/image/1200x145_engineer-support_CN.JPG" id="addigikey" style="cursor:pointer;">
        <div class="line-phone" class="phone-show"></div>
      </div>

      <!-- footer -->
      <div class="page-footer">
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
      window.open('https://ad.doubleclick.net/ddm/clk/474406815;280348893;t?https://www.digikey.cn/product-detail/zh/sparkfun-electronics/DEV-15594/1568-DEV-15594-ND/10715590');
    })
    $('#adbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/474406815;280348893;t?https://www.digikey.cn/product-detail/zh/sparkfun-electronics/DEV-15594/1568-DEV-15594-ND/10715590');
    })
    $('#addigikey').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/472049650;277661009;k?http://www.digikey.cn');
    })

  });
</script>
@endsection
