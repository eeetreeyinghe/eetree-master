@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper phase3">
    <div class="topBanner">
      <!-- class="phone-hidden" -->
      <img alt="DK得捷购十二期" title="DK得捷购十二期" src="/storage/page/digikey-funpack/image/12/banner.png">
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
        <a title="怎么玩" alt="怎么玩" target="_blank" href="/page/digikey-funpack/rule12" class="route-item route-item-2">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/wandou.png"/>
          </div>
          <div class="route-item-right">
            <h4>怎么玩</h4>
          </div>
        </a>

        <a title="教你做" alt="教你做" target="_blank" href="https://class.eetree.cn/detail/l_616d0fd7e4b05adf2076158b/4?fromH5=true" class="route-item route-item-4">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/vide.png"/>
          </div>
          <div class="route-item-right">
            <h4>教你做</h4>
          </div>
        </a>
        <a title="展示秀" alt="展示秀" target="_blank" href="https://www.eetree.cn/project/detail/601" class="route-item route-item-3">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/tv.png"/>
          </div>
          <div class="route-item-right">
            <h4>展示秀</h4>
          </div>
        </a>
      </div>
      <div class="bg-white">
        <img src="/storage/page/digikey-funpack/image/12/desc.png" class="js-imgadbuy" style="cursor:pointer;" />
      </div>
      <!-- step进度条 -->
      <div class="bg-white">
        <h2>Wio Terminal简介</h2>
        <div class="content-text content-text-new content-indent">
          <p class="font-p-normal">Wio Terminal的运行速度为 120MHz (最高可达200MHz), 4MB 外部闪存和 192KB RAM。</p>
          <p class="font-p-normal">Wio Terminal自身配有一个2.4英寸 LCD屏幕, 板载IMU(LIS3DHTR)，麦克风，蜂鸣器，microSD卡槽，光传感器和940nm红外发射器。 除了这些它还有两个用于Grove生态系统的多功能Grove接口和兼容Raspberry pi的40个GPIO引脚，用于支持更多附加组件。</p>
          <img class="pro-img-4" src="/storage/page/digikey-funpack/image/12/project.png"/>
          <img class="pro-img-4" src="/storage/page/digikey-funpack/image/12/project-1.png"/>
          <img class="pro-img-4" src="/storage/page/digikey-funpack/image/12/project-2.png"/>
          <p class="font-b size16">特性：</p>
          <div class="flex flex-between flex-wrap margin-b-20">
            <div class="content-text-p content-text-p-12">
              <p class="font-b">· 高度集成的设计</p>
              <p>· MCU、LCD、Wi-Fi、蓝牙、IMU、麦克风、 蜂鸣器、microSD 卡、可配置的按钮、光传感 器、五向开关、红外发射器 (IR 940 nm) 和 CryptoAuthentication 就绪</p>
            </div>
            <div class="content-text-p content-text-p-12">
              <p class="font-b">· 由 Microchip ATSAMD51P19 驱动</p>
              <p>· Arm® Cortex®-M4F 内核以 120 MHz 的频率运行（可倍频至 200 MHz）</p>
              <p>· 4 MB 外部闪存，192 KB RAM</p>
              <p>· 全面的协议支持</p>
              <p>· SPI、I2C、I2S、ADC、DAC、PWM 和 UART（串行）</p>
            </div>
            <div class="content-text-p content-text-p-12">
              <p class="font-b">· 强大的无线连接</p>
              <p>· 由 Realtek RTL8720DN 提供技术支持</p>
              <p>· 双频 2.4 GHz/5 GHz Wi-Fi (802.11 a/b/g/n)</p>
              <p>· BL/BLE 5.0</p>
            </div>
          </div>
          <div class="flex flex-between flex-wrap margin-b-20">
            <div class="content-text-p content-text-p-12">
              <p class="font-b">· Grove 生态系统</p>
              <p>· 用于探索物联网的 300 多个 Grove 模块</p>
              <p>· 两个板载多功能 Grove 端口可用于数字、模拟、 I2C 和 PWM</p>
              <p>· 简洁易懂的100%开源硬件设计</p>
              <p>· 使用 LCD 屏幕和紧凑型外壳，无需费力从零搭建</p>
              <p>· 用易于使用的图形元素和漂亮的可视化编辑工具创 建嵌入式GUI</p>
            </div>
            <div class="content-text-p content-text-p-12">
              <p class="font-b">· USB OTG 支持</p>
              <p>· USB 主机</p>
              <p>· 辅助设备：鼠标、键盘、MIDI 设备、Xbox/PS 游戏控制 器和3D 打印机</p>
              <p>· USB 客户端</p>
              <p>· 模拟设备：鼠标、键盘和 MIDI 设备）</p>
            </div>
            <div class="content-text-p content-text-p-12">
              <p class="font-b">· 兼容40针Raspberry</p>
              <p>· 可以作为从设备安装到 Raspberry Pi</p>
              <p>· Raspberry Pi 的 HAT 可以与适配器电缆一起使用</p>
              <p class="font-b">· 软件支持</p>
              <p class="content-text-sp">· Arduino</p>
              <p class="content-text-sp">· ArduPy</p>
              <p class="content-text-sp">· MicroPython</p>
              <p class="content-text-sp">· AT 固件</p>
            </div>
          </div>
          <p class="font-b size16">应用：</p>
          <div class="content-text-col4">
            <div class="content-text-p">
              <p>· Python 终端设备</p>
              <p>· 手持设备</p>
              <p>· 物联网控制器</p>
              <p>· 原型开发</p>
              <p>· 用于机器学习的数据收集设备</p>
              <p>· 复古游戏设备</p>
              <p>· 教育</p>
              <p>· Raspberry Pi 的从设备和附件</p>
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
      @include('page.digikey-funpack-history', ['index' => 12])

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
      window.open('https://www.digikey.cn/zh/ordering/cart?action=addItems&items[0][partNumber]=102991299&items[0][quantity]=1&items[0][customerReference]=Funpack推广&promoCode=Back2School-CN');
    })
    $('#adbuy').click(function() {
      window.open('https://www.digikey.cn/zh/ordering/cart?action=addItems&items[0][partNumber]=102991299&items[0][quantity]=1&items[0][customerReference]=Funpack推广&promoCode=Back2School-CN');
    })
    $('#addigikey').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/472049650;277661009;k?http://www.digikey.cn');
    })

  });
</script>
@endsection
