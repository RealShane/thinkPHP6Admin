<?php
namespace app\admin\controller;
use app\common\business\lib\BaseMethod;
use app\common\model\admin\Catalogue;
use think\facade\View;
class AdminGenerator extends BaseMethod
{

    public function retrieveData(){
        $key = $this -> request -> param("key", '', 'trim');
        $value = $this -> request -> param("value", '', 'trim');
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> Retrieve('z_admin_generator', $key, $value)
        );
    }
    
    public function seeAll(){
        $data = $this -> throwAll('z_admin_generator');
        $res = [];
        foreach ($data as $key){
            $temp = (new Catalogue()) -> findById($key['catalogue_bind']);
            $icon = $temp['icon'];
            $res[] = [
                'id' => $key['id'],
                'table_name' => $key['table_name'],
                'table_comment' => $key['table_comment'],
                'catalogue_bind' => "<i class=\"Hui-iconfont\">$icon</i>" . $temp['catalogue_name'],
                'executor' => $key['executor'],
                'create_time' => $key['create_time']
            ];
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $res
        );
    }

}
        