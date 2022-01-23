@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper">
    <div class="topBanner">
      <img alt="硬禾学堂" title="硬禾学堂" src="/storage/page/digikey-funpack/image/banner.png">
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
        <a title="怎么玩" alt="怎么玩" target="_blank" href="/page/digikey-funpack/rule1" class="route-item route-item-2">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/wandou.png"/>
          </div>
          <div class="route-item-right">
            <h4>怎么玩</h4>
          </div>
        </a>

        <a title="教你做" alt="教你做" target="_blank" href="https://class.eetree.cn/detail/l_5f3c8cb6e4b011878731c9c7/4?fromH5=true" class="route-item route-item-4">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/vide.png"/>
          </div>
          <div class="route-item-right">
            <h4>教你做</h4>
          </div>
        </a>
        <a title="展示秀" alt="展示秀" target="_blank" href="https://www.bilibili.com/video/BV1gZ4y1V7r7" class="route-item route-item-3">
          <div class="route-item-left">
            <img src="/storage/page/digikey-funpack/image/tv.png"/>
          </div>
          <div class="route-item-right">
            <h4>展示秀</h4>
          </div>
        </a>
      </div>
      <!-- step进度条 -->
      <div class="bg-white">
        <div class="go-tobug phone-hidden">
          <h3>ODYSSEY – STM32MP157C</h3>
          <h4>
            是一款基于STM32MP1系列通用处理器的单板计算机，核心</br>
            STM32MP157C是工作在650MHz的双核Arm Cortex-A7核心处</br>
            理器。该处理器还与Arm Cortex-M4协处理器集成在一起，</br>
            使其适合于实时任务。Cortex-A7主要在操作系统</br>
            级别执行操作，Cortex-M4在MCU级别处理</br>
            操作。
          </h4>
          <img class="js-imgadbuy btn-bottom" src="/storage/page/digikey-funpack/image/btn-tobug.png"/>
        </div>
        <div class="phone-show go-tobug-phone">
          <img src="/storage/page/digikey-funpack/image/phone/tobug-bg-phone.png" class="js-imgadbuy">
          <div class="js-imgadbuy btn-bottom" >
            <img src="/storage/page/digikey-funpack/image/phone/btn-tobug.png"/>
          </div>
        </div>

        <div class="line-phone" class="phone-show"></div>

        <h2>ODYSSEY – STM32MP157C规格参数</h2>
        <div class="content-text content-text-new">
          <p class="font-p-normal">ODYSSEY – STM32MP157C以模块上系统（SoM）和载板的形式创建。SoM由MPU，PMIC，RAM组成，并且载板采用Raspberry Pi尺寸。载板上包括所有必需的外围设备，包括千兆以太网、WiFi / BLE、直流电源、USB主机、USB-C、MIPI-DSI、摄像机、音频的DVP等。使用该板，客户可以快速评估SoM，并轻松快捷地将SoM部署在自己的载板上。</p>
          <p class="font-b">规格参数：</p>
          <div class="flex flex-between flex-wrap">
            <div class="rules-text-p content-text-p">
              <p class="font-b">核心板SoM – STM32MP157C：</p>
              <p>MPU: STM32MP157C</p>
              <div class="content-text-child">
                <p>
                  · 32位双核 Arm Cortex-A7<br>
                  · 32位具有 FPU/MPU的单核Arm Cortex-M4
                </p>
              </div>
              <p>
                · PMU: ST PMIC STPMIC1A<br>
                · RAM: 512MB DDR3 RAM<br>
                · Flash: 4GB EMMC<br>
                · 外围接口: 3 路70针 板对板连接器<br>
                · 尺寸：38mm x38mm
              </p>
            </div>
            <div class="rules-text-p content-text-p">
              <p class="font-b">载板：</p>
              <p>· 外围接口：</p>
              <div class="content-text-child">
                <p>· 2 路 USB 主机端口<br>
                  · 1 路千兆以太网口<br>
                  · 1 路3.5mm 音频接口<br>
                  · 1 路 MIPI DSI 显示接口<br>
                  · 1 路 DVP 摄像头接口<br>
                  · 2 路Grove (GPIO & I2C)接口<br>
                  · 1 路 SD卡接口(背面)
                </p>
              </div>
            </div>
            <div class="rules-text-p content-text-p phone-margin-b-20">
              <p class="padding-t-24">· WiFi/蓝牙</p>
              <div class="content-text-child">
                <p>
                  · WiFi 802.11 b/g/n 2.4GHz<br>
                  · 蓝牙 4.1
                </p>
              </div>
              <p>· LED：</p>
              <div class="content-text-child">
                <p>
                  · 1 个复位LED<br>
                  · 3 个用户LED<br>
                  · 1 个电源LED
                </p>
              </div>
            </div>
            <div class="rules-text-p content-text-p  phone-margin-b-20">
              <p class="padding-t-24">· 电源：</p>
              <div class="content-text-child">
                <p>
                  · 1 个DC接口<br>· 1 个USB Type-C接口
                </p>
              </div>
              <p>· 按键开关：</p>
              <div class="content-text-child">
                <p>
                  · 1 个复位按键<br>
                  · 1 个用户按键<br>
                  · 1 个拨码开关
                </p>
              </div>
            </div>
          </div>

          <img src="/storage/page/digikey-funpack/image/pro-01.png" style="margin-bottom: 24px;margin-top: 15px;">
          <p class="font-b">详细信息：</p>
          <div class="flex flex-between flex-wrap">
            <div class="rules-text-p content-text-p">
              <p>
                1. 载板：安装核心板 SoM-STM32MP157C的区域。<br>
                2. 直流电源输入端口：12V〜24V / 2A（建议输入12V / 2A电源）。<br>
                3. ETH接口：网络电缆接口可以连接到千兆级网络。<br>
                4. USB端口：两个USB主机端口<br>
                5. USB设备：USB 2.0 TypeC。如果将Type C用作板卡电源输入，则应使用5V / 3A电源适配器。<br>
                6. 数字Grove接口：将Grove接口连接到数字引脚。<br>
                7. IIC Grove接口： 将Grove接口连接到IIC引脚。<br>
                8. 音频接口： 3.5mm音频接口。<br>
                9. MIPI DSI接口：使用MIPI DSI接口（FPC 20Pin 1.0mm）连接到显示器。<br>
                10. 40 PIN GPIO接口：与Raspberry Pi的40-PIN兼容。<br>
                11. AP6236: 2.4G WiFi＆BT 4.2控制芯片<br>
                12. 滑动开关： 可用于选择SD卡或eMMC来启动。<br>
                13. 调试UART： 系统默认的调试串行端口<br>
                14. JST 1.0mm: 3VRTC电池接口。
              </p>
            </div>
            <div class="rules-text-p content-text-p">
              <p style="line-height: 21px;">
                15. RST键：系统复位键<br>
                16. PWR按键：长按约8秒可关闭，短按可启动。<br>
                17. 用户按钮：用户按钮。<br>
                18. PWR LED: 开发板电源指示灯。<br>
                19. User LED: 用户可编程的LED。<br>
                20. ACA-5036-A2-CC-S: 板载2.4G陶瓷天线。<br>
                21. IPEX 1代：外部2.4 G外部天线座（使用外部天线时，需要卸下R49，R51两<br>
                    <span style="margin-left: 22px;">个0Ω电阻）</span><br>
                22. SD卡插槽：将装有系统的SD卡插入该区域<br>
                23. DVP摄像头接口：通过DVP接口（FPC 20Pin 1.0mm）连接到摄像机。<br>
                24. KSZ9031: 1000M网络电缆驱动器网卡。<br>
                25. STMPS2252MTR: 电源开关芯片。<br>
                26. MP9943: 降压DCDC电源芯片。<br>
                27. WM8960: 音频编解码器芯片。<br>
                28. MP2161: 降压DCDC电源芯片。
              </p>
            </div>
          </div>
          <img src="/storage/page/digikey-funpack/image/pro-02.png" style="margin-top:15px;">
          <div class="rules-text-p content-text-p">
            <p>
              1. STM32MP157C: 核心板处理器(双架构处理器：Arm Cortex-A7 and Cortex-M4 )<br>
              2. MT41K256M16TW-107:P: 512M 16位RAM内存芯片<br>
              3. STPMIC1APQR: 电源管理芯片<br>
              4. EMMC04G-M627: 4GeMMC内存<br>
              5. LED: 成功供电后，PWR将继续工作。当系统正常运行时，USER LED将一直闪烁。<br>
              6. 70针连接器：3路70针板对板连接器
            </p>
          </div>
        </div>
        <div class="line-phone" class="phone-show"></div>
      </div>

      <div class="bg-white">
        <div id="stepDiv" class="stepDiv">
          <h2 class="phone-hidden">Digikey Funpack 流程介绍</h2>
          <img src="/storage/page/digikey-funpack/image/step2x.png" class="phone-hidden">
          <img src="/storage/page/digikey-funpack/image/phone/phone-banner-step.png" class="phone-show">
          <div class="bottom-text-desc phone-hidden">
            <p class="text-center">每期活动用户只有从硬禾指定链接购买才有效（即Digikey官网购买）</p>
            <p class="text-center">用户邮件提交的视频、代码、文档将会用于在硬禾或得捷电子运营的网站、公众号、视频号上展示，最终解释权归硬禾所有。</p>
          </div>
        </div>
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
      window.open('https://ad.doubleclick.net/ddm/clk/474402378;280348785;t?https://www.digikey.cn/product-detail/zh/seeed-technology-co-ltd/102110319/1597-102110319-ND/11205850');
    })
    $('#adbuy').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/474402378;280348785;t?https://www.digikey.cn/product-detail/zh/seeed-technology-co-ltd/102110319/1597-102110319-ND/11205850');
    })
    $('#addigikey').click(function() {
      window.open('https://ad.doubleclick.net/ddm/clk/472049650;277661009;k?http://www.digikey.cn');
    })
  });
</script>
@endsection
