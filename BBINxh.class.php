<?php
namespace Libr\Platform\Driver;
use Think\Controller;
class BBIN extends Controller{

    public $type = 1,$testusr=0,$username,$agentid,$gameType=0,$params=[];

    public $pageSite;  //真人

    protected function _initialize(){
        $platform_view	= D("platform_view");
        $set = $platform_view->where("pname='BBIN'")->getField('vname,value');
        foreach($set as $k => $v){
            $this->$k = $v;
        }
    }

    //BBIN接入
    public $webSite = "apivebet";

    public $upperName = "ddrt8";

    public $apiUrl = "http://linkapi.apibox.info/app/WebService/JSON/display.php/";

    // post方法
    public function post($method, $postData){
        $tagUrl = $this->apiUrl . $method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $tagUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $output = curl_exec($ch);
        $error = curl_error($ch);
        if($error != ""){
            $log = new \Think\Log();
            $log->record('BBIN请求curl出错:'.$error);
        }
        curl_close($ch);
        return json_decode($output,true);
    }

    // get方法
    public function get($tagurl){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $tagurl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output,true);
    }

    //注册用户
    public function regUser(){
        $gmt = 12 * 60 * 60;
        $dateStr = date('Ymd', time() - $gmt);
        $method = "CreateMember";
        $postData = [
            'website'   => $this->webSite,
            'username'  => "rt8".$this->username,
            'uppername' => $this->upperName,
        ];
        $md5str = strtolower(md5(utf8_encode($postData['website'] . $postData['username'] . "U3ZalK43" . $dateStr)));
        // 編成key碼加前後無意義碼
        $postData['key'] = '12345678' . $md5str . '123456789';
        $response = $this->post($method, $postData);
        if($response['result'] == true){
            return "rt8".$this->username;
        } else if($response['Code'] == 7 && $response['Message']) { //提示已注册，则直接将账号给玩家用
//            $u = M('MemberPlatform')->field('value')->where("uid=".$uid." and name='BBIN'")->find();
//            if($u == null){
//                $data = array(
//                    'uid'       =>$uid, //用户id
//                    'name'      =>"BBIN", //平台名称
//                    'value'     =>$this->username, //用户在平台的游戏账户名
//                );
//                M('MemberPlatform')->add($data);
//            }
            $log = new \Think\Log();
            $log->record('BBIN注册用户返回信息:'.json_encode($response));
//            return $this->username;
            return 0;
        } else {
            $log = new \Think\Log();
            $log->record('BBIN注册用户返回信息:'.json_encode($response));
            return 0 ;
        }
    }

    // 查询余额，获取用户在平台资金
    public function getAmount(){
        $gmt = 12 * 60 * 60;
        $dateStr = date('Ymd', time() - $gmt);
        $method = "CheckUsrBalance";
        $postData = [
            'website'   => $this->webSite,
            'username'  => $this->username,
            'uppername' => $this->upperName,
        ];
        $md5str = strtolower(md5(utf8_encode($postData['website'] . $postData['username'] . "4xZ5474fQ" . $dateStr)));
        // 編成key碼加前後無意義碼
        $postData['key'] = '123456789' . $md5str . '12';
        $response = $this->post($method, $postData);
        if($response['result'] == true){
            return $response['data'][0]['TotalBalance'];
        } else {
            $log = new \Think\Log();
            $log->record('BBIN查询余额返回信息:'.json_encode($response));
            return 0 ;
        }
    }

    //平台转账
    //$type='IN'/'OUT'; IN:从网站账号转款到游戏账号  OUT:从游戏账号转款到网站账号//
    public function transfer($type,$amount){
        $gmt = 12 * 60 * 60;
        $dateStr = date('Ymd', time() - $gmt);
        $transid = "64".time().rand(1000,9999);
        $amount = (int)$amount;
        $md5str = strtolower(md5(utf8_encode($this->webSite . $this->username . $transid . "n1TBaber84" . $dateStr)));
        // 編成key碼加前後無意義碼
        $key = '123' . $md5str . '1234';
        $url = $this->apiUrl . 'Transfer?website=' . $this->webSite . '&username=' . $this->username . '&uppername=' . $this->upperName
            . '&remitno=' . $transid . '&action=' . $type . '&remit=' . $amount . '&key=' . $key;
        $response = $this->get($url);
        if($response['result'] == true){
            return $transid;
        } else {
            $log = new \Think\Log();
            $log->record('BBIN用户转账返回信息:'.json_encode($response));
            return 0 ;
        }
    }

    //进入游戏
    public function goGame(){
        $gmt = 12 * 60 * 60;
        $dateStr = date('Ymd', time() - $gmt);
        $postData = [
            'website'   => $this->webSite,
            'username'  => $this->username,
            'uppername' => $this->upperName,
            'lang'      => "zh-cn",
            'page_site' => $this->gameType,
        ];
        $md5str = strtolower(md5(utf8_encode($postData['website'] . $postData['username'] . "j30Ak0dY" . $dateStr)));
        // 編成key碼加前後無意義碼
        $postData['key'] = '123456789' . $md5str . '123456';
        $url = "http://888.apibox.info/app/WebService/JSON/display.php/Login";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $output = curl_exec($ch);
        curl_close($ch);
//        if($response['result'] == true){
            $html = str_replace("'",'"',$output);
            $result = substr(strstr($html,'<body'),0,strlen(strstr($html,'<body'))-7).'<script>$(function(){$("#post_form").submit();});</script>';
            return $result;
//        } else {
//            $log = new \Think\Log();
//            $log->record('BBIN登录游戏提交参数:'.json_encode($postData).PHP_EOL.'提交URL:'.$url.PHP_EOL.'返回信息:'.json_encode($response));
//            return 0 ;
//        }
    }

    //获取游戏记录
    public function playerBetLog(){
        $gmt = 12 * 60 * 60;
        $dateStr = date('Ymd', time() - $gmt);
        $method = "BetRecord";
        $postData = [
            'website'   => $this->webSite,
            'uppername' => $this->upperName,
            'rounddate' => $this->params['rounddate'],
            'starttime' => $this->params['starttime'],
            'endtime'   => $this->params['endtime'],
            'gamekind'  => $this->params['gamekind'],
            'page'      => $this->params['page']
        ];
        $md5str = strtolower(md5(utf8_encode($postData['website'] . "oxC73Q6dq" . $dateStr)));
        // 編成key碼加前後無意義碼
        $postData['key'] = '1234' . $md5str . '123456';
        $response = $this->post($method, $postData);
        if($response['result'] == true){
            return $response;
        } else {
            $log = new \Think\Log();
            $log->record('BBIN获取游戏记录parameters:'.json_encode($postData).PHP_EOL.'响应:'.json_encode($response));
            return 0 ;
        }
    }












    //数组转换成字串
    private function arrayeval($array,$format=false,$level=0){
        $space=$line='';
        if(!$format){
            for($i=0;$i<=$level;$i++){
                $space.="\t";
            }
            $line="\n";
        }
        $evaluate='Array'.$line.$space.'('.$line;
        $comma=$space;
        foreach($array as $key=> $val){
            $key=is_string($key)?'\''.addcslashes($key,'\'\\').'\'':$key;
            $val=!is_array($val)&&(!preg_match('/^\-?\d+$/',$val)||strlen($val) > 12)?'\''.addcslashes($val,'\'\\').'\'':$val;
            if(is_array($val)){
                $evaluate.=$comma.$key.'=>'.$this->arrayeval($val,$format,$level+1);
            }else{
                $evaluate.=$comma.$key.'=>'.$val;
            }
            $comma=','.$line.$space;
        }
        $evaluate.=$line.$space.')';
        return $evaluate;
    }

    private function encrypt($input) {
        $size = mcrypt_get_block_size('des', 'ecb');
        $input = $this->pkcs5_pad($input, $size);
        $key = $this->DesKey;
        $td = mcrypt_module_open('des', '', 'ecb', '');
        $iv = @mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        @mcrypt_generic_init($td, $key, $iv);
        $data = mcrypt_generic($td, $input);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        $data = base64_encode($data);
        return preg_replace("/\s*/", '',$data);
    }

    private function decrypt($encrypted) {
        $encrypted = base64_decode($encrypted);
        $key =$this->DesKey;
        $td = mcrypt_module_open('des','','ecb','');
        //使用MCRYPT_DES算法,cbc模式
        $iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        $ks = mcrypt_enc_get_key_size($td);
        @mcrypt_generic_init($td, $key, $iv);
        //初始处理
        $decrypted = mdecrypt_generic($td, $encrypted);
        //解密
        mcrypt_generic_deinit($td);
        //结束
        mcrypt_module_close($td);
        $y=$this->pkcs5_unpad($decrypted);
        return $y;
    }

    private function pkcs5_pad ($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    private function pkcs5_unpad($text) {
        $pad = ord($text{strlen($text)-1});
        if ($pad > strlen($text))
            return false;
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad)
            return false;
        return substr($text, 0, -1 * $pad);
    }
}
