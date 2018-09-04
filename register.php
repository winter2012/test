<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2018/1/24
 * Time: 14:22
 */
$url = "http://zb-api.mekxfj.com/api/user/register/".time().rand(100000,999999);
//$url = "http://api.zb.me/api/user/register/".time().rand(1000,9000);
$prefix = "vzbcs";
for($i = 1; $i <= 100; $i++){
    $body = [
        "username" => $prefix."$i",
        "nickname" => $prefix."$i",
        "password" => "123456",
        "os"       => "ios",
        "channel"  => "server"
    ];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($body));
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    $result = json_decode($response,true);
    if($result['message'] != "注册成功"){
        echo $prefix."$i"." register failed,error code ".$result['status'].",error message ".$result['message']."\n";
    }
}
