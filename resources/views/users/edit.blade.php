@extends('layouts.default')
@section('title', '更新个人资料')

@section('content')
    @include('users._ucenter_left_menu')

    <div class="col-md-9">
        <div class="col-box">
            <div class="panel-body">
                <div class="page-header">
                    <span class="h4"><small><a class="green" href="{{ route('users.show', $user) }}">个人中心</a> / 修改个人资料</small></span>
                </div>
            </div>
        </div>
    </div>
@stop
