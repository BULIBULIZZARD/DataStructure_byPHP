<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/9
 * Time: 13:17
 */
require_once "../queue/queue.php";
require_once "MaxHeap.php";

class PriorityQueue implements Queue
{

    private $maxHeap;

    public function __construct()
    {
        $this->maxHeap = new MaxHeap();
    }

    public function getSize()
    {
        return $this->maxHeap->size();
    }

    public function isEmpty()
    {
        return $this->maxHeap->size() == 0;
    }

    public function enqueue($e)
    {
        $this->maxHeap->add($e);
    }

    public function dequeue()
    {
        return $this->maxHeap->extractMax();
    }

    public function getFront()
    {
        return $this->maxHeap->findMax();
    }
}