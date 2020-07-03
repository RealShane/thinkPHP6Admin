<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/24 上午12:23
 *
 */


namespace app\admin\controller;

use app\common\business\admin\AdminUser as AdminUserBusiness;
use app\common\business\lib\BaseMethod;
use app\common\validate\admin\AdminLogin;
use think\exception\ValidateException;
use think\facade\Env;
use think\facade\Filesystem;
use think\facade\View;

class AdminBaseAccess extends BaseMethod
{

    public function adminUserLogin(){
        $this -> isLogin();
        return View::fetch('index/login');
    }

    public function indexView(){
        View::assign('FILE', Env::get('ADMIN.FILE', ''));
        return View::fetch('index/index');
    }

    public function indexWelcome(){
        return View::fetch('index/welcome');
    }

    public function adminInfo(){
        return $this -> show(
            config("status.success"),
            config("message.success"),
            (new AdminUserBusiness) -> getLoginInfo()
        );
    }

    public function adminQuit(){
        session(config('admin.session_user'), NULL);
        return back_admin_login();
    }

    public function adminLogin(){
        $data["username"] = $this -> request -> param("username", '', 'trim');
        $data["password"] = $this -> request -> param("password", '', 'trim');
        $data["validate"] = $this -> request -> param("validate", '', 'trim');
        try{
            validate(AdminLogin::class) -> check($data);
        }catch (ValidateException $exception){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                $exception -> getMessage()
            );
        }
        $errCode = (new AdminUserBusiness()) -> adminLogin($data);
        if ($errCode == config("status.failed")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "密码错误！"
            );
        }
        if ($errCode == config("status.error")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "管理员不存在！"
            );
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $errCode
        );
    }

    public function seeAllTable(){
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> throwAll('z_admin_generator')
        );
    }

    public function seeAllCatalogue(){
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> throwAll('z_catalogue')
        );
    }

    public function isLogin(){
        $user = session(config('admin.session_user'));
        if(!empty($user)){
            return header('location:/' . Env::get('ADMIN.FILE', '') . '/Index');
        }
    }

    public function upload(){
        $file = request() -> file('file');

        if ($file == null) {
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                '未上传图片'
            );
        }

        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);

        if(!in_array($extension, array("jpeg", "jpg", "png"))){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                '上传图片不合法'
            );
        }
        $saveName = Filesystem::disk('public') -> putFile('admin_upload', $file, 'md5');

        return $this -> show(
            config("status.success"),
            config("message.success"),
            str_replace('\\', '/', '/uploads/' . $saveName)
        );
    }
}