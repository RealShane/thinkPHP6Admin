<?php
namespace app\admin\controller;
use app\common\business\lib\BaseMethod;
use think\facade\View;
class AdminAuthAccess extends BaseMethod
{

    public function view(){
        return View::fetch('auth/admin_auth_access/admin_auth_access');
    }

    public function viewAddEdit(){
        return View::fetch('auth/admin_auth_access/add_edit');
    }

    public function retrieveData(){
        $key = $this -> request -> param("key", '', 'trim');
        $value = $this -> request -> param("value", '', 'trim');
        $data = $this -> Retrieve('z_admin_auth_access', $key, $value);
        $res = [];
        foreach ($data as $key){
            $temp = (new \app\common\model\admin\AdminAuthGroup()) -> findById($key['group']);
            $res[] = [
                'id' => $key['id'],
                'username' => $key['username'],
                'group_id' => $key['group'],
                'group' => $temp['name']
            ];
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $res
        );
    }
    
    public function updateData(){
        $id = $this -> request -> param("target", '', 'trim');
        $data = $this -> request -> param(['id','username','group']);
        $backInfo = $this -> Update('z_admin_auth_access', $id ,$data);
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
            $this -> Delete('z_admin_auth_access', $id)
        );
    }
    
    public function createData(){
        $data = $this -> request -> param();
        $backInfo = $this -> Create('z_admin_auth_access', $data);
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
        $data = $this -> throwAll('z_admin_auth_access');
        $res = [];
        foreach ($data as $key){
            $temp = (new \app\common\model\admin\AdminAuthGroup()) -> findById($key['group']);
            $res[] = [
                'id' => $key['id'],
                'username' => $key['username'],
                'group' => $temp['name']
            ];
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $res
        );
    }
    
    public function batchDeleteData(){
        $ids = $this -> request -> param("ids", '', 'trim');
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> batchDelete('z_admin_auth_access', $ids)
        );
    }

    public function seeAuthGroup(){
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> throwAll('z_admin_auth_group')
        );
    }

}
        