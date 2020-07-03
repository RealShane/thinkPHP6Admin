$(document).ready(function(){
    var FILE = null;
    $.ajaxSetup({async:false});
    $.getJSON("/assets/js/admin/route.json", "", function(data) {
        FILE = data.FILE;
    });
    $.ajax({
        type : "POST",
        contentType : "application/x-www-form-urlencoded",
        url : '/' + FILE + '/AdminGenerator/seeAll',
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
                                        "<td style='text-align: center'>" + key['id'] + "</td>" +
                                        "<td style='text-align: center'>" + key['table_name'] + "</td>" +
                                        "<td style='text-align: center'>" + key['table_comment'] + "</td>" +
                                        "<td style='text-align: center'>├ " + key['catalogue_bind'] + "</td>" +
                                        "<td style='text-align: center'>" + key['executor'] + "</td>" +
                                        "<td style='text-align: center'>" + key['create_time'] + "</td>" +
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

    $("#add_table_crud").click(function(){
        layer_show('代码生成','/' + FILE + '/AdminView/add_table_crud',800,500);
    });

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
        url : '/' + FILE + '/AdminGenerator/retrieveData',
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
                                            "<td style='text-align: center'>" + key['id'] + "</td>" +
                                            "<td style='text-align: center'>" + key['table_name'] + "</td>" +
                                            "<td style='text-align: center'>" + key['table_comment'] + "</td>" +
                                            "<td style='text-align: center'>├ " + key['catalogue_bind'] + "</td>" +
                                            "<td style='text-align: center'>" + key['executor'] + "</td>" +
                                            "<td style='text-align: center'>" + key['create_time'] + "</td>" +
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