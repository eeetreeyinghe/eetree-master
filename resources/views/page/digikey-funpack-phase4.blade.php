@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper phase3">
    <div class="topBanner">
      <!-- class="phone-hidden" -->
      <img alt="DK得捷购四期" title="DK得捷购四期" src="/storage/page/digikey-funpack/image/4/banner.png">
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
        <a title="怎么玩" alt="怎么玩" target="_blank" href="/page/digikey-funpack/rule4" class="route-item route-item-2">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/wandou.png"/>
          </div>
          <div class="route-item-right">
            <h4>怎么玩</h4>
          </div>
        </a>

        <a title="教你做" alt="教你做" target="_blank" href="https://class.eetree.cn/detail/l_5fa4ac42e4b01f764d8907b4/4?fromH5=true" class="route-item route-item-4">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/vide.png"/>
          </div>
          <div class="route-item-right">
            <h4>教你做</h4>
          </div>
        </a>
        <a title="展示秀" alt="展示秀" target="_blank" href="https://www.bilibili.com/video/BV1f5411n7o2" class="route-item route-item-3">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/tv.png"/>
          </div>
          <div class="route-item-right">
            <h4>展示秀</h4>
          </div>
        </a>
      </div>
      <div class="bg-white">
        <img src="/storage/page/digikey-funpack/image/4/desc.png" class="js-imgadbuy" style="cursor:pointer;" />
        <!-- <img src="/storage/page/digikey-funpack/image/3/phone/desc2x.png" class="js-imgadbuy phone-show"/> -->
      </div>
      <!-- step进度条 -->
      <div class="bg-white">
        <h2>Thunderboard™ BG22 开发套件规格参数</h2>
        <div class="content-text content-text-new content-text4">
          <p class="font-p-normal">Silicon Labs的Thunderboard EFR32BG22是基于 EFR32™ Wireless Gecko片上系统的小型且经济高效、功能丰富的原型和开发平台。该开发板是开发节能型联网IoT设备的理想平台，适用于电池供电的蓝牙应用，并带有蓝牙demo，该demo可与连接云的智能手机应用程序一起使用，展示环境和运动传感器数据以及按钮和LED 控制的便利集合。</p>
          <p class="font-p-normal">使用USB Micro-B电缆和板载 J-Link调试器可以轻松完成BG22 Thunderboard的编程。USB虚拟COM端口提供了到目标应用程序的串行连接，数据包跟踪接口 (PTI) 提供了有关无线链路中发送和接收的数据包的宝贵调试信息。板上包含一个8Mbit串行闪存，可用于无线 (OTA) 固件升级，或用作通用非易失性存储器。Simplicity Studio支持BG22 Thunderboard，并提供了一个板级支持包 (BSP)，为应用开发人员提供了一个良好的起点。</p>
          <p class="font-b">开发套件特性：</p>
          <div class="flex flex-between flex-wrap set-main-content-3">
            <div class="rules-text-p content-text-p">
              <p>·  EFR32BG22 无线 Gecko SoC，具有76.8 MHz 的工作频率，512kB 闪存和32kB RAM</p>
              <p>·  用于无线传输的2.4 GHz 陶瓷片式天线</p>
              <p>·  板载外围设备的电源控制，可实现超低功耗运行</p>
              <p>·  用户LED 和按钮</p>
              <p>·  20引脚 2.54 mm 分支焊盘，用于 GPIO 访问和与外部硬件的连接</p>
            </div>
            <div class="rules-text-p content-text-p rules-text-p-r">
              <p>·  SEGGER J-Link 板载调试器，易于编程和调试</p>
              <p>·  虚拟 Com 端口</p>
              <p>·  数据包跟踪接口 (PTI)</p>
              <p>·  Mini Simplicity 连接器，用于访问能量分析和高级无线网络调试</p>
              <p>·  由USB或纽扣电池供电</p>
            </div>
          </div>
          <img class="pro-img-4" src="/storage/page/digikey-funpack/image/4/project.png"/>
          <h2>板上的 EFR32BG22 蓝牙低功耗 5.2 SoC 系列特性参数</h2>
          <p class="font-p-normal">
          是为了满足大量电池供电蓝牙产品的独特要求，可提供低功耗蓝牙、网状网络和误差一米以内的测向精度。BG22 具有超低的发射和接收功率（0 dBm 下 3.6 mA 发射，2.6 mA 接收）和高性能低功耗 M33 内核（工作时 27 µA/MHz，睡眠时 1.2 µA）– 业界领先的能效可以将纽扣电池寿命延长至五年以上。
          </p>
          <div class="flex flex-between flex-wrap">
            <div class="rules-text-p content-text-p">
              <p class="font-b">无线电：</p>
              <p>·  蓝牙 5.2</p>
              <p>·  +6 dBm 发射</p>
              <p>·  -106.7 dBm 接收 (125 Kbps)</p>
              <p>·  AoA 和 AoD</p>
            </div>
            <div class="rules-text-p content-text-p">
              <p class="font-b">超低功耗：</p>
              <p>·  3.5 mA TX（无线电）</p>
              <p>·  2.6 mA RX（无线电）</p>
              <p>·  具有 32 kB RAM 的 1.4 µA EM2</p>
              <p>·  EM4 模式使用 RTC 时耗电 0.5 µA</p>
            </div>
            <div class="rules-text-p content-text-p">
              <p class="font-b">世界一流的软件：</p>
              <p>·  蓝牙 5.2</p>
              <p>·  蓝牙网状网络 LPN</p>
              <p>·  测向</p>
              <p>·  Apple HomeKit</p>
            </div>
          </div>
          <div class="flex flex-between flex-wrap main-content-middle">
            <div class="rules-text-p content-text-p">
              <p class="font-b">带 TrustZone 的 Arm® Cortex®-M33：</p>
              <p>·  76.8 MHz</p>
              <p>·  FPU 和 DSP</p>
              <p>·  352/512 kB 闪存</p>
              <p>·  32 kB RAM</p>
            </div>
            <div class="rules-text-p content-text-p">
              <p class="font-b">适合用途的外围设备：</p>
              <p>·  2 个 USART、2 个 I²C、2 个 PDM 以及 GPIO</p>
              <p>·  12 位 ADC（16 通道）</p>
              <p>·  内置温度传感器，精度 +/-1.5°C</p>
              <p>·  32 kHz 500 ppm PLFRCO，无需晶体</p>
            </div>
            <div class="rules-text-p content-text-p">
              <p class="font-b">安全：</p>
              <p>·  AES128/256, SHA-1, SHA-2（256 位）</p>
              <p>· ECC（最高 256 位）、ECDSA 和 ECDH</p>
              <p>· 真随机数生成器 (TRNG)</p>
              <p>·  RTSL 安全启动</p>
              <p>·  锁定/解锁功能，可安全调试</p>
            </div>
          </div>
          <p class="font-b">应用：</p>
          <div class="flex flex-between flex-wrap">
            <div class="rules-text-p content-text-p">
              <p>·  资产标签和信标</p>
              <p>·  消费电子遥控器</p>
              <p>·  便携式医疗设备</p>
            </div>
            <div class="rules-text-p content-text-p">
              <p>·  蓝牙网状网络低功耗节点</p>
              <p>·  运动、健身和保健设备</p>
            </div>
            <div class="rules-text-p content-text-p">
              <p>·  互联家居</p>
              <p>·  楼宇自动化和安全</p>
            </div>
          </div>
          <div class="flex flex-between flex-wrap two-imgs">
            <img src="/storage/page/digikey-funpack/image/4/project-2-l.png" class="project-2-l"/>
            <img src="/storage/page/digikey-funpack/image/4/project-2-r.png" class="project-2-r"/>
          </div>
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
      @include('page.digikey-funpack-history', ['index' => 4])

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
          <img src="/storage/page/digikey-funpack/image/4/logo-bottom-01.png">
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    $('.js-imgadbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/480446907;286676121;q?https://www.digikey.cn/products/zh?WT.z_header=search_go&keywords=SLTB010A');
    })
    $('#adbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/480446907;286676121;q?https://www.digikey.cn/products/zh?WT.z_header=search_go&keywords=SLTB010A');
    })
    $('#addigikey').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/472049650;277661009;k?http://www.digikey.cn');
    })

  });
</script>

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
