<?php
namespace app\admin\controller;
use app\common\business\lib\BaseMethod;
use think\facade\View;
class AdminGenerator extends BaseMethod
{

    public function viewAddEdit(){
        return View::fetch('command/add_edit');
    }

    public function retrieveData(){
        $key = $this -> request -> param("key", '', 'trim');
        $value = $this -> request -> param("value", '', 'trim');
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> Retrieve('z_admin_generator', $key, $value)
        );
    }
    
    public function updateData(){
        $id = $this -> request -> param("target", '', 'trim');
        $data = $this -> request -> param(['id','table_name','catalogue_bind','executor','create_time']);
        $backInfo = $this -> Update('z_admin_generator', $id ,$data);
        return $this -> show(
            config("status.success"),
            config("message.success"),
            "更改了".$backInfo."条数据"
        );
    }
    
    public function deleteData(){
        $id = $this -> request -> param("target", '', 'trim');
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> Delete('z_admin_generator', $id)
        );
    }
    
    public function createData(){
        $data = $this -> request -> param();
        $backInfo = $this -> Create('z_admin_generator', $data);
        if($backInfo == 1){
            return $this -> show(
                config("status.success"),
                config("message.success"),
                NULL
            );
        }
        return $this -> show(
            config("status.failed"),
            config("message.failed"),
            $backInfo
        );
    }
    
    public function seeAll(){
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> throwAll('z_admin_generator')
        );
    }
    
    public function batchDeleteData(){
        $ids = $this -> request -> param("ids", '', 'trim');
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> batchDelete('z_admin_generator', $ids)
        );
    }

}
        