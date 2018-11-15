<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/6
 * Time: 20:12
 */

require_once '../array/myArray.php';
require_once 'queue.php';

class ArrayQueue implements Queue
{
    private $array;

    public function __construct($capacity = 10)
    {
        $this->array = new myArray($capacity);
    }

    public function getSize()
    {
        return $this->array->getSize();
    }

    public function isEmpty()
    {
        return $this->array->isEmpty();
    }

    public function enqueue($e)
    {
        $this->array->addLast($e);
    }

    public function dequeue()
    {
        return $this->array->removeFirst();
    }

    public function getFront()
    {
        return $this->array->getFirst();
    }

    public function toString(){
        $string = "";
        $string .= "Queue: ";
        $string .= "front [";
        for ($i = 0; $i < $this->array->getSize(); $i++) {
            $string .= $this->array->get($i);
            if ($i != $this->array->getSize() - 1) {
                $string .= ",";
            }
        }
        $string .= "] tail \n";
        return $string;
    }
}