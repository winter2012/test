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

//date_default_timezone_set('PRC');
////echo date("Y-m-d H:i:s",strtotime("-30 minutes"));
//echo date('Y-m-d H:00:00',strtotime('-1 hour'));
//echo "\n";
//echo date('Y-m-d H:59:59',strtotime('-1 hour'));
//echo "\n";
//echo date('Y-m-d 00:00:00',strtotime('-1 day'));
//echo "\n";
//echo date('Y-m-d 23:59:59',strtotime('-1 day'));
//echo "\n";
//echo str_replace(['wechat','alipay','qq','jd'],['微信','支付宝','QQ','京东'],"wechat,jd");

//$bet_amount = ['big_odd'=>500,'big_even'=>100,'small_odd'=>200,'small_even'=>150];
//arsort($bet_amount);
//$bet_result = [];
//foreach ($bet_amount as $key=>$value){
//    $bet_result[] = $key;
//}
//var_dump($bet_result[3]);

//echo date('Y-m-d H:i:s', strtotime("+0.1 months",strtotime(date('Y-m-d H:i:s'))));
//$payMethodArray = ['alipay','wechat','qq','jd','bank'];
//$nowPayMethod = ['wechat','bank','qq'];
//$newPayMethod = array_merge($nowPayMethod,$payMethodArray);
//var_dump(array_unique($newPayMethod));

//function getRandNum($probArray){
//    $sum_prob = 0;
//    $section = [];
//    foreach ($probArray as $key=>$value){
//        $sum_prob += $value;
//        $section[] = $sum_prob;
//    }
//    $prob = mt_rand(1,$sum_prob);
//
//    switch ($prob){
//        case $prob <= $section[0]:
//            $randResult = 0; break;
//        case $prob > $section[0] && $prob <= $section[1]:
//            $randResult = 1; break;
//        case $prob > $section[1] && $prob <= $section[2]:
//            $randResult = 2; break;
//        case $prob > $section[2]:
//            $randResult = 3; break;
//        default:
//            $randResult = rand(0,3); break;
//    }
//    return $randResult;
//}
//
//echo getRandNum([10,20,30,40]);

//echo (int)(microtime(true) * 1000);

//date_default_timezone_set('PRC');
//echo floor( ( strtotime("2019-03-18 15:30:55") - time() ) / 60 );

//$data = [
//    '0'     => '大厅',
//    '620'   => '德州扑克',
//    '720'   => '二八杠',
//    '830'   => '抢庄牛牛',
//    '220'   => '炸金花',
//    '860'   => '三公',
//    '900'   => '押庄龙虎',
//    '600'   => '21点',
//    '870'   => '通比牛牛',
//    '880'   => '欢乐红包',
//    '230'   => '极速炸金花',
//    '730'   => '抢庄牌九',
//    '630'   => '十三水',
//    '380'   => '幸运五张',
//    '610'   => '斗地主',
//    '390'   => '射龙门',
//    '910'   => '百家乐',
//    '920'   => '森林舞会',
//    '930'   => '百人牛牛'
//];
//echo isset($data['2']) ? $data['2'] : "";
//echo $data['3'];


//$curl = curl_init();
//
//curl_setopt_array($curl, array(
//    CURLOPT_URL => "http://154.220.2.7:5218/api/pay/pre-order",
//    CURLOPT_RETURNTRANSFER => true,
//    CURLOPT_CUSTOMREQUEST => "POST",
//    CURLOPT_POSTFIELDS => '{"channelId":"10060000","morderId":"2019042205411349143907","price":"200","payType":"ALIPAYSM","ip":"113.125.53.162","sign":"5e31aa9e81f21072cb152138e639954d","callback":"http://zb-api.mekxfj.com/api/pay/notify/xypay","subject":"mac","ext":"book"}',
//    CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
//));
//
//$response = curl_exec($curl);
//$err = curl_error($curl);
//
//curl_close($curl);
//
//if ($err) {
//    echo "cURL Error #:" . $err;
//} else {
//    echo $response;
//}

//$a = null;
//var_dump(is_null($a));
//echo number_format(rand(10,100),2,'.','');
//echo strtotime(date('Y-m-d H:i:s', 0));
//var_dump(strpos('admin审核通过,2019-05-07 20:46:54','<br>'));
//file_put_contents("./hooks.log", "user_name error,access defind");
//$path = ",a,b,";
//$ids = explode(',',$path);
//$ids = array_filter($ids);
//var_dump($ids);

//$uuid = uniqid('',true);
//$suffix = substr($uuid, strpos($uuid, ".") + 1);
//echo 'TN'.date('YmdHis').$suffix;

//function addLog($log = '', $filePrefix = 'mer', $type = 'INFO', $fileSuffix = '.log', $time = 'day'){
//    switch ($time) {
//        case 'year':
//            $period = date('Y'); break;
//        case 'month':
//            $period = date('Y-m'); break;
//        case 'day':
//            $period = date('Y-m-d'); break;
//        case 'hour':
//            $period = date('YmdH'); break;
//        case 'minute':
//            $period = date('YmdHi'); break;
//        case 'second':
//            $period = date('YmdHis'); break;
//        default:
//            $period = date('Y-m-d'); break;
//    }
//    $filename = "log/".$filePrefix . '-' .$period . $fileSuffix;
//    $nowTime = date('Y-m-d H:i:s', time());
//    $fp = fopen($filename, 'a');
//    fwrite($fp,"[$nowTime] $filePrefix.$type: " . $log . "\n");
//    fclose($fp);
//}
////要写入数据库的字符串
//$str ='3333';
//addLog($str);exit;

//echo date('Y-m-d', (time() - ((date('w') == 0 ? 7 : date('w')) - 1) * 24 * 3600));
//echo date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y")));
//var_dump(explode(',',''));
//$str = 'http://api.me/notify/BeePay';
//echo substr($str,0,strpos($str,'notify'));

//$test = [
//    'amount'=> 100.00,
//    'img'   => "aaaaaa+aaaaa+aaaab aaaaaa"
//];
//echo http_build_query($test);
//$str = '{"code":200,"msg":"确认收款成功!","data":{"order_id":5,"order_money":"599.98","merchant_order_sn":"2019061314331047013342","sign":"8945c6ce54508dd06ea15ab2f9b4e689"}}';
//$arr = json_decode($str,true);
//unset($arr['data']['sign']);
//$signArr = array_merge($arr,$arr['data']);
//unset($signArr['data']);
//var_dump($signArr);

//function createSign($data, $signKey){
//    ksort($data);
//    $str = http_build_query($data);
//    $str .= "&apikey=" . $signKey;
//    $sign = strtolower(md5($str));
//    echo "加密字符串:".$str.",密钥:".$signKey.",生成签名:".$sign;
//    return $sign;
//}
//
//$singKey = "ACFAA9FDF25852593B36332200BBB304";
//$data = [
//    'code'      => '200',
//    'msg'       => '确认收款成功!',
//    'order_id'  => '6',
//    'order_money' => '799.98',
//    'merchant_order_sn' => '2019061314532644188530'
//];
//echo createSign($data, $singKey);

//$test = '';
//var_dump(isset($test));

//var_dump(date('Y-m-d H:i:s', 0));
//$array = [
//    [
//        '1' => 'aaa',
//        '2' => 'bbb',
//        '3' => 'ccc',
//    ],
//    [
//        '4' => 'ddd',
//        '5' => 'eee',
//        '6' => 'fff',
//    ],
//];
//$array[] = [
//    '1' => 'aaa',
//    '2' => 'bbb',
//    '3' => 'ccc',
//];
//$array[] = [
//    '4' => 'ddd',
//    '5' => 'eee',
//    '6' => 'fff',
//];
//var_dump($array);
//$result = 31%2 == 0 ? '双' : '单';
//echo $result;
//$data = [
//    'rspcode'       => '0000',
//    'rspmsg'        => '付款完成',
//    'amount'        => '600',
//    'rspdate'       => '20190928120723',
//    'dealAmount'    => '600',
//    'merchOrderNo'  => 'SZ20191008195820953'
//];
//ksort($data);
//$str = '';
//foreach ($data as $key => $value) {
//    $str .= $key.'='.$value;
//}
//$str .= 'f933f04a62993fb91b51f0980da31cbc';
//$sign = md5($str);
//echo $sign;

$next_open_date = "2019-10-13";
echo date('d',strtotime($next_open_date)) - date('d');