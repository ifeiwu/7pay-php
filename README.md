# 7支付

[7Pay](https://7-pay.cn/)（7Pay PHP SDK）是为个人而打造，安全，正规，低门槛的支付能力服务。

## 申请流程

##### [注册7pay](https://7-pay.cn/reg.php) -> [支付渠道](https://7-pay.cn/member/channel.php)

## 快速安装
```
composer require ifeiwu/7pay-php
```

## 开始使用

```php
require_once 'vendor/autoload.php';

$client = new Pagepan\SevenPayClient(PID, PKEY, NOTIFY_URL, RETURN_URL);
```

### 支付宝
###### 适用于网页端或扫码支付
```php
// 完整的例子：example/alipay.php

$url = $client->alipay('0.01', '201911914837526544602', '商品名称', '商品描述');

Header("Location: $url");
```
