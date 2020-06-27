<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/13 上午10:12
 *
 */


namespace app\common\model\admin;
use think\Model;

class AdminUser extends Model
{

    protected $table = 'z_admin_user';

    public function updateLoginTimeAndIp($data, $key){
        $update = $this -> findByUserName($key);
        return $update ->allowField(['last_login_ip', 'last_login_time']) -> save($data);
    }

    public function findByUserName($data){
        return $this -> where('username', $data) -> find();
    }

    public function add($data){
        $this -> save($data);
        return $this -> id;
    }

}