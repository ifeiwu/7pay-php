<?php
define('ROOT_PATH', dirname(__DIR__) . '/');

// 所有错误和异常记录
ini_set('error_reporting', E_ALL & ~E_NOTICE);
ini_set('display_errors', false);
ini_set('log_errors', true);
ini_set('error_log', ROOT_PATH . 'error.log');

// https://7-pay.cn/member/【会员中心 -> 支付渠道 -> API安全】
define('PID', 'xxxxxx');
define('PKEY', 'xxxxxx');

define('NOTIFY_URL', 'http://www.domain.com/notify_url.php'); // 异步通知页面
define('RETURN_URL', 'http://www.domain.com/return_url.php'); // 交易跳转页面

require_once ROOT_PATH . 'vendor/autoload.php';

// 格式化输出
function dump($value)
{
    if ( is_array($value) )
    {
        echo '<pre>' . print_r($value, 1) . '</pre>';
    }
    else
    {
        var_dump($value);
    }
}