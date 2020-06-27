<?php
// 应用公共文件
use think\facade\Env;

function show_res($status, $message, $data, $HttpStatus = 200){
    $result = [
        'status' => $status,
        'message' => $message,
        'result' => $data
    ];
    return json($result, $HttpStatus);
}

function back_admin_login(){
    $temp = Env::get('ADMIN.FILE', '');
    return redirect('/' . $temp . '/Login');
}

function back_admin_index(){
    $temp = Env::get('ADMIN.FILE', '');
    return redirect('/' . $temp . '/Index');
}

