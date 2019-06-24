<?php

class demo{

    public $merchant = ['uid'=>'商户UID','apikey'=>'商户秘钥'];

    public function getSign($data,$salt)
    {
        //获取商户apikey
        if(empty($salt)){
            abort(500,'获取商户秘钥失败!');
        }

        ksort( $data );
        $str = http_build_query($data);
        $md5str = $str . "&apikey=" . $salt;
        //签名验证，查询数据是否被篡改
        return md5($md5str);
    }


    public function curl_post_json($url, array $params = array(), $timeout = 200,$header = [])
    {

        $data_string = json_encode($params);

        $originHeader = [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        ];

        $header = array_merge($originHeader,$header);

        $ch = curl_init();//初始化
        curl_setopt($ch, CURLOPT_URL, $url);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        return $data;
    }

    public function curl_post($url, array $params = array(), $timeout)
    {
        $ch = curl_init();//初始化
        curl_setopt($ch, CURLOPT_URL, $url);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        return ($data);
    }


    public function addOrder()
    {
        //必填
        $postData['merchant_order_money'] = 25;//订单金额
        $postData['merchant_order_sn'] = '订单号';//商户订单号
        $postData['merchant_order_date'] = date('Y-m-d H:i:s',time());//下单时间

        //非必填项,无此需求可不写,请认真填写回调地址,乱写分分钟打洗你
        $postData['merchant_order_callbak_confirm_duein'] = 'http:\\www.确认收款回调.com';
        $postData['merchant_order_callbak_redirect'] = 'http:\\www.确认收款后页面跳转地址.com';
        $postData['merchant_order_name'] = '测试订单';
        $postData['merchant_order_count'] = 1;
        $postData['merchant_order_desc'] = '测试订单简介';
        $postData['merchant_order_callbak_confirm_create'] = 'http:\\www.下单成功通知回调.com';


        //签名验证，查询数据是否被篡改
        $apikey = $this->merchant['apikey'];

        $sign = $this->getSign($postData,$apikey);

        //必填
        $postData["merchant_order_sign"] = $sign;//md5签名


        $host = '服务器地址.com';


        //获取access-token
        $tokenData = array(
            "uid" => $merchant['uid'],
            "apikey" => $merchant['apikey']
        );
        $token = $this->curl_post($host.'/payapi/BuildToken/getAccessToken',$tokenData,200);

        //显示获得的数据
        $tokenData = json_decode($token,true);
        if(empty($tokenData) || $tokenData['code'] != 200){
            return false;
        }
        $access_token = $tokenData['data']['access_token'];

        $url = $host.'/payapi/Index/payindex';
        $data = $this->curl_post_json($url,$postData,200,['access-token: '.$access_token]);

        //显示获得的数据
        return response($data);
    }


    //接单回调
    public function callbak()
    {
        $post = $_POST;
        $sign = $post['sign'];
        unset($post['sign']);
        $checkSign = $this->getSign($post,$this->merchant['apikey']);

        if($sign != $checkSign){
            return false;
        }

        $return = ['code'=>200,'msg'=>'success','data'=>[]];
        //签名通过, 处理自己逻辑
        try{

        }catch(Exception $e){
            $return = ['code'=>500,'msg'=>'failed','data'=>['params'=>'{任意参数,供查问题}']];
            echo json_encode($return);
            return false;
        }


        //返回
        $return = ['code'=>200,'msg'=>'success','data'=>[]];
        echo json_encode($return);
    }

}
