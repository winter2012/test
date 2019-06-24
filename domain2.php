<?php
$domain = [
    'www.l668u.com',
    'www.l668u1.com',
    'www.l668u2.com',
    'www.l668u3.com',
    'www.l668u3.com',
    'www.l668u3.com',
    'www.l668u3.com',
    'www.l668u3.com',
    'www.l668u3.com',
    'www.l668u3.com',
    'www.l668u3.com',
    'www.l668u3.com',
    'www.l668u3.com',
    'www.l668u3.com',
    'www.l668u3.com',
    'www.l668u3.com',
];
for($i=0; $i<count($domain); $i++){
    $post = [
        'func'  => 'true',
        'm'     => 'check',
        'a'     => 'check',
        'domain'=> $domain[$i]
    ];
    $rel = _qiang($post);
    $arr = json_decode($rel,true);
    if ($arr['strcode'] == 1) {
        echo $domain[$i].' 没有被墙'."\n";
    }elseif ($arr['strcode'] == -1) {
        echo $domain[$i].' 被墙了'."\n";
    }else{
        echo '查询失败'."\n";
    }
}
function _qiang($post) {
    // 创建一个新cURL资源
    $ch = curl_init();
    // 设置URL和相应的选项
    curl_setopt($ch, CURLOPT_URL, 'https://tool.22.cn/ajax/qiang.ashx?'.time());
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    //将curl_exec()获取的信息以文件流的形式返回，而不是直接输出
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //POST请求
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    //执行cURL会话
    $response = curl_exec($ch);
    // 关闭cURL资源，并且释放系统资源
    curl_close($ch);
    return $response;
}