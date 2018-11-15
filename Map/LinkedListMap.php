<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/9
 * Time: 9:49
 */

require_once "node.php";
require_once "Map.php";
require_once "../base/myException.php";


use Map\Node;

class LinkedListMap implements Map
{

    private $dummyHead;
    private $size;

    public function __construct()
    {
        $this->dummyHead = new Node();
        $this->size = 0;
    }

    private function getNode($key)
    {
        $cur = $this->dummyHead->next;
        while ($cur != null) {
            if ($cur->key == $key) {
                return $cur;
            }
            $cur = $cur->next;
        }
        return null;
    }

    public function add($key, $value)
    {
        $node = $this->getNode($key);
        if ($node == null) {
            $this->dummyHead->next = new Node($key, $value, $this->dummyHead->next);
            $this->size++;
        } else {
            $node->value = $value;
        }
    }

    public function remove($key)
    {
        $prev = $this->dummyHead;
        while ($prev->next != null) {
            if ($prev->next->key === $key) {
                break;
            }
            $prev = $prev->next;
        }
        if ($prev->next != null) {
            $delNode = $prev->next;
            $prev->next = $delNode->next;
            $delNode->next = null;
            $this->size--;
            return $delNode->value;
        }
        return null;
    }

    public function contains($key)
    {
        return $this->getNode($key) != null;
    }

    public function get($key)
    {
        $node = $this->getNode($key);
        return $node == null ? null : $node->value;
    }

    public function set($key, $value)
    {
        $node = $this->getNode($key);
        if ($node == null) {
            (new myException($key . "doesn't exist"))->throw_me();
        }
        $node->value = $value;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function isEmpty()
    {
        return $this->size == 0;
    }

}