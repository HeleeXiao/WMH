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
<html lang="en-GB">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="shortcut icon" href="{{url("/images/app/". Config::get('app.icon') )}}" type="image/x-icon">
<link rel="icon" href="{{url("/images/app/". Config::get('app.icon') )}}" type="image/x-icon">
<title>{{ @$title  }} - {{ Config::get('app.name') }}</title>
@include('partials.header')
@section('top')
@show
</head>
<body>
<div id="wrap">
@include('partials.bootstrap')
<div class="container"  onmouseover="$('.lanrenzhijia').hide()">

@include('partials.notifications')
@section('content')
@show
</div>
</div>
@include('partials.footer')

@section('bottom')
@show

</body>
</html>


