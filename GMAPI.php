<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2018/4/4
 * Time: 17:25
 */
$api_username = 'GTLCCNYYS_API';   //请输入你得到的API账号
$api_password = 'ASG93GM9';   //请输入你得到的API密码
$auth = base64_encode($api_username.':'.$api_password); //auth加密后的密文
$apiUrl = 'https://api.gmaster8.com';  //测试环境请使用这个URL： http://api.dynastyggroup.com
//echo $auth;

//register();
//activate();
//getAmount();
//transfer("OUT", 4);
//goGame();
//gameLog();

//注册GM2玩家，请自行添加前缀
function register()
{
    global $api_username,$api_password,$auth,$apiUrl;

    $curl = curl_init();

    $postData = array(
        'username' => 'james008',  //玩家用户名
        'password'=>'123456',   //玩家密码
    );
//    var_dump($postData);
//    var_dump($api_username);
//    var_dump($api_password);
//    var_dump($auth);
//    var_dump($apiUrl);
//    var_dump($postData);

    $postJson = json_encode($postData);

//    var_dump($postJson);

    curl_setopt_array($curl, array(
        CURLOPT_URL => $apiUrl."/register",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postJson,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTPHEADER => array(
            "Authorization: Basic ".$auth,
            "cache-control: no-cache",
            "content-type: application/json; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
//    var_dump($response);
    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}

//激活平台玩家，一次生效
function activate()
{
    global $api_username,$api_password,$auth,$apiUrl;

    $curl = curl_init();

    $postData = array(
        'username' => 'james008',  //玩家用户名
        'password'=>'123456',   //玩家密码
    );

    $postJson = json_encode($postData);

    curl_setopt_array($curl, array(
        CURLOPT_URL => $apiUrl."/Betsoft/player/active",   //这个例子是激活GG玩家，把GG字段换成其他平台名字即可完成其他平台激活
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $postJson,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTPHEADER => array(
            "authorization: Basic ".$auth,
            "cache-control: no-cache",
            "content-type: application/json; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
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
}

function getAmount(){
    global $auth,$apiUrl;
    $postHeader = [
        "authorization: Basic ".$auth,
        "cache-control: no-cache",
        "content-type: application/json; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
    ];
    $postData = [
        'username'  => 'james008'
    ];
    $postJson = json_encode($postData);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl."/Betsoft/player/balance");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $postHeader);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postJson);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $output = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($output,true);
    echo $output."\n";
    echo $response['balance'];
}

function transfer($type, $amount){
    global $auth,$apiUrl;
    $transactionType = $type == "IN" ? "deposit" : "withdrawal";
    $transactionId = 'bs' . time().rand(100,999);
    $postHeader = [
        "authorization: Basic ".$auth,
        "cache-control: no-cache",
        "content-type: application/json; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
    ];
    $postData = [
        'username'              => 'james008',
        'amount'                => $amount,
        'externalTransactionId' => $transactionId
    ];
    $postJson = json_encode($postData);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl."/Betsoft/credit/$transactionType");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $postHeader);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postJson);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $output = curl_exec($ch);
    curl_close($ch);
//    $response = json_decode($output,true);
//    echo $response['balance'];
    echo $output;
}

function goGame(){
    global $auth,$apiUrl;
    $postHeader = [
        "authorization: Basic ".$auth,
        "cache-control: no-cache",
        "content-type: application/json; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
    ];
    $postData = [
        'username'      => 'james008',
        'game_code'     => "747",
        'lang'          => "zh_CN",
//        'play_for_fun'  => "yes",//可选,yes即可进入试玩(只支持SW/AG)
//        'mobile'        => "Yes"//可选,如要打开HTML5游戏,此值请传Yes
    ];
    $postJson = json_encode($postData);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl."/Betsoft/game/open");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $postHeader);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postJson);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $output = curl_exec($ch);
    curl_close($ch);
//    echo $output;
    $response = json_decode($output,true);
    echo $response['url'];
//    var_dump(!empty($response['url']));
//    echo json_encode(json_decode($output,true),320);
}

function gameLog(){
    global $auth,$apiUrl;
    $postHeader = [
        "authorization: Basic ".$auth,
        "cache-control: no-cache",
        "content-type: application/json; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
    ];
    $postData = [
        'fromDate'  => "2018-04-05T10:10:00",
        'toDate'    => "2018-04-05T10:20:00"
    ];
    $postJson = json_encode($postData);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl."/Betsoft/game/history");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $postHeader);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postJson);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $output = curl_exec($ch);
    curl_close($ch);
//    $response = json_decode($output,true);
//    var_dump(empty($response['error']));
    echo json_encode(json_decode($output,true),320);
}