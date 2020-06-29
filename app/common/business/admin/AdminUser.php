<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/13 上午10:24
 *
 */


namespace app\common\business\admin;
use app\common\model\admin\AdminAuthAccess;
use app\common\model\admin\AdminAuthGroup;
use app\common\model\admin\AdminUser as AdminUserModel;

class AdminUser
{
    private $adminUserModel = null;
    private $adminAuthAccessModel = null;
    private $adminAuthGroupModel = null;

    public function __construct(){
        $this -> adminUserModel = new AdminUserModel();
        $this -> adminAuthAccessModel = new AdminAuthAccess();
        $this -> adminAuthGroupModel = new AdminAuthGroup();
    }

    public function getLoginInfo(){
        $user = session(config('admin.session_user'));
        $group = $this -> adminAuthAccessModel -> findByUserName($user);
        $group_name = $this -> adminAuthGroupModel -> findById($group['group']);
        $data = [];
        $data['username'] = $user;
        $data['group'] = $group_name['name'];
        $data['group_id'] = $group_name['rules'];
        return $data;
    }

    public function updateLoginInfo($key){
        $this -> adminUserModel -> updateLoginTimeAndIp([
            'last_login_time' => time(),
            'last_login_ip' => request() ->ip()
        ], $key);
    }

    public function adminLogin($data){
        $admin = $this -> adminUserModel -> findByUserName($data["username"]);
        if(empty($admin)){
            return config("status.error");
        }
        $password = md5($admin["password_salt"] . $data["password"] . $admin["password_salt"]);

        if($password != $admin["password"]){
            return config("status.failed");
        }

        $this -> updateLoginInfo($data["username"]);
        session(config('admin.session_user'), $data["username"]);
        return config("status.success");
    }

    public function passwordAddSalt($data){

        if(!is_array($data)){
            return config("status.error");
        }

        $salt = $this -> salt();
        $ip = request() -> ip();

        $data['password'] = md5($salt . $data['password'] . $salt);
        $data['password_salt'] = $salt;
        $data['last_login_ip'] = $ip;
        $data['last_login_time'] = time();

        return $data;
    }

    public function add($data){
        return $this -> adminUserModel -> add($this -> passwordAddSalt($data));
    }

    public function salt() {
        // 盐字符集
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for($i = 0; $i < 5; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

}