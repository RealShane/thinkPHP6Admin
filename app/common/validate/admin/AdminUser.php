<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/13 上午9:59
 *
 */


namespace app\common\validate\admin;
use think\Validate;

class AdminUser extends Validate
{
    protected $rule = [
        'username' => 'require|max:20',
        'password' => 'require|max:20'
    ];
}