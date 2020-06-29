<?php
/**
 *
 *
 * @description:  オラ!オラ!オラ!オラ!
 * @author: Shane
 * @time: 2020/6/27 16:45
 *
 */

namespace think;

require __DIR__ . '/../vendor/autoload.php';

// 执行HTTP应用并响应
$http = (new App())->http;

$response = $http -> name('admin') -> run();

$response->send();

$http->end($response);