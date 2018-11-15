<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/7
 * Time: 12:36
 */
require_once "../stack/stack.php";
require_once "linkedList.php";

class LinkedListStack implements Stack
{
    private $linklist;

    public function __construct()
    {
        $this->linklist=new LinkedList();
    }

    public function getSize()
    {
        return $this->linklist->getSize();
    }

    public function isEmpty()
    {
        return $this->linklist->isEmpty();
    }

    public function push($e)
    {
        $this->linklist->addFirst($e);
    }

    public function pop()
    {
        return $this->linklist->removeFirst();
    }

    public function peek()
    {
        return $this->linklist->getFirst();
    }

    public function toString(){
        $string = "Stack: top ";
        echo $string;
        $this->linklist->toString();
    }

}