<?php
$file = file_get_contents('73qp2.txt');
$strArray = explode("\n",$file);
$data = [];
foreach ($strArray as $item){
    $pickData = json_decode($item,320);
    $tmpData = rtrim($pickData['Data'],'}');
    $tmpData = ltrim($tmpData,'{');
    $primaryData = explode('},{',$tmpData);
    foreach ($primaryData as $datum){
        $datum = "{".$datum."}";
        $data[] = json_decode($datum,320);
    }
}
$stream = fopen("table2.txt", "w+");
//foreach ($data[0] as $key=>$value){
//    fwrite($stream,$key."/");
//}
//fwrite($stream,"\r\n");
foreach ($data as $datum){
    if( isset($datum['RegisterMobile']) && $datum['RegisterMobile'] != null ){
//        foreach ($datum as $key=>$value){
//            fwrite($stream,$value."/");
//        }
        fwrite($stream,$datum['RegisterMobile']);
        fwrite($stream,"\r\n");
    }
}