<?php
/**
 * Created by PhpStorm.
 * User: Winter
 * Date: 2019/07/26
 * Time: 20:17
 */
function sign ($key_id, $array){
    $data = md5(number_format($array['amount'],2) . $array['out_trade_no']);
    $key[] ="";
    $box[] ="";
    $pwd_length = strlen($key_id);
    $data_length = strlen($data);
    for ($i = 0; $i < 256; $i++) {
        $key[$i] = ord($key_id[$i % $pwd_length]);
        $box[$i] = $i;
    }
    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $key[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    $cipher = '';
    for ($a = $j = $i = 0; $i < $data_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;

        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;

        $k = $box[(($box[$a] + $box[$j]) % 256)];
        $cipher .= chr(ord($data[$i]) ^ $k);
    }
    return md5($cipher);
}


date_default_timezone_set('PRC');
$merchant_id = '10014';
$signKey = '4C90252062EB78';
$gateway = 'http://www.pigspay.com/gateway/index/pay.do';

$data = [
    'account_id'        => $merchant_id,
    'content_type'      => 'json',
    'thoroughfare'      => 'taobao',
    'out_trade_no'      => 'SZ'.date('YmdHis').rand(100,999),
    'amount'            => '600.00',
    'callback_url'      => 'http://www.szh.com/notify.jsp',
    'success_url'       => 'http://www.szh.com/home.jsp',
    'error_url'         => 'http://www.szh.com/error.jsp'
];

$data['sign'] = sign($signKey, $data);
print_r($data);die;
//echo "签名字符串:".$str.",签名方法:md5,签名结果:".$data['merchant_order_sign']."\n";

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $gateway);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: multipart/form-data']);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data,320));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch);
if( curl_errno($ch) ) {
    echo "curl请求异常,错误码:".curl_errno($ch).",错误信息:".curl_error($ch);die;
}
curl_close($ch);
echo "提交URL: $gateway ,提交参数: ".json_encode($data,320)." ,接收响应: ".$response;
//$result = json_decode($response,true);
//echo $result['data']['url'];