<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2018/4/12
 * Time: 9:31
 */
$postHeader = [
    "content-type: application/x-www-form-urlencoded"
];
$postData = [
    'username'  => "ysthrone",
    'channelId' => "137",
    'signature' => "mhjzS3cV4xHPjaPEYFF/tyLlbVOPqshUyaMjDhgrJWBRYkvgMnd3twxSShF9kmuf7dZREhfe00cxLwHy2+mfu4Lcv03G0zL/1iUlv88g4m+M5GwyG3cDhA5eWZwWe+njZyP1mJKb+vUkrnBjIU1iq5BPJi4mkJRcCRvZL2ZaHGs=",
    'timestamp' => "1523440889"
];
$apiUrl = "http://yunding.ebet.im:8888/api/userinfo";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_HTTPHEADER, $postHeader);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$output = curl_exec($ch);
curl_close($ch);
//    $response = json_decode($output,true);
//    var_dump(empty($response['error']));
echo $output;