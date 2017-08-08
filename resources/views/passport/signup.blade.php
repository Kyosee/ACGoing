@extends('layouts.default')
@section('req_js')
<script src="{{ mix('/js/passport.js') }}" charset="utf-8"></script>
@stop
@section('content')
    <div class="col-md-5 col-md-offset-2 passport-box">
        <div class="col-box">
            <div class="passport-title">
                <a class="active" href="{{ route('signup') }}">注册</a>
                <a href="{{ route('login') }}">登录</a>
            </div>
            <form method="POST" class="passport-form">
                <div class="form-group-lg">
                    <label for="email">邮箱：</label>
                    <input type="text" name="email" class="form-control" value="">
                </div>
                <div class="form-group-lg">
                    <label for="password">密码：</label>
                    <input type="password" name="password" class="form-control" value="">
                </div>
                <div class="form-group-lg">
                    <label for="password_confirmation">验证码：</label>
                    <div class="form-inline">
                        <input type="text" name="captcha" class="form-control inp-captcha pull-left" value="">
                        <img src="{{ route('passport.captcha', time()) }}" data-url="{{ route('passport.captcha') }}" class="captcha pull-right">
                    </div>
                    <div class="clearfix"> </div>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="is_agree" value="1">
                        我已同意 <a href="#">《ACGoing用户注册协议》</a>
                    </label>
                </div>
                <button type="submit" class="btn btn-success btn-lg full-width">注了个册</button>
                <div class="checkbox">
                    <a href="{{ route('login') }}">已有账户？前去登录</a>
                </div>
                {{ csrf_field()}}
            </form>
        </div>
    </div>
    <div class="col-md-3 passport-fast">
        <div class="col-box">
            <div class="passport-title">
                社交账号快速登录
            </div>
        </div>
    </div>
@stop
