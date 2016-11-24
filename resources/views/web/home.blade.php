@extends('layouts.default')

@section('title')
    {{@$title}}
@stop

@section('top')
@stop

@section('content')

    <div class="container" style="margin:0 auto;padding: 48px 0 0 0;width: 100%;">
        <div class="row clearfix" style="margin:0 auto;padding: 0 0 0 0;width: 100%">
            <div class="col-md-12 column" style="margin:0 auto;padding: 0 0 0 0;width: 100%">
                <div class="carousel slide" id="carousel-867577">
                    <ol class="carousel-indicators">
                        @foreach($banner as $key => $image)
                            <li data-slide-to="{{$key}}" data-target="#carousel-867577" @if($key==0) class="active" @endif>
                            </li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                    @foreach($banner as $key => $image)
                        <div class="item @if($key==0) active @endif">
                            <img alt="" src="{{url($image->path)}}" />
                            <div class="carousel-caption">
                                <h4>
                                    {{--First Thumbnail label--}}
                                </h4>
                                <p>
                                    {{--Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.--}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                    </div> <a class="left carousel-control" href="#carousel-867577" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#carousel-867577" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </div>
        </div>
    </div>

    <div class="recommend-line"><a>为您推荐</a></div>

    <div id="recommend_container" class="recommend-container" style="margin:0 auto;padding: 0 0 0 0;width: 92.8%;">
            @foreach($demands as $key => $demand)
                @if( ABS(( $key+1) % 3 ) == 1 )
                    <div class="demand recommend-hidebox pl-right">
                        <div class="recommend-imgbox recommend-box">
                            <a href="{{url("s/show/".$demand->id)}}">
                                <img lay-src="{{url($demand->cover->path)}}"
                                     data-baiduimageplus-ignore="1">
                            </a>
                        </div>
                        <div class="recommend-infobox board recommend-box big">
                            <div class="recommend-data board">
                            </div>
                            <h2>
                                <a href="{{url("s/show/".$demand->id)}}">
                                    {{ $demand->title }}
                                </a>
                            </h2>
                            <p>
                                <span>
                                    121 赞许
                                </span>
                                <span>
                                    {{ $demand->discus->count() }} 评论
                                </span>
                            </p>
                            <span>
                                来自
                                <a href="{{url("buddy/".$demand->user->id)}}" rel="nofollow">
                                    {{ @$demand->user->name }}
                                </a>
                            </span>
                            <div class="info-tra-left big">
                            </div>
                        </div>
                    </div>
                @elseif( ABS(( $key+1) % 3 ) == 2 )
                    <div class="demand recommend-box">
                    <div class="recommend-infobox board small">
                        <div class="recommend-data board">
                        </div>
                        <h2>
                            <a href="{{url("s/show/".$demand->id)}}">
                                {{ $demand->title }}
                            </a>
                        </h2>
                        <p>
                        <span>
                            121 赞许
                        </span>
                        <span>
                            {{ $demand->discus->count() }} 评论
                        </span>
                        </p>
                    <span>
                        来自
                        <a href="{{url("buddy/".@$demand->user->id)}}" rel="nofollow">
                            {{ @$demand->user->name }}
                        </a>
                    </span>
                    </div>
                    {{--<div class="info-tra-left">--}}
                    {{--</div>--}}
                    <div class="recommend-infobox board small pl-right">
                        <div class="recommend-data board">
                        </div>
                        <h2>
                            <a href="{{url("s/show/".$demand->id)}}">
                                {{ $demand->name }}
                            </a>
                        </h2>
                        <p>
                        </p>
                    </div>
                    {{--<div class="info-tra-right">--}}
                    {{--</div>--}}
                </div>
                @elseif( ABS(( $key+1) % 3 ) == 0 )
                    <div class="demand recommend-imgbox recommend-box">
                        <a href="{{url("s/show/".$demand->id)}}">
                            <img lay-src="{{url($demand->cover->path)}}">
                        </a>
                    </div>
                @endif
            @endforeach
    </div>

    </div>

    {{--<div class="get-more-line"><a>加载更多</a></div>--}}


@stop
@section('bottom')
    <script>
        $(function(){
            layui.use('flow', function(){
                var flow = layui.flow;
                flow.lazyimg();
            });
            layui.use('flow', function(){
                var $ = layui.jquery;
                var flow = layui.flow;
                flow.load({
                    elem: '#recommend_container'
                    ,done: function(page, next){
                        var lis = [];
                        var html;
                        $.get('{{ route("demand.getHomeDataJson") }}?page='+page, function(res){
                            layui.each(res, function(index, item){
                                if( Math.abs(( index+1) % 3 ) == 1 ) {
                                    html = '\<div class="demand recommend-hidebox pl-right" >'+
                                                '\<div class="recommend-imgbox recommend-box" >'+
                                                    '<a href="/s/show/'+item.id+'" >'+
                                                        '<img lay-src="'+item.cover.path+'">'+
                                                    '<\/a>'+
                                                '<\/div>'+
                                                '\<div class="recommend-infobox board recommend-box big">'+
                                                    '\<div class="recommend-data board"> <\/div>'+
                                                    '\<h2>'+
                                                        '<a href="/s/show/'+item.id+'" >'+ item.name + '<\/a>'+
                                                    '<\/h2>'+
                                                    '\<p>'+
                                                        '\<span> 121赞许 <\/span>'+
                                                        '\<span>'+item.discus.length+'评论<\/span>'+
                                                    '<\/p>'+
                                                    '\<span> 来自'+
                                                        '<a href="/buddy/"'+item.user.id+'" rel="nofollow">'+
                                                            item.user.name+
                                                        '<\/a>'+
                                                    '<\/span >'+
                                                '\<div class="info-tra-left big" >'+
                                                '<\/div>'+
                                        '<\/div>'+
                                    '<\/div>';

                                }else if(Math.abs(( index + 1) % 3) == 2) {

                                    html = '\<div class="demand recommend-box">' +
                                                '\<div class="recommend-infobox board small">' +
                                                    '\<div class="recommend-data board">' +
                                                    '<\/div>' +
                                                    '\<h2>' +
                                                        '<a href ="/s/show/' + item.id + '">' +
                                                            item.name +
                                                        '<\/a>' +
                                                    '<\/h2>' +
                                                    '\<p>' +
                                                        '\<span> 121 赞许<\/span>' +
                                                        '\<span>' + item.discus.length + '评论<\/span>' +
                                                    '\</p>' +
                                                    '\<span> 来自' +
                                                        '<a href="/buddy/"' + item.user.id + '" rel="nofollow">' +
                                                            item.user.name +
                                                        '<\/a>' +
                                                    '<\/span >' +
                                                '\</div>' +
                                                '\<div class="info-tra-left" >' +
                                                '\</div>' +
                                                '\<div class="recommend-infobox board small pl-right" >' +
                                                    '\<div class="recommend-data board" >' +
                                                    '\</div>' +
                                                    '\<h2>' +
                                                        '<a href="/s/show/' + item.id + '" >' +
                                                            item.name +
                                                        '\</a>' +
                                                    '\</h2 >' +
                                                    '\<p >' +
                                                    '\</p >' +
                                                '\</div >' +
                                                '\<div class="info-tra-right" >' +
                                                '\</div >' +
                                            '\</div >' ;
                                }else if(Math.abs(( index + 1) % 3) == 0)
                                {
                                    html = '\<div class="demand recommend-imgbox recommend-box">'+
                                                '<a href="/s/show/' + item.id + '">'+
                                                    '<img lay-src="'+item.cover.path+'" >'+
                                                '\</a>'+
                                            '\</div>';
                                }
                                lis.push(html);
                            });
                            //执行下一页渲染，如果不存在数据，则告诉flow已经没有更多
                            next(lis.join(''), (res.length > 0) ? true : false );
//                            next(lis.join(''), res.data.length === 0);
                        });
                    }
                });
            });
        });

    </script>
@stop

