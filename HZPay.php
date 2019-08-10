<?php
/**
 * Created by PhpStorm.
 * User: Winter
 * Date: 2019/07/26
 * Time: 20:17
 */
date_default_timezone_set('PRC');
$v_mid = '601510488';
$signKey = 'VZJFWm8XvJ14JSUoamF02OPFda9fsAil7DCCHayMhkBmtoabnZcoAkrgjeCVo2E6BQ8fqsR_Z3TRmDmZa73Dx4VXlwsDINypQGVOr5W6icAHBK4R2OVr_aIH5';
$gateway = 'http://hdzw.dlmry.com/PayInterface.aspx';

$data = [
    'v_pagecode'        => '1080',
    'v_mid'             => $v_mid,
    'v_oid'             => date('Ymd').'-'.$v_mid.'-'.time().rand(10,99),
    'v_rcvname'         => $v_mid,
    'v_rcvadd'          => $v_mid,
    'v_rcvtel'          => $v_mid,
    'v_goodsname'       => 'Mac',
    'v_goodsdescription'=> 'book',
    'v_rcvpost'         => $v_mid,
    'v_qq'              => '12355678',
    'v_amount'          => '600.00',
    'v_ymd'             => date('Ymd'),
    'v_orderstatus'     => '1',
    'v_ordername'       => $v_mid,
    'v_bankno'          => '0000',
    'v_moneytype'       => '0',
    'v_url'             => 'http://www.yyf.com/notify',
    'v_noticeurl'       => 'http://www.yyf.com/success',
    'v_app'             => 'web'
];

$str = "v_pagecode=$data[v_pagecode]&v_mid=$data[v_mid]&v_oid=$data[v_oid]&v_amount=$data[v_amount]&v_ymd=$data[v_ymd]&v_bankno=$data[v_bankno]".$signKey;
$data['sign'] = strtoupper(SHA1($str));
//echo "签名字符串:".$str.",签名方法:SHA1,签名结果:".$data['sign'];

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $gateway);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, [json_encode($data,320)]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch);
if( curl_errno($ch) ) {
    exit("curl请求异常,错误码:".curl_errno($ch).",错误信息:".curl_error($ch));
}
curl_close($ch);
echo "合众支付提交URL:$gateway,提交参数:[".json_encode($data,320)."],接收响应:".$response;
//$result = json_decode($response,true);
//echo $result['data']['payUrl'];