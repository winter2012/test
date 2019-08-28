<?php
/**
 * Created by PhpStorm.
 * User: Winter
 * Date: 2019/07/26
 * Time: 20:17
 */
date_default_timezone_set('PRC');
$mchId = 'xiaoya001';
$apiKey = 'sdjkhf234098234wer';
$gateway = 'http://dpsport.3087zu.cn:9006/order';

$data = [
    'mchId'     => $mchId,
    'orderId'   => date('YmdHis').rand(100,999),
    'payType'   => 2,
    'amount'    => 600.00,
    'randomstr' => rand(1000,9999),
    'timestamp' => time(),
    'ip'        => '127.0.0.1',
    'remarks'   => 'mac'
];

$data['key'] = $apiKey;
ksort($data);
$str = http_build_query($data);
$data['sign'] = md5($str);
unset($data['key']);
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
echo "拼多多支付宝提交URL:$gateway,提交参数:".http_build_query($data).",接收响应:".$response;
//$result = json_decode($response,true);
//echo $result['data']['url'];