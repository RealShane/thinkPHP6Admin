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
            if(res.status === 200){
                if(res.result['group_id'] !== '*'){
                    $("#super_admin").remove();
                }
            }

        }
    });

    var data = [];
    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : '/' + FILE + '/seeAllTable',
        success : function(res) {
            var i = 1;
            for(let key of res.result){
                key['table_name'] = key['table_name'].replace(/_/g, "");
                key['table_name'] = key['table_name'].firstUpperCase();
                data[i] = key;
                i++;
            }
            show_menu(data, FILE)
        }
    });

});

function show_menu(data, FILE){

    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : '/' + FILE + '/seeAllCatalogue',
        success : function(res) {
            for(let key of res.result){
                $("#catalogue_here").append(
                    "<dl class=\"Hui-menu\">" +
                        "<dt class=\"Hui-menu-title\" onclick=\"dis("+key['id']+")\"><i class=\"Hui-iconfont\">"+key['icon']+"</i> <strong>"+key['catalogue_name']+"</strong><i class=\"Hui-iconfont Hui-admin-menu-dropdown-arrow\">&#xe6d5;</i></dt>" +
                        "<dd id=dd"+key['id']+" style=\"display: none;\" class=\"Hui-menu-item\">" +
                            "<ul id=cato"+key['id']+">" +
                            "</ul>" +
                        "</dd>" +
                    "</dl>"
                );

            }
            for(let key of res.result){
                for(let key_data of data){
                    if(typeof key_data == "undefined"){
                        continue;
                    }
                    if(key_data['catalogue_bind'] == key['id']){
                        $("#cato"+key['id']).append(
                            "<li><a data-href=/" + FILE + "/" + key_data['table_name'] + "/view data-title=" + key_data['table_comment'] + ">" + key_data['table_comment'] + "</a></li>"
                        );
                    }
                }
            }
        }
    });
}

function dis(id) {

    var v= $('#dd'+id).css('display');
    if(v=='none'){
        $('#dd'+id).css('display','block');
    }else{
        $('#dd'+id).css('display','none');
    }
}

String.prototype.firstUpperCase = function(){
    return this.replace(/\b(\w)(\w*)/g, function($0, $1, $2) {
        return $1.toUpperCase() + $2.toLowerCase();
    });
}