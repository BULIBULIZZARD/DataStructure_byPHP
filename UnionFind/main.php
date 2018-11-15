<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/11
 * Time: 19:26
 */

require_once "UnionFind1.php";
require_once "UnionFind2.php";
require_once "UnionFind3.php";
require_once "UnionFind4.php";
require_once "UnionFind5.php";
require_once "UnionFind6.php";

function test($uf,$m){
    $size = $uf->getSize();
    $startTime = time()+microtime();
    for ($i=0;$i<$m;$i++){
        $a = rand(0,$size-1);
        $b = rand(0,$size-1);
        $uf->unionElements($a,$b);
    }
    for ($i=0;$i<$m;$i++){
        $a = rand(0,$size-1);
        $b = rand(0,$size-1);
        $uf->isConnected($a,$b);
    }
    $endTime = time()+microtime();
    return ($endTime - $startTime);
}

$size = 100000;
$m = 10000;
//$uf1 = new UnionFind1($size);
//echo "UnionFind1 :".test($uf1,$m)."\n";

$uf2 = new UnionFind2($size);
echo "UnionFind2 :".test($uf2,$m)."\n";

$uf3 = new UnionFind3($size);
echo "UnionFind3 :".test($uf3,$m)."\n";

$uf4 = new UnionFind4($size);
echo "UnionFind4 :".test($uf4,$m)."\n";

$uf5 = new UnionFind5($size);
echo "UnionFind5 :".test($uf5,$m)."\n";

$uf6 = new UnionFind6($size);
echo "UnionFind5 :".test($uf6,$m)."\n";
