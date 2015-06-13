<?php 

$json = json_decode(file_get_contents('./1.json'));

$coordinates = $json->coordinates;
$len = count($coordinates);

$x = $y = $z = 0.0;

foreach($coordinates as $coord){
    $x += $coord->x;
    $y += $coord->y;
    $z += $coord->z;
}

echo ($x / $len), "\n";
echo ($y / $len), "\n";
echo ($z / $len), "\n";