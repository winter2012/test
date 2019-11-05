<?php
    include "getReport.php";
    $request = file_get_contents('php://input');
    $request = json_decode($request,true);
    //接收消息的时间
    $date = date('Y-m-d H:i:s',$request['message']['date']);
    //来自群组(哪个群组发的消息就回复哪个群组)
    $chat_id = $request['message']['chat']['id'];
    $chat_title = $request['message']['chat']['title'];
    //来自用户
    $from_id = $request['message']['from']['id'];
    $from_user = $request['message']['from']['first_name'];
    $from_username = $request['message']['from']['username'];
    //接收到的消息
    $text = substr(current(explode('@',$request['message']['text'])),1);
    file_put_contents("request","日期:".$date."\r\n群组ID:".$chat_id."\r\n群组标题:".$chat_title."\r\n祈求者ID:".$from_id."\r\n祈求者:".$from_user."\r\n祈求者用户名:".$from_username."\r\n内容:".$text."\r\n\r\n",FILE_APPEND);
    $baseUrl = "https://api.telegram.org/bot736128122:AAGXWTKGLZMlqyUa68uDT90g94yArq6nA9E/sendMessage?";
    $requestData['chat_id'] = $chat_id;
    if( $text == "report" ){
        $report = getReport();
        $requestData['text'] = $report;
    }
    if( $text == "sexy_report" ){
        $requestData['text'] = '正在开发中...';
    }
    if( $text == "awei_report" ){
        $requestData['text'] = '正在开发中...';
    }
    $url = $baseUrl . http_build_query($requestData);
    file_get_contents($url);