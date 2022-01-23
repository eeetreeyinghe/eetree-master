@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper phase3">
    <div class="topBanner">
      <!-- class="phone-hidden" -->
      <img alt="DK得捷购五期" title="DK得捷购五期" src="/storage/page/digikey-funpack/image/5/banner.png">
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
        <a title="怎么玩" alt="怎么玩" target="_blank" href="/page/digikey-funpack/rule5" class="route-item route-item-2">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/wandou.png"/>
          </div>
          <div class="route-item-right">
            <h4>怎么玩</h4>
          </div>
        </a>

        <a title="教你做" alt="教你做" target="_blank" href="https://class.eetree.cn/detail/l_5fe9a83ee4b0231ba88f7218/4?fromH5=true" class="route-item route-item-4">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/vide.png"/>
          </div>
          <div class="route-item-right">
            <h4>教你做</h4>
          </div>
        </a>
        <a title="展示秀" alt="展示秀" target="_blank" href="https://www.eetree.cn/project/detail/50" class="route-item route-item-3">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/tv.png"/>
          </div>
          <div class="route-item-right">
            <h4>展示秀</h4>
          </div>
        </a>
      </div>
      <div class="bg-white">
        <img src="/storage/page/digikey-funpack/image/5/desc.png" class="js-imgadbuy" style="cursor:pointer;" />
      </div>
      <!-- step进度条 -->
      <div class="bg-white">
        <h2>ADALM-PLUTO</h2>
        <div class="content-text content-text-new">
          <p class="font-p-normal">PlutoSDR 与主机配合使用时，充当便携式实验室，可增强课堂学习。MATLAB®和Simulink®是由PlutoSDR支持的两个主要软件包，它提供直观的图形用户界面 (GUI)，让学生可以更快学会，更巧妙地开展工作并探索更多知识。 </p>
          <p class="font-p-normal">PlutoSDR 具有独立的接收和发射通道，可在全双工模式下工作。主动学习模块可以在 325 MHz 至 3800 MHz 频率范围内以最高每秒 61.44MSPS 产生或捕获 RF 模拟信号。PlutoSDR 非常小，可装在衬衣口袋中，完全独立自足且由配有默认固件的 USB 供电。由于 PlutoSDR 通过 libiio 驱动程序启动，因此它支持 OS X®、Windows® 和 Linux®，可让学生在多台设备上学习和探索。</p>
          <div class="flex flex-between flex-wrap set-main-content-3">
            <div class="rules-text-p content-text-p">
              <p class="font-b">套件包括：</p>
              <p>· ADI PlutoSDR 主动学习模块</p>
              <p>· 两根天线（824 MHz 至 ~894MHz/1710 MHz 至 ~2170 MHz）</p>
              <p>· 一根 15 cm SMA 电缆</p>
              <p>· 一根 USB 电缆</p>
            </div>
            <div class="rules-text-p content-text-p rules-text-p-r">
              <p class="font-b">PlutoSDR 主机接口：</p>
              <p>· 大容量存储（用于轻松更新固件）</p>
              <p>· 串行（用于与 PlutoSDR 上的 Linux 内核 / 用户空间交互）</p>
              <p>· 联网 /RNDIS（用于加载和控制自定义 ARM® 应用）</p>
              <p>· Libiio（大容量 USB，用于 SDR 数据传输和控制）</p>
              <p>· 设备固件升级（用于备份固件升级）</p>
            </div>
          </div>
          <img class="pro-img-4" src="/storage/page/digikey-funpack/image/5/project.png"/>
          <h2>ADI PlutoSDR 主动学习模块特性参数</h2>
          <div class="flex flex-between set-main-content-3">
            <div class="rules-text-p content-text-p content-text-p-5">
              <p>· 独立自足的便携式 RF学习模块</p>
              <p>· 高性价比实验平台</p>
              <p>· RF频率范围：325 MHz至3.8GHz</p>
              <p>· 灵活速率、12位 ADC和 DAC</p>
              <p>· 一个发射器和一个接收器（SMA插口，50Ω）</p>
              <p>· 半双工或全双工</p>
              <p>· 支持MATLAB、Simulink</p>
              <p>· GNU无线电吸电流和源电流模块</p>
              <p>· Libiio、C、C++、C# 和Python API</p>
              <p>· USB 2.0接口</p>
              <p>· 高质量塑料外壳</p>
              <p>· USB 供电</p>
              <p>· 瞬时带宽最高达 20MHz（复数 I/Q）</p>
              <p class="font-b">开源：</p>
              <p>PlutoSDR 开源固件由 Das U-Boot、Linux 内核和 Buildroot 构成。作为课程教材的一部分，可以通过 Vivado® HL WebPACKTM 版本（免许可）来运行、复制、分发、研究、更改和改进此固件。PlutoSDR 支持USB 2.0 OTG，可以连接至各种 USB 外设（有线网络、Wi-Fi 加密狗、音频等）以扩展功能。所有文档都可在<a href="//wiki.analog.com/plutosdr" target="_blank">wiki.analog.com/plutosdr</a>公开访问。</p>
            </div>
            <div class="content-text-p rules-text-p-r-5">
              <img src="/storage/page/digikey-funpack/image/5/project-r.png"/>
            </div>
          </div>
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
      @include('page.digikey-funpack-history', ['index' => 5])

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
          <img src="/storage/page/digikey-funpack/image/5/logo-bottom-01.png">
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    $('.js-imgadbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/480334909;286681506;r?https://www.digikey.cn/products/zh?WT.z_header=search_go&keywords=ADALM-PLUTO');
    })
    $('#adbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/480334909;286681506;r?https://www.digikey.cn/products/zh?WT.z_header=search_go&keywords=ADALM-PLUTO');
    })
    $('#addigikey').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/472049650;277661009;k?http://www.digikey.cn');
    })

  });
</script>
@endsection
