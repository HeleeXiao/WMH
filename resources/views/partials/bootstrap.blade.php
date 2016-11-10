<div id="header" class="hts " style="left: 0px;">
    <div class="wrapper wrapper-996">
        <div class="menu-bar">
            <div class="left-part">
                <a href="{{url("/".config("app.version"))}}">
                    <img id="huaban" src="/images/app/logo.png" alt="">
                </a>

                <a href="/discovery/" class="header-item active">发现</a>
                <a href="/all/" class="header-item ">最新</a>
                <div class="menu-nav">
                </div>
            </div>
            <div class="right-part">
                <div class="login-nav">
                    @if( ! Auth::check())
                        <a href="{{ url("/". config("app.version") ."/register") }}" rel="nofollow" class="register btn rbtn">
                            <span class="text"> 注册</span>
                        </a>
                        <a href="{{ url("/". config("app.version") ."/login") }}" rel="nofollow" class="login btn wbtn">
                            <span class="text"> 登录</span>
                        </a>
                    @else
                        <div id="nav_user"  onmouseover="$('.lanrenzhijia').show()">
                            <a href="/yanzhico/" class="nav-link dm-nav">
                                <img width="26" height="26" src="/images/user/default.jpg" >
                                <div class="arrow"></div>
                                <div class="num hidden">0</div>
                            </a>
                        </div>
                        {{ Auth::user()->name }}
                    @endif
                </div>
                <div class="lanrenzhijia" style="display: none" >
                    <ul>
                        <li class="on"><a href='javascript:void(0);'>用户中心</a></li>
                        <li><a href='javascript:void(0);'>账号设置</a></li>
                        <li><a href='javascript:void(0);'>我关注的</a></li>
                        <li><a href='{{ url("/". config("app.version") ."/logout") }}'>退出</a></li>
                    </ul>
                    <div class="hover"></div>
                </div>

            </div>
            <form id="search_form" method="get" action="/{{ config("app.version") }}/search/" class="searching-unit" data-regestered="regestered">
                <input id="query" type="text" size="27" name="q" autocomplete="off" placeholder="搜索你喜欢的" value="">
                <a href="#" onclick="return false;" class="go"></a>
            </form>
            <div class="search-hint">

            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        var Height = 40; //li的高度
        var pTop = 10; // .lanrenzhijia 的paddding-top的值
        $('.lanrenzhijia li').mouseover(function(){
            $(this).addClass('on').siblings().removeClass('on');
            var index = $(this).index();
            var distance = index*(Height+1)+pTop+'px'; //如果你的li有个border-bottom为1px高度的话，这里需要加1
            $('.lanrenzhijia .hover').stop().animate({top:distance},150); //默认动画时间为150毫秒，懒人们可根据需要修改
        });
    });
</script>
