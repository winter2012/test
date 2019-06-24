<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2019/05/20
 * Time: 14:58
 * @param $url
 * @return string
 */
function httpCode($url){
    $ch = curl_init();
    $timeout = 10;
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpCode;
}

$check_url = [
    'http://vbo.1rfang.com/',
    'http://lu.lubar111.vip/',
    'http://www.l668u.com/',
];

for($i=0; $i<count($check_url); $i++){
    if( httpCode($check_url[$i]) == "200" ){
        echo $check_url[$i]."能正常访问\n";
    } else {
        echo $check_url[$i]."被墙了！！！\n";
    }
}