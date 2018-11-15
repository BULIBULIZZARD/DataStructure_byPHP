<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/8
 * Time: 19:50
 */
require_once "LinkedListMap.php";
require_once "BSTMap.php";

echo "Pride and prejudice \n";
$file = file("../Set/pride-and-prejudice.txt");
$line = sizeof($file);
foreach (range(0,$line-1) as $value){

    $data = array_shift($file);
    $data = str_replace(",",' ',$data);
    $data = str_replace(".",' ',$data);
    $data = str_replace("\n",' ',$data);
    $data = explode(' ',$data);
    foreach ($data as $v){
        array_push($file,$v);
    }
}
echo sizeof($file)."\n";
$map = new BSTMap();

foreach ($file as $word){
    if ($map->contains($word)){
        $map->set($word,$map->get($word)+1);
        echo "set ".$word."\n";
    }else{
        $map->add($word,1);
        echo "add ".$word."\n";
    }
}
echo $map->getSize();

