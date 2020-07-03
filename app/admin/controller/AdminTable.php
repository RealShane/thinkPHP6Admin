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
        $errCode = $adminTableBusiness -> generate($tableName, $path);
        if ($errCode == config("status.failed")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "未知原因生成失败！"
            );
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $errCode
        );
    }


}