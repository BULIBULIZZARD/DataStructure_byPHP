<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/8
 * Time: 19:50
 */
require_once "AVLTree.php";

use AVL\AVLTree as AVL;

echo "Pride and prejudice \n";
$file = file("../Set/pride-and-prejudice.txt");
$line = sizeof($file);
foreach (range(0,$line-1) as $value){

    $data = array_shift($file);
    $data = str_replace(",",' ',$data);
    $data = str_replace(".",' ',$data);
    $data = str_replace("\n",' ',$data);
    $data = str_replace("\t",' ',$data);
    $data = explode(' ',$data);
    foreach ($data as $v){
        array_push($file,$v);
    }
}
echo sizeof($file) . "\n";
$map = new AVL();

foreach ($file as $word){
    if ($map->contains($word)){
        $map->set($word,$map->get($word)+1);
        echo "set ".$word."\n";
    }else{
        $map->add($word,1);
        echo "add ".$word."\n";
    }
}
//foreach (range(0, 100) as $i) {
//    $map->add(rand(1, 100), rand(1, 100));
//}
$string ="";
$string.= $map->getSize();
$string.= "\n";

$string.= "is BST: ";
$string.= $map->isBST() ? 'true' : 'false';
$string.= "\n";


$string.= "is Balanced: ";
$string.= $map->isBalanced() ? 'true' : 'false';
$string.= "\n";


echo $string;

