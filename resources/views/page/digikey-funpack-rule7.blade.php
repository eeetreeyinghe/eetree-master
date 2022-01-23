@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper bg-white content-rule">
    <h3 class="text-center rule-title">Funpack活动规则</h3>
    <div class="content" style="width:auto;">
      <h4>一、什么是Funpack</h4>
      <div class="rules-text-p">
        <p>Funpack是硬禾学堂联合Digi-Key发起，为期一年的“玩成功就能得奖”活动。每个月我们都会推出一款全球顶级半导体厂商的开发板/仪器套件。如果你能在一个月内按照指定目标把它玩起来，就可以获得丰厚奖励。</p>
      </div>
      <div class="bordere5"></div>
      <h4>二、本期活动流程及时间安排</h4>
      <div class="topBanner rule-step-img">
        <img alt="DK活动流程介绍" title="DK活动流程介绍" src="/storage/page/digikey-funpack/image/7/rule-steps.png?1"/>
      </div>
      <div class="rules-text-p">
        <p>1. 第七期板卡购买链接：请在Funpack第七期首页(<a href="https://www.eetree.cn/page/digikey-funpack" target="_blank">https://www.eetree.cn/page/digikey-funpack</a>) 点击“得捷购”，进行购买</p>
        <p>2. 本期直播安排在2021年3月15日</p>
        <p>3. 本期板卡为Microchip Technology的单片机开发板DM164137</p>
        <p>4. 用户需在2021年4月20日前完成指定任务，通过邮件提交指定材料给硬禾，提交时间截止到2021年4月20日晚23:59</p>
        <p>5. 活动返还规则：<br>本期板卡是211元，由于得捷的发货门槛在300元及以上，故各位朋友可购买完本期板卡后选择自己所需的其他器件（本期可选择购买mikroBUS扩展模块），凑齐300元以顺利发货。完成任务并获得审核通过者，由硬禾工作人员直接联系，可获得300元京东券的返还</p>
      </div>
      <div class="bordere5"></div>
      <h4>三、本期指定完成的任务</h4>
      <div class="rules-text-p">
        <p>本期活动参与者可从下面两个任务中任选其一完成：</p>
        <p>任务一：通过按键扩展功能，分为按键点击（快速点击），短按（大于1秒），长按（大于5秒）用来控制板上LED显示。同时外接串口模块打印信息（包括按键信息，电位计信息）</p>
        <p>任务二：可选择从Digi-Key购买mikroBUS扩展模块，插在本期板卡上完成任意一个项目</p>
      </div>
      <div class="bordere5"></div>
      <h4>四、材料提交要求</h4>
      <div class="rules-text-p">
        <p>指定时间内完成指定任务，并按以下要求提交材料。</p>
        <p>
          1. 下单48小时内请提交Digi-Key购买的订单（如下图显示，注意：不是销售订单）到<b>funpack@eetree.cn</b>邮箱，以确认参加活动，订单包含本期板卡订单和凑齐300元达到发货门槛的其他订单
          <br>邮件请命名为：Funpack第七期订单 – 姓名（请填写真实姓名）
          <br>邮件正文请按以下格式填写相应信息：
        </p>
        <div class="rules-p-child">
          <p>· 姓名</p>
          <p>· 电话</p>
          <p>· 邮箱</p>
          <p>· 公司或学校</p>
          <p>· 职务或专业及年级</p>
        </div>
        <img alt="Digi-Key" title="Digi-Key" src="/storage/page/digikey-funpack/image/dk-img-desc.png"/>
        <p>
          2. 在截止日期之前将以下材料提交到电子森林项目网站，提交方法请见<a href="/page/digikey-funpack/help">详细说明</a>】：
          <br>【项目标题需包含关键字：“Funpack第七期”，“DM164137”，及所完成任务的关键字，其他可自由发挥。】：
        </p>
        <div class="rules-p-child">
          <p>a. 3-5分钟短视频（要求横屏且1080p）【请先上传到自己的B站号上（或优酷/腾讯视频），如未注册过bilibili，请提前注册好，以免提交作业时耽误时间】</p>
          <div class="rules-p-child">
            <p>· 简短的自我介绍</p>
            <p>· 硬件介绍（控制器及外设，应用方向及应用场景）</p>
            <p>· 设计思路（用板子的哪些模块实现了什么功能）</p>
            <p>· 本期指定完成任务的功能演示</p>
          </div>
          <p>b. 说明文档</p>
          <div class="rules-p-child">
            <p>· 介绍用本板卡最终实现了什么功能及各功能对应的主要代码片段</p>
            <p>· 对本活动的心得体会（包括意见或建议）</p>
          </div>
          <p>c. 可编译下载的代码（用于验证功能）</p>
        </div>
        <p>
          3. 在截止日期之前将以下内容发送到 funpack@eetree.cn 邮箱，以作最后材料关联和京东券的返还。邮件请命名为：Funpack第七期 – 姓名（请填写真实姓名）
        </p>
        <div class="rules-p-child">
          <p>· 将视频原文件以附件形式发送（即上传到B站的视频原文件，要求横屏且1080p）</p>
          <p>· 在电子森林项目网站(<a href="https://www.eetree.cn" target="_blank">www.eetree.cn</a>)注册的昵称，即网站右上角的名字则为昵称（用于关联最后在电子森林项目网站提交的材料）</p>
          <img src="http://wechatapppro-1252524126.file.myqcloud.com/image/ueditor/95959100_1609221186.png"/>
        </div>
      </div>
      <div class="border-e5"></div>
      <h4>五、返还方法</h4>
      <div class="rules-text-p">
        <p>完成任务并获得审核通过者，由硬禾工作人员直接联系，返还300元京东购物券。</p>
      </div>
      <div class="border-e5"></div>
      <h4>六、微信交流群</h4>
      <div class="rules-text-p">
        <p>请关注“<b>硬禾学堂</b>”微信公众号，并发送关键字“<b>Funpack第七期</b>”获取群二维码进群交流（最近群里发广告的太多，我们采用这个方法并在群里及时维护，尽力为大家提供一个干净的技术交流环境）。</p>
        <p class="yellow-text">注：每期活动用户只有从硬禾指定链接购买才有效（即从“得捷购”进入购买页面），用户邮件提交的视频、代码、文档将会用于在硬禾或得捷电子运营的网站、公众号、视频号上展示，最终解释权归硬禾所有。</p>
      </div>
    </div>
  </div>
@endsection
