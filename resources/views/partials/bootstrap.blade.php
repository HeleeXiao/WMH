<div id="header" class="hts " style="left: 0px;">
    <div class="wrapper wrapper-996">
        <div class="menu-bar">
            <div class="left-part">
                {{--<a id="huaban" href="/">--}}

                {{--</a>--}}
                <a href="/{{config("app.version")}}">
                    <img id="huaban" src="/images/app/logo.png" alt="">
                </a>

                <a href="/discovery/" class="header-item active">发现</a>
                <a href="/all/" class="header-item ">最新</a>
                <div class="menu-nav">
                </div>
            </div>
            <div class="right-part">
                <div class="login-nav">
                    <a href="{{ url("/". config("app.version") ."/register") }}" rel="nofollow" class="register btn rbtn">
                        <span class="text"> 注册</span>
                    </a>
                    <a href="{{ url("/". config("app.version") ."/login") }}" rel="nofollow" class="login btn wbtn">
                        <span class="text"> 登录</span>
                    </a>
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