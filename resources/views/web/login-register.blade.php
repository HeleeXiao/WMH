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
</script>
<script type="text/javascript" src="/js/CanvasParticles-master/canvas-particle.js"></script>
<div class="desk-front sign-flow clearfix sign-flow-simple">

    <div class="index-tab-navs">
        <div class="navs-slider" data-active-index="0">
            注册
        </div>
    </div>

    <div class="view view-signup selected" data-za-module="SignUpForm">
        <form class="zu-side-login-box" action="/register" id="sign-form-1" autocomplete="off" method="POST" novalidate="novalidate">
            <input type="password" hidden="">
            <input type="hidden" name="_xsrf" value="6bdf63dbe265c4e922cab1002f9a923b">
            <div class="group-inputs">

                {{ csrf_field() }}

                <div class="name input-wrapper">
                    <input required="" value="{{old("name")}}" type="text" name="name" aria-label="" placeholder="名称">

                </div>
                @if($errors->has("name"))
                    <div class="name input-wrapper" style="background: red">
                        {{ $errors->first("name") }}
                    </div>
                @endif
                <div class="email input-wrapper">

                    <input required="" type="text" value="{{old("phone")}}" class="account" name="phone" aria-label="" placeholder="手机号">

                </div>
                @if($errors->has("phone"))
                    <div class="name input-wrapper" style="background: red">
                        {{ $errors->first("phone") }}
                    </div>
                @endif
                <div class="input-wrapper">
                    <input required="" type="password" value="{{old("password")}}" name="password" aria-label="" placeholder="密码（不少于 6 位）" autocomplete="off">

                </div>
                @if($errors->has("password"))
                    <div class="name input-wrapper" style="background: red">
                        {{ $errors->first("password") }}
                    </div>
                @endif
                <div class="input-wrapper">
                    <input required="" type="text" name="text" aria-label="" placeholder="验证码" autocomplete="off">
                </div>
                <div class="Captcha input-wrapper" data-type="cn" data-za-module="Captcha">
                    <div class="Captcha-imageConatiner">

                        <img class="Captcha-image" alt="验证码" src="{{ captcha_src() }}" style="display: block;">
                    </div>
                </div>

            </div>
            <div class="button-wrapper command">
                <button class="sign-button submit" type="submit">注册</button>
            </div>
        </form>

        <p class="agreement-tip">点击「注册」按钮，即代表你同意<a href="/terms" target="_blank">《一心一易协议》</a></p>

    </div>
</div>
</body>
</html>