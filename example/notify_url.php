<?php
require 'common.php';

$data = $_GET ?: [];

$client = new Pagepan\SevenPayClient(PID, PKEY, NOTIFY_URL, RETURN_URL);

if ( $client->checkSign($data) == true )
{

    // 请在此处处理你的业务逻辑
    // 支付成功的信息会多次向该页面发送请求，请注意去除重复。

    echo 'success';
}
else
{
    echo 'fail';
}