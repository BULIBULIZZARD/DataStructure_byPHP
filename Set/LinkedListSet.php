<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/8
 * Time: 20:05
 */

require_once "../linklist/linkedList.php";
require_once "Set.php";

class LinkedListSet implements Set
{
    private $list;
    public function __construct()
    {
        $this->list= new LinkedList();
    }

    function add($e)
    {
        if (!$this->list->contains($e)){
            $this->list->addFirst($e);
        }
    }

    function remove($e)
    {
        $this->list->removeElement($e);
    }

    function contains($e)
    {
        return $this->list->contains($e);
    }

    function getSize()
    {
        return $this->list->getSize();
    }

    function isEmpty()
    {
        return $this->list->isEmpty();
    }
}