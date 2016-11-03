<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{{@$title}}</title>
<link rel="stylesheet" type="text/css" href="/assets/manage/body.css">
<link rel="stylesheet" type="text/css" href="/assets/manage/style.css">
<script src="/js/jquery.js"></script>
<script src="{{asset('/layer/layer.js?v=2.4')}}"></script>
<script src="{{asset('/js/common/vilidata.js')}}"></script>
<style type="text/css">
.tb960x90 {display:none!important;display:none}
body{
   background:url(/images/cloud.jpg) 0 bottom repeat-x  #049ec4;
  -webkit-animation: animate-cloud 20s linear infinite;
  -moz-animation: animate-cloud 20s linear infinite;
  -ms-animation: animate-cloud 20s linear infinite;
  -o-animation: animate-cloud 20s linear infinite;
  animation: animate-cloud 20s linear infinite;
  width: 100%;
  height: auto;
}
</style>
</head>
<body >
@if($errors->has("name"))
    <script>
        layer.alert('{{ $errors->first("name") }}', {
            icon: 2,
            shadeClose: true,
            title: "错误"
        });
    </script>
@endif
@if($errors->has("password"))
    <script>
        layer.alert('{{ $errors->first("password") }}', {
            icon: 2,
            shadeClose: true,
            title: "错误"
        });
    </script>
@endif
<div class="container">
	<section id="content">
		<form  id="login" action="" method="post">
			<h1>登录</h1>
			<div>
				<input type="text" value="{{ old("name")  }}" name="name" placeholder="Name" required="" id="username" />
			</div>
            {!! csrf_field() !!}
			<div>
				<input type="password" value="{{ old("password")  }}" name="password" placeholder="Password" required="" id="password" />
			</div>
			 <div class="">
				<span class="help-block u-errormessage" id="js-server-helpinfo">&nbsp;</span>			</div> 
			<div>
				<!-- <input type="submit" value="Log in" /> -->
				<input type="submit" value="登录" class="btn btn-primary" id="js-btn-login"/>
				<a href="javascript:;" id="W-pwd" onclick="javascript:void (0);">忘记密码?</a>
				<!-- <a href="#">Register</a> -->
			</div>
		</form>
	</section>
</div>
</body>
</html>