@extends('layouts.default')

@section('title')
    {{@$title}}
@stop
@section('top')

<link rel="stylesheet" type="text/css" href="/css/swiper.min.css">
<script type="text/javascript" src="/js/common/swiper.min.js"></script>
 <style>

    </style>
   <script>
   $(function(){
          var appendNumber = 6;
          var prependNumber = 1;
          var swiper = new Swiper('.swiper-container', {
              pagination: '.swiper-pagination',
              nextButton: '.swiper-button-next',
              prevButton: '.swiper-button-prev',
              slidesPerView: 3,
              centeredSlides: true,
              paginationClickable: true,
              spaceBetween: 30,
              loop:false,
              speed:500,
              autoplay:3000
          });
           layer.photos({
               photos: '#layer-p',shift: 5
           });
   })
</script>
@stop
@section('content')
<div class="container" style="margin:0 auto;padding: 48px 0 0 0;width: 100%;">
    <div class="album-header">
        <img class="album-header-bg ohmyblured" src="{{url("/images/banner/20161108105946_nxsJL.thumb.1200_280_g.jpeg")}}" height="280">
        <div class="album-header-bg-mask"></div>
        <table class="album-header-info tc">
            <tbody>
            <tr>
                <div class="swiper-container">
                    <div class="swiper-wrapper" id="layer-p">
                    @foreach( $demand->file as $fk=>$file )
                        <div class="swiper-slide"><img layer-pid="{{$fk+1}}"
                           layer-src="{{ $file->path }}"
                           src="{{ $file->path }}" width="100%" height="185"></div>
                    @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <td>

                    {{--<p class="album-info">--}}
                        {{--<span class="album-count"> {{ $demand->file->count() }}张图片 </span>--}}
                        {{--&nbsp;<b>·</b>&nbsp;--}}
                        {{--<span class="like-count"><i>10</i>人关注</span>--}}
                    {{--</p>--}}
                    <p class="album-desc"></p>
                </td>
            </tr>

    <!--             <td>
        <h1 class="album-title">{{ $demand->title }}</h1>
        <p class="album-info">
            <span class="album-count">{{ $demand->file->count() }}张图片</span>
            &nbsp;<b>·</b>&nbsp;<span class="like-count"><i>{{ $demand->follow->count() }}</i>人关注</span></p>
        <p class="album-desc">
        </p>
    </td>
                </tr> -->

            </tbody>
        </table>
        <div class="album-header-attr-mask"></div>
        <div class="album-header-attr tc">

            <a target="_blank" class="album-account" href="{{url("buddy/".$demand->user->id)}}">
                <img class="avatar" src="{{ url($demand->user->content->head->path) }}">
                <span class="name">{{ $demand->user->name }}</span>
            </a>
            <span class="album-title">{{ $demand->title }} </span>
            <div class="album-incoun">
                <p class="album-info">
                  <span class="album-count"> {{ $demand->file->count() }}张图片 </span>
                  &nbsp;<b>·</b>&nbsp;
                  <span class="like-count"><i>10</i>人关注</span>
                </p>

            </div>

            <div class="album-action dib">
                <a title="收藏" class="albumcollectbtn" href="javascript:;" ><i></i><span>收藏</span></a>
                <a title="赞" class="albumlikebtn "  href="javascript:;"><i></i><span>赞</span></a>

                <div id="album-share" class="album-share" href="javascript:;">
                    <i></i>
                </div>
            </div>
        </div>
        <div class="album-header-mask dn"></div>
    </div>
    <div class="info-center discuss">
        <div class="description">
            {{ $demand->description }}
        </div>
        <ul>
            @foreach($demand->discus as $dis)
                <li>
                    <a class="avatar" href="{{url("buddy/".$dis->user_id)}}">
                        <img src="{{ url($dis->user->content->head->path) }}" width="36" height="36">
                    </a>
                    <div class="userinfo">
                        <a class="name" href="{{url("buddy/".$dis->user_id)}}" title="{{ $dis->user->name }}">
                            {{ $dis->user->name }}
                        </a>
                        <i class="uptime">{{ \Carbon\Carbon::parse($dis->created_at)->format('m月d日 h:i') }}</i>
                        <div class="userinfo-action">
                            <span>{{ $dis->content }}</span>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

    </div>

    <div id="discus-form">
        <form class="layui-form" action="">
            <div class="layui-form-item layui-form-text">
                <div class="layui-input-block"  style="margin-left: 0;">
                    <textarea style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif;color: #E03C5A;border-top:none"
                              name="discus" placeholder="我也来评论一句" class="layui-textarea"></textarea>
                </div>
            </div>
            {{ csrf_field() }}
            {!! Form::hidden("user_id",Auth::check() ? Auth::user()->id : 0) !!}
            {!! Form::hidden("demand_id",$demand_id) !!}
            <div class="layui-form-item">
                <div class="layui-input-block" style="margin-left: 2px;">
                    @if(Auth::check())
                        <button class="layui-btn" lay-submit lay-filter="formDiscus">立即提交</button>
                    @else
                        <button class="layui-btn"
                            onclick="layer.confirm('登录了才能评论，现在立刻去登录吧？', {
                              btn: ['现在就去','不评论了'] //按钮
                            }, function(){
                              window.location.href='/{{config("app.version")."login"}}';
                            }, function(){

                            });return false;"
                            lay-submit >立即提交</button>
                    @endif
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
@section('bottom')
    <script>
        layui.use('form', function(){
            var form = layui.form();

            //监听提交评论
            form.on('submit(formDiscus)', function(data){
//                layer.msg(JSON.stringify(data.field));return false;
                if( $(".layui-textarea").val() == "" )
                {
                    layer.alert("请填写你要评论的话", {
                        icon: 5,
                        shadeClose: true,
                        title: "错误"
                    });
                    return false;
                }
                var index = layer.load();
                $.get(
                        "{{ route("demand.postSubmitDiscus") }}",
                        data.field,
                        function(res){
                            layer.close(index);
                            if(res.status !== 200 )
                            {
                                layer.alert(res.message, {
                                    icon: 2,
                                    shadeClose: true,
                                    title: "错误"
                                });
                                return false;
                            }
                            var html = '\<li>'+
                                            '\<a class="avatar" href="/buddy/'+ res.result.user_id +'">'+
                                                '\<img src="{{(Auth::check() ? Auth::user()->content[0]->head->path : '')}}" width="36" height="36">'+
                                            '\</a>'+
                                            '\<div class="userinfo">'+
                                                '\<a class="name" href="{{url("buddy/". (Auth::check() ? Auth::user()->id : 0) )}}" title="{{ (Auth::check() ? Auth::user()->name : '') }}">'+
                                                        "{{ Auth::check() ? Auth::user()->name : '' }}"+
                                                '\</a>'+
                                                '\<i class="uptime">'+ res.result.created_at +'\</i>'+
                                                '\<div class="userinfo-action">'+
                                                    '\<span>'+ res.result.content +'</span>'+
                                                '\</div>'+
                                            '\</div>'+
                                        '\</li>';
                                $(".discuss ul").prepend(html);
                            layer.msg("评论成功");
                            return false;
                        }
                );
                return false;
            });
        });
    </script>
@stop
