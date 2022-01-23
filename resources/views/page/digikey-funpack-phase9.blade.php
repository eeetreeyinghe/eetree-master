@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper phase3">
    <div class="topBanner">
      <!-- class="phone-hidden" -->
      <img alt="DK得捷购九期" title="DK得捷购九期" src="/storage/page/digikey-funpack/image/9/banner.png">
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
        <a title="怎么玩" alt="怎么玩" target="_blank" href="/page/digikey-funpack/rule9" class="route-item route-item-2">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/wandou.png"/>
          </div>
          <div class="route-item-right">
            <h4>怎么玩</h4>
          </div>
        </a>

        <a title="教你做" alt="教你做" target="_blank" href="https://class.eetree.cn/detail/l_607d1544e4b09134c98982c8/4?fromH5=true" class="route-item route-item-4">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/vide.png"/>
          </div>
          <div class="route-item-right">
            <h4>教你做</h4>
          </div>
        </a>
        <a title="展示秀" alt="展示秀" target="_blank" href="https://www.eetree.cn/project/detail/312" class="route-item route-item-3">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/tv.png"/>
          </div>
          <div class="route-item-right">
            <h4>展示秀</h4>
          </div>
        </a>
      </div>
      <div class="bg-white">
        <img src="/storage/page/digikey-funpack/image/9/desc.png" class="js-imgadbuy" style="cursor:pointer;" />
      </div>
      <!-- step进度条 -->
      <div class="bg-white">
        <h2>SensorTile.box功能简介</h2>
        <div class="content-text content-text-new">
          <p class="font-p-normal">SensorTile.box板带有长寿命可充电电池，安装在IP54的塑料盒中，并且可以使用智能手机上的ST BLE传感器应用程序通过蓝牙进行连接，使您可以立即开始使用各种默认的IoT和可穿戴式传感器应用程序。</p>
          <p class="font-p-normal">在专家模式下，您可以选择板上的传感器，设置参数，数据和输出类型以及可用的特殊算法来定制应用程序。无需执行任何编程即可快速轻松地设计无线物联网和可穿戴传感器应用。</p>
          <img class="pro-img-4" src="/storage/page/digikey-funpack/image/9/project.png"/>
          <p class="font-p-normal">SensorTile.box包含一个固件编程和调试接口，允许专业开发人员使用STM32开放式开发环境（STM32 ODE）进行更复杂的固件代码开发，该环境包括带有神经网络库的感应AI功能包。</p>
          <div class="flex flex-between flex-wrap set-main-content-3">
            <div class="rules-text-p content-text-p">
              <p class="font-b">主要特性：</p>
              <p>· 紧凑型开发板上具有以下的高精度传感器：</p>
              <div class="content-text-child">
                <p>· 数字温度传感器（STTS751）</p>
                <p>· 六轴惯性测量单元（LSM6DSOX）</p>
                <p>· 三轴加速度计（LIS2DW12和LIS3DHH）</p>
                <p>· 三轴磁力计（LIS2MDL）</p>
                <p>· 高度计/压力传感器（LPS22HH）</p>
                <p>· 麦克风/音频传感器（MP23ABS1）</p>
                <p>· 湿度传感器（HTS221）</p>
              </div>
            </div>
            <div class="rules-text-p content-text-p rules-text-p-r">
              <p class="phone-hidden">&nbsp;</p>
              <p>· 易于使用的应用程序</p>
              <p>· 应用程序的专家模式可以对传感器参数进行设置</p>
              <p>· 具有DSP和FPU的超低功耗ARM Cortex-M4微控制器（STM32L4R9）</p>
              <p>· 蓝牙应用处理器v5.2（BlueNRG-M2）模块</p>
              <p>· 用于专业固件开发的编程和调试接口</p>
            </div>
          </div>
          <div class="flex flex-between flex-wrap set-main-content-3">
            <div class="rules-text-p content-text-p">
              <p class="font-b">应用方面：</p>
              <p>· 具有以下运动和环境传感器应用程序的即时功能：</p>
              <div class="content-text-child">
                <p>· 针对固定在皮带处进行了优化的计步器</p>
                <p>· 通过Cloud AI学习进行婴儿啼哭检测</p>
                <p>· 气压计/环境监测</p>
                <p>· 车辆/货物跟踪</p>
                <p>· 振动监测</p>
                <p>· 指南针和倾角计</p>
                <p>· 传感器数据记录仪</p>
              </div>
            </div>
            <img src="/storage/page/digikey-funpack/image/9/project-r.png?1" class="image-pr"/>
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
            <p class="text-center">用户邮件提交的视频、代码、文档将会用于在硬禾或得捷电子运营的网站、公众号、视频号上展示，且同意接收由Digi-Key得捷电子发出的电子通讯。</p>
            <p class="text-center">活动最终解释权归硬禾所有。</p>
          </div>
        </div>
        <div class="line-phone" class="phone-show"></div>
      </div>
      @include('page.digikey-funpack-history', ['index' => 9])

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
          <img src="/storage/page/digikey-funpack/image/9/logo-bottom-01.png">
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
  $(document).ready(function(){
    $('.js-imgadbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/492593938;299643919;n?https://www.digikey.cn/zh/products/detail/stmicroelectronics/STEVAL-MKSBOX1V1/10222211');
    })
    $('#adbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/492593938;299643919;n?https://www.digikey.cn/zh/products/detail/stmicroelectronics/STEVAL-MKSBOX1V1/10222211');
    })
    $('#addigikey').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/472049650;277661009;k?http://www.digikey.cn');
    })

  });
</script>
@endsection
