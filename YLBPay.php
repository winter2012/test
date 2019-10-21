<?php
/**
 * Created by PhpStorm.
 * User: Winter
 * Date: 2019/07/26
 * Time: 20:17
 */
date_default_timezone_set('PRC');
$merchant_id = 'YB19092320251';
$signKey = '292950ca5748155a2df573bbef636a02';
$gateway = 'http://www.yironpay.cn/api/v3/cashier.php';

$data = [
    'merchant'  => $merchant_id,
    'qrtype'    => 'ap',
    'customno'  => 'YF'.date('YmdHis').rand(100,999),
    'money'     => 777,
    'sendtime'  => time(),
    'notifyurl' => 'http://www.yyf.com/notify.jsp',
    'backurl'   => 'http://www.yyf.com/home.jsp',
    'risklevel' => ''
];

$str = "merchant=$data[merchant]&qrtype=$data[qrtype]&customno=$data[customno]&money=$data[money]&sendtime=$data[sendtime]&notifyurl=$data[notifyurl]&backurl=$data[backurl]&risklevel=$data[risklevel]".$signKey;

$data['sign'] = md5($str);
//echo "签名字符串:".$str.",签名方法:MD5,签名结果:".$data['sign']."\n";

//print_r($data);die;
//echo $gateway."?".http_build_query($data);die;

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
echo "168支付宝提交URL: $gateway ,提交参数:".json_encode($data,320).",接收响应:".json_encode(json_decode($response,true),320);
//$result = json_decode($response,true);
//echo $result['data']['payUrl'];