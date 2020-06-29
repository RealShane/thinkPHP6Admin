$(document).ready(function() {
    var url = location.search; //获取url中"?"符后的字串
    url=decodeURI(url);
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("&");
        for(var i = 0; i < strs.length; i ++) {
            theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
        }
    }
    var target=theRequest.id;
    var FILE = null;
    $.ajaxSetup({async:false});
    $.getJSON("/assets/js/admin/route.json", "", function(data) {
        FILE = data.FILE;
    });
    if(target != -1){
        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : '/' + FILE + '/AdminUser/retrieveData',
            data : {
                key:'id',
                value:target
            },
            success : function(res) {
                $('#username').val(res.result[0]['username']);
            }
        });

        $("#commit").click(function() {
            var username = $('#username').val();
            var password = $('#password').val();

            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : '/' + FILE + '/AdminUser/updateData',
                data : {
                    target:target,
                    username:username,
                    password:password
                },
                success : function(res) {
                    if(res.status === 200){
                        window.parent.location.reload();
                    }
                }
            });
        })
    }
    if(target == -1){
        $("#commit").click(function() {
            var username = $('#username').val();
            var password = $('#password').val();
            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : '/' + FILE + '/AdminUser/addAdminUser',
                data : {
                    username:username,
                    password:password
                },
                success : function(res) {
                    if(res.status === 200){
                        window.parent.location.reload();
                    }
                }
            });
        })
    }
})

