@extends('layouts.default')

@section('title')
    {{@$title}}
@stop
@section('top')
@stop
@section('content')
<!-- {{dump($demand->file->toArray())}} -->
<div class="container" style="margin:0 auto;padding: 48px 0 0 0;width: 100%;">
    <div class="album-header">
        <img class="album-header-bg ohmyblured" src="/images/banner/20161108105946_nxsJL.thumb.1200_280_g.jpeg" height="280">
        <div class="album-header-bg-mask"></div>
        <table class="album-header-info tc">
            <tbody>
            <tr>
  				      <div class="outer">
                  <div class="inner">

                  </div>
                </div>
              <!--   <td>
                  <h1 class="album-title">{{ $demand->title }}</h1>
                  <p class="album-info">
                      <span class="album-count">{{ $demand->file->count() }}张图片</span>
                      &nbsp;<b>·</b>&nbsp;<span class="like-count"><i>10</i>人关注</span></p>
                  <p class="album-desc">
                  </p>
              </td> -->
            </tr>
            </tbody>
        </table>
        <div class="album-header-attr-mask"></div>
        <div class="album-header-attr tc">
            <a target="_blank" class="album-account" href="/people/?user_id=155429">
                <img class="avatar" src="{{ url($demand->user->content->head->path) }}">
                <span class="name">{{ $demand->user->name }}</span>
            </a>
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
