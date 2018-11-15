<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/7
 * Time: 12:57
 */
require_once "../queue/queue.php";
require_once "../base/myException.php";


class LinkedListQueue implements Queue
{

    private $head;
    private $tail;
    private $size;

    public function __construct()
    {
        $this->head = null;
        $this->tail = null;
        $this->size = 0;
    }


    public function getSize()
    {
        return $this->size;
    }

    public function isEmpty()
    {
        return $this->size == 0;
    }

    public function enqueue($e)
    {
        if ($this->tail == null ) {
            $this->tail = new Node($e);
            $this->head = $this->tail;
        } else {
            $this->tail->next = new Node($e);
            $this->tail = $this->tail->next;
        }
        $this->size++;
    }

    public function dequeue()
    {

        if ($this->isEmpty()) {
            (new myException("Cannot dequeque form an empty queue"))->throw_me();
        }

        $retNode = $this->head;
        $this->head = $this->head->next;
      //  $retNode->next = new Node();
        if ($this->head->e == null) {
            $this->tail = new Node();
        }
        $this->size--;
        return $retNode->e;
    }

    public function getFront()
    {
        if ($this->isEmpty()) {
            (new myException("Cannot dequeque form an empty queue"))->throw_me();
        }
        return $this->head->e;
    }

    public function toString(){
        $string = "Queue: front  ";
        $cur = $this->head;
        while ($cur!=null){
            $string.=$cur->e.'->';
            $cur=$cur->next;
        }
        $string.="NULL tail\n";
        echo $string;
    }
}