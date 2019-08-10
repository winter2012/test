<?php
/**
 * Created by PhpStorm.
 * User: Winter
 * Date: 2019/07/26
 * Time: 20:17
 */
date_default_timezone_set('PRC');
$uid= '2498';
$apiKey = '5476FBB07B4255B0C4C6713D91476AF7';
$gateway = 'http://www.gypay.me/payapi/CreateOrder/CreateOrder';

$data = [
    'uid'       => $uid,
    'sn'        => date('YmdHis').rand(100,999),
    'money'     => 600.00,
    'date'      => date('Y-m-d H:i:s'),
    'channel'   => 1,
    'callbak'   => 'http://www.yyf.com/notify'
];

ksort($data);
$str = '';
foreach ($data as $key => $value) {
    $str .= $key.'='.urlencode($value).'&';
}
$str .= 'apikey='.$apiKey;
$data['sign'] = md5($str);
echo "签名字符串:".$str.",签名方法:md5,签名结果:".$data['sign']."\n";

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
echo "盒子支付提交URL:$gateway,提交参数:".json_encode($data,320).",接收响应:".$response;
//$result = json_decode($response,true);
//echo $result['data']['url'];