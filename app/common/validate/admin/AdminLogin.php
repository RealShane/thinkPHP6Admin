<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/14 上午11:56
 *
 */


namespace app\common\validate\admin;
use think\Validate;

class AdminLogin extends Validate
{

    protected $rule = [
        'username' => 'require|max:20',
        'password' => 'require|max:20',
        'validate' => 'require|captcha'
    ];

    protected $message  =   [
        'username.require' => '用户名不为空',
        'username.max' => '用户名不超过20个字符',
        'password.require' => '密码不为空',
        'password.max' => '密码不超过20个字符',
        'validate.require' => '验证码不为空',
        'validate.captcha' => '验证码错误'
    ];
}