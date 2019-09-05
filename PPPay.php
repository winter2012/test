<?php
/**
 * Created by PhpStorm.
 * User: Winter
 * Date: 2019/07/26
 * Time: 20:17
 */
date_default_timezone_set('PRC');
$merchantID = '1077';
$apiKey = '3647b2bf612e455ca4053e0628225529';
$gateway = 'https://api.ppzf.net/ChargeQRSrc.aspx';

$data = [
    'merchantID'    => $merchantID,
    'bankCode'      => "6002",
    'tradeAmt'      => 600.00,
    'orderNo'       => "RC".date('YmdHis').rand(1000,9999),
    'notifyUrl'     => "http://www.demo.com/notify",
    'returnUrl'     => "http://www.demo.com/success",
    'payerID'       => "10086",
    'payerIP'       => "127.0.0.1",
    'attach'        => "mac"
];

$str = "merchantID=$data[merchantID]&bankCode=$data[bankCode]&tradeAmt=$data[tradeAmt]&orderNo=$data[orderNo]&notifyUrl=$data[notifyUrl]&returnUrl=$data[returnUrl]&payerIP=$data[payerIP]".$apiKey;
$data['sign'] = md5($str);
//echo "签名字符串:".$str.",签名方法:md5,签名结果:".$data['sign']."\n";

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
echo "派派支付提交URL:$gateway,提交参数:".http_build_query($data).",接收响应:".json_encode(json_decode($response,1),320);
//$result = json_decode($response,true);
//echo $result['data']['url'];