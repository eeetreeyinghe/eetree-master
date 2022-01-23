@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper phase3">
    <div class="topBanner">
      <!-- class="phone-hidden" -->
      <img alt="DK得捷购六期" title="DK得捷购六期" src="/storage/page/digikey-funpack/image/6/banner.png">
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
        <a title="怎么玩" alt="怎么玩" target="_blank" href="/page/digikey-funpack/rule6" class="route-item route-item-2">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/wandou.png"/>
          </div>
          <div class="route-item-right">
            <h4>怎么玩</h4>
          </div>
        </a>

        <a title="教你做" alt="教你做" target="_blank" href="https://class.eetree.cn/detail/l_600e72c8e4b0f176aeca51f1/4?fromH5=true" class="route-item route-item-4">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/vide.png"/>
          </div>
          <div class="route-item-right">
            <h4>教你做</h4>
          </div>
        </a>
        <a title="展示秀" alt="展示秀" target="_blank" href="https://www.eetree.cn/project/detail/76" class="route-item route-item-3">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/tv.png"/>
          </div>
          <div class="route-item-right">
            <h4>展示秀</h4>
          </div>
        </a>
      </div>
      <div class="bg-white">
        <img src="/storage/page/digikey-funpack/image/6/desc.png" class="js-imgadbuy" style="cursor:pointer;" />
      </div>
      <!-- step进度条 -->
      <div class="bg-white">
        <h2>MAX32660-EVSYS</h2>
        <div class="content-text content-text-new content-text-6">
          <p class="font-p-normal">MAX32660评估系统提供结构紧凑的开发平台，在微小、易于使用的电路板实现对MAX32660全部特性的访问。主板上已安装基于MAX32625PICO的调试适配器；完成编程后，可将其直接拆卸。调试模块支持可选的10引脚Arm® Cortex®调试连接器，用于实现DAPLink功能。组合尺寸为0.65in x 2.2in，而主板独立尺寸为0.65in x 0.95in。外部连接采用双排连接头，兼容过孔和SMT应用。该电路板以非常小的空间提供强大的处理子系统，很容易集成到各种应用中。</p>
          <img class="pro-img-4" src="/storage/page/digikey-funpack/image/6/project.png"/>
          <p class="font-b size16">MAX32660-EVSYS参数：</p>
          <div class="flex flex-between flex-wrap margin-b-20">
            <div class="content-text-p">
              <p class="font-b">MAX32660微控制器</p>
              <p>· Arm Cortex-M4F内核, 工作频率96MHz</p>
              <p>· 256KB Flash Memory</p>
              <p>· 96KB SRAM</p>
              <p>· 16KB 指令缓存</p>
            </div>
            <div class="content-text-p">
              <p class="font-b">MAX32660最小系统部分</p>
              <p>· DIP双排通孔设计，孔间距2.54mm</p>
              <p>· 可支持面包板</p>
              <p>· 一个用户LED</p>
              <p>· 一个用户按键</p>
            </div>
            <div class="content-text-p">
              <p class="font-b">基于MAX32625PICO调试功能部分</p>
              <p>· 支持CMSIS DAP SWD调试器</p>
              <p> · 一路虚拟串口</p>
            </div>
          </div>
          <p class="font-b size16">MAX32660，超低功耗、高成效、高度集成微控制器</p>
          <p class="font-p-normal">
            评估板最核心的是MAX32660微控制器，属于美信DARWIN产品系列，是一款超低功耗、性价比突出、集成度非常高的32位控制器。芯片封装非常小，4mm x 4mm 的TQFN已经是这个系列里最大封装，非常适合电池供电或是无线传感器的应用。<br>
          MAX32660采用了带浮点运算功能的Cortex-M4内核，最大主频96MHz， 带256KB Flash和96KB SRAM，性能很强劲</p>
          <div class="part-two-left">
            <p class="font-b">应用/用途：</p>
            <div class="flex flex-wrap">
              <div class="content-text-p">
                <p>· 健身监测器</p>
                <p>· 工业传感器</p>
                <p>· IoT</p>
                <p>· 光纤模块：QSFP-DD, QSFP, 400G</p>
              </div>
              <div class="content-text-p">
                <p>· 便携式医疗设备</p>
                <p>· 运动手表</p>
                <p>· 可穿戴医疗设备</p>
              </div>
            </div>
          </div>
          <div class="flex flex-between flex-wrap">
            <div class="rules-text-p content-text-p">
              <p class="font-b">适合可穿戴设备高效微控制器</p>
              <p>· 内部时钟最大96MH</p>
              <p>· 256KB Flash Memory</p>
              <p>· 96KB SRAM, Optionally Preserved in Lowest</p>
              <p>· 待机备份模式</p>
              <p>· 16KB指令缓存</p>
              <p>· 存储保护单元 (MPU)</p>
              <p>· 内核电压1.1V VCORE</p>
              <p>· 3.6V GPIO 电压范围</p>
              <p>· 内部LDO支持单电源供电</p>
            </div>
            <div class="rules-text-p content-text-p">
              <p class="font-b">优化的外围设备组合提供平台灵活组合</p>
              <p>· 最大14 路GPIO</p>
              <p>· 最大两路SPI</p>
              <p>· 一路I2S</p>
              <p>· 最大两路 UART</p>
              <p>· 最大两路 I2C</p>
              <p>· 四通道标准DMA控制器</p>
              <p>· 3路32位计时器</p>
              <p>· 看门狗计时器</p>
              <p>· RTC 32.768kHz</p>
            </div>
            <div class="rules-text-p content-text-p">
              <p class="font-b">电源管理最大化电池供电应用时间</p>
              <p>· 85μA/MHz 从Flash主动执行</p>
              <p>· 2μA 全内存保留待机备份模式下耗电 VDD = 1.8V</p>
              <p>· 450nA 超低功耗 RTC VDD = 1.8V</p>
              <p>· 内部80kHz环形振荡器</p>
            </div>
          </div>
          <img class="pro-img-4" src="/storage/page/digikey-funpack/image/6/project-r.png"/>
        </div>
      </div>

      <div class="bg-white">
        <div id="stepDiv" class="stepDiv">
          <h2 class="phone-hidden">Digikey Funpack 流程介绍</h2>
          <img src="/storage/page/digikey-funpack/image/2/step2x.png?1" class="phone-hidden">
          <img src="/storage/page/digikey-funpack/image/phone/phone-banner-step.png" class="phone-show">
          <div class="bottom-text-desc phone-hidden">
            <p class="text-center">每期活动用户只有从硬禾指定链接购买才有效（即从"得捷购"进入购买页面）</p>
            <p class="text-center">用户邮件提交的视频、代码、文档将会用于在硬禾或得捷电子运营的网站、公众号、视频号上展示，最终解释权归硬禾所有。</p>
          </div>
        </div>
        <div class="line-phone" class="phone-show"></div>
      </div>
      @include('page.digikey-funpack-history', ['index' => 6])

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
          <img src="/storage/page/digikey-funpack/image/6/logo-bottom-01.png">
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    $('.js-imgadbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/487054572;293739639;c?https://www.digikey.cn/products/zh?keywords=MAX32660-EVSYS');
    })
    $('#adbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/487054572;293739639;c?https://www.digikey.cn/products/zh?keywords=MAX32660-EVSYS');
    })
    $('#addigikey').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/472049650;277661009;k?http://www.digikey.cn');
    })

  });
</script>
@endsection
