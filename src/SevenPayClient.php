<?php

namespace Pagepan;

class SevenPayClient
{
    public $base_url = 'https://v2.7-pay.cn/';

    public $pid;

    public $pkey;

    public $notify_url;

    public $return_url;


    /**
     * @param string $pid 商户ID
     * @param string $pkey 商户密钥
     * @param string $notify_url 异步通知页面
     * @param string $return_url 交易跳转页面
     */
    public function __construct(string $pid, string $pkey, string $notify_url, string $return_url)
    {
        $this->pid = $pid;
        
        $this->pkey = $pkey;

        $this->notify_url = $notify_url;

        $this->return_url = $return_url;
    }


    /**
     * 返回支付宝付款页面链接
     * @param string $money
     * @param string $out_trade_no
     * @param string $name
     * @param string $param
     * @return string
     */
    public function alipay(string $money, string $out_trade_no, string $name, string $param = ''): string
    {
        return $this->payurl('alipay', $money, $out_trade_no, $name, $param);
    }

    /**
     * 返回微信付款页面链接
     * @param string $money
     * @param string $out_trade_no
     * @param string $name
     * @param string $param
     * @return string
     */
    public function wxpay(string $money, string $out_trade_no, string $name, string $param = ''): string
    {
        return $this->payurl('wxpay', $money, $out_trade_no, $name, $param);
    }


    /**
     * 返回支付宝或微信付款页面链接
     * 
     * @link https://v2.7-pay.cn/member/doc2.php
     * @example example/alipay.php
     *
     * @param string $type 支付方式
     * @param string $money 订单金额
     * @param string $out_trade_no 商户订单号
     * @param string $name 商品名称
     * @param string $param 商品描述
     *
     * @return array
     */
    public function payurl(string $type, string $money, string $out_trade_no, string $name, string $param = ''): string
    {
        $data = [
            'pid' => $this->pid,
            'type' => $type,
            'name' => $name,
            'money' => $money,
            'param' => $param,
            'sign_type' => 'MD5',
            'out_trade_no' => $out_trade_no,
            'notify_url' => $this->notify_url,
            'return_url' => $this->return_url
        ];

        $url = $this->buildQuery($data);

        $sign = $this->sign($url);

        return $this->base_url . 'submit.php?' . $url . '&sign='.$sign;
    }


    /**
     * 异步通知（notify_url）签名验证
     * @param array $data 交易参数
     * @return bool
     */
    public function checkSign(array $data): bool
    {
        $pay_sign = strtolower($data['sign']); // 提取官方签名

        unset($data['sign'], $data['sign_type']); // 排除不需要生成签名的参数

        $url = $this->buildQuery($data);

        $my_sign = $this->sign($url); // 生成自己的签名

        return $my_sign == $pay_sign ? true : false; // 自己签名和官方签名匹对
    }


    /**
     * 生成签名
     *
     * @param array $data
     *
     * @return string
     */
    public function sign(string $url): string
    {
        return strtolower(md5($url . $this->pkey));
    }


    /**
     * 数组参数转URL拼接参数
     * @param array $data
     * @return string
     */
    public function buildQuery(array $data): string
    {
        // 过虑空值：''
        $data = array_filter($data, function($v) {
            return $v !== '';
        });

        ksort($data); // 参数名从小到大排序（a-z）

        return urldecode(http_build_query($data));
    }

}