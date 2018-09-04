<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2018/5/4
 * Time: 19:18
 */

$url = "http://bzlogin.gf121.com/login.do";
$postData = [
    'userName' => "YSTHRONE",
    'password' => "123456",
    'code'     => "test",
];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
$output = curl_exec($ch);
curl_close($ch);
//$output = '{"res":1104, "url":"http://main.gf121.com?token=63c9dc04f2484ac3b6135757b85c026f&user_id=1995"}';
$result = json_decode(str_replace("'",'"',$output),true);
print_r($result);