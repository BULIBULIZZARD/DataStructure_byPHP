<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 12:14
 */
require_once "../AVLTree/AVLTree.php";
require_once "Map.php";

use AVL\AVLTree as AVL;
class AVLMap implements Map
{

    private $avl;

    public function __construct()
    {
        $this->avl = new AVL();
    }

    public function add($key, $value)
    {
        $this->avl->add($key,$value);
    }

    public function remove($key)
    {
        return $this->avl->remove($key);
    }

    public function contains($key)
    {
        return $this->avl->contains($key);
    }

    public function get($key)
    {
        return $this->avl->get($key);
    }

    public function set($key, $value)
    {
        $this->avl->set($key,$value);
    }

    public function getSize()
    {
        return $this->avl->getSize();
    }

    public function isEmpty()
    {
        return $this->avl->isEmpty();
    }
}