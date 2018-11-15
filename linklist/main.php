<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/7
 * Time: 12:05
 */
require_once "linkedList.php";
require_once "linkedListStack.php";
require_once "LinkedListQueue.php";



$linkedList = new LinkedListQueue();

foreach (range(0,9) as $item) {
    $linkedList->enqueue($item);
    $linkedList->toString();
}

$linkedList->dequeue();
$linkedList->toString();

$linkedList->dequeue();
$linkedList->toString();
//$linkedList = new LinkedList();
//
//foreach (range(0, 4) as $value) {
//    $linkedList->addFirst($value);
//    $linkedList->toString();
//}
//
//$linkedList->add(2,88);
//$linkedList->toString();
//
//$linkedList->set(3,99);
//$linkedList->toString();
//
//$linkedList->remove(2);
//$linkedList->toString();
//
//$linkedList->removeFirst();
//$linkedList->toString();
//
//$linkedList->removeLast();
//$linkedList->toString();