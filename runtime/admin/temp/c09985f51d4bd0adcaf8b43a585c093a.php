<?php /*a:5:{s:62:"D:\WorkSpace\WebServer\code_up\app\admin\view\index\index.html";i:1593264114;s:63:"D:\WorkSpace\WebServer\code_up\app\admin\view\public\_meta.html";i:1593404073;s:63:"D:\WorkSpace\WebServer\code_up\app\admin\view\public\_menu.html";i:1593397081;s:65:"D:\WorkSpace\WebServer\code_up\app\admin\view\public\_header.html";i:1593344679;s:65:"D:\WorkSpace\WebServer\code_up\app\admin\view\public\_footer.html";i:1593394126;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
<title>后台管理</title>
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

</head>
<body>
<aside class="Hui-admin-aside-wrapper">
	<div class="Hui-admin-logo-wrapper">
		<a class="logo navbar-logo" href="/<?php echo htmlentities($FILE); ?>/Index">
			<i class="va-m iconpic global-logo"></i>
			<span class="va-m">后台管理</span>
		</a>
	</div>
	<div class="Hui-admin-menu-dropdown bk_2" id="catalogue_here">
		<div class="Hui-admin-menu-dropdown bk_2" id="super_admin">

			<dl class="Hui-menu">
				<dt class="Hui-menu-title"><i class="Hui-iconfont">&#xe6ee;</i> <strong>在线命令</strong><i class="Hui-iconfont Hui-admin-menu-dropdown-arrow">&#xe6d5;</i></dt>
				<dd class="Hui-menu-item">
					<ul>
						<li><a data-href="/<?php echo htmlentities($FILE); ?>/AdminView/commandView" data-title="代码生成">代码生成</a></li>
						<li><a data-href="/<?php echo htmlentities($FILE); ?>/AdminView/catalogueView" data-title="二级目录">二级目录</a></li>
					</ul>
				</dd>
			</dl>

			<dl class="Hui-menu">
				<dt class="Hui-menu-title"><i class="Hui-iconfont">&#xe62b;</i> <strong>权限管理</strong><i class="Hui-iconfont Hui-admin-menu-dropdown-arrow">&#xe6d5;</i></dt>
				<dd class="Hui-menu-item">
					<ul>
						<li><a data-href="/<?php echo htmlentities($FILE); ?>/AdminView/userView" data-title="管理员添加/更改密码">管理员添加/更改密码</a></li>
						<li><a data-href="/<?php echo htmlentities($FILE); ?>/AdminAuthAccess/view" data-title="管理员权限分配">管理员权限分配</a></li>
						<li><a data-href="/<?php echo htmlentities($FILE); ?>/AdminAuthGroup/view" data-title="管理员权限组">管理员权限组</a></li>
					</ul>
				</dd>
			</dl>

		</div>
	</div>
</aside>
<div class="Hui-admin-aside-mask"></div>
<div class="Hui-admin-dislpayArrow">
	<a href="javascript:void(0);" onClick="displaynavbar(this)">
		<i class="Hui-iconfont Hui-iconfont-left">&#xe6d4;</i>
		<i class="Hui-iconfont Hui-iconfont-right">&#xe6d7;</i>
	</a>
</div>
<section class="Hui-admin-article-wrapper">
<header class="Hui-navbar">
	<div class="navbar">
		<div class="container-fluid clearfix">
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar">
				<ul class="clearfix">
					<li id="admin_group"></li>

					<li class="dropDown dropDown_hover">
						<a href="#" class="dropDown_A">
							<span id="admin_name"></span><i class="Hui-iconfont">&#xe6d5;</i>
						</a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" onClick="myselfinfo()">个人信息</a></li>
							<li><a href="#">切换账户</a></li>
							<li><a href="/<?php echo htmlentities($FILE); ?>/adminQuit">退出</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>



<div id="Hui-admin-tabNav" class="Hui-admin-tabNav">
	<div class="Hui-admin-tabNav-wp">
		<ul id="min_title_list" class="acrossTab clearfix" style="width: 241px; left: 0px;">
			<li class="active"><span title="我的桌面" data-href="/<?php echo htmlentities($FILE); ?>/indexWelcome">我的桌面</span><em></em></li>
		</ul>
	</div>
	<div class="Hui-admin-tabNav-more btn-group" style="display: none;">
		<a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a>
		<a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a>
	</div>
</div>

<div id="iframe_box" class="Hui-admin-article">
	<div class="show_iframe">
		<iframe id="iframe-welcome" data-scrolltop="0" scrolling="yes" frameborder="0" src="/<?php echo htmlentities($FILE); ?>/indexWelcome"></iframe>
	</div>
</div>
</section>
<div class="contextMenu" id="Huiadminmenu">
	<ul>
		<li id="closethis">关闭当前 </li>
		<li id="closeother">关闭其他 </li>
		<li id="closeall">关闭全部 </li>
	</ul>
</div>

<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/lib/layer/3.1.1/layer.js"></script>
<script type="text/javascript" src="/lib/layui/layui.js"></script>
<script type="text/javascript" src="/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/h-ui.admin.pro/js/h-ui.admin.pro.iframe.min.js"></script>
<!--我的assets-->
<script type="text/javascript" src="/assets/js/admin/admin_public/admin.menu.js"></script>
<script type="text/javascript" src="/assets/js/admin/admin_public/admin.header.js"></script>
<script type="text/javascript" src="/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
</body>
</html>