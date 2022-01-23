@extends('layouts.app')

@section('content')
<div class="container">
    <div class="cardLogin">
        <div class="card-body">
            <div class="card-tabs flex flex-center">
                <div class="tab-new">重置密码</div>
            </div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.mobile') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <input  placeholder="手机号" id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" required>
                        @if ($errors->has('mobile'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                @if (config('eetree.captcha.forget'))
                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <input id="captcha" placeholder="图片检验码" type="text" style="max-width:60%;"  class="float-left form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}" name="captcha" value="{{ old('captcha')  }}" required>
                        <img src="{{captcha_src()}}" class="float-right captcha-img" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()">
                        @if ($errors->has('captcha'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('captcha') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                @endif
                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <input id="verify_code" style="max-width:60%;" placeholder="手机验证码"  type="text" class="float-left form-control{{ $errors->has('verify_code') ? ' is-invalid' : '' }}" name="verify_code" required>
                        <input class="btn-send float-right" id="sendSms" type="button" value="发送验证码">
                        @if ($errors->has('verify_code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('verify_code') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit"  class="btn-submit">
                            下一步
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$('#sendSms').sms({
    //laravel csrf token
    token       : "{{csrf_token()}}",
    //请求间隔时间
    interval    : 60,
    captcha: {{ config('eetree.captcha.forget') ? 1 : 0 }},
    //请求参数
    requestData : {
        //手机号
        mobile : function () {
            return $('#mobile').val();
        },
        captcha : function () {
            return $('#captcha').val();
        },
        tpl: 'forget',
    }
});
</script>
@endsection
