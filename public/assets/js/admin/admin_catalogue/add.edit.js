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
            url : '/' + FILE + '/AdminCatalogue/retrieveData',
            data : {
                key:'id',
                value:target
            },
            success : function(res) {
                $('#id').val(res.result[0]['id']);
                $('#catalogue_name').val(res.result[0]['catalogue_name']);
                $('#icon').val(res.result[0]['icon']);
                $('#executor').val(res.result[0]['executor']);
                $('#create_time').val(res.result[0]['create_time']);
            }
        });
    
        $("#commit").click(function() {
            var id = $('#id').val();
            var catalogue_name = $('#catalogue_name').val();
            var icon = $('#icon').val();
            var executor = $('#executor').val();
            var create_time = $('#create_time').val();

            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : '/' + FILE + '/AdminCatalogue/updateData',
                data : {
                    target:target,
                    id:id,
                    catalogue_name:catalogue_name,
                    icon:icon,
                    executor:executor,
                    create_time:create_time
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
            var catalogue_name = $('#catalogue_name').val();
            var icon = $('#icon').val();
            var executor = $('#executor').val();
            var create_time = $('#create_time').val();
            console.log(icon)
            $.ajax({
                type : "POST",
                contentType: "application/x-www-form-urlencoded",
                url : '/' + FILE + '/AdminCatalogue/createData',
                data : {
                    id:id,
                    catalogue_name:catalogue_name,
                    icon:icon,
                    executor:executor,
                    create_time:create_time
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

