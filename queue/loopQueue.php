<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/6
 * Time: 20:28
 */

require_once "../base/myException.php";
require_once "queue.php";

class LoopQueue implements Queue
{
    private $data;
    private $front, $tail;
    private $size;
    private $capacity;

    public function __construct($capacity=10)
    {
        $this->data = [];
        $this->capacity = $capacity + 1;
        $this->front = 0;
        $this->tail = 0;
        $this->size = 0;
    }

    public function getCapacity()
    {
        return $this->capacity - 1;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function isEmpty()
    {
        return $this->front == $this->tail;
    }

    public function enqueue($e)
    {
        if (($this->tail + 1) % $this->capacity == $this->front) {
            $this->resize($this->getCapacity() * 2);
        }
        $this->data[$this->tail] = $e;
        $this->tail = ($this->tail + 1) % $this->capacity;
        $this->size++;
    }

    private function resize($newCapacity)
    {
        $this->capacity = $newCapacity + 1;
        $data = [];
        for ($i = 0; $i < $this->size; $i++) {
            $data[$i] = $this->data[($i + $this->front) % sizeof($this->data)];
        }
        $this->data = $data;
        $this->front = 0;
        $this->tail = $this->size;
    }

    public function dequeue()
    {
        if ($this->isEmpty()) {
            (new myException("Cannot dequeue from an empty queue"))->throw_me();
        }
        $ret = $this->data[$this->front];
        $this->data[$this->front] = null;
        $this->front = ($this->front + 1) % $this->capacity;
        $this->size--;
        if ($this->size == (int)($this->getCapacity() / 4) && $this->getCapacity() > 10) {
            $this->resize((int)($this->getCapacity() / 2));
        }
        return $ret;
    }

    public function getFront()
    {
        if ($this->isEmpty()) {
            (new myException("Cannot dequeue from an empty queue"))->throw_me();
        }
        return $this->data[$this->front];
    }

    public function toString()
    {


        $string = "";
        $string .= "Queue: size = " . $this->size . " , capacity = " . $this->getCapacity() . "\n";
        $string .= "front [";
        for ($i = $this->front; $i != $this->tail; $i = ($i + 1) % $this->capacity) {
            $string .= $this->data[$i];
            if (($i + 1) % $this->capacity != $this->tail) {
                $string .= ",";
            }
        }
        $string .= "] tail\n";
        return $string;
    }

    public function printData(){
        print_r($this->data);
    }

}