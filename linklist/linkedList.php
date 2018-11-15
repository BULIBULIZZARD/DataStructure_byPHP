<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/7
 * Time: 11:05
 */
require_once "node.php";
require_once "../base/myException.php";

class LinkedList
{
    private $dummyHead;
    private $size;


    public function __construct()
    {
        $this->dummyHead = new Node();
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


    public function add($index, $e)
    {
        if ($index < 0 || $index > $this->size) {
            (new myException("index out of range"))->throw_me();
        }
        $perv = $this->dummyHead;
        for ($i = 0; $i < $index; $i++) {
            $perv = $perv->next;
        }
//        $node = new Node($e);
//        $node->next = $perv->next;
//        $perv->next = $node;
        $perv->next = new Node($e, $perv->next);

        $this->size++;

    }
    /**
     * @param $e
     */
    public function addFirst($e)
    {
//        $node = new Node($e);
//        $node->next = $this->head;
//        $this->head=$node;
//        $this->head = new Node($e, $this->head);
//        $this->size++;
        $this->add(0, $e);
    }

    /**
     * @param $e
     */
    public function addLast($e)
    {
        $this->add($this->size, $e);
    }

    public function get($index)
    {
        if ($index < 0 || $index >= $this->size) {
            (new myException("Get failed Illegal index"))->throw_me();
        }
        $cur = $this->dummyHead->next;
        for ($i = 0; $i < $index; $i++) {
            $cur = $cur->next;
        }
        return $cur->e;
    }

    public function getFirst()
    {
        return $this->get(0);
    }

    public function getLast()
    {
        return $this->get($this->size - 1);
    }

    public function set($index, $e)
    {
        if ($index < 0 || $index >= $this->size) {
            (new myException("Get failed Illegal index"))->throw_me();
        }
        $cur = $this->dummyHead->next;
        for ($i = 0; $i < $index; $i++) {
            $cur = $cur->next;
        }
        $cur->e = $e;
    }

    public function contains($e)
    {
        $cur = New Node(null, $this->dummyHead->next);
        while ($cur != null) {
            if ($cur->e === $e) {
                return true;
            }
            $cur = $cur->next;
        }
        return false;
    }

    public function remove($index)
    {
        if ($index < 0 || $index >= $this->size) {
            (new myException("Get failed Illegal index"))->throw_me();
        }
        $perv = $this->dummyHead;
        for ($i = 0; $i < $index; $i++) {
            $perv = $perv->next;
        }
        $retNode = $perv->next;
        $perv->next = $retNode->next;
        $retNode->next = null;
        $this->size--;
        return $retNode->e;
    }

    public function removeFirst()
    {
        return $this->remove(0);
    }

    public function removeLast()
    {
        return $this->remove($this->size - 1);
    }

    public function removeElement($e){
        $perv = $this->dummyHead;
        while ($perv->next!=null){
            if ($perv->next->e == $e){
                break;
            }
            $perv = $perv->next;
        }

        if ($perv->next!=null){
            $delNode = $perv->next;
            $perv->next = $delNode->next;
            $delNode->next = null;
        }
    }
    public function toString()
    {
        $cur = $this->dummyHead->next;
        while ($cur != null) {
            echo $cur->e;
            echo '->';
            $cur = $cur->next;
        }
        echo "NULL\n";
    }
}