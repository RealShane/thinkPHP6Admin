$(document).ready(function(){
    var FILE = null;
    $.ajaxSetup({async:false});
    $.getJSON("/assets/js/admin/route.json", "", function(data) {
        FILE = data.FILE;
    });
    $("#login_send").click(function(){
        var username = $("#username").val();
        var password = $("#password").val();
        var validate = $("#validate").val();

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : '/' + FILE + '/adminLogin',
            data : {
                username:username,
                password:password,
                validate:validate
            },
            success : function(res) {
                if(res.status === 100){
                    layer.msg(res.result);
                    $("#captcha").attr('src',"/captcha?id=" + Math.random());
                }else if(res.status === 200){
                    layer.msg('登录成功!', function () {
                        $(window).attr('location','/' + FILE + '/Index');
                    });
                }

            }
        });

    });


});