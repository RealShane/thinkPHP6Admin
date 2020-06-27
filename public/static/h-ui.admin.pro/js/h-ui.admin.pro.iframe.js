/* -----------H-ui前端框架-------------
* h-ui.admin.pro.js v1.0.7
* http://www.h-ui.net/
* Created & Modified by guojunhui
* Date modified 2019.12.21
* Copyright 2013-2019 郭俊辉 All rights reserved.
* Licensed under MIT license.
* http://opensource.org/licenses/MIT
*/
var num=0,oUl=$("#min_title_list"),hide_nav=$("#Hui-admin-tabNav");

/*获取顶部选项卡总长度*/
function tabNavallwidth(){
  var taballwidth=0,
    $tabNav = hide_nav.find(".acrossTab"),
    $tabNavWp = hide_nav.find(".Hui-admin-tabNav-wp"),
    $tabNavitem = hide_nav.find(".acrossTab li"),
    $tabNavmore =hide_nav.find(".Hui-admin-tabNav-more");
  if (!$tabNav[0]){
    return
  }
  $tabNavitem.each(function(index, element) {
    taballwidth += Number(parseFloat($(this).width()+60))
  });
  $tabNav.width(taballwidth+25);
  var w = $tabNavWp.width();
  if(taballwidth+25 > w){
    $tabNavmore.show()
  } else {
    $tabNavmore.hide();
    $tabNav.css({
      left: 0
    });
  }
}

function toNavPos(){
  oUl.stop().animate({'left':-num*100},100);
}

/*菜单导航*/
function Hui_admin_tab(obj){
  var bStop = false,
    bStopIndex = 0,
    href = $(obj).attr('data-href'),
    title = $(obj).attr("data-title"),
    topWindow = $(window.parent.document),
    show_navLi = topWindow.find("#min_title_list li"),
    iframe_box = topWindow.find("#iframe_box");

  if(!href||href==""){
    alert("data-href不存在");
    return false;
  }if(!title){
    alert("data-title不存在");
    return false;
  }
  if(title==""){
    alert("data-title属性不能为空");
    return false;
  }
  show_navLi.each(function() {
    if($(this).find('span').attr("data-href")==href){
      bStop = true;
      bStopIndex=show_navLi.index($(this));
      return false;
    }
  });
  if(!bStop){
    creatIframe(href,title);
    min_titleList();
  }
  else{
    show_navLi.removeClass("active").eq(bStopIndex).addClass("active");
    iframe_box.find(".show_iframe").hide().eq(bStopIndex).show().find("iframe").attr("src",href);
  }
}

/*最新tab标题栏列表*/
function min_titleList(){
  var topWindow = $(window.parent.document),
    show_nav = topWindow.find("#min_title_list"),
    aLi = show_nav.find("li");
}

/*创建iframe*/
function creatIframe(href,titleName){
  var topWindow=$(window.parent.document),
    show_nav=topWindow.find('#min_title_list'),
    iframe_box=topWindow.find('#iframe_box'),
    iframeBox=iframe_box.find('.show_iframe'),
    $tabNav = topWindow.find(".acrossTab"),
    $tabNavWp = topWindow.find(".Hui-admin-tabNav-wp"),
    $tabNavmore = topWindow.find(".Hui-admin-tabNav-more"),
    taballwidth=0;

  show_nav.find('li').removeClass("active");
  show_nav.append('<li class="active"><span data-href="'+href+'">'+titleName+'</span><i></i><em></em></li>');

  var $tabNavitem = topWindow.find(".acrossTab li");
  if (!$tabNav[0]){
    return;
  }
  $tabNavitem.each(function(index, element) {
    taballwidth+=Number(parseFloat($(this).width()+60))
  });
  $tabNav.width(taballwidth+25);
  var w = $tabNavWp.width();
  if(taballwidth+25>w){
    $tabNavmore.show()}
  else{
    $tabNavmore.hide();
    $tabNav.css({left:0})
  }
  iframeBox.hide();
  iframe_box.append('<div class="show_iframe"><div class="loading"></div><iframe data-scrollTop="0" frameborder="0" src='+href+'></iframe></div>');
  var showBox=iframe_box.find('.show_iframe:visible');
  showBox.find('iframe').load(function(){
    showBox.find('.loading').hide();
  });
  if('function'==typeof show_nav.find('li').contextMenu){

    show_nav.find('li').contextMenu('Huiadminmenu', {
      bindings: {
        'closethis': function(t) {
          var $t = $(t);
          if($t.find("i")){
            $t.find("i").trigger("click");
          }
        },
        'closeother': function(t) {
          var $t = $(t);
          if($t.find("i")){
            removeOther();
          }
        },
        'closeall': function(t) {
          $("#min_title_list li i").trigger("click");
        },
      }
    });
  }else {
    console.log('2');
  }
}

/*关闭iframe*/
function removeIframe(){
  var topWindow = $(window.parent.document),
    iframe = topWindow.find('#iframe_box .show_iframe'),
    tab = topWindow.find(".acrossTab li"),
    showTab = topWindow.find(".acrossTab li.active"),
    i = showTab.index();
  tab.eq(i-1).addClass("active");
  tab.eq(i).remove();
  iframe.eq(i-1).show();
  $(iframe.eq(i-1).find("iframe")[0].contentWindow.document).scrollTop(iframe.eq(i-1).find("iframe").attr("data-scrollTop"));
  iframe.eq(i).remove();
}

/* 关闭其他 */
function removeOther() {
  var topWindow = $(window.parent.document),
    iframe = topWindow.find('#iframe_box .show_iframe'),
    tab = topWindow.find(".acrossTab li"),
    showTab = topWindow.find(".acrossTab li.active"),
    _index = showTab.index();
  for(var i=1;i<tab.length;i++){
    if(i != _index) {
      tab.eq(i).remove();
      iframe.eq(i).remove();
    }
  }
}

/*关闭所有iframe*/
function removeIframeAll(){
  var topWindow = $(window.parent.document),
    iframe = topWindow.find('#iframe_box .show_iframe'),
    tab = topWindow.find(".acrossTab li");
  for(var i=0;i<tab.length;i++){
    if(tab.eq(i).find("i").length>0){
      tab.eq(i).remove();
      iframe.eq(i).remove();
    }
  }
}

/*左侧菜单响应式*/
function Huiasidedisplay(){
  if($(window).width() <= 768){
    $("body").addClass("big-page");
    $(".Hui-admin-dislpayArrow a").addClass("open");
  }
}
/*设置皮肤 + cookie*/
function getskincookie(){
  var v = $.cookie("Huiskin");   // 默认先取cookie
  var hrefStr=$("#skin").attr("href");  // 拿skin.css的路径
  var hrefRes ='';
  if(v==null||v==""){
    v="default";
  }
  if(hrefStr!=undefined){
    hrefRes=hrefStr.substring(0,hrefStr.lastIndexOf('skin/'))+'skin/'+v+'/skin.css';
    $("#skin").attr("href",hrefRes);
  }
  $("#Hui-skin .dropDown-menu a").on('click',function(){
    var _v = $(this).attr("data-val");
    $.cookie("Huiskin", _v);
    hrefRes=hrefStr.substring(0,hrefStr.lastIndexOf('skin/'))+'skin/'+_v+'/skin.css';
    $(window.frames.document).contents().find("#skin").attr("href",hrefRes);
  });
}

/*弹出层*/
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/
function layer_show(title,url,w,h){
	if (title == null || title == '') {
		title=false;
	};
	if (url == null || url == '') {
		url="404.html";
	};
	if (w == null || w == '') {
		w=800;
	};
	if (h == null || h == '') {
		h=($(window).height() - 50);
	};
	layer.open({
		type: 2,
		area: [w+'px', h +'px'],
		fix: false, //不固定
		maxmin: true,
		shade:0.4,
		title: title,
		content: url
	});
}

/*时间*/
function getHTMLDate(obj) {
  var d = new Date();
  var weekday = new Array(7);
  var _mm = "";
  var _dd = "";
  var _ww = "";
  weekday[0] = "星期日";
  weekday[1] = "星期一";
  weekday[2] = "星期二";
  weekday[3] = "星期三";
  weekday[4] = "星期四";
  weekday[5] = "星期五";
  weekday[6] = "星期六";
  _yy = d.getFullYear();
  _mm = d.getMonth() + 1;
  _dd = d.getDate();
  _ww = weekday[d.getDay()];
  obj.html(_yy + "年" + _mm + "月" + _dd + "日 " + _ww);
};

/*个人信息*/
function myselfinfo(){
	layer.open({
		type: 1,
		area: ['300px','200px'],
		fix: false, //不固定
		maxmin: true,
		shade:0.4,
		title: '查看信息',
		content: '<div>管理员信息</div>'
	});
}

/* 侧边栏交互 */
function asideInteractive(){
	var resizeID;
	$(window).resize(function(){
		clearTimeout(resizeID);
		resizeID = setTimeout(function(){
			Huiasidedisplay();
		},500);
	});

	$(".nav-toggle").click(function(){
		$(".Hui-admin-aside-wrapper").slideToggle();
	});
	$(".Hui-admin-aside-wrapper").on("click",".Hui-admin-menu-dropdown dd li a",function(){
		if($(window).width()<=768){
			$("body").addClass("big-page");
			$(".Hui-admin-dislpayArrow a").addClass("open");
		}
	});
	$(".Hui-admin-aside-mask").click(function(){
		$("body").addClass("big-page");
		$(".Hui-admin-dislpayArrow a").addClass("open");
	});

	/*左侧菜单*/
	$(".Hui-admin-aside-wrapper").Huifold({
		titCell:'.Hui-admin-menu-dropdown > .Hui-menu > .Hui-menu-title',
		mainCell:'.Hui-admin-menu-dropdown > .Hui-menu > .Hui-menu-item',
	});
	$(".Hui-menu-item").Huifold({
		titCell:'.Hui-menu > .Hui-menu-title',
		mainCell:'.Hui-menu > .Hui-menu-item',
	});
}

$(function(){
	getHTMLDate($("#top_time"));
	getskincookie();
	Huiasidedisplay();
	asideInteractive();
	tabNavallwidth();

	/*选项卡导航*/
  $(".Hui-admin-aside-wrapper").on("click",".Hui-menu .Hui-menu-title a,.Hui-menu .Hui-menu-item a,.Hui-menu .Hui-menu-item-frist a",function(){
		Hui_admin_tab(this);
		$(".Hui-admin-aside-wrapper").find(".Hui-menu .Hui-menu-title,.Hui-menu .Hui-menu-item ul li,.Hui-menu .Hui-menu-item-frist ul li").removeClass("current");
		$(this).parent().addClass("current");
	});

  $(document).on("click","#min_title_list li",function(){
    var bStopIndex = $(this).index();
    var iframe_box = $("#iframe_box");
    $("#min_title_list li").removeClass("active").eq(bStopIndex).addClass("active");
    iframe_box.find(".show_iframe").hide().eq(bStopIndex).show();
  });

  $(document).on("click","#min_title_list li i",function(){
    var aCloseIndex = $(this).parents("li").index();
    $(this).parent().remove();
    $('#iframe_box').find('.show_iframe').eq(aCloseIndex).remove();
    num==0 ? num=0 : num--;
    tabNavallwidth();
  });

  $(document).on("dblclick","#min_title_list li",function(){
    var aCloseIndex = $(this).index();
    var iframe_box = $("#iframe_box");
    if(aCloseIndex > 0){
      $(this).remove();
      $('#iframe_box').find('.show_iframe').eq(aCloseIndex).remove();
      num==0 ? num=0 : num--;
      $("#min_title_list li").removeClass("active").eq(aCloseIndex-1).addClass("active");
      iframe_box.find(".show_iframe").hide().eq(aCloseIndex-1).show();
      tabNavallwidth();
    }else{
      return false;
    }
  });

  /* tabNav左右滚动 */
  $('#js-tabNav-next').click(function(){
    num==oUl.find('li').length-1 ? num=oUl.find('li').length-1 : num++;
    toNavPos();
  });
  $('#js-tabNav-prev').click(function(){
    num==0 ? num=0 : num--;
    toNavPos();
  });
});
