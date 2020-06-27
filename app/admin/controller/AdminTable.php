<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/17 上午9:55
 *
 */


namespace app\admin\controller;
use app\BaseController;
use think\facade\Env;
use app\common\business\admin\AdminTable as AdminTableBusiness;


class AdminTable extends BaseController
{

    public function getAllTable(){
        $adminTableBusiness = new AdminTableBusiness();
        return $this -> show(
            config("status.success"),
            Env::get('database.database', ''),
            $adminTableBusiness -> getAllTables()
        );

    }

    public function codeGenerator(){
        $tableName = $this -> request -> param("tableName", '', 'trim');
        $path = $this -> request -> param("catalogue", '', 'trim');

        if($tableName == NULL){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "参数错误！"
            );
        }
        $adminTableBusiness = new AdminTableBusiness();
        $isSuccessController = $adminTableBusiness -> generateController($tableName);
        $isSuccessView = $adminTableBusiness -> generateView($tableName, $path);
        $isSuccessJS = $adminTableBusiness -> generateJS($tableName);
        $isSuccessRoute = $adminTableBusiness -> generateRoute($tableName);

        if($isSuccessController && $isSuccessView && $isSuccessJS && $isSuccessRoute){
            $user = session(config('admin.session_user'));
            $tableComment = $adminTableBusiness -> getTableComment($tableName);
            $tableComment = $tableComment[0]['Comment'];
            return $this -> show(
                config("status.success"),
                config("message.success"),
                $adminTableBusiness -> generateInfo($tableName, $tableComment, $path, $user)
            );
        }
        return $this -> show(
            config("status.failed"),
            config("message.failed"),
            NULL
        );
    }


}