<?php

$str_size = 10000000;
$tries = 100;

$str = str_repeat("a", $str_size );
$str2 = ""; 

$start=microtime(true);
$s = 0;

for($i=0; $i< $tries; $i++){
    $str2 = base64_encode($str);
    $s += strlen($str2);
}
echo sprintf("encode: %d, %f", $s, microtime(true) - $start)."\n";

$start=microtime(true);
$s = 0;

for($i=0; $i < $tries; $i++){
    $s += strlen(base64_decode($str2));
}
echo sprintf("decode: %d, %f", $s, microtime(true) - $start)."\n";
