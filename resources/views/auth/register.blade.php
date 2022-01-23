@extends('layouts.app')

@section('content')
<div class="container">
    <div class="cardLogin">
        <div class="card-body">
            <div class="card-tabs flex flex-center">
                <a href="/login" style="color: #999;"><div class="tab-new">登录</div></a>
                <div class="tab-tip"> · </div>
                <div class="tab-new tab-current">注册</div>
            </div>
            <form id="registerForm" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <input id="mobile" placeholder="手机号" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" required autofocus>
                        @if ($errors->has('mobile'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                @if (config('eetree.captcha.register'))
                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <div class="float-left" style="max-width:60%;" >
                            <input id="captcha" placeholder="图片校正码" type="text" class="captcha-input form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}" name="captcha" value="{{ old('captcha')  }}" required>
                            @if ($errors->has('captcha'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('captcha') }}</strong>
                                </span>
                            @endif
                        </div>
                        <img src="{{captcha_src()}}" class="float-right captcha-img" onclick="this.src='{{captcha_src()}}'+Math.random()">
                    </div>
                </div>
                @endif

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <div class="float-left" style="max-width:60%;">
                            <input id="verify_code" placeholder="手机验证码" type="text" class="form-control{{ $errors->has('verify_code') ? ' is-invalid' : '' }}" name="verify_code" required>
                            @if ($errors->has('verify_code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('verify_code') }}</strong>
                                </span>
                            @endif
                        </div>
                        <input class="float-right btn-send" id="sendSms" type="button" value="发送验证码">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <input id="name" type="text" placeholder="用户名" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <input id="nickname" type="text" placeholder="昵称" class="form-control{{ $errors->has('nickname') ? ' is-invalid' : '' }}" name="nickname" value="{{ old('nickname') }}" required>

                        @if ($errors->has('nickname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nickname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <input id="password" type="password" placeholder="密码" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="agreement" name="agreement" value="1" checked="checked">
                            <label class="form-check-label">
                                我已经阅读并同意相关<a target="_blank" href="{{ route('page.agreement') }}">服务条款</a>
                        </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn-submit">
                            注册
                        </button>
                    </div>
                </div>
            </form>
            <!-- <hr>
            <div class="row login-bottom">
                <div class="col-md-12">
                    <h5>使用第三方账号快速登录</h5>
                    <a class="login-item-tip qq-login" href="#" title="QQ登录">
                        <i class="fa fa-qq" aria-hidden="true"></i>
                    </a>
                    <a class="login-item-tip weixin-login" href="#" title="微信登录">
                        <i class="fa fa-weixin" aria-hidden="true"></i>
                    </a>
                    <p class="text-center">创建账号即视为已同意<a href="" target="">服务条款</a></p>
                </div>
            </div> -->
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ mix('js/validate.js') }}"></script>
<script>
jQuery.validator.addMethod("mobileCheck", function(value, element) {
    return this.optional(element) || /^1[0-9]{10}$/.test(value);
}, "手机号格式有误");
jQuery.validator.addMethod("nameCheck", function(value, element) {
    return this.optional(element) || /^[a-zA-Z][a-zA-Z0-9_\-]+$/.test(value);
}, "用户名只能由英数字、中划线、下划线组成");
$("#registerForm").validate({
    rules: {
        mobile: {
            required: true,
            mobileCheck: true,
        },
        name: {
            required: true,
            minlength: 3,
            maxlength: 30,
            nameCheck: true,
        },
        nickname: {
            required: true,
            minlength: 3,
            maxlength: 30,
        },
        password: {
            required: true,
            minlength: 8,
            maxlength: 64,
        },
        agreement: {
            required: true,
        }
    }
});
$('#sendSms').sms({
    //laravel csrf token
    token: "{{csrf_token()}}",
    //请求间隔时间
    interval: 60,
    captcha: {{ config('eetree.captcha.register') ? 1 : 0 }},
    //请求参数
    requestData : {
        //手机号
        mobile : function () {
            return $('#mobile').val();
        },
        captcha : function () {
            return $('#captcha').val();
        },
        tpl: 'register',
    }
});
</script>
@endsection
