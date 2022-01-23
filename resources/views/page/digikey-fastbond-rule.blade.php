@extends('page.layout-class', ['pageParams' => [
  'head' => true,
  'nav' => true
]])
@section('head')
  <title>Digikey FastBond</title>

  <link rel="stylesheet"  href="/storage/page/digikey-funpack/css/iconfont.css" type="text/css">
  <link rel="stylesheet"  href="/storage/page/digikey-funpack/css/index.css?v=2021061" type="text/css">
@endsection
@section('nav')
<a href="https://www.eetree.cn/page/digikey-fastbond" class="">FastBond</a>
@endsection
@section('content')
  <!-- 页面主要内容 -->
  <div class="content-wrapper bg-white content-rule">
    <h3 class="text-center rule-title">FastBond 活动规则</h3>
    <div class="content" style="width:auto;">
      <h4>一、什么是FastBond</h4>
      <div class="rules-text-p">
        <p>FastBond是硬禾学堂联合Digi-Key发起的，为期三个半月的“你创意，我买单”活动。精选5个主题让大家进行创意发挥，如果你能在10月20日之前成功在得捷电子购买元器件（<span class="red-text">所购元器件中必须包含“ADI和美信”的产品</span>），且利用它们实现相关功能并提交项目，那必然能获得丰厚奖励。
        </p>
      </div>
      <div class="bordere5"></div>
      <h4>二、本期活动流程时间安排</h4>
      <div class="topBanner rule-step-img">
        <img class="phone-hidden" alt="DF活动流程介绍" title="DF活动流程介绍" src="/storage/page/digikey-fastbond/image/panle3.png"/>
        <img class="phone-show" alt="DF活动流程介绍" title="DF活动流程介绍" src="/storage/page/digikey-fastbond/image/phone/panle3.png"/>
      </div>
      <div class="rules-text-p">
        <p>1.  下单：在<a href="https://ad.doubleclick.net/ddm/clk/500898489;308256424;u?https://www.digikey.cn/" target="_blank">得捷电子官网</a>购买自己所需要的的元器件（<span class="red-text">所购元器件中必须包含“ADI以及美信”的产品，购买推荐芯片，项目评选时额外加10分</span>）</p>
        <p>2.  Q & A直播 / KiCad工具使用培训</p>
        <p>3.  项目设计：<span class="red-text">本次项目的板卡必须同时使用ADI和美信的产品实现相关功能</span></p>
        <p>4.  项目截止日期：参与者需要在2021年10月20日晚上12点前完成开发板设计以及项目调试，并通过邮件提交指定材料给硬禾学堂</p>
        <p>5.  活动返还：审核通过者予以返还京东购物券</p>
      </div>
      <div class="bordere5"></div>
      <h4>三、活动福利</h4>
      <div class="rules-text-p">
        <p><b>1.  订单返还：</b></p>
        <div class="rules-p-child">
          <p>
            截止2021年10月20日（最晚下单日期10月20日），成功在得捷电子下单，且在电子森林发布项目创意并且上传PCB打板图（<span class="red-text">非必须条件</span>，发送订单之后以官方邮件回复为准）的参与者。经硬禾学堂审核成功，返还300元京东购物券。
            <br><span class="red-text">温馨提示：购买推荐芯片，项目评选额外加10分。</span>
          </p>
        </div>

        <p><b>2.  【项目激励】进军前100，额外加赠：</b></p>
        <div class="rules-p-child">
          <p>截止2021年10月20日，在电子森林网站发布项目，并通过邮件发送相关素材到官方邮箱的参与者。经过审核，内容、项目完整，额外加赠价值￥200元的奖品。</p>
        </div>
        <p><b>3.  【TOP 10评选】-ADI口袋仪器M2K（ADALM2000）：</b></p>
        <div class="rules-p-child">
          <p>截止2021年10月20日，所有参与FastBond活动并成功在电子森林提交完整项目素材的参与者，均可参与评选，最优秀的10位，将每人获得ADI口袋仪器M2K（1份）。</p>
        </div>
        <p><b>4.  【Digi-Key VIP采访】：</b></p>
        <div class="rules-p-child">
          <p>TOP 10获奖者将有机会在Digi-Key VIP进行采访。</p>
        </div>

      </div>
      <div class="bordere5"></div>
      <h4>四、项目方向</h4>
      <div class="rules-text-p">
        <p>活动参与者需从以下5个主题中任选其一完成项目：<br/>
          <span class="red-text">注：项目中必须使用到ADI和Maxim的产品。</span>
        </p>
        <div class="buttons-link">
          <a href="https://www.eetree.cn/project/detail/414" target="_blank" class="button-rule">智能可穿戴</a>
          <a href="https://www.eetree.cn/project/detail/415" target="_blank" class="button-rule">体外诊断</a>
          <a href="https://www.eetree.cn/project/detail/418" target="_blank" class="button-rule">环境监测</a>
          <a href="https://www.eetree.cn/project/detail/417" target="_blank" class="button-rule">工业机器人</a>
          <a href="https://www.eetree.cn/project/detail/416" target="_blank" class="button-rule">智能建筑</a>
        </div>
      </div>
      <div class="bordere5"></div>
      <h4>五、材料提交要求</h4>
      <div class="rules-text-p">
        <p><b>1.Digi-Key订单提交</b><br/>
          下单<span class="red-text">48小时内</span>请提交Digi-Key购买订单的pdf（如下图显示，若无法下载，请将Digi-Key发给您的pdf订单发到邮箱）到官方邮箱<b>fastbond@eetree.cn</b>
        </p>
        <div class="rules-p-child">
          <b>邮件请命名为：FastBond订单 – 姓名（请填写真实姓名）</b>
          <p>邮件正文请按以下格式填写相应信息（用于关联京东券的返还）：</p>
          <p>· 姓名</p>
          <p>· 电话</p>
          <p>· 邮箱</p>
          <p>· 公司或学校</p>
          <p>· 职务或专业及年级</p>
        </div>
        <img alt="Digi-Key" title="Digi-Key" src="/storage/page/digikey-fastbond/image/dk-img-desc.png"/>
        <p><b>2.电子森林项目内容发布</b></p>
        <div class="rules-p-child">
          <p>
            <b>截止时间：</b>在10月20晚上12点之前将以下材料提交到电子森林项目网站，提交方法请见<a href="/page/digikey-funpack/help">详细说明</a><br />
            <b>项目标题需包含关键字：</b>“FastBond”及所完成项目的标题，如“FastBond智能可穿戴之xxxx”，其他可自由发挥。
          </p>
          <b>项目内容：</b>
          <p><b>a. 3-5分钟短视频（要求横屏且1080p）【请先上传到自己的bilibili账号上（或优酷/腾讯视频）】</b></p>
          <div class="rules-p-child">
            <p>· 简短的自我介绍</p>
            <p>· 项目简介（FastBond活动选择的项目方向介绍、PCB打板介绍）</p>
            <p>· 设计思路（用板子的哪些模块实现了什么功能）</p>
            <p>· 模块、芯片功能介绍（“ADI和美信”芯片介绍）</p>
            <p>· 项目的功能演示</p>
          </div>
          <p><b>b. 说明文档（放在电子森林项目的描述处）</b></p>
          <div class="rules-p-child">
            <p>· 项目介绍（包括设计思路、软硬件介绍等）</p>
            <p>· 项目用到的板卡、芯片、模块、仪器、设备等介绍</p>
            <p>· 关键性代码及说明</p>
            <p>· 功能演示结果及说明（可添加演示图片进行解释说明）</p>
            <p>· 对本活动的心得体会（包括意见或建议）</p>
          </div>
          <p><b>c. 可编译下载的代码（放在电子森林项目的附件处）</b></p>
        </div>
        <p>
          <b>3. 邮箱内容提交，作为最后材料，且关联京东购物券的返还</b>
        </p>
        <div class="rules-p-child">
          <p>
            <b>截止日期：2021年10月20日12点前</b><br/>
            <b>邮件请命名为：Fastbond – 姓名（请填写真实姓名）</b><br/>
            <b>正文内容（请提交到官方邮箱：fastbond@eetree.cn）：</b>
          </p>
          <p>· 将视频原文件（要求横屏且1080p）</p>
          <p>· 在电子森林项目网站(<a href="https://www.eetree.cn" target="_blank">www.eetree.cn</a>)注册的昵称，即网站右上角的名字则为昵称（用于关联最后在电子森林项目网站提交的材料）</p>
          <img src="http://wechatapppro-1252524126.file.myqcloud.com/image/ueditor/95959100_1609221186.png"/>
        </div>
      </div>
      <div class="border-e5"></div>
      <h4>六、TOP 10评选标准</h4>
      <div class="rules-text-p">
        <p>2021年10月20日前，成功验证项目功能且完整提交材料的学员，均可参与最终TOP 10评选，具体评分标准如下：</p>
      </div>
      <div class="rule-bottom-table">
          <table>
            <tr>
              <th class="td-l">类别</th>
              <th class="td-m">明细</th>
              <th class="td-r">分值</th>
            </tr>
            <tr>
              <td class="td-l" rowspan="5">短视频<br>（35分）</td>
              <td class="td-m">自我介绍</td>
              <td class="td-r">5</td>
            </tr>
            <tr>
              <td class="td-m">FastBond活动选择的项目方向介绍（打板的PCB介绍）</td>
              <td class="td-r">5</td>
            </tr>
            <tr>
              <td class="td-m">项目设计思路</td>
              <td class="td-r">5</td>
            </tr>
            <tr>
              <td class="td-m">模块、芯片功能介绍（“ADI和美信”芯片介绍）</td>
              <td class="td-r">10</td>
            </tr>
            <tr>
              <td class="td-m">功能演示</td>
              <td class="td-r">10</td>
            </tr>
            <tr>
              <td class="td-l" rowspan="7">电子森林<br>说明文档<br>（50分）</td>
              <td class="td-m">字数要求（不包含代码）：不少于1000字</td>
              <td class="td-r">5</td>
            </tr>
            <tr>
              <td class="td-m">项目介绍（包括设计思路、软硬件介绍等）</td>
              <td class="td-r">10</td>
            </tr>
            <tr>
              <td class="td-m">项目用到的板卡、芯片、模块、仪器、设备等介绍</td>
              <td class="td-r">5</td>
            </tr>
            <tr>
              <td class="td-m">关键性代码及说明</td>
              <td class="td-r">10</td>
            </tr>
            <tr>
              <td class="td-m">功能演示</td>
              <td class="td-r">10</td>
            </tr>
            <tr>
              <td class="td-m">项目中遇到的问题以及解决方案</td>
              <td class="td-r">5</td>
            </tr>
            <tr>
              <td class="td-m">心得感想</td>
              <td class="td-r">5</td>
            </tr>
            <tr>
            <td class="td-l" rowspan="2">附件<br>（15分）</td>
              <td class="td-m">可下载的代码（用于验证功能）</td>
              <td class="td-r">10</td>
            </tr>
            <tr>
              <td class="td-m">电路图、原理图</td>
              <td class="td-r">5</td>
            </tr>
            <td class="td-l" rowspan="5">额外加分项<br>（30分）</td>
              <td class="td-m">
                <span class="red-text">购买“ADI和Maxim”推荐芯片</span>
              </td>
              <td class="td-r">10</td>
            </tr>

           <tr>
              <td class="td-m">提前提交项目创意</td>
              <td class="td-r">5</td>
            </tr>
            <tr>
              <td class="td-m">PCB打板</td>
              <td class="td-r">5</td>
            </tr>
            <tr>
              <td class="td-m">在规定时间内，前50名完整提交项目并通过审核</td>
              <td class="td-r">5</td>
            </tr>
            <tr>
              <td class="td-m">项目难度</td>
              <td class="td-r">5</td>
            </tr>
          </table>
      </div>
      <div class="bordere5"></div>
      <h4>七、微信交流群</h4>
      <div class="rules-text-p">
        <p>请关注“<b>硬禾学堂</b>”微信公众号，并发送关键字“<b>FastBond</b>”获取群二维码进群交流（我们采用回复关键词的方法，维护群聊，尽力为大家提供一个干净的技术交流环境）。</p>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
</script>
@endsection
