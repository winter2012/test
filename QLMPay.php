<?php
/**
 * Created by PhpStorm.
 * User: Winter
 * Date: 2019/07/26
 * Time: 20:17
 */
date_default_timezone_set('PRC');
$shopId = 'AX123456';
$merKey = 'BJHYRBJR8ECI6O0XBFP83YHLCPHV2N3N';
$orderApi = 'http://103.107.237.195:66/apis.php';
$gateway = 'http://103.107.237.195:66/jiedan.php';

function httpRequest($url, $postFields, $customRequest = 'POST'){
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $customRequest);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $response = curl_exec($ch);
    if( curl_errno($ch) ) {
        exit("curl请求异常,错误码:".curl_errno($ch).",错误信息:".curl_error($ch));
    }
    curl_close($ch);
    return $response;
}

$orderData = [
    'shopId'    => $shopId,
    'amount'    => 800.00,
    'payType'   => 'wx',
    'uOrderId'  => 'TD'.date('YmdHis').rand(1000,9999),
    'notify_url'=> 'http://api.axpay9.com/notify/QLMPay'
];
$str = 'shopId='.$orderData['shopId'].'&amount='.$orderData['amount'].'&payType='.$orderData['payType'].'&'.$merKey;
$orderData['sign'] = md5($str);
//echo "签名字符串:".$str.",签名方法:md5,签名结果:".$orderData['sign']."\n";
$response = httpRequest($orderApi, $orderData);
//echo "千里马支付生成订单提交URL:$orderApi,提交参数:".json_encode($orderData,320).",接收响应:".$response;

$order = json_decode($response,true);
$postData = [
    'orderId' => $order['orderId'],
    'shopId'  => $shopId,
    'act'     => 'select',
    'payType' => $order['payType']
];
$postData['sign'] = md5('shopId='.$postData['shopId'].'&orderId='.$postData['orderId'].'&payType='.$postData['payType'].'&'.$merKey);
for($i=1; $i<=10; $i++){
    $receive = httpRequest($gateway, $postData);
    echo "千里马支付第".$i."次抢单提交URL:$gateway,提交参数:".json_encode($postData,320).",接收响应:".json_encode(json_decode($receive,true),320)."\n";
    $result = json_decode($receive,true);
    if( isset($result['error']) && $result['error'] == 0 ){
        echo $result['msg'];
        die;
    }
}