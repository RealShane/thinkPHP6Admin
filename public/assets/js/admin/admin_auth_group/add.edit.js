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
            url : '/' + FILE + '/AdminAuthGroup/retrieveData',
            data : {
                key:'id',
                value:target
            },
            success : function(res) {
                $('#id').val(res.result[0]['id']);
                $('#name').val(res.result[0]['name']);
                $('#rules').val(res.result[0]['rules']);
                $('#create_time').val(res.result[0]['create_time']);
                $('#update_time').val(res.result[0]['update_time']);
            }
        });
    
        $("#commit").click(function() {
            var id = $('#id').val();
            var name = $('#name').val();
            var rules = $('#rules').val();
            var create_time = $('#create_time').val();
            var update_time = $('#update_time').val();

            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : '/' + FILE + '/AdminAuthGroup/updateData',
                data : {
                    target:target,
                    id:id,
                    name:name,
                    rules:rules,
                    create_time:create_time,
                    update_time:update_time
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
        $("#commit").click(function() {
            var id = $('#id').val();
            var name = $('#name').val();
            var rules = $('#rules').val();
            var create_time = $('#createtime').val();
            var update_time = $('#updatetime').val();
            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : '/' + FILE + '/AdminAuthGroup/createData',
                data : {
                    id:id,
                    name:name,
                    rules:rules,
                    create_time:create_time,
                    update_time:update_time
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

