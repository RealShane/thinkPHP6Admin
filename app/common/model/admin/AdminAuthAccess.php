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

class AdminAuthAccess extends Model
{

    protected $table = 'z_admin_auth_access';

    protected $autoWriteTimestamp = false;

    public function findByUserName($data){
        return $this -> where('username', $data) -> find();
    }

}