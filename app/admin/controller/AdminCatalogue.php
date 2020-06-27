<?php
namespace app\admin\controller;
use app\common\business\lib\BaseMethod;
use think\facade\View;
class AdminCatalogue extends BaseMethod
{

    public function retrieveData(){
        $key = $this -> request -> param("key", '', 'trim');
        $value = $this -> request -> param("value", '', 'trim');
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> Retrieve('z_catalogue', $key, $value)
        );
    }
    
    public function updateData(){
        $id = $this -> request -> param("target", '', 'trim');
        $data = $this -> request -> param(['id','catalogue_name', 'icon', 'executor','create_time']);
        $backInfo = $this -> Update('z_catalogue', $id ,$data);
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
            $this -> Delete('z_catalogue', $id)
        );
    }
    
    public function createData(){
        $data['catalogue_name'] = $this -> request -> param("catalogue_name", '', 'trim');
        $data['icon'] = $this -> request -> param("icon", '', 'trim');
        $data['executor'] = session(config('admin.session_user'));
        $backInfo = $this -> Create('z_catalogue', $data);
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
            $this -> throwAll('z_catalogue')
        );
    }
    
    public function batchDeleteData(){
        $ids = $this -> request -> param("ids", '', 'trim');
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> batchDelete('z_catalogue', $ids)
        );
    }

}
        