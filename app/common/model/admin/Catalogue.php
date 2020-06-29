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

class Catalogue extends Model
{

    protected $table = 'z_catalogue';

    protected $autoWriteTimestamp = false;

    public function findById($id){
        return $this -> where('id', $id) -> find();
    }

}