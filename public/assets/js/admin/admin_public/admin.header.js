$(document).ready(function(){
    var FILE = null;
    $.ajaxSetup({async:false});
    $.getJSON("/assets/js/admin/route.json", "", function(data) {
        FILE = data.FILE;
    });
    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : '/' + FILE + '/adminInfo',
        success : function(res) {
            if(res.status == 200){
                $("#admin_name").append(
                    "<strong>"+res.result['username']+"</strong>"
                );
                $("#admin_group").append(
                    "<strong>"+res.result['group']+"</strong>"
                );

            }

        }
    });



});