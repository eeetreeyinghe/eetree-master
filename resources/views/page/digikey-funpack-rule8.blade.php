@extends('page.layout-class')
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper bg-white content-rule">
    <h3 class="text-center rule-title">Funpack第八期活动规则</h3>
    <div class="content" style="width:auto;">
      <h4>一、什么是Funpack</h4>
      <div class="rules-text-p">
        <p>Funpack是硬禾学堂联合Digi-Key发起，为期一年的“玩成功就能得奖”活动。每个月我们都会推出一款全球顶级半导体厂商的开发板/仪器套件。如果你能在一个月内按照指定目标把它玩起来，就可以获得丰厚奖励。</p>
      </div>
      <div class="bordere5"></div>
      <h4>二、本期活动流程及时间安排</h4>
      <div class="topBanner rule-step-img">
        <img alt="DK活动流程介绍" title="DK活动流程介绍" src="/storage/page/digikey-funpack/image/8/rule-steps.png"/>
      </div>
      <div class="rules-text-p">
        <p>1. 下单：请在Funpack首页(<a href="https://www.eetree.cn/page/digikey-funpack" target="_blank">https://www.eetree.cn/page/digikey-funpack</a>) 点击“得捷购”，下单第八期板卡</p>
        <p>2. 直播：第八期直播安排在2021年4月15日</p>
        <p>3. 截止日期：参与者需在2021年5月20日晚上12点前完成指定任务，通过邮件提交指定材料给硬禾</p>
        <p>4. 活动返还：除购买Arduino Nano 33 BLE Sense外，其余器件自选，凑齐300元顺利发货，审核通过者可获得300元京东券的返还</p>
      </div>
      <div class="bordere5"></div>
      <h4>三、第八期指定完成的任务</h4>
      <div class="rules-text-p">
        <p>活动参与者可从下面两个任务中任选其一完成：</p>
        <p>
          <b>任务一：投篮运动手柄</b>
          <br />利用NANO-33 BLE的加速度及角速度感应器，设计一款用于虚拟练习投篮的手柄。
          <br /><br />投篮者可通过手持手柄(开发板)模拟投篮动作，而手柄会根据初始物理参数(可由用户设定或者系统默认值)，对投篮者的命中率作出预判，并且可以将改进建议的信息反馈给投篮者。优秀的模拟投篮手柄的确可以帮助用户提高投篮命中率。
          <br /><br />以下参数可作为参考，通常：
        </p>
        <div class="rules-p-child">
          <p>· 篮筐高度：3.05m</p>
          <p>· 罚球线投篮距离：4.5m</p>
          <p>· 篮球质量：620g</p>
        </div>
        <p>
          <b>任务二：环境监测站</b>
          <br />利用NANO-33 BLE的传感器，搭建一个小型环境监测站用于监测户外环境。待监测的参数包括：
        </p>
        <div class="rules-p-child">
          <p>· 周边环境温度（精度：±0.1°C, ±0.1°F）</p>
          <p>· 周边环境湿度（精度：±1%）</p>
          <p>· 大气压强（精度：±0.1kPa, ±0.1psi）</p>
          <p>· 日照强度（用于判断白天/夜晚）</p>
          <p>· 周边平均噪声（精度：±1dB）</p>
        </div>
        <p>
          其中任务一和任务二的数据信息反馈方式可采用以下任意一种方式:
          <br />1. 通过对开发板外接显示屏显示
          <br />2. 通过蓝牙在电脑端口显示
          <br />3. 通过手机APP
        </p>
      </div>
      <div class="bordere5"></div>
      <h4>四、材料提交要求</h4>
      <div class="rules-text-p">
        <p>指定时间内完成指定任务，并按以下要求提交材料。</p>
        <p>
          1. 下单48小时内请提交Digi-Key购买订单的pdf（如下图显示，若无法下载，请将Digi-Key发给您的pdf订单发到邮箱）到<b>funpack@eetree.cn</b>邮箱
          <br />邮件请命名为：Funpack第八期订单 – 姓名（请填写真实姓名）
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
          2. 在5月20晚上12点之前将以下材料提交到电子森林项目网站，提交方法请见<a href="/page/digikey-funpack/help">详细说明</a>
          <br />【项目标题需包含关键字：“Funpack第八期”，及所完成任务的关键字，其他可自由发挥。】：
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
            <p>. 功能演示结果及说明（可添加演示图片进行解释说明）</p>
            <p>· 对本活动的心得体会（包括意见或建议）</p>
          </div>
          <p>c. 可编译下载的代码（放在电子森林项目的附件处）</p>
        </div>
        <p>
          3. 在截止日期之前将以下内容发送到 funpack@eetree.cn 邮箱，以作最后材料关联和京东券的返还。邮件请命名为：Funpack第八期 – 姓名（请填写真实姓名）
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
        <p>完成任务并获得审核通过者，由硬禾工作人员直接联系，返还300元京东购物券。</p>
      </div>
      <div class="border-e5"></div>
      <h4>六、微信交流群</h4>
      <div class="rules-text-p">
        <p>请关注“<b>硬禾学堂</b>”微信公众号，并发送关键字“<b>Arduino</b>”获取群二维码进群交流（最近群里发广告的太多，我们采用这个方法并在群里及时维护，尽力为大家提供一个干净的技术交流环境）。</p>
        <p class="yellow-text">注：每期活动用户只有从硬禾指定链接购买才有效（即从“得捷购”进入购买页面），用户邮件提交的视频、代码、文档将会用于在硬禾 或得捷电子运营的网站、公众号、视频号上展示，且同意接收由Digi-Key得捷电子发出的电子通讯。活动最终解释权归硬禾所有。</p>
      </div>
    </div>
  </div>
@endsection
