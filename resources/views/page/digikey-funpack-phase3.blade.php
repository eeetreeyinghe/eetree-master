@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper phase3">
    <div class="topBanner">
      <!-- class="phone-hidden" -->
      <img alt="DK得捷购三期" title="DK得捷购三期" src="/storage/page/digikey-funpack/image/3/banner.png">
      <!-- <img class="phone-show" lt="DK得捷购三期" title="DK得捷购三期" src="/storage/page/digikey-funpack/image/3/phone/banner2x.png"> -->
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
        <a title="怎么玩" alt="怎么玩" target="_blank" href="/page/digikey-funpack/rule3" class="route-item route-item-2">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/wandou.png"/>
          </div>
          <div class="route-item-right">
            <h4>怎么玩</h4>
          </div>
        </a>

        <a title="教你做" alt="教你做" target="_blank" href="https://class.eetree.cn/detail/l_5fa10beae4b01f764d886b50/4?fromH5=true" class="route-item route-item-4">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/vide.png"/>
          </div>
          <div class="route-item-right">
            <h4>教你做</h4>
          </div>
        </a>
        <a title="展示秀" alt="展示秀" target="_blank" href="https://www.bilibili.com/video/BV1ft4y1k7Rk" class="route-item route-item-3">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/tv.png"/>
          </div>
          <div class="route-item-right">
            <h4>展示秀</h4>
          </div>
        </a>
      </div>
      <div class="bg-white">
        <img src="/storage/page/digikey-funpack/image/3/desc.png" class="js-imgadbuy" style="cursor:pointer;" />
        <!-- <img src="/storage/page/digikey-funpack/image/3/phone/desc2x.png" class="js-imgadbuy phone-show"/> -->
      </div>
      <!-- step进度条 -->
      <div class="bg-white">
        <h2>Renesas EK-RA2A1评估板 规格参数</h2>
        <div class="content-text content-text-new">
          <p class="font-p-normal">RA2A1系列单片机内部采用了ARM Cortex-M23内核，具备良好的混合信号处理能力，单片机内部集成了24比特超高精度，和高速ADC、DAC。具备很宽的工作电压范围，非常适合工业传感的应用环境。</p>
          <img src="/storage/page/digikey-funpack/image/3/phone/pro-phone01.png" class="phone-show"/>
          <div class="flex flex-between flex-wrap set-main-content-3">
            <div class="rules-text-p content-text-p">
              <p class="font-b">开发板主要参数：</p>
              <p>· 开发板采用R7FA2A1AB3CFM 单片机，64脚 LQFP封装</p>
              <p>· 内核为 ARM Cortex-M23 内核，主频48MHz</p>
              <p>· 256kB Flash 和 32kB SRAM</p>
              <p>· 4X40针排针</p>
              <p>· 单片机电流测量点</p>
            </div>
            <div class="rules-text-p content-text-p rules-text-p-r">
              <p class="font-b">开发板生态系统：</p>
              <p>· 支持全速USB</p>
              <p>· 可USB 5V供电</p>
              <p>· 板载 Segger J-link</p>
              <p>· 支持 SWD 和 JTAG</p>
              <p>· 带有两个Digilent PMOD 接口 （SPI和UART接口）</p>
              <p>· 用户LED，按钮，电容按键和启动配置跳线</p>
            </div>
          </div>
          <div class="set-main-content-second">
            <p class="font-b">R7FA2A1AB3CFM 单片机规格参数：</p>
            <div class="flex flex-between flex-wrap set-main-content-3">
              <div class="rules-text-p content-text-p">
                <p>· 最大时钟 48 MHz，ARM CM23 32-bit</p>
                <p>· 工作电压1.6V-5.5V</p>
                <p>· 256kB Flash， 32kB RAM，8kB数据Flash</p>
                <p>· 实时时钟 RTC</p>
                <p>· 8路中断引脚</p>
                <p>· 6路 16-bit 定时器</p>
                <p>· 1 路32-bit 定时器</p>
                <p>· 2 路 看门狗</p>
                <p>· 2 路 非同步定时器</p>
              </div>
              <div class="rules-text-p content-text-p rules-text-p-r">
                <p>· 14路 PWM</p>
                <p>· 支持USB， 3路通用串行通信接口可实现UART，I2C，SPI</p>
                <p>· 独立2路 SPI，2路I2C 和CAN总线</p>
                <p>· 16-bit ADC 采样速率最大1.2Msps</p>
                <p>· 24-bit ADC 采样速率最大 15.6ksps</p>
                <p>· 12-bit/8-bit （8-bit两组） DAC</p>
                <p>· 高速比较器两组和低速比较器，运算放大器三组</p>
              </div>
            </div>
          </div>
          <img src="/storage/page/digikey-funpack/image/3/phone/pro-phone02.png" class="phone-show"/>
          <img src="/storage/page/digikey-funpack/image/3/project.png" style="margin-bottom: 24px;margin-top: 15px;" class="phone-hidden" />
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
      <div class="bg-white">
        <div class="stepDiv">
          <h2>往期精彩</h2>
          <div class="flex flex-between flex-wrap padding-20 last-phases">
            <a href="/page/digikey-funpack/phase1" target="_blank">
              <img src="/storage/page/digikey-funpack/image/phase1.png">
            </a>
            <a href="/page/digikey-funpack/phase2" target="_blank">
              <img src="/storage/page/digikey-funpack/image/phase2.png">
            </a>
          </div>
          <div class="line-phone" class="phone-show"></div>
        </div>
      </div>

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
          <img src="/storage/page/digikey-funpack/image/3/logo-bottom-01.svg" alt="renesas">
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    $('.js-imgadbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/474352912;280348947;r?https://www.digikey.cn/products/zh?WT.z_header=search_go&keywords=RTK7EKA2A1S00001BU');
    })
    $('#adbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/474352912;280348947;r?https://www.digikey.cn/products/zh?WT.z_header=search_go&keywords=RTK7EKA2A1S00001BU');
    })
    $('#addigikey').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/472049650;277661009;k?http://www.digikey.cn');
    })

  });
</script>
@endsection
