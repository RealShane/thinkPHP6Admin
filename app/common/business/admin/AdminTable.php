<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/17 下午4:07
 *
 */


namespace app\common\business\admin;


use think\db\exception\DbException;
use think\facade\App;
use think\facade\Db;
use think\facade\Env;

class AdminTable
{

    private $FILE = NULL;

    public function __construct(){
        $this -> FILE = Env::get('ADMIN.FILE', '');
    }

    public function generateInfo($tableName, $tableComment, $path, $user){
        try {
            $isExist = Db::name('z_admin_generator') -> where('table_name', $tableName) -> find();
            $data['table_name'] = $tableName;
            $data['table_comment'] = $tableComment;
            $data['catalogue_bind'] = $path;
            $data['executor'] = $user;
            if($isExist == NULL){
                return Db::name('z_admin_generator')->strict(false)->insert($data);
            }
            return Db::name('z_admin_generator') -> where('table_name', $tableName) -> data($data) -> update();
        }catch (DbException $exception){
            return $exception -> getMessage();
        }
    }

    public function generateRoute($tableName){
        $template = $this -> templateRoute($tableName);

        if (file_exists(App::getAppPath() . "route/" . $tableName . ".php")){
            unlink(App::getAppPath() . "route/" . $tableName . ".php");
        }
        file_put_contents(App::getAppPath() . "route/" . $tableName . ".php", $template, FILE_APPEND | LOCK_EX);
        return 1;
    }

    public function generateJS($tableName){
        $origin = $tableName;
        $tableName = str_replace("_","",$tableName);

        if(file_exists(App::getRootPath() . "public/assets/js/admin/generate/" . $tableName . "/" . $tableName . ".js")){
            unlink(App::getRootPath() . "public/assets/js/admin/generate/" . $tableName . "/" . $tableName . ".js");
        }
        if(file_exists(App::getRootPath() . "public/assets/js/admin/generate/" . $tableName . "/add.edit.js")){
            unlink(App::getRootPath() . "public/assets/js/admin/generate/" . $tableName . "/add.edit.js");
        }
        if(!is_dir(App::getRootPath() . "public/assets/js/admin/generate/" . $tableName)){
            mkdir(iconv("UTF-8", "GBK", App::getRootPath() . "public/assets/js/admin/generate/" . $tableName),0777,true);
        }

        $allField = $this -> getAllTableField($origin);

        $template = $this -> templateJS($tableName, $allField);
        file_put_contents(App::getRootPath() . "public/assets/js/admin/generate/" . $tableName . "/" . $tableName . ".js", $template, FILE_APPEND | LOCK_EX);
        $template = $this -> templateAddEditJS($tableName, $allField);
        file_put_contents(App::getRootPath() . "public/assets/js/admin/generate/" . $tableName . "/add.edit.js", $template, FILE_APPEND | LOCK_EX);

        return 1;
    }

    public function generateView($tableName, $path){
        $origin = $tableName;
        $tableName = str_replace("_","",$tableName);

        if(file_exists(App::getAppPath() . "view/generate/" . $tableName . "/" . $tableName . ".html")){
            unlink(App::getAppPath() . "view/generate/" . $tableName . "/" . $tableName . ".html");
        }
        if(file_exists(App::getAppPath() . "view/generate/" . $tableName . "/add_edit.html")){
            unlink(App::getAppPath() . "view/generate/" . $tableName . "/add_edit.html");
        }
        if(!is_dir(App::getAppPath() . "view/generate/" . $tableName)){
            mkdir(iconv("UTF-8", "GBK", App::getAppPath() . "view/generate/" . $tableName),0777,true);
        }
        $allField = $this -> getAllTableField($origin);
        $fieldNum = count($allField);

        $tableComment = $this -> getTableComment($origin);
        $title = $tableComment[0]["Comment"];

        $template = $this -> templateView($fieldNum, $title, $allField, $tableName, $path);
        file_put_contents(App::getAppPath() . "view/generate/" . $tableName . "/" . $tableName . ".html", $template, FILE_APPEND | LOCK_EX);
        $template = $this -> templateAddEdit($tableName, $allField);
        file_put_contents(App::getAppPath() . "view/generate/" . $tableName . "/add_edit.html", $template, FILE_APPEND | LOCK_EX);

        return 1;
    }

    public function generateController($tableName){
        $origin = $tableName;
        $tableName = str_replace("_","",$tableName);
        $allField = $this -> getAllTableField($origin);
        $template = $this -> templateController($tableName, $allField, $origin);
        $tableName = ucwords($tableName);

        if (file_exists(App::getAppPath() . "controller/" . $tableName . ".php")){
            unlink(App::getAppPath() . "controller/" . $tableName . ".php");
        }
        file_put_contents(App::getAppPath() . "controller/" . $tableName . ".php", $template, FILE_APPEND | LOCK_EX);

        return 1;
    }

    public function getAllTables(){
        $str = "SHOW TABLES";
        return Db::query($str);
    }

    public function getAllTableField($tableName){
        $str = "SHOW FULL FIELDS FROM ".$tableName;
        return Db::query($str);
    }

    public function getTableComment($tableName){
        $str = "SHOW TABLE STATUS LIKE '$tableName'";
        return Db::query($str);
    }

    public function templateRoute($tableName){
        $tableName = str_replace("_","",$tableName);
        $lower = $tableName;
        $upper = ucwords($tableName);
return
"<?php
/**
 * 此路由为代码生成
 * 作者：Shane
 */
use think\\facade\Route;
use \app\admin\middleware\Auth;
use \app\admin\middleware\IsLogin;
/*
                          _ooOoo_
                         o8888888o
                         88\" . \"88
                         (| -_- |)
                         O\  =  /O
                      ____/`---'\____
                    .'  \\|     |//  `.
                   /  \\|||  :  |||//  \
                  /  _||||| -:- |||||-  \
                  |   | \\\  -  /// |   |
                  | \_|  ''\---/''  |   |
                  \  .-\__  `-`  ___/-. /
                ___`. .'  /--.--\  `. . __
             .\"\" '<  `.___\_<|>_/___.'  >'\"\".
            | | :  `- \`.;`\ _ /`;.`/ - ` : | |
            \  \ `-.   \_ __\ /__ _/   .-` /  /
       ======`-.____`-.___\_____/___.-`____.-'======
                          `=---='
       ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
                    佛祖保佑       永无BUG
       */

Route::group(function () {
    Route::rule('$upper/view', '/admin/$upper/view', 'GET');
    Route::rule('$upper/viewAddEdit', '/admin/$upper/viewAddEdit', 'GET');
    Route::rule('$upper/retrieveData', '/admin/$upper/retrieveData', 'POST');
    Route::rule('$upper/updateData', '/admin/$upper/updateData', 'POST');
    Route::rule('$upper/deleteData', '/admin/$upper/deleteData', 'POST');
    Route::rule('$upper/createData', '/admin/$upper/createData', 'POST');
    Route::rule('$upper/seeAll', '/admin/$upper/seeAll', 'POST');
    Route::rule('$upper/batchDeleteData', '/admin/$upper/batchDeleteData', 'POST');
    Route::rule('$upper/export_file', '/admin/$upper/export_file', 'GET');
}) -> middleware(IsLogin::class) -> middleware(Auth::class);
";
    }

    public function templateAddEditJS($tableName, $allField){
        $lower = $tableName;
        $upper = ucwords($tableName);
        $str1 = '';$str2 = '';$str3 = '';
        foreach ($allField as $key){
            $str1 .= "$('#".$key['Field']."').val(res.result[0]['".$key['Field']."']);";
        }
        foreach ($allField as $key){
            $str2 .= "var ".$key['Field']." = $('#".$key['Field']."').val();";
        }
        foreach ($allField as $key){
            $str3 .= $key['Field'].":".$key['Field'].",";
        }
        $str3 = rtrim($str3, ',');
return
"/**
 * 此控制器为代码生成
 * 作者：Shane
 */
$(document).ready(function() {
    var url = location.search; //获取url中\"?\"符后的字串
    url=decodeURI(url);
    var theRequest = new Object();
    if (url.indexOf(\"?\") != -1) {
        var str = url.substr(1);
        strs = str.split(\"&\");
        for(var i = 0; i < strs.length; i ++) {
            theRequest[strs[i].split(\"=\")[0]]=unescape(strs[i].split(\"=\")[1]);
        }
    }
    var target=theRequest.id;
    var FILE = null;
    $.ajaxSetup({async:false});
    $.getJSON(\"/assets/js/admin/route.json\", \"\", function(data) {
        FILE = data.FILE;
    });
    if(target != -1){
        $.ajax({
            type : \"POST\",
            contentType : \"application/x-www-form-urlencoded\",
            url : '/' + FILE + '/$upper/retrieveData',
            data : {
                key:'id',
                value:target
            },
            success : function(res) {
                $str1
            }
        });
    
        $(\"#commit\").click(function() {
            $str2

            $.ajax({
                type : \"POST\",
                contentType: \"application/x-www-form-urlencoded\",
                url : '/' + FILE + '/$upper/updateData',
                data : {
                    target:target,
                    $str3
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
        $(\"#commit\").click(function() {
            $str2
            $.ajax({
                type : \"POST\",
                contentType: \"application/x-www-form-urlencoded\",
                url : '/' + FILE + '/$upper/createData',
                data : {
                    $str3
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

";
    }

    public function templateJS($tableName, $allField){
        $lower = $tableName;
        $upper = ucwords($tableName);
        $str = '';
        foreach ($allField as $key){
            $str .= "\"<td>\"+key['".$key['Field']."']+\"</td>\" +";
        }

return
"/**
 * 此控制器为代码生成
 * 作者：Shane
 */
$(document).ready(function(){
    var FILE = null;
    $.ajaxSetup({async:false});
    $.getJSON(\"/assets/js/admin/route.json\", \"\", function(data) {
        FILE = data.FILE;
    });
    $(document).ready(function(){

        $.ajax({
            type : \"POST\",
            contentType : \"application/x-www-form-urlencoded\",
            url : '/' + FILE + '/$upper/seeAll',
            success : function(res) {
                var i = 1;
                $(\"#data_num\").append(
                    \"<strong>\"+res.result.length+\"</strong>\"
                );
                for(let key of res.result){

                    $(\"#dataRoom\").append(
                        \"<tr>\" +
                            \"<td><input type='checkbox' name='multiple' value=\"+key['id']+\"></td>>\" +
                            $str
                            \"<td class='td-manage'>\" +
                                \"<span class='label label - success radius'><a onClick='edit(\"+key['id']+\")'>编辑</a></span>\" +
                                \"<span class='label radius'><a onClick='delete_single(\"+key['id']+\")'>删除</a></span>\" +
                            \"</td>\" +
                        \"</tr>\"
                    );
                    i++;
                }

            }
        });

    });
    $(\"#add\").click(function(){
        layer_show('添加', '/' + FILE + '/$upper/viewAddEdit?id=-1', 800, 500);
    })
    $(\"#batchDelete\").click(function(){
        var ids = [], i = 1;
        $(\"input[name='multiple']:checked\").each(function(index, key){
            ids[i] = $(key).val();
            i++;
        });

        $.ajax({
            type : \"POST\",
            contentType: \"application/x-www-form-urlencoded\",
            url : '/' + FILE + '/$upper/batchDeleteData',
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
$(\"#search_send\").click(function(){
    var FILE = null;
    $.ajaxSetup({async:false});
    $.getJSON(\"/assets/js/admin/route.json\", \"\", function(data) {
        FILE = data.FILE;
    });
    var searchKey = $(\"#searchKey\").val();
    var searchValue = $(\"#searchValue\").val();
    $.ajax({
        type : \"POST\",
        contentType: \"application/x-www-form-urlencoded\",
        url : '/' + FILE + '/$upper/retrieveData',
        data : {
            key:searchKey,
            value:searchValue
        },
        success : function(res) {
            if(res.status == 200){
                $(\"#data_num\").remove();
                $(\"#dataRoom\").remove();
                $(\"#num_room\").append(
                    \"<strong id='data_num'>\"+res.result.length+\"</strong>\"
                );
                $(\"#dataSingleSet\").append(
                    \"<tbody id='dataRoom'></tbody>\"
                );
                var i = 1;
                for(let key of res.result){
                    $(\"#dataRoom\").append(
                        \"<tr>\" +
                            \"<td><input type='checkbox' name='multiple' value=\"+key['id']+\"></td>\" +
                            $str
                            \"<td class='td-manage'>\" +
                                \"<span class='label label - success radius'><a onClick='edit(\"+key['id']+\")'>编辑</a></span>\" +
                                \"<span class='label radius'><a onClick='delete_single(\"+key['id']+\")'>删除</a></span>\" +
                            \"</td>\" +
                        \"</tr>\"
                    );
                    i++;
                }
            }
        }
    });
})

$(\"#search_data_export_file\").click(function(){
    var FILE = null;
    $.ajaxSetup({async:false});
    $.getJSON(\"/assets/js/admin/route.json\", \"\", function(data) {
        FILE = data.FILE;
    });
    var searchKey = $(\"#searchKey\").val();
    var searchValue = $(\"#searchValue\").val();
    setTimeout(location.href='/' + FILE + '/$upper/export_file?key=' + searchKey + '&value=' + searchValue, 1000);
})

function edit(id) {
    var FILE = null;
    $.ajaxSetup({async:false});
    $.getJSON(\"/assets/js/admin/route.json\", \"\", function(data) {
        FILE = data.FILE;
    });
    layer_show('编辑', '/' + FILE + '/$upper/viewAddEdit?id=' + id, 800, 500);
}

function delete_single(id) {
    var FILE = null;
    $.ajaxSetup({async:false});
    $.getJSON(\"/assets/js/admin/route.json\", \"\", function(data) {
        FILE = data.FILE;
    });
    $.ajax({
        type : \"POST\",
        contentType: \"application/x-www-form-urlencoded\",
        url : '/' + FILE + '/$upper/deleteData',
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

";
    }

    public function templateAddEdit($tableName, $allField){
        $str = '';
        foreach ($allField as $field){
            $str .= "
            <div class=\"row clearfix\">
		        <label class=\"form-label col-xs-4 col-sm-3\">".$field['Comment']."</label>
		        <div class=\"form-controls col-xs-8 col-sm-9\">
			        <input type=\"text\" class=\"input-text\" id=\"".$field['Field']."\">
		        </div>
	        </div>
            ";
        }

return "
<!DOCTYPE HTML>
<html>
<head>
	{include file=\"public/_meta\" /}
</head>
<body style=\"background-color:#fff\">
<div class=\"wap-container\">
	<div class=\"panel\">
		<div class=\"panel-body\">
			<form class=\"form form-horizontal\" id=\"form-admin-add\">
	            $str
	            <div class=\"row clearfix\">
					<div class=\"col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3\">
						<input id='commit' class=\"btn btn-primary radius\" type=\"button\" value=\"&nbsp;&nbsp;提交&nbsp;&nbsp;\">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
{include file=\"public/_footer\" /}
<script src=\"/assets/js/admin/generate/$tableName/add.edit.js\"></script>
</body>
</html>
";
    }

    public function templateView($fieldNum, $title, $allField, $tableName, $path){
        $file = $this -> FILE;
        $upper = ucwords($tableName);
        $fieldNum += 2;
        $str = '';$str1 = '';
        foreach ($allField as $field){
            $str .= "<th id='".$field['Field']."'>".$field['Comment']."</th>";
        }
        foreach ($allField as $field){
            $str1 .= "<option value='".$field['Field']."'>".$field['Comment']."</option>";
        }
return
"<!DOCTYPE html>
<html lang=\"en\">
<head>
    {include file=\"public/_meta\" /}
</head>
<body>

<div class=\"wap-container\">
    <nav class=\"breadcrumb\" style=\"background-color:#fff;padding: 0 24px\">
        首页
        <span class=\"c-gray en\">/</span>
        $path
        <span class=\"c-gray en\">/</span>
        $title
        <a class=\"btn btn-success radius f-r\" style=\"line-height:1.6em;margin-top:3px\" href=\"javascript:location.replace(location.href);\" title=\"刷新\" ><i class=\"Hui-iconfont\">&#xe68f;</i></a>
    </nav>

    <article class=\"Hui-admin-content clearfix\">

        <div class=\"row clearfix\">
            <div class=\"col-xs-12 col-sm-6 col-md-4\">
                <div class=\"row clearfix mb-10\">
                    <span class=\"col-xs-4 form-item-label\">键：</span>
                    <span class=\"col-xs-8 form-item-control\">
                        <span class=\"select-box\">
                            <select id=\"searchKey\" class=\"select\">
                                $str1
                            </select>
                        </span>
                    </span>
                </div>
            </div>

            <div class=\"col-xs-12 col-sm-6 col-md-4\">
                <div class=\"row clearfix mb-10\">
                    <span class=\"col-xs-4 form-item-label\">值：</span>
                    <span class=\"col-xs-8 form-item-control\">
                        <input type=\"text\" id=\"searchValue\" placeholder=\"输入...\" class=\"input-text\" />
                    </span>
                </div>
            </div>
            <div class=\"col-xs-12 col-sm-6 col-md-4\">
                <div class=\"row clearfix\">
                    <span class=\"col-xs-4 form-item-control\">
                        <button id=\"search_send\" class=\"btn btn-success radius\" type=\"button\"><i class=\"Hui-iconfont\">&#xe665;</i> 查询</button>
                    </span>
                </div>
            </div>
            <div class=\"col-xs-12 col-sm-6 col-md-4\">
                <div class=\"row clearfix\">
                    <span class=\"col-xs-4 form-item-control\">
                        <button id=\"search_data_export_file\" class=\"btn btn-success radius\" type=\"button\"><i class=\"Hui-iconfont\">&#xe665;</i> 导出查询查询</button>
                    </span>
                </div>
            </div>
        </div>
        
        <div class=\"panel mt-20\">
            <div class=\"panel-body\">
                <div class=\"clearfix\">
					<span class=\"f-l\">
				        <a href=\"/$file/$upper/export_file\" class=\"btn btn-primary radius\">
                            <i class=\"Hui-iconfont\">&#xe644;</i> 导出Excel
                        </a>
					    <a id='batchDelete' href=\"#\" class=\"btn btn-danger radius\">
						    <i class=\"Hui-iconfont\">&#xe6e2;</i> 批量删除
						</a>
				        <a id=\"add\" href=\"#\" class=\"btn btn-primary radius\">
							<i class=\"Hui-iconfont\">&#xe600;</i> 添加数据
					    </a>
					</span>
					<span class=\"f-r\" id='num_room'>共有数据：<strong id='data_num'></strong> 条</span>
                </div>
                <div class=\"mt-20 clearfix\">
                    <table id='dataSingleSet' class=\"table table-border table-bordered table-bg table-hover table-sort\">
                        <thead>
                            <tr>
                                <th scope=\"col\" colspan=\"$fieldNum\">$title</th>
                            </tr>
                            <tr class=\"text-c\">
                                <th></th>
                                $str
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody id='dataRoom'>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </article>
</div>
{include file=\"public/_footer\" /}
<script src=\"/assets/js/admin/generate/$tableName/$tableName.js\"></script>

</body>
</html>
";
    }

    public function templateController($tableName, $allField, $origin){
        $str = '';$str1 = '';$str2 = '';$i = 'A';$str3 = '';$j = 'A';
        foreach($allField as $key){
            $str .= "'".$key['Field']."',";
        }
        $str = rtrim($str, ',');
        foreach($allField as $key){
            $str1 .= "\$".$key['Field']." = isset(\$value['".$key['Field']."']) ? \$value['".$key['Field']."'] : '';";
        }
        foreach($allField as $key){
            $str2 .= "->setCellValue('$i'.\$num, \"$".$key['Field']."\")";
            $i++;
        }
        foreach($allField as $key){
            $str3 .= "->setCellValue('$j'.'1', \"".$key['Comment']."\")";
            $j++;
        }

        $lower = $tableName;
        $upper = ucwords($tableName);
return
"<?php
/**
 * 此控制器为代码生成
 * 作者：Shane
 */
namespace app\admin\controller;
use app\common\business\lib\BaseMethod;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use think\\facade\View;
class $upper extends BaseMethod {

    public function view(){
        return View::fetch('generate/$lower/$lower');
    }

    public function viewAddEdit(){
        return View::fetch('generate/$lower/add_edit');
    }

    public function retrieveData(){
        \$key = \$this -> request -> param(\"key\", '', 'trim');
        \$value = \$this -> request -> param(\"value\", '', 'trim');
        return \$this -> show(
            config(\"status.success\"),
            config(\"message.success\"),
            \$this -> Retrieve('$origin', \$key, \$value)
        );
    }
    
    public function updateData(){
        \$id = \$this -> request -> param(\"target\", '', 'trim');
        \$data = \$this -> request -> param([$str]);
        \$backInfo = \$this -> Update('$origin', \$id ,\$data);
        return \$this -> show(
            config(\"status.success\"),
            config(\"message.success\"),
            \"更改了\".\$backInfo.\"条数据\"
        );
    }
    
    public function deleteData(){
        \$id = \$this -> request -> param(\"target\", '', 'trim');
        return \$this -> show(
            config(\"status.success\"),
            config(\"message.success\"),
            \$this -> Delete('$origin', \$id)
        );
    }
    
    public function createData(){
        \$data = \$this -> request -> param();
        \$backInfo = \$this -> Create('$origin', \$data);
        if(\$backInfo == 1){
            return \$this -> show(
                config(\"status.success\"),
                config(\"message.success\"),
                NULL
            );
        }
        return \$this -> show(
            config(\"status.failed\"),
            config(\"message.failed\"),
            \$backInfo
        );
    }
    
    public function seeAll(){
        return \$this -> show(
            config(\"status.success\"),
            config(\"message.success\"),
            \$this -> throwAll('$origin')
        );
    }
    
    public function batchDeleteData(){
        \$ids = \$this -> request -> param(\"ids\", '', 'trim');
        return \$this -> show(
            config(\"status.success\"),
            config(\"message.success\"),
            \$this -> batchDelete('$origin', \$ids)
        );
    }
    
    public function export_file(){
        \$key = \$this -> request -> param(\"key\", '', 'trim');
        \$value = \$this -> request -> param(\"value\", '', 'trim');
        \$data = \$this -> throwAll('$origin');
        if(!empty(\$key) && !empty(\$value)){
            \$data = \$this -> Retrieve('$origin', \$key, \$value);
        }
        \$user = session(config('admin.session_user'));
        \$this -> push('$origin', \$data, \$user);
        \$this -> redirect('export');
    }

    private function push(\$title, \$data, \$user){

        \$objPHPExcel = new Spreadsheet();

        \$objPHPExcel->getProperties()->setCreator(\$user)
            ->setLastModifiedBy(\$user)
            ->setTitle(\$title)
            ->setSubject(\$title)
            ->setDescription(\$title)
            ->setKeywords(\"excel\")
            ->setCategory(\"result file\");

        \$objPHPExcel -> setActiveSheetIndex(0) $str3;
    
        foreach(\$data as \$key => \$value){

            \$num = \$key + 2;
            $str1
            \$objPHPExcel -> setActiveSheetIndex(0) $str2;
                
        }

        \$objPHPExcel -> getActiveSheet() -> setTitle('User');
        \$objPHPExcel -> setActiveSheetIndex(0);

        header('Content-Type: application.ms-excel');
        header('Content-Disposition: attachment;filename=\"'.\$title.'.xls\"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        \$objWriter = IOFactory::createWriter(\$objPHPExcel, 'Xls');
        \$objWriter -> save('php://output');
        exit;
    }

}
        ";
    }

}