<?php
namespace app\admin\controller;
use app\common\business\lib\BaseMethod;
use think\facade\View;
class AdminAuthGroup extends BaseMethod
{

    public function view(){
        return View::fetch('auth/admin_auth_group/admin_auth_group');
    }

    public function viewAddEdit(){
        return View::fetch('auth/admin_auth_group/add_edit');
    }

    public function retrieveData(){
        $key = $this -> request -> param("key", '', 'trim');
        $value = $this -> request -> param("value", '', 'trim');
        $data = $this -> Retrieve('z_admin_auth_group', $key, $value);
        $res = [];
        foreach ($data as $key){
            $rules = explode(',', $key['rules']);
            $str = "可用权限：";
            foreach ($rules as $rule){
                if ($rule == '*'){
                    $str = "超级权限";
                    break;
                }
                if (($rule == NULL) || ($rule == 0)){
                    continue;
                }
                $temp = (new \app\common\model\admin\AdminGenerator()) -> findById($rule);
                $str .= " " . $temp['table_comment'];
            }
            $res[] = [
                'id' => $key['id'],
                'name' => $key['name'],
                'rules' => $str,
                'rules_id' => $rules,
                'create_time' => $key['create_time'],
                'update_time' => $key['update_time']
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
        $data['id'] = $this -> request -> param("id", '', 'trim');
        $data['name'] = $this -> request -> param("name", '', 'trim');
        $data['rules'] = $this -> request -> param("rules", '', 'trim');
        $data['update_time'] = time();
        $backInfo = $this -> Update('z_admin_auth_group', $id ,$data);
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
            $this -> Delete('z_admin_auth_group', $id)
        );
    }

    public function createData(){
        $data['name'] = $this -> request -> param("name", '', 'trim');
        $data['rules'] = $this -> request -> param("rules", '', 'trim');
        $data['create_time'] = time();
        $data['update_time'] = time();
        $backInfo = $this -> Create('z_admin_auth_group', $data);
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
        $data = $this -> throwAll('z_admin_auth_group');
        $res = [];
        foreach ($data as $key){
            $rules = explode(',', $key['rules']);
            $str = "可用权限：";
            foreach ($rules as $rule){
                if ($rule == '*'){
                    $str = "超级权限";
                    break;
                }
                if (($rule == NULL) || ($rule == 0)){
                    continue;
                }
                $temp = (new \app\common\model\admin\AdminGenerator()) -> findById($rule);
                $str .= " " . $temp['table_comment'];
            }
            $res[] = [
                'id' => $key['id'],
                'name' => $key['name'],
                'rules' => $str,
                'create_time' => $key['create_time'],
                'update_time' => $key['update_time']
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
            $this -> batchDelete('z_admin_auth_group', $ids)
        );
    }

    public function seeGenerator(){
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> throwAll('z_admin_generator')
        );
    }

}