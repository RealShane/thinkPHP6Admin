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
    var groups = null;
    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : '/' + FILE + '/AdminAuthAccess/seeAuthGroup',
        success : function(res) {
            groups = res.result;
        }
    });
    if(target != -1){
        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : '/' + FILE + '/AdminAuthAccess/retrieveData',
            data : {
                key:'id',
                value:target
            },
            success : function(res) {
                $('#id').val(res.result[0]['id']);
                $('#username').val(res.result[0]['username']);
                for (let group of groups){
                    if (group['id'] == res.result[0]['group_id']){
                        $("#group").append(
                            "<option selected value='" + group['id'] +"'>" + group['name'] + "</option>"
                        );
                        continue;
                    }
                    $("#group").append(
                        "<option value='" + group['id'] +"'>" + group['name'] + "</option>"
                    );
                }
            }
        });
    
        $("#commit").click(function() {
            var id = $('#id').val();
            var username = $('#username').val();
            var group = $('#group').val();

            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : '/' + FILE + '/AdminAuthAccess/updateData',
                data : {
                    target:target,
                    id:id,username:username,group:group
                },
                success : function(res) {
                    if(res.status == 200){
                        window.parent.location.reload();
                    }
                }
            });
        })
    }
    if(target == -1){
        for (let group of groups){
            $("#group").append(
                "<option value='" + group['id'] +"'>" + group['name'] + "</option>"
            );
        }
        $("#commit").click(function() {
            var id = $('#id').val();
            var username = $('#username').val();
            var group = $('#group').val();
            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : '/' + FILE + '/AdminAuthAccess/createData',
                data : {
                    id:id,
                    username:username,
                    group:group
                },
                success : function(res) {
                    if(res.status == 200){
                        window.parent.location.reload();
                    }
                }
            });
        })
    }
})

