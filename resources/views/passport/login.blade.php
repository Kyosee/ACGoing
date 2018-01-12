@extends('layouts.default')
@section('title', '用户登录')
@section('req_js')
<script src="{{ mix('/js/passport.js') }}" charset="utf-8"></script>
@stop
@section('content')
    <div class="col-md-5 col-md-offset-2 passport-box">
        <div class="col-box">
            <div class="passport-title">
                <a href="{{ route('register') }}">注册</a>
                <a class="active" href="{{ route('login') }}">登录</a>
            </div>
            <form method="POST" action="" class="passport-form">
                <div class="form-group-lg">
                    <label for="email">邮箱：</label>
                    <input type="text" name="email" class="form-control" value="">
                </div>
                <div class="form-group-lg">
                    <label for="password">密码：</label>
                    <input type="password" name="password" class="form-control" value="">
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" value="1">
                        记住我
                    </label>
                </div>
                <button type="submit" class="btn btn-success btn-lg full-width">登了个录</button>
                <div class="checkbox">
                    <a class="pull-left" href="{{ route('register') }}">妹有账号？前去注册</a>
                    <a class="pull-right" href="{{ route('forget') }}">忘记密码？</a>
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
