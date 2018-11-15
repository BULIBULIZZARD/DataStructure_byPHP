<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/8
 * Time: 19:41
 */

require_once "../BST/BST.php";
require_once "Set.php";

class BSTSet implements Set
{
    private $bst;

    public function __construct()
    {
        $this->bst = new BST();
    }

    function add($e)
    {
        $this->bst->add($e);
    }

    function remove($e)
    {
        $this->bst->remove($e);
    }

    function contains($e)
    {
        $this->bst->contains($e);
    }

    function getSize()
    {
        return $this->bst->size();
    }

    function isEmpty()
    {
        return $this->bst->isEmpty();
    }
}