<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2018/6/13
 * Time: 10:03
 */

//$ch = curl_init();
//$filename = 'C:/Users/shanghai/Pictures/Camera Roll/23.jpg';
//$minetype = 'image/jpeg';
//$curl_file = curl_file_create($filename,$minetype);
//$postData = [
//    'file' => '111',
//    'text' => '666',
//    'file_name'=>$curl_file ,
//];
//
//
//curl_setopt($ch, CURLOPT_URL, 'xxx.com/test/curl');
////curl结果不直接输出
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//
////发送post  请求
//curl_setopt($ch, CURLOPT_POST, 1);
//// urlencoded 后的字符串，类似'para1=val1&para2=val2&...'，也可以使用一个以字段名为键值，字段数据为值的数组 ,测试当值为数组时候  Content-Type头将会被设置成multipart/form-data 否则Content-Type 头会设置为 application/x-www-form-urlencoded
//curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
////curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
//
////允许 cURL 函数执行的最长秒数
//curl_setopt($ch, CURLOPT_TIMEOUT, 50);
////不输出header 头信息
//curl_setopt($ch, CURLOPT_HEADER,0);
////不验证证书 信任任何证书
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//// 检查证书中是否设置域名,0不验证 0：不检查通用名称（CN）属性
////1：检查通用名称属性是否存在
////2：检查通用名称是否存在，是否与服务器的主机名称匹配
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
////设置 在HTTP请求中包含一个"User-Agent: "头的字符串
////curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
//
//
//$res = curl_exec($ch);
//$error_no = curl_errno($ch);
//$info = curl_getinfo($ch);
//$err_msg = '';
//if ($error_no) {
//    $err_msg = curl_error($ch);
//} else {
//    print_r($res);
//    dump($info);
//}
//curl_close($ch);






$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://45.61.238.184/api/room/78/setRoomBackgroundImg?token=e5d276a2856065c4dcf798bf9e10e5b7",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"roomBackgroundImg\"; filename=\"C:\\Users\\IT\\Desktop\\test.jpg\"\r\nContent-Type: image/jpeg\r\n\r\n\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
    CURLOPT_HTTPHEADER => array(
        "Cache-Control: no-cache",
        "Postman-Token: 06758f4c-5215-427c-9c09-82e9d3faa5d0",
        "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}