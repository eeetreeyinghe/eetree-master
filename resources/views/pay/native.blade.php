@extends('layouts.app')

@section('content')
<!-- 微信支付页面 -->
<div class="weixin-pay">
    <div class="head-title font18">收银台</div>
    <div class="flex flex-between flex-center-v head-desc">
        <p class="font14">订单提交成功，请尽快付款！</p>
        <div class="hover-text font14"><span class="fontSize24">{{ $order->total_fee }}</span>元</div>
    </div>
    <h5 class="title-pay font14">{{ $order->orderItems->first()->projectGoods->name }}</h5>
    <div class="bg-white bg-main" style="padding-bottom:40px;">
        <div class="weixin-bg-part flex flex-end-v">
            <div class="font18 weixin-bg-title">微信支付</div>
            <p class="font14 flex flex-end-v" id="jsPayTip">距离二维码过期还剩 <span id="countdown" class="countdown">180</span>秒，过期后请刷新页面重新获取二维码</p>
        </div>
        <div class="flex flex-center main-img">
            <div class="main-weixin-left">
                <img class="erweima" src="{{ $payUrl }}"/>
                <div class="bg-org flex flex-center">
                    <img src="/img/sao.png"/>
                    <p class="font14">
                        请使用微信扫一扫<br/>
                        扫描二维码支付
                    </p>
                </div>
            </div>
            <img src="/img/weixin-r-img.png">
        </div>
        <!-- <a class="bottom-return" href="#"> <i class="el-icon-arrow-left"></i>选择其他支付方式</a> -->
    </div>
</div>

@endsection

@section('scripts')
<script>
    var checkTimer;
    var countDownTimer;
    var countDown = 180;
    setTimeout(function() {
        checkTimer = setInterval(checkPaid, 3000);
    }, 5000);
    countDownTimer = setInterval(function() {
        if (--countDown <= 0) {
            clearInterval(countDownTimer);
            $('#jsPayTip').html(
                '二维码已过期,<span class="countdown" onclick="location.reload()">刷新</span>页面重新获取二维码。').addClass('warning-p')
        }
        $('#countdown').text(countDown)
    }, 1000);

    function checkPaid() {
        $.ajax({
            type: 'GET',
            url: '{{ route('pay.checkPaid', ['order' => $order->id]) }}',
            dataType: 'json',
            success: function(res) {
                if (res.code !== 200) {
                    clearInterval(checkTimer);
                    return;
                }
                if (res.data) {
                    clearInterval(checkTimer);
                    location.href = '{{ route('pay.success') }}'
                }
                if (countDown <= 0) {
                    clearInterval(checkTimer);
                }
            }
        });
    }
</script>
@endsection
<style lang="css" scoped>
    .weixin-pay{
        width:1016px;
        margin:45px auto;
    }
    .bg-main{
        box-shadow: 0px 2px 4px 0px #E5E5E5;
    }
    .head-title{
        color: #9B9B9B;
    }
    .head-desc{
        margin-top:40px;
    }
    .head-desc p{
        margin-bottom:0;
        color: #666666;
    }
    .title-pay{
        font-family: PingFangSC-Semibold, PingFang SC;
        font-weight: 600;
        color: #222222;
        margin-top: 8px;
        margin-bottom: 18px;
    }
    .weixin-bg-part{
        padding:16px 35px 0;
    }
    .weixin-bg-part .weixin-bg-title,.weixin-bg-part p{
        color:#666;
        margin-bottom:0;
    }
    .weixin-bg-title{
        margin-right:58px;
    }


    .weixin-bg-part p.warning-p{
        color:#D0021B;
    }
    .weixin-bg-part p.warning-p .countdown,.countdown {
        cursor: pointer;
        font-size:16px;
        color: #409EFF;
        margin-left:5px;
        margin-right:5px;
    }

    .main-weixin-left .erweima{
        width:300px;
        height:300px;
        border: 1px solid #EFEFEF;
        margin-right: 45px;
    }
    .bg-org{
        width: 300px;
        height: 62px;
        background: #F3CD8D;
    }
    .bg-org img{
        width:46px;
        height:46px;
    }
    .bg-org p{
        color: #FFFFFF;
        margin-bottom:0;
        margin-left: 30px;
    }
    .main-img{
        margin-bottom:40px;
    }
    .bottom-return{
        padding-left:57px;
        font-size: 15px;
    }
    .bottom-return i{
        margin-right:10px;
        color:#666;
    }
</style>
