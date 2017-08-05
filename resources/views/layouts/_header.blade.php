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
                    <li><a href="{{ route('home') }}" class="active">主页</a></li>
                    <li><a href="#">文章</a></li>
                    <li><a href="#">视频</a></li>
                    <li><a href="#">摄影</a></li>
                    <li><a href="#">关于我</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right nav-sign">
                    <li><a href="{{ route('signup') }}">注册</a></li>
                    <li><a href="{{ route('login') }}">登录</a></li>
                </ul>
            </nav>
        </div>
    </header>
