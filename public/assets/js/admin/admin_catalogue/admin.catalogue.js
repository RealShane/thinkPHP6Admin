$(document).ready(function(){
    var FILE = null;
    $.ajaxSetup({async:false});
    $.getJSON("/assets/js/admin/route.json", "", function(data) {
        FILE = data.FILE;
    });
    $(document).ready(function(){

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : '/' + FILE + '/AdminCatalogue/seeAll',
            success : function(res) {
                $("#data_num").append(
                    "<strong>"+res.result.length+"</strong>"
                );
                layui.use('laypage', function(){
                    var laypage = layui.laypage;
                    laypage.render({
                        elem : 'page_set',
                        limit : 10,
                        first : '首页',
                        last : '尾页',
                        curr : res.result,
                        layout : ['count', 'prev', 'page', 'next'],
                        count : res.result.length,
                        jump: function(obj){
                            document.getElementById('dataRoom').innerHTML = function(){
                                var arr = [], thisData = res.result.concat().splice(obj.curr*obj.limit - obj.limit, obj.limit);
                                layui.each(thisData, function(index, key){
                                    arr.push(
                                        "<tr>" +
                                            "<td><input type='checkbox' name='multiple' value="+key['id']+"></td>" +
                                            "<td>"+key['id']+"</td>" +"<td>"+key['catalogue_name']+"</td>" +"<td><i class=\"Hui-iconfont\">"+key['icon']+"</i></td>" +"<td>"+key['executor']+"</td>" +"<td>"+key['create_time']+"</td>" +
                                            "<td class='td-manage'>" +
                                                "<span class='label label - success radius'><a onClick='edit("+key['id']+")'>编辑</a></span>" +
                                                "<span class='label radius'><a onClick='delete_single("+key['id']+")'>删除</a></span>" +
                                            "</td>" +
                                        "</tr>"
                                    );
                                });
                                return arr.join('');
                            }();
                        }
                    });
                });
            }
        });

    });
    $("#add").click(function(){
        layer_show('添加','/' + FILE + '/AdminView/catalogueAddEdit?id=-1',800,500);
    })
    $("#batchDelete").click(function(){
        var ids = [], i = 1;
        $("input[name='multiple']:checked").each(function(index, key){
            ids[i] = $(key).val();
            i++;
        });

        $.ajax({
            type : "POST",
            contentType: "application/x-www-form-urlencoded",
            url : '/' + FILE + '/AdminCatalogue/batchDeleteData',
            data : {
                ids:ids
            },
            success : function(res) {
                if(res.status == 200){
                    window.parent.location.reload();
                }
            }
        });
    })
});
$("#search_send").click(function(){
    var FILE = null;
    $.ajaxSetup({async:false});
    $.getJSON("/assets/js/admin/route.json", "", function(data) {
        FILE = data.FILE;
    });
    var searchKey = $("#searchKey").val();
    var searchValue = $("#searchValue").val();
    $.ajax({
        type : "POST",
        contentType: "application/x-www-form-urlencoded",
        url : '/' + FILE + '/AdminCatalogue/retrieveData',
        data : {
            key:searchKey,
            value:searchValue
        },
        success : function(res) {
            if(res.status == 200){
                $("#data_num").remove();
                $("#dataRoom").remove();
                $("#num_room").append(
                    "<strong id='data_num'>"+res.result.length+"</strong>"
                );
                $("#dataSingleSet").append(
                    "<tbody id='dataRoom'></tbody>"
                );
                layui.use('laypage', function(){
                    var laypage = layui.laypage;
                    laypage.render({
                        elem : 'page_set',
                        limit : 10,
                        first : '首页',
                        last : '尾页',
                        curr : res.result,
                        layout : ['count', 'prev', 'page', 'next'],
                        count : res.result.length,
                        jump: function(obj){
                            document.getElementById('dataRoom').innerHTML = function(){
                                var arr = [], thisData = res.result.concat().splice(obj.curr*obj.limit - obj.limit, obj.limit);
                                layui.each(thisData, function(index, key){
                                    arr.push(
                                        "<tr>" +
                                            "<td><input type='checkbox' name='multiple' value="+key['id']+"></td>" +
                                            "<td>"+key['id']+"</td>" +"<td>"+key['catalogue_name']+"</td>" +"<td>"+key['icon']+"</td>" +"<td>"+key['executor']+"</td>" +"<td>"+key['create_time']+"</td>" +
                                            "<td class='td-manage'>" +
                                                "<span class='label label - success radius'><a onClick='edit("+key['id']+")'>编辑</a></span>" +
                                                "<span class='label radius'><a onClick='delete_single("+key['id']+")'>删除</a></span>" +
                                            "</td>" +
                                        "</tr>"
                                    );
                                });
                                return arr.join('');
                            }();
                        }
                    });
                });
            }
        }
    });
})
function edit(id) {
    var FILE = null;
    $.ajaxSetup({async:false});
    $.getJSON("/assets/js/admin/route.json", "", function(data) {
        FILE = data.FILE;
    });
    layer_show('编辑','/' + FILE + '/AdminView/catalogueAddEdit?id='+id,800,500);
}

function delete_single(id) {
    var FILE = null;
    $.ajaxSetup({async:false});
    $.getJSON("/assets/js/admin/route.json", "", function(data) {
        FILE = data.FILE;
    });
    $.ajax({
        type : "POST",
        contentType: "application/x-www-form-urlencoded",
        url : '/' + FILE + '/AdminCatalogue/deleteData',
        data : {
            target:id
        },
        success : function(res) {
            if(res.status == 200){
                window.parent.location.reload();
            }
        }
    });

}

