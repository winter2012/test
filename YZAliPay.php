<?php
/**
 * Created by PhpStorm.
 * User: Winter
 * Date: 2019/07/26
 * Time: 20:17
 */
date_default_timezone_set('PRC');
$merchant_id = 'Y20190302';
$signKey = 'd6243bbb26b24b38b4717c8b5b4d48dc';
$gateway = 'https://www.yyfcloudpay.cc/WebAPI/Pay.ashx';

$data = [
    'MerNum'        => $merchant_id,
    'OrderNum'      => 'YYF'.date('YmdHis').rand(100,999),
    'Amount'        => 777,
    'NotifyUrl'     => 'http://www.yyf.com/notify.jsp',
    'ReturnUrl'     => 'http://www.yyf.com/home.jsp',
    'NonceStr'      => rand(100000,999999),
    'RechargeType'  => 1,
    'ReturnType'    => 2,
    'Attach'        => 'yyf',
];

ksort($data);
$str = '';
foreach ($data as $key => $value) {
    $str .= $key.'='.$value.'&';
}
$str .= 'Key='.$signKey;
$data['Sign'] = md5($str);
//echo "签名字符串: ".$str." ,签名方法:MD5,签名结果: ".$data['sign']." \n";
//print_r($data);die;
//echo $gateway."&".http_build_query($data);die;

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $gateway);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch);
if( curl_errno($ch) ) {
    echo "curl请求异常,错误码:".curl_errno($ch).",错误信息:".curl_error($ch);die;
}
curl_close($ch);
echo "云信支付宝提交URL: $gateway ,提交参数:".json_encode($data,320).",接收响应:".json_encode(json_decode($response,true),320);
//$result = json_decode($response,true);
//echo $result['data'];