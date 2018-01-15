    <header class="navbar navbar-fixed-top navbar-inverse">
        <div class="container-fluid container">
            <a href="{{ route('home') }}" class="logo pull-left">ACGoing</a>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
    	    </div>
            <nav class="nav collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="{{ route('home') }}" @if(Request::is('home')) class="active" @endif>主页</a></li>
                    <li><a href="{{ route('news') }}" @if(Request::is('news')) class="active" @endif>资讯</a></li>
                    <li><a href="#">经验</a></li>
                    <li><a href="#">话题</a></li>
                    <li><a href="#">问答</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right nav-sign">
                    @if(Auth::user())
                        <li class="inline-block">
                            <a class="dropdown-toggl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->nickname }} <i class="fa fa-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('users.show', Auth::user()) }}">个人中心</a></li>
                                <li><a href="#">我的收藏</a></li>
                                <li><a href="{{ route('logout') }}">退出登录</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">登录</a></li>
                        <li><a href="{{ route('register') }}">注册</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>
