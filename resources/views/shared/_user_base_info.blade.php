<div class="col-box info">
    @auth
    <div class="info-top text-center">
        <a href="{{ route('users.show', Auth::user()) }}"><img class="info-avatar img-circle" src="https://avatars3.githubusercontent.com/u/5360841?v=3&amp;s=460" alt=""></a>
    </div>
    <div class="info-bottom">
        <div class="info-name text-center">
            {{ Auth::user()->nickname }}
        </div>
        <ul class="info-follow clearfix">
            <li>
                <a href="#">
                    <strong>520</strong>
                    <span>关注</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <strong>20w</strong>
                    <span>粉丝</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <strong>10</strong>
                    <span>话题</span>
                </a>
            </li>
        </ul>

        <div class="info-opt text-center clearfix">
        @if ( (!isset($user->id) ? Auth::user()->id : $user->id ) === Auth::user()->id)
            <div class="info-opt-edit">
                <a href="{{ route('users.edit', Auth::user()) }}" class="btn btn-success">修改个人资料</a>
            </div>
        @else
            <div class="pull-left">
                <a href="#" class="btn btn-follow"><i class="fa fa-plus"></i> 关注TA</a>
            </div>
            <div class="pull-left">
                <a href="#" class="btn btn-default"><i class="fa fa-comment"></i> 发私信</a>
            </div>
        @endcan
        </div>

        <ul class="info-contact">
            <li class="github"><a href="#"><i class="fa fa-github"></i> GitHub</a></li>
            <li class="wechat"><a href="#"><i class="fa fa-wechat"></i> Wechat</a></li>
            <li class="weibo"><a href="#"><i class="fa fa-weibo"></i> Weibo</a></li>
            <li class="qq"><a href="#"><i class="fa fa-qq"></i> QQ</a></li>
        </ul>
    </div>
    @endauth
</div>
