@extends('layouts.default')

@section('title')
    {{@$title}}
@stop
@section('top')

<link rel="stylesheet" type="text/css" href="/css/swiper.min.css">
<script type="text/javascript" src="/js/common/swiper.min.js"></script>
 <style>
    body {
        background: #eee;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color:#000;
        margin: 0;
        padding: 0;
    }
    .swiper-container {
        width: 66%;
        height: 185px;
        margin: 13px auto;
    }
    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        width: 28% ;
        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        cursor: pointer;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }
    .append-buttons {
        text-align: center;
        margin-top: 20px;
    }
    .append-buttons a {
        display: inline-block;
        border: 1px solid #007aff;
        color: #007aff;
        text-decoration: none;
        padding: 4px 10px;
        border-radius: 4px;
        margin: 0 10px;
        font-size: 13px;
    }
    .menu-bar .right-part {
        margin-top: 4px;
    }
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

                    <p class="album-info">
                        <span class="album-count"> {{ $demand->file->count() }}张图片 </span>
                        &nbsp;<b>·</b>&nbsp;
                        <span class="like-count"><i>10</i>人关注</span>
                    </p>
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

</div>
@stop
@section('bottom')

@stop
