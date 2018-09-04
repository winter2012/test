<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2018/1/24
 * Time: 14:22
 */
$deal = ["485494","485736","485890","486788","486863","486874","486875","486892"];
$apiUrl = "http://admin.mekxfj.com/admin/user/anchor/cancel/";
$cookie_jar = 'cookie.txt';
for($i = 489653; $i <= 608956; $i++){
    if(in_array("$i",$deal)){
        $url = $apiUrl . $i . "?reason=tony";
//        $url = "http://admin.mekxfj.com/admin/user/anchor/cancel/488182?reason=tony";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_jar);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_jar);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $result = json_decode($response,true);
        if($result['message'] != "操作成功"){
            echo json_encode($result,320)."\n";
        } else {
            echo $i."操作成功\n";
        }
    }
}
