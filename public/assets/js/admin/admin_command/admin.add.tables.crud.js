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
            url : '/' + FILE + '/AdminTable/getAllTable',
            success : function(res) {
                let db_name = 'Tables_in_' + res.message;
                for (let key of res.result){
                    $("#tables_name").append(
                        "<option>"+key[db_name]+"</option>"
                    );
                }
            }
        });

        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : '/' + FILE + '/AdminCatalogue/seeAll',
            success : function(res) {
                for (let key of res.result){
                    $("#catalogue").append(
                        "<option value="+key['id']+">├ "+key['catalogue_name']+"</option>"
                    );
                }
            }
        });

    });

    $("#send").click(function(){

        var tableName = $("#tables_name").val();
        var catalogue = $("#catalogue").val();
        $.ajax({
            type : "POST",
            contentType : "application/x-www-form-urlencoded",
            url : '/' + FILE + '/AdminTable/codeGenerator',
            data : {
                tableName:tableName,
                catalogue:catalogue
            },
            success : function(res) {
                if(res.status == 200){
                    window.parent.location.reload();
                }
            }
        });

    });

});