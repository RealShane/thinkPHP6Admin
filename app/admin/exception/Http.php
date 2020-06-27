<?php

namespace app\admin\exception;
use think\exception\Handle;
use think\Response;
use Throwable;

class Http extends Handle {

    public $httpStatus = 500;

    public function render($request, Throwable $e): Response
    {
        if($e instanceof \think\Exception) {
            return show_res($e -> getCode(), $e -> getMessage(), []);
        }
        if($e instanceof \think\exception\HttpResponseException) {
            return parent::render($request, $e);
        }

        if(method_exists($e, "getStatusCode")) {
            $httpStatus = $e->getStatusCode();
        } else {
            $httpStatus = $this->httpStatus;
        }
        // 添加自定义异常处理机制
        return show_res(config("status.error"), $e -> getMessage(), [], $httpStatus);
    }
}