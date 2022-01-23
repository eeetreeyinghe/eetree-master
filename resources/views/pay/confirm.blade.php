@extends('layouts.app')

@section('content')

<input type="hidden" id="activeAddressId" value="">
@if ($isMobile)
<div class="bg-white container clearpadding">
    <div class="pay-part">
        <!-- <h4 class="header-title">收货地址</h4> -->
        <xy-address></xy-address>
        <!-- <h4 class="header-title">商品信息</h4> -->
        <div class="order-list">
            <img class="content-list-img" src="{{ $goods->cloud->url }}" alt="title">
            <div class="content-list-right">
                <div class="list-group-item-dec">
                    <div class="title font14">{{ $goods->name }}</div>
                </div>
                <div>
                    <p class="float-l desc font12"> 众筹 x 1</p>
                    <div class="float-r hover-price">¥{{ $goods->price }}</div>
                </div>
            </div>
        </div>
        @isset ($useCoupon)
        <div class="pay-list">
            <!-- <div class="font16 margin-b-30 pay-title"> 使用优惠券(码)</div> -->
            <div id="noCode" onclick="toggleCode()" class="code-default-part">
                <img src="/img/icons/code.svg" alt="优惠码" class="icons24">
                <span class="title-mobile-6">优惠码</span>
                <span class="el-radio__input float-r" >
                    <span class="el-radio__inner"></span>
                    <input type="radio"  name="codeProma" aria-hidden="true" tabindex="-1" class="el-radio__original" value="1">
                </span>
            </div>
            <div id="hasCode" class="code-part">
                <span class="el-radio__input margin-b-15">
                    <img src="/img/icons/code.svg" alt="优惠码" class="icons24">
                    <span class="title-mobile-6">优惠码</span>
                </span>
                <div class="el-input radioInput">
                    <input type="text" autocomplete="off" placeholder="请输入内容" class="el-input__inner" >
                    <button type="button" class="el-button el-button--default is-plain">
                        <span>确定</span>
                    </button>
                </div>
                <span class="el-radio__input is-checked float-r" >
                    <span class="el-radio__inner"></span>
                    <input type="radio" name="codeProma" aria-hidden="true" tabindex="-1" class="el-radio__original" value="2">
                </span>
            </div>
        </div>
        @endisset
        <div class="pay-list">
            <!-- <div class="font16 margin-b-30 pay-title">支付方式</div> -->
            <div class="weixinType">
                <img src="/img/icons/pay-wx.svg" alt="微信支付" class="icons24">
                <span class="title-mobile-6">微信支付</span>
                <input class="margin-r-8 float-r radioInput" type="radio" aria-hidden="true" name="weixinType" checked="checked">
            </div>
        </div>
        @isset ($useCoupon)@endisset
        <div class="pay-bottom">
            <div class="pay-last-part float-l">
                <span class="font12">商品总额</span><span class="font18">¥{{ $goods->price }}</span>
                <span class="font12">应付</span><span class="font18 hover-text">¥{{ $goods->price }}</span>
            </div>
            <button class="active-btn" id="dopay">立即支付</button>
        </div>
    </div>
</div>
@else
    <div class="bg-white container clearpadding">
        <div class="pay-part">
            <h4 class="header-title">收货地址</h4>
            <xy-address></xy-address>
            <h4 class="header-title">商品信息</h4>
            <div class="order-list flex flex-end-v flex-between">
                <div class="flex flex-center-v" style="padding-left:0;">
                    <img class="content-list-img" src="{{ $goods->cloud->url }}" alt="title">
                    <div class="list-group-item-dec">
                        <div class="title font18">{{ $goods->name }}</div>
                        <p class="desc font14"> x 1</p>
                    </div>
                </div>
                <div class="flex flex-center hover-price">¥{{ $goods->price }}</div>
            </div>
            @isset ($useCoupon)
            <div class="pay-list">
                <div class="font16 margin-b-30 pay-title"> 使用优惠券(码)</div>
                <div id="noCode" onclick="toggleCode()">
                    <span class="el-radio__input" >
                        <span class="el-radio__inner"></span>
                        <input type="radio" name="codeProma" aria-hidden="true" tabindex="-1" class="el-radio__original" value="1">
                    </span><span>优惠码</span>
                </div>
                <div id="hasCode" class="flex flex-center-v code-part">
                    <span class="el-radio__input is-checked">
                        <span class="el-radio__inner"></span>
                        <input type="radio" name="codeProma" aria-hidden="true" tabindex="-1" class="el-radio__original" value="2">
                    </span>
                    <span>优惠码</span>
                    <div class="el-input radioInput">
                        <input type="text" autocomplete="off" placeholder="请输入内容" class="el-input__inner" >
                    </div>
                    <button type="button" class="el-button el-button--default is-plain">
                        <span>确定</span>
                    </button>
                </div>
            </div>
            @endisset
            <div class="pay-list">
                <div class="font16 margin-b-30 pay-title">支付方式</div>
                <div class="flex flex-center-v weixinType">
                    <input class="margin-r-8" type="radio" aria-hidden="true" name="weixinType" checked="checked">
                    <img src="/img/weixin.svg" alt="微信支付">
                </div>
            </div>
            <div class="pay-list">
                <div class="flex flex-between">
                    <div class="left-desc">
                        <!-- <div class="font16 pay-title red-text"><i class="el-icon-warning-outline"></i>提示</div>
                        <p class="desc font14">· 购买内容提示 1</p>
                        <p class="desc font14">· 购买内容提示 2</p>
                        <p class="desc font14">· 购买内容提示 3</p>
                        <p class="desc font14">· 购买内容提示 4</p> -->
                    </div>
                    <div class="pay-last-part">
                        <div class="font16 flex flex-end-v margin-b-15">@isset ($useCoupon)<h4>商品总额</h4><span>¥{{ $goods->price }}</span>@endisset</div>
                        <div class="font16 flex flex-end-v"><h4>应付</h4><span class="fontSize22 hover-text">¥{{ $goods->price }}</span></div>
                        <button class="flex flex-center active-btn" id="dopay">立即支付</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

@section('scripts')
<script src="{{ mix('js/pages/pay.js') }}"></script>
<script>
    function toggleCode (){
        document.getElementById('noCode').style.display = "none"
        document.getElementById('hasCode').style.display = "block"
    }

    $('#dopay').click(function() {
        if ($('#activeAddressId').val() == '') {
            Notification({
                title: 'Warning',
                message: '请选择收货地址',
                type: 'warning'
            })
            return;
        }
        $.ajax({
            type: 'GET',
            url: '{{ route('pay.index') }}',
            data: {
                goods_id: {{ $goods->id }},
                promote: {{ $promote_user }},
                address_id: $('#activeAddressId').val(),
            },
            dataType: 'json',
            success: function(res) {
                if (res.code !== 200) {
                    alert('出错了，请联系管理员');
                    return;
                }
                @if ($isWeixin)
                WeixinJSBridge.invoke(
                    'getBrandWCPayRequest', res.data,
                    function(res) {
                        if (res.err_msg == "get_brand_wcpay_request:ok") {
                            location.href = '{{ route('pay.success') }}?pid={{ $goods->project_id }}'
                        }
                    }
                );
                @else
                location.href = res.data.payurl
                @endif
            }
        });
    });
</script>
@endsection
