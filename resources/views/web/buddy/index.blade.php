@extends('layouts.default')

@section('title')
    {{@$title}}
@stop

@section('top')
    <style>
        .layui-nav-item a span{
            color: #150d0d;
            font-size: 18px;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        }
        .section ul li{
            width:12rem;
            text-align: center;
        }
    </style>
@stop

@section('content')

    <div class="buddy user-content-header" >
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <a class="people-head" href="javascript:void(0);">
                        <img @if($IS_ME === true) class="buddy-img" @endif src="{{ $buddy->content->head->path }}">
                    </a>
                </td>
            </tr>
            <tr>
                <td>
                    <h2 class="buddy-name">{{ $buddy->name }}</h2>
                    <span class="description">
                        {{ $buddy->content->description }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>

                    @if($IS_ME === true)
                        <span class="buddy-tag cursor" data-nav="follow_demand">收藏
                    @else
                        <span class="buddy-tag">收藏
                    @endif
                        <b class="buddy-tag-collection">6 </b>
                    </span>
                    <span class="buddy-tag cursor" data-nav="follow_user">关注
                        <b class="buddy-tag-follow">33 </b>
                    </span>
                    <span class="buddy-tag cursor" data-nav="fans">粉丝
                        <b class="buddy-tag-fans"> 12</b>
                    </span>
                    @if($IS_ME === true)
                        <span class="buddy-tag cursor" data-nav="follow_demand" >交易
                    @else
                        <span class="buddy-tag ">交易
                    @endif
                        <b class="buddy-tag-transaction"> </b>
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    @if($IS_ME === true)
                        <a title="收藏" class="lay-btn" href="javascript:;">
                            <i class="layui-icon">&#xe642;</i><span>编辑</span>
                        </a>
                    @else
                        @if( ! in_array($buddy->id,$authFollowBuddy) )
                            <a title="收藏" class="flow-btn" href="javascript:;">
                                <i class="i"></i><span>关注</span>
                            </a>
                        @else
                            <a title="收藏" class="flow-btn" href="javascript:;">
                                <i class="layui-icon" style="margin-left: -7px;">&#xe618;</i><span>已关注</span>
                            </a>
                        @endif
                    @endif
                </td>
            </tr>
        </table>
        <div class="table-right">
            <img src="/images/banner/20161108105946_nxsJL.thumb.1200_280_g.jpeg" alt="封面">
        </div>
    </div>
    <div class="section">
        <div class="layui-tab">
            <ul class="layui-tab-title">

                @foreach($tab as $value)
                    <li id="{{ $value['name'] }}" @if($value['active'])class="layui-this"@endif>{{ $value['title'] }}</li>
                @endforeach
            </ul>
            <div class="layui-tab-content">

                @foreach($tab as $value)
                    <div class="layui-tab-item @if($value['active']) layui-show @endif" style="min-height: 200px">
                        @if(str_is( 'follow_user', $value['name']) )
                            <!-- 代码 开始 -->
                            <div class="case-content">
                                @foreach($buddy->follow as $value)
                                    @if($value->idol != null)
                                        <div class="case-item">
                                            <div class="ih-item circle effect1">
                                                <a href="{{ url('buddy/'.$value->idol->id) }}" target="_blank">
                                                    <div class="spinner"></div>
                                                    <div class="img"><img src="{{url($value->idol->content->head->path)}}" alt="懒人图库"></div>
                                                    <div class="info">
                                                        <div class="info-back">
                                                            <p>{{ str_limit($value->idol->name,15) }}</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <!-- 代码 结束 -->
                        @endif
                        @if(str_is( 'fans', $value['name'] ))
                                <div class="case-content">
                                    @foreach($buddy->fans as $value)
                                            <div class="case-item">
                                                <div class="ih-item circle effect1">
                                                    <a href="{{ url('buddy/'.$value->user->id) }}" target="_blank">
                                                        <div class="spinner"></div>
                                                        <div class="img"><img src="{{url($value->user->content->head->path)}}" alt="懒人图库"></div>
                                                        <div class="info">
                                                            <div class="info-back">
                                                                <p>{{ str_limit($value->user->name,15) }}</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                    @endforeach
                                </div>
                        @endif
                        @if(str_is( 'browses', $value['name'] ))
                            @foreach($buddy->browse as $key => $p_demand)
                                @if( ABS(( $key+1) % 3 ) == 1 )
                                    <div class="recommend-hidebox pl-right">
                                        <div class="recommend-imgbox recommend-box">
                                            <a href="{{url("s/show/".$p_demand->demand->id)}}">
                                                <img lay-src="{{url($p_demand->demand->cover->path)}}"
                                                     data-baiduimageplus-ignore="1">
                                            </a>
                                        </div>
                                        <div class="recommend-infobox board recommend-box big">
                                            <div class="recommend-data board">
                                            </div>
                                            <h2>
                                                <a href="{{url("s/show/".$p_demand->demand->id)}}">
                                                    {{ $p_demand->demand->title }}
                                                </a>
                                            </h2>
                                            <p>
                                                <span>
                                                    121 赞许
                                                </span>
                                                <span>
                                                    {{ $p_demand->demand->discus->count() }} 评论
                                                </span>
                                                                    </p>
                                            <span>
                                                来自
                                                <a href="{{url("buddy/".$p_demand->demand->user->id)}}" rel="nofollow">
                                                    {{ @$p_demand->demand->user->name }}
                                                </a>
                                            </span>
                                            <div class="info-tra-left big">
                                            </div>
                                        </div>
                                    </div>
                                @elseif( ABS(( $key+1) % 3 ) == 2 )
                                    <div class="recommend-box">
                                        <div class="recommend-infobox board small">
                                            <div class="recommend-data board">
                                            </div>
                                            <h2>
                                                <a href="{{url("s/show/".$p_demand->demand->id)}}">
                                                    {{ $p_demand->demand->title }}
                                                </a>
                                            </h2>
                                            <p>
                                            <span>
                                                121 赞许
                                            </span>
                                            <span>
                                                {{ $p_demand->demand->discus->count() }} 评论
                                            </span>
                                                                </p>
                                        <span>
                                            来自
                                            <a href="{{url("buddy/".@$p_demand->demand->user->id)}}" rel="nofollow">
                                                {{ @$p_demand->demand->user->name }}
                                            </a>
                                        </span>
                                        </div>
                                        <div class="info-tra-left">
                                        </div>
                                        <div class="recommend-infobox board small pl-right">
                                            <div class="recommend-data board">
                                            </div>
                                            <h2>
                                                <a href="{{url("s/show/".$p_demand->demand->id)}}">
                                                    {{ $p_demand->demand->name }}
                                                </a>
                                            </h2>
                                            <p>
                                            </p>
                                        </div>
                                        <div class="info-tra-right">
                                        </div>
                                    </div>
                                @elseif( ABS(( $key+1) % 3 ) == 0 )
                                    <div class="recommend-imgbox recommend-box">
                                        <a href="{{url("s/show/".$p_demand->demand->id)}}">
                                            <img lay-src="{{url($p_demand->demand->cover->path)}}">
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

    </div>

@stop
@section('bottom')
    <script>
        layui.use('element', function(){
            var element = layui.element();

        });
        layui.use('flow', function(){
            var flow = layui.flow;
            flow.lazyimg();
        });

        $(function(){
            $(".buddy-tag").click(function(){
                $('#'+$(this).data("nav")).trigger("click");
            });
        })
    </script>
@stop
