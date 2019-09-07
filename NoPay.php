<?php
/**
 * Created by PhpStorm.
 * User: Winter
 * Date: 2019/07/26
 * Time: 20:17
 */
date_default_timezone_set('PRC');
$memberId = '10163';
$apiKey = 'y1rmel5ywmzyirojahxpicbzbkvy70v8';
$gateway = 'http://www.91pay888.com/Pay_Index.html';

$data = [
    'pay_memberid'      => $memberId,
    'pay_orderid'       => "91".date('YmdHis').rand(100,999),
    'pay_applydate'     => date('Y-m-d H:i:s'),
    'pay_bankcode'      => "927",
    'pay_notifyurl'     => "http://www.bet168.com/notify",
    'pay_callbackurl'   => "http://www.bet168.com/success",
    'pay_amount'        => 600
];

ksort($data);
$signStr = "";
foreach ($data as $k => $v){
    $signStr .= $k."=".$v."&";
}
$signStr .= "key=".$apiKey;
$data['pay_md5sign'] = strtoupper(MD5($signStr));
$data['pay_productname'] = "mac";

echo "签名字符串:".$signStr.",签名方法:md5,签名结果:".$data['pay_md5sign']."\n";

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
echo "91支付提交URL:$gateway,提交参数:".http_build_query($data).",接收响应:".json_encode(json_decode($response,1),320);
//$result = json_decode($response,true);
//echo $result['data']['url'];