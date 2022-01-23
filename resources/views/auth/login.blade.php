@extends('layouts.app')

@section('content')
<div class="container">
    <div class="cardLogin">
        <div class="card-body">
            <div class="card-tabs flex flex-center">
                <div class="tab-new tab-current">登录</div>
                <div class="tab-tip"> · </div>
                <a href="/register" style="color: #999;"><div class="tab-new">注册</div></a>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <input id="account" placeholder="用户名/手机号"    type="account" class="form-control{{ $errors->has('account') ? ' is-invalid' : '' }}" name="account" value="{{ old('account') }}" required autofocus >

                        @if ($errors->has('account'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('account') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <input id="password" placeholder="密码"  type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-3 offset-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                记住密码
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3 flex flex-end">
                        @if (Route::has('password.mobile'))
                            <a class="btn-link" href="{{ route('password.mobile') }}">
                                忘记密码
                            </a>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn-submit">
                            登录
                        </button>
                    </div>
                </div>
            </form>
            <!-- <hr>
            <div class="row login-bottom">
                <div class="col-md-12">
                    <h5>使用第三方账号快速登录</h5>
                    <a class="login-item-tip qq-login" href="{{ route('auth.loginQQ') }}" title="QQ登录">
                        <i class="fa fa-qq" aria-hidden="true"></i>
                    </a>
                    <a class="login-item-tip weixin-login" href="{{ route('auth.loginWx') }}" title="微信登录">
                        <i class="fa fa-weixin" aria-hidden="true"></i>
                    </a>
                </div>
            </div> -->
        </div>
    </div>
</div>
@endsection
