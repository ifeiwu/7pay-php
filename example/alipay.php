<html>
    <head>
        <title>支付宝支付</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
        <meta name="format-detection" content="email=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
    </head>
    <body style="padding:20px;">
        
        <?php
        require 'common.php';

        $client = new Pagepan\SevenPayClient(PID, PKEY, NOTIFY_URL, RETURN_URL);

        $url = $client->alipay('0.01', '201911914837526544602', '商品名称', '商品描述');

        header("Location: $url");
        ?>
        
    </body>
</html>