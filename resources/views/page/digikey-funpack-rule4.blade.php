@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper bg-white content-rule">
    <h3 class="text-center rule-title">Funpack活动规则</h3>
    <div class="content" style="width:auto;">
      <h4>一、什么是Funpack</h4>
      <div class="rules-text-p">
        <p>开发板，是工程师探索新技术、试用新产品、快速开发原型样机的最佳方式。硬禾学堂联合全球著名的元器件分销商Digi-key发起为期一年的Funpack活动——每个月推出一款用全球顶级半导体厂商的新产品构成的开发板套件。如果你能在一个月内按照指定目标把它玩起来，就可以免费获得它。</p>
      </div>
      <div class="bordere5"></div>
      <h4>二、本期活动流程及时间安排</h4>
      <div class="topBanner rule-step-img">
        <img alt="DK活动流程介绍" title="DK活动流程介绍" src="/storage/page/digikey-funpack/image/4/rule-steps.png"/>
      </div>
      <div class="rules-text-p">
        <p>1. 第四期板卡购买链接：请在Funpack第四期首页(<a href="https://www.eetree.cn/page/digikey-funpack" target="_blank">https://www.eetree.cn/page/digikey-funpack</a>) 点击“得捷购”，进行购买</p>
        <p>2. 本期板卡为Silicon Labs 的Thunderboard™ BG22 开发套件，可提供低功耗蓝牙、网状网络和误差一米以内测向精度，可用纽扣电池供电。直播安排在12月15日，主要介绍板卡上手使用方法。</p>
        <p>3. 用户在2021年1月15前完成指定任务，通过邮件提交指定材料给硬禾，提交时间截止到2021年1月15日晚23:59</p>
        <p>4. 审核通过者，由硬禾工作人员直接联系，发放购买板卡等值的京东购物券</p>
        <p>5. 由于Digi-Key官网要求订单金额达到300人民币才会发货，而本期板卡单价未达到这个下限，所以我们将支持单张订单内最多返还2块板卡的购买费用。也就是说如果最后提交的订单pdf文件中包含1块本期活动板卡，我们返还1块该板卡的购买费用；如果最后提交的订单pdf文件中包含2块或以上本期活动板卡，我们只返还2块该板卡的购买费用。</p>
      </div>
      <div class="bordere5"></div>
      <h4>三、本期指定完成的任务</h4>
      <div class="rules-text-p">
        <p>通过蓝牙读取开发板上的温度传感器数值，超过一定门槛后，再通过蓝牙控制开发板上的LED灯点亮以作报警</p>
      </div>
      <div class="bordere5"></div>
      <h4>四、材料提交要求</h4>
      <div class="rules-text-p">
        <p>指定时间内完成指定任务，需要提交以下材料，发送邮件到：<b>funpack@eetree.cn</b>，邮件命名：<b>Funpack第四期 – 姓名</b>（请填写真实姓名）</p>
        <p>1. 3-5分钟短视频（要求横屏且1080p）</p>
        <div class="rules-p-child">
          <p>· 自我介绍</p>
          <p>· 硬件介绍（控制器及外设，应用方向及应用场景）</p>
          <p>· 设计思路（用板子的哪些模块实现了什么功能）</p>
          <p>· 本期指定完成任务的功能演示：</p>
        </div>
        <p>2. 可编译下载的代码（用于验证功能）</p>
        <p>3. 说明文档</p>
        <div class="rules-p-child">
          <p>· 简短的自我介绍</p>
          <p>· 介绍用本板卡最终实现了什么功能及各功能对应的主要代码片段</p>
          <p>· 对本活动的心得体会（包括意见或建议）</p>
        </div>
        <p>4. Digi-Key购买的订单（从Digi-Key官网直接“下载订单”获得订单pdf文件）,如下图显示：</p>
        <img alt="Digi-Key" title="Digi-Key" src="/storage/page/digikey-funpack/image/dk-img-desc.png"/>
        <p class="yellow-text">注：以上第1、2、3、4项作为附件压缩包发到邮箱</p>
        <p>5. 个人信息：</p>
        <div class="rules-p-child">
          <p>· 姓名</p>
          <p>· 电话</p>
          <p>· 邮箱</p>
          <p>· 公司或学校</p>
          <p>· 职务或专业及年级</p>
        </div>
        <p class="yellow-text">注：第5项需在邮件正文中写明，格式如序号5</p>
      </div>
      <div class="border-e5"></div>
      <h4>五、返还方法</h4>
      <div class="rules-text-p">
        <p>审核通过者返还与购买板卡费用等值的京东购物券</p>
        <p class="yellow-text">注：每期活动用户只有从硬禾指定链接购买才有效（即从“得捷购”进入购买页面），用户邮件提交的视频、代码、文档将会用于在硬禾或得捷电子运营的网站、公众号、视频号上展示，最终解释权归硬禾所有。</p>
      </div>
    </div>
  </div>
@endsection
