<!DOCTYPE html>
<!--
***********************************************************************************
*****************************________*********************************************
***************************/ ---``--- \*******************************************
**************************| |_______| |*******************************************
**************************| |-------| |********************************************
**************************| `-------` |*********************************************
*********************/\.***\---------/***********************************************
********************/   \--------------\*******************************************
*******************/____   __   ____   \******************************************
*************************/ /***/ /***|  |******************************************
************************/ /***/ /***|  |*******************************************
***********************/ /***/ /***|  |********************************************
**********************/ /**/ /*/```  |*********************************************
*********************/_/**/_/**\____/**********************************************
***********************************************************************************
***********************************************************<18681032630@163.com>***
***********************************************************************************
-->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>{{ @$title  }} - {{ Config::get('app.name') }}</title>
<link rel="shortcut icon" href="{{url("/images/app/". Config::get('app.icon') )}}" type="image/x-icon">
<link rel="icon" href="{{url("/images/app/". Config::get('app.icon') )}}" type="image/x-icon">
<!-- head中需要引入的部分 begin -->
<link href="{{ asset("/TransverseDynamicPage/css/lanrenzhijia.css") }}" rel="stylesheet" type="text/css">
<script src="http://www.lanrenzhijia.com/ajaxjs/1.10.2/jquery-1.10.2.min.js"></script>
{{--<script src="{{ asset('/js/jquery.js?t=1476958143') }}"></script>--}}
<script src=" {{asset("/TransverseDynamicPage/js/jquery-migrate-1.2.1.min.js") }}"></script>
<script src=" {{asset("/TransverseDynamicPage/js/transit.js") }}"></script>
<script src=" {{asset("/TransverseDynamicPage/js/touchSwipe.js") }}"></script>
<script src=" {{asset("/TransverseDynamicPage/js/simpleSlider.js") }}"></script>
<script src=" {{asset("/TransverseDynamicPage/js/backstretch.js")}}"></script>
<script src=" {{asset("/TransverseDynamicPage/js/custom.js") }}"></script>
<!-- head中需要引入的部分end -->
</head>
<body>
<!-- 代码 begin -->
<div class='pagewrap'>
  <div class='pageblock' id='fullscreen'>
    <div class='slider'>
      <div class='slide' id="first">
        <div class='slidecontent'> <span class="headersur">从你忙碌的工作中闲暇出来</span>
          <h2>寻一部老相机 一本老故事</h2>
          {{--<div class="button" onClick="mainslider.nextSlide();">让心安静下来</div>--}}
        </div>
      </div>
      <div class='slide' id="sec">
        <div class='slidecontent'> <span class="headersur">摒弃那些电子设备</span>
          <h2>用心呼吸</h2>
          <div class="text">
            {{--<div class="button" onClick="mainslider.nextSlide();">感受时光消散</div>--}}
          </div>
        </div>
      </div>
      <div class='slide' id="thirth">
        <div class='slidecontent'> <span class="headersur">拿起你手中的啤酒</span>
          <h2>感受那经典的摇滚</h2>
          <div class="text">
            <xmp>U.F.O.作为传统老式硬摇滚的首座，其骨子里是摇摆生姿的Blues根音，
这种“形散，神不散”的音乐感觉也基本概括了U.F.O.乐队分分合合的经历。
每次聚合分开所留下给乐迷的是种种令人热爱的专辑。《
Sever deadly》这张专辑的花样繁多，第一首“Fight night”还在Blues根音的节奏里摇曳，
第二首“Wonderland”......</xmp>
            {{--<div class="button" onClick="mainslider.nextSlide();">听得如痴如醉</div>--}}
          </div>
        </div>
      </div>
      <div class='slide' id="fourth">
        <div class='slidecontent'> <span class="headersur">买一张火车票</span>
          <h2>行到水穷处 坐看云起时</h2>
          <div class="text">
            <a class="button" href="{{ url("/new") }}" style="text-decoration: none">开始感受</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- 代码 end -->
</body>
</html>