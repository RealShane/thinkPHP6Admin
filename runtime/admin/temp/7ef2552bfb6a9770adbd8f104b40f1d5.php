<?php /*a:3:{s:91:"D:\WorkSpace\WebServer\code_up\app\admin\view\auth\admin_auth_access\admin_auth_access.html";i:1593405377;s:63:"D:\WorkSpace\WebServer\code_up\app\admin\view\public\_meta.html";i:1593404073;s:65:"D:\WorkSpace\WebServer\code_up\app\admin\view\public\_footer.html";i:1593394126;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
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
<div class="wap-container">
    <nav class="breadcrumb" style="background-color:#fff;padding: 0 24px">
        首页
        <span class="c-gray en">/</span>
        权限管理
        <span class="c-gray en">/</span>
        管理员权限分配
        <a class="btn btn-success radius f-r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
    </nav>

    <article class="Hui-admin-content clearfix">

        <div class="row clearfix">
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="row clearfix mb-10">
                    <span class="col-xs-4 form-item-label">键：</span>
                    <span class="col-xs-8 form-item-control">
                        <span class="select-box">
                            <select id="searchKey" class="select">
                                <option value="id">自增id</option>
                                <option value="username">管理员名</option>
                                <option value="group">权限组所属</option>
                            </select>
                        </span>
                    </span>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="row clearfix mb-10">
                    <span class="col-xs-4 form-item-label">值：</span>
                    <span class="col-xs-8 form-item-control">
                        <input type="text" id="searchValue" placeholder="输入..." class="input-text" />
                    </span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="row clearfix">
                    <span class="col-xs-4 form-item-control">
                        <button id="search_send" class="btn btn-success radius" type="button"><i class="Hui-iconfont">&#xe665;</i> 查询</button>
                    </span>
                </div>
            </div>
        </div>

        <div class="panel mt-20">
            <div class="panel-body">
                <div class="clearfix">
						<span class="f-l">
							<a id='batchDelete' href="#" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
							<a id="add" href="#" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加数据</a>
						</span>
                    <span class="f-r" id='num_room'>共有数据：<strong id='data_num'></strong> 条</span>
                </div>
                <div class="mt-20 clearfix">
                    <table id='dataSingleSet' class="table table-border table-bordered table-bg table-hover table-sort">
                        <thead>
                        <tr>
                            <th scope="col" colspan="5">管理员权限分配</th>
                        </tr>
                        <tr class="text-c">
                            <th></th>
                            <th id='id'>自增id</th>
                            <th id='username'>管理员名</th>
                            <th id='group'>权限组所属</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody id='dataRoom'>
                        </tbody>
                    </table>
                    <div id="page_set"></div>
                </div>
            </div>
        </div>
    </article>
</div>
<script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/lib/layer/3.1.1/layer.js"></script>
<script type="text/javascript" src="/lib/layui/layui.js"></script>
<script type="text/javascript" src="/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/h-ui.admin.pro/js/h-ui.admin.pro.iframe.min.js"></script>
<!--我的assets-->
<script type="text/javascript" src="/assets/js/admin/admin_public/admin.menu.js"></script>
<script type="text/javascript" src="/assets/js/admin/admin_public/admin.header.js"></script>
<script src="/assets/js/admin/admin_auth_access/admin.auth.access.js"></script>

</body>
</html>
