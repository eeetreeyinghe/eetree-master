@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper bg-white content-rule">
    <h3 class="text-center rule-title">Funpack第十期活动规则</h3>
    <div class="content" style="width:auto;">
      <h4>一、什么是Funpack</h4>
      <div class="rules-text-p">
        <p>Funpack是硬禾学堂联合Digi-Key发起，为期一年的“玩成功就能得奖”活动。每个月我们都会推出一款全球顶级半导体厂商的开发板/仪器套件。如果你能在一个月内按照指定目标把它玩起来，就可以获得丰厚奖励。</p>
      </div>
      <div class="bordere5"></div>
      <h4>二、本期活动流程及时间安排</h4>
      <div class="topBanner rule-step-img">
        <img alt="DK活动流程介绍" title="DK活动流程介绍" src="/storage/page/digikey-funpack/image/10/rule-steps.png"/>
      </div>
      <div class="rules-text-p">
        <p>1. 下单：请于7月1日-7月20日在Funpack首页(<a href="https://www.eetree.cn/page/digikey-funpack" target="_blank">https://www.eetree.cn/page/digikey-funpack</a>) 点击“得捷购”，下单第十期板卡</p>
        <p>2. 直播：第十期直播安排在2021年7月20日</p>
        <p>3. 截止日期：参与者需在2021年8月31日晚上12点前完成指定任务，通过邮件提交指定材料给硬禾</p>
        <p>4. 活动返还：审核通过者返还与购买板卡费用等值的京东购物券</p>
      </div>
      <div class="bordere5"></div>
      <h4>三、第十期指定完成的任务</h4>
      <div class="rules-text-p">
        <img src="/storage/page/digikey-funpack/image/10/rule-sample.png" class="phone-hidden" style="float:right;width:240px;margin-left:5px" />
        <p>活动参与者可从以下任务中任选其一完成：</p>
        <p>
          <b>任务一：</b>
          <br />参考官方教程，移植或设计一款游戏（要求: 不得与官方提供的游戏重复； 可供选择：打地鼠、俄罗斯方块等）。
        </p>
        <p>
          <b>任务二：</b>
          <br />设计一个摩斯密码练习器，选择两个按键为点与横，或者一个按键的长短按，从以下两种方式中任选一个完成：
          <br />1. LCD屏上随机出现一个字符，敲出对应的组合（3-5个字符即可），正确时，蜂鸣器响；错误时，振动电机发出振动
          <br />2. 敲击按键，识别出按键组合对应的字符，在屏幕上打出自己的id
        </p>
        <img src="/storage/page/digikey-funpack/image/10/rule-sample.png" class="phone-show" />
      </div>
      <div class="bordere5"></div>
      <h4>四、材料提交要求</h4>
      <div class="rules-text-p">
        <p>指定时间内完成指定任务，并按以下要求提交材料。</p>
        <p>
          1. 下单48小时内请提交Digi-Key购买订单的pdf（如下图显示，若无法下载，请将Digi-Key发给您的pdf订单发到邮箱）到<b>funpack@eetree.cn</b>邮箱
          <br />邮件请命名为：Funpack第十期订单 – 姓名（请填写真实姓名）
          <br />邮件正文请按以下格式填写相应信息：
        </p>
        <div class="rules-p-child">
          <p>· 姓名</p>
          <p>· 电话</p>
          <p>· 邮箱</p>
          <p>· 公司或学校</p>
          <p>· 职务或专业及年级</p>
        </div>
        <img alt="Digi-Key" title="Digi-Key" src="/storage/page/digikey-funpack/image/8/dk-img-desc.png"/>
        <p>
          2. 在8月31晚上12点之前将以下材料提交到电子森林项目网站，提交方法请见<a href="/page/digikey-funpack/help">详细说明</a>
          <br />【项目标题需包含关键字：“Funpack第十期”、“Kitronik ARCADE”，及所完成任务的关键字，其他可自由发挥。】：
        </p>
        <div class="rules-p-child">
          <p>a. 3-5分钟短视频（要求横屏且1080p）【请先上传到自己的bilibili账号上（或优酷/腾讯视频）】</p>
          <div class="rules-p-child">
            <p>· 简短的自我介绍</p>
            <p>· 硬件介绍（控制器及外设，应用方向及应用场景）</p>
            <p>· 设计思路（用板子的哪些模块实现了什么功能）</p>
            <p>· 本期指定完成任务的功能演示</p>
          </div>
          <p>b. 说明文档（放在电子森林项目的描述处）</p>
          <div class="rules-p-child">
            <p>· 介绍用本板卡最终实现了什么功能</p>
            <p>· 各功能对应的主要代码片段及解释</p>
            <p>· 功能展示及说明（可插入图片进行展示并说明）</p>
            <p>· 对本活动的心得体会（包括意见或建议）</p>
          </div>
          <p>c. 可编译下载的代码（放在电子森林项目的附件处）</p>
        </div>
        <p>
          3. 在截止日期之前将以下内容发送到 funpack@eetree.cn 邮箱，以作最后材料关联和京东券的返还。
          <br />邮件请命名为：Funpack第十期 – 姓名（请填写真实姓名）
        </p>
        <div class="rules-p-child">
          <p>· 将视频原文件（要求横屏且1080p）</p>
          <p>· 在电子森林项目网站(<a href="https://www.eetree.cn" target="_blank">www.eetree.cn</a>)注册的昵称，即网站右上角的名字则为昵称（用于关联最后在电子森林项目网站提交的材料）</p>
          <img src="http://wechatapppro-1252524126.file.myqcloud.com/image/ueditor/95959100_1609221186.png"/>
        </div>
      </div>
      <div class="border-e5"></div>
      <h4>五、返还方法</h4>
      <div class="rules-text-p">
        <p>审核通过者返还与购买板卡费用等值的京东购物券</p>
      </div>
      <div class="border-e5"></div>
      <h4>六、微信交流群</h4>
      <div class="rules-text-p">
        <p>请关注“<b>硬禾学堂</b>”微信公众号，并发送关键字“<b>游戏手柄</b>”或“<b>Funpack10</b>”获取群二维码进群交流（我们采用回复关键词的方法，维护群聊，尽力为大家提供一个干净的技术交流环境）。</p>
        <p class="yellow-text">注：每期活动用户只有从硬禾指定链接购买才有效（即从“得捷购”进入购买页面），用户邮件提交的视频、代码、文档将会用于在硬禾 或得捷电子运营的网站、公众号、视频号上展示，且同意接收由Digi-Key得捷电子发出的电子通讯。活动最终解释权归硬禾所有。</p>
      </div>
    </div>
  </div>
@endsection
