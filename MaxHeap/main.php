<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/9
 * Time: 12:27
 */


require_once "MaxHeap.php";


$n = 100000;

$arr=[];
foreach (range(0,$n) as $v){
    array_push($arr,$v);
}
$maxHeap = new MaxHeap($arr);
$arr=[];
while ($maxHeap->size()>0){
    array_push($arr,$maxHeap->extractMax());
}
for ($i=1;$i<sizeof($arr);$i++){
    if ($arr[$i]>$arr[$i-1]){
        echo "false";
    }
}
echo "true;";