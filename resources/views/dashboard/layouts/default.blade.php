<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', '攻城大凉皮的小博客') - ACGoing</title>
        <link rel="stylesheet" href="{{ mix('/css/dashboard.css') }}">
        <link rel="stylesheet" href="{{ mix('/libs/semantic/semantic.min.css') }}">
        @yield('req_css')
        <script src="{{ mix('/js/dashboard.js') }}" charset="utf-8"></script>
        <script src="{{ mix('/libs/semantic/semantic.min.js') }}" charset="utf-8"></script>
        @yield('req_js')
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </head>
    <body>
        <div class="full">
            <div class="menu-box fl">
                <div class="ui vertical menu">
                    <div class="item">
                        <h2 class="ui header">
                            <i class="settings icon"></i>
                            <div class="content">控制面板 <div class="sub header">Manage your site</div></div>
                        </h2>
                    </div>
                    <div class="item">
                        <div class="header">用户管理</div>
                        <div class="menu">
                            <a class="item">Enterprise</a>
                            <a class="item">消费者</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="header">蜘蛛管理</div>
                        <div class="menu">
                            <a href="{{ route('spider_site_type') }}" class="item">网站类型</a>
                            <a href="{{ route('site') }}" class="item">网站规则</a>
                            <a class="item">爬虫任务</a>
                        </div>
                    </div>
                    <div class="item">
                        <a href="#" class="header">资讯管理</a>
                    </div>
                </div>
            </div>
            <div class="site-content fl" id="app">
                <h3 class="ui dividing header">@yield('section_title')</h3>
                @yield('content')
            </div>
        </div>
    </body>
</html>
