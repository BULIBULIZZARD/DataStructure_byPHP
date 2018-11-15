<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/10
 * Time: 15:49
 */


require_once "SegmentTree.php";
require_once "AddMerger.php";

$nums = [-2,0,3,-5,2,-1];
$segTree = new SegmentTree($nums,new AddMerger());

echo $segTree->toString();
echo "\n";

$segTree->set(0,1);
echo $segTree->toString();
echo "\n";


