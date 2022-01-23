@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper bg-white content-rule">
    <h3 class="text-center rule-title">Funpack活动规则</h3>
    <h4>一、活动流程及时间安排</h4>
    <div class="topBanner rule-step-img">
      <img alt="DK活动流程介绍" title="DK活动流程介绍" src="/storage/page/digikey-funpack/image/rule-steps.png"/>
    </div>
    <div class="content">
      <div class="rules-text-p">
        <p>1. 第一期板卡购买链接：请进入<a href="https://www.eetree.cn/page/digikey-funpack/phase1" target="_blank">https://www.eetree.cn/page/digikey-funpack/phase1</a>页面点击“得捷购”，进行购买</p>
        <p>2. 本期板卡直播安排在9月15日，介绍板卡上手使用方法</p>
        <p>3. 用户在10月15日（一个月时间）前完成指定任务，通过邮件提交指定材料给硬禾，提交时间截止到10月15日晚23:59</p>
        <p class="yellow-text">4. 硬禾审核通过的粉丝，由硬禾工作人员直接联系，发放购买板卡等值的京东购物券</p>
      </div>
      <h4>二、材料提交要求</h4>
      <div class="rules-text-p">
        <p>一个月内完成指定任务，需要提交以下材料，发送邮件到：funpack@eetree.cn，邮件命名：Funpack第一期 – 姓名</p>
        <p>1. 3-5分钟短视频</p>
        <div class="rules-p-child">
          <p>· 自我介绍</p>
          <p>· 硬件介绍（控制器及外设，应用方向及应用场景）</p>
          <p>· 设计思路（用板子的哪些模块实现了什么功能）</p>
          <p>· 指定功能演示：</p>
          <div class="rules-p-child">
            <p>· 驱动LED灯亮，使其实现呼吸灯的效果；</p>
            <p>· 成功驱动SPI、I2C、UART三个外设中的其中一个，且在拍视频时显示出来。</p>
          </div>
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
        <p class="yellow-text">注：第5项需在邮件正文中写明，格式如5</p>
      </div>
      <h4>三、返还方法</h4>
      <div class="rules-text-p">
        <p>审核通过者返还与购买板卡费用等值的京东购物券</p>
      </div>
    </div>
  </div>
@endsection
