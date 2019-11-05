<?php
/**
 * Created by PhpStorm.
 * User: Winter
 * Date: 2019/11/04
 * Time: 14:22
 */
function getJSessionId(){
    $loginUrl = "https://mall.whg365.com/login";
    $cookie_jar = 'CookieOfLogin';
    $data = [
        'KEYDATA'   => 'winter,'.md5('123qweASD').',',
        'TM'        => time().rand(100,999),
        'IPADDR'    => ''
    ];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $loginUrl);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_jar);
    curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_jar);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $login_response = curl_exec($curl);
    file_put_contents("LoginResponse",$login_response);
    curl_close($curl);
    $str = file_get_contents($cookie_jar);
    $str = str_replace("\r\n","<br />",$str);
    $LOGIN_JSESSIONID = substr(strstr($str,'JSESSIONID'),11,32);
    return $LOGIN_JSESSIONID;
}

function getReport(){
    $LOGIN_JSESSIONID = getJSessionId();
//    $LOGIN_JSESSIONID = "04AF6EF201F715866A7435DE6BEBDC9F";

    $apiUrl = "https://mall.whg365.com/reportDailyChannel/list.do";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_COOKIE, "JSESSIONID=$LOGIN_JSESSIONID");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    file_put_contents("report.html",$response);
    $reportIndex = explode("\n",$response);
    $totalDeposit = explode(">",$reportIndex[125]);
    $totalDeposit = str_replace(',','',substr($totalDeposit[1],0,strlen($totalDeposit[1])-4));
    $totalWithdraw = explode(">",$reportIndex[127]);
    $totalWithdraw = str_replace(',','',substr($totalWithdraw[1],0,strlen($totalWithdraw[1])-4));
    $revenue = $totalDeposit - $totalWithdraw;

    $newDeposit = explode(">",$reportIndex[121]);
    $newDeposit = str_replace(',','',substr($newDeposit[1],0,strlen($newDeposit[1])-4));
    $newWithdraw = explode(">",$reportIndex[123]);
    $newWithdraw = str_replace(',','',substr($newWithdraw[1],0,strlen($newWithdraw[1])-4));
    $newRevenue = $newDeposit - $newWithdraw;

    $backDeposit = $totalDeposit - $newDeposit;
    $backWithdraw = $totalWithdraw - $newWithdraw;
    $backRevenue = $backDeposit - $backWithdraw;

    $report = "今日实时概况\n今日总充值:$totalDeposit\n今日总提款:$totalWithdraw\n今日充提差:$revenue\n";
    $report .= "今日拉新充值:$newDeposit\n今日拉新提款:$newWithdraw\n今日拉新充提差:$newRevenue\n";
    $report .= "今日回流充值:$backDeposit\n今日回流提款:$backWithdraw\n今日回流充提差:$backRevenue\n";

    return $report;
}