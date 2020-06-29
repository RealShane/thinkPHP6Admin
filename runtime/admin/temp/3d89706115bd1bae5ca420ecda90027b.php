<?php /*a:2:{s:62:"D:\WorkSpace\WebServer\code_up\app\admin\view\index\login.html";i:1593355977;s:63:"D:\WorkSpace\WebServer\code_up\app\admin\view\public\_meta.html";i:1593404073;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
  <title>后台登录</title>
  <meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
    <script type="text/javascript" src="/lib/html5.js"></script>
    <script type="text/javascript" src="/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/static/h-ui.admin.pro/css/h-ui.admin.pro.iframe.min.css" />
<link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.9/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/lib/layui/css/layui.css" />
<link rel="stylesheet" type="text/css" href="/static/business/css/style.css" />
<!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
<![endif]-->

  <link rel="stylesheet" type="text/css" href="/assets/css/admin/adminlte.min.css" />
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a><b>后 台</b></a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">登陆</p>

      <form method="post">
        <div class="input-group mb-3">
          <input id="username" type="text" class="form-control" placeholder="用户名...">
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="Hui-iconfont">&#xe62b;</i>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control" placeholder="密码...">
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="Hui-iconfont">&#xe63f;</i>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input id="validate" type="text" class="form-control" placeholder="验证码...">
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="Hui-iconfont">&#xe605;</i>
            </div>
          </div>
        </div>
        <div class="text-center">
          <div class="col-12">
            <div>
              <img id="captcha" src="<?php echo captcha_src(); ?>" alt="点击更新验证码" />
            </div>
            <a href="#" id="captcha_a"><small>看不清?点图片或者点我</small></a>
          </div>
        </div>
        <div class="text-center">
          <div class="col-12">
            <button id="login_send" type="button" class="btn btn-primary btn-block">登 录</button>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>

<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/lib/layer/3.1.1/layer.js"></script>
<script src="/assets/js/admin/admin_public/admin.login.ajax.js"></script>
<script src="/assets/js/admin/admin_public/reload.captcha.js"></script>
</body>
</html>