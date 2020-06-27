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
            url : '/' + FILE + '/AdminGenerator/retrieveData',
            data : {
                key:'id',
                value:target
            },
            success : function(res) {
                $('#id').val(res.result[0]['id']);$('#table_name').val(res.result[0]['table_name']);$('#table_comment').val(res.result[0]['table_comment']);$('#catalogue_bind').val(res.result[0]['catalogue_bind']);$('#executor').val(res.result[0]['executor']);$('#create_time').val(res.result[0]['create_time']);
            }
        });
    
        $("#commit").click(function() {
            var id = $('#id').val();var table_name = $('#table_name').val();var table_comment = $('#table_comment').val();var catalogue_bind = $('#catalogue_bind').val();var executor = $('#executor').val();var create_time = $('#create_time').val();

            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : '/' + FILE + '/AdminGenerator/updateData',
                data : {
                    target:target,
                    id:id,table_name:table_name,table_comment:table_comment,catalogue_bind:catalogue_bind,executor:executor,create_time:create_time
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
            var id = $('#id').val();var table_name = $('#table_name').val();var table_comment = $('#table_comment').val();var catalogue_bind = $('#catalogue_bind').val();var executor = $('#executor').val();var create_time = $('#create_time').val();
            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : '/' + FILE + '/AdminGenerator/createData',
                data : {
                    id:id,table_name:table_name,table_comment:table_comment,catalogue_bind:catalogue_bind,executor:executor,create_time:create_time
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
