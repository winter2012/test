<?php
/**
 * Created by PhpStorm.
 * User: Winter
 * Date: 2019/07/26
 * Time: 20:17
 */
date_default_timezone_set('PRC');
$uid= '1360';
$signKey = 'DA2378DB3A372F0EEC6D6CD46D03B687';
$gateway = 'http://www.wegopay.me/payapi/Index/payindex';

$data = [
    'merchant_order_uid'                    => $uid,
    'merchant_order_sn'                     => date('YmdHis').rand(100,999),
    'merchant_order_money'                  => 600.00,
    'merchant_order_date'                   => date('Y-m-d H:i:s'),
    'merchant_order_callbak_confirm_duein'  => 'http://www.yyf.com/notify'
];

ksort($data);
$str = http_build_query($data);
$str .= "&apikey=" . $signKey;
$data['merchant_order_sign'] = md5($str);
echo "签名字符串:".$str.",签名方法:md5,签名结果:".$data['merchant_order_sign']."\n";

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $gateway);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: multipart/form-data']);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch);
if( curl_errno($ch) ) {
    exit("curl请求异常,错误码:".curl_errno($ch).",错误信息:".curl_error($ch));
}
curl_close($ch);
echo "提交URL:$gateway,提交参数:".json_encode($data,320).",接收响应:".$response;
//$result = json_decode($response,true);
//echo $result['data']['url'];