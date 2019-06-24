<?php
$md5Key = "";
$signData = [
    'merchant_no'=> "169133",
    'order_id'   => "502738",
    'order_time' => "2019-06-14 18:06:42",
    'pay_type'   => "wechat_qr",
    'amount'     => "250.00",
    'notify_url' => "http://js22.wktdjk.cn/Home/notify/organ/169133"
];
ksort($signData);
$str = '';
foreach ($signData as $key => $value) {
    if($value != ''){
        $str .= $key.'='.$value.'&';
    }
}
$str .= 'key='.$md5Key;
$sign = strtolower(md5($str));
echo $sign;