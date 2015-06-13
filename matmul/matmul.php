<?php

$matrix = [];

function mat_new($k, $j){
    $a = [];
    for($i=0;$i<$k;$i++){
        $a[$i] = array_fill(0, $j, 0);
    }
    return $a;
}

function mat_gen($n){
    $y = mat_new($n, $n);
    $tmp = 1 / $n / $n;
    foreach($y as $i => $lvl1){
        foreach($lvl1 as $j => $lvl2){
            $y[$i][$j] = $tmp * ($i - $j) * ($i + $j);
        }
    }
    return $y;
}

function mat_mul($mat_a, $mat_b){
    $m = count($mat_a);
    $n = count($mat_a[0]);
    $p = count($mat_b[0]);

    $b2 = mat_new($n, $p);
    foreach($b2 as $i => $lvl1){
        foreach($lvl1 as $j => $lvl2){
            $b2[$j][$i] = $mat_b[$i][$j];
        }
    }

    $c = mat_new($m, $p);
    foreach($c as $i => $lvl1){
        foreach($lvl1 as $j => $lvl2){
            $s = 0.0;
            $ai = $mat_a[$i];
            $b2j = $b2[$j];
            for($k=0;$k<$n;$k++){
                $s += $ai[$k] * $b2j[$k];
            }
            $c[$i][$j] = $s;
        }
    }
    return $c;
}

$n = 100;
if(isset($argv[1])){
    $n = (int) $argv[1];
}

$a = mat_gen($n);
$b = mat_gen($n);
$c = mat_mul($a, $b, $n);
echo $c[($n/2)][($n / 2)]."\n";
