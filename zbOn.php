<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2018/1/24
 * Time: 14:22
 */
$url = "http://45.61.238.184/api/mgr/2/createRoom?token=Iwpl3jyVSctAtd4r3UcORiwRsmXJxqwPB3v19H9zLw8E3HbigZ1X4k86bCOr";
$header = ["Content-Type: application/json"];
$body = [
    "startTime"     => 1521857239000,
    "roomType"      => "ticket",
    "roomTitle"     => "test",
    "activityTime"  => 180,
    "price"         => 50,
    "playUrl"       => "http://www.youtube.com/"
];
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
$result = json_decode($response,true);
print_r($response);
