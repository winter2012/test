<?php
/**
 * Created by PhpStorm.
 * User: Winter
 * Date: 2019/07/26
 * Time: 20:17
 */
date_default_timezone_set('PRC');
$merchant_id = '809';
$signKey = 'YVVmZklhcGRl2krFeU2XGBcuVCyZdvse';
$gateway = 'http://a530709666tidan.699dz.com/api/order-add';

$data = [
    'merchant_id'       => $merchant_id,
    'order_no'          => 'SZ'.date('YmdHis').rand(100,999),
    'type'              => 'ALIPAYQR',
    'amount'            => 800,
    'user_identifier'   => rand(1000000,9999999),
    'callback_url'      => 'http://www.yyf.com/notify.jsp'
];

$signData = $data;
ksort($signData);
$str = '';
foreach ($signData as $key => $value) {
    $str .= $key.'='.$value.'&';
}
$str .= 'key='.$signKey;

$data['sign'] = md5($str);
//echo "签名字符串:".$str.",签名方法:MD5,签名结果:".$data['sign']."\n";
$data['return_url'] = 'http://www.yyf.com/home.jsp';

//print_r($data);die;
echo $gateway."?".http_build_query($data);die;

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $gateway);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch);
if( curl_errno($ch) ) {
    exit("curl请求异常,错误码:".curl_errno($ch).",错误信息:".curl_error($ch));
}
curl_close($ch);
echo "通付提交URL: $gateway ,提交参数:".json_encode($data,320).",接收响应:".json_encode(json_decode($response,true),320);
//$result = json_decode($response,true);
//echo $result['data']['payUrl'];