<?php
/**
 * Created by PhpStorm.
 * User: Winter
 * Date: 2019/07/26
 * Time: 20:17
 */
date_default_timezone_set('PRC');
$merchant_id = 'm56040';
$signKey = 'p1jHw21q1XHw2ixvPQUEQp4qWj3uyC4lZJemeXs2v8y';
$gateway = 'http://aj5.jdf409.cn/ajw/pay.do?method=pay';

$data = [
    'out_trade_no'  => 'SZH'.date('YmdHis').rand(100,999),
    'mch_uid'  => $merchant_id,
    'total_fee'  => 777,
    'pay_type'  => 2,
    'notify_url'  => 'http://www.szh.com/notify.jsp',
    'timestamp'  => time().rand(100,999),
    'return_url'  => 'http://www.szh.com/home.jsp'
];

$str = "mch_uid=$data[mch_uid]&notify_url=$data[notify_url]&out_trade_no=$data[out_trade_no]&pay_type=$data[pay_type]&return_url=$data[return_url]&timestamp=$data[timestamp]&total_fee=$data[total_fee]".$signKey;

$data['sign'] = md5($str);
//echo "签名字符串: ".$str." ,签名方法:MD5,签名结果: ".$data['sign']." \n";
//print_r($data);die;
echo "GET请求地址和参数: ".$gateway."&".http_build_query($data);die;

$gateway = $gateway."&".http_build_query($data);

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $gateway);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch);
if( curl_errno($ch) ) {
    echo "curl请求异常,错误码:".curl_errno($ch).",错误信息:".curl_error($ch);die;
}
curl_close($ch);
echo "ZX支付提交URL: $gateway ,包含参数:".json_encode($data,320).",接收响应:".json_encode(json_decode($response,true),320);
//$result = json_decode($response,true);
//echo $result['data'];