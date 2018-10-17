<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2017/12/20
 * Time: 14:58
 */
//function add($numberOne, $numberTwo){
//    $numberThree = $numberOne + $numberTwo;
//    return $numberThree;
//}
//
//$result = add(2,3 );
//echo $result;

//var_dump(!(-2));
//date_default_timezone_set('PRC');
//var_dump(round((strtotime(date('Y-m-d',$expireTime[0])) - strtotime(date('Y-m-d'))) / 86400));

//$str = 'C:\www\qvod_admin\public\error';
//echo str_replace('qvod_admin','zb_api_php',$str);

//$str = '-1:不需要上传';
//echo substr(strstr($str,':'),1);

//$arr = [
//    -1 => '不需要上传',
//    0 => '上传所有日志',
//    1 => '流媒体测速日志',
//    2 => '聊天服务器测速日志',
//    3 => '其他错误日志信息'
//];
//if(in_array("其他错误日志信息",$arr)){
//    echo "匹配成功";
//}else{
//    echo "匹配失败";
//}

//$text = '';
//echo json_decode($text);

//$data = [
//    "mcht_no" => "1000000000003",
//    "trade_no" => "201803081000018520",
//    "notify_url" => "http://www.apptest.com/notify.php",
//    "total_fee" => "2000",
//    "body" => "app"
//];
//
//function getSort($data){
//    $result = [];
//    foreach ($data as $k => $v){
//        $keys[] = $k;
//    }
//    sort($keys);
//    foreach ($keys as $key){
//        $result[$key] = $data[$key];
//    }
//    return $result;
//}
//
//function getSign($data){
//    $sortData = getSort($data);
//    $signStr = "";
//    foreach ($sortData as $k => $v){
//        $signStr .= $k."=".$v."&";
//    }
//    $data['sign'] = strtoupper(MD5($signStr."key=5104919524DA0CBC2344A70301CE8FFA"));
//    $result = getSort($data);
//    print_r($result);
//}
//
//getSign($data);

//$file = 'D:/workspace/test/test.php';
//$fileInfo = explode('/', $file);
//$file = array_pop($fileInfo);
//print_r($file);
//$data = ["测试汉字","http://url.com/test/php/index.html"];
//echo json_encode($data,320);

//$tempName = "httpzb-api.mekxfj.comlogandroid_error_log100020_7cd8c409-581a-4fc8-abff-9b03e1b93466_2018-04-01-07-57-07.txt";
//$log_date = substr($tempName,-23,10);
//echo $tempName."\n".$log_date;

//echo preg_match("/^[A-Za-z0-9]+$/", "ASDFasdf1234");
//echo preg_match("/^[A-Za-z0-9\x7f-\xff]+$/", "ASDFasdf1234你妈");
//echo "\n";
//echo preg_match("/(\\\u[ed][0-9a-f]{3})/i",json_encode("测试TESTtest123456😁"));
//echo "\n";
//echo preg_match("/^[\x7f-\xff]+$/","测试😁");
//echo "\n";
//echo preg_match("/^[\x{4e00}-\x{9fa5}a-zA-Z0-9]+$/u","刘亦菲lyf008");
//echo "\n";
//echo mb_strlen("刘亦菲lyf008");

//echo number_format(floatval(2),2,'.','');

//$str = '{\"shopCode\":\"jc00000630\",\"outOrderNo\":\"2018050710233806266395\",\"goodsClauses\":\"mac\",\"tradeAmount\":\"30_00\",\"code\":\"0\",\"nonStr\":\"ctVVjvG25EV1ed1H\",\"msg\":\"SUCCESS\",\"sign\":\"decad6c24abe0fdf3e69df090266fa5b\"}":"","\/api\/pay\/notify\/jcpay":""}';
//json_decode($str,true);

//echo md5('1234567890abcdefghijklmnopqrstuvwxyz');

//date_default_timezone_set('PRC');
//echo date(DateTime::ISO8601);
//echo "\n";
//echo date(DATE_ISO8601,time());

//$url = "http://tgpaccess.com/api/oauth/token";
//$header = ["Content-Type: application/x-www-form-urlencoded"];
//$postData = [
//    'client_id'     => "yasheng",
//    'client_secret' => "ReZ1q6AApel5h4lcjrf6rzYn7ha0nBgLJmViQ6H03QX",
//    'grant_type'    => "client_credentials",
//    'scope'         => "playerapi"
//];
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//$output = curl_exec($ch);
//curl_close($ch);
////$result = json_decode($output,true);
////echo $result['access_token'];
//echo $output;

//date_default_timezone_set('PRC');
//echo strtotime("2018-06-14 00:00:00");
//echo date('Y-m-d 23:59:59', strtotime("2018-04-14 12:23:34"));

//echo substr("NetworkEntity:123456",14);
//echo floor(8.9);

//$data = explode('.',"sb.new.test.com:8200");
//$count = count($data);
//$result = $data[$count-2].'.'.$data[$count-1];
//print_r($result);

//echo rand(100,255).'.'.rand(50,150).'.'.rand(1,99).'.'.rand(1,200);
//
//$file = popen("ping http://www.baidu.com","r");
//
////一些要执行的代码
//
//pclose($file);

//echo in_array(14,[1,14,17]);

//$fileNameDivide = explode("_","abcd_2018-07-30-04-28-08_error_log");
//
//echo substr($fileNameDivide[1],0,10);

//echo uniqid();

//$result['htmlText'] = "<script language=\"javascript\">window.onload=function(){window.location.href='HTTPS://QR.ALIPAY.COM/FKX06843IV69JGUVRA2JAD?t=1535707000937';}</script>";
//echo substr(strstr($result['htmlText'],"href="),6,strpos(strstr($result['htmlText'],"href="), ';}')-7);
//echo strpos(strstr($result['htmlText'],"href="), ';}');

date_default_timezone_set('PRC');
echo date("Y-m-d H:i:s",strtotime("-30 minutes"));