<footer class="footer @yield('is_position')">
    <div class="container">
        <div class="text-center">
            <ul class="footer-nav nav navbar-nav ">
                <li><a href="#">主页</a></li>
                <li><a href="#">资讯</a></li>
                <li><a href="#">经验</a></li>
                <li><a href="#">话题</a></li>
                <li><a href="#">问答</a></li>
            </ul>
            <p>Copyright (c) 2017 <a target="_blank" href="{{ route('home') }}">acgoing.com.</a> All Rights Reserved V 2.0.0   鲁ICP备15019286号-1<p>
            {{-- <p class="footer-link">相关链接：a<p> --}}
            <p><a href="{{ route('home') }}" class="logo">ACGoing</a></p>
        </div>
    </div>
</footer>
