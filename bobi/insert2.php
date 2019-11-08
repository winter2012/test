<?php
$file = file_get_contents('jd.txt');
$strArray = explode("\r\n",$file);
$data = [];
$stream = fopen("jd_after.txt", "w+");
$itemData = [];
foreach ($strArray as $item){
    $itemArray = explode("/",$item);
    $itemData[] = $itemArray;
}
$i = 0;
$littleData = [];
$bigData = [];
foreach ($itemData as $itemDatum){
    if( count($itemDatum) < 20 ){
        $littleData[] = $itemDatum;
    } else {
        if( $itemDatum[20] != "" ){
            $bigData[] = $itemDatum;
        }
    }
}
foreach ($bigData as $datum) {
    $datumOn = implode(';',$datum);
    fwrite($stream,$datumOn);
    fwrite($stream,"\r\n");
}