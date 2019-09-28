<?php
/**
 * Created by PhpStorm.
 * User: Winter
 * Date: 2019/07/26
 * Time: 20:17
 */
date_default_timezone_set('PRC');
$app_id = '218379';
$signKey = 'f7405bdd316979b9c8f10bdfe712a5115d14bb18';
$gateway = 'https://www.jinlinpay.com/gateway';

$data = [
    'app_id'            => $app_id,
    'out_trade_no'      => 'SZ'.date('YmdHis').rand(1000,9999),
    'total_amount'       => 600*100,
    'subject'           => 'mac',
    'notify_url'        => 'http://www.szh.com/notify.jsp',
    'return_url'        => 'http://www.szh.com/return.jsp',
    'method'            => 'alipay'
];

$signData = $data;
ksort($signData);
$str = '';
foreach ($signData as $key => $value) {
    $str .= $key.'='.$value.'&';
}
$str .= 'key='.$signKey;

$data['sign'] = strtoupper(md5($str));
//echo "签名字符串:".$str.",签名方法:MD5,签名结果:".$data['sign']."\n";

$data['client_ip'] = '229.87.100.103';
$data['ext'] = 'book';

echo $gateway."?".http_build_query($data);die;

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $gateway);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch);
if( curl_errno($ch) ) {
    exit("curl请求异常,错误码:".curl_errno($ch).",错误信息:".curl_error($ch));
}
curl_close($ch);
echo "金鳞支付提交URL:$gateway,提交参数:[".json_encode($data,320)."],接收响应:".$response;
//$result = json_decode($response,true);
//echo $result['data']['payUrl'];