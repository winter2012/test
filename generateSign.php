<?php

//AngelPay
function generateSign($data){
    ksort($data);
    $str = '';
    foreach ($data as $key => $value) {
        if($value != ''){
            $str .= $key.'='.$value.'&';
        }
    }
    $str .= 'key='.$this->signKey;
    $sign = strtolower(md5($str));
    return $sign;
}

//EFpay ebofin支付
function genSign1($data){
    ksort($data);
    $str = '';
    foreach ($data as $key => $value) {
        if($value != ''){
            $str .= $key.'='.$value.'&';
        }
    }
    $str .= 'key='.$this->signKey;
//        \Log::error("ebofin支付签名字符串:".$str);
    $sign = strtoupper(md5($str));
    return $sign;
}

//HHpay 汇合支付
function genSign2($param, $signKey){
    ksort($param);
    foreach ($param as $key => $value) {
        if(empty($value) && $value !== '0'){
            unset($param[$key]);
        }
    }
    $signStr = urldecode( http_build_query($param) ) . $signKey;
    //dd($signStr);
    return strtoupper(md5($signStr));
}

//JCpay 聚创支付
function genSign3($data){
    ksort($data);
    $str = '';
    foreach ($data as $key => $value) {
        if($value != ''){
            $str .= $key.'='.$value.'&';
        }
    }
    $str .= 'key='.$this->signKey;
    $sign = md5($str);
    return $sign;
}

//KKpay KK支付
function genSign4($data){
    ksort($data);
    $string='';
    foreach ($data as $key => $value){
        if($value != ''){
            $string .= $key.'='.$value.'&';
        }
    }
    $string .= 'key='. $this->signKey;
    $sign=strtoupper(md5($string));
    return $sign;
}

//Lepay 乐付支付
function genSign5($param, $signKey){
    ksort($param);
    $signStr = http_build_query($param);
    return md5($signStr . '&'.$signKey);
}

//Sespay 686支付
function genSign6($data){
    ksort($data);
    $str = '';
    foreach ($data as $key => $value) {
        if($value != ''){
            $str .= $key.'='.$value.'&';
        }
    }
    $str .= 'key='.$this->signKey;
    $sign = md5($str);
    return $sign;
}

//JCpay 聚创支付
function genSign($data){
    ksort($data);
    $str = '';
    foreach ($data as $key => $value) {
        if($value != ''){
            $str .= $key.'='.$value.'&';
        }
    }
    $str .= 'key='.$this->signKey;
    $sign = md5($str);
    return $sign;
}