<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="/images/app/{{ Config::get('app.icon') }}" type="image/x-icon">
    <link rel="icon" href="/images/app/{{ Config::get('app.icon') }}" type="image/x-icon">
    <title>{{ Config::get('app.name') }} - {{ @$title  }}</title>
@include('partials.header')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/login-register.css') }}">
    <script src="{{ asset('/js/jquery.js?t=1476958143') }}"></script>
    <script src="{{ asset('/layer/layer.js?v=2.4') }}"></script>
    <script src="{{ asset('/js/common/vilidata.js') }}"></script>
</head>
<body>
<script type="text/javascript">
    window.onload = function(){
        var config = {
            vx: 4,
            vy:  4,
            height: 2,
            width: 2,
            count: 100,
            color: "121, 162, 185",
            stroke: "100,200,180",
            dist: 6000,
            e_dist: 20000,
            max_conn: 10
        }
        CanvasParticle(config);
    }
    @if( Session::has('pageMsg') )
        layer.alert('{{Session::get('pageMsg')}}', {
            icon: 5,
            shadeClose: true,
            title: "操作失败"
        });
    @endif
</script>
<script type="text/javascript" src="/js/CanvasParticles-master/canvas-particle.js"></script>

@if(@$page == "register")
<div class="desk-front sign-flow clearfix sign-flow-simple">

    <div class="index-tab-navs">
        <div class="navs-slider" data-active-index="0">
            注册
        </div>
    </div>

    <div class="view view-signup selected" data-za-module="SignUpForm">
        <form class="zu-side-login-box" action="/{{config("app.version")}}/register" id="sign-form-1" autocomplete="off" method="POST" novalidate="novalidate">
            <input type="password" hidden="">
            <input type="hidden" name="_xsrf" value="6bdf63dbe265c4e922cab1002f9a923b">
            <div class="group-inputs">

                {{ csrf_field() }}

                <div class="name input-wrapper">
                    <input id="RegName" required="" value="{{old("name")}}" type="text" name="name" aria-label="" placeholder="名称">

                </div>
                @if($errors->has("name"))
                    <script>
                        layer.tips("{{ $errors->first("name") }}",$("#RegName"), {
                            tips: [2, '#e53e49'],
                            tipsMore: true
                        });
                    </script>
                @endif
                <div class="email input-wrapper">

                    <input id="RegPhone" required="" type="text" value="{{old("phone")}}" class="account" name="phone" aria-label="" placeholder="手机号">

                </div>
                @if($errors->has("phone"))
                    <script>
                        var RgIndex = layer.tips("{{ $errors->first("phone") }}",$("#RegPhone"), {
                            tips: [2, '#e53e49'],
                            tipsMore: true
                        });
                    </script>
                @endif
                <div class="input-wrapper">
                    <input id="RegPassword" required="" type="password" value="{{old("password")}}" name="password" aria-label="" placeholder="密码（不少于 6 位）" autocomplete="off">

                </div>
                @if($errors->has("password"))
                    <script>
                        RgIndex = layer.tips("{{ $errors->first("password") }}",$("#RegPassword"), {
                            tips: [2, '#e53e49'],
                            tipsMore: true
                        });
                    </script>
                @endif
                <div class="input-wrapper" id="RegCaptcha">
                    <input
                           required="" type="text"
                           name="captcha"
                           aria-label=""
                           placeholder="验证码"
                           autocomplete="off"
                           style="width: 50%;float: left;border: none">
                    <div class="Captcha-imageConatiner" >
                        <img id="Captcha" class="Captcha-image"
                             alt="验证码"
                             src="{{ captcha_src() }}"
                             style="display: block;width: 50%;height: 4.1em;cursor:pointer">
                    </div>
                </div>
                @if($errors->has("captcha"))
                    <script>
                        RgIndex = layer.tips("{{ $errors->first("captcha") }}",$("#RegCaptcha"), {
                            tips: [2, '#e53e49'],
                            tipsMore: true
                        });
                    </script>
                @endif

            </div>
            <div class="button-wrapper command">
                <button class="sign-button submit" type="submit">注册</button>
            </div>
        </form>

        <p class="agreement-tip">点击「注册」按钮，即代表你同意<a href="/terms" target="_blank">《{{config("app.name")}} 协议》</a></p>

    </div>
</div>
@endif
<!--BEGIN LOGIN -->
@if(@$page == "login")
<div class="desk-front sign-flow clearfix sign-flow-simple">

    <div class="index-tab-navs">
        <div class="navs-slider" data-active-index="0">
            登录
        </div>
    </div>

    <div class="view view-signup selected" data-za-module="SignUpForm">
        <form class="zu-side-login-box" action="/{{config("app.version")}}/login" id="sign-form-1" autocomplete="off" method="POST" novalidate="novalidate">
            <input type="password" hidden="">
            <input type="hidden" name="_xsrf" value="6bdf63dbe265c4e922cab1002f9a923b">
            <div class="group-inputs">

                {{ csrf_field() }}

                <div class="name input-wrapper">
                    <input id="RegName" required="" value="{{old("name")}}" type="text" name="name" aria-label="" placeholder="名称、电话、邮箱">

                </div>
                @if($errors->has("name"))
                    <script>
                        layer.tips("{{ $errors->first("name") }}",$("#RegName"), {
                            tips: [2, '#e53e49'],
                            tipsMore: true
                        });
                    </script>
                @endif

                <div class="input-wrapper">
                    <input id="RegPassword" required="" type="password" value="{{old("password")}}" name="password" aria-label="" placeholder="密码" autocomplete="off">

                </div>
                @if($errors->has("password"))
                    <script>
                        RgIndex = layer.tips("{{ $errors->first("password") }}",$("#RegPassword"), {
                            tips: [2, '#e53e49'],
                            tipsMore: true
                        });
                    </script>
                @endif

                @if(@$captcha)
                    <div class="input-wrapper" id="RegCaptcha">
                        <input
                                required="" type="text"
                                name="captcha"
                                aria-label=""
                                placeholder="验证码"
                                autocomplete="off"
                                style="width: 50%;float: left;border: none">
                        <div class="Captcha-imageConatiner" >
                            <img id="Captcha" class="Captcha-image"
                                 alt="验证码"
                                 src="{{ captcha_src() }}"
                                 style="display: block;width: 50%;height: 4.1em;cursor:pointer">
                        </div>
                    </div>
                @endif
                @if(@$captcha)
                    @if($errors->has("captcha"))
                        <script>
                            RgIndex = layer.tips("{{ $errors->first("captcha") }}",$("#RegCaptcha"), {
                                tips: [2, '#e53e49'],
                                tipsMore: true
                            });
                        </script>
                    @endif
                @endif

                <div class="input-wrapper" style="height: 6em;">
                    <div class="Captcha-imageConatiner" >
                        <img class="Captcha-image"
                             alt=""
                             src="/images/app/login_bottom.jpg"
                             style="display: block;width: 100%;height: 6em;">
                    </div>
                </div>

            </div>
            <div class="button-wrapper command">
                <button class="sign-button submit" type="submit">登录</button>
            </div>
        </form>

    </div>

</div>
@endif
<!--BEGEND LOGIN -->


</body>
</html>
<script>
    $("#Captcha").on("click",function(){
       $.get("/api/captcha",function(s){
           if(s.status == 200)
           {
                $("#Captcha").attr("src", s.result.src);
           }
       })
    });
</script>