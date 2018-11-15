<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/6
 * Time: 20:17
 */

require_once "arrayQueue.php";
require_once "loopQueue.php";

$queue = new ArrayQueue();

//for ($i=0;$i<12;$i++){
//    $queue->enqueue($i);
//    if ($i%3==2){
//        $queue->dequeue();
//    }
//}
//$queue->printData();
//echo $queue->toString();
//
//$queue->dequeue();
//$queue->dequeue();
//echo $queue->toString();
$time =  microtime();
$test = 1000000;
for ($i=0;$i<$test;$i++){
    $queue->enqueue(rand(2,10));
    $queue->dequeue();
}

echo (microtime()-$time)/1000000000.0;