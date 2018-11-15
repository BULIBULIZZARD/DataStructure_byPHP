<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/8
 * Time: 19:50
 */
require_once "BSTSet.php";
require_once "LinkedListSet.php";

echo "Pride and prejudice \n";
$file = file("pride-and-prejudice.txt");
$line = sizeof($file);
foreach (range(0,$line-1) as $value){
    $data = array_shift($file);
    $data = explode(' ',$data);
    foreach ($data as $v){
        array_push($file,$v);
    }
}
echo sizeof($file);

//$set = new LinkedListSet();
//foreach ($file as $value){
//    $set->add($value);
//}
//
//echo $set->getSize()."\n";
//echo sizeof($file);

